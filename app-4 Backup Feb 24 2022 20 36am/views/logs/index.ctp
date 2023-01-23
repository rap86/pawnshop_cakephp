<div class="row">
	<div class="col-lg-12">
		<br />
		<?php echo $this->Form->create('Log', array('action'=>'index')); ?>
		<div class="w3-row-padding w3-light-grey w3-padding w3-border">
		  <div class="w3-quarter">
			<input class="w3-input w3-border" type="text" name="data[Log][date_from]" value="<?php echo $date['date_from']?>" placeholder="From" id="dateFrom">
		  </div>
		  <div class="w3-quarter">
			<input class="w3-input w3-border" type="text" name="data[Log][date_to]" value="<?php echo $date['date_to']; ?>" placeholder="To" id="dateTo">
		  </div>
		  <div class="w3-quarter">
			<button class="w3-button w3-dark-grey w3-block w3-round-small">LOAD</button>
		  </div>
		   <div class="w3-quarter">
			<a href="/print/print/print_logs/<?php echo($date['date_from']); ?>/<?php echo($date['date_to']); ?>" target="_blank" class="w3-button w3-dark-grey w3-block w3-round-small"><i class="fa fa-print"></i> PRINT</a>
		  </div>
		</div>
		
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-lg-12">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>Activity logs</h4>
			</div>
			<div class="panel-body">
				<table width="100%" class="table table-bordered table-hover" id="dataTablesUsers">
					<thead>
						<tr class="text-primary active">
							<td>Id</td>
							<td>Description Id</td>
							<td>Module</td>
							<td>URL</td>
							<td>Action</td>
							<td>Description</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($logs as $key => $value): ?>
							
							<tr>
								<td><?php echo $value['Log']['id']; ?></td>
								<td><?php echo $value['Log']['transaction_id']; ?></td>
								<td><?php echo $value['Log']['controller']; ?></td>
								<td><?php echo $value['Log']['url']; ?></td>
								<td><?php echo $value['Log']['action']; ?></td>
								<td><?php echo $value['Log']['description']; ?></td>
							</tr>
						
						<?php endforeach;  ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	
	$('table#dataTablesUsers').DataTable({
		responsive: true,
		"pageLength": 25
	});

});
</script>