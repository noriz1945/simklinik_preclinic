<script>
var save_method;
var table;

function add_fisik(id_reg) {
  save_method = 'add';
  $('#form_fisik')[0].reset();
  $('#modal_form_fisik').modal('show');

}

function save_fisik(id_reg) {
  var url;

  if (save_method == 'add') {
    url = '<?php echo site_url('nurse_station/stat_fisik_add'); ?>/' + id_reg;
    title = 'Data Berhasil Disimpan';
  } else {
    url = '<?php echo site_url('soap_awal/soap_awal_edit_act'); ?>/' + id_reg;
    title = 'Data Berhasil Diupdate';
  }
  var data_submit = $('#form_fisik').serialize();
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
    error: function(jqXHR, textStatus, errorThrown) {
      //console.log(data);
      alert('Error Add / Update Data');
    }
  });

}

function update_asm(id_asm) {
  save_method = 'update';
  $('#form_awal')[0].reset();

  $.ajax({
    url: '<?php echo site_url('soap_awal/soap_awal_edit'); ?>/' + id_asm,
    type: 'GET',
    dataType: 'JSON',
    success: function(data) {
      $('[name="id_asm"]').val(data.id_asm);
      $('[name="asm_date"]').val(data.asm_date);
      $('[name="id_pasien"]').val(data.id_pasien);
      $('[name="id_reg"]').val(data.id_reg);
      $('[name="id_dokter"]').val(data.id_dokter);
      $('[name="id_type"]').val(data.id_type);
      $('[name="sign"]').val(data.sign);

      $('[name="id_jns_asm"]').val(data.id_jns_asm).attr('selected', true);
      //$('#birth_month option[value="'+data.month+'"]').prop('selected', true);

      $('[name="kel_utama"]').val(data.kel_utama);
      $('[name="riwayat_sakit_now"]').val(data.riwayat_sakit_now);
      $('[name="riwayat_sakit_old"]').val(data.riwayat_sakit_old);
      $('[name="riwayat_pengobatan"]').val(data.riwayat_pengobatan);
      $('[name="riwayat_sakit_keluarga"]').val(data.riwayat_sakit_keluarga);
      $('[name="riwayat_alergi"]').val(data.riwayat_alergi);

      var status_psikologi = data.status_psikologi;
      if (status_psikologi.length > 0) {
        var status_psikologi = data.status_psikologi.split(","),
          $inputs = $('input[name^=status_psikologi]');
        for (var j = 0; j < status_psikologi.length; j++) {
          $inputs.filter('[value=' + status_psikologi[j] + ']').attr('checked', 'checked');
        }
      }

      var wajib_ibadah = data.wajib_ibadah;
      if (wajib_ibadah.length > 0) {
        var wajib_ibadah = data.wajib_ibadah.split(","),
          $inputs = $('input[name^=wajib_ibadah]');
        for (var j = 0; j < wajib_ibadah.length; j++) {
          $inputs.filter('[value=' + wajib_ibadah[j] + ']').attr('checked', 'checked');
        }
      }

      var taharoh = data.taharoh;
      if (taharoh.length > 0) {
        var taharoh = data.taharoh.split(","),
          $inputs = $('input[name^=taharoh]');
        for (var j = 0; j < taharoh.length; j++) {
          $inputs.filter('[value=' + taharoh[j] + ']').attr('checked', 'checked');
        }
      }

      var sholat = data.sholat;
      if (sholat.length > 0) {
        var sholat = data.sholat.split(","),
          $inputs = $('input[name^=sholat]');
        for (var j = 0; j < sholat.length; j++) {
          $inputs.filter('[value=' + sholat[j] + ']').attr('checked', 'checked');
        }
      }

      $('[name="kesadaran"]').val(data.kesadaran);
      $('[name="td"]').val(data.td);
      $('[name="nadi"]').val(data.nadi);
      $('[name="tinggi"]').val(data.tinggi);
      $('[name="keadaan_umum"]').val(data.keadaan_umum);
      $('[name="nafas"]').val(data.nafas);
      $('[name="suhu"]').val(data.suhu);
      $('[name="berat"]').val(data.berat);

      $('[name="pain_score"]').val(data.pain_score);

      var resiko_jatuh_dewasa = data.resiko_jatuh_dewasa;
      if (resiko_jatuh_dewasa.length > 0) {
        var resiko_jatuh_dewasa = data.resiko_jatuh_dewasa.split(","),
          $inputs = $('input[name^=resiko_jatuh_dewasa]');
        for (var j = 0; j < resiko_jatuh_dewasa.length; j++) {
          $inputs.filter('[value=' + resiko_jatuh_dewasa[j] + ']').attr('checked', 'checked');
        }

      }

      var resiko_jatuh_geriatri = data.resiko_jatuh_geriatri;
      if (resiko_jatuh_geriatri.length > 0) {
        var resiko_jatuh_geriatri = data.resiko_jatuh_geriatri.split(","),
          $inputs = $('input[name^=resiko_jatuh_geriatri]');
        for (var j = 0; j < resiko_jatuh_geriatri.length; j++) {
          $inputs.filter('[value=' + resiko_jatuh_geriatri[j] + ']').attr('checked', 'checked');
        }

      }

      var resiko_jatuh_anak = data.resiko_jatuh_anak;
      if (resiko_jatuh_anak.length > 0) {
        var resiko_jatuh_anak = data.resiko_jatuh_anak.split(","),
          $inputs = $('input[name^=resiko_jatuh_anak]');
        for (var j = 0; j < resiko_jatuh_anak.length; j++) {
          $inputs.filter('[value=' + resiko_jatuh_anak[j] + ']').attr('checked', 'checked');
        }

      }

      var turun_bb = data.turun_bb;
      if (turun_bb.length > 0) {
        var turun_bb = data.turun_bb.split(","),
          $inputs = $('input[name^=turun_bb]');
        for (var j = 0; j < turun_bb.length; j++) {
          $inputs.filter('[value=' + turun_bb[j] + ']').attr('checked', 'checked');
        }

      }

      var turun_bb_value = data.turun_bb_value;
      if (turun_bb_value.length > 0) {
        var turun_bb_value = data.turun_bb_value.split(","),
          $inputs = $('input[name^=turun_bb_value]');
        for (var j = 0; j < turun_bb_value.length; j++) {
          $inputs.filter('[value=' + turun_bb_value[j] + ']').attr('checked', 'checked');
        }

      }

      var nafsu_makan = data.nafsu_makan;
      if (nafsu_makan.length > 0) {
        var nafsu_makan = data.nafsu_makan.split(","),
          $inputs = $('input[name^=nafsu_makan]');
        for (var j = 0; j < nafsu_makan.length; j++) {
          $inputs.filter('[value=' + nafsu_makan[j] + ']').attr('checked', 'checked');
        }

      }

      var status_fungsional = data.status_fungsional;
      if (status_fungsional.length > 0) {
        var status_fungsional = data.status_fungsional.split(" "),
          $inputs = $('input[name^=status_fungsional]');
        for (var j = 0; j < status_fungsional.length; j++) {
          $inputs.filter('[value=' + status_fungsional[j] + ']').attr('checked', 'checked');
        }

      }

      $('[name="pemeriksaan_penunjang"]').val(data.pemeriksaan_penunjang);
      $('[name="diagnosis_kerja"]').val(data.diagnosis_kerja);
      $('[name="rencana"]').val(data.rencana);
      $('[name="terapi"]').val(data.terapi);
      $('[name="prioritas_perawatan"]').val(data.prioritas_perawatan);
      $('[name="indikasi_rawat"]').val(data.indikasi_rawat);

      //$('[name="created"]').val(data.created);
      //$('[name="creator"]').val(data.creator);
      $('[name="updated"]').val(data.updated);
      $('[name="updator"]').val(data.updator);


      $('#modal_form_awal').modal('show');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      //console.log(data);
      alert('Error Get Data From Ajax');
    }
  });

}

function delete_asm(id_asm) {
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
      url: '<?php echo site_url('soap_awal/soap_awal_delete'); ?>/' + id_asm,
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
            location.reload();
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