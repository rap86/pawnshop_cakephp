<?php
class TransactionInOutItem extends AppModel {
	
	var $name = 'TransactionInOutItem';
	
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