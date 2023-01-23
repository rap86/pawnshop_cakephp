<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-padding w3-border w3-border-gray w3-margin-bottom">
			<?php 
				echo (empty($payment_details) == true)? '<span class="w3-text-red">PT NUMBER NOT FOUND!</span>': 'PT NUMBER DETAILS'; 
			?>
		</h3>
		
		<?php foreach($payment_details as $keyPawn1 => $valuePawn1): ?>

			<?php 
			
				$dueDate 		= date($valuePawn1['TransactionInterestPayment']['payment_starting_date']);
				$dateNow 		= date('Y-m-d');
				$startDate      = new DateTime($dueDate); 
				$endDate   		= new DateTime($dateNow); 
				$diffDate		= $startDate->diff($endDate); 
				
				$this->yearPayment     = $diffDate->format('%y'); 
				$this->monthPayment    = $diffDate->format('%m'); 
				$this->dayPayment      = $diffDate->format('%d');
				
				$valuePawn1['TransactionInterestPayment']['date_diff'] = 'Y'.$this->yearPayment.'-'.'M'.$this->monthPayment.'-'.'D'.$this->dayPayment;
				
				if($valuePawn1['TransactionInterestPayment']['status'] == 'unpaid')
				{
					
					$textColor = 'w3-text-red';
					
				} else {
					
					$textColor = '';
					
				}
				
				
				if($valuePawn1['CustomerTransaction']['status'] == 'pawned')
				{
					
					$borderLeftColor = 'w3-border-red';
					
				} elseif($valuePawn1['CustomerTransaction']['status'] == 'ua')
				{
					
					$borderLeftColor = 'w3-border-green';
					
				} elseif($valuePawn1['CustomerTransaction']['status'] == 'redeemed')
				{
					
					$borderLeftColor = 'w3-border-blue';
					
				} elseif($valuePawn1['CustomerTransaction']['status'] == 'auctioned')
				{
					
					$borderLeftColor = 'w3-border-amber';
					
				} else {
					
					$borderLeftColor = 'w3-border-gray';
					
				}
			
			?>
		<div class="w3-container w3-border w3-leftbar <?php echo $borderLeftColor; ?> w3-card-4">
			<div class="table-responsive">
				<table class="table table-bordered w3-margin-top w3-padding-right">
				
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
							<td>
								<?php echo $valuePawn1['Customer']['first_name'].' '.$valuePawn1['Customer']['middle_name'].' ' .$valuePawn1['Customer']['last_name']; ?>
							</td>
							<td>
								<?php echo $valuePawn1['TransactionInterestPayment']['payment_starting_date']; ?>
							</td>
							<td>
								<?php echo $valuePawn1['TransactionInterestPayment']['date_diff']; ?>
							</td>
							<td>
								<?php echo $valuePawn1['CustomerTransaction']['item_type']; ?>
							</td>
							<td>
								<?php echo $valuePawn1['CustomerTransaction']['jewelry_type']; ?>
							</td>
							<td class="w3-center <?php echo $textColor; ?>" style="font-weight:bold;">
								<?php echo $valuePawn1['TransactionInterestPayment']['pt_number']; ?>
							</td>
							<td>
								<a href="/customer_transactions/transaction/<?php echo $valuePawn1['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
							</td>
						</tr>
						
					<?php endforeach; ?>
				
				</table>
			</div>
		</div>
	</div>
</div>

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
	
	$('#dataTablescustomer').DataTable({
		responsive: true,
		"pageLength": 25
	});
	
});
</script>