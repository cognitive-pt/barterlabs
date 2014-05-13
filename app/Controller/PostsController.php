<?php /* PostsController.php */

class PostsController extends AppController {

	public $helpers = array('Html', 'Form');

	public $uses = array('Usermgmt.User', 'Post');


	public function index() {

		$this->layout = 'posts';

		$this->set('posts', $this->Post->find('all',array(
				'order'=>'Post.created DESC'
				)
			)
		);

	

	}


	public function view($id = null) {

		$this->layout = 'posts';

	        if (!$id) {
	            throw new NotFoundException(__('Invalid post'));
	        }

	        $post = $this->Post->findById($id);
	        if (!$post) {
	            throw new NotFoundException(__('Invalid post'));
	        }
	        $this->set('post', $post);
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


} //end of PostsController.php



?>