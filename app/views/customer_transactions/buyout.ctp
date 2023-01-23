<?php 

	foreach($datas as $key => $value)
	{
		$granted_total += $value['CustomerTransaction']['net_amount_duplicate'];
		
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
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-gray w3-padding w3-border w3-border-gray">Buy these items</h3>
		<!-- Nav tabs -->
		<div class="w3-margin-top">
			<p class="w3-border-bottom"><span class="w3-badge w3-pink w3-xlarge">F</span><span class="w3-badge w3-yellow w3-xlarge">O</span><span class="w3-badge w3-gray w3-xlarge">R</span> &emsp; <span class="w3-badge w3-blue w3-xlarge">S</span> <span class="w3-badge w3-orange w3-xlarge">A</span> <span class="w3-badge w3-green w3-xlarge">L</span> <span class="w3-badge w3-red w3-xlarge">E</span> </p>
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
						  <?php foreach($pawn_book1 as $keyua1 => $valueua1): ?>
						  
							<tr>
								<td class="w3-center">
								
									<?php if(trim($valueua1['Customer']['image_name']) != '') { ?>
							
										<img src="<?php echo $valueua1['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueua1['Customer']['image_name']) == '' && $valueua1['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueua1['Customer']['image_name']) == '' && $valueua1['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
								</td>
								<td>
									<?php echo $valueua1['Customer']['first_name'].' '.$valueua1['Customer']['middle_name'].' ' .$valueua1['Customer']['last_name']; ?>
								</td>
								<td>
									<?php echo date('M j, Y', strtotime($valueua1['CustomerTransaction']['sangla_date'])); ?>
								</td>
								<td>
									<?php echo $valueua1['CustomerTransaction']['book_id']; ?>
								</td>
								<td>
									<?php echo $valueua1['CustomerTransaction']['item_type']; ?>
								</td>
								<td>
									<?php echo $valueua1['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<?php echo $valueua1['TransactionInterestPayment']['pt_number']; ?>
								</td>
								<td>
									<a data-net-amount-duplicate="<?php echo $valueua1['CustomerTransaction']['net_amount_duplicate']; ?>" data-customer-transactionid="<?php echo $valueua1['CustomerTransaction']['id']; ?>" data-forbir="<?php echo $valueua1['CustomerTransaction']['for_bir']; ?>" data-bookid="<?php echo $valueua1['CustomerTransaction']['book_id']; ?>" data-ptnumber="<?php echo $valueua1['TransactionInterestPayment']['pt_number']; ?>" data-auction-price="<?php echo $valueua1['TransactionUnderAuction']['auction_price'];?>" class="w3-button w3-teal w3-round-small" data-toggle="modal" data-target="#myModalBuyItemx" id="buybutton">Buy</a>
									<a target="_blank" href="/customer_transactions/transaction/<?php echo $valueua1['CustomerTransaction']['id']; ?>" class="w3-button w3-dark-gray w3-round-small">View</a>
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
						  <?php foreach($pawn_book2 as $keyua2 => $valueua2): ?>

							<tr>
								<td class="w3-center">
								
									<?php if(trim($valueua2['Customer']['image_name']) != '') { ?>
							
										<img src="<?php echo $valueua2['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueua2['Customer']['image_name']) == '' && $valueua2['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueua2['Customer']['image_name']) == '' && $valueua2['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
								</td>
								<td>
									<?php echo $valueua2['Customer']['first_name'].' '.$valueua2['Customer']['middle_name'].' ' .$valueua2['Customer']['last_name']; ?>
								</td>
								<td>
									<?php echo date('M j, Y', strtotime($valueua2['CustomerTransaction']['sangla_date'])); ?>
								</td>
								<td>
									<?php echo $valueua2['CustomerTransaction']['book_id']; ?>
								</td>
								<td>
									<?php echo $valueua2['CustomerTransaction']['item_type']; ?>
								</td>
								<td>
									<?php echo $valueua2['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<?php echo $valueua2['TransactionInterestPayment']['pt_number']; ?>
								</td>
								<td>
									<a data-net-amount-duplicate="<?php echo $valueua2['CustomerTransaction']['net_amount_duplicate']; ?>" data-customer-transactionid="<?php echo $valueua2['CustomerTransaction']['id']; ?>" data-forbir="<?php echo $valueua2['CustomerTransaction']['for_bir']; ?>" data-bookid="<?php echo $valueua2['CustomerTransaction']['book_id']; ?>" data-ptnumber="<?php echo $valueua2['TransactionInterestPayment']['pt_number']; ?>" data-auction-price="<?php echo $valueua2['TransactionUnderAuction']['auction_price'];?>" class="w3-button w3-teal w3-round-small" data-toggle="modal" data-target="#myModalBuyItemx" id="buybutton">Buy</a>
									<a target="_blank" href="/customer_transactions/transaction/<?php echo $valueua2['CustomerTransaction']['id']; ?>" class="w3-button w3-dark-gray w3-round-small">View</a>
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
						  <?php foreach($pawn_book3 as $keyua3 => $valueua3): ?>
						  
							<tr>
								<td class="w3-center">
								
									<?php if(trim($valueua3['Customer']['image_name']) != '') { ?>
							
										<img src="<?php echo $valueua3['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueua3['Customer']['image_name']) == '' && $valueua3['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valueua3['Customer']['image_name']) == '' && $valueua3['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
								</td>
								<td>
									<?php echo $valueua3['Customer']['first_name'].' '.$valueua3['Customer']['middle_name'].' ' .$valueua3['Customer']['last_name']; ?>
								</td>
								<td>
									<?php echo date('M j, Y', strtotime($valueua3['CustomerTransaction']['sangla_date'])); ?>
								</td>
								<td>
									<?php echo $valueua3['CustomerTransaction']['book_id']; ?>
								</td>
								<td>
									<?php echo $valueua3['CustomerTransaction']['item_type']; ?>
								</td>
								<td>
									<?php echo $valueua3['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<?php echo $valueua3['TransactionInterestPayment']['pt_number']; ?>
								</td>
								<td>
									<a data-net-amount-duplicate="<?php echo $valueua3['CustomerTransaction']['net_amount_duplicate']; ?>" data-customer-transactionid="<?php echo $valueua3['CustomerTransaction']['id']; ?>" data-forbir="<?php echo $valueua3['CustomerTransaction']['for_bir']; ?>" data-bookid="<?php echo $valueua3['CustomerTransaction']['book_id']; ?>" data-ptnumber="<?php echo $valueua3['TransactionInterestPayment']['pt_number']; ?>" data-auction-price="<?php echo $valueua3['TransactionUnderAuction']['auction_price'];?>" class="w3-button w3-teal w3-round-small" data-toggle="modal" data-target="#myModalBuyItemx" id="buybutton">Buy</a>
									<a target="_blank" href="/customer_transactions/transaction/<?php echo $valueua3['CustomerTransaction']['id']; ?>" class="w3-button w3-dark-gray w3-round-small">View</a>
								</td>
							</tr>
							
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
			<div class="tab-pane fade" id="book4">
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
						  <?php foreach($semiua as $keysemi => $valuesemi): ?>

							 <?php auctionedStatus($valuesemi, $customer_id); ?>
							 
							<tr>
								<td class="w3-center">
								
									<?php if(trim($valuesemi['Customer']['image_name']) != '') { ?>
							
										<img src="<?php echo $valuesemi['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valuesemi['Customer']['image_name']) == '' && $valuesemi['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($valuesemi['Customer']['image_name']) == '' && $valuesemi['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
								</td>
								<td>
									<?php echo $valuesemi['Customer']['first_name'].' '.$valuesemi['Customer']['middle_name'].' ' .$valuesemi['Customer']['last_name']; ?>
								</td>
								<td>
									<?php echo date('M j, Y', strtotime($valuesemi['CustomerTransaction']['sangla_date'])); ?>
								</td>
								<td>
									<?php echo $valuesemi['CustomerTransaction']['book_id']; ?>
								</td>
								<td>
									<?php echo $valuesemi['CustomerTransaction']['item_type']; ?>
								</td>
								<td>
									<?php echo $valuesemi['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<?php echo $valuesemi['TransactionInterestPayment']['pt_number']; ?>
								</td>
								<td>
									<a data-partial-capital="<?php echo $valuesemi['CustomerTransaction']['partial_capital']; ?>" data-net-amount-duplicate="<?php echo $valuesemi['CustomerTransaction']['net_amount_duplicate']; ?>" data-customer-transactionid="<?php echo $valuesemi['CustomerTransaction']['id']; ?>" data-forbir="<?php echo $valuesemi['CustomerTransaction']['for_bir']; ?>" data-bookid="<?php echo $valuesemi['CustomerTransaction']['book_id']; ?>" data-ptnumber="<?php echo $valuesemi['TransactionInterestPayment']['pt_number']; ?>" data-auction-price="<?php echo $valuesemi['TransactionUnderAuction']['auction_price'];?>" class="w3-button w3-teal w3-round-small" data-toggle="modal" data-target="#myModalBuyItemx" id="buybutton">Buy</a>
									<!--a class="w3-button w3-amber w3-round-small" data-toggle="modal" data-target="#myModalAuctionedItem<?php echo $valuesemi['CustomerTransaction']['id']; ?>">Done</a-->
									<a target="_blank" href="/customer_transactions/transaction/<?php echo $valuesemi['CustomerTransaction']['id']; ?>" class="w3-button w3-dark-gray w3-round-small">View</a>
								</td>
							</tr>
							
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
		</div>
		<p style="font-size:24px;"><b>Total Granted Amount:</b> <span style="font-weight:bold; color:red;"><?php echo  number_format($granted_total, 0);  ?></span><p>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->




<!-- Modal -->
<div class="modal fade" id="myModalBuyItemx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" action="/transaction_sold_items/add">
			<div class="modal-content">

				 <input name="data[TransactionSoldItem][book_id]" id="tbook_id" type="hidden">
				 <input name="data[TransactionSoldItem][for_bir]" id="tforbir" type="hidden">
				 <input name="data[TransactionSoldItem][customer_id]" value="<?php echo $customer_id; ?>" type="hidden">
				 <input name="data[TransactionSoldItem][customer_transaction_id]" id="tcustomer_transaction_id" type="hidden">
				 <input name="data[TransactionSoldItem][pawned_net_amount_duplicate]" id="tnet_amount_duplicate" type="hidden">
				 <input name="data[TransactionSoldItem][partial_capital]" id="tpartial_capital" type="hidden">
			
				 <input name="data[TransactionSoldItem][status]" value="auctioned" type="hidden">
				 <input name="data[TransactionSoldItem][date_sold]" value="<?php echo date('Y-m-d'); ?>" type="hidden">
				 <input name="data[TransactionSoldItem][time_sold]" value="<?php echo date('H:i:s'); ?>" type="hidden">
				  
				<div class="modal-header w3-gray">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">BUY THIS ITEM</h4>
				</div>
				<div class="modal-body">
					
				  <div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-sm-4">Or Number:</label>
							<div class="col-sm-5">          
								<input name="data[TransactionSoldItem][or_number]" class="w3-input w3-border w3-light-grey" id="sold_price_or_number" style="font-size:30px;" autocomplete="off">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">PT No.:</label>
							<div class="col-sm-5">          
								<input name="data[TransactionSoldItem][pt_number]" class="w3-input w3-border w3-light-grey" id="buy_ptnumber" style="font-size:30px;" readonly="readonly">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Auction Price:</label>
							<div class="col-sm-5">          
								<input name="data[TransactionSoldItem][auction_price]" class="w3-input w3-border w3-light-grey" id="sold_auction_price"  value="<?php echo $data['TransactionUnderAuction']['auction_price']; ?>" style="font-size:30px;" autocomplete="off" readonly="readonly">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Sold Price:</label>
							<div class="col-sm-5">          
								<input name="data[TransactionSoldItem][sold_price]" style="font-size:30px;" id="sold_price_amount" autocomplete="off" class="w3-input w3-border w3-light-grey">
							</div>
					   </div>
						<div class="form-group">
							<label class="control-label col-sm-4">Discount:</label>
							<div class="col-sm-5">          
								<input name="data[TransactionSoldItem][discount]" style="font-size:30px;" id="sold_price_discount" autocomplete="off" class="w3-input w3-border w3-light-grey" readonly="readonly">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Details:</label>
							<div class="col-sm-5">          
								<textarea name="data[TransactionSoldItem][details]" autocomplete="off" rows="5" class="w3-input w3-border w3-light-grey" ></textarea>
							</div>
					   </div>
				   </div>
				  
				</div>
				<div class="modal-footer">
					<button type="submit" class="w3-button w3-border w3-dark-gray w3-round-small pull-left" id="buttonYes" style="display:none;">YES</button>
					<div class="w3-button w3-border w3-dark-gray w3-round-small pull-left" id="buttonConfirmationYes">YES</div>
					<button type="button" class="w3-button w3-border w3-dark-gray w3-round-small" data-dismiss="modal">NO</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</form>
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php function auctionedStatus($data, $customer_id) { ?>

	<!-- Modal -->
	<div class="modal fade" id="myModalAuctionedItem<?php echo $data['CustomerTransaction']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog">
			<form method="post" action="/transaction_sold_items/auctioned_status">
				<div class="modal-content">
					
					 <input name="data[TransactionSoldItem][customer_transaction_id]" value="<?php echo $data['CustomerTransaction']['id']; ?>" type="hidden">
					 <input name="data[TransactionSoldItem][status]" value="auctioned" type="hidden">
				  
					<div class="modal-header w3-amber">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">SET STATUS AS AUCTION</h4>
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
<?php } ?>

<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$('a#buybutton').click(function() {

		$('input#buy_ptnumber').val($(this).attr("data-ptnumber"));
		$('input#sold_auction_price').val( $(this).attr("data-auction-price"));
		$('input#tbook_id').val( $(this).attr("data-bookid"));
		$('input#tforbir').val( $(this).attr("data-forbir"));
		$('input#tcustomer_transaction_id').val( $(this).attr("data-customer-transactionid"));
		$('input#tnet_amount_duplicate').val( $(this).attr("data-net-amount-duplicate"));
		$('input#tpartial_capital').val( $(this).attr("data-partial-capital"));

	});
	
	$('img').click(function() {
		
		Swal.fire({
		  title: 'Image',
		  imageUrl: $(this).attr('src'),
		  imageWidth: 400,
		  imageHeight: 200,
		  imageAlt: 'Image',
		  animation: false
		});
	});
	
	$('table#dataTablesUsers').DataTable({
		responsive: true,
		"pageLength": 25
	});
	
	// only numbers allowed
	$('input#sold_price_amount').on('keyup blur', function(event) {
		this.value = this.value.replace(/[^0-9]/g,''); 
	});
	
	$('input#sold_price_amount').keyup(function() {

		var auction_price = $(this).parents('div.form-group').siblings('div').find('div input#sold_auction_price').val();
		var sold_price     = Number($(this).val());
		var discount_price = discount_price = auction_price - sold_price;
		
		if(sold_price > auction_price)
		{
		
			$(this).parents('div.form-group').siblings('div').find('div input#sold_price_discount').val(0);
			
		}  else {
			
			$(this).parents('div.form-group').siblings('div').find('div input#sold_price_discount').val(discount_price);
		
		}
		
	})
	
	$('div#buttonConfirmationYes').click(function() {
		
		var amount   	= $(this).parent('div').siblings('div').find('div div div input#sold_price_amount').val();
		var or_number   = $(this).parent('div').siblings('div').find('div div div input#sold_price_or_number').val();
		
		if(true)
		{
			Swal.fire({
			  type: 'error',
			  title: 'OR Empty!',
			  text: 'OR Number must unique!'
			})
		
		} 
		
		$.ajax({
			async: false,
			type: 'POST',
			url: '/customer_transactions/sold_checkif_orexist',
			data: {
				'data[TransactionSoldItem][or_number]': or_number
			},
			dataType: 'json',
			success: function(data) {
				// console.log(data);
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
					
				} else if($.trim(amount) == '')
				{
					Swal.fire({
					  type: 'error',
					  title: 'Oops...',
					  text: 'Sold Price must not empty!'
					});
					
				} else if(amount < 1)
				{
					Swal.fire({
					  type: 'error',
					  title: 'Oops...',
					  text: 'Less than 1 is not valid!'
					});
					
				} else 
				{
					Swal.fire({
						  title: 'Amount:'+ amount + '',
						  text: "You won't be able to revert this!",
						  type: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Yes, save it!'
						}).then((result) => {
							  if (result.value) {
								
								$('#buttonYes').trigger('click');
								
							  } else {
							  
								location.reload();
							  
							  }
						});	
				}
			}
			
		});

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
	
	// only numbers allowed
	$('input#sold_price_amount').on('keyup blur', function(event) {
		this.value = this.value.replace(/[^0-9]/g,''); 
	});
	
});
</script>