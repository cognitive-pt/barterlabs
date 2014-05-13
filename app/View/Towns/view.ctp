<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('View Town') ?>
		</span>
     
		<span class="um-panel-title-right">
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $town['Town']['id'])); ?> 
        <?php echo " /";?>
		<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $town['Town']['id']), null, __('Are you sure you want to delete # %s?', $town['Town']['id'])); ?> 
        <?php echo " /";?>
        <?php echo $this->Html->link(__('Add New Town', true),  array('action' => 'add'));?>
        <?php echo " /";?>
		<?php echo $this->Html->link(__('List Towns'), array('action' => 'index')); ?>
		<?php echo " /";?>
		<?php echo $this->Html->link(__('Dashboard', true), '/dashboard');?>
		</span>
	</div>
	<div class="um-panel-content">

		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">

			<tbody>
					<tr>
						<td><strong><?php echo __('Town Id:');?></strong></td>
						<td><?php echo h($town['Town']['id']); ?></td>
					</tr>
                    
                    <tr>
						<td><strong><?php echo __('Name:');?></strong></td>
						<td><?php echo h($town['Town']['name']); ?></td>
					</tr>
                    
					<tr>
						<td><strong><?php echo __('State:');?></strong></td>
						<td><?php echo h($town['Town']['state']); ?></td>
					</tr>                    
                    
                    <tr>
						<td><strong><?php echo __('Abbreviation:');?></strong></td>
						<td><?php echo h($town['Town']['stateab']); ?></td>
					</tr>

					
			</tbody>
		</table>
	</div>
</div>

