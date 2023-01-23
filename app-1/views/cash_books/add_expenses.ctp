<div class="row">
	<div class="col-lg-6">
		<br />
		<form method="post" action="/cash_books/add_expenses" class="form-horizontal">
			
			<input name="data[CashBook][enabled]" value="1" type="hidden"/>
			<input name="data[CashBook][status]" value="expenses" type="hidden"/>
			
			<div class="panel panel-default">
				<div class="panel-heading" id="headerBackgroundColor">
					<h4>Add Expenses</h4>
				 </div>
				 <div class="panel-body">
					 <table class="table table-bordered">
						<tr>
							<td style="width:30%;">Amount</td>
							<td style="width:70%;">
								<input name="data[CashBook][expenses]" class="w3-input w3-border w3-light-grey" id="amount" style="font-size:30px;" autocomplete="off" required />
							</td>
						</tr>
						<tr>
							<td>Details</td>
							<td>
								<textarea name="data[CashBook][details]" class="w3-input w3-border w3-light-grey" id="details" autocomplete="off" required rows="4"></textarea>
							</td>
						</tr>
						<tr>
							<td>Date</td>
							<td>
								<input name="data[CashBook][date_created]" class="w3-input w3-border w3-light-grey" value="<?php echo date('Y-m-d'); ?>" readonly />
							</td>
						</tr>
						<tr>
							<td>Time</td>
							<td>
								<input name="data[CashBook][time_created]" class="w3-input w3-border w3-light-grey" value="<?php echo date('H:i:s'); ?>" readonly />
							</td>
						</tr>
					 </table>
				</div>
			  <div class="panel-footer">
				<input type="submit" value="Add Expenses" class="w3-btn w3-teal w3-block w3-padding-16" id="addExpensesSave" style="display:none;">
				<div class="w3-btn w3-teal w3-block w3-padding-16" id="addExpenses">Add Expenses</div>
			  </div>
			</div>	
		</form>
	</div>
</div>



<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	//$('.date_created').datepicker({ dateFormat: "yy-mm-dd" });
	
	$('#addExpenses').click(function() {
	
		var amount	= $('#amount').val();
		var details	= $('#details').val();
		
		 if($.trim(amount) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Amount must not empty!'
			})
			
		} else if(amount < 1)
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Less than 1 is not valid!'
			})
			
		} else if($.trim(details) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Details must not empty!'
			})
			
		} else {
		
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
				
				$('#addExpensesSave').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
		}
	});
	
	// only numbers allowed
	$('input#amount').on('keyup blur', function(event) {
		this.value = this.value.replace(/[^0-9]/g,''); 
	});
});
</script>	