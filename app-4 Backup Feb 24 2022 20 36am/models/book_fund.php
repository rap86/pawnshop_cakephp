<?php
class BookFund extends AppModel {
	
	var $name = 'BookFund';
	
	var $validate = array(
		'amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Amount must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'Numeric' => array(
				'rule' => array('Numeric'),
				'message' => 'Amount only number accepted',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Description must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);
}
?>