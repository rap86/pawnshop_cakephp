<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Item Book</title>
		<style>
		@page  {
					header: html_myHTMLHeader1;
					footer: html_myHTMLFooter1;
					margin-top: 10%;
					margin-bottom:10%;
					margin-left:40px;
					margin-right:40px;
					margin-header:4%;
					margin-footer:3%;	

				}
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
		
			<p style="font-family:arial;">BOOK: 
				<?php 
				if($book_id == 1) {
					echo '1';
				} elseif($book_id == 2) {
					echo '2';
				} else {
					echo '3';
				}
				
			?><br />Date Converage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
		<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="4">
				<tr class="text-primary active">
					<td>Id</td>
					<td>Book Id</td>
					<td>Item</td>
					<td>Date Pawned</td>
					<td>Net Amount</td>
					<td>Status</td>
				</tr>
				<?php 
				foreach($item_book as $key => $value): ?>
					
					<tr>
						<td><?php echo $value['CustomerTransaction']['id']; ?></td>
						<td><?php echo $value['CustomerTransaction']['book_id']; ?></td>
						<td><?php echo (trim($value['CustomerTransaction']['item_type']) != '')? $value['CustomerTransaction']['item_type'] : $value['CustomerTransaction']['jewelry_type']; ?></td>
						<td><?php echo date('M j, Y g:i A', strtotime($value['CustomerTransaction']['sangla_date'].' '.$value['CustomerTransaction']['sangla_time'])); ?></td>
						<td><?php echo $value['CustomerTransaction']['net_amount_duplicate']; ?></td>
						<td><?php echo $value['CustomerTransaction']['status']; ?></td>
					</tr>
				
				<?php endforeach;  ?>
				
			</table>
		
		<htmlpagefooter name="myHTMLFooter1">
			
			<p style="border-top: 1px solid; black;">Page: {PAGENO} of {nbpg}</p>	
		
		</htmlpagefooter>
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>