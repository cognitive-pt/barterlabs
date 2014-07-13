<div>	 	
		<?php if ($viewedUserId == $userId) {?>
			<div class = "labs-header-editdelete"><?php echo "( This is your lab!! Feel free to ";
		 				echo $this->Html->link(__('Edit'), array('action' => 'editLab', $lab['Lab']['id']));?>
		 					<?php echo (' / ');
		    			echo $this->Form->postLink(__('Delete'), array('action' => 'deleteLab', $lab['Lab']['id']), null, __('Are you sure you want to delete %s?', $lab['Lab']['projectname']));
		    			 		  echo (' / ');
 						echo $this->Html->link(__('Add Pictures'), array('action' => 'addPic', $lab['Lab']['id']))." )";?></div><?php }?> 



		    		


<div class="labs-header-title">
		<span>
			<?php echo $lab['Lab']['projectname'].' '.'('.$town_name.', '.$state_name.')'?>		
		</span>
</div>




    			<div class="labs-header-engage">
    			<?php echo "Want to make a trade? Tap";?>
	    			<?php 
						echo $this->Html->link(__('Engage!'), 
							array('controller'=>'Labs','action' => 'passToEmail',$lab['Lab']['id']),
				 			array('class'=>'pure-button button-large button-success', 'id'=>'contact'));
				 	
				 echo " and barter with ".$user['User']['username']."!"; ?>
			</div>

				


				<div class="new-inline">
					<?php
						if (!empty($labPics)){
						echo $this->element('dynamicLabPics');}
					?>
				</div>

			<div class="labDescView">			
					<?php echo $lab['Lab']['labdesc'];?>
				</div>


			<div style="margin-bottom:0px; margin-left:20px; margin-top 0px;">
    			<?php echo "Tap ";?>
	    			<?php 
						echo $this->Html->link(__('Engage!'), 
							array('controller'=>'Labs','action' => 'passToEmail',$lab['Lab']['id']),
				 			array('class'=>'pure-button button-large button-success', 'id'=>'contact'));
				 	
				 echo " to contact ".$user['User']['username']."!"; ?>
				</div>

			<div class = "labDetailTableElement">
				<?php echo $this->element('labDetailTableElement');?>
			</div>

    			<div class="labs-header-engage" style="margin-bottom:55px;">
    			<?php echo "Want to make a trade? Tap";?>
	    			<?php 
						echo $this->Html->link(__('Engage!'), 
							array('controller'=>'Labs','action' => 'passToEmail',$lab['Lab']['id']),
				 			array('class'=>'pure-button button-large button-success', 'id'=>'contact'));
				 	
				 echo " and barter with ".$user['User']['username']."!"; ?>
				</div>

	</div>
	
</div>
