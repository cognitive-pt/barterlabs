<?php echo $this->Html->script(array('/usermgmt/js/umupdate.js?q='.QRDN)); ?>


<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo h($viewedUser['User']['username'])?>
		</span>

		<span class="um-panel-title-right">
	        <?php if ($viewedUser['User']['id']!=$userId){
	 			echo $this->Html->link(__('Contact'),
					array('controller' => 'UserEmails', 
						  'action' => 'send', 
						  $user['User']['id'], 
						  'plugin'=>'usermgmt'),
				 	array('class'=>'btn', 
				 	      'id'=>'contact'));} ?>
		</span>
	</div>

    
	<div class="um-panel-content" style="background-image: url('<?php echo $this->Image->resize('img/'.IMG_DIR, $viewedUser['UserDetail']['bgphoto'], 800, null, true) ?>');">
    
    
  	
		<div class="u-row"> 
			<div class="lab-panel-content">



				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
           			<div class="tradeinfo">
						<?php echo __($user['User']['username']);?>         
                    		
                    		<div class="tradenameinfo">
									<?php echo __($user['UserDetail']['tradename']);?>
                   		 	</div>

        						<tbody>
										<tr> 
											<td><?php echo "LabLevel: "?></td>
            					        	<td><?php echo $this->element('votecounter');?></td>
            					        </tr>
            					        
            					        <tr> 
											<td><?php echo "Location: "?></td>
            					        	<td><?php echo $state;?></td>
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



        
				<?php if (!empty($user)) { ?>
					<div class="right" style="height:100%; margin:5px">
						<div class="profile">
							<img alt="<?php echo h($user['User']['username']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $user['UserDetail']['photo'], 250, null, true) ?>">
						</div>
					</div>
				<?php } ?>
			</div>
    
    
           

		<?php echo $this->element('viewedUserLabs');?>

	</div>
</div>