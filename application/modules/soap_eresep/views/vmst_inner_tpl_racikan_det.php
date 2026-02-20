	
	<h5>Detail Template Racikan : </h5>
  <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
    <div class="col-sm-12">
      
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Dokter</label>
          <div class="col-sm-8">
            <div class="ui-widget">
            	<input id="nama_dokter" name="nama_dokter" class="form-control" value="<?php echo $rs_head['nama_dokter']; ?>">
              <!-- <input id="id_dokter" name="id_dokter" class="form-control" value="<?php #echo $rs_head['id_dokter']; ?>"> -->
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Nama template racikan</label>
          <div class="col-sm-8">
          	<input id="nama_racikan" name="nama_racikan" class="form-control" value="<?php echo $rs_head['nama_racikan']; ?>">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Instruksi kemasan</label>
          <div class="col-sm-8">
          	<input id="kemasan" name="kemasan" class="form-control" value="<?php echo $rs_head['kemasan']; ?>">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Jumlah</label>
          <div class="col-sm-8">
              <input id="jumlah_tpl" name="jumlah_tpl" class="form-control" value="<?php echo $rs_head['jumlah']; ?>">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Dosis</label>
          <div class="col-sm-8">
              <input id="dosis_tpl" name="dosis_tpl" class="form-control" value="<?php echo $rs_head['dosis']; ?>">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Frekwensi</label>
          <div class="col-sm-8">
              <input id="frekwensi_tpl" name="frekwensi_tpl" class="form-control" value="<?php echo $rs_head['frekwensi']; ?>">
          </div>
        </div>
    
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Waktu</label>
          <div class="col-sm-8">
            <input id="tme_tpl" name="tme_tpl" class="form-control" value="<?php echo $rs_head['tme']; ?>">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Keterangan</label>
          <div class="col-sm-8">
            <div class="ui-widget">
              <input id="note_tpl" name="note_tpl" class="form-control" value="<?php echo $rs_head['note']; ?>">
            </div>
          </div>
        </div>
            
    </div>
  </div>
  
  <h5 style="margin-top:15px;">Item Template Racikan : </h5>
  <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
    <div class="col-sm-12">
	  	<div class="table-responsive" style="max-height:200px; border:#CCC thin solid;">
    <table class="table table-bordered table-hover table-striped table-responsive">
      <tbody>
        <tr>
          <th scope="col">Obat</th>
          <!--<th scope="col">Produk</th>-->
          <th scope="col">Jenis</th>
          <th scope="col">Jumlah</th>
          <!--<th scope="col">Dosis</th>-->
        </tr>
        <?php
				foreach($rs as $k => $v)
				{
        ?>
        <tr>
          <td><?php echo $v['name'] ?></td>
          <!--<td><?php #echo $v->produk'] ?></td>-->
          <td><?php echo $v['jenis_obat'] ?></td>
          <td><?php echo $v['qty'] ?></td>
          <!--<td><?php #echo $v['dosis'] ?></td>-->
				</tr>
        <?php
				}
        ?>
      </tbody>
    </table>
  </div>
		</div>
  </div>

	<div class="col-sm-12 text-right" style="padding-top:10px; padding-right:0;">
    <a href="#"><button type="button" class="btn btn-secondary" 
    	id="butt_hapus_tpl_racik_eresep" onClick="javascript : hapus_template_racikan_dari_master('<?php echo $rs_head['id_tpl_racikan']; ?>');">Hapus Template Racikan Ini</button></a>
  </div>