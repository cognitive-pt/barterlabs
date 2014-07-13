<?php /* PostsController.php */



class PostsController extends AppController {

	public $helpers = array('Html', 'Form');

	var $components = array('RequestHandler');
	var $name = 'Posts';



	public $uses = array('Usermgmt.User', 'Post', 'Pic', 'Comment');


	public function index() {

		$this->layout = 'posts';

		$this->set('posts', $this->Post->find('all',array(
				'order'=>'Post.created DESC'
				)
			)
		);





	}


	public function view($id = null) {

		$user_id = $this->UserAuth->getUserId();
    	$user_name = $this->User->getUserNameById($user_id);
    	$postTitle = $this->Post->find('first', array('conditions'=>array('Post.id'=>$id), 'fields'=>array('Post.title')));
    	if(!empty($user_name)){
    		$this->set('user_name', $user_name);
    	}

		$this->layout = 'posts';

		$comments = $this->Comment->getComments($id);
		if (!empty($comments)){
			$this->set('comments', $comments);
		}

	        if (!$id) {
	            throw new NotFoundException(__('Invalid post'));
	        }

	        $post = $this->Post->findById($id);
	        if (!$post) {
	            throw new NotFoundException(__('Invalid post'));
	        }
	        $this->set('post', $post);

	        $postPics = $this->Pic->getPostPics($id);
	        $this->set('postPics', $postPics);

	         if ($this->request->is('post')) {
	         			
	            	$this->Post->Comment->create();
	            	$this->request->data['Comment']['post_id'] = $id;
		            if($this->UserAuth->isLogged()) {
			            $this->request->data['Comment']['user_id'] = $user_id;
			            $this->request->data['Comment']['name'] = $user_name;}

				            $Email = new CakeEmail();
							$Email->from(array('comments@barterlabs.com' => 'comments@barterlabs.com'));
							$Email->to(array('catpainzmcspice@gmail.com'=>'catpainzmcspice@gmail.com'));
							$Email->subject('New Blog Comment');
							$message = "You have a new comment on blog post #".$id.", the post titled \"".$postTitle['Post']['title'].".\"\nFrom: ".$this->request->data['Comment']['name']."\nComment: ".$this->request->data['Comment']['content'];
							$Email->send($message);

			            if ($this->Comment->save($this->request->data)) {
		 					$this->Session->setFlash(__('Your comment has been saved.'));
			                return $this->redirect(array('action' => 'view', $id));
			            }
	            $this->Session->setFlash(__('Unable to add your comment.'));
        
				}





    }



    public function add() {
    	$this->layout = 'posts';

    	$user_id = $this->UserAuth->getUserId();

    	$user_name = $this->User->getUserNameById($user_id);

    	$this->set(compact('user_id', 'user_name'));

	        if ($this->request->is('post')) {
	            $this->Post->create();

	            $this->request->data['Post']['user_id'] = $user_id;
	            $this->request->data['Post']['user_name'] = $user_name;

	            if ($this->Post->save($this->request->data)) {
 					$this->Session->setFlash(__('Your post has been saved.'));
	                return $this->redirect(array('action' => 'index'));
	            }
	            $this->Session->setFlash(__('Unable to add your post.'));
        



   	 	}
    }


    public function edit($id = null) {
    	$this->layout = 'posts';

	    if (!$id) {
	        throw new NotFoundException(__('Invalid post'));
	    }

	    $post = $this->Post->findById($id);
	    if (!$post) {
	        throw new NotFoundException(__('Invalid post'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Post->id = $id;
	        if ($this->Post->save($this->request->data)) {
	            $this->Session->setFlash(__('Your post has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your post.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $post;
	    }
	}


	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    if ($this->Post->delete($id)) {
	        $this->Session->setFlash(
	            __('The post with id: %s has been deleted.', h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
	    }
}


	public function deleteComment($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    if ($this->Comment->delete($id)) {
	        $this->Session->setFlash(
	            __('The comment with id: %s has been deleted.', h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
	    }
}



		public function addPic($id) {

			$userId = $this->UserAuth->getUserId();
			if ($this->request->is('post')) {
							//Verifies a file was uploaded and that 
							//the form contains a filename
			if(is_uploaded_file($this->request->data['Pic']['name']['tmp_name']) && !empty($this->request->data['Pic']['name']['tmp_name'])) 
						{$this->Pic->create();
					$path_info = pathinfo($this->request->data['Pic']['name']['name']);
							chmod ($this->request->data['Pic']['name']['tmp_name'], 0644);
							$photo=time().mt_rand().".".$path_info['extension'];
							$fullpath= WWW_ROOT."img".DS."barter_blog/pics";

							//create directory if none exists
							if(!is_dir($fullpath)) {
								mkdir($fullpath, 0777, true);
							}

								ImageTool::resize(array(
								    'input' => $this->request->data['Pic']['name']['tmp_name'],
								    'output' => $fullpath.DS.$photo,
								    'width' => 500,
								    'height' => 500,
								    'paddings' => true
								));
							
		//****************************************
		//****************************************

							//inserts hashed filename into table row
							$this->request->data['Pic']['name']=$photo;
							//inserts the current labId
							$this->request->data['Pic']['post_id']=$id;
							$this->request->data['Pic']['user_id']=$userId;
							

							//double-checks that files & names exist
							if(!empty($Pic['Pic']['name']) && file_exists($fullpath.DS.$Pic['Pic']['pic'])) {
								unlink($fullpath.DS.$Pic['Pic']['name']);
							}
						}

						else {
							unset($this->request->data['Pic']['name']);
						}

			if ($this->Pic->save($this->request->data)) {
				$this->Session->setFlash(__('Saved!'));

				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The Picture could not be saved. Please, try again.'), 'default', array('class' => 'error'));
				unset($this->request->data['Picture']['name']);
			}
		}		
}


public function viewPic($id) {

		$this->layout = 'posts';

		$viewPic = $this->Pic->find('first', array(

			'conditions' => 
				array('Pic.id' => $id)
				)
			);

		$this->set('viewPic', $viewPic);
}

public function editPic($id = null) {


		$res = $this->Pic->find('first', array('conditions'=>array('Pic.id'=>$id),'recursive'=>0));

			if (!$this->Pic->exists($id)) {
				throw new NotFoundException(__('Invalid picture'));
			}
				if ($this->request->is(array('post', 'put'))) {
					$this->Pic->id = $id;
								//if the Display Photo checkbox is checked
					if ($this->Pic->save($this->request->data)) {
						$this->Session->setFlash(__('Saved!'));
						$this->redirect(array('action' => 'view', $res['Pic']['post_id']));
					} else {
						$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
					}
				} else {
					$viewPic = array('conditions' => array('Pic.' . $this->Pic->primaryKey => $id));
					$this->request->data = $this->Pic->find('first', $viewPic);
				}
			$viewPic = $this->Pic->find('first', array(
				'conditions' => 
					array('Pic.id' => $id)
					)
				);
			$this->set('viewPic', $viewPic);
			}



public function deletePic($id) {
		$this->Pic->id = $id;
		$res = $this->Pic->find('first', array('conditions'=>array('Pic.id'=>$id),'recursive'=>0));
		
			if (!$this->Pic->exists()) {
				throw new NotFoundException(__('Invalid picture'));
				}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Pic->delete()) {
				$this->Session->setFlash(__('The picture has been deleted.'));
			} else {
				$this->Session->setFlash(__('The picture could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'view', $res['Pic']['post_id']));
		}

} //end of PostsController.php



?>