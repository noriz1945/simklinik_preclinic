<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_nav_menu extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mst_nav_menu_model');
    }

    public function index()
    {
		#$this->output->enable_profiler(true);
		$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_nav_menu/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_nav_menu/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_nav_menu/';
            $config['first_url'] = base_url() . 'mst_nav_menu/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->mst_nav_menu_model->total_rows($q);
        $mst_nav_menu = $this->mst_nav_menu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_nav_menu_data' => $mst_nav_menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,


        );
        $this->load->view('mst_nav_menu_list', $data);
    }

    public function read($id) 
    {
        $row = $this->mst_nav_menu_model->get_by_id($id);
				$sql_aktif = "SELECT * FROM template_dummy_reff ORDER BY title";
			
        if ($row) {
            $data = array('radio-aktif' => $this->sarkodan->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'icon' => set_value('icon', $row->icon),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'menu' => set_value('menu', $row->menu),
		'urutan' => set_value('urutan', $row->urutan),
	    );
						
            //$this->load->view('mst_nav_menu_read', $data);
						$this->parser->parse('mst_nav_menu_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_menu'));
        }
    }

    public function create() 
    {
		$this->load->library('FormGenerator');
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_is_grup_submenu = "SELECT * FROM reff_ya_tidak ORDER BY id_ya_tidak";
		$sql_id_menu_parent = "SELECT id_menu AS id_menu_parent,menu FROM mst_nav_menu WHERE is_grup_submenu=0 ORDER BY urutan";

		$data = array(
			'button' => 'Create',
			'action' => site_url('mst_nav_menu/create_action'),
			'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,1),

			'icon' => set_value('icon'),
			'id_menu' => set_value('id_menu'),
			'menu' => set_value('menu'),
			'urutan' => set_value('urutan'),
			
			'radio-is_grup_submenu' => $this->formgenerator->get_radio('is_grup_submenu',$sql_is_grup_submenu,0,false,'javascript: load_unload_parent_menu();'),
			'dropdown-id_menu_parent' => $this->formgenerator->get_dropdown('id_menu_parent',$sql_id_menu_parent),
		);
		//$this->load->view('mst_nav_menu_form', $data);
		$this->parser->parse('mst_nav_menu_form', $data);
    }
    
    public function create_action() 
    {
				#print_r($_POST);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			$data_u = array();
			
			$is_grup_submenu = $this->input->post('is_grup_submenu',TRUE);
			if($is_grup_submenu==1)
				$id_menu_parent = $this->input->post('id_menu_parent',TRUE);
			else
				$id_menu_parent = NULL;
			
            $data = array(
				'aktif' => $this->input->post('aktif',TRUE),
				'icon' => $this->input->post('icon',TRUE),
				'menu' => $this->input->post('menu',TRUE),
				'urutan' => $this->input->post('urutan',TRUE),
				'is_grup_submenu' => $this->input->post('is_grup_submenu',TRUE),
				'id_menu_parent' => $id_menu_parent,
			);
			
			$data = $data + $data_u;
            $this->mst_nav_menu_model->insert($data);
            #$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mst_nav_menu'));
        }
    }
    
    public function update($id) 
    {
		$this->load->library('FormGenerator');
        $row = $this->mst_nav_menu_model->get_by_id($id);
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_is_grup_submenu = "SELECT * FROM reff_ya_tidak ORDER BY id_ya_tidak";
		$sql_id_menu_parent = "SELECT id_menu AS id_menu_parent,menu FROM mst_nav_menu WHERE is_grup_submenu=0 ORDER BY urutan";
			
        if ($row) {
            $data = array(
					'button' => 'Update',
					'action' => site_url('mst_nav_menu/update_action'),
					'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),			
					'icon' => set_value('icon', $row->icon),
					'id_menu' => set_value('id_menu', $row->id_menu),
					'menu' => set_value('menu', $row->menu),
					'urutan' => set_value('urutan', $row->urutan),
					
					'radio-is_grup_submenu' => $this->formgenerator->get_radio('is_grup_submenu',$sql_is_grup_submenu,$row->is_grup_submenu),
					'dropdown-id_menu_parent' => $this->formgenerator->get_dropdown('id_menu_parent',$sql_id_menu_parent,$row->id_menu_parent),
					);
            //$this->load->view('mst_nav_menu_form', $data);
						$this->parser->parse('mst_nav_menu_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_menu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
				'aktif' => $this->input->post('aktif',TRUE),
				'icon' => $this->input->post('icon',TRUE),
				'menu' => $this->input->post('menu',TRUE),
				'urutan' => $this->input->post('urutan',TRUE),
				
				'is_grup_submenu' => $this->input->post('is_grup_submenu',TRUE),
				'id_menu_parent' => $this->input->post('id_menu_parent',TRUE),
			);
			$data = $data + $data_u;
            $this->mst_nav_menu_model->update($this->input->post('id_menu', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_nav_menu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->mst_nav_menu_model->get_by_id($id);

        if ($row) {
            $this->mst_nav_menu_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_nav_menu'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_menu'));
        }
    }

    public function _rules() 
    {
	#$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');
	#$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('menu', 'menu', 'trim|required');
	$this->form_validation->set_rules('urutan', 'urutan', 'trim|required');

	$this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->mst_nav_menu_model->total_rows($q);
				$mst_nav_menu = $this->mst_nav_menu_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_nav_menu_data' => $mst_nav_menu,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_nav_menu_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->mst_nav_menu_model->total_rows($q);
		$rs = $this->mst_nav_menu_model->get_limit_data($config['per_page'], $start, $q);
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

/* End of file mst_nav_menu.php */
/* Location: ./application/controllers/mst_nav_menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-13 09:01:58 */
/* http://harviacode.com */