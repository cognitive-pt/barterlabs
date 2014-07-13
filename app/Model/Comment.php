<?php /* Comment.php */

App::uses('UserMgmtAppModel', 'Usermgmt.Model');

class Comment extends AppModel {
	var $belongsTo = array('User', 'Post');


			 public $validate = array(
			        'name' => array(
			            'rule' => 'notEmpty'
			        ),
			        'content' => array(
			            'rule' => 'notEmpty'
			        )
			    );


function getComments($id){
		$getComments = $this->find('all', array(
			'conditions' => array('Comment.post_id' => $id),
			'order'=>'Comment.created ASC'
			)
		); 
		return $getComments;} //end getComments();



}
?>