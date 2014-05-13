<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('View Type') ?>
		</span>
		<span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $type['Type']['id'])); ?> 
        <?php echo " /";?>
		<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $type['Type']['id']), null, __('Are you sure you want to delete # %s?', $type['Type']['id'])); ?> 
        <?php echo " /";?>
        <?php echo $this->Html->link(__('Add New Type', true),  array('action' => 'add'));?>
        <?php echo " /";?>
		<?php echo $this->Html->link(__('List Types'), array('action' => 'index')); ?>
		<?php echo " /";?>
		<?php echo $this->Html->link(__('Dashboard', true), '/dashboard');?>
		</span>
	</div>
	<div class="um-panel-content">
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
			<tbody>
					<tr>
						<td><strong><?php echo __('Type Id:');?></strong></td>
						<td><?php echo h($type['Type']['id']); ?></td>
					</tr>
                    <tr>
						<td><strong><?php echo __('Name:');?></strong></td>
						<td><?php echo h($type['Type']['name']); ?></td>
					</tr>
	
			</tbody>
		</table>
	</div>
</div>

