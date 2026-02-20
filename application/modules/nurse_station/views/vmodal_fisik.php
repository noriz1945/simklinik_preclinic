<form action="<?php echo $action; ?>" method="post" id="form_fisik">
  <div class="form-body">
    <div class="row p-t-20">

      <!-- Hidden fields -->
      <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>">
      <!-- Hidden fields -->

      <div class="col-md-12">
        <!-- START PEMERIKSAAN UMUM -->
        <label class="control-label">PEMERIKSAAN UMUM :</label>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Kesadaran :</label>
              <input type="text" id="kesadaran" name="kesadaran" class="form-control input-focus"
                value="<?php echo $kesadaran; ?>" placeholder="Kesadaran">
            </div>

            <div class="form-group">
              <label class="control-label">Tekanan Darah :</label>
              <input type="text" id="td" name="td" class="form-control input-focus" value="<?php echo $td; ?>"
                placeholder="Tekanan Darah">
            </div>

            <div class="form-group">
              <label class="control-label">Nadi :</label>
              <input type="text" id="nadi" name="nadi" class="form-control input-focus" value="<?php echo $nadi; ?>"
                placeholder="Nadi">
            </div>

            <div class="form-group">
              <label class="control-label">Alergi :</label>
              <input type="text" id="alergi" name="alergi" class="form-control input-focus"
                value="<?php echo $alergi; ?>" placeholder="Alergi">
            </div>


            <div class="form-group">
              <label class="control-label">Gula :</label>
              <input type="text" id="gula" name="gula" class="form-control input-focus" value="<?php echo $gula; ?>"
                placeholder="Gula">
            </div>

            <div class="form-group">
              <label class="control-label">Keluhan Pasien:</label>
              <input type="text" id="keluhan" name="keluhan" class="form-control input-focus" value="<?php echo $gula; ?>"
                placeholder="Keluhan Pasien">
            </div>
          </div>
          <!--/span-->
          <div class="col-md-6">


            <div class="form-group">
              <label class="control-label">Pernafasan :</label>
              <input type="text" id="nafas" name="nafas" class="form-control input-focus" value="<?php echo $nafas; ?>"
                placeholder="Pernafasan">
            </div>

            <div class="form-group">
              <label class="control-label">Suhu :</label>
              <input type="text" id="suhu" name="suhu" class="form-control input-focus" value="<?php echo $suhu; ?>"
                placeholder="Suhu">
            </div>

            <div class="form-group">
              <label class="control-label">Tinggi Badan :</label>
              <input type="text" id="tinggi" name="tinggi" class="form-control input-focus"
                value="<?php echo $tinggi; ?>" placeholder="Tinggi Badan">
            </div>

            <div class="form-group">
              <label class="control-label">Berat Badan :</label>
              <input type="text" id="berat" name="berat" class="form-control input-focus" value="<?php echo $berat; ?>"
                placeholder="Berat Badan">
            </div>

            <div class="form-group">
              <label class="control-label">Lingkar Kepala :</label>
              <input type="text" id="lingkar_kepala" name="lingkar_kepala" class="form-control input-focus" value="<?php echo $berat; ?>"
                placeholder="Lingkar Kepala">
            </div>
          </div>
        </div>
      </div><!-- END PEMERIKSAAN UMUM -->
      <input type="hidden" class="form-control input-default" id="created" name="created">
      <input type="hidden" class="form-control input-default" id="creator" name="creator">
      <input type="hidden" class="form-control input-default" id="updated" name="updated">
      <input type="hidden" class="form-control input-default" id="updator" name="updator">



      <div class="modal-footer">
        <div class="form-actions">
          <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
        </div>
      </div>

    </div>
  </div>
</form>
