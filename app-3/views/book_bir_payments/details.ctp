<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom">Hi, You have less the BIR payment on your Monthly collected</h3>
		<p>Details</p>
		<table class="table table-bordered table-striped w3-xlarge">
			<tr>
				<td style="width:50%;">Interest</td>
				<td style="width:50%;"><?php echo $query_result[0]['BookBirPayment']['interest'];?></td>
			</tr>
			<tr>
				<td>Interest payment</td>
				<td><?php echo $query_result[0]['BookBirPayment']['payment'];?></td>
			</tr>
			<tr>
				<td>Total Monthly Collected</td>
				<td><?php echo $query_result[0]['BookBirPayment']['total_monthly_collected'];?></td>
			</tr>
			<tr>
				<td>Cash Book1 Balanced (BIR)</td>
				<td><?php echo number_format($query_result[0]['BookBirPayment']['cash_book1_balanced'], 0);?></td>
			</tr>
			<tr>
				<td>Cash Book 2 Balanced (Book 1,2 and 3)</td>
				<td><?php echo number_format($query_result[0]['BookBirPayment']['cash_book2_balanced'], 0);?></td>
			</tr>
			<tr>
				<td>Date Created</td>
				<td><?php echo date('M j, Y g:i A',strtotime($query_result[0]['BookBirPayment']['created']));?></td>
			</tr>
		</table>
	</div>
</div>