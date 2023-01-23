<?php echo $this->element('header_background_color'); ?>

<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<a href="/book_month_interests/add" class="w3-btn w3-dark-gray w3-round-small">Add value</a>
			</div>
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
						    <th>Book Id</th>
							<th>Month</th>
							<th>Percent</th>
							<th>Order</th>
							<th>Description</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
					   <?php foreach ($book_month_interests as $value): ?>
							<tr>
							   <td><?php echo $value['BookMonthInterest']['book_id']; ?></td>
								<td><?php echo $value['BookMonthInterest']['month']; ?></td>
								<td><?php echo $value['BookMonthInterest']['percent_interest']; ?></td>
								<td><?php echo $value['BookMonthInterest']['display_order']; ?></td>
								<td><?php echo $value['BookMonthInterest']['description']; ?></td>
								<td class="actions">
									<?php echo $this->Html->link(__('View', true), array('action' => 'view', $value['BookMonthInterest']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $value['BookMonthInterest']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $value['BookMonthInterest']['id']), array('class'=>'w3-btn w3-red w3-round-small'), sprintf(__('Are you sure you want to delete # %s?', true), $value['BookMonthInterest']['id'])); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$('table#dataTablesUsers').DataTable({
		responsive: true
	});

});
</script>