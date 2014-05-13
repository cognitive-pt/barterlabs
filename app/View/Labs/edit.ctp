<div class="labs form">
<?php echo $this->Form->create('Lab'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lab'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('projectname');
		echo $this->Form->input('displayphoto');
		echo $this->Form->input('upvote');
		echo $this->Form->input('downvote');
		echo $this->Form->input('labdesc');
		echo $this->Form->input('link');
		echo $this->Form->input('Town');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Lab.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Lab.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Labs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Towns'), array('controller' => 'towns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Town'), array('controller' => 'towns', 'action' => 'add')); ?> </li>
	</ul>
</div>
