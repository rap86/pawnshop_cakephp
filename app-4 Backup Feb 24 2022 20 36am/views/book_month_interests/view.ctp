<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>View Book Month Interest Details</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
						<tr>
							<td style="width:40%;">Book Type</td>
							<td style="width:60%;"><?php echo $book_month_interest['BookMonthInterest']['book_id']; ?></td>
						</tr>
						<tr>
							<td>Month</td>
							<td><?php echo $book_month_interest['BookMonthInterest']['month']; ?></td>
						</tr>
						<tr>
							<td>Percent Interest</td>
							<td><?php echo $book_month_interest['BookMonthInterest']['percent_interest']; ?></td>
						</tr>
						<tr>
							<td>Display Order</td>
							<td><?php echo $book_month_interest['BookMonthInterest']['display_order']; ?></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><?php echo $book_month_interest['BookMonthInterest']['description']; ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="/book_month_interests/index"class="w3-button w3-dark-gray w3-round-small">Back to index</a>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>