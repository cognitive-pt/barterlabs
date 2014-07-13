<strong><?php echo "This is a list of everything ".$viewedUser['User']['username']." has to barter! Click any image for more info, or to make a trade!"; ?></strong>
	


<div class="pure-g">
	<?php if (!empty($dispics)){?>
	<?php foreach($dispics as $dispic): { ?>

	        <div class="photo-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3">
	<?php //only display a picture if there is a pic assc with the lab

	if (!empty($dispic['Pic']['name'])){

			echo $this->Html->link($this->Html->image('pics/' . $dispic['Pic']['name'], 
				array(
					'alt'=> $dispic['Pic']['tag'])), 
				array('controller' => 'labs', 
					'action' => 'view', $dispic['Pic']['lab_id'],'plugin'=>''), 
		    	array('escape' => false)
		    	);
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
	            <aside class="photo-box-caption">
	                <span>
	            <?php echo $this->Html->link(__($dispic['Pic']['tag'], true), array('controller'=>'Labs', 'action'=>'view',$dispic['Pic']['lab_id'],'plugin'=>''));?>
	                </span>
	            </aside>
	        </div>
	<?php } endforeach;
	} ?>
</div>