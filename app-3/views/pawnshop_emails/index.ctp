<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<a href="/pawnshop_emails/add" class="w3-btn w3-dark-gray w3-round-small">Add Email</a>
			</div>
			<br />
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
							<th>Email</th>
							<th>Password</th>
							<th>Phone</th>
							<th>Mobile</th>
							<th>Address</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
					   <?php foreach ($pawnshop_emails as $pawnshop_email): ?>
							<tr>
								<td><?php echo $pawnshop_email['PawnshopEmail']['email']; ?></td>
								<td><?php echo $pawnshop_email['PawnshopEmail']['password']; ?></td>
								<td><?php echo $pawnshop_email['PawnshopEmail']['phone']; ?></td>
								<td><?php echo $pawnshop_email['PawnshopEmail']['mobile']; ?></td>
								<td><?php echo $pawnshop_email['PawnshopEmail']['address']; ?></td>
								<td class="actions">
									<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pawnshop_email['PawnshopEmail']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pawnshop_email['PawnshopEmail']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pawnshop_email['PawnshopEmail']['id']), array('class'=>'w3-btn gray-red w3-round-small'), sprintf(__('Are you sure you want to delete # %s?', true), $pawnshop_email['PawnshopEmail']['id'])); ?>
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