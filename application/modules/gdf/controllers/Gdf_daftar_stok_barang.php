<?php
class Gdf_daftar_stok_barang extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_daftar_stok_barang');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_daftar_stok_barang');
    }

    function listdatarpo(){
        $idobat_set_get          = $this->input->post('idobat');


        $data                    = $this->D_Gdf_daftar_stok_barang->dlistrpo($idobat_set_get);
		$dataset                 = json_encode($data);
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