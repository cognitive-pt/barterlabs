<?php if (!empty($user)) { ?>
	<?php  
	//only display a picture if there is a pic assc with the lab
	if (!empty($dispic['Pic']['name'])){
		echo $this->Html->link($this->Html->image('pics/' . $dispic['Pic']['name'], 
		array(
			'alt'=> $dispic['Pic']['tag'], 
			'height'=>'auto', 
			'width'=>'auto')), 
		array('controller' => 'labs', 
			'action' => 'view', $dispic['Pic']['lab_id'],'plugin'=>''), 
		array('escape' => false));
	} 

		else {
			echo "No images to display.";
		} ?>
<?php } ?>
