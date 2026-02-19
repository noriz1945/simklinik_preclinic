<?php
class Jasmed extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_jasmed');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }

    function index(){
        $iddate_range_1   = $this->input->get('date1');
        $iddate_range_2   = $this->input->get('date2');
        $iddokter         = $this->input->get('iddokter');
        $idwaktudokter    = $this->input->get('jnswktdokter');
        $idjabatan        = $this->input->get('jabatanids');
        $idspesialis      = $this->input->get('spesialisids');
        $idtindakan       = $this->input->get('tindakanids'); 
        $idlayanan        = $this->input->get('layananids'); 
        $idpenjamin       = $this->input->get('penjaminids'); 



        //query add nyah
        if (isset($iddate_range_1)) {
            if($iddate_range_1==null){
                $date_range_1_set = date('Y-m-d');
            }else{
                $date_range_1_set = $iddate_range_1;
            }
            $date_range_1 = $date_range_1_set;
        } else {  $date_range_1 = date('Y-m-d');;} 

        if (isset($iddate_range_2)) {
            if($iddate_range_2==null){
                $date_range_2_set = date('Y-m-d');
            }else{
                $date_range_2_set = $iddate_range_2;
            }
            $date_range_2 = $date_range_2_set;
        } else {  $date_range_2 = date('Y-m-d');} 

        if (isset($idspesialis)) {
            if($idspesialis=='0'){
                $spesialisdokter_set = "";
            }else{
                $spesialisdokter_set = "AND c.id_spes='".$idspesialis."'";
            }
            $spesialisdokter = $spesialisdokter_set;
        } else {  $spesialisdokter = ""; } 
        
        if (isset($idtindakan)) {
            if($idtindakan=='0'){
                $tindakandokter_set = "";
            }else{
                $tindakandokter_set = "AND a.id_reg_act='".$idtindakan."'";
            }
            $tindakandokter = $tindakandokter_set;
        } else {  $tindakandokter = "";} 

        if (isset($idpenjamin)) {
            if($idpenjamin=='0'){
                $penjaminnya_set = "";
            }else{
                $penjaminnya_set = "AND e.id_asuransi='".$idpenjamin."'";
            }
            $penjaminnya = $penjaminnya_set;
        } else {  $penjaminnya = "";} 

        if (isset($iddokter)) {
            if($iddokter=='0'){
                $iddokter_set = "";
            }else{
                $iddokter_set = "AND a.id_dokter='".$iddokter."'";
            }
            $iddokter = $iddokter;
        } else { $iddokter = "";} 
        //end query add nyah

       
        $spesialis  = $this->D_jasmed->mspesialis();
        $tindakan   = $this->D_jasmed->mtindakan();
        $penjamin   = $this->D_jasmed->mpenjamin();
        $dokter     = $this->D_jasmed->mdokter();
        $jasmed     = $this->D_jasmed->mjasmed($date_range_1, $date_range_2, $iddokter_set, $spesialisdokter, $tindakandokter, $penjaminnya);

        $data = array(
            'jasmed'         => $jasmed,
            'spesialis'      => $spesialis,
            'tindakan'       => $tindakan,
            'penjamin'       => $penjamin,
            'dokter'         => $dokter,
            'date_range_1'   => $date_range_1,
            'date_range_2'   => $date_range_2,
            'iddokter'       => $iddokter,
            'idwaktudokter'  => $idwaktudokter,
            'idjabatan'      => $idjabatan,
            'idspesialis'    => $idspesialis,
            'idtindakan'     => $idtindakan,
            'idlayanan'      => $idlayanan,
            'idpenjamin'     => $idpenjamin
        ); 

        $this->load->view('list_jasmed', $data);
    }    

    function settarif(){
        $datetime = DATE('Y-m-d H:i:s');
        $namatind =  $this->input->post('dt_namatindakan');
        
        $dt_idtindakan 	   =  $this->input->post('dt_idtindakan');
        $dt_idcarabayar    =  $this->input->post('dt_idcarabayar');
        $dt_jasmedpersen   =  $this->input->post('dt_jasmedpersen');
        $dt_jasmednominal  =  $this->input->post('dt_jasmednominal');
        $dt_jeniswaktuid   =  $this->input->post('dt_jeniswaktuid');
        $dt_jbnid          =  $this->input->post('dt_jbnid');
        $dt_insid          =  $this->input->post('dt_insid');
        if($dt_jeniswaktuid==0){
            $idjnswkt = "Paruh Waktu";
        }else{
            $idjnswkt = "Purnah Waktu";
        }
        $dt_mode 		       =  $this->input->post('dt_mode');
        $dt_note 		       =  $this->input->post('dt_note');

        $dt_persen1 		   =  $this->input->post('dt_persen1');
        $dt_persen2 		   =  $this->input->post('dt_persen2');

        $sqlrm2       = $this->D_jasmed->datafnddata($dt_idtindakan, $dt_idcarabayar, $idjnswkt, $dt_jbnid, $dt_insid);
        $fnddata      = $sqlrm2->fnddata;
        
        if($fnddata > 0){
         $update="UPDATE z_jasmed_m SET jenistarif_id = '$dt_idcarabayar', jasmed_persen = '$dt_jasmedpersen', jasmed_nominal = '$dt_jasmednominal', mode='$dt_mode', note='$dt_note', datetime_update='$datetime', persen_1='$dt_persen1', persen_2='$dt_persen2' WHERE daftartindakan_id = '$dt_idtindakan' AND jenistarif_id='$dt_idcarabayar' AND jeniswaktukerja='$idjnswkt' AND idjabatan='$dt_jbnid' AND idlayanan='$dt_insid'";
         $this->db2->query($update);
        }else{
         $insert="INSERT INTO z_jasmed_m (daftartindakan_id,jenistarif_id,mode,jasmed_persen,jasmed_nominal,note,jeniswaktukerja,idjabatan,idlayanan,persen_1,persen_2,datetime_insert) VALUES ('$dt_idtindakan','$dt_idcarabayar','$dt_mode','$dt_jasmedpersen','$dt_jasmednominal','$dt_note','$idjnswkt','$dt_jbnid','$dt_insid','$dt_persen1','$dt_persen2','$datetime')";
         $this->db2->query($insert);
        }

    }
}
?>