<?php echo $this->element('header_background_color'); ?>

<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4><?php echo (empty($payment_details) == true)? '<span class="w3-text-red">PT NUMBER NOT FOUND</span>': 'PT NUMBER DETAILS'; ?></h4>
			</div>
			<div class="panel-body">
				<table style="width:100%;" class="table table-striped table-bordered table-hover" id="dataTablescustomer">
					<thead>
						<tr>
							<th>PT No.</th>
							<th>Image</th>
							<th>Due Amount</th>
							<th>Due %</th>
							<th>Due Date</th>
							<th>Item</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($payment_details as $key => $value): ?>

						<tr>
							<td><?php echo $value['TransactionInterestPayment']['pt_number']; ?></td>
							<td style="text-align:center; cursor:pointer;">
								<img src="<?php echo $value['CustomerTransaction']['image_location']; ?>" width="30px;" height="30px;" style="border-radius:2px;">
							</td>
							<td><?php echo $value['TransactionInterestPayment']['payment_due_amount']; ?></td>
							<td><?php echo $value['TransactionInterestPayment']['payment_due_interest']; ?></td>
							<td><?php echo $value['TransactionInterestPayment']['payment_due_date']; ?></td>
							<td><?php echo $value['CustomerTransaction']['item_type']; ?></td>
							<td style="width:25%;">
								<?php echo $this->Html->link(__('View Transaction', true), array('controller'=>'customer_transactions', 'action' => 'transaction', $value['CustomerTransaction']['id']), array('class'=>'w3-btn w3-dark-gray w3-round-small')); ?>
								<!--?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $customer['Customer']['id']), array('class'=>'w3-btn w3-blue-grey w3-round-small')); ?-->
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
	
	$('#dataTablescustomer').DataTable({
		responsive: true,
		"pageLength": 25
	});
	
});
</script>