<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	
	var $components = array('Auth', 'Session');
	var $uses 		= array(
							'User', 
							'Log',
							'BookFund', 
							'ServiceCharge',  
							'PawnshopEmail',
							'EmailLog',
							'CustomerTransaction',
							'CashBook',
							'IncrementptNumber'
	);
	

	
	function beforeFilter() {
		
		// $this->Auth->allow = false;

		$this->Auth->authError = "Please login to view that Page";
		$this->Auth->loginError = "Login Failed!";
		$this->Auth->loginRedirect = array("controller"=>"homes", "action"=>"home");
		$this->Auth->logoutRedirect = array("controller"=>"users", "action"=>"login");
	
		$this->set("admin", $this->_isAdmin());
		$this->set("logged_in", $this->_loggedIn());
		$this->set("user_role", $this->_usersUserName());
		
		$this->set("trasaction_counter_for_delete", $this->lastTrasaction());
		
		
		// preventing accesss on specific controller
		$clerk_controller = array(
			'users',
			'books',
			'items',
			'debits',
			'homes',
			'pawnshop_emails',
			'book_bir_interests'
		);
		
		// preventing accesss on specific action
		$clerk_action = array(
			'add',
			'edit',
			'delete',
			'view',
			'index',
			'add_debit'
			//'call_delete_log'
		);
		
		if(in_array($this->params['controller'], $clerk_controller) && in_array($this->params['action'], $clerk_action) && $this->Session->read('Auth.User.roles') == 'clerk')
		{
			$this->Session->setFlash('You are not autohorized access to access that location!', 'flash_failure');
			$this->redirect(array('controller'=>'homes', 'action'=>'home'));
			
		}
		
		// if user is enbled = 0 then auto logout
		if($this->Session->read('Auth.User.enabled') == '0')
		{
			$this->Session->setFlash('User denied, already disabled!', 'flash_failure');
			$this->redirect($this->Auth->logout());
		}
		
	}	
	
	function beforeRender()
	{
		// $this->set("patient_count", $this->_myPatientCount());
		// $this->set("user_count", $this->_myUserCount());
		// $this->set("order_count", $this->_myOrderCount());
	}

	function _isAdmin() {
		$admin = false;
		if($this->Auth->User('roles') == "admin") {  
			
			$admin = true;
		}
		return $admin;
	}	
	
	function _loggedIn() {
		$logged_in = false;
		if($this->Auth->User()) {
			$logged_in = true;
		}
		return $logged_in;
	}	
	
	function _usersUserName() {
		$user_role = null;
		if($this->Auth->User()) {
			$user_role = $this->Auth->User('roles');
		}
		return $user_role;
	}
	
	/*
	* every time you hitting the Email button at customer_trasaction controller
	* transaction.ctp this function will be call
	*/
	function addEmailLog($customer_id = null, $customer_name = null, $customer_email = null, $pt_number = null, $principal_amount = null, $interest = null, $due_amount = null, $due_date = null)
	{
		$email = array();
		
		$email['EmailLog']['customer_id'] 			= $customer_id;
		$email['EmailLog']['customer_name'] 		= $customer_name;
		$email['EmailLog']['customer_email'] 		= $customer_email;
		$email['EmailLog']['pt_number'] 			= $pt_number;
		$email['EmailLog']['principal_amount'] 		= $principal_amount;
		$email['EmailLog']['interest'] 				= $interest;
		$email['EmailLog']['payment_due_amount'] 	= $due_amount;
		$email['EmailLog']['payment_due_date'] 		= $due_date;
		$email['EmailLog']['user_id'] 				= $this->Auth->user('id');
		$email['EmailLog']['date'] 					= date('Y-m-d');
		$email['EmailLog']['time'] 					= date('H:i:s');
	
		$this->EmailLog->create();
		$this->EmailLog->save($email['EmailLog']);
	}
	
	// you can call this function to log the transaction
	function addTransactionLog($transaction_id = null, $controller = null, $description = null)
	{		
	
		$audit=array();
		
		$url 								= $this->params['url'];
		$audit['Log']['transaction_id'] 	= $transaction_id;
		$audit['Log']['controller'] 		= $controller;			
		$audit['Log']['url'] 				= $url['url'];			
		$audit['Log']['action'] 			= $this->params['action'];	
		$audit['Log']['description'] 		= $description;		
		$audit['Log']['ip_address'] 		= $_SERVER['REMOTE_ADDR'];
		$audit['Log']['user_id'] 			= $this->Auth->user('id');
		$audit['Log']['date'] 				= date('Y-m-d');
		$audit['Log']['time'] 				= date('H:i:s');

		$this->Log->create();
		$this->Log->save($audit['Log']);
	}
	
	// you can call this function anywhere to save cash book transaction kaya may & kasi array data yung pinapasa
	function addCashBookRecord(&$cashBookData)
	{		

		$cash_book_data = array();
		$cash_book_data = &$cashBookData;
						
		$this->CashBook->create();
		$this->CashBook->save($cash_book_data);

	}
	
	/*
	* ang gagawin nito example new pawned added pero gustong
	* i edit saka dito papasok. pwedeng ma edit yung bagong
	* sangla pag wala pang na create ng PT NUMBER
	*/
	function editCashBookRecord($book_id, $column, $amount, $cash_on_hand, $column_identifier, $id) 
	{	
		$this->CashBook->query("update cash_books set book_id = '{$book_id}', $column = '{$amount}', ending_balanced ='{$cash_on_hand}' where $column_identifier = '{$id}' ");
	}
	
	// for pawnshop 
	function fundBookAllUpdate($new_balanced) {
	
		$this->BookFund->query("update book_funds set starting_balance = '{$new_balanced}' where book_id = 123 ", false);
	}
	
	// for bir
	function fundBookAllUpdateBIR($new_balanced) {
	
		$this->BookFund->query("update book_funds set starting_balance = '{$new_balanced}' where book_id = 'bir' ", false);
	}

	// call this function to return the starting_balance
	function fundBookAll() {
	
		$start_balance = $this->BookFund->query("select starting_balance from book_funds BookFund where book_id = 123", false);
		return $start_balance[0]['BookFund']['starting_balance'];
	}
	
	// call this function to return the starting_balance
	function fundBookAllBIR() {
	
		$start_balance = $this->BookFund->query("select starting_balance from book_funds BookFund where book_id = 'bir' ", false);
		return $start_balance[0]['BookFund']['starting_balance'];
	}
	
	// call this function to return the service charge amount
	function serviceChargeAmount() {
	
		$service_charge = $this->ServiceCharge->query("select service_charge_amount from service_charges ServiceCharge where enabled = 1");
		return $service_charge[0]['ServiceCharge']['service_charge_amount'];
	}
	
	/*
	 * gagawin ng function na to i update yung net amount 
	 * pag mag bayad or mag less ng principal amount si customer
	*/
	function updateCustomerTransactionNetAmount($customer_transaction_id, $net_amount_duplicate) 
	{
		$this->CustomerTransaction->query("update customer_transactions set net_amount_duplicate = net_amount_duplicate - '{$net_amount_duplicate}' where id = '{$customer_transaction_id}' ");
	}
	
	// delete principal payment	
	function cancelPrincipalPayment($id, $net_amount_duplicate) {
		
		$this->CustomerTransaction->query("update customer_transactions set net_amount_duplicate = net_amount_duplicate + '{$net_amount_duplicate}' where id = '{$id}' ", false);
	}
	/*
	 this function will call if you hit the button 
	 1. price for auction
	 2. transaction redeemed
	 */
	function updateCustomerTransactionStatus($status, $id) {

		$this->CustomerTransaction->query("update customer_transactions set status = '{$status}' where id = '{$id}' ");
	}
	
	// partial status kung may bibili ex. total pcs 10 ang bibilin lang 5pcs ganon
	function updateCustomerTransactionParialStatus($partial_status, $id) {

		$this->CustomerTransaction->query("update customer_transactions set partial_status = '{$partial_status}' where id = '{$id}' ");
	}
	
	// partial status kung may bibili ex. total pcs 10 ang bibilin lang 5pcs ganon
	function updatePartialCapital($partialcapital, $id) {
	
		$this->CustomerTransaction->query("update customer_transactions set partial_capital = '{$partialcapital}' where id = '{$id}' ");
	}
	
	// partial status kung may bibili ex. total pcs 10 ang bibilin lang 5pcs ganon
	function returnPartial($id) {
		
		$result = $this->CustomerTransaction->query("select partial_capital from customer_transactions CustomerTransaction  where id = '{$id}' ");
		return $result[0]['CustomerTransaction']['partial_capital'];
	}
	
	// this function will call in every saving or creating new pt number
	function updateIncrementPtNumbers($book_id,  $next_pt_number) {

		$this->IncrementptNumber->query("update incrementpt_numbers set next_pt_number = '{$next_pt_number}' where book_id = '{$book_id}' ");
	}
	
	// this function will call in every saving or creating new pt number
	function nextPtNumberBook1() {
	
		$next_pt_number = $this->IncrementptNumber->query("select next_pt_number from incrementpt_numbers IncrementptNumber where book_id = 1");
		return $next_pt_number[0]['IncrementptNumber']['next_pt_number'];
	}
	
	// this function will call in every saving or creating new pt number
	function nextPtNumberBook2() {
	
		$next_pt_number = $this->IncrementptNumber->query("select next_pt_number from incrementpt_numbers IncrementptNumber where book_id = 2");
		return $next_pt_number[0]['IncrementptNumber']['next_pt_number'];
	}
	
	// this function will call in every saving or creating new pt number
	function nextPtNumberBook3() {
	
		$next_pt_number = $this->IncrementptNumber->query("select next_pt_number from incrementpt_numbers IncrementptNumber where book_id = 3");
		return $next_pt_number[0]['IncrementptNumber']['next_pt_number'];
	}
	
	function pawshopEmail() {
		
		$emailPassword = $this->PawnshopEmail->find('all', array('fields'=>array('email', 'password'), 'conditons'=>array('PawnshopEmail.enable'=> 1)));
		return $emailPassword;		
	}
	
		
	// bank account balanced for book 1,2 and 3 at si cash book 2 lang ang may bank account
	function bankBalancedBookAll() {
	
		$start_balance = $this->BookFund->query("select balanced from book_bank_funds BookBankFund where book_id = 123 ", false);
		return $start_balance[0]['BookBankFund']['balanced'];
	}
	
		// bank account balanced for book 1,2 and 3 at si cash book 2 lang ang may bank account
	function bankBalancedBookAllBIR() {
	
		$start_balance = $this->BookFund->query("select balanced from book_bank_funds BookBankFund where book_id = 'bir' ", false);
		return $start_balance[0]['BookBankFund']['balanced'];
	}
	
	// for expenses, withdrawal, deposit
	// mag papakita lang yung delete button sa pinaka last na transaction
	function lastTrasaction()
	{
		$date_today = date('Y-m-d');
		$result_id = $this->CashBook->query("select id from cash_books CashBook where date_created = '{$date_today}' order by id desc limit 1");

		if(!empty($result_id[0]))
		{
			return $result_id[0];
		}
	}
	
	function lastTrasactionPrincipalPayment()
	{
		$date_today = date('Y-m-d');
		$result_principal_payment_id = $this->CashBook->query("select id, transaction_principal_payment_id from cash_books CashBook where date_created = '{$date_today}' and transaction_principal_payment_id is not null order by id desc limit 1");

		if(!empty($result_principal_payment_id[0]))
		{
			return $result_principal_payment_id[0];
		}
	}
	
	function deletePrincipalPaymentCashBook($transaction_principal_payment_id) {
	
		$this->CashBook->query("delete from cash_books where transaction_principal_payment_id = '{$transaction_principal_payment_id}' ", false);

	}
	
	function fourMonthsUpdateToAunderAuction($customerTransactionID)
	{
		$this->CustomerTransaction->query("update customer_transactions set status = 'ua' where id = '{$customerTransactionID}' ", false);
	}
	
}?>