<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add Pictures') ?>
		</span>
        
        
		<span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Return to your Trading Post', true),  array('controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'usermgmt'));?>
		</span>
	</div>
    
    
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editProfileForm', 'submitButtonId' => 'editProfileSubmitBtn')); ?>

		<?php echo $this->Form->create('Pic', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>
		
         <div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Image File');?></label>
			<div class="controls">
    <?php echo $this->Form->input('name', array('label'=>false, 'div'=>false, 'type' => 'file')); ?>			
    		</div>
        </div>

		<div class="um-form-row control-group">
        <label class="control-label required"><?php echo __('Description');?></label>
            <div class="controls">    
        <?php echo $this->Form->input('Pic.tag', array(
                                                        'label'=>false, 
                                                        'div'=>false,
                                                        'class'=>'span5'));?>
            </div>
        </div>

 	</div>
 </div>
        
   
			<div class="controls" style="padding-bottom:20px;">
				<p><?php echo $this->Form->Submit('Save', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
			</div>
         </div>            

    	<?php echo $this->Form->end(); ?>
	</div>
</div>


