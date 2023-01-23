<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Cash Book 2</title>
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
		
			<p style="font-family:arial;">Cash Book 2 (1,2 and 3)<br />Date Coverage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
			<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="5">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						
						<th colspan="2" class="w3-center success" style="text-align:center;">Granted 1</th>
						<th colspan="2" class="w3-center warning" style="text-align:center;">Granted 2</th>
						<th colspan="2" class="w3-center info" style="text-align:center;">Granted 3</th>
						
						<th></th>
					</tr>
					<tr>
						<th style="width:8%;">Date</th>
						<th style="width:8%;">SB</th>
						<th style="width:4%;">EXP</th>
						<th style="width:5%;">IN</th>
						<th style="width:5%;">OUT</th>
						<th style="width:5%;">DEP</th>
						<th style="width:5%;">WDL</th>
						<th style="width:8%;">ACCT</th>
						
						
						<th style="width:8%;" class="success">PYMT</th>
						<th style="width:8%;" class="success">RCPT</th>
						
						<th style="width:8%;" class="warning">PYMT</th>
						<th style="width:8%;" class="warning">RCPT</th>
						
						<th style="width:8%;" class="info">PYMT</th>
						<th style="width:8%;" class="info">RCPT</th>
						
						<th style="width:8%;">EB</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach($datas as $key => $data): ?>

					<tr>
						<td><?php echo $key; ?></td>
						<td>
							<strong>
								<?php echo $data['starting_balanced'][0]; ?>
							</strong>
						</td>
						<td><?php echo $data['expenses']['expenses']; ?></td>
						<td><?php echo $data['cashin']['cashin']; ?></td>
						<td><?php echo $data['cashout']['cashout']; ?></td>
						<td><?php echo $data['deposit']['deposit']; ?></td>
						<td><?php echo $data['withdrawal']['withdrawal']; ?></td>
						<td>
							<?php echo number_format($data['ending_bank_balanced'][ count($data['ending_bank_balanced']) -1 ], 0); ?>
						</td>
						
						<td class="success"><?php echo $data['book_1']['payment']; ?></td>
						<td class="success"><?php echo $data['book_1']['receipt'] ?></td>
				
						<td class="warning"><?php echo $data['book_2']['payment']; ?></td>
						<td class="warning"><?php echo $data['book_2']['receipt']; ?></td>
						
						<td class="info"><?php echo $data['book_3']['payment']; ?></td>
						<td class="info"><?php echo $data['book_3']['receipt']; ?></td>
						
						<td>
							<strong>
								<?php echo number_format($data['ending_balanced'][ count($data['ending_balanced']) -1 ], 0); ?>
							</strong>
						</td>
					</tr>
						
					<?php endforeach; ?>
						<tr class="danger">
							<td>
								<strong>COH</strong>
							</td>
							<td colspan="13"></td>
							<td style="text-align:left; font-weight:bold;" colspan="1">
								<?php echo number_format($data['ending_balanced'][ count($data['ending_balanced']) -1 ], 0); ?>
							</td>
						</tr>
				</tbody>
			</table>
		
		<htmlpagefooter name="myHTMLFooter1">
			
			<p style="border-top: 1px solid; black;">Page: {PAGENO} of {nbpg}</p>	
		
		</htmlpagefooter>
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>