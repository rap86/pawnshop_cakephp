
<div class="row">
	<div class="col-lg-12">
		<h4 class="page-header">Click the view button to display the interest details</h4>
	</div>
	<div class="col-lg-4 w3-rightbar w3-border-dark-gray">
		<div class="w3-container w3-light-gray w3-padding">
			<div class="w3-large">Books</div>	
		</div>
		<table class="table table-striped table-bordered">
				
			<?php foreach($categories as $keyCategoty => $valueCategory):?>
				
				<tr id="categoryItem" class="w3-hover-gray">
					
					<td style="width:60%;">
						<?php echo $valueCategory['Book']['id']; ?>
					</td>
					<td style="width:40%;">
						<a id="buttonView" class="w3-button w3-dark-gray w3-round-small btn-xs" href="#<?php echo $valueCategory['Book']['id']; ?>" data-toggle="tab">View</a>
					</td>
				</tr>
		
			<?php endforeach; ?>
		</table>
	</div>
	<div class="col-lg-8">
	
		<div class="tab-content">
			<div class="w3-container w3-light-gray w3-padding">
				<div class="w3-large">Interest</div>	
			</div>
			<?php foreach($categories as $keyCategoty => $valueCategory):?>
				
				<div class="tab-pane fade w3-margin-top" id="<?php echo $valueCategory['Book']['id']; ?>">
					<table width="100%" class="table table-striped table-bordered" id="dataTablesUsers">		
						<thead>
							<tr>
								<th>Id</th>
								<th>Month</th>
								<th>Percent Interest</th>
								<th>Order</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>	
							<?php foreach($valueCategory['BookMonthInterest'] as $keyCat => $valueCat):?>
								
								<tr>
									<td><?php echo $valueCat['id']; ?></td>
									<td><?php echo $valueCat['month']; ?></td>
									<td><?php echo $valueCat['percent_interest']; ?></td>
									<td><?php echo $valueCat['display_order']; ?></td>
									<td><?php echo $valueCat['description']; ?></td>
									<td>
										<a target="_blank" class="w3-button w3-dark-gray btn-xs" href="/book_month_interests/edit/<?php echo $valueCat['id']; ?>" target="_blank">Edit</a>
									</td>
								</tr>
								
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
		
			<?php endforeach; ?>
			
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalBuyItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="/category_items/add">
				<input name="data[CategoryItem][user_id]" value="<?php echo $this->Session->read('Auth.User.id'); ?>" type="hidden">
				   
				<div class="modal-header w3-indigo">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">New Category</h4>
				</div>
				
				<div class="modal-body">
				  <div class="form-horizontal">
					   <div class="form-group">
							<label class="control-label col-sm-4">Code:</label>
							<div class="col-sm-5">          
								<input name="data[CategoryItem][group_code]" class="w3-input w3-border w3-light-grey" id="categoryCode" style="font-size:14px;" autocomplete="off">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Name:</label>
							<div class="col-sm-5">          
								<input name="data[CategoryItem][group_name]" style="font-size:14px;" id="categoryName" autocomplete="off" class="w3-input w3-border w3-light-grey">
							</div>
					   </div>
						<div class="form-group">
							<label class="control-label col-sm-4">Description:</label>
							<div class="col-sm-5">          
								<textarea name="data[CategoryItem][description]" id="categoryDescription" class="w3-input w3-border w3-light-grey" style="font-size:14px;" autocomplete="off" rowspan="4"></textarea>
							</div>
					   </div>
				   </div>
				</div>
				
				<div class="modal-footer">
					<button type="submit" id="buttonYes" style="display:none;">YES</button>
					
					<div class="w3-button w3-dark-gray w3-round-small pull-left" id="buttonConfirmationYes">YES</div>
					<div class="w3-button w3-dark-gray w3-round-small" data-dismiss="modal">NO</div>
				</div>
				
			</form>
			
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="/items/add">
			
				<input name="data[Item][category_item_id]" type="hidden" id="categoryItemId">
				  
				<div class="modal-header w3-indigo">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">New Item for Category <?php echo $category_id; ?></h4>
				</div>
				
				<div class="modal-body">
				  <div class="form-horizontal">
					   <div class="form-group">
							<label class="control-label col-sm-4">Item Code:</label>
							<div class="col-sm-5">          
								<input name="data[Item][item_code]" class="w3-input w3-border w3-light-grey" id="categoryCode" style="font-size:14px;" autocomplete="off">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Item name:</label>
							<div class="col-sm-5">          
								<input name="data[Item][item_name]" style="font-size:14px;" id="categoryName" autocomplete="off" class="w3-input w3-border w3-light-grey">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Brand:</label>
							<div class="col-sm-5">          
								<input name="data[Item][brand]" style="font-size:14px;" id="categoryName" autocomplete="off" class="w3-input w3-border w3-light-grey">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Quantity:</label>
							<div class="col-sm-5">          
								<input name="data[Item][quantity]" style="font-size:14px;" id="categoryName" autocomplete="off" class="w3-input w3-border w3-light-grey">
							</div>
					   </div>
					   <div class="form-group">
							<label class="control-label col-sm-4">Critical Quantity:</label>
							<div class="col-sm-5">          
								<input name="data[Item][critical_quantity]" style="font-size:14px;" id="categoryName" autocomplete="off" class="w3-input w3-border w3-light-grey">
							</div>
					   </div>
						<div class="form-group">
							<label class="control-label col-sm-4">Description:</label>
							<div class="col-sm-5">          
								<textarea name="data[Item][description]" id="categoryDescription" class="w3-input w3-border w3-light-grey" style="font-size:14px;" autocomplete="off" rowspan="4"></textarea>
							</div>
					   </div>
				   </div>
				</div>
				
				<div class="modal-footer">
					<button type="submit" id="buttonYesItem" style="display:none;">YES</button>
					
					<div class="w3-button w3-dark-gray w3-round-small pull-left" id="buttonConfirmationYesItem">YES</div>
					<div class="w3-button w3-dark-gray w3-round-small" data-dismiss="modal">NO</div>
				</div>
				
			</form>
			
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$('table#dataTablesUsers').DataTable({
		responsive: true,
		"pageLength": 10
	});

	$('a#buttonView').click(function() {
		$(this).parents('tr').addClass('w3-red').siblings('tr').removeClass('w3-red');
	});
	
	
	$('div#buttonConfirmationYes').click(function() {
	
		var category_code 		 = $('#categoryCode').val();
		var category_name 		 = $('#categoryName').val();
		var category_description = $('#categoryDescription').val();

		if($.trim(category_code) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Code must not empty!'
			})
			
		} else if($.trim(category_name) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Name must not empty!'
			})
			
		} else if($.trim(category_description) == '')
		{
			Swal.fire({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Description must not empty!'
			})
			
		} else {
		
			Swal.fire({
			  title: 'Confirmation',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, save it!'
			}).then((result) => {
			  if (result.value) {
				
				$('#buttonYes').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
		}
	});
	
	$('div#buttonConfirmationYesItem').click(function() {
	
		
			Swal.fire({
			  title: 'Confirmation',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, save it!'
			}).then((result) => {
			  if (result.value) {
				
				$('#buttonYesItem').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
		
	});
	
	$('div#divAddItem').click(function() {
		var id = $(this).attr('data-id');
		$('input#categoryItemId').val(id);
		//alert(id);
	});
});
</script>