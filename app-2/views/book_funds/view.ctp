<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="w3-card-2">
			<div class="w3-container w3-teal w3-padding-large">
				<h4>User Information</h4>
			</div>
			<br />
			<div class="w3-container">
				<?php echo $this->Form->create('User', array('action'=>'edit', 'class'=>'form-horizontal')); ?>
					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">User Id:</label>
						<div class="col-sm-6">          
							<input type="text" value="<?php echo $user['User']['id']?>" class="w3-input w3-border w3-light-grey" disabled>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">First name:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('first_name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'disabled'=>'disabled', 'value'=>$user['User']['first_name'])); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Middle name:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('middle_name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'disabled'=>'disabled', 'value'=>$user['User']['middle_name'])) ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Last name:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('last_name', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'disabled'=>'disabled', 'value'=>$user['User']['last_name'])); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Username:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('username', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'disabled'=>'disabled', 'value'=>$user['User']['username'])); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Password:</label>
						<div class="col-sm-6">          
							<?php echo $this->Form->input('password', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'disabled'=>'disabled', 'value'=>$user['User']['password'])); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" for="pwdd">Role:</label>
						<div class="col-sm-6">  
							<?php echo $this->Form->input('roles', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'disabled'=>'disabled', 'value'=>$user['User']['roles'])); ?>
						</div>
					</div> 
				<?php echo $this->Form->end(); ?>
			</div>
			<div class="panel-footer">
				<a href="/homes/dashboard"class="w3-button w3-grey w3-round-small">Back to Home</a>
			</div>
		</div>	
	</div>
	<div class="col-lg-5 col-md-5"></div>
	<br />
</div>