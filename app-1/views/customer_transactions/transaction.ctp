<?php 

	$customer 			= array();
	$transactionDetails = array();
		
	foreach($customer_details as $key => $value)
	{
		$customer['Customer'] 							    = $value['Customer'];

		$transactionDetails['CustomerTransaction'][ $key ]  = $value['CustomerTransaction'];	
		$transactionDetails['TransactionPrincipalPayment'] 	= $value['TransactionPrincipalPayment'];
		$transactionDetails['TransactionInterestPayment']	= $value['TransactionInterestPayment'];
		$transactionDetails['TransactionUnderAuction']		= $value['TransactionUnderAuction'];
		$transactionDetails['TransactionSoldItem']			= $value['TransactionSoldItem'];
		$transactionDetails['TransactionRedeemItem']		= $value['TransactionRedeemItem'];
		
		if($value['CustomerTransaction']['status'] == 'pawned')
		{
			$transactionStatus = 'w3-red';
			
		} elseif( $value['CustomerTransaction']['status'] == 'ua')
		{
			$transactionStatus = 'w3-green';
			
		} elseif( $value['CustomerTransaction']['status'] == 'redeemed')
		{
			$transactionStatus = 'w3-blue';
			
		} elseif( $value['CustomerTransaction']['status'] == 'auctioned')
		{
			$transactionStatus = 'w3-amber';
			
		} else {
			
			$transactionStatus = 'w3-gray';
		}
		
	}

	// $this->log($customer_details, 'now');
?>

<style>
	#myTab li a {background-color:#ccccb3; border-top-left-radius:2px; border-top-right-radius:2px; }
	#myTab li.active a {border-bottom-color: transparent;background-color:white; }

	a.disabled {
		  /* Make the disabled links grayish*/
		  color: gray;
		 
		  /* And disable the pointer events */
		  pointer-events: none;
		  border:1px solid black;
		  opacity:0.3;
	}
	table tr td.text-bold { font-weight:bold; }
</style>

<?php echo $this->element('header_background_color'); ?>

<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-text-black">Customer</h3>
	
		<ul class="nav nav-tabs w3-hide-small" id="myTab">
			<li>
				<a href="/customers/view/<?php echo $customer['Customer']['id']; ?>" class="w3-button">All Transaction</a>
			</li>
			<li>
				<a href="#menu1" data-toggle="tab">Information</a>
			</li>
			
			<li class="active">
				<a href="#menu2" data-toggle="tab">Ongoing Transaction</a>
			</li>
			
			<li>
				<a href="/print/print/print_customer_transactions/<?php echo $value['CustomerTransaction']['id']; ?>" target="_blank" class="w3-button"><i class="fa fa-print"></i> All Transaction</a>
			</li>
		</ul>
		
		<div class="col-lg-12 w3-show-small w3-hide-large w3-hide-medium">
			<div class="w3-section ">
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="/customers/view/<?php echo $customer['Customer']['id']; ?>"><i class="fa fa-user"></i> Customer</a>
			</div>                                                           
			<div class="w3-section">                                         
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu1" data-toggle="tab"><i class="fa fa-info"></i> Information</a>
			</div>                                                           
			<div class="w3-section">                                         
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu2" data-toggle="tab">Ongoing Transaction</a>
			</div>                                                           
			<div class="w3-section">                                          
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="/print/print/print_customer_transactions/<?php echo $value['CustomerTransaction']['id']; ?>" target="_blank"><i class="fa fa-print"></i> Print Transaction</a>
			</div> 
		</div>
		
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane fade" id="menu1">
				<br />
				<div class="panel panel-default">
					<div class="panel-heading w3-teal">
						<h4>Details
							<span class="pull-right">
								Customer ID: <?php echo $customer['Customer']['id']; ?>
							</span>
						</h4>
					</div>
					<div class="panel-body">
						<div class="table table-responsive">
							<table class="table table-bordered">
								<tr>
									<td style="width:30%;" class="text-bold">Image</td>
									<td style="width:35%;" class="text-bold">Firstname</td>
									<td style="width:35%;">
										<?php echo $customer['Customer']['first_name']; ?>
									</td>
								</tr>
								<tr>
									<td rowspan="10">
										<?php if(trim($customer['Customer']['image_name']) != '') { ?>
							
											<img src="<?php echo $customer['Customer']['image_location']; ?>" alt="Avatar" class="w3-block" style="100%;">
										 
										 <?php } ?>
										 
										 <?php if(trim($customer['Customer']['image_name']) == '' && $customer['Customer']['gender'] == 'male') { ?>
											
											<img src="/img/image_male.png" alt="Avatar" class="w3-block" style="100%;">
										 
										 <?php } ?>
										 
										 <?php if(trim($customer['Customer']['image_name']) == '' && $customer['Customer']['gender'] == 'female') { ?>
											
											<img src="/img/image_female.png" alt="Avatar" class="w3-block" style="100%;">
										 
										 <?php } ?>
									</td>
									<td class="text-bold">Middlename</td>
									<td>
										<?php echo $customer['Customer']['middle_name']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Lastname</td>
									<td>
										<?php echo $customer['Customer']['last_name']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Gender</td>
									<td>
										<?php echo $customer['Customer']['gender']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Birthdate</td>
									<td>
										<?php echo $customer['Customer']['birthdate']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Age</td>
									<td>
										<?php echo $customer['Customer']['age']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Status</td>
									<td>
										<?php echo $customer['Customer']['marital_status']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Contact Number</td>
									<td>
										<?php echo $customer['Customer']['number']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Email</td>
									<td>
										<?php echo $customer['Customer']['email']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Occupation</td>
									<td>
										<?php echo $customer['Customer']['occupation']; ?>
									</td>
								</tr>
								<tr>
									<td class="text-bold">Address</td>
									<td>
										<?php echo $customer['Customer']['address']; ?>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="panel-footer">
						<a href="/customers/view/<?php echo $customer['Customer']['id']; ?>" class="w3-button w3-dark-gray w3-round-small">View All Transaction</a>
					</div>
				</div>
				<br />
			
			</div>
			<!--/#menu1-->
			
			<div class="tab-pane fade in active" id="menu2">
				
				<br />
				<?php foreach($transactionDetails['CustomerTransaction'] as $keyIndex => $keyValue) { ?>
				
				<?php 
							
					if($keyValue['status'] == 'rfa')
					{
						$button_for_interest_payment = 'disabled';
						$button_for_reactivate = '';
						$button_for_ready_for_action = '';
						
					} elseif($keyValue['status'] == 'ua')
					{
						$button_for_interest_payment = 'disabled';
						$button_for_reactivate = '';
						$button_for_ready_for_action = 'disabled';
						
					} elseif($keyValue['status'] == 'redeemed')
					{
						$button_for_interest_payment = 'disabled';
						$button_for_reactivate = 'disabled';
						$button_for_ready_for_action = 'disabled';
						$button_for_redeem = 'disabled';
						
					} elseif($keyValue['status'] == 'auctioned')
					{
						$button_for_interest_payment = 'disabled';
						$button_for_reactivate = 'disabled';
						$button_for_ready_for_action = 'disabled';
						$button_for_redeem = 'disabled';
						
					} else {
						
						$button_for_interest_payment = '';
						$button_for_reactivate = 'disabled';
						// $button_for_ready_for_action = 'disabled';
					}

				?>
							
				<div class="row">
					<div class="col-lg-12">
						<div class="w3-row w3-border w3-margin-bottom" style="padding-bottom:5px;">
							<div class="w3-container w3-border-bottom w3-padding-16 <?php echo $transactionStatus; ?>" id="headerBackgroundColor">
								<h4  class="panel-title" style="text-transform:uppercase;">
									STATUS: <?php echo $keyValue['status']; ?>
									<span class="pull-right">
										<?php echo $value['Book']['name']; ?> |
										<?php
											if($keyValue['for_bir'] == 1)
											{
												echo 'Under BIR: Yes';
												
											} else {
												
												echo 'Under BIR: No';
											}
										
										?>
										
									</span>	
								</h4>
							</div>
							<div class="w3-container">
								<div class="table-responsive">
									<div class="table table-responsive">
										<table class="table table-bordered w3-margin-top">
											<tr>
												<td style="width:20%;" rowspan="5">
													
													 <?php if(trim($keyValue['image_name']) != '') { ?>
										  
														<img src="<?php echo $keyValue['image_location']; ?>" style="width:100%;"/>
														
													  <?php } else { ?>
													  
													  No Image
													   
													  <?php } ?>
												</td>
												<td style="width:20%;" class="text-bold">Gross Amount</td>
												<td style="width:20%;" class="w3-light-grey"><?php echo $keyValue['gross_amount']; ?></td>
												<td style="width:20%;" class="text-bold">Jewelry Type</td>
												<td style="width:20%;" class="w3-light-grey"><?php echo $keyValue['jewelry_type']; ?></td>
											</tr>
											<tr>
												<td class="text-bold">Orig. Net Amount</td>
												<td class="w3-light-grey"><?php echo $keyValue['net_amount_duplicate']; ?></td>
												<td class="text-bold">Karat</td>
												<td class="w3-light-grey"><?php echo $keyValue['karat']; ?></td>
											</tr>
											<tr>
												<td class="text-bold">Net Amount</td>
												<td class="w3-light-grey" id="netAmountRemaining"><?php echo $keyValue['net_amount']; ?></td>
												<td class="text-bold">Weight (grams)</td>
												<td class="w3-light-grey"><?php echo $keyValue['weight']; ?></td>
											</tr>
											<tr>
												<td class="text-bold">1st Month Interest</td>
												<td class="w3-light-grey"><?php echo $keyValue['first_month_interest']; ?></td>
												<td class="text-bold">Item Type</td>
												<td class="w3-light-grey"><?php echo $keyValue['item_type']; ?></td>
											</tr>
											<tr>
												<td class="text-bold">Date Pawned</td>
												<td class="w3-light-grey"><?php echo date('M j, Y g:i A', strtotime($keyValue['sangla_date'].' '.$keyValue['sangla_time'])); ?></td>	
												<td class="text-bold">Brand</td>
												<td class="w3-light-grey"><?php echo $keyValue['brand']; ?></td>
											</tr>
											<tr>
												<td>
													TRANSACTION ID: 
													<?php if(count($transactionDetails['TransactionInterestPayment']) == 0) { ?>
														
														<a class="w3-button w3-border w3-border-red" href="/customer_transactions/edit/<?php echo $keyValue['id']; ?>"><span>DELETE</span></a>
													
													<?php } else { ?>
													
														<span class="w3-badge w3-red"><?php echo $keyValue['id']; ?></span>
													
													<?php } ?>
											
												</td>
												<td class="text-bold">ID Presented</td>
												<td class="w3-light-grey"><?php echo $keyValue['id_presented']; ?></td>
												<td class="text-bold">Model</td>
												<td class="w3-light-grey"><?php echo $keyValue['model']; ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.col-lg-8-->
				</div><!-- /.row-->
				
				 <?php if(!empty($transactionDetails['TransactionRedeemItem'])) { ?>
					 <div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<tr>
									<td colspan="7" class="w3-center w3-light-gray">
										<b>REDEEMED DETAILS</b>
									</td>
								</tr>
								<tr>
									<td>Remaining Principal</td>
									<td>Interest</td>
									<td>Payment Interest</td>
									<td>SC</td>
									<td>Grand Total</td>
									<td>Status</td>
									<td>Redeemed Date</td>
								</tr>
								<?php foreach($transactionDetails['TransactionRedeemItem'] as $key_redeemed => $value_redeemed){ ?>
									<tr class="danger">
										<td><?php echo $value_redeemed['remaining_principal']; ?></td>
										<td><?php echo $value_redeemed['payment_interest']; ?></td>
										<td><?php echo $value_redeemed['payment_amount']; ?></td>
										<td><?php echo $value_redeemed['service_charge']; ?></td>
										<td><?php echo $value_redeemed['grand_amount']; ?></td>
										<td><?php echo $value_redeemed['status']; ?></td>
										<td><?php echo date('M j, Y g:i:A', strtotime($value_redeemed['date_redeemed'].' '.$value_redeemed['time_redeemed'])); ?></td>
										
									</tr>
								<?php } ?>
							</table>
						</div>
					 </div><!--.row-->
				 <?php } ?>
				
				 <?php if(!empty($transactionDetails['TransactionSoldItem'])) { ?>
					 <div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<tr>
									<td colspan="7" class="w3-center w3-light-gray">
										<b>SOLD ITEM DETAILS</b>
									</td>
								</tr>
								<tr>
									<td style="width:12%;">Sold Price</td>
									<td style="width:12%;">Discount</td>
									<td style="width:12%;">OR</td>
									<td style="width:10%; font-weight:bold;">PT No.</td>
									<td style="width:16%;">Auction Date</td>
									<td style="width:14%;">User</td>
									<td style="width:24%;">Details</td>
								</tr>
								<?php foreach($transactionDetails['TransactionSoldItem'] as $key_sold => $value_sold){ ?>
									<tr>
										<td><?php echo $value_sold['sold_price']; ?></td>
										<td><?php echo $value_sold['discount']; ?></td>
										<td><?php echo $value_sold['or_number']; ?></td>
										<td style="font-weight:bold; color:red;"><?php echo $value_sold['pt_number']; ?></td>
										<td><?php echo date('M j, Y g:i:A', strtotime($value_sold['date_sold'].' '.$value_sold['time_sold'])); ?></td>
										<td><?php echo $users[ $value_sold['user_id'] ]; ?></td>
										<td><?php echo $value_sold['details']; ?></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					 </div><!--.row-->
				 <?php } ?>
				 
				 <?php if(!empty($transactionDetails['TransactionUnderAuction'])) { ?>
					 <div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<tr>
									<td colspan="4" class="w3-center w3-light-gray">
										<b>UNDER AUCTION DETAILS</b>
									</td>
								</tr>
								<tr>
									<td style="width:25%;">Auction Price</td>
									<td style="width:25%;">Auction Date</td>
									<td style="width:25%;">User</td>
									<td style="width:25%;">Details</td>
								</tr>
								<?php foreach($transactionDetails['TransactionUnderAuction'] as $key_auction => $value_auction){ ?>
									<tr>
										<td><?php echo $value_auction['auction_price']; ?></td>
										<td><?php echo date('M j, Y g:i:A', strtotime($value_auction['date_auction'].' '.$value_auction['time_auction'])); ?></td>
										<td><?php echo $users[ $value_auction['user_id'] ]; ?></td>
										<td><?php echo $value_auction['details']; ?></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					 </div><!--.row-->
				 <?php } ?>
				 
				 
				 <?php if(!empty($transactionDetails['TransactionPrincipalPayment'])) { ?>
					 <div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="w3-block w3-center" data-toggle="collapse" data-parent="#accordion" href="#principalPayment">
									<b>PRINCIPAL PAYMENT DETAILS</b>
								</a>
							</h4>
						</div>
						<div id="principalPayment" class="panel-collapse collapse">
							<div class="panel-body">
								<table class="table table-bordered">
									
									<tr>
										<td style="width:25%; font-weight:bold;">Id</td>
										<td style="width:25%; font-weight:bold;">Payment Date</td>
										<td style="width:25%; font-weight:bold;">Amount</td>
										<td style="width:25%; font-weight:bold;">Details</td>
										<td style="width:20%; font-weight:bold;">Action</td>
									</tr>
									<?php foreach($transactionDetails['TransactionPrincipalPayment'] as $key_princial => $value_principal) { ?>
										
										<?php principalPayment($value_principal, $value_principal['id'], $keyValue['for_bir']); ?>
									
										<?php $totalPaymentPrincipal += $value_principal['amount']; ?>
										<tr>
											<td><span class="w3-badge w3-green"><?php echo $value_principal['id']; ?></span></td>
											<td><?php echo date('M j, Y', strtotime($value_principal['transaction_date'])); ?></td>
											<td><?php echo $value_principal['amount']; ?></td>
											<td><?php echo $value_principal['details']; ?></td>
											<td>
												<?php if($cashbookid_principal_id['CashBook']['id'] == $trasaction_counter_for_delete['CashBook']['id'] && $cashbookid_principal_id['CashBook']['transaction_principal_payment_id'] == $value_principal['id']) { ?>
									
													<button class="w3-button w3-red w3-border w3-round-small" data-toggle="modal" data-target="#myModalPrincipalPayment<?php echo $value_principal['id']; ?>">Delete</button>
												
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
									<tr class="info">
										<td colspan="2"><b>Total Payment</b></td>
										<td colspan="3"><b><?php echo $totalPaymentPrincipal; ?></b></td>
									</tr>
									<tr class="danger">
										<td colspan="2"><b>Remaining Principal</b></td>
										<td colspan="3"><b><?php echo $keyValue['gross_amount'] - $totalPaymentPrincipal; ?></b></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				 <?php } ?>
				 
				<div class="row">
					<div class="col-lg-12">
						<div class="w3-center w3-padding w3-border-top w3-border-left w3-border-right w3-light-gray">
							<b>INTEREST PAYMENT DETAILS</b>
						</div>
						<div class="table-responsive">
							<table class="table w3-striped w3-border" data-count-payment="<?php echo count($transactionDetails['TransactionInterestPayment']); ?>" id="tablePaymentDetails">
								
								<tr>
									<td class="w3-center">PT No.</td>
									<td class="w3-center">Interest(%)</td>
									<td class="w3-center">Due Amount</td>
									<td class="w3-center">Start Date</td>
									<td class="w3-center">Tot inte(%)</td>
									<td class="w3-center">Payment</td>
									<td class="w3-center">Payment Date</td>
									<td class="w3-center">Status</td>
									<td class="w3-center">Action</td>
								</tr>
								<?php 
									 
									if($keyValue['book_id'] == 1) {
										
										$books_number = 1;
										
									} elseif($keyValue['book_id'] == 2) {
										
										$books_number = 2;
										
									} else {
										
										$books_number = 3;
									}
									
									
									$sangla_date 				 = strtotime($keyValue['sangla_date']);
									// $plusOneMOnth 			 = date("Y-m-d", strtotime("+1 month", $sangla_date));
									// date ng sangla don mag start ng bilang ng day
									$plusOneMOnth 				 = date("Y-m-d");
									$book_allowance_day_interest = $keyValue['allowance_day'];
									$interest_payment_id 		 = $transactionDetails['TransactionInterestPayment'][ count($transactionDetails['TransactionInterestPayment']) - 1]['id'];
									
									/*
										Note: for book3
										pag sangla pa lang 1st month interest + 0.40 doc_stamp_interest example 5 + 0.40 = 5.40
										gross_amount =  15000
										net_amount = (5.40 / 100) x 15000
										net_amount = (net_amount + 5 service charge)
										
										1. 
											unang create ng PT number at sa susunod pa
											due_amount = (5.40 / 100) x 15000
										
										2. 
											pag mag babayad ng interest sa PT number
											payment_amount = ((interest + 0.40 / 100) x net_amount_duplicate) + 5 service charge
											
										3.
											pag mag redeem naman
											
											if 
											
											less than or equal(<=) to 1 month the interest
											grand_total = net_duplicate_amount
											
											else
											
											greater > 1 month
											grand_total ((interest + 0.40 / 100) x net_amount_duplicate) + 5 service charge + net_amount_duplicate
											result = (5 / 100) x gross_amount
											grand_total = grand_total - result
											
									*/
									
									if(count($transactionDetails['TransactionInterestPayment']) == 0)
									{
										/*
											step 1. 
											dito papasok pag gagawa ng unang record ng PT number
											
											pag book3, may additional 0.40 doc_stamp_interest sa monthly interest 
										*/
										if($keyValue['book_id'] == 3)
										{
											$books_due_amount 	= round((($keyValue['first_month_interest'] + $keyValue['doc_stamp_interest']) / 100) * $keyValue['net_amount_duplicate']);
											$books_interest 	= $keyValue['first_month_interest'] + $keyValue['doc_stamp_interest'];
											
										} else {
										
											$books_due_amount 	= round(($keyValue['first_month_interest'] / 100) * $keyValue['net_amount_duplicate']);
											$books_interest 	= $keyValue['first_month_interest'] + $keyValue['doc_stamp_interest'];
										
										}
										
										$books_due_date 	= $plusOneMOnth;
										
									} 
									else {
										
										
										/*
											this is for interest payment
										*/
										
										//$interest_payment_due_date   = date($transactionDetails['TransactionInterestPayment'][ count($transactionDetails['TransactionInterestPayment']) - 1]['payment_due_date']); 
										$interest_payment_due_date   = date($transactionDetails['TransactionInterestPayment'][ count($transactionDetails['TransactionInterestPayment']) - 1]['payment_starting_date']); 
										$interest_date_today		 = date('Y-m-d'); 
										$interest_date_start    	 = new DateTime($interest_payment_due_date); 
										$interest_date_end      	 = new DateTime($interest_date_today); 
										$interest_date_difference 	 = $interest_date_start->diff($interest_date_end); 
										
									    $this->year     = (int)$interest_date_difference->format('%y'); 
										$this->month    = (int)$interest_date_difference->format('%m'); 
										$this->day      = (int)$interest_date_difference->format('%d');
										
										if($this->month == 0)
										{
											if($this->day >= 7)
											{
												$this->month = 1;
											}
											
										} elseif($this->month == 1) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 1;
												
											} else {
												
												$this->month = 2;
											}
											
										} elseif($this->month == 2) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 2;
												
											} else {
												
												$this->month = 3;
											}
										} elseif($this->month == 3) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 3;
												
											} else {
												
												$this->month = 4;
											}
										} elseif($this->month == 4) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 4;
												
											} else {
												
												$this->month = 5;
											}
										} elseif($this->month == 5) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 5;
												
											} else {
												
												$this->month = 6;
											}
										} elseif($this->month == 6) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 6;
												
											} else {
												
												$this->month = 7;
											}
										} elseif($this->month == 7) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 7;
												
											} else {
												
												$this->month = 8;
											}
										} elseif($this->month == 8) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 8;
												
											} else {
												
												$this->month = 9;
											}
										} elseif($this->month == 9) {
											
											if($this->day <= $book_allowance_day_interest) {
												
												$this->month = 9;
												
											} else {
												
												$this->month = 9;
											}
										} else {
											
											$this->month = 9;
										}
										
										$year_interest  = $this->year;
										$month_interest = $this->month;
										$day_interest   = $this->day;
										
										if($this->year >= 1)
										{
											$this->month = 9;
										}
										//echo $this->month;
										/*
										kapag itong $this->month > 9, $this->month = 9 kasi 
										yung interest computation ay hanggang 9 months lang
										nag add na lang ako ng other_charge_amount para
										sa extra amount na ipapatong nila para sa penalty
										*/
										
										if($transactionDetails['TransactionInterestPayment'][ count($transactionDetails['TransactionInterestPayment']) - 1]['status'] == 'paid')
										{
											/*
												step 2. 
												Dito papasok pag gagawa na ng pangalawang PT number at susunod pa.
												
											*/
											if($keyValue['book_id'] == 3)
											{
												$books_due_amount 		= round((($keyValue['first_month_interest'] + $keyValue['doc_stamp_interest']) / 100) * $keyValue['net_amount_duplicate']);
												$books_interest 		= $keyValue['first_month_interest'] + $keyValue['doc_stamp_interest'];
												
											} else {
											
												$books_due_amount 		= round(($keyValue['first_month_interest'] / 100) * $keyValue['net_amount_duplicate']);
												$books_interest 		= $keyValue['first_month_interest'];
											}
											
											
											$books_due_date 		= date("Y-m-d", strtotime("+1 month", strtotime($transactionDetails['TransactionInterestPayment'][ count($transactionDetails['TransactionInterestPayment']) - 1]['payment_date'])));
										
										} else {
											
											/*
												step 3. 
												dito papasok pag mag babayad na ng interest kahit sa pinaka unang record ng PT number
												dito rin papasok pag sa redeem
											*/
											
											/*
												Pag sa Redeem ng item, less than or equal to 6 days sa book1, book2  magiging 2percent of interest lng
											*/
											
											if($this->year == 0 && $this->month == 0 && $this->day <= 6 && ($keyValue['book_id'] == 1 || $keyValue['book_id'] == 2) )
											{
												$payment_interest = 2;
												$payment_amount   = round(($payment_interest / 100) * $keyValue['net_amount_duplicate']);
												
											} else {
											
												$payment_interest = $book_month_interest['BookMonthInterest'][$books_number][ $this->month ];
												
												/*
													Pag book3, may additional na 0.40 na doc_stamp_interest sa interest
												*/
												if($keyValue['book_id'] == 3)
												{
													$payment_amount   = round((($book_month_interest['BookMonthInterest'][$books_number][ $this->month ] + $keyValue['doc_stamp_interest']) / 100) * $keyValue['net_amount_duplicate']); 
													
												} else {
												
													$payment_amount   = round(($book_month_interest['BookMonthInterest'][$books_number][ $this->month ] / 100) * $keyValue['net_amount_duplicate']);
													
												}
											
											}
											
											/*
												This is for grand total, for payment interest
											*/
											$grand_charge_amount = $service_charge + $payment_amount;
											
											if($keyValue['book_id'] == 3)
											{
												if($this->month <= 1)
												{
													$redeemgrand_charge_amount = $keyValue['net_amount_duplicate'];
													
												} else {
												
													$first_month_interest_book3 = round((5 / 100) * $keyValue['gross_amount']);
													$redeemgrand_charge_amount = ($service_charge + $payment_amount + $keyValue['net_amount_duplicate']) - $first_month_interest_book3;
												}
												
												$payment_interest = $payment_interest + $keyValue['doc_stamp_interest'];
												
											} else {
												
												$redeemgrand_charge_amount = $service_charge + $payment_amount + $keyValue['net_amount_duplicate'];
												
											}
											
											
										} // else
										
									} // else
									
								?>
								
								<?php foreach($transactionDetails['TransactionInterestPayment'] as $key_interest => $value_interest_details) { ?>
								
								<?php 
									
									if($value_interest_details['status'] == 'paid')
									{
										$paymentDisabled = 'disabled';
										$anchorButtonDisabled = '';
										
									} else {
										$paymentDisabled = '';
										$anchorButtonDisabled = 'disabled';
									}										
									
									
									$customer_id 				= $customer['Customer']['id'];
									$customer_transaction_id 	= $keyValue['id'];
									$for_bir 					= $keyValue['for_bir'];
									$book_id 					= $keyValue['book_id'];
									$pt_number 					= $value_interest_details['pt_number'];
								
									if($value_interest_details['status'] == "unpaid")
									{
										
										$w3Disabled = "w3-disabled";
										$status_unpaid = 'font-weight:bold; color:red';
										
									} else {
										
										$w3Disabled = "";
										$status_unpaid = '';
									}
								?>
								
									<tr>
										<td class="w3-center">
											<span class="w3-badge w3-green" data-toggle="modal" data-target="#myModalDate<?php echo $value_interest_details['pt_number']; ?>" style="cursor:pointer;">
												<?php echo $value_interest_details['pt_number']; ?>
											</span>
										</td>
											<!-- Modal -->
											<div class="modal fade" id="myModalDate<?php echo $value_interest_details['pt_number']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Other details</h4>
														</div>
														<div class="modal-body w3-large">
															Year : <?php echo $value_interest_details['year']; ?>
															<br />
															Month: <?php echo $value_interest_details['month']; ?>
															<br />
															Day: <?php echo $value_interest_details['day']; ?>
															<hr />
															Payment: <?php echo $value_interest_details['payment_amount']; ?>
															<br />
															Service charge: <?php echo $value_interest_details['service_charge']; ?>
															<br />
															+ Amount Payment: <?php echo $value_interest_details['other_charge_amount']; ?>
															<br />
															- Amount Payment: <?php echo $value_interest_details['less_charge_amount']; ?>
															<hr />
															OR: <?php echo $value_interest_details['or_number']; ?>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
											
										<td class="w3-center">
											<?php echo $value_interest_details['payment_due_interest']; ?>
										</td>
										<td class="w3-center">
											<?php echo $value_interest_details['payment_due_amount']; ?>
										</td>
										<td class="w3-center">
											<?php echo $value_interest_details['payment_starting_date']; ?>
										</td>
										<td class="w3-center">
											<?php echo $value_interest_details['payment_interest']; ?>
										</td>
										<td class="w3-center">
											<?php echo $value_interest_details['payment_amount'] + $value_interest_details['other_charge_amount'] + $value_interest_details['service_charge']; ?>
										</td>
										<td class="w3-center">
											<?php echo $value_interest_details['payment_date']; ?>
										</td>
										<td class="w3-center" style="<?php echo $status_unpaid; ?>">
											<?php echo $value_interest_details['status']; ?>
										</td>
										<td class="w3-center">
											
											<button <?php echo $paymentDisabled; ?> <?php echo $button_for_interest_payment; ?> id="btnUpdateDuePayment" class="w3-button w3-green w3-round-small" data-toggle="modal" data-target="#myModalUpdateDuePayment<?php echo $interest_payment_id; ?>" data-date-now="<?php echo date('Y-m-d'); ?>">Payment</button>
														
											<!--a href="/print/print/print_details/<?php echo $value_interest_details['id']; ?>" target="_blank" class="w3-button w3-red w3-round-small"><i class="fa fa-print"></i> Print</a-->
											<a href="/print/print/print_form/<?php echo $value_interest_details['id']; ?>" target="_blank" class="w3-button w3-red w3-round-small"><i class="fa fa-print"></i> Print</a>
												
											<button style="display:none;" <?php echo $paymentDisabled; ?> <?php echo $button_for_interest_payment; ?> class="w3-button w3-teal w3-round-small" data-toggle="modal" data-target="#myModalEmailNotif<?php echo $value_interest_details['id']; ?>">Email</button>
											
											<!-- Modal -->
											<div class="modal fade" id="myModalEmailNotif<?php echo $value_interest_details['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
												<div class="modal-dialog">
													<form method="post" action="/transaction_interest_payments/sendmail" >
													
														<input name="data[CustomerTransaction][id]" value="<?php echo $keyValue['id']; ?>" type="hidden">
													
														<input name="data[Customer][id]" value="<?php echo $customer['Customer']['id']; ?>" type="hidden">
														<input name="data[Customer][first_name]" value="<?php echo $customer['Customer']['first_name']; ?>" type="hidden">
														<input name="data[Customer][middle_name]" value="<?php echo $customer['Customer']['middle_name']; ?>" type="hidden">
														<input name="data[Customer][last_name]" value="<?php echo $customer['Customer']['last_name']; ?>" type="hidden">
														<input name="data[Customer][email]" value="<?php echo $customer['Customer']['email']; ?>" type="hidden">
													
														<div class="modal-content">
															<div class="modal-header w3-teal">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title" id="myModalLabel" style="text-align:left;">SEND EMAIL DETAILS</h4>
															</div>
															<div class="modal-body">
															   <div class="form-horizontal">
																	   <div class="form-group">
																			<label class="control-label col-sm-4">PT Number:</label>
																			<div class="col-sm-5">          
																				<input name="data[TransactionInterestPayment][id]" class="w3-input w3-border w3-light-grey" value="<?php echo  $value_interest_details['id']; ?>" readonly="readonly">
																			</div>
																	   </div>
																	   <div class="form-group">
																			<label class="control-label col-sm-4">Principal Amount:</label>
																			<div class="col-sm-5">          
																				<input name="data[CustomerTransaction][gross_amount]" class="w3-input w3-border w3-light-grey" value="<?php echo $keyValue['gross_amount']; ?>" readonly="readonly">
																			</div>
																	   </div>
																	   <div class="form-group">
																			<label class="control-label col-sm-4">Interest:</label>
																			<div class="col-sm-5">          
																				<input name="data[TransactionInterestPayment][payment_due_interest]" class="w3-input w3-border w3-light-grey" value="<?php echo $value_interest_details['payment_due_interest']; ?>" readonly="readonly">
																			</div>
																	   </div>
																	   <div class="form-group">
																			<label class="control-label col-sm-4">Due Amount:</label>
																			<div class="col-sm-5">          
																				<input name="data[TransactionInterestPayment][payment_due_amount]" class="w3-input w3-border w3-light-grey" value="<?php echo  $value_interest_details['payment_due_amount']; ?>" readonly="readonly">
																			</div>
																	   </div>
																	   <div class="form-group">
																			<label class="control-label col-sm-4">Due Date:</label>
																			<div class="col-sm-5">          
																				<input name="data[TransactionInterestPayment][payment_due_date]" class="w3-input w3-border w3-light-grey" value="<?php echo $value_interest_details['payment_due_date']; ?>" readonly="readonly">
																			</div>
																	   </div>
																</div>					   
															</div>
															<div class="modal-footer">
																<button type="submit" class="w3-button w3-light-grey w3-border w3-round-small pull-left">Submit</button>
																<button type="button" class="w3-button w3-light-grey w3-border w3-round-small" data-dismiss="modal">Close</button>
															</div>
														</div>
													</form>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->	
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div><!--/.row interest payment details-->
				
				<div class="panel-body w3-border w3-round-small w3-light-grey">
				
					<div class="col-lg-2">
	
						<a class="<?php echo $anchorButtonDisabled; ?> <?php echo $button_for_interest_payment; ?> w3-button w3-block w3-dark-gray w3-round-small" data-toggle="modal" data-target="#myModalPayment" id="btnCreatePtNumber">Create PT Number</a>
						
						<div class="modal fade" id="myModalPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header <?php echo $transactionStatus; ?>">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">CREATE PT NUMBER</h4>
									</div>
									<div class="modal-body">
										
									  <?php echo $this->Form->create('TransactionInterestPayment', array("action"=>"add")); ?>	
									  <?php echo $this->Form->hidden('status', array('label'=>false, 'value'=>'unpaid')); ?>
									  <?php echo $this->Form->hidden('customer_transaction_id', array('label'=>false, 'value'=>$keyValue['id'])); ?>
									  <?php echo $this->Form->hidden('book_id', array('label'=>false, 'value'=>$keyValue['book_id'])); ?>
									   
										  <table class="table table-bordered">
												<tr>
													<td style="width:30%;">PT Number</td>
													<td style="width:70%;"><input type="text" name="data[TransactionInterestPayment][pt_number]" id="myPtNumber" class="w3-input w3-border w3-light-grey w3-xlarge"></td>
												</tr>
												<tr>
													<td style="width:30%;">Total Interest</td>
													<td style="width:70%;"><input type="text" name="data[TransactionInterestPayment][payment_due_interest]" value="<?php echo $books_interest ?>" class="w3-input w3-border w3-light-grey" readonly="readonly"></td>
												</tr>
												<tr>
													<td>Due Amount</td>
													<td><input type="text" name="data[TransactionInterestPayment][payment_due_amount]" value="<?php echo $books_due_amount ?>" class="w3-input w3-border w3-light-grey" readonly="readonly"></td>
												</tr>
												<tr>
													<td>Starting Date</td>
													<td><input type="text" name="data[TransactionInterestPayment][payment_starting_date]" value="<?php echo date("Y-m-d") ?>" class="w3-input w3-border w3-light-grey" readonly="readonly"></td>
												</tr>
												<tr>
													<td>Due Date</td>
													<td><input type="text" name="data[TransactionInterestPayment][payment_due_date]" value="<?php echo $books_due_date ?>" class="w3-input w3-border w3-light-grey" readonly="readonly"></td>
												</tr>
										   </table>
									</div>
									<div class="modal-footer">
										<?php echo $this->Form->submit(__('YES',true), array('class'=>'w3-button w3-teal w3-round-small pull-left', 'id'=>'createPtNumberSave', 'style'=>'display:none')); ?>
										<?php echo $this->Form->end(); ?>
										<div class="w3-button w3-dark-gray w3-round-small pull-left" id="createPtNumberConfirmation">YES</div>
										<button type="button" class="w3-button w3-dark-gray w3-round-small" data-dismiss="modal">NO</button>
									</div>
								</div>
							</div>
						</div>	
					</div>
					
					
					<div class="col-lg-2">
					
						<a id="redeemItem" class="<?php echo $button_for_redeem; ?> w3-button w3-block w3-dark-gray w3-round-small" data-toggle="modal" data-target="#myModalTubos" data-date-now="<?php echo date('Y-m-d'); ?>">Redeem</a>
						
						<!-- Modal -->
						<div class="modal fade" id="myModalTubos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
							<div class="modal-dialog">
								<form method="post" action="/transaction_redeem_items/add">
									<div class="modal-content">
									
										 <input type="hidden" name="data[Book][book_id]" value="<?php echo $keyValue['book_id']; ?>">
										 <input type="hidden" name="data[Customer][id]" value="<?php echo $customer['Customer']['id']; ?>">
										 
										 <input name="data[TransactionRedeemItem][customer_transaction_id]" value="<?php echo $customer_transaction_id; ?>" type="hidden">
										 <input name="data[TransactionRedeemItem][status]" value="redeemed" type="hidden">
										 <input name="data[TransactionRedeemItem][enabled]" value="1" type="hidden">
										 <input name="data[TransactionRedeemItem][for_bir]" value="<?php echo $for_bir; ?>" type="hidden">
										
										<div class="modal-header <?php echo $transactionStatus; ?>">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times; &nbsp;&nbsp;</button>
											<h4 class="modal-title" id="myModalLabel">REDEEM</h4>
										</div>
										<div class="modal-body">
										   <table class="table table-bordered">
												<tr>
													<td style="width:30%;">Remaining Principal</td>
													<td style="width:70%;">
														<input name="data[TransactionRedeemItem][remaining_principal]" class="w3-input w3-border w3-light-grey" value="<?php echo $keyValue['net_amount_duplicate']; ?>" id="remainingPrincipal" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Total Interest</td>
													<td>
														<input name="data[TransactionRedeemItem][payment_interest]" class="w3-input w3-border w3-light-grey" value="<?php echo $payment_interest; ?>" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Total Amount</td>
													<td>
														<input name="data[TransactionRedeemItem][payment_amount]" value="<?php echo $payment_amount; ?>" class="w3-input w3-border w3-light-grey" id="redeemPaymetAmount" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Service Charge</td>
													<td>
														<input name="data[TransactionRedeemItem][service_charge]" value="<?php echo $service_charge; ?>" class="w3-input w3-border w3-light-grey" id="redeemServiceCharge" value="" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td class="w3-text-red" style="font-weight:bold;">Add Amount Interest</td>
													<td>
														<input name="data[TransactionRedeemItem][other_charge_amount]"  class="w3-input w3-border w3-light-grey" id="redeemOtherChargeAmount">
													</td>
												</tr>
												<tr>
													<td class="w3-text-red" style="font-weight:bold;">Less Amount Interest</td>
													<td>
														<input name="data[TransactionRedeemItem][less_charge_amount]"  class="w3-input w3-border w3-light-grey" id="redeemLessChargeAmount">
													</td>
												</tr>
												<tr>
													<td><b>Grand Total</b></td>
													<td>
														<input name="data[TransactionRedeemItem][grand_amount]" value="<?php echo $redeemgrand_charge_amount; ?>" class="w3-input w3-border w3-light-grey w3-border-red" id="redeemGrantAmount" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Payment Date</td>
													<td>
														<input name="data[TransactionRedeemItem][date_redeemed]" class="w3-input w3-border w3-light-grey" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Payment Time</td>
													<td>
														<input name="data[TransactionRedeemItem][time_redeemed]" class="w3-input w3-border w3-light-grey" value="<?php echo date('H:i:s'); ?>" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Firstname</td>
													<td>
														<input name="data[TransactionRedeemItem][first_name]" class="w3-input w3-border w3-light-grey">
													</td>
												</tr>
												<tr>
													<td>Middlename</td>
													<td>
														<input name="data[TransactionRedeemItem][middle_name]" class="w3-input w3-border w3-light-grey">
													</td>
												</tr>
												<tr>
													<td>Lastname</td>
													<td>
														<input name="data[TransactionRedeemItem][last_name]" class="w3-input w3-border w3-light-grey">
													</td>
												</tr>
												<tr>
													<td>Relationship</td>
													<td>
														<input name="data[TransactionRedeemItem][relationship]" class="w3-input w3-border w3-light-grey">
													</td>
												</tr>
												<tr>
													<td>OR Number</td>
													<td>
														<input name="data[TransactionRedeemItem][or_number]" id="redeemTextInputOrNumber" class="w3-input w3-border w3-light-grey" autocomplete="off">
													</td>
												</tr>
											</table>
										</div>
										<div class="modal-footer">
											<button type="submit" class="w3-button w3-dark-gray w3-round-small pull-left" id="paymentRedeemConfirmationYes" style="display:none;">YES</button>
											<div class="w3-button w3-dark-gray w3-round-small pull-left" id="paymentRedeemConfirmation">YES</div>
											<button type="button" class="w3-button w3-dark-gray w3-round-small" data-dismiss="modal">NO</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					 <div class="col-lg-2">
						
						<a class="<?php echo $button_for_ready_for_action; ?> w3-button w3-dark-gray w3-block w3-round-small" data-toggle="modal" data-target="#myModalSetNewPrice">Ready For Auction</a>
						
						<div class="modal fade" id="myModalSetNewPrice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
							<div class="modal-dialog">
							
								<form method="post" action="/transaction_under_auctions/add" >
								
									<input type="hidden" name="data[CustomerTransaction][id]" value="<?php echo $keyValue['id']; ?>">
									<input type="hidden" name="data[CustomerTransaction][status]" value="ua">
									
									<input type="hidden" name="data[TransactionUnderAuction][customer_transaction_id]" value="<?php echo $keyValue['id']; ?>">
									<input type="hidden" name="data[TransactionUnderAuction][status]" value="ua" >
									<input type="hidden" name="data[TransactionUnderAuction][enabled]" value="1">
									<input type="hidden" name="data[TransactionUnderAuction][user_id]" value="<?php echo $this->Session->read('Auth.User.id'); ?>">
								
									<div class="modal-content">
										<div class="modal-header <?php echo $transactionStatus; ?>">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">READY FOR AUCTION</h4>
										</div>
										<div class="modal-body">
										   <table class="table table-bordered">
												<tr>
													<td style="width:30%;">Auction Price</td>
													<td style="width:70%;">
														<input name="data[TransactionUnderAuction][auction_price]" id="priceForAuction" class="w3-input w3-border w3-light-grey"  style="font-size:30px;" autocomplete="off" required="required">
													</td>
												</tr>
												<tr>
													<td>Details</td>
													<td>
														<input name="data[TransactionUnderAuction][details]" class="w3-input w3-border w3-light-grey" autocomplete="off">
													</td>
												</tr>
												<tr>
													<td>Date</td>
													<td>
														<input name="data[TransactionUnderAuction][date_auction]" value="<?php echo date('Y-m-d')?>" class="w3-input w3-border w3-light-grey" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Time</td>
													<td>
														<input name="data[TransactionUnderAuction][time_auction]" value="<?php echo date('H:i:s')?>" class="w3-input w3-border w3-light-grey" readonly="readonly">
													</td>
												</tr>
											</table>										   
										</div>
										<div class="modal-footer">
											<button type="submit" class="w3-button w3-dark-grey w3-round-small pull-left" id="readyForAuctionSave" style="display:none;">YES</button>
											<div class="w3-button w3-dark-grey w3-round-small pull-left" id="readyForAuctionConfimation">YES</div>
											<button type="button" class="w3-button w3-dark-grey w3-round-small" data-dismiss="modal">NO</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /.col-lg-2 -->
					 
					 <div class="col-lg-2">
						<a class="<?php echo $button_for_reactivate; ?> w3-button w3-dark-gray w3-block w3-round-small" data-toggle="modal" data-target="#myModalReactivate">Reactivate</a>
						
						<div class="modal fade" id="myModalReactivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
							<div class="modal-dialog">
								<form method="post" action="/customer_transactions/reactivate_back_pawned" >
								
									<input name="data[CustomerTransaction][id]" value="<?php echo $keyValue['id']; ?>" type="hidden">
									
									<div class="modal-content">
										<div class="modal-header <?php echo $transactionStatus; ?>">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">REACTIVATE</h4>
										</div>
										<div class="modal-body">
										   <p>Are you sure, you want to re-activate for payment of renewal?</p>			   
										</div>
										<div class="modal-footer">
											<button type="submit" class="w3-button w3-dark-grey w3-round-small pull-left" id="addReactivateSave" style="display:none;">YES</button>
											<div class="w3-button w3-dark-grey w3-round-small pull-left" id="addReactivate">Yes</div>
											<button type="button" class="w3-button w3-dark-grey w3-round-small" data-dismiss="modal">NO</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					 <div class="col-lg-2">
							
						<a class="<?php echo $button_for_interest_payment; ?> w3-button w3-block w3-dark-gray w3-round-small" data-toggle="modal" data-target="#myModalPrincipal">Less Principal</a>
						
						<div class="modal fade" id="myModalPrincipal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
							<div class="modal-dialog">
							
								<form method="post" action="/transaction_principal_payments/add" >
								
									<input type="hidden" name="data[TransactionPrincipalPayment][customer_transaction_id]" value="<?php echo $keyValue['id']; ?>">
									<input type="hidden" name="data[TransactionPrincipalPayment][user_id]" value="<?php echo $this->Session->read('Auth.User.id'); ?>">
									<input type="hidden" name="data[TransactionPrincipalPayment][for_bir]" value="<?php echo $for_bir; ?>">
									<input type="hidden" name="data[CustomerTransaction][net_amount_duplicate]" value="<?php echo $keyValue['net_amount_duplicate']; ?>">
									<input type="hidden" name="data[Book][book_id]" value="<?php echo $keyValue['book_id']; ?>">
									<input type="hidden" name="data[Customer][id]" value="<?php echo $customer['Customer']['id']; ?>">
									
									
									<div class="modal-content">
										<div class="modal-header <?php echo $transactionStatus; ?>">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">PAYMENT FOR PRINCIPAL</h4>
										</div>
										<div class="modal-body">
											<table class="table table-bordered">
												<tr>
													<td style="width:30%;">Amount</td>
													<td style="width:70%;">
														<input name="data[TransactionPrincipalPayment][amount]" id="textInputPaymentPrincipal" class="w3-input w3-border w3-light-grey" style="font-size:30px;" autocomplete="off">
													</td>
												</tr>
												<tr>
													<td>Details</td>
													<td>
														<textarea name="data[TransactionPrincipalPayment][details]" id="textInputPaymentPrincipalDetails" class="w3-input w3-border w3-light-grey" autocomplete="off" rows="3"></textarea>
													</td>
												</tr>
												<tr>
													<td>Date</td>
													<td>
														<input name="data[TransactionPrincipalPayment][transaction_date]" class="w3-input w3-border w3-light-grey" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>Time</td>
													<td>
														<input name="data[TransactionPrincipalPayment][transaction_time]" class="w3-input w3-border w3-light-grey" value="<?php echo date('H:i:s'); ?>" readonly="readonly">
													</td>
												</tr>
											</table>				
										</div>
										<div class="modal-footer">
											<button type="submit" class="w3-button w3-dark-grey w3-round-small pull-left" id="addPrincipalSave" style="display:none;">YES</button>
											<div class="w3-button w3-dark-grey w3-round-small pull-left" id="addPrincipal">Yes</div>
											<button type="button" class="w3-button w3-dark-grey w3-round-small" data-dismiss="modal">NO</button>
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
				 <!-- /.panel body -->
				
				<h1 style="border-bottom:1px solid #e5e5cc;"/>
				
			<?php } ?>
			</div>
			<!--/#menu2-->
		</div>
		<!--/.tab-content-->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<?php function principalPayment($principalPayment, $principal_payment_id, $for_bir) { ?>
<!-- Modal -->
<div class="modal fade" id="myModalPrincipalPayment<?php echo $principal_payment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" action="/transaction_principal_payments/delete" >
			
			<input name="data[TransactionPrincipalPayment][id]" type="hidden" value="<?php echo $principalPayment['id']; ?>">
			<input name="data[TransactionPrincipalPayment][for_bir]" type="hidden" value="<?php echo $for_bir; ?>">
			<input name="data[CustomerTransaction][id]" type="hidden" value="<?php echo $principalPayment['customer_transaction_id']; ?>">
			
			<div class="modal-content">
				<div class="modal-header w3-red">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">DELETE PRINCIPAL PAYMENT</h4>
				</div>
				<div class="modal-body">
					<div class="form-horizontal">
					   <div class="form-group">
							<label class="control-label col-sm-4">Amount:</label>
							<div class="col-sm-5">          
								<input name="data[TransactionPrincipalPayment][amount]" class="w3-input w3-border w3-light-grey w3-xxlarge" value="<?php echo $principalPayment['amount']; ?>" autocomplete="off" readonly>
							</div>
					   </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="w3-button w3-dark-grey w3-round-small pull-left">YES</button>
					<button type="button" class="w3-button w3-dark-grey w3-round-small" data-dismiss="modal">NO</button>
				</div>
			</div>
		</form>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>


<!-- Modal -->
<div class="modal fade" id="myModalUpdateDuePayment<?php echo $interest_payment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" action="/transaction_interest_payments/edit">
			<div class="modal-content">
				
				<input name="data[Customer][id]" value="<?php echo $customer_id; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][id]" value="<?php echo $interest_payment_id; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][pt_number]" value="<?php echo $pt_number; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][customer_transaction_id]" value="<?php echo $customer_transaction_id; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][status]" value="paid" type="hidden">
				<input name="data[TransactionInterestPayment][enabled]" value="1" type="hidden">
				<input name="data[TransactionInterestPayment][book_id]" value="<?php echo $book_id; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][year]" value="<?php echo $year_interest; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][month]" value="<?php echo $month_interest; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][day]" value="<?php echo $day_interest; ?>" type="hidden">
				<input name="data[TransactionInterestPayment][for_bir]" value="<?php echo $for_bir; ?>" type="hidden">

				<div class="modal-header <?php echo $transactionStatus; ?>">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">PAYMENT INTEREST</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tr>
							<td style="width:40%;">Total Interest</td>
							<td style="width:60%;">
								<input name="data[TransactionInterestPayment][payment_interest]" value="<?php echo $payment_interest; ?>" class="w3-input w3-border w3-light-grey" id="totPaymentInterest" readonly="readonly">
							</td>
						</tr>
						<tr>
							<td>Total Amount</td>
							<td>
								<input name="data[TransactionInterestPayment][payment_amount]" value="<?php echo $payment_amount; ?>" class="w3-input w3-border w3-light-grey" id="totPaymentAmount" readonly="readonly">
							</td>
						</tr>
						<tr>
							<td>Service Charge</td>
							<td>
								<input name="data[TransactionInterestPayment][service_charge]" value="<?php echo $service_charge; ?>" class="w3-input w3-border w3-light-grey"  id="totServiceCharge" readonly="readonly">
							</td>
						</tr>
						<tr>
							<td class="w3-text-red" style="font-weight:bold;">Add Other Amount</td>
							<td>
								<input name="data[TransactionInterestPayment][other_charge_amount]"  class="w3-input w3-border w3-light-grey" id="otherChargeAmount">
							</td>
						</tr>
						<tr>
							<td class="w3-text-red" style="font-weight:bold;">Less Other Amount</td>
							<td>
								<input name="data[TransactionInterestPayment][less_charge_amount]"  class="w3-input w3-border w3-light-grey" id="lessChargeAmount">
							</td>
						</tr>
						<tr>
							<td><b>Grand Total</b></td>
							<td>
								<input name="data[TransactionInterestPayment][grand_interest_amount]" value="<?php echo $grand_charge_amount; ?>" class="w3-input w3-border w3-light-grey w3-border-red" id="grandChargeAmount" readonly="readonly">
							</td>
						</tr>
						<tr>
							<td>Payment Date</td>
							<td>
								<input name="data[TransactionInterestPayment][payment_date]" class="w3-input w3-border w3-light-grey" id="" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
							</td>
						</tr>
						<tr>
							<td>Payment Time</td>
							<td>
								<input name="data[TransactionInterestPayment][payment_time]" class="w3-input w3-border w3-light-grey" id="totPaymentTime" value="<?php echo date('H:i:s'); ?>" readonly="readonly">
							</td>
						</tr>
						<tr>
							<td>Firstname</td>
							<td>
								<input name="data[TransactionInterestPayment][first_name]" class="w3-input w3-border w3-light-grey">
							</td>
						</tr>
						<tr>
							<td>Middlename</td>
							<td>
								<input name="data[TransactionInterestPayment][middle_name]" class="w3-input w3-border w3-light-grey">
							</td>
						</tr>
						<tr>
							<td>Lastname</td>
							<td>
								<input name="data[TransactionInterestPayment][last_name]" class="w3-input w3-border w3-light-grey">
							</td>
						</tr>
						<tr>
							<td>OR Number</td>
							<td>
								<input name="data[TransactionInterestPayment][or_number]" id="textInputOrnumber" class="w3-input w3-border w3-light-grey" autocomplete="off">
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="submit" class="w3-button w3-dark-grey w3-round-small pull-left" id="paymentInterestSave" style="display:none;">Yes</button>
					<div class="w3-button w3-dark-grey w3-round-small pull-left" id="paymentInterestConfirmation">Yes</div>
					<button type="button" class="w3-button w3-dark-grey w3-round-small" data-dismiss="modal">No</button>
				</div>
			</div>
		</form>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script src="/js/jquery.min.js"></script>

<script>
$(document).ready(function(){
	
	$('.datepicker').datepicker({ dateFormat: "yy-mm-dd" });
	
	// reactivate
	$('#addReactivate').click(function() {
		
		Swal.fire({
		  title: 'Are you sure, you want to re-activate?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, save it!'
		}).then((result) => {
		  if (result.value) {
			
			$('#addReactivateSave').trigger('click');
			
		  } else {
		  
			location.reload();
		  
		  }
		})
		
	});	
	// end reactivate
	
	// start confirmation for saving less principal
	$('#addPrincipal').click(function() {
	
		var amount_Principal	= $('#textInputPaymentPrincipal').val();
		var details_Principal	= $('#textInputPaymentPrincipalDetails').val();
		var net_amount_remaining = Number($('td#netAmountRemaining').text());

		if($.trim(amount_Principal) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Amount must not empty!'
			})
			
		} else if(amount_Principal < 1)
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Less than 1 is not valid!'
			})
			
		} else if($.trim(details_Principal) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Details must not empty!'
			})
			
		} else if(amount_Principal >= net_amount_remaining)
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Should less than to your current principal, or redeem this item instead!'
			})
			
		} else {
		
			Swal.fire({
			  title: 'Amount:'+ amount_Principal + '\n Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, save it!'
			}).then((result) => {
			  if (result.value) {
				
				$('#addPrincipalSave').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
		}
	});	
	// end confirmation for saving less principal
	
	// start redeem
	$('div#paymentRedeemConfirmation').click(function() {
		
		$.ajax({
			async: false,
			type: 'POST',
			url: '/customer_transactions/redeem_checkif_orexist',
			data: {
				'data[TransactionRedeemItem][or_number]': $('input#redeemTextInputOrNumber').val()
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				if(data['notempty'] == 1)
				{
					Swal.fire({
					  type: 'error',
					  title: 'OR Number already exist!',
					  text: 'OR Number must unique!'
					});
					
				} else if(data['orempty'] == 1)
				{
					Swal.fire({
					  type: 'error',
					  title: 'OR Number is empty!',
					  text: 'OR Number must unique!'
					});
					
					$('input#redeemTextInputOrNumber').val('');
					
				} else {
					
					Swal.fire({
					  title: 'Are you sure, you want to Redeem?',
					  text: "You won't be able to revert this!",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, create it!'
					}).then((result) => {
					  if (result.value) {
						
						$('#paymentRedeemConfirmationYes').trigger('click');
						
					  } else {
					  
						location.reload();
					  
					  }
					})	
				}
			}
			
		});
		
		
	});	
	// end redeem
	
	
	
	// start confirmation for creating a new pt number
	$('#createPtNumberConfirmation').click(function() {
	
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, create it!'
		}).then((result) => {
		  if (result.value) {
			
			$('#createPtNumberSave').trigger('click');
			
		  } else {
		  
			location.reload();
		  
		  }
		})
		
	});	
	// end confirmation for creating a new pt number
	
	// start confirmation for saving payment interest
	$('div#paymentInterestConfirmation').click(function() {
		
		$.ajax({
			async: false,
			type: 'POST',
			url: '/customer_transactions/checkif_orexist',
			data: {
				'data[TransactionInterestPayment][or_number]': $('input#textInputOrnumber').val()
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				if(data['notempty'] == 1)
				{
					Swal.fire({
					  type: 'error',
					  title: 'OR Number already exist!',
					  text: 'OR Number must unique!'
					});
					
				} else if(data['orempty'] == 1)
				{
					Swal.fire({
					  type: 'error',
					  title: 'OR Number is empty!',
					  text: 'OR Number must unique!'
					});
					
					$('input#textInputOrnumber').val('');
					
				} else {
					
					Swal.fire({
					  title: 'Are you sure?',
					  text: "You won't be able to revert this!",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, save it!'
					}).then((result) => {
					  if (result.value) {
						
						$('#paymentInterestSave').trigger('click');
						
					  } else {
					  
						location.reload();
					  
					  }
					})	
				}
			}
			
		});
		
	});	
	
	// end confirmation for saving payment interest
	
	
	// start confirmation for set for auction
	$('#readyForAuctionConfimation').click(function() {
	
		var price_for_auction = $('#priceForAuction').val();
		
		if($.trim(price_for_auction) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Price for auction must not empty!'
			})
			
		} else if(price_for_auction < 1)
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Less than 1 is not valid!'
			})
			
		}else {
		
			Swal.fire({
			  title: 'Price for Auction:'+ price_for_auction + '',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, save it!'
			}).then((result) => {
			  if (result.value) {
				
				$('#readyForAuctionSave').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
		}
	});
	// end confirmation for set for auction
	
	// only numbers allowed
	$('input#priceForAuction, input#textInputPaymentPrincipal').on('keyup blur', function(event) {
		this.value = this.value.replace(/[^0-9]/g,''); 
	});
	
	// for numbers only.
	$('input#otherChargeAmount, input#redeemOtherChargeAmount, input#lessChargeAmount, input#redeemLessChargeAmount').on('keyup blur', function(event) {
		this.value = this.value.replace(/[^0-9]/g,''); 
	});
	
	$('input#otherChargeAmount').on('keyup', function(event) {
	
		var tot_payment_interest  = Number( $('input#totPaymentAmount').val() );
		var tot_service_charge    = Number( $('input#totServiceCharge').val() );
		var tot_less_other_amount = Number( $('input#lessChargeAmount').val() );
		var totalGrandIns 		  = ( Number($(this).val() ) + tot_service_charge + tot_payment_interest) - tot_less_other_amount;
		//alert(otherInts);
		$('input#grandChargeAmount').val(totalGrandIns);
	});
	
	$('input#lessChargeAmount').on('keyup', function(event) {
	
		var tot_payment_interest  = Number( $('input#totPaymentAmount').val() );
		var tot_service_charge    = Number( $('input#totServiceCharge').val() );
		var tot_other_charge      = Number( $('input#otherChargeAmount').val() );
		var totalGrandIns 		  = ( tot_payment_interest + tot_service_charge  + tot_other_charge ) - Number($(this).val());
		//alert(otherInts);
		$('input#grandChargeAmount').val(totalGrandIns);
	});
	
	$('input#redeemOtherChargeAmount').on('keyup', function(event) {
	
		var red_remaining_principal = Number( $('input#remainingPrincipal').val() );
		var red_payment_interest  	= Number( $('input#redeemPaymetAmount').val() );
		var red_service_charge    	= Number( $('input#redeemServiceCharge').val() );
		var red_less_other_amount   = Number( $('input#redeemLessChargeAmount').val() );
		var redtotalGrandIns 		= ( red_remaining_principal + red_payment_interest + red_service_charge + Number($(this).val()) ) - red_less_other_amount;
		//alert(otherInts);
		$('input#redeemGrantAmount').val(redtotalGrandIns);
		
	});
	
	$('input#redeemLessChargeAmount').on('keyup', function(event) {
	
		var red_remaining_principal = Number( $('input#remainingPrincipal').val() );
		var red_payment_interest  	= Number( $('input#redeemPaymetAmount').val() );
		var red_service_charge    	= Number( $('input#redeemServiceCharge').val() );
		var red_add_other_amount    = Number( $('input#redeemOtherChargeAmount').val() );
		var redtotalGrandIns 		= (red_remaining_principal + red_payment_interest + red_service_charge + red_add_other_amount) - Number($(this).val() );
		//alert(otherInts);
		$('input#redeemGrantAmount').val(redtotalGrandIns);
		
	});
});
</script>