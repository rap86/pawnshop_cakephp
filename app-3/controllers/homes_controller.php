<?php 

class HomesController extends AppController {
	var $name = 'Homes';
	var $uses = array();
	// var $components = array('Sms');
	
	function sendsms() {
	
		
	}
	
	function dashboard() {
		
	}
	
	function download_database(){
		
		$this->backupDatabase();
		$this->Session->setFlash('Database Backup Success!', 'flash_success');
		$this->addTransactionLog('Database backup clicked', 'Homes', 'click');
		//$this->redirect(array('controller'=> 'homes', 'action'=>'dashboard'));
		
	}
	
	function backupDatabase($dbHost='localhost',$dbUsername='root',$dbPassword='',$dbName='mypawnshop',$tables = '*'){
		//connect & select the database
		
		$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

		//get all of the tables
		$return .= "SET FOREIGN_KEY_CHECKS = 0;";
		
		if($tables == '*'){
			$tables = array();
			$result = $db->query("SHOW TABLES");
			while($row = $result->fetch_row()){
				$tables[] = $row[0];
			}
		}else{
			$tables = is_array($tables)?$tables:explode(',',$tables);
		}

		//loop through the tables
		foreach($tables as $table){
			$result = $db->query("SELECT * FROM $table");
			$numColumns = $result->field_count;

			// $return .= "DROP TABLE $table;";
			// $return .= "SET FOREIGN_KEY_CHECKS = 0;";

			$result2 = $db->query("SHOW CREATE TABLE $table");
			$row2 = $result2->fetch_row();

			$return .= "\n\n".$row2[1].";\n\n";

			for($i = 0; $i < $numColumns; $i++){
				while($row = $result->fetch_row()){
					$return .= "INSERT INTO $table VALUES(";
					for($j=0; $j < $numColumns; $j++){
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
						if ($j < ($numColumns-1)) { $return.= ','; }
					}
					$return .= ");\n";
				}
			}

			$return .= "\n\n\n";
		}
		$return .= "SET FOREIGN_KEY_CHECKS = 1;";
		
		$directoryName = 'C:/pawnshopDatabase/'.date('Y-m-d');
		if(!is_dir($directoryName)){
		
			mkdir($directoryName, 0755, true);
			
		}
				
		//save file

		$handle = fopen($directoryName.'/'.date('Y-m-d').'.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
	}
	
	function call_delete_log() {

	}
	
	function home()
	{
		
		$queryResult = $this->CustomerTransaction->query("
			SELECT 
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'pawned' AND book_id = 1) book_one_item_pawned,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'pawned' AND book_id = 1) book_one_amount_pawned,
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'pawned' AND book_id = 2) book_two_item_pawned,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'pawned' AND book_id = 2) book_two_amount_pawned,
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'pawned' AND book_id = 3) book_three_item_pawned,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'pawned' AND book_id = 3) book_three_amount_pawned,
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'ua' AND book_id = 1) book_one_item_ua,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'ua' AND book_id = 1) book_one_amount_ua,
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'ua' AND book_id = 2) book_two_item_ua,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'ua' AND book_id = 2) book_two_amount_ua,
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'ua' AND book_id = 3) book_three_item_ua,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'ua' AND book_id = 3) book_three_amount_ua,	
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'takeout' AND book_id = 1) book_one_item_to,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'takeout' AND book_id = 1) book_one_amount_to,
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'takeout' AND book_id = 2) book_two_item_to,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'takeout' AND book_id = 2) book_two_amount_to,
				(SELECT 
						COUNT(status)
					FROM
						customer_transactions
					WHERE
						status = 'takeout' AND book_id = 3) book_three_item_to,
				(SELECT 
						SUM(net_amount_duplicate)
					FROM
						customer_transactions
					WHERE
						status = 'takeout' AND book_id = 3) book_three_amount_to
	  
		");
		//debug($queryResult);
		
		return $queryResult;
	}
	
	function bookFund()
	{
		$this->loadModel('BookFund');
		$queryResultFund = $this->BookFund->query("
			SELECT 
				(SELECT 
						starting_balance
					FROM
						book_funds
					WHERE
						book_id = 123) AS book_123,
				(SELECT 
						starting_balance
					FROM
						book_funds
					WHERE
						book_id = 'bir') AS book_bir,
				(SELECT 
						balanced
					FROM 
						book_bank_funds where book_id = 'bir') cash_book_one_bank_fund,
				(SELECT 
						balanced
					FROM 
						book_bank_funds where book_id = '123') cash_book_two_bank_fund
		");
		return $queryResultFund[0][0];	
	}
	
	function delete_internal_file_logs()
	{

		$files = glob('../tmp/logs/'.'*');
		foreach ($files as $file) {
			
			unlink($file);
		}
		
		$this->Session->setFlash('Internal log files deleted', 'flash_success');
		$this->addTransactionLog('internal log files deleted in tmp/logs/', 'Homes', 'click');
	}
}
?>