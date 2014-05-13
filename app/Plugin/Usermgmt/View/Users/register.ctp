<?php
echo $this->element('registerModal'); //loads the beta test welcome modal
?>

<div class = "registerrr">


<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Sign-up is easy and free!!') ?>
		</span>
	</div>
	<div class="um-panel-content">
		<div class="row">
			<div class="span6">
				<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'registerForm', 'submitButtonId' => 'registerSubmitBtn')); ?>
				<?php echo $this->Form->create('User', array('id'=>'registerForm', 'class'=>'form-horizontal')); ?>
				
				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('Username');?></label>
					<div class="controls">
						<?php echo $this->Form->input('username', array('label'=>false, 'div'=>false)); ?>
					</div>
				</div>

				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('Email');?></label>
					<div class="controls">
						<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false)); ?>
					</div>
				</div>
				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('Password');?></label>
					<div class="controls">
						<?php echo $this->Form->input('password', array('type'=>'password', 'label'=>false, 'div'=>false)); ?>
					</div>
				</div>
				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('Confirm Password');?></label>
					<div class="controls">
						<?php echo $this->Form->input('cpassword', array('type'=>'password', 'label'=>false, 'div'=>false)); ?>
					</div>
				</div>
				<?php if($this->UserAuth->canUseRecaptha('registration')) { ?>
				<div class="um-form-row control-group">
					<?php   $this->Form->unlockField('recaptcha_challenge_field');
							$this->Form->unlockField('recaptcha_response_field'); ?>
					<label class="control-label required"><?php echo __('Prove you\'re not a robot');?></label>
					<div class="controls">
						<?php echo $this->UserAuth->showCaptcha(isset($this->validationErrors['User']['captcha'][0]) ? $this->validationErrors['User']['captcha'][0] : ""); ?>
					</div>
				</div>
				<?php } ?>
				<div class="um-button-row">
					<?php echo $this->Form->Submit('Sign Up', array('div'=>false, 'class'=>'button-success pure-button', 'id'=>'registerSubmitBtn')); ?>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
			<div class="span5 right">
				<?php // echo $this->element('Usermgmt.provider'); ?>
			</div>
		</div>
	</div>
</div>
</div>