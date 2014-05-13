<?php //final user validation 
if (($userId == $userEmail['UserEmail']['to_id'])||($userId==$userEmail['UserEmail']['from_id'])){
	
	

?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('To '.$toName['User']['username']); ?>
		</span>
		<span class="um-panel-title-right">
			
			<?php 
			echo $this->Form->postLink(__('Delete'), array('action' => 'deleteEmail', $userEmail['UserEmail']['id']), null, __('Are you sure you want to delete message: %s?', $userEmail['UserEmail']['subject']));
			echo (' / ');
			echo $this->Html->link(__('Inbox', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<table class="table table-striped table-bordered">
			
	<table class="table table-striped table-bordered table-hover">

		<tbody>
        	<tr>
            <div class="emailfrompic">
            <?php 
			echo $this->Html->link($this->Html->image('umphotos/' . $fromPic['UserDetail']['photo'], 
		array(
			'alt'=> $userEmail['User']['username'], 
			'height'=>'75', 
			'width'=>'75')), 
		array('controller' => 'Users', 
			'action' => 'viewUser', $userEmail['User']['id'],'plugin'=>'usermgmt'), 
    	array('escape' => false)); ?>
            </div>
            </tr>
            
			<tr><th width="10%">From</th><td>
            <?php echo $this->Html->link(__($userEmail['User']['username'], true), array('controller'=>'Users', 'action'=>'viewUser',$userEmail['User']['id'], 'plugin'=>'usermgmt')); ?>
            </td></tr>
			<tr><th>Subject</th><td><?php echo $userEmail['UserEmail']['subject'];?></td></tr>
			</tr>
			<tr><th>Date Sent</th><td><?php echo date('d-M-Y H:i:s', strtotime($userEmail['UserEmail']['created']));?></td></tr>
		
		</table>
        <div class="um-panel-content">
        <div class="um-panel-content">
            <div class="um-panel-header">
            
            
            
            <span class="um-panel-title">
<tr><td><?php echo $userEmail['UserEmail']['subject'];?></td></tr>
			</span>
            
            <span class="um-panel-title-right">
                 
                 <?php
                 
                 echo $this->Form->create('Reply', array('type' => 'post', 'id'=>'ContactForm', 'class'=>'form-horizontal'));
			$reply = 1;
			$this->Form->hidden('reply');
			echo $this->Form->Submit('Reply', array('class'=>'btn btn-primary btn-f', 'id'=>'addIconSubmitBtn'));
                 
                 ?>
                 	</span>


	</tbody>
    			 
        </div>
        
        
        <div class="um-panel-content">
        <tr><th></th><td><?php echo $userEmail['UserEmail']['message'];?></td></tr>
        </div>
        </div>
    		
    		</div>
    </div>
</div>
<?php } else {echo ('invalid email id');}
?>