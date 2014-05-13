<?php

?>
<div>

	<div class="lablogo">
    	
        <?php
        $logo = 'logo.jpg';
		echo $this->Html->Image($logo);
		?>
            <div class="login-logo-subheading">
                <?php echo "this for that";?>
            </div> <!-- <div class="login-logo-subheading"> -->
    </div>


        <div class="labsearch">
        <?php   
            
         echo $this->Form->create('Lab', array(
    'url' => array_merge(array('action' => 'find'), $this->params['pass'])
));

		echo $this->Form->input('search', array('div' => false, 'label'=>false, 'class'=>'span6'));   
        	 $this->Form->input('catalyst', array('type' => 'hidden', 'value'=>1));; ?>
		<div>
		
        
	        <div class = "login-inline">
        
		<?php echo $this->Form->submit(__('Search'), array('div' => false, 'class'=>'button-large button-success pure-button', 'style'=>'padding:2px;'));
		echo $this->Form->end();?>
        	</div>
        
        
        </div>
    
</div>