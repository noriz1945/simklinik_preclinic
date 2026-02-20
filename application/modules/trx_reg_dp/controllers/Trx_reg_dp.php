<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_reg_dp extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_reg_dp_model');
		$this->load->library('FormGenerator');
		$this->load->library('SmartLib');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'trx_reg_dp/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'trx_reg_dp/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'trx_reg_dp/';
            $config['first_url'] = base_url() . 'trx_reg_dp/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        #$config['total_rows'] = $this->Trx_reg_dp_model->total_rows($q);
        $trx_reg_dp = $this->Trx_reg_dp_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_reg_dp_data' => $trx_reg_dp,
            'q'               => $q,
            'pagination'      => $this->pagination->create_links(),
            #'total_rows'      => $config['total_rows'],
            'start'           => $start,
        );
        $this->load->view('trx_reg_dp_list', $data);
		
    }
	
	public function list_dp_pasien($id_reg)
    {
		$data_reg = $this->Trx_reg_dp_model->get_data_reg($id_reg);
        $trx_reg_dp = $this->Trx_reg_dp_model->get_by_id_reg($id_reg);
		
		$sql_id_bank   = "	SELECT * FROM mst_bank ORDER BY nama_bank";
        $data = array(
			'id_reg'	        => $id_reg,
            'trx_reg_dp_data'   => $trx_reg_dp,
			'dropdown_id_bank'	=> $this->formgenerator->get_dropdown('id_bank1',$sql_id_bank),
			'data_reg'        	=> $data_reg,
        );
        $this->load->view('trx_reg_dp_list_pasien', $data);
    }

    function cetak_invoice_dp_pos($id_trx)
	{
		$this->load->library('Terbilang');
		$data_dp = $this->Trx_reg_dp_model->get_data_dp($id_trx);
		
		$sql_id_bank = "SELECT * FROM mst_bank ORDER BY nama_bank";
		$data_dp->txt_refund_dp = ($data_dp->ret==1)?'PENGEMBALIAN':'';
		if($data_dp->ret==1)
		{
			$data_dp->total_cash = $data_dp->total_cash * (-1);
			$data_dp->total 	 = $data_dp->total * (-1);
		}
		
		$data = array(
			'data_dp'	=> $data_dp,
        );
        $this->load->view('cetak_invoice_dp_pos', $data);
	}

    public function create() 
    {
        $data = array(
			'button'     => 'Create',
			'action'     => site_url('trx_reg_dp/create_action'),
			'id_trx'     => set_value('id_trx'),
			'id_pasien'  => set_value('id_pasien'),
			'id_reg'     => set_value('id_reg'),
			'trxdate'    => set_value('trxdate'),
			'id_cctype1' => set_value('id_cctype1'),
			'id_bank1'   => set_value('id_bank1'),
			'nocc1'      => set_value('nocc1'),
			'total_cc1'  => set_value('total_cc1'),
			'id_cctype2' => set_value('id_cctype2'),
			'id_bank2'   => set_value('id_bank2'),
			'nocc2'      => set_value('nocc2'),
			'total_cc2'  => set_value('total_cc2'),
			'total_cash' => set_value('total_cash'),
			'total'      => set_value('total'),
			'ret'        => set_value('ret'),
			'id_reg_csr' => set_value('id_reg_csr'),
			'id_cfb'     => set_value('id_cfb'),
			'jnl_post'   => set_value('jnl_post'),
			'created'    => set_value('created'),
			'creator'    => set_value('creator'),
			'updated'    => set_value('updated'),
			'updater'    => set_value('updater'),
		);
        //$this->load->view('trx_reg_dp_form', $data);
		$this->parser->parse('trx_reg_dp_form', $data);
    }
    
    public function create_action() 
    {
		#$this->output->enable_profiler(true);
		$id_reg = $this->input->post('id_reg',TRUE);
		$total_cc1 = $this->input->post('total_cc1',TRUE);
		$note_dp = $this->input->post('note_dp',TRUE);
		$id_opening = $this->smartlib->get_id_opening_kasir();
		$total_dp = 0;
		$new_id_trx1 = '';
		$new_id_trx2 = '';
		$this->db->trans_begin();
		if($total_cc1 > 0)
		{
			$data = array(
				'id_reg'     => $id_reg,
				'trxdate'    => date('Y-m-d H:i:s'),
				'id_bank1'   => $this->input->post('id_bank1',TRUE),
				'nocc1'      => $this->input->post('nocc1',TRUE),
				'total_cc1'  => $total_cc1,
				'total'      => $total_cc1,
				'note_dp'  	 => $note_dp,
				#'id_reg_csr' => $this->input->post('id_reg_csr',TRUE),
				'created'    => date('Y-m-d H:i:s'),
				'creator'    => $this->session->userdata['sp']->login_name,
				'id_opening' => $id_opening,
			);
			$new_id_trx1 = $this->Trx_reg_dp_model->insert('trx_reg_dp',$data);
			$total_dp += $total_cc1;
		}
		$total_cash = $this->input->post('total_cash',TRUE);
		if($total_cash > 0)
		{
			$data = array(
				'id_reg'     => $id_reg,
				'trxdate'    => date('Y-m-d H:i:s'),
				'total_cash' => $total_cash,
				'total'      => $total_cash,
				'note_dp'  	 => $note_dp,
				#'id_reg_csr' => $this->input->post('id_reg_csr',TRUE),
				'created'    => date('Y-m-d H:i:s'),
				'creator'    => $this->session->userdata['sp']->login_name,
				'id_opening' => $id_opening,
			);
			$new_id_trx2 = $this->Trx_reg_dp_model->insert('trx_reg_dp',$data);
			$total_dp += $total_cash;
		}
		
		$total_dp = intval($total_dp);
		$sql = "UPDATE trx_reg SET total_dp=(total_dp+".$total_dp.") WHERE id_reg='".$id_reg."'";
		$query = $this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
		}
		else
		{
				#$this->db->trans_rollback();
				$this->db->trans_commit();
		}
		
		#redirect(site_url('trx_reg_dp/list_dp_pasien/'.$id_reg));
		redirect(site_url('pembayaran?id_trx1='. $new_id_trx1.'&id_trx2='. $new_id_trx2));
    }
    
    public function update($id) 
    {
        $row = $this->Trx_reg_dp_model->get_by_id($id);
			
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('trx_reg_dp/update_action'),
		'id_trx' => set_value('id_trx', $row->id_trx),
		'id_pasien' => set_value('id_pasien', $row->id_pasien),
		'id_reg' => set_value('id_reg', $row->id_reg),
		'trxdate' => set_value('trxdate', $row->trxdate),
		'id_cctype1' => set_value('id_cctype1', $row->id_cctype1),
		'id_bank1' => set_value('id_bank1', $row->id_bank1),
		'nocc1' => set_value('nocc1', $row->nocc1),
		'total_cc1' => set_value('total_cc1', $row->total_cc1),
		'id_cctype2' => set_value('id_cctype2', $row->id_cctype2),
		'id_bank2' => set_value('id_bank2', $row->id_bank2),
		'nocc2' => set_value('nocc2', $row->nocc2),
		'total_cc2' => set_value('total_cc2', $row->total_cc2),
		'total_cash' => set_value('total_cash', $row->total_cash),
		'total' => set_value('total', $row->total),
		'ret' => set_value('ret', $row->ret),
		'id_reg_csr' => set_value('id_reg_csr', $row->id_reg_csr),
		'id_cfb' => set_value('id_cfb', $row->id_cfb),
		'jnl_post' => set_value('jnl_post', $row->jnl_post),
		'created' => set_value('created', $row->created),
		'creator' => set_value('creator', $row->creator),
		'updated' => set_value('updated', $row->updated),
		'updater' => set_value('updater', $row->updater),
	    );
            //$this->load->view('trx_reg_dp_form', $data);
						$this->parser->parse('trx_reg_dp_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_reg_dp'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_trx', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
		'id_pasien' => $this->input->post('id_pasien',TRUE),
		'id_reg' => $this->input->post('id_reg',TRUE),
		'trxdate' => $this->input->post('trxdate',TRUE),
		'id_cctype1' => $this->input->post('id_cctype1',TRUE),
		'id_bank1' => $this->input->post('id_bank1',TRUE),
		'nocc1' => $this->input->post('nocc1',TRUE),
		'total_cc1' => $this->input->post('total_cc1',TRUE),
		'id_cctype2' => $this->input->post('id_cctype2',TRUE),
		'id_bank2' => $this->input->post('id_bank2',TRUE),
		'nocc2' => $this->input->post('nocc2',TRUE),
		'total_cc2' => $this->input->post('total_cc2',TRUE),
		'total_cash' => $this->input->post('total_cash',TRUE),
		'total' => $this->input->post('total',TRUE),
		'ret' => $this->input->post('ret',TRUE),
		'id_reg_csr' => $this->input->post('id_reg_csr',TRUE),
		'id_cfb' => $this->input->post('id_cfb',TRUE),
		'jnl_post' => $this->input->post('jnl_post',TRUE),
		'created' => $this->input->post('created',TRUE),
		'creator' => $this->input->post('creator',TRUE),
		'updated' => $this->input->post('updated',TRUE),
		'updater' => $this->input->post('updater',TRUE),
	    );
						$data = $data + $data_u;
            $this->Trx_reg_dp_model->update($this->input->post('id_trx', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('trx_reg_dp'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_reg_dp_model->get_by_id($id);

        if ($row) {
            $this->Trx_reg_dp_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('trx_reg_dp'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_reg_dp'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_pasien', 'id pasien', 'trim|required');
	$this->form_validation->set_rules('id_reg', 'id reg', 'trim|required');
	$this->form_validation->set_rules('trxdate', 'trxdate', 'trim|required');
	$this->form_validation->set_rules('id_cctype1', 'id cctype1', 'trim|required');
	$this->form_validation->set_rules('id_bank1', 'id bank1', 'trim|required');
	$this->form_validation->set_rules('nocc1', 'nocc1', 'trim|required');
	$this->form_validation->set_rules('total_cc1', 'total cc1', 'trim|required|numeric');
	$this->form_validation->set_rules('id_cctype2', 'id cctype2', 'trim|required');
	$this->form_validation->set_rules('id_bank2', 'id bank2', 'trim|required');
	$this->form_validation->set_rules('nocc2', 'nocc2', 'trim|required');
	$this->form_validation->set_rules('total_cc2', 'total cc2', 'trim|required|numeric');
	$this->form_validation->set_rules('total_cash', 'total cash', 'trim|required|numeric');
	$this->form_validation->set_rules('total', 'total', 'trim|required|numeric');
	$this->form_validation->set_rules('ret', 'ret', 'trim|required');
	$this->form_validation->set_rules('id_reg_csr', 'id reg csr', 'trim|required');
	$this->form_validation->set_rules('id_cfb', 'id cfb', 'trim|required');
	$this->form_validation->set_rules('jnl_post', 'jnl post', 'trim|required');
	$this->form_validation->set_rules('created', 'created', 'trim|required');
	$this->form_validation->set_rules('creator', 'creator', 'trim|required');
	$this->form_validation->set_rules('updated', 'updated', 'trim|required');
	$this->form_validation->set_rules('updater', 'updater', 'trim|required');

	$this->form_validation->set_rules('id_trx', 'id_trx', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->Trx_reg_dp_model->total_rows($q);
				$trx_reg_dp = $this->Trx_reg_dp_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'trx_reg_dp_data' => $trx_reg_dp,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('trx_reg_dp_pdf', $data);
		}
		
	function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->Trx_reg_dp_model->total_rows($q);
		$rs = $this->Trx_reg_dp_model->get_limit_data($config['per_page'], $start, $q);
		foreach($rs[0] as $k => $v)
		{
			$fields[] = (object)array('name' => $k);
		}

		foreach($fields as $k => $v)
		{
			$no = $k+1;
			$arrCol[] = array('urutan'=>($no), 'nilai'=>$v->name,'fontsize'=> '12', 'bold'=>true, 'namanya'=>$v->name, 'format'=>'string');
		}
		$arrExcel = array('sNAMESS'=>'sarkodan', 'sFILNAM'=>$parameter,'col'=>$arrCol, 'rsl'=>$rs);
		$this->libexcel->bangunexcel($arrExcel);
	}
	
	public function refund_dp_act($id_reg)
	{
		$dp_ret = intval($this->input->post('dp_ret'));
		$id_opening = $this->smartlib->get_id_opening_kasir();
		$data_trx_reg_dp			   = array();
		$data_trx_reg_dp['id_reg'] 	   = $id_reg;
		#$data_trx_reg_dp['id_inv'] 	   = $new_id_inv;
		$data_trx_reg_dp['total_cash'] = ($dp_ret * -1);
		$data_trx_reg_dp['total'] 	   = ($dp_ret * -1);
		$data_trx_reg_dp['ret'] 	   = 1;
		$data_trx_reg_dp['note_dp']    = "Refund";
		$data_trx_reg_dp['creator']    = $this->session->userdata['sp']->login_name;
		$data_trx_reg_dp['created']    = date('Y-m-d H:i:s');
		$data_trx_reg_dp['id_opening'] = $id_opening;
		$new_id_ret_dp = $this->Trx_reg_dp_model->insert('trx_reg_dp', $data_trx_reg_dp);

		$sql = "UPDATE trx_reg SET total_dp=(total_dp - ".$dp_ret.") WHERE id_reg='".$id_reg."'";
		$query = $this->db->query($sql);
		
		echo $new_id_ret_dp;
	}
	
	public function dp_all()
	{
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;

		$periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;

		$dp_data = $this->Trx_reg_dp_model->get_data_dp_all($periode_start,$periode_end);

		$data = array(
			'dp_data' 			=> $dp_data,
			'periode_start' => $periode_start,
			'periode_end' 	=> $periode_end,
			'num_rows'			=> count($dp_data),
		);
		$this->load->view('v_dp_all', $data);
	}

}



?>
