<?php
class TransactionUnderAuction extends AppModel {
	
	var $name = 'TransactionUnderAuction';
	
	var $belongsTo = array(
		'CustomerTransaction' => array(
			'className' => 'CustomerTransaction',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	
}
?>