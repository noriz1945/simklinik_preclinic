<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Refund extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Refund_model');
		#$this->load->library('FormGenerator');
		$this->load->library('SmartLib');
    }

	public function add($id_inv)
	{
		#$this->load->library('Terbilang');
		
		$data_inv_header = $this->Refund_model->get_data_inv_header($id_inv);
		$data_inv_detail = $this->Refund_model->get_data_inv_detail($id_inv);
		
		$subtotal = $data_inv_header->subtotal;
		$vcdisc_m = $data_inv_header->vcdisc_m;
		foreach($data_inv_detail as $k => $v)
		{
			$data_inv_detail[$k]->min_disc_item = 0;
			
			$pcn_disc_all = ($vcdisc_m/$subtotal);
			$min_disc_all = ($v->total * $pcn_disc_all);
			
			$data_inv_detail[$k]->min_disc_all = $min_disc_all;
			$total_refund = ($v->total) - ($data_inv_detail[$k]->min_disc_item) - ($data_inv_detail[$k]->min_disc_all);
			$data_inv_detail[$k]->total_refund = $total_refund;
			
			## --- MINUSISASI -------------------------------------------------------------
			$data_inv_detail[$k]->min_disc_item = $data_inv_detail[$k]->min_disc_item * -1;
			$data_inv_detail[$k]->min_disc_all = $data_inv_detail[$k]->min_disc_all * -1;
			#$data_inv_detail[$k]->total = $data_inv_detail[$k]->total * -2;
		}
		
		$data = array(
			#'data_reg'				=> $data_reg,
			'data_inv_header'		=> $data_inv_header,
			'data_inv_detail'		=> $data_inv_detail,
        );
		$this->load->view('refund/refund_add', $data);
	}
	
	public function buat_invoice_refund()
	{
		#$this->output->enable_profiler(true);
		#return;
		
		### --- INSERT DATA HEADER REFUND ----------------------------------------
		$id_inv = $this->input->post('id_inv');
		$yg_direfund = $this->input->post('yg_direfund');
		$total_noncash = $this->input->post('total_noncash');
		$total_cash = $this->input->post('total_cash');
		$id_opening = $this->smartlib->get_id_opening_kasir();
		
		$this->db->trans_begin();
		$data_refund = array();
		$data_refund['id_inv'] 			= $id_inv;
		$data_refund['refund_date'] 	= date('Y-m-d H:i:s');
		$data_refund['refund_total'] 	= intval(str_replace('.','',$yg_direfund));
		$data_refund['tunai'] 			= intval(str_replace('.','',$total_cash));
		$data_refund['asuransi'] 		= intval(str_replace('.','',$total_noncash));
		$data_refund['creator'] 		= $this->session->userdata['sp']->name;
		$data_refund['created'] 		= date('Y-m-d H:i:s');
		$data_refund['id_opening'] = $id_opening;
		$this->Refund_model->insert('trx_reg_inv_refund', $data_refund);
		$id_refund = $this->db->insert_id();
		
		### --- INSERT DATA DETAIL REFUND ----------------------------------------
		$id_trx 		= $this->input->post('id_trx');
		$price 			= $this->input->post('price');
		$qty 			= $this->input->post('qty');
		$price_total 	= $this->input->post('price_total');
		$is_farmasi 	= $this->input->post('is_farmasi');
		$min_disc_item 	= $this->input->post('min_disc_item');
		$min_disc_inv 	= $this->input->post('min_disc_inv');
		$price_refund 	= $this->input->post('price_refund');
		
		$data_refund_det = array();
		foreach($id_trx as $k => $v)
		{
			$data_refund_det['id_refund'] 		= $id_refund;
			$data_refund_det['is_farmasi'] 		= $is_farmasi[$k];
			$data_refund_det['id_trx'] 			= $v;
			$data_refund_det['price'] 			= intval(str_replace('.','',$price[$k]));
			$data_refund_det['qty'] 			= $qty[$k];
			$data_refund_det['price_total'] 	= intval(str_replace('.','',$price_total[$k]));
			$data_refund_det['min_disc_item'] 	= intval(str_replace('.','',$min_disc_item[$k]));
			$data_refund_det['min_disc_inv'] 	= intval(str_replace('.','',$min_disc_inv[$k]));
			$data_refund_det['price_refund'] 	= intval(str_replace('.','',$price_refund[$k]));
			$data_refund_det['id_opening'] = $id_opening;
			$this->Refund_model->insert('trx_reg_inv_refund_det', $data_refund_det);
			
			if($is_farmasi[$k] == 1)
			{
				$data_soap_eresep_det['id_inv_refund'] = $id_refund;
				$data_soap_eresep_det['id_opening_refund'] = $id_opening;
				$this->Refund_model->update('soap_eresep_det','id_eresep_det',$v, $data_soap_eresep_det);
			}
			else
			{
				$data_trx_reg_act['id_inv_refund'] = $id_refund;
				$data_trx_reg_act['id_opening_refund'] = $id_opening;
				$this->Refund_model->update('trx_reg_act','id_trx',$v, $data_trx_reg_act);
			}
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
		redirect('pembayaran?id_refund='. $id_refund);
	}
	
	function cetak_invoice_refund_pos($id_refund)
	{
		$this->load->library('Terbilang');
		$data_inv_refund_header = $this->Refund_model->get_data_inv_refund_header($id_refund);
		$data_inv_refund_detail = $this->Refund_model->get_data_inv_refund_detail($id_refund);
		
		$data = array(
			'data_inv_refund_header'		=> $data_inv_refund_header,
			'data_inv_refund_detail'		=> $data_inv_refund_detail,
        );
        $this->load->view('refund/cetak_invoice_refund_pos', $data);
	}
}

