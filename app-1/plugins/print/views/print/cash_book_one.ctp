<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Cash Book 1</title>
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
		
			<p style="font-family:arial;">Cash Book 1<br />Date Coverage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
			<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="5">
				<thead>
					<tr>
						<th>DATE</th>
						<th>SB</th>
						<th>EXPENSES</th>
						<th>CASHOUT</th>
						<th>CASHIN</th>
						<th class="success">PAYMENT</th>
						<th class="success">RECEIPT</th>
						<th>ED</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach ($datas as $key => $data): ?>

					<tr>
						<td><?php echo $key; ?></td>
						<td>
							<strong>
								<?php echo $data['starting_balanced_bir'][0]; ?>
							</strong>
						</td>
						<td><?php echo $data['expenses']['expenses']; ?></td>
						<td><?php echo $data['deposit']['deposit']; ?></td>
						<td><?php echo $data['withdrawal']['withdrawal']; ?></td>
						<td class="success"><?php echo $data['book_1']['payment']; ?></td>
						<td class="success"><?php echo $data['book_1']['receipt'] ?></td>
						<td>
							<strong>
								<?php echo number_format($data['ending_balanced_bir'][ count($data['ending_balanced_bir']) -1 ], 0); ?>
							</strong>
						</td>
					</tr>
						
					<?php endforeach; ?>
						<tr class="danger">
						<tr>
							<td>
								<strong>COH</strong>
							</td>
							<td colspan="6"></td>
							<td style="text-align:left; font-weight:bold;" colspan="1">
								<?php echo number_format($data['ending_balanced_bir'][ count($data['ending_balanced_bir']) -1 ], 0);; ?>
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