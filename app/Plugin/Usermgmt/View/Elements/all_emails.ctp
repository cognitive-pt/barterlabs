<?php

?>
<div id="updateUserEmailIndex">
	<?php echo $this->Search->searchForm('UserEmail', array('legend' => false, 'updateDivId' => 'updateUserEmailIndex')); ?>
	<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateUserEmailIndex')); ?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('User.username', __('From')); ?></th>
				<th><?php echo $this->Paginator->sort('UserEmail.subject', __('Subject')); ?></th>
				
				
				<th><?php echo $this->Paginator->sort('UserEmail.created', __('Date Sent')); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>
		<tbody>
        <?php
        if ($userEmails==NULL) {
			echo "<td>"."No email to display!!"."</td>"; ?>
		</tbody>
       </table>
		<?php } else {
		
		
		
        ?>
	<?php   if (!empty($userEmails)) {
				
				foreach ($userEmails as $row) {

					
					echo "</td>";
					
					
					?><td width="15%"><?php
					echo $this->Html->link(__($row['User']['username'], true), array('controller'=>'Users', 'action'=>'viewUser',$row['User']['id'], 'plugin'=>'usermgmt'));?></td><?php

					echo"</td>";
					
					
					
					if(($row['UserEmail']['is_email_read']==NULL)||($row['UserEmail']['is_email_read']==0)) {
					?><td><div class="emailnotread"><?php		
					echo $this->Html->link(__($row['UserEmail']['subject'], true), array('action'=>'view',$row['UserEmail']['id'], 'plugin'=>'usermgmt'));?></div></td><?php } else { ?>					
					
					<td><div class="emailisread"><?php		
					echo $this->Html->link(__($row['UserEmail']['subject'], true), array('action'=>'view',$row['UserEmail']['id'], 'plugin'=>'usermgmt'));?></div></td><?php
					
					
					}?>
				<?php echo "<td width=\"15%\">".date('d-M-Y', strtotime($row['UserEmail']['created']))."</td>";
					echo "<td>";
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>";
						echo "<ul class='dropdown-menu'>";
						
							echo "<li>".$this->Html->link(__('View Email'), array('action'=>'view', $row['UserEmail']['id']	), array('escape'=>false))."</li>";
							
							
							 echo "<li>".$this->Form->postLink(__('Delete'), array('action' => 'deleteEmail', $row['UserEmail']['id']), null, __('Are you sure you want to delete message: %s?', $row['UserEmail']['subject']))."</li>"; 
							
							
						echo "</ul>";
					echo "</div>";
					echo "</td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
			} ?>
		</tbody>
	</table>
	<?php if(!empty($userEmails)) { echo $this->element('Usermgmt.pagination'); }
	 ?>
</div>
 <?php } ?> 