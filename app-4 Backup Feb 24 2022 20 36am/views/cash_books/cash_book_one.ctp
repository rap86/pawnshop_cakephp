<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom w3-margin-bottom">Cash Book 1</h3>
		
		<?php echo $this->Form->create('CashBook', array('action'=>'cash_book_one')); ?>
			
		<table class="table table-bordered w3-light-gray">
		  <tr>
			  <td style="width:20%;">
				<input class="w3-input w3-border" type="text" name="data[CashBook][date_from]" value="<?php echo $date['date_from']?>" placeholder="From" id="dateFrom">
			  </td>
			  <td style="width:20%;">
				<input class="w3-input w3-border" type="text" name="data[CashBook][date_to]" value="<?php echo $date['date_to']; ?>" placeholder="To" id="dateTo">
			  </td>
			  <td style="width:20%;">
				<button class="w3-button w3-dark-grey w3-block w3-round-small">LOAD</button>
			  </td>
			   <td style="width:20%;">
				<a href="/print/print/cash_book_one/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
			  </td>
			  <td style="width:20%;">
				<?php if($bir_payment_count == 0) { ?>
				
					<div class="w3-button w3-round-small w3-red w3-block" data-toggle="modal" data-target="#myModalBIR">Less BIR Interest?</div>
				
				<?php } else { ?>
					
					<div class="w3-text-red">BIR Payment deducted!</div>
					
				<?php } ?>
			  </td>
		  </tr>
		</table>
		
		<?php echo $this->Form->end(); ?>

		<div class="table-responsive">
			<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
				<thead>
					<tr>
						<th>DATE</th>
						<th>SB</th>
						<th>EXPENSES</th>
						<th>CASHOUT</th>
						<th>CASHIN</th>
						<th class="success">PAYMENT</th>
						<th class="success">RECEIPT</th>
						<th>ED</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach($datas as $key => $data): ?>

					<tr>
						<td><?php echo $key; ?></td>
						<td>
							<strong>
								<?php echo number_format($data['starting_balanced_bir'][0], 0); ?>
							</strong>
						</td>
						<td><?php echo $data['expenses']['expenses']; ?></td>
						<td><?php echo $data['deposit']['deposit']; ?></td>
						<td><?php echo $data['withdrawal']['withdrawal']; ?></td>
						<td class="success"><?php echo $data['book_1']['payment']; ?></td>
						<td class="success"><?php echo $data['book_1']['receipt'] ?></td>
						<td>
							<strong>
								<?php echo number_format($data['ending_balanced_bir'][ count($data['ending_balanced_bir']) -1 ], 0); ?>
							</strong>
						</td>
					</tr>
						
					<?php endforeach; ?>
						<tr class="danger">
							<td>
								<strong>COH</strong>
							</td>
							<td colspan="6"></td>
							<td style="text-align:left; font-weight:bold;" colspan="1">
								<?php echo number_format($data['ending_balanced_bir'][ count($data['ending_balanced_bir']) -1 ], 0); ?>
							</td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>		



<!-- Modal -->
<div class="modal fade" id="myModalBIR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" action="/cash_books/bir_payment">
			<div class="modal-content">

				 <input name="data[TransactionSoldItem][book_id]" value="<?php echo $data['CustomerTransaction']['book_id']; ?>" type="hidden">
				 
				<div class="modal-header w3-red">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Less <?php echo $bir_interest; ?> Percent for BIR to your Monthly collected</h4>
				</div>
				<div class="modal-body">
					<div class="form-horizontal">
						<p class="w3-border-bottom">
							Reminder: Please perform this task on every last day of the month before closing time!
						</p>
					   <?php 
					  
						   foreach($datas as $key => $data)
						   {
							$total_collected += $data['book_1']['receipt'];
						   }
						   $bir_payment = ceil(($bir_interest / 100) * $total_collected);
					   ?>
					   
						<div class="form-group">
							<label class="control-label col-sm-4">Total Collected</label>
							<div class="col-sm-5">          
								<input name="data[BIR][total_collected]" value="<?php echo $total_collected; ?>" class="w3-input w3-border w3-light-grey" id="total_collected_bir" style="font-size:30px;" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">BIR payment</label>
							<div class="col-sm-5">          
								<input name="data[BIR][payment]" value="<?php echo $bir_payment; ?>" class="w3-input w3-border w3-light-grey" id="payment_bir" style="font-size:30px;" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="w3-button w3-border w3-dark-gray w3-round-small pull-left" id="buttonYes" style="display:none;">YES</button>
						<div class="w3-button w3-border w3-dark-gray w3-round-small pull-left" id="buttonConfirmationYes">YES</div>
						<button type="button" class="w3-button w3-border w3-dark-gray w3-round-small" data-dismiss="modal">NO</button>
					</div>
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
	
	$('div#buttonConfirmationYes').click(function() {
	
		var payment_bir = $('#payment_bir').val();
		var total_collected_bir = $('#total_collected_bir').val();
		
		$('#payment_bir').val();
		Swal.fire({
		  title: 'Are you sure, you want to less BIR payment?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, save it!'
		}).then((result) => {
			  if (result.value) {
			  
				if(total_collected_bir == '')
				{
					Swal.fire({
					  type: 'warning',
					  title: 'Notification',
					  text: 'Select date range then click Load',
					  showConfirmButton: true
					});
				} else if(payment_bir <= 0)
				{
					Swal.fire({
					  type: 'warning',
					  title: 'Notification',
					  text: 'Go to add stock to update the quantity',
					  showConfirmButton: true
					});
					
				} else {
				
					$('button#buttonYes').trigger('click');
				}
				
				
				/*
				$.ajax({
					async: false,
					type: 'POST',
					url: '/cash_books/bir_payment',
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
							
						} 
					}
					
				});
				*/
				
				
			  } else {
			  
				location.reload();
			  
			  }
		});	

	});

});
</script>