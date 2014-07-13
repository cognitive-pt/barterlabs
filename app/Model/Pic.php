<?php

App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('Lab','Model');
class Pic extends AppModel {
	
var $belongsTo = array('Lab','Post');	
public $actsAs = array('Search.Searchable');
	
	public $validate = array(
			'name'=>array(
					'mustValid'=>array(
						'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg', '')),
						'message'=> 'Please supply a valid image -- .gif, .jpeg, .jpg, .png')),
			'tag'=>array('limitLength'=>array(
						'rule'=>array('maxLength', 255),
						'message'=>'Please limit your tag to 255 characters!'
						))
			);
					
	public function getLabPics($id){
	$labPics = $this->find('all', array(
			'conditions' => array('Pic.lab_id' => $id)
			)
		);
	return $labPics;}//end getLabPics()
				
	public function getPostPics($id){
	$postPics = $this->find('all', array(
			'conditions' => array('Pic.post_id' => $id)
			)
		);
	return $postPics;}//end getPostPics()		
							
public function nullOldDisPic($id) {
		//this function finds the old Display Picture
		//and inserts a value of NULL
		//as of yet I haven't got this function to work properly
		$res = $this->find('first', array(
			'conditions' => array('lab_id' => $id,
								  'isdisp' => 1),
			'fields' => array('id','isdisp'),
			'recursive' => 0
			));
		
				$this->id=$res['id'];
				$this->data['isdisp']=NULL;
				$this->save();
			
			return;
		}
							
public function isDisPic($id) {

		$res = $this->find('first', array(
			'conditions' => array('lab_id' => $id,
								  'isdisp' => 1),
			'fields' => array('id','isdisp'),
			'recursive' => 0
			));
		
			if(empty($res))
				{return $isDisPic = false;} 
				else		
				{return $isDisPic = true;}
	
	}

}	
?>