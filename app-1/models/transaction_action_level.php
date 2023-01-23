<?php
class TransactionActionLevel extends AppModel {
	var $name = 'TransactionActionLevel';
	
	var $belongsTo = array(
		'CustomerTransaction' => array(
			'className' => 'CustomerTransaction',
			'foreignKey' => 'customer_transaction_id'
		)
	);
	
}
?>