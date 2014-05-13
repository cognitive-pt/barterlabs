<div class="u-row"> 
	<div class="lab-panel-content">
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
			<div class="tradeinfo pull-left">
				<?php echo __($user['User']['username']);?>         
					<div class="tradenameinfo">
						<?php echo __($user['UserDetail']['tradename']);?>
       				</div>
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
			                            				echo 'Not Currently Active';?></div><?php }?></td>
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
	     