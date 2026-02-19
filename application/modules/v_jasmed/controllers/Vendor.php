<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require 'vendor/autoload.php';
		use PhpOffice\PhpSpreadsheet\Spreadsheet;
		use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
		use PhpOffice\PhpSpreadsheet\Shared\Font;

class Vendor extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('v_jasmed_model');
		$this->load->library('FormGenerator');
    }
	
	public function index($auto_print_id_jasdor="")
	{
		$periode_start 	= $this->input->post('periode_start');
		$periode_start 	= ($periode_start=='') ? date('Y-m-d',mktime(0,0,0,date('m'),1,date('Y'))) : $periode_start;
        $periode_end 	= $this->input->post('periode_end');
		$periode_end 	= ($periode_end=='')?date('Y-m-d'):$periode_end;
		$id_vendor 		= $this->input->post('id_vendor');
		
        $trx_jasdor_data = $this->v_jasmed_model->data_jasdor($periode_start,$periode_end,$id_vendor);
		
		$sql_id_vendor = "	SELECT 	a.id_vendor,a.vendor AS name
							FROM 	mst_vendor a
							ORDER BY a.vendor";
		$num_rows = 0;
		$data = array(
			'trx_jasdor_data'			=> $trx_jasdor_data,
			'periode_start' 			=> $periode_start,
			'periode_end' 				=> $periode_end,
			'num_rows'					=> $num_rows,
			'dropdown_id_vendor' 		=> $this->formgenerator->get_dropdown('id_vendor',$sql_id_vendor,$id_vendor),
			'auto_print_id_jasdor'		=> $auto_print_id_jasdor,
		);
		$this->load->view('jasdor_list', $data);
	}
	
	public function add()
	{
		$periode_start 	= $this->input->post('periode_start');
		$periode_start 	= ($periode_start=='')?date('Y-m-d'):$periode_start;
        $periode_end 	= $this->input->post('periode_end');
		$periode_end 	= ($periode_end=='')?date('Y-m-d'):$periode_end;
		$sql_id_vendor = "	SELECT 	a.id_vendor,a.vendor AS name
							FROM 	mst_vendor a
							ORDER BY a.vendor";
		$waktu_jasdor = date('Y-m-d H:i:s');
		$data = array(
			'id_jasdor'				=> '',
			'periode_start' 		=> $periode_start,
			'periode_end' 			=> $periode_end,
			'waktu_jasdor' 			=> $waktu_jasdor,
			'dropdown_id_vendor' 	=> $this->formgenerator->get_dropdown('id_vendor',$sql_id_vendor),
			'subtotal' 				=> 0,
			'total' 				=> 0,
			
		);
		$this->load->view('jasdor_add', $data);
	}
	
	public function add_detail()
    {
		$id_vendor 		= $this->input->post('id_vendor');
		
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
        
        $v_jasdor = $this->v_jasmed_model->vendor_data_add_detail($id_vendor,$periode_start,$periode_end);
		$curr_id_vendor = '';
		$curr_id_reg = '';
		$curr_id_inv = '';
		$i = 1;
		$num_rows = 0;
		foreach ($v_jasdor as $k => $v)
		{
			if($curr_id_vendor != $v->id_vendor)
			{
				$v_jasdor[$k]->nomor = $i;
				#$v_jasdor[$k]->nakes = $v->nakes;
				
				$curr_id_vendor = $v->id_vendor;
				$v_jasdor[$k]->id_reg_text = $v->id_reg;
				$v_jasdor[$k]->id_inv_text = $v->id_inv;
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
					
					$v_jasdor[$k]->id_reg_text = $v->id_reg;
					$v_jasdor[$k]->id_inv_text = $v->id_inv;
					$v_jasdor[$k]->nomor = '';
					$v_jasdor[$k]->jenis_nakes = '';
					$v_jasdor[$k]->nakes = '';
					$v_jasdor[$k]->id_pasien = '';
				}
				else
				{
					if($curr_id_inv != $v->id_inv)
					{
						$v_jasdor[$k]->id_inv_text = $v->id_inv;
						$curr_id_inv = $v->id_inv;
					}
					else
					{						
						$v_jasdor[$k]->nomor = '';
						$v_jasdor[$k]->jenis_nakes = '';
						$v_jasdor[$k]->nakes = '';
						$v_jasdor[$k]->id_pasien = '';
						$v_jasdor[$k]->id_reg_text = '';
						$v_jasdor[$k]->tgl_reg = '';
						$v_jasdor[$k]->pasien = '';
						$v_jasdor[$k]->asuransi = '';
						$v_jasdor[$k]->id_inv_text = '';
						$v_jasdor[$k]->tgl_inv = '';
					}
					
					$v_jasdor[$k]->nomor = '';
					$v_jasdor[$k]->jenis_nakes = '';
					$v_jasdor[$k]->nakes = '';
					$v_jasdor[$k]->id_pasien = '';
					$v_jasdor[$k]->id_reg_text = '';
					$v_jasdor[$k]->tgl_reg = '';
					$v_jasdor[$k]->pasien = '';
					#$v_jasdor[$k]->asuransi = '';
				}
				
			}
			$num_rows++;
		}
		
		$sql_id_vendor = "	SELECT 	a.id_vendor,a.vendor AS name
							FROM 	mst_vendor a
							ORDER BY a.vendor";
        $data = array(
            'v_jasdor_data' 	=> $v_jasdor,
            'periode_start' 	=> $periode_start,
			'periode_end' 		=> $periode_end,
			'i'					=> $i-1,
			'num_rows'			=> $num_rows,
			'dropdown_id_vendor' 	=> $this->formgenerator->get_dropdown('id_vendor',$sql_id_vendor,$id_vendor),
        );
        $this->load->view('jasdor_add_detail', $data);
    }
	
	public function save()
	{
		#$this->output->enable_profiler(true);
		#return;
		
		$this->db->trans_begin();
		### --- SIAPIN data header duluan ----------------------------
		$data_r = array();
		$data_r['waktu_jasdor'] 	= date("Y-m-d H:i:s");
		$data_r['id_vendor'] 		= $this->input->post('r_id_vendor');
		$data_r['periode_start'] 	= $this->input->post('r_periode_start');
		$data_r['periode_end'] 		= $this->input->post('r_periode_end');
		$data_r['subtotal'] 		= $this->input->post('r_total');
		$data_r['total'] 			= $this->input->post('r_total');
		$data_r['creator'] 			= $this->session->userdata['sp']->login_name;
		$data_r['created'] 			= date("Y-m-d H:i:s");
		$this->db->insert('trx_jasdor', $data_r);
		$id_jasdor = $this->db->insert_id();
		
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
				$data_d['id_jasdor'] 		= $id_jasdor;
				$data_d['id_trx'] 			= $v;
				$data_d['tindakan'] 		= $tindakan[$k];
				$data_d['tarif'] 			= $tarif[$k];
				$data_d['persen_vendor'] 	= $persen_vendor[$k];
				$data_d['persen_nakes'] 	= $persen_nakes[$k];
				$data_d['persen_rs'] 		= $persen_rs[$k];
				$data_d['share_vendor'] 	= $share_vendor[$k];
				$data_d['share_nakes'] 		= $share_nakes[$k];
				$data_d['share_rs'] 		= $share_rs[$k];
			
				$this->db->insert('trx_jasdor_det', $data_d);
				
				### --- UPDATE trx_reg, add id_jasmed ---
				$this->db->set('id_jasdor', $id_jasdor);
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
			
			echo 'Proses Share Vendor Gagal'."<br>";
			echo $errNo . "<br>";
			echo $errMess . "<br>";
		}
		else
		{
			#$this->db->trans_rollback();
			$this->db->trans_commit();
			redirect('v_jasmed/vendor/index/'.$id_jasdor);
		}
	}
	
	public function cetak_share_vendor($id_jasdor)
	{
		#$var1 = $this->input->post('var1');
		$share_vendor_header = $this->v_jasmed_model->share_vendor_header($id_jasdor);
		$share_vendor_header = (object) $share_vendor_header;
		
		$share_vendor_detail = $this->v_jasmed_model->share_vendor_detail($id_jasdor);
		
		$data = array(
			'share_vendor_header' => $share_vendor_header,
			'share_vendor_detail' => $share_vendor_detail,
		);
		$this->load->view('cetak_share_vendor', $data);
	}
	
	public function export_xlsx($id_jasdor)
	{
		$share_vendor_header = $this->v_jasmed_model->share_vendor_header($id_jasdor);
		$title = array(
			'Dokumen'					=> 'SHARE VENDOR',
			'Id. Vendor'				=> $share_vendor_header->id_vendor,
			'Nama'						=> $share_vendor_header->vendor,
			'Tgl Dibuat'				=> $share_vendor_header->waktu_jasdor,
			'Periode Tindakan (dari)'	=> date('Y-m-d',strtotime($share_vendor_header->periode_start)),
			'Periode Tindakan (sampai)'	=> date('Y-m-d',strtotime($share_vendor_header->periode_end)),
			'Total'						=> $share_vendor_header->total,
		);
		
		$rs = $this->v_jasmed_model->share_vendor_detail($id_jasdor);
		foreach($rs as $k => $v)
		{
			$data[] = array(
				'TGL WAKTU'					=> $v->trxdate,
				'NAMA PASIEN/NO.RM/NO.REG'	=> $v->pasien.' / '.$v->id_pasien.' / '.$v->id_reg,
				'TINDAKAN'					=> $v->tindakan,
				'TARIF (Rp)'				=> $v->tarif,
				'SHARE VENDOR (%)'			=> $v->persen_vendor,
				'SHARE VENDOR (Rp)'			=> $v->share_vendor,
			);
		}
		
		$this->load->library('Exportir');
		$this->exportir->export_to_spreadsheet($title,$data);
	}
}

?>
