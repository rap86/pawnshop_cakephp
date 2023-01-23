<?php
class CustomerTransaction extends AppModel {
	var $name = 'CustomerTransaction';
	// var $displayField = 'first_name';
	
	var $validate = array(
		'book_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Book must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'item_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Item must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gross_amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Gross amount must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gross_amount' => array(
			'notempty' => array(
				'rule' => array('numeric'),
				'message' => 'Numbers Only',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'net_amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Net amount must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'net_amount' => array(
			'notempty' => array(
				'rule' => array('numeric'),
				'message' => 'Numbers Only',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	var $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Book' => array(
			'className' => 'Book',
			'foreignKey' => 'book_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'TransactionInterestPayment' => array(
			'className' => 'TransactionInterestPayment',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionPrincipalPayment' => array(
			'className' => 'TransactionPrincipalPayment',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionActionLevel' => array(
			'className' => 'TransactionActionLevel',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionSoldItem' => array(
			'className' => 'TransactionSoldItem',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionUnderAuction' => array(
			'className' => 'TransactionUnderAuction',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionRedeemItem' => array(
			'className' => 'TransactionRedeemItem',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionInOutItem' => array(
			'className' => 'TransactionInOutItem',
			'foreignKey' => 'customer_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>