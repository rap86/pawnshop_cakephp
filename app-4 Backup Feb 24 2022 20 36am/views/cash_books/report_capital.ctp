<?php
/*
echo '<pre>';
print_r($datas);
echo '</pre>';
*/
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom">Monthly Report</h3>
		<?php echo $this->Form->create('CashBook', array('action'=>'report_capital')); ?>
				
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
			<a href="/print/print/report_capital/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
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
						
						<th colspan="3" class="w3-center success">BOOK 1</th>
						<th colspan="3" class="w3-center warning">BOOK 2</th>
						<th colspan="3" class="w3-center info">BOOK 3</th>
						
						<th></th>
					</tr>
					<tr>
						<th>Date</th>
						<th>SB</th>
						<th>EXP</th>
						<th>DEPOSIT</th>
						<th>WITHDRAWAL</th>
						
						<th class="success">GRANT</th>
						<th class="success">TOTC</th>
						<th class="success">INT</th>
						
						<th class="warning">GRANT</th>
						<th class="warning">TOTC</th>
						<th class="warning">INT</th>
						
						<th class="info">GRANT</th>
						<th class="info">TOTC</th>
						<th class="info">INT</th>
						
						<th>EB</th>
					</tr>
				</thead>
				<tbody>
				   <?php foreach($datas as $key => $data): ?>

					<?php 
						
						$others['expenses']			+=$data['expenses']['expenses'];
						$others['deposit']			+=$data['deposit']['deposit'];
						$others['withdrawal']		+=$data['withdrawal']['withdrawal'];
						
						$book1['pawned'] 			+= $data['book_1']['pawned'];
						$book1['total_capital'] 	+= $data['book_1']['total_capital'];
						$book1['total_interest'] 	+= $data['book_1']['total_interest'];
						
						$book2['pawned'] 			+= $data['book_2']['pawned'];
						$book2['total_capital'] 	+= $data['book_2']['total_capital'];
						$book2['total_interest'] 	+= $data['book_2']['total_interest'];
						
						$book3['pawned'] 			+= $data['book_3']['pawned'];
						$book3['total_capital'] 	+= $data['book_3']['total_capital'];
						$book3['total_interest'] 	+= $data['book_3']['total_interest'];
					?>
					
					<tr>
						<td><?php echo $key; ?></td>
						<td>
							<strong>
								<?php echo number_format($data['starting_balanced'][0], 0); ?>
							</strong>
						</td>
						<td><?php echo $data['expenses']['expenses']; ?></td>
						<td><?php echo $data['deposit']['deposit']; ?></td>
						<td><?php echo $data['withdrawal']['withdrawal']; ?></td>
						
						<td class="success"><?php echo $data['book_1']['pawned']; ?></td>
						<td class="success"><?php echo $data['book_1']['total_capital'] ?></td>
						<td class="success"><?php echo $data['book_1']['total_interest'] ?></td>
				
						<td class="warning"><?php echo $data['book_2']['pawned']; ?></td>
						<td class="warning"><?php echo $data['book_2']['total_capital']; ?></td>
						<td class="warning"><?php echo $data['book_2']['total_interest']; ?></td>
						
						<td class="info"><?php echo $data['book_3']['pawned']; ?></td>
						<td class="info"><?php echo $data['book_3']['total_capital']; ?></td>
						<td class="info"><?php echo $data['book_3']['total_interest']; ?></td>
						
						<td>
							<strong>
								<?php echo number_format($data['ending_balanced'][ count($data['ending_balanced']) -1 ], 0); ?>
							</strong>
						</td>
					</tr>
					
					<?php endforeach; ?>
						<tr>
							<td class="w3-text-red">TOTAL</td>
							<td></td>
							<td><?php echo $others['expenses']; ?></td>
							<td><?php echo $others['deposit']; ?></td>
							<td><?php echo $others['withdrawal']; ?></td>
							
							<td class="success w3-text-red"><?php echo $book1['pawned']; ?></td>
							<td class="success w3-text-red"><?php echo $book1['total_capital']; ?></td>
							<td class="success w3-text-red"><?php echo $book1['total_interest']; ?></td>
							
							<td class="warning w3-text-red"><?php echo $book2['pawned']; ?></td>
							<td class="warning w3-text-red"><?php echo $book2['total_capital']; ?></td>
							<td class="warning w3-text-red"><?php echo $book2['total_interest']; ?></td>
							
							<td class="info w3-text-red"><?php echo $book3['pawned']; ?></td>
							<td class="info w3-text-red"><?php echo $book3['total_capital']; ?></td>
							<td class="info w3-text-red"><?php echo $book3['total_interest']; ?></td>
							<td></td>
						</tr>
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