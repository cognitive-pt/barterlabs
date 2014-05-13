
<?php echo $this->Html->script(array('/usermgmt/js/umupdate.js?q='.QRDN)); ?>



<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo h($lab['Lab']['projectname'])?>		
		</span>
    	<span class="um-panel-title-right">
    		<?php if ($viewedUserId == $userId) {
 				echo $this->Html->link(__('Edit'), array('action' => 'editLab', $lab['Lab']['id']));?>
 					<?php echo (' / ');
    			echo $this->Form->postLink(__('Delete'), array('action' => 'deleteLab', $lab['Lab']['id']), null, __('Are you sure you want to delete %s?', $lab['Lab']['projectname']));} 
    			else {
					echo $this->Html->link(__('Contact'), 
						array('controller'=>'Labs','action' => 'passToEmail',$lab['Lab']['id']),
			 			array('class'=>'btn', 'id'=>'contact'));}?>
		</span>
	</div>

           
			<div>
				<?php echo $this->element('voteArrowsElement');?>
			</div>

						
			

			<div class = "labDispPicViewElement">
				<?php echo $this->element('labDispPicViewElement');?>
			</div>

			<div class = "labDetailTableElement">
				<?php echo $this->element('labDetailTableElement');?>
			</div>

			<div class = "labPics">
				<?php echo $this->element('labPics');?>
			</div>

			<div class = "labDescElement">			
				<?php echo $lab['Lab']['labdesc'];?>
			</div> 


	

</div>		



	
