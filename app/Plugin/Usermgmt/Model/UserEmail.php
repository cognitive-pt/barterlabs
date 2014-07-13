<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
class UserEmail extends AppModel {
	/**
	 * This model has following models
	 *
	 * @var array
	 */
	var $belongsTo = array('User'=>array('foreignKey'=>'from_id'));
	/**
	 * model validation array
	 *
	 * @var array
	 */
	var $validate = array();
	/**
	 * model validation array
	 *
	 * @var array
	 */
	function sendValidate() {
		$validate1 = array(
				'subject'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter email subject'),
						'last'=>true)
					),
				'message'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter email message'),
						'last'=>true)
					),
				);
		$this->validate=$validate1;
		return $this->validates();
	}
	
	
	
	function validateTOEmails($check) {
		if($this->data['UserEmail']['type']=='MANUAL' && !empty($this->data['UserEmail']['to_email'])) {
			return $this->validateEmails($check);
		}
		return true;
	}
	function validateEmails($check) {
		$emails = array_values($check);
		$key = array_keys($check);
		$emails = explode(',', $emails[0]);
		foreach($emails as $email) {
			$email = trim($email);
			if(!empty($email)) {
				$valid = Validation::email($email);
				if(!$valid) {
					$this->validationErrors[$key[0]][0]=__('There was an email error.').' \''.$email.'\'';
					break;
				}
			}
		}
		return true;
	}
	
	
//Retrieves the email data and fromUser data based on the id of email being viewed	
	public function getUserEmail($userEmailId){
		$userEmail = $this->find('first', array(
			'conditions' => array('
				UserEmail.id'=>$userEmailId), 
			'contain'=>array('User'), 
			'fields'=>array(
				'UserEmail.*', 
				'User.username', 
				'User.id')));	
		return $userEmail;
	} //end getUserEmail
	
	
//Retrieves the email data and fromUser data based on the id of email being viewed	
	public function checkEmail($userId) {
		$res = $this->find('count', array(
			'conditions'=>array(
				'UserEmail.to_id'=>$userId,
				'UserEmail.is_email_sent'=>1,
				'UserEmail.is_email_read'=>0
				),
			'recursive'=>0
				));
		return $res;
	} //end checkEmail	
	


	
}