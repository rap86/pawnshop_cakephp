<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Cash Type</title>
		<style>
		@page  {
					header: html_myHTMLHeader1;
					footer: html_myHTMLFooter1;
					margin-top: 9%;
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
		
			<p style="font-family:arial;">Cash type: <b><?php echo $status; ?></b><br />

			<br />
			Date Converage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
			<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="5">
				<thead>
					<tr>
						<th>Id</th>
						<th>Amount</th>
						<th>Details</th>
						<th>Date</th>
						<th>Time</th>
						<th>User</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach ($datas as $key => $data): ?>
				   
						<?php $total += $data['CashBook'][$status]; ?>
						
						<tr>
							<td><?php echo $data['CashBook']['id']; ?></td>
							<td><?php echo $data['CashBook'][$status]; ?></td>
							<td><?php echo $data['CashBook']['details']; ?></td>
							<td><?php echo $data['CashBook']['date_created']; ?></td>
							<td><?php echo $data['CashBook']['time_created']; ?></td>
							<td><?php echo $users[ $data['CashBook']['user_id'] ]; ?></td>
						</tr>
					<?php endforeach; ?>
						<tr class="success">
							<td>
								<strong>Total</strong>
							</td>
							<td colspan="5">
								<strong><?php echo number_format($total, 0); ?></strong>
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