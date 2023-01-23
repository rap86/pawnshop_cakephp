<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="login-panel w3-card-4">
			<div class="panel-heading w3-teal w3-padding-24">
				<h3 class="panel-title w3-xxlarge" style="text-align:center;"><span class="w3-text-black">Pawn</span><span>shop</span></h3>
				<span style="color:white; text-align:center;">
					<?php echo $session->flash('auth'); ?>
					<?php echo $this->Session->flash(); ?>
				</span>
			</div>
			<div class="panel-body w3-white">
				<?php echo $this->Form->create('User', array("action"=>"login", 'class'=>'w3-container w3-white')); ?>

					<div class="form-group">
						<?php echo $this->Form->input('username', array('label'=>false, 'class'=>'w3-input w3-border w3-light-grey', 'id'=>'inputUsername', 'placeholder'=>'Username', 'style'=>'text-align:center; font-size:30px;')); ?>
					</div>
					<div class="form-group">
						<?php echo $this->Form->input('password', array('label'=>false, 'class'=>'w3-input w3-border w3-light-grey', 'placeholder'=>'Password', 'style'=>'text-align:center; font-size:30px;')); ?>
					</div>
			</div>
			<div>
				<?php echo $this->Form->button(__('<i class="fa fa-sign-in"></i> Submit',true), array('class'=>'w3-btn w3-dark-gray btn-block')); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$(document).bind("contextmenu",function(e){
		 Swal.fire({
			  position: 'top',
			  type: 'error',
			  title: 'Right click is disabled!',
			  showConfirmButton: false,
			  timer: 1000
		});
	 return false;
   });
	
	document.getElementById('inputUsername').focus();
	$("div.alert").fadeOut(3000);
	$("div#flashMessage").fadeOut(2000);
	$("div#authMessage").fadeOut(2000);
	$("div.alert").siblings("br").fadeOut(3000);
	$("input[type=text]").attr('autocomplete', 'off');
});
</script>