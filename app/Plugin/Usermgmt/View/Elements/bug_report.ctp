<div class="span 1">
	<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'contactForm', 'submitButtonId' => 'contactSubmitBtn')); ?>
			<div style='padding:10px'>
				<?php echo $this->Form->create('UserContact', array('url'=>array('controller' => 'user_contacts', 'action' => 'contactUs', 'plugin'=>'usermgmt'), 'id'=>'contactForm')); ?>
				
				<?php echo $this->Form->input('username', array('label' => false, 'div' => false, 'placeholder'=>__('Username'), 'title'=>__('Username'))); ?><br/>
				
				<?php echo $this->Form->input('email', array('label' => false, 'div' => false, 'placeholder'=>__('Email'), 'title'=>__('Email'))); ?><br/>
				
				<?php echo $this->Form->input('subject', array('label' => false, 'div' => false, 'style'=>'margin-right:5px; width: 100%;', 'placeholder'=>__('Subject'), 'title'=>__('Subject'))); ?><br/>
				
				<?php echo $this->Form->textarea('body', array('label' => false, 'div' => false, 'style'=>'margin-right:5px; width: 100%; height:500px;', 'placeholder'=>__('Body'), 'title'=>__('Body'))); ?><br/>
				
				<?php echo $this->Form->Submit(__('Submit'), array('id'=>'contactSubmitBtn', 'class'=>'btn btn-primary')); ?>
				<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="bug-report span 4">
	<p><?php echo "Thank you for taking time to submit a report."; ?></p>
	<p><?php echo "If you received an error, please copy/paste it into the box." ?></p>
	<p><?php echo "Otherwise, please describe the problem you encountered the best you can."?></p>
	<p><strong><?php echo "During our beta test period we are especially interested in the following:"?></strong></p>
		<ul>
			<li>SQL injections</li>
			<li>Permissions... Is our admin routing secure?</li>
			<li>Is password scripting secure?</li>
			<li>Validation (empty fields, correct file type, etc...)</li>
			<li>Form tampering</li>
			<li>XSS</li>
			<li>Authentication (logging-in, remaining logged-in, stored password, etc...)</li>
			<li>Broken Links</li>
			<li>Error pages</li>
			<li>Load testing</li>
			<li>Different browsers/platforms</li>
			<li>Simplicity</li>
		</ul>
	<p>A big THANKS to the online community for putting us through the ropes.</p>


</div>
