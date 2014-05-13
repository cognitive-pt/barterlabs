<?php /* this is the main search/find page*/ ?>

<div class="labSearchInput">

	<?php
		echo $this->Form->create('Lab', array(
		    'url' => array_merge(array('action' => 'find'), $this->params['pass'])
		));
		echo $this->Form->input('search', array('div' => false, 'label'=>'Search', 'class'=>'span6'));
		echo $this->Form->input('catalyst', array('type' => 'hidden', 'value'=>1));?>

	<div class="labSearchInputInside">


		<?php 
			echo $this->Form->input('state_id', array(
					'label'=> 'State',
					'class'=> 'span2',
					'id' => 'state_id',
					'options' => array(
								'' => 'ALL',
								'Town' => $state)
			 				));

				echo $this->Form->input('town_id', array(
				        'label' => 'Town',
						'class'=>'span2',
				  		'id' => 'town_id',
				        'options' => array(
									'' => 'ALL',
									'Town' => $town)
								));
					

				echo $this->Form->input('type_id', array(
				        'label' => 'Category',
						'class'=>'span2',
				        'id' => 'type_id',
				        'options' => array(
									 '' => 'ALL',
									 'Type' => $type)
									 ));

						
				$this->Form->input('catalyst', array('type' => 'hidden', 'value'=>1));
				echo $this->Form->submit(__('Search'), array('div' => false, 'class'=>'pure-button button-success labsearchsearchbtn'));
				echo $this->Form->end(); ?>
	</div>
</div>



	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th></th>
                <th><?php echo $this->Paginator->sort('User.username', __('User')); ?></th>
                <th><?php echo $this->Paginator->sort('Lab.projectname', __('Lab Name')); ?></th>
                <th><?php echo $this->Paginator->sort('Lab.town_id', __('Location')); ?></th>
            </tr>
	
		</thead>

<pre><?php //print_r($results) ?></pre>

<?php if(!empty($results)){
	
	foreach ($results as $result): {?>
		
	<tbody>
	<?php //only display a picture if there is a pic assc with the lab
		if (!empty($result['Pic']['0']['name'])){?>
        	
            <td width="5%">
			
			<?php
			
			echo $this->Html->link($this->Html->image('pics/' . $result['Pic']['0']['name'], 
			array(
				'alt'=> $result['Pic']['0']['tag'], 
				'height'=>'100', 
				'width'=>'100')), 
			array('controller' => 'labs', 
				'action' => 'view', $result['Pic']['0']['lab_id'],'plugin'=>''), 
			array('escape' => false));
		} 
		
			else {
			
				?><td width="5%"><?php echo $this->Html->link($this->Html->image('pics/' . 'error.jpg', 
				array(
					'height'=>'100', 
					'width'=>'100'
					)), 
				array('controller' => 'labs', 
					'action' => 'view','plugin'=>''), 
				array('escape' => false));
			}
			
			?>            
            </td>
    
   
    <td width="10%">
    <?php echo $this->Html->link(__($result['User']['username'], true), array('controller'=>'Users', 'action'=>'viewUser',$result['User']['id'], 'plugin'=>'usermgmt'));?>
    </td>
    
    
    <td width="35%">
    <?php echo $this->Html->link(__($result['Lab']['projectname'], true), array('controller'=>'Labs', 'action'=>'view',$result['Lab']['id']));?>
    </td>
    
		
 	
	<td width="15%"><?php echo $result['Town']['name'];?></td>
	
	 
	
	<?php } endforeach; ?>
	
    </tbody>
    </table>
<?php } 


	else {?><td><?php echo 'no results to display!!!';}?>
			</td>
            </tbody>
    </table>

<script>
$(document).ready(function(){
    $("#state_id").change(function(){
        $.ajax({
            async: false,
            url: "getTowns.php?state_id=" + $(this).val(),
            method: "GET",
            success: function(data)
            {
                $.each(data.towns, function(index, town){
                    $("#town_id").append("<option value='" + town.id + "'>" + town.name + "</option>");
                });
            },
            error: function(data)
            {
                //handle your error 
            }
        });
    }); 
});
</script>