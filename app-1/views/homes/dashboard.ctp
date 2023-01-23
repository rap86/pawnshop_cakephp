<?php 
$status_count 	= $this->requestAction('/homes/home');
$book_fund 		= $this->requestAction('/homes/bookFund');

/*
echo '<pre>';
print_r($book_fund);
echo '</pre>';
*/
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- /.row -->
<p class="w3-border-bottom">Pawned</p>
<div class="row">
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo $status_count[0][0]['book_one_item_pawned']; ?> <br /> <?php echo number_format($status_count[0][0]['book_one_amount_pawned'], 0); ?></div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer  w3-hover-red">
					<span class="pull-left">Book 1</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-list-alt fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo $status_count[0][0]['book_two_item_pawned']; ?> <br /> <?php echo number_format($status_count[0][0]['book_two_amount_pawned'], 0); ?></div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer  w3-hover-red">
					<span class="pull-left">Book 2</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-list-alt fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo $status_count[0][0]['book_three_item_pawned']; ?> <br /> <?php echo number_format($status_count[0][0]['book_three_amount_pawned'], 0); ?></div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer w3-hover-red">
					<span class="pull-left">Book 3</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-list-alt fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge">
							<?php
								echo $status_count[0][0]['book_one_item_pawned'] + $status_count[0][0]['book_two_item_pawned'] + $status_count[0][0]['book_three_item_pawned']; 
							?> 
							<br />
							<?php 
								echo number_format($status_count[0][0]['book_one_amount_pawned'] + $status_count[0][0]['book_two_amount_pawned'] + $status_count[0][0]['book_three_amount_pawned'], 0); 
							?>
						</div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer  w3-hover-red">
					<span class="pull-left">Total </span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>

<p class="w3-border-bottom">Under Auction</p>
<div class="row">
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo $status_count[0][0]['book_one_item_ua']; ?> <br /> <?php echo number_format($status_count[0][0]['book_one_amount_ua'], 0); ?></div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer  w3-hover-green">
					<span class="pull-left">Book 1</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-list-alt fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo $status_count[0][0]['book_two_item_ua']; ?> <br /> <?php echo number_format($status_count[0][0]['book_two_amount_ua'], 0); ?></div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer  w3-hover-green">
					<span class="pull-left">Book 2</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-list-alt fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo $status_count[0][0]['book_three_item_ua']; ?> <br /> <?php echo number_format($status_count[0][0]['book_three_amount_ua'], 0); ?></div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer w3-hover-green">
					<span class="pull-left">Book 3</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="panel w3-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-list-alt fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge">
							<?php
								echo $status_count[0][0]['book_one_item_ua'] + $status_count[0][0]['book_two_item_ua'] + $status_count[0][0]['book_three_item_ua']; 
							?> 
							<br />
							<?php 
								echo number_format($status_count[0][0]['book_one_amount_ua'] + $status_count[0][0]['book_two_amount_ua'] + $status_count[0][0]['book_three_amount_ua'], 0); 
							?>
						</div>
						<div>Count | Amount</div>
					</div>
				</div>
			</div>
			<a href="#" class="w3-text-black">
				<div class="panel-footer  w3-hover-green">
					<span class="pull-left">Total </span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>

<p class="w3-border-bottom">Fund</p>

<div class="row">
	<div class="col-lg-3">
		<div class="panel panel-primary w3-border">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-money fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo number_format($book_fund['book_bir'], 0); ?></div>
						<div>REMAINING FUND</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">CASH BOOK 1 (BIR)</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
		<div class="col-lg-3">
		<div class="panel panel-primary w3-border">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-money fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo number_format($book_fund['cash_book_one_bank_fund'], 0); ?></div>
						<div>REMAINING FUND</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">CASH BOOK 1 (BANK)</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel w3-light-gray w3-border">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-money fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo number_format($book_fund['book_123'], 0); ?></div>
						<div>REMAINING FUND</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">CASH BOOK 2 (1,2 and 3)</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel w3-light-gray w3-border">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-money fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="w3-xlarge"><?php echo number_format($book_fund['cash_book_two_bank_fund'], 0); ?></div>
						<div>BALANCED</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">CASH BOOK 2 (BANK)</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>