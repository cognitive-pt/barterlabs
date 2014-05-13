<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Types') ?>
		</span>
		<span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Add Type', true),  array('action' => 'add'));?>
		<?php echo " /";?>
		<?php echo $this->Html->link(__('Dashboard', true), '/dashboard');?>
		</span>
	</div>
	<div class="um-panel-content">
	<table cellpadding="4" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo('id'); ?></th>
			<th><?php echo('Name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($types as $type): ?>
	<tr>
		<td><?php echo h($type['Type']['id']); ?>&nbsp;</td>
		<td><?php echo h($type['Type']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $type['Type']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $type['Type']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $type['Type']['id']), null, __('Are you sure you want to delete # %s?', $type['Type']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>




