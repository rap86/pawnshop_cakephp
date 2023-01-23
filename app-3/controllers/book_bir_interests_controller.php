<?php
class BookBirInterestsController extends AppController {

	var $name = 'BookBirInterests';
	
	function index() {
		
		$this->BookBirInterest->recursive = 0;
		$this->set('interests', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid BookBirInterest', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('interest', $this->BookBirInterest->read(null, $id));
	}

	function add() {
		
		if (!empty($this->data)) {
			$this->BookBirInterest->create();
			if ($this->BookBirInterest->save($this->data)) {
				$this->Session->setFlash('The BookBirInterest has been saved', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The BookBirInterest could not be saved. Please, try again.', 'flash_failure');
			}
		}
	}

	function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid BookBirInterest', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BookBirInterest->save($this->data)) {
				$this->Session->setFlash('BookBirInterest information updated', 'flash_success');
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash('The BookBirInterest could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BookBirInterest->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for BookBirInterest', 'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BookBirInterest->delete($id)) {
			$this->Session->setFlash('BookBirInterest deleted', 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('BookBirInterest was not deleted', 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}
}
?>