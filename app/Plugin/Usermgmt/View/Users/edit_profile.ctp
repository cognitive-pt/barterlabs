<?php /*THIS IS THE ONE WE USE*/	

if (!empty($editProfileModal)){
	echo $this->element('editProfileNewUserModal');
}

?>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Profile') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'myprofile'));?>
			
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editProfileForm', 'submitButtonId' => 'editProfileSubmitBtn')); ?>
		<?php echo $this->Form->create('User', array('type' => 'file', 'id'=>'editProfileForm', 'class'=>'form-horizontal')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<?php echo $this->Form->hidden('UserDetail.id'); ?>
		<?php $changeUserName = (ALLOW_CHANGE_USERNAME) ? false : true; ?>


	
		

		<div class="um-form-row control-group" style="color:#003D4C;font-size:14px;font-weight:bold;">
			<?php echo "Personalize your experience and tell us a little about yourself!";?>
		</div>
        
        
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Email');?></label>
			<div class="controls">
				<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
        
        
        


		<div class="um-form-row control-group">
        	<label class="control-label required"><?php echo __('Tagline');?></label>
            <div class="controls">
            	<?php echo $this->Form->input('UserDetail.tradename', array('label'=>false, 'div'=>false));?>
            	<div style="color:#003D4C;font-size:10px;display:inline-block;">
            		<?php echo "ex: Joe's Fishing; Seagulls-R-We; I heart Bikes; Barterlabs.com";?>
            	</div>
            </div>
         </div>
        
        
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('User Photo');?></label>
			<div class="controls">
				<?php echo $this->Form->input('UserDetail.photo', array('label'=>false, 'div'=>false, 'type' => 'file')); ?>
				<div style="color:#003D4C;font-size:10px;">
            		<?php echo "This is the picture people will see when they visit your profile page.";?>
            	</div>
			</div>
		</div>
        
        
        	


	    <div>
			<div class="um-button-row">
				<?php echo $this->Form->Submit('Update Profile', array('class'=>'pure-button button-success', 'id'=>'editProfileSubmitBtn')); ?>
				<?php echo $this->Form->end(); ?>
			

						<div class="pull-right">
							<div class="editProfileHelpBtn" style="margin-top: -20px;">
								<strong><?php echo "<a class=\"btn\" data-toggle=\"modal\" href=\"#myModal\">Help</a>"?></strong>
							</div>
						</div>
						
	 		</div>
	 	</div>
 	</div>
</div>


				
				
	 	
 	</div>
</div>

			</div>
			
		</div>





<?php /***********************Help Modal****************************/?>
		<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			            <div class="modal-header">
			                 <button class="close" data-dismiss="modal">×</button>
			                <h3 class="modal-title" id="myModalLabel"><?php echo __('User Profile Help'); ?></h3>
			            </div>
			<div class="modal-body">
                	<p>Adding flare and content to you profile will help potential barterers get an idea who you are!</p>

                	<p>Bartering is all about building connections with people in the real world, so you'll increase your chances of success by building a well-rounded profile. The more you share yourself, the more trust you will build in the community!</p>

                	<p><strong>Tagline:</strong> This appears directly after your username on the profile page. Think of it as a sub-heading for your main title. Many people use this space for their business name or a catchy phrase.</p>

 					<p><strong>State:</strong> We made a conscious decision to narrow search results based on user-inputed location instead of GPS or IP located positioning. User sercurity and privacy are important to everyboy these days. Unfortunately this means the user (you) needs to make a few extra clicks. The benefit, however, is that nobody knows exactly where you are. Nobody should have access to your location unless you want them to have it.</p>
 					
                	<p>During our beta test, Barterlabs is available only in the United States. If there is a specific location you would like added to our database, please take a moment to fill out the "Contact Us" form!</p>

                	<p><strong>User Photo:</strong> Give the world what it wants! Hook em' up with a profile photo. This can be a picture of yourself, your organization or a cat. Whatever you feel represents who you are.</p>
                	
                	<p><strong>Landscape Photo:</strong> This is something that might disappear in future versions, but
                	for now you can decorate your background with something nice. Let us know what you think of the background image feature by using the "Contact Us" form.</p>
			</div>
			  <div class="modal-footer">
			    <strong><a class="pure-button button-primary pull-left" data-dismiss="modal" data-toggle="modal" href="#myModal2">Close</a><!-- note the use of "data-dismiss" -->
			  </div>
		</div>


<script>
    $(function(){
        $('#myModal2').modal('show');
    });
</script>

