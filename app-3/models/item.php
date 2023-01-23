<?php
class Item extends AppModel {
	var $name = 'Item';
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
	
	
	var $hasMany = array(
		'CustomerTransaction' => array(
			'className' => 'CustomerTransaction',
			'foreignKey' => 'item_id'
		)
	);
	
}
?>