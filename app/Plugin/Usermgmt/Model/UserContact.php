<?php


App::uses('UserMgmtAppModel', 'Usermgmt.Model');
class UserContact extends UserMgmtAppModel {

	/**
	 * model validation array
	 *
	 * @var array
	 */
	var $validate = array();
	function contactValidate() {
		$validate1 = array(
				'name' => array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter your name'),
						'last'=>true)),
				'email' => array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter your email'),
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => __('Please enter valid email'),
						'last'=>true)),
				'subject' => array(
					'mustNotEmpty'=>array(
							'rule' => 'notEmpty',
							'message'=> __('Please enter a subject'),
							'last'=>true),
					'limitLength'=>array(
						'rule'=>array('maxLength', 100),
						'message'=>'Please limit your description to 100 characters!',
						'last'=>true)),
				'body' => array(
					'rule' => 'notEmpty',
					'message'=> __('Please enter requirement')),
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
}