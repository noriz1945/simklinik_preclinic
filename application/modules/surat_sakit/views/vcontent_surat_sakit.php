<!doctype html>
<html>

<head>

</head>

<div class="container-fluid">
  <div class="table-wrapper">

    <div class="table-title">
      <div class="row">
        <div class="col-sm-8 p-5">
          <button type="button" class="btn btn-secondary add-new fa fa-plus" onclick="add_surat_sakit('<?php echo $id_reg; ?>')">
            TAMBAH
          </button>
        </div>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" class="text-center">No</th>
          <th scope="col" class="text-center">Tanggal</th>
          <th scope="col" class="text-center">No. RM / Noreg</th>
          <th scope="col" class="text-center">Poli Dokter</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
            $i = 1;
            foreach ($sukit as $k)
            {
          ?>
          <td><?php echo $i; ?> </td>
          <td><?php echo $k['created']; ?> </td>
          <td><?php echo $k['id_pasien']; ?> / <?php echo $k['id_reg']; ?></td>
          <td><?php echo $k['poli']; ?><br> <?php echo $k['dokter']; ?> </td>
          <td class="text-center">
            <a href="#" onClick="javascript:void window.open('<?php echo base_url('surat_sakit/surat_sakit_print/'.$k['id_sukit']) ?>','1541221517736', 'width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><img src="<?php echo base_url('assets/img/print1.png'); ?>" alt="View"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" onclick="javascript:update_sukit('<?php echo $k['id_sukit']; ?>')"><img src="<?php echo base_url('assets/img/tulis.png'); ?>" alt="Update"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" onclick="javascript:delete_sukit('<?php echo $k['id_sukit']; ?>')"><img src="<?php echo base_url('assets/img/delete.png'); ?>" alt="Delete"></a>&nbsp;&nbsp;&nbsp;&nbsp;
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

<div class="modal animated bounceIn" id="modal_form_sukit" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-lg-smart" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">FORM SURAT IJIN SAKIT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form_sukit">
        <form action="#" id="form_sukit">
          <div class="form-body">
            <div class="row">

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>Nama</strong></label>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label class="control-label"><strong>: </strong></label>
                      <label class="control-label"><strong><?php echo $pasien['nama_pasien']; ?> </strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>NIK</strong></label>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label class="control-label"><strong>: </strong></label>
                      <label class="control-label"><strong><?php echo $pasien['pid_num']; ?> </strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>Umur</strong></label>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label class="control-label"><strong>: </strong></label>
                      <label class="control-label"><strong><?php echo $pasien['umur2']; ?></strong></label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>Alamat</strong></label>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label class="control-label"><strong>: </strong></label>
                      <label class="control-label"><strong><?php echo $pasien['alamat']; ?>, <?php echo $pasien['kelurahan']; ?>
                        Kec. <?php echo $pasien['kecamatan']; ?>, Kota/Kab. <?php echo $pasien['kota']; ?> </strong></label>
                      <!-- <input type="text" class="form-control input-sm" id="alamat" name="alamat" value=""> -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="alert alert-danger print-error-msg"></div>
              <input type="hidden"  id="id_sukit" name="id_sukit" value="">

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>Pekerjaan</strong></label>
                    </div>
                  </div>
                  <div class="col-md-10">
                      <strong>: </strong><input type="text"  id="pekerjaan" name="pekerjaan" value="">
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>Lama Cuti</strong></label>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <strong>: </strong><input type="text"  id="lama_cuti" name="lama_cuti" value="">
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>Alasan Cuti</strong></label>
                    </div>
                  </div>

                  <div class="col-md-1">
                    <div class="form-group">
                      <input type="checkbox" name="alasan[]" value="1"> Sakit
                      <div class="input-group-addon"> </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="checkbox" name="alasan[]" value="2"> Melahirkan / Periksa Hamil
                      <div class="input-group-addon"> </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label"><strong>Tanggal Cuti</strong></label>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <strong>: </strong> <input type="text" id="tgl_cuti_start" name="tgl_cuti_start" class="tanggal" placeholder="Tanggal Mulai" />
                    <strong> Sampai Dengan </strong> <input type="text" id="tgl_cuti_end" name="tgl_cuti_end" class="tanggal" placeholder="Tanggal Akhir" />
                  </div>
                </div>
              </div>

            </div>

            <div class="modal-footer">
              <div class="form-actions">
                <button type="button" class="btn btn-success" onclick="javascript: save_sukit('<?php echo $id_reg; ?>');">
                  <i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $this->theme->script('theme_default'); ?>

<!-- action here -->
<script>
  // Date picker only
  $('.tanggal').datepicker({
    dateFormat: "yy-mm-dd",
    autoclose: true,
    language: 'id',
  });

  $(".tanggal").datepicker("setDate", new Date());

  var save_method;
  var table;

  function add_surat_sakit(id_reg) {
    save_method = 'add';
    $('#form_sukit')[0].reset();
    $('#modal_form_sukit').modal('show');
  }

  function save_sukit(id_reg) {
    var url;

    if (save_method == 'add') {
      url = '<?php echo site_url('surat_sakit/surat_sakit_add');?>/'+id_reg;
      title = 'Data Berhasil Disimpan';
    } else {
      url = '<?php echo site_url('surat_sakit/surat_sakit_edit_act');?>/'+id_reg;
      title = 'Data Berhasil Diupdate';
    }
    var data_submit = $('#form_sukit').serialize();
    $.ajax({
      type: 'POST',
      data: data_submit,
      dataType: 'JSON',
      url: url,
      success: function(data) {
        //console.log(data_submit);
        //console.log(data);
        Swal.fire({
          type: 'success',
          title: title,
          showConfirmButton: false,
          timer: 1000
        });

        window.setTimeout(function() {
          location.reload();
        }, 1000);
      },
      // error: function (jqXHR, exception) {
      //   console.log(jqXHR);
      //   getErrorMessage(jqXHR, exception);
      // }
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(data);
        //alert(data);

        $('[id="print-error-msg"]').css('display','block');
        $('[id="print-error-msg"]').val(data.error);

        // $(".print-error-msg").css('display','block');
        // $(".print-error-msg").html(data);
      }
    });

  }

  function update_sukit(id_sukit) {
    save_method = 'update';
    $('#form_sukit')[0].reset();

    $.ajax({
      url: '<?php echo site_url('surat_sakit/surat_sakit_edit');?>/'+id_sukit,
      type: 'GET',
      dataType: 'JSON',
      success: function(data) {
        $('[name="id_sukit"]').val(data.id_sukit);

        $('[name="pekerjaan"]').val(data.pekerjaan);
        $('[name="lama_cuti"]').val(data.lama_cuti);

        var alasan = data.alasan;
        if (alasan.length > 0) {
          var alasan = data.alasan.split(","),
            $inputs = $('input[name^=alasan]');
          for (var j = 0; j < alasan.length; j++) {
            $inputs.filter('[value=' + alasan[j] + ']').attr('checked', 'checked');
          }
        }

        $('[name="tgl_cuti_start"]').val(data.tgl_cuti_start);
        $('[name="tgl_cuti_end"]').val(data.tgl_cuti_end);


        $('#modal_form_sukit').modal('show');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(data);
        alert('Error Get Data From Ajax');
      }
    });

  }

  function delete_sukit(id_sukit) {
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
          url: '<?php echo site_url('surat_sakit/surat_sakit_delete');?>/'+id_sukit,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            if (result.value) {
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

</body>

</html>
