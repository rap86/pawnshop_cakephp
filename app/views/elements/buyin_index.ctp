<thead>
	<tr>
		<th>Image</th>
		<th>Customer</th>
		<th>Date Pawn</th>
		<th>Book</th>
		<th>Item Type</th>
		<th>Jewelty Type</th>
		<th>PT No.</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
	  <?php foreach($pawn_book1 as $keyua1 => $valueua1): ?>
	  
		<tr>
			<td class="w3-center">
			
				<?php if(trim($valueua1['Customer']['image_name']) != '') { ?>
		
					<img src="<?php echo $valueua1['Customer']['image_location']; ?>" alt="Avatar"  height="30px" width="30px">
				 
				 <?php } ?>
				 
				 <?php if(trim($valueua1['Customer']['image_name']) == '' && $valueua1['Customer']['gender'] == 'male') { ?>
					
					<img src="/img/image_male.png" alt="Avatar"  height="30px" width="30px">
				 
				 <?php } ?>
				 
				 <?php if(trim($valueua1['Customer']['image_name']) == '' && $valueua1['Customer']['gender'] == 'female') { ?>
					
					<img src="/img/image_female.png" alt="Avatar"  height="30px" width="30px">
				 
				 <?php } ?>
			</td>
			<td>
				<?php echo $valueua1['Customer']['first_name'].' '.$valueua1['Customer']['middle_name'].' ' .$valueua1['Customer']['last_name']; ?>
			</td>
			<td>
				<?php echo date('M j, Y', strtotime($valueua1['CustomerTransaction']['sangla_date'])); ?>
			</td>
			<td>
				<?php echo $valueua1['CustomerTransaction']['book_id']; ?>
			</td>
			<td>
				<?php echo $valueua1['CustomerTransaction']['item_type']; ?>
			</td>
			<td>
				<?php echo $valueua1['CustomerTransaction']['jewelry_type']; ?>
			</td>
			<td class="w3-center">
				<?php echo $valueua1['TransactionInterestPayment']['pt_number']; ?>
			</td>
			<td>
				<a data-net-amount-duplicate="<?php echo $valueua1['CustomerTransaction']['net_amount_duplicate']; ?>" data-customer-transactionid="<?php echo $valueua1['CustomerTransaction']['id']; ?>" data-forbir="<?php echo $valueua1['CustomerTransaction']['for_bir']; ?>" data-bookid="<?php echo $valueua1['CustomerTransaction']['book_id']; ?>" data-ptnumber="<?php echo $valueua1['TransactionInterestPayment']['pt_number']; ?>" data-auction-price="<?php echo $valueua1['TransactionUnderAuction']['auction_price'];?>" class="w3-button w3-teal w3-round-small" data-toggle="modal" data-target="#myModalBuyItemx" id="buybutton">Buy</a>
				<a target="_blank" href="/customer_transactions/transaction/<?php echo $valueua1['CustomerTransaction']['id']; ?>" class="w3-button w3-dark-gray w3-round-small">View</a>
			</td>
		</tr>
		
	<?php endforeach; ?>
</tbody>