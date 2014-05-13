<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo h('Trading Post 	'); ?>
		</span>

		<span class="um-panel-title-right">
			<?php 
				if ($userId==$viewedUser['User']['id']){		
					echo $this->Html->link(__('Add Barter', true), '/labs/add');
				}
			?>
		</span>
	</div>


    
    
	<div class="um-panel-content" style="background-image: url('<?php echo $this->Image->resize('img/'.IMG_DIR, $user['UserDetail']['bgphoto'], 800, null, true) ?>');">
    
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
	</div> <!--closes um-panel-content and BG image-->
</div> <!--closes um-panel-->