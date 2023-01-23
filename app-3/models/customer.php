<?php 
class Customer extends AppModel {
	
	var $name = 'Customer';
	
	var $validate = array(
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Firstname must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Lastname must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Gender must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);	
	
	
	var $hasMany = array(
		'CustomerTransaction' => array(
			'className' => 'CustomerTransaction',
			'foreignKey' => 'customer_id'
		),
		'TransactionSoldItem' => array(
			'className' => 'TransactionSoldItem',
			'foreignKey' => 'customer_id'
		)
	);
	
}
?>