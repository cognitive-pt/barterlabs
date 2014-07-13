<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('State','Model');
App::uses('CakeEmail', 'Network/Email');
class Town extends AppModel {

public $displayField = 'name';
var $hasMany = array('Lab');
public $actsAs = array('Search.Searchable');
	public function getTownById($userid) {
		$res = $this->find('first', array('conditions'=>array('Town.id'=>$userid), 'contain'=>array('Town')));
		return $res;
	}


public $validate = array(
		'name'=>array(
					'mustNotEmpty'=>array(
						'rule'=>'notEmpty',
						'message'=>'Please enter a town name!'
						),
					'limitLength'=>array(
						'rule'=>array('maxLength', 25),
						'message'=>'Please limit your Trade Name to 25 characters!'
						)
				),
		'state'=>array(
					'mustNotEmpty'=>array(
						'rule'=>'notEmpty',
						'message'=>'Please enter a state name!'
						),
					'limitLength'=>array(
						'rule'=>array('maxLength', 15),
						'message'=>'Please limit this to 15 characters!'
						)
				),
				
		
		'stateab'=>array(
					'mustNotEmpty'=>array(
						'rule'=>'notEmpty',
						'message'=>'You must enter the state abbreviation (all caps)!'
						),
					'limitLength'=>array(
						'rule'=>array('maxLength', 2),
						'message'=>'Please limit your this to 2 characters!'
						)
					),
				);

	public function getAllTowns($stateName){
		$towns = $this->Lab->Town->find('list', array('conditions' =>array('Town.state'=>$stateName), 'order'=>array('Town.name', 'Town.name ASC'),'fields'=> array('Town.name')));
		return $towns;
	} //end of getAllTowns()


	public function getTownsByStateId($state_id){
		$towns = $this->Lab->Town->find('list', array('conditions' =>array('Town.state'=>$stateName), 'order'=>array('Town.name', 'Town.name ASC'),'fields'=> array('Town.name')));
		return $towns;
	} //end of getAllTowns()


	public function getTownName($townId){
		$res = $this->find('first', array(
			'conditions' => 
				array('Town.id' => $townId),
			'fields' => 
				array('Town.name')
				)
			);
		$townName = (!empty($res)) ? ($res['Town']['name']) : '';	
		return $townName;
} //end getTownName()



}
?>
