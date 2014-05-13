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

           
       

			<div class ="vote-arrows">
				
				<?php 								
					echo $this->Html->link($this->Html->image('icons/glyphicon_upvote.png', 
						array(
							'alt'=> 'glyphicon_upvote.png')), 
						array('action' => 'upVote', $lab['Lab']['id']), 
						array(
 							'rel'=>'tooltip',//tooltip init
							'data-placement'=>'bottom', //tooltip placement
							'title'=>'Upvote Lab!', //tooltip text
							'escape' => false));
				?>
				
				<div class="arrow-number">
					<center>
						<?php echo $allLabVotes; ?>
					</center>
				</div>

				<div>
					<?php 
						echo $this->Html->link($this->Html->image('icons/glyphicon_downvote.png', 
							array(
								'alt'=> 'glyphicon_downvote.png')), 
							array('action' => 'downVote', $lab['Lab']['id']), 
							array(
 								'rel'=>'tooltip',//tooltip init
								'data-placement'=>'bottom', //tooltip placement
								'title'=>'Downvote Lab!', //tooltip text
								'escape' => false));
					?>
				</div>
			</div>




            <div class="span4">
			<?php if (!empty($user)) { ?>
				<div class="right" style="height:100%; margin:5px">
					<div class="profile">

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
					

					</div>
				</div>
			<?php } ?>
			</div>
            


		<span class="left">
            <section class="labdesc">
            	<?php echo $lab['Lab']['labdesc'];?>
            </section>
		</span>

<span class="um-panel-title-right">

          	<div class="mainmiddle">


<div class="pictable">
  <div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo 'Pictures';?>
		</span>
        <span class="um-panel-title-right">
          
  			<?php if ($viewedUserId == $userId) {
			 echo $this->Html->link(__('Add'), array('action' => 'addPic', $lab['Lab']['id']));} 			?> 
  		</span>
  </div>
    <?php echo $this->element('labPics');?>
</div>






		<div class="u-row"> 
			<div class="lab-panel-content">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<div class="tradeinfo pull-left">
						<?php echo __($user['User']['username']);?>         
 							<div class="tradenameinfo">
								<?php echo __($user['UserDetail']['tradename']);?>
                   			</div>
 								<tbody>
 									<tr>
				                    	<td><strong><?php echo __('Lab id:');?></strong></td>
				                    	<td><?php echo __($lab['Lab']['id']);?></td>
				                    </tr>
				                    
				                    <tr>
				                    	<td><strong><?php echo __('Status:');?></strong></td>
				        					<td><?php if(!empty($lab['Lab']['catalyst']))
						   					{?><div class="labstatus1"><?php
												echo 'Active';?></div><?php }
 													else {?> <div class="labstatusnull"><?php
				                            			echo 'Not Currently Active';?><?php }?></td>
				                    </tr>
				                    
				                    <tr>
										<td><strong><?php echo __('Location:');?></strong></td>
										<td><?php echo h($townName['Town']['name']) . ', '; ?>
				                        <?php echo h($stateName); ?></td>
									</tr>

				                    <tr>


							


										<td>
											<strong>
												<?php echo 'Lab Level:'; ?>
											</strong>
										</td>
										

										<td>
										<?php echo $allLabVotes; ?>
				                        <?php echo '('; ?>
										<?php echo $allLabUpvotes; ?>
				                        <?php echo '/'; ?>
				                        <?php echo $allLabDownvotes; ?>
				                        <?php echo ')'; ?>
				                        </td>
									</tr>
				                    
				                    <?php if(!empty($lab['Lab']['link']))
						   					{?>
				                    <tr>
				                    	<td><?php echo 'External Link:';?></td>
				                        <td><div class="lablink"><a href="<?php echo h($lab['Lab']['link']); ?>"><?php echo h($lab['Lab']['link']); ?></div> </td>
				                    </tr> <?php }?>
				                    
				                    <tr>
										<td><strong><?php echo __('Launched:');?></strong></td>
										<td><?php echo $this->Time->format(
				  							'F jS, Y h:i A',
				  							$lab['Lab']['created']); ?></td>
									</tr>

				                    <tr>
										<td><strong><?php echo __('Member Since:');?></strong></td>
										<td><?php echo $this->Time->format(
				  							'F jS, Y ',
				  							$user['User']['created']); ?></td>
									</tr>
                     			</tbody>
		       			</table>
					</div>
				</div>
			</div>            
		</div>
	</div>    
</div>