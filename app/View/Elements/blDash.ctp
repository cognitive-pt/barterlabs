<?php
//this is the drop-down navbar dashboard
?>
<?php
$contName = Inflector::camelize($this->params['controller']);
$actName = $this->params['action'];
$actionUrl = $contName.'/'.$actName;
$activeClass='active';
$inactiveClass='';
?>

<div class="dashboard-menu">
	<div class="navbar">
    	<div class="navbar-fixed-top"> 
    	 
		 <div class="navbar-inner"> 
		 	<div class="navbar-inner-bye"> 
			<div class="navbar-inner-left">
            <ul class="nav nav-pills">  
            	
			<?php

						echo "<li class='".(($actionUrl=='Labs/index') ? $activeClass : $inactiveClass)."'>".
							$this->Html->link($this->Html->image('icons/glyphicon-b.png', 
									array(
										'alt'=> 'glyphicon-b.png')), 
									array('controller' => 'Labs', 
										'action' => 'index', 'plugin'=>''), 
									array(
										
										'rel'=>'tooltip',//tooltip init
										'data-placement'=>'bottom', //tooltip placement
										'title'=>'Search Barterlabs', //tooltip text
										'escape' => false))."</li>";
				
				 if ($this->UserAuth->isLogged()) {		
					echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__($var['User']['username']), 
							array(
								'controller'=>'Users', 
								'action'=>'myprofile', 
								'plugin'=>'usermgmt'),
							array(
								'rel'=>'tooltip',//tooltip init
								'data-placement'=>'bottom', //tooltip placement
								'title'=>'Your Profile', //tooltip text
									))."</li>"; }?>


								</div>
							</ul>
                		</div>
				
                <div class="navbar-inner">
                	<ul class="nav nav-pills">
                		<?php // echo $this->element('navbarSearch'); ?>
 					</ul>

			<div class="navbar-inner-right">
				<div class="betatestmargin">
                	<ul class="nav nav-pills pull-right">

						<?php echo "<li class='dropdown'>";
						echo $this->Html->link(__('Beta').' <b class="caret"></b>', '#', 
							array(
								'escape'=>false, 

								'rel'=>'tooltip',//tooltip init
								'data-placement'=>'bottom', //tooltip placement
								'title'=>'Beta', //tooltip text
								'class'=>'dropdown-toggle', 
								'data-toggle'=>'dropdown'));
						
						echo "<ul class='dropdown-menu pull-right'>";


							echo "<li class='".(($actionUrl=='UserContacts/bugReport') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Report Bug!'), 
										array('controller'=>'UserContacts',
											'action'=>'bugReport',
											'plugin'=>'usermgmt')).
									"</li>";

							echo "<li class='".(($actionUrl=='UserContacts/contactUs') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Contact Us'), 
										array(
											'controller'=>'UserContacts',
											'action'=>'contactUs',
											'plugin'=>'usermgmt')).
									"</li>";

							echo "<li>".$this->Html->link('Changelog', 
									'http://www.barterlabs.com/CHANGELOG.TXT',
									array('target' => '_blank')).
									"</li>";
							?>
					</ul>
             	</div>
            </div>

            	<div class="display-none-bl">
            		<div class="navbar-inner-right">
            				
                		<ul class="nav nav-pills"><?php
                			echo "<li class='".(($actionUrl=='Labs/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link($this->Html->image('icons/glyphicon-b.png', 
									array(
										'alt'=> 'glyphicon-b.png')), 
									array('controller' => 'Labs', 
										'action' => 'index', 'plugin'=>''), 
									array('escape' => false))."</li>"; ?>

                		</ul>
 	               	
    				</div>
                </div>
				
				<?php
				
				if($this->UserAuth->isLogged()) {?>
					

				
			<div class="navbar-inner-right pull-right">				
                <ul class="nav nav-pills">

                

                	<?php /************ START OF NEW LAB ***********/ ?>
					<li class='dropdown'>
						<?php echo "<li class='".(($actionUrl=='Labs/new') ? $activeClass : $inactiveClass)."'>".$this->Html->link($this->Html->image('icons/glyphicon-circleplus.png', 
								array(
									'alt'=> 'glyphicon-circleplus.png')), 
								array(
									'controller' => 'Labs', 
									'action' => 'add', 'plugin'=>''), 
								array(
									'rel'=>'tooltip',//tooltip init
									'data-placement'=>'bottom', //tooltip placement
									'title'=>'New Lab!', //tooltip text
									'escape' => false,
									))."</li>";?>
					<?php /************ END OF NEW LAB ***********/ ?>



					<?php /************ START OF MESSAGES ***********/ ?>
					<li class='dropdown'>
						<?php if(!empty($checkEmail)){
							echo $this->Html->link(__($this->Html->image('icons/glyphicon-envelope-new.png')).' 

											<div class="emailNums">'.
												$checkEmail	
											.'</div>
										', '#', array(
 													'escape'=>false, 
 													'class'=>'dropdown-toggle', 
 													'data-toggle'=>'dropdown'));?>

							<?php } 

								else{echo $this->Html->link(__($this->Html->image('icons/glyphicon-envelope.png')).' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));}
						


						echo "<ul class='dropdown-menu pull-right'>";
							if($this->UserAuth->HP('UserEmails', 'index')) {
								echo "<li class='".(($actionUrl=='UserEmails/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Inbox'), array('controller'=>'UserEmails', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}

							if($this->UserAuth->HP('UserEmails', 'sent')) {
								echo "<li class='".(($actionUrl=='UserEmails/sent') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Sent'), array('controller'=>'UserEmails', 'action'=>'sent', 'plugin'=>'usermgmt'))."</li>";
							}
						echo "</ul>";
					echo "</li>";
						/************* END OF MESSAGES ***************/?>




					<?php /************* START OF SETTINGS ***************/
					echo "<li class='dropdown'>";
						echo $this->Html->link(__($this->Html->image('icons/glyphicon-cog.png')).' <b class="caret"></b>', '#', 
							array(
								
								'rel'=>'tooltip',//tooltip init
								'data-placement'=>'bottom', //tooltip placement
								'title'=>'Settings', //tooltip text
								'escape'=>false, 
								'class'=>'dropdown-toggle', 
								'data-toggle'=>'dropdown'));
						

						echo "<ul class='dropdown-menu pull-right'>";
							if($this->UserAuth->HP('Users', 'dashboard')){								


							if($this->UserAuth->HP('Labs', 'allLabs')) {
								echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Your Profile'), array('controller'=>'Users', 'action' => 'myprofile', 'plugin'=>'usermgmt'))."</li>";
							}

							echo "<li class='".(($actionUrl=='Users/dashboard') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__("Your Labs"), 
									  array('controller'=>'Labs', 
											'action'=>'allLabs', 
											'plugin'=>''))."</li>"; 
						    }

								?>

									
									
									<hr style="margin: 5px;">
										<li class="dropdown-submenu pull-left">
										    <!--update this link when Help screen is available -->
										    <a tabindex="-1" href="#">Help</a>
								    			<ul class="dropdown-menu"> 



		    				<?php //TODO: CHANGE 'Users','myprofle' below  to 'help' or whatever
		    					  //as soon as there are pages to link to


		    					echo "<li>"."<a tabindex=\"-1\" class=\"btn\" data-toggle=\"modal\" href=\"#myModal1\">Help</a>".
									"</li>";

								echo "<li>".$this->Html->link('About Us', 
									array('controller'=>'pages','action'=>'thanks','plugin'=>''),
									array('target' => '_blank')).
									"</li>";

								echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Contact Us'), 
										array(
											'controller'=>'UserContacts',
											'action'=>'contactUs',
											'plugin'=>'usermgmt')).
									"</li>";

								echo "<li>".$this->Html->link('Blog', 
									 array('controller'=>'posts','action'=>'index','plugin'=>''),
									 array('target' => '_blank')).
										"</li>";?>

						</li>
					</ul>
							
							<li class="divider"><?php
						
							if($this->UserAuth->HP('Users', 'dashboard')) {
								echo "<li class='".(($actionUrl=='Users/dashboard') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__("Settings"), 
									  array('controller'=>'Users', 
											'action'=>'dashboard', 
											'plugin'=>'usermgmt'))."</li>"; 
							}
							if($this->UserAuth->isLogged()) {
					echo "<li>".$this->Html->link(__('Sign Out'), array('controller'=>'Users', 'action'=>'logout', 'plugin'=>'usermgmt'))."</li>";
				} else {
					echo "<li class='".(($actionUrl=='Users/login') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Sign In'), array('controller'=>'Users', 'action'=>'login', 'plugin'=>'usermgmt'))."</li>";
				} 	
						echo "</ul>";
					echo "</li>";}?>
					</div>
				</ul>
							



            </div>
		</div>
	</div>



<script>
    $('[rel="tooltip"]').tooltip('toggle')
    $('[rel="tooltip"]').tooltip('hide');   
</script>



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
                	
                	<p><strong>1) </strong>Return to the main search page at any time by clicking on the green "B" in the upper-left.</p>

                	<p><strong>2) </strong>Click on your Username to return to your profile page. From your profile page you can view all of your current barters (labs), and create the persona you wish to be seen by the whole trading world!</p>

                	<p><strong>3) </strong>Create a new listing by clicking the + icon!</p>

                	<p><strong>4) </strong>Messages are how you interact with other users! When you find someone with whom you'd like to trade, send them a message!</p>

                	<p><strong>5) </strong>All of your account maintenance happens under the gears icon. Click "Settings" to goto the main account settings page, where you can view and change all of the nitty-gritty options.</p>


			</div>
			  <div class="modal-footer">
			    <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
			  </div>
		</div>

