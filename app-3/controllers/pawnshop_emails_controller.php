<?php
class PawnshopEmailsController extends AppController {

	var $name = 'PawnshopEmails';

	
	function index() {
		
		$this->PawnshopEmail->recursive = 0;
		$pawnshop_emails = $this->PawnshopEmail->find('all'); 
		$this->set('pawnshop_emails', $pawnshop_emails);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid PawnshopEmail Email', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pawnshop_email', $this->PawnshopEmail->read(null, $id));
	}

	function add() {
		
		if (!empty($this->data)) {
			$this->PawnshopEmail->create();
			if ($this->PawnshopEmail->save($this->data)) {
				$this->Session->setFlash('The PawnshopEmail Email has been saved', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The PawnshopEmail Email could not be saved. Please, try again.', 'flash_failure');
			}
		}
	}

	function edit($id = null) {
		
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid PawnshopEmail', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PawnshopEmail->save($this->data)) {
				$this->Session->setFlash('PawnshopEmail information updated', 'flash_success');
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash('The PawnshopEmail could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PawnshopEmail->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for PawnshopEmail', 'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PawnshopEmail->delete($id)) {
			$this->Session->setFlash('PawnshopEmail deleted', 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('PawnshopEmail was not deleted', 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}
	
}
?>