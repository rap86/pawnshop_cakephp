<?php
class BookBirPaymentsController extends AppController {

	var $name = 'BookBirPayments';
	
	function index()
	{
		$this->loadModel('BookBirPayment');
		$query_result = $this->BookBirPayment->query("select * from book_bir_payments BookBirPayment");
		$this->set('query_result', $query_result);
	}
	
	function details($id)
	{
		$this->loadModel('BookBirPayment');
		$query_result = $this->BookBirPayment->query("select * from book_bir_payments BookBirPayment where id = '{$id}'");
		
		/*
		echo '<pre>';
		print_r($query_result);
		echo '</pre>';
		*/
		
		$this->set('query_result', $query_result);
	}
	
}
?>