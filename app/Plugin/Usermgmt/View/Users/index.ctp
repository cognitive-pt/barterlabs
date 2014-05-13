<?php

?>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('All Users') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Add User', true), array('action'=>'addUser'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.all_users'); ?>
	</div>
</div>