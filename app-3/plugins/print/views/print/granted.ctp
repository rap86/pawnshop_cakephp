<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Granted</title>
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
		
			<p style="font-family:arial;">Granted <?php echo $book_id; ?> <br />Date Converage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
			<table border="1" style="width:100%; border-collapse:collapse; font-family:arial; font-size:12px;">
				<thead>
					<tr>
						<th style="width:5%; text-align:center;">Total</th>
						<th style="width:5%; text-align:center;">Granted</th>
						<th style="width:5%; text-align:center;">Id</th>
						<th style="width:13%; text-align:center;">Date</th>
						<th style="width:17%; text-align:center;">Customer</th>
						<th style="width:10%; text-align:center;">Item</th>
						<th style="width:10%; text-align:center;">Item * Type</th>
						<th style="width:10%; text-align:center;">Brand * Karat</th>
						<th style="width:10%; text-align:center;">Model * Weight</th>
						<th style="width:15%; text-align:center;">Details</th>
					</tr>
				</thead>
				<tbody>
							
				   <?php foreach ($datas as $keyDate => $dataOutter): ?>
						
					   <?php 
					   $ctr = 0;
					   foreach ($dataOutter as $keyId => $data): ?>
								
							<?php 
							
							$ctr++;
							$grand_total += $data[0]['CustomerTransaction']['net_amount_duplicate'];

							?>
							<tr>
							
								<?php if($ctr == 1) {?>
									<td style="text-align:center; font-weight:bold;" rowspan="<?php echo count($dataOutter); ?>">
												
										<?php 
										$total = 0;
										foreach ($dataOutter as $keyIdx => $datax): ?>
													<?php $total += $datax[0]['CustomerTransaction']['net_amount_duplicate']; ?>
										<?php endforeach;
											echo  $total;
										?>
										
									</td>
								<?php } ?>
								
								<td style="text-align:center;"><?php echo $data[0]['CustomerTransaction']['net_amount_duplicate']; ?></td>
								<td style="text-align:center;"><?php echo $data[0]['CustomerTransaction']['id']; ?></td>
								<td style="text-align:center;"><?php echo date('M j, Y g:i A', strtotime($data[0]['CustomerTransaction']['sangla_date'].' '.$data[0]['CustomerTransaction']['sangla_time'])); ?></td>							
								
								<td style="text-align:center;"><?php echo $data[0]['Customer']['first_name'].' '.$data[0]['Customer']['middle_name'].' '.$data[0]['Customer']['last_name']; ?></td>
								<td style="text-align:center;"><?php echo $data[0]['Item']['name']; ?></td>
								<td style="text-align:center;">
									<?php echo $data[0]['CustomerTransaction']['item_type']; ?>
									*
									<?php echo $data[0]['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td style="text-align:center;">
									<?php echo $data[0]['CustomerTransaction']['brand']; ?>
									*
									<?php echo $data[0]['CustomerTransaction']['karat']; ?>
								</td>
								<td style="text-align:center;">
									<?php echo $data[0]['CustomerTransaction']['model']; ?>
									*
									<?php echo $data[0]['CustomerTransaction']['weight']; ?>
								</td>
								<td style="text-align:center;">
									<?php echo $data[0]['CustomerTransaction']['details']; ?>
								</td>
							</tr>
							
						<?php endforeach; ?>
						
					<?php endforeach; ?>
					<tr>
						<td style="text-align:center; font-weight:bold; color:red;"><?php echo $grand_total; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		
		<htmlpagefooter name="myHTMLFooter1">
			
			<p style="border-top: 1px solid; black;">Page: {PAGENO} of {nbpg}</p>	
		
		</htmlpagefooter>
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>