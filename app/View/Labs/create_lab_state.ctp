<div class="createLabContainer">
	<?php echo __('Select a state') ?>

	<?php echo $this->Form->create('Lab', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>
	<?php echo $this->Form->input('state_id', array(
		        'label' => 'State',
				'class'=>'span2',
		  		'id' => 'state_id',
		        'options' => array(
							'' => 'ALL',
							'State' => $state)
						));?>

	<p><?php echo $this->Form->Submit('Next', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?></p>
	<?php echo $this->Form->end(); ?>
</div>