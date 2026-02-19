<!DOCTYPE html>
<html>

<head>
    <?php $this->theme->head('theme_default'); ?>

        <style type="text/css">
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #FAFAFA;
                font: 10pt "Tahoma";
            }
            
            table {
                padding: 0;
                margin: 0;
                border: none;
            }
            
            .border-it {
                border: black thin solid;
            }
            
            .border-top {
                border-top: black thin solid;
            }
            
            .border-left border-right {
                border-right: black thin solid;
            }
            
            .border-bottom {
                border-bottom: black thin solid;
            }
            
            .border-left {
                border-left: black thin solid;
            }
            
            .border-left-right {
                border-left: black thin solid;
                border-right: black thin solid;
            }
            
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            
            .page {
                width: 210mm;
                min-height: 297mm;
                padding: 5mm;
                margin: 5mm auto;
                border: 1px #D3D3D3 solid;
                border-radius: 5px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            
            .subpage {
                height: 280mm;
            }
            
            @page {
                size: A4;
                margin: 0;
            }
            
            @media print {
                html,
                body {
                    width: 210mm;
                    height: 297mm;
                }
                .page {
                    margin: 0;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
                }
            }
        </style>
</head>

<body onload="window.print()">
    <div class="container-fluid page">
        <div class="subpage">
            <div class="row">
                <div class="col-sm-1">
                    <span><img src="<?php echo base_url('assets/img/logo_sariasih.png'); ?>" alt="homepage" class="dark-logo" width="70px" /></span>

                </div>

                <div class="col-sm-6">
                    <label class="col-sm-12 col-form-label">
                        <?php echo $nama_rs; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $alamat_rs; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">Telp :
                        <?php echo $telp_rs; ?> / Fax :
                            <?php echo $fax_rs; ?>
                    </label>
                </div>

                <div class="col-sm-5 text-right">
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['id_pasien']; ?> /
                            <?php echo $pasien['id_reg']; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['nama_pasien']; ?> (
                            <?php echo $pasien['gender2']; ?>)</label>
                    <label class="col-sm-12 col-form-label">
                            <?php echo $pasien['pid_num']; ?></label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['tgl_lahir']; ?> (
                            <?php echo $pasien['umur1']; ?>Thn)</label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['dokter']; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['poli_ruangan']; ?>
                    </label>
                </div>

            </div>
            <h4>RINGKASAN PASIEN PULANG</h4>
            <div class="row p-t-20">
                <!-- Hidden fields -->
                <input type="hidden" class="form-control input-default" id="id_asm" name="id_asm">
                <input type="hidden" class="form-control input-default" id="id_pasien" name="id_pasien" value="00000903">
                <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="0119SA000983">
                <input type="hidden" class="form-control input-default" id="id_dokter" name="id_dokter" value="570">
                <input type="hidden" class="form-control input-default" id="id_type" name="id_type" value="1">
                <input type="hidden" class="form-control input-default" id="sign" name="sign" value="xxx">

                <input type="hidden" class="form-control input-default" id="created" name="created" value="xxx">
                <input type="hidden" class="form-control input-default" id="creator" name="creator" value="xxx">
                <input type="hidden" class="form-control input-default" id="updated" name="updated" value="xxx">
                <input type="hidden" class="form-control input-default" id="updator" name="updator" value="xxx">
                <!-- Hidden fields -->
                <?php 
                $tgl_masuk=$data_resmed['regdate']; 
                $tgl_pulang=$data_resmed['tgl_keluar']; 
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Tanggal Masuk :</label>
                        </br>
                        <label class="control-label">&#9998; :                            
                            <?php echo tgl_indonesia($data_resmed['regdate'])?>
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Tanggal Keluar :</label>
                        </br>
                        <label class="control-label">&#9998; :
                            <?php echo tgl_indonesia($data_resmed['tgl_keluar'])?>
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Indikasi Rawat Inap :</label>
                        </br>
                        <label class="control-label">&#9998; :
                            <?php echo $data_resmed['keluhan_utama']; ?>
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Ringkasan Riwayat Penyakit Sekarang :</label>
                        </br>
                        <label class="control-label">&#9998; : <?php echo $data_resmed['riwayat_sakit_dulu']; ?> </label>
                    </div>
                </div>
                <!--/span-->


                    <label class="control-label"><b>PEMERIKSAAN FISIK :</b></label>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Keadaan Umum :</label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php echo $data_resmed['keadaan_umum']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="col-sm-12 col-form-label">&#9998; Kesadaran:
                                <?php echo $data_resmed['kesadaran']; ?>
                            </label>
                            <label class="col-sm-12 col-form-label">&#9998; TD:
                                <?php echo $data_resmed['td']; ?>
                            </label>
                            <label class="col-sm-12 col-form-label">&#9998; Nadi:
                                <?php echo $data_resmed['nadi']; ?>
                            </label>
                            <!--
                            <label class="col-sm-12 col-form-label">&#9998; Gula:
                                <?php #echo $data_resmed['gula']; ?>
                            </label>
                            -->
                            <label class="col-sm-12 col-form-label">&#9998; Alergi:
                                <?php #echo $data_resmed['obj_alergi']; ?>
                            </label>
                        </div>

                        <div class="col-sm-6">
                            <label class="col-sm-12 col-form-label">&#9998; Tinggi:
                                <?php echo $data_resmed['tinggi']; ?>
                            </label>
                            <label class="col-sm-12 col-form-label">&#9998; Berat:
                                <?php echo $data_resmed['berat']; ?>
                            </label>
                            <label class="col-sm-12 col-form-label">&#9998; Suhu:
                                <?php echo $data_resmed['suhu']; ?>
                            </label>
                            <label class="col-sm-12 col-form-label">&#9998; Pernafasan:
                                <?php echo $data_resmed['nafas']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Pemeriksaan Penunjang / Diagnostik terpenting :</label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php echo $data_resmed['pemeriksaan_penunjang']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Terapi / Pengobatan Selama di Rumah Sakit :</label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php echo $data_resmed['riwayat_pengobatan']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Hasil Konsultasi :</label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php echo $data_resmed['hasil_konsultasi']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Diagnosis ICD10 :</label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php 
																	foreach($data_resmed['diag_medis_banding_text'] as $k => $v)
																	{
																		
																		echo "<br>" . $v;
																	}
																?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tindakan / prosedur (ICD 9cm):</label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php 
																	foreach($data_resmed['planning_text'] as $k => $v)
																	{
																		
																		echo "<br>" . $v;
																	}
																?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Alergi : </label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php echo $data_resmed['riwayat_alergi']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Hasil Laboratorium belum selesai : </label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php 
																	foreach($rs_lab_pending as $k => $v)
																	{
																?>
																		<ul>
                                    	<li>
                                    				<?php echo "-. " . $v['tindakan'] . "<br>" ;?>
                                    	</li>
                                    </ul>
                                <?php
																	}
																?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Diet : </label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php echo $data_resmed['diet']; ?>
                            </label>
                        </div>
                    </div>

                   

                    <div class="col-md-12">

                    </div>

            </div>
            <!-- END STATUS PSIKOLOGI -->
        </div>
    </div>


    <div class="container-fluid page">
        <div class="subpage">
            <div class="row">
                <div class="col-sm-1">
                    <span><img src="<?php echo base_url('assets/img/logo_sariasih.png'); ?>" alt="homepage" class="dark-logo" width="70px" /></span>

                </div>

                <div class="col-sm-5">
                    <label class="col-sm-12 col-form-label">
                        <?php echo $nama_rs; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $alamat_rs; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">Telp :
                        <?php echo $telp_rs; ?> / Fax :
                            <?php echo $fax_rs; ?>
                    </label>
                </div>

                <div class="col-sm-6 text-right">
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['id_pasien']; ?> /
                            <?php echo $pasien['id_reg']; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['nama_pasien']; ?> (
                            <?php echo $pasien['gender2']; ?>)</label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['tgl_lahir']; ?> (
                            <?php echo $pasien['umur1']; ?>Thn)</label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['dokter']; ?>
                    </label>
                    <label class="col-sm-12 col-form-label">
                        <?php echo $pasien['poli_ruangan']; ?>
                    </label>
                </div>
            </div>
							 <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Instruksi / Anjuran dan Edukasi ( Follow Up ): </label>
                            </br>
                            <label class="control-label">&#9998; :
                                <?php echo $data_resmed['p_instruksi_terakhir']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label"><b>KONDISI IBADAH :</b></label>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input <?php if (in_array( '1', $data_resmed['kondisi_ibadah'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_ibadah[]" value="1"> Disiplin
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input <?php if (in_array( '2', $data_resmed['kondisi_ibadah'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_ibadah[]" value="2"> Kadang Kadang
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input <?php if (in_array( '3', $data_resmed['kondisi_ibadah'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_ibadah[]" value="3"> Tidak
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label"><b>KONDISI PSIKO-SPIRITUAL :</b></label>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input <?php if (in_array( '1', $data_resmed['kondisi_psiko'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_psiko[]" value="1"> Menerima
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input <?php if (in_array( '2', $data_resmed['kondisi_psiko'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_psiko[]" value="2"> Mengeluh
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input <?php if (in_array( '3', $data_resmed['kondisi_psiko'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_psiko[]" value="3"> Menolak
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label"><b>CARA KELUAR :</b></label>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input <?php if (in_array( '1', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="1"> Petunjuk Dokter
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input <?php if (in_array( '2', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="2"> Rujuk
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input <?php if (in_array( '3', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="3"> APS
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input <?php if (in_array( '4', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="4"> Lain-lain
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label"><b>KONDISI KELUAR :</b></label>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input <?php if (in_array( '1', $data_resmed['kondisi_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_keluar[]" value="1"> Sembuh
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input <?php if (in_array( '2', $data_resmed['kondisi_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_keluar[]" value="2"> Meninggal
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input <?php if (in_array( '3', $data_resmed['kondisi_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_keluar[]" value="3"> Asuhan Belum Selesai
                                    <div class="input-group-addon"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="col-md-12">
                <label class="control-label"><b>TINDAK LANJUT :</b></label>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input <?php if (in_array( '1', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="1"> Kontrol Rawat Jalan
                            <div class="input-group-addon"> </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <input <?php if (in_array( '2', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="2"> Tidak Perlu kontrol
                            <div class="input-group-addon"> </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input <?php if (in_array( '3', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="3"> Home Care
                            <div class="input-group-addon"> </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input <?php if (in_array( '4', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="4"> Kembali ke perujuk
                            <div class="input-group-addon"> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input <?php if (in_array( '1', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="1"> Sudah Mendapat Penjelasan
                            <div class="input-group-addon"> </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <input <?php if (in_array( '2', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="2"> Akses Link www.sariasih.com/kerohanian.pdf
                            <div class="input-group-addon"> </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <input <?php if (in_array( '3', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="3"> Menerima Salinan Formulir
                            <div class="input-group-addon"> </div>
                        </div>
                    </div>
                </div>
            </div>

            <label class="control-label"><b>TERAPI PULANG :</b></label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nama Obat</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-center">Dosis</th>
                        <th scope="col" class="text-center">Frekuensi</th>
                        <th scope="col" class="text-center">Cara Pemberian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>

                    </tr>

                </tbody>
            </table>

						<div class="col-md-12" id="box_eresep_pulang">
                <br>
            </div>
            
            <div class="col-md-12">
                <br>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>

                            <tr>
                                <td class="border-it" style="text-align: center;" height="100">TANDA TANGAN PASIEN
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>(&nbsp; &nbsp; &nbsp; &nbsp;)</td>
                                <td class="border-it" style="text-align: center;" height="100">Tanggal …………………….. Jam ………
                                    <br>Dokter Penanggung Jawab Pasien
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>(Tanda Tangan & Nama lengkap)</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12">

            </div>
        </div>
    </div>
    <!-- END RESIKO JATUH -->

<?php
function tgl_indonesia($date){
   /* ARRAY u/ hari dan bulan */
   $Hari = array ("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",);
   $Bulan = array ("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

/* Memisahkan format tanggal bulan dan tahun menggunakan substring */
$tahun 	 = substr($date, 0, 4);
$bulan 	 = substr($date, 5, 2);
$tgl	 = substr($date, 8, 2);
$waktu	 = substr($date,11, 5);
$hari	 = date("w", strtotime($date));

$result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun."";
return $result;
}
/* by RioBermano.Com */
?>


    <?php $this->theme->script('theme_default'); ?>
<script>
	var data_id_eresep = <?php echo $data_id_eresep; ?>;
	for(i=0;i<data_id_eresep.length;i++)
	{
		inner_loader('<?php echo base_url('soap_eresep/list_riwayat_resep_online_det/') ?>' + data_id_eresep[i] + '/false/t' , '#box_eresep_pulang', false, '');
	}
</script>
</body>

</html>