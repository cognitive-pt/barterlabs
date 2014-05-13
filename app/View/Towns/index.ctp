<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Towns') ?>
		</span>
        
        
		<span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Add Town', true),  array('action' => 'add'));?>
		<?php echo " /";?>
		<?php echo $this->Html->link(__('Dashboard', true), '/dashboard');?>
		</span>
	</div>
	<div class="um-panel-content">

	<table cellpadding="4" cellspacing="0" class="table table-striped table-bordered">
	<tr>
    
			<th><?php echo('id'); ?></th>
			<th><?php echo('Town'); ?></th>
			<th><?php echo('State'); ?></th>
			<th><?php echo('Abbreviation'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($towns as $town): ?>
	<tr>
		<td><?php echo h($town['Town']['id']); ?>&nbsp;</td>
		<td><?php echo h($town['Town']['name']); ?>&nbsp;</td>
		<td><?php echo h($town['Town']['state']); ?>&nbsp;</td>
		<td><?php echo h($town['Town']['stateab']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $town['Town']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $town['Town']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $town['Town']['id']), null, __('Are you sure you want to delete # %s?', $town['Town']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>




