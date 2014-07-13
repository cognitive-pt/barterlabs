	
	<?php if ($userId==$viewedUser['User']['id']){	?>	

		<div class = "labs-header-editdelete"><?php echo "( This is your profile!! Feel free to ";

						echo $this->Html->link(__('Add a Barter', true), '/labs/add');
							echo (' / ');
		 				echo $this->Html->link(__('Edit Your Profile'), array('controller'=>'Users', 'action' => 'editProfile', $user['User']['id'],'plugin'=>'usermgmt'))." )";?>
		</div>
	<?php }?>






	<div style = "margin-left: 25px;">
		<h2><?php echo "You are viewing ".$viewedUser['User']['username']."'s profile page. "?></h2>
			<div style = "margin-top: -25px; margin-bottom: 25px;">
				<?php echo "From here you can see everything ".$viewedUser['User']['username']." has to trade and other general info.";?> 
			</div>
	</div>	


	<div>
		<?php echo $this->element('userDeskContact');?>
	</div>


	<div class="userDeskPhoto">
		<?php echo $this->element('userDeskPhoto');?>
	</div>
	
	<div class="userDeskDetail"> 
	 	<?php echo $this->element('userDeskDetail');?>
	</div>
 		

</div>
	

	<div class="viewedUserLabs">
 		<?php echo $this->element('viewedUserLabs');?>
 	</div>	