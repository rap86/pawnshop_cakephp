 <?php
 
	$noPtNumbers 	= array();
	$for_auction 	= array();
	$pawn		 	= array();
	$granted_total = 0;
	
	/*
	echo '<pre>';
	print_r($datas);
	echo '</pre>';
	*/
	
 foreach($datas as $key => $value)
 {

	$granted_total = $granted_total + $value['CustomerTransaction']['net_amount_duplicate'];
	 
	 if(isset($value['TransactionInterestPayment']) && !empty($value['TransactionInterestPayment']))
	 {
		foreach($value['TransactionInterestPayment'] as $keyInterest => $insterestValue)
		{

			if($insterestValue['status'] == 'unpaid') 
			{
				
				$dueDate 		= date($insterestValue['payment_starting_date']);
				$dateNow 		= date('Y-m-d');
				$startDate      = new DateTime($dueDate); 
				$endDate   		= new DateTime($dateNow); 
				$diffDate		= $startDate->diff($endDate); 
				
				$this->yearPayment     = $diffDate->format('%y'); 
				$this->monthPayment    = $diffDate->format('%m'); 
				$this->dayPayment      = $diffDate->format('%d');
				
				$value['TransactionInterestPayment'][ count($value['TransactionInterestPayment']) -1 ]['date_diff'] = 'Y'.$this->yearPayment.'-'.'M'.$this->monthPayment.'-'.'D'.$this->dayPayment;
	
	
				if($this->monthPayment >= $value['CustomerTransaction']['month_before_remata']) 
				{
					$for_auction[ $key ] = $value;
					//$textColor = 'w3-text-red';
				} 
				else 
				{
					$pawn[ $key ] = $value;
					$textColor = '';
				}
			} 
			else 
			{
				
				if($value['TransactionInterestPayment'][ count($value['TransactionInterestPayment']) - 1 ]['status'] == 'paid') 
				{
					$noPtNumbers[ $key ] = $value;
					$textColor = '';
					
				} 
				else 
				{
					if($value['TransactionInterestPayment'][ count($value['TransactionInterestPayment']) - 1 ]['status'] == '')
					{
						$noPtNumbers[ $key ] = $value;
						$textColor = '';
					}
					
				}
				
			}
		}
	 } 
	 else 
	 {
		$pawn[ $key ] = $value;
		 
	 }
		
		
		
	foreach($pawn as $keyPawn => $valuePawn)
	{
		if($valuePawn['CustomerTransaction']['book_id'] == 1)
		{
			$pawn_book1[ $valuePawn['CustomerTransaction']['id'] ] = $valuePawn;
			
		} 
		if($valuePawn['CustomerTransaction']['book_id'] == 2)
		{
			$pawn_book2[ $valuePawn['CustomerTransaction']['id'] ] = $valuePawn;
			
		} 
		if($valuePawn['CustomerTransaction']['book_id'] == 3)
		{	
			$pawn_book3[ $valuePawn['CustomerTransaction']['id'] ] = $valuePawn;
		}
	}
	
	foreach($for_auction as $keyAuction => $valueAuction)
	{
		if($valueAuction['CustomerTransaction']['book_id'] == 1)
		{
			$forauction_book1[ $valueAuction['CustomerTransaction']['id'] ] = $valueAuction;
			
		} 
		if($valueAuction['CustomerTransaction']['book_id'] == 2)
		{
			$forauction_book2[ $valueAuction['CustomerTransaction']['id'] ] = $valueAuction;
			
		} 
		if($valueAuction['CustomerTransaction']['book_id'] == 3)
		{	
			$forauction_book3[ $valueAuction['CustomerTransaction']['id'] ] = $valueAuction;
		}
	}
		/*
		echo '<pre>';
		print_r($pawn_book1);
		echo '</pre>';
		*/
 }
?>
	
<style>
#myTab li a { 
	background-color:#ccccb3;
	border-top-left-radius:2px; 
	border-top-right-radius:2px; 
}
#myTab li.active a {
	border-bottom-color:transparent;
	background-color:white; 
}

#myTab2 li a { 
	background-color:#ccccb3;
	border-top-left-radius:2px; 
	border-top-right-radius:2px; 
}
#myTab2 li.active a {
	border-bottom-color:transparent;
	background-color:white; 
}
</style>

<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-pale-red w3-padding w3-border w3-border-red">Pawned</h3>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a href="#menu1" data-toggle="tab">Pawned <span class="w3-badge w3-red"><?php echo count($pawn); ?></span></a>
			</li>
			<li>
				<a href="#menu2" data-toggle="tab">Ready for Auction <span class="w3-badge w3-red"><?php echo count($for_auction); ?></span></a>
			</li>
			<li>
				<a href="#menu3" data-toggle="tab">NO PT Number <span class="w3-badge w3-red"><?php echo count($noPtNumbers); ?></span></a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content my-tab">
		
			<div class="tab-pane fade in active" id="menu1">
				<div class="w3-margin-top w3-border-red w3-leftbar">
					<p class="w3-border-bottom"> &emsp; Transaction here are less than Four (4) Months </p>
				</div>
				<ul class="nav nav-tabs" id="myTab2">
					<li class="active">
						<a href="#book1" data-toggle="tab">Book 1  <span class="w3-badge w3-red"><?php echo count($pawn_book1); ?></span></a>
					</li>
					<li>
						<a href="#book2" data-toggle="tab">Book 2 <span class="w3-badge w3-red"><?php echo count($pawn_book2); ?></span></a>
					</li>
					<li>
						<a href="#book3" data-toggle="tab">Book 3 <span class="w3-badge w3-red"><?php echo count($pawn_book3); ?></span></a>
					</li>
				</ul>
				<div class="tab-content my-tab">
					<div class="tab-pane fade in active" id="book1">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<thead>
								<tr>
									<th>Image</th>
									<th>Customer</th>
									<th>Last Payment</th>
									<th>Date Diff</th>
									<th>Item Type</th>
									<th>Jewelty Type</th>
									<th>PT No.</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								 <?php foreach($pawn_book1 as $keyPawn1 => $valuePawn1): ?>

									<tr>
										<td class="w3-center">
				
											<?php if(trim($valuePawn1['Customer']['image_name']) != '') { ?>
								
												<img src="<?php echo $valuePawn1['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valuePawn1['Customer']['image_name']) == '' && $valuePawn1['Customer']['gender'] == 'male') { ?>
												
												<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valuePawn1['Customer']['image_name']) == '' && $valuePawn1['Customer']['gender'] == 'female') { ?>
												
												<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
												 
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn1['Customer']['first_name'].' '.$valuePawn1['Customer']['middle_name'].' ' .$valuePawn1['Customer']['last_name']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn1['TransactionInterestPayment'][count($valuePawn1['TransactionInterestPayment']) -1 ]['payment_starting_date']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn1['TransactionInterestPayment'][count($valuePawn1['TransactionInterestPayment']) -1 ]['date_diff']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn1['CustomerTransaction']['item_type']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn1['CustomerTransaction']['jewelry_type']; ?>
										</td>
										<td class="w3-center">
											<?php echo $valuePawn1['TransactionInterestPayment'][ count($valuePawn1['TransactionInterestPayment']) -1 ]['pt_number']; ?>
										</td>
										<td>
											<a href="/customer_transactions/transaction/<?php echo $valuePawn1['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
										</td>
									</tr>
									
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane fade" id="book2">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<thead>
								<tr>
									<th>Image</th>
									<th>Customer</th>
									<th>Last Payment</th>
									<th>Date Diff</th>
									<th>Item Type</th>
									<th>Jewelty Type</th>
									<th>PT No.</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								 <?php foreach($pawn_book2 as $keyPawn2 => $valuePawn2): ?>

									<tr>
										<td class="w3-center">
				
											<?php if(trim($valuePawn2['Customer']['image_name']) != '') { ?>
								
												<img src="<?php echo $valuePawn2['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($value1['Customer']['image_name']) == '' && $valuePawn2['Customer']['gender'] == 'male') { ?>
												
												<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valuePawn2['Customer']['image_name']) == '' && $valuePawn2['Customer']['gender'] == 'female') { ?>
												
												<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
												 
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn2['Customer']['first_name'].' '.$valuePawn2['Customer']['middle_name'].' ' .$valuePawn2['Customer']['last_name']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn2['TransactionInterestPayment'][count($valuePawn2['TransactionInterestPayment']) -1 ]['payment_starting_date']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn2['TransactionInterestPayment'][count($valuePawn2['TransactionInterestPayment']) -1 ]['date_diff']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn2['CustomerTransaction']['item_type']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn2['CustomerTransaction']['jewelry_type']; ?>
										</td>
										<td class="w3-center">
											<?php echo $valuePawn2['TransactionInterestPayment'][ count($valuePawn2['TransactionInterestPayment']) -1 ]['pt_number']; ?>
										</td>
										<td>
											<a href="/customer_transactions/transaction/<?php echo $valuePawn2['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
										</td>
									</tr>
									
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane fade" id="book3">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<thead>
								<tr>
									<th>Image</th>
									<th>Customer</th>
									<th>Last Payment</th>
									<th>Date Diff</th>
									<th>Item Type</th>
									<th>Jewelty Type</th>
									<th>PT No.</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								 <?php foreach($pawn_book3 as $keyPawn3 => $valuePawn3): ?>

									<tr>
										<td class="w3-center">
				
											<?php if(trim($valuePawn3['Customer']['image_name']) != '') { ?>
								
												<img src="<?php echo $valuePawn3['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valuePawn3['Customer']['image_name']) == '' && $valuePawn3['Customer']['gender'] == 'male') { ?>
												
												<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valuePawn3['Customer']['image_name']) == '' && $valuePawn3['Customer']['gender'] == 'female') { ?>
												
												<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
												 
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn3['Customer']['first_name'].' '.$valuePawn3['Customer']['middle_name'].' ' .$valuePawn3['Customer']['last_name']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn3['TransactionInterestPayment'][count($valuePawn3['TransactionInterestPayment']) -1 ]['payment_starting_date']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn3['TransactionInterestPayment'][count($valuePawn3['TransactionInterestPayment']) -1 ]['date_diff']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn3['CustomerTransaction']['item_type']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn3['CustomerTransaction']['jewelry_type']; ?>
										</td>
										<td class="w3-center">
											<?php echo $valuePawn3['TransactionInterestPayment'][ count($valuePawn3['TransactionInterestPayment']) -1 ]['pt_number']; ?>
										</td>
										<td>
											<a href="/customer_transactions/transaction/<?php echo $valuePawn3['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
										</td>
									</tr>
									
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
			
			<div class="tab-pane fade" id="menu2">
				<div class="w3-margin-top w3-border-red w3-leftbar">
					<p class="w3-border-bottom"> &emsp; Transaction here are greater than Four (4) Months </p>
				</div>
				<ul class="nav nav-tabs" id="myTab2">
					<li class="active">
						<a href="#for_auction_book1" data-toggle="tab">Book 1  <span class="w3-badge w3-red"><?php echo count($forauction_book1); ?></span></a>
					</li>
					<li>
						<a href="#for_auction_book2" data-toggle="tab">Book 2 <span class="w3-badge w3-red"><?php echo count($forauction_book2); ?></span></a>
					</li>
					<li>
						<a href="#for_auction_book3" data-toggle="tab">Book 3 <span class="w3-badge w3-red"><?php echo count($forauction_book3); ?></span></a>
					</li>
				</ul>
				<div class="tab-content my-tab">
					<div class="tab-pane fade in active" id="for_auction_book1">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<thead>
								<tr>
									<th>Image</th>
									<th>Customer</th>
									<th>Last Payment</th>
									<th>Date Diff</th>
									<th>Item Type</th>
									<th>Jewelty Type</th>
									<th>PT No.</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								 <?php foreach($forauction_book1 as $keyForAuc1 => $valueForAuc1): ?>

									<tr>
										<td class="w3-center">
				
											<?php if(trim($valueForAuc1['Customer']['image_name']) != '') { ?>
								
												<img src="<?php echo $valueForAuc1['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valueForAuc1['Customer']['image_name']) == '' && $valueForAuc1['Customer']['gender'] == 'male') { ?>
												
												<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valueForAuc1['Customer']['image_name']) == '' && $valueForAuc1['Customer']['gender'] == 'female') { ?>
												
												<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
												 
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc1['Customer']['first_name'].' '.$valueForAuc1['Customer']['middle_name'].' ' .$valueForAuc1['Customer']['last_name']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc1['TransactionInterestPayment'][count($valueForAuc1['TransactionInterestPayment']) -1 ]['payment_starting_date']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc1['TransactionInterestPayment'][count($valueForAuc1['TransactionInterestPayment']) -1 ]['date_diff']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc1['CustomerTransaction']['item_type']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc1['CustomerTransaction']['jewelry_type']; ?>
										</td>
										<td class="w3-center">
											<?php echo $valueForAuc1['TransactionInterestPayment'][ count($valueForAuc1['TransactionInterestPayment']) -1 ]['pt_number']; ?>
										</td>
										<td>
											<a href="/customer_transactions/transaction/<?php echo $valueForAuc1['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
										</td>
									</tr>
									
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane fade" id="for_auction_book2">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<thead>
								<tr>
									<th>Image</th>
									<th>Customer</th>
									<th>Last Payment</th>
									<th>Date Diff</th>
									<th>Item Type</th>
									<th>Jewelty Type</th>
									<th>PT No.</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								  <?php foreach($forauction_book2 as $keyForAuc2 => $valueForAuc2): ?>

									<tr>
										<td class="w3-center">
				
											<?php if(trim($valueForAuc2['Customer']['image_name']) != '') { ?>
								
												<img src="<?php echo $valueForAuc2['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valueForAuc2['Customer']['image_name']) == '' && $valueForAuc2['Customer']['gender'] == 'male') { ?>
												
												<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valueForAuc2['Customer']['image_name']) == '' && $valueForAuc2['Customer']['gender'] == 'female') { ?>
												
												<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
												 
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc2['Customer']['first_name'].' '.$valueForAuc2['Customer']['middle_name'].' ' .$valueForAuc2['Customer']['last_name']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc2['TransactionInterestPayment'][count($valueForAuc2['TransactionInterestPayment']) -1 ]['payment_starting_date']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc2['TransactionInterestPayment'][count($valueForAuc2['TransactionInterestPayment']) -1 ]['date_diff']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc2['CustomerTransaction']['item_type']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc2['CustomerTransaction']['jewelry_type']; ?>
										</td>
										<td class="w3-center">
											<?php echo $valueForAuc2['TransactionInterestPayment'][ count($valueForAuc2['TransactionInterestPayment']) -1 ]['pt_number']; ?>
										</td>
										<td>
											<a href="/customer_transactions/transaction/<?php echo $valueForAuc2['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
										</td>
									</tr>
									
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane fade" id="for_auction_book3">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<thead>
								<tr>
									<th>Image</th>
									<th>Customer</th>
									<th>Last Payment</th>
									<th>Date Diff</th>
									<th>Item Type</th>
									<th>Jewelty Type</th>
									<th>PT No.</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								 <?php foreach($forauction_book3 as $keyForAuc3 => $valueForAuc3): ?>

									<tr>
										<td class="w3-center">
				
											<?php if(trim($valueForAuc3['Customer']['image_name']) != '') { ?>
								
												<img src="<?php echo $valueForAuc3['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valueForAuc3['Customer']['image_name']) == '' && $valueForAuc3['Customer']['gender'] == 'male') { ?>
												
												<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
											 
											 <?php if(trim($valueForAuc3['Customer']['image_name']) == '' && $valueForAuc3['Customer']['gender'] == 'female') { ?>
												
												<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
											 
											 <?php } ?>
												 
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc3['Customer']['first_name'].' '.$valueForAuc3['Customer']['middle_name'].' ' .$valueForAuc3['Customer']['last_name']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc3['TransactionInterestPayment'][count($valueForAuc3['TransactionInterestPayment']) -1 ]['payment_starting_date']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc3['TransactionInterestPayment'][count($valueForAuc3['TransactionInterestPayment']) -1 ]['date_diff']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc3['CustomerTransaction']['item_type']; ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valueForAuc3['CustomerTransaction']['jewelry_type']; ?>
										</td>
										<td class="w3-center">
											<?php echo $valueForAuc3['TransactionInterestPayment'][ count($valueForAuc3['TransactionInterestPayment']) -1 ]['pt_number']; ?>
										</td>
										<td>
											<a href="/customer_transactions/transaction/<?php echo $valueForAuc3['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
										</td>
									</tr>
									
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
			
			<div class="tab-pane fade" id="menu3">
				<div class="w3-margin-top w3-border-red w3-leftbar">
					<p class="w3-border-bottom"> &emsp; Transaction here are no PT Number</p>
				</div>
				<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
							<th>Image</th>
							<th>Customer</th>
							<th>Date Pawn</th>
							<th>Book</th>
							<th>Item Type</th>
							<th>Jewelty Type</th>
							<th>PT No.</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						 <?php foreach($noPtNumbers as $keyNumber => $valueNumber): ?>
						  
							<tr>
								<td class="w3-center">
									<?php if(trim($valueNumber['Customer']['image_name']) != '') { ?>
						
										<img src="<?php echo $valueNumber['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueNumber['Customer']['image_name']) == '' && $valueNumber['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueNumber['Customer']['image_name']) == '' && $valueNumber['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
								</td>
								<td class="<?php echo $textColor; ?> ">
									<?php echo $valueNumber['Customer']['first_name'].' '.$valueNumber['Customer']['middle_name'].' ' .$valueNumber['Customer']['last_name']; ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo date('M j, Y', strtotime($valueNumber['CustomerTransaction']['sangla_date'])); ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo $valueNumber['CustomerTransaction']['book_id']; ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo $valueNumber['CustomerTransaction']['item_type']; ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo $valueNumber['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<?php echo $valueNumber['TransactionInterestPayment'][ count($valueNumber['TransactionInterestPayment']) -1 ]['pt_number']; ?>
								</td>
								<td>
									<a href="/customer_transactions/transaction/<?php echo $valueNumber['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
								</td>
							</tr>
							
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
		</div>
		<p style="font-size:24px;"><b>Total Granted Amount:</b> <span style="font-weight:bold; color:red;"><?php echo $granted_total; ?></span><p>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

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
	
	$('table#dataTablesUsers').DataTable({
		responsive: true,
		"pageLength": 25
	});

});
</script>