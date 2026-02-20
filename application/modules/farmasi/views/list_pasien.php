<!DOCTYPE html>
<html lang="en">
    <head> <?php $this->theme->head('theme_default'); ?> <?php require_once(APPPATH.'../assets/app_hn/farmasifnc/mnu-cmp-css.php');?> <title>FARMASI</title>
    </head>
    <body> <?php $this->theme->wrapper_open('theme_default'); ?> <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="page-header card">
                                <div class="row align-items-end">
                                    <div class="col-lg-8">
                                        <div class="page-header-title">
                                            <i class="feather icon-feather bg-c-blue"></i>
                                            <div class="d-inline">
                                                <h5>Penjualan resep dokter</h5>
                                                <span>klik row nomor registrasi untuk proses obat pasien</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="page-header-breadcrumb">
                                            <ul class=" breadcrumb breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url('./'); ?>">
                                                        <i class="feather icon-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url('farmasi/'); ?>">FARMASI </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <div class="page-body">
                                            <!--search pasien-->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Pencarian Pasien</h5>
                                                        </div>
                                                        <div class="card-block tab-icon">
                                                            <div class="card table-card">
                                                                <div class="card-block p-b-0">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover m-b-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>No Reg</th>
																					<th>No Resep</th>
                                                                                    <th>Tgl Reg</th>
                                                                                    <th>NO. Rm</th>
                                                                                    <th>Tgl Lahir</th>
                                                                                    <th>Nama</th>
                                                                                    <th>Asuransi</th>
                                                                                    <th>Nama Dokter</th>
                                                                                    <th>Total</th>
                                                                                    <th>Status</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody> <?php $no_1 =1; $arr_reg_aps = array('','APS'); foreach($datapasien as $v_2){  ?> <tr class="clickable" data-toggle="collapse" id="
																					<?php echo $v_2->id_reg; ?>" data-target=".<?php echo $v_2->id_reg; ?>collapsed">
                                                                                    <td> <?php echo $no_1++; ?> </td>
                                                                                    <td style="color:black;font-weight: 900;"><a href="<?php echo base_url('farmasi/rm/'.$v_2->id_eresep); ?>"> <?php echo $v_2->id_reg; ?> </a></td>
                                                                                    <td> <?php echo $v_2->id_eresep; ?> </td>
																					<td> <?php echo $v_2->regdate; ?> </td>
                                                                                    <td> <?php echo $v_2->id_pasien; ?> </td>
                                                                                    <td> <?php $date=date_create($v_2->birthdate); echo date_format($date,"d m Y"); ?> </td>
                                                                                    <td> <?php echo $v_2->nama_pasien; ?> </td>
                                                                                    <td> <?php echo $v_2->asuransi; ?> </td>
                                                                                    <td> <?php echo $v_2->nama_dokter; ?> </td>
                                                                                    <td> <?php echo number_format($v_2->total_tagihan,0); ?> </td> <?php if ($v_2->id_inv ==null) { $isbayartxt='Invoice : Belum Bayar'; $isbayarlbl="label label-danger";}else{ $isbayartxt='Invoice :Sudah Bayar'; $isbayarlbl="label label-success";} ?> <td>
                                                                                        <label class="<?php echo $isbayarlbl; ?>"> <?php echo $isbayartxt; ?> </label>
                                                                                    </td>
                                                                                </tr> <?php } ?> </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end search pasien-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="styleSelector"></div>
                    </div>
                </div>
            </div>
        </div>
    </body> <?php $this->theme->wrapper_close('theme_default'); ?> <?php $this->theme->script('theme_default'); ?> <?php require_once(APPPATH.'../assets/app_hn/farmasifnc/mnu-cmp-js.php');?> <script src=<?php echo base_url('assets/app_hn/farmasifnc/fncfarmasi.js'); ?>>
    </script>