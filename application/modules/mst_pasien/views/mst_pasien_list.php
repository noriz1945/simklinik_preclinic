
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<title>Fast Clinic - Bina Medika</title>
	<style>
	/*
	.bg-success {
		background: #00ced1 !important;;;
	}
	*/
	</style>
    </head>
	<?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
	<div class="loader-bg">
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
                                    <div class="page-header-title"><i class="feather icon-book bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Pasien</h5><span>No. Rekam Medis</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('mst_pasien/'); ?>">List Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        <div class="" style="">
                                                            <div class="col-md-12 box-shadow--16dp">
                                                                <div class="card-header">
																	<h5>Mst_pasien</h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		<div class="col-md-4"> 
																		<!-- <?php #echo anchor(site_url('mst_pasien/create'),'<i class="fa fa-plus"></i> Tambah Data', 'btn btn-success waves-effect"'); ?>  -->
																		<!-- <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i>Jenis Tindakan</button> -->
																		<?php echo anchor(site_url('mst_pasien/create'),'<button type="button" class="btn btn-success waves-effect"><i class="fa fa-plus"></i> Tambah Data </button>', 'style="color:white;"'); ?> 
																		</div>
																		<div class="col-md-4 text-center">
																			<div style="margin-top: 8px" id="message">
																				<!-- Isi Mesage -->
																			</div>
																		</div>
																		<div class="col-md-1 text-right"></div>
																		<div class="col-md-3 text-right">
																			<form action="<?php echo site_url('mst_pasien/index'); ?>" class="form-inline" method="get">
																				<div class="input-group" style="width:100%;">
																					<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
																					<span class="input-group-btn">
																					<?php 
																					if ($q <> "")
																					{
																					?> 
																						<a href="<?php echo site_url('mst_pasien'); ?>" class="btn btn-default">Reset </a> 
																					<?php
																					}
																					?> 
																					<button class="btn btn-success" type="submit">Cari</button>
																					</span>
																				</div>
																			</form>
																		</div>
																	</div>
                            <div class="table-responsive">
																		<table class="table table-bordered table-hover table-striped table-responsive" style="max-height:50vh; overflow-x:scroll">
																			<thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Edit</th>
																					<th scope="col">No.RM</th>
																					<th scope="col">Nama Pasien</th>
																					<th scope="col">NIK/No.KTP</th>
																					<th scope="col">Tgl.Lahir</th>
																					<th scope="col">Usia</th>
																					<th scope="col">JK</th>
																					<th scope="col">Alamat</th>
																					<th scope="col">No.Hp</th>
																					<th scope="col">Nama Ayah</th>
																					<th scope="col">Nama Ibu</th>
																					<th scope="col">Email</th>
																					<th scope="col">Propinsi</th>
																					<th scope="col">Kota</th>
																					<th scope="col">Kecamatan</th>
																					<th scope="col">Kelurahan</th>
																					<th scope="col">Kodepos</th>
																					
																					
																					
																					<th scope="col">Catatan</th>
																					
																					<th scope="col">Aktif</th>
																					
																					
																				</tr>
																			</thead>
																			<tbody>
<?php
$arr_gender = array('', 'Laki-laki', 'Perempuan');
$arr_aktif = array('Non-Aktif','Aktif');
$arr_aktif_bgcolor = array('style="background-color:#CCC;"','');

// Mapping bulan singkatan Indonesia
$bulan_id = array(
    'Jan' => 'Jan',
    'Feb' => 'Feb',
    'Mar' => 'Mar',
    'Apr' => 'Apr',
    'May' => 'Mei',
    'Jun' => 'Jun',
    'Jul' => 'Jul',
    'Aug' => 'Agu',
    'Sep' => 'Sep',
    'Oct' => 'Okt',
    'Nov' => 'Nov',
    'Dec' => 'Des'
);

// Penomoran baris
$no = isset($start) ? (int)$start : 0;

foreach ($mst_pasien_data as $mst_pasien)
{
    // Default jika tidak ada tanggal lahir
    $usia = '<span style="color:#888;font-style:italic;">Belum di isi</span>';
    $tgl_lahir_display = '<span style="color:#888;font-style:italic;">Belum di isi</span>';
    $tgl_lahir_raw = trim($mst_pasien->birthdate);

    if (
        !empty($tgl_lahir_raw) &&
        strtolower($tgl_lahir_raw) !== 'null' &&
        $tgl_lahir_raw !== '0' &&
        $tgl_lahir_raw !== '0000-00-00 00:00:00' &&
        strtotime($tgl_lahir_raw) !== false
    ) {
        $tgl_obj = new DateTime($tgl_lahir_raw);

        // Format dd/MM/YY dengan singkatan bulan Indonesia
        $bln_eng = $tgl_obj->format('M');
        $bln_id = isset($bulan_id[$bln_eng]) ? $bulan_id[$bln_eng] : $bln_eng;
        $tgl_lahir_display = $tgl_obj->format('d') . '/' . $bln_id . '/' . $tgl_obj->format('y');

        // Hitung usia detail
        $today = new DateTime();
        $diff = $today->diff($tgl_obj);

        if ($diff->y > 0) {
            $usia = $diff->y . ' tahun';
            if ($diff->m > 0) {
                $usia .= ' ' . $diff->m . ' bulan';
            }
        } elseif ($diff->m > 0) {
            $usia = $diff->m . ' bulan';
            if ($diff->d > 0) {
                $usia .= ' ' . $diff->d . ' hari';
            }
        } else {
            $usia = $diff->d . ' hari';
        }
    }

    // Cek NIK kosong/null/0
    $nik_display = '<span style="color:#888;font-style:italic;">Belum di isi</span>';
    if (
        !empty($mst_pasien->nik) &&
        strtolower($mst_pasien->nik) !== 'null' &&
        $mst_pasien->nik !== '0'
    ) {
        $nik_display = $mst_pasien->nik;
    }

    $gender_display = isset($arr_gender[$mst_pasien->gender]) ? $arr_gender[$mst_pasien->gender] : '';
    
?>
<tr <?php echo $arr_aktif_bgcolor[$mst_pasien->aktif] ?>>
    <td><?php echo ++$no; ?></td>
    <td nowrap> 
        <?php  
        echo anchor(
            site_url("mst_pasien/update/".$mst_pasien->id_pasien),
            "<img src=\"".base_url('assets/img/doc_edit.png')."\" style=\"max-height:20px;\">"
        ) . " &nbsp; ";
        ?> 
    </td>
    <td><?php echo $mst_pasien->id_pasien ?></td>
    <td><?php echo $mst_pasien->name ?></td>
    <td><?php echo $nik_display; ?></td>
    <td><?php echo $tgl_lahir_display; ?></td>
    <td><?php echo $usia; ?></td>
    <td><?php echo $gender_display; ?></td>
    <td><?php echo $mst_pasien->address ?></td>
    <td><?php echo $mst_pasien->hp ?></td>
    <td><?php echo $mst_pasien->father_name ?></td>
    <td><?php echo $mst_pasien->mother_name ?></td>
    <td><?php echo $mst_pasien->email ?></td>
    <td><?php echo $mst_pasien->propinsi ?></td>
    <td><?php echo $mst_pasien->kota ?></td>
    <td><?php echo $mst_pasien->kecamatan ?></td>
    <td><?php echo $mst_pasien->kelurahan ?></td>
    <td><?php echo $mst_pasien->kodepos ?></td>
    <td><?php echo $mst_pasien->description ?></td>
    <td><?php echo $arr_aktif[$mst_pasien->aktif] ?></td>
</tr>
<?php
}
?>





																			</tbody>
																			<tfoot>
																				<tr>
																					
																				</tr>
																			<tfoot>
																		</table>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<!-- <a href="#" class="btn btn-success">Total Data : <?php #echo $total_rows ?> </a> -->
																		</div>
																		<div class="col-md-6 text-right"> <?php #echo $pagination ?> </div>
																	</div>
																	
																</div>
															</div>
                                                        </div>
                                                        <!-- /.content -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?>
