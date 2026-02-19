

<?php $this->theme->head('theme_default'); ?>
<title>Zia Aesthetic</title>

<?php //$this->theme->wrapper_open('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/dshomecafe/dshome-cmp-css.php');?>
<link rel="stylesheet" href="<?php echo base_url('assets/app_hn/dshomecafe/cafecss/fontawesome/css/all.min.css'); ?>"> <!-- https://fontawesome.com/ -->
<link rel="stylesheet" href="<?php echo base_url('assets/app_hn/dshomecafe/cafecss/css/tooplate-wave-cafe.css'); ?>">
<body>
  <div class="tm-container">
    <div class="tm-row">
      <!-- Site Header -->
      <div class="tm-left">
        <div class="tm-left-inner">
          <!--<div class="tm-site-header">
            <i class="fas fa-coffee fa-3x tm-site-logo"></i>
            <h1 class="tm-site-name">ZIA Cafe</h1>
          </div>-->
          <nav class="tm-site-nav">
            <ul class="tm-site-nav-ul">
            <li class="tm-page-nav-item">
                <a href="#contact" class="tm-page-link active">
                  <i class="fas fa-users tm-page-link-icon"></i>
                  <span>List</span>
                </a>
              </li>
              <li class="tm-page-nav-item">
                <a href="#drink" class="tm-page-link" id="klik_drink">
                  <i class="fas fa-mug-hot tm-page-link-icon"></i>
                  <span>Minuman</span>
                </a>
              </li>
              <li class="tm-page-nav-item">
                <a href="#food" class="tm-page-link" id="klik_food">
                  <i class="fas fa-pepper-hot tm-page-link-icon"></i>
                  <span>Makanan</span>
                </a>
              </li>
            </ul>
          </nav>

          <!--rincian pemesanan-->
          <hr>
          <div class="row">
          <div class="col-xl-12 col-md-12">
          <div class="card table-card">
          <div class="card-header">
          <h5 class="datapembelikopi">-----//-----</h5>
          </div>
          <div class="card-block">
          <div class="table-responsive">
          <form method="POST" id="formsavepembelikopi">
          <input type="hidden" id="reg_pas" name="reg_pas" readonly>
          <input type="hidden" id="nama_pas" name="nama_pas" readonly>
          <table class="table table-hover m-b-0">
          <thead>
          <tr>
          <th>Produk</th>
          <th>&nbsp;</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
          <th><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></th>
          </tr>
          </thead>
          <tbody class="setaddrow"></tbody>
          </table>
          <button type="button" class="btn btn-success" id="simpanpesanan">Simpan</button>
          </form>
          </div>
          </div>
          </div>
          </div>
          </div>
          <!--end rincian pemesanan-->
          
        </div>        
      </div>
      <div class="tm-right">
        <main class="tm-main">
          <!-- Contact Page -->
          <div id="contact" class="tm-page-content">
            <!--search pasien-->
            <div class="row">
            <div class="col-sm-12">
            <div class="card">
            <div class="card-header">
            <h5>Pencarian</h5>
            </div>
            <div class="card-block">
            <div class="row">
            <div class="col-sm-12 col-xl-4 m-b-30">
            <input type="text" class="form-control" id="search_nama_pasien" name="search_nama_pasien" placeholder="Nama">
            </div>
            <!--<div class="col-sm-12 col-xl-2 m-b-30">
            <input type="text" class="form-control" id="tgl_reg_st" name="tgl_reg_st" placeholder="Tanggal Registrasi 1">
            </div>
            <div class="col-sm-12 col-xl-2 m-b-30">
            <input type="text" class="form-control" id="tgl_reg_ed" name="tgl_reg_ed" placeholder="Tanggal Registrasi 2">
            </div>
            <div class="col-sm-12 col-xl-2 m-b-30">
            <select name="id_asuransi_set" id="id_asuransi_set" class="form-control form-control-info selmst_asuransi"></select>
            </div>
            <div class="col-sm-12 col-xl-2 m-b-30">
            <select name="id_dokter_set" id="id_dokter_set" class="form-control form-control-warning selmst_dokter"></select>
            </div>-->
            <div class="col-sm-12 col-xl-1 m-b-30">
            <button class="btn btn-success set_data" id="set_data"><i class="fa fa-plus"></i> Proses</button>
            <br>
            </div>
            <!--<div class="col-sm-12 col-xl-1 m-b-30">
            <button class="btn btn-warning" id="cari_data"><i class="fa fa-refresh"></i> Refresh</button>
            </div>-->
            </div>

            <div class="row">
            <div class="col-sm-12 col-xl-3 m-b-30">
            <button class="btn btn-success cari_data" id="cari_data"><i class="fa fa-search"></i> List Pasien</button>
            </div>
            <div class="col-sm-12 col-xl-3 m-b-30">
            <button class="btn btn-warning cari_data_pembayaran" id="cari_data_pembayaran"><i class="fa fa-search"></i> List Pembayaran</button>
            </div>
            </div>

            </div>
            <div class="card-block tab-icon">
            <div id="datalistrpo"></div>
            </div>
            </div>
            </div>
            </div>
            <!--end search pasien-->
          </div> 
          <!-- end Contact Page -->

          <div id="drink" class="tm-page-content">
          <div class="setmenu_header"></div>
          <div class="setmenudrink"></div>
          </div>

          <!-- Makanan -->
          <div id="food" class="tm-page-content">
          <div class="setmenu_header_food"></div>
          <div class="setmenufood"></div>
          </div>
          <!-- end Makanan -->

        </main>
      </div>    
    </div>
  </div>


</body>

<!--End section from wrapper_open-->
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/dshomecafe/dshome-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/dshomecafe/dshome.js'); ?>></script>