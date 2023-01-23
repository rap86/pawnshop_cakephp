<style>
#myTab li a {background-color:#ccccb3; border-top-left-radius:2px; border-top-right-radius:2px; }
#myTab li.active a {border-bottom-color: transparent;background-color:white; }
</style>

<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-pale-blue w3-padding w3-border w3-border-blue">Redeemed</h3>
		<!-- Nav tabs -->
		<!--ul class="nav nav-tabs" id="myTab">
			<li>
				<a href="/customer_transactions/pawn">Pawned</a>
			</li>
			<li>
				<a href="/customer_transactions/under_auction">Under Auction</a>
			</li>
			<li class="active">
				<a href="#" data-toggle="tab">Redeemed</a>
			</li>
			<li>
				<a href="/customer_transactions/auctioned">Auctioned</a>
			</li>
		</ul-->
	</div>
	<!-- Tab panes -->
	<div class="col-lg-12">
		<?php echo $this->Form->create('CustomerTransaction', array('action'=>'redeemed')); ?>
	
		<div class="w3-row-padding w3-light-grey w3-padding w3-border">
		  <div class="w3-third">
			<input class="w3-input w3-border" type="text" name="data[CustomerTransaction][date_from]" value="<?php echo $date['date_from']?>" placeholder="From" id="dateFrom">
		  </div>
		  <div class="w3-third">
			<input class="w3-input w3-border" type="text" name="data[CustomerTransaction][date_to]" value="<?php echo $date['date_to']; ?>" placeholder="To" id="dateTo">
		  </div>
		  <div class="w3-third">
			<button class="w3-button w3-dark-gray w3-block w3-round-small">LOAD</button>
		  </div>
		</div>
		
		<?php echo $this->Form->end(); ?>
	</div>
	
	<!-- Tab panes -->
	<div class="col-lg-12">
		<div class="tab-content my-tab">
			<div class="tab-pane fade in active" id="menu1">
				<div class="w3-margin-top">
					<p class="w3-border-bottom">Click View Details</p>
				</div>
				<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
							<th>Image</th>
							<th>Customer</th>
							<th>Date Redeemed</th>
							<th>Book</th>
							<th>Item Type</th>
							<th>Jewelty Type</th>
							<th>Image</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						  <?php foreach($datas as $key => $value): ?>
						  
							<tr>
								<td class="w3-center">
									<?php if(trim($value['Customer']['image_name']) != '') { ?>
							
										<img src="<?php echo $value['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($value['Customer']['image_name']) == '' && $value['Customer']['gender'] == 'male') { ?>
										
										<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
									 
									 <?php if(trim($value['Customer']['image_name']) == '' && $value['Customer']['gender'] == 'female') { ?>
										
										<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
									 
									 <?php } ?>
								</td>
								<td>
									<?php echo $value['Customer']['first_name'].' '.$value['Customer']['middle_name'].' ' .$value['Customer']['last_name']; ?>
								</td>
								<td>
									<?php echo date('M j, Y g:i:A', strtotime($value['TransactionRedeemItem']['date_redeemed'].' '.$value['TransactionRedeemItem']['time_redeemed'])); ?>
								</td>
								<td>
									<?php echo $value['CustomerTransaction']['book_id']; ?>
								</td>
								<td>
									<?php echo $value['CustomerTransaction']['item_type']; ?>
								</td>
								<td>
									<?php echo $value['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td class="w3-center">
									<img src="<?php echo $value['CustomerTransaction']['image_location']; ?>" height="30px" width="30px">
								</td>
								<td>
									<a href="/customer_transactions/transaction/<?php echo $value['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View Details</a>
								</td>
							</tr>
							
						<?php endforeach; ?>
					</tbody>
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
	
	$('table#dataTablesUsers').DataTable({
		responsive: true,
		"pageLength": 25
	});

});
</script>