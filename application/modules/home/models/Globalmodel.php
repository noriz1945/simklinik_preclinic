<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Globalmodel extends ci_model 
{

    function getdatapoliumum7($tgl_1){
        $query=$this->db->query("SELECT 
        -- COUNT(a.regdate) AS jumlah
        -- uji coba
        (SELECT COUNT(regdate) AS jumlah
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND DATE_FORMAT(a.regdate,'%Y-%m-%d')='$tgl_1' AND c.id_unit='001'
        GROUP BY DATE_FORMAT(NOW(),'%Y-%m-%d')) AS day_1,
        (SELECT COUNT(regdate) AS jumlah
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND DATE_FORMAT(a.regdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 1 DAY) AND c.id_unit='001'
        GROUP BY DATE_FORMAT(NOW(),'%Y-%m-%d')) AS day_2,
        (SELECT COUNT(regdate) AS jumlah
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND DATE_FORMAT(a.regdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 2 DAY) AND c.id_unit='001'
        GROUP BY DATE_FORMAT(NOW(),'%Y-%m-%d')) AS day_3,
        (SELECT COUNT(regdate) AS jumlah
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND DATE_FORMAT(a.regdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 3 DAY) AND c.id_unit='001'
        GROUP BY DATE_FORMAT(NOW(),'%Y-%m-%d')) AS day_4,
        (SELECT COUNT(regdate) AS jumlah
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND DATE_FORMAT(a.regdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 4 DAY) AND c.id_unit='001'
        GROUP BY DATE_FORMAT(NOW(),'%Y-%m-%d')) AS day_5,
        (SELECT COUNT(regdate) AS jumlah
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND DATE_FORMAT(a.regdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 5 DAY) AND c.id_unit='001'
        GROUP BY DATE_FORMAT(NOW(),'%Y-%m-%d')) AS day_6,
        (SELECT COUNT(regdate) AS jumlah
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND DATE_FORMAT(a.regdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 6 DAY) AND c.id_unit='001'
        GROUP BY DATE_FORMAT(NOW(),'%Y-%m-%d')) AS day_7
        -- end uji coba
        FROM trx_reg a
        LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
        LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
        WHERE a.is_reg_aps=0 AND b.name IS NOT NULL AND c.name IS NOT NULL AND c.id_unit='001'
        GROUP BY DATE_FORMAT(a.regdate,'%Y-%m-%d')
        LIMIT 1");
        return $query->result();
    }

  
 function getdatapenjualanobat($tgl_1){
    $query=$this->db->query("SELECT
    (SELECT SUM(a.subtotal) FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE DATE_FORMAT(b.eresepdate,'%Y-%m-%d')='$tgl_1' AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL) AS day_1,
    (SELECT SUM(a.subtotal) FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE DATE_FORMAT(b.eresepdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 1 DAY) AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL) AS day_2,
    (SELECT SUM(a.subtotal) FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE DATE_FORMAT(b.eresepdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 2 DAY) AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL) AS day_3,
    (SELECT SUM(a.subtotal) FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE DATE_FORMAT(b.eresepdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 3 DAY) AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL) AS day_4,
    (SELECT SUM(a.subtotal) FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE DATE_FORMAT(b.eresepdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 4 DAY) AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL) AS day_5,
    (SELECT SUM(a.subtotal) FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE DATE_FORMAT(b.eresepdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 5 DAY) AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL) AS day_6,
    (SELECT SUM(a.subtotal) FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE DATE_FORMAT(b.eresepdate,'%Y-%m-%d')=SUBDATE('$tgl_1', INTERVAL 6 DAY) AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL) AS day_7
    FROM soap_eresep_det 
    WHERE id_eresep IS NOT NULL
    LIMIT 1");
    return $query->row();
 }

 function getdatapoliumum7_range($tgl_1,$tgl_2)
 {
     $monyear = $tgl_2."-".$tgl_1; 
     $exp_monyear = explode("-",$monyear);
     $year = $exp_monyear[0];
     $mon = $exp_monyear[1];

     $query=$this->db->query("SELECT DATE_FORMAT(a.regdate,'%d') AS hari,COUNT(a.id_reg) AS jumlah
             FROM 	`trx_reg` a
             LEFT JOIN mst_dokter b ON a.id_dokter_prt1=b.id_dokter
             LEFT JOIN mst_unit c ON b.id_unit=c.id_unit 
             WHERE DATE_FORMAT(a.regdate,'%Y-%m')='$monyear' AND c.id_unit='001'
             GROUP BY DATE_FORMAT(a.regdate,'%d')
             ORDER BY DATE_FORMAT(a.regdate,'%d')");

     $data_poli = $query->result();
     $pre_data = array();
     foreach($data_poli as $k => $v)
     {
         $pre_data[$v->hari] = $v->jumlah;
     }		

     $data_respon = array(); 
     $last_date_of_month = $this->get_last_date_of_month($year,$mon);
     $data_respon[0] = 0;
     for($i=1;$i<=$last_date_of_month;$i++)
     {
         $data_respon[$i] = intval($pre_data[$i]);
     }
     return $data_respon;
 }

 function getdatapenjualanobat_range($tgl_1,$tgl_2)
 {
     $monyear = $tgl_2."-".$tgl_1; 
     $exp_monyear = explode("-",$monyear);
     $year = $exp_monyear[0];
     $mon = $exp_monyear[1];

     $query=$this->db->query("SELECT DATE_FORMAT(a.created,'%d') AS hari,SUM(a.subtotal) AS jumlah
             FROM soap_eresep_det a 
             LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep 
             WHERE DATE_FORMAT(b.eresepdate,'%Y-%m')='$monyear' AND a.is_validasi=1 AND a.status=0 AND a.id_inv IS NOT NULL GROUP BY DATE_FORMAT(b.eresepdate,'%Y-%m-%d')");

     $data_poli = $query->result();
     $pre_data = array();
     foreach($data_poli as $k => $v)
     {
         $pre_data[$v->hari] = $v->jumlah;
     }		

     $data_respon = array(); 
     $last_date_of_month = $this->get_last_date_of_month($year,$mon);
     $data_respon[0] = 0;
     for($i=1;$i<=$last_date_of_month;$i++)
     {
         $data_respon[$i] = intval($pre_data[$i]);
     }
     return $data_respon;
 }

 function get_last_date_of_month($year,$mon)
 {
     $tgl_input = $year."-".$mon."-1";
     // Converting string to date
     $date = strtotime($tgl_input);
     // Last date of current month.
     $lastdate = strtotime(date("Y-m-t", $date ));
     // Day of the last date 
     $day = date("d", $lastdate);
     return $day;
 }

}