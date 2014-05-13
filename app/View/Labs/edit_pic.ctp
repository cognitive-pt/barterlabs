		<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit ' . $viewPic['Pic']['name']) ?>
		</span>
        
        
        
        
        <span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Return', true),  array('controller'=>'Labs', 'action'=>'view', $viewPic['Pic']['lab_id'], 'plugin'=>''));?>
		</span>
        
        <span class="um-panel-title-right">
  			<?php if ($viewPic['Pic']['user_id'] == $userId) {?>
			 
             
             <?php echo $this->Form->postLink(__('Delete'), array('action' => 'deletePic', $viewPic['Pic']['id']), null, __('Are you sure you want to delete %s?', $viewPic['Pic']['name'])); ?>
        <?php }?>
        </span>
	</div>
    </div>
    <?php echo $this->Form->create('Pic'); ?>
		<div class="um-panel-content">
</div>
         <div class="um-form-row control-group">
			<?php 
            echo $this->Html->image('pics/' . $viewPic['Pic']['name'], 
            array(
                'alt'=> $viewPic['Pic']['name']));?>
         </div>
         
         <div class="um-form-row control-group">
         	
             <div class="um-form-row control-group">
            <div class="controls">
            <?php echo $this->Form->input('display', array(
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => array(
            '1' => 'Would you like to use this as the display photo for search results?'
    )
)); ?>
 	</div>
 </div>     
          
            		
                             
	<fieldset>
	   <?php echo $this->Form->input('Pic.tag');?>
	</fieldset>


            <div class="controls" style="padding-bottom:20px;">
                <p><?php echo $this->Form->Submit('Save', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
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



<?php /***********************Edit Pic Modal****************************/?>
        <div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <div class="pull-right" style="font-size: 15px; font-weight:bold;">   
                <?php echo $this->Html->link(__('x', true), array('controller'=>'users', 'action'=>'myprofile', 'plugin'=>'usermgmt'));?>
              </div>
                <h3 class="modal-title" id="myModalLabel"><?php echo __('Edit Picture'); ?></h3>
            </div>
            <?php/************************************************************************************************/?>   
            <div class="modal-body">
                

                        <div class="um-panel">
    <div class="um-panel-header">
        <span class="um-panel-title">
            <?php echo __('Edit ' . $viewPic['Pic']['name']) ?>
        </span>
        
        
        
        
        <span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Return', true),  array('controller'=>'Labs', 'action'=>'view', $viewPic['Pic']['lab_id'], 'plugin'=>''));?>
        </span>
        
        <span class="um-panel-title-right">
            <?php if ($viewPic['Pic']['user_id'] == $userId) {?>
             
             
             <?php echo $this->Form->postLink(__('Delete'), array('action' => 'deletePic', $viewPic['Pic']['id']), null, __('Are you sure you want to delete %s?', $viewPic['Pic']['name'])); ?>
        <?php }?>
        </span>
    </div>
    </div>
    <?php echo $this->Form->create('Pic'); ?>
        <div class="um-panel-content">
</div>
         <div class="um-form-row control-group">
            <?php 
            echo $this->Html->image('pics/' . $viewPic['Pic']['name'], 
            array(
                'alt'=> $viewPic['Pic']['name']));?>
         </div>
         
         <div class="um-form-row control-group">
            
             <div class="um-form-row control-group">
            <div class="controls">
            <?php echo $this->Form->input('display', array(
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => array(
            '1' => 'Would you like to use this as the display photo for search results?'
    )
)); ?>
    </div>
 </div>     
    
                             
    <fieldset>
    <?php echo $this->Form->input('Pic.tag');?>
    </fieldset>


            <div class="controls">
                <p><?php echo $this->Form->Submit('Save', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
            </div>
                <?php echo $this->Form->end(); ?>
            

                    </div>
                </div>


            </div>
            <?php/************************************************************************************************/?>   
            <div class="modal-footer">
                <?php echo $this->Form->Submit('Save', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>

<script>
    $(function(){
        $('#myModal').modal('show');
    });
</script>