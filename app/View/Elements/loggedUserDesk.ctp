<?php echo $this->Html->script(array('/usermgmt/js/umupdate.js?q='.QRDN)); ?>


<?php if (!empty($readytogoModal)){
	echo $this->element('readytogoModal');
} ?>



<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo $user['User']['username'];?>
				<div>
					<?php
						echo $this->Html->link(__(' (click here to see how your profile looks to other users) '), 
							array(
								'controller'=>'Users', 
								'action' => 'viewUser', $userId,
								'plugin'=>'usermgmt'));?>
				</div>





		</span>
    	<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Edit', true), '/editProfile');?>

			<?php echo ' / '; ?>

				<?php echo "<a class=\"link\" data-toggle=\"modal\" href=\"#myModal\">Help</a>"?>

		</span>
	</div>

	<div class="um-panel-content">
    
  
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
	  <?php echo $this->element('loggedUserLabs'); ?>
	</div>
</div>





		<div class="modal hide" id="myModal" tabindex="-1">
			            <div class="modal-header">
			                 <button class="close" data-dismiss="modal">×</button>
			                <h3 class="modal-title" id="myModalLabel"><?php echo __('User Profile Overview'); ?></h3>
			            </div>
			<div class="modal-body">
                	
                    <p> <?php  $logo = '/img/help/help_toolbar_2.png';
                         echo $this->Html->Image($logo);?> </p>

                    <hr>                  

                    <p><strong>This is your user profile page.</strong> All of your Labs (trade/skill/barter ads) are listed here.</p>

                    <p>You can add as many Labs as you want!</p>

                    <p>Say you have a couch you need to get rid of, click "Add Barter" or the + icon, say a few words, upload a pic
                       and you're ready to go!!</p>

                    <p>Maybe you're a great chef and you'd like to trade cooking lessons for a new fence... click + and share your skill with the world!!</p>

                    <p><strong>There's no limit to how many Labs you can create!</strong></p>

                    <p><strong>Create a new Lab </strong> (trade/barter) by clicking the + icon at the top of the screen at any time to offer a new item or service!</p>
                    
                    <p>It's <strong>THAT</strong> easy!!</p>

                    <p>The <strong>Trading Post</strong> is where you can see all of your current Labs. Click the "Trading Post" link to get a more detailed list of
                    your trades.</p>

                    <p>Your <strong>LabLevel</strong> is a number that represents your success on Barterlabs. If you like what somebody is doing on Barterlabs give them
                    an upvote! Votes help refine relevant search results and weed-away old and sketchy Labs.Show your appreciation for other peoples' hard work by clicking that Upvote button!! Let them know they did a good job!!</p>
                    
                    <p>And as always, <strong>Happy trading!</strong></p>



			</div>
			  <div class="modal-footer">
			    <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
			  </div>
		</div>