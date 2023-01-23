<?php
class CustomerTransactionsController extends AppController {
	
	var $name = 'CustomerTransactions';
	var $helpers = array('Html', 'Form', 'Ajax');
	var $uses = array('CustomerTransaction', 'Book', 'Item', 'User', 'Customer', 'TransactionUnderAuction', 'CashBook');
	var $components = array("AddCustomerTransactionLevels");
	
	function redeemed() {
		
		if(!isset($this->data['CustomerTransaction']['date_from']))
		{
			$this->data['CustomerTransaction']['date_from'] = date('Y-m-d');
		}
		if(!isset($this->data['CustomerTransaction']['date_to']))
		{
			$this->data['CustomerTransaction']['date_to'] = date('Y-m-d');
		}
		
		$query_result = $this->CustomerTransaction->query("
			select 
				Customer.first_name,
				Customer.middle_name,
				Customer.last_name,
				Customer.gender,
				Customer.image_location,
				CustomerTransaction.id,
				CustomerTransaction.book_id,
				CustomerTransaction.item_type,
				CustomerTransaction.jewelry_type,
				CustomerTransaction.image_location,
				CustomerTransaction.month_before_remata,
				CustomerTransaction.status,
				CustomerTransaction.sangla_date,
				CustomerTransaction.sangla_time,
				TransactionRedeemItem.id,
				TransactionRedeemItem.date_redeemed,
				TransactionRedeemItem.time_redeemed
			from 
				customers Customer 
			join 
				customer_transactions CustomerTransaction
					on 	
				Customer.id = CustomerTransaction.customer_id
			join
				transaction_redeem_items TransactionRedeemItem
					on
				TransactionRedeemItem.customer_transaction_id = CustomerTransaction.id	
			where 
				CustomerTransaction.status = 'redeemed'
			and
				TransactionRedeemItem.date_redeemed >= '{$this->data['CustomerTransaction']['date_from']}'
			and
				TransactionRedeemItem.date_redeemed <= '{$this->data['CustomerTransaction']['date_to']}'
		");
		
		$date['date_from'] = $this->data['CustomerTransaction']['date_from'];
		$date['date_to']   = $this->data['CustomerTransaction']['date_to'];
				
		foreach($query_result as $key => $value)
		{
			$datas[ $value['CustomerTransaction']['id'] ]['Customer'] 				= $value['Customer'];
			$datas[ $value['CustomerTransaction']['id'] ]['CustomerTransaction'] 	= $value['CustomerTransaction'];
			$datas[ $value['CustomerTransaction']['id'] ]['TransactionRedeemItem'] 			= $value['TransactionRedeemItem'];
		}
		
		$this->set('date', $date);
		$this->set('datas', $datas);
	}
	
	function auctioned() {
		
		if(!isset($this->data['CustomerTransaction']['date_from']))
		{
			$this->data['CustomerTransaction']['date_from'] = date('Y-m-d');
		}
		if(!isset($this->data['CustomerTransaction']['date_to']))
		{
			$this->data['CustomerTransaction']['date_to'] = date('Y-m-d');
		}
		
		$query_result = $this->CustomerTransaction->query("
			select 
				Customer.first_name,
				Customer.middle_name,
				Customer.last_name,
				Customer.gender,
				Customer.image_location,
				CustomerTransaction.id,
				CustomerTransaction.book_id,
				CustomerTransaction.item_type,
				CustomerTransaction.jewelry_type,
				CustomerTransaction.image_location,
				CustomerTransaction.month_before_remata,
				CustomerTransaction.status,
				CustomerTransaction.sangla_date,
				CustomerTransaction.sangla_time,
				TransactionSoldItem.id,
				TransactionSoldItem.date_sold,
				TransactionSoldItem.time_sold
			from 
				customers Customer 
			join 
				customer_transactions CustomerTransaction
					on 	
				Customer.id = CustomerTransaction.customer_id
			join
				transaction_sold_items TransactionSoldItem
					on
				TransactionSoldItem.customer_transaction_id = CustomerTransaction.id	
			where 
				CustomerTransaction.status = 'auctioned'
			and
				TransactionSoldItem.date_sold >= '{$this->data['CustomerTransaction']['date_from']}'
			and
				TransactionSoldItem.date_sold <= '{$this->data['CustomerTransaction']['date_to']}'
		");
		
		$date['date_from'] = $this->data['CustomerTransaction']['date_from'];
		$date['date_to']   = $this->data['CustomerTransaction']['date_to'];
				
		foreach($query_result as $key => $value)
		{
			$datas[ $value['CustomerTransaction']['id'] ]['Customer'] 				 = $value['Customer'];
			$datas[ $value['CustomerTransaction']['id'] ]['CustomerTransaction'] 	 = $value['CustomerTransaction'];
			$datas[ $value['CustomerTransaction']['id'] ]['TransactionSoldItem'] 	 = $value['TransactionSoldItem'];
		}

		$this->set('date', $date);
		$this->set('datas', $datas);
	}
	
	function under_auction() {
		
		// ua = under auction
		$datas = $this->transactionStatus($status = 'ua');
		
		$this->set('datas', $datas);
		
	}
	
	function takeout() {
		
		// takeput = under auction but the item is not in pawnshop
		$datas = $this->transactionStatus($status = 'takeout');
		
		$this->set('datas', $datas);
		
	}
	
	function buyin($customer_id = null) {
		
		// ua = under auction
		$datas = $this->transactionStatus($status = 'ua');
		
		$this->set('customer_id', $customer_id);
		$this->set('datas', $datas);
	}
	
	function buyout($customer_id = null) {
		
		// ua = under auction
		$datas = $this->transactionStatus($status = 'takeout');
		
		$this->set('customer_id', $customer_id);
		$this->set('datas', $datas);
	}
	
	function pawn() {
		
		$datas = $this->transactionStatus($status = 'pawned');

		$this->set('datas', $datas);
	}
	
	
	function transactionStatus($status) {
		
		$query_result = $this->CustomerTransaction->query("
					select 
						Customer.id,
						Customer.first_name,
						Customer.middle_name,
						Customer.gender,
						Customer.last_name,
						Customer.image_name,
						Customer.image_location,
						CustomerTransaction.id,
						CustomerTransaction.book_id,
						CustomerTransaction.for_bir,
						CustomerTransaction.net_amount,
						CustomerTransaction.net_amount_duplicate,
						CustomerTransaction.item_type,
						CustomerTransaction.jewelry_type,
						CustomerTransaction.image_location,
						CustomerTransaction.month_before_remata,
						CustomerTransaction.status,
						CustomerTransaction.partial_status,
						CustomerTransaction.partial_capital,
						CustomerTransaction.sangla_date,
						CustomerTransaction.sangla_time,
						TransactionInterestPayment.id,
						TransactionInterestPayment.payment_starting_date,
						TransactionInterestPayment.payment_date,
						TransactionInterestPayment.status,
						TransactionInterestPayment.pt_number,
						TransactionUnderAuction.id,
						TransactionUnderAuction.customer_transaction_id,
						TransactionUnderAuction.auction_price

					from 
						customers Customer 
					join 
						customer_transactions CustomerTransaction on Customer.id = CustomerTransaction.customer_id
					left join
						transaction_interest_payments TransactionInterestPayment on TransactionInterestPayment.customer_transaction_id = CustomerTransaction.id
					left join
						transaction_under_auctions TransactionUnderAuction on TransactionUnderAuction.customer_transaction_id = CustomerTransaction.id	
					where 
						CustomerTransaction.status = '{$status}'
		");
		
		foreach($query_result as $key => $value)
		{
			$datas[ $value['CustomerTransaction']['id'] ]['Customer'] = $value['Customer'];
			$datas[ $value['CustomerTransaction']['id'] ]['CustomerTransaction'] = $value['CustomerTransaction'];
			$datas[ $value['CustomerTransaction']['id'] ]['TransactionInterestPayment'] = $value['TransactionInterestPayment'];
			$datas[ $value['CustomerTransaction']['id'] ]['TransactionUnderAuction'] = $value['TransactionUnderAuction'];
		}
		
		usort($datas, function ($item1, $item2) {
				if ($item1['TransactionInterestPayment']['pt_number'] == $item2['TransactionInterestPayment']['pt_number']) return 0;
				return $item1['TransactionInterestPayment']['pt_number'] < $item2['TransactionInterestPayment']['pt_number'] ? -1 : 1;
		});


		return $datas;
	}
	
	function item_image() {
		 
		// $this->log($_FILES['webcam']['tmp_name'], 'pakpak');	
		
		$fileDate = date('Y-m-d')."-";	 
		$fileTime = time() . '.jpg';
		$filepath = 'webcamImage/';

		move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$fileDate.$fileTime);

		echo $filepath.$fileDate.$fileTime;
		
		$this->layout='ajax';
		$this->render('/common/json');
		
	}
	
	function add($customer_id) {
		
		$service_charge         = 0;
		$customerId 			= $this->data['CustomerTransaction']['customer_id'];

		$books = $this->CustomerTransaction->Book->find('list', array('conditions'=>array('Book.enabled'=>1)));
		$items = $this->CustomerTransaction->Item->find('list', array('conditions'=>array('Item.enabled'=>1)));
		
		if (!empty($this->data)) {
			
			if(!empty($this->data['image_name']['name']))
			{
			
				if (!empty($this->data['image_name']['name'])) 
				{
					$dateTime = date('Y-m-d-H-i-s');
					$file = $this->data['image_name'];
					
					$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
					$arr_ext = array('jpg', 'jpeg', 'gif','png');

					if (in_array($ext, $arr_ext)) 
					{
						
						$directoryName = 'img/item_image/'.date('Y').'/'.date('m').'/'.date('d');
						if(!is_dir($directoryName)){
						
							mkdir($directoryName, 0755, true);
							
						}
						
						move_uploaded_file($file['tmp_name'], WWW_ROOT . $directoryName."/".$dateTime.'-'.$file['name']);
						$this->data['CustomerTransaction']['image_name'] 		= $dateTime.'-'.$file['name'];
						$this->data['CustomerTransaction']['image_size'] 		= $file['size'];
						$this->data['CustomerTransaction']['image_location'] 	= "/".$directoryName."/".$dateTime.'-'.$file['name'];
						
					}
					
				} else 
				{
					
					$this->data['CustomerTransaction']['image_name'] 		= '';
					$this->data['CustomerTransaction']['image_size'] 		= 0;
					$this->data['CustomerTransaction']['image_location'] 	= '';
				}
				
				
			}
			else 
			{
				
				
				$directoryName = 'img/item_image/'.date('Y').'/'.date('m').'/'.date('d');
				if(!is_dir($directoryName)){
				
					mkdir($directoryName, 0755, true);
					
				}
				copy('webcamImage/'.$this->data['CustomerTransaction']['item_image'], $directoryName."/".$this->data['CustomerTransaction']['item_image']);
				
				$this->data['CustomerTransaction']['image_name'] 	 = $this->data['CustomerTransaction']['item_image'];
				$this->data['CustomerTransaction']['image_location'] = "/".$directoryName."/".$this->data['CustomerTransaction']['item_image'];
				
				$files = glob('webcamImage/'.'*');
				foreach ($files as $file) {
					
					unlink($file);
				}
				
			}
			
			$this->CustomerTransaction->create();
			$this->data['CustomerTransaction']['user_id'] 				= $this->Session->read('Auth.User.id');
			$this->data['CustomerTransaction']['net_amount_duplicate']  = $this->data['CustomerTransaction']['gross_amount'] ;

			/*
			kaya meron nito para ma track kung mag kano yung net amount nya
			pag dadating yung time ng mag le less ng principal amount si customer
			*/
			if(trim($this->data['CustomerTransaction']['image_name']) == '')
			{
				$this->data['CustomerTransaction']['image_location'] = '';
			}
			
			if ($this->CustomerTransaction->save($this->data['CustomerTransaction'])) {
				
				$cash_book = array();
				
				$starting_balanced  = $this->fundBookAll();
				$ending_balanced    = $this->fundBookAll() - $this->data['CustomerTransaction']['net_amount'];
			
				// this is for cash book 1 report for bir
				if($this->data['CustomerTransaction']['for_bir'] == 1)
				{
					$starting_balanced_bir  = $this->fundBookAllBIR();
					$ending_balanced_bir    = $this->fundBookAllBIR() - $this->data['CustomerTransaction']['net_amount'];
					
					$cash_book['CashBook']['for_bir'] 				= 1;
					$cash_book['CashBook']['starting_balanced_bir'] = $starting_balanced_bir;
					$cash_book['CashBook']['ending_balanced_bir']   = $ending_balanced_bir;
					
					// this is for update of book funds, remaining balanced after
					// new pawned item made by customer
					$this->fundBookAllUpdateBIR($ending_balanced_bir);

				}
				
				$cash_book['CashBook']['book_id'] 					= $this->data['CustomerTransaction']['book_id'];
				$cash_book['CashBook']['customer_transaction_id'] 	= $this->CustomerTransaction->id;
				$cash_book['CashBook']['starting_balanced']			= $starting_balanced;
				$cash_book['CashBook']['pawned']					= $this->data['CustomerTransaction']['net_amount'];
				$cash_book['CashBook']['service_charge'] 			= 0;
				$cash_book['CashBook']['details'] 					= 'Granted';
				$cash_book['CashBook']['ending_balanced'] 			= $ending_balanced;
				$cash_book['CashBook']['status'] 					= 'granted';
				$cash_book['CashBook']['enabled'] 					= 1;
				$cash_book['CashBook']['user_id'] 					= $this->Session->read('Auth.User.id');
				$cash_book['CashBook']['date_created'] 				= $this->data['CustomerTransaction']['sangla_date'];
				$cash_book['CashBook']['time_created'] 				= date('H:i:s');
				// nilagay ko ito para laging mag papakita sa report yung account balanced kahit walang transaction sa bangko
				$cash_book['CashBook']['ending_bank_balanced'] 		= $this->bankBalancedBookAll();
				
				
				// this is for update of book funds, remaining balanced after
				// new pawned item made by customer
				$this->fundBookAllUpdate($ending_balanced);
		
				// this is for book reports
				$this->addCashBookRecord($cash_book);
				
				// this is for logs
				$this->addTransactionLog($this->CustomerTransaction->id, 'CustomerTransaction', 'New item pawned');
				
				$this->Session->setFlash('New Transaction added', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions' ,'action' => 'transaction', $this->CustomerTransaction->id));
				
			} else {
				
				$this->Session->setFlash('The CustomerTransaction could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
		
		$this->set('customer_id', $customer_id);
		$this->set('books', $books);
		$this->set('items', $items);
		
	}
	
	function index() {
		
	}
	
	function edit($id = null) {
		
		// $this->log($this->data, 'abc');
		$this->CustomerTransaction->recursive = -1;
		$books 			= $this->CustomerTransaction->Book->find('list', array('conditions'=>array('Book.enabled'=>1)));
		$items 			= $this->CustomerTransaction->Item->find('list', array('conditions'=>array('Item.enabled'=>1)));
		
		// $starting_balance = $this->fundBookAll();
		
		if (!empty($this->data)) {
		
			if(!empty($this->data["image_name"]["name"]))
			{
				
				$image_location = $this->CustomerTransaction->query("select image_location from customer_transactions CustomerTransaction where id = '{$this->data['CustomerTransaction']['id']}' ");
				
				if(trim($image_location["CustomerTransaction"]["image_location"]) != "")
				{
					unlink(substr($image_location[0]["CustomerTransaction"]["image_location"],1));
				}
				
				$file = $this->data['CustomerTransaction']['image_name'];
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				
				if (in_array($ext, $arr_ext)) {
					
					$dateTime = date('Y-m-d-H-i-s');
					$directoryName = 'img/customer_image/'.date('Y-m-d');
					if(!is_dir($directoryName)){
					
						mkdir($directoryName, 0755, true);
						
					}
					
					move_uploaded_file($file['tmp_name'], WWW_ROOT . $directoryName."/".$dateTime.'-'.$file['name']);
					$this->data['CustomerTransaction']['image_name'] 		= $dateTime.'-'.$file['name'];
					$this->data['CustomerTransaction']['image_size'] 		= $file['size'];
					$this->data['CustomerTransaction']['image_location'] 	= "/".$directoryName."/".$dateTime.'-'.$file['name'];
						
			
				
				} else{
					
					$this->Session->setFlash('CustomerTransaction image failed to update', 'flash_failure');
				}
					
			} elseif (!empty($this->data['CustomerTransaction']['item_image'])) {
					
					
				$this->CustomerTransaction->recursive = 0;
				$image_location = $this->CustomerTransaction->query("select image_location from customer_transactions CustomerTransaction where id = '{$this->data['CustomerTransaction']['id']}' ");
				
				if(trim($image_location[0]["CustomerTransaction"]["image_location"]) != "")
				{
					unlink(substr($image_location[0]["CustomerTransaction"]["image_location"],1));
				}
				
				$directoryName = 'img/item_image/'.date('Y-m-d');
				if(!is_dir($directoryName)){
				
					mkdir($directoryName, 0755, true);
					
				}
				$directoryName = 'img/item_image/'.date('Y-m-d');
				copy('webcamImage/'.$this->data['CustomerTransaction']['item_image'], $directoryName."/".$this->data['CustomerTransaction']['item_image']);
				
				
				$this->data['CustomerTransaction']['image_name'] 	 = $this->data['CustomerTransaction']['item_image'];
				$this->data['CustomerTransaction']['image_location'] = "/".$directoryName."/".$this->data['CustomerTransaction']['item_image'];
				
				$files = glob('webcamImage/'.'*');
				foreach ($files as $file) {
					
					unlink($file);
				}
					
			} else {
					
				
				$image_location = $this->CustomerTransaction->query("select * from customer_transactions CustomerTransaction where id = '{$this->data['CustomerTransaction']['id']}' ");
				$this->data['CustomerTransaction']['image_name'] 		= $image_location[0]["CustomerTransaction"]["image_name"];
				$this->data['CustomerTransaction']['image_location'] 	= $image_location[0]["CustomerTransaction"]["image_location"];
				$this->data['CustomerTransaction']['image_size'] 		= $image_location[0]["CustomerTransaction"]["image_size"];
				
			}
			
			// to update the funds for book 1,2 and 3
			
			// disable ko na lang to, ams ok pa delete transaction kesa edit dami dada anan prone to error
			/*
			if($this->data['CustomerTransaction']['net_amount'] > $this->data['CustomerTransaction']['net_amount_duplicate'])
			{
				$result = $this->data['CustomerTransaction']['net_amount'] - $this->data['CustomerTransaction']['net_amount_duplicate'];
				$cash_on_hand = $starting_balance - $result;	
				$this->fundBookAllUpdate($cash_on_hand);
				
			} else {
				
				$result = $this->data['CustomerTransaction']['net_amount_duplicate'] - $this->data['CustomerTransaction']['net_amount'];
				$cash_on_hand = $starting_balance + $result;
				$this->fundBookAllUpdate($cash_on_hand);
			}
			*/
			
			$this->data['CustomerTransaction']['net_amount_duplicate']  =  $this->data['CustomerTransaction']['net_amount'];
			
			$this->CustomerTransaction->recursive = 0;
			if ($this->CustomerTransaction->save($this->data['CustomerTransaction'])) 
			{
				// para malaman kung kelan na tag as ready for auction (RFA) itong transaction na ito
				if(!empty($this->data['TransactionActionLevel']))
				{
					$this->data['TransactionActionLevel']['customer_transaction_id']  	= $this->data['CustomerTransaction']['id'];
					$this->data['TransactionActionLevel']['status'] 					= $this->data['CustomerTransaction']['status'];
					$this->data['TransactionActionLevel']['user_id'] 					= $this->Session->read('Auth.User.id');
					$this->data['TransactionActionLevel']['name'] 						= $this->data['TransactionActionLevel']['name'];
				
					$this->AddCustomerTransactionLevels->addLevels($this->data['TransactionActionLevel']);
				}
				
				
				$this->addTransactionLog('Edit Customer Transaction', 'CustomerTransaction', $this->CustomerTransaction->id);
				
				// disabled ko na lang po mas ok pa delete kesa mag edit dami dadaanan prone to error
				/*
				if(isset($this->data['CustomerTransaction']['net_amount']) && !empty($this->data['CustomerTransaction']['net_amount']))
				{
					$this->editCashBookRecord($this->data['CustomerTransaction']['book_id'], $this_column = 'pawned', $this->data['CustomerTransaction']['net_amount'], $cash_on_hand, $whereColumn = 'customer_transaction_id' ,$this->CustomerTransaction->id);
				}
				*/
				
				$this->Session->setFlash('Transaction updated!', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
				
			} else {
				
				$this->Session->setFlash('Transaction update failed!. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
		
			$this->data = $this->CustomerTransaction->read(null, $id);
		}
		
		$this->set('books', $books);
		$this->set('items', $items);
		$this->set('id', $id);
	}
	
	function search_book() {
		
		$resultQuery= $this->Book->query("select deduct_first_month from books where id = '{$this->data['Book']['id']}' ");

	    $data['data'] = $resultQuery[0]['books']['deduct_first_month'];
		$this->set('data',$data);
		$this->layout='ajax';
		$this->render('/common/json');
		
	}
	
	function search_item() {
		
		$resultQuery= $this->Item->query("select * from books where id = '{$this->data['Book']['id']}' ");

	    $data['data'] = $resultQuery;
		$this->set('data',$data);
		$this->layout='ajax';
		$this->render('/common/json');
		
	}
	
	function transaction($id = null) {
	
		$this->loadModel('BookMonthInterest');
		$book_interest = $this->BookMonthInterest->query('select book_id, month, percent_interest,display_order, description from book_month_interests BookMonthInterest');
		
		/*
		echo '<pre>';
		print_r($book_interest);
		echo '</pre>';
		*/
		
		$formatOne = array();
		foreach($book_interest as $keyInterest => $valInterest)
		{
			$formatOne['BookMonthInterest'][ $valInterest['BookMonthInterest']['book_id']][ $valInterest['BookMonthInterest']['month'] ] = $valInterest['BookMonthInterest']['percent_interest'];
		}
		
		/*
		echo '<pre>';
		print_r($formatOne);
		echo '</pre>';
		*/
		
		if (!$id) {
			$this->Session->setFlash('Invalid Transaction, record not found available', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		
		$users = $this->User->find('list');
		
		$this->CustomerTransaction->Behaviors->attach('containable');
		$customerDetails = $this->CustomerTransaction->find('all', array(
				'contain'=>array(
						'Customer',
						'TransactionInterestPayment'=>array(
							'order' => 'id asc'
						),
						'Book',
						'Item',
						'TransactionPrincipalPayment'=>array(
							'order'=>'id asc'
						),
						'TransactionActionLevel',
						'TransactionUnderAuction',
						'TransactionSoldItem',
						'TransactionRedeemItem',
						'TransactionInOutItem'
							
						
					),
					'conditions'=>array('CustomerTransaction.id'=>$id)
				)
		);
		
		/*
		echo "<pre>";
		print_r($customerDetails);
		echo "</pre>";
		*/

		$this->set('customer_details', $customerDetails);
		$this->set('users', $users);
		$this->set('service_charge', $this->serviceChargeAmount());
		$this->set('book_month_interest', $formatOne);
		$this->set("trasaction_counter_for_delete", $this->lastTrasaction());
		$this->set("cashbookid_principal_id", $this->lastTrasactionPrincipalPayment());
		
	}
	
	function delete_transaction()
	{
		if(!empty($this->data))
		{
			// $this->log($this->data, 'delete');
			
			$this->CashBook->query("delete from cash_books  where customer_transaction_id = '{$this->data['CustomerTransaction']['id']}' ");
			$this->CustomerTransaction->query("delete from customer_transactions where id = '{$this->data['CustomerTransaction']['id']}' ");
			
			$cashBook2Balanced = $this->fundBookAll();
			$total = $cashBook2Balanced + $this->data['CustomerTransaction']['net_amount_duplicate'];	
			
			$this->fundBookAllUpdate($total);
			
			if($this->data['CustomerTransaction']['for_bir'] == 1)
			{
				$cashBook1BIRBalanced = $this->fundBookAllBIR();
				$totalBIR = $cashBook1BIRBalanced + $this->data['CustomerTransaction']['net_amount_duplicate'];
				$this->fundBookAllUpdateBIR($totalBIR);
			}
			
			$this->addTransactionLog($this->data['CustomerTransaction']['id'], 'CustomerTransaction', 'Delete Customer Transaction');
			
			$this->Session->setFlash('Transaction deleted!', 'flash_success');
			$this->redirect(array('controller'=>'homes', 'action' => 'home'));
				
		} else {
			$this->Session->setFlash('Transaction not deleted!', 'flash_failure');
		}
	}
	
	function checkif_orexist() {
		// $this->log($this->data, 'sample');
		
		$this->loadModel('TransactionInterestPayment');
		
		$resultQuery= $this->TransactionInterestPayment->query("select or_number from transaction_interest_payments where or_number = '{$this->data['TransactionInterestPayment']['or_number']}' ");

	    if(!empty($resultQuery))
		{
			$resultQuery['notempty'] = 1;
			
		} elseif(trim($this->data['TransactionInterestPayment']['or_number']) == '')
		{
			$resultQuery['ptempty'] = 1;
			
		} 
		//echo "<pre>";
		//print_r($resultQuery);
		//echo "</pre>";
		$this->set('data', $resultQuery);
		$this->layout='ajax';
		$this->render('/common/json');
		
	}
	
	function sold_checkif_orexist() {
		
		// $this->log($this->data, 'sampledddd');
		$this->loadModel('TransactionSoldItem');
		
		$resultQuery = $this->TransactionSoldItem->query("select * from transaction_sold_items where or_number = '{$this->data['TransactionSoldItem']['or_number']}' ");

		if(!empty($resultQuery))
		{
			$resultQuery['notempty'] = 1;
			
		} elseif(trim($this->data['TransactionSoldItem']['or_number']) == '')
		{
			$resultQuery['orempty'] = 1;
			
		} 

		$this->set('data', $resultQuery);
		$this->layout='ajax';
		$this->render('/common/json');
		
	}
	
	function redeem_checkif_orexist() {
		
		// $this->log($this->data, 'sampledddd');
		$this->loadModel('TransactionRedeemItem');
		
		$resultQuery = $this->TransactionRedeemItem->query("select * from transaction_redeem_items where or_number = '{$this->data['TransactionRedeemItem']['or_number']}' ");

		if(!empty($resultQuery))
		{
			$resultQuery['notempty'] = 1;
			
		} elseif(trim($this->data['TransactionRedeemItem']['or_number']) == '')
		{
			$resultQuery['orempty'] = 1;
			
		} 

		$this->set('data', $resultQuery);
		$this->layout='ajax';
		$this->render('/common/json');
		
	}
	
	function reactivate_back_pawned()
	{
		if(!empty($this->data))
		{
			if($this->CustomerTransaction->query("update customer_transactions set status = 'pawned' where id = {$this->data['CustomerTransaction']['id']} ")) 
			{
				$this->TransactionUnderAuction->query("delete from transaction_under_auctions where customer_transaction_id = {$this->data['CustomerTransaction']['id']} ");
				
				$this->data['TransactionActionLevel']['customer_transaction_id']  	= $this->data['CustomerTransaction']['id'];
				$this->data['TransactionActionLevel']['status'] 					= 'pawned';
				$this->data['TransactionActionLevel']['user_id'] 					= $this->Session->read('Auth.User.id');
				$this->data['TransactionActionLevel']['name'] 						= 'reactivate';
			
				$this->AddCustomerTransactionLevels->addLevels($this->data['TransactionActionLevel']);
				
				
				$this->Session->setFlash('Transaction reactivated', 'flash_success');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
				
			} 
			else 
			{
				$this->Session->setFlash('Transaction failed to reactivate', 'flash_failure');
				$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
			}
			
		} 
		else 
		{
			$this->Session->setFlash('Transaction unable to reactivate', 'flash_failure');
			$this->redirect(array('controller'=>'customer_transactions', 'action' => 'transaction', $this->data['CustomerTransaction']['id']));
		}
	}
}
?>