<?php /************* START OF SETTINGS ***************/ ?>
	<ul class="nav nav-pills">
		<li class='dropdown'>
			<?php echo $this->Html->link(__($this->Html->image('img/icons/glyphicon-cog.png')).' <b class="caret"></b>', '#', 
				array(	
					'rel'=>'tooltip',//tooltip init
					'data-placement'=>'bottom', //tooltip placement
					'title'=>'Settings', //tooltip text
					'escape'=>false, 
					'class'=>'dropdown-toggle', 
					'data-toggle'=>'dropdown'));?>
			<ul class='dropdown-menu pull-right'>
				<?php if($this->UserAuth->HP('Users', 'dashboard')){								
						if($this->UserAuth->HP('Labs', 'allLabs')) {
							echo "<li>".$this->Html->link(__('Your Profile'), 
																	array(
																		'controller'=>'Users', 
																		'action' => 'myprofile', 
																		'plugin'=>'usermgmt'))."</li>";}
						if($this->UserAuth->isLogged()) {	
							echo "<li>".$this->Html->link(__("Your Labs"), 
									  array('controller'=>'Labs', 
											'action'=>'allLabs', 
											'plugin'=>''))."</li>";?>
						<hr style="margin: 5px;"> <?php }
					}?>
				
					<li class="dropdown-submenu pull-left">
					    <!--update this link when Help screen is available -->
					    <a tabindex="-1" href="#">Help</a>
			    			<ul class="dropdown-menu"> 
			    				<?php
			    					echo "<li>"."<a tabindex=\"-1\" data-toggle=\"modal\" href=\"#myModal1\">"."Help"."</a>".
										"</li>";
									echo "<li>".$this->Html->link('Frequently Ask Questions', 
										array('controller'=>'faq','action'=>'index','plugin'=>''),
										array('target' => '_blank')).
										"</li>";
									echo "<li>".$this->Html->link('About Us', 
										array('controller'=>'pages','action'=>'thanks','plugin'=>''),
										array('target' => '_blank')).
										"</li>";
									echo "<li>".$this->Html->link(__('Contact Us'), 
											array(
												'controller'=>'UserContacts',
												'action'=>'contactUs',
												'plugin'=>'usermgmt')).
										"</li>";
									echo "<li>".$this->Html->link('Blog', 
										 array('controller'=>'posts','action'=>'index','plugin'=>''),
										 array('target' => '_blank'))."</li>";?>
							</ul>
					</li>
							
							<?php if($this->UserAuth->isLogged()) {?>
								<li class="divider"></li><?php
									echo "<li>".$this->Html->link(__("Settings"), 
										  array('controller'=>'Users', 
												'action'=>'dashboard', 
												'plugin'=>'usermgmt'))."</li>"; }

				if($this->UserAuth->isLogged()) {
						echo "<li>".$this->Html->link(__('Sign Out'), array('controller'=>'Users', 'action'=>'logout', 'plugin'=>'usermgmt'))."</li>";
				}

				if (!$this->UserAuth->isLogged()) { 
						echo "<li>".$this->Html->link(__("Sign In"), 
										  array('controller'=>'Users', 
												'action'=>'login', 
												'plugin'=>'usermgmt'))."</li>";

						echo "<li>".$this->Html->link(__("Sign Up"), 
										  array('controller'=>'Users', 
												'action'=>'register', 
												'plugin'=>'usermgmt'))."</li>";}

						echo "<li>".$this->Html->link('Blog', 
										 array('controller'=>'posts','action'=>'index','plugin'=>''),
										 array('target' => '_blank'))."</li>";?>
												
		</li>
	</ul>