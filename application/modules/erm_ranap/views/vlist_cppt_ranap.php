<div class="container-fluid" id="box_list_cppt">
  <div class="table-wrapper">

    <div class="table-title">
      <div class="row">
        <div class="col-sm-8 p-5">
          <button type="button" class="btn btn-secondary add-new fa fa-plus" id="butt_tambah_cppt" onClick="javascript : add_new_cppt_ranap('<?php echo $id_reg; ?>')">
            TAMBAH
          </button>
        </div>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" class="text-center">No</th>
          <th scope="col" class="text-center">Noreg</th>
          <th scope="col" class="text-center">Tgl Kaji</th>
          <th scope="col" class="text-center">Kategori</th>
          <th scope="col" class="text-center">Jenis</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($rs as $v)
        {
          $icon_update = base_url('assets/img/tulis.png');
          $icon_delete = base_url('assets/img/delete.png');

          $id_asmri 	= $v['id_asmri'];
          $update ='<a href="#" onclick="javascript:edit_cppt_ranap('.$id_asmri.')"><img src="'.$icon_update.'" alt="Update"></a>';
          $delete ='<a href="#" onclick="javascript:delete_asm('.$id_asmri.')"><img src="'.$icon_delete.'" alt="Update"></a>';

         ?>
        <tr>
          <td> <?php echo $i; ?> </td>
          <td> <?php echo $v['id_reg']; ?> </td>
          <td> <?php echo $v['tgl_pengkajian']; ?> </td>
          <td> <?php echo $v['kategori']; ?></td>
          <td> <?php echo $v['jenis_asm']; ?></td>
          <td class="text-center">
            <a href="#" onClick="javascript:void window.open('<?php echo base_url('ppa/ppa_viewer/'.$id_asmri) ?>','1541221517736', 'width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">
              <img src="<?php echo base_url('assets/img/view.png'); ?>" alt="View"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo $update; ?> &nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo $delete; ?> &nbsp;&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
      <?php $i++; } ?>
      </tbody>
    </table>

  </div>
  
  <div id="result"></div>
</div>
<!--
<div class="modal animated bounceIn" id="modal_form_cppt" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-lg-smart" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">CPPT PPA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form_cppt">
      </div>
    </div>
  </div>
</div>
-->
<?php #$this->theme->script('theme_default'); ?>
<script>
function add_new_cppt_ranap()
{
	$.get( "<?php echo base_url('erm_ranap/add_cppt/'.$id_reg); ?>", function( data ) {
		$( "#box_list_cppt" ).html( data );
		//alert( "Load was performed." );
	});
}
function edit_cppt_ranap(id_asmri)
{
	inner_loader('<?php echo base_url('erm_ranap/add_cppt/'.$id_reg.'/') ?>' + id_asmri, '#box_list_cppt', false, '');
}

function delete_asm(id_asmri) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {

        $.ajax({
          url: '<?php echo site_url('erm_ranap/delete_asm_ranap');?>/'+id_asmri,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            if (result.value) {
              /* Swal({
                type: 'success',
                title: 'Data Berhasil Dihapus',
                showConfirmButton: false,
                timer: 1000
              }); */

              window.setTimeout(function() {
                location.reload();
              }, 1000);
            } else {
              Swal.close(
                'Cancelled',
                'Dibatalkan',
                'error'
              )
            }

          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error DELETE Data From Ajax');
          }
        });

      } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
      ) {
        /* swal.fire(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
        ) */
      }


    });

  }
</script>