<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');
class State extends AppModel {
	
	
var $hasMany = array('Lab');
public $actsAs = array('Search.Searchable');	

		//this function returns the name of state with the $stateId
	public function getStateName($stateId){
			//queries State name
			$res = $this->Lab->State->find('first', array('conditions' =>array('State.id'=>$stateId), 'fields'=> array('State.name')));
			//save State name as a string
			$stateName = (!empty($res)) ? ($res['State']['name']) : '';	
			return $stateName;} //end of getStateName	
}
?>