<?php echo $this->element('header_background_color'); ?>

<div class="row">
	<div class="col-lg-12">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>
					<a href="/customers/add" class="w3-btn w3-dark-gray w3-round-small">Create New Customer</a>
					<span class="pull-right">
						Customer/s
					</span>
				</h4>
			</div>
			<div class="panel-body">
				<table style="width:100%;" class="table table-striped table-bordered table-hover" id="dataTablescustomer">
					<thead>
						<tr>
							<th>Customer Id</th>
							<th>Image</th>
							<th>Firstname</th>
							<th>MIddelname</th>
							<th>Lastname</th>
							<th>Gender</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($customers as $key => $customer): ?>

							<tr>
								<td><?php echo $customer['Customer']['id']; ?></td>
								<td style="text-align:center; cursor:pointer;">
									<img src="<?php echo $customer['Customer']['image_location']; ?>" width="30px;" height="30px;" style="border-radius:2px;">
								</td>
								<td><?php echo $customer['Customer']['first_name']; ?></td>
								<td><?php echo $customer['Customer']['middle_name']; ?></td>
								<td><?php echo $customer['Customer']['last_name']; ?></td>
								<td><?php echo $customer['Customer']['gender']; ?></td>
								<td style="width:25%;">
									<?php echo $this->Html->link(__('View Transaction', true), array('action' => 'view', $customer['Customer']['id']), array('class'=>'w3-btn w3-teal w3-round-small')); ?>
									<!--?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $customer['Customer']['id']), array('class'=>'w3-btn w3-blue-grey w3-round-small')); ?-->
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
	
	$('img').click(function() {
		
		Swal.fire({
		  title: 'Image',
		  imageUrl: $(this).attr('src'),
		  imageWidth: 400,
		  imageHeight: 200,
		  imageAlt: 'Image',
		  animation: false
		})
	});
	
	$('#dataTablescustomer').DataTable({
		responsive: true,
		"pageLength": 25
	});
	
});
</script>	