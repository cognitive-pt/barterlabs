<?php if (!empty($user)) { 
	echo $this->Html->image('umphotos/' . $user['UserDetail']['photo'], 
		array(
			'alt'=> $viewedUser['User']['username'], 
			'height'=>'100',
			'width'=>'100'));}
?>