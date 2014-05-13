<?php
echo $this->Form->create('Lab', 
	array('class'=>'form'),
	array(
    	'url' => array_merge(array(
			'controller'=>'Labs',
			'action' => 'find',
			'plugin'=>''), 
		$this->params['pass'])
));
echo $this->Form->input('search', 
	array(
		'div' => 'formfield', 
		'label'=>false, 
		'class'=>'span3'));


echo $this->Form->input('catalyst', array('type' => 'hidden', 'value'=>1));
echo $this->Form->end();
?>


