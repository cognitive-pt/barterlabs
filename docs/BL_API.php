<?php 

//Retrieves current Version Number (stored in Lab.php)
$this->Lab->returnVersionNumber();

/**************************************************************************/
/*********************************EMAIL*********************************/
/**************************************************************************/

//Retrieves the email data and fromUser data based on the id of email being viewed
$this->UserEmail->getUserEmail($userEmailId);

//Retrieves the filename for fromUser user pic
$this->UserDetail->getFromPic($userEmail['UserEmail']['from_id']);



/**************************************************************************/
/*********************************LOCATION*********************************/
/**************************************************************************/

//Retrieves the town name based on $townId
$this->Town->getTownName($townId);

//Retrieves the town ID of the viewed lab
$this->Lab->getTownId($id);

//Retrieves the numerical state id from the individual user's saved settings
$this->UserDetail->getStateId($userId);

//Retrives the name of the state based on the varible $stateId
$this->State->getStateName($stateId);

//Retrieves a list of all the towns in a state 
//based on $stateName
$this->Town->getAllTowns($stateName);

/**************************************************************************/
/*********************************USERS************************************/
/**************************************************************************/

//Retrieves the id of the user whose lab is being viewed
$this->Lab->getViewedUserId($id);

//Retrieves the id of the user whose profile is being viewed
$this->User->getViewedUserId($id);

//Retrieves logged-in user's name by userId
$this->User->getUserNameById($userId);

/**************************************************************************/
/*********************************LABS*************************************/
/**************************************************************************/

//Retrieves all of the labs of the user being viewed
//based on $viewedUserId
$this->Lab->getViewedUserLabs($viewedUserId);


//Retrieves all of the viewed User's Labs (returns only list of Lab IDs)
$this->Lab->getViewedUserLabIds($id);

//Exact same as above only passing $viewedUserId
$this->Lab->getViewedUserLabIds2($viewedUserId);

//Retrieves all of the User's Lab IDs (same as above only with $userId
$this->Lab->getUserLabIds($id);


/**************************************************************************/
/*******************************PICTURES***********************************/
/**************************************************************************/

//returns all pictures associated with current lab $id
$this->Pic->getLabPics($id);

//this function finds the old Display Picture and inserts a value of NULL
$this->Pic->nullOldDisPic($id);

/**************************************************************************/
/*********************************VOTING***********************************/
/**************************************************************************/

//calculates hot score based on Reddit's updated (2014) hot algorithm
$this->Lab->hot($allLabVotes);

//calculates total votes (up - down)
$this->Vote->countLabVotes($id);

//counts number of user's upvotes
$this->Vote->countUserUpvotes($userLabIds);

//counts number of user's downvotes
$this->Vote->countUserDownvotes($userLabIds);

//counts number of lab's upvotes
$this->Vote->countLabUpvotes($id);

//counts number of lab's downvotes
$this->Vote->countLabDownvotes($id);

//returns true/false if a user has voted on a lab
$this->Vote->hasVoted($userId, $id, $viewedUserId);

//adds an upvote
$this->Vote->upVote($userId, $id, $hasvoted);

//adds a downvote
$this->Vote->downVote($userId, $id, $hasvoted);


/**************************************************************************/
/*********************************HANDY SNIPPETS***************************/
/***************************************************************************
--returns the current url
Router::url($this->here, true)




****************************************************************************/
?>