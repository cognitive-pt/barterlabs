<div class="u-row"> 
	<div class="lab-panel-content">
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
		
		<div>
			<div class="tradeinfo pull-left">
					<div class="scoreboard" style="margin-bottom:5px;">
						<strong><?php echo "Scoreboard:"?></strong>
					</div>
					<div>
						<?php 
							echo "User: ".$this->Html->link(__($user['User']['username']), 
								array('controller'=>'Users','action' => 'viewUser', $user['User']['id'], 'plugin'=>'usermgmt'));
					 	?>
				 	</div>
					<div class="tradenameinfo">
						<?php echo __($user['UserDetail']['tradename']);?>
       				</div>			
			</div>
			<div class="vote-arrows-chart pull-right">
 				<?php echo $this->element('voteArrowsElement');?>
 			</div>
 		</div>




						<tbody>



									<tr>
										<td><strong><?php echo __('Posted:');?></strong></td>
										<td><?php echo $this->Time->format(
				  							'F jS, Y h:i A',
				  							$lab['Lab']['created']); ?></td>
									</tr>


									<tr>
										<td><strong><?php echo __('Location:');?></strong></td>
										<td><?php echo $town_name.', '.$state_name; ?>
				                        </td>
									</tr>



									<tr>
 										<td>
											<strong>
												<?php echo 'Lab Score:'; ?>
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


									<tr>
			                    		<td><strong><?php echo __('Lab id:');?></strong></td>
			                    		<td><?php echo __($lab['Lab']['id']);?></td>
			                    	</tr>
			                    
			                    	<tr>
			                    		<td><strong><?php echo __('Lab Status:');?></strong></td>
			        					<td><?php if(!empty($lab['Lab']['catalyst']))
					   						{?><div class="labstatus1"><?php
												echo 'Currently Seeking Barters!';?></div><?php }
													else {?> <div class="labstatusnull"><?php
			                            				echo 'Not Currently Active';?></div><?php }?></td>
			                    	</tr>

			                    <tr>
									<td><strong><?php echo __('Member Since:');?></strong></td>
									<td><?php echo $this->Time->format(
			  							'F jS, Y ',
			  							$user['User']['created']); ?></td>
								</tr>
		     		</tbody>
       	</table>
       		<div class="morebarters">
       
					<?php 
						echo $this->Html->link(__("Click here to see more barters from ".$user['User']['username']), 
							array('controller'=>'Users','action' => 'viewUser',$user['User']['id'], 'plugin' => 'usermgmt'));
				 	?>
       		</div>
	</div>

<div style="max-width: 350px;"><strong><div style="margin-left:15px; margin-top:-15px;"><?php echo "Do you like this? Spread the love! Give ".$user['User']['username']." an upvote with the green arrow above!";?></div></strong><div>

</div>