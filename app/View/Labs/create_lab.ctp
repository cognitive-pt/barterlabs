<div class="createLabContainer">
	<?php echo __('Add a new lab') ?>
	<?php echo $this->Form->create('Lab', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>
	<?php
		if($anon==1){ //if the user is anonymous?> 
					<label class="required"><?php echo 'Please enter a contact email';?> </label>
	            			<?php echo $this->Form->input('email', 
	            						array(
	            							'label'=>false, 
	            							'div'=>false, 
	            							'class'=>'span6',
	            							 'placeholder'=>__('Your email will never be displayed, shared or sold.'))); ?>
	            			<p><?php echo $this->Form->Submit('Next', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?></p>
					<?php }?>
						<?php echo $this->Form->end(); ?>
</div>


<?php  /**************************************
       ***************************************
       **************MODALS*******************
       ***************************************
       **************************************/
?>
<?php /***********************Edit Pic Modal****************************/?>
        <div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <div class="pull-right" style="font-size: 15px; font-weight:bold;">   
                <a href="#" data-dismiss="modal">x</a>
              </div>
                <h3 class="modal-title" id="myModalLabel"><?php echo __('Add Anonymous Lab'); ?></h3>
            </div>
            <?php/************************************************************************************************/?>   
            <div class="modal-body">
                
            <p><b>You're almost ready to go!</b> Just a few things before you continue...</p>

            <p>Bartering works best when people get to know you.
            <br/>By registering for free you can:
            	<ul><b>
            		<li>Add multiple barters</li>
            		<li>Track current listings</li>
            		<li>Earn rank as you go</li>
            		<li>Edit listings</li>
            		<li>Include more than one picture</li>
            	</b></ul>
            </p>
            <p> 
            		<?php echo $this->Html->link(__('Sign-up for free!', true), 
                                                    array(
                                                        'controller'=>'Users', 
                                                        'action'=>'register',  
                                                        'plugin'=>'usermgmt'),
                                                    array(
                                                        'div'=>false,
                                                        'class'=>'pure-button button-secondary')
                                                         );?>
            </p>

           
                        
            </div>
            <?php/************************************************************************************************/?>   
            <div class="modal-footer">
                 <a href="#" class="pure-button button-success" data-dismiss="modal">No thanks, I'm good.</a><!-- note the use of "data-dismiss" -->
            </div>
        </div>

<?php if (!$this->UserAuth->isLogged()) {?>	
	<script>
	    $(function(){
	        $('#myModal').modal('show');
	    });
	</script>
<?php }?>