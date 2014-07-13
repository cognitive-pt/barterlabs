<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
App::uses('AppController', 'Controller');
/**
 * Towns Controller
 *
 * @property Town $Town
 * @property PaginatorComponent $Paginator
 */
class TownsController extends AppController {

	//	 * This controller uses following models
	public $uses = array('Usermgmt.User', 'Usermgmt.UserGroup', 'Usermgmt.UserSetting', 'Usermgmt.TmpEmail', 'Usermgmt.UserDetail', 'Usermgmt.UserActivity', 'Usermgmt.LoginToken', 'Usermgmt.UserGroupPermission', 'Usermgmt.UserContact', 'Tradeicon', 'Lab', 'Town');



	//	 * This controller uses following components
	public $components = array('RequestHandler', 'Usermgmt.UserConnect', 'Cookie', 'Usermgmt.Search', 'Usermgmt.ControllerList', 'Paginator');

	var $name = 'Towns';

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
		$this->Town->recursive = 0;
		$this->set('towns', $this->Town->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Town->exists($id)) {
			throw new NotFoundException(__('Invalid town'));
		}
		$options = array('conditions' => array('Town.' . $this->Town->primaryKey => $id));
		$this->set('town', $this->Town->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Town->create();
			if ($this->Town->save($this->request->data)) {
				$this->Session->setFlash(__('The town has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The town could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$labs = $this->Town->Lab->find('list');
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
		if (!$this->Town->exists($id)) {
			throw new NotFoundException(__('Invalid town'));
		}
		if ($this->request->is(array('post', 'put'))) {
			//!!!without this it will create a new entry!!!
			$this->request->data['Town']['id']=$id;
			if ($this->Town->save($this->request->data)) {
				$this->Session->setFlash(__('The town has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The town could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Town.' . $this->Town->primaryKey => $id));
			$this->request->data = $this->Town->find('first', $options);
		}
		$labs = $this->Town->Lab->find('list');
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
		$this->Town->id = $id;
		if (!$this->Town->exists()) {
			throw new NotFoundException(__('Invalid town'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Town->delete()) {
			$this->Session->setFlash(__('The town has been deleted.'));
		} else {
			$this->Session->setFlash(__('The town could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}