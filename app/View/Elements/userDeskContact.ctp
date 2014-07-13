    			<div class="labs-header-engage">
    			<?php echo "Want to trade with ".$viewedUser['User']['username']."? Click";?>
	    			<?php 
						echo $this->Html->link(__('Engage!'), 
							array('controller' => 'UserEmails', 
								  'action' => 'send', 
								   $user['User']['id'], 
								  'plugin'=>'usermgmt'),
				 			array('class'=>'pure-button button-large button-success', 'id'=>'contact'));
echo " and barter with ".$user['User']['username']."!";
?>