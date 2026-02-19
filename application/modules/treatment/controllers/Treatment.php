<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Treatment extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('trx_reg/Trx_reg_model');
		$this->load->model('Treatment_model');
		$this->load->library('FormGenerator');
    }
	
	public function index($id_reg)
    {
		$data_reg = $this->Trx_reg_model->get_by_id($id_reg);
		$data_treatment = $this->Treatment_model->data_treatment($id_reg);
		#$data_eresep_open = $this->Pembayaran_model->data_eresep_open($id_reg);
		$sql_id_dokter = "	SELECT 	a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							WHERE	a.aktif=1
							ORDER BY a.name";
		$sql_kunjungan = "		(SELECT 1 as kunj_ke,CONCAT('1','. ',a.`regdate`) as kunjdate 
								FROM 	`trx_reg` a 
								WHERE 	a.`id_reg`='".$id_reg."'
								)
							UNION ALL
								(SELECT 	a.`kunj_ke`,CONCAT(a.`kunj_ke`,'. ',a.`kunjdate`) as kunjdate 
								FROM 	`trx_reg_paket_kunj` a 
								WHERE 	a.`id_reg`='".$id_reg."'
										AND a.kunj_ke>1
								ORDER BY a.kunj_ke)";
		$dropdown_nakes1 = $dropdown_nakes2 = $dropdown_nakes3 = array();
		foreach($data_treatment as $k => $v)
		{
			$readonly = false;
			if($v->id_inv!='') $readonly = true;
			$data_treatment[$k]->dropdown_nakes = $this->formgenerator->get_dropdown('id_dokter[]',$sql_id_dokter,$v->id_dokter,$readonly);
			$data_treatment[$k]->dropdown_nakes2 = $this->formgenerator->get_dropdown('id_dokter2[]',$sql_id_dokter,$v->id_dokter2,$readonly);
			$data_treatment[$k]->dropdown_nakes3 = $this->formgenerator->get_dropdown('id_dokter3[]',$sql_id_dokter,$v->id_dokter3,$readonly);
			
			$data_treatment[$k]->dropdown_kunj_ke = $this->formgenerator->get_dropdown('kunj_ke[]',$sql_kunjungan,$v->kunj_ke);
			
			$data_treatment[$k]->checked_treatment = ($v->treatment==1)?'checked':'';
		}
		$data = array(
            'id_reg'			 => $id_reg,
			'data_reg'			 => $data_reg,
			'data_treatment'	 => $data_treatment,
        );
		$this->load->view('treatment_list', $data);
    }
	
	function inner_load_treatment($id_reg,$modal="")
	{
		$data_treatment = $this->Treatment_model->data_treatment($id_reg);
		#$data_eresep_open = $this->Pembayaran_model->data_eresep_open($id_reg);
		$data = array(
            'id_reg'			=> $id_reg,
			'data_treatment'	=> $data_treatment,
        );
		if($modal!='')
			$this->load->view('inner_data_treatment_modal', $data);
		else
			$this->load->view('inner_data_treatment', $data);
	}
	
	public function treatment_update()
    {
		#$this->output->enable_profiler(true);
		$id_reg     = $this->input->post('id_reg');
		$id_trx     = $this->input->post('id_trx');
		$chk_id_trx = $this->input->post('chk_id_trx');
		$kunj_ke    = $this->input->post('kunj_ke');
		$id_dokter  = $this->input->post('id_dokter');
		$id_dokter2 = $this->input->post('id_dokter2');
		$id_dokter3 = $this->input->post('id_dokter3');
		
		$this->db->trans_begin();
		foreach($id_trx as $k => $v)
		{
			if(@$chk_id_trx[$v]!='')
			{
				$treament_i = 1;
				$kunj_ke_i = $kunj_ke[$k];
				if($id_dokter[$k] !='') $id_dokter_i  = $id_dokter[$k] ; else $id_dokter_i  = null;
				if($id_dokter2[$k]!='') $id_dokter2_i = $id_dokter2[$k]; else $id_dokter2_i = null;
				if($id_dokter3[$k]!='') $id_dokter3_i = $id_dokter3[$k]; else $id_dokter3_i = null;
			}
			else
			{
				$treament_i   = 0;
				$kunj_ke_i    = 0;
				$id_dokter_i  = null;
				$id_dokter2_i = null;
				$id_dokter3_i = null;
			}
			$data_treament = array();
			$data_treament['treatment']  = $treament_i;
			$data_treament['kunj_ke']    = $kunj_ke_i;
			$data_treament['id_dokter']  = $id_dokter_i;
			$data_treament['id_dokter2'] = $id_dokter2_i;
			$data_treament['id_dokter3'] = $id_dokter3_i;
			$data_treament['trxdate'] 	 = date('Y-m-d H:i:s');
			$data_treament['updater']    = $this->session->userdata['sp']->name;
			$data_treament['updated']    = date('Y-m-d H:i:s');
			$this->Treatment_model->update('trx_reg_act','id_trx',$v,$data_treament);
		}
		
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
		}
		else
		{
				#$this->db->trans_rollback();
				$this->db->trans_commit();
		}
		redirect(site_url('trx_reg'));
	}
	/*
	function update_treatment($id_trx,$grup="")
	{
		if($grup=='FARMASI')
			$sql = "UPDATE soap_eresep_det SET treatment = (CASE WHEN treatment=1 THEN 0 ELSE 1 END) WHERE id_eresep_det='".$id_trx."'";
		else
			$sql = "UPDATE trx_reg_act SET treatment = (CASE WHEN treatment=1 THEN 0 ELSE 1 END) WHERE id_trx='".$id_trx."'";
		$query = $this->db->query($sql);
		
		echo 'OK';
	}
	*/
}

?>
