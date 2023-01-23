<?php
class TransactionRedeemItem extends AppModel {
	
	var $name = 'TransactionRedeemItem';
	
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