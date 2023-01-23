<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>View Book Details</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
						<tr>
							<td style="width:40%;">Name</td>
							<td style="width:60%;"><?php echo $book['Book']['name']; ?></td>
						</tr>
						<tr>
							<td>Book Code</td>
							<td><?php echo $book['Book']['book_code']; ?></td>
						</tr>
						<tr>
							<td>1st Month Interest</td>
							<td><?php echo $book['Book']['first_month_interest']; ?></td>
						</tr>
						<tr>
							<td>Month Before Remata</td>
							<td><?php echo $book['Book']['month_before_remata']; ?></td>
						</tr>
						<tr>
							<td>Allowance Day</td>
							<td><?php echo $book['Book']['allowance_day']; ?></td>
						</tr>
						<tr>
							<td>Deduct First Month</td>
							<td><?php echo $book['Book']['deduct_first_month']; ?></td>
						</tr>
						<tr>
							<td>Granted Service Charge</td>
							<td><?php echo $book['Book']['granted_service_charge']; ?></td>
						</tr>
						<tr>
							<td>Doc Stamp Interest (Percent)</td>
							<td><?php echo $book['Book']['doc_stamp_interest']; ?></td>
						</tr>
						<tr>
							<td>Details</td>
							<td><?php echo $book['Book']['details']; ?></td>
						</tr>
						<tr>
							<td>Enabled</td>
							<td><?php echo $this->Form->checkbox('enabled', array('checked'=>($book['Book']['enabled'] == 1)? "checked": "", 'style'=>'width:30px; height:30px;', 'disabled'=>'disabled')); ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="/books/index"class="w3-button w3-dark-gray w3-round-small">Back to index</a>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>