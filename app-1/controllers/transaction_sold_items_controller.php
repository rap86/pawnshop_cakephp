<?php 
class TransactionSoldItemsController extends AppController
{	  
	var $name  = 'TransactionSoldItems';
	var $components = array("AddCustomerTransactionLevels");
	
	function add() 
	{
		$customer_transaction_id = $this->data['TransactionSoldItem']['customer_transaction_id'];
		
		$this->data['TransactionActionLevel']['customer_transaction_id']    = $this->data['TransactionSoldItem']['customer_transaction_id'];
		$this->data['TransactionActionLevel']['status'] 					= $this->data['TransactionSoldItem']['status'];
		$this->data['TransactionActionLevel']['user_id'] 					= $this->Session->read('Auth.User.id');
		$this->data['TransactionActionLevel']['name'] 					    = 'Partial auctioned';
		
		$this->data['TransactionSoldItem']['user_id'] 						= $this->Session->read('Auth.User.id');
		
		$total_sold_partial = $this->data['TransactionSoldItem']['partial_capital'] + $this->data['TransactionSoldItem']['sold_price'];
		
		if($total_sold_partial > $this->data['TransactionSoldItem']['pawned_net_amount_duplicate'])
		{
			$partial_capital = $this->data['TransactionSoldItem']['sold_price'];
			$interest_amount = $total_sold_partial - $this->data['TransactionSoldItem']['pawned_net_amount_duplicate'];
			$total_capital = 0;
			
		} else {
			
			$interest_amount = 0;
			$total_capital   = $this->data['TransactionSoldItem']['sold_price'];
			$partial_capital = $this->data['TransactionSoldItem']['sold_price'];
			
		}

		$this->TransactionSoldItem->recursive = -1;
		
		if (!empty($this->data)) 
		{
			$this->TransactionSoldItem->create();
			if ($this->TransactionSoldItem->save($this->data['TransactionSoldItem']))
			{
				$cash_book = array();
				
				$starting_balanced  = $this->fundBookAll();
				$ending_balanced    = $this->fundBookAll() + $this->data['TransactionSoldItem']['sold_price'];
			
				// this is for cash book 1 report for bir
				if($this->data['TransactionSoldItem']['for_bir'] == 1)
				{
					$starting_balanced_bir  = $this->fundBookAllBIR();
					$ending_balanced_bir    = $this->fundBookAllBIR() + $this->data['TransactionSoldItem']['sold_price'];
					
					$cash_book['CashBook']['for_bir'] 				= 1;
					$cash_book['CashBook']['starting_balanced_bir'] = $starting_balanced_bir;
					$cash_book['CashBook']['ending_balanced_bir']   = $ending_balanced_bir;
					
					// this is for update of book funds, remaining balanced after
					// new pawned item made by customer
					$this->fundBookAllUpdateBIR($ending_balanced_bir);

				}
				
				$cash_book['CashBook']['customer_id'] 					= $this->data['TransactionSoldItem']['customer_id'];
				$cash_book['CashBook']['book_id'] 						= $this->data['TransactionSoldItem']['book_id'];
				$cash_book['CashBook']['customer_transaction_id'] 		= $this->data['TransactionSoldItem']['customer_transaction_id'];
				$cash_book['CashBook']['pt_number'] 					= $this->data['TransactionSoldItem']['pt_number'];
				$cash_book['CashBook']['starting_balanced']				= $starting_balanced;
				$cash_book['CashBook']['sold']							= $this->data['TransactionSoldItem']['sold_price'];
				$cash_book['CashBook']['redeem_sold_capital']			= $total_capital;
				$cash_book['CashBook']['redeem_sold_difference_amount']	= $interest_amount;
				$cash_book['CashBook']['details'] 						= 'Auctioned';
				$cash_book['CashBook']['date_created'] 					= date('Y-m-d');
				$cash_book['CashBook']['time_created'] 					= date('H:i:s');
				$cash_book['CashBook']['ending_balanced'] 				= $ending_balanced;
				$cash_book['CashBook']['status'] 						= 'collected';
				$cash_book['CashBook']['enabled'] 						= 1;
				$cash_book['CashBook']['user_id'] 						= $this->Session->read('Auth.User.id');
				$cash_book['CashBook']['or_number'] 					= $this->data['TransactionSoldItem']['or_number'];
				// nilagay ko ito para laging mag papakita sa report yung account balanced kahit walang transaction sa bangko
				$cash_book['CashBook']['ending_bank_balanced'] 			= $this->bankBalancedBookAll();
				
				// i call this function from app controller
				// this is for cash book report
				$this->addCashBookRecord($cash_book);
				
				// this is for update of book funds, remaining balanced after
				// new pawned item made by customer
				// redeemed
				// payment interest
				// payment principal
				// sold items
				$this->fundBookAllUpdate($ending_balanced);
				
				// partial status kung may bibili ex. total pcs 10 ang bibilin lang 5pcs ganon
				$this->updateCustomerTransactionParialStatus('semiua', $customer_transaction_id);
				

				// para sa monthly report to kung may partial na bumili ng item
				$returnVal = $this->returnPartial($customer_transaction_id);
				
				if($returnVal != null)
				{
					$partial_capital += $returnVal;
				}
				
				
				$this->updatePartialCapital($partial_capital, $customer_transaction_id);
				
				
				//  update for customer_transactions status to become auctioned
				//$this->updateCustomerTransactionStatus('auctioned', $customer_transaction_id);
				

				$this->addTransactionLog($customer_transaction_id, 'TransactionSoldItem', 'Sold item partial');
				
				$this->AddCustomerTransactionLevels->addLevels($this->data['TransactionActionLevel']);
					
				$this->Session->setFlash('The TransactionSoldItem has been saved', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $customer_transaction_id));
				
			} else {
				
				$this->Session->setFlash('The TransactionSoldItem could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
	function auctioned_status() 
	{
		/*
		echo '<pre>';
		print_r($this->data);
		echo '</pre>';
		*/
		$this->data['TransactionActionLevel']['customer_transaction_id']    = $this->data['TransactionSoldItem']['customer_transaction_id'];
		$this->data['TransactionActionLevel']['status'] 					= $this->data['TransactionSoldItem']['status'];
		$this->data['TransactionActionLevel']['user_id'] 					= $this->Session->read('Auth.User.id');
		$this->data['TransactionActionLevel']['name'] 					    = 'Auctioned';
		
		$this->TransactionSoldItem->recursive = -1;
		
		if (!empty($this->data['TransactionSoldItem'])) 
		{
			//  update for customer_transactions status to become auctioned
			$this->updateCustomerTransactionStatus('auctioned', $this->data['TransactionSoldItem']['customer_transaction_id']);
			
			$this->addTransactionLog($this->data['TransactionSoldItem']['customer_transaction_id'], 'TransactionSoldItem', 'Sold item done');
			
			$this->AddCustomerTransactionLevels->addLevels($this->data['TransactionActionLevel']);
				
			$this->Session->setFlash('The TransactionSoldItem has been saved', 'flash_success');
			$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['TransactionSoldItem']['customer_transaction_id']));
			
		} else {
			
			$this->Session->setFlash('The TransactionSoldItem could not be saved. Please, try again.', 'flash_failure');
		}
		
	}
	
}
?>