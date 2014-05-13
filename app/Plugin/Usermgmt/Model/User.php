<?php



App::uses('UserMgmtAppModel', 'Usermgmt.Model');

App::uses('CakeEmail', 'Network/Email');


class User extends UserMgmtAppModel {

	

	

	public $actsAs = array('Search.Searchable');

	

	public $virtualFields = array(

		'created1' => 'User.created',

		'created2' => 'User.created'

	);

	/**

	 * This model has following models

	 *

	 * @var array

	 */

	var $hasOne = array('Usermgmt.UserDetail');

	var $hasMany = array('Lab','Vote','Post');

	/**

	 * model validation array

	 *

	 * @var array

	 */

	var $validate = array();

	/**

	 * UsetAuth component object

	 *

	 * @var object

	 */

	var $userAuth;

	/**

	 * data variable for holding multiple users data

	 *

	 * @var array

	 */

	var $multiUsers = array();

	/**

	 * model validation array

	 *

	 * @var array

	 */

	function LoginValidate() {

		$validate1 = array(

				'email'=> array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter email address'))

					),

				'password'=>array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter password'))

					),

				'captcha'=>array(

					'mustMatch'=>array(

						'rule' => array('recaptchaValidate'),

						'message' => ''),

					)

			);

		$this->validate=$validate1;

		return $this->validates();

	}

	/**

	 * model validation array

	 *

	 * @var array

	 */

	function RegisterValidate() {

		$validate1 = array(

				'username'=> array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter username'),

						'last'=>true),

					'mustAlphaNumeric'=>array(

						'rule' => 'alphaNumericDashUnderscore',

						'message'=> __('Letters and numbers only! (no spaces or anything)'),

						'on' => 'create',

						'last'=>true),

					'mustAlpha'=>array(

						'rule' => 'alpha',

						'message'=> __('Username must contain at least a single letter'),

						'last'=>true),

					'mustUnique'=>array(

						'rule' =>'isUnique',

						'message' =>__('This username already taken'),

						'last'=>true),

					'mustNotBanned'=>array(

						'rule' =>'isBanned',

						'message' =>'',

						'last'=>true),

					'mustBeLonger'=>array(

						'rule' => array('minLength', 4),

						'message'=> __('Username must be greater than 3 characters'),

						'last'=>true),

					),

				'email'=> array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter email'),

						'last'=>true),

					'mustBeEmail'=> array(

						'rule' => array('email'),

						'message' => __('Please enter valid email'),

						'last'=>true),

					'mustUnique'=>array(

						'rule' =>'isUnique',

						/* Please note if you want to change this message then also change this in change_password.ctp */

						'message' =>__('This email is already registered')

						)

					),

				'oldpassword'=>array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter old password'),

						'last'=>true),

					'mustMatch'=>array(

						'rule' => array('verifyOldPass'),

						'message' => __('Please enter correct old password')),

					),

				'password'=>array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter password'),

						'on' => 'create',

						'last'=>true),

					'mustBeLonger'=>array(

						'rule' => array('minLength', 6),

						'message'=> __('Password must be greater than 5 characters'),

						'on' => 'create',

						'last'=>true),

					'mustMatch'=>array(

						'rule' => array('verifies'),

						'message' => __('Both passwords must match')),

					),

				'captcha'=>array(

					'mustMatch'=>array(

						'rule' => array('recaptchaValidate'),

						'message' => ''),

					)

			);

		$this->validate=$validate1;

		return $this->validates();

	}

	/**

	 * model validation array

	 *

	 * @var array

	 */

	function multipleValidate() {

		$validate1 = array(

				'user_group_id' => array(

					'rule' => array('multiple', array('min' => 1)),

					'message'=> __('Please select group')),

				'username'=> array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter username'),

						'last'=>true),

					'mustAlphaNumeric'=>array(

						'rule' => 'alphaNumericDashUnderscore',

						'message'=> __('Username must be alphaNumeric'),

						'on' => 'create',

						'last'=>true),

					'mustAlpha'=>array(

						'rule' => 'alpha',

						'message'=> __('Username must contain any letter'),

						'last'=>true),

					'mustUnique'=>array(

						'rule' =>'isUnique',

						'message' =>__('This username already taken'),

						'last'=>true),

					'mustNotBanned'=>array(

						'rule' =>'isBanned',

						'message' =>'',

						'last'=>true),

					'mustBeLonger'=>array(

						'rule' => array('minLength', 4),

						'message'=> __('Username must be greater than 3 characters'),

						'last'=>true),

					'mustNotExist'=>array(

						'rule' =>'checkExistUsernameInList',

						'message' =>__('Duplicate username in this page')

						)

					),





				'email'=> array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter email'),

						'last'=>true),

					'mustBeEmail'=> array(

						'rule' => array('email'),

						'message' => __('Please enter valid email'),

						'last'=>true),

					'mustUnique'=>array(

						'rule' =>'isUnique',

						'message' =>__('This email is already registered')

						),

					'mustNotExist'=>array(

						'rule' =>'checkExistEmailInList',

						'message' =>__('Duplicate email in this page')

						)

					),

				'password'=>array(

					'mustNotEmpty'=>array(

						'rule' => 'notEmpty',

						'message'=> __('Please enter password'),

						'on' => 'create',

						'last'=>true),

					'mustBeLonger'=>array(

						'rule' => array('minLength', 6),

						'message'=> __('Password must be greater than 5 characters'),

						'on' => 'create',

						'last'=>true)

					)

			);

		$this->validate=$validate1;

		return $this->validates();

	}

	/**

	 * Used to check duplicate email in add multiple users page

	 *

	 * @access public

	 * @return boolean

	 */

	function checkExistEmailInList() {

		$found = 0;

		foreach($this->multiUsers['User'] as $key=>$row) {

			if(isset($this->multiUsers['usercheck'][$key]) && $this->multiUsers['usercheck'][$key]==1) {

				if(strtolower($this->data['User']['email'])==strtolower($row['email'])) {

					$found++;

				}

			}

		}

		if($found > 1) {

			return false;

		}

		return true;

	}

	/**

	 * Used to check duplicate username in add multiple users page

	 *

	 * @access public

	 * @return boolean

	 */

	function checkExistUsernameInList() {

		$found = 0;

		foreach($this->multiUsers['User'] as $key=>$row) {

			if(isset($this->multiUsers['usercheck'][$key]) && $this->multiUsers['usercheck'][$key]==1) {

				if(strtolower($this->data['User']['username'])==strtolower($row['username'])) {

					$found++;

				}

			}

		}

		if($found > 1) {

			return false;

		}

		return true;

	}

	/**

	 * Used to validate captcha

	 *

	 * @access public

	 * @return boolean

	 */

	public function recaptchaValidate() {

		App::import("Vendor", "Usermgmt.recaptcha/recaptchalib");

		$recaptcha_challenge_field = (isset($_POST['recaptcha_challenge_field'])) ? $_POST['recaptcha_challenge_field'] : "";

		$recaptcha_response_field = (isset($_POST['recaptcha_response_field'])) ? $_POST['recaptcha_response_field'] : "";

		$resp = recaptcha_check_answer(PRIVATE_KEY_FROM_RECAPTCHA, $_SERVER['REMOTE_ADDR'], $recaptcha_challenge_field, $recaptcha_response_field);

		$error = $resp->error;

		if(!$resp->is_valid) {

			$this->validationErrors['captcha'][0]=$error;

		}

		return true;

	}

	/**

	 * Used to validate banned usernames

	 *

	 * @access public

	 * @return boolean

	 */

	public function isBanned() {

		$bannedUsers= explode(',', strtolower(BANNED_USERNAMES));

		$bannedUsers = array_map('trim', $bannedUsers);

		$checkMore=true;

		if(!empty($bannedUsers)) {

			if(isset($this->data['User']['id'])) {

				$oldUsername= $this->getUserNameById($this->data['User']['id']);

			}

			if(!isset($oldUsername) || $oldUsername !=$this->data['User']['username']) {

				if(in_array(strtolower($this->data['User']['username']), $bannedUsers)) {

					$this->validationErrors['username'][0]=__('You cannot set this username');

					$checkMore=false;

				}

			}

		}

		if($checkMore) {

			App::import("Component", "Usermgmt.ControllerList");

			$contList = new ControllerListComponent(new ComponentCollection());

			$conts = $contList->getControllers();

			unset($conts[-2]);

			unset($conts[-1]);

			$conts = array_map('strtolower', $conts);

			$usernameTmp =strtolower(str_replace(' ','',ucwords(str_replace('_',' ',$this->data['User']['username']))));

			if(in_array($usernameTmp, $conts)) {

				$this->validationErrors['username'][0]=__('You cannot set this username');

				$checkMore=false;

			}

			if($checkMore) {

				$plugins = App::objects('plugins');

				$plugins = array_map('strtolower', $plugins);

				if(in_array($usernameTmp, $plugins)) {

					$this->validationErrors['username'][0]=__('You cannot set this username');

					$checkMore=false;

				}

				if($checkMore) {

					$customRoutes = Router::$routes;

					$usernameTmp ='/'.$this->data['User']['username'];

					foreach($customRoutes as $customRoute) {

						if(strpos(strtolower($customRoute->template),strtolower($usernameTmp)) !==false) {

							$this->validationErrors['username'][0]=__('You cannot set this username');

							break;

						}

					}

				}

			}

		}

		return true;

	}

	/**

	 * Used to validate and generate usernames

	 *

	 * @access public

	 * @return boolean

	 */

	public function isBanned2($username = null) {

		$bannedUsers= explode(',', strtolower(BANNED_USERNAMES));

		$bannedUsers = array_map('trim', $bannedUsers);

		if(!empty($bannedUsers)) {

			if(in_array(strtolower($username), $bannedUsers)) {

				return true;

			}

		}

		App::import("Component", "Usermgmt.ControllerList");

		$contList = new ControllerListComponent(new ComponentCollection());

		$conts = $contList->getControllers();

		unset($conts[-2]);

		unset($conts[-1]);

		$conts = array_map('strtolower', $conts);

		$usernameTmp =strtolower(str_replace(' ', '', ucwords(str_replace('_', ' ', $username))));

		if(in_array($usernameTmp, $conts)) {

			return true;

		}

		$plugins = App::objects('plugins');

		$plugins = array_map('strtolower', $plugins);

		if(in_array($usernameTmp, $plugins)) {

			return true;

		}

		$customRoutes = Router::$routes;

		$usernameTmp ='/'.$username;

		foreach($customRoutes as $customRoute) {

			if(strpos(strtolower($customRoute->template),strtolower($usernameTmp)) !== false) {

				return true;

			}

		}

		return false;

	}

	/**

	 * Used to match old password

	 *

	 * @access public

	 * @return boolean

	 */

	public function verifyOldPass() {

		$userId = $this->userAuth->getUserId();

		$user=$this->find('first', array('conditions'=>array('id'=>$userId)));

		$oldpass=$this->userAuth->makePassword($this->data['User']['oldpassword'], $user['User']['salt']);

		return ($user['User']['password']===$oldpass);

	}

	/**

	 * Used to send registration mail to user

	 *

	 * @access public

	 * @param array $user user detail array

	 * @return void

	 */

	public function sendRegistrationMail($user) {

		// send email to newly created user

		$userId=$user['User']['id'];

		$email = new CakeEmail('default');

		$email->emailFormat('both');

		$fromConfig = EMAIL_FROM_ADDRESS;

		$fromNameConfig = EMAIL_FROM_NAME;

		$email->from(array( $fromConfig => $fromNameConfig));

		$email->sender(array( $fromConfig => $fromNameConfig));

		$email->to($user['User']['email']);

		$email->subject(SITE_NAME.': '.__('Registration is Complete'));

		//$email->transport('Debug');

		$body=__('Welcome %s,<br/><br/>Thank you for your registration on %s.<br/><br/>Thanks,<br/>%s', $user['User']['username'], SITE_URL, SITE_NAME);

		try{

			$result = $email->send($body);

			$this->log('Registration mail sent to userid-'.$userId, LOG_DEBUG);

		} catch (Exception $ex) {

			// we could not send the email, ignore it

			$result="Could not send registration email to userid-".$userId;

			$this->log($result, LOG_DEBUG);

		}

	}

	/**

	 * Used to send email verification mail to user

	 *

	 * @access public

	 * @param array $user user detail array

	 * @return void

	 */

	public function sendVerificationMail($user) {

		$userId=$user['User']['id'];

		$email = new CakeEmail('default');

		$email->emailFormat('both');

		$fromConfig = EMAIL_FROM_ADDRESS;

		$fromNameConfig = EMAIL_FROM_NAME;

		$email->from(array( $fromConfig => $fromNameConfig));

		$email->sender(array( $fromConfig => $fromNameConfig));

		$email->to($user['User']['email']);

		$email->subject(SITE_NAME.': '.__('Contact Email Confirmation'));

		$activate_key = $this->getActivationKey($user['User']['password']);

		$link = Router::url("/userVerification?ident=$userId&activate=$activate_key",true);

		$body=__('Hey %s, <br/><br/>You recently entered a contact email address.  To confirm your contact email, follow the link below: <br/><br/>%s<br/><br/>If clicking on the link doesn\'t work, try copying and pasting it into your browser.<br/><br/>Thanks,<br/>%s', $user['User']['username'], $link, SITE_NAME);

		try{

			$result = $email->send($body);

			$this->log('Email verification mail sent to userid-'.$userId, LOG_DEBUG);

		} catch (Exception $ex){

			// we could not send the email, ignore it

			$result="Could not send verification email to userid-".$userId;

			$this->log($result, LOG_DEBUG);

		}

	}

	/**

	 * Used to send email verification code to user

	 *

	 * @access public

	 * @param array $user user detail array

	 * @return void

	 */

	public function sendVerificationCode($userId, $emailadd, $code) {

		$name = $this->getNameById($userId);

		$email = new CakeEmail('default');

		$email->emailFormat('both');

		$fromConfig = EMAIL_FROM_ADDRESS;

		$fromNameConfig = EMAIL_FROM_NAME;

		$email->from(array( $fromConfig => $fromNameConfig));

		$email->sender(array( $fromConfig => $fromNameConfig));

		$email->to($emailadd);

		$email->subject(SITE_NAME.': '.__('Email Verification Code'));

		$body=__('Hey %s,<br/><br/>You recently entered a new contact email address. Your email confirmation code is %s<br/><br/>Thanks,<br/>%s', $name, $code, SITE_NAME);

		try{

			$result = $email->send($body);

			$this->log('Email verification code mail sent to userid-'.$userId, LOG_DEBUG);

		} catch (Exception $ex){

			// we could not send the email, ignore it

			$result="Could not send verification code email to userid-".$userId;

			$this->log($result, LOG_DEBUG);

		}

	}

	/**

	 * Used to generate activation key

	 *

	 * @access public

	 * @param string $password user password

	 * @return hash

	 */

	public function getActivationKey($password) {

		$salt = Configure::read ( "Security.salt" );

		return md5(md5($password).$salt);

	}

	/**

	 * Used to send forgot password mail to user

	 *

	 * @access public

	 * @param array $user user detail

	 * @return void

	 */

	public function sendForgotPasswordMail($user) {

		$userId=$user['User']['id'];

		$email = new CakeEmail('default');

		$email->emailFormat('both');

		$fromConfig = EMAIL_FROM_ADDRESS;

		$fromNameConfig = EMAIL_FROM_NAME;

		$email->from(array( $fromConfig => $fromNameConfig));

		$email->sender(array( $fromConfig => $fromNameConfig));

		$email->to($user['User']['email']);

		$email->subject(SITE_NAME.': '.__('Request to Reset Your Password'));

		$activate_key = $this->getActivationKey($user['User']['password']);

		$link = Router::url("/activatePassword?ident=$userId&activate=$activate_key",true);

		$body=__('Welcome %s,<br/><br/>You have requested to have your password reset on %s. Please click the link below to reset your password now: <br/><br/>%s<br/><br/>If clicking on the link doesn\'t work, try copying and pasting it into your browser.<br/><br/>Thanks,<br/>%s', $user['User']['username'], SITE_NAME, $link, SITE_NAME);

		try{

			$result = $email->send($body);

			$this->log('Forgot password mail sent to userid-'.$userId, LOG_DEBUG);

		} catch (Exception $ex){

			// we could not send the email, ignore it

			$result="Could not send forgot password email to userid-".$userId;

			$this->log($result, LOG_DEBUG);

		}

	}

	/**

	 * Used to send change password mail to user

	 *

	 * @access public

	 * @param array $user user detail

	 * @return void

	 */

	public function sendChangePasswordMail($user) {

		$userId=$user['User']['id'];

		$email = new CakeEmail('default');

		$email->emailFormat('both');

		$fromConfig = EMAIL_FROM_ADDRESS;

		$fromNameConfig = EMAIL_FROM_NAME;

		$email->from(array( $fromConfig => $fromNameConfig));

		$email->sender(array( $fromConfig => $fromNameConfig));

		$email->to($user['User']['email']);

		$email->subject(SITE_NAME.': '.__('Change Password Confirmation'));

		$datetime = date('Y M d h:i:s', time());

		$body= __('Hey %s,<br/><br/>You recently changed your password on %s.<br/><br/>As a security precaution, this notification has been sent to your email addresse associated with your account.<br/><br/>Thanks,<br/>%s', $user['User']['username'], $datetime, SITE_NAME);

		try{

			$result = $email->send($body);

			$this->log('Change password mail sent to userid-'.$userId, LOG_DEBUG);

		} catch (Exception $ex){

			// we could not send the email, ignore it

			$result="Could not send change password email to userid-".$userId;

			$this->log($result, LOG_DEBUG);

		}

	}

	/**

	 * Used to mark cookie used

	 *

	 * @access public

	 * @param string $type

	 * @param string $credentials

	 * @return array

	 */

	public function authsomeLogin($type, $credentials = array()) {

		$conditions = array();

		switch ($type) {

			case 'guest':

				// You can return any non-null value here, if you don't

				// have a guest account, just return an empty array

				return array();

			case 'cookie':

				App::import("Model", "Usermgmt.LoginToken");

				$loginTokenModel = new LoginToken;

				$loginToken=false;

				if(strpos($credentials['token'], ":") !==false) {

					list($token, $userId) = split(':', $credentials['token']);

					$duration = $credentials['duration'];



					$loginToken = $loginTokenModel->find('first', array(

						'conditions' => array(

							'user_id' => $userId,

							'token' => $token,

							'duration' => $duration,

							'used' => false,

							'expires <=' => date('Y-m-d H:i:s', strtotime($duration)),

						),

						'contain' => false

					));

				}

				if (!$loginToken) {

					return false;

				}

				$loginToken['LoginToken']['used'] = true;

				$loginTokenModel->save($loginToken);



				$conditions = array(

					'User.id' => $loginToken['LoginToken']['user_id']

				);

			break;

			default:

				return array();

		}

		$user = $this->find('first', array('conditions'=>$conditions, 'contain'=>array('UserDetail')));

		return $user;

	}

	/**

	 * Used to generate cookie token

	 *

	 * @access public

	 * @param integer $userId user id

	 * @param string $duration cookie persist life time

	 * @return string

	 */

	public function authsomePersist($userId, $duration) {

		$token = md5(uniqid(mt_rand(), true));

		App::import("Model", "Usermgmt.LoginToken");

		$loginTokenModel = new LoginToken;

		$loginTokenModel->create(array(

			'user_id' => $userId,

			'token' => $token,

			'duration' => $duration,

			'expires' => date('Y-m-d H:i:s', strtotime($duration)),

		));

		$loginTokenModel->deleteAll(array('user_id'=>$userId),false);

		$loginTokenModel->save();

		return "${token}:${userId}";

	}

	/**

	 * Used to get name by user id

	 *

	 * @access public

	 * @param integer $userId user id

	 * @return string

	 */

	public function getNameById($userId) {

		$res=$this->find('first', array('conditions'=>array('id'=>$userId), 'fields'=>array('User.username')));

		$name=(!empty($res)) ? ($res['User']['username']) : '';

		return $name;

	}

	/**

	 * Used to get username by user id

	 *

	 * @access public

	 * @param integer $userId user id

	 * @return string

	 */

	

	

	

	

	public function getUserNameById($userId) {

		$res=$this->find('first', array('conditions'=>array('id'=>$userId), 'fields'=>array('User.username')));

		$name=(!empty($res)) ? ($res['User']['username']) : '';

		return $name;

	}

	

	

	

	

	/**

	 * Used to get email by user id

	 *

	 * @access public

	 * @param integer $userId user id

	 * @return string

	 */

	public function getEmailById($userId) {

		$res=$this->find('first', array('conditions'=>array('id'=>$userId), 'fields'=>array('User.email')));

		$email=(!empty($res)) ? ($res['User']['email']) : '';

		return $email;

	}

	/**

	 * Used to get user by user id

	 *

	 * @access public

	 * @param integer $userId user id

	 * @return string

	 */

	public function getUserById($userId) {

		$res = $this->find('first', array('conditions'=>array('User.id'=>$userId), 'contain'=>array('UserDetail')));

		return $res;

	}





function getViewedUserId($id){

		$res = $this->find('first', array(

			'conditions' => array('User.id' => $id),

			'fields' => array('User.id'),

			)

		); 

		$viewedUserId = (!empty($res)) ? ($res['User']['id']) : '';

		return $viewedUserId;} //end getViewedUserId();















	/**

	 * Used to check user by user id

	 *

	 * @access public

	 * @param integer $userId user id

	 * @return boolean

	 */

	public function isValidUserId($userId) {

		if($this->hasAny(array('User.id'=>$userId))) {

			return true;

		}

		return false;

	}

	/**

	 * Used to check users by group id

	 *

	 * @access public

	 * @param integer $groupId user id

	 * @return boolean

	 */

	public function isUserAssociatedWithGroup($groupId) {

		$res = $this->find('count', array('conditions'=>array('OR'=> array(array('User.user_group_id'=>$groupId),array('User.user_group_id like'=>$groupId.',%'),array('User.user_group_id like'=>'%,'.$groupId.',%'),array('User.user_group_id like'=>'%,'.$groupId)))));

		if(!empty($res)) {

			return true;

		}

		return false;

	}

	/**

	 * Used to group id by user id

	 *

	 * @access public

	 * @param integer $userId user id

	 * @return boolean

	 */

	public function getGroupId($userId) {

		$res=$this->find('first', array('conditions'=>array('id'=>$userId), 'fields'=>array('User.user_group_id')));

		$groupId='';

		if(!empty($res)) {

			$groupId =$res['User']['user_group_id'];

		}

		return $groupId;

	}

	/**

	 * Used to get all users

	 *

	 * @access public

	 * @param array $userIds user ids

	 * @return boolean

	 */

	function getAllUsersWithUserIds($userIds=null) {

		$users=array();

		$cond = array();

		$cond['User.active']= 1;

		if ($userIds) {

			$cond['User.id']=$userIds;

		}

		if($userIds) {

			$res = $this->find('all', array('conditions'=>$cond, 'fields'=>array('User.id', 'User.email', 'User.username')));

			foreach($res as $row) {

				$users[$row['User']['id']]=$row['User']['username'].' ('.$row['User']['email'].')';

			}

		}

		return $users;

	}

	/**

	 * Used to get user by email

	 *

	 * @access public

	 * @param string $email user email

	 * @return string

	 */

	public function findByEmail($email) {

		$res = $this->find('first', array('conditions'=>array('User.email'=>$email), 'contain'=>array('UserDetail')));

		return $res;

	}

	/**

	 * Used to get user by username

	 *

	 * @access public

	 * @param string $username user username

	 * @return string

	 */

	public function findByUsername($username) {

		$res = $this->find('first', array('conditions'=>array('User.username'=>$username), 'contain'=>array('UserDetail')));

		return $res;

	}

	/**

	 * Used to get user by fb_id

	 *

	 * @access public

	 * @param string $fb_id user fb_id

	 * @return string

	 */

	public function findByFbId($fb_id) {

		$res = $this->find('first', array('conditions'=>array('User.fb_id'=>$fb_id), 'contain'=>array('UserDetail')));

		return $res;

	}

	/**

	 * Used to get user by twt_id

	 *

	 * @access public

	 * @param string $twt_id user twt_id

	 * @return string

	 */

	public function findByTwtId($twt_id) {

		$res = $this->find('first', array('conditions'=>array('User.twt_id'=>$twt_id), 'contain'=>array('UserDetail')));

		return $res;

	}

	/**

	 * Used to get user by ldn_id

	 *

	 * @access public

	 * @param string $ldn_id user ldn_id

	 * @return string

	 */

	public function findByLdnId($ldn_id) {

		$res = $this->find('first', array('conditions'=>array('User.ldn_id'=>$ldn_id), 'contain'=>array('UserDetail')));

		return $res;

	}

	

	



	

	

	

	

	

}