	 	<div class="u-row"> 
	 		<div class="lab-panel-content">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
           			<div class="tradeinfo">
                    <div class="scoreboard" style="margin-bottom:5px;">
                        <strong><?php echo "Scoreboard:"?></strong>
                    </div>


						<?php echo $user['User']['username'];?>         
 							<div class="tradenameinfo">
									<?php echo __($user['UserDetail']['tradename']);?>
                   		 	</div>

        						<tbody>
										<tr> 
											<td><?php echo "Lab Score: "?></td>
            					        	<td><?php echo $this->element('votecounter');?></td>
            					        </tr>
            					        
            					        
            					        
            					        <tr>
											<td><strong><?php echo __('Member Since:');?></strong></td>
											<td><?php echo $this->Time->format(
  												'F jS, Y ',
  												$user['User']['created']); ?></td>
										</tr>
 								</tbody>
 					</div>			
       			</table>		
			</div>
		</div>