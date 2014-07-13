<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __($viewPic['Pic']['name']) ?>
		</span>
        
        
        
        
        <span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Return', true),  array('controller'=>'Posts', 'action'=>'view', $viewPic['Pic']['post_id'], 'plugin'=>''));?>
		</span>
        
        <span class="um-panel-title-right">
  			<?php if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {
			 echo $this->Html->link(__('Edit'), array('action' => 'editPic', $viewPic['Pic']['id']));?>
             
             <?php echo (' / '); ?>
             
             <?php echo $this->Form->postLink(__('Delete'), array('action' => 'deletePic', $viewPic['Pic']['id']), null, __('Are you sure you want to delete %s?', $viewPic['Pic']['name'])); ?>
             
             
        <?php }?>
        </span>
    </div>
    
    
		 <div>
			<?php 
            echo $this->Html->image('barter_blog/pics/' . $viewPic['Pic']['name'], 
            array(
                'alt'=> $viewPic['Pic']['name']));?>
         </div>
</div>
         
         <div>  
			<?php echo __($viewPic['Pic']['tag']) ?>
		 </div>
