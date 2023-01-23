<?php
class TransactionInterestPayment extends AppModel {
	var $name = 'TransactionInterestPayment';
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
		),
		'book_code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Book code must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'deduct_first_month' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Deduct First Month must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'enabled' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enabled must check',
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