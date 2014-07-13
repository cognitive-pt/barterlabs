<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
App::uses('AppController', 'Controller');
/**
 * Types Controller
 *
 * @property Type $Type
 * @property PaginatorComponent $Paginator
 */
class TypesController extends AppController {

	//	 * This controller uses following models
	public $uses = array('Usermgmt.User', 'Usermgmt.UserGroup', 'Usermgmt.UserSetting', 'Usermgmt.TmpEmail', 'Usermgmt.UserDetail', 'Usermgmt.UserActivity', 'Usermgmt.LoginToken', 'Usermgmt.UserGroupPermission', 'Usermgmt.UserContact', 'Tradeicon', 'Lab', 'Town', 'Type');



	//	 * This controller uses following components
	public $components = array('RequestHandler', 'Usermgmt.UserConnect', 'Cookie', 'Usermgmt.Search', 'Usermgmt.ControllerList', 'Paginator');

	var $name = 'Types';

	//	 * This controller uses following helpers

	public $helpers = array('Js', 'Usermgmt.Tinymce', 'Usermgmt.Ckeditor');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->User->userAuth=$this->UserAuth;
		if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->action=='login' || $this->action=='addMultipleUsers')){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
	}




/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Type->recursive = 0;
		$this->set('types', $this->Type->find('all', array('order'=>array('Type.name', 'Type.name ASC'))));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Invalid Type'));
		}
		$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
		$this->set('type', $this->Type->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Type->create();
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('The Type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Type could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$labs = $this->Type->Lab->find('list');
		$this->set(compact('labs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Invalid Type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			//!!!without this it will create a new entry!!!
			$this->request->data['Type']['id']=$id;
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('The Type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Type could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
			$this->request->data = $this->Type->find('first', $options);
		}
		$labs = $this->Type->Lab->find('list');
		$this->set(compact('labs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Type->id = $id;
		if (!$this->Type->exists()) {
			throw new NotFoundException(__('Invalid Type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Type->delete()) {
			$this->Session->setFlash(__('The Type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}