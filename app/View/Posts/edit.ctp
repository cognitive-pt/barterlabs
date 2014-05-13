<!-- File: /app/View/Posts/edit.ctp -->

<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title', array('class'=> 'span8'));
echo $this->Form->input('content',array('type'=>'textarea','label' => 'Content', 'rows' => 15, 'class'=> 'span8')); 
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->submit(__('Save'), array('div' => false, 'class'=>'pure-button button-success labsearchsearchbtn'));
echo $this->Form->end();
?>