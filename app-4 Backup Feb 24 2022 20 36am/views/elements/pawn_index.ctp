<thead>
	<tr>
		<th>Image</th>
		<th>Customer</th>
		<th>Last Payment</th>
		<th>Date Diff</th>
		<th>Item Type</th>
		<th>Jewelty Type</th>
		<th>PT No.</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
<?php foreach($pawn_book1 as $keyPawn1 => $valuePawn1): ?>

	<tr>
		<td class="w3-center">

			<?php if(trim($valuePawn1['Customer']['image_name']) != '') { ?>

				<img src="<?php echo $valuePawn1['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
			 
			 <?php } ?>
			 
			 <?php if(trim($valuePawn1['Customer']['image_name']) == '' && $valuePawn1['Customer']['gender'] == 'male') { ?>
				
				<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
			 
			 <?php } ?>
			 
			 <?php if(trim($valuePawn1['Customer']['image_name']) == '' && $valuePawn1['Customer']['gender'] == 'female') { ?>
				
				<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
			 
			 <?php } ?>
				 
		</td>
		<td class="<?php echo $textColor; ?>">
			<?php echo $valuePawn1['Customer']['first_name'].' '.$valuePawn1['Customer']['middle_name'].' ' .$valuePawn1['Customer']['last_name']; ?>
		</td>
		<td class="<?php echo $textColor; ?>">
			<?php echo $valuePawn1['TransactionInterestPayment']['payment_starting_date']; ?>
		</td>
		<td class="<?php echo $textColor; ?>">
			<?php echo $valuePawn1['TransactionInterestPayment']['date_diff']; ?>
		</td>
		<td class="<?php echo $textColor; ?>">
			<?php echo $valuePawn1['CustomerTransaction']['item_type']; ?>
		</td>
		<td class="<?php echo $textColor; ?>">
			<?php echo $valuePawn1['CustomerTransaction']['jewelry_type']; ?>
		</td>
		<td class="w3-center">
			<?php echo $valuePawn1['TransactionInterestPayment']['pt_number']; ?>
		</td>
		<td>
			<a href="/customer_transactions/transaction/<?php echo $valuePawn1['CustomerTransaction']['id']; ?>" class="w3-btn w3-dark-gray w3-round-small">View</a>
		</td>
	</tr>
	
<?php endforeach; ?>
</tbody>