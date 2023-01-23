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
		
			<p style="font-family:arial;">Monthly Report<br />Date Coverage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
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
						
						<th colspan="3" class="w3-center success" style="text-align:center;">BOOK 1</th>
						<th colspan="3" class="w3-center warning" style="text-align:center;">BOOK 2</th>
						<th colspan="3" class="w3-center info" style="text-align:center;">BOOK 3</th>
						
						<th></th>
					</tr>
					<tr>
						<th style="width:6%;">Date</th>
						<th style="width:6%;">SB</th>
						<th style="width:6%;">EXP</th>
						<th style="width:6%;">DEP</th>
						<th style="width:6%;">WDL</th>
						
						
						<th style="width:6%;" class="success">GRAND</th>
						<th style="width:6%;" class="success">TOTC</th>
						<th style="width:6%;" class="success">INT</th>
						
						<th style="width:6%;" class="warning">GRAND</th>
						<th style="width:6%;" class="warning">TOTC</th>
						<th style="width:6%;" class="warning">INT</th>
						
						<th style="width:6%;" class="info">GRAND</th>
						<th style="width:6%;" class="info">TOTC</th>
						<th style="width:6%;" class="info">INT</th>
						
						<th style="width:6%;">EB</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach($datas as $key => $data): ?>
					
					<?php 
						
						$others['expenses']			+=$data['expenses']['expenses'];
						$others['deposit']			+=$data['deposit']['deposit'];
						$others['withdrawal']		+=$data['withdrawal']['withdrawal'];
						
						$book1['pawned'] 			+= $data['book_1']['pawned'];
						$book1['total_capital'] 	+= $data['book_1']['total_capital'];
						$book1['total_interest'] 	+= $data['book_1']['total_interest'];
						
						$book2['pawned'] 			+= $data['book_2']['pawned'];
						$book2['total_capital'] 	+= $data['book_2']['total_capital'];
						$book2['total_interest'] 	+= $data['book_2']['total_interest'];
						
						$book3['pawned'] 			+= $data['book_3']['pawned'];
						$book3['total_capital'] 	+= $data['book_3']['total_capital'];
						$book3['total_interest'] 	+= $data['book_3']['total_interest'];
					?>
					
					<tr>
						<td><?php echo $key; ?></td>
						<td>
							<strong>
								<?php echo $data['starting_balanced'][0]; ?>
							</strong>
						</td>
						<td><?php echo $data['expenses']['expenses']; ?></td>
						<td><?php echo $data['deposit']['deposit']; ?></td>
						<td><?php echo $data['withdrawal']['withdrawal']; ?></td>
						<td class="success"><?php echo $data['book_1']['pawned']; ?></td>
						<td class="success"><?php echo $data['book_1']['total_capital'] ?></td>
						<td class="success"><?php echo $data['book_1']['total_interest'] ?></td>
				
						<td class="warning"><?php echo $data['book_2']['payment']; ?></td>
						<td class="warning"><?php echo $data['book_2']['total_capital']; ?></td>
						<td class="warning"><?php echo $data['book_2']['total_interest']; ?></td>
						
						<td class="info"><?php echo $data['book_3']['pawned']; ?></td>
						<td class="info"><?php echo $data['book_3']['total_capital']; ?></td>
						<td class="info"><?php echo $data['book_3']['total_interest']; ?></td>
						
						<td>
							<strong>
								<?php echo number_format($data['ending_balanced'][ count($data['ending_balanced']) -1 ], 0); ?>
							</strong>
						</td>
					</tr>
						
					<?php endforeach; ?>
					
						<tr>
							<td class="w3-text-red">TOTAL</td>
							<td></td>
							<td><?php echo $others['expenses']; ?></td>
							<td><?php echo $others['deposit']; ?></td>
							<td><?php echo $others['withdrawal']; ?></td>
							
							<td class="success w3-text-red"><?php echo $book1['pawned']; ?></td>
							<td class="success w3-text-red"><?php echo $book1['total_capital']; ?></td>
							<td class="success w3-text-red"><?php echo $book1['total_interest']; ?></td>
							
							<td class="warning w3-text-red"><?php echo $book2['pawned']; ?></td>
							<td class="warning w3-text-red"><?php echo $book2['total_capital']; ?></td>
							<td class="warning w3-text-red"><?php echo $book2['total_interest']; ?></td>
							
							<td class="info w3-text-red"><?php echo $book3['pawned']; ?></td>
							<td class="info w3-text-red"><?php echo $book3['total_capital']; ?></td>
							<td class="info w3-text-red"><?php echo $book3['total_interest']; ?></td>
							<td></td>
						</tr>
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