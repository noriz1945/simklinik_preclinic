<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require 'vendor/autoload.php';
		use PhpOffice\PhpSpreadsheet\Spreadsheet;
		use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
		use PhpOffice\PhpSpreadsheet\Shared\Font;

class V_jasmed extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('V_jasmed_model');
		$this->load->library('FormGenerator');
    }
	
	public function index($auto_print_id_jasmed="")
	{
		$periode_start 	= $this->input->post('periode_start');
		$periode_start 	= ($periode_start=='') ? date('Y-m-d',mktime(0,0,0,date('m'),1,date('Y'))) : $periode_start;
        $periode_end 	= $this->input->post('periode_end');
		$periode_end 	= ($periode_end=='')?date('Y-m-d'):$periode_end;
		$id_jenis 		= $this->input->post('id_jenis');
		$id_nakes 		= $this->input->post('id_nakes');
		
        $trx_jasmed_data = $this->V_jasmed_model->data_jasmed($periode_start,$periode_end,$id_nakes);
		
		$sql_id_nakes = "	SELECT 	a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							ORDER BY a.name";
		$sql_id_jenis_nakes = "SELECT a.id_jenis,a.name FROM mst_dokter_type a ORDER BY a.id_jenis";
		$num_rows = 0;
		$data = array(
			'trx_jasmed_data'			=> $trx_jasmed_data,
			'periode_start' 			=> $periode_start,
			'periode_end' 				=> $periode_end,
			'num_rows'					=> $num_rows,
			'dropdown_id_jenis_nakes' 	=> $this->formgenerator->get_dropdown('id_jenis',$sql_id_jenis_nakes,$id_jenis),
			'dropdown_id_nakes' 		=> $this->formgenerator->get_dropdown('id_nakes',$sql_id_nakes,$id_nakes),
			'auto_print_id_jasmed'		=> $auto_print_id_jasmed,
		);
		$this->load->view('jasmed_list', $data);
	}
	
	public function add()
	{
		$periode_start 	= $this->input->post('periode_start');
		$periode_start 	= ($periode_start=='')?date('Y-m-d'):$periode_start;
        $periode_end 	= $this->input->post('periode_end');
		$periode_end 	= ($periode_end=='')?date('Y-m-d'):$periode_end;
		$sql_id_nakes = "	SELECT 	a.id_dokter AS id_nakes,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							ORDER BY a.name";
		$waktu_jasmed = date('Y-m-d H:i:s');
		$data = array(
			'id_jasmed'			=> '',
			'periode_start' 	=> $periode_start,
			'periode_end' 		=> $periode_end,
			'waktu_jasmed' 		=> $waktu_jasmed,
			'dropdown_id_nakes' => $this->formgenerator->get_dropdown('id_nakes',$sql_id_nakes),
			'subtotal' 			=> 0,
			'total' 			=> 0,
			
		);
		$this->load->view('jasmed_add', $data);
	}
	
	public function add_detail()
    {
		#$this->output->enable_profiler(true);
		$id_nakes 		= $this->input->post('id_nakes');
		
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
        
        $v_jasmed = $this->V_jasmed_model->data_add_detail($id_nakes,$periode_start,$periode_end);
		$curr_id_nakes = '';
		$curr_id_reg = '';
		$curr_id_inv = '';
		$i = 1;
		$num_rows = 0;
		foreach ($v_jasmed as $k => $v)
		{
			if($curr_id_nakes != $v->id_nakes)
			{
				$v_jasmed[$k]->nomor = $i;
				#$v_jasmed[$k]->nakes = $v->nakes;
				
				$curr_id_nakes = $v->id_nakes;
				$v_jasmed[$k]->id_reg_text = $v->id_reg;
				$v_jasmed[$k]->id_inv_text = $v->id_inv;
				$curr_id_reg = $v->id_reg;
				$curr_id_inv = $v->id_inv;
				$i++;
			}
			else
			{
				if($curr_id_reg != $v->id_reg)
				{
					$curr_id_reg = $v->id_reg;
					$curr_id_inv = $v->id_inv;
					
					$v_jasmed[$k]->id_reg_text = $v->id_reg;
					$v_jasmed[$k]->id_inv_text = $v->id_inv;
					$v_jasmed[$k]->nomor = '';
					$v_jasmed[$k]->jenis_nakes = '';
					$v_jasmed[$k]->nakes = '';
					$v_jasmed[$k]->id_pasien = '';
				}
				else
				{
					if($curr_id_inv != $v->id_inv)
					{
						$v_jasmed[$k]->id_inv_text = $v->id_inv;
						$curr_id_inv = $v->id_inv;
					}
					else
					{						
						$v_jasmed[$k]->nomor = '';
						$v_jasmed[$k]->jenis_nakes = '';
						$v_jasmed[$k]->nakes = '';
						$v_jasmed[$k]->id_pasien = '';
						$v_jasmed[$k]->id_reg_text = '';
						$v_jasmed[$k]->tgl_reg = '';
						$v_jasmed[$k]->pasien = '';
						$v_jasmed[$k]->asuransi = '';
						$v_jasmed[$k]->id_inv_text = '';
						$v_jasmed[$k]->tgl_inv = '';
					}
					
					$v_jasmed[$k]->nomor = '';
					$v_jasmed[$k]->jenis_nakes = '';
					$v_jasmed[$k]->nakes = '';
					$v_jasmed[$k]->id_pasien = '';
					$v_jasmed[$k]->id_reg_text = '';
					$v_jasmed[$k]->tgl_reg = '';
					$v_jasmed[$k]->pasien = '';
					#$v_jasmed[$k]->asuransi = '';
				}
				
			}
			$num_rows++;
		}
		
		$sql_id_nakes = "	SELECT 	a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							ORDER BY a.name";
        $data = array(
            'v_jasmed_data' 	=> $v_jasmed,
            'periode_start' 	=> $periode_start,
			'periode_end' 		=> $periode_end,
			'i'					=> $i-1,
			'num_rows'			=> $num_rows,
			'dropdown_id_nakes' => $this->formgenerator->get_dropdown('id_nakes',$sql_id_nakes),
        );
        $this->load->view('jasmed_add_detail', $data);
    }
	
	public function save()
	{
		#$this->output->enable_profiler(true);
		#return;
		
		$this->db->trans_begin();
		### --- SIAPIN data header duluan ----------------------------
		$data_r = array();
		$data_r['waktu_jasmed'] 	= date("Y-m-d H:i:s");
		$data_r['id_nakes'] 		= $this->input->post('r_id_nakes');
		$data_r['periode_start'] 	= $this->input->post('r_periode_start');
		$data_r['periode_end'] 		= $this->input->post('r_periode_end');
		$data_r['subtotal'] 		= $this->input->post('r_total');
		$data_r['total'] 			= $this->input->post('r_total');
		$data_r['creator'] 			= $this->session->userdata['sp']->login_name;
		$data_r['created'] 			= date("Y-m-d H:i:s");
		$this->db->insert('trx_jasmed', $data_r);
		$id_jasmed = $this->db->insert_id();
		
		### --- SIAPIN data anakan -----------------------------------
		$id_trx 		= $this->input->post('id_trx');
		$tindakan 		= $this->input->post('tindakan');
		$tarif 			= $this->input->post('tarif');
		$persen_vendor 	= $this->input->post('persen_vendor');
		$persen_nakes 	= $this->input->post('persen_nakes');
		$persen_rs 		= $this->input->post('persen_rs');
		$share_vendor 	= $this->input->post('share_vendor');
		$share_nakes 	= $this->input->post('share_nakes');
		$share_rs 		= $this->input->post('share_rs');
		
		$data_d 		= array();
		if(is_array($id_trx) && !empty($id_trx))
		{
			foreach($id_trx as $k => $v)
			{
				$data_d['id_jasmed'] 		= $id_jasmed;
				$data_d['id_trx'] 			= $v;
				$data_d['tindakan'] 		= $tindakan[$k];
				$data_d['tarif'] 			= $tarif[$k];
				$data_d['persen_vendor'] 	= $persen_vendor[$k];
				$data_d['persen_nakes'] 	= $persen_nakes[$k];
				$data_d['persen_rs'] 		= $persen_rs[$k];
				$data_d['share_vendor'] 	= $share_vendor[$k];
				$data_d['share_nakes'] 		= $share_nakes[$k];
				$data_d['share_rs'] 		= $share_rs[$k];
			
				$this->db->insert('trx_jasmed_det', $data_d);
				
				### --- UPDATE trx_reg, add id_jasmed ---
				$this->db->set('id_jasmed', $id_jasmed);
				$this->db->where('id_trx', $v);
				$this->db->update('trx_reg_act');
				### -------------------------------------
			}
		}
		if ($this->db->trans_status() === FALSE)
		{
			$errNo   = $this->db->_error_number();
			$errMess = $this->db->_error_message();
			
			$this->db->trans_rollback();
			
			echo 'Proses Share Nakes Gagal'."<br>";
			echo $errNo . "<br>";
			echo $errMess . "<br>";
		}
		else
		{
			#$this->db->trans_rollback();
			$this->db->trans_commit();
			redirect('v_jasmed/index/'.$id_jasmed);
		}
	}
	
	public function cetak_share_nakes($id_jasmed)
	{
		#$var1 = $this->input->post('var1');
		$share_nakes_header = $this->V_jasmed_model->share_nakes_header($id_jasmed);
		$share_nakes_header = (object) $share_nakes_header;
		
		$share_nakes_detail = $this->V_jasmed_model->share_nakes_detail($id_jasmed);
		
		$data = array(
			'share_nakes_header' => $share_nakes_header,
			'share_nakes_detail' => $share_nakes_detail,
		);
		$this->load->view('cetak_share_nakes', $data);
	}
	
	public function bahan()
    {
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
		
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
        
        $v_jasmed = $this->V_jasmed_model->data_jasmed_bahan($periode_start,$periode_end);
		$curr_id_nakes = '';
		$curr_id_reg = '';
		$curr_id_inv = '';
		$i = 1;
		$num_rows = 0;
		foreach ($v_jasmed as $k => $v)
		{
			if($curr_id_nakes != $v->id_nakes)
			{
				$v_jasmed[$k]->nomor = $i;
				#$v_jasmed[$k]->nakes = $v->nakes;
				
				$curr_id_nakes = $v->id_nakes;
				$v_jasmed[$k]->id_reg_text = $v->id_reg;
				$v_jasmed[$k]->id_inv_text = $v->id_inv;
				$curr_id_reg = $v->id_reg;
				$curr_id_inv = $v->id_inv;
				$i++;
			}
			else
			{
				if($curr_id_reg != $v->id_reg)
				{
					$curr_id_reg = $v->id_reg;
					$curr_id_inv = $v->id_inv;
					
					$v_jasmed[$k]->id_reg_text = $v->id_reg;
					$v_jasmed[$k]->id_inv_text = $v->id_inv;
					$v_jasmed[$k]->nomor = '';
					$v_jasmed[$k]->jenis_nakes = '';
					$v_jasmed[$k]->nakes = '';
					#$v_jasmed[$k]->id_pasien = '';
				}
				else
				{
					if($curr_id_inv != $v->id_inv)
					{
						$v_jasmed[$k]->id_inv_text = $v->id_inv;
						$curr_id_inv = $v->id_inv;
					}
					else
					{						
						$v_jasmed[$k]->nomor = '';
						$v_jasmed[$k]->jenis_nakes = '';
						$v_jasmed[$k]->nakes = '';
						$v_jasmed[$k]->id_pasien = '';
						$v_jasmed[$k]->id_reg_text = '';
						$v_jasmed[$k]->tgl_reg = '';
						$v_jasmed[$k]->pasien = '';
						$v_jasmed[$k]->asuransi = '';
						$v_jasmed[$k]->id_inv_text = '';
						$v_jasmed[$k]->tgl_inv = '';
					}
					
					$v_jasmed[$k]->nomor = '';
					$v_jasmed[$k]->jenis_nakes = '';
					$v_jasmed[$k]->nakes = '';
					$v_jasmed[$k]->id_pasien = '';
					$v_jasmed[$k]->id_reg_text = '';
					$v_jasmed[$k]->tgl_reg = '';
					$v_jasmed[$k]->pasien = '';
					#$v_jasmed[$k]->asuransi = '';
				}
				
			}
			$num_rows++;
		}
		
		$sql_id_nakes = "	SELECT 	a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							ORDER BY a.name";
        $data = array(
            'v_jasmed_data' 	=> $v_jasmed,
            'periode_start' 	=> $periode_start,
			'periode_end' 		=> $periode_end,
			'i'					=> $i-1,
			'num_rows'			=> $num_rows,
			'dropdown_id_nakes' => $this->formgenerator->get_dropdown('id_nakes',$sql_id_nakes),
        );
        $this->load->view('v_jasmed_bahan', $data);
    }
	
	public function show_all()
    {
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
		
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
        
        $v_jasmed = $this->V_jasmed_model->data_jasmed_show_all($periode_start,$periode_end);
		$curr_id_nakes = '';
		$curr_id_reg = '';
		$curr_id_inv = '';
		$i = 1;
		$num_rows = 0;
		foreach ($v_jasmed as $k => $v)
		{
			if($curr_id_nakes != $v->id_nakes)
			{
				$v_jasmed[$k]->nomor = $i;
				#$v_jasmed[$k]->nakes = $v->nakes;
				
				$curr_id_nakes = $v->id_nakes;
				$v_jasmed[$k]->id_reg_text = $v->id_reg;
				$v_jasmed[$k]->id_inv_text = $v->id_inv;
				$curr_id_reg = $v->id_reg;
				$curr_id_inv = $v->id_inv;
				$i++;
			}
			else
			{
				if($curr_id_reg != $v->id_reg)
				{
					$curr_id_reg = $v->id_reg;
					$curr_id_inv = $v->id_inv;
					
					$v_jasmed[$k]->id_reg_text = $v->id_reg;
					$v_jasmed[$k]->id_inv_text = $v->id_inv;
					$v_jasmed[$k]->nomor = '';
					$v_jasmed[$k]->jenis_nakes = '';
					$v_jasmed[$k]->nakes = '';
					#$v_jasmed[$k]->id_pasien = '';
				}
				else
				{
					if($curr_id_inv != $v->id_inv)
					{
						$v_jasmed[$k]->id_inv_text = $v->id_inv;
						$curr_id_inv = $v->id_inv;
					}
					else
					{						
						$v_jasmed[$k]->nomor = '';
						$v_jasmed[$k]->jenis_nakes = '';
						$v_jasmed[$k]->nakes = '';
						$v_jasmed[$k]->id_pasien = '';
						$v_jasmed[$k]->id_reg_text = '';
						$v_jasmed[$k]->tgl_reg = '';
						$v_jasmed[$k]->pasien = '';
						$v_jasmed[$k]->asuransi = '';
						$v_jasmed[$k]->id_inv_text = '';
						$v_jasmed[$k]->tgl_inv = '';
					}
					
					$v_jasmed[$k]->nomor = '';
					$v_jasmed[$k]->jenis_nakes = '';
					$v_jasmed[$k]->nakes = '';
					$v_jasmed[$k]->id_pasien = '';
					$v_jasmed[$k]->id_reg_text = '';
					$v_jasmed[$k]->tgl_reg = '';
					$v_jasmed[$k]->pasien = '';
					#$v_jasmed[$k]->asuransi = '';
				}
				
			}
			$num_rows++;
		}
		
		$sql_id_nakes = "	SELECT 	a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							ORDER BY a.name";
        $data = array(
            'v_jasmed_data' 	=> $v_jasmed,
            'periode_start' 	=> $periode_start,
			'periode_end' 		=> $periode_end,
			'i'					=> $i-1,
			'num_rows'			=> $num_rows,
			'dropdown_id_nakes' => $this->formgenerator->get_dropdown('id_nakes',$sql_id_nakes),
        );
        $this->load->view('v_jasmed_all', $data);
    }
    
	public function export_xlsx($id_jasmed)
	{
		$share_nakes_header = $this->V_jasmed_model->share_nakes_header($id_jasmed);
		$title = array(
			'Dokumen'					=> 'SHARE NAKES',
			'Id. Nakes'					=> $share_nakes_header->id_nakes,
			'Nama'						=> $share_nakes_header->nakes,
			'Tgl DIbuat'				=> $share_nakes_header->waktu_jasmed,
			'Periode Tindakan (dari)'	=> date('Y-m-d',strtotime($share_nakes_header->periode_start)),
			'Periode Tindakan (sampai)'	=> date('Y-m-d',strtotime($share_nakes_header->periode_end)),
			'Total'						=> $share_nakes_header->total,
		);
		
		$rs = $this->V_jasmed_model->share_nakes_detail($id_jasmed);
		foreach($rs as $k => $v)
		{
			$data[] = array(
				'TGL WAKTU'					=> $v->trxdate,
				'NAMA PASIEN/NO.RM/NO.REG'	=> $v->pasien.' / '.$v->id_pasien.' / '.$v->id_reg,
				'TINDAKAN'					=> $v->tindakan,
				'TARIF (Rp)'				=> $v->tarif,
				'SHARE NAKES (%)'			=> $v->persen_nakes,
				'SHARE NAKES (Rp)'			=> $v->share_nakes,
			);
		}
		
		$this->load->library('Exportir');
		$this->exportir->export_to_spreadsheet($title,$data);
	}
}

?>
