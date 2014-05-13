<?php

App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('Tradeicon','Model');
class UserDetail extends UserMgmtAppModel {

public $actsAs = array('Search.Searchable');

var $hasMany = array('Tradeicon','Lab');

var $belongsTo = array('State');



	/**
	 * model validation array
	 *
	 * @var array
	 */
	var $validate = array();
	function RegisterValidate() {
		$validate1 = array(
		
				'tradename'=>array(
					'mustNotEmpty'=>array(
						'rule'=>'notEmpty',
						'message'=>'Please enter a trade name for yourself!'
						),
					'limitLength'=>array(
						'rule'=>array('maxLength', 40),
						'message'=>'Please limit your Trade Name to 40 characters!'
						)
				),
								
				'state_id'=>array(
					'mustNotEmpty'=>array(
						'rule'=>'notEmpty',
						'message'=>'Please select a state!'
						),
				),
				

				
				'photo'=> array(
					'mustValid'=>array(
						'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg', '')),
						'message'=> __('Please supply a valid image'),
						'last'=>true)
					),
					
				'bgphoto'=> array(
					'mustValid'=>array(
						'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg', '')),
						'message'=> __('Please supply a valid image'),
						'last'=>true)
					)
					
								);
		$this->validate=$validate1;
		return $this->validates();
	}
	function multipleValidate() {
		$validate1 = array(
				'bday'=> array(
					'mustDate'=>array(
						'rule' => array('date', 'ymd'),
						'allowEmpty' => true,
						'message'=> __('Please select valid birthday date'),
						'last'=>true)
					)
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	
	
	
	
	
	public function getFromPic($id){
		$fromPic = $this->find('first', array(
				'conditions'=>array(
					'UserDetail.user_id'=>$id),
					'recursive'=>0,
					'fields'=>array('UserDetail.photo'),
					));
		return $fromPic;
	}
	
	
	
		//this function retrieves the numerical id 
		//of the state saved in UserDetails
	public function getStateId($userId){
		$res = $this->find('first', array('conditions' => array('UserDetail.user_id'=>$userId), 'fields' => array('UserDetail.state_id')));
		$stateId =(!empty($res)) ? ($res['UserDetail']['state_id']) : '';
		return $stateId;} //end of getStateId()


	
	
	
	
	
} //end of UserDetail model