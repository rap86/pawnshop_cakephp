<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function beforeFilter() {
		
		parent::beforeFilter();
		$this->Auth->allow("add");
		
		if ($this->action == "add" || $this->action == "edit")
		{
			$this->Auth->authenticate = $this->User;
		}
	}
	
	function login() {
		
		$this->layout = "login";
	}
	
	function logout() {
		$this->Session->setFlash('Logout successful!');
		$this->redirect($this->Auth->logout());
	}
	
	function index() {
		
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid user', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The user has been saved', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_failure');
			}
		}
	}

	function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid user', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('User information updated', 'flash_success');
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for user', 'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash('User deleted', 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('User was not deleted', 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}
	
	function call_delete_log() {
		
		$this->loadModel('Log');
		$this->Log->query("delete from logs");
		$this->addTransactionLog('User Deleted the Logs', 'User', $this->Session->read('Auth.User.id'));
		$this->Session->setFlash('You deleted Logs', 'flash_success');
		$this->redirect(array('controller'=> 'homes', 'action'=>'call_delete_log'));
		
	}
	
}
?>