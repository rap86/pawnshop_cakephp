<?php

class AddCustomerTransactionLevelsComponent extends Object
{
	function initialize($controller)
	{ 
		$this->controller = $controller;
	}
	
	public function addLevels($addLevelValue)
	{
		$this->controller->loadModel('TransactionActionLevel');
		
		if (!empty($addLevelValue)) {
			    $this->controller->TransactionActionLevel->create();
			if ($this->controller->TransactionActionLevel->save($addLevelValue)) {
				
			} else {
				$this->Session->setFlash('The TransactionActionLevel could not be saved. Please, try again.', 'flash_failure');
			}
		}
	}
}
?>