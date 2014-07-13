			<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit ' . $viewLab['Lab']['projectname']) ?>
		</span>
        
        
		<span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Return', true),  array('controller'=>'Labs', 'action'=>'view', $viewLab['Lab']['id'], 'plugin'=>''));?>
		</span>
	</div>
    
    
		<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editProfileForm', 'submitButtonId' => 'editProfileSubmitBtn')); ?>

		<?php echo $this->Form->create('Lab', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>


		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Nearest Location');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('town_id', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
        
        
        <div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Category');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('type_id', array('label'=>false, 'div'=>false)); ?>
        </div>
        </div>
        
        
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Barter Name');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('projectname', array('label'=>false, 'div'=>false, 'class'=>'span9')); ?>
        </div>
		</div>

		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Main Description');?></label>
			<div class="controls">
				<?php  echo $this->Ckeditor->textarea('Lab.labdesc', array('type' => 'textarea', 'label' => false, 'div' => false, 'style'=>'height:400px', 'class'=>'span6'), array('language'=>'en', 'uiColor'=> '#14B8C4'), 'full');?>
			</div>
			</div>
       
       <div class="um-form-row control-group">
			<label class="control-label"><?php echo __('External Link');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('link', array('label'=>false, 'div'=>false, 'class'=>'span5')); ?>
        </div>
		</div>     
          
   
			<div class="controls" style="padding-bottom:20px;">
				<p><?php echo $this->Form->Submit('Save', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
			</div>
         </div>            

    	<?php echo $this->Form->end(); ?>
	</div>
</div>


