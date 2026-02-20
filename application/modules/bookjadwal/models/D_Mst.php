<?php
class D_Mst extends ci_model
{

  function setcalendar($id_unit,$id_dokter,$id_bulan){
    $tahun    = date('Y');
    $monyear  = $tahun.'-'.$id_bulan; 
    $exp_monyear = explode("-",$monyear);
    $year = $exp_monyear[0];
    $mon = $exp_monyear[1];
    $last_date_of_month = $this->get_last_date_of_month($year,$mon);
    $end=$last_date_of_month;
    // Safer query with bindings for id_dokter and counting per dokter per tanggal
    $baseDate = $monyear.'-01';
    $sql = "SELECT x.d AS tanggal_slot, mc.tanggal_cuti,
                   (SELECT COUNT(*) FROM trx_reg_book rb WHERE rb.tanggal = x.d AND rb.id_dokter = ?) AS jumlah_book
            FROM (SELECT DATE_ADD(?, INTERVAL seq-1 DAY) AS d FROM seq_1_to_$end) x
            LEFT JOIN mst_dokter_cuti mc ON (mc.tanggal_cuti = x.d AND mc.id_dokter = ?)
            ORDER BY x.d ASC";
    $query=$this->db->query($sql, [$id_dokter, $baseDate, $id_dokter]);
    return $query->result();
  }

  function setslot($tanggal,$totalslot,$time_start,$time_ends,$durasi){

    $jumlahslot = $totalslot;

    $query=$this->db->query("SELECT a.*,b.*,c.name AS nama_dokter,d.name AS nama_asuransi
    FROM trx_reg_book a 
    LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien 
    LEFT JOIN mst_dokter c ON a.id_dokter=c.id_dokter
    LEFT JOIN mst_company d ON a.id_asuransi=d.id_company
    WHERE a.tanggal=? 
    GROUP BY a.slot 
    ORDER BY a.slot", [$tanggal]); //SAMAIN KAYA QUERY DI ATAS NYA YG di fungsi setcalendar

    $data_poli = $query->result();
    $pre_data = array();
    $set_tanggal_book = array();
    $set_nama_book = array();
    $set_nama_dokter_book = array();
    foreach($data_poli as $k => $v)
    {

        $pre_data[$v->slot]               = $v->slot;
        $set_tanggal_book[$v->slot]       = $v->tanggal;
        $set_nama_book[$v->slot]          = $v->name;
        $set_nama_dokter_book[$v->slot]   = $v->nama_dokter;
        $set_nama_asurasi[$v->slot]       = $v->nama_asuransi;
        $set_diag[$v->slot]               = $v->diag;
        $set_note[$v->slot]               = $v->note;
        //$pre_data[$v->slot] = $dayFrom;
    }		

    //create divide time
    $time_start_after_divide = new DateTime($tanggal.' '.$time_start);
    $time_start_after_divide->sub(new DateInterval('P0DT0H'.$durasi.'M'));
    $after_process = $time_start_after_divide->format('H:i:s');

    //echo $after_process;


    $begin = new DateTime($tanggal.' '.$after_process);
    $end = new DateTime($tanggal.' '.$time_ends);
    
    $timeRanges = [];
    while($begin < $end) {
    
        $output = $begin->format('H:i');
        $begin->modify('+'.$durasi.' minutes');          /** Note, it modifies time by 15 minutes */
        //$output .= $begin->format('H:i');
    
        $timeRanges[] = $output;
    }
    
    //print_r($timeRanges);
   //end create divide time



    $data_respon = array(); 
    //$data_respon[0] = 0;
    for($i=1;$i<=$jumlahslot;$i++)
    {
        $data_respon[$i]['slot'] = intval($pre_data[$i]); 
        $data_respon[$i]['jam_slot'] = $timeRanges[$i];
        $data_respon[$i]['tanggal_book'] = $set_tanggal_book[$i];
        $data_respon[$i]['name_book'] = $set_nama_book[$i];
        $data_respon[$i]['name_dokter'] = $set_nama_dokter_book[$i];
        $data_respon[$i]['asuransi'] = $set_nama_asurasi[$i];
        $data_respon[$i]['diag'] = $set_diag[$i];
        $data_respon[$i]['note'] = $set_note[$i];
        
    }
    return $data_respon;
  }

  function setslotcheckin($tanggal){

    $query=$this->db->query("SELECT a.*,b.*,c.name AS nama_dokter,d.name AS nama_asuransi
    FROM trx_reg_book a 
    LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien 
    LEFT JOIN mst_dokter c ON a.id_dokter=c.id_dokter
    LEFT JOIN mst_company d ON a.id_asuransi=d.id_company
    WHERE a.tanggal=?
    GROUP BY a.slot 
    ORDER BY a.slot", [$tanggal]);
     return $query->result();
  }


  function setdetailjadwaldokter($dow,$id_dokter){
    $query=$this->db->query("SELECT * FROM mst_dokter_jadwal_praktek WHERE id_dokter=? AND id_dow=?", [$id_dokter, $dow]);
    return $query->row();
  }

  function get_last_date_of_month($year,$mon){
    $tgl_input = $year."-".$mon."-1";
    // Converting string to date
    $date = strtotime($tgl_input);
    // Last date of current month.
    $lastdate = strtotime(date("Y-m-t", $date ));
    // Day of the last date 
    $day = date("d", $lastdate);
    return $day;
  }

  function mst_unit(){
    $query=$this->db->query("SELECT * FROM mst_dokter_spec WHERE aktif='1' ORDER BY id_spes ASC");
    return $query->result();
  }

  function mst_dokter($id_unit){
		$query=$this->db->query("SELECT * FROM mst_dokter WHERE id_spes=? AND aktif='1' ORDER BY name ASC", [$id_unit]);
		return $query->result();
	}

  function setslot_api($tanggal,$totalslot,$time_start,$time_ends,$durasi){

    /*echo "xxxxxxxxxxxxxxx-> ".*/$jumlahslot = $totalslot;

    $query=$this->db->query("SELECT a.*,b.*,c.name AS nama_dokter 
    FROM trx_reg_book a 
    LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien 
    LEFT JOIN mst_dokter c ON a.id_dokter=c.id_dokter 
    WHERE a.tanggal=? 
    GROUP BY a.slot 
    ORDER BY a.slot", [$tanggal]); //SAMAIN KAYA QUERY DI ATAS NYA YG di fungsi setcalendar

    $data_poli = $query->result();
    $pre_data = array();
    $set_tanggal_book = array();
    $set_nama_book = array();
    $set_nama_dokter_book = array();
    foreach($data_poli as $k => $v)
    {

        $pre_data[$v->slot]             = $v->slot;
        $set_tanggal_book[$v->slot]     = $v->tanggal;
        $set_nama_book[$v->slot]        = $v->name;
        $set_nama_dokter_book[$v->slot]        = $v->nama_dokter;
        //$pre_data[$v->slot] = $dayFrom;
    }		

    //create divide time
    $time_start_after_divide = new DateTime($tanggal.' '.$time_start);
    $time_start_after_divide->sub(new DateInterval('P0DT0H'.$durasi.'M'));
    $after_process = $time_start_after_divide->format('H:i:s');

    //echo $after_process;


    $begin = new DateTime($tanggal.' '.$after_process);
    $end = new DateTime($tanggal.' '.$time_ends);
    
    $timeRanges = [];
    while($begin < $end) {
    
        $output = $begin->format('H:i');
        $begin->modify('+'.$durasi.' minutes');          /** Note, it modifies time by 15 minutes */
        //$output .= $begin->format('H:i');
    
        $timeRanges[] = $output;
    }
    
    //print_r($timeRanges);
   //end create divide time



    $data_respon = array(); 
    //$data_respon[0] = 0;
    for($i=1;$i<=$jumlahslot;$i++)
    {
        $data_respon[$i]['slot'] = intval($pre_data[$i]); 
        $data_respon[$i]['jam_slot'] = $timeRanges[$i];
        $data_respon[$i]['tanggal_book'] = $set_tanggal_book[$i];
        $data_respon[$i]['name_book'] = $set_nama_book[$i];
        $data_respon[$i]['name_dokter'] = $set_nama_dokter_book[$i];
        //$data_respon[$i]['slot'] = intval($pre_data[$i+1]);
        
    }
    return $data_respon;
  }

  function check_slot_holding($set_no_slot,$set_jam_slot,$set_tgl_slot){
		$query=$this->db->query("SELECT COUNT(*) AS holding FROM trx_book_holding WHERE slot=? AND jam_slot=? AND tanggal=?", [$set_no_slot, $set_jam_slot, $set_tgl_slot]);
		return $query->row();
	}

  function check_slot_holding_type($set_no_slot,$set_jam_slot,$set_tgl_slot){
		$query=$this->db->query("SELECT type,expired FROM trx_book_holding WHERE slot=? AND jam_slot=? AND tanggal=?", [$set_no_slot, $set_jam_slot, $set_tgl_slot]);
		return $query->row();
	}

  function check_slot_holding_expired($set_no_slot,$set_jam_slot,$set_tgl_slot){
		$query=$this->db->query("SELECT expired FROM trx_book_holding WHERE slot=? AND jam_slot=? AND tanggal=? ORDER BY created DESC", [$set_no_slot, $set_jam_slot, $set_tgl_slot]);
		return $query->row();
	}

  function check_slot_holding_delete($set_no_slot,$set_jam_slot,$set_tgl_slot){
		$this->db->where(['slot'=>$set_no_slot,'jam_slot'=>$set_jam_slot,'tanggal'=>$set_tgl_slot]);
		$this->db->delete('trx_book_holding');
	}

  function check_slot_holding_delete_close_modal($set_no_slot,$set_jam_slot,$set_tgl_slot){
		$this->db->where(['slot'=>$set_no_slot,'jam_slot'=>$set_jam_slot,'tanggal'=>$set_tgl_slot]);
		$this->db->delete('trx_book_holding');
	}


  function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }
  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }
} 
?>
