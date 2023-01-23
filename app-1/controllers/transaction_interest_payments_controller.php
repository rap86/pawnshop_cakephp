<?php

class TransactionInterestPaymentsController extends AppController {

	var $name = 'TransactionInterestPayments';
	var $components = array('Email', 'AddCustomerTransactionLevels');
	
	function text()
	{
	
	}
	
	function index() {

		$this->TransactionInterestPayment->recursive = -1;
		$transaction_details = $this->TransactionInterestPayment->find('all');
		$this->set('transaction_details', $transaction_details);
	}

	function view($id = null) {
		
		$this->TransactionInterestPayment->recursive = -1;
		if (!$id) {
			$this->Session->setFlash('Invalid TransactionInterestPayment', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('transaction_payment', $this->TransactionInterestPayment->read(null, $id));
	}

	function add() {
		
		$this->TransactionInterestPayment->recursive = -1;
		//$this->log($this->data, 'this1');
		if (!empty($this->data)) {
			

			if(trim($this->data['TransactionInterestPayment']['pt_number']) == '')
			{
				if($this->data['TransactionInterestPayment']['book_id'] == 1) {
	
					$pt_number = $this->nextPtNumberBook1();
					
				} elseif($this->data['TransactionInterestPayment']['book_id'] == 2) {
					
					$pt_number = $this->nextPtNumberBook2();
					
				} else {
					
					$pt_number = $this->nextPtNumberBook3();
				}
				
				$this->data['TransactionInterestPayment']['pt_number']  = $pt_number;
			}			
			
			$this->data['TransactionInterestPayment']['user_id'] 	= $this->Session->read('Auth.User.id');
			
			$this->TransactionInterestPayment->create();
			if ($this->TransactionInterestPayment->save($this->data['TransactionInterestPayment'])) {
				
				$this->addTransactionLog($this->TransactionInterestPayment->id, 'TransactionInterestPayment', 'New PT number created');
				$this->updateIncrementPtNumbers($this->data['TransactionInterestPayment']['book_id'], $pt_number + 1);
				
				$this->Session->setFlash('The TransactionInterestPayment has been saved', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['TransactionInterestPayment']['customer_transaction_id']));
				
			} else {
				$this->Session->setFlash('The TransactionInterestPayment could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}

	function edit($id = null) {

		$this->TransactionInterestPayment->recursive = -1;
		
		if (!$id && empty($this->data)) {
			
			$this->Session->setFlash('Invalid TransactionInterestPayment', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			if ($this->TransactionInterestPayment->save($this->data['TransactionInterestPayment'])) {
				
				$cash_book = array();
				
				$starting_balanced  = $this->fundBookAll();
				$ending_balanced    = $this->fundBookAll() + $this->data['TransactionInterestPayment']['grand_interest_amount'];
				
				// this is for cash book 1 report for bir
				if($this->data['TransactionInterestPayment']['for_bir'] == 1)
				{
					$starting_balanced_bir  = $this->fundBookAllBIR();
					$ending_balanced_bir    = $this->fundBookAllBIR() + $this->data['TransactionInterestPayment']['grand_interest_amount'];
					
					$cash_book['CashBook']['for_bir'] 				= 1;
					$cash_book['CashBook']['starting_balanced_bir'] = $starting_balanced_bir;
					$cash_book['CashBook']['ending_balanced_bir']   = $ending_balanced_bir;
					
					// this is for update of book funds, remaining balanced after
					// new pawned item made by customer
					$this->fundBookAllUpdateBIR($ending_balanced_bir);

				}
				
				
				$cash_book['CashBook']['book_id'] 							= $this->data['TransactionInterestPayment']['book_id'];
				$cash_book['CashBook']['customer_transaction_id'] 			= $this->data['TransactionInterestPayment']['customer_transaction_id'];
				$cash_book['CashBook']['transaction_interest_payment_id'] 	= $this->TransactionInterestPayment->id;
				$cash_book['CashBook']['starting_balanced']					= $starting_balanced;
				$cash_book['CashBook']['pt_number'] 						= $this->data['TransactionInterestPayment']['pt_number'];
				$cash_book['CashBook']['interest_amount']					= $this->data['TransactionInterestPayment']['grand_interest_amount'] - $this->serviceChargeAmount();
				$cash_book['CashBook']['or_number']							= $this->data['TransactionInterestPayment']['or_number'];
				$cash_book['CashBook']['service_charge'] 					= $this->serviceChargeAmount();
				$cash_book['CashBook']['details'] 							= 'Interest payment';
				$cash_book['CashBook']['ending_balanced'] 					= $ending_balanced;
				$cash_book['CashBook']['status'] 							= 'collected';
				$cash_book['CashBook']['enabled'] 							= 1;
				$cash_book['CashBook']['date_created'] 						= date('Y-m-d');
				$cash_book['CashBook']['time_created'] 						= date('H:i:s');
				// nilagay ko ito para laging mag papakita sa report yung account balanced kahit walang transaction sa bangko
				$cash_book['CashBook']['ending_bank_balanced'] 				= $this->bankBalancedBookAll();
				
				// this is for update of book funds, remaining balanced after
				// new pawned item made by customer
				$this->fundBookAllUpdate($ending_balanced);
		
				// this is for book reports
				$this->addCashBookRecord($cash_book);
				
				// this is for logs
				$this->addTransactionLog($this->TransactionInterestPayment->id, 'TransactionInterestPayment', 'Interest payment');
	

				$this->Session->setFlash('TransactionInterestPayment information updated', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['TransactionInterestPayment']['customer_transaction_id']));
				
			} else {
				
				$this->Session->setFlash('The TransactionInterestPayment could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TransactionInterestPayment->read(null, $id);
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for TransactionInterestPayment', 'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TransactionInterestPayment->delete($id)) {
			$this->Session->setFlash('TransactionInterestPayment deleted', 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('TransactionInterestPayment was not deleted', 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}
	
	
	function sendmail() {
		
		$email_password = $this->pawshopEmail();
	
		// ini_set("max_input_time",0);
		// set_time_limit(0);
		// ini_set("memory_limit","1000M");

		$this->layout = false;

			//$this->Email->reset();
			$this->Email->smtpOptions = array(
			     'port'=>'465',
			     'timeout'=>'30',
			     'host' => 'ssl://smtp.gmail.com',
			     'username' => $email_password[0]['PawnshopEmail']['email'],
			     'password'=> $email_password[0]['PawnshopEmail']['password'],
			);
			// $this->Email->delivery = 'debug';
			 $this->Email->delivery = 'smtp';
	
	
		    $this->Email->to = 'ronaldo.panuelos@gmail.com';
			$this->Email->from = 'ronaldo.panuelos@gmail.com';
			$this->Email->cc = array('ronaldo.panuelos@gmail.com');
			// $this->Email->bcc = array('<reymarthizon16@gmail.com'>);
			$this->Email->subject = 'Amount Due Reminder!';
			// $this->Email->replyTo = 'support@example.com';
			$this->Email->template = 'simple_message'; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$this->Email->sendAs = 'both'; // because we like to send pretty mail
			//Set view variables as normal
			
			$customerId 	 = $this->data['Customer']['id'];
			$customerName 	 = $this->data['Customer']['first_name'].' '.$this->data['Customer']['middle_name'].' '.$this->data['Customer']['last_name'];
			$customerEmail 	 = $this->data['Customer']['email'];
			$ptNumber		 = $this->data['TransactionInterestPayment']['id'];
			$principalAmount = $this->data['CustomerTransaction']['gross_amount'];
			$interest		 = $this->data['TransactionInterestPayment']['payment_due_interest'];
			$dueAmount 		 = $this->data['TransactionInterestPayment']['payment_due_amount'];
			$dueDate 		 = $this->data['TransactionInterestPayment']['payment_due_date'];
				
			$this->set('value', $this->data);

			//Do not pass any args to send()
			
			/*
			$this->Email->attachments = array(
			    APP . 'foo.docx',
			    'bar.doc' => APP . 'mat.docx'
			);
			*/
			
			if($this->Email->send()){
				
				$this->addEmailLog($customerId, $customerName , $customerEmail, $ptNumber, $principalAmount,  $interest, $dueAmount, $dueDate);
				$this->addTransactionLog('Send Email Notification', 'TransactionInterestPayment', 0); 
				
				$this->Session->setFlash('Email has been sent', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
				
			} else {
				// echo $this->Email->smtpError;
				// $this->log($this->Email->smtpError, 'email_password_error');
				$this->addTransactionLog($this->Email->smtpError, 'TransactionInterestPayment', $this->data['TransactionInterestPayment']['id']); 
				$this->Session->setFlash($this->Email->smtpError, 'flash_failure');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
			}							

		
	}
	
	
	function search() {
		
		$this->loadModel('CustomerTransaction');

		$paymentDetails = $this->TransactionInterestPayment->query("
			select 
			*
			from transaction_interest_payments TransactionInterestPayment
				join 
			customer_transactions CustomerTransaction on CustomerTransaction.id = TransactionInterestPayment.customer_transaction_id 
				where 
			TransactionInterestPayment.pt_number = '{$this->data['TransactionInterestPayment']['pt_number']}' and TransactionInterestPayment.status = 'unpaid'
			
			");
		/*
		echo '<pre>';
			print_r($paymentDetails);
		echo '</pre>';
		*/
		$this->set('payment_details', $paymentDetails);

	}
}
?>