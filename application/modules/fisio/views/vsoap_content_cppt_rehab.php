<div class="tab-pane active" id="plan2" role="tabpanel">
	<div class="p-5">
		<div class="container-fluid">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-8 p-5">
                        <?php $segment4=$this->uri->segment('4'); $segment5=$this->uri->segment('5'); ?>
                        <a href='#' class="btn btn-info add-new fa fa-plus" title='Tambah Order-Rehab Medik'onclick='linkopen_add_rehab();'>ADD</a>
							<script>
							function linkopen_add_rehab() {
    						window.open("<?php echo site_url("fisio/rehabmedik/indexrehab/$segment4/$segment5"); ?>", "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
							}
							</script>
                            </div>
					</div>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
						<th scope="col">ID Order</th>
                        <th scope="col">ID Registrasi</th>
						<th scope="col">Nama</th>
						<th scope="col">Diagnosa</th>
						<th scope="col">Terapi</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Action</th>
						</tr>
					</thead>
                    <?php 
                    foreach($data_list_rehab as $u){ ?>
					<td><?php echo $u->id_digital_request; ?></td>
                    <td><?php echo $u->registrasi; ?></td>
                    <td><?php echo $u->nama; ?></td>
                    <td><?php echo $u->diagnosa; ?></td>
                    <td><?php echo $u->terapi; ?></td>
                    <td><?php echo $u->tgl_request; ?></td>
                    <td><?php echo anchor_popup(("fisio/rehabmedik/edit_formsprehab/$segment4/$segment5/$u->id_digital_request"), "<label class='btn btn-info add-new fa fa-plus'>Edit</label>", '$attributes'); ?>
                    
                    <?php echo anchor_popup(("fisio/rehabmedik/delete_rehab_id/$segment4/$segment5/$u->id_digital_request"), "<label class='btn btn-danger add-new fa fa-plus'>Delete</label>", '$attributes'); ?>
                    </td>
                    <?php } ?>
					</tbody>
				</table>
                	
			</div>
		</div>
	</div>
</div>



</body>
</html>