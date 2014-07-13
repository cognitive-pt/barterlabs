
    <div style = "margin-left: 25px;">
        <?php echo $this->Html->link(__('View Barters as List'), array('controller'=>'Labs', 'action' => 'allLabs', 'plugin'=>''));?>
        
        <?php echo " / "; ?>
				
		<?php echo $this->Html->link(__('Add Barter', true), '/labs/add');?>
	</div>



    
    

    
<div class="eachlab">
<?php if (!empty($dispics)){?>
<?php foreach($dispics as $dispic): { ?>	
<?php 
		//only display a picture if there is a pic assc with the lab
		if (!empty($dispic['Pic']['name'])){
			echo $this->Html->link($this->Html->image('pics/' . $dispic['Pic']['name'], 
			array(
				'alt'=> $dispic['Pic']['tag'], 
				'height'=>'150', 
				'width'=>'150')), 
			array('controller' => 'labs', 
				'action' => 'view', $dispic['Pic']['lab_id'],'plugin'=>''), 
			array('escape' => false));
		} 
		
			else {
				echo $this->Html->link($this->Html->image('pics/' . 'error.jpg', 
				array(
					'height'=>'150', 
					'width'=>'150'
					)), 
				array('controller' => 'labs', 
					'action' => 'view','plugin'=>''), 
				array('escape' => false));
			}
?>
<?php }?>
<?php endforeach; ?>
<?php }?>
</div>
	
</div> <!--closes um-panel-->