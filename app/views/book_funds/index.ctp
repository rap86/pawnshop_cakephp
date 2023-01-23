<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="w3-border">
			<div class="w3-container w3-teal w3-padding-small">
				<h4>Users <span class="pull-right"><a href="/users/add" class="w3-button w3-border">Add User</a></span></h4>
			</div>
			<br />
			<div class="w3-container">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
						    <th>Id</th>
							<th>Firstname</th>
							<th>Middlename</th>
							<th>Lastname</th>
							<th>Username</th>
							<th>Roles</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
					   <?php foreach ($users as $user): ?>
							<tr>
							   <td><?php echo $user['User']['id']; ?></td>
								<td><?php echo $user['User']['first_name']; ?></td>
								<td><?php echo $user['User']['middle_name']; ?></td>
								<td><?php echo $user['User']['last_name']; ?></td>
								<td><?php echo $user['User']['username']; ?></td>
								<td><?php echo $user['User']['roles']; ?></td>
								<td class="actions">
									<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id']), array('class'=>'btn btn-success btn-sm')); ?>
									<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-warning btn-sm')); ?>
									<!--?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-danger btn-sm'), sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?-->
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