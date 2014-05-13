<?php

?>
<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'cloginForm', 'submitButtonId' => 'cloginSubmitBtn')); ?>
<div style='padding:10px'>
	<?php echo $this->Form->create('User', array('url'=>array('controller' => 'users', 'action' => 'login', 'plugin'=>'usermgmt'), 'id'=>'cloginForm')); ?>
	<?php echo $this->Form->input('email', array('label' => false, 'div' => false, 'placeholder'=>__('Email'), 'title'=>__('Email / Username'))); ?><br/>
	<?php echo $this->Form->input('password', array('type'=>'password', 'label' => false, 'div' => false, 'placeholder'=>__('Password'), 'title'=>__('Password'))); ?><br/>
	<?php   if(USE_REMEMBER_ME) {
				if(!isset($this->request->data['User']['remember'])) { $this->request->data['User']['remember']=true; }
				echo $this->Form->input('remember', array('type'=>'checkbox', 'label' => false, 'div' => false, 'title'=>__('Remember Me'), 'style'=>'margin-top:0'));
				echo __('Remember Me');
				echo "<br/>";
			}
	?><br/>
	<?php if($this->UserAuth->canUseRecaptha('login')) {
		$this->Form->unlockField('recaptcha_challenge_field');
		$this->Form->unlockField('recaptcha_response_field');
		echo $this->UserAuth->showCaptcha(isset($this->validationErrors['User']['captcha'][0]) ? $this->validationErrors['User']['captcha'][0] : "");
		echo "<br/>";
	} ?>
	<?php echo $this->Form->Submit(__('Sign In'), array('id'=>'cloginSubmitBtn', 'class'=>'btn btn-primary'));?>
	<?php echo $this->Form->end(); ?>
	<?php if(SITE_REGISTRATION) {
			echo $this->Html->link(__('Register'), '/register', array());
			echo "<br/>";
		} ?>
	<?php echo $this->Html->link(__('Forgot Password?'), '/forgotPassword', array()); ?><br/>
	<?php echo $this->Html->link(__('Email Verification'), '/emailVerification', array()); ?>
</div>