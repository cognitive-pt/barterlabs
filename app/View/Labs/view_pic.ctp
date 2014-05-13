		<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __($viewPic['Pic']['name']) ?>
		</span>
        
        
        
        
        <span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Return', true),  array('controller'=>'Labs', 'action'=>'view', $viewPic['Pic']['lab_id'], 'plugin'=>''));?>
		</span>
        
        <span class="um-panel-title-right">
  			<?php if ($viewPic['Pic']['user_id'] == $userId) {
			 echo $this->Html->link(__('Edit'), array('action' => 'editPic', $viewPic['Pic']['id']));?>
             
             <?php echo (' / '); ?>
             
             <?php echo $this->Form->postLink(__('Delete'), array('action' => 'deletePic', $viewPic['Pic']['id']), null, __('Are you sure you want to delete %s?', $viewPic['Pic']['name'])); ?>
             
             
        <?php }?>
        </span>


        

	</div>
    
    
		<div class="um-panel-content">

		
         <div class="um-form-row control-group">
			<?php 
            echo $this->Html->image('pics/' . $viewPic['Pic']['name'], 
            array(
                'alt'=> $viewPic['Pic']['name']));?>
         </div>
         
         <div class="um-form-row control-group">
         	
            <div class="picdesc">
					<div class="tradedesctext">   
            
			<?php echo __($viewPic['Pic']['tag']) ?>
        	</div></div>
		</div>
</div>