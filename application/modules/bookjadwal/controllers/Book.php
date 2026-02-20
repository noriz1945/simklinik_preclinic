<?php
class Book extends MX_controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('D_Mst');
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->library('encryption');
  }
  function escape($text)
  {
    return str_replace(array(","), array(""), $text);
  }


  ////////////////////////////////////////////////////////////////////////////////////////////////////////////USED
  function index()
  {
    $this->load->view('book');
  }


  function calendarfnc(){ //id_unit,id_dokter,id_bulan
    $id_unit    = $this->input->post('id_unit');
    $id_dokter  = $this->input->post('id_dokter');
    $id_bulan   = $this->input->post('id_bulan');
    $datalist   = $this->D_Mst->setcalendar($id_unit,$id_dokter,$id_bulan);
    $dataset    = json_encode($datalist);
    echo $dataset;
  }

  function slotset(){
    $tanggal    = $this->input->post('set_tglslot');
    $totalslot  = $this->input->post('totalslotnyah');
    $time_start = $this->input->post('timestartnyah');
    $time_ends  = $this->input->post('timeendnyah');
    $durasi     = $this->input->post('durasinyah');
    
    $datalist       = $this->D_Mst->setslot($tanggal,$totalslot,$time_start,$time_ends,$durasi);
    $dataset = json_encode($datalist);
    echo $dataset;
  }

  function slotsetlistcheckin(){
    $tanggal    = $this->input->post('set_tglslot');
    $datalist       = $this->D_Mst->setslotcheckin($tanggal);
    $dataset = json_encode($datalist);
    echo $dataset;
  }

  function caridetailjadwaldokter(){
    $dow        = $this->input->post('id_dow');
    $id_dokter  = $this->input->post('id_dokter');
    $datalist   = $this->D_Mst->setdetailjadwaldokter($dow,$id_dokter);
    $dataset    = json_encode($datalist);
    echo $dataset;
  }

  function mst_unit(){
		$dataset    = $this->D_Mst->mst_unit();
		echo json_encode($dataset);
	}


  function mst_dokter(){
    $id_unit    = $this->input->post('id_unit');
		$dataset    = $this->D_Mst->mst_dokter($id_unit);
		echo json_encode($dataset);
	}

  //test bakal api
  function testgetslotbook(){ //tinggal set parameter nya aja
    echo "Proses API buat get slot booking untuk Mobile JKN <br>";
    /*echo "<br> 1 --> ".*/$tanggal       = "2024-12-16";
    /*echo "<br> 2 --> ".*/$id_dokter     = "001";
    /*echo "<br> 3 --> ".*/$dow           = $this->getdownya($tanggal); // returns 4
    $checkdatadow  = $this->D_Mst->setdetailjadwaldokter($dow,$id_dokter);
    /*echo "<br> 4 --> ".*/$durasiset     = $checkdatadow->durasi;
    /*echo "<br> 5 --> ".*/$start         = $checkdatadow->time_start;
    /*echo "<br> 6 --> ".*/$end           = $checkdatadow->time_end;

    /*echo "<br> 7 --> ".*/$totaljam      = abs($start - $end);
    /*echo "<br> 8 --> ".*/$totalmenit    = ($totaljam)*60;
    /*echo "<br> 9 --> ".*/$totaljamslot  = $totalmenit/$durasiset;
    /*echo "<br> 10 --> ".*/$totalslotnyah = abs($totaljamslot);

    /*echo "<br> 11 --> ".*/$totalslot    = $totalslotnyah;
    /*echo "<br> 12 --> ".*/$time_start   = $start;
    /*echo "<br> 13 --> ".*/$time_ends    = $end;
    /*echo "<br> 14 --> ".*/$durasi       = $durasiset;
    $set_jam_slot = array(); 
    $datalist     = $this->D_Mst->setslot_api($tanggal,$totalslot,$time_start,$time_ends,$durasi);
    /*foreach($datalist as $set => $val){
      if($datalist[$set]['slot']==0){
        //echo "<br> ==> ".$set.";".$datalist[$set]['jam_slot'].";".$datalist[$set]['slot'];
        //echo "<br> ==> Slot Tersedia : ".$set." => ".$datalist[$set]['jam_slot'];
        //$set_jam_slot = $datalist[$set]['jam_slot'];
        //break;
      }else{
        //nothing
      }
      if($datalist[$set]['slot']==0){
          $tersedia="Kosong";
      }else{
          $tersedia="________________________Kebooking";
      }
      echo "<br> ==> Slot Tersedia : ".$set." => ".$datalist[$set]['jam_slot']."----> ".$tersedia."- ".$datalist[$set]['slot'];
      }*/

    foreach($datalist as $set => $val){
      if($datalist[$set]['slot']==0){
        //echo "<br> ==> ".$set.";".$datalist[$set]['jam_slot'].";".$datalist[$set]['slot'];
        //echo "<br> ==> Slot Tersedia : ".$set." => ".$datalist[$set]['jam_slot'];
        $set_jam_slot = "Slot nya --> ".$set." ; Jam Slot nya --> ".$datalist[$set]['jam_slot']." ; Tanggal Slot nya --> ".$tanggal;

        $set_no_slot_from_array = $set;
        $set_jam_slot_from_array = $datalist[$set]['jam_slot'];
        $set_tgl_slot_from_array = $tanggal;

        break;
      }else{
        //nothing
      }
      
    }
    //echo "<br><br><br> Slot ke ambil ==> ".$set_jam_slot;

    $set_ini_no_slot      = $set_no_slot_from_array;
    $set_ini_jam_slot     = $set_jam_slot_from_array;
    $set_ini_tgl_slot     = $set_tgl_slot_from_array;

    echo "<br> ".$set_ini_no_slot." --> ".$set_ini_jam_slot." --> ".$set_ini_tgl_slot;
    $this->settoholding_for_api($set_ini_no_slot,$set_ini_jam_slot,$set_ini_tgl_slot);
    
    //echo json_encode($datalist);

    //Insert to trx_book_antrian
    $slot           = $set_ini_no_slot;
    $jam_slot       = $set_ini_jam_slot;
    $id_pasien      = "0";
    $id_dokter_set  = $id_dokter;
    $datetime       = date('Y-m-d H:i:s');

    $datains = array(
      'slot'          => $slot,
      'jam_slot'      => $jam_slot,
      'tanggal'       => $set_ini_tgl_slot,
      'id_pasien'     => $id_pasien,
      'id_dokter'     => $id_dokter_set,
      'created'       => $datetime
    );

    //nyalain ini buat insert ke trx_book_antrian
    //$this->D_Mst->ins1($datains,'trx_book_antrian');

    //$datalist = "OK";
    //$dataset = json_encode($datalist);
    //echo $dataset;
    //End insert to trx_book_antrian
  }
  //end test bakal api

  //fungsi holding
  function settoholding_for_api($set_ini_no_slot,$set_ini_jam_slot,$set_ini_tgl_slot){
    $set_no_slot      = $set_ini_no_slot;
    $set_jam_slot     = $set_ini_jam_slot;
    $set_tgl_slot     = $set_ini_tgl_slot;
    $datetime         = date('Y-m-d H:i:s');
    $datetime_for_exp = date('Y-m-d H:i:s');
    $datetime_exp     = strtotime($datetime_for_exp.' + 1 minute');
    $expired_date     = date('Y-m-d H:i:s', $datetime_exp);

    $dataset_expired  = $this->D_Mst->check_slot_holding_expired($set_no_slot,$set_jam_slot,$set_tgl_slot);
    $check_expired    = $dataset_expired->expired;

    if($check_expired==null){
      $dataset          = $this->D_Mst->check_slot_holding($set_no_slot,$set_jam_slot,$set_tgl_slot);
      $check_available  = $dataset->holding;
    }else{
      
      if($datetime_for_exp > $check_expired){
        $this->D_Mst->check_slot_holding_delete($set_no_slot,$set_jam_slot,$set_tgl_slot);
        $dataset          = $this->D_Mst->check_slot_holding($set_no_slot,$set_jam_slot,$set_tgl_slot);
        $check_available  = $dataset->holding;
      }else{
        $dataset          = $this->D_Mst->check_slot_holding($set_no_slot,$set_jam_slot,$set_tgl_slot);
        $check_available  = $dataset->holding;
      }
    }
    /*echo "<br> -->>>>>> check = ".*/$check_available;
    if($check_available==0){
      $datains = array(
        'slot'          => $set_no_slot,
        'jam_slot'      => $set_jam_slot,
        'tanggal'       => $set_tgl_slot,
        'type'          => 1,
        'created'       => $datetime,
        'expired'       => $expired_date
      );
  
      $this->D_Mst->ins1($datains,'trx_book_holding');
      /*trx_book_holding dr external di bypass aja langsung ke trx_reg_book, tapi bkin fungsi check ke holding nya dlu untuk dapetin nomor slot berikut nya, contoh :
      jika ada slot yg terholding misalkan slot 8 jam 12:40 dari internal, kemudian yg dr external dateng maka slot nya akan teroper ke slot 9 jam 12:45 / yg terkecil 
      jika slot 10 jam 12:50 kosong, slot 11 jam 12:55 terisi maka saat ada eksekusi dari external / internal slot nya akan menggunakan yang slot 10 jam 12:50.*/
    }else{
      $check_available="ok";
    }

    return $check_available;
		
  }

  function settoholding(){
    $set_no_slot      = $this->input->post('setnoslot');
    $set_jam_slot     = $this->input->post('setjamslot');
    $set_tgl_slot     = $this->input->post('settglslot');
    $datetime         = date('Y-m-d H:i:s');
    $datetime_for_exp = date('Y-m-d H:i:s');
    $datetime_exp     = strtotime($datetime_for_exp.' + 1 minute');
    $expired_date     = date('Y-m-d H:i:s', $datetime_exp);

    $dataset_expired  = $this->D_Mst->check_slot_holding_expired($set_no_slot,$set_jam_slot,$set_tgl_slot);
    $check_expired    = $dataset_expired->expired;

    if($check_expired==null){
      $dataset          = $this->D_Mst->check_slot_holding($set_no_slot,$set_jam_slot,$set_tgl_slot);
      $check_available  = $dataset->holding;
    }else{
      
      if($datetime_for_exp > $check_expired){
        $this->D_Mst->check_slot_holding_delete($set_no_slot,$set_jam_slot,$set_tgl_slot);
        $dataset          = $this->D_Mst->check_slot_holding($set_no_slot,$set_jam_slot,$set_tgl_slot);
        $check_available  = $dataset->holding;
      }else{
        $dataset          = $this->D_Mst->check_slot_holding($set_no_slot,$set_jam_slot,$set_tgl_slot);
        $check_available  = $dataset->holding;
      }
    }

    if($check_available==0){
      echo json_encode($dataset);
      $datains = array(
        'slot'          => $set_no_slot,
        'jam_slot'      => $set_jam_slot,
        'tanggal'       => $set_tgl_slot,
        'type'          => 0,
        'created'       => $datetime,
        'expired'       => $expired_date
      );
  
      $this->D_Mst->ins1($datains,'trx_book_holding');
    }else{
      $dataset="ok";
      echo json_encode($dataset);
    }

    /*
      1. jika slot di klik ngecek apakah sudah ada datanya di slot tsb dari tabel trx_book_holding
      2. jika 0 maka akan kirim data 0 dan menginsert data ke dalam tabel trx_book_holding dengan estimasi waktu expired nya
      3. jika ada user lain yg memilih slot yg sama, pertama akan mengecek apakah ada row datanya jika ada yg kedua mengecek waktu expired nya jika sudah expired
         row akan di hapus kemudian mengirim data 0 kemudian menginsert data ke dalam tabel trx_book_holding dengan expired yg baru
      4. jika ada user lain yang memilih slot yg sama, di form modal ada keterangan sedang di gunakan
      5. jika user menutup modal maka row yg dipilih akan terhapus, jika type nya 0 = internal akan terhapus, jika type nya 1 = external tidak bisa terhapus sebelum expired terhapus dari tabel trx_book_holding
      6. jika selesai aksi dari api / dari sistem internal data akan masuk ke trx_book_antrian maka sequence slot akan berlanjut
      7. jika selesai masuk ke trx_book_antrian lakukan peng hapusan row slot dari trx_book_holding (belum)

      ///telp terakhir : 

    */
		
  }

  function set_delete_holding_close_modal(){
    $set_no_slot      = $this->input->post('setnoslot');
    $set_jam_slot     = $this->input->post('setjamslot');
    $set_tgl_slot     = $this->input->post('settglslot');

    $dataset          = $this->D_Mst->check_slot_holding_type($set_no_slot,$set_jam_slot,$set_tgl_slot);
    $check_type       = $dataset->type;
    $check_expired    = $dataset->expired;
    if($check_type==1){
      $datetime_for_exp = date('Y-m-d H:i:s');
      if($datetime_for_exp > $check_expired){
        $this->D_Mst->check_slot_holding_delete($set_no_slot,$set_jam_slot,$set_tgl_slot);
        $dataset = "ok";
      }else{
        $dataset = "ok";
      }
    }else{
      $this->D_Mst->check_slot_holding_delete_close_modal($set_no_slot,$set_jam_slot,$set_tgl_slot);
      $dataset = "ok";
    }
    
    echo json_encode($dataset);
  }
  //end fungsi holding

  function getdownya($date) {
    // Konsisten dengan date('N'): Senin=1..Minggu=7
    $ts = strtotime($date);
    if(!$ts) return 0;
    return (int)date('N', $ts);
}

}
