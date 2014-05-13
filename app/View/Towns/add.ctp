<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add a Town') ?>
		</span>
        

        
        
		<span class="um-panel-title-right">
        <?php echo $this->Html->link(__('List Towns', true),  array('action' => 'index'));?>
		<?php echo " /";?>
		<?php echo $this->Html->link(__('Dashboard', true), '/dashboard');?>
		</span>
	</div>
    
    
    		<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editTownForm', 'submitButtonId' => 'editTownSubmitBtn')); ?>

		<?php echo $this->Form->create('Town', array('type' => 'data', 'id'=>'editTownForm', 'class'=>'form-horizontal')); ?>

		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Town Name');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('name', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
        
        <div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('State');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('state', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>


    	<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('State Abbreviation');?></label>
			<div class="controls">
    <?php echo $this->Form->input('stateab', array('label'=>false, 'div'=>false)); ?>			
    		</div>
        </div>
 



			<?php echo $this->Form->Submit('Add Town', array('class'=>'btn btn-primary', 'id'=>'addIconSubmitBtn')); ?>


    	<?php echo $this->Form->end(); ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
