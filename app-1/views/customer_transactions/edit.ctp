<style>
	#myTab li a {background-color:#ccccb3; border-top-left-radius:2px; border-top-right-radius:2px; }
	#myTab li.active a {border-bottom-color: transparent;background-color:white; }
	table tr td:nth-child(1) { font-weight:bold; }
</style>

<div class="row">
	<div class="col-lg-12">
	
		<h3 style="border-bottom:1px solid #e5e5cc;">Edit Transaction</h3>
		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a href="#menu1" data-toggle="tab">Item Details</a>
			</li>
			<li>
				<a href="#menu2" data-toggle="tab">Item Image</a>
			</li>
		</ul>
		
		<div class="tab-content my-tab">
			<div class="tab-pane fade in active" id="menu1">
				<div class="col-lg-6">
					<br />
					<?php echo $this->Form->create('CustomerTransaction', array('action'=>'edit', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data')); ?>
					
					<?php echo $this->Form->hidden('id'); ?>
					<?php echo $this->Form->hidden('first_month_interest', array('id'=>'firstMonthInterest')); ?>
					<?php echo $this->Form->hidden('succeding_month_interest', array('id'=>'succedingMonthInterest')); ?>
					<?php echo $this->Form->hidden('month_before_remata', array('id'=>'monthBeforeRemata')); ?>
					<?php echo $this->Form->hidden('allowance_day', array('id'=>'allowanceDay')); ?>
					<?php echo $this->Form->hidden('add_monthly_interest', array('id'=>'addMonthlyInterest')); ?>
					<?php echo $this->Form->hidden('deduct_first_month', array('id'=>'deductFirstMonth')); ?>
					<?php echo $this->Form->hidden('doc_stamp_interest', array('id'=>'docStampInterest')); ?>
					<?php echo $this->Form->hidden('sangla_date', array('value'=>date('Y-m-d'))); ?>
					<?php echo $this->Form->hidden('sangla_time', array('value'=>date('H:i:s'))); ?>
					<?php echo $this->Form->hidden('status', array('value'=>'pawned')); ?>
					<?php echo $this->Form->hidden('enabled', array('value'=>1)); ?>
					<?php echo $this->Form->hidden('net_amount_duplicate'); ?>
					<?php echo $this->Form->input('book_id', array('class'=>'w3-input w3-border w3-light-grey', 'options'=>array(""=>"", $books), 'label'=>false, 'id'=>'bookTransaction', 'style'=>'font-size:30px; display:none;')); ?>
					
					<?php echo $this->Form->hidden('item_image', array('class'=>'form-control', 'label'=>false, 'id'=>'itemPhoto')); ?>
					
					<table class="table table-bordered">
						<tr>
							<td style="width:35%; color:red;">For BIR Also?</td>
							<td style="width:65%;">
									<?php echo $this->Form->checkbox('for_bir', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'style'=>'width:30px; height:30px;')); ?>
							</td>
						</tr>
						<tr>
							<td style="width:35%;">Granted</td>
							<td style="width:65%;">
								<?php echo $this->Form->input('book_id', array('class'=>'w3-input w3-border w3-light-grey', 'options'=>array(""=>"", $books), 'label'=>false, 'id'=>'bookTransaction', 'style'=>'font-size:30px;')); ?>
							</td>
						</tr>
						<tr>
							<td>Item</td>
							<td>
								<?php echo $this->Form->input('item_id', array('class'=>'w3-input w3-border w3-light-grey', 'options'=>array(""=>"", $items), 'label'=>false, 'id'=>'itemType', 'style'=>'font-size:30px;')); ?>
							</td>
						</tr>
						<tr>
							<td>Item Type</td>
							<td>
								<?php echo $this->Form->input('item_type', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'jewelryItem')); ?>
							</td>
						</tr>
						<tr>
							<td>Brand</td>
							<td>
								<?php echo $this->Form->input('brand', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'jewelryBrand')); ?>
							</td>
						</tr>
						<tr>
							<td>Model</td>
							<td>
								<?php echo $this->Form->input('model', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'jewelryModel')); ?>
							</td>
						</tr>
						<tr>
							<td>Jewelry Type</td>
							<td>
								<?php echo $this->Form->input('jewelry_type', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'jewelryType')); ?>
							</td>
						</tr>
						<tr>
							<td>Karat</td>
							<td>
								<?php echo $this->Form->input('karat', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'jewelryKarat')); ?>
							</td>
						</tr>
						<tr>
							<td>Item Weight (grams)</td>
							<td>
								<?php echo $this->Form->input('weight', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'jewelryGrams')); ?>
							</td>
						</tr>
						<tr>
							<td>Gross Amount</td>
							<td>
								<?php echo $this->Form->input('gross_amount', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'grossAmount', 'style'=>'font-size:30px;')); ?>
							</td>
						</tr>
						<tr>
							<td>Less Service Charge</td>
							<td>
								<?php echo $this->Form->input('granted_service_charge', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'grantedServiceCharge', 'readonly'=>'readonly', 'style'=>'font-size:30px;')); ?>
							</td>
						</tr>
						<tr>
							<td>Net Amount</td>
							<td>
								<?php echo $this->Form->input('net_amount', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'id'=>'netAmount', 'readonly'=>'readonly', 'style'=>'font-size:30px;')); ?>
							</td>
						</tr>
						<tr>
							<td>Id Presented</td>
							<td>
								<?php echo $this->Form->input('id_presented', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
							</td>
						</tr>
						<tr>
							<td>Details</td>
							<td>
								<?php echo $this->Form->input('details', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'type'=>'textarea')); ?>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--/#menu1-->
			
			<div class="tab-pane fade" id="menu2">
				<div class="col-lg-6 col-md-6">
					<br />
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Image Preview</h4>
						</div>
						<div class="panel-body w3-center">
							<div style="min-height: 344px;" class="w3-center" id="results">
								<img src="<?php echo $this->data['CustomerTransaction']['image_location']; ?>" class="img-thumbnail" alt="avatar" id="patientImageFrame">
								
							</div>
						</div>
						<div class="panel-footer">
							<div class="w3-section">
								<input name="data[image_name]" type="file" class="btn btn-default text-center form-control file-upload patientImagePreview" id="patientImage">
							</div>
						</div>
					</div>
				</div>
				<!--col-lg-6-->
				
				<div class="col-lg-6 col-md-6">
					<br />
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Webcam</h4>
						</div>
						<div class="panel-body">
							<div class="w3-container" style="min-height:344px;" id="my_camera">
								
							</div>
						</div>
						<!--panel body-->
						<div class="panel-footer">
							<div class="w3-section">
								<a href="#" class="btn btn-default btn-block" onClick="take_snapshot()">Take a Photo</a>
							</div>	
						</div>
					</div>
					<!--panel-->
				</div>
				<!--/.col-lg-6-->
				<div class="w3-container w3-padding-large"><br /></div>
			</div>
			<!--/#menu2-->
			
		</div>
		<!--/.tab-content-->
		
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div style="margin-left:10px; display:none;">
	<?php echo $this->Form->submit(__('Submit Information',true), array('class'=>'w3-button w3-grey w3-round-small', 'id'=>'submitItemDetails', 'style'=>'text-shadow:1px 1px 0 #444;')); ?>
	<?php echo $this->Form->end(); ?>
</div>
<div style="margin-left:10px; margin-top:-70px;">
	<!--button data-toggle="modal" data-target="#myModalTransactionConfirmation" class="w3-button w3-blue-grey w3-round-small" style="text-shadow:1px 1px 0 #444;" id="idSubmitInformartion">Edit Information</button-->
	<a class="w3-button w3-dark-gray w3-round-small" href="/customer_transactions/transaction/<?php echo $id; ?>">Cancel Delete</a>
	<button data-toggle="modal" data-target="#myModalTransactionDelete" class="w3-button w3-red w3-round-small">Delete This</button>
	<hr class="w3-gray w3-border"/>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalTransactionConfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header w3-teal">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure all item details are correct ?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="w3-button w3-teal w3-round-small pull-left" id="btnConfirmation">YES</button>
					<button type="button" class="w3-button w3-light-grey w3-border w3-round-small" data-dismiss="modal">NO</button>
				</div>
			</div>
			<!-- /.modal-content -->
		
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="myModalTransactionDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		
			<div class="modal-content">
				<form method="post" action="/customer_transactions/delete_transaction">
		
					<input type="hidden" name="data[CustomerTransaction][id]" value="<?php echo $this->data['CustomerTransaction']['id']; ?>"> 
					<input type="hidden" name="data[CustomerTransaction][for_bir]" value="<?php echo $this->data['CustomerTransaction']['for_bir']; ?>"> 
					<input type="hidden" name="data[CustomerTransaction][book_id]" value="<?php echo $this->data['CustomerTransaction']['book_id']; ?>"> 
					<input type="hidden" name="data[CustomerTransaction][net_amount_duplicate]" value="<?php echo $this->data['CustomerTransaction']['net_amount_duplicate']; ?>"> 
			
					<div class="modal-header w3-teal">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this ?</p>
					</div>
					<div class="modal-footer">
						<button type="submit" class="w3-button w3-green w3-round-small pull-left" id="buttonDeleteYes" style="display:none;">YES</button>
						<div class="w3-button w3-teal w3-round-small pull-left" id="btnConfirmationDelete">YES</div>
						<button type="button" class="w3-button w3-light-grey w3-border w3-round-small" data-dismiss="modal">NO</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
			
		
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script src="/js/jquery.min.js"></script>
<script src="/js/webcam.js"></script>
<script>
Webcam.set({
			width: 450,
			height: 300,
			image_format: 'jpeg',
			jpeg_quality: 95
		});
	Webcam.attach( '#my_camera' );
	
	function take_snapshot() {
			// take snapshot and get image data
			//alert("here");
			Webcam.snap( function(data_uri) {
				// display results in page
				
					
				Webcam.upload( data_uri, '../item_image', function(code, text) {
					// console.log(text);
					var imageText = text.slice(12);
					var imageName = imageText.slice(0, -4);
					 // console.log(imageName);
					document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
					document.getElementById('itemPhoto').value = imageName; 
					
				} );
				
			} );
	}
</script>
<script>
$(document).ready(function() {

	$('#itemType').trigger('change');
	
	$('div#btnConfirmationDelete').click(function() {

		Swal.fire({
			  title: 'Very Sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.value) {
				
				$('#buttonDeleteYes').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
		
	});
	
	$('button#btnConfirmation').click(function() {

		Swal.fire({
			  title: 'Very Sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, save it!'
			}).then((result) => {
			  if (result.value) {
				
				$('#submitItemDetails').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
		
	});
	
	$('#bookTransaction').change(function() {
		var thisVal = $(this).val();
		var data = [];
		data.push({name:'data[Book][id]', value:thisVal });
		
		jQuery.ajax({
			async:false,
			url:'/customer_transactions/search_item',
			data:data,
			dataType: "json",
			type:'POST',
			success:function(data)
			{
				// console.log(data);
				
				if(data !="")
				{
					$('#firstMonthInterest').val(data['data'][0]['books']['first_month_interest']);
					$('#monthBeforeRemata').val(data['data'][0]['books']['month_before_remata']);
					$('#allowanceDay').val(data['data'][0]['books']['allowance_day']);
					$('#deductFirstMonth').val(data['data'][0]['books']['deduct_first_month']);
					$('#grantedServiceCharge').val(data['data'][0]['books']['granted_service_charge']);
					$('#docStampInterest').val(data['data'][0]['books']['doc_stamp_interest']);
					
				}
			
			}
		});
		
	});
	
	$('#itemType').change(function() {
		
		var thisVal = $(this).val();
			
		if(thisVal == 1) 
		{
			$('#jewelryItem').attr('readonly', 'readonly').removeClass('w3-light-grey').addClass('w3-grey');
			$('#jewelryBrand').attr('readonly', 'readonly').removeClass('w3-light-grey').addClass('w3-grey');
			$('#jewelryModel').attr('readonly', 'readonly').removeClass('w3-light-grey').addClass('w3-grey');
			
			$('#jewelryType').removeAttr('readonly').removeClass('w3-grey').addClass('w3-light-grey');
			$('#jewelryKarat').removeAttr('readonly').removeClass('w3-grey').addClass('w3-light-grey');
			$('#jewelryGrams').removeAttr('readonly').removeClass('w3-grey').addClass('w3-light-grey');
			
			$('#jewelryItem').val('');
			$('#jewelryBrand').val('');
			$('#jewelryModel').val('');
			
			$('#jewelryType').val('');
			$('#jewelryKarat').val('');
			$('#jewelryGrams').val('');
			
			$('#grossAmount').val('');
			$('#netAmount').val('');
			$('#CustomerTransactionDetails').val('');
			$('#grantedServiceCharge').val('');
			
		} else {
			
			$('#jewelryItem').removeAttr('readonly').removeClass('w3-grey').addClass('w3-light-grey');
			$('#jewelryBrand').removeAttr('readonly').removeClass('w3-grey').addClass('w3-light-grey');
			$('#jewelryModel').removeAttr('readonly').removeClass('w3-grey').addClass('w3-light-grey');
			
			$('#jewelryType').attr('readonly', 'readonly').removeClass('w3-light-grey').addClass('w3-grey');
			$('#jewelryKarat').attr('readonly', 'readonly').removeClass('w3-light-grey').addClass('w3-grey');
			$('#jewelryGrams').attr('readonly', 'readonly').removeClass('w3-light-grey').addClass('w3-grey');
			
			$('#jewelryItem').val('');
			$('#jewelryBrand').val('');
			$('#jewelryModel').val('');
			
			$('#jewelryType').val('');
			$('#jewelryKarat').val('');
			$('#jewelryGrams').val('');
			
			$('#grossAmount').val('');
			$('#netAmount').val('');
			$('#CustomerTransactionDetails').val('');
			$('#grantedServiceCharge').val('');
		
		}
		
	});
	
	$('#grossAmount').keyup(function() {
		
		var grossAmountValue 		= $(this).val();
		var varDeductionFirstMonth  = $('#deductFirstMonth').val();
		var doc_stamp_interest 		= $('#docStampInterest').val();
		var first_month_interest 	= $('#firstMonthInterest').val();
		var granter_service_charge 	= $('#grantedServiceCharge').val();
		var total_interest 			=  Number(first_month_interest) + Number(doc_stamp_interest);
		
		if(varDeductionFirstMonth == "yes")
		{
			
			if( $.isNumeric(grossAmountValue) ) {

				var answer = ( total_interest / 100 ) * grossAmountValue;
				
				$('#netAmount').val(Math.floor(grossAmountValue - answer.toFixed(2) - granter_service_charge));
				
			} else {
				
				$('#netAmount').val('');
				$('#grossAmount').val('');
				
				warningDialog('Only numbers allowed!');
			}
			
		} 
		
		if(varDeductionFirstMonth == "no")
		{

			if( $.isNumeric(grossAmountValue) ) {
			
				$('#netAmount').val(grossAmountValue);
				
			} else {
				
				$('#netAmount').val('');
				$('#grossAmount').val('');
				
				warningDialog('Only numbers allowed!');
				
			}
			
		}
		
	});
	
	function warningDialog(errortext)
	{
		Swal.fire({
		  type: 'error',
		  title: 'Error...',
		  text: errortext,
		  showConfirmButton: false,
		  timer: 1000
		});
	}
});
</script>