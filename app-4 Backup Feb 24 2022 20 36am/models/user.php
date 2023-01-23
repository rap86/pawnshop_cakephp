<?php
class User extends AppModel {
	
	var $name = 'User';
	var $displayField = 'name';
	var $virtualFields = array('name' => 'CONCAT(User.first_name, " ", User.last_name)');
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
		'middle_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Middlename must not empty',
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
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Username must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Password must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password_confirmation'=>array(
			'rule'=>'matchPassword',
			'message'=>'The Password do not match'
		),
		'roles' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Role must not empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	function matchPassword($data)
	{	
		if($data['password_confirmation'] == $this->data['User']['password'])
		{
			return true;
		}	
		$this->invalidate("password_confirmation","Password do not match");
		return false; 
	}
	
	function hashPasswords($data)
	{
		
		if(isset($this->data['User']['password']))
		{
			$this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
			return $data;
		}
		return $data;
	}
	
	function beforeSave()
	{
		$this->hashPasswords(null, true);
		return true;
	}
}
?>