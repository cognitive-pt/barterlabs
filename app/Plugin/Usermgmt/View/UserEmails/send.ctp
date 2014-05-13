<?php

?>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Message').' '.$to_name; ?>
		</span>
		
	</div>
	<div class="um-panel-content">
		
		<?php echo $this->Form->create('UserEmail', array('id'=>'sendMailForm', 'class'=>'form-horizontal')); ?>
		<?php
			if(!isset($this->request->data['UserEmail']['to_id'])) {
				$this->request->data['UserEmail']['to_name'] = $to_name;
			}
		?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('To');?></label>
			<div class="controls"> 
				<?php echo $to_name; ?> 
			</div>
		</div>
		
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('From Name');?></label>
			<div class="controls">
				<?php echo $senderName; ?>
			</div>
		</div>

		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Subject');?></label>
			<div class="controls">
            	<?php $this->request->data['UserEmail']['subject']=$subject; ?>
				<?php echo $this->Form->input('subject', array('label'=>false, 'div'=>false, 'class'=>'span8')); ?>
			</div>
		</div>

		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Message');?></label>
			<div class="controls">
				<?php  echo $this->Ckeditor->textarea('UserEmail.message', array('type' => 'textarea', 'label' => false, 'div' => false, 'style'=>'height:400px', 'class'=>'span6'), array('language'=>'en', 'uiColor'=> '#33CC33'), 'basic');?>
			</div>
		</div>
		<div class="um-button-row">
       
			<?php echo $this->Form->Submit('Send', array('class'=>'btn btn-primary', 'id'=>'sendMailSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>