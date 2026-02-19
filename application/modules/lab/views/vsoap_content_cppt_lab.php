<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="tab-pane active" id="plan2" role="tabpanel">
	<div class="p-5">
		<div class="container-fluid">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-8 p-5">
							<?php $segment4=$this->uri->segment('4'); $segment5=$this->uri->segment('5'); ?>
							<a href='#' class="btn btn-info add-new fa fa-plus" title='Tambah Sp-Laboratorium'onclick='linkopen_add_lab();'>ADD</a>
							<script>
							function linkopen_add_lab() {
    						window.open("<?php echo site_url("lab/splab/indexlab/$segment4/$segment5"); ?>", "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=1280, height=720px");
							}
							</script>
							<!--<button type="button" class="btn btn-info add-new fa fa-plus" data-toggle="modal" data-target="#addCppt">
								Edit
							</button>
							<button type="button" class="btn btn-info add-new fa fa-plus" data-toggle="modal" data-target="#viewCppt">
								Delete
							</button>
							<?php // $segment4=$this->uri->segment('4'); $segment5=$this->uri->segment('5'); ?>
							<a href='#' class="btn btn-info add-new fa fa-plus" title='Print Sp-Laboratorium'onclick='linkopen_print_lab();'>Print</a>
							<script>
							function linkopen_print_lab() {
    						window.open("<?php echo site_url("lab/splab/print_formsplab/$segment4/$segment5"); ?>", "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=1280, height=720px");
							}
							</script> -->

						</div>
					</div>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
						<th scope="col">No</th>
						<th scope="col">ID Reg</th>
						<th scope="col">Nama</th>
						<th scope="col">Tindakan</th>
						<th scope="col">Diagnosa</th>
						<th scope="col">Tanggal Periksa</th>
						<th scope="col" >Cito</th>
						<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i=1;
						foreach($list_dat_pasien_lab as $k)
						{
					?>
						<tr>
						<?php 
							if($k->cito==1){
								$icon="<i class='fa fa-check' style='font-size:28;color:black'></i>";
								$classcito="w3-panel w3-border-left w3-pale-red";
							}else{
								$icon="";
								$classcito="";
							}	
							?>
							<td style="color:black;" class="<?php echo $classcito; ?>"><?php echo $i; ?></td>
							<td style="color:black;" class="<?php echo $classcito; ?>"><?php echo $k->registrasi;	 ?></td>
							<td style="color:black;" class="<?php echo $classcito; ?>"><?php echo $k->nama;	 ?></td>
							<td style="color:black;" class="<?php echo $classcito; ?>"><?php echo $k->tindakan;	 ?>,<?php echo $k->lainlain; ?></td>
							<td style="color:black;" class="<?php echo $classcito; ?>"><?php echo $k->diagnosa;	 ?></td>
							<td style="color:black;" class="<?php echo $classcito; ?>"><?php echo $k->tgl_proses;	 ?></td>
							<td align="center" style="color:black;" class="<?php echo $classcito; ?>"><?php echo $icon; ?></td>
							<td nowrap class="<?php echo $classcito; ?>">
<?php echo anchor_popup(("lab/splab/edit_formsplab/$segment4/$segment5/$k->id_digital_request"), "<label class='btn btn-info add-new fa fa-plus'>Edit</label>", '$attributes'); ?>

<?php echo anchor_popup(("lab/splab/delete_lab_id/$segment4/$segment5/$k->id_digital_request"), "<label class='btn btn-danger add-new fa fa-plus'>Delete</label>", '$attributes'); ?>
						</td>

							<?php
							$i++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
