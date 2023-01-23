<?php
	
$details = array();
foreach($transaction_details as $key => $value)
{
	$details['Customer'] 					= $value['CustomerTransaction']['Customer'];
	$details['TransactionInterestPayment'] 	= $value['TransactionInterestPayment'];
	$details['CustomerTransaction'] 		= $value['CustomerTransaction'];
	$details['TransactionPrincipalPayment'] = $value['CustomerTransaction']['TransactionPrincipalPayment'];


}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Customer Transaction Due</title>
		<style>
		 @page  {
					header: html_myHTMLHeader1;
					footer: html_myHTMLFooter1;
					margin-top: 40%;
					margin-bottom:20%;
					margin-left:40px;
					margin-right:40px;
					margin-header:3%;
					margin-footer:3%;	

				}
		.text-bold { font-weight:bold; }
		table#address tr td { font-size:14px; }	
		table#transaction tr td { font-size:14px; }	
		table#payment_details tr td { text-align:center; }
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
			<table style="width:100%; border-collapse:collapse; font-family:arial;" border="0">
				<tr>	
					<td style="width:33%; font-size:24px; color:#595959;"><b>Pawn</b>SHOP</td>
					<td style="width:33%;"></td>
					<td style="width:33%; font-size:24px; color:#595959;">Transaction Id: <?php echo $details['CustomerTransaction']['id']?></td>
				</tr>
			</table>
			<table id="address" style="width:100%; border-collapse:collapse; font-family:arial; margin-top:5px;" border="0">
				<tr>
					<td>Address: <?php echo $email_detail['PawnshopEmail']['address']; ?></td>
				</tr>
				<tr>	
					<td>Email: <?php echo $email_detail['PawnshopEmail']['email']; ?></td>
				</tr>
				<tr>	
					<td>Phone: <?php echo $email_detail['PawnshopEmail']['phone']; ?></td>
				</tr>
				<tr>	
					<td>Mobile: <?php echo $email_detail['PawnshopEmail']['mobile']; ?></td>
				</tr>
			</table>
			
			<div style="height:5px; background-color:#e6e6e6; margin-top:7px; margin-bottom:5px;"></div>
			
				<span style="text-transform:uppercase; font-family:arial;"><strong>Customer:</strong> <?php echo $details['Customer']['first_name']." ".$details['Customer']['middle_name'].". ".$details['Customer']['last_name']; ?></span>
			
			<div style="height:5px; background-color:#e6e6e6; margin-top:7px;"></div>
			
			<table id="transaction" style="width:100%; border-collapse:collapse; font-family:arial; margin-top:10px;" border="1" cellpadding="5">
				<tr>
					<td colspan="4" style="font-weight:bold;">Transaction Details</td>
				</tr>
				<tr>
					<td style="width:25%;">Gross Amount</td>
					<td style="width:25%;"><?php echo $details['CustomerTransaction']['gross_amount']; ?></td>
					<td style="width:25%;">Jewelry Type</td>
					<td style="width:25%;"><?php echo $details['CustomerTransaction']['jewelry_type']; ?></td>
				</tr>
				<tr>
					<td>Orig. Net Amount</td>
					<td><?php echo $details['CustomerTransaction']['net_amount_duplicate']; ?></td>
					<td>Karat</td>
					<td><?php echo $details['CustomerTransaction']['karat']; ?></td>
				</tr>
				<tr>
					<td>Net Amount</td>
					<td><?php echo $details['CustomerTransaction']['net_amount']; ?></td>
					<td>Weight (grams)</td>
					<td><?php echo $details['CustomerTransaction']['weight']; ?></td>
				</tr>
				<tr>
					<td>1st Month Interest</td>
					<td><?php echo $details['CustomerTransaction']['first_month_interest']; ?></td>
					<td>Item Type</td>
					<td><?php echo $details['CustomerTransaction']['item_type']; ?></td>
				</tr>
				<tr>
					<td>Date Pawned</td>
					<td><?php echo $details['CustomerTransaction']['sangla_date'].' '.$details['CustomerTransaction']['sangla_time']; ?></td>
					<td>Brand</td>
					<td><?php echo $details['CustomerTransaction']['brand']; ?></td>
				</tr>
				<tr>
					<td>ID Presented</td>
					<td><?php echo $details['CustomerTransaction']['id_presented']; ?></td>
					<td>Model</td>
					<td><?php echo $details['CustomerTransaction']['model']; ?></td>
				</tr>
			</table>
			
			<div style="height:5px; background-color:#e6e6e6; margin-top:7px;"></div>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
		<?php if(isset($details['TransactionPrincipalPayment']) && !empty($details['TransactionPrincipalPayment'])) { ?>
			
			<table id="principal_details" style="width:100%; border-collapse:collapse; font-family:arial; margin-bottom:10px;" border="1" cellpadding="5">
				<tr>
					<td colspan="3" style="font-weight:bold; text-align:left;">Principal Payment Details</td>
				</tr>
				<tr>
					<td style="width:25%; font-weight:bold;">Date</td>
					<td style="width:25%; font-weight:bold;">Amount</td>
					<td style="width:50%; font-weight:bold;">Details</td>
				</tr>
				<?php foreach($details['TransactionPrincipalPayment'] as $keyPrincipal => $valuePrincipal): ?>
					
					<tr>
						<td><?php echo date('M j, Y g:i A', strtotime($valuePrincipal['transaction_date'].' '.$valuePrincipal['transaction_time'])); ?></td>
						<td><?php echo $valuePrincipal['amount']; ?></td>
						<td><?php echo $valuePrincipal['details']; ?></td>
					</tr>
				
				<?php endforeach; ?>
			</table>
		
		<?php } ?>

		
		<table id="payment_details" style="width:100%; border-collapse:collapse; font-family:arial;" border="1" cellpadding="5">
			<tr>
				<td colspan="7" style="font-weight:bold; text-align:left;">Interest Details</td>
			</tr>
			<tr>
				<td style="width:10%; font-weight:bold;">PT #</td>
				<td style="width:15%; font-weight:bold;">Due Date</td>
				<td style="width:15%; font-weight:bold;">Maturity</td>
				<td style="width:15%; font-weight:bold;">Due Interest</td>
				<td style="width:15%; font-weight:bold;">Due Amount</td>
				<td style="width:15%; font-weight:bold;">Payment</td>
				<td style="width:15%; font-weight:bold;">Payment Date</td>
			</tr>
			<tr>
				<td><?php echo $details['TransactionInterestPayment']['pt_number']; ?></td>
				<td><?php echo date('M j, Y', strtotime($details['TransactionInterestPayment']['payment_due_date'])); ?></td>
				<td><?php echo date('M j, Y', strtotime("+1 month", strtotime($details['TransactionInterestPayment']['payment_due_date']))); ?></td>
				<td><?php echo $details['TransactionInterestPayment']['payment_due_interest']; ?> %</td>
				<td><?php echo $details['TransactionInterestPayment']['payment_due_amount']; ?></td>
				<td><?php echo $details['TransactionInterestPayment']['payment_amount']; ?></td>
				<td><?php echo $details['TransactionInterestPayment']['payment_date']; ?></td>
				
			</tr>
		
		</table>
		
		<htmlpagefooter name="myHTMLFooter1">

			<table style="border-collapse:collapse; width:100%; font-family:arial;" border="0">
				<tr>
					<td style="text-align:right; border-top:1px solid black;"><i><b>Page: {PAGENO} of {nbpg}</b></i></td>
				</tr>
			</table>
			
		</htmlpagefooter>
		
		<sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>