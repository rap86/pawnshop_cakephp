<div class="row">
	<div class="col-lg-6">
	<br />
		<div class="w3-border">
			<div class="w3-container w3-teal w3-padding-large">
				<h4>Edit User Information</h4>
			</div>
			<br />
			<div class="w3-container">
				<?php echo $this->Form->create('User', array('action'=>'edit', 'class'=>'form-horizontal')); ?>
				<div class="form-group">
					<label class="control-label col-sm-4" for="pwdd">First name:</label>
					<div class="col-sm-6">          
						<?php echo $this->Form->input('first_name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
					</div>
				</div>

				<div class="form-group">
				<label class="control-label col-sm-4" for="pwdd">Middle name:</label>
				<div class="col-sm-6">          
				<?php echo $this->Form->input('middle_name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
				</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4" for="pwdd">Last name:</label>
					<div class="col-sm-6">          
						<?php echo $this->Form->input('last_name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4" for="pwdd">Username:</label>
					<div class="col-sm-6">          
						<?php echo $this->Form->input('username', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4">Password:</label>
					<div class="col-sm-6">          
						<?php echo $this->Form->input('password', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4">Confirm Password:</label>
					<div class="col-sm-6">          
						<?php echo $this->Form->input('password_confirmation', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4" for="pwdd">Role:</label>
					<div class="col-sm-6">  
						<?php echo $this->Form->input('roles', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'type'=>'select', 'options'=>array(''=>'', 'clerk'=>'clerk', 'admin'=>'admin'))); ?>
					</div>
				</div> 
			</div>
			<div class="panel-footer">
			<?php echo $this->Form->submit(__('Submit',true), array('class'=>'w3-button w3-grey w3-round-small')); ?>
			<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>			
	<div class="col-lg-5 col-md-5">
	
	</div>
	<br />
</div>