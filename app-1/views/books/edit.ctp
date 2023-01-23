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
					
						<?php echo $this->Form->create('Book', array('action'=>'edit', 'class'=>'form-horizontal')); ?>
						<?php echo $this->Form->hidden('id'); ?>
				
						<tr>
							<td style="width:40%;">Name</td>
							<td style="width:60%;"><?php echo $this->Form->input('name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Book Code</td>
							<td><?php echo $this->Form->input('book_code', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>1st Month Interest</td>
							<td><?php echo $this->Form->input('first_month_interest', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Month Before Remata</td>
							<td><?php echo $this->Form->input('month_before_remata', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Allowance Day</td>
							<td><?php echo $this->Form->input('allowance_day', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Deduct First Month</td>
							<td><?php echo $this->Form->input('deduct_first_month', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Granted Service Charge</td>
							<td><?php echo $this->Form->input('granted_service_charge', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Doc Stamp Interest (Percent)</td>
							<td><?php echo $this->Form->input('doc_stamp_interest', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Details</td>
							<td><?php echo $this->Form->input('details', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'type'=>'textarea')); ?></td>
						</tr>
						<tr>
							<td>Enabled</td>
							<td><?php echo $this->Form->checkbox('enabled', array('style'=>'width:30px; height:30px;')); ?></td>
						</tr>
						<tr>
							<td>
								<?php echo $this->Form->submit(__('Edit Information',true), array('class'=>'w3-btn w3-teal w3-round-small')); ?>
								<?php echo $this->Form->end(); ?>
							</td>
							<td><a href="/books/index" class="w3-btn w3-dark-gray w3-round-small">Back to Index</a></td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>