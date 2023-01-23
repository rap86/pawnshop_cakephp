<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>Pawnshop Details</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
						<tr>
							<td style="width:40%;">ID</td>
							<td style="width:60%;"><?php echo $pawnshop_email['PawnshopEmail']['id']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $pawnshop_email['PawnshopEmail']['email']; ?></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><?php echo $pawnshop_email['PawnshopEmail']['password']; ?></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td><?php echo $pawnshop_email['PawnshopEmail']['phone']; ?></td>
						</tr>
						<tr>
							<td>Mobile</td>
							<td><?php echo $pawnshop_email['PawnshopEmail']['mobile']; ?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><?php echo $pawnshop_email['PawnshopEmail']['address']; ?></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><?php echo $pawnshop_email['PawnshopEmail']['description']; ?></td>
						</tr>
						<tr>
							<td>Enabled</td>
							<td><?php echo $this->Form->checkbox('enabled', array('checked'=>($pawnshop_email['PawnshopEmail']['enabled'] == 1)? "checked": "", 'style'=>'width:30px; height:30px;', 'disabled'=>'disabled')); ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="/pawnshop_emails/index"class="w3-button w3-dark-gray w3-round-small">Back to index</a>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>