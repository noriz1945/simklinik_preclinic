<table class="table table-bordered">
<thead>
	<th>
		
		<td>ITEM</td>
		<td>TARIF</td>
		<td>QTY</td>
		<td>SUBTOTAL</td>
	</th>
</thead>
<tbody>
	<?php 
	foreach($data_paket_det as $k => $v)
	{
	?>
	<tr>
		<td><?php echo $k+1 ?></td>
		<td><?php echo $v->id_trx_det_txt ?></td>
		<td><?php echo $v->price ?></td>
		<td><?php echo $v->qty ?></td>
		<td><?php echo $v->total ?></td>
	</tr>
	<?php 
	}
	?>
</tbody>
<tfoot>
	<tr>
		<td colspan="4" align="right"> TOTAL : </td>
		<td></td>
	</tr>
</tfoot>

</table>