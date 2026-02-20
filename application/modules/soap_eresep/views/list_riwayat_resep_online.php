

  <h5 class="p-20 z-depth-0" style="margin:5px 0 0 0; padding:5px;background:#00ced1;color:white;"> List Riwayat eResep : </h5>
  <div class="table-responsive" style="border:#CCC thin solid;">
    <table class="table table-bordered table-responsive styled-table" style="min-height:875px;height:110px;overflow-x: hidden;overflow-y: auto;">
    	<thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Tanggal e-Resep</th>
          <th scope="col">Jenis Rawat</th>
          <th scope="col">Id.Reg</th>
          <th scope="col">Dokter</th>
          <th scope="col">Fungsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach($rs_eresep as $k => $v)
        {
          if($v['is_edited']=="1"){
            $det_set_flagedit = "background-color:crimson;";
          }else{
            $det_set_flagedit = "";
          }
        ?>
        <tr id="tr_riw_<?php echo $v['id_eresep']; ?>" bgcolor="<?php echo $v['bgcolor_riw_eresep']; ?>">
          <td style="<?php echo $det_set_flagedit; ?>"><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $no; ?></a></td>
          <td style="<?php echo $det_set_flagedit; ?>"><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['eresepdate'] ?></a></td>
          <td style="<?php echo $det_set_flagedit; ?>"><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['tipe_rawat'] ?></a></td>
          <td style="<?php echo $det_set_flagedit; ?>"><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['id_reg'] ?></a></td>
          <td style="<?php echo $det_set_flagedit; ?>"><a href="#" onClick="javascript: load_eresep_detail(<?php echo $v['id_eresep'] ?>); return false;"><?php echo $v['nama_dokter'] ?></a></td>
          <td style="text-align:center;"><?php echo $v['fungsi'] ?></td>
        </tr>
        <?php
        $no++;
        }
        ?>
      </tbody>
    </table>
  </div>    

	

<div style="" id="box_list_riwayat_eresep_online_det"></div>
<script>
function load_eresep_detail(id_eresep)
{
	$("#box_list_riwayat_eresep_online_det" ).load( "<?php echo base_url('soap_eresep/list_riwayat_resep_online_det/'); ?>" + id_eresep ,function(){
			//alert('loaded');
		});
}

function hapus_eresep_hangat(id_eresep){
 /////
 Swal.fire({
    title: 'Hapus E-Resep',
    text: 'Hapus E-Resep ?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Hapus E-Resep!','Hapus E-Resep berhasil!', 'success').then(function(){ 
          $.get("<?php echo base_url('soap_eresep/remove_eresep_hangat/'); ?>" + id_eresep, function(data){
		        //console.log(data);
		        if(data == 'ok'){
			        $("#tr_riw_" + id_eresep).remove();
        		}else{
              Swal.fire('Gagal Hapus!', 'eResep tidak dapat dihapus karena sudah diproses oleh farmasi, silahkan hubungi bagian farmasi!', 'danger');
            }
	        });
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Hapus E-Resep!', 'Batal hapus E-Resep!', 'info')
      }
 })
 ////
}

function cancel_eresep_by_phone(id_eresep)
{
	$.get("<?php echo base_url('soap_eresep/cancel_eresep_by_phone/'); ?>" + id_eresep, function(data)
	{
		//console.log(data);
		if(data == 'ok')
		{
			$("#tr_riw_" + id_eresep).attr("bgcolor","#9ba19a");
			alert('Resep berhasil dibatalkan');
		}
		else
			alert('Pembatalan eResep gagal');
	});
}
</script>
