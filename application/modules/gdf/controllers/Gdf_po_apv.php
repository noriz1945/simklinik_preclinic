<?php
class Gdf_po_apv extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_PO_Apv');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_PO_Apv');
    }
    function listdatarpo(){
        $tglmulai_set_get        = $this->input->post('tglmulai');
        $tglakhir_set_get        = $this->input->post('tglakhir');

        if(empty($tglmulai_set_get)){
            $tglmulai_set            = date('Y-m-d');
        }else{
            $tglmulai_set_get_crt    = date_create($tglmulai_set_get);
            $tglmulai_set            = date_format($tglmulai_set_get_crt,"Y-m-d"); 
        }

        if(empty($tglakhir_set_get)){
            $tglakhir_set            = date('Y-m-t');
        }else{
            $tglakhir_set_get_crt    = date_create($tglakhir_set_get);
            $tglakhir_set            = date_format($tglakhir_set_get_crt,"Y-m-d");

        }


        $data                    = $this->D_Gdf_PO_Apv->dlistrpo($tglmulai_set,$tglakhir_set);
		$dataset                 = json_encode($data);
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
        $data                 = $this->D_Gdf_PO_Apv->data_check_mst_obat($id_obat_set,$id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }


    function checksohitemini(){
        $id_obat_set          = $this->input->post('id_obat');
        $data                 = $this->D_Gdf_PO_Apv->data_soh_obat($id_obat_set);
		$dataset = json_encode($data);
		echo $dataset;
    }


    function listpernorpo(){
        $no_rpo_p       = $this->input->post('no_rpo_p_set');
        $id_wrh         = $this->input->post('id_wrh_set');
        $data           = $this->D_Gdf_PO_Apv->list_obat_per_norpo($no_rpo_p, $id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function listpernorpo_depo(){
        $no_rpo_p       = $this->input->post('no_rpo_p_set'); 
        $id_wrh_set     = $this->input->post('id_wrh_set');
        $data           = $this->D_Gdf_PO_Apv->list_obat_per_norpo_depo($no_rpo_p, $id_wrh_set);
		$dataset = json_encode($data);
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

    function edit(){
        $no_rpo     = $this->input->post('id');
        $datasett   = $this->D_Gdf_PO_Apv->dlistrpo_edt($no_rpo);
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
        $data           = $this->D_Gdf_PO_Apv->list_obat_per_norpo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    


    function editthis(){ //bikin fungsi edit sto
        $username              = @$this->session->userdata['sp']->login_name;
        $no_rpo_set            = $this->input->post('edt_no_rpo_p_set');
        $id_wrh_set            = $this->input->post('edt_id_wrh');
        $closedate             = date('Y-m-d');
        $id_obat_set           = $this->input->post('edt_id_obat');
        $qty_last_set          = $this->input->post('edt_qty_last');
        $qty_depo_set          = $this->input->post('edt_qty_depo');
        $qty_fts_set           = $this->input->post('qty_fts');
        $qty_set               = $this->input->post('edt_qty');
        $id_pabrik             = $this->input->post('id_pabrik');
        $pabrik                = $this->input->post('pabriksearch');
        $tanggal_po            = $this->input->post('tanggal_po');
        $tanggal_po_set        = date_create($tanggal_po);
        $tanggalpo_set         = date_format($tanggal_po_set,"Y-m-d");
        $harga_satuan_set      = $this->input->post('edt_harga_satuan');
        $harga_total_set       = $this->input->post('edt_total_harga');
        $datetime              = date('Y-m-d H:i:s'); //ST011901
        if($id_obat_set==''){
            //nothing
        }else{
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
            $this->D_Gdf_PO_Apv->ins1($datains,'gdf_rpo_det');

        }
        }
        $sql_par        = "UPDATE gdf_rpo SET id_pabrik='$id_pabrik',pabrik='$pabrik',tanggal='$tanggalpo_set',updated='$datetime',updated_by='$username' WHERE id_rpo='$no_rpo_set'";
        $set_par        = $this->db->query($sql_par);
        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;
    }
    function editthis_apv(){ //bikin fungsi edit sto
        $username              = @$this->session->userdata['sp']->login_name;
        $nosto                 = $this->input->post('edt_no_rpo_p_set');
        $closedate             = date('Y-m-d');
        $id_pabrik             = $this->input->post('id_pabrik');
        $pabrik                = $this->input->post('pabriksearch');
        $tanggal_po            = $this->input->post('tanggal_po');
        $tanggal_po_set        = date_create($tanggal_po);
        $tanggalpo_set         = date_format($tanggal_po_set,"Y-m-d");
        $datetime              = date('Y-m-d H:i:s'); //ST011901

        ///////////////////
        $sql            = "UPDATE gdf_rpo_det SET status = '1',updated='$datetime',updated_by='$username' WHERE id_rpo='$nosto'";
        $set_det        = $this->db->query($sql);
        $sql_par        = "UPDATE gdf_rpo SET id_pabrik='$id_pabrik',pabrik='$pabrik',tanggal='$tanggalpo_set',closedate='$closedate',status = '2',updated='$datetime',updated_by='$username' WHERE id_rpo='$nosto'";
        $set_par        = $this->db->query($sql_par);
        ///////////////////
        $data           ="ok";
        $dataset        = json_encode($data);
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


    
    function set_qty_on_rpo(){
        $username       = @$this->session->userdata['sp']->login_name;
        $datetime       = date('Y-m-d H:i:s');
        $id             = $this->input->post('id'); 
        $qty            = $this->input->post('qty_apv_nyah');
        $qty_depo       = $this->input->post('edt_qty_depo');
        $hargasatuan_set    = $this->input->post('hargasatuan'); 
        $totalnyah_set    = $this->input->post('totalnyah');
        $qty_depo       = $this->input->post('edt_qty_depo');
        $qtysetup       = $this->escape($qty);
        $hargasatuan       = $this->escape($hargasatuan_set);
        $totalnyah_set       = $this->escape($totalnyah_set);

        $qty_soh_depo = ($qty_depo+$qtysetup);

        $sql = "UPDATE gdf_rpo_det SET qty_aprv='$qtysetup',qty_soh_depo='$qty_soh_depo',harga_satuan='$hargasatuan',total_harga='$totalnyah_set',updated='$datetime',updated_by='$username' WHERE id='$id'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }


}
?>