<?php

?>
<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'contactForm', 'submitButtonId' => 'contactSubmitBtn')); ?>
<div style='padding:10px'>
	<?php echo $this->Form->create('UserContact', array('url'=>array('controller' => 'user_contacts', 'action' => 'contactUs', 'plugin'=>'usermgmt'), 'id'=>'contactForm')); ?>
	
	<?php echo $this->Form->input('username', array('label' => false, 'div' => false, 'placeholder'=>__('Username'), 'title'=>__('Username'))); ?><br/>
	
	<?php echo $this->Form->input('email', array('label' => false, 'div' => false, 'placeholder'=>__('Email'), 'title'=>__('Email'))); ?><br/>
	
	<?php echo $this->Form->input('subject', array('label' => false, 'div' => false, 'placeholder'=>__('Subject'), 'title'=>__('Subject'))); ?><br/>
	
	<?php echo $this->Form->textarea('body', array('label' => false, 'div' => false, 'placeholder'=>__('Body'), 'title'=>__('Body'))); ?><br/>
	<?php if($this->UserAuth->canUseRecaptha('contactus')) {
		$this->Form->unlockField('recaptcha_challenge_field');
		$this->Form->unlockField('recaptcha_response_field');
		echo $this->UserAuth->showCaptcha(isset($this->validationErrors['UserContact']['captcha'][0]) ? $this->validationErrors['UserContact']['captcha'][0] : "");
		echo "<br/>";
	} ?>
	<?php echo $this->Form->Submit(__('Submit'), array('id'=>'contactSubmitBtn', 'class'=>'btn btn-primary')); ?>
	<?php echo $this->Form->end(); ?>
</div>