<?php //barterlabs: things for things

App::uses('AppController', 'Controller'); 
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
App::uses('CakeEmail', 'Network/Email');
class LabsController extends AppController {
 
   var $name = 'Labs';

	//	 * This controller uses following models

	public $uses = array('Lab', 'Town', 'State', 'Usermgmt.User', 'Usermgmt.UserGroup', 'Usermgmt.UserSetting', 'Usermgmt.TmpEmail', 'Usermgmt.UserDetail', 'Usermgmt.UserEmail', 'Usermgmt.UserActivity', 'Usermgmt.LoginToken', 'Usermgmt.UserGroupPermission', 'Usermgmt.UserContact','Usermgmt.UserDetail', 'Pic', 'Vote', 'Type');

	//	 * This controller uses following components
	public $components = array('Search.Prg','RequestHandler', 'Usermgmt.UserConnect', 'Cookie', 'Usermgmt.Search', 'Usermgmt.ControllerList','Session');

	//	 * This controller uses following helpers
	public $helpers = array('Js', 'Usermgmt.Tinymce', 'Usermgmt.Ckeditor');
	public $presetVars = true;
	public $paginate=array();


/**
 * beforeFilter method
 *
 *
 * runs before every function
 * 
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->User->userAuth=$this->UserAuth;
		if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->action=='login' || $this->action==' addMultipleUsers')){
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
 * index method
 *
 *
 * 
 * 
 */	
		public function index() {

		$userId = $this->UserAuth->getUserId();	
		
		$this->Prg->commonProcess();
     	$this->paginate = array(
        'conditions' => $this->Lab->parseCriteria($this->Prg->parsedParams()),
		'order'=>array('Lab.hot'=>'DESC')
		);
		$this->set('results', $this->paginate());	

		//pulls 40 labs from the db even though only 4 are displayed, to give ample error for 
		//labs w/o pictures attached
		$frontHots = $this->Lab->find('all', array(
				'conditions' => array('Lab.catalyst' => 1),
				'limit'=>40,
				'order'=>array('Lab.hot'=>'DESC')
				));	
		$this->set('frontHots', $frontHots);

		//pulls 20 labs from the db even though only 2 are displayed, to give ample error for 
		//labs w/o pictures attached
		$frontLabs = $this->Lab->find('all', array(	
				'conditions' => array('Lab.catalyst' => 1),
				'limit'=>20,
				'order'=>'rand()'
					)
				);
		$this->set('frontLabs', $frontLabs);
		//pulls 20 labs from the db even though only 2 are displayed, to give ample error for 
		//labs w/o pictures attached
		$tradedLabs = $this->Lab->find('all', array(	
				'conditions' => array('Lab.catalyst' => 2),
				'limit'=>20,
				'order'=>'rand()'
					)
				);
		$this->set('tradedLabs', $tradedLabs);
	}

/**
 * find method
 *
 *
 *
 * 
 */
public function find() {
		$userId = $this->UserAuth->getUserId();
		$type = $this->Lab->Type->find('list', 
			array('order'=>array('Type.name', 'Type.name ASC')
				)
			);
		$this->set(compact('type', 'catalyst'));
		$this->Prg->commonProcess();
     	$this->paginate = array(
        'conditions' => $this->Lab->parseCriteria($this->Prg->parsedParams()),
		'order'=>array('Lab.hot'=>'DESC')
		);
		$this->set('results', $this->paginate());
			if(!empty($results)){
					$dispics = array();
					foreach($results as $labres): {
						$dispics[] = $this->Pic->find('first', array(
							'conditions'=>array(
								'Pic.lab_id'=>$labres['Lab']['id'],
								'Pic.isdisp'=>1),
							'recursive'=>0)
						);	
					} endforeach; 
					//$labSearches = array_merge($results, $dispics);
					$this->set('dispics', $dispics);}
    }


/**
 * view method
 *
 *
 * 
 * 
 */

	public function view($id = null) {
		$this->layout = 'default';
			if (!$this->Lab->exists($id)) {
				throw new NotFoundException(__('Invalid Barter'));}
		$state_id = $this->Lab->getStateId($id);
		$town_id = $this->Lab->getTownId($id);
		$state_name = $this->State->getStateName($state_id);
		$town_name = $this->Town->getTownName($town_id);
		$this->set(compact('state_name','town_name'));
		$userId = $this->UserAuth->getUserId();
		$viewedUserId = $this->Lab->getViewedUserId($id);
		$viewedUserLabs = $this->Lab->getViewedUserLabs($viewedUserId);
		$labPics = $this->Pic->getLabPics($id);
		$lab = $this->Lab->getLab($id); 
		$user = $this->User->getUserById($viewedUserId);
		$this->set(compact('userId', 'viewedUserId', 'labPics', 'lab', 'user', 'townName', 'stateName'));

		/*////////////////////votes results for USER////////////////*/
		/* this finds all of selected user's upvotes & downvotes */
		$userLabIds = $this->Lab->getViewedUserLabIds2($viewedUserId);
		$allupvotes = $this->Vote->countUserUpvotes($userLabIds);
		$alldownvotes = $this->Vote->countUserDownvotes($userLabIds);
		$allvotes = $allupvotes-$alldownvotes;		
		$this->set(compact('allupvotes', 'alldownvotes', 'allvotes'));

		/*////////////////////votes results for LAB////////////////*/		
		/* this finds all of selected lab's upvotes & downvotes */
		$allLabUpvotes = $this->Vote->countLabUpvotes($id);
		$allLabDownvotes = $this->Vote->countLabDownvotes($id);
		$allLabVotes = $this->Vote->countLabVotes($id);
		$hot = $this->Lab->hot($allLabVotes, $id); //calculates hot score
		$this->Lab->updateHot($hot, $id); //updates hot score
		$this->set(compact('allLabUpvotes', 'allLabDownvotes', 'allLabVotes'));
		//******************Lab Pics Loop**********************		
		//This code loads a list of all the viewed User's Labs, then 
		//finds the corresponding display photo for each lab. Then 
		//the data is sent to the view.
		//loads all of the selected user's lab IDs
		$dispic = $this->Pic->find('first', array(
			'conditions'=>array(
				'Pic.lab_id'=>$id,
				'Pic.isdisp'=>1),
			'recursive'=>0
			)
		);
					$this->set('dispic', $dispic);
			if ($this->request->is(array('post', 'put'))) {
				$this->Session->write('lab', $lab);
				$this->redirect(array('controller' => 'UserEmails', 'action' => 
	'send', $user['User']['id'], 'plugin'=>'usermgmt')); 
				}

}


/**
 * passToEmail method
 *
 * this method passes session data to the Email Controller when
 * a user clicks the "Contact" button
 * 
 */
	public function passToEmail($id){
		$this->autoRender = false;
		$lab = $this->Lab->getLab($id); 
		$this->Session->write('globalLabEmail', $lab['Lab']['email']);
		$this->Session->write('globalLabId', $lab['Lab']['id']);
		$this->Session->write('globalLabProjectname', $lab['Lab']['projectname']);
		
		$this->redirect(array('controller' => 'UserEmails', 'action' => 
					'send', $lab['Lab']['user_id'], 'plugin'=>'usermgmt'));	

}

/**
 * upVote method
 *
 *
 * 
 * 
 */
    public function upVote($id) {
		$userId = $this->UserAuth->getUserId();
		$viewedUserId = $this->Lab->getViewedUserId($id);
		$hasvoted = $this->Vote->hasVoted($userId, $id, $viewedUserId);
							if ($hasvoted == true) {
								$wasup = $this->Vote->wasup($userId, $id);
								if($wasup==true){
									$this->Session->setFlash(__('You only get one upvote!'), 
									'default', array('class' => 'error'));
									return $this->redirect($this->referer());}
											  $this->Vote->upVote($userId, $id, $hasvoted);
											  $hot = $this->Lab->hot($allLabVotes, $id); //calculates hot score
											  $this->Lab->updateHot($hot, $id); //updates hot score
											  $this->Session->setFlash(__('Upvoted!!'));
											  return $this->redirect($this->referer());
								}
							$this->Vote->upVote($userId, $id, $hasvoted);
							$allLabVotes = $this->Vote->countLabVotes($id);
							$hot = $this->Lab->hot($allLabVotes, $id);
							$this->Lab->updateHot($hot, $id);
							$this->Session->setFlash(__('Upvoted!!'));
							return $this->redirect($this->referer());
	}

/**
 * downVote method
 *
 *
 * 
 * 
 */
    public function downVote($id) {$userId = $this->UserAuth->getUserId();
		$viewedUserId = $this->Lab->getViewedUserId($id);
		$hasvoted = $this->Vote->hasVoted($userId, $id, $viewedUserId);
						if ($hasvoted == true) {
							$wasdown = $this->Vote->wasdown($userId, $id);
							if($wasdown==true){
								$this->Session->setFlash(__('You only get one downvote!'), 
								'default', array('class' => 'error'));
								return $this->redirect($this->referer());}
										  $this->Vote->downVote($userId, $id, $hasvoted);
										  $hot = $this->Lab->hot($allLabVotes, $id); //calculates hot score
							   		      $this->Lab->updateHot($hot, $id); //updates hot score
										  $this->Session->setFlash(__('Downvoted!!'));
										  return $this->redirect($this->referer());
							}
						$this->Vote->downVote($userId, $id, $hasvoted);
						$hot = $this->Lab->hot($allLabVotes, $id); //calculates hot score
						$this->Lab->updateHot($hot, $id); //updates hot score
						$this->Session->setFlash(__('Downvoted!!'));
						return $this->redirect($this->referer());
	}

/**
* Creates Lab id
*
* If anonymous:
*     	-creates unique user ID
*		-sets $anon to 1 (indicating the post is anonymous) 
*		-gets contact email address
*
* If user is logged:
*		-sets user_id
*		-sets email
*/


	public function createLab($id=null) {
	    	if($this->UserAuth->isLogged()) {
	    		$userId = $this->UserAuth->getUserId();
	    		$anon=0;
	    		$this->set('anon',$anon);
	    		$userId = $this->UserAuth->getUserId();
	    		$user = $this->User->getUserById($userId);
	    		$email = $this->User->getEmailById($userId);
	    		$this->request->data['Lab']['user_id']=$userId;
	    		$this->request->data['Lab']['email']=$email;
	    		$this->Lab->save($this->request->data);
	    		return $this->redirect(array(
	    									'controller'=>'Labs', 
	    									'action'=>'createLabState', $this->Lab->id, 
	    									'plugin'=>''));
	    	} else {
	 			$anon=1;
	 			$this->set('anon',$anon);
    				if ($this->request->is('post')) {
    					$this->Lab->create();
    					$GUID = $this->User->getGUID();
						$this->request->data['Lab']['anon_id']=$GUID;
 						$this->request->data['Lab']['anon']=1;
							if ($this->Lab->save($this->request->data)) {
								return $this->redirect(array(
															'controller'=>'Labs', 
															'action'=>'createLabState', $this->Lab->id, 
															'plugin'=>''));}
						}
	    	} //end ANON else/if
}

	public function createLabState($id) {
		$state = $this->State->find('list');
		$this->set('state', $state);

		if(!empty($id)){
			$this->Lab->id = $id;
				if ($this->request->is('post')) {
					if ($this->Lab->save($this->request->data)) {
						return $this->redirect(array(
															'controller'=>'Labs', 
															'action'=>'createLabTown', $this->Lab->id, 
															'plugin'=>''));
					}//end SAVE
				}//end POST
		} else {
				return $this->redirect(array(
										'controller'=>'Labs', 
										'action'=>'index',  
										'plugin'=>''));}
	} //end createLabState

	public function createLabTown($id){
		$this->Lab->id=$id;
		$state_id = $this->Lab->find('first', array(
											'conditions' =>array('Lab.id'=>$id), 
											'fields'=> array('Lab.state_id')
											)
										);
		
		$town = $this->Town->find('list', 
									array(
										'conditions' =>array(
											'Town.state_id'=>$state_id['Lab']['state_id']), 
										'order'=>array('Town.name', 'Town.name ASC'),
										'fields'=> array('Town.name')
										)
									);
		
		 $this->set('town', $town);
				if ($this->request->is('post')) {
							if ($this->Lab->save($this->request->data)) {
								return $this->redirect(array(
															'controller'=>'Labs', 
															'action'=>'createLabItemservice', $this->Lab->id, 
															'plugin'=>''));}//end SAVE
						}//end POST
	} //end createLabTown

	public function createLabItemservice($id){
		$this->Lab->id=$id;
		if ($this->request->is('post')) {
			if (!empty($this->request->data['Lab']['kind'])){
				if($this->request->data['Lab']['kind']==1){
					$this->request->data['Lab']['itemservice']=0;
					if ($this->Lab->save($this->request->data)) {
						return $this->redirect(array(
													'controller'=>'Labs', 
													'action'=>'createLabType', $this->Lab->id, 
													'plugin'=>''));}//end SAVE
				}
				if($this->request->data['Lab']['kind']==2){
					$this->request->data['Lab']['itemservice']=1;
					if ($this->Lab->save($this->request->data)) {
						return $this->redirect(array(
													'controller'=>'Labs', 
													'action'=>'createLabType', $this->Lab->id, 
													'plugin'=>''));}//end SAVE
				}
			} else {return $this->redirect(array(
													'controller'=>'Labs', 
													'action'=>'createLabItemservice', $this->Lab->id, 
													'plugin'=>''));}//end ELSE
		}//end if POST
	}

/**
 * createLabType method
 *
 *
 * 
 * 
 */
    public function createLabType($id) {
    	$this->Lab->id=$id;

    	$itemservice = $this->Lab->find('first', array(
											'conditions' =>array('Lab.id'=>$id), 
											'fields'=> array('Lab.itemservice')
											)
										);
   
    	$type = $this->Type->find('list', 
						array(
							'conditions' =>array(
								'Type.itemservice'=>$itemservice['Lab']['itemservice']), 
							'order'=>array('Type.name', 'Type.name ASC'),
							'fields'=> array('Type.name')
							)
						);
    	$this->set('type', $type);

    	if ($this->request->is('post')) {
    	 	if(!empty($this->request->data['Lab']['type_id'])){
	    	 	if ($this->Lab->save($this->request->data)) {
							return $this->redirect(array(
														'controller'=>'Labs', 
														'action'=>'createLabAdd', $this->Lab->id, 
														'plugin'=>''));}//end SAVE
    	 	} else {return $this->redirect(array(
														'controller'=>'Labs', 
														'action'=>'createLabType', $this->Lab->id, 
														'plugin'=>''));}//end SAVE

		}//end if POST
}

/**
 * createLabAdd method
 *
 *
 * 
 * 
 */
    public function createLabAdd($id) {
    	$this->Lab->id=$id;    	
    	if ($this->request->is('post')) {
    		$this->request->data['Lab']['catalyst'] = 1;
    			if ($this->Lab->save($this->request->data)) {
							return $this->redirect(array(
														'controller'=>'Labs', 
														'action'=>'addPic', $this->Lab->id, 
														'plugin'=>''));}//end SAVE
    	 	else {return $this->redirect(array(
														'controller'=>'Labs', 
														'action'=>'createLabAdd', $this->Lab->id, 
														'plugin'=>''));}//end SAVE
    	} //end POST
    }

/**
 * allLabs method
 *
 *
 * 
 * 
 */
	public function allLabs() {	

		$this->layout = 'default';
		$userId = $this->UserAuth->getUserId();
		$this->set('userId', $userId);	
		$allLabs = $this->Lab->find('all', array('conditions'=>array('Lab.user_id'=>$userId),'recursive'=>0));
		$this->set('allLabs', $allLabs);
		if($this->RequestHandler->isAjax()) {
		}
	}

/**
 * editLab method
 *
 * This function is depricated 
 * Last version: v.0.1.2b
 * 
 */
	public function _editLab($id = null) {
		$this->layout = 'default';
		$userId = $this->UserAuth->getUserId();
		$this->set('userId', $userId);		
		//this finds the Lab_id and User_id of the selected Pic for two purposes:
		//***1) to reroute to the proper lab after edit
		//***2) to validate that the Lab belongs to the user attempting to edit it
		$res = $this->Lab->find('first', array('conditions'=>array('Lab.id'=>$id), 'fields'=>array('Lab.id','Lab.user_id'),'recursive'=>0));
		if ($res['Lab']['user_id']==$userId){
			if (!$this->Lab->exists($id)) {
				throw new NotFoundException(__('Invalid barter'));
			}
				if ($this->request->is(array('post', 'put'))) {
					$this->Lab->id = $id;
					if ($this->Lab->save($this->request->data)) {
						$this->Session->setFlash(__('The barter has been saved.'));
						$this->redirect(array('action' => 'view', $res['Lab']['id']));
					} else {
						$this->Session->setFlash(__('The lab could not be saved. Please, try again.'));
					}
				} else {
					$viewLab = array('conditions' => array('Lab.' . $this->Lab->primaryKey => $id));
					$this->request->data = $this->Pic->find('first', $viewLab);
				}
			$viewLab = $this->Lab->find('first', array(
				'conditions' => 
					array('Lab.id' => $id)
					)
				);
			$this->set('viewLab', $viewLab);
			}
	//else throws an error if a user attempts to edit a barter that isn't theirs
	else {$this->Session->setFlash(__('You can only edit barters that belong to you.'));}
}

 /**
 * deactivateLab method
 *
 *
 * 
 * 
 */
	public function deactivateLab($id = null) {
		if (!$id) {
	            throw new NotFoundException(__('Invalid Lab'));
	        }
		$userId = $this->UserAuth->getUserId();
		$this->Lab->id = $id;
		$res = $this->Lab->find('first', array('conditions'=>array('Lab.id'=>$id), 'fields'=>array('Lab.catalyst','Lab.user_id'),'recursive'=>0));

		if ($res['Lab']['user_id']==$userId){
			if (!$this->Lab->exists()) {
				throw new NotFoundException(__('Invalid lab'));}
			$this->Lab->id = $id;	
			$this->request->data['Lab']['catalyst']=NULL;
			$this->Lab->save($this->request->data);
			$this->Session->setFlash(__('This barter has been deactivated'));
			return $this->redirect($this->referer());
		}
	    else {$this->Session->setFlash(__('You can only deactivate barters that belong to you.'));}
	}

 /**
 * activateLab method
 *
 *
 * 
 * 
 */
	public function activateLab($id = null) {

		if (!$id) {
	            throw new NotFoundException(__('Invalid Lab'));
	        }
		$userId = $this->UserAuth->getUserId();
		$this->Lab->id = $id;
		$res = $this->Lab->find('first', array('conditions'=>array('Lab.id'=>$id), 'fields'=>array('Lab.catalyst','Lab.user_id'),'recursive'=>0));
		if ($res['Lab']['user_id']==$userId){
			if (!$this->Lab->exists()) {
				throw new NotFoundException(__('Invalid lab'));}
			$this->Lab->id = $id;	
			$this->request->data['Lab']['catalyst']=1;
			$this->Lab->save($this->request->data);
			$this->Session->setFlash(__('This barter has been activated'));
			return $this->redirect($this->referer());
		}
	    else {$this->Session->setFlash(__('You can only activate barters that belong to you.'), 'default', array('class' => 'warning'));}
	}

 /**
 * setTradedLab method
 *
 *
 * 
 * 
 */
	public function setTradedLab($id = null) {
		if (!$id) {
	            throw new NotFoundException(__('Invalid Lab'));
	        }
		$userId = $this->UserAuth->getUserId();
		$this->Lab->id = $id;
		$res = $this->Lab->find('first', array('conditions'=>array('Lab.id'=>$id), 'fields'=>array('Lab.catalyst','Lab.user_id'),'recursive'=>0));
		if ($res['Lab']['user_id']==$userId){
			if (!$this->Lab->exists()) {
				throw new NotFoundException(__('Invalid lab'));}
			$this->Lab->id = $id;	
			$this->request->data['Lab']['catalyst']=2;
			$this->Lab->save($this->request->data);
			$this->Session->setFlash(__('This barter has been set to TRADED status'), 'default', array('class' => 'success'));
			return $this->redirect($this->referer());
		}
	    else {$this->Session->setFlash(__('You can only activate barters that belong to you.'), 'default', array('class' => 'warning'));}
	}

 /**
 * expireLab method
 *
 *
 * 
 * 
 */
	public function expireLab($id = null) {
		if (!$id) {
	            throw new NotFoundException(__('Invalid Lab'));
	        }
		$userId = $this->UserAuth->getUserId();
		$this->Lab->id = $id;
		$res = $this->Lab->find('first', array('conditions'=>array('Lab.id'=>$id), 'fields'=>array('Lab.catalyst','Lab.user_id'),'recursive'=>0));
		if ($res['Lab']['user_id']==$userId){
			if (!$this->Lab->exists()) {
				throw new NotFoundException(__('Invalid lab'));}
			$this->Lab->id = $id;	
			$this->request->data['Lab']['catalyst']=3;
			$this->Lab->save($this->request->data);

			return $this->redirect($this->referer());
		}
	    else {$this->Session->setFlash(__('You can only activate barters that belong to you.'), 'default', array('class' => 'warning'));}
	}

/**
 * deleteLab method
 *
 *
 * 
 * 
 */
	public function deleteLab($id = null) {
		$userId = $this->UserAuth->getUserId();
		$this->Lab->id = $id;
		//this finds the Lab_id and User_id of the selected Pic for two purposes:
		//***1) to reroute to the proper lab after delete
		//***2) to validate that the Picture belongs to the user attempting to delete it
		$res = $this->Lab->find('first', array('conditions'=>array('Lab.id'=>$id), 'fields'=>array('Lab.id','Lab.user_id'),'recursive'=>0));
		if ($res['Lab']['user_id']==$userId){
			if (!$this->Lab->exists()) {
				throw new NotFoundException(__('Invalid lab'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Lab->delete()) {
				$this->Session->setFlash(__('This barter has been deleted.'));
			} else {
				$this->Session->setFlash(__('This barter could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('controller'=>'Users','action'=>'myprofile', 'plugin'=>'usermgmt'));
		}
	    else {$this->Session->setFlash(__('You can only delete barters that belong to you.'));}
	}

/**
 * viewPic method
 *
 *
 * 
 * 
 */
public function viewPic($id) {
		$this->layout = 'default';
		$userId = $this->UserAuth->getUserId();
		$this->set('userId', $userId);
		$viewPic = $this->Pic->find('first', array(
			'conditions' => 
				array('Pic.id' => $id)
				)
			);
		$this->set('viewPic', $viewPic);
}

/**
 * deletePic method
 *
 *
 * 
 * 
 */
	public function deletePic($id = null) {
		$userId = $this->UserAuth->getUserId();
		$this->Pic->id = $id;
		//this finds the Lab_id and User_id of the selected Pic for two purposes:
		//***1) to reroute to the proper lab after delete
		//***2) to validate that the Picture belongs to the user attempting to delete it
		$res = $this->Pic->find('first', array('conditions'=>array('Pic.id'=>$id), 'fields'=>array('Pic.lab_id','Pic.user_id'),'recursive'=>0));
		if ($res['Pic']['user_id']==$userId){
			if (!$this->Pic->exists()) {
				throw new NotFoundException(__('Invalid picture'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Pic->delete()) {
				$this->Session->setFlash(__('The picture has been deleted.'));
			} else {
				$this->Session->setFlash(__('The picture could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'view', $res['Pic']['lab_id']));
		}
	    else {$this->Session->setFlash(__('You can only delete pictures that belong to you.'));}
	}

/**
 * addPic method
 *
 *
 * 
 * 
 */
	public function addPic($id) {
		$this->Lab->id = $id;
		$labId = $id;
		$this->set('labId', $labId);
		$userId = $this->UserAuth->getUserId();
		if ($this->request->is('post')) {
						//Verifies a file was uploaded and that 
						//the form contains a filename
			if(is_uploaded_file($this->request->data['Pic']['name']['tmp_name']) && !empty($this->request->data['Pic']['name']['tmp_name'])) 
						{
					$path_info = pathinfo($this->request->data['Pic']['name']['name']);
							chmod ($this->request->data['Pic']['name']['tmp_name'], 0644);
							$photo=time().mt_rand().".".$path_info['extension'];
							$fullpath= WWW_ROOT."img".DS."pics";

							//create directory if none exists
							if(!is_dir($fullpath)) {
								mkdir($fullpath, 0777, true);
							}
						ImageTool::resize(array(
							    'input' => $this->request->data['Pic']['name']['tmp_name'],
							    'output' => $fullpath.DS.$photo,
							    'width' => 500,
							    'height' => 500,
							    'paddings' => true
							));
							//inserts hashed filename into table row
							$this->request->data['Pic']['name']=$photo;
							//inserts the current labId
							$this->request->data['Pic']['lab_id']=$id;
							$this->request->data['Pic']['user_id']=$userId;
							$isDisPic = $this->Pic->isDisPic($id);
							
							//if the Display Photo checkbox is checked
							if (!empty($this->request->data['Pic']['display'])){
								$this->request->data['Pic']['isdisp']=1;}
								else {
									if(empty($isDisPic)){
										$this->request->data['Pic']['isdisp']=1;
										} 
									}			
								//double-checks that files & names exist
								if(!empty($Pic['Pic']['name']) && file_exists($fullpath.DS.$Pic['Pic']['pic'])) {
									unlink($fullpath.DS.$Pic['Pic']['name']);}
							} else {
								unset($this->request->data['Pic']['name']);
							}
			if ($this->Pic->save($this->request->data)) {
				$this->Session->setFlash(__('Saved!'));
				unset($this->request->data['Picture']['name']);
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The Picture could not be saved. Please, try again.'), 'default', array('class' => 'error'));
				unset($this->request->data['Picture']['name']);
			}
		}		
	}

/**
 * editPic method
 *
 *
 * 
 * 
 */

	public function editPic($id = null) {
		$this->layout = 'default';
		$userId = $this->UserAuth->getUserId();
		$this->set('userId', $userId);		
		//this finds the Lab_id and User_id of the selected Pic for two purposes:
		//***1) to reroute to the proper lab after edit
		//***2) to validate that the Picture belongs to the user attempting to edit it
		$res = $this->Pic->find('first', array('conditions'=>array('Pic.id'=>$id), 'fields'=>array('Pic.lab_id','Pic.user_id'),'recursive'=>0));
		if ($res['Pic']['user_id']==$userId){
			if (!$this->Pic->exists($id)) {
				throw new NotFoundException(__('Invalid picture'));
			}
				if ($this->request->is(array('post', 'put'))) {
					$this->Pic->id = $id;
								//if the Display Photo checkbox is checked
							if (!empty($this->request->data['Pic']['display'])){
								//this function finds the old Display Picture
								//and inserts a value of NULL
								//$this->Pic->nullOldDisPic($id);
								$this->request->data['Pic']['isdisp']=1;}
					if ($this->Pic->save($this->request->data)) {
						$this->Session->setFlash(__('Saved!'));
						$this->redirect(array('action' => 'view', $res['Pic']['lab_id']));
					} else {
						$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
					}
				} else {
					$viewPic = array('conditions' => array('Pic.' . $this->Pic->primaryKey => $id));

					$this->request->data = $this->Pic->find('first', $viewPic);

				}
			$viewPic = $this->Pic->find('first', array(
				'conditions' => 
					array('Pic.id' => $id)
					)
				);
			$this->set('viewPic', $viewPic);
			}
	//else throws an error if a user attempts to edit a pic that isn't theirs
	else {$this->Session->setFlash(__('You can only edit pictures that belong to you.'));}
	}

	public function randomAdminAccess() {
		//This is just a general container class that only has
		//Admin permissions.
		//
		//I created it to hide the Admin menu headers on the User Dashboard,
		//but I suppose it could be used for other purposes. 	
		//    /Usermgmt/View/Users/dashboard.ctp
		//
		//You can change the permissions at:
		// http://.../usermgmt/UserGroupPermissions
	}


}?>