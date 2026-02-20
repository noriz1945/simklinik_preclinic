

<div class="container-fluid">
	<div class="table-wrapper">

		<div class="table-title">
			<div class="row">
				<div class="col-sm-8 p-5">

				<button type="button" class="btn btn-info add-new fa fa-plus" onclick="javascript:indexrad('<?php echo $id_reg; ?>')" >
								TAMBAH
							</button>
				</div>
			</div>
		</div>

		<table class="table table-bordered">
		<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col" class="text-center">No</th>
							<th scope="col" class="text-center">ID Reg</th>
							<th scope="col" class="text-center">Nama</th>
							<th scope="col" class="text-center">Tindakan</th>
							<th scope="col" class="text-center">Diagnosa</th>
							<th scope="col" class="text-center">Tanggal Periksa</th>
							<th scope="col" class="text-center">Cito</th>
							<th scope="col" class="text-center">Aksi</th>
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
							$date_proses= $k['tgl_proses'];
							$date_proses= date("d-m-Y", strtotime($date_proses) );
							$tindakan= $k['tindakan'];
							$lainlaingigi= $k['lainlaingigi'];
							$lainlainct= $k['lainlainct'];
							$lainlainmri= $k['lainlainmri'];
							$lainlain= $k['lainlain'];
							$diag= $k['diagnosa'];
							$cito= $k['cito'];
							if($cito==1){
								$icon="<i class='fa fa-check' style='font-size:28;color:black'></i>";
								$classcito="w3-panel w3-border-left w3-pale-red";
							}else{
								$icon="";
								$classcito="";
							}	
					?>
						<tr>
							<td style="color:black;" class="<?php echo $classcito; ?>">
								<?php echo $i; ?>
							</td>
							<td style="color:black;" class="<?php echo $classcito; ?>">
								<?php echo $id_rm;	 ?>
							</td>
							<td style="color:black;" class="<?php echo $classcito; ?>">
								<?php echo $nama_pasien;	 ?>
							</td>
							<td style="color:black;" class="<?php echo $classcito; ?>">
								<?php echo $tindakan; ?>,<?php echo $lainlaingigi; ?>,<?php echo $lainlainct; ?>,<?php echo $lainlainmri; ?>,<?php echo $lainlain; ?>
							</td>
							<td style="color:black;" class="<?php echo $classcito; ?>">
								<?php echo $diag; ?>
							</td>
							<td style="color:black;" class="<?php echo $classcito; ?>">
								<?php echo $date_proses; ?>
							</td>
							<td align="center" style="color:black;" class="<?php echo $classcito; ?>"><?php echo $icon; ?>
							</td>
							<td class="text-center"  style="color:black;" class="<?php echo $classcito; ?>">
								<a href="#anchor_order_rad" onclick="javascript:edit_formsprad('<?php echo $id_digit; ?>')"><img src="<?php echo base_url('assets/img/tulis.png'); ?>" alt="Update"></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="#anchor_order_rad" class="delbutton" id="<?php echo $id_digit ?>"><img src="<?php echo base_url('assets/img/delete.png'); ?>" alt="Delete"></a>
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
<div class="modal animated bounceIn" id="Modalradmod" role="dialog">
	<div class="modal-dialog modal-lg modal-lg-smart" role="document">
		<div class="modal-content">
			<div class="modal-body" id="ModalBodyradmod">
			
			</div>
		</div>
	</div>
</div>
<!--kdlklk-->


<script>
  function indexrad(id_pasienx) {
      $.get("<?php echo base_url('rad/radiologi/indexrad/') ?>" + id_pasienx + "/<?php echo $optional_page; ?>")
        .done(function (data) {
          //alert("Data Loaded: " + data);

          $('#ModalBodyradmod').html(data);
          $('#Modalradmod').modal('show');
          //$('#myModal').modal('hide')
        });
    }

		function edit_formsprad(id_digit) {
      $.get("<?php echo base_url('rad/radiologi/edit_formsprad/') ?>" + id_digit + "/<?php echo $optional_page; ?>")
        .done(function (data) {
          //alert("Data Loaded: " + data);

          $('#ModalBodyradmod').html(data);
          $('#Modalradmod').modal('show');
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
 if(confirm("Hapus data order Radiologi ?"))
 {
 $.ajax({
 type: "POST",
 url : '<?php echo site_url('rad/radiologi/hapus_rad'); ?>/'+id_digit + "/<?php echo $optional_page; ?>",
 data: info,
 success: function(){
	 alert("Hapus data berhasil !");
	 if(optional_page!='')
	 {
		 inner_loader('<?php echo base_url('rad/radiologi/rad_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rad', false, '');
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
