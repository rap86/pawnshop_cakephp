 <?php
 
	$noPtNumbers 	= array();
	$for_auction 	= array();
	$pawn		 	= array();
	$granted_total = 0;
	$book1_total = 0;
	$book2_total = 0;
	$book3_total = 0;
	
	/*
	echo '<pre>';
	print_r($datas);
	echo '</pre>';
	*/
	
 foreach($datas as $key => $value)
 {
	$granted_total = $granted_total + $value['CustomerTransaction']['net_amount_duplicate'];
	 
	 if(isset($value['TransactionInterestPayment']) && !empty($value['TransactionInterestPayment']))
	 {
		

		if($value['TransactionInterestPayment']['status'] == 'unpaid') 
		{
			
			$dueDate 		= date($value['TransactionInterestPayment']['payment_starting_date']);
			$dateNow 		= date('Y-m-d');
			$startDate      = new DateTime($dueDate); 
			$endDate   		= new DateTime($dateNow); 
			$diffDate		= $startDate->diff($endDate); 
			
			$this->yearPayment     = $diffDate->format('%y'); 
			$this->monthPayment    = $diffDate->format('%m'); 
			$this->dayPayment      = $diffDate->format('%d');
			
			$value['TransactionInterestPayment']['date_diff'] = 'Y'.$this->yearPayment.'-'.'M'.$this->monthPayment.'-'.'D'.$this->dayPayment;

			if($this->yearPayment == 0 && $this->monthPayment >= $value['CustomerTransaction']['month_before_remata'] || $this->yearPayment >= 1) 
			{
				$for_auction[ $key ] = $value;
				//$textColor = 'w3-text-red';
			}
		} 
		else 
		{
			
			if($value['TransactionInterestPayment']['status'] == 'paid') 
			{
				$value['TransactionInterestPayment']['pt_number'] = "";
				$noPtNumbers[ $key ] = $value;
				$textColor = '';
				
			} 
			else 
			{
				if($value['TransactionInterestPayment']['status'] == '')
				{
					$noPtNumbers[ $key ] = $value;
					$textColor = '';
				}
				
			}
			
		}
		
	 }
	/*
	Pawnted tab, i display lang per book 1,2, and 3
	*/

	if($value['CustomerTransaction']['book_id'] == 1)
	{
		$pawn_book1[ $value['CustomerTransaction']['id'] ] = $value;
		$book1_total = $book1_total + $value['CustomerTransaction']['net_amount_duplicate'];
	} 
	if($value['CustomerTransaction']['book_id'] == 2)
	{
		$pawn_book2[ $value['CustomerTransaction']['id'] ] = $value;
		$book2_total = $book2_total + $value['CustomerTransaction']['net_amount_duplicate'];
	} 
	if($value['CustomerTransaction']['book_id'] == 3)
	{	
		$pawn_book3[ $value['CustomerTransaction']['id'] ] = $value;
		$book3_total = $book3_total + $value['CustomerTransaction']['net_amount_duplicate'];
	}
	 
	 
		

	foreach($for_auction as $keyAuction => $valueAuction)
	{
		if($valueAuction['CustomerTransaction']['book_id'] == 1)
		{
			$forauction_book1[ $valueAuction['CustomerTransaction']['id'] ] = $valueAuction;
			
		} 
		if($valueAuction['CustomerTransaction']['book_id'] == 2)
		{
			$forauction_book2[ $valueAuction['CustomerTransaction']['id'] ] = $valueAuction;
			
		} 
		if($valueAuction['CustomerTransaction']['book_id'] == 3)
		{	
			$forauction_book3[ $valueAuction['CustomerTransaction']['id'] ] = $valueAuction;
		}
	}
		/*
		echo '<pre>';
		print_r($pawn_book1);
		echo '</pre>';
		*/
 }
?>
	
<style>
#myTab li a { 
	background-color:#ccccb3;
	border-top-left-radius:2px; 
	border-top-right-radius:2px; 
}
#myTab li.active a {
	border-bottom-color:transparent;
	background-color:white; 
}

#myTab2 li a { 
	background-color:#ccccb3;
	border-top-left-radius:2px; 
	border-top-right-radius:2px; 
}
#myTab2 li.active a {
	border-bottom-color:transparent;
	background-color:white; 
}
</style>

<div class="row">
	<div class="col-lg-12">
		<h3 style="border-bottom:1px solid #e5e5cc;" class="w3-pale-red w3-padding w3-border w3-border-red">
			Pawned |
			<a href="/print/print/print_book/1/pawned" target="_blank" class="btn btn-danger">Print Book 1</a> | 
			<a href="/print/print/print_book/2/pawned" target="_blank" class="btn btn-danger">Print Book 2</a> |
			<a href="/print/print/print_book/3/pawned" target="_blank" class="btn btn-danger">Print Book 3</a>
		</h3>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a href="#menu1" data-toggle="tab">Pawned <span class="w3-badge w3-red"><?php echo count($datas); ?></span></a>
			</li>
			<li>
				<a href="#menu2" data-toggle="tab">Ready for Auction <span class="w3-badge w3-red"><?php echo count($for_auction); ?></span></a>
			</li>
			<li>
				<a href="#menu3" data-toggle="tab">NO PT Number <span class="w3-badge w3-red"><?php echo count($noPtNumbers); ?></span></a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content my-tab">
		
			<div class="tab-pane fade in active" id="menu1">
				<div class="w3-margin-top w3-border-red w3-leftbar">
					<p class="w3-border-bottom"> &emsp; Transaction here are less than Four (4) Months </p>
				</div>
				<ul class="nav nav-tabs" id="myTab2">
					<li class="active">
						<a href="#book1" data-toggle="tab">Book 1  <span class="w3-badge w3-red"><?php echo count($pawn_book1); ?></span> | <?php echo $book1_total; ?></a>
					</li>
					<li>
						<a href="#book2" data-toggle="tab">Book 2 <span class="w3-badge w3-red"><?php echo count($pawn_book2); ?></span> |  <?php echo $book2_total; ?></a>
					</li>
					<li>
						<a href="#book3" data-toggle="tab">Book 3 <span class="w3-badge w3-red"><?php echo count($pawn_book3); ?></span> |  <?php echo $book3_total; ?></a>
					</li>
				</ul>
				<div class="tab-content my-tab">
					<div class="tab-pane fade in active" id="book1">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<?php echo $this->element('pawn_index', array('pawn_book1' => $pawn_book1)); ?>
						</table>
					</div>
					
					<div class="tab-pane fade" id="book2">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<?php echo $this->element('pawn_index', array('pawn_book1' => $pawn_book2)); ?>
						</table>
					</div>
					
					<div class="tab-pane fade" id="book3">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<?php echo $this->element('pawn_index', array('pawn_book1' => $pawn_book3)); ?>
						</table>
					</div>
				</div>
				
			</div>
			
			<div class="tab-pane fade" id="menu2">
				<div class="w3-margin-top w3-border-red w3-leftbar">
					<p class="w3-border-bottom"> &emsp; Transaction here are greater than Four (4) Months </p>
				</div>
				<ul class="nav nav-tabs" id="myTab2">
					<li class="active">
						<a href="#for_auction_book1" data-toggle="tab">Book 1  <span class="w3-badge w3-red"><?php echo count($forauction_book1); ?></span></a>
					</li>
					<li>
						<a href="#for_auction_book2" data-toggle="tab">Book 2 <span class="w3-badge w3-red"><?php echo count($forauction_book2); ?></span></a>
					</li>
					<li>
						<a href="#for_auction_book3" data-toggle="tab">Book 3 <span class="w3-badge w3-red"><?php echo count($forauction_book3); ?></span></a>
					</li>
				</ul>
				<div class="tab-content my-tab">
					<div class="tab-pane fade in active" id="for_auction_book1">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<?php echo $this->element('pawn_index', array('pawn_book1' => $forauction_book1)); ?>
						</table>
					</div>
					
					<div class="tab-pane fade" id="for_auction_book2">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<?php echo $this->element('pawn_index', array('pawn_book1' => $forauction_book2)); ?>
						</table>
					</div>
					
					<div class="tab-pane fade" id="for_auction_book3">
						<br />
						<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
							<?php echo $this->element('pawn_index', array('pawn_book1' => $forauction_book3)); ?>
						</table>
					</div>
				</div>
				
			</div>
			
			<div class="tab-pane fade" id="menu3">
				<div class="w3-margin-top w3-border-red w3-leftbar">
					<p class="w3-border-bottom"> &emsp; Transaction here are no PT Number</p>
				</div>
				<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
					<?php echo $this->element('pawn_index', array('pawn_book1' => $noPtNumbers)); ?>
				</table>
			</div>
			
		</div>
		<p style="font-size:24px;"><b>Total Granted Amount:</b> <span style="font-weight:bold; color:red;"><?php echo $granted_total; ?></span><p>
		<br />
	</div>
	<!-- /.col-lg-12 -->

</div>
<!-- /.row -->

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
	
	$('table#dataTablesUsers').DataTable({
		responsive: true,
		"pageLength": 25
	});
	
});
</script>