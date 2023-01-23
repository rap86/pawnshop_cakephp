<?php
/*
echo '<pre>';
print_r($datas);
echo '</pre>';
*/
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom">Cash Book 2 (1,2 and 3)</h3>
		<?php echo $this->Form->create('CashBook', array('action'=>'cash_book_two')); ?>
				
		<div class="w3-row-padding w3-light-grey w3-padding w3-border">
		  <div class="w3-quarter">
			<input class="w3-input w3-border" type="text" name="data[CashBook][date_from]" value="<?php echo $date['date_from']?>" placeholder="From" id="dateFrom">
		  </div>
		  <div class="w3-quarter">
			<input class="w3-input w3-border" type="text" name="data[CashBook][date_to]" value="<?php echo $date['date_to']; ?>" placeholder="To" id="dateTo">
		  </div>
		  <div class="w3-quarter">
			<button class="w3-button w3-dark-grey w3-block w3-round-small">LOAD</button>
		  </div>
		   <div class="w3-quarter">
			<a href="/print/print/cash_book_two/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
		  </div>
		</div>
		
		<?php echo $this->Form->end(); ?>
		<br />
		<div class="table-responsive">
			<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						
						<th colspan="2" class="w3-center success">Granted 1</th>
						<th colspan="2" class="w3-center warning">Granted 2</th>
						<th colspan="2" class="w3-center info">Granted 3</th>
						
						<th></th>
					</tr>
					<tr>
						<th>Date</th>
						<th>SB</th>
						<th>EXP</th>
						<th>IN</th>
						<th>OUT</th>
						<th>DEPOSIT</th>
						<th>WITHDRAWAL</th>
						<th>ACCT BAL</th>
						
						<th class="success">PYMT</th>
						<th class="success">RCPT</th>
						
						<th class="warning">PYMT</th>
						<th class="warning">RCPT</th>
						
						<th class="info">PYMT</th>
						<th class="info">RCPT</th>
						
						<th>EB</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach($datas as $key => $data): ?>

					<tr>
						<td><?php echo $key; ?></td>
						<td>
							<strong>
								<?php echo number_format($data['starting_balanced'][0], 0); ?>
							</strong>
						</td>
						<td><?php echo $data['expenses']['expenses']; ?></td>
						<td><?php echo $data['cashin']['cashin']; ?></td>
						<td><?php echo $data['cashout']['cashout']; ?></td>
						<td><?php echo $data['deposit']['deposit']; ?></td>
						<td><?php echo $data['withdrawal']['withdrawal']; ?></td>
						<td>
							<?php echo number_format($data['ending_bank_balanced'][ count($data['ending_bank_balanced']) -1 ], 0); ?>
						</td>
						
						<td class="success"><?php echo $data['book_1']['payment']; ?></td>
						<td class="success"><?php echo $data['book_1']['receipt'] ?></td>
				
						<td class="warning"><?php echo $data['book_2']['payment']; ?></td>
						<td class="warning"><?php echo $data['book_2']['receipt']; ?></td>
						
						<td class="info"><?php echo $data['book_3']['payment']; ?></td>
						<td class="info"><?php echo $data['book_3']['receipt']; ?></td>
						
						<td>
							<strong>
								<?php echo number_format($data['ending_balanced'][ count($data['ending_balanced']) -1 ], 0); ?>
							</strong>
						</td>
					</tr>
						
					<?php endforeach; ?>
						<tr class="danger">
							<td>
								<strong>COH</strong>
							</td>
							<td colspan="13"></td>
							<td style="text-align:left; font-weight:bold;" colspan="1">
								<?php echo number_format($data['ending_balanced'][ count($data['ending_balanced']) -1 ], 0); ?>
							</td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>		