<?php
class Gdf_kartu_stok extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_kartu_stok');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_kartu_stok');
    }

    function listdatarpo(){
        $tglmulai_set_get        = $this->input->post('tglmulai');
        $tglakhir_set_get        = $this->input->post('tglakhir');
        $idwarehouse_set_get     = $this->input->post('idwarehouse');
        $idobat_set_get          = $this->input->post('idobat');

        $tglmulai_set_get_crt    = date_create($tglmulai_set_get);
        $tglmulai_set            = date_format($tglmulai_set_get_crt,"Y-m-d"); 

        $tglakhir_set_get_crt    = date_create($tglakhir_set_get);
        $tglakhir_set            = date_format($tglakhir_set_get_crt,"Y-m-d"); 

        $data                    = $this->D_Gdf_kartu_stok->dlistrpo($tglmulai_set,$tglakhir_set,$idwarehouse_set_get,$idobat_set_get);
		$dataset                 = json_encode($data);
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

    
}
?>