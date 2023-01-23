<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>SOA</title>
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
		
			<h3>State Of Account (SOA)</h3>
			<p>Date Converage From: <?php echo date('M j, Y', strtotime($date['from'])); ?>  To: <?php echo date('M j, Y', strtotime($date['to'])); ?></p>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
			<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="4">
				<tr class="text-primary active">
					<td>Id</td>
					<td>Debit Id</td>
					<td>Credit Id</td>
					<td>Description</td>
					<td>Debit</td>
					<td>Credit</td>
					<td>Balanced</td>
					<td>Datetime</td>
				</tr>
				<?php 
				$debit_count = 0;
				$credit_count = 0;
				foreach($debit_credit_funds as $key => $value): ?>
					
					<?php 
						if($value['DebitCreditFund']['status'] == 'debit') 
						{
							$total_debit += $value['DebitCreditFund']['debit_amount'];
							$debit_count++;
						} else {
						
							$total_credit += $value['DebitCreditFund']['credit_amount'];
							$credit_count++;
						}
					
					?>

					
					<tr>
						<td><?php echo $value['DebitCreditFund']['id']; ?></td>
						<td><?php echo ($value['DebitCreditFund']['debit_id'] == 0) ? '' : $value['DebitCreditFund']['debit_id']; ?></td>
						<td><?php echo ($value['DebitCreditFund']['credit_id'] == 0) ? '' : $value['DebitCreditFund']['credit_id']; ?></td>
						<td><?php echo $value['DebitCreditFund']['description']; ?></td>
						<td><?php echo $value['DebitCreditFund']['debit_amount']; ?></td>
						<td><?php echo $value['DebitCreditFund']['credit_amount']; ?></td>
						<td><?php echo $value['DebitCreditFund']['balanced']; ?></td>
						<td><?php echo date('M j, Y g:i A', strtotime($value['DebitCreditFund']['date'].' '.$value['DebitCreditFund']['time'])); ?></td>
						<!--td>
							<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $value['DebitCreditFund']['id']), array('class'=>'w3-button w3-border w3-border-green w3-hover-green w3-round-small')); ?>
							<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $value['DebitCreditFund']['id']), array('class'=>'w3-button w3-border w3-border-red w3-hover-red w3-round-small'), sprintf(__('Are you sure you want to delete # %s?', true), $value['DebitCreditFund']['id'])); ?>
							
						</td-->
					</tr>
				
				<?php endforeach;  ?>
					<tr class="danger">
						<td></td>
						<td></td>
						<td></td>
						<td>ENDING BALANCED</td>
						<td></td>
						<td></td>
						<td><b><?php echo $debit_credit_funds[ count($debit_credit_funds) - 1 ]['DebitCreditFund']['balanced'];?></td>
						<td></td>
					</tr>
					<tr class="success">
						<td></td>
						<td></td>
						<td></td>
						<td>TOTAL DEBIT</td>
						<td><b><?php echo ($total_debit == 0)? '' : $total_debit; ?></b></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="info">
						<td></td>
						<td></td>
						<td></td>
						<td>TOTAL CREDIT</td>
						<td></td>
						<td><b><?php echo ($total_credit == 0)? '' : $total_credit; ?></b></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="success">
						<td></td>
						<td></td>
						<td></td>
						<td># of Debit(s) : <?php echo $debit_count; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="info">
						<td></td>
						<td></td>
						<td></td>
						<td># of Credit(s) : <?php echo $credit_count; ?></td>
						<td></td>
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