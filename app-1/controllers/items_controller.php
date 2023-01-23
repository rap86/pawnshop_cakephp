<?php

class ItemsController extends AppController {

	var $name = 'Items';
	
	function index() {

		$this->Item->recursive = -1;
		$items = $this->Item->find('all');
		$this->set('items', $items);
	}

	function view($id = null) {
		
		$this->Item->recursive = -1;
		if (!$id) {
			$this->Session->setFlash('Invalid Item', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}

	function add() {
		
		if (!empty($this->data)) {
			$this->Item->create();
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash('The Item has been saved', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Item could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}

	function edit($id = null) {
		
		$this->Item->recursive = -1;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Item', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash('Item information updated', 'flash_success');
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash('The Item could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Item->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Item', 'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Item->delete($id)) {
			$this->Session->setFlash('Item deleted', 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('Book was not deleted', 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}

}
?>