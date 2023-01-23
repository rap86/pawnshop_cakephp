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
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Graph</title>
		<style>
		@page  {
					header: html_myHTMLHeader1;
					footer: html_myHTMLFooter1;
					margin-top: 10%;
					margin-bottom:10%;
					margin-left:40px;
					margin-right:40px;
					margin-header:3%;
					margin-footer:3%;	

				}
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
		
			<h3>Graphical representation of Debit and Credit</h3>
			<p>Date Converage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
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
				</div>
			</div>
		
		<htmlpagefooter name="myHTMLFooter1">
			
			<p style="border-top: 1px solid; black;">Page: {PAGENO} of {nbpg}</p>	
		
		</htmlpagefooter>
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>

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
        resize: true
    });
</script>