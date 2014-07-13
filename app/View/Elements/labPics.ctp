<?php foreach($labPics as $labPic): ?>
	<div class = "labDispPicViewElementPics">
		<?php 
			echo $this->Html->link($this->Html->image('pics/' . $labPic['Pic']['name'], 
				array(
					'alt'=> $labPic['Pic']['id'], 
					'height'=>'75', 
					'width'=>'75',
					"class"=>"lab-pics-class")), 
				array('controller' => 'labs', 
					'action' => 'viewPic', $labPic['Pic']['id'],'plugin'=>''), 
		    	array('escape' => false)); ?>
	</div>
		<?php endforeach;?>