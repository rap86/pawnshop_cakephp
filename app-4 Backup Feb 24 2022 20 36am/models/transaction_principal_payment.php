<?php
class TransactionPrincipalPayment extends AppModel {
	var $name = 'TransactionPrincipalPayment';
	// var $displayField = 'first_name';
	
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	
	var $belongsTo = array(
		'CustomerTransaction' => array(
			'className' => 'CustomerTransaction',
			'foreignKey' => 'customer_transaction_id'
		)
	);
	
}
?>