<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom">List of BIR Payment</h3>
		<table class="table table-bordered table-striped">
			<tr>
				<td style="font-weight:bold">Interest</td>
				<td style="font-weight:bold">Interest payment</td>
				<td style="font-weight:bold">Total Monthly Collected</td>
				<td style="font-weight:bold">Cash Book1 Balanced</td>
				<td style="font-weight:bold">Cash Book 2 Balanced</td>
				<td style="font-weight:bold">Created</td>
			</tr>
			<?php foreach($query_result as $key => $value):?>
				<tr>
					<td><?php echo $value['BookBirPayment']['interest'];?></td>
					<td><?php echo $value['BookBirPayment']['payment'];?></td>
					<td><?php echo $value['BookBirPayment']['total_monthly_collected'];?></td>
					<td><?php echo number_format($value['BookBirPayment']['cash_book1_balanced'], 0);?></td>
					<td><?php echo number_format($value['BookBirPayment']['cash_book2_balanced'], 0);?></td>
					<td><?php echo date('M j, Y g:i A',strtotime($value['BookBirPayment']['created']));?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>