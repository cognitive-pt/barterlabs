<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');
class Type extends AppModel {
	
	
var $hasMany = array('Lab');


		public $validate = array(
        'name' => array(
            'rule'=> 'notEmpty',
			'message' => 'You must enter a Type name'
        ));
}
?>