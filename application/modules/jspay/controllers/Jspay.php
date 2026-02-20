<?php
class Jspay extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_jasmed');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
    }

    function index(){
        $iddate_range_1   = $this->input->get('date1');
        $iddate_range_2   = $this->input->get('date2');
        $iddokter         = $this->input->get('iddokter');
        $idspesialis      = $this->input->get('spesialisids');
        $idtindakan       = $this->input->get('tindakanids'); 
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
        $jasmed     = $this->D_jasmed->mjasmed($date_range_1, $date_range_2, $iddokter_set);

        $data = array(
            'jasmed'         => $jasmed,
            'spesialis'      => $spesialis,
            'tindakan'       => $tindakan,
            'penjamin'       => $penjamin,
            'dokter'         => $dokter,
            'date_range_1'   => $date_range_1,
            'date_range_2'   => $date_range_2,
            'iddokter'       => $iddokter,
            'idspesialis'    => $idspesialis,
            'idtindakan'     => $idtindakan,
            'idpenjamin'     => $idpenjamin
        ); 

        $this->load->view('list_jasmed', $data);
    }    

    function datajasmedforjspay(){
        $iddate_range_1   = $this->input->post('date1');
        $iddate_range_2   = $this->input->post('date2');
        $iddokter         = $this->input->post('iddokter');
        $idspesialis      = $this->input->post('spesialisids');
        $idtindakan       = $this->input->post('tindakanids'); 
        $idpenjamin       = $this->input->post('penjaminids'); 



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

        $data     = $this->D_jasmed->mjasmed($date_range_1, $date_range_2, $iddokter_set);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function datajasmedforjspay_doneset(){
        $iddate_range_1   = $this->input->post('date1');
        $iddate_range_2   = $this->input->post('date2');
        $iddokter         = $this->input->post('iddokter');
        $idspesialis      = $this->input->post('spesialisids');
        $idtindakan       = $this->input->post('tindakanids'); 
        $idpenjamin       = $this->input->post('penjaminids'); 



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

        $data     = $this->D_jasmed->mjasmed_doneset($date_range_1, $date_range_2, $iddokter_set);
        $datasend = json_encode($data);
        echo $datasend;
    }

    //selection jspay
    function setjspay(){
        $datetime   = DATE('Y-m-d H:i:s');
        $periode    = DATE('Y-m');
        $dt_idtrx_from_list =  $this->input->post('dt_idtrx');
        $date_range_1       =  $this->input->post('date1');
        $date_range_2       =  $this->input->post('date2');


        $checktrxregfrom    = $this->D_jasmed->datafnddata($dt_idtrx_from_list);
        $fnddata            = $checktrxregfrom->fnddata;

        $retrievedatatrxregact    = $this->D_jasmed->dataretregact($dt_idtrx_from_list);
        $set_id_trx               = $retrievedatatrxregact->id_trx;
        $set_id_reg               = $retrievedatatrxregact->id_reg;
        $set_trxdate              = $retrievedatatrxregact->trxdate;
        $set_id_reg_act           = $retrievedatatrxregact->id_reg_act;
        $set_id_type              = $retrievedatatrxregact->id_type;
        $set_id_kamar             = $retrievedatatrxregact->id_kamar;
        $set_id_kelas             = $retrievedatatrxregact->id_kelas;
        $set_id_dokter            = $retrievedatatrxregact->id_dokter;
        $set_id_group_act         = $retrievedatatrxregact->id_group_act;
        $set_id_unit              = $retrievedatatrxregact->id_unit;
        $set_name                 = $retrievedatatrxregact->name;
        $set_qty                  = $retrievedatatrxregact->qty;
        $set_price                = $retrievedatatrxregact->price;
        $set_disc_p               = $retrievedatatrxregact->disc_p;
        $set_disc_m               = $retrievedatatrxregact->disc_m;
        $set_is_mdisc             = $retrievedatatrxregact->is_mdisc;
        $set_mdisctype            = $retrievedatatrxregact->mdisctype;
        $set_mdiscexp             = $retrievedatatrxregact->mdiscexp;
        $set_total                = $retrievedatatrxregact->total;
        $set_price_nc             = $retrievedatatrxregact->price_nc;
        $set_price_cs             = $retrievedatatrxregact->price_cs;
        $set_qty_paket            = $retrievedatatrxregact->qty_paket;
        $set_qty_ext              = $retrievedatatrxregact->qty_ext;
        $set_price_ext            = $retrievedatatrxregact->price_ext;
        $set_disc_ext_p           = $retrievedatatrxregact->disc_ext_p;
        $set_disc_ext_m           = $retrievedatatrxregact->disc_ext_m;
        $set_total_ext            = $retrievedatatrxregact->total_ext;
        $set_ref                  = $retrievedatatrxregact->ref;
        $set_id_ref               = $retrievedatatrxregact->id_ref;
        $set_no_foto              = $retrievedatatrxregact->no_foto;
        $set_dokter_krm           = $retrievedatatrxregact->dokter_krm;
        $set_id_dokter_rad        = $retrievedatatrxregact->id_dokter_rad;
        $set_rad                  = $retrievedatatrxregact->rad;
        $set_is_cito              = $retrievedatatrxregact->is_cito;
        $set_is_paket             = $retrievedatatrxregact->is_paket;
        $set_is_outpaket          = $retrievedatatrxregact->is_outpaket;
        $set_id_tpkp              = $retrievedatatrxregact->id_tpkp;
        $set_is_inc               = $retrievedatatrxregact->is_inc;
        $set_is_srv               = $retrievedatatrxregact->is_srv;
        $set_id_form              = $retrievedatatrxregact->id_form;
        $set_id_mod               = $retrievedatatrxregact->id_mod;
        $set_id_rad               = $retrievedatatrxregact->id_rad;
        $set_id_inv               = $retrievedatatrxregact->id_inv;
        $set_hddstatus            = $retrievedatatrxregact->hddstatus;
        $set_total_hdd            = $retrievedatatrxregact->total_hdd;
        $set_hddsetdate           = $retrievedatatrxregact->hddsetdate;
        $set_cancel               = $retrievedatatrxregact->cancel;
        $set_canceldate           = $retrievedatatrxregact->canceldate;
        $set_cancel_uid           = $retrievedatatrxregact->cancel_uid;
        $set_is_select            = $retrievedatatrxregact->is_select;
        $set_created              = $datetime;
        $set_creator              = "Admin";
        
        if($fnddata > 0){
         $set_updated              = $datetime;
         $set_updater              = "Admin";
         $jsrespon = " Tindakan ".$set_name." sudah di set";
         //$updsetjspay="UPDATE trx_reg_jspay SET updated = '$set_updated', updater = '$set_updater'  WHERE id_trx_from_reg_act = '$dt_idtrx_from_list'";
         //$updsetjspay="DELETE FROM trx_reg_jspay WHERE id_trx_from_reg_act = '$dt_idtrx_from_list'";
         //$this->db2->query($updsetjspay);
        }else{
         $jsrespon = " ".$set_name;
         $inssetjspay="INSERT INTO trx_reg_jspay (id_trx_from_reg_act,id_reg,trxdate,id_reg_act,id_type,id_kamar,id_kelas,id_dokter,id_group_act,id_unit,name,qty,price,disc_p,disc_m,is_mdisc,mdisctype,mdiscexp,total,price_nc,price_cs,qty_paket,qty_ext,price_ext,disc_ext_p,disc_ext_m,total_ext,ref,id_ref,no_foto,dokter_krm,id_dokter_rad,rad,is_cito,is_paket,is_outpaket,id_tpkp,is_inc,is_srv,id_form,id_mod,id_rad,id_inv,hddstatus,total_hdd,hddsetdate,cancel,canceldate,cancel_uid,is_select,date_p1,date_p2,periode,created,creator) VALUES 
         ('$set_id_trx','$set_id_reg','$set_trxdate','$set_id_reg_act','$set_id_type','$set_id_kamar','$set_id_kelas','$set_id_dokter','$set_id_group_act','$set_id_unit','$set_name','$set_qty','$set_price','$set_disc_p','$set_disc_m','$set_is_mdisc','$set_mdisctype','$set_mdiscexp','$set_total','$set_price_nc','$set_price_cs','$set_qty_paket','$set_qty_ext','$set_price_ext','$set_disc_ext_p','$set_disc_ext_m','$set_total_ext','$set_ref','$set_id_ref','$set_no_foto','$set_dokter_krm','$set_id_dokter_rad','$set_rad','$set_is_cito','$set_is_paket','$set_is_outpaket','$set_id_tpkp','$set_is_inc','$set_is_srv','$set_id_form','$set_id_mod','$set_id_rad','$set_id_inv','$set_hddstatus','$set_total_hdd','$set_hddsetdate','$set_cancel','$set_canceldate','$set_cancel_uid','$set_is_select','$date_range_1','$date_range_2','$periode','$set_created','$set_creator')";
        $this->db2->query($inssetjspay);
        }

        $datasend=json_encode($jsrespon);
        echo $datasend;

    }

    function setalljasmed($date_range_1, $date_range_2, $iddokter){
        
        $setall     =  $this->input->post('setall1');
        $datetime   = DATE('Y-m-d H:i:s');
        $periode    = DATE('Y-m');
        
        foreach($setall as $k => $v){
       
        $dt_idtrx_from_list =  $v;
        
        $checktrxregfrom    = $this->D_jasmed->datafnddata($dt_idtrx_from_list);
        $fnddata            = $checktrxregfrom->fnddata;
        
        if($fnddata > 0){
         $jsrespon = "Update";
        }else{
         $jsrespon = "Insert";
         $retrievedatatrxregact    = $this->D_jasmed->dataretregact($dt_idtrx_from_list);
         $set_id_trx               = $retrievedatatrxregact->id_trx;
         $set_id_reg               = $retrievedatatrxregact->id_reg;
         $set_trxdate              = $retrievedatatrxregact->trxdate;
         $set_id_reg_act           = $retrievedatatrxregact->id_reg_act;
         $set_id_type              = $retrievedatatrxregact->id_type;
         $set_id_kamar             = $retrievedatatrxregact->id_kamar;
         $set_id_kelas             = $retrievedatatrxregact->id_kelas;
         $set_id_dokter            = $retrievedatatrxregact->id_dokter;
         $set_id_group_act         = $retrievedatatrxregact->id_group_act;
         $set_id_unit              = $retrievedatatrxregact->id_unit;
         $set_name                 = $retrievedatatrxregact->name;
         $set_qty                  = $retrievedatatrxregact->qty;
         $set_price                = $retrievedatatrxregact->price;
         $set_disc_p               = $retrievedatatrxregact->disc_p;
         $set_disc_m               = $retrievedatatrxregact->disc_m;
         $set_is_mdisc             = $retrievedatatrxregact->is_mdisc;
         $set_mdisctype            = $retrievedatatrxregact->mdisctype;
         $set_mdiscexp             = $retrievedatatrxregact->mdiscexp;
         $set_total                = $retrievedatatrxregact->total;
         $set_price_nc             = $retrievedatatrxregact->price_nc;
         $set_price_cs             = $retrievedatatrxregact->price_cs;
         $set_qty_paket            = $retrievedatatrxregact->qty_paket;
         $set_qty_ext              = $retrievedatatrxregact->qty_ext;
         $set_price_ext            = $retrievedatatrxregact->price_ext;
         $set_disc_ext_p           = $retrievedatatrxregact->disc_ext_p;
         $set_disc_ext_m           = $retrievedatatrxregact->disc_ext_m;
         $set_total_ext            = $retrievedatatrxregact->total_ext;
         $set_ref                  = $retrievedatatrxregact->ref;
         $set_id_ref               = $retrievedatatrxregact->id_ref;
         $set_no_foto              = $retrievedatatrxregact->no_foto;
         $set_dokter_krm           = $retrievedatatrxregact->dokter_krm;
         $set_id_dokter_rad        = $retrievedatatrxregact->id_dokter_rad;
         $set_rad                  = $retrievedatatrxregact->rad;
         $set_is_cito              = $retrievedatatrxregact->is_cito;
         $set_is_paket             = $retrievedatatrxregact->is_paket;
         $set_is_outpaket          = $retrievedatatrxregact->is_outpaket;
         $set_id_tpkp              = $retrievedatatrxregact->id_tpkp;
         $set_is_inc               = $retrievedatatrxregact->is_inc;
         $set_is_srv               = $retrievedatatrxregact->is_srv;
         $set_id_form              = $retrievedatatrxregact->id_form;
         $set_id_mod               = $retrievedatatrxregact->id_mod;
         $set_id_rad               = $retrievedatatrxregact->id_rad;
         $set_id_inv               = $retrievedatatrxregact->id_inv;
         $set_hddstatus            = $retrievedatatrxregact->hddstatus;
         $set_total_hdd            = $retrievedatatrxregact->total_hdd;
         $set_hddsetdate           = $retrievedatatrxregact->hddsetdate;
         $set_cancel               = $retrievedatatrxregact->cancel;
         $set_canceldate           = $retrievedatatrxregact->canceldate;
         $set_cancel_uid           = $retrievedatatrxregact->cancel_uid;
         $set_is_select            = $retrievedatatrxregact->is_select;
         $set_created              = $datetime;
         $set_creator              = "Admin";


        $inssetjspay="INSERT INTO trx_reg_jspay (id_trx_from_reg_act,id_reg,trxdate,id_reg_act,id_type,id_kamar,id_kelas,id_dokter,id_group_act,id_unit,name,qty,price,disc_p,disc_m,is_mdisc,mdisctype,mdiscexp,total,price_nc,price_cs,qty_paket,qty_ext,price_ext,disc_ext_p,disc_ext_m,total_ext,ref,id_ref,no_foto,dokter_krm,id_dokter_rad,rad,is_cito,is_paket,is_outpaket,id_tpkp,is_inc,is_srv,id_form,id_mod,id_rad,id_inv,hddstatus,total_hdd,hddsetdate,cancel,canceldate,cancel_uid,is_select,date_p1,date_p2,periode,created,creator) VALUES 
        ('$set_id_trx',
        '$set_id_reg','$set_trxdate','$set_id_reg_act','$set_id_type','$set_id_kamar','$set_id_kelas','$set_id_dokter','$set_id_group_act','$set_id_unit','$set_name','$set_qty','$set_price','$set_disc_p','$set_disc_m','$set_is_mdisc','$set_mdisctype','$set_mdiscexp','$set_total','$set_price_nc','$set_price_cs','$set_qty_paket','$set_qty_ext','$set_price_ext','$set_disc_ext_p','$set_disc_ext_m','$set_total_ext','$set_ref','$set_id_ref','$set_no_foto','$set_dokter_krm','$set_id_dokter_rad','$set_rad','$set_is_cito','$set_is_paket','$set_is_outpaket','$set_id_tpkp','$set_is_inc','$set_is_srv','$set_id_form','$set_id_mod','$set_id_rad','$set_id_inv','$set_hddstatus','$set_total_hdd','$set_hddsetdate','$set_cancel','$set_canceldate','$set_cancel_uid','$set_is_select','$date_range_1','$date_range_2','$periode','$set_created','$set_creator')";
        $this->db2->query($inssetjspay);
        }

        //echo "<br>".$jsrespon." >>> ".$inssetjspay;
           
        }//exit;
        redirect('jspay/?date1='.$date_range_1.'&date2='.$date_range_2.'&iddokter='.$iddokter);
    }
    //end selection jspay

    //proses jspay
    function setjspay_doneset(){
        $datetime = DATE('Y-m-d H:i:s');
        $dt_idtrx_from_list =  $this->input->post('dt_idtrx');

        $checktrxregfrom    = $this->D_jasmed->datafnddata($dt_idtrx_from_list);
        $fnddata            = $checktrxregfrom->fnddata;
        
         $updsetjspay="DELETE FROM trx_reg_jspay WHERE id_trx_from_reg_act = '$dt_idtrx_from_list'";
         $this->db2->query($updsetjspay);

        $datasend=json_encode($jsrespon);
        echo $datasend;

    }

    function setalljasmed_doneset($date_range_1, $date_range_2, $iddokter){
        $setall     =  $this->input->post('setall1_doneset');
        $datetime   = DATE('Y-m-d H:i:s');
        
        foreach($setall as $k => $v){
       
        $dt_idtrx_from_list =  $v;
        
        $updsetjspay="DELETE FROM trx_reg_jspay WHERE id_trx_from_reg_act = '$dt_idtrx_from_list'";
        $this->db2->query($updsetjspay);

        //echo "<br>".$jsrespon." >>> ".$inssetjspay;
           
        }//exit;
        redirect('jspay/?date1='.$date_range_1.'&date2='.$date_range_2.'&iddokter='.$iddokter);
    }
    //end proses 

    //proses final jspay
    function jasmedslipprc($date_range_1, $date_range_2, $iddokter){
        $row_1     =  $this->input->post('penghasilan_set');
        $row_2     =  $this->input->post('penghasilan_add_1_set');
        $row_3     =  $this->input->post('penghasilan_add_2_set');
        $row_4     =  $this->input->post('penghasilan_add_3_set');
        $row_5     =  $this->input->post('penghasilan_add_4_set');
        $row_6     =  $this->input->post('penghasilan_min_1_set');
        $row_7     =  $this->input->post('penghasilan_total_set');
        $row_8     =  $this->input->post('penghasilan_min_set');
        $row_9     =  $this->input->post('penghasilan_grand_set');
        $datetime  = DATE('Y-m-d H:i:s');
        $periode   = DATE('Y-m');

        $setfinal  = $this->D_jasmed->mjasmed_finset($date_range_1, $date_range_2, $iddokter);
        foreach($setfinal as $k => $v){
            $id_trx = $v->id_trx;
        
            $updsetjspay="UPDATE trx_reg_jspay SET is_final = '1', updated = '$datetime', updater = 'Admin'  WHERE id_trx = '$id_trx'";
            $this->db2->query($updsetjspay);

            //echo "<br>".$jsrespon." >>> ".$inssetjspay;
           
        }//exit;

        $inssetjspaydokter="INSERT INTO trx_jspay_dokter (id_dokter,date_1,date_2,periode,penghasilan_set,penghasilan_add_1_set,penghasilan_add_2_set,penghasilan_add_3_set,penghasilan_add_4_set,penghasilan_min_1_set,penghasilan_total_set,penghasilan_min_set,penghasilan_grand_set,created,creator) VALUES 
        ('$iddokter','$date_range_1','$date_range_2','$periode','$row_1','$row_2','$row_3','$row_4','$row_5','$row_6','$row_7','$row_8','$row_9','$datetime','Admin')";
        $this->db2->query($inssetjspaydokter);

        redirect('jspay/?date1='.$date_range_1.'&date2='.$date_range_2.'&iddokter='.$iddokter);
    }
    //end proses final jspay
    

    
    function datajasmeddraft(){
        $iddate_range_1   = $this->input->post('date1');
        $iddokter         = $this->input->post('iddokter');
        $daterange1       = date_create($iddate_range_1);
        $date_range_1     = date_format($daterange1,"Y-m");
        //$iddate_range_2   = $this->input->post('date2');

        //query add nyah
        /*if (isset($iddate_range_1)) {
            if($iddate_range_1==null){
                $date_range_1_set = "DATE_FORMAT(a.date_1, '%Y-%m-%d')='$date_range_1'";
            }else{
                $date_range_1_set = $iddate_range_1;
            }
            $date_range_1 = $date_range_1_set;
        } else {  $date_range_1 = "DATE_FORMAT(a.date_1, '%Y-%m-%d')='$date_range_1'";} 

        if (isset($iddate_range_2)) {
            if($iddate_range_2==null){
                $date_range_2_set = "DATE_FORMAT(a.date_2, '%Y-%m-%d')='$date_range_2'";
            }else{
                $date_range_2_set = $iddate_range_2;
            }
            $date_range_2 = $date_range_2_set;
        } else {  $date_range_2 = "DATE_FORMAT(a.date_2, '%Y-%m-%d')='$date_range_2'";} */
        //end query add nyah

        $data     = $this->D_jasmed->draft_jasmed($date_range_1, $iddokter);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function finprosesjspay(){
        $idtrx    = $this->input->post('idtrx');
        $datetime = DATE('Y-m-d H:i:s');
        $updater  = "Admin";

        $updsetjspay="UPDATE trx_jspay_dokter SET is_check = '1', updater = '$updater', updated='$datetime'  WHERE id_trx = '$idtrx'";
        $this->db2->query($updsetjspay);

        $data     = $this->D_jasmed->draft_jasmed($date_range_1);
        $datasend = json_encode($data);
        echo $datasend;
    }
    
    function printjspay($idtrx){
        $dataset     = $this->D_jasmed->setdataslipgaji($idtrx);
        $periode                    = $dataset->periode;
        $name                       = $dataset->name;
        $name_spes                  = $dataset->name_spes;
        $penghasilan_set            = $dataset->penghasilan_set;
        $penghasilan_add_1_set      = $dataset->penghasilan_add_1_set;
        $penghasilan_add_2_set      = $dataset->penghasilan_add_2_set;
        $penghasilan_add_3_set      = $dataset->penghasilan_add_3_set;
        $penghasilan_add_4_set      = $dataset->penghasilan_add_4_set;
        $penghasilan_min_1_set      = $dataset->penghasilan_min_1_set;
        $penghasilan_total_set      = $dataset->penghasilan_total_set;
        $penghasilan_min_set        = $dataset->penghasilan_min_set;
        $penghasilan_grand_set      = $dataset->penghasilan_grand_set;

        $setterbilang               = $this->terbilang($penghasilan_grand_set);
        $datenows                   = $this->tanggal_indo($periode);

        $data = array(
            'datenows'                    => $datenows,
            'name'                        => $name,
            'name_spes'                   => $name_spes,
            'penghasilan_set'             => $penghasilan_set,
            'penghasilan_add_1_set'       => $penghasilan_add_1_set,
            'penghasilan_add_2_set'       => $penghasilan_add_2_set,
            'penghasilan_add_3_set'       => $penghasilan_add_3_set,
            'penghasilan_add_4_set'       => $penghasilan_add_4_set,
            'penghasilan_min_1_set'       => $penghasilan_min_1_set,
            'penghasilan_total_set'       => $penghasilan_total_set,
            'penghasilan_min_set'         => $penghasilan_min_set,
            'penghasilan_grand_set'       => $penghasilan_grand_set,
            'setterbilang'                => $setterbilang
        );
        $this->load->view('print_rincian',$data);
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}

    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

    function datajasmedforjspay_countnotif(){
        $iddate_range_1   = $this->input->post('date1');
        $iddokter         = $this->input->post('iddokter');
        $daterange1       = date_create($iddate_range_1);
        $date_range_1     = date_format($daterange1,"Y-m");
        
        $data     = $this->D_jasmed->notifrincianunproses($date_range_1, $iddokter);
        $datasend = json_encode($data);
        echo $datasend;
    }


}
?>