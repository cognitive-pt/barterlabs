<?php

?>
<div id="updateContactIndex">
	<?php echo $this->Search->searchForm('UserContact', array('legend' => false, 'updateDivId' => 'updateContactIndex')); ?>
	<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateContactIndex')); ?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo __('SL');?></th>
				<th><?php echo $this->Paginator->sort('UserContact.user_id', __('User Id')); ?></th>
				<th><?php echo $this->Paginator->sort('UserContact.username', __('Username')); ?></th>
				<th><?php echo $this->Paginator->sort('UserContact.email', __('Email')); ?></th>
				<th><?php echo $this->Paginator->sort('UserContact.subject', __('Subject')); ?></th>
				<th><?php echo __('Body');?></th>
				<th><?php echo __('Reply Message');?></th>
				<th><?php echo $this->Paginator->sort('UserContact.created', __('Date')); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>
		<tbody>
	<?php   if (!empty($userContacts)) {
				$page = $this->request->params['paging']['UserContact']['page'];
				$limit = $this->request->params['paging']['UserContact']['limit'];
				$i=($page-1) * $limit;
				foreach ($userContacts as $row) {
					$i++;
					echo "<tr>";
					echo "<td>".$i."</td>";
					echo "<td>";
					if($row['UserContact']['user_id']) {
						echo $this->Html->link($row['UserContact']['user_id'], array('controller'=>'Users', 'action'=>'ViewUser', $row['UserContact']['user_id'], 'page'=>$page));
					}
					echo "</td>";
					echo "<td>".h($row['UserContact']['username'])."</td>";
					echo "<td>".h($row['UserContact']['email'])."</td>";
					echo "<td>".h($row['UserContact']['subject'])."</td>";
					echo "<td>".nl2br($row['UserContact']['body'])."</td>";
					echo "<td>".$row['UserContact']['reply_message']."</td>";
					echo "<td>".date('d-M-Y',strtotime($row['UserContact']['created']))."</td>";
					echo "<td>";
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>";
						echo "<ul class='dropdown-menu'>";
							echo "<li>".$this->Html->link(__('Send Reply'), array('controller'=>'UserEmails', 'action'=>'sendReply', $row['UserContact']['id'], 'page'=>$page), array('escape'=>false))."</li>";
						echo "</ul>";
					echo "</div>";
					echo "</td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan=8><br/><br/>".__('No Data')."</td></tr>";
			} ?>
		</tbody>
	</table>
	<?php if(!empty($userContacts)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Enquiries'))); } ?>
</div>