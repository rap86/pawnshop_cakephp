<?php echo $this->element('header_background_color'); ?>

<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<a href="/books/add" class="w3-btn w3-dark-gray w3-round-small">Add Book</a>
			</div>
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
						    <th>Id</th>
							<th>Name</th>
							<th>Book Code</th>
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
								<td><?php echo $book['Book']['enabled']; ?></td>
								<td class="actions">
									<?php echo $this->Html->link(__('View', true), array('action' => 'view', $book['Book']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $book['Book']['id']), array('class'=>'w3-button w3-gray w3-round-small')); ?>
									<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $book['Book']['id']), array('class'=>'w3-btn w3-red w3-round-small'), sprintf(__('Are you sure you want to delete # %s?', true), $book['Book']['id'])); ?>
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