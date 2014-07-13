<?php
//this is the drop-down navbar dashboard
?>

	<div class="navbar">
    	<div class="navbar-fixed-top"> 
            <div class="navbar-inner"> <!-- This sets the color -->
            	<div class="bl-login-dash"> <!-- this adds margin to the top & left -->
		            <ul class="nav nav-pills">
		            	<?php echo $this->Html->link($this->Html->image('icons/glyphicon-b.png',
								array(
									'alt'=> 'glyphicon-b.png')), 
								array('controller' => 'Labs', 
									'action' => 'index', 'plugin'=>''), 
								array('escape' => false)); ?>
					</ul>

	               	<?php if (!$this->UserAuth->isLogged()) { ?>
	        			<div class="guest-words pull-left bl-login-dosh">
								<?php echo $this->Html->link(__('Sign In'), 
									array('controller'=>'users',
										'action' => 'login',
										'plugin' => 'usermgmt')); ?>
								<?php echo ' / '; ?>
			 					<?php echo $this->Html->link(__('Sign Up', true), '/register'); ?>
			 			</div>
			 		<?php }?>
			 		
			 		<div class="make-this-disappear">
				 		<?php if ($this->UserAuth->isLogged()) {?>	
				 			<div class="guest-words pull-left bl-login-dosh">	
				 				<?php echo $this->Html->link(__($var['User']['username']), 
										array(
											'controller'=>'Users', 
											'action'=>'myprofile', 
											'plugin'=>'usermgmt'),
										array(
											'rel'=>'tooltip',//tooltip init
											'data-placement'=>'bottom', //tooltip placement
											'title'=>'Your Profile', //tooltip text
												)); ?>
							</div>
						<?php }?>
					</div>	

			 	</div>
			
		<div class="new-inline pull-right bl-dash-btn-group">	
			<div class="navbar-inner-right">
				<div class="betatestmargin"> <!-- this makes it disappear at @media sizes -->
                	<ul class="nav nav-pills pull-right">
						<li class='dropdown'>
							<?php echo $this->Html->link(__('Beta').' <b class="caret"></b>', '#', 
								array(
									'escape'=>false, 
									'rel'=>'tooltip',//tooltip init
									'data-placement'=>'bottom', //tooltip placement
									'title'=>'Beta', //tooltip text
									'class'=>'dropdown-toggle', 
									'data-toggle'=>'dropdown'));
										echo "<ul class='dropdown-menu pull-right'>";
											echo "<li>".$this->Html->link(__('Report Bug!'), 
														array('controller'=>'UserContacts',
															'action'=>'bugReport',
															'plugin'=>'usermgmt'))."</li>";
											echo "<li>".$this->Html->link(__('Contact Us'), 
														array(
															'controller'=>'UserContacts',
															'action'=>'contactUs',
															'plugin'=>'usermgmt'))."</li>";
											echo "<li>".$this->Html->link('Changelog', 
													'http://www.barterlabs.com/CHANGELOG.TXT',
													array('target' => '_blank'))."</li></ul>";?>
						</li>
					</ul>
             	</div>
            </div>
		</div>

			<div class="new-inline pull-right bl-dash-btn-group">				
				<?php echo $this->element('blDash_newLab');?>
				<?php if($this->UserAuth->isLogged()) {
					echo $this->element('blDash_messages');}?>
				<?php echo $this->element('blDash_settings');?>
            </div>
		</div>
	</div>





		<div class="modal hide" id="myModal1" tabindex="-1">
			            <div class="modal-header">
			                 <button class="close" data-dismiss="modal">×</button>
			                <h3 class="modal-title" id="myModalLabel"><?php echo __('Navbar Help'); ?></h3>
			            </div>
			<div class="modal-body">
                	<p> <?php  $logo = '/img/help/help_toolbar_1.png';
                         echo $this->Html->Image($logo);?> </p>

                	<hr>

                	<p> This is the Navbar. It will take you anywhere you need to go inside of Barterlabs.</p>
                	
                	<p><strong>1) </strong>Return to the main search page at any time by tapping on the green "B" in the upper-left.</p>

                	<p><strong>2) </strong>Tap on your Username to return to your profile page. From your profile page you can view all of your current barters (labs), and create the persona you wish to be seen by the whole trading world!</p>

                	<p><strong>3) </strong>Create a new listing by tapping the + icon!</p>

                	<p><strong>4) </strong>Messages are how you interact with other users! When you find someone with whom you'd like to trade, send them a message!</p>

                	<p><strong>5) </strong>All of your account maintenance happens under the gears icon. Tap "Settings" to goto the main account settings page, where you can view and change all of the nitty-gritty options.</p>


			</div>
			  <div class="modal-footer">
			    <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
			  </div>
		</div>

