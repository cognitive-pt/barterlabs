<div class="um-panel">
	<div class="um-panel-header">
		
    
    <div class="mainleft">
            <div class="labdesc">
            <span class="um-panel-title">
			<?php echo __('Trade ID: ') ?><?php echo h($lab['Lab']['id'])?>
			
            <?php echo h($lab['Lab']['labdesc']); ?>
            </span>
            
            </div>
    </div>
    
    
     
		<span class="um-panel-title-right">
        
        <div class="profile">
<?php echo $this->Html->image('pics/' . $firstLabPic, 
		array(
			'alt'=> $firstLabPic, 
			'height'=>'300', 
			'width'=>'300'));  ?>
        </div>
        
                
	<div class="um-panel">
		<span class="um-panel-title">
			<?php echo h($user['User']['first_name'])?>
			<?php echo h(' ')?>
			<?php echo h($user['User']['last_name'])?>
		</span>
	</div>
    
    <div>
    <?php echo $this->element('labPics');?>
    </div>
    
    
    
	<div class="lab-panel-content">

		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">

			

			<tbody>
					<tr>
						<td><strong><?php echo __('Lab Name:');?></strong></td>
						<td><?php echo h($lab['Lab']['projectname']); ?></td>
					</tr>
               
               		<tr>
                    	<td><strong><?php echo __('Status:');?></strong></td>
        					<td><?php if(!empty($lab['Lab']['catalyst']))
		   					{?><div class="labstatus1"><?php
								echo 'Active';?></div><?php }
							
							else
		   					{?> <div class="labstatusnull"><?php
                            echo 'Not Currently Active';?><?php }?></td>
                    
                    </tr>
               
               
                    
                    <tr>
                        <td><strong><?php echo __('Location:');?></strong></td>
                        <td><?php echo h($town['Town']['name']) . ', '; ?>
                        <?php echo h($state); ?></td>
                    </tr>
                    
                    <tr>
						<td><strong><?php echo __('Score (Up/Down): ');?></strong></td>
						<td>
						<?php echo $allobjvotes; ?>
                        <?php echo '('; ?>
						<?php echo $upvotes; ?>
                        <?php echo '/'; ?>
                        <?php echo $downvotes; ?>
                        <?php echo ')'; ?>
                        </td>
					</tr>
                    
                    <?php if(!empty($lab['Lab']['link']))
		   					{?>
                    <tr>
                    	<td><?php echo 'External Link:';?></td>
                        <td><div class="lablink"><a href="<?php echo h($lab['Lab']['link']); ?>"><?php echo h($lab['Lab']['link']); ?></div> </td>
                    </tr> <?php }?>
                    
                    <tr>
						<td><strong><?php echo __('Created:');?></strong></td>
						<td><?php echo $this->Time->format(
  							'F jS, Y h:i A',
  							$lab['Lab']['created']); ?></td>
					</tr>
			
                    
                    
			</tbody>
		</table>
	</div>
</div>





