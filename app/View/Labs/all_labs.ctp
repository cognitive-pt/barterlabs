<?php


?>

<?php echo $this->Html->script(array('/usermgmt/js/umupdate.js?q='.QRDN)); ?>


                <div class="um-panel">
                    <div class="um-panel-header">
                        <span class="um-panel-title">
                            <?php echo h('View All Barters')?>
                        </span>  
                    	<span class="um-panel-title-right">
                        
                        <?php
						
						echo $this->Html->link(__('Return'), array('controller'=>'Users', 'action' => 'myprofile', 'plugin'=>'usermgmt'));?>
                        
                        
                        
                        
                        
                		</span>
              		</div> 

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo ('Barter Id'); ?></th>
				<th><?php echo ('Project Name'); ?></th>
				<th><?php echo ('Status'); ?></th>
				<th><?php echo ('Created'); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>				

		<tbody>
	<?php   if (!empty($allLabs)) {
				foreach ($allLabs as $row) {
					
					echo "<td>".$row['Lab']['id']."</td>";
					echo "<td>".$row['Lab']['projectname']."</td>";
					
					if ($row['Lab']['catalyst']==1) {
						
						echo "<td><div class=\"labstatus1\">".('ACTIVE')."</td></div>";
					} else {
						echo "<td><div class=\"labstatusnull\">".('INACTIVE')."</td></div>";
					}
					echo "<td>".h($row['Lab']['created'])."</td>";
					
					$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
					echo "<td>";?>




					<ul class="nav-all-labs nav-pills">  <!--  this CSS is contained in pure-bl.css   -->
					<li class='dropdown' style="list-style-type: none;">
						<?php 
							echo $this->Html->link(__('Options'), '#', 
							array(
								'escape'=>false, 

								'rel'=>'tooltip',//tooltip init
								'data-placement'=>'bottom', //tooltip placement
								'title'=>'Option Menu', //tooltip text
								'class'=>'dropdown-toggle', 
								'data-toggle'=>'dropdown'));

						echo "<ul class='dropdown-menu pull-right'>";

							echo "<li>".$this->Html->link(__('View'), array('controller'=>'Labs', 'action'=>'view',$row['Lab']['id']), array('escape'=>false))."</li>";

							echo "<li>".$this->Html->link(__('Edit'), array('controller'=>'Labs', 'action'=>'editLab', $row['Lab']['id']), array('escape'=>false))."</li>";

							
							if ($row['Lab']['catalyst']==1) {
								echo "<li>".$this->Form->postLink(__('Deactivate'), array('action' => 'deactivateLab', $row['Lab']['id']), null, __('Are you sure you want deactivate %s?', $row['Lab']['projectname']))."</li>";} 
								else {echo "<li>".$this->Form->postLink(__('Activate'), array('action' => 'activateLab', $row['Lab']['id']), null, __('Are you sure you want activate %s?', $row['Lab']['projectname']))."</li>";}
							echo "<li>".$this->Form->postLink(__('Delete'), array('action' => 'deleteLab', $row['Lab']['id']), null, __('Are you sure you want to delete %s?', $row['Lab']['projectname']))."</li>";
							
							
							
							
						
						echo "</ul>";
					echo "</div>";
					echo "</td>";
					echo "</tr>";
				echo "</ul>";
				}
			} else {
				echo "<tr><td colspan=10><br/><br/>".__("You don't have any barters yet!<br/>Click the + icon in the navbar to add a new Lab!")."<br/><br/></td></tr>";
			} ?>
		</tbody>
	</table>
	<?php if(!empty($users)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Users'))); } ?>
</div>