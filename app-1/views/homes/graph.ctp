<?php 
$sample = 'sample=[';
foreach($holder as $key=>$value): ?>
	
	<?php


	$sample .= '{';
	$sample .= 'y:'.'\''.$value['DebitCreditFund']['date'].'\', ';
	$sample .= ' a:'.$value['DebitCreditFund']['credit'].', ';
	$sample .= ' b:'.$value['DebitCreditFund']['debit'];
	$sample .= '},';
	
	?>
	
<?php endforeach;

$sample .= ']';

?>

<div class="row">
	<div class="col-lg-12">
		<br />
		<?php echo $this->Form->create('DebitCreditFund', array('action'=>'graph')); ?>
		<br />	
		<div class="w3-row-padding w3-light-grey w3-padding w3-border">
		  <div class="w3-quarter">
			<input class="w3-input w3-border" type="text" name="data[DebitCreditFund][date_from]" value="<?php echo $date['date_from']?>" placeholder="From" id="dateFrom">
		  </div>
		  <div class="w3-quarter">
			<input class="w3-input w3-border" type="text" name="data[DebitCreditFund][date_to]" value="<?php echo $date['date_to']; ?>" placeholder="To" id="dateTo">
		  </div>
		  <div class="w3-quarter">
			<button class="w3-button w3-dark-grey w3-block w3-round-small">LOAD</button>
		  </div>
		   <div class="w3-quarter">
			<a href="/print/print/print_graph/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
		  </div>
		</div>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>
	
<div class="row">
	<div class="col-lg-12">
		<br />
		<!-- /.panel -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Graphical representation of Debit and Credit</h4>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div id="morris-bar-chart"></div>
					</div>
					<!-- /.col-lg-8 (nested) -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
	</div>
</div>
	
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/raphael/raphael.min.js"></script>
<script src="/vendor/morrisjs/morris.min.js"></script>

<script>
    Morris.Bar({
        element: 'morris-bar-chart',
        data: <?php echo $sample; ?>,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Credit', 'Debit'],
        hideHover: 'auto',
        resize: true,
		xLabelAngle: 60,
    });
</script>