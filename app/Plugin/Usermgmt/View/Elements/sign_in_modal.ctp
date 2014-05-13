<?php /*this is the sign-in modal*/ ?>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header"><button class="close" data-dismiss="modal">×</button><h3 class="modal-title" id="myModalLabel"><?php echo __('Login'); ?></h3>
            </div>
            
            <div class="modal-body">
                <?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'loginForm', 'submitButtonId' => 'loginSubmitBtn')); ?>
                <?php echo $this->Form->create('User', array('id'=>'loginForm', 'class'=>'form-horizontal')); ?>
                <div style="padding: 5%; padding-top: 0px;">
                        <p> <?php  $logo = '/img/logo.jpg';
                        echo $this->Html->Image($logo);?> </p>            
                </div>
                            
                <div class="sign-in-ctr"> <!--this is the grey background -->
                    <?php echo $this->Form->input('email', array(
                        'type'=>'text', 
                        'label'=>false, 
                        'div'=>false, 
                        'class'=>'span3',
                        'placeholder'=>__('Email / Username'))); ?>

                    <?php echo $this->Form->input('password', array(
                        'type'=>'password', 
                        'label'=>false, 
                        'div'=>false,
                        'class'=>'span3', 
                        'placeholder'=>__('Password'))); ?>
                    <div class="sign-in-btn">
                        <?php echo $this->Form->Submit('Sign In', array('div'=>false, 'class'=>'button-success pure-button')); ?>
                    </div>
                        <div>
                            <?php if(USE_REMEMBER_ME) { ?>
                            <?php   if(!isset($this->request->data['User']['remember'])) {
                				$this->request->data['User']['remember']=true;} ?>
                				<?php echo __('Remember me!');?>
                					<?php echo $this->Form->input('remember', array('type'=>'checkbox', 'label'=>false, 'div'=>'login-rememberme-margin', 'class'=>'login-rememberme-margin'));}?>
                        </div>
                                <?php echo $this->Html->link(__('Forgot Password?'), 
                                								array('controller'=>'Users', 
                                									  'action'=>'forgotPassword'),
                                								array('class'=>'forgot-password')
                                								   ); ?> 
                                 					<?php echo $this->Html->link(__('Sign Up', true), '/register',
                                 						array('class'=>'forgot-password'));?>
                                                        <?php echo $this->Form->end(); ?>
                </div>    
            </div> <? //end of body div ?>
            
            <div class="modal-footer">
                <a href="#" class="btn" style="color: #000000;" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#myModal').modal('show');
    });
</script>



