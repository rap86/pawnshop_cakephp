<?php 
class TransactionUnderAuctionsController extends AppController
{	  
	var $name  = 'TransactionUnderAuctions';
	var $components = array("AddCustomerTransactionLevels");
	
	function add() {
		
		$this->data['CustomerTransactionLevel']['customer_transaction_id']  = $this->data['CustomerTransaction']['id'];
		$this->data['CustomerTransactionLevel']['status'] 					= $this->data['CustomerTransaction']['status'];
		$this->data['CustomerTransactionLevel']['user_id'] 					= $this->Session->read('Auth.User.id');
		$this->data['CustomerTransactionLevel']['name'] 					= 'under auction';
		
		$this->TransactionUnderAuction->recursive = -1;
		
		if (!empty($this->data)) {
			
			$this->TransactionUnderAuction->create();
			if ($this->TransactionUnderAuction->save($this->data['TransactionUnderAuction'])) {

				$this->updateCustomerTransactionStatus($this->data['CustomerTransaction']['status'], $this->data['CustomerTransaction']['id']);
				$this->AddCustomerTransactionLevels->addLevels($this->data['CustomerTransactionLevel']);
					
				$this->Session->setFlash('The Item has been saved', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
				
			} else {
				$this->Session->setFlash('The Item could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
}
?>