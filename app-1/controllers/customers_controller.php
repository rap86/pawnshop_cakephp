<?php 
class CustomersController extends AppController {
	
	var $name = 'Customers';
	var $helpers = array('Html', 'Form', 'Ajax');
	
	function beforeFilter() {
		parent::beforeFilter();
	}


	function customer_image() {
		
		$fileDate = date('Y-m-d')."-";	 
		$fileTime = time() . '.jpg';
		$filepath = 'webcamImage/';

		move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$fileDate.$fileTime);

		echo $filepath.$fileDate.$fileTime;
		
		$this->layout='ajax';
		$this->render('/common/json');
		
	}
	
	function add() {
		
		if (!empty($this->data)) {
			
			$this->Customer->create();
			$this->data['Customer']["created_by"] =  $this->Session->read('Auth.User.id');
			$this->data['Customer']["enabled"] = 1;
			
			if(!empty($this->data['image_name']['name']))
			{
			
				if (!empty($this->data['image_name']['name'])) 
				{
					$dateTime = date('Y-m-d-H-i-s');
					$file = $this->data['image_name'];
					
					$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
					$arr_ext = array('jpg', 'jpeg', 'gif','png');

					if (in_array($ext, $arr_ext)) 
					{
						
						$directoryName = 'img/customer_image/'.date('Y').'/'.date('m').'/'.date('d');
						if(!is_dir($directoryName)){
						
							mkdir($directoryName, 0755, true);
							
						}
						
						move_uploaded_file($file['tmp_name'], WWW_ROOT . $directoryName."/".$dateTime.'-'.$file['name']);
						$this->data['Customer']['image_name'] 		= $dateTime.'-'.$file['name'];
						$this->data['Customer']['image_size'] 		= $file['size'];
						$this->data['Customer']['image_location'] 	= "/".$directoryName."/".$dateTime.'-'.$file['name'];
						
					}
					
				} else {
					
					$this->data['Customer']['image_name'] 		= '';
					$this->data['Customer']['image_size'] 		= 0;
					$this->data['Customer']['image_location'] 	= '';
				}
				
				
			} else {
				
				
				$directoryName = 'img/customer_image/'.date('Y').'/'.date('m').'/'.date('d');
				if(!is_dir($directoryName)){
				
					mkdir($directoryName, 0755, true);
					
				}
				copy('webcamImage/'.$this->data['Customer']['customer_image'], $directoryName."/".$this->data['Customer']['customer_image']);
				
				$this->data['Customer']['image_name'] 	 = $this->data['Customer']['customer_image'];
				$this->data['Customer']['image_location'] = "/".$directoryName."/".$this->data['Customer']['customer_image'];
				
				$files = glob('webcamImage/'.'*');
				foreach ($files as $file) {
					
					unlink($file);
				}
				
				
			}
			
			if(trim($this->data['Customer']['image_name']) == '')
			{
				$this->data['Customer']['image_location'] = '';
			}
			
			if ($this->Customer->save($this->data)) {
								
				$this->Session->setFlash('New Customer record created.', 'flash_success');
				$this->addTransactionLog('Add new customer', 'Customer', $this->Customer->id);
				$this->redirect(array('controller'=>'customers' ,'action' => 'view', $this->Customer->id));
				
			} else {
				$this->Session->setFlash('The Customer could not be saved. Please, try again.', 'flash_failure');
			}
		}
		
	}
	
	function search() {
		
		$this->Customer->recursive = 0;
		$customer_like = $this->Customer->find('all', array(
			'conditions'=>array(
				'last_name LIKE'=> '%'. $this->data['Customer']['name']. '%'
			)
		));
				
		$this->set('customers', $customer_like);
		$this->addTransactionLog($this->data['Customer']['name'], 'Customer', 'Search customer information');
		
		$this->render('/customers/index');
	}
	
	function index() {
		
		$this->Customer->recursive = 0;
		$customers = $this->Customer->find('all');
		$this->set('customers', $customers);
		
	}
	
	function edit($id = null) {
		
		$this->loadModel('CustomerLog');
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Customer', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			
				if(!empty($this->data["Customer"]["image_name"]["name"]))
				{
					$this->Customer->recursive = 0;
					$image_location = $this->Customer->find('first', array('fields'=>'image_location', 'conditions'=>array('id'=>$this->data['Customer']['id'])));
					
					if(trim($image_location["Customer"]["image_location"]) != "")
					{
						unlink(substr($image_location["Customer"]["image_location"], 1));
					}
					
					$file = $this->data['Customer']['image_name'];
					$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
					$arr_ext = array('jpg', 'jpeg', 'gif','png');
					
					if (in_array($ext, $arr_ext)) {
						
						$dateTime = date('Y-m-d-H-i-s');
						$directoryName = 'img/customer_image/'.date('Y').'/'.date('m').'/'.date('d');
						if(!is_dir($directoryName)){
						
							mkdir($directoryName, 0755, true);
							
						}
						
						move_uploaded_file($file['tmp_name'], WWW_ROOT . $directoryName."/".$dateTime.'-'.$file['name']);
						$this->data['Customer']['image_name'] 		= $dateTime.'-'.$file['name'];
						$this->data['Customer']['image_size'] 		= $file['size'];
						$this->data['Customer']['image_location'] 	= "/".$directoryName."/".$dateTime.'-'.$file['name'];
							
				
					
					} else{
						
						$this->Session->setFlash('Customer image failed to update', 'flash_failure');
					}
					
				} elseif (!empty($this->data['Customer']['customer_image'])){
					
					$image_location = $this->Customer->find('first', array('fields'=>'image_location', 'conditions'=>array('id'=>$this->data['Customer']['id'])));
					
					if(trim($image_location["Customer"]["image_location"]) != "")
					{
						unlink(substr($image_location["Customer"]["image_location"], 1));
					}
					
					$directoryName = 'img/customer_image/'.date('Y').'/'.date('m').'/'.date('d');
					if(!is_dir($directoryName)){
					
						mkdir($directoryName, 0755, true);
						
					}
					$directoryName = 'img/customer_image/'.date('Y').'/'.date('m').'/'.date('d');
					copy('webcamImage/'.$this->data['Customer']['customer_image'], $directoryName."/".$this->data['Customer']['customer_image']);
					
					
					$this->data['Customer']['image_name'] 	 = $this->data['Customer']['customer_image'];
					$this->data['Customer']['image_location'] = "/".$directoryName."/".$this->data['Customer']['customer_image'];
					
					$files = glob('webcamImage/'.'*');
					foreach ($files as $file) {
						
						unlink($file);
					}
					
				} else {
					
					$this->Customer->recursive = 0;
					$image_column = $this->Customer->find('first', array('fields'=>array('image_name', 'image_location', 'image_size'), 'conditions'=>array('id'=>$this->data['Customer']['id'])));
					$this->data['Customer']['image_name'] = $image_column["Customer"]["image_name"];
					$this->data['Customer']['image_location'] = $image_column["Customer"]["image_location"];
					$this->data['Customer']['image_size'] = $image_column["Customer"]["image_size"];
					
				}
				
				if(trim($this->data['Customer']['image_name']) == '')
				{
					$this->data['Customer']['image_location'] = '';
				}
				if ($this->Customer->save($this->data)) {
					$this->addTransactionLog('Edit customer information', 'Customer', $id);
					
					$this->data['CustomerLog']['customer_id'] 	= $this->Customer->id;
					$this->data['CustomerLog']['first_name'] 	= $this->data['Customer']['first_name'];
					$this->data['CustomerLog']['middle_name'] 	= $this->data['Customer']['middle_name'];
					$this->data['CustomerLog']['last_name'] 	= $this->data['Customer']['last_name'];
					$this->data['CustomerLog']['user_id'] 		= $this->Session->read('Auth.User.id');
					
					$this->CustomerLog->create();
					$this->CustomerLog->save($this->data['CustomerLog']);
					
					$this->Session->setFlash('Customer record updated', 'flash_success');
					$this->redirect(array('action' => 'view', $id));
					
				} else {
					$this->Session->setFlash('The Customer could not be saved. Please, try again.', 'flash_failure');
				}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Customer->read(null, $id);
			
			$this->data['CustomerLog']['customer_id'] 	= $this->Customer->id;
			$this->data['CustomerLog']['first_name'] 	= $this->data['Customer']['first_name'];
			$this->data['CustomerLog']['middle_name'] 	= $this->data['Customer']['middle_name'];
			$this->data['CustomerLog']['last_name'] 	= $this->data['Customer']['last_name'];
			$this->data['CustomerLog']['user_id'] 		= $this->Session->read('Auth.User.id');
			
			$this->CustomerLog->create();
			$this->CustomerLog->save($this->data['CustomerLog']);
		}
		
	}
	
	function view($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Invalid Customer, record not available', 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		
		$this->loadModel('User');
		$users = $this->User->find('list');
		
		$this->Customer->Behaviors->attach('containable');
		$customerDetails = $this->Customer->find('all', array(
				'contain'=>array(
						'CustomerTransaction'=>array(
							'TransactionInterestPayment'=>array(
								'order' => 'id asc'
							),
							'Book',
							'Item',
							'TransactionPrincipalPayment'=>array(
								'order'=>'id asc'
							),
							'TransactionActionLevel',
							'TransactionRedeemItem',
							'TransactionUnderAuction',
							'TransactionSoldItem'=>array(
								
								'Customer'
							)
						)
						
						
					),
					'conditions'=>array('Customer.id'=>$id)
				)
				
		);
	
		
		$customerPurchased = $this->Customer->find('all', array(
				'contain'=>array(
							'TransactionSoldItem'=>array(
								'CustomerTransaction'=>array(
									'Customer'
								)
							)
					),
					'conditions'=>array('Customer.id'=>$id)
				)
				
		);
	
		/*
		echo "<pre>";
		print_r($customerPurchased);
		echo "</pre>";
		*/
		
		// $this->addTransactionLog('View customer information', 'Customer', $id);
		$this->set('customer_purchased', $customerPurchased);
		$this->set('customer_details', $customerDetails);
		$this->set('users', $users);
		
	}
} 
?>