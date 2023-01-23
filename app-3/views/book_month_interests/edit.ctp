<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>Edit Book Month Interest</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
					
						<?php echo $this->Form->create('BookMonthInterest', array('action'=>'add', 'class'=>'form-horizontal')); ?>
						<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
						
						<tr>
							<td style="width:40%;">Book Type</td>
							<td style="width:60%;"><?php echo $this->Form->input('book_id', array('options'=>array(""=>"", $books_id), 'class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>Month</td>
							<td><?php echo $this->Form->input('month', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'inputMonth')); ?></td>
						</tr>
						<tr>
							<td>Percent Interest</td>
							<td><?php echo $this->Form->input('percent_interest', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'inputInterest')); ?></td>
						</tr>
						<tr>
							<td>Display Order</td>
							<td><?php echo $this->Form->input('display_order', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'inputOrder')); ?></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><?php echo $this->Form->input('description', array('type'=>'textarea', 'class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
						</tr>
						<tr>
							<td>
								<?php echo $this->Form->submit(__('Edit Information',true), array('class'=>'w3-btn w3-teal w3-round-small')); ?>
								<?php echo $this->Form->end(); ?>
							</td>
							<td><a href="/book_month_interests/index" class="w3-btn w3-dark-gray w3-round-small">Back to Index</a></td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>

<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	// only numbers allowed
	$('input#inputMonth, input#inputInterest, input#inputOrder').on('keyup blur', function(event) {
		this.value = this.value.replace(/[^0-9]/g,''); 
	});
	
});
</script>