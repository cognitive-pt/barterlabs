
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Type Info') ?>
		</span>
        
        
		<span class="um-panel-title-right">
        
        
        
		<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tradeicon.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Type.id'))); ?>       
        <?php echo " /";?>
        <?php echo $this->Html->link(__('List Types', true),  array('action' => 'index'));?>
		<?php echo " /";?>
		<?php echo $this->Html->link(__('Dashboard', true), '/dashboard');?>
		</span>
	</div>
    
    
		<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editTypeForm', 'submitButtonId' => 'editTypeSubmitBtn')); ?>

		<?php echo $this->Form->create('Type', array('Type' => 'data', 'id'=>'editTypeForm', 'class'=>'form-horizontal')); ?>

		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Type Name');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('name', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
        


		<div class="um-button-row">
			<?php echo $this->Form->Submit('Update', array('class'=>'btn btn-primary', 'id'=>'addIconSubmitBtn')); ?>
		</div>

    	<?php echo $this->Form->end(); ?>
 </div>
</div>




