<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom">Report (Granted)</h3>
		<?php echo $this->Form->create('CashBook', array('action'=>'granted')); ?>
		
		<table class="table table-bordered">
			<tr class="w3-light-grey">
				<td style="width:20%;">
					<?php echo $this->Form->input('CashBook.book', array('class'=>'w3-input w3-border', 'label'=>false, 'type'=>'select', 'options'=>array(''=>'', ''=> '', 1=>'Granted 1', 2=>'Granted 2', 3=>'Granted 3'))); ?>
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
					<a href="/print/print/granted/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>/<?php echo $book_id; ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
				</td>
			</tr>
		</table>
		<?php echo $this->Form->end(); ?>
		
		<div class="table-responsive">
			<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
				<thead>
					<tr class="w3-light-grey">
						<th>Total</th>
						<th data-aka="pawn">Granted</th>
						<th>Id</th>
						<th>Date</th>
						<th>Customer</th>
						<th>Item</th>
						<th>Item Type</th>
						<th>Brand * Karat</th>
						<th>Model * Weight</th>
						<th>Details</th>
					</tr>
				</thead>
				<tbody>
							
				   <?php foreach ($datas as $keyDate => $dataOutter): ?>
							<tr>
								<td style="text-align:center; font-weight:bold;" rowspan="<?php echo count($dataOutter); ?>">
									
									<?php 
									$total = 0;
									foreach ($dataOutter as $keyId => $data): ?>
												<?php $total += $data[0]['CustomerTransaction']['net_amount_duplicate']; ?>
									<?php endforeach;
										echo $total;
									?>
									
								</td>
							
					   <?php foreach ($dataOutter as $keyId => $data): ?>
								
								<?php $grand_total += $data[0]['CustomerTransaction']['net_amount_duplicate']; ?>
								
								<td><?php echo $data[0]['CustomerTransaction']['net_amount_duplicate']; ?></td>
								<td><?php echo $data[0]['CustomerTransaction']['id']; ?></td>
								<td><?php echo date('M j, Y g:i A', strtotime($data[0]['CustomerTransaction']['sangla_date'].' '.$data[0]['CustomerTransaction']['sangla_time'])); ?></td>							
								
								<td><?php echo $data[0]['Customer']['first_name'].' '.$data[0]['Customer']['middle_name'].' '.$data[0]['Customer']['last_name']; ?></td>
								<td><?php echo $data[0]['Item']['name']; ?></td>
								<td>
									<?php echo $data[0]['CustomerTransaction']['item_type']; ?>
									*
									<?php echo $data[0]['CustomerTransaction']['jewelry_type']; ?>
								</td>
								<td>
									<?php echo $data[0]['CustomerTransaction']['brand']; ?>
									*
									<?php echo $data[0]['CustomerTransaction']['karat']; ?>
								</td>
								<td>
									<?php echo $data[0]['CustomerTransaction']['model']; ?>
									*
									<?php echo $data[0]['CustomerTransaction']['weight']; ?>
								</td>
								<td>
									<?php echo $data[0]['CustomerTransaction']['details']; ?>
								</td>
							</tr>
						
						<?php endforeach; ?>
						
					<?php endforeach; ?>
					<tr>
						<td style="font-weight:bold; text-align:center; color:red;">
							<strong><?php echo $grand_total; ?></strong>
						</td>
						<td></td>
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