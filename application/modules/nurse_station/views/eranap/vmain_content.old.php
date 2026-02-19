<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default');?>

  <style>
  .thead_table {
    background-color: #85c440;
    font-weight: bold;
    color: black;
  }

  .cf {
    padding: 0 10px 10px;
  }
  </style>

</head>

<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>


<?php echo $header; ?>

<div class="container-fluid  cf bg-white">
  <div class="row">
    <div class="col-md-12">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'erm_ranap/pasien_igd_list/'; ?>">
            <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"><input type="image"
                id="image" alt="Login" src="<?php echo base_url('assets/img/back1.png'); ?>"
                style="max-height:36px;">
            </span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#planning" role="tab">
          <span class="hidden-sm-up"><i class="ti-email"></i></span>
          <span class="hidden-xs-down">E-RANAP</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#box_riwayat_kunjungan_ranap" role="tab" id="riwayat_kunjungan_id">
            <span class="hidden-sm-up"><i class="ti-email"></i></span>
            <span class="hidden-xs-down">Riwayat Kunjungan</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#box_riwayat_hasil_lab" role="tab" id="a_riwayat_hasil_lab">
            <span class="hidden-sm-up"><i class="ti-email"></i></span><span class="hidden-xs-down">Hasil
              Laboratorium</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#box_riwayat_hasil_rad" role="tab" id="a_riwayat_hasil_rad">
            <span class="hidden-sm-up"><i class="ti-email"></i></span><span class="hidden-xs-down">Hasil
              Radiologi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#box_riwayat_resep" role="tab" id="a_riwayat_resep">
            <span class="hidden-sm-up"><i class="ti-email"></i></span><span class="hidden-xs-down">Riwayat Resep</span>
          </a>
        </li>

      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabcontent-border">
        <!-- Tab panes -->
        <div class="tab-content tabcontent-border">
          <!-- Tab panes -->
          <div class="tab-pane p-5" id="planning" role="tabpanel">
            <ul class="nav nav-tabs customtab2" role="tablist">
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#box_asm_awal_ranap" role="tab" id="id_asm_awal_ranap">
                  <span class="hidden-sm-up"><i class="ti-email"></i></span>
                  <span class="hidden-xs-down">Assesment Awal</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#box_cppt_ranap" role="tab" id="id_cppt_ranap">
                  <span class="hidden-sm-up"><i class="ti-email"></i></span>
                  <span class="hidden-xs-down">CPPT</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#box_cppt_viewer" role="tab" id="id_cppt_viewer">
                  <span class="hidden-sm-up"><i class="ti-email"></i></span>
                  <span class="hidden-xs-down">CPPT Viewer</span>
                </a>
              </li>

             <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#box_tool_keperawatan" role="tab">
                  <span class="hidden-sm-up"><i class="ti-email"></i></span>
                  <span class="hidden-xs-down">Tool Keperawatan</span>
                </a>
              </li> -->

              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#box_kurva_klinis" role="tab" id="id_kurva_klinis">
                  <span class="hidden-sm-up"><i class="ti-email"></i></span>
                  <span class="hidden-xs-down">Kurva Klinis</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#box_serah_terima" role="tab" id="id_serah_terima">
                  <span class="hidden-sm-up"><i class="ti-email"></i></span>
                  <span class="hidden-xs-down">Serah Terima</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#box_caper" role="tab" id="id_caper">
                  <span class="hidden-sm-up"><i class="ti-email"></i></span>
                  <span class="hidden-xs-down">CAPER</span>
                </a>
              </li>

            </ul>
            <!-- Tab panes -->




            <div class="tab-content">

              <div class="tab-pane p-20" id="box_asm_awal_ranap" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="box_cppt_ranap" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="box_cppt_viewer" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="box_surat_sakit" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="box_konsul" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="box_kurva_klinis" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="box_serah_terima" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="box_caper" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

            </div>

          </div>

          <div class="tab-pane p-20" id="box_riwayat_hasil_rad" role="tabpanel">
            <div class="col-sm-12 text-center">
              <h5>Loading page content, please wait...</h5>
              <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
            </div>
          </div>

          <div class="tab-pane p-20" id="box_riwayat_kunjungan_ranap" role="tabpanel">
            <div class="col-sm-12 text-center">
              <h5>Loading page content, please wait...</h5>
              <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
            </div>
          </div>

          <div class="tab-pane p-20" id="box_riwayat_hasil_lab" role="tabpanel">
            <div class="col-sm-12 text-center">
              <h5>Loading page content, please wait...</h5>
              <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
            </div>
          </div>

          <div class="tab-pane p-20" id="box_riwayat_resep" role="tabpanel">
            <div class="col-sm-12 text-center">
              <h5>Loading page content, please wait...</h5>
              <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div><!-- row -->

</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>

$('#riwayat_kunjungan_id').click(function(e) {
  inner_loader('<?php echo base_url('history_pasien/history_pasien_list/'.$id_pasien) ?>', '#box_riwayat_kunjungan_ranap', true, '');
});

$('#a_riwayat_hasil_rad').click(function(e) {
  inner_loader('<?php echo base_url('hasil_rad/riwayat_hasil_rad/' . $id_reg) ?>', '#box_riwayat_hasil_rad', true,
    '');
});

$('#a_riwayat_hasil_lab').click(function(e) {
  inner_loader('<?php echo base_url('hasil_lab/riwayat_hasil_lab/' . $id_reg) ?>', '#box_riwayat_hasil_lab', true,
    '');
});

$('#a_riwayat_resep').click(function(e) {
  inner_loader('<?php echo base_url('soap_eresep/riwayat_resep/' . $id_reg) ?>', '#box_riwayat_resep', true, '');
});

$('#id_asm_awal_ranap').click(function(e) {
  inner_loader('<?php echo base_url('nurse_station/eranap/asm_ranap/'.$id_reg) ?>', '#box_asm_awal_ranap', true, '');
});

$('#id_cppt_ranap').click(function(e) {
  inner_loader('<?php echo base_url('nurse_station/eranap/cppt_ranap/'.$id_reg) ?>', '#box_cppt_ranap', true, '');
});

$('#id_cppt_viewer').click(function(e) {
  inner_loader('<?php echo base_url('nurse_station/eranap/cppt_viewer/'.$id_reg) ?>', '#box_cppt_viewer', true, '');
});

$('#id_history_pasien').click(function(e) {
  inner_loader('<?php echo base_url('history_pasien/history_pasien_list/'.$id_pasien) ?>', '#box_history_pasien', true, '');
});

$('#id_kurva_klinis').click(function(e) {
  inner_loader('<?php echo base_url('ranap_cat_klinis/report_rmemr/index_rmemr/'.$id_reg) ?>', '#box_kurva_klinis', true, '');
});

$('#id_serah_terima').click(function(e) {
  inner_loader('<?php echo base_url('serah_terima/serah_terima/indexserahterima/'.$id_reg) ?>', '#box_serah_terima', true, '');
});

$('#id_caper').click(function(e) {
  inner_loader('<?php echo base_url('ranap_catatan_perawat/catatan_perawat/indexcatatanperawat/'.$id_reg) ?>', '#box_caper', true, '');
});

</script>

</body>

</html>
