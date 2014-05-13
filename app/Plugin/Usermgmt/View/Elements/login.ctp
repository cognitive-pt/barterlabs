<!-- This is EMAIL ADDRESS and PASSWORD form that appears in the NAVBAR -->

<div class="login-page-container">
	<div class="dashboard-menu">
		<div class="navbar">
	    	<div class="navbar-fixed-top"> 
				<div class="navbar-inner"> 


			<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'loginForm', 'submitButtonId' => 'loginSubmitBtn')); ?>
			<?php echo $this->Form->create('User', array('id'=>'loginForm', 'class'=>'form-horizontal')); ?>
			



			<div class="um-form-row-login pull-left">
					<div class="small-new-login-left">
							<?php echo $this->Form->input('email', array('type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>__('Email / Username'))); ?>
					</div>		
			</div>
		

			<div class="um-form-row-login pull-left">
					<div class="small-new-login-left">
							<?php echo $this->Form->input('password', array('type'=>'password', 'label'=>false, 'div'=>false, 'placeholder'=>__('Password'))); ?>
					</div>
			</div>



			<?php if(USE_REMEMBER_ME) { ?>
			<div class="um-form-row-login pull-left">
			<?php   if(!isset($this->request->data['User']['remember'])) {
						$this->request->data['User']['remember']=true;
					} ?>
				<?php echo __('Remember me!');?>
					<?php echo $this->Form->input('remember', array('type'=>'checkbox', 'label'=>false, 'div'=>'login-rememberme-margin', 
					'class'=>'login-rememberme-margin')); ?>
			
			<?php } ?>



			<?php if($this->UserAuth->canUseRecaptha('login')) { ?>

				<?php   $this->Form->unlockField('recaptcha_challenge_field');
						$this->Form->unlockField('recaptcha_response_field'); ?>
					<label class="control-label required"><?php echo __('Prove you\'re not a robot');?></label>

						<?php echo $this->UserAuth->showCaptcha(isset($this->validationErrors['User']['captcha'][0]) ? $this->validationErrors['User']['captcha'][0] : ""); ?>
				<?php } ?>



				
					<?php echo $this->Form->Submit('Sign In', array('div'=>false, 'class'=>'button-success pure-button')); ?>
					
				
					<?php echo $this->Html->link(__('Forgot Password?'), 
								array('controller'=>'Users', 
									  'action'=>'forgotPassword'),
								array('class'=>'forgot-password')
								   ); ?> 

 					<?php echo $this->Html->link(__('Sign Up', true), '/register',
 						array('class'=>'forgot-password'));?>

					<?php echo $this->Form->end(); ?>

				
							
				
					

			<?php // echo $this->element('Usermgmt.provider'); ?>
		</div>
	</div>
</div>



				</div>
			</div>
		</div>
	</div>	
</div>