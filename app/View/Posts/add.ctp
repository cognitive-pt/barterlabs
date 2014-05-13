<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>

<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('title', array('class'=> 'span8'));
	echo $this->Form->input('content',array('type'=>'textarea','label' => 'Content', 'rows' => 15, 'class'=> 'span8'));
	echo $this->Form->submit(__('Save'), array('div' => false, 'class'=>'pure-button button-success labsearchsearchbtn'));
	echo $this->Form->end();

?>