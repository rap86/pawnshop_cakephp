<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<a href="/book_bir_interests/add" class="w3-btn w3-dark-gray w3-round-small">Add Interest</a>
			</div>
			<br />
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
						    <th>Id</th>
							<th>Interest</th>
							<th>Description</th>
							<th>Enabled</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
					   <?php foreach ($interests as $interest): ?>
							<tr>
							    <td><?php echo $interest['BookBirInterest']['id']; ?></td>
								<td><?php echo $interest['BookBirInterest']['interest']; ?></td>
								<td><?php echo $interest['BookBirInterest']['description']; ?></td>
								<td><?php echo $interest['BookBirInterest']['enabled']; ?></td>
								<td class="actions">
									<?php echo $this->Html->link(__('View', true), array('action' => 'view', $interest['BookBirInterest']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $interest['BookBirInterest']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $interest['BookBirInterest']['id']), array('class'=>'w3-btn w3-red w3-round-small'), sprintf(__('Are you sure you want to delete # %s?', true), $interest['BookBirInterest']['id'])); ?>
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