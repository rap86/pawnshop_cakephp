<?php

class AddCustomerTransactionLevelComponent extends Object
{
	function initialize($controller)
	{ 
		$this->controller = $controller;
	}
	
	public function addDetails($addDetailValue)
	{
		// $this->log($myData, 'posex');
		
		$this->controller->loadModel('TransactionActionLevel');
		
		if (!empty($addDetailValue)) {
			    $this->controller->TransactionActionLevel->create();
			if ($this->controller->TransactionActionLevel->save($addDetailValue)) {
				
			} else {
				$this->Session->setFlash('The TransactionActionLevel could not be saved. Please, try again.', 'flash_failure');
			}
		}
	}
}
?>