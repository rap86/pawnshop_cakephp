<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>View Item Details</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
						<tr>
							<td style="width:40%;">Name</td>
							<td style="width:60%;"><?php echo $item['Item']['name']; ?></td>
						</tr>
						<tr>
							<td>Item Code</td>
							<td><?php echo $item['Item']['item_code']; ?></td>
						</tr>
						<tr>
							<td>Type</td>
							<td><?php echo $item['Item']['type']; ?></td>
						</tr>
						<tr>
							<td>Details</td>
							<td><?php echo $item['Item']['details']; ?></td>
						</tr>
						<tr>
							<td>Enabled</td>
							<td><?php echo $this->Form->checkbox('enabled', array('checked'=>($item['Item']['enabled'] == 1)? "checked": "", 'style'=>'width:30px; height:30px;', 'disabled'=>'disabled')); ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="/items/index"class="w3-button w3-dark-gray w3-round-small">Back to index</a>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>