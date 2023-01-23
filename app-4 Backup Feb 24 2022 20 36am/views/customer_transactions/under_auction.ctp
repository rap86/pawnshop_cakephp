<?php 

	foreach($datas as $key => $value)
	{
		$granted_total += $value['CustomerTransaction']['net_amount_duplicate'];
		
		if($value['TransactionInterestPayment']['status'] == 'unpaid')
		{
			$dueDate_b1 	= date($value['TransactionInterestPayment']['payment_starting_date']);
			$dateNow_b1 	= date('Y-m-d');
			$startDate_b1   = new DateTime($dueDate_b1); 
			$endDate_b1  	= new DateTime($dateNow_b1); 
			$diffDate_b1	= $startDate_b1->diff($endDate_b1); 
			
			$this->yearPayment1     = $diffDate_b1->format('%y'); 
			$this->monthPayment1    = $diffDate_b1->format('%m'); 
			$this->dayPayment1      = $diffDate_b1->format('%d');
			
			$value['TransactionInterestPayment']['date_diff'] = 'Y'.$this->yearPayment1.'-'.'M'.$this->monthPayment1.'-'.'D'.$this->dayPayment1;
		}
				
		if($value['CustomerTransaction']['partial_status'] == 'semiua')
		{
			$semiua[ $value['CustomerTransaction']['id'] ] = $value;
			
		} else {
		
			if($value['CustomerTransaction']['book_id'] == 1)
			{
				$pawn_book1[ $value['CustomerTransaction']['id'] ] = $value;
				
			} elseif($value['CustomerTransaction']['book_id'] == 2)
			{
				$pawn_book2[ $value['CustomerTransaction']['id'] ] = $value;
				
			} else {
								
				$pawn_book3[ $value['CustomerTransaction']['id'] ] = $value;
			}
		}
	}
?>
<style>
#myTab li a {background-color:#ccccb3; border-top-left-radius:2px; border-top-right-radius:2px; }
#myTab li.active a {border-bottom-color: transparent;background-color:white; }
</style>

<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-pale-green w3-padding w3-border w3-border-green">
		Under Auction |
		<a href="/print/print/print_book/1/ua" target="_blank" class="btn btn-success">Print Book 1</a> | 
		<a href="/print/print/print_book/2/ua" target="_blank" class="btn btn-success">Print Book 2</a> |
		<a href="/print/print/print_book/3/ua" target="_blank" class="btn btn-success">Print Book 3</a>
		</h3>
		<!-- Nav tabs -->
		<div class="w3-margin-top">
			<p class="w3-border-bottom">Note: All Items here are good to go. FOR <span class="w3-badge w3-blue w3-xlarge">S</span> <span class="w3-badge w3-orange w3-xlarge">A</span> <span class="w3-badge w3-green w3-xlarge">L</span> <span class="w3-badge w3-red w3-xlarge">E</span> </p>
		</div>
		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a href="#book1" data-toggle="tab">Book 1 <span class="w3-badge w3-red"><?php echo count($pawn_book1); ?></a>
			</li>
			<li>
				<a href="#book2" data-toggle="tab">Book 2 <span class="w3-badge w3-red"><?php echo count($pawn_book2); ?></a>
			</li>
			<li>
				<a href="#book3" data-toggle="tab">Book 3 <span class="w3-badge w3-red"><?php echo count($pawn_book3); ?></a>
			</li>
			<li>
				<a href="#book4" data-toggle="tab">Partial Auctioned <span class="w3-badge w3-red"><?php echo count($semiua); ?></a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content my-tab">
			<div class="tab-pane fade in active" id="book1">
				<br />
				<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
					<?php echo $this->element('pawn_index', array('pawn_book1' => $pawn_book1)); ?>
				</table>
			</div>
			
			<div class="tab-pane fade" id="book2">
				<br />
				<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
					<?php echo $this->element('pawn_index', array('pawn_book1' => $pawn_book2)); ?>
				</table>
			</div>
			
			<div class="tab-pane fade" id="book3">
				<br />
				<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
					<?php echo $this->element('pawn_index', array('pawn_book1' => $pawn_book3)); ?>
				</table>
			</div>
			
			<div class="tab-pane fade" id="book4">
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
							<th style="width:50px;">&emsp;&emsp;Action&emsp;</th>
						</tr>
					</thead>
					<tbody>
						  <?php foreach($semiua as $keySemi => $valueSemi): ?>

							<tr>
								<td class="w3-center">
								
									<?php if(trim($valueSemi['Customer']['image_name']) != '') { ?>
							
										<img src="<?php echo $valueSemi['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueSemi['Customer']['image_name']) == '' && $valueSemi['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueSemi['Customer']['image_name']) == '' && $valueSemi['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
								</td>
								<td>
									<?php echo $valueSemi['Customer']['first_name'].' '.$valueSemi['Customer']['middle_name'].' ' .$valueSemi['Customer']['last_name']; ?>
								</td>
								<td>
									<?php echo $valueSemi['TransactionInterestPayment']['payment_starting_date']; ?>
								</td>
								<td>
									<?php echo $valueSemi['TransactionInterestPayment']['date_diff']; ?>
								</td>
								<td>
									<?php echo $valueSemi['CustomerTransaction']['item_type']; ?>
								</td>
								<td>
									<?php echo $valueSemi['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<?php echo $valueSemi['TransactionInterestPayment']['pt_number']; ?>
								</td>
								<td>
									<a class="w3-button w3-amber w3-round-small" data-toggle="modal" data-target="#myModalAuctionedItem" data-customer-transction-id="<?php echo $valueSemi['CustomerTransaction']['id']; ?>" id="buttonDone">Done</a>
									<a href="/customer_transactions/transaction/<?php echo $valueSemi['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View</a>
								</td>
							</tr>
							
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
		</div>
		<p style="font-size:24px;"><b>Total Granted Amount:</b> <span style="font-weight:bold; color:red;"><?php echo $granted_total;  ?></span><p>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->



<!-- Modal -->
<div class="modal fade" id="myModalAuctionedItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" action="/transaction_sold_items/auctioned_status">
			<div class="modal-content">
				
				 <input name="data[TransactionSoldItem][customer_transaction_id]" value="<?php echo $data['CustomerTransaction']['id']; ?>" type="hidden" id="inputCustomerTransactionId">
				 <input name="data[TransactionSoldItem][status]" value="auctioned" type="hidden">
			  
				<div class="modal-header w3-amber">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">SET STATUS AS AUCTIONED </h4>
				</div>
				<div class="modal-body">
					
				  <div class="form-horizontal">
						<p>Are you sure?</p>
				   </div>
				  
				</div>
				<div class="modal-footer">
					<button type="submit" class="w3-button w3-border w3-dark-gray w3-round-small pull-left" id="buttonYesstatus" style="display:none;">YES</button>
					<div class="w3-button w3-border w3-dark-gray w3-round-small pull-left" id="buttonConfirmationYesstatus">YES</div>
					<button type="button" class="w3-button w3-border w3-dark-gray w3-round-small" data-dismiss="modal">NO</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</form>
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$('a#buttonDone').click(function() {
		$('#inputCustomerTransactionId').val($(this).attr('data-customer-transction-id'));
	});
	
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
	
	$('div#buttonConfirmationYesstatus').click(function() {
	
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
				
				$('#buttonYesstatus').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
		});	

	});
	
});
</script>