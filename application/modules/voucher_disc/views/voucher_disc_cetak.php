
<!doctype html>
<html>
    <head> <?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
    <style>
        body{
           
        }
        body[themebg-pattern="theme1"] {
            background-image: none;
        }
        .pcoded-inner-content {
            padding: 0px;
        }
        .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
            padding: 5px;
        }
        .pcoded-main-container {
            display: block;
            position: relative;
            background: #FFF;
            min-height: calc(100vh - 70px);
        }
        .my-bg{
            background-image : url("<?php echo base_url('assets/img/bg-vcr-disc.jpg') ?>");
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding : 8px 10px 10px 10px;
        }
        .card .card-header {
            padding: 0;
        }
        .header-kiri{
            padding : 10px 0 0 20px;
        }
        .header-tengah{
            padding : 0px 0 0 10px;
        }
        .header-kanan{
            padding : 15px 20px 0 0;
        }
        .card {
            margin-bottom: 10px;
        }
        .card .card-block {
            padding: 0px 0 0 10px;
            /* min-height : 100px; */
        }
        .footer-kanan{
            /*
            padding : 0 25px 15px 0;
            bottom : 0;
            right : 0;
            position: absolute;
            */
            font-size : 9px;
        }
        .items{
            padding-left : 0px;
             font-size : 9px;
        }
        ul.bullet {
          list-style-type: square;
          list-style-position: inside;
        }
        .qrcode{
            padding-right : 15px;
        }
    @media print {
        body{
           
        }
        body[themebg-pattern="theme1"] {
            background-image: none;
        }
        .pcoded-inner-content {
            padding: 0px;
        }
        .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
            padding: 5px;
        }
        .pcoded-main-container {
            display: block;
            position: relative;
            background: #FFF;
            min-height: calc(100vh - 70px);
        }
        .my-bg{
            background-image : url("<?php echo base_url('assets/img/bg-vcr-disc.jpg') ?>");
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding : 8px 10px 10px 10px;
        }
        .card .card-header {
            padding: 0;
        }
        .header-kiri{
            padding : 10px 0 0 20px;
        }
        .header-tengah{
            padding : 0px 0 0 10px;
        }
        .header-kanan{
            padding : 15px 20px 0 0;
        }
        .card {
            margin-bottom: 10px;
        }
        .card .card-block {
            padding: 0px 0 0 10px;
            /* min-height : 100px; */
        }
        .footer-kanan{
            /*
            padding : 0 25px 15px 0;
            bottom : 0;
            right : 0;
            position: absolute;
            */
            font-size : 9px;
        }
        .items{
            padding-left : 0px;
             font-size : 9px;
        }
        ul.bullet {
          list-style-type: square;
          list-style-position: inside;
        }
        .qrcode{
            padding-right : 15px;
        }
    }
    </style>
    </head>
    <?php #$this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
	<div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <!--
                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title"><i class="feather icon-book bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Page Title</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Trx_reg/'); ?>">List Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                    <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="row">
                                            <?php 
                                            foreach($data_trx_vcr as $k => $v)
                                            {
                                            ?>
                                            <div class="col-md-6">
                                                
                                                <div class="card my-bg">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center text-white header-tengah">
                                                                <h7 class="text-white">ZIA AESTHETIC CLINIC</h7>
                                                            </div>
                                                         </div>   
                                                         
                                                        <div class="row">
                                                            <div class="col-md-6 text-left header-kiri">
                                                                <h7>VOUCHER DISKON</h7>
                                                            </div>
                                                            <div class="col-md-6 text-right header-kanan">
                                                                <h9><?php echo $v->kode_vcr ?></h9>
                                                            </div>
                                                        </div>
                                                            
                                                        
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <h8>Item : </h8>
                                                                <ul class="bullet">
                                                                <?php 
                                                                foreach($v->items as $kk => $vv)
                                                                {
                                                                ?>
                                                                    <li class="card-text items"><?php echo $vv->txt_id_act_fa ?> >>> <?php echo round($vv->disc_p) ?> %</li>
                                                                <?php 
                                                                } 
                                                                ?>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3 text-right qrcode">
                                                                <?php echo $v->qrcode_vcr ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p class="card-text text-center footer-kanan">Berlaku sampai dengan <?php echo $v->end ?></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <a href="https://wa.me//?text=<?php echo urlencode('Link Kode Voucher ZIA AESTHETIC : 
'.base_url('voucher_disc/cetak_vcr_single/'.base64_encode($v->id_tvd))) ?>" target="_blank">Kirim ke Whatsapp</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <?php 
                                            } 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
                    
<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
