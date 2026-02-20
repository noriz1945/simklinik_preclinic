<input type="hidden" id="ideresepset" name="ideresepset" value="<?php echo $id_eresep; ?>" readonly>
<div style="" id="box_list_riwayat_eresep_online_det"></div>
<script>
  $( document ).ready(function() {
    var id_eresep     = $('#ideresepset').val();
	$("#box_list_riwayat_eresep_online_det" ).load( "<?php echo base_url('soap_eresep/list_riwayat_resep_farmasi_online_det/'); ?>" + id_eresep ,function(){
			//alert('loaded');
		});
});

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
