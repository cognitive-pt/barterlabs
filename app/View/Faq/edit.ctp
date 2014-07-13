
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Faq Info') ?>
		</span>
        
        
		<span class="um-panel-title-right">
        
        
        
		<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Faq.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Faq.id'))); ?>       
		<?php echo " /";?>
		<?php echo $this->Html->link(__('FAQ Index', true), '/faq');?>
		</span>
	</div>
    
    
		<div class="um-panel-content">
		<?php echo $this->Form->create('Faq', array('type' => 'data', 'id'=>'editFaqForm', 'class'=>'form-horizontal')); ?>

		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Question:');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('question', array(
            													'label'=>false, 
            													'div'=>false,
            													'class'=>'span6')); ?>
			</div>
		</div>
        
        <div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Answer:');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('answer', array(
            												'label'=>false, 
            												'div'=>false,
            												'class'=>'span9',
                            								'placeholder'=>__('Don\'t forget to surround paragraphs with <p> ... </p>'))); ?>
			</div>
		</div>


		<div class="um-button-row">
				<div style="margin-left: 55px;">
					<?php echo $this->Form->Submit('Update', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
				</div>
		</div>

    	<?php echo $this->Form->end(); ?>
 </div>
</div>




