<div class="card">
	<div class="card-header">
		<h5>Paket Medis</h5>
	</div>
	<div class="card-block">
		<form id="frm_paket" class="form-horizontal" action="<?php echo base_url('trx_reg/add_paket_to_reg'); ?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 border">
					<h4>Paket yang diambil :</h4>
					<table class="table table-bordered">
						<thead>
							<th>
								<td>NAMA PAKET</td>
								<td>TARIF</td>
							</th>
						</thead>
						<tbody>
							<?php 
							$total_paket = 0;
							foreach($data_paket as $k => $v)
							{
							?>
							<tr>
								<td><?php echo $k+1 ?></td>
								<td><?php echo $v->name ?></td>
								<td><?php echo $v->price ?></td>
							</tr>
							<?php 
								$total_paket += $v->price;
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" align="right">TOTAL : </td>
								<td><?php echo $total_paket ?></td>
							</tr>
						</tfoot>

					</table>
				</div>
				<div class="col-md-6 border">
					<div class="col-md-12">
						<div class="form-group">
							<label for="id_paket" class="col-sm-4 control-label"><h4>Tambah Paket :</h4></label>
							<div class="col-sm-12">
								<?php echo $dropdown_id_paket ?>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="box_detail_paket_medis">
						
					</div>
					<div class="col-md-12">
						<div class="form-group text-right">
							<div class="col-sm-12">
								<input type="hidden" name="id_reg" value="<?php echo $id_reg; ?>" />
								<button type="button" onclick="javascript : onsubmit_paket()" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
function load_paket_det()
{	var id_paket = $('#id_paket').children(":selected").attr("value");
	$.ajax({
		type: "GET",
		url: '<?php echo base_url('trx_reg/load_paket_det/'); ?>' + id_paket,
		success: function(response) {
			$("#box_detail_paket_medis").html(response);
		},
		error: function() {
			alert('Error');
		}
	});
}
function onsubmit_paket()
{
	//$('#frm_paket').on('submit',function(){
		$.ajax({
			type: "POST",
			data: $('#frm_paket').serialize(),
			url: $('#frm_paket').attr('action'),
			success: function(response) {
				if(response=='SUDAH INPUT')
				{
					Swal.fire({
					  title: "Tambah Paket",
					  text: "Paket sudah diinput",
					  icon: "success"
					});
				}
				if(response=='OK')
				{
					Swal.fire({
					  title: "Tambah Paket",
					  text: "Berhasil",
					  icon: "success"
					});
					
					$( "#box_paket_medis" ).load("<?php echo base_url('trx_reg/load_paket_medis/'.$id_reg) ?>");
				}
			},
			error: function() {
				alert('Error');
			}
		});
	//});
}
</script>