<?php


App::uses('UserMgmtAppController', 'Usermgmt.Controller');



class UsersController extends UserMgmtAppController {



	/**
	 * This controller uses following models
	 *
	 * @var array
	 */



	public $uses = array('Usermgmt.User', 'Usermgmt.UserGroup', 'Usermgmt.UserSetting', 'Usermgmt.TmpEmail', 'Usermgmt.UserDetail', 'Usermgmt.UserActivity', 'Usermgmt.LoginToken', 'Usermgmt.UserGroupPermission', 'Usermgmt.UserContact', 'Tradeicon', 'Usermgmt.UserEmail', 'Lab', 'Vote', 'Town', 'Pic');



	/**
	 * This controller uses following components
	 *
	 * @var array
	 */



	public $components = array('RequestHandler', 'Usermgmt.UserConnect', 'Cookie', 'Usermgmt.Search', 'Usermgmt.ControllerList');



	/**
	 * This controller uses following default pagination values
	 *
	 * @var array
	 */



	public $paginate = array(



		'limit' => 25



	);



	/**
	 * This controller uses following helpers
	 *
	 * @var array
	 */



	public $helpers = array('Js', 'Usermgmt.Tinymce', 'Usermgmt.Ckeditor');



	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */



	var $searchFields = array



		(



			'index' => array(



				'User' => array(



					'User'=> array(



						'type' => 'text',



						'label' => 'Search',



						'tagline' => 'Search by name, username, email',



						'condition' => 'multiple',



						'searchFields'=>array('User.username', 'User.email'),



						'searchFunc'=>array('plugin'=>'usermgmt', 'controller'=>'Users', 'function'=>'indexSearch'),



						'inputOptions'=>array('style'=>'width:200px;')



					),



					'User.id'=> array(



						'type' => 'text',



						'condition' => '=',



						'label' => 'User Id',



						'inputOptions'=>array('style'=>'width:50px;')



					),



					'User.user_group_id' => array(



						'type' => 'select',



						'condition' => 'comma',



						'label' => 'Group',



						'model' => 'UserGroup',



						'selector' => 'getGroups'



					),



					'User.email_verified' => array(



						'type' => 'select',



						'label' => 'Email Verified',



						'options' => array(''=>'Select', '0'=>'No', '1'=>'Yes')



					),



					'User.active' => array(



						'type' => 'select',



						'label' => 'Status',



						'options' => array(''=>'Select', '1'=>'Active', '0'=>'Inactive')



					),



					'User.created1'=> array(



						'type' => 'text',



						'condition' => '>=',



						'label' => 'From',



						'inputOptions'=>array('style'=>'width:100px;', 'class'=>'datepicker')



					),



					'User.created2'=> array(



						'type' => 'text',



						'condition' => '<=',



						'label' => 'To',



						'inputOptions'=>array('style'=>'width:100px;', 'class'=>'datepicker')



					),



				)



			),



			'online' => array(



				'UserActivity' => array(



					'UserActivity'=> array(



						'type' => 'text',



						'label' => 'Search',



						'tagline' => 'Search by name, email, ip address',



						'condition' => 'multiple',



						'searchFields'=>array('User.email', 'UserActivity.ip_address'),



						'inputOptions'=>array('style'=>'width:200px;')



					),



					'UserActivity.status' => array(



						'type' => 'select',



						'label' => 'Status',



						'options' => array(''=>'Select', '0'=>'Guest', '1'=>'Online')



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



		$this->User->userAuth=$this->UserAuth;



		if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->action=='login' || $this->action=='addMultipleUsers')){



			$this->Security->csrfCheck = false;



			$this->Security->validatePost = false;



		}



	    



	    					/**** NEW USER EMAIL CHECK ****/



	    $userId = $this->UserAuth->getUserId();



		$checkEmail = $this->UserEmail->checkEmail($userId);
		$this->set('checkEmail', $checkEmail);
							/**** END USER EMAIL CHECK ****/
	}




	/**
	 * It displays all users details
	 *
	 * @access public
	 * @return array
	 */

	public function index() {

		$this->paginate = array('limit' => 10, 'order'=>'User.id desc');
		$users = $this->paginate('User');
		$i=0;
		foreach($users as $user) {
			$users[$i]['UserGroup']['name']=$this->UserGroup->getGroupsByIds($user['User']['user_group_id']);
			$i++;
		}
		$this->set('users', $users);
		if($this->RequestHandler->isAjax()) {



			$this->layout = 'ajax';



			$this->render('/Elements/all_users');



		}



	}



	/**

	 * It displays search suggestions on all users index page

	 *

	 * @access public

	 * @return json

	 */



	public function indexSearch() {



		$resultToPrint=array();



		if($this->RequestHandler->isAjax()) {



			$results = array();



			if(isset($_GET['term'])) {



				$query = $_GET['term'];



				$results = $this->User->find('all', array('conditions'=>array('OR'=>array(array('User.username LIKE'=>$query.'%'), array('User.username LIKE'=>$query.'%'), array('User.email LIKE'=>'%'.$query.'%@%'))), 'fields'=>array('User.username', 'User.email')));



			}



			$usernames=array();



			$names=array();



			$emails=array();



			foreach($results as $res) {



				if(stripos($res['User']['email'], $query) !==false) {



					$emails[] =$res['User']['email'];



				}



				if(stripos($res['User']['username'], $query) !==false) {



					$usernames[] =$res['User']['username'];



				}



			}



			$names = array_unique($names);



			$emails = array_unique($emails);



			$usernames = array_unique($usernames);



			$res = array_merge($usernames, $names, $emails);



			foreach($res as $row) {



				$resultToPrint[] = array('name'=>$row);



			}



		}



		echo json_encode($resultToPrint);



		exit;



	}



	/**

	 * It displays all online users with in specified time

	 *

	 * @access public

	 * @return array

	 */



	public function online() {

		$this->paginate = array('limit' => 1000, 'order'=>'UserActivity.modified desc', 'conditions'=>array('UserActivity.modified >'=>(date('Y-m-d G:i:s', strtotime('-5000 minutes', time()))), 'UserActivity.logout'=>0), 'fields'=>array('UserActivity.*', 'User.username', 'User.email'), 'contain'=>array('User'));
		$users = $this->paginate('UserActivity');
		$this->set('users', $users);

		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/online_users');
		}
	}



	



	



	



	



	



	



	/**
	 * It displays single user's full details by user id
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return array
	 */



	public function viewUser($id=null) {

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid User'));
		}

	//these delete session data from the UsersEmail class

		$this->layout = 'default';

		$userId = $this->UserAuth->getUserId();

		$user = $this->User->getUserById($userId);

		$viewedUser = $this->User->getUserById($id); 

		$this->set(compact('viewedUser', 'userId'));

		$this->set('user', $this->User->getUserById($id));

		$email = $this->User->getEmailById($id);
		$this->Session->write('globalLabEmail', $email);
		$this->Session->delete('globalLabId');
		$this->Session->delete('globalLabProjectname');


		//************************VOTES**************************//	
		/* this finds all of selected user's upvotes & downvotes */

		$userLabIds = $this->Lab->getViewedUserLabIds($id);

		$allupvotes = $this->Vote->countUserUpvotes($userLabIds);

		$alldownvotes = $this->Vote->countUserDownvotes($userLabIds);

		$allvotes = $allupvotes-$alldownvotes;

		$this->set(compact('allupvotes', 'alldownvotes', 'allvotes'));


		//******************Lab Pics Loop**********************		
		//This code loads a list of all the viewed User's Labs, then 
		//finds the corresponding display photo for each lab. Then 
		//the data is sent to the view.

		//loads all of the selected user's lab IDs

		$viewedUserLabIds = $this->Lab->getViewedUserLabIds($id);

				if(!empty($viewedUserLabIds)){

					$dispics = array();

					foreach($viewedUserLabIds as $labres): {



						$dispics[] = $this->Pic->find('first', array(



							'conditions'=>array(



								'Pic.lab_id'=>$labres['Lab']['id'],



								'Pic.isdisp'=>1),



							'recursive'=>0,



							'order'=>array('Pic.created DESC', 'Pic.modified DESC'),



							)



						);	



					} endforeach; 



					$this->set('dispics', $dispics);}



	



}



	







	



	



	



	/**

	 * It displays logged in user's full details to user itself

	 *

	 * @access public

	 * @return array

	 */



	public function myprofile() {



		$this->layout = 'default';



		$userId = $this->UserAuth->getUserId();



		$user = $this->User->getUserById($userId);



		$user['UserGroup']['name']=$this->UserGroup->getGroupsByIds($user['User']['user_group_id']);



		$this->set(compact('user','userId'));




		



		//************************VOTES**************************//



		/* this finds all of selected user's upvotes & downvotes */



		$userLabIds = $this->Lab->getUserLabIds($userId);



		$allupvotes = $this->Vote->countUserUpvotes($userLabIds);



		$alldownvotes = $this->Vote->countUserDownvotes($userLabIds);



		$allvotes = $allupvotes-$alldownvotes;



		$this->set(compact('allupvotes', 'alldownvotes', 'allvotes'));





		$readytogoModal = $this->Session->read('readytogoModal');



		if(!empty($readytogoModal)){



				$this->set('readytogoModal', $this->Session->read('readytogoModal'));



				$this->Session->delete('readytogoModal');



			}

		







		



		//******************Lab Pics Loop**********************		



		//This code loads a list of all the viewed User's Labs, then 



		//finds the corresponding display photo for each lab. Then 



		//the data is sent to the view.



		



		//loads all of the selected user's lab IDs



		$viewedUserLabIds = $this->Lab->getViewedUserLabIds($userId);



				if(!empty($viewedUserLabIds)) {



					$dispics = array();



					foreach($viewedUserLabIds as $labres): {



						$dispics[] = $this->Pic->find('first', array(



							'conditions'=>array(



								'Pic.lab_id'=>$labres['Lab']['id'],



								'Pic.isdisp'=>1),



							'recursive'=>0,



							'order'=>array('Pic.created DESC', 'Pic.modified DESC'),



							)



						);	



					} endforeach; 



					$this->set('dispics', $dispics);}	



	}



	



	



	



	



	



	



	/**

	 * It is used to edit personal profile by user

	 *

	 * @access public

	 * @return array

	 */



	public function editProfile() {



		$userId = $this->UserAuth->getUserId();



		$editProfileModal = $this->Session->read('editProfileModal');



		if(!empty($editProfileModal)){



				$this->set('editProfileModal', $this->Session->read('editProfileModal'));



				$this->Session->delete('editProfileModal');



					$readytogoModal = 1;



					$this->Session->write('readytogoModal', $readytogoModal);

			}







		



		if (!empty($userId)) {



			if ($this->request->isPut() || $this->request->isPost()) {



				$this->User->set($this->request->data);



				$this->UserDetail->set($this->request->data);



				$UserRegisterValidate = $this->User->RegisterValidate();



				$UserDetailRegisterValidate = $this->UserDetail->RegisterValidate();



				



				if($this->RequestHandler->isAjax()) {



					$this->layout = 'ajax';



					$this->autoRender = false;



					



					if ($UserRegisterValidate && $UserDetailRegisterValidate) {



						$response = array('error' => 0, 'message' => 'success');



						return json_encode($response);



					} 



					



					else {



						$response = array('error' => 1,'message' => 'failure');



						$response['data']['User']   = $this->User->validationErrors;



						$response['data']['UserDetail'] = $this->UserDetail->validationErrors;



						return json_encode($response);



					}



				}



				



		



					else {



					if ($UserRegisterValidate && $UserDetailRegisterValidate) {



						$user = $this->User->getUserById($userId);



						


		



							



						/* USER PHOTO LOGIC*/	



						if(is_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name']) && !empty($this->request->data['UserDetail']['photo']['tmp_name']))



						{



							$path_info = pathinfo($this->request->data['UserDetail']['photo']['name']);



							chmod ($this->request->data['UserDetail']['photo']['tmp_name'], 0644);



							$photo=time().mt_rand().".".$path_info['extension'];



							$fullpath= WWW_ROOT."img".DS.IMG_DIR;



							if(!is_dir($fullpath)) {



								mkdir($fullpath, 0777, true);



							}



							move_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name'],$fullpath.DS.$photo);



							$this->request->data['UserDetail']['photo']=$photo;



							if(!empty($user['UserDetail']['photo']) && file_exists($fullpath.DS.$user['UserDetail']['photo'])) {



								unlink($fullpath.DS.$user['UserDetail']['photo']);



							}



						}



						else {



							unset($this->request->data['UserDetail']['photo']);



						}



						/* END OF USERPHOTO LOGIC*/











						if(!ALLOW_CHANGE_USERNAME) {



							unset($this->request->data['User']['username']);



						}



						unset($this->request->data['User']['user_group_id']);



						if(!$this->UserAuth->isAdmin() && $user['User']['email'] != $this->request->data['User']['email']) {



							$this->request->data['User']['email_verified']=0;



							$user['User']['email']= $this->request->data['User']['email'];



							$this->User->sendVerificationMail($user);



							$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);



						}



						



						



						



						if(empty($user['User']['ip_address'])) {



							if(isset($_SERVER['REMOTE_ADDR'])) {



								$this->request->data['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



							}



						}







						$this->User->saveAssociated($this->request->data);



						$this->Session->setFlash(__('Your profile has been successfully updated'));



						$this->redirect(array('action' => 'myprofile'));



					}



				}



			} else {



				$this->request->data = $this->User->getUserById($userId);



			}



	



		} else {



			$this->redirect(array('action' => 'myprofile'));



		}	



		



	}











	/**

	 * It is used to log in user on the site by normal, facebook, twitter etc

	 *

	 * @access public

	 * @param string $connect login type for e.g. fb, twt or null for normal login

	 * @return void

	 */



	public function login($connect=null) {



		$userId = $this->UserAuth->getUserId();



		if ($userId) {



			if($connect) {



				$this->render('popup');



			} else {



				$this->redirect(array('controller'=>'labs','action'=>'index','plugin'=>''));



			}



		}



		if($connect=='fb') {



			$this->login_facebook();



			$this->render('popup');



		} elseif($connect=='twt') {



			$this->login_twitter();



			$this->render('popup');



		} elseif($connect=='gmail') {



			$this->login_gmail();



			$this->render('popup');



		} elseif($connect=='ldn') {



			$this->login_linkedin();



			$this->render('popup');



		} elseif($connect=='fs') {



			$this->login_foursquare();



			$this->render('popup');



		} elseif($connect=='yahoo') {



			$this->login_yahoo();



			$this->render('popup');



		} else {



			if ($this->request->isPost()) {



				$errorMsg="";



				$loginValid=false;



				if($this->UserAuth->canUseRecaptha('login') && !$this->RequestHandler->isAjax()) {



					$this->request->data['User']['captcha']= (isset($this->request->data['recaptcha_response_field'])) ? $this->request->data['recaptcha_response_field'] : "";



				}



				$this->User->set($this->request->data);



				$UserLoginValidate = $this->User->LoginValidate();



				if($UserLoginValidate) {



					$email  = $this->request->data['User']['email'];



					$password = $this->request->data['User']['password'];



					$this->User->contain('UserDetail');



					$user = $this->User->findByUsername($email);



					if(empty($user)) {



						$user = $this->User->findByEmail($email);



						if (empty($user)) {



							$this->UserAuth->setBadLoginCount();



							$errorMsg = __('Incorrect Email/Username or Password', true);



						}



					}



					if($user) {



						$hashed = $this->UserAuth->makePassword($password, $user['User']['salt']);



						if ($user['User']['password'] === $hashed) {



							if ($user['User']['active']==1) {



								if ($user['User']['email_verified']==1) {



									$loginValid=true;



								} else {



									$errorMsg = __('Your email has not been confirmed please verify your email or contact to Administrator', true);



								}



							} else {



								$errorMsg = __('Sorry your account is not active, please contact to Administrator', true);



							}



						} else {



							$this->UserAuth->setBadLoginCount();



							$errorMsg = __('Incorrect Email/Username or Password', true);



						}



					}



				}



				if($this->RequestHandler->isAjax()) {



					$this->layout = 'ajax';



					$this->autoRender = false;



					if ($UserLoginValidate && $loginValid) {



						$response = array('error' => 0, 'message' => 'success');



						return json_encode($response);



					} else {



						$response = array('error' => 1,'message' => 'failure');



						if(empty($errorMsg)) {



							$response['data']['User'] = $this->User->validationErrors;



						} else {



							if($this->UserAuth->captchaOnBadLogin()) {



								// need to submit login for captcha validation



								$response = array('error' => 0, 'message' => 'success');



							} else {



								$response['data']['User'] = array('email'=>array($errorMsg));



							}



						}



						return json_encode($response);



					}



				} else {



					if ($UserLoginValidate && $loginValid) {



						$this->UserAuth->login($user);



						$remember = (!empty($this->request->data['User']['remember']));



						if ($remember) {



							$this->UserAuth->persist('2 weeks');



						}



						$OriginAfterLogin=$this->Session->read('Usermgmt.OriginAfterLogin');



						$this->Session->delete('Usermgmt.OriginAfterLogin');



						$redirect = (!empty($OriginAfterLogin)) ? $OriginAfterLogin : LOGIN_REDIRECT_URL;



						$this->redirect($redirect);



					} else {



						if(empty($errorMsg)) {



							$errorMsg = __('Please fill recaptcha code', true);



						}



						$this->Session->setFlash($errorMsg, 'default', array('class' => 'warning'));



					}



				}



			}



		}



	}



	/**
	* This is the logic for the sign-in modal, which is accessed via the login_guest navbar
	*
	*
	*
	* @access public
	* @param string $connect login type for e.g. fb, twt or null for normal login
	* @return void
	*
	*
	*/






	private function login_facebook() {



		$userId = $this->UserAuth->getUserId();



		$this->Session->read();



		$this->layout=NULL;



		$fbData=$this->UserConnect->facebook_connect();



		if(isset($_GET['error'])) {



			/* Do nothing user canceled authentication */



		} elseif(!empty($fbData['loginUrl'])) {



			$this->redirect($fbData['loginUrl']);



		} else {



			$emailCheck=true;



			if(!empty($fbData['user_profile']['id'])) {



				$this->User->contain('UserDetail');



				$user = $this->User->findByFbId($fbData['user_profile']['id']);



				if(empty($user)) {



					$user = $this->User->findByEmail($fbData['user_profile']['email']);



					$emailCheck=false;



				}



				if(empty($user)) {



					if(SITE_REGISTRATION) {



						$user['User']['fb_id']=$fbData['user_profile']['id'];



						$user['User']['fb_access_token']=$fbData['user_profile']['accessToken'];



						$user['User']['user_group_id']=DEFAULT_GROUP_ID;



						if(!empty($fbData['user_profile']['username'])) {



							$user['User']['username']= $this->generateUserName($fbData['user_profile']['username']);



						} else {



							$user['User']['username']= $this->generateUserName($fbData['user_profile']['name']);



						}



						$user['User']['password'] = $this->UserAuth->generatePassword();



						$user['User']['email']=$fbData['user_profile']['email'];



						$user['User']['active']=1;



						$user['User']['email_verified']=1;



						if(isset($_SERVER['REMOTE_ADDR'])) {



							$user['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



						}



						$userImageUrl = 'http://graph.facebook.com/'.$fbData['user_profile']['id'].'/picture?type=large';



						$photo = $this->updateProfilePic($userImageUrl);



						$user['UserDetail']['photo']=$photo;



						$this->User->save($user,false);



						$userId=$this->User->getLastInsertID();



						$user['UserDetail']['user_id']=$userId;



						$this->UserDetail->save($user,false);



						$user = $this->User->getUserById($userId);



						$this->UserAuth->login($user);



						$this->Session->write('UserAuth.FacebookLogin', true);



						$this->Session->write('UserAuth.FacebookChangePass', true);



					} else {



						$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));



					}



				} else {



					if($user['User']['id'] !=1) {



						$user['User']['fb_id']=$fbData['user_profile']['id'];



						$user['User']['fb_access_token']=$fbData['user_profile']['accessToken'];



						$login=false;



						if(!$emailCheck) {



							$user['User']['email_verified']=1;



							$login=true;



						} else if($user['User']['email_verified']==1) {



							$login=true;



						} else if($user['User']['email']==$fbData['user_profile']['email']) {



							$user['User']['email_verified']=1;



							$login=true;



						}



						$this->User->save($user,false);



						if($login) {



							$user = $this->User->getUserById($user['User']['id']);



							if ($user['User']['active']==0) {



								$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'warning'));



							} else {



								$this->UserAuth->login($user);



								$this->Session->write('UserAuth.FacebookLogin', true);



							}



						} else {



							$this->Session->setFlash(__('Sorry your email is not verified yet'), 'default', array('class' => 'error'));



						}



					}



				}



			}



		}



	}



	private function login_twitter() {



		$userId = $this->UserAuth->getUserId();



		$this->Session->read();



		$this->layout=NULL;



		$twtData=$this->UserConnect->twitter_connect();



		if(isset($twtData['url'])) {



			$this->redirect($twtData['url']);



		} else if(!empty($twtData['user_profile'])) {



			if(!empty($twtData['user_profile']['id'])) {



				$this->User->contain('UserDetail');



				$twtId  = $twtData['user_profile']['id'];



				$user = $this->User->findByTwtId($twtId);



				if(empty($user)) {



					if(SITE_REGISTRATION) {



						$user['User']['twt_id']=$twtData['user_profile']['id'];



						$user['User']['twt_access_token']=$twtData['user_profile']['accessToken'];



						$user['User']['twt_access_secret']=$twtData['user_profile']['accessSecret'];



						$user['User']['user_group_id']=DEFAULT_GROUP_ID;



						$user['User']['username']= $this->generateUserName($twtData['user_profile']['screen_name']);



						$user['User']['password'] = $this->UserAuth->generatePassword();



						$name=preg_replace("/ /", "~", $twtData['user_profile']['name'], 1);



						$name= explode('~', $name);



						$user['User']['active']=1;



						if(isset($_SERVER['REMOTE_ADDR'])) {



							$user['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



						}



						$user['UserDetail']['location']=$twtData['user_profile']['location'];



						$userImageUrl = 'http://api.twitter.com/1.1/users/profile_image?screen_name='.$twtData['user_profile']['screen_name'].'&size=original';



						$photo = $this->updateProfilePic($userImageUrl);



						$user['UserDetail']['photo']=$photo;



						$this->User->save($user,false);



						$userId=$this->User->getLastInsertID();



						$user['UserDetail']['user_id']=$userId;



						$this->UserDetail->save($user,false);



						$user = $this->User->getUserById($userId);



						$this->UserAuth->login($user);



						$this->Session->write('UserAuth.TwitterLogin', true);



						$this->Session->write('UserAuth.TwitterChangePass', true);



					} else {



						$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));



					}



				} else {



					if($user['User']['id'] !=1) {



						if ($user['User']['id'] != 1 and $user['User']['active']==0) {



							$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'warning'));



						} else {



							$user['User']['twt_access_token']=$twtData['user_profile']['accessToken'];



							$user['User']['twt_access_secret']=$twtData['user_profile']['accessSecret'];



							$this->User->save($user,false);



							$this->UserAuth->login($user);



							$this->Session->write('UserAuth.TwitterLogin', true);



						}



					}



				}



			}



		}



	}



	private function login_gmail() {



		$userId = $this->UserAuth->getUserId();



		$this->Session->read();



		$this->layout=NULL;



		$gmailData=$this->UserConnect->gmail_connect();



		if(!isset($_GET['openid_mode'])) {



			$this->redirect($gmailData['url']);



		} else {



			if(!empty($gmailData)) {



				if(!empty($gmailData['email'])) {



					$this->User->contain('UserDetail');



					$user = $this->User->findByEmail($gmailData['email']);



					if(empty($user)) {



						if(SITE_REGISTRATION) {



							$user['User']['user_group_id']=DEFAULT_GROUP_ID;



							if(!empty($gmailData['name'])) {



								$user['User']['username']= $this->generateUserName($gmailData['name']);



							} else {



								$emailArr = explode('@', $gmailData['email']);



								$user['User']['username']= $this->generateUserName($emailArr[0]);



							}



							$user['User']['password'] = $this->UserAuth->generatePassword();



							$user['User']['email']=$gmailData['email'];



							$user['User']['active']=1;



							$user['User']['email_verified']=1;



							if(isset($_SERVER['REMOTE_ADDR'])) {



								$user['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



							}



							$user['UserDetail']['location']=$gmailData['location'];



							$this->User->save($user,false);



							$userId=$this->User->getLastInsertID();



							$user['UserDetail']['user_id']=$userId;



							$this->UserDetail->save($user,false);



							$user = $this->User->getUserById($userId);



							$this->UserAuth->login($user);



							$this->Session->write('UserAuth.GmailLogin', true);



							$this->Session->write('UserAuth.GmailChangePass', true);



						} else {



							$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));



						}



					} else {



						if($user['User']['id'] !=1) {



							if($user['User']['email_verified'] !=1) {



								$user['User']['email_verified']=1;



								$this->User->save($user,false);



							}



							$user = $this->User->getUserById($user['User']['id']);



							if ($user['User']['active']==0) {



								$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'warning'));



							} else {



								$this->UserAuth->login($user);



								$this->Session->write('UserAuth.GmailLogin', true);



							}



						}



					}



				}



			}



		}



	}



	private function login_yahoo() {



		$userId = $this->UserAuth->getUserId();



		$this->Session->read();



		$this->layout=NULL;



		$yahooData=$this->UserConnect->yahoo_connect();



		if(!isset($_GET['openid_mode'])) {



			$this->redirect($yahooData['url']);



		} else {



			if(!empty($yahooData)) {



				if(!empty($yahooData['email'])) {



					$this->User->contain('UserDetail');



					$user = $this->User->findByEmail($yahooData['email']);



					if(empty($user)) {



						if(SITE_REGISTRATION) {



							$user['User']['user_group_id']=DEFAULT_GROUP_ID;



							if(!empty($yahooData['name'])) {



								$user['User']['username']= $this->generateUserName($yahooData['name']);



							} else {



								$emailArr = explode('@', $yahooData['email']);



								$user['User']['username']= $this->generateUserName($emailArr[0]);



							}



							$user['User']['password'] = $this->UserAuth->generatePassword();



							$user['User']['email']=$yahooData['email'];



							$user['User']['active']=1;



							$user['User']['email_verified']=1;



							if(isset($_SERVER['REMOTE_ADDR'])) {



								$user['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



							}



							$user['UserDetail']['gender']=$yahooData['gender'];



							$this->User->save($user,false);



							$userId=$this->User->getLastInsertID();



							$user['UserDetail']['user_id']=$userId;



							$this->UserDetail->save($user,false);



							$user = $this->User->getUserById($userId);



							$this->UserAuth->login($user);



							$this->Session->write('UserAuth.YahooLogin', true);



							$this->Session->write('UserAuth.YahooChangePass', true);



						} else {



							$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));



						}



					} else {



						if($user['User']['id'] !=1) {



							if($user['User']['email_verified'] !=1) {



								$user['User']['email_verified']=1;



								$this->User->save($user,false);



							}



							if ($user['User']['active']==0) {



								$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'warning'));



							} else {



								$this->UserAuth->login($user);



								$this->Session->write('UserAuth.YahooLogin', true);



							}



						}



					}



				}



			}



		}



	}



	private function login_linkedin() {



		$userId = $this->UserAuth->getUserId();



		$this->Session->read();



		$this->layout=NULL;



		$ldnData=$this->UserConnect->linkedin_connect();



		if(!$_GET[LINKEDIN::_GET_RESPONSE]) {



			$this->redirect($ldnData['url']);



		} else {



			$ldnData = json_decode(json_encode($ldnData['user_profile']),TRUE);



			if(!empty($ldnData)) {



				$emailCheck=true;



				if(!empty($ldnData['id'])) {



					$this->User->contain('UserDetail');



					$user = $this->User->findByLdnId($ldnData['id']);



					if(empty($user)) {



						if(!empty($ldnData['email-address'])) {



							$user = $this->User->findByEmail($ldnData['email-address']);



							$emailCheck=false;



						}



					}



					if(empty($user)) {



						if(SITE_REGISTRATION) {



							$user['User']['ldn_id']=$ldnData['id'];



							$user['User']['user_group_id']=DEFAULT_GROUP_ID;



							$user['User']['username']= $this->generateUserName($ldnData['first-name']. ' '.$ldnData['last-name']);



							$user['User']['password'] = $this->UserAuth->generatePassword();



							if(!empty($ldnData['email-address'])) {



								$user['User']['email'] = $ldnData['email-address'];



							}



							$user['User']['active']=1;



							if(isset($ldnData['picture-url'])) {



								$photo = $this->updateProfilePic($ldnData['picture-url']);



								$user['UserDetail']['photo']=$photo;



							}



							if(isset($_SERVER['REMOTE_ADDR'])) {



								$user['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



							}



							$this->User->save($user,false);



							$userId=$this->User->getLastInsertID();



							$user['UserDetail']['user_id']=$userId;



							$this->UserDetail->save($user,false);



							$user = $this->User->getUserById($userId);



							$this->UserAuth->login($user);



							$this->Session->write('UserAuth.LinkedinLogin', true);



							$this->Session->write('UserAuth.LinkedinChangePass', true);



							if(!empty($ldnData['email-address'])) {



								$this->Session->write('UserAuth.LinkedinEmail', true);



							}



						} else {



							$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));



						}



					} else {



						if($user['User']['id'] !=1) {



							$login=false;



							if(!$emailCheck) {



								$user['User']['email_verified']=1;



								$login=true;



							} else if($user['User']['email_verified']==1) {



								$login=true;



							} else if(!empty($ldnData['email-address']) && $user['User']['email']==$ldnData['email-address']) {



								$user['User']['email_verified']=1;



								$login=true;



							}



							$user['User']['ldn_id']=$ldnData['id'];



							$this->User->save($user,false);



							if($login) {



								$user = $this->User->getUserById($user['User']['id']);



								if ($user['User']['active']==0) {



									$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'warning'));



								} else {



									$this->UserAuth->login($user);



									$this->Session->write('UserAuth.LinkedinLogin', true);



								}



							} else {



								$this->Session->setFlash(__('Sorry your email is not verified yet'), 'default', array('class' => 'error'));



							}



						}



					}



				}



			}



		}



	}



	private function login_foursquare() {



		$userId = $this->UserAuth->getUserId();



		$this->Session->read();



		$this->layout=NULL;



		$fsData=$this->UserConnect->foursquare_connect();



		if(!isset($_GET['code']) && !isset($_GET['error']) && empty($_SESSION['fs_access_token'])) {



			$this->redirect($fsData['url']);



		} else {



			$fsData = json_decode(json_encode($fsData['user_profile']),TRUE);



			if(!empty($fsData) && isset($fsData['user']['contact']['email'])) {



				$this->User->contain('UserDetail');



				$user = $this->User->findByEmail($fsData['user']['contact']['email']);



				if(empty($user)) {



					if(SITE_REGISTRATION) {



						$user['User']['user_group_id']=DEFAULT_GROUP_ID;



						$user['User']['username']= $this->generateUserName($fsData['user']['firstName']. ' '.$fsData['user']['lastName']);



						$user['User']['password'] = $this->UserAuth->generatePassword();



						$user['User']['email']=$fsData['user']['contact']['email'];



						if(isset($fsData['user']['photo'])) {



							$user['UserDetail']['photo']=$this->updateProfilePic($fsData['user']['photo']);



						}



						$user['User']['active']=1;



						$user['User']['email_verified']=1;



						if(isset($_SERVER['REMOTE_ADDR'])) {



							$user['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



						}



						$this->User->save($user,false);



						$userId=$this->User->getLastInsertID();



						$user['UserDetail']['user_id']=$userId;



						$this->UserDetail->save($user,false);



						$user = $this->User->getUserById($userId);



						$this->UserAuth->login($user);



						$this->Session->write('UserAuth.FoursquareLogin', true);



						$this->Session->write('UserAuth.FoursquareChangePass', true);



					} else {



						$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));



					}



				} else {



					if($user['User']['id'] !=1) {



						if ($user['User']['active']==0) {



							$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'warning'));



						} else {



							$this->UserAuth->login($user);



							$this->Session->write('UserAuth.FoursquareLogin', true);



						}



					}



				}



			}



		}



	}



	/**

	 * It is used to generate unique username

	 *

	 * @access private

	 * @param string $name user's name to generate username

	 * @return String

	 */



	private function generateUserName($name=null) {



		$username='';



		if(!empty($name)) {



			$username = str_replace(' ', '', strtolower($name));



			while(($this->User->findByUsername($username) || $this->User->isBanned2($username))) {



				$username = str_replace(' ', '', strtolower($name)) . '_' . rand(1000, 9999);



			}



		}



		return $username;



	}



	/**

	 * It is used to log out user from the site

	 *

	 * @access public

	 * @param boolean $msg true for flash message on logout

	 * @return void

	 */



	public function logout($msg=true) {



		$this->UserAuth->logout();



		if($msg) {



			$this->Session->setFlash(__('You are successfully signed out'));



		}



		$this->redirect(LOGOUT_REDIRECT_URL);



	}



















	



	/**

	 * It is used to register a user

	 *

	 * @access public

	 * @return void

	 */



	public function register() {



		$userId = $this->UserAuth->getUserId();



		if ($userId) {



			$this->redirect(array('controller'=>'Labs', 'action' => 'labs', 'plugin'=>''));



		}



		if (SITE_REGISTRATION) {



			if ($this->request->isPost()) {



				if($this->UserAuth->canUseRecaptha('registration') && !$this->RequestHandler->isAjax()) {



					$this->request->data['User']['captcha']= (isset($this->request->data['recaptcha_response_field'])) ? $this->request->data['recaptcha_response_field'] : "";



				}











				$this->User->set($this->request->data);











				$UserRegisterValidate = $this->User->RegisterValidate();



				if($this->RequestHandler->isAjax()) {



					$this->layout = 'ajax';



					$this->autoRender = false;



					if ($UserRegisterValidate) {



						$response = array('error' => 0, 'message' => 'success');



						return json_encode($response);



					} else {



						$response = array('error' => 1,'message' => 'failure');



						$response['data']['User']   = $this->User->validationErrors;



						return json_encode($response);



					}



				} else {



					if ($UserRegisterValidate) {



						 



						if (!EMAIL_VERIFICATION) {



							$this->request->data['User']['email_verified']=1;



						}







						$this->request->data['User']['active']=1;



						



						if(isset($_SERVER['REMOTE_ADDR'])) {



							$this->request->data['User']['ip_address']=$_SERVER['REMOTE_ADDR'];



						}







						$salt = $this->UserAuth->makeSalt();



						











						$this->request->data['User']['salt']=$salt;



						$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);



						



						$this->request->data['User']['user_group_id']=2; //sets all new users to Regular (2) by default







						$this->User->save($this->request->data,false);



						



						$userId=$this->User->getLastInsertID();



						



						$this->request->data['UserDetail']['user_id']=$userId;



						



						$this->UserDetail->save($this->request->data,false);



						



						$this->User->contain('UserDetail');



						



						$user = $this->User->getUserById($userId);



						



						if (SEND_REGISTRATION_MAIL && !EMAIL_VERIFICATION) {



							$this->User->sendRegistrationMail($user);



						}







						if (EMAIL_VERIFICATION) {



							$this->User->sendVerificationMail($user);



						}







						if (isset($this->request->data['User']['active']) && $this->request->data['User']['active'] && !EMAIL_VERIFICATION) {



							$this->UserAuth->login($user);







							$editProfileModal = 1;



							$this->Session->write('editProfileModal', $editProfileModal);







							$this->redirect(array('controller'=>'Users', 'action' => 'editProfile', 'plugin'=>'usermgmt'));







						} else {



							$this->Session->setFlash(__('Please check your mail and confirm your registration'));



							$this->redirect(array('action' => 'login'));



						}



					}



				}



			}



		} else {



			$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));



			$this->redirect(array('action' => 'login'));



		}



	}















	/**

	 * It is used to change password by user itself

	 *

	 * @access public

	 * @return void

	 */



	public function changePassword() {



		$userId = $this->UserAuth->getUserId();



		if ($this->request->isPost()) {



			$this->User->set($this->request->data);



			if(!empty($this->request->data['User']['emailVerifyCode']) && !empty($this->request->data['User']['email'])) {



				$tmpEmail = $this->TmpEmail->findByEmail($this->request->data['User']['email']);



				if(!empty($tmpEmail) && $tmpEmail['TmpEmail']['code']==$this->request->data['User']['emailVerifyCode']) {



					$this->User->contain('UserDetail');



					$user = $this->User->getUserById($userId);



					$userOld = $this->User->findByEmail($this->request->data['User']['email']);



					$success=0;



					if($this->Session->check('UserAuth.TwitterChangePass')) {



						$userOld['User']['twt_id']=$user['User']['twt_id'];



						$userOld['User']['twt_access_token']=$user['User']['twt_access_token'];



						$userOld['User']['twt_access_secret']=$user['User']['twt_access_secret'];



						if(empty($userOld['UserDetail']['photo'])) {



							$userOld['UserDetail']['photo'] = $user['UserDetail']['photo'];



						}



						if(empty($userOld['UserDetail']['location'])) {



							$userOld['UserDetail']['location'] = $user['UserDetail']['location'];



						}



						$this->Session->delete('UserAuth.EmailVerifyCode');



						$this->User->saveAssociated($userOld);



						$success=1;



					} elseif ($this->Session->check('UserAuth.LinkedinChangePass')) {



						$userOld['User']['ldn_id']=$user['User']['ldn_id'];



						if(empty($userOld['UserDetail']['photo'])) {



							$userOld['UserDetail']['photo'] = $user['UserDetail']['photo'];



						}



						$this->Session->delete('UserAuth.EmailVerifyCode');



						$this->User->saveAssociated($userOld);



						$success=1;



					}



					if($success) {



						$this->User->delete($userId, false);



						$this->UserDetail->delete($user['UserDetail']['id'], false);



						$this->TmpEmail->delete($tmpEmail['TmpEmail']['id'], false);



						$this->Session->delete('UserAuth.TwitterChangePass');



						$this->Session->delete('UserAuth.LinkedinChangePass');



						$this->UserAuth->login($userOld);



						$this->Session->setFlash(__('Your accounts were successfully merged'));



						$this->redirect(array('action' => 'dashboard'));



					}



				} else {



					$this->Session->setFlash(__('Email verification code is incorrect, please try again'), 'default', array('class' => 'error'));



				}



			}



			if ($this->User->RegisterValidate()) {



				$user =$this->User->getUserById($userId);



				if(!empty($this->request->data['User']['email'])) {



					$user['User']['email'] = $this->request->data['User']['email'];



				}



				$salt = $this->UserAuth->makeSalt();



				$user['User']['salt'] = $salt;



				$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);



				$this->User->save($user,false);



				$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);



				if(!empty($this->request->data['User']['email'])) {



					$this->User->sendVerificationMail($user);



				}



				if(SEND_PASSWORD_CHANGE_MAIL) {



					$this->User->sendChangePasswordMail($user);



				}



				$this->Session->delete('UserAuth.FacebookChangePass');



				$this->Session->delete('UserAuth.TwitterChangePass');



				$this->Session->delete('UserAuth.GmailChangePass');



				$this->Session->delete('UserAuth.LinkedinChangePass');



				$this->Session->delete('UserAuth.FoursquareChangePass');



				$this->Session->delete('UserAuth.YahooChangePass');



				$this->Session->setFlash(__('Password changed successfully'));



				$this->redirect(array('action' => 'dashboard'));



			} else {



				if(isset($this->request->data['verify']) && !empty($this->request->data['User']['email'])) {



					$emailSent=1;



					if($this->Session->check('UserAuth.EmailVerifyCode')) {



						$emailSent += $this->Session->read('UserAuth.EmailVerifyCode');



					}



					if($emailSent >2) {



						$this->Session->setFlash(__('Sorry we have sent already 2 emails for verification code'), 'default', array('class' => 'warning'));



					} else {



						$code= rand(10000, 1000000);



						$tmpEmail = $this->TmpEmail->findByEmail($this->request->data['User']['email']);



						$tmpEmail['TmpEmail']['code']=$code;



						$tmpEmail['TmpEmail']['email']=$this->request->data['User']['email'];



						$this->TmpEmail->save($tmpEmail, false);



						$this->User->sendVerificationCode($userId, $tmpEmail['TmpEmail']['email'], $code);



						$this->Session->write('UserAuth.EmailVerifyCode', $emailSent);



						$this->Session->setFlash(__('We have sent you an email verification code'));



					}



				}



			}



		}



	}



	/**

	 * It is used to change password of user by admin

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return void

	 */



	public function changeUserPassword($userId=null) {



		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;



		if (!empty($userId)) {



			if(!$this->User->isValidUserId($userId)) {



				$this->redirect(array('action'=>'index', 'page'=>$page));



			}



			$name=$this->User->getNameById($userId);



			$this->set('name', $name);



			if ($this->request->isPost()) {



				$this->User->set($this->request->data);



				$UserRegisterValidate = $this->User->RegisterValidate();



				if($this->RequestHandler->isAjax()) {



					$this->layout = 'ajax';



					$this->autoRender = false;



					if ($UserRegisterValidate) {



						$response = array('error' => 0, 'message' => 'success');



						return json_encode($response);



					} else {



						$response = array('error' => 1,'message' => 'failure');



						$response['data']['User']   = $this->User->validationErrors;



						return json_encode($response);



					}



				} else {



					if ($UserRegisterValidate) {



						$user =$this->User->getUserById($userId);



						$salt = $this->UserAuth->makeSalt();



						$user['User']['salt'] = $salt;



						$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);



						$this->User->save($user,false);



						$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);



						$this->Session->setFlash(__('Password for %s changed successfully', $name));



						$this->redirect(array('action'=>'index', 'page'=>$page));



					}



				}



			}



		} else {



			$this->redirect(array('action'=>'index', 'page'=>$page));



		}



	}



	/**

	 * It is used to add user by Admin

	 *

	 * @access public

	 * @return void

	 */



	public function addUser() {



		$userGroups=$this->UserGroup->getGroups();



		unset($userGroups['']);



		$this->set('userGroups', $userGroups);



		if ($this->request->isPost()) {



			if($this->RequestHandler->isAjax()) {



				$this->layout = 'ajax';     // uses an empty layout



				$this->autoRender = false;  // renders nothing by default



			}



			$this->User->set($this->request->data);



			$UserRegisterValidate = $this->User->RegisterValidate();



			if($this->RequestHandler->isAjax()) {



				if ($UserRegisterValidate) {



					$response = array('error' => 0, 'message' => 'success');



					return json_encode($response);



				} else {



					$response = array('error' => 1,'message' => 'failure');



					$response['data']['User']   = $this->User->validationErrors;



					return json_encode($response);



				}



			} else {



				if ($UserRegisterValidate) {



					sort($this->request->data['User']['user_group_id']);



					$this->request->data['User']['user_group_id'] = implode(',',$this->request->data['User']['user_group_id']);



					$this->request->data['User']['active']=1;



					$this->request->data['User']['email_verified']=1;



					$this->request->data['User']['by_admin']=1;



					$salt = $this->UserAuth->makeSalt();



					$this->request->data['User']['salt']= $salt;



					$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);



					$this->User->save($this->request->data,false);



					$userId=$this->User->getLastInsertID();



					$this->request->data['UserDetail']['user_id']=$userId;



					$this->UserDetail->save($this->request->data,false);



					$this->Session->setFlash(__('The user is successfully added'));



					$this->redirect(array('action' => 'addUser'));



				}



			}



		}



	}



	/**

	 * It is used to add multiple users by Admin

	 *

	 * @access public

	 * @return void

	 */



	public function addMultipleUsers($csv_file=null) {



		$this->set('csv_file', $csv_file);



		if($csv_file) {



			$fullpath= WWW_ROOT."files".DS."csv_users";



			if(file_exists($fullpath.DS.$csv_file)) {



				if (!empty($this->request->data)) {



					if($this->RequestHandler->isAjax()) {



						$this->layout = 'ajax';     // uses an empty layout



						$this->autoRender = false;  // renders nothing by default



					}



					$userErrors = array();



					$userDetailErrors = array();



					$data = array();



					$this->User->multiUsers = $this->request->data;



					foreach($this->request->data['User'] as $key=>$row) {



						$data['User'] = $row;



						if(isset($this->request->data['usercheck'][$key]) && $this->request->data['usercheck'][$key]==1) {



							$this->User->set($data);



							if(!$this->User->multipleValidate()) {



								$userErrors[$key] = $this->User->validationErrors;



							}



						}



					}



					foreach($this->request->data['UserDetail'] as $key=>$row) {



						$data['UserDetail'] = $row;



						if(isset($this->request->data['usercheck'][$key]) && $this->request->data['usercheck'][$key]==1) {



							$this->UserDetail->set($data);



							if(!$this->UserDetail->multipleValidate()) {



								$userDetailErrors[$key] = $this->UserDetail->validationErrors;



							}



						}



					}



					if($this->RequestHandler->isAjax()) {



						if (empty($userErrors) && empty($userDetailErrors)) {



							$response = array('error' => 0, 'message' => 'success');



							return json_encode($response);



						} else {



							$response = array('error' => 1,'message' => 'failure');



							foreach($userErrors as $key=>$val) {



								foreach($val as $k=>$v) {



									$response['data']['User'][$key.'_'.$k]=$v;



								}



							}



							foreach($userDetailErrors as $key=>$val) {



								foreach($val as $k=>$v) {



									$response['data']['UserDetail'][$key.'_'.$k]=$v;



								}



							}



							return json_encode($response);



						}



					} else {



						if(!empty($this->request->data['usercheck'])) {



							if (empty($userErrors) && empty($userDetailErrors)) {



								$userData = array();



								unset($this->request->data['User']['sel_all']);



								foreach($this->request->data['User'] as $key=>$val) {



									if(isset($this->request->data['usercheck'][$key]) && $this->request->data['usercheck'][$key]==1) {



										$userData[$key]['User']=$val;



										$salt = $this->UserAuth->makeSalt();



										$userData[$key]['User']['salt']= $salt;



										$userData[$key]['User']['password'] = $this->UserAuth->makePassword($val['password'], $salt);







										sort($val['user_group_id']);



										$userData[$key]['User']['user_group_id'] = implode(',',$val['user_group_id']);



										$userData[$key]['User']['active']=1;



										$userData[$key]['User']['email_verified']=1;



										$userData[$key]['User']['by_admin']=1;



									}



								}



								foreach($this->request->data['UserDetail'] as $key=>$val) {



									if(isset($this->request->data['usercheck'][$key]) && $this->request->data['usercheck'][$key]==1) {



										$userData[$key]['UserDetail']=$val;



									}



								}



								foreach($userData as $userRow) {



									$this->User->Create();



									$this->User->saveAssociated($userRow, array('validate'=>false));



								}



								$this->Session->setFlash(__('all users information have been saved', true));



								$this->redirect(array('action' => 'index'));



							}  else {



								foreach($userErrors as $key=>$val) {



									foreach($val as $k=>$v) {



										$this->User->validationErrors[$key][$k]=$v;



									}



								}



								foreach($userErrors as $key=>$val) {



									foreach($val as $k=>$v) {



										$this->UserDetail->validationErrors[$key][$k]=$v;



									}



								}



							}



						} else {



							$this->Session->setFlash(__('Please select atleast one user to save'), 'default', array('class' => 'error'));



						}



					}



				} else {



					$users = array();



					$fields1 = array();



					$fields2 = array();



					$i=0;



					$dataFound = false;



					if (($handle = fopen($fullpath.DS.$csv_file, "r")) !== false) {



						while (($data = fgetcsv($handle, 1000, ",")) !== false) {



							if($i==0) {



								$fields1 = $data;



								if(!empty($data[0])) {



									$dataFound = true;



								}



								foreach($data as $key=>$val) {



									$val = trim($val);



									if(in_array($val, array('user_group_id', 'username', 'email', 'password'))) {



										$fields2[$key] = 'User';



									} else if(in_array($val, array('gender', 'bday', 'location', 'marital_status', 'cellphone', 'web_page'))) {



										$fields2[$key] = 'UserDetail';



									}



								}



							} else {



								if($dataFound) {



									foreach($data as $key=>$val) {



										$val = trim($val);



										if($fields1[$key]=='bday') {



											$val = date('Y-m-d', strtotime($val));



										}



										$users[$fields2[$key]][$i-1][$fields1[$key]] = $val;



										$users['usercheck'][$i-1] = 1;



									}



								}



							}



							$i++;



						}



						fclose($handle);



					}



					if(!empty($users)) {



						$this->request->data = $users;



						$this->request->data['Select']['all'] = 1;



					} else {



						$this->Session->setFlash(__('Invalid or empty data in CSV file, please try again'), 'default', array('class'=>'error'));



						$this->redirect(array('action' => 'uploadCsv'));



					}



				}



			} else {



				$this->Session->setFlash(__('CSV file was not uploaded or does not exist, please try again'), 'default', array('class'=>'error'));



				$this->redirect(array('action' => 'uploadCsv'));



			}



		} else {



			$this->redirect(array('action' => 'uploadCsv'));



		}



		$userGroups=$this->UserGroup->getGroups();



		$gender= $this->User->getGenderArray();



		$marital= $this->User->getMaritalArray();



		$this->set(compact('userGroups', 'gender', 'marital', 'total_users'));



	}







	function uploadCsv() {



		if (!empty($this->request->data)) {



			if(is_uploaded_file($this->request->data['User']['csv_file']['tmp_name']) && !empty($this->request->data['User']['csv_file']['tmp_name'])) {



				$path_info = pathinfo($this->request->data['User']['csv_file']['name']);



				if(strtolower($path_info['extension']) =='csv') {



					chmod ($this->request->data['User']['csv_file']['tmp_name'], 0644);



					$filename=time().".".$path_info['extension'];



					$fullpath= WWW_ROOT."files".DS."csv_users";



					if(!is_dir($fullpath)) {



						mkdir($fullpath, 0777, true);



					}



					move_uploaded_file($this->request->data['User']['csv_file']['tmp_name'], $fullpath.DS.$filename);



					$this->redirect(array('action' => 'addMultipleUsers', $filename));



				} else {



					$this->Session->setFlash(__('Please upload CSV file only'), 'default', array('class' => 'error'));



				}



			} else {



				$this->Session->setFlash(__('Please upload CSV file'), 'default', array('class' => 'error'));



			}



		}



		$userGroups=$this->UserGroup->getGroups();



		unset($userGroups['']);



		$this->set(compact('userGroups'));



	}



	/**

	 * It is used to edit user by Admin

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return void

	 */



	public function editUser($userId=null) {



		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;



		if (!empty($userId)) {



			if(!$this->User->isValidUserId($userId)) {



				$this->redirect(array('action'=>'index', 'page'=>$page));



			}



			$userGroups=$this->UserGroup->getGroups();



			$this->set('userGroups', $userGroups);







			if ($this->request->isPut() || $this->request->isPost()) {



				$this->User->set($this->request->data);



				$this->UserDetail->set($this->request->data);



				$UserRegisterValidate = $this->User->RegisterValidate();



				$UserDetailRegisterValidate = $this->UserDetail->RegisterValidate();



				



				



				



				if($this->RequestHandler->isAjax()) {



					$this->layout = 'ajax';



					$this->autoRender = false;



					if ($UserRegisterValidate && $UserDetailRegisterValidate) {



						$response = array('error' => 0, 'message' => 'success');



						return json_encode($response);



					} else {



						$response = array('error' => 1,'message' => 'failure');



						$response['data']['User']   = $this->User->validationErrors;



						$response['data']['UserDetail'] = $this->UserDetail->validationErrors;



						return json_encode($response);



					}



				} else {



					if ($UserRegisterValidate && $UserDetailRegisterValidate) {



						$user = $this->User->getUserById($userId);



						



						



						if(is_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name']) && !empty($this->request->data['UserDetail']['photo']['tmp_name']))



						{



							$path_info = pathinfo($this->request->data['UserDetail']['photo']['name']);



							chmod ($this->request->data['UserDetail']['photo']['tmp_name'], 0644);



							$photo=time().mt_rand().".".$path_info['extension'];



							$fullpath= WWW_ROOT."img".DS.IMG_DIR;



							if(!is_dir($fullpath)) {



								mkdir($fullpath, 0777, true);



							}



							move_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name'],$fullpath.DS.$photo);



							$this->request->data['UserDetail']['photo']=$photo;



							if(!empty($user['UserDetail']['photo']) && file_exists($fullpath.DS.$user['UserDetail']['photo'])) {



								unlink($fullpath.DS.$user['UserDetail']['photo']);



							}



						}



						else {



							unset($this->request->data['UserDetail']['photo']);



						}



						



						



						



						



						



						



						sort($this->request->data['User']['user_group_id']);



						$this->request->data['User']['user_group_id'] = implode(',',$this->request->data['User']['user_group_id']);



						$oldGroupId = $this->User->getGroupId($userId);



						if($oldGroupId != $this->request->data['User']['user_group_id']) {



							$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));



						}



						$this->User->saveAssociated($this->request->data);



						$this->Session->setFlash(__('The user is successfully updated'));



						$this->redirect(array('action'=>'index', 'page'=>$page));



					}



				}



			} else {



				$this->request->data = $this->User->getUserById($userId);



				$this->request->data['User']['user_group_id'] = explode(',',$this->request->data['User']['user_group_id']);



			}



		} else {



			$this->redirect(array('action'=>'index', 'page'=>$page));



		}



	}



	/**

	 * It is used to delete user by Admin

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return void

	 */



	public function deleteUser($userId = null) {



		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;



		if (!empty($userId)) {



			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {



				$res = $this->User->delete($userId, false);



				if($res) {



					$this->UserDetail->deleteAll(array('UserDetail.user_id'=>$userId), false);



					$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);



					$this->UserActivity->updateAll(array('UserActivity.deleted'=>1), array('UserActivity.user_id'=>$userId));



				}



				if($this->RequestHandler->isAjax()) {



					if($res) {



						echo "1";



					}



				} else {



					if($res) {



						$this->Session->setFlash(__('Selected user is deleted successfully'));



					}



					$this->redirect(array('action'=>'index', 'page'=>$page));



				}



			}



		}



		exit;



	}



	/**

	 * It is used to delete user account by itself If allowed by admin in All settings

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return void

	 */



	public function deleteAccount() {



		$userId = $this->UserAuth->getUserId();



		if (!empty($userId)) {



			if ($this->request->isPost() || isset($_SERVER['HTTP_REFERER'])) {



				if(ALLOW_DELETE_ACCOUNT && $userId !=1) {



					if ($this->User->delete($userId, false)) {



						$this->UserDetail->deleteAll(array('UserDetail.user_id'=>$userId), false);



						$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);



						$this->UserActivity->updateAll(array('UserActivity.deleted'=>1), array('UserActivity.user_id'=>$userId));



						$this->Session->setFlash(__('Your account is successfully deleted'));



						$this->logout(false);



					}



				} else {



					$this->Session->setFlash(__('You are not allowed to delete account'), 'default', array('class' => 'warning'));



				}



			}



		}



		$this->redirect(array('action' => 'dashboard'));



	}



	/**

	 * It is used to logout user by Admin from online users page

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return void

	 */



	public function logoutUser($userId = null) {



		if (!empty($userId)) {



			if ($this->request->isPost()) {



				$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));



				$this->Session->setFlash(__('User is successfully signed out'));



			}



		}



		$this->redirect(array('action' => 'online'));



	}



	/**

	 * It is used to logout & make inactive user and by Admin from online users page

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return void

	 */



	public function makeInactive($userId = null) {



		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;



		if ($this->request->isPost()) {



			if (!empty($userId)) {



				$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));



				$this->User->updateAll(array('User.active'=>0), array('User.id'=>$userId));



				$this->Session->setFlash(__('User is successfully signed out and deactivated'));



			}



		}



		$this->redirect(array('action'=>'index', 'page'=>$page));



	}



	/**

	 * It displays dashboard for logged in user

	 *

	 * @access public

	 * @return array

	 */



	public function dashboard() {



		/* Do here something for user */



		$VERSION_NUMBER = $this->Lab->returnVersionNumber();



		$this->set('VERSION_NUMBER', $VERSION_NUMBER);







		$userId = $this->UserAuth->getUserId();



		$user = $this->User->getUserById($userId);



		$this->set('user', $user);







	}



	/**

	 * It is used to activate or deactivate from all users page

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return string

	 */



	public function makeActiveInactive($userId = null) {



		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;



		$msg=__('Sorry there was a problem, please try again');



		if (!empty($userId)) {



			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {



				$res=$this->User->find('first', array('conditions' => array('User.id'=>$userId), 'fields' => array('User.active')));



				if(!empty($res)) {



					if($res['User']['active']) {



						$this->User->id = $userId;



						$this->User->saveField('active', 0, false);



						$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));



					} else {



						$this->User->id = $userId;



						$this->User->saveField('active', 1, false);



						$this->UserActivity->updateAll(array('UserActivity.logout'=>0), array('UserActivity.user_id'=>$userId));



					}



					if($this->RequestHandler->isAjax()) {



						if($res['User']['active']) {



							echo '0';



						} else {



							echo '1';



						}



					} else {



						if($res['User']['active']) {



							$this->Session->setFlash(__('Selected user is de-activated successfully'));



						} else {



							$this->Session->setFlash(__('Selected user is activated successfully'));



						}



						$this->redirect(array('action'=>'index', 'page'=>$page));



					}



				}



			}



		}



		exit;



	}



	/**

	 * It is Used to mark verified email of user from all users page

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return string

	 */



	public function verifyEmail($userId = null) {



		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;



		if (!empty($userId)) {



			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {



				$this->User->id = $userId;



				$this->User->saveField('email_verified', 1, false);



				if($this->RequestHandler->isAjax()) {



					if(!$this->User->field('email_verified')) {



						echo '<img alt="Verify Email" src="'.SITE_URL.'usermgmt/img/email-verify.png">';



					} else {



						echo "1";



					}



				} else {



					if($this->User->field('email_verified')) {



						$this->Session->setFlash(__('Email of selected user is verified successfully'));



					}



					$this->redirect(array('action'=>'index', 'page'=>$page));



				}



			}



		}



		exit;



	}



	/**

	 * It displays Access Denied Page if user wants to view the page without permission

	 *

	 * @access public

	 * @return void

	 */



	public function accessDenied() {







	}



	/**

	 * It is used to verify user's email address when users click on the link sent to their email address

	 *

	 * @access public

	 * @return void

	 */



	public function userVerification() {



		if (isset($_GET['ident']) && isset($_GET['activate'])) {



			$userId= $_GET['ident'];



			$activateKey= $_GET['activate'];



			$user = $this->User->read(null, $userId);



			if (!empty($user)) {



				if (!$user['User']['email_verified']) {



					$password = $user['User']['password'];



					$theKey = $this->User->getActivationKey($password);



					if ($activateKey==$theKey) {



						$user['User']['email_verified']=1;



						$res= $this->User->save($user,false);



						if (SEND_REGISTRATION_MAIL && EMAIL_VERIFICATION) {



							$this->User->sendRegistrationMail($user);



						}



						$this->Session->setFlash(__('Thank you, your account is activated now'));



					}



				} else {



					$this->Session->setFlash(__('Thank you, your account is already activated'));



				}



			} else {



				$this->Session->setFlash(__('Sorry something went wrong, please tap on the link again'), 'default', array('class' => 'error'));



			}



		} else {



			$this->Session->setFlash(__('Sorry something went wrong, please tap on the link again'), 'default', array('class' => 'error'));



		}



		$this->redirect(array('action' => 'login'));



	}



	/**

	 * It is used to reset password of user itself, this function sends email with link to reset the password

	 *

	 * @access public

	 * @return void

	 */



	public function forgotPassword() {



		if ($this->request->isPost()) {



			if($this->UserAuth->canUseRecaptha('forgotPassword') && !$this->RequestHandler->isAjax()) {



				$this->request->data['User']['captcha']= (isset($this->request->data['recaptcha_response_field'])) ? $this->request->data['recaptcha_response_field'] : "";



			}



			$this->User->set($this->request->data);



			if ($this->User->LoginValidate()) {



				$email  = $this->request->data['User']['email'];



				$user = $this->User->findByUsername($email);



				if (empty($user)) {



					$user = $this->User->findByEmail($email);



					if (empty($user)) {



						$this->Session->setFlash(__('Incorrect Email/Username'), 'default', array('class' => 'error'));



						return;



					}



				}



				// check for unverified account



				if ($user['User']['id'] != 1 and $user['User']['email_verified']==0) {



					$this->Session->setFlash(__('Your registration has not been confirmed yet please verify your email before reset password'), 'default', array('class' => 'warning'));



					return;



				}



				$this->User->sendForgotPasswordMail($user);



				$this->Session->setFlash(__('Please check your email for reset your password'));



				$this->redirect(array('action' => 'login'));



			}



		}



	}



	/**

	 * It is used to send email verification mail to user with link to verify the email address

	 *

	 * @access public

	 * @return void

	 */



	public function emailVerification() {



		if ($this->request->isPost()) {



			if($this->UserAuth->canUseRecaptha('emailVerification') && !$this->RequestHandler->isAjax()) {



				$this->request->data['User']['captcha']= (isset($this->request->data['recaptcha_response_field'])) ? $this->request->data['recaptcha_response_field'] : "";



			}



			$this->User->set($this->request->data);



			if ($this->User->LoginValidate()) {



				$email  = $this->request->data['User']['email'];



				$user = $this->User->findByUsername($email);



				if (empty($user)) {



					$user = $this->User->findByEmail($email);



					if (empty($user)) {



						$this->Session->setFlash(__('Incorrect Email/Username'), 'default', array('class' => 'error'));



						return;



					}



				}



				if($user['User']['email_verified']==0) {



					$this->User->sendVerificationMail($user);



					$this->Session->setFlash(__('Please check your mail to verify your email address'));



				} else {



					$this->Session->setFlash(__('Your email is already verified'), 'default', array('class' => 'info'));



				}



				$this->redirect(array('action' => 'login'));



			}



		}



	}



	/**

	 *  It is used to reset password when users click the link in their email

	 *

	 * @access public

	 * @return void

	 */



	public function activatePassword() {



		if ($this->request->isPost()) {



			if (!empty($this->request->data['User']['ident']) && !empty($this->request->data['User']['activate'])) {



				$this->set('ident',$this->request->data['User']['ident']);



				$this->set('activate',$this->request->data['User']['activate']);



				$this->User->set($this->request->data);



				if ($this->User->RegisterValidate()) {



					$userId= $this->request->data['User']['ident'];



					$activateKey= $this->request->data['User']['activate'];



					$user = $this->User->read(null, $userId);



					if (!empty($user)) {



						$password = $user['User']['password'];



						$thekey =$this->User->getActivationKey($password);



						if ($thekey==$activateKey) {



							$user['User']['password']=$this->request->data['User']['password'];



							$salt = $this->UserAuth->makeSalt();



							$user['User']['salt']= $salt;



							$user['User']['password'] = $this->UserAuth->makePassword($user['User']['password'], $salt);



							$this->User->save($user,false);



							$this->Session->setFlash(__('Your password has been reset successfully'));



							$this->redirect(array('action' => 'login'));



						} else {



							$this->Session->setFlash(__('Something went wrong, please send password reset link again'), 'default', array('class' => 'error'));



						}



					} else {



						$this->Session->setFlash(__('Something went wrong, please tap again on the link in email'), 'default', array('class' => 'error'));



					}



				}



			} else {



				$this->Session->setFlash(__('Something went wrong, please tap again on the link in email'), 'default', array('class' => 'error'));



			}



		} else {



			if (isset($_GET['ident']) && isset($_GET['activate'])) {



				$this->set('ident',$_GET['ident']);



				$this->set('activate',$_GET['activate']);



			}



		}



	}



	/**

	 *  It is used to update profile pic from given url

	 *

	 * @access private

	 * @param integer $file_location url of pic

	 * @return String

	 */



	private function updateProfilePic($file_location) {



		$fullpath= WWW_ROOT."img".DS.IMG_DIR;



		if(!is_dir($fullpath)) {



			mkdir($fullpath, 0777, true);



		}



		$imgContent = file_get_contents($file_location);



		$photo=time().mt_rand().".jpg";



		$tempfile=$fullpath.DS.$photo;



		$fp = fopen($tempfile, "w");



		fwrite($fp, $imgContent);



		fclose($fp);



		return $photo;



	}



	/**

	 *  It is used to delete cache of cakephp on production

	 *

	 * @access public

	 * @return void

	 */



	public function deleteCache() {



		Cache::clear();



		$iterator = new RecursiveDirectoryIterator(CACHE);



		foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) {



			$path_info = pathinfo($file);



			if($path_info['dirname']==CACHE."models"  && $path_info['basename']!='.svn') {



				@unlink($file->getPathname());



			}



			if($path_info['dirname']==CACHE."persistent"  && $path_info['basename']!='.svn') {



				@unlink($file->getPathname());



			}



			if($path_info['dirname']==CACHE."views"  && $path_info['basename']!='.svn') {



				@unlink($file->getPathname());



			}



			if($path_info['dirname']==TMP."cache" && $path_info['basename']!='.svn') {



				if(!is_dir($file->getPathname())) {



					@unlink($file->getPathname());



				}



			}



		}



		$this->UserSetting->updateAll(array('UserSetting.value'=>'UserSetting.value + 1'), array('UserSetting.name'=>'QRDN'));



		$this->Session->setFlash('Cache has been deleted successfully');



		$this->redirect(array('action' => 'dashboard'));



	}



	/**

	 *  It is used to view user's permissions by admin

	 *

	 * @access public

	 * @param integer $userId user id of user

	 * @return void

	 */



	public function viewUserPermissions($userId) {



		$name='';



		$permissions=array();



		if (!empty($userId)) {



			$user = $this->User->read(null, $userId);



			if (!empty($user)) {



				$name = trim($user['User']['username']);



				$userGroupIDArray= explode(',', $user['User']['user_group_id']);



				$userGroupIDArray = array_map('trim', $userGroupIDArray);



				$result = $this->UserGroupPermission->find('all',array('conditions'=>array('UserGroupPermission.user_group_id' => $userGroupIDArray, 'UserGroupPermission.allowed'=>1), 'fields'=>array('UserGroupPermission.controller', 'UserGroupPermission.action', 'UserGroup.name'), 'order'=>'UserGroupPermission.controller', 'contain'=>array('UserGroup')));



				$allControllers=$this->ControllerList->getControllers();



				$allControllers = array_flip($allControllers);



				foreach($result as $row) {



					$conAct = $row['UserGroupPermission']['controller'].'/'.$row['UserGroupPermission']['action'];



					if(isset($permissions[$conAct])) {



						$permissions[$conAct]['group'] .= ", ".$row['UserGroup']['name'];



					} else {



						$permissions[$conAct]['controller'] = $row['UserGroupPermission']['controller'];



						$permissions[$conAct]['action'] = $row['UserGroupPermission']['action'];



						$permissions[$conAct]['group'] = $row['UserGroup']['name'];



						$permissions[$conAct]['index'] = $allControllers[$row['UserGroupPermission']['controller']];



					}



				}



				$this->set('permissions',$permissions);



				$this->set('name',$name);



			}



		}



		$this->set('permissions',$permissions);



		$this->set('name',$name);



	}



	



	



	



	



	



	



	



	



	/**

	 * It is used to redirect on login page while ajax call if user is not logged in

	 *

	 * @access public

	 * @return void

	 */



	public function ajaxLoginRedirect() {



		$this->render('/Elements/login_redirect');



	}







	/**

	 * It is used to search emails on send email page

	 *

	 * @access public

	 * @return array

	 */



	public function searchEmails() {



		$results = array();



		$query = '';



		if($this->RequestHandler->isAjax()) {



			if(isset($_POST['data']['q'])) {



				$query = $_POST['data']['q'];



				$selectedUserIds=array();



				if(isset($_POST['data']['selIds'])) {



					$selectedUserIds = explode(',', $_POST['data']['selIds']);



				}



				$results = $this->User->find('all', array('conditions'=>array('OR'=>array(array('User.username LIKE'=>$query.'%'), array('User.email LIKE'=>$query.'%@%')), 'User.email IS NOT NULL', 'User.email !='=>'', 'User.active'=>1, 'User.id NOT'=>$selectedUserIds), 'fields'=>array('User.id', 'User.username', 'User.email')));



			}



		}



		$resultToPrint=array();



		foreach($results as $res) {



			$resultToPrint[] = array('id' => $res['User']['id'], 'text' => $res['User']['username'].' ( '.$res['User']['email'].' )');



		}



		echo json_encode(array('q' => $query, 'results' => $resultToPrint));



		exit;



	}



}