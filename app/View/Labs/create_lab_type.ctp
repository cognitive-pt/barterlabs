<div class="createLabContainer">
	<?php echo __('Select a category') ?>

	<?php echo $this->Form->create('Lab', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>
	<?php echo $this->Form->input('type_id', array(
		        'label' => 'Type',
				'class'=>'span2',
		  		'id' => 'type_id',
		        'options' => array(
							'' => 'ALL',
							'Type' => $type)
						));?>

	<p><?php echo $this->Form->Submit('Next', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?></p>
	<?php echo $this->Form->end(); ?>
</div>