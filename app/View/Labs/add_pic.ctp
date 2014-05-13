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
				<p><?php echo $this->Form->Submit('Save', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
			</div>
         </div>            

    	<?php echo $this->Form->end(); ?>
	</div>
</div>


<?php  /**************************************
       ***************************************
       **************MODALS*******************
       ***************************************
       **************************************/
?>



<?php /***********************Add Pic Modal****************************/?>
        <div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <div class="pull-right" style="font-size: 15px; font-weight:bold;">   
                <?php echo $this->Html->link(__('x', true), array('controller'=>'users', 'action'=>'myprofile', 'plugin'=>'usermgmt'));?>
              </div>
                <h3 class="modal-title" id="myModalLabel"><?php echo __('Add Picture'); ?></h3>
            </div>
            <?php/************************************************************************************************/?>   
            <div class="modal-body">
                
                <div class="um-panel">
                    

                    <div class="um-panel-content" style="border-top: 3px solid #CCCCCC;">

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
                        </div>
                 </div> 


        
            
   

            </div>
            <?php/************************************************************************************************/?>   
            <div class="modal-footer">
                <?php echo $this->Form->Submit('Add Photo', array('class'=>'pure-button button-success pull-left', 'id'=>'editProfileSubmitBtn')); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>








<script>
    $(function(){
        $('#myModal').modal('show');
    });
</script>