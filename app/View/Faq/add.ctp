<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add a FAQ question') ?>
		</span>
        

        
        
		<span class="um-panel-title-right">
		<?php echo $this->Html->link(__('Return to FAQ', true), '/faq');?>
		</span>
	</div>
    
    
    		<div class="um-panel-content">
		<?php echo $this->Form->create('Faq', array('type' => 'data', 'id'=>'editFaqForm', 'class'=>'form-horizontal')); ?>

		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Question:');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('question', array(
            													'label'=>false, 
            													'div'=>false,
            													'class'=>'span6')); ?>
			</div>
		</div>
        
        <div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Answer:');?></label>
			<div class="controls">
            	<?php echo $this->Form->input('answer', array(
            												'label'=>false, 
            												'div'=>false,
            												'class'=>'span9',
                            								'placeholder'=>__('Don\'t forget to surround paragraphs with <p> ... </p>'))); ?>
			</div>
		</div>

		<div style="margin-left: 55px;">
			<?php echo $this->Form->Submit('Add Question', array('class'=>'pure-button button-success', 'id'=>'addIconSubmitBtn')); ?>
		</div>

    	<?php echo $this->Form->end(); ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
