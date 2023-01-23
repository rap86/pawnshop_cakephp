<?php

class TransactionPrincipalPaymentsController extends AppController {

	var $name = 'TransactionPrincipalPayments';
	
	function index() {

		$this->TransactionPrincipalPayment->recursive = -1;
		$principal_amounts = $this->TransactionPrincipalPayment->find('all');
		$this->set('principal_amounts', $principal_amounts);
	}

	function view($id = null) {
		
		$this->TransactionPrincipalPayment->recursive = -1;
		if (!$id) {
			$this->Session->setFlash('Invalid TransactionPrincipalPayment', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('TransactionPrincipalPayment', $this->TransactionPrincipalPayment->read(null, $id));
	}

	function add() {
		
		if (!empty($this->data)) {
			
			$this->TransactionPrincipalPayment->create();
			if ($this->TransactionPrincipalPayment->save($this->data['TransactionPrincipalPayment'])) {
				
				$cash_book = array();
				
				$starting_balanced  = $this->fundBookAll();
				$ending_balanced    = $this->fundBookAll() + $this->data['TransactionPrincipalPayment']['amount'];
				
				// this is for cash book 1 report for bir
				if($this->data['TransactionPrincipalPayment']['for_bir'] == 1)
				{
					$starting_balanced_bir  = $this->fundBookAllBIR();
					$ending_balanced_bir    = $this->fundBookAllBIR() + $this->data['TransactionPrincipalPayment']['amount'];
					
					$cash_book['CashBook']['for_bir'] 				= 1;
					$cash_book['CashBook']['starting_balanced_bir'] = $starting_balanced_bir;
					$cash_book['CashBook']['ending_balanced_bir']   = $ending_balanced_bir;
					
					// this is for update of book funds, remaining balanced after
					// new pawned item made by customer
					$this->fundBookAllUpdateBIR($ending_balanced_bir);

				}
				
				$cash_book['CashBook']['customer_id'] 						= $this->data['Customer']['id'];
				$cash_book['CashBook']['book_id'] 							= $this->data['Book']['book_id'];
				$cash_book['CashBook']['customer_transaction_id'] 			= $this->data['TransactionPrincipalPayment']['customer_transaction_id'];
				$cash_book['CashBook']['transaction_principal_payment_id'] 	= $this->TransactionPrincipalPayment->id;
				$cash_book['CashBook']['starting_balanced']					= $starting_balanced;
				$cash_book['CashBook']['less_principal']					= $this->data['TransactionPrincipalPayment']['amount'];
				$cash_book['CashBook']['details'] 							= 'Less principal';
				$cash_book['CashBook']['ending_balanced'] 					= $ending_balanced;
				$cash_book['CashBook']['status'] 							= 'collected';
				$cash_book['CashBook']['enabled'] 							= 1;
				$cash_book['CashBook']['user_id'] 							= $this->Session->read('Auth.User.id');
				$cash_book['CashBook']['date_created'] 						= date('Y-m-d');
				$cash_book['CashBook']['time_created'] 						= date('H:i:s');
				// nilagay ko ito para laging mag papakita sa report yung account balanced kahit walang transaction sa bangko
				$cash_book['CashBook']['ending_bank_balanced'] 				= $this->bankBalancedBookAll();
				
				// this is for update of book funds, remaining balanced after
				// new pawned item made by customer
				$this->fundBookAllUpdate($ending_balanced);
				
				// this is for book reports
				$this->addCashBookRecord($cash_book);
				
				// this is for update of net amount duplicate transaction
				$this->updateCustomerTransactionNetAmount($this->data['TransactionPrincipalPayment']['customer_transaction_id'], $this->data['TransactionPrincipalPayment']['amount']);
				
				// this is for logs
				$this->addTransactionLog($this->TransactionPrincipalPayment->id, 'TransactionPrincipalPayment', 'Less principal amount');
				
				$this->Session->setFlash('The TransactionPrincipalPayment has been saved', 'flash_success');
				$this->redirect(array('controller' => 'customer_transactions', 'action' => 'transaction', $this->data['TransactionPrincipalPayment']['customer_transaction_id']));
				
			} else {
				
				$this->Session->setFlash('The TransactionPrincipalPayment could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}

	function edit($id = null) {
		
		$this->TransactionPrincipalPayment->recursive = -1;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid TransactionPrincipalPayment', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data['TransactionPrincipalPayment'])) {
			if ($this->TransactionPrincipalPayment->save($this->data['TransactionPrincipalPayment'])) {
				$this->Session->setFlash('TransactionPrincipalPayment information updated', 'flash_success');
				$this->addTransactionLog('Edit amount paid on principal amount', 'TransactionPrincipalPayment', $this->TransactionPrincipalPayment->id);
				$this->redirect(array('controller' => 'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
			} else {
				$this->Session->setFlash('The TransactionPrincipalPayment could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TransactionPrincipalPayment->read(null, $id);
		}
	}

	function delete($id = null) {
		
		$this->log($this->data, 'delete_prin');
		
		if (!$this->data['TransactionPrincipalPayment']['id']) {
			$this->Session->setFlash('Invalid id for TransactionPrincipalPayment', 'flash_failure');
			$this->redirect(array('controller'=> 'customer_transactions', 'action'=>'transaction', $this->data['CustomerTransaction']['id']));
		}
		if ($this->TransactionPrincipalPayment->delete($this->data['TransactionPrincipalPayment']['id'])) {
			
			
				$this->cancelPrincipalPayment($this->data['CustomerTransaction']['id'], $this->data['TransactionPrincipalPayment']['amount']);
			
				$starting_balanced  = $this->fundBookAll() - $this->data['TransactionPrincipalPayment']['amount'];
				$this->fundBookAllUpdate($starting_balanced);
				
				// this is for cash book 1 report for bir
				if($this->data['TransactionPrincipalPayment']['for_bir'] == 1)
				{
					$starting_balanced_bir  = $this->fundBookAllBIR() - $this->data['TransactionPrincipalPayment']['amount'];
					
					// this is for update of book funds, remaining balanced after
					// new pawned item made by customer
					$this->fundBookAllUpdateBIR($starting_balanced_bir);

				}
				
				$this->deletePrincipalPaymentCashBook($this->data['TransactionPrincipalPayment']['id']);
				
			$this->Session->setFlash('TransactionPrincipalPayment deleted', 'flash_success');
			$this->redirect(array('controller'=> 'customer_transactions', 'action'=>'transaction', $this->data['CustomerTransaction']['id']));
		}
		$this->Session->setFlash('TransactionPrincipalPayment was not deleted', 'flash_failure');
		$this->redirect(array('controller'=> 'customer_transactions', 'action'=>'transaction', $this->data['CustomerTransaction']['id']));
	}
}
?>