<?php echo $this->element('header_background_color'); ?>
<style>
	table tr td:nth-child(1) { font-weight:bold; }
</style>
<div class="row">
	<div class="col-lg-6">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading" id="headerBackgroundColor">
				<h4>View User Details</h4>
			</div>
			<div class="panel-body">
				<div class="table table-responsive">
					<table class="table table-bordered">
						<tr>
							<td style="width:40%;">User id</td>
							<td style="width:60%;"><?php echo $user['User']['id']?></td>
						</tr>
						<tr>
							<td>First name</td>
							<td><?php echo $user['User']['first_name']?></td>
						</tr>
						<tr>
							<td>Middle name</td>
							<td><?php echo $user['User']['middle_name']?></td>
						</tr>
						<tr>
							<td>Last name</td>
							<td><?php echo $user['User']['last_name']?></td>
						</tr>
						<tr>
							<td>Username</td>
							<td><?php echo $user['User']['username']?></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><?php echo $user['User']['username']?></td>
						</tr>
						<tr>
							<td>Role</td>
							<td><?php echo $user['User']['roles']?></td>
						</tr>
						<tr>
							<td>Enabled</td>
							<td><?php echo $this->Form->checkbox('enabled', array('class'=>'w3-input w3-border w3-light-grey', 'label'=>false, 'style'=>'width:30px; height:30px;', 'checked'=>($user['User']['enabled'] == 1)? "checked":"", 'disabled'=>'disabled')); ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="/users/index"class="w3-button w3-dark-gray w3-round-small">Back to index</a>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>