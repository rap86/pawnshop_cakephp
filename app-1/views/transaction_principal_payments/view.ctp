<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="w3-card-2">
			<div class="w3-container w3-teal w3-padding-large">
				<h4>View Book Information</h4>
			</div>
			<br />
			<div class="w3-container">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Name:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'value'=>$book['Book']['name'], 'disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Book Code:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('book_code', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'value'=>$book['Book']['book_code'], 'disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Details:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('details', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'type'=>'textarea', 'value'=>$book['Book']['details'], 'disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Deduct First Month:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('deduct_first_month', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'value'=>$book['Book']['deduct_first_month'], 'disabled'=>'disabled' )); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Enabled:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->checkbox('enabled', array('checked'=>($book['Book']['enabled'] == 1)? "checked": "", 'style'=>'width:30px; height:30px;', 'disabled'=>'disabled')); ?>
						</div>
					</div>
				</div>
			</div>		
			<div class="panel-footer">
				<a href="/books/index" class="w3-button w3-grey w3-round-small">Back to List</a>
			</div>	
		</div>
	</div>
</div>