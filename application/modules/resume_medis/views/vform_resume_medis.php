<script>
    var id_reg = '<?php echo $id_reg; ?>';
    var id_pasien = '<?php echo $id_pasien; ?>';
</script>
<style>
    .pnl-head-3 {
        border-radius: 40px 40px 0 0;
        background-color: #CCC;
        margin-bottom: 0;
    }

    hr {
        margin-top: 3px;
        margin-bottom: 5px;
    }
</style>
<div class="container-fluid">
    <form id="frm_resume_medis" method="post" action="<?php echo base_url('resume_medis/act_resume_medis/'.$id_reg.'/'.$id_pasien); ?>">
        <div class="row pnl">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">id_resmed :</label>
                        <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>">
                    </div>
                    <div class="col-sm-9">
                        <label class="control-label">
                            <input type="text" id="id_resmed" name="id_resmed" value="<?php echo $data_resmed['id_resmed']; ?>"  readonly />
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Sheet Command :</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="sql_command" name="sql_command" value="<?php echo $sql_command; ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Tanggal Resume Medis :</label>
                    </div>
                    <div class="col-sm-9">
                        <label class="control-label">
                            <input type="text" id="resmed_date" name="resmed_date" value="<?php echo $data_resmed['resmed_date']; ?>" />
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Id Dokter :</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="id_dokter" name="id_dokter" value="<?php echo $this->session->userdata['sp']->id_dokter; ?>" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Tanggal Masuk :</label>
                    </div>
                    <div class="col-sm-9">
                        <label class="control-label">
                            <input type="text" name="regdate" value="<?php echo $data_pasien['regdate']; ?>" />
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Ruang Rawat Terakhir :</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="ruang_rawat" value="<?php echo $data_resmed['id_kamar']; ?>" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Tanggal Keluar / Meninggal :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="tgl_keluar" id="tgl_keluar" class="form-control tanggal" value="<?php echo $data_resmed['tgl_keluar']; ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Penanggung Bayaran :</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="penanggung_bayaran" value="<?php echo $data_resmed['penanggung']; ?>" />
                    </div>
                </div>
            </div>

        </div>

        <div class="row pnl">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Indikasi Rawat Inap :</label>
                    <textarea class="form-control input-focus area-scroll" id="keluhan_utama" name="keluhan_utama" rows="5" placeholder="Keluhan Utama" style="min-height:300px;"><?php echo $data_resmed['keluhan_utama']; ?></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Ringkasan Riwayat Penyakit :</label>
                    <!--<textarea class="form-control input-focus area-scroll" id="riwayat_sakit_now" name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Sekarang">Riwayat Penyakit Sekarang : <?php #echo $riwayat_pasien['penyakit_sekarang']; ?> &#13;&#10;Riwayat Penyakit Dahulu : <?php echo $riwayat_pasien['penyakit_dahulu']; ?></textarea>-->
                    <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_dulu" name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit" style="min-height:300px;"><?php echo $data_resmed['riwayat_sakit_dulu']; ?></textarea>
                </div>
            </div>

        </div>
        <br>

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
                    <label class="control-label">Keadaan Umum :</label>
                    <textarea class="form-control input-focus area-scroll" id="keadaan_umum" name="keadaan_umum" rows="5" placeholder="Keadaan Umum"><?php echo $data_resmed['keadaan_umum']; ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <h4>TTV</h4>
                    <hr>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Kesadaran</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="kesadaran" name="kesadaran" placeholder="Kesadaran" value="<?php echo $data_resmed['kesadaran']; ?>">
                </div>
            </div>

            <!--
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Keadaan Umum</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="xxx" name="xxx" placeholder="Keadaan Umum" value="<#?php echo $data_resmed['keadaan_umum']; ?>">
                </div>
            </div>
        -->

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Tekanan Darah</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="td" name="td" placeholder="Tekanan Darah" value="<?php echo $data_resmed['td']; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">GCS</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="gcs" name="gcs" placeholder="GCS" value="<?php echo $data_resmed['gcs']; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Nadi</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="nadi" name="nadi" placeholder="Nadi" value="<?php echo $data_resmed['nadi']; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">SUHU</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="suhu" name="suhu" placeholder="SUHU" value="<?php echo $data_resmed['suhu']; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Pernafasan</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="nafas" name="nafas" placeholder="Pernafasan" value="<?php echo $data_resmed['nafas']; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Reaksi Cahaya</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="reaksi_cahaya" name="reaksi_cahaya" placeholder="Reaksi Cahaya" value="<?php echo $data_resmed['reaksi_cahaya']; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Tinggi Badan</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="tinggi" name="tinggi" placeholder="Tinggi Badan" value="<?php echo $data_resmed['tinggi']; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Berat Badan</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" id="berat" name="berat" placeholder="Berat Badan" value="<?php echo $data_resmed['berat']; ?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Pemeriksaan Penunjang / Diagnostik terpenting :</label>
                    <textarea class="form-control input-focus area-scroll" id="pemeriksaan_penunjang" name="pemeriksaan_penunjang" rows="5" placeholder="Pemeriksaan Penunjang / Diagnostik terpenting"><?php echo $data_resmed['pemeriksaan_penunjang']; ?></textarea>
                    <a href="<?php echo base_url('hasil_lab/riwayat_hasil_lab/'.$id_reg.''); ?>"
                    onClick="javascript: centeredPopup(this.href,'myWindow','700','300','yes');return false;">[ Kisi-kisi Lab ]</a>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Terapi / Pengobatan Selama di Rumah Sakit :</label>
                    <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan" name="riwayat_pengobatan" rows="5" placeholder="Terapi / Pengobatan Selama di Rumah Sakit"><?php echo $data_resmed['riwayat_pengobatan']; ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Hasil Konsultasi :</label>
                    <textarea class="form-control input-focus area-scroll" id="hasil_konsultasi" name="hasil_konsultasi" rows="5"placeholder="Hasil Konsultasi"><?php echo $data_resmed['hasil_konsultasi']; ?></textarea>
                </div>
            </div>

        </div>
        <br>

        <div class="row pnl pnl-asm">
            <div class="col-md-12">
                <div class="form-group">
                    <h4>Diagnosis ICD 10</h4>
                    <hr>
                </div>
            </div>
            <?php
    for($i=0;$i<=4;$i++){
    $caption = ($i==0) ? "Utama" : ("Sekundari ".($i+1)) ;
    ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">
                            <?php echo $caption; ?> :</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="ui-widget">
                            <input id="name_icd_ten[<?php echo $i; ?>]" name="name_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten_text[$i]; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input id="id_icd_ten[<?php echo $i; ?>]" name="id_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten[$i]; ?>">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input id="old_id_icd_ten[<?php echo $i; ?>]" name="old_id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly>
                    </div>
                </div>
                <?php
    }
    ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4>Tindakan / Prosedur (ICD 9CM)</h4>
                            <hr>
                        </div>
                    </div>
                    <?php
    for($i=0;$i<=2;$i++){
    $caption = ($i==0) ? "Utama" : ("Sekundari ".($i+1)) ;
    ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">
                                    <?php echo $caption; ?> :</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="ui-widget">
                                    <input id="name_icd_nine[<?php echo $i; ?>]" name="name_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine_text[$i]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <input id="id_icd_nine[<?php echo $i; ?>]" name="id_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine[$i]; ?>">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <input id="old_id_icd_nine[<?php echo $i; ?>]" name="old_id_icd_nine[<?php echo $i; ?>]" class="form-control" readonly>
                            </div>
                        </div>
                        <?php
    }
    ?>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Alergi ( reaksi obat ) :</label>
                                    <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi" rows="5" placeholder="riwayat_alergi"><?php echo $data_resmed['riwayat_alergi']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Hasil Laboratorium :</label>
                                    <textarea class="form-control input-focus area-scroll" id="lab_belum_selesai" name="lab_belum_selesai" rows="5" placeholder="lab_belum_selesai"><?php echo $data_resmed['lab_belum_selesai']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Diet :</label>
                                    <textarea class="form-control input-focus area-scroll" id="diet" name="diet" rows="5" placeholder="diet"><?php echo $data_resmed['diet']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Instruksi / Anjuran dan Edukasi ( Follow Up ) :</label>
                                    <textarea class="form-control input-focus area-scroll" id="p_instruksi_terakhir" name="p_instruksi_terakhir" rows="5" placeholder="p_instruksi_terakhir"><?php echo $data_resmed['p_instruksi_terakhir']; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tanda Vital (Saat Pulang) :</label>
                                    <textarea class="form-control input-focus area-scroll" id="tanda_vital_saat_pulang" name="tanda_vital_saat_pulang" rows="5" placeholder="Tanda vital saat pulang"><?php echo $data_resmed['tanda_vital_saat_pulang']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Kondisi Psiko-Spiritual :</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_psiko[]" value="1"> Menerima
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_psiko[]" value="2"> Mengeluh
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_psiko[]" value="3"> Menolak
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Kondisi Ibadah :</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_ibadah[]" value="1"> Disiplin
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_ibadah[]" value="2"> Kadang Kadang
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_ibadah[]" value="3"> Tidak
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Cara Keluar :</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="cara_keluar[]" value="1"> Petunjuk Dokter
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="cara_keluar[]" value="2"> Rujuk
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="cara_keluar[]" value="3"> APS
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="cara_keluar[]" value="3"> Lain - Lain
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Kondisi Keluar :</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_keluar[]" value="1"> Sembuh
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_keluar[]" value="2"> Meninggal
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="checkbox" name="kondisi_keluar[]" value="3"> Asuhan Belum Selesai
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Tindak Lanjut :</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="tindak_lanjut[]" value="1"> Kontrol Rawat Jalan
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="tindak_lanjut[]" value="2"> Tidak Perlu Kontrol
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="tindak_lanjut[]" value="3"> Home Care
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="tindak_lanjut[]" value="3"> Kembali Ke Perujuk
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="pertanyaan[]" value="1"> Sudah Mendapat Penjelasan
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" name="pertanyaan[]" value="2"> Akses Link www.sariasih.com/kerohanian.pdf
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="pertanyaan[]" value="3"> Menerima Salinan Formulir
                                            <div class="input-group-addon"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <label class="control-label">Terapi Pulang :</label>
                                </div>
                            </div>

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
                                <a href="#" title="Cek Resep Pulang" data-toggle="modal" data-target="#modalResmedEresep">[ Cek Resep Pulang ]</a>
                                <!-- Button trigger modal -->
                                <button id="butt_cek_resep" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalResmedEresep">
                                  Cek Resep Pulang
                                </button>
                            </div>

        </div>

        <div class="col-md-12 text-center" style="margin-top:30px;">
            <button type="submit" class="btn btn-success" style="font-size:22px"> <i class="fa fa-check"></i> S I M P A N </button>
            <!--<button type="button" class="btn btn-info <?php #echo ($data_resmed['id_resmed']=='')?'d-none':''; ?>" style="font-size:22px" onClick="javascript: centeredPopup('<?php echo base_url('resume_medis/print_resmed/'.$data_resmed['id_resmed'].'/'.$id_reg.''); ?>','myWindow','1024','600','yes');return false;"><i class="fa fa-check"></i> P R I N T (OLD)</button>-->
            <button type="button" class="btn btn-info <?php echo ($data_resmed['id_resmed']=='')?'d-none':''; ?>" style="font-size:22px" onClick="javascript: centeredPopup('<?php echo base_url('resume_medis/print_resmed_v2/'.$id_reg.''); ?>','myWindow','1024','600','yes');return false;"><i class="fa fa-check"></i> P R I N T </button>
        </div>

		</form>
</div>

<!--modal segment-->
<div class="modal fade" id="modalResmedEresep" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Form Pilih Resep Pulang</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<!--<h5>Default Modal</h5>-->
<div class="row">
<div class="col-sm-12">

<div class="card table-card">
<div class="card-block" id="modal-body-resmed" style="overflow:auto; max-height:80vh"></div>
</div>
</div>


</div>
</div>
</div>

</div>
</div>
<!--end modal segment-->

<!-- modal here -->
<?php $this->theme->script('theme_default'); ?>
    <!-- action here -->
    <script>
        var baseUrl = '/prjext/clinic/';
        $(function() {
            // ---- autocomplet buat icd 10 ------
            $("#name_icd_ten\\[0\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_ten\\[0\\]").val(ui.item.id);
                }
            });

            $("#name_icd_ten\\[1\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_ten\\[1\\]").val(ui.item.id);
                }
            });

            $("#name_icd_ten\\[2\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_ten\\[2\\]").val(ui.item.id);
                }
            });

            $("#name_icd_ten\\[3\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_ten\\[3\\]").val(ui.item.id);
                }
            });

            $("#name_icd_ten\\[4\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_ten\\[4\\]").val(ui.item.id);
                }
            });

            // ---- autocomplet buat icd 9 ------
            $("#name_icd_nine\\[0\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[0\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[1\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[1\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[2\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[2\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[3\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[3\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[4\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[4\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[5\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[5\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[6\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[6\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[7\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[7\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[8\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[8\\]").val(ui.item.id);
                }
            });

            $("#name_icd_nine\\[9\\]").autocomplete({
                source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
                appendTo: "#modal-body-upl",
                minLength: 2,
                select: function(event, ui) {
                    $("#id_icd_nine\\[9\\]").val(ui.item.id);
                }
            });

        });
    </script>
    <script>
        // Date picker only
        $('.tanggal').datepicker({
            dateFormat: "yy-mm-dd",
            autoclose: true,
            language: 'id',
        });

        $(".tanggal").datepicker("setDate", new Date());
    </script>
    <script>
        $('#frm_resume_medis').submit(function(event) {
						//alert('masuk cuy');
            event.preventDefault(); //prevent default action

            var post_url = $(this).attr("action"); //get form action url
            var form_data = $(this).serialize(); //Encode form elements for submission

            $.post(post_url, form_data, function(response) {
                alert('Response :' + response);
                //inner_loader('<?php #echo base_url('erm_ranap/asm_ranap/'.$id_reg) ?>', '#box_asm_awal_ranap', false, '');
                location.reload();
            });
        });
    </script>
    <script>
		//$('#frm_resume_medis').find(':radio[name=kondisi_psiko][value="<?php #echo $row['asal_masuk']; ?>"]').prop('checked', true).val();
			var data = <?php echo $data_resmed_json; ?>;
			//alert('test : ' + data.kondisi_psiko);

			if(data.kondisi_psiko != null)
			{
				var kondisi_psiko = data.kondisi_psiko;
					if (kondisi_psiko.length > 0) {
						var kondisi_psiko = data.kondisi_psiko.split(";"),
							$inputs = $('input[name^=kondisi_psiko]');
						for (var j = 0; j < kondisi_psiko.length; j++) {
							$inputs.filter("[value='" + kondisi_psiko[j] + "']").attr('checked', 'checked');
					}
				}
			}

			if(data.kondisi_ibadah != null)
			{
				var kondisi_ibadah = data.kondisi_ibadah;
					if (kondisi_ibadah.length > 0) {
						var kondisi_ibadah = data.kondisi_ibadah.split(";"),
							$inputs = $('input[name^=kondisi_ibadah]');
						for (var j = 0; j < kondisi_ibadah.length; j++) {
							$inputs.filter("[value='" + kondisi_ibadah[j] + "']").attr('checked', 'checked');
					}
				}
			}

			if(data.cara_keluar != null)
			{
				var cara_keluar = data.cara_keluar;
					if (cara_keluar.length > 0) {
						var cara_keluar = data.cara_keluar.split(";"),
							$inputs = $('input[name^=cara_keluar]');
						for (var j = 0; j < cara_keluar.length; j++) {
							$inputs.filter("[value='" + cara_keluar[j] + "']").attr('checked', 'checked');
					}
				}
			}

			if(data.kondisi_keluar != null)
			{
				var kondisi_keluar = data.kondisi_keluar;
					if (kondisi_keluar.length > 0) {
						var kondisi_keluar = data.kondisi_keluar.split(";"),
							$inputs = $('input[name^=kondisi_keluar]');
						for (var j = 0; j < kondisi_keluar.length; j++) {
							$inputs.filter("[value='" + kondisi_keluar[j] + "']").attr('checked', 'checked');
					}
				}
			}

			if(data.tindak_lanjut != null)
			{
				var tindak_lanjut = data.tindak_lanjut;
					if (tindak_lanjut.length > 0) {
						var tindak_lanjut = data.tindak_lanjut.split(";"),
							$inputs = $('input[name^=tindak_lanjut]');
						for (var j = 0; j < tindak_lanjut.length; j++) {
							$inputs.filter("[value='" + tindak_lanjut[j] + "']").attr('checked', 'checked');
					}
				}
			}

			if(data.pertanyaan != null)
			{
				var pertanyaan = data.pertanyaan;
					if (pertanyaan.length > 0) {
						var pertanyaan = data.pertanyaan.split(";"),
							$inputs = $('input[name^=pertanyaan]');
						for (var j = 0; j < pertanyaan.length; j++) {
							$inputs.filter("[value='" + pertanyaan[j] + "']").attr('checked', 'checked');
					}
				}
			}


    </script>


<script language="javascript">
var popupWindow = null;
function centeredPopup(url,winName,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
popupWindow = window.open(url,winName,settings)
}
</script>

<script>
    //alert(data_id_eresep);
var data_id_eresep = <?php echo $data_id_eresep; ?>;
for(i=0;i<data_id_eresep.length;i++)
{
	inner_loader('<?php echo base_url('soap_eresep/list_riwayat_resep_online_det/') ?>' + data_id_eresep[i] + '/false/t' , '#box_eresep_pulang', false, '');
}

/*$('#butt_cek_resep').click(function(e) {
    alert("popopo");
	inner_loader('<?php echo base_url('soap_eresep/list_riwayat_resep_online_v2/') ?>' + id_reg + '/' + id_pasien , '#modal-body-resmed', false, '');
});*/

/*$('#butt_cek_resep').click(function(){
//inner_loader('<?php echo base_url('soap_eresep/list_riwayat_resep_online_v2/') ?>' + id_reg + '/' + id_pasien , '#modal-body-resmed', false, '');
});*/


$('#butt_cek_resep').click(function(){
  var type_rwt   = 'ri';
    //resume medis
    $.ajax({
      url : baseUrl+"soap_eresep/list_riwayat_resep_online_v2/"+id_reg+"/"+id_pasien,
      method : "POST",
      data : {id_reg:id_reg,id_pasien:id_pasien,type_rwt:type_rwt},
      async : true,
      dataType : 'html',
      success: function(datarestind){
          $('#modal-body-resmed').html(datarestind);
        }
      });
    //end resume medis
});
</script>
