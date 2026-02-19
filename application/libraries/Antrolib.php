<?php
defined('BASEPATH') or exit('No direct script access allowed');
class antrolib {

	var $db;
	var $dbsupp;
	var $db2;
	var $dbhis;
	var $wsv;
	var $today;
	var $today_timestamp;
	var $config;
  var $prosesor;            
	
	public function __construct()
	{
		$CI =& get_instance();
		$this->config = $CI->config;
		
		$this->db = $CI->dbsupp;
		$this->dbsupp = $CI->dbsupp;
		
		$this->db2 = $CI->dbhis;
		$this->dbhis = $CI->dbhis;
	
		$this->wsv = $CI->wsv;
    $this->prosesor =  $CI->prosesor;
		
		date_default_timezone_set('Asia/Jakarta'); 
		$this->today = date("Y-m-d");
		$this->today_timestamp = date("Y-m-d H:i:s"); 
		$this->id_ppk = $this->config->item('apem_id_ppk');
		
		if($this->config->item('apem_debug'))
		{
			$this->db->db_verbose = true;
			$this->db2->db_verbose = true;
			$this->dbsupp->db_verbose = true;
			$this->dbhis->db_verbose = true;
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		}
	}

  // Daftar Services RS post to BPJS -- Start Here

  public function reffPoli()
  {
    $result = $this->wsv->antrol_ref_poli();
    return $result;
  }

  public function reffDokter()
  {
    $result = $this->wsv->antrol_ref_dokter();
    return $result;
  }

  public function antrolJadwalDokter($id_unit, $tanggal)
  {
    $mapping_poli = $this->poliRsToBpjs($id_unit);
    $kodepoli     = $mapping_poli->kode_poli;

    $result = $this->wsv->antrol_jadwal($kodepoli, $tanggal);
		return $result;
  }

  public function updateJadwalDokter($id_unit, $id_dokter)
  {
    $mapping_poli     = $this->poliRsToBpjs($id_unit);
    $kodepoli         = $mapping_poli->kode_poli;
    $kodesubspesialis = $mapping_poli->kode_poli;
    
    $mapping_dokter = $this->dokterRsToBpjs($id_dokter);
    $kodedokter     = $mapping_dokter->iddokter;

    $jadwal =$this->get_jadwal_byid($id_dokter);

    $result = $this->wsv->antrol_update_jadwal_dokter($kodepoli, $kodesubspesialis, $kodedokter, $jadwal);
		return $result;
  }

  public function tambahAntrean($kodebooking)
  {
    $data_booking   = $this->get_booking_byid($kodebooking);

    $id_pasien   = $data_booking['id_pasien'];
    $data_pasien = $this->get_pasien_byid($data_booking['id_pasien']);

    $id_shift       = $data_booking['id_shift'];
    $id_dokter      = $data_booking['id_dokter'];
    $tanggalperiksa = date('Y-m-d',strtotime($data_booking['bookdate']));
    
    $telp = intval($data_booking['telp']);
    $hape = intval($data_booking['hp']);

    if($hape == 0 || $hape == '')
    {
      if($telp == 0 || $telp == '')
      {
        if($data_booking['id_pasien'] != '')
        {
          $telp_pasien = intval($data_pasien['telp']);
          $hape_pasien = intval($data_pasien['hp']);

          if($hape_pasien == 0 || $hape_pasien == ''){
            if($telp_pasien == 0 || $hape_pasien == ''){
              $hp = '081234567890';
            }else{
              $hp = $telp_pasien;
            }
          }else{
            $hp = $hape_pasien;
          }
        }else{
          $hp = '081234567890';
        }
      }
      else
      {
        $hp = $telp;
      }
    }else{
      $hp = $hape;
    }

    if(substr($hp, 0, 1) == 8 || substr($hp, 0, 2) == 62)
    {
      $nohp = '0'.$hp;
    }else{
      $nohp = $hp;
    }

    $nohp           = $nohp;
    $kodepoli       = $data_booking['kode_poli'];
    $namapoli       = $data_booking['poli'];
    $pasienbaru     = $data_booking['is_op'];
    $norm           = $data_booking['id_pasien'];
    $kodedokter     = $data_booking['id_dokter_bpjs'];
    $namadokter     = $data_booking['dokter'];
    $nomorantrean   = $data_booking['id_num'];
    $angkaantrean   = intval($data_booking['id_num']);

    $jadwal_dokter = $this->get_jadwal_dokter_v1($id_dokter, $tanggalperiksa, $id_shift);
    $hr_start      = date('H:i', strtotime($jadwal_dokter->mulai));
    $hr_end        = date('H:i', strtotime($jadwal_dokter->selesai));
    $jampraktek    = $hr_start.'-'.$hr_end;
    $jum_slot      = floor($jadwal_dokter->slot);

    $jml_pasien_booking = $this->jml_pasien_booking($id_shift, $id_dokter, $tanggalperiksa);
    $kuotanonjkn        = $jum_slot - $jml_pasien_booking;
    $kuotanonjkn        = ($kuotanonjkn <= 0) ? 0 : $kuotanonjkn ;
								
		$jml_pasien_booking_bpjs = $this->jml_pasien_booking_bpjs($id_shift, $id_dokter, $tanggalperiksa);
		$kuotajkn                = $jum_slot - $jml_pasien_booking_bpjs['num_rows'];
		$kuotajkn                = ($kuotajkn <= 0) ? 0 : $kuotajkn ;

    date_default_timezone_set('Asia/Jakarta');
		$time             = date("H:i", strtotime($data_booking['hr_start']));
		$bookdate         = $tanggalperiksa . ' ' . $time;
		$stamp            = strtotime($bookdate);
		$second           = $stamp * 1000;
		$estimasidilayani = number_format($second, 0, '.', '');

    

    $id_reg   = $data_booking['id_reg'];
    if($id_reg == ''){
      $tipe_pasien = strtolower($data_booking['description']);
      $tipe_pasien = stripos($tipe_pasien, 'bpjs');
    }else{
      $data_reg    = $this->get_registrasi_byid($id_reg);
      $id_comp     = $data_reg['id_asuransi'];
      $tipe_pasien = ($id_comp == '0190') ? true : false ;
    }
    
    if ($tipe_pasien === false) {
			$jenispasien    = 'NON JKN';
			$nomorkartu     = '';
			$nik            = $data_pasien['pid_num'];
			$jeniskunjungan = 1;
			$nomorreferensi = '';
		}
    else
    {
      $rujukan   = $this->prosesor->get_rujukan_yg_cocok($data_pasien['asm_id'], $data_booking['kode_poli']);
      
      if(!$rujukan){
        $nomorkartu     = '0001234567890';
        $nik            = '3212345678987654';
        $nomorreferensi = '0001R0040116A000001';
      }else{
        $nomorkartu     = $rujukan->peserta->noKartu;
        $nik            = $rujukan->peserta->nik;
        $nomorreferensi = $rujukan->noKunjungan;
      }

      $jenispasien    = 'JKN';
      $jeniskunjungan = 1;
    }

    $result = $this->wsv->antrol_tambah_antrian($kodebooking, $jenispasien, $nomorkartu, $nik, $nohp, $kodepoli, $namapoli, $pasienbaru, $norm, $tanggalperiksa, $kodedokter, $namadokter, $jampraktek, $jeniskunjungan, $nomorreferensi, $nomorantrean, $angkaantrean, $estimasidilayani, $jum_slot, $kuotajkn, $kuotanonjkn);
    if($result){
      $status  = $result->metadata->code;
      $message = $result->metadata->message;
    }else{
      $status = null;
      $message= 'Gagal Connect Server BPJS';
    }
    
    $cek_log =  $this->cekLogService($kodebooking, 0);
    if ($cek_log== 0) {
      $this->storeLogService($kodebooking,'tambahAntrean', 0, $status, $message);
    }

    return $result;
  }

  function updateWaktu($kodebooking, $taskid, $estimasidilayani)
  {
    $result = $this->wsv->antrolUpdateWaktu($kodebooking, $taskid, $estimasidilayani);

    if($result){
      $status  = $result->metadata->code;
      $message = $result->metadata->message;
    }else{
      $status  = null;
      $message = 'Gagal Connect Server BPJS';
    }

    $cek_log =  $this->cekLogService($kodebooking, $taskid);
    if ($cek_log== 0) {
      $this->storeLogService($kodebooking,'updateWaktuAntrean', $taskid, $status, $message);   
    }
    return $status;

  }
  
  public function updateWaktuAntrean($kodebooking, $taskid)
  {
    if($taskid==4 || $taskid==2)
    {
      $prev_task = $taskid - 1;
      $cek_log   = $this->cekLogService($kodebooking, $prev_task);
      
      if($cek_log == 0)
      {
        $cek_log0   = $this->cekLogService($kodebooking,0);
        if($cek_log0 == 0){
          $tambah_antrean = $this->tambahAntrean($kodebooking);
          $status_tambah  = $tambah_antrean->metadata->code;
        }else{
          $status_tambah = 200;
        }
        
        if($status_tambah == 200)
        {
          $get_reg = $this->getRegByKodebooking($kodebooking);
          $regdate = $get_reg->regdate;

          $date3             = $regdate;
          $stamp3            = strtotime($date3);
          $second3           = $stamp3 * 1000;
          $estimasidilayani3 = number_format($second3, 0, '.', '');
          
          $taskid_3 = $this->updateWaktu($kodebooking, $prev_task, $estimasidilayani3);

          if($taskid_3 == 200)
          {
            $date             = date('Y-m-d H:i:s');
            $stamp            = strtotime($date);
            $second           = $stamp * 1000;
            $estimasidilayani = number_format($second, 0, '.', '');

            $result = $this->updateWaktu($kodebooking, $taskid, $estimasidilayani);
            return $result;
          }
        }
      }
      else
      {
        $date             = date('Y-m-d H:i:s');
        $stamp            = strtotime($date);
        $second           = $stamp * 1000;
        $estimasidilayani = number_format($second, 0, '.', '');

        $result = $this->updateWaktu($kodebooking, $taskid, $estimasidilayani);
        return $result;
      }
    }
    else
    {
      $date             = date('Y-m-d H:i:s');
      $stamp            = strtotime($date);
      $second           = $stamp * 1000;
      $estimasidilayani = number_format($second, 0, '.', '');

      $result = $this->updateWaktu($kodebooking, $taskid, $estimasidilayani);
      return $result;
    }

  }

  public function updateWaktuAntreanWithIdreg($id_reg, $id_dokter, $taskid)
  {
    $get_book = $this->getKodebookingWithIdreg($id_reg, $id_dokter);
    if (isset($get_book))
    {
      $kodebooking = $get_book->id_trx;
      $result      = $this->updateWaktuAntrean($kodebooking, $taskid);
      return $result;
    }
    return;
  }


  public function batalAntrean($kodebooking)
  {
    $keterangan = "Tidak Jadi Berobat";
    $result = $this->wsv->antrolBatalAntrean($kodebooking, $keterangan);
    return $result;
  }

  public function listWaktuTaksId($kodebooking)
  {
    $result = $this->wsv->antrolListWaktuTaskid($kodebooking);
    return $result;
  }

  public function dashboardPerTanggal($tanggal, $waktu)
  {
    $result = $this->wsv->antrol_dashboard_per_tanggal($tanggal, $waktu);
    return $result;
  }

  public function dashboardPerBulan($bulan, $tahun, $waktu)
  {
    $result = $this->wsv->antrol_dashboard_per_bulan($bulan, $tahun, $waktu);
    return $result;
  }

  // Daftar Services RS post to BPJS -- End Here





  public function get_booking_byid($kodebooking){
    $sql = "SELECT TRB.*,MD.name AS dokter, MDB.iddokter AS id_dokter_bpjs, MU.name AS poli, MPB.kode_poli
            
            FROM trx_reg_book TRB
            left join mst_unit MU ON TRB.id_unit = MU.id_unit
            left join mst_dokter MD on TRB.id_dokter = MD.id_dokter
            left join dbsupp.mapping_poli_bpjs MPB ON MU.id_unit = MPB.id_unit
            left join dbsupp.mapping_dokter_bpjs MDB ON MD.id_dokter = MDB.id_dokter
            
            WHERE TRB.id_trx = '" . $kodebooking . "'
            ";
    //echo $sql;
    $query = $this->dbhis->query($sql);
    $rs = $query->row_array();
    return $rs;
  }

  public function get_pasien_byid($id_pasien){
    $sql = "SELECT a.*
            FROM mst_pasien a
            WHERE a.id_pasien = '" . $id_pasien . "'
            ";
    //echo $sql;
    $query = $this->dbhis->query($sql);
    $rs = $query->row_array();
    return $rs;
  }

  public function get_registrasi_byid($id_reg){
    $sql = "SELECT a.*
            FROM trx_reg a
            WHERE a.id_reg = '" . $id_reg . "'
            ";
    //echo $sql;
    $query = $this->dbhis->query($sql);
    $rs = $query->row_array();
    return $rs;
  }

  public function get_jadwal_dokter_v1($id_dokter, $tanggalperiksa, $id_shift) {
    $sql = " SELECT  a.id_dokter, a.hr_start AS mulai, a.hr_end AS selesai, a.id_dow AS hari,
          a.id_shift AS shift, a.duration AS durasi,
          CONVERT(TIMESTAMPDIFF(MINUTE, a.hr_start, a.hr_end), CHAR) AS total_menit,
          (CONVERT(TIMESTAMPDIFF(MINUTE, a.hr_start, a.hr_end), CHAR)/a.duration) AS slot
          FROM `mst_dokter_jwp` a
          WHERE a.`id_dow`= (DAYOFWEEK('" . $tanggalperiksa . "')-1)
          AND a.`id_dokter`='" . $id_dokter . "'
          AND a.id_shift = '" . $id_shift . "'
        ";
    //print_r($sql);
    $query = $this->dbhis->query($sql);
    $rs = $query->row();
    return $rs;
  }

  public function jml_pasien_booking($id_shift, $id_dokter, $tanggalperiksa) {
    $sql = " SELECT a.*
          FROM  trx_reg_book a
          WHERE a.bookdate  ='" . $tanggalperiksa . "'
          AND  a.id_dokter  ='" . $id_dokter . "'
          AND a.id_shift    ='" . $id_shift . "'
        ";
    $query = $this->dbhis->query($sql);
    $rs = $query->num_rows();
    return $rs;
  }
  
  public function jml_pasien_booking_bpjs($id_shift, $id_dokter, $tanggalperiksa) {
    $sql = " SELECT a.*
          FROM  trx_reg_book a
          WHERE a.bookdate  ='" . $tanggalperiksa . "'
          AND  a.id_dokter  ='" . $id_dokter . "'
          AND a.id_shift    ='" . $id_shift . "'
          AND a.description LIKE '%BPJS%'
        ";
    $query = $this->dbhis->query($sql);
    $rs = $query->result_array();
    $rs_num = $query->num_rows();
    
    $data = array(
      'num_rows' => $rs_num,
      'rs'       => $rs
    );
    return $data;
  }

  public function getKodebookingWithIdreg($id_reg, $id_dokter)
  {
    $sql = "SELECT a.*
            FROM  trx_reg_book a
            WHERE a.id_reg  ='" . $id_reg . "'
            AND  a.id_dokter  ='" . $id_dokter . "'
          ";
    $query = $this->dbhis->query($sql);
    $rs = $query->row();
    return $rs;
  }

  //Query Mapping Dokter RS to BPJS
  public function dokterRsToBpjs($id_dokter)
  {
    $sql ="	SELECT MDB.*, MD.name AS dokter
            FROM mapping_dokter_bpjs MDB
            LEFT JOIN mst_dokter MD ON MDB.id_dokter = MD.id_dokter
            WHERE MDB.id_dokter = '" . $id_dokter . "'
					";
			
		$query = $this->dbsupp->query($sql);
		$rs    = $query->row();
			
		if ($query->num_rows() > 0) {
			return $rs;
		} else {
			return "";
		}
  }

  //Query Mapping Dokter BPJS to RS
  public function dokterBpjsToRs($kodedokter)
  {
    $sql ="	SELECT MDB.*, MD.name AS dokter
            FROM mapping_dokter_bpjs MDB
            LEFT JOIN mst_dokter MD ON MDB.id_dokter = MD.id_dokter
            WHERE MDB.iddokter = '" . $kodedokter . "'
					";
			
		$query = $this->dbsupp->query($sql);
		$rs    = $query->row();
			
		if ($query->num_rows() > 0) {
			return $rs;
		} else {
			return "";
		}
  }

  //Query Mapping Poli RS to BPJS
  public function poliRsToBpjs($id_unit)
  {
    $sql ="	SELECT MPB.*, MU.name AS poli
            FROM mapping_poli_bpjs MPB
            LEFT JOIN mst_unit MU ON MPB.id_unit = MU.id_unit
            WHERE MPB.id_unit = '" . $id_unit . "'
					";
			
		$query = $this->dbsupp->query($sql);
		$rs    = $query->row();
			
		if ($query->num_rows() > 0) {
			return $rs;
		} else {
			return "";
		}
  }

  //Query Mapping Poli BPJS to RS
  public function poliBpjsToRs($kodepoli)
  {
    $sql ="	SELECT MPB.*, MU.name AS poli
            FROM mapping_poli_bpjs MPB
            LEFT JOIN mst_unit MU ON MPB.id_unit = MU.id_unit
            WHERE MPB.kode_poli = '" . $kodepoli . "'
					";
			
		$query = $this->dbsupp->query($sql);
		$rs    = $query->row();
			
		if ($query->num_rows() > 0) {
			return $rs;
		} else {
			return "";
		}
  }

  //Query JAdwal Dokter by Id_dokter
  public function get_jadwal_byid($id_dokter) {
    $sql =" SELECT  a.*
            FROM `mst_dokter_jwp` a
            WHERE a.`id_dokter`='" . $id_dokter . "'
          ";
    //echo $sql;
    $query = $this->dbhis->query($sql);
    $rs    = $query->result_array();
    return $rs;
  }

  function cekLogService($kodebooking, $taskid) {
    $sql = "SELECT a.*
            FROM  antrol_antrian_task_log a
            WHERE a.kodebooking  ='" . $kodebooking . "'
            AND  a.taskid  ='" . $taskid . "'
            AND a.status = 200
          ";
    $query = $this->dbsupp->query($sql);
    $rs = $query->num_rows();
    return $rs;
  }

  public function storeLogService($kodebooking, $service, $taskid, $status, $message)
  {
    if($status == 200 || $status == ''){
      date_default_timezone_set('Asia/Jakarta');
      $time = date('Y-m-d H:i:s');

      $data = array(
        'service'     => $service,
        'kodebooking' => $kodebooking,
        'taskid'      => $taskid,
        'status'      => $status,
        'message'     => $message,
        'time'        => $time
      );

      $this->dbsupp->insert('antrol_antrian_task_log',$data);
    }
  }

  public function estimasiDilayani($kodebooking, $taskid)
  {
    $date             = date('Y-m-d H:i:s');
    $stamp            = strtotime($date);
    $second           = $stamp * 1000;
    $estimasidilayani = number_format($second, 0, '.', '');

    return $estimasidilayani;
  }

  public function getRegByKodebooking($kodebooking)
  {
    $sql = "SELECT tr.*, trb.*
            FROM trx_reg tr 
            left join trx_reg_book trb on tr.id_reg = trb.id_reg 
            WHERE trb.id_trx = '" . $kodebooking . "'
          ";
    $query = $this->dbsupp->query($sql);
    $rs = $query->row();
    return $rs;
  }




}