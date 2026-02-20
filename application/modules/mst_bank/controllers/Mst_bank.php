<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_bank extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mst_bank_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_bank/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_bank/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_bank/';
            $config['first_url'] = base_url() . 'mst_bank/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Mst_bank_model->total_rows($q);
        $mst_bank = $this->Mst_bank_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_bank_data' => $mst_bank,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,


        );
        $this->load->view('mst_bank_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Mst_bank_model->get_by_id($id);			
		$sql_is_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_is_kartu_debit_kredit = "SELECT * FROM reff_ya_tidak ORDER BY id_ya_tidak";
			
        if ($row) {
            $data = array(
		'id_bank' => set_value('id_bank', $row->id_bank),
		'nama_bank' => set_value('nama_bank', $row->nama_bank),
		'radio-is_kartu_debit_kredit' => $this->formgenerator->get_radio('is_kartu_debit_kredit',$sql_is_kartu_debit_kredit,$row->is_kartu_debit_kredit),
			'radio-is_aktif' => $this->formgenerator->get_radio('is_aktif',$sql_is_aktif,$row->is_aktif),
			
		'creator' => set_value('creator', $row->creator),
		'created' => set_value('created', $row->created),
		'updater' => set_value('updater', $row->updater),
		'updated' => set_value('updated', $row->updated),
	    );
						
            //$this->load->view('mst_bank_read', $data);
						$this->parser->parse('mst_bank_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_bank'));
        }
    }

    public function create() 
    {
		$sql_is_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_is_kartu_debit_kredit = "SELECT * FROM reff_ya_tidak ORDER BY id_ya_tidak";
			
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_bank/create_action'),
	    'id_bank' => set_value('id_bank'),
	    'nama_bank' => set_value('nama_bank'),'radio-is_kartu_debit_kredit' => $this->formgenerator->get_radio('is_kartu_debit_kredit',$sql_is_kartu_debit_kredit),
			'radio-is_aktif' => $this->formgenerator->get_radio('is_aktif',$sql_is_aktif,1),
			
	    'creator' => set_value('creator'),
	    'created' => set_value('created'),
	    'updater' => set_value('updater'),
	    'updated' => set_value('updated'),
	);
        //$this->load->view('mst_bank_form', $data);
				$this->parser->parse('mst_bank_form', $data);
    }
    
    public function create_action() 
    {
				#print_r($_POST);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
					$data_u = array();
				
            $data = array(
		'nama_bank' => $this->input->post('nama_bank',TRUE),
		'is_kartu_debit_kredit' => $this->input->post('is_kartu_debit_kredit',TRUE),
		'is_aktif' => $this->input->post('is_aktif',TRUE),
		'creator' => $this->input->post('creator',TRUE),
		'created' => $this->input->post('created',TRUE),
		'updater' => $this->input->post('updater',TRUE),
		'updated' => $this->input->post('updated',TRUE),
	    );
						$data = $data + $data_u;
            $this->Mst_bank_model->insert($data);
            #$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mst_bank'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mst_bank_model->get_by_id($id);
		$sql_is_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_is_kartu_debit_kredit = "SELECT * FROM reff_ya_tidak ORDER BY id_ya_tidak";
			
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_bank/update_action'),
		'id_bank' => set_value('id_bank', $row->id_bank),
		'nama_bank' => set_value('nama_bank', $row->nama_bank),'radio-is_kartu_debit_kredit' => $this->formgenerator->get_radio('is_kartu_debit_kredit',$sql_is_kartu_debit_kredit,$row->is_kartu_debit_kredit),
			'radio-is_aktif' => $this->formgenerator->get_radio('is_aktif',$sql_is_aktif,$row->is_aktif),
			
		'creator' => set_value('creator', $row->creator),
		'created' => set_value('created', $row->created),
		'updater' => set_value('updater', $row->updater),
		'updated' => set_value('updated', $row->updated),
	    );
            //$this->load->view('mst_bank_form', $data);
						$this->parser->parse('mst_bank_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_bank'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bank', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
		'nama_bank' => $this->input->post('nama_bank',TRUE),
		'is_kartu_debit_kredit' => $this->input->post('is_kartu_debit_kredit',TRUE),
		'is_aktif' => $this->input->post('is_aktif',TRUE),
		'creator' => $this->input->post('creator',TRUE),
		'created' => $this->input->post('created',TRUE),
		'updater' => $this->input->post('updater',TRUE),
		'updated' => $this->input->post('updated',TRUE),
	    );
						$data = $data + $data_u;
            $this->Mst_bank_model->update($this->input->post('id_bank', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_bank'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mst_bank_model->get_by_id($id);

        if ($row) {
            $this->Mst_bank_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_bank'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_bank'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_bank', 'nama bank', 'trim|required');
	#$this->form_validation->set_rules('is_kartu_debit_kredit', 'is kartu debit kredit', 'trim|required');
	#$this->form_validation->set_rules('is_aktif', 'is aktif', 'trim|required');
	#$this->form_validation->set_rules('creator', 'creator', 'trim|required');
	#$this->form_validation->set_rules('created', 'created', 'trim|required');
	#$this->form_validation->set_rules('updater', 'updater', 'trim|required');
	#$this->form_validation->set_rules('updated', 'updated', 'trim|required');

	$this->form_validation->set_rules('id_bank', 'id_bank', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->Mst_bank_model->total_rows($q);
				$mst_bank = $this->Mst_bank_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_bank_data' => $mst_bank,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_bank_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->Mst_bank_model->total_rows($q);
		$rs = $this->Mst_bank_model->get_limit_data($config['per_page'], $start, $q);
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


}

/* End of file Mst_bank.php */
/* Location: ./application/controllers/Mst_bank.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-11-25 07:19:47 */
/* http://harviacode.com */
?>
