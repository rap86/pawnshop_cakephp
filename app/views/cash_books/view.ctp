<div class="row">
	<div class="col-lg-6 col-md-6">
		<br />
		<div class="w3-card-4">
             <div class="panel-heading w3-border-bottom w3-green" id="headerBackgroundColor">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-money fa-3x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $current_fund; ?> PHP</div>
						<div>Remaining Fund</div>
						<br />
					</div>
				</div>
			 </div>
			 <br />
			 <div class="w3-container">
				<?php echo $this->Form->create('CashBook', array('action'=>'add', 'class'=>'form-horizontal')); ?>
				
				<div class="form-group">
					<label class="control-label col-sm-4">Amount:</label>
					<div class="col-sm-6">          
						<?php echo $this->Form->input('deposit', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4">Details:</label>
					<div class="col-sm-6">          
						<?php echo $this->Form->input('details', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'type'=>'textarea')); ?>
					</div>
				</div>
			  </div>
			  <div class="w3-row w3-border-top">
				<?php echo $this->Form->submit(__('Deposit',true), array('class'=>'w3-btn w3-orange w3-block w3-padding-16')); ?>
				<?php echo $this->Form->end(); ?>
			  </div>
		</div>	
	</div>
	<br />
</div>