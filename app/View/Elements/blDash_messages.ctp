				<ul class="nav nav-pills">
					<li class='dropdown'>
						<?php if(!empty($checkEmail)){
							echo $this->Html->link(__($this->Html->image('icons/glyphicon-envelope-new.png')).'<div class="emailNums">'.
								$checkEmail.'</div>', '#', array(
			 													'escape'=>false, 
			 													'class'=>'dropdown-toggle', 
			 													'data-toggle'=>'dropdown'));}
								else{echo $this->Html->link(__($this->Html->image('icons/glyphicon-envelope.png')).' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));}?>
										<ul class='dropdown-menu pull-right'>
											<?php if($this->UserAuth->HP('UserEmails', 'index')) {
												echo "<li>".$this->Html->link(__('Inbox'), array('controller'=>'UserEmails', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
											}
											if($this->UserAuth->HP('UserEmails', 'sent')) {
												echo "<li>".$this->Html->link(__('Sent'), array('controller'=>'UserEmails', 'action'=>'sent', 'plugin'=>'usermgmt'))."</li>";
											} ?>
										</ul>
					</li>
				</ul>
