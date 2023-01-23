<?php
class CashBooksController extends AppController {

	var $name = 'CashBooks';
	
	/*
		Pag call add_deposit() mag add balanced sa column na 
		balanced sa table na book_bank_funds
	*/
	function bankFundIncrease($amount, $book_id)
	{
		$this->loadModel('BookBankFund');
		$this->BookBankFund->query("update book_bank_funds set balanced = balanced + '{$amount}'  where book_id = '{$book_id}' ");
	}
	
	/*
		Pag call add_withdrawal() mag minus balanced sa column na 
		balanced sa table na book_bank_funds
	*/
	function bankFundDecrease($amount, $book_id)
	{
		$this->loadModel('BookBankFund');
		$this->BookBankFund->query("update book_bank_funds set balanced = balanced - '{$amount}'  where book_id = '{$book_id}' ");
	}

	function add_deposit() {
		
		if (!empty($this->data)) {
			
			if($this->data['CashBook']['for_bir'] == 1)
			{
				
				$this->data['CashBook']['starting_balanced_bir'] = $this->fundBookAllBIR();
				$this->data['CashBook']['ending_balanced_bir']   = $this->fundBookAllBIR() - $this->data['CashBook']['deposit'];
				
				// this for back account balanced for cash book 2 (book 1,2,3)
				$this->data['CashBook']['starting_bank_balanced_bir'] 	= $this->bankBalancedBookAllBIR();
				$this->data['CashBook']['ending_bank_balanced_bir'] 	= $this->bankBalancedBookAllBIR() + $this->data['CashBook']['deposit'];
				
				// for cash book 1(BIR) fund, dummy account
				$this->fundBookAllUpdateBIR($this->data['CashBook']['ending_balanced_bir']);
				$bookid = 'bir';
			}
			
			if($this->data['CashBook']['for_bir'] == 0)
			{	
				$this->data['CashBook']['starting_balanced']  = $this->fundBookAll();
				$this->data['CashBook']['ending_balanced']    = $this->fundBookAll() - $this->data['CashBook']['deposit'];	
				
				// this for back account balanced for cash book 2 (book 1,2,3)
				$this->data['CashBook']['starting_bank_balanced'] 	= $this->bankBalancedBookAll();
				$this->data['CashBook']['ending_bank_balanced'] 	= $this->bankBalancedBookAll() + $this->data['CashBook']['deposit'];
				
				// For Cash Book 2(Book 1,2,3) fund
				$this->fundBookAllUpdate($this->data['CashBook']['ending_balanced']);
				$bookid = '123';
			}
			
			$this->data['CashBook']['user_id']  = $this->Session->read('Auth.User.id');
			
			$this->CashBook->create();
			if ($this->CashBook->save($this->data)) {
				
				//Bank for Cash Book 2(Book 1,2,3) or Cash Book 1(BIR)
				$this->bankFundIncrease($this->data['CashBook']['deposit'], $bookid);
				
				$this->Session->setFlash('Transaction has been saved', 'flash_success');
				$this->redirect(array('controller'=>'cash_books', 'action' => 'list_deposit'));
				
			} else {
				
				$this->Session->setFlash('Transaction could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
	function add_withdrawal() {
		
		if (!empty($this->data)) {
			
			if($this->data['CashBook']['for_bir'] == 1)
			{
				
				$this->data['CashBook']['starting_balanced_bir'] = $this->fundBookAllBIR();
				$this->data['CashBook']['ending_balanced_bir']   = $this->fundBookAllBIR() + $this->data['CashBook']['withdrawal'];
				
				// this for back account balanced for cash book 1
				$this->data['CashBook']['starting_bank_balanced_bir'] 	= $this->bankBalancedBookAllBIR();
				$this->data['CashBook']['ending_bank_balanced_bir'] 	= $this->bankBalancedBookAllBIR() - $this->data['CashBook']['withdrawal'];
				
				// for cash book 1(BIR) fund, dummy account
				$this->fundBookAllUpdateBIR($this->data['CashBook']['ending_balanced_bir']);
				$bookid = 'bir';
			}
			
			if($this->data['CashBook']['for_bir'] == 0)
			{	
				$this->data['CashBook']['starting_balanced']  = $this->fundBookAll();
				$this->data['CashBook']['ending_balanced']    = $this->fundBookAll() + $this->data['CashBook']['withdrawal'];	
				
				// this for back account balanced for cash book 2 (book 1,2,3)
				$this->data['CashBook']['starting_bank_balanced'] 	= $this->bankBalancedBookAll();
				$this->data['CashBook']['ending_bank_balanced'] 	= $this->bankBalancedBookAll() - $this->data['CashBook']['withdrawal'];
				
				// For Cash Book 2(Book 1,2,3) fund
				$this->fundBookAllUpdate($this->data['CashBook']['ending_balanced']);
				$bookid = '123';
			}
			
			$this->data['CashBook']['user_id'] = $this->Session->read('Auth.User.id');
			
			$this->CashBook->create();
			if ($this->CashBook->save($this->data)) {
				
				//Bank for Cash Book 2(Book 1,2,3) or Cash Book 1(BIR)
				$this->bankFundDecrease($this->data['CashBook']['withdrawal'], $bookid);
		
				$this->Session->setFlash('Transaction has been saved', 'flash_success');
				$this->redirect(array('controller'=>'cash_books', 'action' => 'list_withdrawal'));
				
			} else {
				
				$this->Session->setFlash('Transaction could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
	function add_expenses() {
		
		if (!empty($this->data)) {
			
			// $this->log($this->data, 'poss');
			
			/*
				pag mag add ng expenses automatic book 1 and 2 meron expenses
			*/
			$this->data['CashBook']['for_bir'] 				 = 1;
			$this->data['CashBook']['starting_balanced_bir'] = $this->fundBookAllBIR();
			$this->data['CashBook']['ending_balanced_bir']   = $this->fundBookAllBIR() - $this->data['CashBook']['expenses'];;
			
			$this->data['CashBook']['starting_balanced']  		= $this->fundBookAll();
			$this->data['CashBook']['ending_balanced']    		= $this->fundBookAll() - $this->data['CashBook']['expenses'];	
			$this->data['CashBook']['user_id'] 			  		= $this->Session->read('Auth.User.id');
			$this->data['CashBook']['ending_bank_balanced'] 	= $this->bankBalancedBookAll();
			
			$this->CashBook->create();
			if ($this->CashBook->save($this->data)) {
	
				// to update fund of book 123
				$this->fundBookAllUpdate($this->data['CashBook']['ending_balanced']);
				
				// to update fund of book 1 for bir
				$this->fundBookAllUpdateBIR($this->data['CashBook']['ending_balanced_bir']);
				
				$this->Session->setFlash('Transaction has been saved', 'flash_success');
				$this->redirect(array('controller'=>'cash_books', 'action' => 'list_expenses'));
				
			} else {
				
				$this->Session->setFlash('Transaction could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
	function delete_expenses() {
		
		if (!$this->data['CashBook']['id']) {
			$this->Session->setFlash('Invalid id for CashBook', 'flash_failure');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		if ($this->CashBook->delete($this->data['CashBook']['id'])) {
			
			// to increase the bank amount balanced 
			if(isset($this->data['CashBook']['expenses']) && !empty($this->data['CashBook']['expenses']))
			{
				// to update fund of book 123
				$bookAll = $this->data['CashBook']['expenses'] + $this->fundBookAll();
				$bookAllBIR = $this->data['CashBook']['expenses'] + $this->fundBookAllBIR();
				
				$this->fundBookAllUpdate($bookAll);
				
				// to update fund of book 1 for bir
				$this->fundBookAllUpdateBIR($bookAllBIR);
			}
			
			$this->Session->setFlash('CashBook information updated', 'flash_success');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		$this->Session->setFlash('CashBook was not deleted', 'flash_failure');
		$this->redirect(array('action' => $this->data['CashBook']['action']));
		
	}
	
	function no_editx($id = null) {
		
		$this->log($this->data, 'pos1');
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Expenses', 'flash_failure');
			$this->redirect(array('action' => 'list_expenses'));
		}
		if (!empty($this->data)) {
			if ($this->CashBook->save($this->data)) {
				$this->Session->setFlash('CashBook information updated', 'flash_success');
				$this->redirect(array('action' => $this->data['CashBook']['action']));
			} else {
				$this->Session->setFlash('The CashBook could not be saved. Please, try again.', 'flash_failure');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CashBook->read(null, $id);
		}
	}
	
	function delete_deposit() {
		
		if (!$this->data['CashBook']['id']) {
			$this->Session->setFlash('Invalid id for CashBook', 'flash_failure');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		
		if ($this->CashBook->delete($this->data['CashBook']['id'])) {
			
			// to decrease the bank amount balanced 
			if(isset($this->data['CashBook']['deposit']) && !empty($this->data['CashBook']['deposit']))
			{
				$amount_deposit = $this->data['CashBook']['deposit'];
				
				if($this->data['CashBook']['for_bir'] == 0)
				{
					$cash_book_two_total = $this->fundBookAll() + $amount_deposit;
					$this->fundBookAllUpdate($cash_book_two_total);
					
					$bookid = 123;
					
				} else {
					
					$cash_book_two_total = $this->fundBookAllBIR() + $amount_deposit;
					$this->fundBookAllUpdateBIR($cash_book_two_total);
					
					$bookid = 'bir';
				}
				
				$this->bankFundDecrease($amount_deposit , $bookid);
				
			}
			
			$this->Session->setFlash('CashBook information updated', 'flash_success');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		$this->Session->setFlash('CashBook was not deleted', 'flash_failure');
		$this->redirect(array('action' => $this->data['CashBook']['action']));
	}
	
	function delete_withdrawal() {
		if (!$this->data['CashBook']['id']) {
			$this->Session->setFlash('Invalid id for CashBook', 'flash_failure');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		
		/*
		echo '<pre>';
		print_r($this->data);
		echo '</pre>';
		*/
		
		if ($this->CashBook->delete($this->data['CashBook']['id'])) {
			
			// to increase the bank amount balanced 
			if(isset($this->data['CashBook']['withdrawal']) && !empty($this->data['CashBook']['withdrawal']))
			{
				$amount_withdrawal = $this->data['CashBook']['withdrawal'];
				
				if($this->data['CashBook']['for_bir'] == 0)
				{
					
					$cash_book_two_total = $this->fundBookAll() - $amount_withdrawal;
					$this->fundBookAllUpdate($cash_book_two_total);
					
					$bookid = 123;
					
				} else {
					
					$cash_book_two_total = $this->fundBookAllBIR() - $amount_withdrawal;
					$this->fundBookAllUpdateBIR($cash_book_two_total);
					$bookid = 'bir';
				}
				
				$this->bankFundIncrease($amount_withdrawal , $bookid);
			}
			
			$this->Session->setFlash('CashBook information updated', 'flash_success');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		$this->Session->setFlash('CashBook was not deleted', 'flash_failure');
		$this->redirect(array('action' => $this->data['CashBook']['action']));
	}
	
	function list_deposit() {
		
		$this->loadModel('User');
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']) && isset($this->data['CashBook']['for_bir']))
		{
			$datas = $this->withdrawalDeposit($status = 'deposit', $this->data['CashBook']['date_from'], $this->data['CashBook']['date_to'], $this->data['CashBook']['for_bir']);
			
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];

			$this->set('date', $date);
			$this->set('datas', $datas);
			$this->set('for_bir', $this->data['CashBook']['for_bir']);
			$this->set('users', $this->User->find('list'));
		}
	}
	
	function list_withdrawal() {
		
		$this->loadModel('User');
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']) && isset($this->data['CashBook']['for_bir']))
		{
			$datas = $this->withdrawalDeposit($status = 'withdrawal', $this->data['CashBook']['date_from'], $this->data['CashBook']['date_to'], $this->data['CashBook']['for_bir']);
			
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			
			$this->set('datas', $datas);
			$this->set('date', $date);
			$this->set('for_bir', $this->data['CashBook']['for_bir']);
			$this->set('users', $this->User->find('list'));
		}
	}
	
	function withdrawalDeposit($status, $date_from, $date_to, $bir)
	{
		
		$this->CashBook->recursive = 0;
		return $data = $this->CashBook->query("
			select 
				id,
				for_bir,
				$status,
				details,
				date_created,
				time_created,
				enabled,
				user_id
			from 
				cash_books CashBook 
			where 
				date_created >= '{$date_from}'
					and
				date_created <= '{$date_to}'
					and
				status = '{$status}'
					and
				for_bir = '{$bir}'	
		");
	}
	
	function list_expenses() {
		
		$this->loadModel('User');
		
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']))
		{
			$datas = $this->myCashBook($status = 'expenses', $this->data['CashBook']['date_from'], $this->data['CashBook']['date_to']);
			
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			
			$this->set('datas', $datas);
			$this->set('date', $date);
			$this->set('users', $this->User->find('list'));
		}
	}
	
	
	function myCashBook($status, $date_from, $date_to)
	{
		
		$this->CashBook->recursive = 0;
		return $data = $this->CashBook->query("
			select 
				id,
				for_bir,
				$status,
				details,
				date_created,
				time_created,
				enabled,
				user_id
			from 
				cash_books CashBook 
			where 
				date_created >= '{$date_from}'
					and
				date_created <= '{$date_to}'
					and
				status = '{$status}'
		");
	}
	
	function granted()
	{
		$this->loadModel('CustomerTransaction');
		$this->loadModel('Customer');
		$this->loadModel('User');
		$this->loadModel('Item');
		
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']) && isset($this->data['CashBook']['book']))
		{
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			
			$result_query = $this->CashBook->query("
					select 
						Customer.id,
						Customer.first_name,
						Customer.middle_name,
						Customer.last_name,
						Customer.gender,
						CustomerTransaction.id,
						CustomerTransaction.item_type,
						CustomerTransaction.brand,
						CustomerTransaction.model,
						CustomerTransaction.jewelry_type,
						CustomerTransaction.karat,
						CustomerTransaction.weight,
						CustomerTransaction.net_amount_duplicate,
						CustomerTransaction.sangla_date,
						CustomerTransaction.sangla_time,
						CustomerTransaction.details,
						User.id,
						User.first_name,
						User.middle_name,
						User.last_name,
						Item.id,
						Item.name
					from 
						customers Customer
							join
						customer_transactions CustomerTransaction on CustomerTransaction.customer_id = Customer.id
							join
						items Item on Item.id = CustomerTransaction.item_id
							join
						users User on User.id = CustomerTransaction.user_id
					where 
						CustomerTransaction.book_id = '{$this->data['CashBook']['book']}' 
					and 
						CustomerTransaction.sangla_date >= '{$this->data['CashBook']['date_from']}' 
					and
						CustomerTransaction.sangla_date <= '{$this->data['CashBook']['date_to']}' 
					
					order by CustomerTransaction.id asc	
			");
			
			/*
			echo '<pre>';
			echo print_r($result_query);
			echo '</pre>';
			*/
			
			foreach($result_query as $key => $value)
			{
				$formatOne[ $value['CustomerTransaction']['sangla_date'] ] [ $value['CustomerTransaction']['id'] ][] = $value;
			}
			/*
			echo '<pre>';
			echo print_r($formatOne);
			echo '</pre>';
			*/
			$this->set('book_id', $this->data['CashBook']['book']);
			$this->set('date', $date);
			$this->set('datas', $formatOne);
		}

	}
	
	function collected()
	{
		$this->loadModel('CustomerTransaction');
		$this->loadModel('Customer');
		$this->loadModel('User');
		$this->loadModel('Item');
		
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']) && isset($this->data['CashBook']['book']))
		{
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			
			$result_query = $this->CashBook->query("
					SELECT 
						Customer.id,
						Customer.first_name,
						Customer.middle_name,
						Customer.last_name,
						Customer.gender,
						CustomerTransaction.id,
						CustomerTransaction.customer_id,
						CustomerTransaction.book_id,
						CashBook.id cash_book_id,
						CashBook.pt_number,
						CashBook.customer_transaction_id,
						CashBook.interest_amount,
						CashBook.sold,
						CashBook.redeemed,
						CashBook.less_principal,
						CashBook.service_charge,
						CashBook.or_number,
						CashBook.details,
						CashBook.book_id,
						CashBook.date_created,
						CashBook.time_created,
						Item.name

					FROM
						customers Customer
							JOIN
						customer_transactions CustomerTransaction ON CustomerTransaction.customer_id = Customer.id
							JOIN
						cash_books CashBook ON CashBook.customer_transaction_id = CustomerTransaction.id
							JOIN
						items Item ON Item.id = CustomerTransaction.item_id

					WHERE
							CashBook.status = 'collected'
							AND CashBook.book_id = '{$this->data['CashBook']['book']}' 
							AND CashBook.date_created >= '{$this->data['CashBook']['date_from']}' 
							AND CashBook.date_created <= '{$this->data['CashBook']['date_to']}' 
					GROUP BY CashBook.id 
					ORDER BY CashBook.id ASC
			");
			/*
			echo '<pre>';
			echo print_r($result_query);
			echo '</pre>';
			*/
			//sort($result_query);
			foreach($result_query as $key => $value)
			{
				$formatOne[ $value['CashBook']['date_created'] ][ $value['CashBook']['cash_book_id'] ][] = $value;
			}
			/*
			echo '<pre>';
			echo print_r($formatOne);
			echo '</pre>';
			*/
			
			$this->set('book_id', $this->data['CashBook']['book']);
			$this->set('date', $date);
			$this->set('datas', $formatOne);
		}
		
	}
	
	function report_capital()
	{
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']))
		{
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			
			$result_query = $this->CashBook->query("
					select 
						* 
					from 
						cash_books CashBook
					where 
						date_created >= '{$this->data['CashBook']['date_from']}' 
					and
						date_created <= '{$this->data['CashBook']['date_to']}' 
					
					order by id, date_created, time_created asc
			");
			
			/*
			echo '<pre>';
			echo print_r($result_query);
			echo '</pre>';
			*/
			foreach($result_query as $key => $value)
			{

				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ]['pawned'] 		 	+= $value['CashBook']['pawned'];
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ]['total_capital'] 	+= $value['CashBook']['redeem_sold_capital'] + $value['CashBook']['less_principal'];
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ]['total_interest'] 	+= $value['CashBook']['redeem_sold_difference_amount'] + $value['CashBook']['interest_amount'] + $value['CashBook']['service_charge'];
				$formatOne[ $value['CashBook']['date_created'] ] ['expenses']['expenses'] 										+= $value['CashBook']['expenses'];
				$formatOne[ $value['CashBook']['date_created'] ] ['withdrawal']['withdrawal'] 									+= $value['CashBook']['withdrawal'];
				$formatOne[ $value['CashBook']['date_created'] ] ['deposit']['deposit'] 										+= $value['CashBook']['deposit'];
				
				if(trim($value['CashBook']['starting_balanced']) != '')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['starting_balanced'][] = $value['CashBook']['starting_balanced'];
				}
				if(trim($value['CashBook']['ending_balanced']) != '')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['ending_balanced'][] = $value['CashBook']['ending_balanced'];
				}
				
			}
			/*
			echo '<pre>';
			echo print_r($formatOne);
			echo '</pre>';
			*/
			$this->set('date', $date);
			$this->set('datas', $formatOne);
		}

	}
	
	function cash_book_two()
	{
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']))
		{
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			
			$result_query = $this->CashBook->query("
					select 
						* 
					from 
						cash_books CashBook
					where 
						date_created >= '{$this->data['CashBook']['date_from']}' 
					and
						date_created <= '{$this->data['CashBook']['date_to']}' 
					
					order by id, date_created, time_created asc
			");
			
			/*
			echo '<pre>';
			echo print_r($result_query);
			echo '</pre>';
			*/
			foreach($result_query as $key => $value)
			{

				//$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ][] = $value;
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ]['payment'] += $value['CashBook']['pawned'];
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ]['receipt'] += $value['CashBook']['interest_amount'] + $value['CashBook']['sold'] + $value['CashBook']['redeemed'] + $value['CashBook']['less_principal'] + $value['CashBook']['service_charge'];
				$formatOne[ $value['CashBook']['date_created'] ] ['expenses']['expenses'] += $value['CashBook']['expenses'];
				$formatOne[ $value['CashBook']['date_created'] ] ['cashin']['cashin'] += $value['CashBook']['cashin'];
				$formatOne[ $value['CashBook']['date_created'] ] ['cashout']['cashout'] += $value['CashBook']['cashout'];
				
				if(trim($value['CashBook']['starting_balanced']) != '')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['starting_balanced'][] = $value['CashBook']['starting_balanced'];
				}
				if(trim($value['CashBook']['ending_balanced']) != '')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['ending_balanced'][] = $value['CashBook']['ending_balanced'];
				}
				if(trim($value['CashBook']['ending_bank_balanced']) > 0)
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['ending_bank_balanced'][] = $value['CashBook']['ending_bank_balanced'];
				}
				if($value['CashBook']['for_bir'] == '0')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['withdrawal']['withdrawal'] += $value['CashBook']['withdrawal'];
					$formatOne[ $value['CashBook']['date_created'] ] ['deposit']['deposit'] += $value['CashBook']['deposit'];
				}
				

			}
			/*
			echo '<pre>';
			echo print_r($formatOne);
			echo '</pre>';
			*/
			$this->set('date', $date);
			$this->set('datas', $formatOne);
		}

	}
	
	function cash_book_one()
	{
		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']))
		{
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			
			$result_query = $this->CashBook->query("
					select 
						* 
					from 
						cash_books CashBook
					where 
						date_created >= '{$this->data['CashBook']['date_from']}' 
					and
						date_created <= '{$this->data['CashBook']['date_to']}' 
					and 
						for_bir = 1
					
					order by id, date_created, time_created asc
			");
			
			/*
			echo '<pre>';
			echo print_r($result_query);
			echo '</pre>';
			*/
			foreach($result_query as $key => $value)
			{
	
				//$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ][] = $value;
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ]['payment'] += $value['CashBook']['pawned'];
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ]['receipt'] += $value['CashBook']['interest_amount'] + $value['CashBook']['sold'] + $value['CashBook']['redeemed'] + $value['CashBook']['less_principal'] + $value['CashBook']['service_charge'];
				
				$formatOne[ $value['CashBook']['date_created'] ] ['starting_balanced_bir'][] = $value['CashBook']['starting_balanced_bir'];
				$formatOne[ $value['CashBook']['date_created'] ] ['ending_balanced_bir'][] 	= $value['CashBook']['ending_balanced_bir'];
			
				$formatOne[ $value['CashBook']['date_created'] ] ['expenses']['expenses'] += $value['CashBook']['expenses'];
				if($value['CashBook']['for_bir'] == '1')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['withdrawal']['withdrawal'] += $value['CashBook']['withdrawal'];
					$formatOne[ $value['CashBook']['date_created'] ] ['deposit']['deposit'] += $value['CashBook']['deposit'];
				}
			}
			
			/*
			echo '<pre>';
			echo print_r($formatOne);
			echo '</pre>';
			*/
			
			$this->set('bir_interest', $this->bir_percent_interest());
			$this->set('date', $date);
			$this->set('datas', $formatOne);
		}
		$this->set('bir_payment_count', count($this->checkBirPayment()));
	}	

	function bir_percent_interest()
	{
		$this->loadModel('BookBirInterest');
		$interest = $this->BookBirInterest->query("select interest from book_bir_interests BookBirInterest where enabled = 1");
		return $interest[0]['BookBirInterest']['interest'];
	}
	
	function bir_payment()
	{
		$this->loadModel('BookBirPayment');
		
		if (!empty($this->data)) {

			$this->data['CashBook']['for_bir'] 			  = 1;
			$this->data['CashBook']['status'] 			  = 'expenses';
			$this->data['CashBook']['details'] 			  = 'payment for BIR for monthly collected on cash book 1';
			$this->data['CashBook']['date_created'] 	  = date('Y-m-d');
			$this->data['CashBook']['time_created'] 	  = time('H:i:s');
			$this->data['CashBook']['expenses'] 		  = $this->data['BIR']['payment'];	
			$this->data['CashBook']['starting_balanced']  = $this->fundBookAll();
			$this->data['CashBook']['ending_balanced']    = $this->fundBookAll() - $this->data['BIR']['payment'];	
			$this->data['CashBook']['user_id'] 			  = $this->Session->read('Auth.User.id');	

			$starting_balanced_bir  = $this->fundBookAllBIR();
			$ending_balanced_bir    = $this->fundBookAllBIR() - $this->data['BIR']['payment'];
			
			$this->data['CashBook']['starting_balanced_bir'] = $starting_balanced_bir;
			$this->data['CashBook']['ending_balanced_bir']   = $ending_balanced_bir;
			
			$this->CashBook->create();
			if ($this->CashBook->save($this->data)) {
			
				$this->data['BookBirPayment']['interest'] 				 = $this->bir_percent_interest();
				$this->data['BookBirPayment']['payment'] 				 = $this->data['BIR']['payment'];
				$this->data['BookBirPayment']['total_monthly_collected'] = $this->data['BIR']['total_collected'];
				$this->data['BookBirPayment']['cash_book1_balanced'] 	 = $ending_balanced_bir;
				$this->data['BookBirPayment']['cash_book2_balanced'] 	 = $this->fundBookAll() - $this->data['BIR']['payment'];
				$this->data['BookBirPayment']['user_id'] 			  	 = $this->Session->read('Auth.User.id');
				$this->data['BookBirPayment']['month'] 			  		 = date('m');
				$this->data['BookBirPayment']['year'] 			  		 = date('Y');
				
				$this->BookBirPayment->create();
				$this->BookBirPayment->save($this->data['BookBirPayment']);
				
				// update remaining cash book 2 balanced
				$this->fundBookAllUpdate($this->data['CashBook']['ending_balanced']);
				
				// update remaining cash book 1 balanced
				$this->fundBookAllUpdateBIR($ending_balanced_bir);
				
				
				$this->Session->setFlash('Transaction has been saved', 'flash_success');
				$this->redirect(array('controller'=>'book_bir_payments', 'action' => 'details', $this->BookBirPayment->id));
				
			} else {
				
				$this->Session->setFlash('Transaction could not be saved. Please, try again.', 'flash_failure');
			}
		}
	}
	
	function checkBirPayment()
	{
		$month = date('m');
		$year = date('Y');
		
		$this->loadModel('BookBirPayment');
		$query_payment = $this->BookBirPayment->query("select * from book_bir_payments BookBirPayment where month = '{$month}' and year = '{$year}' ");
		return $query_payment;
	}
	
	function add_cashtype() {
		
		if (!empty($this->data)) {
			
			// $this->log($this->data, 'poss');
			
			/*
				pag mag add ng expenses automatic book 1 and 2 meron expenses
			*/
			$remainingBalancedBookAll = $this->fundBookAll();
			
			if($this->data['CashBook']['status'] == 'cashin')
			{
				$this->data['CashBook']['cashin'] 			 = $this->data['CashBook']['amount'];
				$this->data['CashBook']['starting_balanced'] = $remainingBalancedBookAll;	
				$this->data['CashBook']['ending_balanced']   = $remainingBalancedBookAll + $this->data['CashBook']['amount'];
				
			} else {
				
				$this->data['CashBook']['cashout']           = $this->data['CashBook']['amount'];
				$this->data['CashBook']['starting_balanced'] = $remainingBalancedBookAll;	
				$this->data['CashBook']['ending_balanced']   = $remainingBalancedBookAll - $this->data['CashBook']['amount'];
			}
			
			
			
			$this->data['CashBook']['user_id'] 			    = $this->Session->read('Auth.User.id');
			$this->data['CashBook']['ending_bank_balanced'] = $this->bankBalancedBookAll();
		
			$this->CashBook->create();
			if ($this->CashBook->save($this->data)) {
	
				// to update fund of book 123
				$this->fundBookAllUpdate($this->data['CashBook']['ending_balanced']);
				
				$this->Session->setFlash('Transaction has been saved', 'flash_success');
				$this->redirect(array('controller'=>'cash_books', 'action' => 'list_cashtype'));
				
			} else {
				
				$this->Session->setFlash('Transaction could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
	function delete_cashtype() {

		if (!$this->data['CashBook']['id']) {
			$this->Session->setFlash('Invalid id for CashBook', 'flash_failure');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		if ($this->CashBook->delete($this->data['CashBook']['id'])) {
			
			// to increase the bank amount balanced 
			if(isset($this->data['CashBook']['amount']) && !empty($this->data['CashBook']['amount']))
			{

				$remainingBalancedBookAll = $this->fundBookAll();
				
				if($this->data['CashBook']['status'] == 'cashin')
				{
					$totalRemainingBalance = $remainingBalancedBookAll - $this->data['CashBook']['amount'];
					
				} else {
					
					$totalRemainingBalance = $remainingBalancedBookAll + $this->data['CashBook']['amount'];
				}
			
				// to update fund of book 123
				$this->fundBookAllUpdate($totalRemainingBalance);
				
			}
			
			$this->Session->setFlash('CashBook information updated', 'flash_success');
			$this->redirect(array('action' => $this->data['CashBook']['action']));
		}
		$this->Session->setFlash('CashBook was not deleted', 'flash_failure');
		$this->redirect(array('action' => $this->data['CashBook']['action']));
		
	}
	
	function list_cashtype() {
		
		$this->loadModel('User');

		if(isset($this->data['CashBook']['date_from']) && isset($this->data['CashBook']['date_to']))
		{
			$status = $this->data['CashBook']['status'];
			$datas = $this->myCashBook($status, $this->data['CashBook']['date_from'], $this->data['CashBook']['date_to']);
			
			$date['date_from'] = $this->data['CashBook']['date_from'];
			$date['date_to'] = $this->data['CashBook']['date_to'];
			$date['status'] = $this->data['CashBook']['status'];
			
			/*
			echo '<pre>';
			print_r($datas);
			echo '</pre>';
			*/
		
			$this->set('datas', $datas);
			$this->set('date', $date);
			$this->set('users', $this->User->find('list'));
		}
	}
	
}
?>