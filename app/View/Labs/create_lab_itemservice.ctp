<div class="createLabContainer">
	<?php echo $this->Form->create('Lab', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>
	<?php echo __('Are you offering an item or a service?') ?>
		<div style="display: block;">
			<?php 
				$options = array('1' => 'Item', '2' => 'Service');
				$attributes = array('legend' => false);
				echo $this->Form->radio('kind', $options, $attributes);
			?>
		</div>
				<p><?php echo $this->Form->Submit('Next', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?></p>
				<?php echo $this->Form->end(); ?>
</div>