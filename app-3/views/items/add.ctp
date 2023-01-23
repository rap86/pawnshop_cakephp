<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>Add Item Details</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
					
						<?php echo $this->Form->create('Item', array('action'=>'add', 'class'=>'form-horizontal')); ?>
						
						<tr>
							<td style="width:40%;">Name</td>
							<td style="width:60%;"><?php echo $this->Form->input('name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Item Code</td>
							<td><?php echo $this->Form->input('item_code', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Type</td>
							<td><?php echo $this->Form->input('type', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
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
								<?php echo $this->Form->submit(__('Add Details',true), array('class'=>'w3-btn w3-teal w3-round-small')); ?>
								<?php echo $this->Form->end(); ?>
							</td>
							<td>
								<a href="/items/index"class="w3-button w3-dark-gray w3-round-small">Back to index</a>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>