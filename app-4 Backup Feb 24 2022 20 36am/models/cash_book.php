<?php
class CashBook extends AppModel {
	var $name = 'CashBook';
	
	var $validate = array(
		'credit_amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Amount must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'credit_amount' => array(
			'notempty' => array(
				'rule' => array('numeric'),
				'message' => 'Numbers Only',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please add description',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
}
?>