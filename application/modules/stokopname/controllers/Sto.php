<?php
class Sto extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Sto');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
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
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_sto');
    }
    function listdatasto(){
        $tglmulai_set_get          = $this->input->post('tglmulai');
        $tglakhir_set_get          = $this->input->post('tglakhir');

        $tglmulai_set_get_crt    = date_create($tglmulai_set_get);
        $tglmulai_set            = date_format($tglmulai_set_get_crt,"Y-m-d"); 

        $tglakhir_set_get_crt    = date_create($tglakhir_set_get);
        $tglakhir_set            = date_format($tglakhir_set_get_crt,"Y-m-d"); 

        $data           = $this->D_Sto->dliststo($tglmulai_set,$tglakhir_set);
		$dataset = json_encode($data);
		echo $dataset;
    }    
    public function mstgudang(){
		//$term = $this->input->get('term',true);
		$sql = "SELECT a.id_wrh ,a.name AS nama_gudang FROM mst_warehouse a ORDER BY a.name ASC";
		//WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		/*foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_gudang'];
			$rs[$k]['id'] = $v['id_wrh'];
		}*/
		$dataset = json_encode($rs);
		echo $dataset;
    }

    public function mstrak(){
		$id_gudang  = $this->input->post('id_wrh_set');
		$sql        = "SELECT a.id_rak AS no_rak,a.name AS nama_rak FROM mst_rak a WHERE a.id_wrh = '$id_gudang' ORDER BY a.name ASC";
		//WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		/*foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_gudang'];
			$rs[$k]['id'] = $v['id_wrh'];
		}*/
		$dataset = json_encode($rs);
		echo $dataset;
    }

    public function mstrak_edt(){
		$id_gudang  = $this->input->post('id_wrh_set');
		$sql        = "SELECT a.id_rak AS no_rak,a.name AS nama_rak FROM mst_rak a WHERE a.id_wrh = '$id_gudang' ORDER BY a.name ASC";
		//WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		/*foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_gudang'];
			$rs[$k]['id'] = $v['id_wrh'];
		}*/
		$dataset = json_encode($rs);
		echo $dataset;
    }

    public function mstobat(){
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_fa AS id_obat,a.name AS nama_obat
						FROM 		mst_farmalkes a 
						WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_obat'];
			$rs[$k]['id'] = $v['id_obat'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }


    function checksohitemini(){
        $id_obat_set          = $this->input->post('id_obat');
        $id_wrh_set           = $this->input->post('id_wrh');
        $no_rak_set           = $this->input->post('no_rak');
        $data                 = $this->D_Sto->data_soh_obat($id_obat_set,$id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }

    function checktersediaobatnya(){
        $id_obat_set          = $this->input->post('id_obat');
        $id_wrh_set           = $this->input->post('id_wrh');
        $no_rak_set           = $this->input->post('no_rak');
        $no_sto_set           = $this->input->post('no_sto');
        $data                 = $this->D_Sto->data_tersedia_obat_gudang($id_obat_set,$id_wrh_set,$no_rak_set,$no_sto_set);
		$dataset = json_encode($data);
		echo $dataset;
    }

    function save(){
        $username              = @$this->session->userdata['sp']->login_name;
        $no_sto_set            = $this->input->post('no_sto_p_set');
        $id_wrh_set            = $this->input->post('id_wrh');
        $id_rak_set            = $this->input->post('raksearch');
        $min_set               = $this->input->post('min');
        $expired_set           = $this->input->post('expired');
        $id_obat_set           = $this->input->post('id_obat');
        $qty_last_set          = $this->input->post('qty_last');
        $no_rak_set            = $this->input->post('no_rak');
        $set_catatan_set       = $this->input->post('set_catatan');
        //listing
        $min_list_set          = $this->input->post('min_listing');
        $id_obat_list_set      = $this->input->post('id_obat_listing');
        $qty_last_list_set     = $this->input->post('qty_last_listing');
        $no_rak_list_set       = $this->input->post('no_rak_listing');

        $datetime              = date('Y-m-d H:i:s'); //ST011901
        if(empty($no_sto_set)){
        //gen no sto
        $checkid                       = $this->D_Sto->cdk();
        $setnoreg                      = $checkid->id_sto;
        $prefix       = "ST-";
        $datereal_tgl = date('d');
        $datereal_bln = date('m');
        $datereal_thn = date('y');
        $setidregfnc = $setnoreg;
        $setnoreg_bln = substr($setidregfnc, 5, 2);
        $setnoreg_thn = substr($setidregfnc, 7, 2);
        $urutan_reg = (int) substr($setidregfnc, 12, 17);
        //echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";
        if(($datereal_bln==$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){
            $setincrement_reg = $urutan_reg+1;
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."OP".sprintf("%06s", $setincrement_reg);
        }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
            $setincrement_reg = "000001";
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."OP".$setincrement_reg;
        }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
            $setincrement_reg = "000001";
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."OP".$setincrement_reg;
        }else{
            $setincrement_reg = "000001";
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."OP".$setincrement_reg;
        }
        //end gen no sto
        $datains = array(  
            'id_sto'            =>   $id_stoset,
            'stodate'           =>   $datetime,
            'id_wrh'            =>   $id_wrh_set,
            'no_rak'            =>   $id_rak_set,
            'catatan'           =>   $set_catatan_set,
            'status'            =>   0,
            'created'           =>   $datetime,
            'creator'           =>   $username
        );
        $this->D_Sto->ins1($datains,'trx_lgs_sto'); 
        if(empty($id_obat_set)){
        //listing data
        foreach($id_obat_list_set as $k_list => $v_list){
            $id_obat_lst            = $id_obat_list_set[$k_list]; 
            $no_rak_lst             = $no_rak_list_set[$k_list];
            $qty_last_lst           = $qty_last_list_set[$k_list];
            $min_lst                = $min_list_set[$k_list];
            $expired_sto_set_lst    = date_create($expired_set_lst[$k_list]);
            $expired_lst            = date_format($expired_sto_set_lst,"Y-m-d"); 
 
            $datains = array(  
                'id_sto'          =>   $id_stoset,
                'id_trx_det'      =>   $id_obat_lst,
                'id_wrh'          =>   $id_wrh_set,
                'no_rak'          =>   $no_rak_lst,
                'min'             =>   $min_lst,
                'qty_soh'         =>   $qty_last_lst,
                'created'         =>   $datetime,
                'creator'         =>   $username
            );
            $this->D_Sto->ins3($datains,'trx_lgs_sto_det');
        }
        //end listing
        }else{

        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $no_rak             = $no_rak_set[$k];
            $qty_last           = $qty_last_set[$k];
            $min                = $min_set[$k];
            $expired_sto_set    = date_create($expired_set[$k]);
            $expired            = date_format($expired_sto_set,"Y-m-d"); 
 
            $datains = array(  
                'id_sto'          =>   $id_stoset,
                'id_trx_det'      =>   $id_obat,
                'no_rak'          =>   $no_rak,
                'id_wrh'          =>   $id_wrh_set,
                'min'             =>   $min,
                'qty_soh'         =>   $qty_last,
                'created'         =>   $datetime,
                'creator'         =>   $username
            );
            $this->D_Sto->ins1($datains,'trx_lgs_sto_det');

            $checkmstwrh                   = $this->D_Sto->cdk_gudang_sto($id_obat, $id_wrh_set, $id_rak_set);
            $datafind                      = $checkmstwrh->countget;

            if($datafind > 1){
                //nothing
            }else{
                $datains2 = array(  
                    'id_fa'          =>   $id_obat,
                    'id_wrh'         =>   $id_wrh_set,
                    'min'            =>   $min,
                    'no_rak'         =>   $no_rak,
                    'exp'            =>   $expired,
                    'created'        =>   $datetime,
                    'creator'        =>   $username
                );
                $this->D_Sto->ins2($datains2,'mst_wrh_mm');
            }


        }

        //listing data
        if(empty($id_obat_list_set)){
            //nothing
        }else{
            foreach($id_obat_list_set as $k_list => $v_list){
                $id_obat_lst            = $id_obat_list_set[$k_list]; 
                $no_rak_lst             = $no_rak_list_set[$k_list];
                $qty_last_lst           = $qty_last_list_set[$k_list];
                $min_lst                = $min_list_set[$k_list];
                $expired_sto_set_lst    = date_create($expired_set_lst[$k_list]);
                $expired_lst            = date_format($expired_sto_set_lst,"Y-m-d"); 
            
                $datains = array(  
                    'id_sto'          =>   $id_stoset,
                    'id_trx_det'      =>   $id_obat_lst,
                    'no_rak'          =>   $no_rak_lst,
                    'id_wrh'          =>   $id_wrh_set,
                    'min'             =>   $min_lst,
                    'qty_soh'         =>   $qty_last_lst,
                    'created'         =>   $datetime,
                    'creator'         =>   $username
                );
                $this->D_Sto->ins3($datains,'trx_lgs_sto_det');
            }
        }
        //end listing

        }


        $senddata = array(
            'id_wrh_set'    => $id_wrh_set,
            'id_stoset'     => $id_stoset
        );

        $dataset = json_encode($senddata);
		echo $dataset;
    }else{
        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $no_rak             = $no_rak_set[$k];
            $qty_last           = $qty_last_set[$k];
            $min                = $min_set[$k];
            $expired_sto_set    = date_create($expired_set[$k]);
            $expired            = date_format($expired_sto_set,"Y-m-d"); 
 
            $datains = array(  
                'id_sto'          =>   $no_sto_set,
                'id_trx_det'      =>   $id_obat,
                'no_rak'          =>   $no_rak,
                'id_wrh'          =>   $id_wrh_set,
                'min'             =>   $min,
                'qty_soh'         =>   $qty_last,
                'created'         =>   $datetime,
                'creator'         =>   $username
            );
            $this->D_Sto->ins1($datains,'trx_lgs_sto_det');

            $checkmstwrh                   = $this->D_Sto->cdk_gudang_sto($id_obat, $id_wrh_set, $id_rak_set);
            $datafind                      = $checkmstwrh->countget;
    
            if($datafind > 1){
                //nothing
            }else{
                $datains2 = array(  
                    'id_fa'          =>   $id_obat,
                    'id_wrh'         =>   $id_wrh_set,
                    'min'            =>   $min,
                    'no_rak'         =>   $no_rak,
                    'exp'            =>   $expired,
                    'created'        =>   $datetime,
                    'creator'        =>   $username
                );
                $this->D_Sto->ins2($datains2,'mst_wrh_mm');
            }
        }


        $senddata = array(
            'id_wrh_set'     => $id_wrh_set,
            'id_stoset'      => $no_sto_set
        );
        $dataset = json_encode($senddata);
		echo $dataset;
    }
    }
    function listpernosto(){
        $id_wrh         = $this->input->post('id_wrh_set');
        $no_sto_p       = $this->input->post('no_sto_p_set');
        $id_rak         = $this->input->post('id_rak_set');
        $data           = $this->D_Sto->list_obat_per_nosto_aftersave($no_sto_p,$id_wrh,$id_rak);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function listpernosto_set_rak(){
        $id_wrh         = $this->input->post('id_wrh_set');
        $no_sto_p       = $this->input->post('no_sto_p_set');
        $id_rak         = $this->input->post('id_rak_set');
        $data           = $this->D_Sto->list_obat_per_nosto_no_rak($id_wrh,$id_rak);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    
    function edit_start_sto(){ 
        $no_sto             = $this->input->post('id');
        $datasett           = $this->D_Sto->dliststo_edt_ststo_starttoend($no_sto);
        $row_1              = $datasett->id_wrh;
        $row_2              = $datasett->nama_gudang;
        $datestart_sto_set  = date_create($datasett->sto_startdate);
        $row_3              = date_format($datestart_sto_set,"d-m-Y H:i:s"); 
        $row_4              = $datasett->catatan;
        $data = array(
            'row_0'     => $no_sto,
            'row_1'     => $row_1,
            'row_2'     => $row_2,
            'row_3'     => $row_3,
            'row_4'     => $row_4
        );
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_end_sto(){
        $no_sto             = $this->input->post('id');
        $datasett           = $this->D_Sto->dliststo_edt_endsto($no_sto);
        $row_1              = $datasett->id_wrh;
        $row_2              = $datasett->nama_gudang;
        $datestart_sto_set  = date_create($datasett->sto_startdate);
        $row_3              = date_format($datestart_sto_set,"d-m-Y H:i:s");
        $dateend_sto_set    = date_create($datasett->sto_enddate);
        $row_4              = date_format($dateend_sto_set,"d-m-Y H:i:s");
        $row_5              = $datasett->catatan;
        $data = array(
            'row_0'     => $no_sto,
            'row_1'     => $row_1,
            'row_2'     => $row_2,
            'row_3'     => $row_3,
            'row_4'     => $row_4,
            'row_5'     => $row_5
        );
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit(){
        $no_sto     = $this->input->post('id');
        $datasett   = $this->D_Sto->dliststo_edt($no_sto);
        $row_1      = $datasett->id_wrh;
        $row_2      = $datasett->nama_gudang;
        $row_3      = $datasett->catatan;
        $row_4      = $datasett->no_rak;
        $row_5      = $datasett->nama_rak;
        $data = array(
            'row_0'     => $no_sto,
            'row_1'     => $row_1,
            'row_2'     => $row_2,
            'row_3'     => $row_3,
            'row_4'     => $row_4,
            'row_5'     => $row_5
        );
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab(){
        $nosto        = $this->input->post('no_sto_p_set');
        $id_wrh       = $this->input->post('id_wrh_set');
        $id_rak       = $this->input->post('id_rak_set');
        $data           = $this->D_Sto->list_obat_per_nosto_edt($id_wrh,$id_rak,$nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function edit_tab_ststo(){
        $nosto          = $this->input->post('no_sto_p_set');
        $data           = $this->D_Sto->list_obat_per_nosto_edt_ststo($nosto); 
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab_endsto(){
        $nosto          = $this->input->post('no_sto_p_set');
        $data           = $this->D_Sto->list_obat_per_nosto_edt_ststo_finish($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }
    function listobatpernosto_edt(){
        $nosto        = $this->input->post('no_sto_set');
        $data           = $this->D_Sto->list_obat_per_nosto_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    
    function editthis(){ //bikin fungsi edit sto
        $username              = @$this->session->userdata['sp']->login_name;
        $no_sto_set            = $this->input->post('edt_no_sto_p_set');
        $id_wrh_set            = $this->input->post('edt_id_wrh');
        $id_obat_set           = $this->input->post('edt_id_obat');
        $qty_last_set          = $this->input->post('edt_qty_last');
        $no_rak_set            = $this->input->post('edt_no_rak');
        $min_set               = $this->input->post('edt_min');
        $expired_set           = $this->input->post('edt_expired');
        $set_catatan_set       = $this->input->post('edt_set_catatan');
        $datetime              = date('Y-m-d H:i:s'); //ST011901
        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k];
            $no_rak             = $no_rak_set[$k];
            $qty_last           = $qty_last_set[$k];
            $min                = $min_set[$k];
            $expired_sto_set    = date_create($expired_set[$k]);
            $expired            = date_format($expired_sto_set,"Y-m-d"); 
 
            $datains = array(  
                'id_sto'          =>   $no_sto_set,
                'id_trx_det'      =>   $id_obat,
                'no_rak'          =>   $no_rak,
                'id_wrh'          =>   $id_wrh_set,
                'min'             =>   $min,
                'qty_soh'         =>   $qty_last,
                'created'         =>   $datetime,
                'creator'         =>   $username
            );
            $this->D_Sto->ins1($datains,'trx_lgs_sto_det'); 

            $checkmstwrh                   = $this->D_Sto->cdk_gudang_sto($id_obat, $id_wrh_set, $id_rak_set);
            $datafind                      = $checkmstwrh->countget;

            if($datafind > 1){
                //nothing
            }else{
                $datains2 = array(  
                    'id_fa'          =>   $id_obat,
                    'id_wrh'         =>   $id_wrh_set,
                    'min'            =>   $min,
                    'no_rak'         =>   $no_rak,
                    'exp'            =>   $expired,
                    'created'        =>   $datetime,
                    'creator'        =>   $username
                );
                $this->D_Sto->ins2($datains2,'mst_wrh_mm');
            }
        }

        $sql_up_note = "UPDATE trx_lgs_sto SET catatan='$set_catatan_set',updated='$datetime',updater='$username' WHERE id_sto='$no_sto_set'";
        $this->db->query($sql_up_note);

        $senddata = array(
            'id_wrh_set'    => $id_wrh_set,
            'id_stoset'     => $no_sto_set
        );

        $dataset = json_encode($senddata);
		echo $dataset;
    }
    function deleteitemedit(){
        $username       = @$this->session->userdata['sp']->login_name;
        $datetime       = date('Y-m-d H:i:s');
        $id_obat_set    = $this->input->post('id_obat');
        $id_wrh_set     = $this->input->post('id_wrh');
        $sql            = "UPDATE mst_wrh_mm SET aktif = '1',updated='$datetime',updater='$username' WHERE id_fa='$id_obat_set' AND id_wrh='$id_wrh_set'";
        $this->db->query($sql);
        $sql2           = "UPDATE trx_lgs_sto_det SET aktif = '0',updated='$datetime',updater='$username' WHERE id_trx_det='$id_obat_set' AND id_wrh='$id_wrh_set'";
        $this->db->query($sql2);
        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;
    }

    function update_note_ststo(){
        $username              = @$this->session->userdata['sp']->login_name;
        $no_sto_set            = $this->input->post('id_sto');
        $set_catatan_set       = $this->input->post('note');
        $datetime              = date('Y-m-d H:i:s');

        $sql_up_note = "UPDATE trx_lgs_sto SET catatan='$set_catatan_set',updated='$datetime',updater='$username' WHERE id_sto='$no_sto_set'";
        $this->db->query($sql_up_note);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function edit_rak(){
        $username           = @$this->session->userdata['sp']->login_name;
        $id_set             = $this->input->post('id');
        $idwrh_set          = $this->input->post('idwrh');
        $norak_set          = $this->input->post('norak'); 
        $id_sto             = $this->input->post('no_sto_p_set'); 
        $datetime           = date('Y-m-d H:i:s');

        $sql_up_lgs_det = "UPDATE trx_lgs_sto_det SET no_rak='$norak_set',updated='$datetime',updater='$username' WHERE id_sto='$id_sto' AND id_trx_det='$id_set'";
        $this->db->query($sql_up_lgs_det);

        $sql_up_wrh_mm = "UPDATE mst_wrh_mm SET no_rak='$norak_set',updated='$datetime',updater='$username' WHERE id_fa='$id_set' AND id_wrh='$idwrh_set'";
        $this->db->query($sql_up_wrh_mm);

        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function startstokopname_set_up(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id_sto             = $this->input->post('id_sto'); 
        $datestart_sto      = $this->input->post('datestart_sto');
        $datestart_sto_set  = date_create($datestart_sto);
        $res_start_sto_date = date_format($datestart_sto_set,"Y/m/d H:i:s");
        $sql = "UPDATE trx_lgs_sto SET sto_startdate='$res_start_sto_date',status = '1',updated='$datetime',updater='$username' WHERE id_sto='$id_sto'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function cancelstokopname_set_up(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id_sto     = $this->input->post('id_sto'); 
        $sql = "UPDATE trx_lgs_sto SET status = '3',updated='$datetime',updater='$username' WHERE id_sto='$id_sto'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function set_qty_on_startstokopname(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id         = $this->input->post('id'); 
        $qty        = $this->input->post('qty_nyah');
        $qtysetup   = $this->escape($qty);
        $sql = "UPDATE trx_lgs_sto_det SET qty='$qtysetup',updated='$datetime',updater='$username' WHERE id_trx='$id'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function endstokopname_set_up(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id_sto             = $this->input->post('id_sto'); 
        $dateend_sto      = $this->input->post('dateend_sto');
        $dateend_sto_set  = date_create($dateend_sto);
        $res_end_sto_date = date_format($dateend_sto_set,"Y/m/d H:i:s");
        $sql = "UPDATE trx_lgs_sto SET sto_enddate='$res_end_sto_date',status = '2',updated='$datetime',updater='$username' WHERE id_sto='$id_sto'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    public function print_list_sto($id_sto){
	
        $liststo    	= $this->D_Sto->get_data_liststo($id_sto);
        $getnote    	= $this->D_Sto->get_data_note($id_sto);
        $set_catatan    = $getnote->catatan;
    
        $data = array(
          'id_sto'      => $id_sto,
          'liststo'     => $liststo,
          'set_catatan' => $set_catatan
        );
        //return $data;
        $this->load->view('print', $data);
    }

}
?>