
<input type="text" id="idregset" name="idregset" value="<?php echo $id_reg; ?>" readonly hidden> 
<input type="text" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" readonly hidden>

<div class="card" id="assesmentawal">
<div class="card-header">
<h5>CPPT</h5>
</div>
<div class="card-block">
<div class="container-fluid">
<form id="frm_cppt_ri_dokter" method="post" action="<?php echo base_url('soap/act_cppt/'.$id_reg.'/'.$id_pasien); ?>">
  <input type="hidden" id="id_asmri" name="id_asmri">
  <input type="hidden" id="sql_command" name="sql_command">
  <input type="hidden" id="kategori" name="kategori" value="CPPT">
  <div class="row pnl">
    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Tanggal Masuk :</label>
        </div>
        <div class="col-sm-9">
          <label class="control-label">-</label>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Asal Masuk :</label>
        </div>
        <div class="col-sm-3">
          <input type="radio" name="asal_masuk" value="IGD" /> IGD
        </div>
        <div class="col-sm-5">
          <input type="radio" name="asal_masuk" value="Rawat Jalan" /> RAWAT JALAN
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Pengkajian :</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="tgl_pengkajian" id="tgl_pengkajian" class="form-control tanggalcppt">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Cara Masuk :</label>
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="JALAN" /> JALAN
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="KURSI RODA" /> KURSI RODA
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="BRANKAR" /> BRANKAR
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
          placeholder="Keluhan Utama"></textarea>
      </div>
    </div>

  </div>
  <br>

	<h3 class="pnl-head-3">OBJECTIVE</h3>
  <div class="row pnl pnl-obj">
  <!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>OBJECTIVE</strong></label>
        <hr>
      </div>
    </div>
	-->

    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="objective" name="objective" rows="5"
          placeholder="Objective"></textarea>
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

    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label">Utama :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_ten[0]" name="name_icd_ten[0]" class="form-control">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_ten[0]" name="id_icd_ten[0]" class="form-control">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_ten[0]" name="old_id_icd_ten[0]" class="form-control" readonly>
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

    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label">Utama :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_nine[0]" name="name_icd_nine[0]" class="form-control">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_nine[0]" name="id_icd_nine[0]" class="form-control">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_nine[0]" name="old_id_icd_nine[0]" class="form-control" readonly>
      </div>
    </div>

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
            <input id="nama_tindakan_cppt" name="nama_tindakan_cppt" class="form-control">
            <input type="hidden" id="id_act_cppt" name="id_act_cppt" class="hidden" readonly>
          </div>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Harga</label>
        <div class="col-sm-8">
          <input id="price_cppt" name="price_cppt" class="form-control autonumber fill" data-reverse>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Qty</label>
        <div class="col-sm-8">
          <input id="qty_cppt" name="qty_cppt" class="form-control autonumber fill" data-reverse>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Grup</label>
        <div class="col-sm-8">
          <input id="group_cppt" name="group_cppt" class="form-control" readonly>
          <input type="hidden" id="id_group_cppt" name="id_group_cppt" class="hidden" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Sub Grup</label>
        <div class="col-sm-8">
          <input id="subgroup_cppt" name="subgroup_cppt" class="form-control" readonly>
        </div>
      </div>
      
    <div class="form-group row" style="margin-top:10px;">
        <div class="col-sm-6 text-left">

      </div>
      <div class="col-sm-6 text-right">
        <button type="button" class="btn btn-primary" id="addrow_cppt"><i class="fa fa-plus"></i></button>
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
    <tbody id="contdata_cppt"></tbody>
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
          placeholder="Instruksi"></textarea>
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
      <div class="form-group" id="box_new_eresep_add">
        <div class="col-sm-12 text-center">
          <h5>Loading page content, please wait...</h5>
          <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
        </div>
      </div>

    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_lab">
      <div class="form-group">
        <h4>LABORATORIUM</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_lab" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rad">
      <div class="form-group">
        <h4>RADIOLOGI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rad" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rehab">
      <div class="form-group">
        <h4>REHAB MEDIK</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rehab" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_op">
      <div class="form-group">
        <h4>OPERASI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_op" style="background-color:white;">
    </div>


  </div>

  <div class="col-md-12 text-center" style="margin-top:30px;">
    	<button type="submit" class="btn btn-success" style="font-size:22px"> <i class="fa fa-check"></i> S I M P A N </button>
  </div>
	</form>
</div>
</div>


