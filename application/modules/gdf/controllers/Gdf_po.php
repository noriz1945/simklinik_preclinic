<?php
class Gdf_PO extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_PO');
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
        $this->load->view('list_Gdf_PO');
    }
    function listdatarpo(){
        $tglmulai_set_get        = $this->input->post('tglmulai');
        $tglakhir_set_get        = $this->input->post('tglakhir');

        $tglmulai_set_get_crt    = date_create($tglmulai_set_get);
        $tglmulai_set            = date_format($tglmulai_set_get_crt,"Y-m-d"); 

        $tglakhir_set_get_crt    = date_create($tglakhir_set_get);
        $tglakhir_set            = date_format($tglakhir_set_get_crt,"Y-m-d"); 

        $data                    = $this->D_Gdf_PO->dlistrpo($tglmulai_set,$tglakhir_set);
		$dataset                 = json_encode($data);
		echo $dataset;
    }    
    public function mstpabrik(){
		$term = $this->input->get('term',true);
		$sql = "SELECT a.id_pabrik ,a.name AS nama_pabrik
						FROM mst_pabrik a 
						WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_pabrik'];
			$rs[$k]['id'] = $v['id_pabrik'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }
    
    public function mstgudang(){
		$term = $this->input->get('term',true);
		$sql = "SELECT a.id_wrh ,a.name AS nama_gudang
						FROM mst_warehouse a 
						WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_gudang'];
			$rs[$k]['id'] = $v['id_wrh'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }
    public function mstobat(){
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_fa AS id_obat,a.name AS nama_obat,qty AS qty_last
                FROM    mst_farmalkes a 
                LEFT JOIN mst_soh b ON a.id_fa = b.id_soh
                WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%' AND b.id_wrh='001'
                ";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_obat'];
			$rs[$k]['id'] = $v['id_obat'];
            $rs[$k]['qty_last'] = $v['qty_last'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }

    function check_data_mst_obat(){
        $id_obat_set          = $this->input->post('id_obat');
        $id_wrh_set           = $this->input->post('id_wrh');
        $data                 = $this->D_Gdf_PO->data_check_mst_obat($id_obat_set,$id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }


    function checksohitemini(){
        $id_obat_set          = $this->input->post('id_obat');
        $data                 = $this->D_Gdf_PO->data_soh_obat($id_obat_set);
		$dataset = json_encode($data);
		echo $dataset;
    }

    function save(){
        $username              = @$this->session->userdata['sp']->login_name;
        $no_rpo_set            = $this->input->post('no_rpo_p_set');
        $id_wrh_set            = $this->input->post('id_wrh');
        $id_obat_set           = $this->input->post('id_obat');
        $qty_last_set          = $this->input->post('qty_last');
        $qty_depo_set          = $this->input->post('qty_depo');
        $qty_fts_set           = $this->input->post('qty_fts');
        $qty                   = $this->input->post('qty');
        $id_pabrik             = $this->input->post('id_pabrik');
        $pabrik                = $this->input->post('pabriksearch');
        $tanggal_po            = $this->input->post('tanggal_po');
        $tanggal_po_set        = date_create($tanggal_po);
        $tanggalpo_set         = date_format($tanggal_po_set,"Y-m-d");
        $harga_satuan_set      = $this->input->post('harga_satuan');
        $total_harga_set       = $this->input->post('total_harga');

        $datetime              = date('Y-m-d H:i:s'); 
        $datetime_req          = date('Y-m-d'); 
        if(empty($no_rpo_set)){
        //gen no sto
        $checkid                       = $this->D_Gdf_PO->cdk();
        $setnoreg                      = $checkid->id_rpo;
        $prefix       = "RPO-";
        $datereal_tgl = date('d');
        $datereal_bln = date('m');
        $datereal_thn = date('y');
        $setidregfnc = $setnoreg;
        $setnoreg_bln = substr($setidregfnc, 6, 2);
        $setnoreg_thn = substr($setidregfnc, 8, 2);
        $urutan_reg = (int) substr($setidregfnc, 10, 16);
        //echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";
        if(($datereal_bln==$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){
            $setincrement_reg = $urutan_reg+1;
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.sprintf("%06s", $setincrement_reg);
        }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
            $setincrement_reg = "000001";
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
            $setincrement_reg = "000001";
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }else{
            $setincrement_reg = "000001";
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }
        //end gen no sto
        $datains = array(  
            'id_rpo'            =>   $id_gdfset,
            'request_date'      =>   $datetime_req,
            'from'              =>   $id_wrh_set,
            'id_pabrik'         =>   $id_pabrik,
            'pabrik'            =>   $pabrik,
            'tanggal'           =>   $tanggalpo_set, 
            'status'            =>   0,
            'created'           =>   $datetime,
            'created_by'        =>   $username
        );
        $this->D_Gdf_PO->ins1($datains,'gdf_rpo'); 

        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $qty_req            = $qty[$k];
            $qty_last           = $qty_last_set[$k];
            $qty_depo           = $qty_depo_set[$k];
            $qty_fts            = $qty_fts_set[$k];
            $harga_satuan       = $harga_satuan_set[$k];
            $total_harga        = $total_harga_set[$k];
 
            $datains = array(  
                'id_rpo'          =>   $id_gdfset,
                'id_obat'         =>   $id_obat,
                'qty'             =>   $qty_req,
                'qty_last'        =>   $qty_last,
                'qty_depo'        =>   $qty_depo,
                'qty_fts'         =>   $qty_fts, 
                'harga_satuan'    =>   $this->escape($harga_satuan),
                'total_harga'     =>   $this->escape($total_harga),
                'created'         =>   $datetime,
                'created_by'      =>   $username
            );
            $this->D_Gdf_PO->ins1($datains,'gdf_rpo_det');

        }



        $senddata = array(
            'id_wrh_set'    => $id_wrh_set,
            'id_gdfset'     => $id_gdfset
        );

        $dataset = json_encode($senddata);
		echo $dataset;
    }else{
        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $qty_req            = $qty[$k];
            $qty_last           = $qty_last_set[$k];
            $qty_depo           = $qty_depo_set[$k];
            $qty_fts            = $qty_fts_set[$k];
            $harga_satuan       = $harga_satuan_set[$k];
            $total_harga        = $total_harga_set[$k];
 
            $datains = array(  
                'id_rpo'          =>   $no_rpo_set,
                'id_obat'         =>   $id_obat,
                'qty'             =>   $qty_req,
                'qty_last'        =>   $qty_last,
                'qty_depo'        =>   $qty_depo,
                'qty_fts'         =>   $qty_fts,
                'harga_satuan'    =>   $this->escape($harga_satuan),
                'total_harga'     =>   $this->escape($total_harga),
                'created'         =>   $datetime,
                'created_by'      =>   $username
            );
            $this->D_Gdf_PO->ins1($datains,'gdf_rpo_det');

        }


        $senddata = array(
            'id_wrh_set'     => $id_wrh_set,
            'id_gdfset'      => $no_rpo_set
        );
        $dataset = json_encode($senddata);
		echo $dataset;
    }
    }
    function listpernorpo(){
        $no_rpo_p       = $this->input->post('no_rpo_p_set');
        $data           = $this->D_Gdf_PO->list_obat_per_norpo($no_rpo_p);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function edit(){
        $no_rpo     = $this->input->post('id');
        $datasett   = $this->D_Gdf_PO->dlistrpo_edt($no_rpo);
        $row_1      = $datasett->from;
        $row_2      = $datasett->nama_gudang;
        $row_3      = $datasett->pabrik;
        $row_4      = $datasett->id_pabrik;
        $row_5      = $datasett->tanggal;
        $data = array(
            'row_0'     => $no_rpo,
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
        $nosto        = $this->input->post('no_rpo_p_set');
        $data           = $this->D_Gdf_PO->list_obat_per_norpo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function edit_tab_ststo(){
        $nosto          = $this->input->post('no_rpo_p_set');
        $data           = $this->D_Gdf_PO->list_obat_per_norpo_edt_ststo($nosto); 
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab_endsto(){
        $nosto          = $this->input->post('no_rpo_p_set');
        $data           = $this->D_Gdf_PO->list_obat_per_norpo_edt_ststo_finish($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }
    function listobatpernosto_edt(){
        $nosto        = $this->input->post('no_rpo_set');
        $data           = $this->D_Gdf_PO->list_obat_per_norpo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    
    function editthis(){ //bikin fungsi edit sto
        $username              = @$this->session->userdata['sp']->login_name;
        $no_rpo_set            = $this->input->post('edt_no_rpo_p_set');
        $id_wrh_set            = $this->input->post('edt_id_wrh');
        $id_obat_set           = $this->input->post('edt_id_obat');
        $qty_last_set          = $this->input->post('edt_qty_last');
        $qty_depo_set          = $this->input->post('edt_qty_depo');
        $qty_fts_set           = $this->input->post('qty_fts');
        $qty_set               = $this->input->post('edt_qty');
        $id_pabrik             = $this->input->post('edt_id_pabrik');
        $pabrik                = $this->input->post('edt_pabriksearch');
        $tanggal_po            = $this->input->post('tanggal_po');
        $tanggal_po_set        = date_create($tanggal_po);
        $tanggalpo_set         = date_format($tanggal_po_set,"Y-m-d");
        $harga_satuan_set      = $this->input->post('edt_harga_satuan');
        $harga_total_set       = $this->input->post('edt_total_harga');
        $datetime              = date('Y-m-d H:i:s'); //ST011901
        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $qty                = $qty_set[$k];
            $qty_last           = $qty_last_set[$k];
            $qty_depo           = $qty_depo_set[$k];
            $qty_fts            = $qty_fts_set[$k];
            $harga_satuan       = $harga_satuan_set[$k];
            $harga_total        = $harga_total_set[$k];
 
            $datains = array(  
                'id_rpo'          =>   $no_rpo_set,
                'id_obat'         =>   $id_obat,
                'qty'             =>   $qty,
                'qty_last'        =>   $qty_last,
                'qty_depo'        =>   $qty_depo,
                'qty_fts'         =>   $qty_fts,
                'harga_satuan'    =>   $this->escape($harga_satuan),
                'total_harga'     =>   $this->escape($harga_total),
                'created'         =>   $datetime,
                'created_by'      =>   $username
            );
            $this->D_Gdf_PO->ins1($datains,'gdf_rpo_det');

        }

        $sql_par        = "UPDATE gdf_rpo SET id_pabrik='$id_pabrik',pabrik='$pabrik',tanggal='$tanggalpo_set',updated='$datetime',updated_by='$username' WHERE id_rpo='$no_rpo_set'";
        $set_par        = $this->db->query($sql_par);

        $senddata = array(
            'id_wrh_set'    => $id_wrh_set,
            'id_gdfset'     => $no_rpo_set
        );

        $dataset = json_encode($senddata);
		echo $dataset;
    }
    function deleteitemedit(){
        $username       = @$this->session->userdata['sp']->login_name;
        $datetime       = date('Y-m-d H:i:s');
        $id_set         = $this->input->post('id_obat');
        $sql            = "UPDATE gdf_rpo_det SET hapus = '1',updated='$datetime',updated_by='$username' WHERE id='$id_set'";
        $this->db->query($sql);
        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;
    }

    function cancelstokopname_set_up(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id_rpo     = $this->input->post('id_rpo'); 
        $sql = "UPDATE gdf_rpo SET status = '1',updated='$datetime',updated_by='$username' WHERE id_rpo='$id_rpo'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    
    public function print_sp($id_rpo){
	
        $datapabrik     = $this->D_Gdf_PO->get_data_pabrik($id_rpo);
        $nama_pabrik    = $datapabrik->nama_pabrik;
        $alamat_pabrik  = $datapabrik->alamat_pabrik;
        $datasp    	    = $this->D_Gdf_PO->get_data_sp($id_rpo);
    
        $data = array(
          'id_rpo'          => $id_rpo,
          'nama_pabrik'     => $nama_pabrik,
          'alamat_pabrik'   => $alamat_pabrik,
          'datasp'          => $datasp
        );
        //return $data;
        $this->load->view('print_sp', $data);
    }

}
?>