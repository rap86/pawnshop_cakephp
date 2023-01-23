<?php

class LogsController extends AppController {

	var $name = 'Logs';
	
	function index() {

		if( isset($this->data['Log']['date_from']) ) {
			$dateFrom = $this->data['Log']['date_from'];
		} else {
			$dateFrom = date('Y-m-d');
		}
		
		if( isset($this->data['Log']['date_to']) ) {
			$dateTo = $this->data['Log']['date_to'];
		} else {
			$dateTo = date('Y-m-d');
		}
		
		$date['date_from'] = $dateFrom;
		$date['date_to']   = $dateTo;
		
		
		$logs = $this->Log->query("select * from logs Log where date >= '{$dateFrom}' and date <= '{$dateTo}' order by id, date asc");
		/*
		echo '<pre>';
		print_r($logs);
		echo '</pre>';
		*/
		$this->set('logs', $logs);
		$this->set('date', $date);
	}
}
?>