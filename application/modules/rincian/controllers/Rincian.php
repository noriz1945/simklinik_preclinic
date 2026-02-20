<?php
class Rincian extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Rincian');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
    }

    function index(){
        $id_reg_set         = $this->input->get('id_reg');

        $id_reg         = $id_reg_set; //"0213SA00009";
        $sql_2="SELECT b.name,a.id_group_act FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='$id_reg' GROUP BY a.id_group_act";
        //echo "<pre>".$sql_2;
		$query_2 = $this->db->query($sql_2);
        $rs_2 = $query_2->result_array();

        foreach($rs_2 as $k => $v_2){

        $id_group_act   = $v_2['id_group_act'];
            
        $sql_3 = "SELECT a.name, a.qty, a.trxdate, a.price FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='$id_reg' AND a.id_group_act='$id_group_act'";
        //echo "<pre>".$sql_3;
        $query_3 	= $this->db->query($sql_3);
        $rs3 	= $query_3->result_array();
        $rs_2[$k]['rs_3'] = $rs3;
        //print_r($rs_2);

        }

        ///handler tombol proses rincian
        $handlertombol           = $this->D_Rincian->dhandlertombolrincian($id_reg);
        $iostatus_set            = $handlertombol->iostatus;
        $idpasien_set            = $handlertombol->id_pasien;
        ///end handler tombol proses rincian
        $data = array(
            'rs_2'          => $rs_2,
            'id_reg_set'    => $id_reg_set,
            'iostatus_set'  => $iostatus_set,
            'idpasien_set'  => $idpasien_set
        );

        $this->load->view('rincian', $data);
    }

    function msttindakan(){
        $data       = $this->D_Rincian->mtindakan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function proses(){
        $id_reg      = $this->input->post('id_reg');
        $send        = $this->input->post('id_set');
        $qty         = $this->input->post('qty_set');
        $name        = $this->input->post('name_set');
        $price       = $this->input->post('price_set');
        foreach($send as $k => $v){
            $qtyset    = $qty[$k];
            $nameset   = $name[$k];
            $priceset  = $price[$k];
            $totalset  = ($priceset * $qtyset);

            $data_trx_reg_act = array(  
                'id_reg'             =>   $id_reg,
                'id_reg_act'         =>   $v,
                'qty'                =>   $qtyset,
                'name'               =>   $nameset,
                'price'              =>   $priceset,
                'total'              =>   $totalset
            );
            $this->D_Transaksi->createregact($data_trx_reg_act,'trx_reg_act'); 
           
        } //exit;
        redirect('transaksi');
    }

    function mstpasien(){
        $nama_pasien    = $this->input->post('valselnamapasien');
        $id_pasien      = $this->input->post('valselidpasien');
        $tgl_lahir      = $this->input->post('valseltgllahir');
        $id_reg         = $this->input->post('valselidreg');
        $data           = $this->D_Rincian->mpasien($nama_pasien, $id_pasien, $tgl_lahir, $id_reg);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function dataresspb(){
        $id_reg      = $this->input->get('id_reg');
        $data        = $this->D_Rincian->mspb($id_reg);
        $datasend = json_encode($data);
        echo $datasend;
    }//datarestind

    function dataresrinc_pkt(){
        $id_reg                  = $this->input->get('id_reg');
        $check_data_paket        = $this->D_Rincian->dcheckpaket($id_reg);
        $id_paket_set            = $check_data_paket->id_paket;

        //if(!empty($id_paket_set)){
            $sql_2="SELECT 
            (CASE WHEN b.id_paket IS NULL THEN '1_tind' ELSE '2_paket' END) AS type_header, 
            (CASE WHEN b.id_paket IS NULL THEN 'TINDAKAN LUAR PAKET' ELSE 'PAKET' END) AS name_group
            FROM trx_reg_act a 
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='$id_paket_set') 
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket WHERE a.id_reg='$id_reg'
            GROUP BY type_header ORDER BY type_header DESC";
        //}else{
        //    $sql_2="SELECT a.name, b.name AS name_group FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='$id_reg'";
        //}
        //echo "<pre>".$sql_2;
		$query_2 = $this->db->query($sql_2);
        $rs_2 = $query_2->result_array();

        foreach($rs_2 as $k => $v_2){

        $type_header   = $v_2['type_header'];
            
        if($type_header=="2_paket"){
            $sql_3 = "SELECT
            (CASE WHEN b.id_paket IS NULL THEN a.name ELSE c.name END) AS name_tind ,
            c.id_paket,
            (CASE WHEN b.id_paket IS NULL THEN a.qty ELSE b.qty END) AS qtynya,
            (CASE WHEN b.id_paket IS NULL THEN a.price ELSE c.price END) AS pricenya
            FROM trx_reg_act a 
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='$id_paket_set')
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket
            WHERE a.id_reg='$id_reg' AND c.id_paket='$id_paket_set'
            GROUP BY c.id_paket";
        }else{
            $sql_3 = "SELECT
            (CASE WHEN b.id_paket IS NULL THEN a.name ELSE c.name END) AS name_tind ,
            c.id_paket,
            (CASE WHEN b.id_paket IS NULL THEN a.qty ELSE b.qty END) AS qtynya,
            (CASE WHEN b.id_paket IS NULL THEN a.price ELSE c.price END) AS pricenya
            FROM trx_reg_act a 
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='$id_paket_set')
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket
            WHERE a.id_reg='$id_reg' AND c.id_paket IS NULL";
        }

        //echo "<pre>".$sql_3;
        $query_3 	= $this->db->query($sql_3);
        $rs3 	= $query_3->result_array();
        $rs_2[$k]['rs_3'] = $rs3;
        //print_r($rs_2);

        }
        $data = array(
            'rs_2'          => $rs_2,
            'id_reg_set'    => $id_reg_set
        );

        $this->load->view('rincian_pkt', $data);

    }

    function dataresrinc(){
        $id_reg                  = $this->input->get('id_reg');

        $sql_2="SELECT 
        b.name AS name_group, a.id_group_act,(CASE a.id_reg IS NULL WHEN 'tnd' THEN 'tnd' END) AS jns
        FROM trx_reg_act a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group 
        WHERE a.id_reg='$id_reg' AND a.is_select='1' 
        GROUP BY b.name
        UNION ALL
        SELECT (CASE a.id_reg IS NULL WHEN 'FARMASI - (Non Racikan)' THEN 'FARMASI - (Non Racikan)' END) AS
        nama_group,a.id_resep AS id_group_act,(CASE a.id_reg IS NULL WHEN 'nrc' THEN 'nrc' END) AS jns
        FROM trx_frm_resep a
        LEFT JOIN trx_frm_resep_det b ON a.id_resep=b.id_resep 
        LEFT JOIN soap_eresep_det c ON b.id_trx_det=c.id_trx_det 
        WHERE a.id_reg='$id_reg' AND b.is_select='1' AND c.is_racikan='0'
        GROUP BY nama_group
        UNION ALL
        SELECT
        (CASE a.id_reg IS NULL WHEN 'FARMASI - (Racikan)' THEN 'FARMASI - (Racikan)' END) AS nama_group,a.id_resep AS id_group_act,(CASE a.id_reg IS NULL WHEN 'rac' THEN 'rac' END) AS jns
        FROM trx_frm_resep_rck a
        LEFT JOIN soap_eresep_det b ON a.id_trx_from_soap=b.id_eresep_det 
        WHERE a.id_reg='$id_reg' AND a.is_select='1' AND b.is_racikan='1'
        GROUP BY nama_group
        ";
        //echo "<pre>".$sql_2;
		$query_2 = $this->db->query($sql_2);
        $rs_2 = $query_2->result_array();

        foreach($rs_2 as $k => $v_2){

        $jns_group      = $v_2['jns'];
        $sql_set_1 = "SELECT
        a.name AS name_tind,
        a.qty AS qtynya,
        a.price AS pricenya
        FROM trx_reg_act a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group
        WHERE a.id_group_act='".$v_2['id_group_act']."' AND a.is_select='1' AND a.id_reg='$id_reg'";
        if($jns_group=="nrc"){
            $sql_set_1 .= "UNION ALL SELECT b.name,b.qty,b.total
            FROM trx_frm_resep a 
            LEFT JOIN trx_frm_resep_det b ON a.id_resep=b.id_resep 
            LEFT JOIN soap_eresep_det c ON b.id_trx_det=c.id_trx_det 
            LEFT JOIN soap_eresep d ON c.id_eresep=d.id_eresep 
            WHERE a.id_resep='".$v_2['id_group_act']."' AND d.id_reg='$id_reg' AND b.is_select='1' AND c.is_racikan='0'";
        }
        if($jns_group=="rac"){
            $sql_set_1 .= "UNION ALL SELECT b.name,b.qty,a.subtotal
            FROM trx_frm_resep_rck a
            LEFT JOIN soap_eresep_det b ON a.id_trx_from_soap=b.id_eresep_det 
            WHERE a.id_resep='".$v_2['id_group_act']."' AND a.is_select='1' AND b.is_racikan='1'";
        }

        $sql_3 = $sql_set_1;


        //echo "<pre>".$sql_3;
        $query_3 	= $this->db->query($sql_3);
        $rs3 	= $query_3->result_array();
        $rs_2[$k]['rs_3'] = $rs3;
        //print_r($rs_2);

        }
        $data = array(
            'rs_2'          => $rs_2,
            'id_reg'        => $id_reg
        );

        $this->load->view('rincian_pkt', $data);

    }

    function datasendtind(){
        $id_reg      = $this->input->post('id_reg');
        $send        = $this->input->post();
        foreach($send['optgrp'] as $k => $v){
            $idtrx=$v;
            $expidtrxv = explode(";",$idtrx);
            $expidtrxv[1]."->".$expidtrxv[0];
            $datetime = date('Y-m-d H:i:s');

            if($expidtrxv[1]=="tnd"){ //Tindakan
            $update_1="UPDATE trx_reg_act SET is_select='1', updated='$datetime' WHERE id_trx='$expidtrxv[0]' AND id_reg='$id_reg'";
            $this->db2->query($update_1);
            }

            if($expidtrxv[1]=="nrc"){ //Farmasi Obat Non-racikan
            $update_2="UPDATE trx_frm_resep_det SET is_select='1', updated='$datetime' WHERE id_trx='$expidtrxv[0]'";
            $this->db2->query($update_2);
            }

            if($expidtrxv[1]=="rac"){ //Farmasi Obat Racikan
            $update_3="UPDATE trx_frm_resep_rck SET is_select='1', updated='$datetime' WHERE id_trx='$expidtrxv[0]'";
            $this->db2->query($update_3);
            }

        }//exit;
        $setcomplete = "Done";
        $datasend    = json_encode($setcomplete);
        echo $datasend;
    }

    function datasendtindbatal(){
        $id_reg      = $this->input->post('id_reg');
        /*$send        = $this->input->post();
        foreach($send['optgrp'] as $k => $v){
            $idtrx=$v;
            $datetime = date('Y-m-d H:i:s');

            $update="UPDATE trx_reg_act SET is_select='0', updated='$datetime' WHERE id_trx='$idtrx' AND id_reg='$id_reg'";
            $this->db2->query($update);
        }*/
        $update="UPDATE trx_reg_act SET is_select='0', updated='$datetime' WHERE id_reg='$id_reg'";
        $this->db2->query($update);
        $setcomplete = "Done";
        $datasend    = json_encode($setcomplete);
        echo $datasend;
    }

    function printrincian($id_reg){
        $datapasien        = $this->D_Rincian->detaildatapasien($id_reg);
        $id_reg_set        = $datapasien->id_reg;
        $name_set          = $datapasien->name;
        $id_pasien_set     = $datapasien->id_pasien;
        $alamat_set        = $datapasien->address;
        $tanggal_set       = $datapasien->regdate;
        $penanggung_set    = $datapasien->penanggung;
        $penjamin_set      = $datapasien->nama_comp;
        $polis_set         = $datapasien->card_id;
        $asperu_set        = $datapasien->card_comp;

        $sql_2="SELECT 
        b.name AS name_group, a.id_group_act,(CASE a.id_reg IS NULL WHEN 'tnd' THEN 'tnd' END) AS jns
        FROM trx_reg_act a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group 
        WHERE a.id_reg='$id_reg' AND a.is_select='1' 
        GROUP BY b.name
        UNION ALL
        SELECT (CASE a.id_reg IS NULL WHEN 'FARMASI - (Non Racikan)' THEN 'FARMASI - (Non Racikan)' END) AS
        nama_group,a.id_resep AS id_group_act,(CASE a.id_reg IS NULL WHEN 'nrc' THEN 'nrc' END) AS jns
        FROM trx_frm_resep a
        LEFT JOIN trx_frm_resep_det b ON a.id_resep=b.id_resep 
        LEFT JOIN soap_eresep_det c ON b.id_trx_det=c.id_trx_det 
        WHERE a.id_reg='$id_reg' AND b.is_select='1' AND c.is_racikan='0'
        GROUP BY nama_group
        UNION ALL
        SELECT
        (CASE a.id_reg IS NULL WHEN 'FARMASI - (Racikan)' THEN 'FARMASI - (Racikan)' END) AS nama_group,a.id_resep AS id_group_act,(CASE a.id_reg IS NULL WHEN 'rac' THEN 'rac' END) AS jns
        FROM trx_frm_resep_rck a
        LEFT JOIN soap_eresep_det b ON a.id_trx_from_soap=b.id_eresep_det 
        WHERE a.id_reg='$id_reg' AND a.is_select='1' AND b.is_racikan='1'
        GROUP BY nama_group";
        //echo "<pre>".$sql_2;
		$query_2 = $this->db->query($sql_2);
        $rs_2 = $query_2->result_array();

        foreach($rs_2 as $k => $v_2){

        $jns_group = $v_2['jns'];
        $sql_set_1 = "SELECT
        a.name AS name_tind,
        a.qty AS qtynya,
        a.price AS pricenya
        FROM trx_reg_act a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group
        WHERE a.id_group_act='".$v_2['id_group_act']."' AND a.is_select='1' AND a.id_reg='$id_reg'";
        if($jns_group=="nrc"){
            $sql_set_1 .= "UNION ALL SELECT b.name,b.qty,b.total
            FROM trx_frm_resep a 
            LEFT JOIN trx_frm_resep_det b ON a.id_resep=b.id_resep 
            LEFT JOIN soap_eresep_det c ON b.id_trx_det=c.id_trx_det 
            LEFT JOIN soap_eresep d ON c.id_eresep=d.id_eresep 
            WHERE a.id_resep='".$v_2['id_group_act']."' AND d.id_reg='$id_reg' AND b.is_select='1' AND c.is_racikan='0'";
        }
        if($jns_group=="rac"){
            $sql_set_1 .= "UNION ALL SELECT b.name,b.qty,a.subtotal
            FROM trx_frm_resep_rck a
            LEFT JOIN soap_eresep_det b ON a.id_trx_from_soap=b.id_eresep_det 
            WHERE a.id_resep='".$v_2['id_group_act']."' AND a.is_select='1' AND b.is_racikan='1'";
        }

        $sql_3 = $sql_set_1;

        //echo "<pre>".$sql_3;
        $query_3 	= $this->db->query($sql_3);
        $rs3 	= $query_3->result_array();
        $rs_2[$k]['rs_3'] = $rs3;
        //print_r($rs_2);

        }//exit;
        $data = array(
            'rs_2'           => $rs_2,
            'id_reg'         => $id_reg,
            'id_reg_set'     => $id_reg_set,
            'name_set'       => $name_set,
            'id_pasien_set'  => $id_pasien_set,
            'alamat_set'     => $alamat_set,
            'tanggal_set'    => $tanggal_set,
            'penanggung_set' => $penanggung_set,
            'penjamin_set'   => $penjamin_set,
            'polis_set'      => $polis_set,
            'asperu_set'     => $asperu_set
        );

    $this->load->view('print_rincian', $data);
    }

    function printrincianpkt($id_reg){
        $datapasien        = $this->D_Rincian->detaildatapasien($id_reg);
        $id_reg_set        = $datapasien->id_reg;
        $name_set          = $datapasien->name;
        $id_pasien_set     = $datapasien->id_pasien;
        $alamat_set        = $datapasien->address;
        $tanggal_set       = $datapasien->regdate;
        $penanggung_set    = $datapasien->penanggung;
        $penjamin_set      = $datapasien->nama_comp;
        $polis_set         = $datapasien->card_id;
        $asperu_set        = $datapasien->card_comp;

        $check_data_paket        = $this->D_Rincian->dcheckpaket($id_reg);
        $id_paket_set            = $check_data_paket->id_paket;

        //if(!empty($id_paket_set)){
            $sql_2="SELECT 
            (CASE WHEN b.id_paket IS NULL THEN '1_tind' ELSE '2_paket' END) AS type_header, 
            (CASE WHEN b.id_paket IS NULL THEN 'TINDAKAN LUAR PAKET' ELSE 'PAKET' END) AS name_group
            FROM trx_reg_act a 
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='$id_paket_set') 
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket WHERE a.id_reg='$id_reg'
            GROUP BY type_header ORDER BY type_header DESC";
        //}else{
        //    $sql_2="SELECT a.name, b.name AS name_group FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='$id_reg'";
        //}
        //echo "<pre>".$sql_2;
		$query_2 = $this->db->query($sql_2);
        $rs_2 = $query_2->result_array();

        foreach($rs_2 as $k => $v_2){

        $type_header   = $v_2['type_header'];
            
        if($type_header=="2_paket"){
            $sql_3 = "SELECT
            (CASE WHEN b.id_paket IS NULL THEN a.name ELSE c.name END) AS name_tind ,
            c.id_paket,
            (CASE WHEN b.id_paket IS NULL THEN a.qty ELSE b.qty END) AS qtynya,
            (CASE WHEN b.id_paket IS NULL THEN a.price ELSE c.price END) AS pricenya
            FROM trx_reg_act a 
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='$id_paket_set')
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket
            WHERE a.id_reg='$id_reg' AND c.id_paket='$id_paket_set'
            GROUP BY c.id_paket";
        }else{
            $sql_3 = "SELECT
            (CASE WHEN b.id_paket IS NULL THEN a.name ELSE c.name END) AS name_tind ,
            c.id_paket,
            (CASE WHEN b.id_paket IS NULL THEN a.qty ELSE b.qty END) AS qtynya,
            (CASE WHEN b.id_paket IS NULL THEN a.price ELSE c.price END) AS pricenya
            FROM trx_reg_act a 
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='$id_paket_set')
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket
            WHERE a.id_reg='$id_reg' AND c.id_paket IS NULL";
        }

        //echo "<pre>".$sql_3;
        $query_3 	= $this->db->query($sql_3);
        $rs3 	= $query_3->result_array();
        $rs_2[$k]['rs_3'] = $rs3;
        //print_r($rs_2);

        }
        $data = array(
            'rs_2'           => $rs_2,
            'id_reg'         => $id_reg,
            'id_reg_set'     => $id_reg_set,
            'name_set'       => $name_set,
            'id_pasien_set'  => $id_pasien_set,
            'alamat_set'     => $alamat_set,
            'tanggal_set'    => $tanggal_set,
            'penanggung_set' => $penanggung_set,
            'penjamin_set'   => $penjamin_set,
            'polis_set'      => $polis_set,
            'asperu_set'     => $asperu_set
        );

    $this->load->view('print_rincian_pkt', $data);
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

    function datasendtindprosesrincian(){
        $id_reg             = $this->input->post('id_reg');
        $id_cctype1         = $this->input->post('id_cctype1');
        $id_bank1           = $this->input->post('id_bank1');
        $nocc1              = $this->input->post('nocc1');
        $total_cc1          = $this->input->post('total_cc1');
        $subtotal           = $this->input->post('subtotal');
        $total_grand        = $this->input->post('total_grand');
        $total_inv          = $this->input->post('total_inv');
        $total_cash         = $this->input->post('total_cash');
        $total_noncash      = $this->input->post('total_noncash');
        $disc_total         = $this->input->post('disctotal');
        

        $datetime           = date('Y-m-d H:i:s');
        $id_cabang          = "01"; 
        //set increment nya
            $datainv       = $this->D_Rincian->dinv();
            $setnourut     = $datainv->id_inv;//"INV230100000010";//$datainv->nourut;
            $urutan        = (int) substr($setnourut, 9, 5);
            $setincrement  = $urutan + 1;
            $increset="INV".$id_cabang.date('ym').sprintf("%05s", $setincrement);
            //$increset;
        //end set increment nya

        //$dataregtrx             = $this->D_Rincian->checkdatatrxreg($id_reg);
        //$id_reg_trx_act_set     = $dataregtrx->id_trx;

        $update_1="UPDATE trx_reg_act SET id_inv='$increset', updated='$datetime',updater='username' WHERE id_reg='$id_reg'";
        $this->db->query($update_1);

        $update_2="UPDATE trx_reg SET iostatus='1', updated='$datetime',updater='username' WHERE id_reg='$id_reg'";
        $this->db->query($update_2);

        //$update_3="UPDATE trx_reg_paket SET id_inv='$increset', updated='$datetime' WHERE id_reg='$id_reg'";
        //$this->db->query($update_3);

        $update_4="UPDATE trx_paket_aktif SET id_inv='$increset', updated='$datetime',updateby='username' WHERE id_reg='$id_reg'";
        $this->db->query($update_4);

        $update_5="INSERT INTO trx_reg_inv (id_inv,invdate,id_reg,id_cctype1,id_bank1,nocc1,total_cc1,subtotal,total,total_inv,total_cash,total_noncash,id_pkt,vcdisc_m,created,creator) VALUE ('$increset','$datetime','$id_reg','$id_cctype1','$id_bank1','$nocc1','$total_cc1','$subtotal','$total_grand','$total_inv','$total_cash','$total_noncash','0','$disc_total','$datetime','username')";
        $this->db->query($update_5);

        $setcomplete = "Done";
        $datasend    = json_encode($setcomplete);
        echo $datasend;
    }

    function datasendtindprosesrincianpaket(){
        $id_reg             = $this->input->post('id_reg');
        $id_cctype1         = $this->input->post('id_cctype1');
        $id_bank1           = $this->input->post('id_bank1');
        $nocc1              = $this->input->post('nocc1');
        $total_cc1          = $this->input->post('total_cc1');
        $subtotal           = $this->input->post('subtotal');
        $total_grand        = $this->input->post('total_grand');
        $total_inv          = $this->input->post('total_inv');
        $total_cash         = $this->input->post('total_cash');
        $total_noncash      = $this->input->post('total_noncash');
        $disc_total         = $this->input->post('disctotal');

        $datetime           = date('Y-m-d H:i:s');
        $id_cabang          = "01"; 
        //set increment nya
            $datainv       = $this->D_Rincian->dinv();
            $setnourut     = $datainv->id_inv;//"INV230100000010";//$datainv->nourut;
            $urutan        = (int) substr($setnourut, 9, 5);
            $setincrement  = $urutan + 1;
            $increset="INV".$id_cabang.date('ym').sprintf("%05s", $setincrement);
            //$increset;
        //end set increment nya

        //checkpaket
        $dataregtrx             = $this->D_Rincian->checkdatatrxreg($id_reg);
        $id_paket_set           = $dataregtrx->id_paket;
        $id_trx_paket_set       = $dataregtrx->id_trx_paket;
        //end checkpaket

        //checkdatatindpaket
        $datatindpaket          = $this->D_Rincian->checkdatatindpaket($id_paket_set);
        foreach($datatindpaket as $datatindpaketdt){
            $id_trx_det = $datatindpaketdt->id_trx_det;
            $datatrxrecatpaket  = $this->D_Rincian->checkdatatrxrecatpaket($id_reg, $id_trx_det);
            $id_trx_det_set     = $datatrxrecatpaket->id_reg_act;
            if($id_trx_det==$id_trx_det_set){
                $update_1="UPDATE trx_reg_act SET is_select='2',is_paket='1', updated='$datetime',updater='username' WHERE id_reg_act='$id_trx_det' AND id_reg='$id_reg'";
                $this->db->query($update_1);
            }else{
                $update_1="UPDATE trx_reg_act SET is_select='1',is_outpaket='1', updated='$datetime',updater='username' WHERE id_reg_act='$id_trx_det' AND id_reg='$id_reg'";
                $this->db->query($update_1);
            }


            $update_1="UPDATE trx_reg_act SET id_inv='$increset', updated='$datetime',updater='username' WHERE id_reg='$id_reg'";
            $this->db->query($update_1);
        }
        //end checkdatatindpaket

        

        $update_2="UPDATE trx_reg SET iostatus='1', updated='$datetime',updater='username' WHERE id_trx_paket='$id_trx_paket_set'";
        $this->db->query($update_2);

        $update_3="UPDATE trx_reg_paket SET id_inv='$increset', updated='$datetime', updater='username' WHERE id_reg='$id_reg'";
        $this->db->query($update_3);

        $update_4="UPDATE trx_paket_aktif SET id_inv='$increset', updated='$datetime',updateby='username' WHERE id_trx_paket='$id_trx_paket_set'";
        $this->db->query($update_4);

        $update_5="INSERT INTO trx_reg_inv (id_inv,invdate,id_reg,id_cctype1,id_bank1,nocc1,total_cc1,subtotal,total,total_inv,total_cash,total_noncash,id_pkt,id_paket,vcdisc_m,created,creator) VALUE ('$increset','$datetime','$id_reg','$id_cctype1','$id_bank1','$nocc1','$total_cc1','$subtotal','$total_grand','$total_inv','$total_cash','$total_noncash','1','$id_paket_set','$disc_total','$datetime','username')";
        $this->db->query($update_5);

        $setcomplete = "Done";
        $datasend    = json_encode($setcomplete);
        echo $datasend;
    }

    function trxinvpasien(){
        //$id_pasien         = $this->input->post('id_pasien');
        $id_reg            = $this->input->get('id_reg');

        $datasetpasien     = $this->D_Rincian->mtrxinvidpasien($id_reg);
        $id_pasien         = $datasetpasien->id_pasien;

        $data              = $this->D_Rincian->mtrxinvpasien($id_pasien);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstcctype(){
        $data       = $this->D_Rincian->mcctype();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstbank(){
        $data       = $this->D_Rincian->mbank();
        $datasend = json_encode($data);
        echo $datasend;
    }

    
    

}
?>