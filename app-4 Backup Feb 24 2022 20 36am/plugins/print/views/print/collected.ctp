<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Collected</title>
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
				table thead tr th { text-align:center; }
				table tbody tr td { text-align:center; }
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
		
			<p style="font-family:arial;">Collected <?php echo $book_id; ?> <br />Date Converage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
			<table border="1" style="width:100%; border-collapse:collapse; font-family:arial; font-size:12px;">
				<thead>
					<tr>
						<th style="width:10%;">Total</th>
						<th style="width:10%;" data-aka="interest">Collected</th>
						<th style="width:5%;">SC</th>
						<th style="width:5%;">PT No.</th>
						<th style="width:15%;">Payment Date</th>
						<th style="width:18%;">Customer</th>
						<th style="width:10%;">Item</th>
						<th style="width:7%;">OR No.</th>
						<th style="width:10%;">Details</th>
					</tr>
				</thead>
				<tbody>
							
				   <?php foreach ($datas as $keyDate => $dataOutter): ?>
						
					   <?php 
					   $ctr = 0;
					   foreach ($dataOutter as $keyId => $data): ?>
								
							<?php 
							
							$ctr++;
							$grand_total += $data[0]['CashBook']['interest_amount'] + 
										  $data[0]['CashBook']['sold'] + 
										  $data[0]['CashBook']['redeemed'] + 
										  $data[0]['CashBook']['less_principal'] +
										  $data[0]['CashBook']['service_charge'];
										  
							$collected +=	$data[0]['CashBook']['interest_amount'] + 
											$data[0]['CashBook']['sold'] + 
											$data[0]['CashBook']['redeemed'] + 
											$data[0]['CashBook']['less_principal'];		  

							?>
							<tr>
							
								<?php if($ctr == 1) {?>
									<td style="text-align:center; font-weight:bold;" rowspan="<?php echo count($dataOutter); ?>">
												
										<?php 
										$total = 0;
										foreach ($dataOutter as $keyIdx => $datax): ?>
													<?php 
													  $total += $datax[0]['CashBook']['interest_amount'] + 
															    $datax[0]['CashBook']['sold'] + 
															    $datax[0]['CashBook']['redeemed'] + 
															    $datax[0]['CashBook']['less_principal'] + 
															    $datax[0]['CashBook']['service_charge'];
													  ?>
										<?php endforeach;
											echo  $total;
										?>
										
									</td>
								<?php } ?>
								
									<td>
										<?php echo $collected; ?>
									</td>
									<td><?php echo $data[0]['CashBook']['service_charge']; ?></td>
									<td><?php echo $data[0]['CashBook']['pt_number']; ?></td>
									<td><?php echo date('M j, Y g:i A', strtotime($data[0]['CashBook']['date_created'].' '.$data[0]['CashBook']['time_created'])); ?></td>							
									
									<td><?php echo $data[0]['Customer']['first_name'].' '.$data[0]['Customer']['middle_name'].' '.$data[0]['Customer']['last_name']; ?></td>
									<td><?php echo $data[0]['Item']['name']; ?></td>
									<td><?php echo $data[0]['CashBook']['or_number']; ?></td>
									<td><?php echo $data[0]['CashBook']['details']; ?></td>
								
							</tr>
							
						<?php 
						$collected = 0;
						endforeach; ?>
						
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
					</tr>
				</tbody>
			</table>
		
		<htmlpagefooter name="myHTMLFooter1">
			
			<p style="border-top: 1px solid; black;">Page: {PAGENO} of {nbpg}</p>	
		
		</htmlpagefooter>
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>