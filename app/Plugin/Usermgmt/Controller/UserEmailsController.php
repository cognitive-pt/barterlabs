<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class UserEmailsController extends AppController {

/**
* This controller uses following models
*
* @var array
*/
public $uses = array('Usermgmt.User', 'Usermgmt.UserEmail', 'Usermgmt.UserGroup', 'Usermgmt.UserContact', 'Usermgmt.UserEmailTemplate', 'Usermgmt.UserEmailSignature','Pic','Usermgmt.UserDetail', 'Lab');


/**
* This controller uses following components
*
* @var array
*/
public $components = array('RequestHandler', 'Usermgmt.Search', 'Session');


/**
* This controller uses following helpers
*
* @var array
*/
public $helpers = array('Js', 'Usermgmt.Tinymce', 'Usermgmt.Ckeditor');


/**
* This controller uses following default pagination values
*
* @var array
*/
public $paginate = array(
'limit' => 25
);


/**
* This controller uses search filters in following functions for ex index function
*
* @var array
*/
			var $searchFields = array(
							'index' => array(
							'UserEmail' => array(
							'UserEmail'=> array(
							'type' => 'text',
							'label' => 'Search',
							'tagline' => 'Search by subject, message',
							'condition' => 'multiple',
							'searchFields'=>array('UserEmail.subject', 'UserEmail.message'),
							'inputOptions'=>array('style'=>'width:300px;')
						)
					)
				)
			);


/**
* Called before the controller action.  You can use this method to configure and customize components
* or perform logic that needs to happen before each controller action.
*
* @return void
*/
public function beforeFilter() {
	parent::beforeFilter();
		if(isset($this->Security) &&  $this->RequestHandler->isAjax()){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
		
		/**** USER EMAIL CHECK ****/
	    $userId = $this->UserAuth->getUserId();
		$checkEmail = $this->UserEmail->checkEmail($userId);
		$this->set('checkEmail', $checkEmail);
		/**** END USER EMAIL CHECK ****/
}


/**
* Index displays inbox
*
* @access public
* @return array
*/
public function index() {
$cond = array();

		$cond['UserEmail.to_id']=$this->UserAuth->getUserId();
		
		$userEmails = $this->UserEmail->find('all', array(
			'conditions'=>$cond, 
			'contain'=>array('User'), 
			'fields'=>array('UserEmail.*', 'User.id','User.username'),
			'order'=>array('UserEmail.created DESC')
			)
		); 


		if (empty($userEmails)) {
			$userEmails=NULL;
		} 
		
		$this->paginate('UserEmail');
		$this->set('userEmails', $userEmails);
		
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/all_emails');
		}
}// END INDEX INBOX




/**
* Sent displays all sent Emails
*
* @access public
* @return array
*/	


public function sent() {
$cond = array();

$cond['UserEmail.from_id']=$this->UserAuth->getUserId();

	$userEmails = $this->UserEmail->find('all', array(
		'conditions'=>$cond, 
		'contain'=>array('User'), 
		'fields'=>array('UserEmail.*', 'User.id','User.username'),
		'order'=>array('UserEmail.created DESC')
		)
	); 


	if (empty($userEmails)) {
		$userEmails=NULL;
	} 
	
	$this->paginate('UserEmail');
	$this->set('userEmails', $userEmails);
	
	if($this->RequestHandler->isAjax()) {
		$this->layout = 'ajax';
		$this->render('/Elements/all_emails');
	}

}



/**
* Used to view userEmail 
*
* @access public
* @param integer $userEmailId userEmail id
* @return void
*/
public function view($userEmailId = null) {

$userId = $this->UserAuth->getUserId();
	if (!empty($userEmailId)) {
		if (!$this->UserAuth->isAdmin()) {$cond['UserEmail.from_id']=$this->UserAuth->getUserId();}
			$userEmail = $this->UserEmail->getUserEmail($userEmailId);
			$fromPic = $this->UserDetail->getFromPic($userEmail['UserEmail']['from_id']);
			$toName = $this->User->find('first', array(
				'conditions'=>array(
				'User.id'=>$userEmail['UserEmail']['to_id']),
				'recursive'=>0,
				'fields'=>array('User.username')
				)
			);




	if(($userId==$userEmail['UserEmail']['to_id'])||($userId==$userEmail['UserEmail']['from_id'])){	
		$this->UserEmail->id = $userEmail['UserEmail']['id'];
		$this->request->data['UserEmail']['is_email_read']=1;
		$this->UserEmail->save($this->request->data);
		$this->set(compact('userEmail','userId','toName','fromPic'));


		if ($this->request->is(array('post', 'put'))) {
			$this->redirect(array('controller' => 
				'UserEmails', 
				'action' => 'send', $userEmail['UserEmail']['from_id'], 
				'plugin'=>'usermgmt'));}
				}
					else {   
						$this->Session->setFlash('Invalid email id', 'default', array('class' => 'warning'));
						$this->redirect(array('action'=>'index'));}
						        } else {
									$this->Session->setFlash('Invalid email id', 'default', array('class' => 'warning'));
									$this->redirect(array('action'=>'index', 'page'=>$page));}
}




/**
* deleteEmail method
*
*
* 
* 
*/
public function deleteEmail($id = null) {

$userId = $this->UserAuth->getUserId();

$this->UserEmail->id = $id;

	//this finds the Lab_id and User_id of the selected Pic for two purposes:
	//***1) to reroute to the proper lab after delete
	//***2) to validate that the Picture belongs to the user attempting to delete it

$res = $this->UserEmail->find('first', array('conditions'=>array('UserEmail.id'=>$id), 'fields'=>array('UserEmail.id','UserEmail.to_id'),'recursive'=>0));
	if (($res['UserEmail']['to_id']==$userId)||($res['UserEmail']['from_id']==$userId)){
	if (!$this->UserEmail->exists()) {
		throw new NotFoundException(__('Invalid email'));
		}

$this->request->onlyAllow('post', 'delete');
	if ($this->UserEmail->delete()) {
		$this->Session->setFlash(__('This email has been deleted.'));
		} else {$this->Session->setFlash(__('This email could not be deleted. Please, try again.'),array('class' => 'warning'));}
			return $this->redirect(array('action'=>'index'));
			}
		   	 else {$this->Session->setFlash(__('You can only delete email that belong to you.'),array('class' => 'warning'));}



}	






/**
* It is used to send email to user
*
* @access public
* @param integer $userId user id of user
* @return void
*/
public function send($id) {

$userId = $this->UserAuth->getUserId();
$globalLabId = $this->Session->read('globalLabId');
$globalLabEmail = $this->Session->read('globalLabEmail');
$globalLabProjectname = $this->Session->read('globalLabProjectname');

/*find the info of the TO user based on their id*/
$user = $this->User->find('first', array('conditions'=>array('User.id'=>$id), 'contain'=>array('UserDetail')));

/*determine the "to_name"*/
$res=$this->User->find('first', array('conditions'=>array('id'=>$id), 'fields'=>array('User.username')));
$to_name=(!empty($res)) ? ($res['User']['username']) : '';




if(!empty($globalLabEmail)){
	$toEmailAddress=$globalLabEmail;
	} else{
	$this->Session->setFlash(__('Awe no, this lab is without an email address! Check the listing for contact info.', 'default', array('class' => 'warning')));
	$this->Session->delete('globalLabEmail');
	$this->Session->delete('globalLabId');
	$this->Session->delete('globalLabProjectname');
	$this->Session->delete('toUser');
	$this->redirect(array(
							'controller'=>'Labs', 
							'action'=>'view', $globalLabId,
							'plugin'=>''));
}


/*determine is sending user is anonymous*/
 if (!$this->UserAuth->isLogged()) {
 	$anon = 1;
 	$senderName = "Anonymous Barterlabs User";
 	$fromEmailAddress = 'DO_NOT_REPLY@barterlabs.com';
 	$this->set(compact('anon', 'senderName'));
 } else {
 	$anon = 0;
 	/*determine the senderName*/
	$res2=$this->User->find('first', array('conditions'=>array('User.id'=>$userId), 'fields'=>array('User.username')));
	$senderName=(!empty($res2)) ? ($res2['User']['username']) : '';
 	$res5 = $this->User->find('first', array('conditions'=>array('User.id'=>$userId), 'fields'=>array('User.email')));
 	$fromEmailAddress=(!empty($res5)) ? ($res5['User']['email']) : '';
 	$this->set(compact('anon', 'senderName'));
 }

$this->set(compact('to_name'));

	if(!empty($globalLabId)){
		$subject = "Inquiry regarding Trade #".$globalLabId.", ".$globalLabProjectname;} else {$subject = "A Barterlabs message from ".$senderName;
		}

	$this->set('subject', $subject);

	if ($this->request->isPost()) {
			$Email = new CakeEmail();
			$Email->from(array('trades@barterlabs.com' => $fromEmailAddress));
			$Email->to(array($toEmailAddress=>$toEmailAddress));
			$Email->subject($subject);
			$message = $this->request->data['UserEmail']['message'];
			$Email->send($message);


		$this->UserEmail->create();
		$this->request->data['UserEmail']['from_id'] = $userId;
		$this->request->data['UserEmail']['to_id'] = $id;
		$this->request->data['UserEmail']['is_email_sent'] = 1;
		$this->UserEmail->set($this->request->data);
		$this->UserEmail->save($this->request->data);
			

		$this->Session->setFlash(__('This email has been sent.'));
		$this->Session->delete('globalLabEmail');
		$this->Session->delete('globalLabId');
		$this->Session->delete('globalLabProjectname');
		$this->Session->delete('toUser');
		$this->redirect(array('controller'=>'Labs', 'action'=>'index','plugin'=>''));
		} else {$this->Session->delete('lab');
		 	 	$this->Session->delete('toUser');}
}











/**
* It is used to send reply of contact enquiry
*
* @access public
* @param integer $userContactId user contact id
* @return void
*/
public function sendReply($userContactId=null, $confirm=null) {

$confirmRender=false;

$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;

$contactDetail = $this->UserContact->read(null, $userContactId);

$name='';

$email='';

	if(!empty($contactDetail)) {
		$name = $contactDetail['UserContact']['name'];
		$email = $contactDetail['UserContact']['email'];
 		if ($this->request->isPost()) {
			$this->UserEmail->set($this->request->data);
			$sendValidate = $this->UserEmail->sendValidate();
				if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
					if ($sendValidate) {
						$response = array('error' => 0, 'message' => 'success');
						return json_encode($response);
						} else {
							$response = array('error' => 1,'message' => 'failure');
							$response['data']['UserEmail']  = $this->UserEmail->validationErrors;
							return json_encode($response);
							}
						} else {
						if ($sendValidate) {
							if(is_null($confirm)) {
								$this->Session->write('send_reply_email_data', $this->request->data);
								$this->set('data', $this->request->data);
								$template=$this->UserEmailTemplate->getTemplateById($this->request->data['UserEmail']['template']);
								$signature=$this->UserEmailSignature->getSignatureById($this->request->data['UserEmail']['signature']);
								$this->set(compact('template', 'signature'));
								$confirmRender=true;
									} else if($confirm=='confirm') {
									$data = $this->Session->read('send_reply_email_data');
 									$fromConfig = $data['UserEmail']['from_email'];
									$fromNameConfig = $data['UserEmail']['from_username'];
									$emailObj = new CakeEmail('default');
									$emailObj->from(array($fromConfig => $fromNameConfig));
									$emailObj->sender(array($fromConfig => $fromNameConfig));
									$emailObj->subject($data['UserEmail']['subject']);
									$body = '';
										if(!empty($template['UserEmailTemplate']['header'])) {
										$body .= nl2br($template['UserEmailTemplate']['header'])."<br/><br/>";
										}
									$body .= $data['UserEmail']['message'];
										if(!empty($signature['UserEmailSignature']['signature'])) {
										$body .= "<br/>".$signature['UserEmailSignature']['signature'];
										}
										if(!empty($template['UserEmailTemplate']['footer'])) {
										$body .= "<br/>".nl2br($template['UserEmailTemplate']['footer']);
										}
									$data['UserEmail']['message'] = $body;
									$emailObj->emailFormat('both');
									$sent=false;
									$emailObj->to($data['UserEmail']['to']);
											if(!empty($data['UserEmail']['cc_to'])) {
											$emailObj->cc($data['UserEmail']['cc_to']);
											}
												try{
													$result = $emailObj->send($body);
													if($result) {
													$sent=true;
													}
												} catch (Exception $ex){
 											}
if($sent) {
$msg = $contactDetail['UserContact']['reply_message'];
if(empty($msg)) {
$contactDetail['UserContact']['reply_message'] = 'Reply On '.date('d M Y', time()).' at '.date('h:i A', time()).'<br/>'.$data['UserEmail']['message'];
} else {
$contactDetail['UserContact']['reply_message'] = 'Reply On '.date('d M Y', time()).' at '.date('h:i A', time()).'<br/>'.$data['UserEmail']['message'].'<br/><br/>'.$msg;
}
$this->UserContact->save($contactDetail, false);
$this->Session->setFlash('Contact Reply has been sent successfully');
$this->redirect(array('controller'=>'UserContacts', 'action'=>'index', 'page'=>$page));
} else {
$this->Session->setFlash('We could not send Reply Email', 'default', array('class' => 'warning'));
$this->redirect(array('action'=>'sendReply', $userContactId));
}
}
}
}
} else {
$this->request->data['UserEmail']['from_name'] = EMAIL_FROM_NAME;
$this->request->data['UserEmail']['from_email'] = EMAIL_FROM_ADDRESS;

if(!empty($contactDetail)) {
$this->request->data['UserEmail']['to'] = $contactDetail['UserContact']['email'];
$this->request->data['UserEmail']['subject'] = 'Re: '.SITE_NAME;
$this->request->data['UserEmail']['message'] ='<br/><p>-------------------------------------------<br/>
On '.date('d M Y', strtotime($contactDetail['UserContact']['created'])).' at '.date('h:i A', strtotime($contactDetail['UserContact']['created'])).'<br/>'.h($contactDetail['UserContact']['name']).' wrote:</p>'.$contactDetail['UserContact']['requirement'];
}
if($this->Session->check('send_reply_email_data')) {
$this->request->data = $this->Session->read('send_reply_email_data');
$this->Session->delete('send_reply_email_data');
}
}
} else {
$this->Session->setFlash(__('Invalid Id'), 'default', array('class' => 'error'));
$this->redirect(array('controller'=>'UserContacts', 'action'=>'index', 'page'=>$page));
}
$templates = $this->UserEmailTemplate->getTemplates();
$signatures = $this->UserEmailSignature->getSignatures();
$this->set(compact('userContactId', 'name', 'email', 'templates', 'signatures'));
if($confirmRender) {
$this->render('send_reply_confirm');
}
}


}