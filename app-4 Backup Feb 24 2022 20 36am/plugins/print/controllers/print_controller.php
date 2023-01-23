<?php
class PrintController extends PrintAppController
{
	var $name = 'Print';
    var $uses = array();
	var $helpers = array('Html');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
	}
	
	function print_book($bookNo , $status)
	{
		$this->loadModel('Customer');	
		$this->loadModel('CustomerTransaction');
		$this->loadModel('TransactionInterestPayment');
		$query_result = $this->CustomerTransaction->query("
					select 
						Customer.id,
						Customer.first_name,
						Customer.middle_name,
						Customer.gender,
						Customer.last_name,
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
						DATEDIFF(current_date(), TransactionInterestPayment.payment_starting_date) as difference_days

					from 
						customers Customer 
					join 
						customer_transactions CustomerTransaction on Customer.id = CustomerTransaction.customer_id
					left join
						transaction_interest_payments TransactionInterestPayment on TransactionInterestPayment.customer_transaction_id = CustomerTransaction.id
					where 
						CustomerTransaction.status = '{$status}' and CustomerTransaction.book_id = '{$bookNo}'
		");
		

		
		foreach($query_result as $key => $value)
		{
			$datas[ $value['CustomerTransaction']['id'] ]['Customer'] = $value['Customer'];
			$datas[ $value['CustomerTransaction']['id'] ]['CustomerTransaction'] = $value['CustomerTransaction'];
			$datas[ $value['CustomerTransaction']['id'] ]['TransactionInterestPayment'] = $value['TransactionInterestPayment'];
			$datas[ $value['CustomerTransaction']['id'] ]['TransactionInterestPayment']['date_diff'] = $this->convertToYearMonthDay($value[0]['difference_days']);
		}
		
		/*
		echo '<pre>';
		print_r($datas);
		echo '</pre>';
		*/
		usort($datas, function ($item1, $item2) {
				if ($item1['TransactionInterestPayment']['pt_number'] == $item2['TransactionInterestPayment']['pt_number']) return 0;
				return $item1['TransactionInterestPayment']['pt_number'] < $item2['TransactionInterestPayment']['pt_number'] ? -1 : 1;
		});
		
		$this->set('results', $datas);
		$this->set('book', $bookNo);
		$this->layout = 'pdf';
	}
	
	function convertToYearMonthDay($sum) {
		$years = floor($sum / 365);
		$months = floor(($sum - ($years * 365))/30.5);
		$days = floor($sum - ($years * 365) - ($months * 30.5));
		return 'Y'.$years.'-M'.$months.'-D'.$days;
	}
	
	// this printing is for whole transaction
	function print_customer_transactions($id = null)
	{
		if (!$id) {
			$this->Session->setFlash('Invalid id, record not available', 'flash_failure');
			$this->redirect(array('controller'=>'homes', 'action' => 'home'));
		}

		$this->loadModel('CustomerTransaction');	
		$this->loadModel('PawnshopEmail');
		
		$email_details = $this->PawnshopEmail->find('all', array('conditions'=>array('enabled'=>1)));
		
		$this->CustomerTransaction->Behaviors->attach('containable');
		$transaction_details = $this->CustomerTransaction->find('all', array(
				'contains'=>array(
					'CustomerTransaction'=>array(
						'Customer'
						)
					),
					'conditions'=>array('CustomerTransaction.id'=>$id)
				)
		);

		$this->set('email_detail', $email_details[0]);
		$this->set('transaction_details', $transaction_details);
		
		$this->layout = 'pdf';
	}
	
	// per pt number of printing details
	function print_details($id)
	{
		$this->loadModel('TransactionInterestPayment');
		$this->loadModel('PawnshopEmail');
		
		$email_details = $this->PawnshopEmail->find('all', array('conditions'=>array('enabled'=>1)));
		
		if (!$id) {
			$this->Session->setFlash('Invalid TransactionInterestPayment id, record not available', 'flash_failure');
			$this->redirect(array('controller'=>'homes', 'action' => 'home'));
		}
		
		$this->TransactionInterestPayment->Behaviors->attach('containable');
		$transaction_details = $this->TransactionInterestPayment->find('all', array(
				'contain'=>array(
					'CustomerTransaction'=>array(
						'Customer',
						'TransactionPrincipalPayment'=>array(
							'order'=>'id asc'
							)
						),
						
					),
					'conditions'=>array('TransactionInterestPayment.id'=>$id)
				)
		);
		
		$this->set('email_detail', $email_details[0]);
		$this->set('transaction_details', $transaction_details);		
		$this->layout = 'pdf';
	}
	
	// per pt number of printing details
	function print_form($id)
	{
		$this->loadModel('TransactionInterestPayment');
		$this->loadModel('PawnshopEmail');
		
		$email_details = $this->PawnshopEmail->find('all', array('conditions'=>array('enabled'=>1)));
		
		if (!$id) {
			$this->Session->setFlash('Invalid TransactionInterestPayment id, record not available', 'flash_failure');
			$this->redirect(array('controller'=>'homes', 'action' => 'home'));
		}
		
		$this->TransactionInterestPayment->Behaviors->attach('containable');
		$transaction_details = $this->TransactionInterestPayment->find('all', array(
				'contain'=>array(
					'CustomerTransaction'=>array(
						'Customer',
						'TransactionPrincipalPayment'=>array(
							'order'=>'id asc'
							)
						),
						
					),
					'conditions'=>array('TransactionInterestPayment.id'=>$id)
				)
		);
		
		$this->set('email_detail', $email_details[0]);
		$this->set('transaction_details', $transaction_details);		
		$this->layout = 'pdf';
	}
	
	// printing of logs by transaction
	function print_logs($from = null, $to = null) {
		
		$results = $this->Log->query("select * from logs Log where date >= '{$from}' and date <= '{$to}' order by id asc ");
		$date['from'] = $from;
		$date['to'] = $to;
		
		$this->set('date', $date);
		$this->set('results', $results);
		$this->layout = 'pdf';
		
	}
	
	// printing of cash type like withdrawal, deposit and expenses
	function cash_type($status = null, $from = null, $to = null) {
		
		$this->loadModel('User');
		$this->loadModel('CashBook');
		
		if( isset($from) && isset($to) ) {
		
			$datas = $this->CashBook->query("
				select 
					id,
					$status,
					details,
					date_created,
					time_created,
					enabled,
					user_id
				from 
					cash_books CashBook 
				where 
					date_created >= '{$from}'
						and
					date_created <= '{$to}'
						and
					enabled = 1	
						and
					status = '{$status}'
			");
			
			$users =  $this->User->find('list');
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('users', $users);
		$this->set('status', $status);
		$this->set('datas', $datas);
		$this->set('date', $date);
		
		$this->layout = 'pdf';
	}
	
	// printing of cash type like withdrawal, deposit and expenses
	function cash_type_two($status = null, $bir = null, $from = null, $to = null) {
		
		$this->loadModel('User');
		$this->loadModel('CashBook');
		
		if( isset($from) && isset($to) ) {
		
			$datas = $this->CashBook->query("
				select 
					id,
					$status,
					details,
					date_created,
					time_created,
					enabled,
					user_id
				from 
					cash_books CashBook 
				where 
					date_created >= '{$from}'
						and
					date_created <= '{$to}'
						and
					enabled = 1	
						and
					status = '{$status}'
						and
					for_bir = '{$bir}'	
			");
			
			$users =  $this->User->find('list');
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('users', $users);
		$this->set('status', $status);
		$this->set('datas', $datas);
		$this->set('date', $date);
		$this->set('bir', $bir);
		
		$this->layout = 'pdf';
	}
	
	// printing of cash type like withdrawal, deposit and expenses
	function cashtype_inout($status = null, $from = null, $to = null) {
		
		$this->loadModel('User');
		$this->loadModel('CashBook');
		
		if( isset($from) && isset($to) ) {
		
			$datas = $this->CashBook->query("
				select 
					id,
					$status,
					details,
					date_created,
					time_created,
					enabled,
					user_id
				from 
					cash_books CashBook 
				where 
					date_created >= '{$from}'
						and
					date_created <= '{$to}'
						and
					enabled = 1	
						and
					status = '{$status}'	
			");
			
			$users =  $this->User->find('list');
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('users', $users);
		$this->set('status', $status);
		$this->set('datas', $datas);
		$this->set('date', $date);
		
		$this->layout = 'pdf';
	}
	
	// printing of cash book all book
	function report_capital($from = null, $to = null) {
		
		$this->loadModel('CashBook');
		
		if( isset($from) && isset($to) ) {
		
			$result_query = $this->CashBook->query("
			
				select 
					* 
				from 
					cash_books CashBook
				where 
					date_created >= '{$from}' 
				and
					date_created <= '{$to}' 
					
				order by id, date_created, time_created asc
			");
			
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
			
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('datas', $formatOne);
		$this->set('date', $date);
		
		//$this->layout = 'pdf';
		$this->layout = 'pdf_landscape';
	}
	
	// printing of cash book all book
	function cash_book_two($from = null, $to = null) {
		
		$this->loadModel('CashBook');
		
		if( isset($from) && isset($to) ) {
		
			$result_query = $this->CashBook->query("
			
				select 
					* 
				from 
					cash_books CashBook
				where 
					date_created >= '{$from}' 
				and
					date_created <= '{$to}' 
					
				order by id, date_created, time_created asc
			");
			
			foreach($result_query as $key => $value)
			{
					
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ][] = $value;
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
				if(trim($value['CashBook']['ending_bank_balanced']) != '')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['ending_bank_balanced'][] = $value['CashBook']['ending_bank_balanced'];
				}
				
				if($value['CashBook']['for_bir'] == '0')
				{
					$formatOne[ $value['CashBook']['date_created'] ] ['deposit']['deposit'] += $value['CashBook']['deposit'];
					$formatOne[ $value['CashBook']['date_created'] ] ['withdrawal']['withdrawal'] += $value['CashBook']['withdrawal'];
				}
				
			}
			
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('datas', $formatOne);
		$this->set('date', $date);
		
		$this->layout = 'pdf';
		//$this->layout = 'pdf_landscape';
	}
	
	// printing of cash book all book
	function cash_book_one($from = null, $to = null) {
		
		$this->loadModel('CashBook');
		
		if( isset($from) && isset($to) ) {
		
			$result_query = $this->CashBook->query("
			
				select 
					* 
				from 
					cash_books CashBook
				where 
					date_created >= '{$from}' 
				and
					date_created <= '{$to}' 
				and
					for_bir = 1
					
				order by id, date_created, time_created asc
			");
			
			foreach($result_query as $key => $value)
			{
					
				$formatOne[ $value['CashBook']['date_created'] ] [ 'book_'.$value['CashBook']['book_id'] ][] = $value;
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
			
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('datas', $formatOne);
		$this->set('date', $date);
		
		$this->layout = 'pdf';
	}
	
	// printing of granted
	function granted($from = null, $to = null, $book_id = null) {
		
		$this->loadModel('CustomerTransaction');
		$this->loadModel('Customer');
		$this->loadModel('User');
		$this->loadModel('Item');
		
		if( isset($from) && isset($to) ) {
		
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
						CustomerTransaction.book_id = '{$book_id}' 
					and 
						CustomerTransaction.sangla_date >= '{$from}' 
					and
						CustomerTransaction.sangla_date <= '{$to}' 
					
					order by CustomerTransaction.id asc	
			");
			
			foreach($result_query as $key => $value)
			{
				$formatOne[ $value['CustomerTransaction']['sangla_date'] ] [ $value['CustomerTransaction']['id'] ][] = $value;
			}
			
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('book_id', $book_id);
		$this->set('datas', $formatOne);
		$this->set('date', $date);
		
		$this->layout = 'pdf_landscape';
	}
	
	// printing of collected
	function collected($from = null, $to = null, $book_id = null) {
		
		$this->loadModel('CustomerTransaction');
		$this->loadModel('Customer');
		$this->loadModel('User');
		$this->loadModel('Item');
		
		if( isset($from) && isset($to) ) {
		
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
							AND CashBook.book_id = '{$book_id}' 
							AND CashBook.date_created >= '{$from}' 
							AND CashBook.date_created <= '{$to}' 
					GROUP BY CashBook.id 
					ORDER BY CashBook.date_created, CashBook.time_created ASC
			");
			
			foreach($result_query as $key => $value)
			{
				$formatOne[ $value['CashBook']['date_created'] ][ $value['CashBook']['cash_book_id'] ][] = $value;
			}
			
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('book_id', $book_id);
		$this->set('datas', $formatOne);
		$this->set('date', $date);
		
		$this->layout = 'pdf_landscape';
	}
	
	function print_funds($from = null, $to = null, $status = null) {
		
		$this->loadModel('DebitCreditFund');
		$results = $this->DebitCreditFund->query("select * from debit_credit_funds DebitCreditFund where status = '{$status}' and date >= '{$from}' and date <= '{$to}' ");
		$date['from'] = $from;
		$date['to'] = $to;
		
		
		$this->set('status', $status);
		$this->set('date', $date);
		$this->set('results', $results);
		$this->layout = 'pdf';
		
	}
	
	function print_soa($from = null, $to = null) {
		
		$this->loadModel('DebitCreditFund');
		$debit_credit_funds = $this->DebitCreditFund->query("select * from debit_credit_funds DebitCreditFund where date >= '{$from}' and date <= '{$to}' ");
		$date['from'] = $from;
		$date['to'] = $to;

		$this->set('date', $date);
		$this->set('debit_credit_funds', $debit_credit_funds);
		$this->layout = 'pdf';
		
	}
	
	function print_graph($from = null, $to = null) {
		
		$debit_amount = 'debit';
		$credit_amount = 'credit';
		$this->loadModel('DebitCreditFund');
		
		if( isset($from) && isset($to) ) {
		
			$query_result = $this->DebitCreditFund->query("select * from debit_credit_funds DebitCreditFund where date >= '{$from}' and date <= '{$to}' order by id, date asc");
				
			$holder = array();
			foreach($query_result as $key => $value)
			{
				$holder[ $value['DebitCreditFund']['date'] ] ['DebitCreditFund']['date'] = $value['DebitCreditFund']['date'];
				
				
					$holder[ $value['DebitCreditFund']['date'] ] ['DebitCreditFund'][ 'debit' ] += ($value['DebitCreditFund']['debit_amount'] != '') ? $value['DebitCreditFund']['debit_amount'] : 0;
					$holder[ $value['DebitCreditFund']['date'] ] ['DebitCreditFund'][ 'credit' ] += ($value['DebitCreditFund']['credit_amount'] != '') ? $value['DebitCreditFund']['credit_amount'] : 0;	
				
			}

			
			$date['from'] = $from;
			$date['to']   = $to;
		}
		
		$this->set('date', $date);
		$this->set('holder', $holder);
		$this->layout = 'pdf';
	}
	
}
?>