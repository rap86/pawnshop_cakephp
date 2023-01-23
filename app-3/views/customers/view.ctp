<?php 

	$customer 			 = array();	
	$purchasedCount 	 = count($customer_purchased[0]['TransactionSoldItem']);
	$pawnedCount 		 = 0;
	$redeemedCount 		 = 0;
	$auctionedCount 	 = 0;
	$underAuctionCount   = 0;
	$underAuctionTakeout = 0;
	
	foreach($customer_details as $key => $value)
	{
		$customer['Customer'] = $value['Customer'];
		$summaryCount = count($value['CustomerTransaction']);
		
		foreach($value['CustomerTransaction'] as $keyInner => $valueInner)
		{	
			
			if(strtolower($valueInner['status']) == "pawned") {
				 
				$pawnedCount++;
				$pawned['CustomerTransaction'][ $keyInner ] = $value['CustomerTransaction'][ $keyInner ];
				
			} 
			if(strtolower($valueInner['status']) == "redeemed") {
				
				$redeemedCount++;
				$redeemed['CustomerTransaction'][ $keyInner ] = $value['CustomerTransaction'][ $keyInner ];
				
			}  
			if(strtolower($valueInner['status']) == "auctioned") {
				
				$auctionedCount++;
				$auctioned['CustomerTransaction'][ $keyInner ] = $value['CustomerTransaction'][ $keyInner ];
				
			}
			
			if(strtolower($valueInner['status']) == "ua") {
				
				$underAuctionCount++;
				$under_auction['CustomerTransaction'][ $keyInner ] = $value['CustomerTransaction'][ $keyInner ];
				
			}
			
			if(strtolower($valueInner['status']) == "takeout") {
				
				$underAuctionTakeout++;
				$under_auction_takeout['CustomerTransaction'][ $keyInner ] = $value['CustomerTransaction'][ $keyInner ];
				
			}
		}	
		
		
	}
	
	//$this->log($value['CustomerTransaction'], 'sangla_count');
	 /*
	 echo '<pre>';
	 print_r($auctioned);
	 echo '</pre>';
	 */
	
?>

<style>
#myTab li a {background-color:#ccccb3; border-top-left-radius:2px; border-top-right-radius:2px; }
#myTab li.active a {border-bottom-color: transparent;background-color:white; }
</style>

<?php echo $this->element('header_background_color'); ?>

<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-text-black">Customer</h3>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs w3-hide-small" id="myTab">
			<li class="active">
				<a href="#menu1" data-toggle="tab">Information</a>
			</li>
			<li>
				<a href="#menu2" data-toggle="tab">Pawned <span class="w3-badge w3-red"><?php echo $pawnedCount; ?></span></a>
			</li>
			<li>
				<a href="#menu3" data-toggle="tab">Redeemed <span class="w3-badge w3-red"><?php echo $redeemedCount; ?></span></a>
			</li>
			<li>
				<a href="#menu4" data-toggle="tab">Under Auction <span class="w3-badge w3-red"><?php echo $underAuctionCount; ?></span></a>
			</li>
			<li>
				<a href="#menu44" data-toggle="tab">UA Takeout <span class="w3-badge w3-red"><?php echo $underAuctionTakeout; ?></span></a>
			</li>
			<li>
				<a href="#menu5" data-toggle="tab">Auctioned <span class="w3-badge w3-red"><?php echo $auctionedCount; ?></span></a>
			</li>
			<li>
				<a href="#menu6" data-toggle="tab">Summary <span class="w3-badge w3-red"><?php echo $summaryCount; ?></span></a>
			</li>
			<li>
				<a href="#menu7" data-toggle="tab">Purchased item <span class="w3-badge w3-red"><?php echo $purchasedCount; ?></span></a>
			</li>
		</ul>
		
		<div class="col-lg-12 w3-show-small w3-hide-large w3-hide-medium">
			<div class="w3-section ">
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu1" data-toggle="tab">Information</a>
			</div>                                                           
			<div class="w3-section">                                         
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu2" data-toggle="tab">Pawned <span class="w3-badge w3-red"><?php echo $pawnedCount; ?></a>
			</div>                                                           
			<div class="w3-section">                                         
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu3" data-toggle="tab">Redeemed <span class="w3-badge w3-red"><?php echo $redeemedCount; ?></a>
			</div>                                                           
			<div class="w3-section">                                          
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu4" data-toggle="tab">Under Auction <span class="w3-badge w3-red"><?php echo $underAuctionCount; ?></a>
			</div> 
			<div class="w3-section">                                          
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu4" data-toggle="tab">Under Auction Takeout<span class="w3-badge w3-red"><?php echo $underAuctionTakeout; ?></a>
			</div> 
			<div class="w3-section">                                          
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu5" data-toggle="tab">Auction <span class="w3-badge w3-red"><?php echo $auctionedCount; ?></a>
			</div> 			
			<div class="w3-section">                                         
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu6" data-toggle="tab">Summary <span class="w3-badge w3-red"><?php echo $summaryCount; ?></a>
			</div>
			<div class="w3-section">                                         
				<a class="w3-border w3-padding w3-block w3-hover-dark-grey w3-round-small w3-button" href="#menu7" data-toggle="tab">Purchased item <span class="w3-badge w3-red"><?php echo $purchasedCount; ?></a>
			</div>
		</div>
		
		<!-- Tab panes -->
		<div class="tab-content my-tab">
		
			<div class="tab-pane fade in active" id="menu1">
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
						<table class="table table-bordered">
							
							<tr>
								<td style="width:30%;">Image</td>
								<td style="width:35%;">Firstname</td>
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
								<td>Middlename</td>
								<td>
									<?php echo $customer['Customer']['middle_name']; ?>
								</td>
							</tr>
							<tr>
								<td>Lastname</td>
								<td>
									<?php echo $customer['Customer']['last_name']; ?>
								</td>
							</tr>
							<tr>
								<td>Gender</td>
								<td>
									<?php echo $customer['Customer']['gender']; ?>
								</td>
							</tr>
							<tr>
								<td>Birthdate</td>
								<td>
									<?php echo $customer['Customer']['birthdate']; ?>
								</td>
							</tr>
							<tr>
								<td>Age</td>
								<td>
									<?php echo $customer['Customer']['age']; ?>
								</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>
									<?php echo $customer['Customer']['marital_status']; ?>
								</td>
							</tr>
							<tr>
								<td>Contact Number</td>
								<td>
									<?php echo $customer['Customer']['number']; ?>
								</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>
									<?php echo $customer['Customer']['email']; ?>
								</td>
							</tr>
							<tr>
								<td>Occupation</td>
								<td>
									<?php echo $customer['Customer']['occupation']; ?>
								</td>
							</tr>
							<tr>
								<td>Address</td>
								<td>
									<?php echo $customer['Customer']['address']; ?>
								</td>
							</tr>
						</table>
					</div>
					<div class="panel-footer">
						<a href="/customer_transactions/add/<?php echo $customer['Customer']['id']; ?>" class="w3-button w3-dark-gray w3-round-small" style="text-decoration: none;">Pawn Item</a>
						<a href="/customer_transactions/buyin/<?php echo $customer['Customer']['id']; ?>" class="w3-button w3-dark-gray w3-round-small" style="text-decoration: none;">Buy Item Under Auction</a>
						<a href="/customer_transactions/buyout/<?php echo $customer['Customer']['id']; ?>" class="w3-button w3-dark-gray w3-round-small" style="text-decoration: none;">Buy Item Under Auction Takeout</a>
						<a href="/customers/edit/<?php echo $customer['Customer']['id']; ?>" class="w3-button w3-dark-gray w3-round-small" style="text-decoration: none;">Edit Customer Info</a>
					</div>
				</div>
				<br />
				
			</div><!--menu 1 customer information-->
			
			<div class="tab-pane fade" id="menu2">
				
				<?php foreach($pawned['CustomerTransaction'] as $keyPawned => $valuePawned) { ?>
					
					<div class="w3-margin-top w3-margin-bottom">
						<div class="panel-heading w3-red" id="headerBackgroundColor">
							<h4>
								<?php echo $valuePawned['Book']['name']; ?>
								<span class="pull-right">
									<?php 
										echo 'Date Pawned: '.date('M j, Y g:i A',strtotime($valuePawned['sangla_date'].' '.$valuePawned['sangla_time']));
									?>
								</span>
							</h4>
						</div>
						<div class="panel-body w3-border">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<td style="width:20%;">Item</td>
										<td style="width:20%;">Gross Amount</td>
										<td style="width:20%;" class="w3-light-grey"><?php echo $valuePawned['gross_amount']; ?></td>
										<td style="width:20%;">Jewelry Type</td>
										<td style="width:20%;" class="w3-light-grey"><?php echo $valuePawned['jewelry_type']; ?></td>
									</tr>
									<tr>
										<td rowspan="5" class="w3-light-grey">
											<img src="<?php echo $valuePawned['image_location']; ?>" class="img-thumbnail" />
										</td>
										<td>Orig. Net Amount</td>
										<td class="w3-light-grey"><?php echo $valuePawned['net_amount_duplicate']; ?></td>
										<td>Karat</td>
										<td class="w3-light-grey"><?php echo $valuePawned['karat']; ?></td>
									</tr>
									<tr>
										<td>Net Amount</td>
										<td class="w3-light-grey"><?php echo $valuePawned['net_amount']; ?></td>
										<td>Weight (grams)</td>
										<td class="w3-light-grey"><?php echo $valuePawned['weight']; ?></td>
									</tr>
									<tr>
										<td>1st Month Interest</td>
										<td class="w3-light-grey"><?php echo $valuePawned['first_month_interest']; ?></td>
										<td>Item Type</td>
										<td class="w3-light-grey"><?php echo $valuePawned['item_type']; ?></td>
									</tr>
									<tr>
										<td>Transaction Date</td>
										<td class="w3-light-grey"><?php echo date('M j, Y g:i a', strtotime($valuePawned['sangla_date'].' '.$valuePawned['sangla_time'])); ?></td>	
										<td>Brand</td>
										<td class="w3-light-grey"><?php echo $value['brand']; ?></td>
									</tr>
									<tr>
										<td>ID Presented</td>
										<td class="w3-light-grey"><?php echo $valuePawned['id_presented']; ?></td>
										<td>Model</td>
										<td class="w3-light-grey"><?php echo $valuePawned['model']; ?></td>
									</tr>
								</table>
							</div>
							<!--/.table-responsive-->
							
							<?php if(!empty($valuePawned['TransactionPrincipalPayment'])) { ?>
									<div class="table-responsive">
										<table class="table table-bordered">
											<tr>
												<td colspan="4" class="w3-center w3-light-gray">Principal Payment Details</td>
											</tr>
											<tr>
												<td style="width:25%; font-weight:bold;">Payment Date</td>
												<td style="width:15%; font-weight:bold;">Amount</td>
												<td style="width:35%; font-weight:bold;">Details</td>
												<td style="width:25%; font-weight:bold;">User</td>
											</tr>
											<?php 
											$totalPaymentPawn = 0;
											foreach($valuePawned['TransactionPrincipalPayment'] as $principal_key => $principal_value) { ?>
												
												<?php $totalPaymentPawn += $principal_value['amount']; ?>
												
												<tr>
													<td><?php echo date('M j, Y', strtotime($principal_value['transaction_date'])); ?></td>
													<td><?php echo $principal_value['amount']; ?></td>
													<td><?php echo $principal_value['details']; ?></td>
													<td><?php echo $users[ $principal_value['user_id'] ]; ?></td>
												</tr>
											<?php } ?>
											
											<tr class="info">
												<td><b>Total Payment</b></td>
												<td><b><?php echo $totalPaymentPawn; ?></b></td>
												<td></td>
												<td></td>
											</tr>
											<tr class="danger">
												<td><b>Remaining Principal</b></td>
												<td><b><?php echo $valuePawned['net_amount_duplicate'] - $totalPaymentPawn; ?></b></td>
												<td></td>
												<td></td>
											</tr>
										</table>
									</div>
							 <?php } ?>
				 
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<td colspan="8" class="w3-center w3-light-gray">Interest Payment Details</td>
									</tr>
									<tr>
										<td class="w3-center" style="font-weight:bold;">PT No.</td>
										<td class="w3-center" style="font-weight:bold;">Interest(%)</td>
										<td class="w3-center" style="font-weight:bold;">Due Amount</td>
										<td class="w3-center" style="font-weight:bold;">Start Date</td>
										<td class="w3-center" style="font-weight:bold;">Total Interest(%)</td>
										<td class="w3-center" style="font-weight:bold;">Payment</td>
										<td class="w3-center" style="font-weight:bold;">Payment Date</td>
										<td class="w3-center" style="font-weight:bold;">Status</td>
									</tr>
										<?php foreach($valuePawned['TransactionInterestPayment'] as $key_interest_pawn => $value_interest_pawn) { ?>
									
												<tr>
													<td class="w3-center"><span class="w3-badge w3-green"><?php echo $value_interest_pawn['pt_number']; ?></span></td>
													<td class="w3-center"><?php echo $value_interest_pawn['payment_due_interest']; ?></td>
													<td class="w3-center"><?php echo $value_interest_pawn['payment_due_amount']; ?></td>
													<td class="w3-center"><?php echo $value_interest_pawn['payment_starting_date']; ?></td>
													<td class="w3-center"><?php echo $value_interest_pawn['payment_interest']; ?></td>
													<td class="w3-center"><?php echo $value_interest_pawn['payment_amount']; ?></td>
													<td class="w3-center"><?php echo $value_interest_pawn['payment_date']; ?></td>
													<td class="w3-center"><?php echo $value_interest_pawn['status']; ?></td>
												</tr>
											
										<?php } ?>
								</table>									
							</div>
							
						</div><!--/.panel-body-->
						
						<div class="w3-container w3-padding w3-border-bottom w3-border-left w3-border-right w3-light-gray">
							<a href="/customer_transactions/transaction/<?php echo $valuePawned['id']; ?>" class="w3-button w3-gray w3-round-small pull-left w3-margin-left"><i class="fa fa-eye"></i> View Details</a>
						</div>
						
					</div><!--/.panel-default-->
					
				<?php }?>
				
			</div><!--menu 2 pawned-->
			
			<div class="tab-pane fade" id="menu3">
				
				 <?php foreach($redeemed['CustomerTransaction'] as $redeem_key => $redeem_value) { ?>
					
					<div class="panel panel-default w3-margin-top">
						<div class="panel-heading w3-large">
							<a class="w3-padding w3-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $redeem_key; ?>">
								<?php echo $redeem_value['Book']['name']; ?>
								<span class="pull-right">
									Date Redeemed: 
									<?php 
										echo $redeem_value['TransactionRedeemItem'][ count( $redeem_value['TransactionRedeemItem'] ) - 1 ]['date_redeemed'].' ';
										echo $redeem_value['TransactionRedeemItem'][ count( $redeem_value['TransactionRedeemItem'] ) - 1 ]['time_redeemed'];
									?>
								</span>
							</a>
						</div>
						<div id="collapseOne<?php echo $redeem_key; ?>" class="panel-collapse collapse">
							<div class="panel-body">
								
								<div class="w3-margin-top w3-margin-bottom">
									<div class="panel-heading w3-blue" id="headerBackgroundColor">
										<h4>
											<?php echo $redeem_value['Book']['name']; ?>
											<span class="pull-right">
												<?php 
													echo 'Date Pawned: '.date('M j, Y g:i A',strtotime($redeem_value['sangla_date'].' '.$redeem_value['sangla_time']));
												?>
											</span>
										</h4>
									</div>
									<div class="panel-body w3-border">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td style="width:20%;">Item</td>
													<td style="width:20%;">Gross Amount</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $redeem_value['gross_amount']; ?></td>
													<td style="width:20%;">Jewelry Type</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $redeem_value['jewelry_type']; ?></td>
												</tr>
												<tr>
													<td rowspan="5" class="w3-light-grey">
														<img src="<?php echo $redeem_value['image_location']; ?>" class="img-thumbnail" />
													</td>
													<td>Orig. Net Amount</td>
													<td class="w3-light-grey"><?php echo $redeem_value['net_amount_duplicate']; ?></td>
													<td>Karat</td>
													<td class="w3-light-grey"><?php echo $redeem_value['karat']; ?></td>
												</tr>
												<tr>
													<td>Net Amount</td>
													<td class="w3-light-grey"><?php echo $redeem_value['net_amount']; ?></td>
													<td>Weight (grams)</td>
													<td class="w3-light-grey"><?php echo $redeem_value['weight']; ?></td>
												</tr>
												<tr>
													<td>1st Month Interest</td>
													<td class="w3-light-grey"><?php echo $redeem_value['first_month_interest']; ?></td>
													<td>Item Type</td>
													<td class="w3-light-grey"><?php echo $redeem_value['item_type']; ?></td>
												</tr>
												<tr>
													<td>Transaction Date</td>
													<td class="w3-light-grey"><?php echo date('M j, Y g:i a', strtotime($redeem_value['sangla_date'].' '.$redeem_value['sangla_time'])); ?></td>	
													<td>Brand</td>
													<td class="w3-light-grey"><?php echo $redeem_value['brand']; ?></td>
												</tr>
												<tr>
													<td>ID Presented</td>
													<td class="w3-light-grey"><?php echo $redeem_value['id_presented']; ?></td>
													<td>Model</td>
													<td class="w3-light-grey"><?php echo $redeem_value['model']; ?></td>
												</tr>
											</table>
										</div>
										<!--/.table-responsive-->
										
										<?php if(!empty($redeem_value['TransactionPrincipalPayment'])) { ?>
												<div class="table-responsive">
													<table class="table table-bordered">
														<tr>
															<td colspan="4" class="w3-center w3-light-gray">Principal Payment Details</td>
														</tr>
														<tr>
															<td style="width:25%; font-weight:bold;">Payment Date</td>
															<td style="width:15%; font-weight:bold;">Amount</td>
															<td style="width:35%; font-weight:bold;">Details</td>
															<td style="width:25%; font-weight:bold;">User</td>
														</tr>
														<?php 
														$totalPaymentRedeem = 0;
														foreach($redeem_value['TransactionPrincipalPayment'] as $principal_key_redeem => $principal_value_redeem) { ?>
															
															<?php $totalPaymentRedeem += $principal_value_redeem['amount']; ?>
															
															<tr>
																<td><?php echo date('M j, Y', strtotime($principal_value_redeem['transaction_date'])); ?></td>
																<td><?php echo $principal_value_redeem['amount']; ?></td>
																<td><?php echo $principal_value_redeem['details']; ?></td>
																<td><?php echo $users[ $principal_value_redeem['user_id'] ]; ?></td>
															</tr>
														<?php } ?>
														
														<tr class="info">
															<td><b>Total Payment</b></td>
															<td><b><?php echo $totalPaymentRedeem; ?></b></td>
															<td></td>
															<td></td>
														</tr>
														<tr class="danger">
															<td><b>Remaining Principal</b></td>
															<td><b><?php echo $redeem_value['net_amount_duplicate'] - $totalPaymentRedeem; ?></b></td>
															<td></td>
															<td></td>
														</tr>
													</table>
												</div>
										 <?php } ?>
							 
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="8" class="w3-center w3-light-gray">Interest Payment Details</td>
												</tr>
												<tr>
													<td class="w3-center" style="font-weight:bold;">PT No.</td>
													<td class="w3-center" style="font-weight:bold;">Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Due Amount</td>
													<td class="w3-center" style="font-weight:bold;">Start Date</td>
													<td class="w3-center" style="font-weight:bold;">Total Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Payment</td>
													<td class="w3-center" style="font-weight:bold;">Payment Date</td>
													<td class="w3-center" style="font-weight:bold;">Status</td>
												</tr>
													<?php foreach($redeem_value['TransactionInterestPayment'] as $interest_key_redeem => $interest_value_redeem) { ?>
												
															<tr>
																<td class="w3-center"><span class="w3-badge w3-green"><?php echo $interest_value_redeem['pt_number']; ?></span></td>
																<td class="w3-center"><?php echo $interest_value_redeem['payment_due_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_redeem['payment_due_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_redeem['payment_starting_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_redeem['payment_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_redeem['payment_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_redeem['payment_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_redeem['status']; ?></td>
															</tr>
														
													<?php } ?>
											</table>									
										</div>
										
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="7" class="w3-center w3-light-gray">Redeemed Payment Details</td>
												</tr>
												<tr>
													<td style="font-weight:bold;">ID</td>
													<td style="font-weight:bold;">Remaining Principal</td>
													<td style="font-weight:bold;">Interest</td>
													<td style="font-weight:bold;">Interest Payment</td>
													<td style="font-weight:bold;">SC</td>
													<td style="font-weight:bold;">Grand Total</td>
													<td style="font-weight:bold;">Date Redeemed</td>
												</tr>
													<?php foreach($redeem_value['TransactionRedeemItem'] as $redeem_key_item => $redeem_value_item) { ?>
													
														<tr>
															<td><?php echo $redeem_value_item['id']; ?></td>
															<td><?php echo $redeem_value_item['remaining_principal']; ?></td>
															<td><?php echo $redeem_value_item['payment_interest']; ?></td>
															<td><?php echo $redeem_value_item['payment_amount']; ?></td>
															<td><?php echo $redeem_value_item['service_charge']; ?></td>
															<td><?php echo $redeem_value_item['grand_amount']; ?></td>
															<td><?php echo date('M j, Y g:i A', strtotime($redeem_value_item['date_redeemed'].' '.$redeem_value_item['time_redeemed'])); ?></td>
														</tr>
												
													<?php } ?>
											</table>	
										</div>
										
									</div><!--/.panel-body-->
									
									<div class="w3-container w3-padding w3-border-bottom w3-border-left w3-border-right w3-light-gray">
										<a href="/print/print/print_customer_transactions/<?php echo $redeem_value_item['id']; ?>" class="w3-button w3-gray w3-round-small pull-left" target="_blank"><i class="fa fa-print"></i> Print Transaction Detail</a>
										<a href="/customer_transactions/transaction/<?php echo $redeem_value_item['id']; ?>" class="w3-button w3-gray w3-round-small pull-left w3-margin-left"><i class="fa fa-eye"></i> View Details</a>
									</div>
									
								</div><!--/.panel-default-->
								
							</div>
						</div>
					</div><!--/.panel-default-->
					
					
				<?php } ?>
				
			</div><!--menu 3 redeemed-->
			
			<div class="tab-pane fade" id="menu4">
				
				<?php foreach($under_auction['CustomerTransaction'] as $key_ua => $value_ua) {?>
					
					<div class="panel panel-default w3-margin-top">
						<div class="panel-heading w3-large">
							<a class="w3-padding w3-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key_ua; ?>">
								<?php echo $value_ua['Book']['name']; ?>
								<span class="pull-right">
									<?php 
										echo $value_ua['TransactionUnderAuction'][ count( $value_ua['TransactionUnderAuction'] ) - 1 ]['date_auction'].' ';
										echo $value_ua['TransactionUnderAuction'][ count( $value_ua['TransactionUnderAuction'] ) - 1 ]['time_auction'];
									?>
								</span>
							</a>
						</div>
						<div id="collapseOne<?php echo $key_ua; ?>" class="panel-collapse collapse">
							<div class="panel-body">
								
								<div class="w3-margin-top w3-margin-bottom">
									<div class="panel-heading w3-green" id="headerBackgroundColor">
										<h4>
											<?php echo $value_ua['Book']['name']; ?>
											<span class="pull-right">
												<?php 
													echo 'Date Pawned: '.date('M j, Y g:i A',strtotime($value_ua['sangla_date'].' '.$value_ua['sangla_time']));
												?>
											</span>
										</h4>
									</div>
									<div class="panel-body w3-border">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td style="width:20%;">Item</td>
													<td style="width:20%;">Gross Amount</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $value_ua['gross_amount']; ?></td>
													<td style="width:20%;">Jewelry Type</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $value_ua['jewelry_type']; ?></td>
												</tr>
												<tr>
													<td rowspan="5" class="w3-light-grey">
														<img src="<?php echo $value_ua['image_location']; ?>" class="img-thumbnail" />
													</td>
													<td>Orig. Net Amount</td>
													<td class="w3-light-grey"><?php echo $value_ua['net_amount_duplicate']; ?></td>
													<td>Karat</td>
													<td class="w3-light-grey"><?php echo $value_ua['karat']; ?></td>
												</tr>
												<tr>
													<td>Net Amount</td>
													<td class="w3-light-grey"><?php echo $value_ua['net_amount']; ?></td>
													<td>Weight (grams)</td>
													<td class="w3-light-grey"><?php echo $value_ua['weight']; ?></td>
												</tr>
												<tr>
													<td>1st Month Interest</td>
													<td class="w3-light-grey"><?php echo $value_ua['first_month_interest']; ?></td>
													<td>Item Type</td>
													<td class="w3-light-grey"><?php echo $value_ua['item_type']; ?></td>
												</tr>
												<tr>
													<td>Transaction Date</td>
													<td class="w3-light-grey"><?php echo date('M j, Y g:i a', strtotime($value_ua['sangla_date'].' '.$value_ua['sangla_time'])); ?></td>	
													<td>Brand</td>
													<td class="w3-light-grey"><?php echo $value_ua['brand']; ?></td>
												</tr>
												<tr>
													<td>ID Presented</td>
													<td class="w3-light-grey"><?php echo $value_ua['id_presented']; ?></td>
													<td>Model</td>
													<td class="w3-light-grey"><?php echo $value_ua['model']; ?></td>
												</tr>
											</table>
										</div>
										<!--/.table-responsive-->
										
										<?php if(!empty($value_ua['TransactionPrincipalPayment'])) { ?>
												<div class="table-responsive">
													<table class="table table-bordered">
														<tr>
															<td colspan="4" class="w3-center w3-light-gray">Principal Payment Details</td>
														</tr>
														<tr>
															<td style="width:25%; font-weight:bold;">Payment Date</td>
															<td style="width:15%; font-weight:bold;">Amount</td>
															<td style="width:35%; font-weight:bold;">Details</td>
															<td style="width:25%; font-weight:bold;">User</td>
														</tr>
														<?php
														$totalPaymentUa = 0;
														foreach($value_ua['TransactionPrincipalPayment'] as $principal_key_ua => $principal_value_ua) { ?>
															
															<?php $totalPaymentUa += $principal_value_ua['amount']; ?>
															
															<tr>
																<td><?php echo date('M j, Y', strtotime($principal_value_ua['transaction_date'])); ?></td>
																<td><?php echo $principal_value_ua['amount']; ?></td>
																<td><?php echo $principal_value_ua['details']; ?></td>
																<td><?php echo $users[ $principal_value_ua['user_id'] ]; ?></td>
															</tr>
														<?php } ?>
														
														<tr class="info">
															<td><b>Total Payment</b></td>
															<td><b><?php echo $totalPaymentUa; ?></b></td>
															<td></td>
															<td></td>
														</tr>
														<tr class="danger">
															<td><b>Remaining Principal</b></td>
															<td><b><?php echo $value_ua['net_amount_duplicate'] - $totalPaymentUa; ?></b></td>
															<td></td>
															<td></td>
														</tr>
													</table>
												</div>
										 <?php } ?>
							 
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="8" class="w3-center w3-light-gray">Interest Payment Details</td>
												</tr>
												<tr>
													<td class="w3-center" style="font-weight:bold;">PT No.</td>
													<td class="w3-center" style="font-weight:bold;">Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Due Amount</td>
													<td class="w3-center" style="font-weight:bold;">Start Date</td>
													<td class="w3-center" style="font-weight:bold;">Total Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Payment</td>
													<td class="w3-center" style="font-weight:bold;">Payment Date</td>
													<td class="w3-center" style="font-weight:bold;">Status</td>
												</tr>
													<?php foreach($value_ua['TransactionInterestPayment'] as $interest_key_ua => $interest_value_ua) { ?>
												
															<tr>
																<td class="w3-center"><span class="w3-badge w3-green"><?php echo $interest_value_ua['pt_number']; ?></span></td>
																<td class="w3-center"><?php echo $interest_value_ua['payment_due_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua['payment_due_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua['payment_starting_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua['payment_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua['payment_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua['payment_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua['status']; ?></td>
															</tr>
														
													<?php } ?>
											</table>									
										</div>
										
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="4" class="w3-center w3-light-gray">Under Auctioned Details</td>
												</tr>
												<tr>
													<td style="font-weight:bold;">ID</td>
													<td style="font-weight:bold;">Auction Price</td>
													<td style="font-weight:bold;">Date Auctioned</td>
													<td style="font-weight:bold;">Time Auctioned</td>
												</tr>
													<?php foreach($value_ua['TransactionUnderAuction'] as $auction_sold_key => $auction_sold_value) { ?>
													
														<tr>
															<td><?php echo $auction_sold_value['id']; ?></td>
															<td><?php echo $auction_sold_value['auction_price']; ?></td>
															<td><?php echo $auction_sold_value['date_auction']; ?></td>
															<td><?php echo $auction_sold_value['time_auction']; ?></td>
														</tr>
												
													<?php } ?>
											</table>	
										</div>
										
									</div><!--/.panel-body-->
									
									<div class="w3-container w3-padding w3-border-bottom w3-border-left w3-border-right w3-light-gray">
										<a href="/print/print/print_customer_transactions/<?php echo $value_ua['id']; ?>" class="w3-button w3-gray w3-round-small pull-left" target="_blank"><i class="fa fa-print"></i> Print Transaction Detail</a>
										<a href="/customer_transactions/transaction/<?php echo $value_ua['id']; ?>" class="w3-button w3-gray w3-round-small pull-left w3-margin-left"><i class="fa fa-eye"></i> View Details</a>
									</div>
									
								</div><!--/.panel-default-->
								
							</div>
						</div>
					</div><!--/.panel-default-->
					
				<?php }?>
				
			</div><!--menu 4 under auction-->
			
			
			<div class="tab-pane fade" id="menu44">
				
				<?php foreach($under_auction_takeout['CustomerTransaction'] as $key_ua_to => $value_ua_to) {?>
					
					<div class="panel panel-default w3-margin-top">
						<div class="panel-heading w3-large">
							<a class="w3-padding w3-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key_ua; ?>">
								<?php echo $value_ua_to['Book']['name']; ?>
								<span class="pull-right">
									<?php 
										echo $value_ua_to['TransactionUnderAuction'][ count( $value_ua_to['TransactionUnderAuction'] ) - 1 ]['date_auction'].' ';
										echo $value_ua_to['TransactionUnderAuction'][ count( $value_ua_to['TransactionUnderAuction'] ) - 1 ]['time_auction'];
									?>
								</span>
							</a>
						</div>
						<div id="collapseOne<?php echo $key_ua; ?>" class="panel-collapse collapse">
							<div class="panel-body">
								
								<div class="w3-margin-top w3-margin-bottom">
									<div class="panel-heading w3-gray" id="headerBackgroundColor">
										<h4>
											<?php echo $value_ua_to['Book']['name']; ?>
											<span class="pull-right">
												<?php 
													echo 'Date Pawned: '.date('M j, Y g:i A',strtotime($value_ua_to['sangla_date'].' '.$value_ua_to['sangla_time']));
												?>
											</span>
										</h4>
									</div>
									<div class="panel-body w3-border">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td style="width:20%;">Item</td>
													<td style="width:20%;">Gross Amount</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $value_ua_to['gross_amount']; ?></td>
													<td style="width:20%;">Jewelry Type</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $value_ua_to['jewelry_type']; ?></td>
												</tr>
												<tr>
													<td rowspan="5" class="w3-light-grey">
														<img src="<?php echo $value_ua_to['image_location']; ?>" class="img-thumbnail" />
													</td>
													<td>Orig. Net Amount</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['net_amount_duplicate']; ?></td>
													<td>Karat</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['karat']; ?></td>
												</tr>
												<tr>
													<td>Net Amount</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['net_amount']; ?></td>
													<td>Weight (grams)</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['weight']; ?></td>
												</tr>
												<tr>
													<td>1st Month Interest</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['first_month_interest']; ?></td>
													<td>Item Type</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['item_type']; ?></td>
												</tr>
												<tr>
													<td>Transaction Date</td>
													<td class="w3-light-grey"><?php echo date('M j, Y g:i a', strtotime($value_ua_to['sangla_date'].' '.$value_ua_to['sangla_time'])); ?></td>	
													<td>Brand</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['brand']; ?></td>
												</tr>
												<tr>
													<td>ID Presented</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['id_presented']; ?></td>
													<td>Model</td>
													<td class="w3-light-grey"><?php echo $value_ua_to['model']; ?></td>
												</tr>
											</table>
										</div>
										<!--/.table-responsive-->
										
										<?php if(!empty($value_ua_to['TransactionPrincipalPayment'])) { ?>
												<div class="table-responsive">
													<table class="table table-bordered">
														<tr>
															<td colspan="4" class="w3-center w3-light-gray">Principal Payment Details</td>
														</tr>
														<tr>
															<td style="width:25%; font-weight:bold;">Payment Date</td>
															<td style="width:15%; font-weight:bold;">Amount</td>
															<td style="width:35%; font-weight:bold;">Details</td>
															<td style="width:25%; font-weight:bold;">User</td>
														</tr>
														<?php
														$totalPaymentUa = 0;
														foreach($value_ua_to['TransactionPrincipalPayment'] as $principal_key_ua_to => $principal_value_ua_to) { ?>
															
															<?php $totalPaymentUa += $principal_value_ua_to['amount']; ?>
															
															<tr>
																<td><?php echo date('M j, Y', strtotime($principal_value_ua_to['transaction_date'])); ?></td>
																<td><?php echo $principal_value_ua_to['amount']; ?></td>
																<td><?php echo $principal_value_ua_to['details']; ?></td>
																<td><?php echo $users[ $principal_value_ua_to['user_id'] ]; ?></td>
															</tr>
														<?php } ?>
														
														<tr class="info">
															<td><b>Total Payment</b></td>
															<td><b><?php echo $totalPaymentUa; ?></b></td>
															<td></td>
															<td></td>
														</tr>
														<tr class="danger">
															<td><b>Remaining Principal</b></td>
															<td><b><?php echo $value_ua_to['net_amount_duplicate']; ?></b></td>
															<td></td>
															<td></td>
														</tr>
													</table>
												</div>
										 <?php } ?>
							 
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="8" class="w3-center w3-light-gray">Interest Payment Details</td>
												</tr>
												<tr>
													<td class="w3-center" style="font-weight:bold;">PT No.</td>
													<td class="w3-center" style="font-weight:bold;">Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Due Amount</td>
													<td class="w3-center" style="font-weight:bold;">Start Date</td>
													<td class="w3-center" style="font-weight:bold;">Total Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Payment</td>
													<td class="w3-center" style="font-weight:bold;">Payment Date</td>
													<td class="w3-center" style="font-weight:bold;">Status</td>
												</tr>
													<?php foreach($value_ua_to['TransactionInterestPayment'] as $interest_key_ua_to => $interest_value_ua_to) { ?>
												
															<tr>
																<td class="w3-center"><span class="w3-badge w3-green"><?php echo $interest_value_ua_to['pt_number']; ?></span></td>
																<td class="w3-center"><?php echo $interest_value_ua_to['payment_due_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua_to['payment_due_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua_to['payment_starting_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua_to['payment_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua_to['payment_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua_to['payment_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_ua_to['status']; ?></td>
															</tr>
														
													<?php } ?>
											</table>									
										</div>
										
										<?php if(!empty($value_ua_to['TransactionUnderAuction'])) { ?>
											<div class="table-responsive">
												<table class="table table-bordered">
													<tr>
														<td colspan="4" class="w3-center w3-light-gray">Under Auctioned Details</td>
													</tr>
													<tr>
														<td style="font-weight:bold;">ID</td>
														<td style="font-weight:bold;">Auction Price</td>
														<td style="font-weight:bold;">Date Auctioned</td>
														<td style="font-weight:bold;">Time Auctioned</td>
													</tr>
														<?php foreach($value_ua_to['TransactionUnderAuction'] as $auction_sold_key_to => $auction_sold_value_to) { ?>
														
															<tr>
																<td><?php echo $auction_sold_value_to['id']; ?></td>
																<td><?php echo $auction_sold_value_to['auction_price']; ?></td>
																<td><?php echo $auction_sold_value_to['date_auction']; ?></td>
																<td><?php echo $auction_sold_value_to['time_auction']; ?></td>
															</tr>
													
														<?php } ?>
												</table>	
											</div>
										<?php } ?>
										
										<?php if(!empty($value_ua_to['TransactionInOutItem'])) { ?>
											<div class="table-responsive">
												<table class="table table-bordered">
													<tr>
														<td colspan="3" class="w3-center w3-light-gray">Under Auctioned Takeout Details</td>
													</tr>
													<tr>
														<td style="width:25%; font-weight:bold;">Status</td>
														<td style="width:50%; font-weight:bold;">Details</td>
														<td style="width:25%; font-weight:bold;">Date Transaction</td>
													</tr>
													<?php foreach($value_ua_to['TransactionInOutItem'] as $key_takeout => $value_takeout){ ?>
														<tr>
															<td><?php echo $value_takeout['status']; ?></td>
															<td><?php echo $value_takeout['details']; ?></td>
															<td><?php echo date('M j, Y g:i:A', strtotime($value_takeout['date_transaction'].' '.$value_takeout['time_transaction'])); ?></td>
														</tr>
													<?php } ?>
												</table>	
											</div>
										<?php } ?>
										
									</div><!--/.panel-body-->
									
									<div class="w3-container w3-padding w3-border-bottom w3-border-left w3-border-right w3-light-gray">
										<a href="/print/print/print_customer_transactions/<?php echo $value_ua_to['id']; ?>" class="w3-button w3-gray w3-round-small pull-left" target="_blank"><i class="fa fa-print"></i> Print Transaction Detail</a>
										<a href="/customer_transactions/transaction/<?php echo $value_ua_to['id']; ?>" class="w3-button w3-gray w3-round-small pull-left w3-margin-left"><i class="fa fa-eye"></i> View Details</a>
									</div>
									
								</div><!--/.panel-default-->
								
							</div>
						</div>
					</div><!--/.panel-default-->
					
				<?php }?>
				
			</div><!--menu 44 under auction-->
			
			<div class="tab-pane fade" id="menu5">
				
				<?php foreach($auctioned['CustomerTransaction'] as $key_auctioned => $value_auctioned) {?>
					
					<div class="panel panel-default w3-margin-top">
						<div class="panel-heading w3-large">
							<a class="w3-padding w3-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key_auctioned; ?>">
								<?php echo $value_auctioned['Book']['name']; ?>
								<span class="pull-right">
								<?php 
									echo $value_auctioned['TransactionUnderAuction'][ count( $value_auctioned['TransactionUnderAuction'] ) - 1 ]['date_sold'].' ';
									echo $value_auctioned['TransactionUnderAuction'][ count( $value_auctioned['TransactionUnderAuction'] ) - 1 ]['time_sold'];
								?>
								</span>
							</a>
						</div>
						<div id="collapseOne<?php echo $key_auctioned; ?>" class="panel-collapse collapse">
							<div class="panel-body">
								
								<div class="w3-margin-top w3-margin-bottom">
									<div class="panel-heading w3-amber" id="headerBackgroundColor">
										<h4>
											<?php echo $value_auctioned['Book']['name']; ?>
											<span class="pull-right">
												<?php 
													echo 'Date Pawned: '.date('M j, Y g:i A',strtotime($value_auctioned['sangla_date'].' '.$value_auctioned['sangla_time']));
												?>
											</span>
										</h4>
									</div>
									<div class="panel-body w3-border">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td style="width:20%;">Item</td>
													<td style="width:20%;">Gross Amount</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $value_auctioned['gross_amount']; ?></td>
													<td style="width:20%;">Jewelry Type</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $value_auctioned['jewelry_type']; ?></td>
												</tr>
												<tr>
													<td rowspan="5" class="w3-light-grey">
														<img src="<?php echo $value_auctioned['image_location']; ?>" class="img-thumbnail" />
													</td>
													<td>Orig. Net Amount</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['net_amount_duplicate']; ?></td>
													<td>Karat</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['karat']; ?></td>
												</tr>
												<tr>
													<td>Net Amount</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['net_amount']; ?></td>
													<td>Weight (grams)</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['weight']; ?></td>
												</tr>
												<tr>
													<td>1st Month Interest</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['first_month_interest']; ?></td>
													<td>Item Type</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['item_type']; ?></td>
												</tr>
												<tr>
													<td>Transaction Date</td>
													<td class="w3-light-grey"><?php echo date('M j, Y g:i a', strtotime($value_auctioned['sangla_date'].' '.$value_auctioned['sangla_time'])); ?></td>	
													<td>Brand</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['brand']; ?></td>
												</tr>
												<tr>
													<td>ID Presented</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['id_presented']; ?></td>
													<td>Model</td>
													<td class="w3-light-grey"><?php echo $value_auctioned['model']; ?></td>
												</tr>
											</table>
										</div>
										<!--/.table-responsive-->
										
										<?php if(!empty($value_auctioned['TransactionPrincipalPayment'])) { ?>
												<div class="table-responsive">
													<table class="table table-bordered">
														<tr>
															<td colspan="4" class="w3-center w3-light-gray">Principal Payment Details</td>
														</tr>
														<tr>
															<td style="width:25%; font-weight:bold;">Payment Date</td>
															<td style="width:15%; font-weight:bold;">Amount</td>
															<td style="width:35%; font-weight:bold;">Details</td>
															<td style="width:25%; font-weight:bold;">User</td>
														</tr>
														<?php
														$totalPaymentActioned = 0;
														foreach($value_auctioned['TransactionPrincipalPayment'] as $principal_key_auctioned => $principal_value_auctioned) { ?>
															
															<?php $totalPaymentActioned += $principal_value_auctioned['amount']; ?>
															
															<tr>
																<td><?php echo date('M j, Y', strtotime($principal_value_auctioned['transaction_date'])); ?></td>
																<td><?php echo $principal_value_auctioned['amount']; ?></td>
																<td><?php echo $principal_value_auctioned['details']; ?></td>
																<td><?php echo $users[ $principal_value_auctioned['user_id'] ]; ?></td>
															</tr>
														<?php } ?>
														
														<tr class="info">
															<td><b>Total Payment</b></td>
															<td><b><?php echo $totalPaymentActioned; ?></b></td>
															<td></td>
															<td></td>
														</tr>
														<tr class="danger">
															<td><b>Remaining Principal</b></td>
															<td><b><?php echo $value_auctioned['net_amount_duplicate'] - $totalPaymentActioned; ?></b></td>
															<td></td>
															<td></td>
														</tr>
													</table>
												</div>
										 <?php } ?>
							 
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="8" class="w3-center w3-light-gray">Interest Payment Details</td>
												</tr>
												<tr>
													<td class="w3-center" style="font-weight:bold;">PT No.</td>
													<td class="w3-center" style="font-weight:bold;">Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Due Amount</td>
													<td class="w3-center" style="font-weight:bold;">Start Date</td>
													<td class="w3-center" style="font-weight:bold;">Total Interest(%)</td>
													<td class="w3-center" style="font-weight:bold;">Payment</td>
													<td class="w3-center" style="font-weight:bold;">Payment Date</td>
													<td class="w3-center" style="font-weight:bold;">Status</td>
												</tr>
													<?php foreach($value_auctioned['TransactionInterestPayment'] as $interest_key_auctioned => $interest_value_auctioned) { ?>
												
															<tr>
																<td class="w3-center"><span class="w3-badge w3-green"><?php echo $interest_value_auctioned['pt_number']; ?></span></td>
																<td class="w3-center"><?php echo $interest_value_auctioned['payment_due_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_auctioned['payment_due_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_auctioned['payment_starting_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_auctioned['payment_interest']; ?></td>
																<td class="w3-center"><?php echo $interest_value_auctioned['payment_amount']; ?></td>
																<td class="w3-center"><?php echo $interest_value_auctioned['payment_date']; ?></td>
																<td class="w3-center"><?php echo $interest_value_auctioned['status']; ?></td>
															</tr>
														
													<?php } ?>
											</table>									
										</div>
										
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="6" class="w3-center w3-light-gray">Under Auctioned Details</td>
												</tr>
												<tr>
													<td style="font-weight:bold;">ID</td>
													<td style="font-weight:bold;">Auction Price</td>
													<td style="font-weight:bold;">Date Auctioned</td>
													<td style="font-weight:bold;">Time Auctioned</td>
													<td style="font-weight:bold;">Details</td>
													<td style="font-weight:bold;">User</td>
												</tr>
													<?php foreach($value_auctioned['TransactionUnderAuction'] as $auction_sold_key_auctioned => $auction_sold_value_auctioned) { ?>
													
														<tr>
															<td><?php echo $auction_sold_value_auctioned['id']; ?></td>
															<td><?php echo $auction_sold_value_auctioned['auction_price']; ?></td>
															<td><?php echo $auction_sold_value_auctioned['date_auction']; ?></td>
															<td><?php echo $auction_sold_value_auctioned['time_auction']; ?></td>
															<td><?php echo $auction_sold_value_auctioned['details']; ?></td>
															<td><?php echo $users[ $auction_sold_value_auctioned['user_id'] ]; ?></td>
														</tr>
												
													<?php } ?>
											</table>
										</div>
										
										<hr class="w3-border-red"/>
										
										<?php foreach($value_auctioned['TransactionSoldItem'] as $sold_key_auctioned => $sold_value_auctioned) { ?>
													
											<div class="table-responsive">
												<table class="table table-bordered">
													<tr>
														<td colspan="7" class="w3-center w3-light-gray">Sold Details</td>
													</tr>
													<tr>
														<td style="font-weight:bold;">ID</td>
														<td style="font-weight:bold;">Sold Price</td>
														<td style="font-weight:bold;">Discount</td>
														<td style="font-weight:bold;">Date Sold</td>
														<td style="font-weight:bold;">OR No.</td>
														<td style="font-weight:bold;">PT No.</td>
														<td style="font-weight:bold;">Details</td>
													</tr>
													<tr>
														<td><?php echo $sold_value_auctioned['id']; ?></td>
														<td><?php echo $sold_value_auctioned['sold_price']; ?></td>
														<td><?php echo $sold_value_auctioned['discount']; ?></td>
														<td><?php echo date('M j, Y g:i A', strtotime($sold_value_auctioned['date_sold'].''.$sold_value_auctioned['time_sold'])); ?></td>
														<td><?php echo $sold_value_auctioned['or_number']; ?></td>
														<td style="font-weight:bold; color:red;"><?php echo $sold_value_auctioned['pt_number']; ?></td>
														<td><?php echo $sold_value_auctioned['details']; ?></td>
													</tr>
												</table>
											</div>
											
											<div class="table-responsive">
												<table class="table table-bordered">
													<tr>
															<td colspan="5" class="w3-center w3-light-gray">Buyer Information Details</td>
														</tr>
													<tr>
														<td style="width:20%;">Buyer</td>
														<td style="width:20%;">Firstname</td>
														<td style="width:20%;" class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['first_name']; ?></td>
														<td style="width:20%;">Number</td>
														<td style="width:20%;" class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['number']; ?></td>
													</tr>
													<tr>
														<td rowspan="3" class="w3-light-grey">
															<img src="<?php echo $sold_value_auctioned['Customer']['image_location']; ?>" class="img-thumbnail" />
														</td>
														<td>Middlename</td>
														<td class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['middle_name']; ?></td>
														<td>Email</td>
														<td class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['email']; ?></td>
													</tr>
													<tr>
														<td>Latname</td>
														<td class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['last_name']; ?></td>
														<td>Address</td>
														<td class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['address']; ?></td>
													</tr>
													<tr>
														<td>Gender</td>
														<td class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['gender']; ?></td>
														<td>Birthdate</td>
														<td class="w3-light-grey"><?php echo $sold_value_auctioned['Customer']['birthdate']; ?></td>
													</tr>
													<tr>
														<td>
															<a class="w3-button w3-dark-gray w3-block" href="/customers/view/<?php echo $sold_value_auctioned['Customer']['id']; ?>">View Details</a></td>
														</td>
														<td>Customer Id</td>
														<td class="w3-light-grey"><span class="w3-badge w3-green"><?php echo $sold_value_auctioned['Customer']['id']; ?></span></td>
														<td></td>
														<td class="w3-light-grey"></td>
													</tr>
												</table>
											</div>
											<hr class="w3-border-red"/>
										<?php } ?>
										
									</div><!--/.panel-body-->
									
									<div class="w3-container w3-padding w3-border-bottom w3-border-left w3-border-right w3-light-gray">
										<a href="/print/print/print_customer_transactions/<?php echo $value_auctioned['id']; ?>" class="w3-button w3-gray w3-round-small pull-left" target="_blank"><i class="fa fa-print"></i> Print Transaction Detail</a>
										<a href="/customer_transactions/transaction/<?php echo $value_auctioned['id']; ?>" class="w3-button w3-gray w3-round-small pull-left w3-margin-left"><i class="fa fa-eye"></i> View Details</a>
									</div>
									
								</div><!--/.panel-default-->
								
							</div>
						</div>
					</div><!--/.panel-default-->
					
				<?php }?>
				
			</div><!-- menu 5 auctioned-->
			
			<div class="tab-pane fade" id="menu6">
				
				<br />
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Result/s</h4>
					</div>
					<div class="panel-body">
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<thead>
								<tr>
									<th>Date Pawn</th>
									<th>Book</th>
									<th>Item Type</th>
									<th>Jewelty Type</th>
									<th>Image</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							  <?php foreach($customer_details as $key_sum => $value_sum): ?>
								 
								 <?php foreach($value_sum['CustomerTransaction'] as $key_inner => $value_inner): ?>
								  
									<?php 
									
										if($value_inner['status'] == 'pawned') {
											
											$color = 'red';
											
										} elseif($value_inner['status'] == 'redeemed') {
											
											$color = 'blue';
											
										} elseif($value_inner['status'] == 'auctioned') {
											
											$color = 'orange';
											
										} elseif($value_inner['status'] == 'ua') {
											
											$color = 'green';
										} elseif($value_inner['status'] == 'ua') {
											
											$color = 'gray';
										}
										
										
										if($value_inner['book_id'] == 1){
											
											$typeColor = 'w3-badge';
											
										} elseif($value_inner['book_id'] == 2) {
											
											$typeColor = 'w3-badge w3-red';
											
										} else {
											
											$typeColor = 'w3-badge w3-blue';
										}
									?>
									
								  
									<tr>
										<td style="border-left:15px solid <?php echo $color; ?>">
											<?php echo date('M j, Y g:i A', strtotime($value_inner['sangla_date'].' '.$value_inner['sangla_time'])); ?>
										</td>
										<td>
											<span class="<?php echo $typeColor; ?>">
												<?php echo $value_inner['book_id']; ?>
											</span>	
										</td>
										<td>
											<?php echo $value_inner['item_type']; ?>
										</td>
										<td>
											<?php echo $value_inner['jewelry_type']; ?>
										</td>
										<td class="w3-center">
											<img src="<?php echo $value_inner['image_location']; ?>" height="30px" width="30px">
										</td>
										<td>
											<a href="/customer_transactions/transaction/<?php echo $value_inner['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
										</td>
									</tr>
									
								<?php endforeach; ?>
							
							<?php endforeach; ?>
							
							</tbody>
						</table>
					</div>
				</div>
				
			</div><!-- menu 6 summary-->
			
			<div class="tab-pane fade" id="menu7"><?php echo $purchasedKey;?>
				<br />
				
				<?php foreach($customer_purchased as $purchasedKey => $purchasedValue) { ?>
				
					<?php foreach($purchasedValue['TransactionSoldItem'] as $keyBought => $valueBought) { ?>
						
						<div class="panel panel-default">
							<div class="panel-heading w3-large">
								<a class="w3-padding w3-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOneSold<?php echo $keyBought; ?>">
									GRANTED <?php echo $valueBought['CustomerTransaction']['book_id']; ?>
									<span class="pull-right">Date Purchased
										<?php echo date('M j, Y g:i A', strtotime($valueBought['date_sold'].' '.$valueBought['time_sold'])); ?>
									</span>
								</a>
							</div>
							<div id="collapseOneSold<?php echo $keyBought; ?>" class="panel-collapse collapse">
									
								<div class="w3-container">
								<div class="panel panel-default w3-margin-top">
									<div class="panel-heading w3-amber" id="headerBackgroundColor">
										<h4>Your Purchased Item</h4>
									</div>
									<div class="panel-body">
											
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="5" class="w3-center w3-light-gray">Item Details</td>
												</tr>
												<tr>
													<td style="width:20%;">Item</td>
													<td style="width:20%;">Gross Amount</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['gross_amount']; ?></td>
													<td style="width:20%;">Jewelry Type</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['jewelry_type']; ?></td>
												</tr>
												<tr>
													<td rowspan="5" class="w3-light-grey">
														<img src="<?php echo $valueBought['CustomerTransaction']['image_location']; ?>" class="img-thumbnail" />
													</td>
													<td>Orig. Net Amount</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['net_amount_duplicate']; ?></td>
													<td>Karat</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['karat']; ?></td>
												</tr>
												<tr>
													<td>Net Amount</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['net_amount']; ?></td>
													<td>Weight (grams)</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['weight']; ?></td>
												</tr>
												<tr>
													<td>1st Month Interest</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['first_month_interest']; ?></td>
													<td>Item Type</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['item_type']; ?></td>
												</tr>
												<tr>
													<td>Transaction Date</td>
													<td class="w3-light-grey"><?php echo date('M j, Y g:i a', strtotime($valueBought['CustomerTransaction']['sangla_date'].' '.$valueBought['CustomerTransaction']['sangla_time'])); ?></td>	
													<td>Brand</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['brand']; ?></td>
												</tr>
												<tr>
													<td>Id Presented</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['id_presented']; ?></td>
													<td>Model</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['model']; ?></td>
												</tr>
											</table>
										</div>
										<!--/.table-responsive-->
										
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="6" class="w3-center w3-light-gray">Purchased Details</td>
												</tr>
												<tr>
													<td style="width:16%;">ID</td>
													<td style="width:16%;">Auction Price</td>
													<td style="width:16%;">Sold Price</td>
													<td style="width:16%;">Discount</td>
													<td style="width:16%;">OR No.</td>
													<td style="width:20%;">Auction Sold</td>
												</tr>
												<tr>
													<td><?php echo $valueBought['id']; ?></td>
													<td><?php echo $valueBought['auction_price']; ?></td>
													<td><?php echo $valueBought['sold_price']; ?></td>
													<td><?php echo $valueBought['discount']; ?></td>
													<td><?php echo $valueBought['or_number']; ?></td>
													<td><?php echo $valueBought['date_sold'].' '.$valueBought['time_sold']; ?></td>
												</tr>
											</table>	
										</div>
										<!--/.table-responsive-->
										
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="5" class="w3-center w3-light-gray">Original Owner Details</td>
												</tr>
												<tr>
													<td style="width:20%;">Image</td>
													<td style="width:20%;">Firstname</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['first_name']; ?></td>
													<td style="width:20%;">Number</td>
													<td style="width:20%;" class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['number']; ?></td>
												</tr>
												<tr>
													<td rowspan="3" class="w3-light-grey">
														<img src="<?php echo $valueBought['CustomerTransaction']['Customer']['image_location']; ?>" class="img-thumbnail" />
													</td>
													<td>Middlename</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['middle_name']; ?></td>
													<td>Email</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['email']; ?></td>
												</tr>
												<tr>
													<td>Latname</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['last_name']; ?></td>
													<td>Address</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['address']; ?></td>
												</tr>
												<tr>
													<td>Gender</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['gender']; ?></td>
													<td>Birthdate</td>
													<td class="w3-light-grey"><?php echo $valueBought['CustomerTransaction']['Customer']['birthdate']; ?></td>
												</tr>
												<tr>
													<td>
														<a class="w3-button w3-dark-gray w3-block" href="/customers/view/<?php echo $valueBought['CustomerTransaction']['Customer']['id']; ?>">View Detais</a>
													</td>
													<td>Customer Id</td>
													<td class="w3-light-grey"><span class="w3-badge w3-green"><?php echo $valueBought['CustomerTransaction']['Customer']['id']; ?></span></td>
													<td></td>
													<td class="w3-light-grey"></td>
												</tr>
											</table>
										</div>	
									
									</div>
									<!--/.panel-body-->
									<div class="modal-footer">
										<a href="/print/print/print_customer_transactions/<?php echo $valueBought['CustomerTransaction']['id']; ?>" class="w3-button w3-gray w3-round-small pull-left" target="_blank"><i class="fa fa-print"></i> Print Transaction Detail</a>
										<a href="/customer_transactions/transaction/<?php echo $valueBought['CustomerTransaction']['id']; ?>" class="w3-button w3-gray w3-round-small pull-left w3-margin-left" target="_blank"><i class="fa fa-eye"></i> View Details</a>
									</div>
								</div>
								</div>
									
							</div>
						</div>
						
						<!--/.panel-default-->
					
					<?php } ?>
					
				<?php } ?>
				
			</div><!-- menu 7 purchased items -->
			
		</div><!--/.tab content -->
		
	</div><!-- /.col-lg-12 -->
	
</div><!-- /.row -->

<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$('img').click(function() {
		
		Swal.fire({
		  title: 'Image',
		  imageUrl: $(this).attr('src'),
		  imageWidth: 400,
		  imageHeight: 200,
		  imageAlt: 'Image',
		  animation: false
		})
	});

});
</script>