<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_nav_role extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mst_nav_role_model');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_nav_role/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_nav_role/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_nav_role/';
            $config['first_url'] = base_url() . 'mst_nav_role/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->mst_nav_role_model->total_rows($q);
        $mst_nav_role = $this->mst_nav_role_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_nav_role_data' => $mst_nav_role,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,


        );
        $this->load->view('mst_nav_role_list', $data);
    }

    public function read($id) 
    {
        $row = $this->mst_nav_role_model->get_by_id($id);
				$sql_aktif = "SELECT * FROM template_dummy_reff ORDER BY title";
			
        if ($row) {
            $data = array('radio-aktif' => $this->sarkodan->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'id_role' => set_value('id_role', $row->id_role),
		'nama' => set_value('nama', $row->nama),
	    );
						
            //$this->load->view('mst_nav_role_read', $data);
						$this->parser->parse('mst_nav_role_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_role'));
        }
    }

    public function create() 
    {
			$this->load->library('FormGenerator');
			$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
			
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_nav_role/create_action'),
			'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,1),
			
	    'id_role' => set_value('id_role'),
	    'nama' => set_value('nama'),
	);
        //$this->load->view('mst_nav_role_form', $data);
				$this->parser->parse('mst_nav_role_form', $data);
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
		'aktif' => $this->input->post('aktif',TRUE),
		'nama' => $this->input->post('nama',TRUE),
	    );
						$data = $data + $data_u;
            $this->mst_nav_role_model->insert($data);
            #$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mst_nav_role'));
        }
    }
    
    public function update($id) 
    {
				$this->load->library('FormGenerator');
        $row = $this->mst_nav_role_model->get_by_id($id);
			$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
			
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_nav_role/update_action'),'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'id_role' => set_value('id_role', $row->id_role),
		'nama' => set_value('nama', $row->nama),
	    );
            //$this->load->view('mst_nav_role_form', $data);
						$this->parser->parse('mst_nav_role_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_role'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_role', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
		'aktif' => $this->input->post('aktif',TRUE),
		'nama' => $this->input->post('nama',TRUE),
	    );
						$data = $data + $data_u;
            $this->mst_nav_role_model->update($this->input->post('id_role', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_nav_role'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->mst_nav_role_model->get_by_id($id);

        if ($row) {
            $this->mst_nav_role_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_nav_role'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_role'));
        }
    }

    public function _rules() 
    {
	#$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('id_role', 'id_role', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->mst_nav_role_model->total_rows($q);
				$mst_nav_role = $this->mst_nav_role_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_nav_role_data' => $mst_nav_role,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_nav_role_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->mst_nav_role_model->total_rows($q);
		$rs = $this->mst_nav_role_model->get_limit_data($config['per_page'], $start, $q);
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

/* End of file mst_nav_role.php */
/* Location: ./application/controllers/mst_nav_role.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-13 09:43:03 */
/* http://harviacode.com */