<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom">Report (Collected)</h3>
		
			<?php echo $this->Form->create('CashBook', array('action'=>'collected')); ?>
		<table class="table table-bordered">
			<tr class="w3-light-grey">
				<td style="width:20%;">
					<?php echo $this->Form->input('CashBook.book', array('class'=>'w3-input w3-border', 'label'=>false, 'type'=>'select', 'options'=>array(''=>'', ''=> '', 1=>'Collected 1', 2=>'Collected 2', 3=>'Collected 3'))); ?>
				</td>
				<td style="width:20%;">
					<input class="w3-input w3-border" type="text" name="data[CashBook][date_from]" value="<?php echo $date['date_from']?>" placeholder="From" id="dateFrom">
				</td>
				<td style="width:20%;">
					<input class="w3-input w3-border" type="text" name="data[CashBook][date_to]" value="<?php echo $date['date_to']; ?>" placeholder="To" id="dateTo">
				</td>
				<td style="width:20%;">
					<button class="w3-button w3-dark-grey w3-block w3-round-small">LOAD</button>
				</td>
				<td style="width:20%;">
					<a href="/print/print/collected/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>/<?php echo $book_id; ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
				</td>
			</tr>
		</table>
		
		<?php echo $this->Form->end(); ?>
		<div class="table-responsive">
			<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
				<thead>
					<tr>
						<th>Total</th>
						<th style="text-align:center;" data-aka="interest">Collected</th>
						<th style="text-align:center;">SC</th>
						<th style="text-align:center;">PT No.</th>
						<th>Payment Date</th>
						<th>Customer</th>
						<th>Item</th>
						<th>OR No.</th>
						<th>Details</th>
					</tr>
				</thead>
				<tbody>
							
				   <?php 
				   
				   foreach ($datas as $keyDate => $dataOutter): ?>
							<tr>
								<td style="text-align:center; font-weight:bold;" rowspan="<?php echo count($dataOutter); ?>">
									
									<?php 
									$total = 0;
									foreach ($dataOutter as $keyId => $data): ?>
												<?php $total += $data[0]['CashBook']['interest_amount'] + 
																$data[0]['CashBook']['sold'] + 
																$data[0]['CashBook']['redeemed'] + 
																$data[0]['CashBook']['less_principal'] +
																$data[0]['CashBook']['service_charge']; 
												
												?>
									<?php endforeach;
										echo $total;
									?>
									
								</td>
							
					   <?php
						
					   foreach ($dataOutter as $keyId => $data): ?>
								
								<?php 
									 $grand_total +=  $data[0]['CashBook']['interest_amount'] + 
													  $data[0]['CashBook']['sold'] + 
													  $data[0]['CashBook']['redeemed'] + 
													  $data[0]['CashBook']['less_principal'] +
													  $data[0]['CashBook']['service_charge'];
													  
									  $sub_total += $data[0]['CashBook']['interest_amount'] + 
													  $data[0]['CashBook']['sold'] + 
													  $data[0]['CashBook']['redeemed'] + 
													  $data[0]['CashBook']['less_principal'];
								?>
								
								<td style="text-align:center;"><?php echo $sub_total; ?></td>
								<td style="text-align:center;"><?php echo $data[0]['CashBook']['service_charge']; ?></td>
								<td style="text-align:center;"><?php echo $data[0]['CashBook']['pt_number']; ?></td>
								<td><?php echo date('M j, Y g:i A', strtotime($data[0]['CashBook']['date_created'].' '.$data[0]['CashBook']['time_created'])); ?></td>
								<td><?php echo $data[0]['Customer']['first_name'].' '.$data[0]['Customer']['middle_name'].' '.$data[0]['Customer']['last_name']; ?></td>
								<td><?php echo $data[0]['Item']['name']; ?></td>
								<td><?php echo $data[0]['CashBook']['or_number']; ?></td>
								<td><?php echo $data[0]['CashBook']['details']; ?></td>
							</tr>
						
						<?php 
						$sub_total = 0;
						endforeach; ?>
						
					<?php endforeach; ?>
					<tr>
						<td style="font-weight:bold; text-align:center; color:red;">
							<?php echo $grand_total; ?>
						</td>
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
		</div>
	</div>
</div>		