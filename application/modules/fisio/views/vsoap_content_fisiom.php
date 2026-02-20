<div class="container-fluid">
	<div class="table-wrapper">

		<div class="table-title">
			<div class="row">
				<div class="col-sm-8 p-5">

				<button type="button" class="btn btn-info add-new fa fa-plus" onclick="javascript:indexrehab('<?php echo $id_reg; ?>')" >
								TAMBAH
							</button>
				</div>
			</div>
		</div>

		<table class="table table-bordered">
		<table class="table table-bordered">
					<thead>
						<tr>
						<th scope="col">No</th>
						<th scope="col">ID Order</th>
 		        <th scope="col">ID Registrasi</th>
						<th scope="col">Nama</th>
						<th scope="col">Diagnosa</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=1;
						
						foreach($data_row as $k)
						{
							$id_digit 	= $k['id_digital_request'];
							$id_reg 	= $k['registrasi'];
              $id_rm		= $k['rm']; 
              $nama_pasien= $k['nama']; 
							//$date_proses= $k['tgl_proses'];
							//$date_proses= date("d-m-Y", strtotime($date_proses) );
							$tgl_request= $k['tgl_periksa'];
							$diag= $k['diagnosa'];
					?>
						<tr>
							<td style="color:black;" >
								<?php echo $i; ?>
							</td>
							<td style="color:black;" >
								<?php echo $id_digit;	 ?>
							</td>
							<td style="color:black;" >
								<?php echo $id_reg;	 ?>
							</td>
							<td style="color:black;" >
								<?php echo $nama_pasien; ?>
							</td>
							<td style="color:black;" >
								<?php echo $diag; ?>
							</td>
							<td style="color:black;" >
								<?php echo $tgl_request; ?>
							</td>
						
							<td class="text-center"  style="color:black;" >
								<a href="#loader_box_rehab" onclick="javascript:edit_formsprehab('<?php echo $id_digit; ?>')"><img src="<?php echo base_url('assets/img/tulis.png'); ?>" alt="Update"></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="#loader_box_rehab" class="delbutton" id="<?php echo $id_digit ?>"><img src="<?php echo base_url('assets/img/delete.png'); ?>" alt="Delete"></a>
							</td>
						</tr>
						<?php
							$i++;
							}
						?>
					</tbody>
				</table>

	</div>
</div>




<!--jjj-->
<div class="modal animated bounceIn" id="Modalfisiomod" role="dialog">
	<div class="modal-dialog modal-lg modal-lg-smart" role="document">
		<div class="modal-content">
			<div class="modal-body" id="ModalBodyfisiomod">
			
			</div>
		</div>
	</div>
</div>
<!--kdlklk-->


<script>
  function indexrehab(id_pasienx) {
      $.get("<?php echo base_url('fisio/rehabmedik/indexrehab/') ?>" + id_pasienx + "/<?php echo $optional_page; ?>")
        .done(function (data) {
          //alert("Data Loaded: " + data);

          $('#ModalBodyfisiomod').html(data);
          $('#Modalfisiomod').modal('show');
          //$('#myModal').modal('hide')
        });
    }

		function edit_formsprehab(id_digit) {
      $.get("<?php echo base_url('fisio/rehabmedik/edit_formsprehab/') ?>" + id_digit + "/<?php echo $optional_page; ?>")
        .done(function (data) {
          //alert("Data Loaded: " + data);

          $('#ModalBodyfisiomod').html(data);
          $('#Modalfisiomod').modal('show');
          //$('#myModal').modal('hide')
        });
    }

$(".delbutton").click(function(){
 var optional_page = '<?php echo $optional_page; ?>';
 //Save the link in a variable called element
 var element = $(this);
 
 //Find the id of the link that was clicked
 var id_digit = element.attr("id");
 
 //Built a url to send
 var info = 'id=' + id_digit;
 if(confirm("Hapus data order Rehabmedik ?"))
 {
 $.ajax({
 type: "POST",
 url : '<?php echo site_url('fisio/rehabmedik/hapus_fisio'); ?>/'+id_digit,
 data: info,
 success: function(){
		alert("Hapus data berhasil !");
		if(optional_page!='')
		{
			inner_loader('<?php echo base_url('fisio/rehabmedik/fisio_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rehab', false, '');
		}
		else
			location.reload();
 }
 });
 
 $(this).parents(".record").animate({ opacity: "hide" }, "slow");
 
 }

 return false;
 
 });
</script>
