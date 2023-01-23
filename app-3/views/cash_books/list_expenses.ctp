<div class="row">
	<div class="col-lg-12">
		<h3 class="w3-border-bottom">List of Expenses</h3>
		<?php echo $this->Form->create('CashBook', array('action'=>'list_expenses')); ?>

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
			<a href="/print/print/cash_type/<?php echo 'expenses'; ?>/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
		  </div>
		</div>
		
		<?php echo $this->Form->end(); ?>
		
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<a href="/cash_books/add_expenses" class="w3-btn w3-teal w3-round-small">+ Add Expenses</a>
			</div>
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr>
						    <th>Id</th>
							<th>Amount</th>
							<th>Details</th>
							<th>Date</th>
							<th>User</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
					   <?php foreach ($datas as $key => $data): ?>
					   
							<?php editCashType($data, $data['CashBook']['id']); ?>
							<?php $total += $data['CashBook']['expenses']; ?>
							
							<tr>
							    <td><?php echo $data['CashBook']['id']; ?></td>
								<td><?php echo $data['CashBook']['expenses']; ?></td>
								<td><?php echo $data['CashBook']['details']; ?></td>
								<td><?php echo date('M j, Y g:i A', strtotime($data['CashBook']['date_created'].' '.$data['CashBook']['time_created'])); ?></td>
								<td><?php echo $users[ $data['CashBook']['user_id'] ]; ?></td>
								<td class="actions">
									
									<?php if($data['CashBook']['id'] == $trasaction_counter_for_delete['CashBook']['id']) { ?>
									
										<button class="w3-button w3-red w3-round-small" data-toggle="modal" data-target="#myModalCashType<?php echo $data['CashBook']['id']; ?>">DELETE</button>
									
									<?php } ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<p class="w3-text-red">
					<strong>Total: <?php echo $total; ?></strong>
				</p>
			</div>
		</div>
	</div>
</div>

<?php function editCashType($data, $expenses_id) { ?>
<!-- Modal -->
<div class="modal fade" id="myModalCashType<?php echo $expenses_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" action="/cash_books/delete_expenses" >
			
			<input type="hidden" name="data[CashBook][id]" class="w3-input w3-border w3-light-grey" value="<?php echo $data['CashBook']['id']; ?>">
			<input type="hidden" name="data[CashBook][action]" value="list_expenses">
			
			<div class="modal-content">
				<div class="modal-header w3-red">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">EDIT EXPENSES</h4>
				</div>
				<div class="modal-body">
					<div class="form-horizontal">
					   <div class="form-group">
							<label class="control-label col-sm-4">Amount:</label>
							<div class="col-sm-5">          
								<input type="text" name="data[CashBook][expenses]" class="w3-input w3-border w3-light-grey w3-xxlarge" value="<?php echo $data['CashBook']['expenses']; ?>" autocomplete="off" readonly>
							</div>
					   </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="w3-button w3-dark-gray w3-round-small pull-left">YES</button>
					<button type="button" class="w3-button w3-light-gray w3-border w3-round-small" data-dismiss="modal">NO</button>
				</div>
			</div>
		</form>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>


<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$('.date_created').datepicker({ dateFormat: "yy-mm-dd" });
	
	$('table#dataTablesUsers').DataTable({
		responsive: true,
		"pageLength": 25
	});

});
</script>		