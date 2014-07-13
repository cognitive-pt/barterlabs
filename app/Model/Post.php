<?php /* Post.php */


App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('Pic','Model');

class Post extends AppModel {
	var $belongsTo = array('User');
	var $hasMany = array('Pic', 'Comment');


			 public $validate = array(
			        'title' => array(
			            'rule' => 'notEmpty'
			        ),
			        'content' => array(
			            'rule' => 'notEmpty'
			        )
			    );



	function getAuthorName($uesr_id){
			//loads a username based on the post's user_id
			$res = $this->User->find('first', array(
				'conditions'=>
					array('User.id' => $id),
				'fields' => array(
						  'User.username')
				)
			);	
			return $res;
		} 
	

}



?>