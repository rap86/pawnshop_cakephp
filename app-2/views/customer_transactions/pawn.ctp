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
  
	/*
	 $dateNgSangla   = date($value['CustomerTransaction']['sangla_date']); 
	 $dateNgayon     = date('Y-m-d'); 
	 $sanglaDate     = new DateTime($dateNgSangla); 
	 $ngayonNaDate   = new DateTime($dateNgayon); 
	 $diff 			 = $sanglaDate->diff($ngayonNaDate); 
	
	 $this->year     = $diff->format('%y'); 
	 $this->month    = $diff->format('%m'); 
	 $this->day      = $diff->format('%d');
	 */
	 
	$granted_total = $granted_total + $value['CustomerTransaction']['net_amount'];
	 
	 if(isset($value['TransactionInterestPayment']) && !empty($value['TransactionInterestPayment']))
	 {
		foreach($value['TransactionInterestPayment'] as $keyInterest => $insterestValue)
		{

			if($insterestValue['status'] == 'unpaid') 
			{
				
				$dueDate 		= date($insterestValue['payment_due_date']);
				$dateNow 		= date('Y-m-d');
				$startDate      = new DateTime($dueDate); 
				$endDate   		= new DateTime($dateNow); 
				$diffDate		= $startDate->diff($endDate); 
				
				$this->yearPayment     = $diffDate->format('%y'); 
				$this->monthPayment    = $diffDate->format('%m'); 
				$this->dayPayment      = $diffDate->format('%d');
				
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
				<a href="#menu1" data-toggle="tab">Pawned</a>
			</li>
			<li>
				<a href="#menu2" data-toggle="tab">Ready for Auction <span class="w3-badge w3-red"><?php echo count($for_auction); ?></span></a>
			</li>
			<li>
				<a href="#menu3" data-toggle="tab">NO PT Number</a>
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
									<th>Date Pawn</th>
									<th>Book</th>
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
											<?php echo date('M j, Y', strtotime($valuePawn1['CustomerTransaction']['sangla_date'])); ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn1['CustomerTransaction']['book_id']; ?>
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
									<th>Date Pawn</th>
									<th>Book</th>
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
											<?php echo date('M j, Y', strtotime($valuePawn2['CustomerTransaction']['sangla_date'])); ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn2['CustomerTransaction']['book_id']; ?>
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
									<th>Date Pawn</th>
									<th>Book</th>
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
											<?php echo date('M j, Y', strtotime($valuePawn3['CustomerTransaction']['sangla_date'])); ?>
										</td>
										<td class="<?php echo $textColor; ?>">
											<?php echo $valuePawn3['CustomerTransaction']['book_id']; ?>
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
					<p class="w3-border-bottom"> &emsp; Transaction here are greater than or equal Four (4) Months </p>
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
						 <?php foreach($for_auction as $keyAuction => $valueAuction): ?>
						  
							<tr>
								<td class="w3-center">
								
									<?php if(trim($valueAuction['Customer']['image_name']) != '') { ?>
						
										<img src="<?php echo $valueAuction['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueAuction['Customer']['image_name']) == '' && $valueAuction['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueAuction['Customer']['image_name']) == '' && $valueAuction['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
										 
								</td>
								<td class="<?php echo $textColor; ?> ">
									<?php echo $valueAuction['Customer']['first_name'].' '.$valueAuction['Customer']['middle_name'].' ' .$valueAuction['Customer']['last_name']; ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo date('M j, Y', strtotime($valueAuction['CustomerTransaction']['sangla_date'])); ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo $valueAuction['CustomerTransaction']['book_id']; ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo $valueAuction['CustomerTransaction']['item_type']; ?>
								</td>
								<td class="<?php echo $textColor; ?>">
									<?php echo $valueAuction['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<?php echo $valueAuction['TransactionInterestPayment'][ count($valueAuction['TransactionInterestPayment']) -1 ]['pt_number']; ?>
								</td>
								<td>
									<a href="/customer_transactions/transaction/<?php echo $valueAuction['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
								</td>
							</tr>
							
						<?php endforeach; ?>
					</tbody>
				</table>
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