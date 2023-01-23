<?php 
class TransactionInOutItemsController extends AppController
{	  
	var $name  = 'TransactionInOutItems';
	var $components = array("AddCustomerTransactionLevels");
	
	function add(){
		
		$this->data['CustomerTransactionLevel']['customer_transaction_id']  = $this->data['TransactionInOutItem']['customer_transaction_id'];
		$this->data['CustomerTransactionLevel']['status'] 					= $this->data['TransactionInOutItem']['status'];
		$this->data['CustomerTransactionLevel']['user_id'] 					= $this->Session->read('Auth.User.id');
		$this->data['CustomerTransactionLevel']['name'] 					= 'Takeout';
		
		$this->TransactionInOutItems->recursive = -1;
		
		if (!empty($this->data)) {
			
			$this->TransactionInOutItem->create();
			if ($this->TransactionInOutItem->save($this->data['TransactionInOutItem'])) {

				$this->updateCustomerTransactionStatus($this->data['TransactionInOutItem']['status'], $this->data['TransactionInOutItem']['customer_transaction_id']);
				$this->AddCustomerTransactionLevels->addLevels($this->data['CustomerTransactionLevel']);
					
				$this->Session->setFlash('The Item has been saved', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['TransactionInOutItem']['customer_transaction_id']));
				
			} else {
				$this->Session->setFlash('The Item could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
}
?>