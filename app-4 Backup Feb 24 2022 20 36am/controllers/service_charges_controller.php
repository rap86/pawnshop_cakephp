<?php
class ServiceChargesController extends AppController {

	var $name = 'ServiceCharges';
	
	function index() {
		$this->ServiceCharges->recursive = 0;
		$this->set('service_charges', $this->paginate());
	}
	
}
?>