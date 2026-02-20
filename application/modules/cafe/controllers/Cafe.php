<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cafe extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        //load model
        $this->load->helper('url');
        $this->load->helper('html');
		$this->load->module('auth');
		$this->auth->check_session();
		$this->load->model('MCafe', 'mdl');
    }

    public function index()
    {
        $username                       = @$this->session->userdata['sp']->username;
        $idrole                         = @$this->session->userdata['sp']->id_role;
        $datet                          = date('Y-m-d H:i:s');

        $datamv = array(
			'username'	=> $username,
            'idrole'    => $idrole
        );

        $this->load->view('vhome', $datamv);
    }

    public function data_poli_umum(){
        $data   = $this->mdl->getdatapoliumum7();
        $datasend = json_encode($data);
        echo $datasend;
    }

    public function data_poli_gigi(){
        $data   = $this->mdl->getdatapoligigi7();
        $datasend = json_encode($data);
        echo $datasend;
    }
    
    public function data_penjualan_obat(){
        $data   = $this->mdl->getdatapenjualanobat();
        $datasend = json_encode($data);
        echo $datasend;
    }


        ///////////////////////////////LIST PASIEN
        function listpasien(){
            $name       = @$this->session->userdata['sp']->name;
            $login_name = @$this->session->userdata['sp']->login_name;
            $nmpasien   = $this->input->post('nmpasien');
            $tgl_reg_1  = $this->input->post('stdate');
            $tgl_reg_2  = $this->input->post('endate');
            $asuransi   = $this->input->post('idasuransi');
            $dokter     = $this->input->post('iddokter');
            $datetime   = date('Y-m-d');
    
            if($nmpasien ==''){
                $set_qry_nmpasien = NULL;
            }else{
                $set_qry_nmpasien = "AND b.name LIKE '%".$nmpasien."%'";
            }
    
            if($tgl_reg_1 =='' && $tgl_reg_2==''){
                $set_qry_tglreg = NULL;
            }else{
                $set_qry_tglreg = "AND DATE_FORMAT(a.regdate, '%d-%m-%Y') BETWEEN '$tgl_reg_1' AND '$tgl_reg_2'";
            }
    
            if($asuransi =='' || $asuransi ==0){
                $set_qry_asuransi = NULL;
            }else{
                $set_qry_asuransi = "AND a.id_asuransi='$asuransi'";
            }
    
            if($dokter =='' || $dokter ==0){
                $set_qry_dokter = NULL;
            }else{
                $set_qry_dokter = "AND a.id_dokter_prt1='$dokter'";
            }
    
            $data       = $this->mdl->mpasien($set_qry_nmpasien,$set_qry_tglreg,$set_qry_asuransi,$set_qry_dokter,$datetime);
            $datasend = json_encode($data);
            echo $datasend;
        }
    
        function mstdokterset(){
            $data       = $this->mdl->mst_dokter();
            $datasend = json_encode($data);
            echo $datasend;
        }
        function mstasuransiset(){
            $data       = $this->mdl->mst_asuransi();
            $datasend = json_encode($data);
            echo $datasend;
        }
    
        ///////////////////////////////END LIST PASIEN

        public function headermenu_minumannyah(){
            $sql_1="SELECT * FROM cafe_headermenu WHERE grup_id='1'";
            $query_1 = $this->db->query($sql_1);
            $rs_1 = $query_1->result_array();
          
            foreach($rs_1 as $k1 => $v_1){
          
            $id_header  = $v_1['id'];
                
            $sql_2 = "SELECT * FROM cafe_itemmenu WHERE id_header='$id_header' ORDER BY nama_produk ASC";
            //echo "<pre>".$sql_2;
            $query_2 	= $this->db->query($sql_2);
            $rs2 	= $query_2->result_array();
            $rs_1[$k1]['rs_1'] = $rs2;
          
            }//end lvl 1
          
            echo json_encode($rs_1);
          
        }

        public function headermenuitem_minuman(){
            $id_data_header   = $this->input->post('id_data_header');
            $sql_1="SELECT * FROM cafe_headermenu WHERE id='$id_data_header' AND grup_id='1'";
            $query_1 = $this->db->query($sql_1);
            $rs_1 = $query_1->result_array();
          
            foreach($rs_1 as $k1 => $v_1){
          
            $id_header  = $v_1['id'];
                
            $sql_2 = "SELECT a.*,b.grup_id AS grup FROM cafe_itemmenu a 
            LEFT JOIN cafe_headermenu b ON a.id_header=b.id
            WHERE a.id_header='$id_data_header' ORDER BY a.nama_produk ASC";
            //echo "<pre>".$sql_2;
            $query_2 	= $this->db->query($sql_2);
            $rs2 	= $query_2->result_array();
            $rs_1[$k1]['rs_1'] = $rs2;
          
            }//end lvl 1
          
            echo json_encode($rs_1);
          
        }

        public function headermenu_makanannyah(){
            $sql_1="SELECT * FROM cafe_headermenu WHERE grup_id='2'";
            $query_1 = $this->db->query($sql_1);
            $rs_1 = $query_1->result_array();
          
            foreach($rs_1 as $k1 => $v_1){
          
            $id_header  = $v_1['id'];
                
            $sql_2 = "SELECT * FROM cafe_itemmenu WHERE id_header='$id_header' ORDER BY nama_produk ASC";
            //echo "<pre>".$sql_2;
            $query_2 	= $this->db->query($sql_2);
            $rs2 	= $query_2->result_array();
            $rs_1[$k1]['rs_1'] = $rs2;
          
            }//end lvl 1
          
            echo json_encode($rs_1);
          
        }

        public function headermenuitem_makanan(){
            $id_data_header   = $this->input->post('id_data_header');
            $sql_1="SELECT * FROM cafe_headermenu WHERE id='$id_data_header' AND grup_id='2'";
            $query_1 = $this->db->query($sql_1);
            $rs_1 = $query_1->result_array();
          
            foreach($rs_1 as $k1 => $v_1){
          
            $id_header  = $v_1['id'];
                
            $sql_2 = "SELECT a.*,b.grup_id AS grup FROM cafe_itemmenu a 
            LEFT JOIN cafe_headermenu b ON a.id_header=b.id
            WHERE a.id_header='$id_data_header' ORDER BY a.nama_produk ASC";
            //echo "<pre>".$sql_2;
            $query_2 	= $this->db->query($sql_2);
            $rs2 	= $query_2->result_array();
            $rs_1[$k1]['rs_1'] = $rs2;
          
            }//end lvl 1
          
            echo json_encode($rs_1);
          
        }

        public function simpanpesanan(){
            $username              = @$this->session->userdata['sp']->login_name;
            $randset=rand(1000000,100);
            $id_reg_set            = preg_replace('/[^a-zA-Z0-9\']/', '', '01/02/2025,11.07').$randset;
            //$id_reg_set            = preg_replace('/[^A-Za-z0-9_~`\/@!$.%^#&*\\()+-=]/','', $this->input->post('reg_pas'));
            $id_produk_set         = $this->input->post('id_produk');    
            $order_name_set        = $this->input->post('order_name');
            $harga_produk_set      = $this->input->post('harga_produk');
            $jumlah_produk_set     = $this->input->post('jumlah_produk');
            $total_harga_set       = $this->input->post('total_harga');
            $nama_set              = $this->input->post('nama');

            $datetime              = date('Y-m-d H:i:s'); 

            foreach($id_produk_set as $k_list => $v_list){
                $id_produk              = $id_produk_set[$k_list]; 
                $order_name             = $order_name_set[$k_list];
                $harga_produk           = $harga_produk_set[$k_list];
                $jumlah_produk          = $jumlah_produk_set[$k_list];
                $total_harga            = $total_harga_set[$k_list];
     
                $datains = array(  
                    'id_reg'        =>   $id_reg_set,
                    'nama'          =>   $nama_set,
                    'id_produk'     =>   $id_produk,
                    'nama_produk'   =>   $order_name,
                    'harga'         =>   $harga_produk,
                    'jumlah'        =>   $jumlah_produk,
                    'total'         =>   $total_harga,
                    'created'       =>   $datetime,
                    'created_by'    =>   $username
                );
                $this->mdl->ins1($datains,'cafe_trn_pesanan');
            }
            echo json_encode("ok");
        }

        function listpasienpembayaran(){
            $name       = @$this->session->userdata['sp']->name;
            $login_name = @$this->session->userdata['sp']->login_name;

            $datetime   = date('Y-m-d');

            $data       = $this->mdl->mpasien_bayar($datetime);
            $datasend = json_encode($data);
            echo $datasend;
        }
        
        	function cetak_invoice_pos($id_inv)
	{
		$this->load->library('Terbilang');
		$data_inv_header = $this->mdl->get_data_inv_header($id_inv);
		$data_inv_detail = $this->mdl->get_data_inv_detail($id_inv);
		#print_r($data_inv_header);
		$sql_id_bank = "SELECT * FROM mst_bank ORDER BY nama_bank";
		$data = array(
			'data_inv_header'		=> $data_inv_header,
			'data_inv_detail'		=> $data_inv_detail,
        );
        $this->load->view('cetak_invoice_pos', $data);
	}
	
	function updatebayar_1(){
	        $id            = $this->input->post('id');
            $jumlah         = $this->input->post('jumlah');  
            
            $datakembalian = $this->mdl->get_data_kembalian($id);
            $get_pembayaran_0     = $datakembalian->hargatotal;

            $get_pembayaran_1 = $jumlah;
  
            
            if($datakembalian->tunai==null || $datakembalian->tunai=="" || $datakembalian->tunai==0){
                $get_pembayaran_2 = 0;
            }else{
                $get_pembayaran_2 = $datakembalian->tunai;
            }

            if($datakembalian->diskon_persen==null || $datakembalian->diskon_persen=="" || $datakembalian->diskon_persen==0){
                $get_pembayaran_4 = 0;
                $diskon_persen = 0;
            }else{
                $get_pembayaran_4 = $datakembalian->diskon_persen;
                $diskon_persen = ($get_pembayaran_0/$get_pembayaran_4)/100;
            }

            if($datakembalian->diskon_rp==null || $datakembalian->diskon_rp=="" || $datakembalian->diskon_rp==0){
                $get_pembayaran_5 = 0;
            }else{
                $get_pembayaran_5 = $datakembalian->diskon_rp;
            }

            
            $diskon_rp     = $get_pembayaran_5;
            
            if(($datakembalian->tunai==null || $datakembalian->tunai=="" || $datakembalian->tunai==0) && ($jumlah==0)){
                $reskembalian = 0;
            }else{
                $reskembalian = abs(($get_pembayaran_0-$get_pembayaran_1-$get_pembayaran_2)-($diskon_persen+$diskon_rp));
            }
           
            
            $sql_2_1 = "UPDATE cafe_trn_pesanan SET debit='$get_pembayaran_1' WHERE id_reg='$id'";
            $query_2_1 	= $this->db->query($sql_2_1);
            
            $sql_2_2 = "UPDATE cafe_trn_pesanan SET tunai='$get_pembayaran_2' WHERE id_reg='$id'";
            $query_2_2 	= $this->db->query($sql_2_2);
	        
	        $sql_2 = "UPDATE cafe_trn_pesanan SET kembalian='$reskembalian' WHERE id_reg='$id'";
            $query_2 	= $this->db->query($sql_2);
            
            echo json_encode($reskembalian);
	}
	
		function updatebayar_2(){
	        $id            = $this->input->post('id');
            $jumlah         = $this->input->post('jumlah');  
            
            $datakembalian = $this->mdl->get_data_kembalian($id);
            $get_pembayaran_0     = $datakembalian->hargatotal;
            
            if($datakembalian->debit==null || $datakembalian->debit=="" || $datakembalian->debit==0){
                $get_pembayaran_1 = 0;
            }else{
                $get_pembayaran_1 = $datakembalian->debit;
            }

            if($datakembalian->diskon_persen==null || $datakembalian->diskon_persen=="" || $datakembalian->diskon_persen==0){
                $get_pembayaran_4 = 0;
                $diskon_persen = 0;
            }else{
                $get_pembayaran_4 = $datakembalian->diskon_persen;
                $diskon_persen = ($get_pembayaran_0/$get_pembayaran_4)/100;
            }

            if($datakembalian->diskon_rp==null || $datakembalian->diskon_rp=="" || $datakembalian->diskon_rp==0){
                $get_pembayaran_5 = 0;
            }else{
                $get_pembayaran_5 = $datakembalian->diskon_rp;
            }

            
            $diskon_rp     = $get_pembayaran_5;
            
            $get_pembayaran_2 = $jumlah;

            
            if(($jumlah==0) && ($datakembalian->debit==null || $datakembalian->debit=="" || $datakembalian->debit==0)){
                $reskembalian = 0;
            }else{
                $reskembalian = abs(($get_pembayaran_0-$get_pembayaran_1-$get_pembayaran_2)-($diskon_persen+$diskon_rp));
            }
            
            $sql_2_1 = "UPDATE cafe_trn_pesanan SET debit='$get_pembayaran_1' WHERE id_reg='$id'";
            $query_2_1 	= $this->db->query($sql_2_1);
            
            $sql_2_2 = "UPDATE cafe_trn_pesanan SET tunai='$get_pembayaran_2' WHERE id_reg='$id'";
            $query_2_2 	= $this->db->query($sql_2_2);
	        
	        $sql_2 = "UPDATE cafe_trn_pesanan SET kembalian='$reskembalian' WHERE id_reg='$id'";
            $query_2 	= $this->db->query($sql_2);
            echo json_encode($reskembalian);
	    }
	
		function updatebayar_3(){
	        $id            = $this->input->post('id');
            $jumlah        = $this->input->post('jumlah_kem');  
	        $sql_2         = "UPDATE cafe_trn_pesanan SET kembalian='$jumlah' WHERE id_reg='$id'";
            $query_2 	   = $this->db->query($sql_2);
            echo json_encode($reskembalian);
	    }

        function updatebayar_4(){
	        $id            = $this->input->post('id');
            $jumlah         = $this->input->post('jumlah');  
            
            $datakembalian = $this->mdl->get_data_kembalian($id);
            $get_pembayaran_0     = $datakembalian->hargatotal;
            
                $get_pembayaran_4 = $jumlah;

            if($datakembalian->diskon_rp==null || $datakembalian->diskon_rp=="" || $datakembalian->diskon_rp==0){
                $get_pembayaran_5 = 0;
            }else{
                $get_pembayaran_5 = $datakembalian->diskon_rp;
            }
            
            if($get_pembayaran_4==0){
                $totalharganew = $get_pembayaran_0;
            }else{
                $diskon_persen = ($get_pembayaran_0/$get_pembayaran_4)/100;

                $diskon     = $diskon_persen + $get_pembayaran_5;
                $totalharganew = $get_pembayaran_0 - $diskon;
            }


            
            $sql_2_1 = "UPDATE cafe_trn_pesanan SET diskon_persen='$get_pembayaran_4' WHERE id_reg='$id'";
            $query_2_1 	= $this->db->query($sql_2_1);

            $sql_2_a = "UPDATE cafe_trn_pesanan SET debit='0' WHERE id_reg='$id'";
            $query_2_a 	= $this->db->query($sql_2_a);
            $sql_2_b = "UPDATE cafe_trn_pesanan SET tunai='0' WHERE id_reg='$id'";
            $query_2_b 	= $this->db->query($sql_2_b);
            $sql_2_c = "UPDATE cafe_trn_pesanan SET kembalian='0' WHERE id_reg='$id'";
            $query_2_c 	= $this->db->query($sql_2_c);
            
            echo json_encode($totalharganew);
	    }

        function updatebayar_5(){
	        $id            = $this->input->post('id');
            $jumlah         = $this->input->post('jumlah');  
            
            $datakembalian = $this->mdl->get_data_kembalian($id);
            $get_pembayaran_0     = $datakembalian->hargatotal;
            
                $get_pembayaran_5 = $jumlah;
            
            if($datakembalian->diskon_persen==null || $datakembalian->diskon_persen=="" || $datakembalian->diskon_persen==0){
                $get_pembayaran_4 = 0;
            }else{
                $get_pembayaran_4 = $datakembalian->diskon_persen;
            }


            if($get_pembayaran_5==0){
                $totalharganew = $get_pembayaran_0;
            }else{
                if($datakembalian->diskon_persen==null || $datakembalian->diskon_persen=="" || $datakembalian->diskon_persen==0){
                    $totalharganew = ($get_pembayaran_0-$get_pembayaran_5);
                }else{
                    $diskon_persen = ($get_pembayaran_0/$get_pembayaran_4)/100;

                    $diskon     = $diskon_persen + $get_pembayaran_5;
                    $totalharganew = $get_pembayaran_0 - $diskon;
                }

            }

                
            

            /*$diskon_persen = ($get_pembayaran_0/$get_pembayaran_4);

            $diskon     = $diskon_persen + $get_pembayaran_5;
            $totalharganew = $get_pembayaran_0 - $diskon;*/
            

            
            //$reskembalian = abs($get_pembayaran_0-$get_pembayaran_1-$get_pembayaran_2);
            
            $sql_2_1 = "UPDATE cafe_trn_pesanan SET diskon_rp='$get_pembayaran_5' WHERE id_reg='$id'";
            $query_2_1 	= $this->db->query($sql_2_1);

            $sql_2_a = "UPDATE cafe_trn_pesanan SET debit='0' WHERE id_reg='$id'";
            $query_2_a 	= $this->db->query($sql_2_a);
            $sql_2_b = "UPDATE cafe_trn_pesanan SET tunai='0' WHERE id_reg='$id'";
            $query_2_b 	= $this->db->query($sql_2_b);
            $sql_2_c = "UPDATE cafe_trn_pesanan SET kembalian='0' WHERE id_reg='$id'";
            $query_2_c 	= $this->db->query($sql_2_c);
            
            echo json_encode($totalharganew);
	    }

}
