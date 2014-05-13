<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');
class Vote extends AppModel {

public $actsAs = array('Search.Searchable');


//counts an individual user's upvotes
function countUserUpvotes($userLabIds) {
	foreach($userLabIds as $userLabId) {
		$res[]=$this->find('count', array(
		'conditions'=>array(
			'Vote.lab_id'=>$userLabId['Lab']['id'],
			'Vote.upvote'=>1),
			'recursive'=>0,
			));
		}
if(!empty($res)){
	$allupvotes = array_sum($res); 
	return $allupvotes;}
	else {$allupvotes=0;
		  return $allupvotes;}
	} //end countUpvotes();

//counts an individual user's downvotes
function countUserDownvotes($userLabIds){
	foreach($userLabIds as $userLabId) {
		$res[]=$this->find('count', array(
			'conditions'=>array(
				'Vote.lab_id'=>$userLabId['Lab']['id'],
				'Vote.downvote'=>1),
				'recursive'=>0,
				));
			}	
	if(!empty($res)){
	$alldownvotes = array_sum($res); 
	return $alldownvotes;}
	else {$alldownvotes=0;
		  return $alldownvotes;}




	$alldownvotes = array_sum($res);	
	return $alldownvotes;



	} //end countDownvotes();

function countLabVotes($id) {
	$allLabUpvotes = $this->find('count', array(
			'conditions'=>array(
				'Vote.lab_id'=>$id,
				'Vote.upvote'=>1),
				'recursive'=>0,
				));
	$allLabDownvotes = $this->find('count', array(
			'conditions'=>array(
				'Vote.lab_id'=>$id,
				'Vote.downvote'=>1),
				'recursive'=>0,
				));
	return $allLabVotes = $allLabUpvotes - $allLabDownvotes;			
}

//counts an individual lab's upvotes
function countLabUpvotes($id) {
	$allLabUpvotes = $this->find('count', array(
			'conditions'=>array(
				'Vote.lab_id'=>$id,
				'Vote.upvote'=>1),
				'recursive'=>0,
				));
	return $allLabUpvotes;
}

//counts an individual lab's downvotes
function countLabDownvotes($id) {
	$allLabDownvotes = $this->find('count', array(
			'conditions'=>array(
				'Vote.lab_id'=>$id,
				'Vote.downvote'=>1),
				'recursive'=>0,
				));
	return $allLabDownvotes;
}

//returns whether a user has voted or not
function hasVoted($userId, $id) {
	$voters=$this->find('all', array(
	'conditions'=>array(
		'Vote.lab_id'=>$id,
		'Vote.voter_id'=>$userId) 
		)
	);
	foreach($voters as $voter) {
		if (($voter['Vote']['upvote']==1)&&($voter['Vote']['downvote']==NULL))
		{ $hasvoted = true;
		  return $hasvoted;}
		if (($voter['Vote']['upvote']==NULL)&&($voter['Vote']['downvote']==1))
		{ $hasvoted = true;
		  return $hasvoted;}
        else {$hasvoted = false;
		return $hasvoted;}
	}
} //end of hasVoted()


//returns whether a vote was an upvote
function wasup($userId, $id) {
	$voters=$this->find('all', array(
	'conditions'=>array(
		'Vote.lab_id'=>$id,
		'Vote.voter_id'=>$userId) 
		)
	);
	foreach($voters as $voter) {
		if (($voter['Vote']['upvote']==1)&&($voter['Vote']['downvote']==NULL))
		{ $wasup = true;
		  return $wasup;}
		if (($voter['Vote']['upvote']==NULL)&&($voter['Vote']['downvote']==1))
		{ $wasup = false;
		  return $wasup;}
        else {$wasup = false;
		return $wasup;}
	}
} //end of wasup()

//returns whether a vote was an downvote
function wasdown($userId, $id) {
	$voters=$this->find('all', array(
	'conditions'=>array(
		'Vote.lab_id'=>$id,
		'Vote.voter_id'=>$userId) 
		)
	);
	foreach($voters as $voter) {
		if (($voter['Vote']['upvote']==1)&&($voter['Vote']['downvote']==NULL))
		{ $wasdown = false;
		  return $wasdown;}
		if (($voter['Vote']['upvote']==NULL)&&($voter['Vote']['downvote']==1))
		{ $wasdown = true;
		  return $wasdown;}
        else {$wasdown = false;
		return $wasdown;}
	}
} //end of wasdown()


//adds an upvote to the current object
function upVote($userId, $id, $hasvoted) {
	$voters=$this->find('first', array(
		'conditions'=>array(
			'Vote.lab_id'=>$id,
			'Vote.voter_id'=>$userId),
		 'fields'=>array('id','Vote.upvote','Vote.downvote')
		 )
	);

	if ($hasvoted==true){
			foreach($voters as $voter) {
				if (($voter['upvote']==NULL)&&($voter['downvote']==1))
					{ $this->id=$voter['id'];
					  $this->save($this->data['Vote']['upvote']=1);
					  $this->save($this->data['Vote']['downvote']=NULL);
					  $this->save($this->data['Vote']['voter_id']=$userId);
					  
					  $upvote = true;
					  return $upvote;} 		
				if (($voter['upvote']==1)&&($voter['downvote']==NULL)){
					$upvote=true;
					return $upvote;}
			}
	}
	 $hasvoted=false;
	 if ($hasvoted==false){
		 	  $this->create();
			  $this->save($this->data['Vote']['upvote']=1);
			  $this->save($this->data['Vote']['lab_id']=$id);
			  $this->save($this->data['Vote']['voter_id']=$userId);
			  $upvote = true;
			  return $upvote;}	
} //end of upVote()
	
//adds a downvote to the current object
function downVote($userId, $id, $hasvoted) {
	$voters=$this->find('first', array(
		'conditions'=>array(
			'Vote.lab_id'=>$id,
			'Vote.voter_id'=>$userId),
		 'fields'=>array('id','Vote.upvote','Vote.downvote')
		 )
	);
	
	if ($hasvoted==true){
			foreach($voters as $voter) {
				if (($voter['upvote']==1)&&($voter['downvote']==NULL))
					{ $this->id=$voter['id'];
					  $this->save($this->data['Vote']['upvote']=NULL);
					  $this->save($this->data['Vote']['voter_id']=$userId);
					  $this->save($this->data['Vote']['downvote']=1);
					  $downvote = true;
					  return $downvote;} 		
				if (($voter['upvote']==NULL)&&($voter['downvote']==1)){
					$downvote = true;
					return $downvote;}
			} //end foreach();
	}
	 if ($hasvoted==false){
			  $this->save($this->data['Vote']['downvote']=1);
			  $this->save($this->data['Vote']['voter_id']=$userId);
			  $this->save($this->data['Vote']['lab_id']=$id);
			  $downvote = true;
			  return $downvote;}	
} //end of downVote()
	


} //end of Vote.php