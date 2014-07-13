<?php

$GLOBALS['VERSION_NUMBER'] = 'v.0.1.3b';

App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('Pic','Model');

class Lab extends AppModel {



var $name = 'Lab';

		public $validate = array(
		
		'projectname'=>array(
					'mustNotEmpty'=>array(
						'rule'=>'notEmpty',
						'message'=>'Please enter a name for this lab!!'
						),
					'limitLength'=>array(
						'rule'=>array('maxLength', 80),
						'message'=>'Please limit your Trade Name to 80 characters!'
						)
				),
				
		'labdesc'=>array(
					'mustNotEmpty'=>array(
						'rule'=>'notEmpty',
						'message'=>'We strongly recommend you enter a discription for your lab!!'
						),
				)	
		);

public $actsAs = array('Search.Searchable');

var $belongsTo = array('State','User','Town', 'Type');
var $hasMany = array('Pic');

public $filterArgs = array(
		array( 
			'name'=>'search', 
			'type'=>'query',
			'field'=>array('projectname', 'labdesc'),
			'method'=>'orConditions'
			),
		array(
			'name'=>'catalyst',
			'type' => 'value'),
		array(
			'name'=>'town_id',
			'type' => 'value',
			'allowEmpty' => false,
			'emptyValue'=>'0'
			),
		array(
			'name'=>'type_id',
			'type' => 'value',
			'allowEmpty' => false,
			'emptyValue'=>'0'
			)

	
	);    



public function orConditions($data = array()) {
    $filterName = key($data);
    $filter = Set::extract('/.[name='.$filterName.']', $this->filterArgs);
    if (!isset($filter[0]['field'])) {
        $filter[0]['field'] = $this->alias.'.'.$this->displayField;
    }
    $field = $filter[0]['field'];
    $query = $data[$filterName];
    $ds = ConnectionManager::getDataSource($this->useDbConfig);
    if (!is_array($field)) {
        $field = array($field);
    }
    return array($ds->expression('MATCH ('.implode(',',array_map(array($ds, 'name'), $field)).') AGAINST ('.$ds->value($query).' IN BOOLEAN MODE)'));
    }




public function returnVersionNumber(){
 return $GLOBALS['VERSION_NUMBER'];
}
   
public function hot($score, $id) {
	
	$order = log10(max(abs($score), 1));
	
    if ($score>0){
        $sign = 1;
    } else {
        if ($score<0){
            $sign = -1;
        } else {
            $sign = 0;
        }
    } 
	$date1 = strtotime(date('Y-m-d H:i:s')); //converts current time into UNIX timestamp
											 //which is in seconds
	$date2 = strtotime(date('1970.01.01 00:00:00')); //converts control date into UNIX timestamp
													 //which is in seconds
	$seconds = $date1 - $date2;					
   
    return round($sign * $order + $seconds / 45000, 7);}


public function updateHot($hot, $id){
	$this->id=$id;
	$this->save($this->data['Lab']['hot']=$hot);	
	return;
	}


function getLab($id) {
		$options = array('conditions' => array('Lab.' . $this->primaryKey => $id));
		$labId = $this->find('first', $options);
        return $labId;} //end LabId();

function getViewedUserLabs($viewedUserId){
		$viewedUserLabs = $this->find('all', array(
			'conditions' => array('Lab.user_id' => $viewedUserId)
			)
		); 
		return $viewedUserLabs;} //end getViewedUserLabs();

function getViewedUserLabIds($id) {
		//loads all of the selected user's lab (only Lab IDs)
		$viewedUserLabIds = $this->find('all', array(
			'conditions' => array('Lab.user_id' => $id),
			'fields' => array('Lab.id'),
			'recursive' => 0
			)
		); return $viewedUserLabIds;} //end getViewedUserLabIds();

function getViewedUserLabIds2($viewedUserId) {
		//loads all of the selected user's labs (only Lab IDs)
		$viewedUserLabIds = $this->find('all', array(
			'conditions' => array('Lab.user_id' => $viewedUserId),
			'fields' => array('Lab.id'),
			'recursive' => 0
			)
		); return $viewedUserLabIds;} //end getViewedUserLabIds2();


function getUserLabIds($userId) {
		//loads all of the selected user's lab (only Lab IDs)
		$userLabIds = $this->find('all', array(
			'conditions' => array('Lab.user_id' => $userId),
			'fields' => array('Lab.id'),
			'recursive' => 0
			)
		); return $userLabIds;} //end getViewedUserLabIds();


function getViewedUserId($id){
		$res = $this->find('first', array(
			'conditions' => array('Lab.id' => $id),
			'fields' => array('Lab.user_id'),
			)
		); 
		$viewedUserId = (!empty($res)) ? ($res['Lab']['user_id']) : '';
		return $viewedUserId;} //end getViewedUserId();



function getTownId($id){
		//loads the user's town Id based on lab Id
		$res = $this->find('first', array(
			'conditions'=>
				array('Lab.id' => $id),
			'fields' => array('Lab.town_id')
			)
		);	
		$townId = (!empty($res)) ? ($res['Lab']['town_id']) : '';
		return $townId;} //end getTownId()

function getStateId($id){
		//loads the user's town Id based on lab Id
		$res = $this->find('first', array(
			'conditions'=>
				array('Lab.id' => $id),
			'fields' => array('Lab.state_id')
			)
		);	
		$stateId = (!empty($res)) ? ($res['Lab']['state_id']) : '';
		return $stateId;} //end getTownId()



}
?>
