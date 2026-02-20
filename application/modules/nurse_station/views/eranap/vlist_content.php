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
  <!-- Start Page Content -->
  <div class="row">
    <div class="col-md-12">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'erm_ranap/pasien_igd_list/'.$id_reg; ?>">
            <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"><input type="image"
                id="image" alt="Login" src="<?php echo base_url('assets/img/back1.png'); ?>"
                style="max-height:36px;">
            </span>
          </a>
        </li>

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

        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#menutab_4" role="tab" id="resume_medis_id">
            <span class="hidden-sm-up"><i class="ti-email"></i></span>
            <span class="hidden-xs-down">Tool Keperawatan</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#menutab_5" role="tab" id="riwayat_kunjungan_id">
            <span class="hidden-sm-up"><i class="ti-email"></i></span>
            <span class="hidden-xs-down">Riwayat Kunjungan</span>
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

      </div>

    </div>
  </div><!-- row -->
</div>


<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>
$('#id_asm_awal_ranap').click(function(e) {
  inner_loader('<?php echo base_url('nurse_station/eranap/asm_ranap/'.$id_reg) ?>', '#box_asm_awal_ranap', true, '');
});

$('#id_cppt_ranap').click(function(e) {
  inner_loader('<?php echo base_url('nurse_station/eranap/cppt_ranap/'.$id_reg) ?>', '#box_cppt_ranap', true, '');
});

$('#id_cppt_viewer').click(function(e) {
  inner_loader('<?php echo base_url('nurse_station/eranap/cppt_viewer/'.$id_reg) ?>', '#box_cppt_viewer', true, '');
});

</script>

</body>

</html>
