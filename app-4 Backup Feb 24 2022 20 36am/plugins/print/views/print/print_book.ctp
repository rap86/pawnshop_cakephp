<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Cash Book</title>
		<style>
		@page  {
					header: html_myHTMLHeader1;
					footer: html_myHTMLFooter1;
					margin-top: 8%;
					margin-bottom:10%;
					margin-left:40px;
					margin-right:40px;
					margin-header:3%;
					margin-footer:3%;	

				}
				table thead tr th { text-align:left; }
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
		
			<p style="font-family:arial;">Granted Book: <?php echo $book; ?></p>

		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
			<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="5">
				<thead>
					<tr>
						<th>No.</th>
						<th>Customer</th>
						<th>Last Payment</th>
						<th>Date Diff</th>
						<th>Item Type</th>
						<th>Jewelty Type</th>
						<th>PT No.</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$i = 1;
				$total = 0;
				foreach($results as $keyPawn1 => $valuePawn1): ?>
				
					<?php $total = $total + $valuePawn1['CustomerTransaction']['net_amount_duplicate']; ?>	
					<tr>
						<td><?php echo $i++; ?></td>
						<td>
							<?php echo $valuePawn1['Customer']['first_name'].' '.$valuePawn1['Customer']['middle_name'].' ' .$valuePawn1['Customer']['last_name']; ?>
						</td>
						<td>
							<?php echo $valuePawn1['TransactionInterestPayment']['payment_starting_date']; ?>
						</td>
						<td>
							<?php echo $valuePawn1['TransactionInterestPayment']['date_diff']; ?>
						</td>
						<td>
							<?php echo $valuePawn1['CustomerTransaction']['item_type']; ?>
						</td>
						<td>
							<?php echo $valuePawn1['CustomerTransaction']['jewelry_type']; ?>
						</td>
						<td class="w3-center">
							<?php echo $valuePawn1['TransactionInterestPayment']['pt_number']; ?>
						</td>
					</tr>
					
				<?php endforeach; ?>
				</tbody>
			</table>
			<p><strong>Total: <?php echo $total; ?></strong></p>
		<htmlpagefooter name="myHTMLFooter1">
			
			<p style="border-top: 1px solid; black;">Page: {PAGENO} of {nbpg}</p>	
		
		</htmlpagefooter>
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>