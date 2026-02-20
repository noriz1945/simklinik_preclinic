<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>
</head>
<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>
<div class="container-fluid">

  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">

        <form name="form1" method="post" action="<?php echo base_url('rekam_medis/cari_pasien_poli') ?>"
          class="form-inline">
          <div class="form-group">
            <input type="text" name="id_pasien" id="id_pasien" class="form-control" placeholder="No. RM Pasien"
              value="<?php echo $id_pasien; ?>">
          </div> &nbsp&nbsp&nbsp
          <div class="form-group">
            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="Nama Pasien"
              value="<?php echo $nama_pasien; ?>">
          </div>&nbsp&nbsp&nbsp
          <input class="btn btn-secondary" type="submit" name="button" value="Tampilkan">
        </form>
      </div>
    </div>
  </div>

  <div class="card-body" id="box_data_reg">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">No Reg</th>
            <th scope="col">No RM</th>
            <th scope="col">Regdate</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Dokter</th>
            <th scope="col">Asuransi</th>
            <!-- <th scope="col">Status</th> -->
            <th scope="col">Action</th>
            <th scope="col">Surat Sakit</th>
          </tr>
        </thead>
        <tbody>
          <?php
        $i=1;
        foreach($rs as $v)
        {
          $id_reg = $v['id_reg'];
          $id_pasien = $v['id_pasien'];

          $regdate	= $v['regdate'];
          $regdate	= date("d-m-Y", strtotime($regdate) );

          if($v['cek_fisik'] > 0)
          {
            $status = '<span class="badge badge-success">Done</span>';
            $add    = 'style="display: none;"';
            $update = '';
            $delete = '';
          }
          else
          {
            $status = '<span class="badge badge-danger">Waiting</span>';
            $add    = '';
            $update = 'style="display: none;"';
            $delete = 'style="display: none;"';
          }

          if($v['cek_sukit'] > 0)
          {
            $sukit = '';
          }
          else
          {
            $sukit = 'style="display: none;"';
          }

      ?>
          <tr class="table-row" data-href="<?php echo site_url("soap/epoli/pasien_list/"."$id_reg/".$id_pasien) ?>">
            <td>
              <?php echo $i; ?>
            </td>
            <td>
              <?php echo $v['id_reg'];	 ?>
            </td>
            <td>
              <?php echo $v['id_pasien']; ?>
            </td>
            <td>
              <?php echo $v['regdate']; ?>
            </td>
            <td>
              <?php echo $v['pasien']; ?>
            </td>
            <td>

              <?php 
                if ($v['ugd']=='1') {
                  echo $v['dokter_igd']; 
                }else{
                  echo $v['dokter']; 
                }
              ?>
            </td>
            <td>
              <?php echo $v['asuransi']; ?>
            </td>
            <!-- 
            <td>
              <?php echo $status; ?>
            </td>
             -->
            <td>
              <a href="#" onClick="javascript:void window.open('<?php echo base_url('resume_medis/print_resmed_v2/'.$v['id_reg']) ?>','1541221517736', 'width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><img src="<?php echo base_url('assets/img/print1.png'); ?>" alt="View"></a>
            </td>
            <td>
              <a <?php echo $sukit; ?> href="#" onClick="javascript:void window.open('<?php echo base_url('surat_sakit/surat_sakit_print_byidreg/' . $v['id_reg'].'/'.$v['id_dokter']) ?>','1541221517736','width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><img src="<?php echo base_url('assets/img/mail.png'); ?>" alt="View"></a>&nbsp;&nbsp;&nbsp;&nbsp;
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

</div>

</div>
<?php $this->theme->script('theme_default'); ?>
<script>
function add_fisik(id_reg) {
  $.get("<?php echo base_url('nurse_station/add_stat_fisik/') ?>" + id_reg)
    .done(function(data) {
      //alert("Data Loaded: " + data);

      $('#modal_form_fisik').html(data);
      $('#modal_fisik').modal('show');
      //$('#myModal').modal('hide')
    });
}

function edit_fisik(id_reg) {
  $.get("<?php echo base_url('nurse_station/edit_stat_fisik/') ?>" + id_reg)
    .done(function(data) {
      //alert("Data Loaded: " + data);

      $('#modal_form_fisik').html(data);
      $('#modal_fisik').modal('show');
      //$('#myModal').modal('hide')
    });
}

function delete_fisik(id_reg) {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    $.ajax({
      url: '<?php echo site_url('nurse_station/delete_stat_fisik'); ?>/' + id_reg,
      type: 'POST',
      dataType: 'JSON',
      success: function(data) {
        if (result.value) {
          Swal.fire({
            type: 'success',
            title: 'Data Berhasil Dihapus',
            showConfirmButton: false,
            timer: 1000
          });

          window.setTimeout(function() {
            window.location.replace('<?php echo base_url('nurse_station/cari_pasien_poli/') ?>');
          }, 1000);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error DELETE Data From Ajax');
      }
    });
  })

}
</script>


<div class="modal animated bounceIn" id="modal_fisik" role="dialog">
  <div class="modal-dialog modal-lg modal-lg-smart" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Form Rekam Medis Pasien Rawat Jalan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body form_fisik" id="modal_form_fisik">

      </div>

    </div>
  </div>
</div>

</body>

</html>
