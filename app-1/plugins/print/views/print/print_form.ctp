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
					margin-top: 17%;
					margin-bottom:20%;
					margin-left:40px;
					margin-right:40px;
					margin-header:3%;
					margin-footer:3%;	

				}
		.text-bold { font-weight:bold; }
		table tr td { font-size: 14px;}
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
			
			<table style="width:100%; border-collapse:collapse; font-family:arial; text-align:center;">
				<tr>
					<td style="font-size:24px;">st. george Pawnshop</td>
				</tr>
				<tr>
					<td style="font-size:11px;">
					CS-C Bldg. Stall No. 4., Maharlika High-way Maestrang Kikay<br />
					Talavera, Nueva Ecija / Tel. No.: (044) 940-0344<br />
					<b>
					NINA P. EDUARDO - <i>Proprietress</i><br />
					NONVAT REG. TIN: 167-323-196-001<br />
					</b>
					Mondays to Saturdays 8:00 A.M. to 5:00 P.M.
					</td>
				</tr>
			</table>
			
		</htmlpageheader>
		
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
		<table style="width:100%; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:22%;">Date Loan Granted</td>
				<td style="width:30%; border-bottom: 1px solid black; font-weight:bold;"><?php echo date('M j, Y', strtotime($details['CustomerTransaction']['sangla_date'])); ?></td>
				<td style="width:2%;"></td>
				<td style="width:15%;">Maturity Date</td>
				<td style="width:35%; border-bottom: 1px solid black; font-weight:bold;"><?php echo date('M j, Y', strtotime("+1 month", strtotime($details['CustomerTransaction']['sangla_date']))); ?></td>
			</tr>
		</table>
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:17%;"></td>
				<td style="width:35%;"></td>
				<td style="width:2%;"></td>
				<td style="width:25%;">Expiry Date of Redemption</td>
				<td style="width:25%; border-bottom: 1px solid black; font-weight:bold;"><?php echo date('M j, Y', strtotime("+4 month", strtotime($details['CustomerTransaction']['sangla_date']))); ?></td>
			</tr>
		</table>
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:10%;">Mr./Mrs</td>
				<td style="width:40%; border-bottom: 1px solid black; text-transform:uppercase; font-weight:bold;"><?php echo $details['Customer']['first_name']." ".$details['Customer']['middle_name']." ".$details['Customer']['last_name']; ?></td>
				<td style="width:2%;"></td>
				<td style="width:12%;">a resident</td>
				<td style="width:38%; border-bottom: 1px solid black; font-weight:bold;"><?php echo $details['Customer']['address']; ?></td>
			</tr>
		</table>
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:20%;">for a loan of PESOS</td>
				<td style="width:38%; border-bottom: 1px solid black; font-weight:bold;"></td>
				<td style="width:2%;">(P</td>
				<td style="width:30%; border-bottom: 1px solid black; font-weight:bold; text-align:center;"><?php echo number_format($details['CustomerTransaction']['net_amount'], 0); ?></td>
				<td style="width:20%;">) with an interest</td>
			</tr>
		</table>
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:5%;">of</td>
				<td style="width:23%; border-bottom: 1px solid black; font-weight:bold;"><?php echo $details['TransactionInterestPayment']['payment_amount']; ?></td>
				<td style="width:2%;">percent(</td>
				<td style="width:10%; border-bottom: 1px solid black; font-weight:bold; text-align:center;"><?php echo $details['TransactionInterestPayment']['payment_due_interest']; ?></td>
				<td style="width:60%;">) days/month), has pledged to this Pawnee, as security for the</td>
			</tr>
		</table>
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:52%;">loan, articles(s) described below appraised as PESOS</td>
				<td style="width:48%; border-bottom: 1px solid black; font-weight:bold;"></td>
			</tr>
		</table>
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:28%; border-bottom: 1px solid black; font-weight:bold;"></td>
				<td style="width:2%;">(P</td>
				<td style="width:25%; border-bottom: 1px solid black; font-weight:bold;"></td>
				<td style="width:45%;">) subject to the terms and condiftions stated</td>
			</tr>
		</table>
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="6">
			<tr>
				<td style="width:50%;">on the reverse side hereof. Penalty interest, if any</td>
				<td style="width:25%; border-bottom: 1px solid black; font-weight:bold;"></td>
				<td style="width:25%;">.</td>
			</tr>
		</table>
		<br />
		<div style="width:1200px;  height:2px;">
			
			<div style="width:352px; float:left">
				
				<p style="text-align:center; font-family:arial; font-weight:bold;">Description ot the Pawn</p>
				
				<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial;" border="0" cellpadding="12">
					<tr>
						<td style="width:100%; border-bottom: 1px solid black;"><?php echo $details['CustomerTransaction']['details']; ?></td>
					</tr>
					<tr>
						<td style="width:100%; border-bottom: 1px solid black;"></td>
					</tr>
					<tr>
						<td style="width:100%; border-bottom: 1px solid black;"></td>
					</tr>
					<tr>
						<td style="width:100%; border-bottom: 1px solid black;"></td>
					</tr>
				</table>
		
			</div>
			<div style="width:352px; float:right">
				<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial; font-size:20px;" border="0" cellpadding="6">
					<tr>
						<td style="width:58%;">Principal</td>
						<td style="width:1%;"></td>
						<td style="width:1%;">P</td>
						<td style="width:40%; border-bottom: 1px solid black; font-weight:bold;"> <?php echo number_format($details['CustomerTransaction']['net_amount'], 0); ?></td>
					</tr>
					<tr>
						<td style="width:58%;">Interest in absolute amount</td>
						<td style="width:1%;"></td>
						<td style="width:1%;"></td>
						<td style="width:40%; border-bottom: 1px solid black; font-weight:bold;"><?php echo $details['TransactionInterestPayment']['payment_due_amount']; ?></td>
					</tr>
					<tr>
						<td style="width:58%;">Service Charge in amount</td>
						<td style="width:1%;"></td>
						<td style="width:1%;"></td>
						<td style="width:40%; border-bottom: 1px solid black; font-weight:bold;">5</td>
					</tr>
					<tr>
						<td style="width:58%;">Net Proceeds</td>
						<td style="width:1%;"></td>
						<td style="width:1%;">P</td>
						<td style="width:40%; border-bottom: 1px solid black; font-weight:bold;"><?php echo $details['TransactionInterestPayment']['payment_due_amount'] + 5; ?></td>
					</tr>
				</table>
				<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial; font-size:20px;" border="0" cellpadding="6">
					<tr>
						<td style="width:70%;">Effective Interest Rate in Percent</td>
						<td style="width:5%;"></td>
						<td style="width:25%; border-bottom: 1px solid black; font-weight:bold;">
							<?php 
								echo number_format($details['CustomerTransaction']['net_amount'] + $details['TransactionInterestPayment']['payment_due_amount'] + 5, 0)
							?>
						
						</td>
					</tr>
					<tr>
						<td>Please check:</td>
					</tr>
				</table>
				<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial; font-size:20px;" border="0" cellpadding="6">
					<tr>
						<td style="width:10%;">Per annum</td>
						<td style="width:5%; text-align:left;">
							<input type="checkbox"> 
						</td>
						<td style="width:10%;">Per Month</td>
						<td style="width:5%; text-align:left;">
							<input type="checkbox"> 
						</td>
						<td style="width:10%;"><u>(Others)</u></td>
						<td style="width:5%; text-align:left;">
							<input type="checkbox"> 
						</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align:center; width:100%;">Formula (Principal x Rate x Time)</td>
					</tr>
				</table>
					
			</div>
		
		</div>
		<br />
		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial; font-size:20px;" border="0" cellpadding="6">
			<tr>
				<td style="width:15%;">ID Presented:</td>
				<td style="width:30%; border-bottom: 1px solid black; font-weight:bold;"><?php echo $details['CustomerTransaction']['id_presented']; ?></td>
				<td style="width:5%;"></td>
				<td style="width:20%;">Contact Number</td>
				<td style="width:30%; border-bottom: 1px solid black; font-weight:bold;"><?php echo $details['Customer']['number']; ?></td>
			</tr>
		</table>
		<htmlpagefooter name="myHTMLFooter1">

		<table style="width:100%; margin-top:10px; border-collapse:collapse; font-family:arial; font-size:20px;" border="0" cellpadding="6">
			<tr>
				<td style="width:40%; border-bottom: 1px solid black;"></td>
				<td style="width:2%;"></td>
				<td style="width:48%; border-bottom: 1px solid black;"></td>
			</tr>
			<tr>
				<td style="width:40%; font-weight:bold">(Signature or Thumbmark of Pawner)</td>
				<td style="width:2%;"></td>
				<td style="width:48%; font-weight:bold">(Signature of Pawnshop's Authorized Representative)</td>
			</tr>
		</table>	
		</htmlpagefooter>
		
		<sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>