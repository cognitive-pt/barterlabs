<?php /*this is the user registration modal*/ ?>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title" id="myModalLabel"><?php echo __('Barterlabs Registration'); ?></h3>
            </div>
            <div class="modal-body">



<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Sign-up is easy and free!!') ?>
		</span>
	</div>
	<div class="um-panel-content">
		<div class="row">
			
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
				<div style = "padding: 0 0 10px 25px;">
					<?php echo $this->Form->Submit('Sign Up', array('div'=>false, 'class'=>'button-success pure-button', 'id'=>'registerSubmitBtn')); ?>
				</div>
				<?php echo $this->Form->end(); ?>
			
		</div>
	</div>
</div>





 </div>
            <div class="modal-footer" style="text-color">
                <a href="#" class="btn" data-dismiss="modal" style="color: #000000;">Close</a><!-- note the use of "data-dismiss" -->
            </div>
        </div>
    </div>
</div>

</div>

<script>
    $(function(){
        $('#myModal').modal('show');
    });
</script>