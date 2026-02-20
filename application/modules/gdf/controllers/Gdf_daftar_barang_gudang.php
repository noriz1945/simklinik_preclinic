<?php
class Gdf_daftar_barang_gudang extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_daftar_barang_gudang');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_daftar_barang_gudang');
    }

    function listdatarpo(){
        $idwrh_set_get          = $this->input->post('idwrh');


        $data                    = $this->D_Gdf_daftar_barang_gudang->dlistrpo($idwrh_set_get);
		$dataset                 = json_encode($data);
		echo $dataset;
    }    


    public function mstobat(){
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_wrh ,a.name AS nama_gudang
						FROM 		mst_warehouse a 
						WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
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

    
}
?>