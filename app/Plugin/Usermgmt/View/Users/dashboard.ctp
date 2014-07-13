<?php

//this is the main screen admin dashboard


?>
<div class="um-panel">

	<div class="um-panel-header">

		<div class="um-panel-title">
			<?php echo __('Dashboard') ?>
            <?php   if ($this->UserAuth->isLogged()) {
			echo __(' --- Hello').' '.h($var['User']['username']); ?>
		</div>
        
        <div class="um-panel-title-right">
				<?php   $lastLoginTime = $this->UserAuth->getLastLoginTime();
				if($lastLoginTime) {
					echo __('Last login ').$lastLoginTime;
					echo "<br/><br/>";
				} ?>        
        </div>

	</div>
    
    
	<div class="um-panel-content with-padding">
    
    
    
    							<!--BEGIN "YOUR USER SETTINGS" GROUP:-->
			<?php if($this->UserAuth->HP('Users', 'myprofile')) {?>
					<strong>
						<?php echo "Your User Settings";?>
                    </strong>
                        <div class="um-button-row" style="margin-bottom:0px;padding-bottom:0px;"> <!--this draws the horizontal line 
            											between dashboard groups-->
                        </div>
					<?php }	?>

		<div class="btn-group">
			<?php if($this->UserAuth->HP('Users', 'myprofile')) {
			    echo $this->Html->link(__('View Profile'), array('controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-lightred'));
			} ?>
			
			<?php if($this->UserAuth->HP('Users', 'editProfile')) {
				echo $this->Html->link(__('Edit Profile'), array('controller'=>'Users', 'action'=>'editProfile', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-dandelion'));
			} ?>
			<?php if($this->UserAuth->HP('Users', 'changePassword')) {
				echo $this->Html->link(__('Change Password'), array('controller'=>'Users', 'action'=>'changePassword', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-green'));
			} ?>
        </div>
        <br />

 
            

        <div class="btn-group">
            <?php if($this->UserAuth->HP('Labs', 'allLabs')) {
				echo $this->Html->link(__('View Your Barters'), array('controller'=>'Labs', 'action'=>'allLabs', 'plugin'=>''), array('class'=>'btn btn-primary-mtrench'));
			} ?>
		</div>

            
        <div class="btn-group">    
			<?php if($this->UserAuth->HP('UserEmails', 'index')) {
				echo $this->Html->link(__('Messages'), array('controller'=>'UserEmails', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-pink'));
			} ?>
			
			<?php if($this->UserAuth->HP('UserEmails', 'sent')) {
				echo $this->Html->link(__('Sent Messages'), array('controller'=>'UserEmails', 'action'=>'sent', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-purple'));
			} ?>
		</div>
	<br/>

		<div class="btn-group">
			<?php if(ALLOW_DELETE_ACCOUNT && $this->UserAuth->HP('Users', 'deleteAccount')) {
				echo $this->Form->postLink(__('Delete Account'), array('controller'=>'Users', 'action'=>'deleteAccount', 'plugin'=>'usermgmt'), array('escape' => false, 'class'=>'btn btn-primary-lightgrey', 'confirm' => __('Are you sure you want to delete your account?')));
			} ?>
		</div>
	<br />

							<!--END "YOUR USER SETTINGS" GROUP-->



							<!--START "BETA TEST" GROUP-->
			<?php if($this->UserAuth->HP('Users', 'myprofile')) {?>
				<div style="margin-top:25px;">
                <strong>
					<?php echo "Beta Test Menu - Barterlabs ".$VERSION_NUMBER;?>
                </strong>
                			<div class="um-button-row" style="margin-bottom:0px;padding-bottom:0px;"><!--this draws the horizontal line 
            											between dashboard groups-->
                       		</div>
					<?php }?>
							
		<div class="btn-group">					
			<?php if($this->UserAuth->HP('Users', 'myprofile')) {
				echo $this->Html->link(__('Report Bug!'), 
					array(
						'controller'=>'UserContacts',
						'action'=>'bugReport',
						'plugin'=>'usermgmt'), 
					array(
						'class'=>'btn btn-primary-wordperfect'));
			} ?>
		</div>
    
            <br />
							<!--END "BETA TEST" GROUP-->




							<!-- BEGIN "BARTERLABS ADMIN" GROUP-->
			<?php if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {?>
                <strong>
					<?php echo "Barterlabs Admin";?>
                </strong>
                        <div class="um-button-row"> <!--this draws the horizontal line 
            											between dashboard groups-->
                        </div>
					<?php }?>
							<!--place buttons in here:-->
		<div class="btn-group">
			<?php if($this->UserAuth->HP('UserSettings', 'index')) {
				echo $this->Html->link(__('All Settings'), array('controller'=>'UserSettings', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-riisetiel'));
			} ?>
		</div>

		<div class="btn-group">
			<?php if($this->UserAuth->HP('UserSettings', 'analytics')) {
				echo $this->Html->link(__('Analytics'), array('controller'=>'UserSettings', 'action'=>'analytics', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-skagitorange'));
			} ?>
		</div>

		<div class="btn-group">
			<?php if($this->UserAuth->HP('Users', 'online')) {
				echo $this->Html->link(__('Online Users'), array('controller'=>'Users', 'action'=>'online', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-lightred '));
			} ?> 
		</div>

		<br/>

			

		       <div class="btn-group">
            			<?php if($this->UserAuth->HP('UserContacts', 'index')) {
				echo $this->Html->link(__('Admin Inbox'), array('controller'=>'UserContacts', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-lightred'));
			} ?>
		</div>

		<div class="btn-group">
            			<?php if($this->UserAuth->HP('UserContacts', 'index')) {
				echo $this->Html->link(__('Beta Inbox'), array('controller'=>'UserContacts', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-purple'));
			} ?>
		</div>

		<br />

		<div class="btn-group">
            <?php if($this->UserAuth->HP('Contents', 'addPage')) {
				echo $this->Html->link(__('Add Page'), array('controller'=>'Contents', 'action'=>'addPage', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-mtrench'));
			} ?>
			<?php if($this->UserAuth->HP('Contents', 'index')) {
				echo $this->Html->link(__('All Pages'), array('controller'=>'Contents', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-dandelion'));
			} ?>
        </div>
       
            
         <br />

        <div class="btn-group">
            <?php if($this->UserAuth->HP('Towns', 'index')) {
				echo $this->Html->link(__('List Towns'), array('controller'=>'Towns', 'action'=>'index', 'plugin'=>''), array('class'=>'btn btn-primary-msblue'));
			} ?>
			<?php if($this->UserAuth->HP('Towns', 'add')) {
				echo $this->Html->link(__('Add Town'), array('controller'=>'Towns', 'action'=>'add', 'plugin'=>''), array('class'=>'btn btn-primary-wordperfect'));
			} ?>
        </div>    
        
        <br />    

		<div class="btn-group">            
            <?php if($this->UserAuth->HP('Types', 'index')) {
				echo $this->Html->link(__('List Trade Types'), array('controller'=>'Types', 'action'=>'index', 'plugin'=>''), array('class'=>'btn btn-primary-mtrench'));
			} ?>
			<?php if($this->UserAuth->HP('Types', 'add')) {
				echo $this->Html->link(__('Add Trade Type'), array('controller'=>'Types', 'action'=>'add', 'plugin'=>''), array('class'=>'btn btn-primary-purple'));
			} ?>
		</div>
      <br />
								<!--END "BARTERLABS ADMIN" GROUP-->

								<!--START "GENERAL USERS ADMIN" GROUP-->
			<?php if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {?>
                <strong>
					<?php echo "General Users Admin";?>
                </strong>
                			<div class="um-button-row"> <!--this draws the horizontal line 
            											between dashboard groups-->
                        	</div>
					<?php }?>
							<!--place buttons in here:-->
		<div class="btn-group">
			<?php if($this->UserAuth->HP('Users', 'index')) {
				echo $this->Html->link(__('All Users'), array('controller'=>'Users', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-mtrench'));
			} ?>
    	</div>



		<div class="btn-group">
			<?php if($this->UserAuth->HP('Users', 'addUser')) {
				echo $this->Html->link(__('Add User'), array('controller'=>'Users', 'action'=>'addUser', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-pink'));
			} ?>
			<?php if($this->UserAuth->HP('Users', 'addMultipleUsers')) {
				echo $this->Html->link(__('Add Multiple Users'), array('controller'=>'Users', 'action'=>'addMultipleUsers', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-riisetiel'));
			} ?>
    	</div>
	<br />

		<div class="btn-group">
			<?php if($this->UserAuth->HP('UserGroupPermissions', 'index')) {
				echo $this->Html->link(__('Permissions'), array('controller'=>'UserGroupPermissions', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-dandelion'));
			} ?>
			<?php if($this->UserAuth->HP('UserGroupPermissions', 'subPermissions')) {
				echo $this->Html->link(__('Subgroup Permissions'), array('controller'=>'UserGroupPermissions', 'action'=>'subPermissions', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-skagitorange'));
			} ?>
        </div> 


        <div class="btn-group">
            <?php if($this->UserAuth->HP('UserGroups', 'addGroup')) {
				echo $this->Html->link(__('Add Group'), array('controller'=>'UserGroups', 'action'=>'addGroup', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-msblue'));
			} ?>
			<?php if($this->UserAuth->HP('UserGroups', 'index')) {
				echo $this->Html->link(__('All Groups'), array('controller'=>'UserGroups', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-mtrench'));
			} ?>


        </div>    
        <br />
							<!--END "GENERAL USERS ADMIN" GROUP-->




							<!--START "CakePHP ADMIN" GROUP-->
			
			<?php if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {?>
                <strong>
					<?php echo "CakePHP Admin";?>
                </strong>
                        <div class="um-button-row"> <!--this draws the horizontal line 
            											between dashboard groups-->
                        </div>
					<?php }?>
						<!--place buttons in here:-->
		<div class="btn-group">
			<?php if($this->UserAuth->HP('UserSettings', 'cakelog')) {
				echo $this->Html->link(__('Cake Logs'), array('controller'=>'UserSettings', 'action'=>'cakelog', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-lightred '));
			} ?>
			<?php if($this->UserAuth->HP('Users', 'deleteCache')) {
				echo $this->Html->link(__('Delete Cache'), array('controller'=>'Users', 'action'=>'deleteCache', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-skagitorange'));
			} ?>
		</div>            
	
		<div class="btn-group">
			
			<?php if($this->UserAuth->HP('UserEmailTemplates', 'index')) {
				echo $this->Html->link(__('Email Templates'), array('controller'=>'UserEmailTemplates', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-mtrench'));
			} ?>
			<?php if($this->UserAuth->HP('UserEmailSignatures', 'index')) {
				echo $this->Html->link(__('Email Signatures'), array('controller'=>'UserEmailSignatures', 'action'=>'index', 'plugin'=>'usermgmt'), array('class'=>'btn btn-primary-riisetiel'));
			} ?>
			
		</div>
								<!--END CakePHP ADMIN-->
		<?php }?>
	</div>
</div>