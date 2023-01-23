<?php 
class TransactionRedeemItemsController extends AppController
{	  
	var $name  		= 'TransactionRedeemItems';
	var $components = array("AddCustomerTransactionLevels");
	
	function add() {
		
		$this->TransactionRedeemItem->recursive = -1;
		
		if (!empty($this->data)) {
			
			$this->TransactionRedeemItem->create();
			if ($this->TransactionRedeemItem->save($this->data['TransactionRedeemItem'])) {
				
				$this->data['CustomerTransactionLevel']['customer_transaction_id']  = $this->data['TransactionRedeemItem']['customer_transaction_id'];
				$this->data['CustomerTransactionLevel']['status'] 					= $this->data['TransactionRedeemItem']['status'];
				$this->data['CustomerTransactionLevel']['user_id'] 					= $this->Session->read('Auth.User.id');
				$this->data['CustomerTransactionLevel']['name'] 					= 'Redeemed';
				
				$cash_book = array();
				
				$starting_balanced  = $this->fundBookAll();
				$ending_balanced    = $this->fundBookAll() + $this->data['TransactionRedeemItem']['grand_amount'];
				
				// this is for cash book 1 report for bir
				if($this->data['TransactionRedeemItem']['for_bir'] == 1)
				{
					$starting_balanced_bir  = $this->fundBookAllBIR();
					$ending_balanced_bir    = $this->fundBookAllBIR() + $this->data['TransactionRedeemItem']['grand_amount'];
					
					$cash_book['CashBook']['for_bir'] 				= 1;
					$cash_book['CashBook']['starting_balanced_bir'] = $starting_balanced_bir;
					$cash_book['CashBook']['ending_balanced_bir']   = $ending_balanced_bir;
					
					// this is for update of book funds, remaining balanced after
					// new pawned item made by customer
					$this->fundBookAllUpdateBIR($ending_balanced_bir);

				}
				
				$cash_book['CashBook']['customer_id'] 					= $this->data['Customer']['id'];
				$cash_book['CashBook']['book_id'] 						= $this->data['Book']['book_id'];
				$cash_book['CashBook']['customer_transaction_id'] 		= $this->data['TransactionRedeemItem']['customer_transaction_id'];
				$cash_book['CashBook']['transaction_redeem_item_id']	= $this->TransactionRedeemItem->id;
				$cash_book['CashBook']['starting_balanced']				= $starting_balanced;
				$cash_book['CashBook']['redeemed']						= $this->data['TransactionRedeemItem']['grand_amount'] - $this->serviceChargeAmount();
				$cash_book['CashBook']['redeem_sold_capital']			= $this->data['TransactionRedeemItem']['remaining_principal'];
				$cash_book['CashBook']['redeem_sold_difference_amount']	= $this->data['TransactionRedeemItem']['grand_amount'] - $this->data['TransactionRedeemItem']['remaining_principal'];
				$cash_book['CashBook']['or_number']						= $this->data['TransactionRedeemItem']['or_number'];
				$cash_book['CashBook']['service_charge'] 				= $this->serviceChargeAmount();
				$cash_book['CashBook']['details'] 						= 'Redeemed';
				$cash_book['CashBook']['ending_balanced'] 				= $ending_balanced;
				$cash_book['CashBook']['status'] 						= 'collected';
				$cash_book['CashBook']['enabled'] 						= 1;
				$cash_book['CashBook']['user_id'] 							= $this->Session->read('Auth.User.id');
				$cash_book['CashBook']['date_created'] 					= $this->data['TransactionRedeemItem']['date_redeemed'];
				$cash_book['CashBook']['time_created'] 					= date('H:i:s');
				// nilagay ko ito para laging mag papakita sa report yung account balanced kahit walang transaction sa bangko
				$cash_book['CashBook']['ending_bank_balanced'] 			= $this->bankBalancedBookAll();
				
				// this is for update of book funds, remaining balanced after
				// new pawned item made by customer
				// redeemed
				// payment interest
				// payment principal
				// sold items
				$this->fundBookAllUpdate($ending_balanced);
				
				// i call this function from app controller
				// this is for cash book report
				$this->addCashBookRecord($cash_book);
				
				// i call this function from app controller
				// this is to update the status of customer transaction
				$this->updateCustomerTransactionStatus($this->data['TransactionRedeemItem']['status'], $this->data['TransactionRedeemItem']['customer_transaction_id']);
				
				// this is for transaction action level example
				// under auction ua
				// redeemed redeemed
				// auction item auctioned
				$this->AddCustomerTransactionLevels->addLevels($this->data['CustomerTransactionLevel']);
				
				$this->Session->setFlash('The UnderAuctionsItems has been saved', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['TransactionRedeemItem']['customer_transaction_id']));
				
			} else {
				
				$this->Session->setFlash('The UnderAuctionsItems could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
	function edit($id = null) {

		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid TransactionRedeemItem', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			if ($this->TransactionRedeemItem->save($this->data)) {
				
				$this->Session->setFlash('TransactionRedeemItem information updated', 'flash_success');
				$this->redirect(array('controller'=>'homes', 'action' => 'dashboard'));
			
			} else {
				
				$this->Session->setFlash('The TransactionRedeemItem could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TransactionRedeemItem->read(null, $id);
		}
	}
}
?>