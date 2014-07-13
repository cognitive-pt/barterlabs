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
        <?php echo $this->Form->input('Pic.tag', array('label'=>false, 'div'=>false));?>
            </div>
        </div>


<div class="um-form-row control-group">
            <div class="controls">
            <?php echo $this->Form->input('display', array(
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => array(
            '1' => 'Use this as the display photo for search results?'
    )
)); ?>
    </div>
 </div>

        
   
			<div class="controls" style="padding-bottom:20px;">
				<?php echo $this->Form->Submit('Save', array('div'=>false, 'class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
			    <?php echo $this->Html->link(__('No pics for now, thanks!', true), 
                                                    array(
                                                        'controller'=>'labs', 
                                                        'action'=>'view', $labId, 
                                                        'plugin'=>''),
                                                    array(
                                                        'div'=>false,
                                                        'class'=>'pure-button button-secondary no-pics-now')
                                                         );?>
               
                
                <p><div class="new-block pull-left"><?php echo "Note: while photos are optional, it is highly recommended that you add at least one!";?></div></p></div>
                <div style="margin-left: 180px;"><?php echo " And remember, you can always add more pictures later."; ?></div>
            </div>
            </div>
      </div>






         </div>            

    	<?php echo $this->Form->end(); ?>
	</div>
</div>