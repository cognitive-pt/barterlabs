<div class="createLabContainer">
	<?php echo __('Select a town') ?>

	<?php echo $this->Form->create('Lab', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>
	<?php echo $this->Form->input('town_id', array(
		        'label' => 'Town',
				'class'=>'span3',
		  		'id' => 'town_id',
		        'options' => array(
							'' => 'ALL',
							'Town' => $town)
						));?>
	<p><?php echo $this->Form->Submit('Next', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?></p>
	<?php echo $this->Form->end(); ?>
</div>