<style>
	
</style>

<table style="width:100%; font-size:12px; font-family:arial; border-collapse:collapse;" border="1" cellpadding="4">
		<tr class="text-primary active">
			<td style="width:12%;">Description Id</td>
			<td style="width:20%;">Controller</td>
			<td style="width:20%;">URL</td>
			<td style="width:18%;">Action</td>
			<td style="width:30%;">Description</td>
		</tr>
	
		<?php foreach($results as $key => $value): ?>
		<tr>
			<td><?php echo $value['Log']['description_id']; ?></td>
			<td><?php echo $value['Log']['controller']; ?></td>
			<td><?php echo $value['Log']['url']; ?></td>
			<td><?php echo $value['Log']['action']; ?></td>
			<td><?php echo $value['Log']['description']; ?></td>
		</tr>
	
	<?php endforeach;  ?>
</table>