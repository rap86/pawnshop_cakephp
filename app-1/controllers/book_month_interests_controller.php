<?php

class BookMonthInterestsController extends AppController {

	var $name = 'BookMonthInterests';
	

	function index() {

		$this->BookMonthInterest->recursive = -1;
		$book_month_interests = $this->BookMonthInterest->find('all');
		$this->set('book_month_interests', $book_month_interests);
	}

	function view($id = null) {
		
		$this->BookMonthInterest->recursive = -1;
		if (!$id) {
			$this->Session->setFlash('Invalid Book', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('book_month_interest', $this->BookMonthInterest->read(null, $id));
	}

	function add() {
		
		$books_id = $this->BookMonthInterest->Book->find('list');
		
		if (!empty($this->data)) {
			$this->BookMonthInterest->create();
			if ($this->BookMonthInterest->save($this->data)) {
				$this->Session->setFlash('The BookMonthInterest has been saved', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The BookMonthInterest could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
		$this->set('books_id', $books_id);
		
	}

	function edit($id = null) {
		
		$books_id = $this->BookMonthInterest->Book->find('list');
		
		$this->BookMonthInterest->recursive = -1;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Book', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BookMonthInterest->save($this->data)) {
				$this->Session->setFlash('Book information updated', 'flash_success');
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash('The Book could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BookMonthInterest->read(null, $id);
		}
		$this->set('books_id', $books_id);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for BookMonthInterest', 'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BookMonthInterest->delete($id)) {
			$this->Session->setFlash('BookMonthInterest deleted', 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('BookMonthInterest was not deleted', 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}
	
	function categories()
	{
		$this->loadModel('Book');
		
		$this->Book->Behaviors->attach('containable');
		$categories = $this->Book->find('all', array(
						'contain'=>array(
								'BookMonthInterest'
				)
			)
		);
		/*
		echo '<pre>';
		print_r($categories);
		echo '</pre>';
		*/
		$this->set('categories', $categories);
	}
}
?>