<!--  NAVBAR - This is the navbar that appears at the top when a guest uses the site  -->

<div class="login-page-container">
	<div class="dashboard-menu">
		<div class="navbar">
	    	<div class="navbar-fixed-top"> 
				<div class="navbar-inner"> 



					<div class="guest-bb">
							<?php 
								echo $this->Html->link($this->Html->image('icons/glyphicon-b.png',
									array(
										'alt'=> 'glyphicon-b.png')), 
									array('controller' => 'Labs', 
										'action' => 'index', 'plugin'=>''), 
									array(
										'class'=>'glyphicon-bb',
										'rel'=>'tooltip',//tooltip init
										'data-placement'=>'bottom', //tooltip placement
										'title'=>'Search Barterlabs', //tooltip text
										'escape' => false));
							

									

							?>


					</div>
						



						<div class="guest-words pull-right">
									<?php echo $this->Html->link(__('Sign In'), 
										array('controller'=>'users',
											'action' => 'login',
											'plugin' => 'usermgmt')); ?>
				 		
									<?php echo ' / '; ?>

				 					<?php echo $this->Html->link(__('Sign Up', true), '/register');?>
				 		
								
						
											<?php echo $this->Html->link('Help', 
												array(
													'controller'=>'pages',
													'action'=>'whoweare',
													'plugin'=>''),
												array('class="guest-help-btn pull-right') 
												);?>
 						</div>



				 	</div>
				</div>
			</div>
		</div>
	</div>

		



