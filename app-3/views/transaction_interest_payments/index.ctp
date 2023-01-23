<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="w3-card-2">
			<div class="w3-container w3-teal w3-padding-small">
				<h4>Books <span class="pull-right"><a href="/books/add" class="w3-button w3-border">Add Book</a></span></h4>
			</div>
			<br />
			<div class="w3-container">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
						    <th>Id</th>
							<th>Name</th>
							<th>Book Code</th>
							<th>Deduct First Month</th>
							<th>Enable</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
					   <?php foreach ($books as $book): ?>
							<tr>
							   <td><?php echo $book['Book']['id']; ?></td>
								<td><?php echo $book['Book']['name']; ?></td>
								<td><?php echo $book['Book']['book_code']; ?></td>
								<td><?php echo $book['Book']['deduct_first_month']; ?></td>
								<td><?php echo $book['Book']['enabled']; ?></td>
								<td class="actions">
									<?php echo $this->Html->link(__('View', true), array('action' => 'view', $book['Book']['id']), array('class'=>'btn btn-success btn-sm')); ?>
									<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $book['Book']['id']), array('class'=>'btn btn-warning btn-sm')); ?>
									<!--?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $book['Book']['id']), array('class'=>'btn btn-danger btn-sm'), sprintf(__('Are you sure you want to delete # %s?', true), $book['Book']['id'])); ?-->
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