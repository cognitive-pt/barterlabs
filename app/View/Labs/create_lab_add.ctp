<div class="createLabContainer">
	<?php echo $this->Form->create('Lab', array('type' => 'file', 'id'=>'editLabForm', 'class'=>'form-horizontal')); ?>
	


	<p><?php echo $this->Form->input('projectname', array(
													'label'=>'Barter name:', 
													'div'=>false, 
													'class'=>'span9',
													'placeholder'=>__('Please enter a name for your barter'))); ?>

	</p>
	<?php  echo $this->Ckeditor->textarea('Lab.labdesc', array(
															'type' => 'textarea', 
															'label' => false, 
															'div' => false, 
															'style'=>'height:10px', 
															'class'=>'span6',
															 'placeholder'=>__('Write a description')), 
														 array(
														 	'language'=>'en', 
														 	'uiColor'=> '#33CC33'), 
											'standard');?>





	<p><?php echo $this->Form->Submit('Next', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?></p>
	<?php echo $this->Form->end(); ?>
</div>