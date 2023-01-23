<link href="/swal/sweetalert2.min" rel="stylesheet" type="text/css">
<script src="/swal/sweetalert2.all.min.js"></script>
<script src="/vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {

	Swal.fire({
		  type: 'error',
		  title: 'Oops',
		  text: '<?php echo $message ?>',
		  showConfirmButton: false,
		  timer: 1500
		});

});
</script>