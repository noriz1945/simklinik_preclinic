<?php
class Farmasi extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Farmasi');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('SmartLib');
    }

    function index(){
        $datapasien         = $this->D_Farmasi->mpasien();
        $data = array(
            'datapasien'    => $datapasien
        );
        $this->load->view('list_pasien', $data);
    }
    
    function pasienaps(){
        $datapasien         = $this->D_Farmasi->mpasien_aps();
        $data = array(
            'datapasien'    => $datapasien
        );
        $this->load->view('list_pasien_aps', $data);
    }

    function rm($id_eresep){
		$dataidreg      = $this->D_Farmasi->fndidreg($id_eresep);
		$id_reg 		= $dataidreg->id_reg;
        $data = array(
			'id_reg'		=> $id_reg,
			'id_eresep'		=> $id_eresep
        );
        $this->load->view('farmasi', $data);
    }

	function data_list_farmasi_header(){
		$datasett   	= $this->D_Farmasi->data_list_farmasi_header();
		$dataset 		= json_encode($datasett);
		echo $dataset;
	}

	function data_list_farmasi(){
		$datasett   	= $this->D_Farmasi->data_list_farmasi();
		$dataset 		= json_encode($datasett);
		echo $dataset;
	}		
	
	### ADDED function by sarkodan	
	function aps($id_reg){				
		$dataeresep = $this->D_Farmasi->fnderesepbyreg($id_reg);
		if($dataeresep->id_eresep=='')		
		{			
			$new_data_eresep['eresepdate'] = date("Y-m-d H:i:s");
			$new_data_eresep['id_reg'] = $id_reg;
			$this->db->insert('soap_eresep', $new_data_eresep);
			
			$dataeresep = $this->D_Farmasi->fnderesepbyreg($id_reg);
			$id_eresep = $dataeresep->id_eresep;
		}		
		else
		{
			$id_eresep = $dataeresep->id_eresep;
		}				
		$dataidreg      = $this->D_Farmasi->fndidreg($id_eresep);
		$id_reg 		= $dataidreg->id_reg;
		$data = array(
			'id_reg'		=> $id_reg,
			'id_eresep'		=> $id_eresep 
		);        
		$this->load->view('farmasi', $data);
	}			
	    //bypass
    function byps(){
        $datapasien         = $this->D_Farmasi->mpasien();
        $data = array(
            'datapasien'    => $datapasien
        );
        $this->load->view('list_pasien_bypass', $data);
    }
    
    function rmbs($id_eresep){
		$dataidreg      = $this->D_Farmasi->fndidreg($id_eresep);
		$id_reg 		= $dataidreg->id_reg;
        $data = array(
			'id_reg'		=> $id_reg,
			'id_eresep'		=> $id_eresep
        );
        $this->load->view('farmasi_bypass', $data);
    }
    //end bypass

}
?>