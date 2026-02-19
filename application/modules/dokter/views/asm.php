
<input type="text" id="idregset" name="idregset" value="<?php echo $id_reg; ?>" readonly hidden> 
<input type="text" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" readonly hidden>

<div class="card" id="assesmentawal">
<div class="card-header">
<h5>ASSESMENT AWAL</h5>
</div>
<div class="card-block">
<div class="container-fluid">
	<form id="frm_asm_ri_dokter" method="post" action="<?php echo base_url('dokter/soap/act_assesment/'.$id_reg.'/'.$id_pasien); ?>">
  <input type="hidden" id="id_asmri" name="id_asmri" value="<?php echo $row['id_asmri']; ?>">
  <input type="hidden" id="sql_command" name="sql_command" value="<?php echo $sql_command; ?>">
  <input type="hidden" id="kategori" name="kategori" value="ASM">
  <input type="hidden" id="asal_masuk_set" value="<?php echo $row['asal_masuk']; ?>" />
  <input type="hidden" id="cara_masuk_set" value="<?php echo $row['cara_masuk']; ?>" />
  <div class="row pnl">
    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Pengkajian </label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="tgl_pengkajian" id="tgl_pengkajian" class="form-control tanggal" value="<?php echo $row['tgl_pengkajian']; ?>">
        </div>
      </div>
    </div>
  </div>


	<h3 class="pnl-head-3" style="margin-top:30px">SUBJECTIVE</h3>
  <div class="row pnl">

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Keluhan Utama :</label>
        <textarea class="form-control input-focus area-scroll" id="keluhan_utama" name="keluhan_utama" rows="5"
          placeholder="Keluhan Utama"><?php echo $row['keluhan_utama']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Sekarang :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_now" name="riwayat_sakit" rows="5" placeholder="Riwayat Penyakit Sekarang"><?php echo $row['riwayat_sakit']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Dahulu :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_old" name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Dahulu"><?php echo $riwayat_pasien['penyakit_dahulu']; ?></textarea>
      </div>
    </div>

    <!--/span-->
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Pengobatan/Operasi/Obstetri :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan"
          name="riwayat_pengobatan" rows="5" placeholder="Riwayat Pengobatan/Operasi/Obstetri"><?php echo $riwayat_pasien['pengobatan']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Keluarga :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_keluarga"
          name="riwayat_sakit_keluarga" rows="5" placeholder="Riwayat Penyakit Keluarga"><?php echo $riwayat_pasien['penyakit_keluarga']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Alergi :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi"
          rows="5" placeholder="Riwayat Alergi"><?php echo $riwayat_pasien['alergi']; ?></textarea>
      </div>
    </div>

  </div>
  <br>

	<h3 class="pnl-head-3">OBJECTIVE</h3>
  <div class="row pnl pnl-obj">
    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="objective" name="objective" rows="5"
          placeholder="Objective"><?php echo $row['objective']; ?></textarea>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <h4>TTV</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Kesadaran</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="kesadaran" name="kesadaran" placeholder="Kesadaran" value="<?php echo $row['kesadaran']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Keadaan Umum</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="keadaan_umum" name="keadaan_umum" placeholder="Keadaan Umum" value="<?php echo $row['keadaan_umum']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tekanan Darah</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="td" name="td" placeholder="Tekanan Darah" value="<?php echo $row['td']; ?>">
      </div>
    </div>


    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">GCS</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="gcs" name="gcs" placeholder="GCS" value="<?php echo $row['gcs']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Nadi</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nadi" name="nadi" placeholder="Nadi" value="<?php echo $row['nadi']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">SUHU</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="suhu" name="suhu" placeholder="SUHU" value="<?php echo $row['suhu']; ?>">
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Berat Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="berat" name="berat" placeholder="Berat Badan" value="<?php echo $row['berat']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Reaksi Cahaya</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="reaksi_cahaya" name="reaksi_cahaya" placeholder="Reaksi Cahaya" value="<?php echo $row['reaksi_cahaya']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tinggi Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="tinggi" name="tinggi" placeholder="Tinggi Badan" value="<?php echo $row['tinggi']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Pernafasan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nafas" name="nafas" placeholder="Pernafasan" value="<?php echo $row['nafas']; ?>">
      </div>
    </div>



  </div>
  <br>

  <h3 class="pnl-head-3">ASSESMENT</h3>
  <div class="row pnl pnl-asm">
    <div class="col-md-12">
      <div class="form-group">
    		<h4>Diagnosa Medis dan Diagnosa Banding</h4>
        <hr>
      </div>
    </div>
    <?php
		for($i=0;$i<=4;$i++){
		$caption = ($i==0) ? "Utama" : ("Sekundari ".($i+0)) ;
		?>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label"><?php echo $caption; ?> :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_ten[<?php echo $i; ?>]" name="name_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten_text[$i]; ?>">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_ten[<?php echo $i; ?>]" name="id_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten[$i]; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_ten[<?php echo $i; ?>]" name="old_id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly>
      </div>
    </div>
		<?php
		}
		?>
</div>
  <div class="col-md-12" style="margin-top:30px">
    <div class="form-group">
      <h4>PEMERIKSAAN FISIK (GAMBAR)</h4>
      <hr>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      	<div id="box_drawing_canvas"></div>
    </div>
  </div>

  </div>

	<h3 class="pnl-head-3" style="margin-top:30px">PLANNING</h3>
  <div class="row pnl pnl-plan">
    <div class="col-md-12">
      <div class="form-group">
    		<h4>RENCANA TINDAKAN</h4>
        <hr>
      </div>
    </div>
    <?php
		for($i=0;$i<=2;$i++){
		$caption = ($i==0) ? "Utama" : ("Sekundari ".($i+0)) ;
		?>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label"><?php echo $caption; ?> :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_nine[<?php echo $i; ?>]" name="name_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine_text[$i]; ?>">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_nine[<?php echo $i; ?>]" name="id_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine[$i]; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_nine[<?php echo $i; ?>]" name="old_id_icd_nine[<?php echo $i; ?>]" class="form-control" readonly>
      </div>
    </div>
		<?php
		}
		?>

    <!--tindakan-->
    <input type="text" class="form-control" id="idregset" name="idregset" readonly value="<?php echo $id_reg; ?>" hidden>
    <input type="text" class="form-control" id="idrmset" name="idrmset" readonly value="<?php echo $id_pasien; ?>" hidden>
    <input type="text" class="form-control" id="nameset" name="nameset" readonly value="<?php echo $id_pasien; ?>" hidden>

    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label">Tindakan :</label>
      </div>
    </div>

    <div class="col-md-5">
    <div class="form-group">
    <div class="form-group row">
    <div class="col-sm-12">
    <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">
      
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Tindakan</label>
        <div class="col-sm-8">
          <div class="ui-widget">
            <input id="nama_tindakan" name="nama_tindakan" class="form-control">
            <input type="hidden" id="id_act" name="id_act" class="hidden" readonly>
          </div>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Harga</label>
        <div class="col-sm-8">
          <input id="price" name="price" class="form-control autonumber fill" data-reverse>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Qty</label>
        <div class="col-sm-8">
          <input id="qty" name="qty" class="form-control autonumber fill" data-reverse>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Grup</label>
        <div class="col-sm-8">
          <input id="group" name="group" class="form-control" readonly>
          <input type="hidden" id="id_group" name="id_group" class="hidden" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Sub Grup</label>
        <div class="col-sm-8">
          <input id="subgroup" name="subgroup" class="form-control" readonly>
        </div>
      </div>
      
    <div class="form-group row" style="margin-top:10px;">
        <div class="col-sm-6 text-left">

      </div>
      <div class="col-sm-6 text-right">
        <button type="button" class="btn btn-primary" id="addrow_assesment"><i class="fa fa-plus"></i></button>
      </div>
    </div>
    </div>
    </div>
 
    </div>
    </div>
    </div>

    <div class="col-md-5">
    <div class="form-group">
    <div class="form-group row">
    <div class="col-sm-12">
    <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">
    <table class="table table-bordered table-hover table-striped table-responsive styled-table">
    <thead>
    <tr>
    <th scope="col">Tindakan</th>
    <th scope="col">Harga</th>
    <th scope="col">Qty</th>
    <th scope="col">Grup</th>
    <th scope="col">Sub Grup</th>
    <th scope="col" style="color:red;"><i class="fa fa-trash"></i></th>
    </tr>
    </thead>
    <tbody id="contdata_assesment"></tbody>
    </table>
    </div>
    </div>
 
    </div>
    </div>
    </div>
    

    
    <!--end tindakan-->

    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>INSTRUKSI</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="p_instruksi" name="p_instruksi" rows="5"
          placeholder="Instruksi"><?php echo $row['p_instruksi']; ?></textarea>
      </div>
    </div>

    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>RESEP ONLINE</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-12">
    	<!--
      <div class="form-group">
        <label class="control-label"><strong>RESEP ONLINE</strong></label>
      </div>
			-->
      <div class="form-group" id="box_new_eresep">
        <div class="col-sm-12 text-center">
          <h5>Loading page content, please wait...</h5>
          <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
        </div>
      </div>

    </div>

    <div class="col-md-12" id="loader_box_op" style="background-color:white;">
    </div>

  </div>

  <div class="col-md-12 text-center" style="margin-top:30px;">
    	<button type="submit" class="btn btn-success frmsubmit" style="font-size:22px"> <i class="fa fa-check"></i> S I M P A N </button>
    </div>
	</form>
</div>
</div>


<script>
    ////menu soap
  //$('#mnu_1').click(function(){
    var baseUrl = '<?php echo $baseUrl; ?>';
    var id_reg     = $('#idregset').val();
    var id_pasien  = $('#id_pasien').val();
    var type_rwt   = 'ri';
  
    $('.tanggal').datepicker({ dateFormat: 'yy-mm-dd' });
    var asal_masuk = $('#asal_masuk_set').val();
    var cara_masuk = $('#cara_masuk_set').val();
    $('#frm_asm_ri_dokter').find(':radio[name=asal_masuk][value="'+asal_masuk+'"]').prop('checked', true).val();
    $('#frm_asm_ri_dokter').find(':radio[name=cara_masuk][value="'+cara_masuk+'"]').prop('checked', true).val();
  
    //ICD TEN
    $("#name_icd_ten\\[0\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#id_icd_ten\\[0\\]").val(ui.item.id);
    }
    });
  
    $("#name_icd_ten\\[1\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#id_icd_ten\\[1\\]").val(ui.item.id);
    }
    });
  
    $("#name_icd_ten\\[2\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#id_icd_ten\\[2\\]").val(ui.item.id);
    }
    });
  
    $("#name_icd_ten\\[3\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#id_icd_ten\\[3\\]").val(ui.item.id);
    }
    });
  
    $("#name_icd_ten\\[4\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#id_icd_ten\\[4\\]").val(ui.item.id);
    }
    });
    //END ICD TEN
  
    //ICD NINE
    $("#name_icd_nine\\[0\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_nine",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#name_icd_nine\\[0\\]").val(ui.item.id);
    }
    });
  
    $("#name_icd_nine\\[1\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_nine",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#name_icd_nine\\[1\\]").val(ui.item.id);
    }
    });
  
    $("#name_icd_nine\\[2\\]").autocomplete({
    source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_nine",
    appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#name_icd_nine\\[2\\]").val(ui.item.id);
    }
    });
    //END ICD NINE
  
    //TINDAKAN
      //proses transaksi
      $.ajax({
        url : baseUrl+"transaksi/msttindakan",
        method : "POST",
        data : {},
        async : true,
        dataType : 'json',
        success: function(datarestind){
           var irestind;
            var dataresunitsend="<option value='0' selected disabled><p>-</p></option>";
            for (irestind = 0; irestind < datarestind.length; irestind++){    
            
            dataresunitsend +="<option value='"+datarestind[irestind].id_act+";"+datarestind[irestind].nama_tindakan+";"+datarestind[irestind].price+";"+datarestind[irestind].nama_grup+";"+datarestind[irestind].nama_subgrup+";"+datarestind[irestind].idgrup+"'><p>"+datarestind[irestind].nama_tindakan+"</p></option>";
            }
            $('.selmsttindakan_assawal').html(dataresunitsend);
          
            //var counter = 0;
            $('.pilihtindakan_assawal').change(function(){
            var id_reg_set      = $('#idregset').val();
            var id_rm_set       = $('#idrmset').val();
    
            var text = $('#tindakan_dipilih_assawal').val();
            
            const text_set = text.split(";");
            let idset           = text_set[0];
            let nameset         = text_set[1];
            let priceset        = text_set[2];
            let nama_grupset    = text_set[3];
            let nama_subgrupset = text_set[4];
            if(nama_subgrupset=="null"){
               var namagrupset = "-";
            }else{
               var namagrupset = nama_grupset
            }
            let idgrup_set     = text_set[5];
    
            //save to db 
            $.ajax({
              url : baseUrl+"transaksi/setinstindakan",
              method : "POST",
              data : {
                id_reg_set    : id_reg_set,
                id_rm_set     : id_rm_set,
                idset         : idset,
                nameset       : nameset,
                priceset      : priceset,
                nama_grupset  : nama_grupset,
                namagrupset   : namagrupset,
                idgrup_set    : idgrup_set
              },
              async : false,
              dataType : 'json',
              success: function(data){
                Swal.fire({
                  position: 'top-end',
                  title: 'Berhasil tambah tindakan ',
                  text: nameset,
                  showConfirmButton: false,
                  timer: 1500
                })
          
                readtrxactdraft_assawal();
              },
              fail: function(xhr, textStatus, errorThrown){
                 alert('request failed');
                }
            });
            //end save to db
          
            
            });
        }
      });
      //end proses transaksi
  
      //draft
        function readtrxactdraft_assawal(){
          var id_reg_set      = $('#idregset').val();
          $.ajax({
            url : baseUrl+"transaksi/trxdraft",
            method : "POST",
            data : {id_reg_set:id_reg_set},
            async : true,
            dataType : 'json',
            success: function(datarestind){
               var irestind;
                var datarestindakanadd="";
                for (irestind = 0; irestind < datarestind.length; irestind++){    
                  datarestindakanadd +="<tr style='background-color:#f6fc3a;'>"
                  +"<td>"+datarestind[irestind].nameset+"</td>"
                  +"<td>"+datarestind[irestind].name_group+"</td>"
                  +"<td>"+datarestind[irestind].name_subgroup+"</td>"
                  +"<td><input class='form-control edits' type='text' id='qty_set[]' name='qty_set[]' value='1' size='2'><input type='text' id='id_set[]' name='id_set[]' value="+datarestind[irestind].idset+" hidden readonly><input type='text' id='name_set[]' name='name_set[]' value="+datarestind[irestind].nameset+" hidden readonly><input type='text' id='price_set[]' name='price_set[]' value="+datarestind[irestind].priceset+" hidden readonly><input type='text' id='idgrup_set[]' name='idgrup_set[]' value="+datarestind[irestind].idgrup_set+" hidden readonly></td>"
                  +"<td>"+formatMoney(datarestind[irestind].priceset,0)+"</td>"
                  +"<td><input type='button' class='deleteread_temp_assawal done' id='delete_temp"+datarestind[irestind].id_trx+"' value='Delete' data-set-idtrx='"+datarestind[irestind].id_trx+"'></td>"
                  +"</tr>";
                }
                $('#todo_list_set_assawal').html(datarestindakanadd);   
  
                //delete
                $('.deleteread_temp_assawal').dblclick(function(){
                  var id_trx_set           = $(this).attr('data-set-idtrx'); 
                  //set delete
                  $.ajax({
                    url : baseUrl+"transaksi/trxregdelete_temp",
                    method : "POST",
                    data : {id_trx_set:id_trx_set},
                    async : true,
                    dataType : 'json',
                    success: function(datarestind){
                      Swal.fire({
                        position: 'top-end',
                        title: 'Berhasil hapus tindakan',
                        text: 'Tindakan di draft terhapus',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      readtrxactdraft_assawal();
                    }
                  });
                  //end set delete
                });
                  //end delete
              }
          });
        }
      //end draft
    //END TINDAKAN
  
    //eresep
    $.ajax({
      url : baseUrl+"soap_eresep/add_new",
      method : "POST",
      data : {id_reg:id_reg,id_pasien:id_pasien},
      async : true,
      dataType : 'html',
      success: function(datarestind){
          $('#box_new_eresep').html(datarestind);
        }
      });
    //end eresep
  
    //eresep
    $.ajax({
      url : baseUrl+"drawing/canvas_drawing",
      method : "POST",
      data : {id_reg:id_reg,id_pasien:id_pasien,type_rwt:type_rwt},
      async : true,
      dataType : 'html',
      success: function(datarestind){
          $('#box_drawing_canvas').html(datarestind);
        }
      });
    //end eresep
  
    //Order Lab
    $.ajax({
      url : baseUrl+"lab/splab/lab_modal_lad/"+id_reg+"/asm_ri",
      method : "POST",
      data : {id_reg:id_reg,id_pasien:id_pasien,type_rwt:type_rwt},
      async : true,
      dataType : 'html',
      success: function(datarestind){
          $('#loader_box_lab').html(datarestind);
        }
      });
    //end Order Lab
  //});
  ///end menu soap

   //INPUT
 $(function() {
	$("#nama_tindakan").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
      swal.fire('Mohon Maaf!','simbol .(titik) pada keyboard tidak bisa digunakan untuk input', 'danger');
			return false;
    }
  });
  
  $("#nama_tindakan").autocomplete({
    source: baseUrl+"soap/msttindakan",
    minLength: 3,
    select: function(event, ui) {
      $("#id_act").val(ui.item.id_act);
      $("#price").val(ui.item.price);
      $("#qty").val('1');
      $("#group").val(ui.item.group);
      $("#subgroup").val(ui.item.subgroup);
    }
  });
 });
 
 $(function() {
	$("#price").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			swal.fire('Mohon Maaf!','simbol .(titik) pada keyboard tidak bisa digunakan untuk input', 'danger');
			return false;
    }
  });
 });

 $(function() {
	$("#qty").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			swal.fire('Mohon Maaf!','simbol .(titik) pada keyboard tidak bisa digunakan untuk input', 'danger');
			return false;
    }
  });
 });
 //END INPUT

  // ADD ITEM INPUT
  $('#addrow_assesment').click(function(e) {
  
  var id_act           = $('#id_act').val();
  var nama_tindakan    = $('#nama_tindakan').val();
  var harga            = $('#price').val(); 
  var qty              = $('#qty').val(); 
  var id_group         = $('#id_group').val();  
  var group            = $('#group').val();  
  var subgroup         = $('#subgroup').val(); 
  var rand_no          = get_random_number();
 

  var tpl_row = '\n' +
    '<tr id="' + rand_no + '"> \n ' +
    '<td>' + nama_tindakan + '				<input type="hidden" name="nama_tindakan[]" 				value="' + nama_tindakan + '"></td> \n ' +
    '"><input type="hidden" name="id_act[]" 	value="' + id_act + '"></td> \n ' +
    '<td>' + formatMoney(harga,0) + '<input type="hidden" name="price[]" value="' + harga + '"></td> \n ' +
    '<td>' + qty + '<input type="hidden" name="qty[]" value="' + qty + '"></td> \n ' +
    '<td>' + group + '<input type="hidden" name="group[]" value="' + group + '"><input type="hidden" name="id_group[]" 	value="' + id_group + '"></td> \n ' +
    '<td>' + subgroup + '<input type="hidden" name="subgroup[]" value="' + subgroup + '"></td> \n ' +
    '<td style="text-align:center"><a href="#" onclick="javascript: delitem(\'' + rand_no +
    '\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
    '</tr>';
  $("#contdata_assesment").append(tpl_row);
	
  // --- CLEAR --------------------------
  $('#id_act').val('');
  $('#nama_tindakan').val('');
  $('#price').val(''); 
  $('#qty').val(''); 
  $('#group').val('');  
  $('#subgroup').val(''); 
 });


  $('#mnu_1').click(function(){
          document.getElementById('assesmentawal').scrollIntoView();
  });

  $('.frmsubmit').click(function(){
    $("#frm_asm_ri_dokter").submit();
  });
</script>