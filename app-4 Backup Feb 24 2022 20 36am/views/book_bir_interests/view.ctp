<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>View BIR Interest Per Month Details</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
						<tr>
							<td style="width:40%;">Id</td>
							<td style="width:60%;"><?php echo $interest['BookBirInterest']['id']?></td>
						</tr>
						<tr>
							<td>Interest Per Month</td>
							<td><?php echo $interest['BookBirInterest']['interest']?></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><?php echo $interest['BookBirInterest']['description']?></td>
						</tr>
						<tr>
							<td>Enabled</td>
							<td><?php echo $this->Form->checkbox('enabled', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'style'=>'width:30px; height:30px;', 'checked'=>($interest['BookBirInterest']['enabled'] == 1)? "checked":"", 'disabled'=>'disabled')); ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="/book_bir_interests/index"class="w3-button w3-dark-gray w3-round-small">Back to index</a>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>