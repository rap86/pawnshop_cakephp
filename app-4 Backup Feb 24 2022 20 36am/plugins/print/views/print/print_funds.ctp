<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Activity Funds</title>
		<style>
		@page  {
					header: html_myHTMLHeader1;
					footer: html_myHTMLFooter1;
					margin-top: 10%;
					margin-bottom:10%;
					margin-left:40px;
					margin-right:40px;
					margin-header:1%;
					margin-footer:3%;	

				}
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
		
			<h3>Activity Fund: <?php echo ($status == 'credit')? 'Credit':' Debit'; ?></h3>
			<p>Date Converage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
		<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="4">
				<tr class="text-primary active">
					<td style="width:20%; font-weight:bold;">Id</td>
					<td style="width:20%; font-weight:bold;">Amount</td>
					<td style="width:20%; font-weight:bold;">Description</td>
					<td style="width:20%; font-weight:bold;">Date</td>
					<td style="width:20%; font-weight:bold;">Time</td>
				</tr>
				<?php 
				$total_debit = 0;
				$total_credit = 0;
				foreach($results as $key => $value): ?>
					
					<?php 
						if($value['DebitCreditFund']['status'] == 'debit') {
						
							$total_debit += $value['DebitCreditFund']['debit_amount'];
						
						} else {
							
							$total_credit += $value['DebitCreditFund']['credit_amount'];
						
						}
					?>
					
					<tr>
						<td><?php echo $value['DebitCreditFund']['id']; ?></td>
						<td><?php echo ($value['DebitCreditFund']['status'] == 'debit') ? $value['DebitCreditFund']['debit_amount'] : $value['DebitCreditFund']['credit_amount']; ?></td>
						<td><?php echo $value['DebitCreditFund']['description']; ?></td>
						<td><?php echo date('M j, Y', strtotime($value['DebitCreditFund']['date'])); ?></td>
						<td><?php echo date('g:i A', strtotime($value['DebitCreditFund']['time'])); ?></td>
					</tr>
				
				<?php endforeach;  ?>
				
					<tr>
						<td style="font-weight:bold;"></td>
						<td style="font-weight:bold;"><?php echo ($value['DebitCreditFund']['status'] == 'debit') ? $total_debit : $total_credit; ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				
			</table>
		
		<htmlpagefooter name="myHTMLFooter1">
			
			<p style="border-top: 1px solid; black;">Page: {PAGENO} of {nbpg}</p>	
		
		</htmlpagefooter>
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>