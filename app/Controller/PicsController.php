<?php
App::uses('AppController', 'Controller'); 
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
/**
 * Pics Controller
 *
 * @property Pic $Pic
 * @property PaginatorComponent $Paginator
 */
class PicsController extends AppController {

	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('Lab','Pic');

	/**
	 * This controller uses following components
	 *
	 * @var array
	 */
	public $components = array('RequestHandler', 'Usermgmt.UserConnect', 'Cookie', 'Usermgmt.Search', 'Usermgmt.ControllerList', 'Paginator');



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pic->recursive = 0;
		$this->set('pics', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Pic->recursive = 0;
		if (!$this->Pic->exists($id)) {
			throw new NotFoundException(__('Invalid picture'));
		}
		$options = array('conditions' => array('Pic.' . $this->Pic->primaryKey => $id));
		$this->set('pic', $this->Pic->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
						
		if ($this->request->is('post')) {
							//Verifies a file was uploaded and that 
							//the form contains a filename
			if(is_uploaded_file($this->request->data['Pic']['name']['tmp_name']) && !empty($this->request->data['Pic']['name']['tmp_name'])) 
						{$this->Pic->create();
					$path_info = pathinfo($this->request->data['Pic']['name']['name']);
							chmod ($this->request->data['Pic']['name']['tmp_name'], 0644);
							$photo=time().mt_rand().".".$path_info['extension'];
							$fullpath= WWW_ROOT."img".DS."pics";
							//create directory if none exists
							if(!is_dir($fullpath)) {
								mkdir($fullpath, 0777, true);
							}
							//moves uploaded file to pics directory
			move_uploaded_file($this->request->data['Pic']['name']['tmp_name'],$fullpath.DS.$photo); 
							//inserts hashed filename into table row
							$this->request->data['Pic']['name']=$photo;
							//double-checks that files & names exist
							if(!empty($Pic['Pic']['name']) && file_exists($fullpath.DS.$Pic['Pic']['pic'])) {
								unlink($fullpath.DS.$Pic['Pic']['name']);
							}
						}
						else {
							unset($this->request->data['Pic']['name']);
						}
			if ($this->Pic->save($this->request->data)) {
				$this->Session->setFlash(__('The Picture has been saved.'));

			} else {
				$this->Session->setFlash(__('The Picture could not be saved. Please, try again.'), 'default', array('class' => 'error'));
				unset($this->request->data['Picture']['name']);
			}
		}



	}




/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Pic->exists($id)) {
			throw new NotFoundException(__('Invalid Trade Icon'));
		}
		if ($this->request->is(array('post', 'put'))) {
							//Verifies a file was uploaded and that 
							//the form contains a filename
			if(is_uploaded_file($this->request->data['Pic']['name']['tmp_name']) && !empty($this->request->data['Pic']['name']['tmp_name'])) 
						{
					$path_info = pathinfo($this->request->data['Pic']['name']['name']);
							chmod ($this->request->data['Pic']['name']['tmp_name'], 0644);
							$photo=time().mt_rand().".".$path_info['extension'];
							$fullpath= WWW_ROOT."img".DS."pics";
							
							//create directory if none exists
							if(!is_dir($fullpath)) {
								mkdir($fullpath, 0777, true);
							}
							//moves uploaded file to Pics directory
					move_uploaded_file($this->request->data['Pic']['name']['tmp_name'],$fullpath.DS.$photo); 
							//inserts hashed filename into table row
							$this->request->data['Pic']['name']=$photo;
							//sets save id to currently selected id
							//!!!without this it will create a new entry!!!
							$this->request->data['Pic']['id']=$id;
							//double-checks that files & names exist
							if(!empty($Pic['Pic']['name']) && file_exists($fullpath.DS.$Pic['Pic']['name'])) {
								unlink($fullpath.DS.$Pic['Pic']['name']);
							}
						}
						else {
							unset($this->request->data['Pic']['name']);
						}
			if ($this->Pic->save($this->request->data)) {
				$this->Session->setFlash(__('The trade icon has been updated.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trade icon could not be updated. Please, try again.'),'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Pic.' . $this->Pic->primaryKey => $id));
			$this->request->data = $this->Pic->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Pic->id = $id;
		if (!$this->Pic->exists()) {
			throw new NotFoundException(__('Invalid Picture'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pic->delete()) {
			$this->Session->setFlash(__('The Picture has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Picture could not be deleted. Please, try again.'),'default', array('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
