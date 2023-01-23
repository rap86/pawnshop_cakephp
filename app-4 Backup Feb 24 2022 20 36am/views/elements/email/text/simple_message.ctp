<p>
	Hi <?php echo $value['Customer']['first_name'] ?> <?php echo $value['Customer']['middle_name'] ?>, <?php echo $value['Customer']['last_name'] ?>
	<br />
	We woud like to remind you about your transaction at PAWNSHOP 
	<br />
	PT Number : <?php echo $value['TransactionPayment']['id'] ?>
	<br />
	Principal Amount : <?php echo $value['CustomerTransaction']['gross_amount'] ?>
	<br />
	Interest : <?php echo $value['TransactionPayment']['payment_due_interest'] ?>
	<br />
	Due Amount : <?php echo $value['TransactionPayment']['payment_due_amount'] ?> 
	<br />
	Due Date <?php echo $value['TransactionPayment']['payment_due_date'] ?>
	<br />
	pay before due date to avoid having a penalty
	<br />
	<br />
	Thank You.
</p>