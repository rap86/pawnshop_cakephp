<?php echo $this->element('header_background_color'); ?>

<div class="row">
	<br />
	<div class="col-lg-12">
		<div class="w3-border-bottom">
			<a href="/customers/add" class="w3-btn w3-dark-gray w3-round-small w3-large w3-margin-bottom">Create New Customer</a>
			<span class="pull-right">
				Customer/s
			</span>
		</div>
	</div>
	<div class="col-lg-12">
		<br />
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
							<?php if(trim($customer['Customer']['image_name']) != '') { ?>
				
								<img src="<?php echo $customer['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
							 
							 <?php } ?>
							 
							 <?php if(trim($customer['Customer']['image_name']) == '' && $customer['Customer']['gender'] == 'male') { ?>
								
								<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
							 
							 <?php } ?>
							 
							 <?php if(trim($customer['Customer']['image_name']) == '' && $customer['Customer']['gender'] == 'female') { ?>
								
								<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
							 
							 <?php } ?>
						</td>
						<td><?php echo $customer['Customer']['first_name']; ?></td>
						<td><?php echo $customer['Customer']['middle_name']; ?></td>
						<td><?php echo $customer['Customer']['last_name']; ?></td>
						<td><?php echo $customer['Customer']['gender']; ?></td>
						<td style="width:25%;">
							<?php echo $this->Html->link(__('View Transaction', true), array('action' => 'view', $customer['Customer']['id']), array('class'=>'w3-button w3-dark-gray w3-round-small')); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<br />
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