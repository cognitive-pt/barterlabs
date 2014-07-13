		<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit ' . $viewPic['Pic']['name']) ?>
		</span>
        
        
        
        
        <span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Return', true),  array('controller'=>'Labs', 'action'=>'view', $viewPic['Pic']['lab_id'], 'plugin'=>''));?>
		</span>
        
        <span class="um-panel-title-right">
  			<?php if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {?>
			 
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
            echo $this->Html->image('barter_blog/pics/' . $viewPic['Pic']['name'], 
            array(
                'alt'=> $viewPic['Pic']['name']));?>
         </div>
         
 </div>     
          
            		
                             
	<fieldset>
	   <?php echo $this->Form->input('Pic.tag', array('class'=>'span5'));?>
	</fieldset>


            <div class="controls" style="padding-bottom:20px;">
                <p><?php echo $this->Form->Submit('Save', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
            </div>

<?php echo $this->Form->end(); ?>
        
	</div>
</div>

