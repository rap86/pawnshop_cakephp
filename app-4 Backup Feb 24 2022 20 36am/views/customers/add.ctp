<style>
#myTab li a {background-color:#ccccb3; border-top-left-radius:2px; border-top-right-radius:2px; }
#myTab li.active a {border-bottom-color: transparent;background-color:white; }
</style>
<?php echo $this->element('header_background_color'); ?>

<?php echo $this->Form->create('Customer', array("action"=>"add", 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data')); ?>	
<?php echo $this->Form->hidden('customer_image', array('class'=>'form-control', 'label'=>false, 'id'=>'customerPhoto')); ?>
	
<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;">Add Customer</h3>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#menu1" data-toggle="tab">Information</a>
			</li>
			<li><a href="#menu2" data-toggle="tab">Image</a>
			</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane fade in active" id="menu1">
				<div class="col-md-6">
					<br />
					<div class="panel panel-default">
						<div class="panel-heading" id="headerBackgroundColor">
							<h4>Customer Information</h4>
						</div>
						<div class="panel-body">
							<div class="table table-responsive">
								<table class="table table-bordered">
									<tr>
										<td style="width:40%;">First name</td>
										<td style="width:60%;"><?php echo $this->Form->input('first_name', array('class'=>'w3-input w3-border w3-light-grey w3-xlarge', 'label'=>false)); ?></td>
									</tr>
									<tr>
										<td>Middle name</td>
										<td><?php echo $this->Form->input('middle_name', array('class'=>'w3-input w3-border w3-light-grey w3-xlarge', 'label'=>false)); ?></td>
									</tr>
									<tr>
										<td>Last name</td>
										<td><?php echo $this->Form->input('last_name', array('class'=>'w3-input w3-border w3-light-grey w3-xlarge', 'label'=>false)); ?></td>
									</tr>
									<tr>
										<td>Gender</td>
										<td><?php echo $this->Form->input('gender', array('class'=>'w3-input w3-border w3-light-grey w3-xlarge', 'label'=>false, 'type'=>'select', 'options'=>array(''=>'','male'=>'Male', 'female'=>'Female'))); ?></td>
									</tr>
									<tr>
										<td>Birthdate</td>
										<td><?php echo $this->Form->input('birthdate', array('class'=>'w3-input w3-border w3-light-grey', 'id'=>'patientBirthday', 'label'=>false, 'type'=>'text', 'placeholder'=>'yyyy-mm-dd')); ?></td>
									</tr>
									<tr>
										<td>Age</td>
										<td><?php echo $this->Form->input('age', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'type'=>'text')); ?></td>
									</tr>
									<tr>
										<td>Marital Status</td>
										<td><?php echo $this->Form->input('marital_status', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'type'=>'select', 'options'=>array(''=>'', 'single'=>'Single', 'married'=>'Married'))); ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td><?php echo $this->Form->input('email', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
									</tr>
									<tr>
										<td>Contact No</td>
										<td><?php echo $this->Form->input('number', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
									</tr>
									<tr>
										<td>Occupation</td>
										<td><?php echo $this->Form->input('occupation', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
									</tr>
									<tr>
										<td>Address</td>
										<td><?php echo $this->Form->input('address', array('type'=>'textarea', 'class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?></td>
									</tr>
								</table>
							</div>
						</div>
						<!--/.panel-body-->
					</div>
				</div>
				<!--/.col-md-6-->
			</div>
			<!--/#menu1-->
			
			<div class="tab-pane fade" id="menu2">
				<div class="col-lg-6 col-md-6">
					<br />
					<div class="panel panel-default">
						<div class="panel-heading" id="headerBackgroundColor">
							<h4>Image Preview</h4>
						</div>
						<div class="panel-body">
							<div style="min-height: 344px;" class="w3-container w3-center" id="results">
								<img src="/images/img_avatar.png" class="img-thumbnail" alt="avatar" id="patientImageFrame" width="300" height="200">
								<h6>Upload photo...</h6>
							</div>
						</div>
						<div class="panel-footer">
							<div class="w3-section">
								<input name="data[image_name]" type="file" class="btn btn-default form-control file-upload patientImagePreview" id="patientImage">
							</div>
						</div>
					</div>
				</div>
				<!--col-lg-6-->
				
				<div class="col-lg-6 col-md-6">
					<br />
					<div class="panel panel-default">
						<div class="panel-heading" id="headerBackgroundColor">
							<h4>Webcam</h4>
						</div>
						<div class="panel-body">
							<div class="w3-container" style="min-height:344px;" id="my_camera">
								
							</div>
						</div>
						<!--panel body-->
						<div class="panel-footer">
							<div class="w3-section">
								<div class="btn btn-default btn-block" onClick="take_snapshot()">Take a Photo</div>
							</div>	
						</div>
					</div>
					<!--panel-->
					
				</div>
				<!--/.col-lg-6-->
				
			</div>
			<!--/#menu2-->
			
		</div>
		<!-- /.tab-content-->
		
	</div>
	<!-- /.col-lg-12-->
</div>
<!-- /.row -->
<div style="margin-left:10px; display:none;">
	<?php echo $this->Form->submit(__('Submit Information',true), array('class'=>'w3-button w3-dark-grey w3-round-small', 'id'=>'submitCustomerDetails')); ?>
	<?php echo $this->Form->end(); ?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="w3-container">
			<div>
				<button data-toggle="modal" data-target="#myModalTransactionConfirmation" class="w3-btn w3-dark-grey w3-round-small">Submit Information</button>
				<hr />
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalTransactionConfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<input name="data[PrincipalAmount][id]" class="w3-input w3-border w3-light-grey" type="hidden"  id="editPrincipalId">
		
		<div class="modal-content">
			<div class="modal-header w3-teal">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure all customer details are correct ? if so, then click submit</p>
			</div>
			<div class="modal-footer">
				<button type="submit" class="w3-button w3-light-grey w3-border w3-round-small pull-left" id="btnConfirmation">Submit</button>
				<button type="button" class="w3-button w3-light-grey w3-border w3-round-small" data-dismiss="modal">Cancel</button>
			</div>
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
				
					
				Webcam.upload( data_uri, 'customer_image', function(code, text) {
					// console.log(text);
					var imageText = text.slice(12);
					var imageName = imageText.slice(0, -4);
					// console.log(imageName);
					document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
					document.getElementById('customerPhoto').value = imageName; 
					
				} );
				
			} );
	}
</script>
<script>
$(document).ready(function() {

	$('button#btnConfirmation').click(function() {
		
		Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, save it!'
			}).then((result) => {
			  if (result.value) {
				
				$('#submitCustomerDetails').trigger('click');
				
			  } else {
			  
				location.reload();
			  
			  }
			})
	});
	
	
	var readURL = function(input) {
		
        if (input.files && input.files[0]) {
			
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#patientImageFrame').attr('src', e.target.result);
				
            }
    
            reader.readAsDataURL(input.files[0]);
			
        }
    }
    

    $("#patientImage").on('change', function(){
        readURL(this);
		
    });
});
</script>