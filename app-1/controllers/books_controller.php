<?php

class BooksController extends AppController {

	var $name = 'Books';
	

	function index() {

		$this->Book->recursive = -1;
		$books = $this->Book->find('all');
		$this->set('books', $books);
	}

	function view($id = null) {
		
		$this->Book->recursive = -1;
		if (!$id) {
			$this->Session->setFlash('Invalid Book', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('book', $this->Book->read(null, $id));
	}

	function add() {
		
		if (!empty($this->data)) {
			$this->Book->create();
			if ($this->Book->save($this->data)) {
				$this->Session->setFlash('The Book has been saved', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Book could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}

	function edit($id = null) {
		
		$this->Book->recursive = -1;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Book', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Book->save($this->data)) {
				$this->Session->setFlash('Book information updated', 'flash_success');
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash('The Book could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Book->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Book', 'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Book->delete($id)) {
			$this->Session->setFlash('Book deleted', 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('Book was not deleted', 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}
}
?>