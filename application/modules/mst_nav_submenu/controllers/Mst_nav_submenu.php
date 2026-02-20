<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_nav_submenu extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mst_nav_submenu_model');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_nav_submenu/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_nav_submenu/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_nav_submenu/';
            $config['first_url'] = base_url() . 'mst_nav_submenu/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->mst_nav_submenu_model->total_rows($q);
        $mst_nav_submenu = $this->mst_nav_submenu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_nav_submenu_data' => $mst_nav_submenu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,


        );
        $this->load->view('mst_nav_submenu_list', $data);
    }

    public function read($id) 
    {
        $row = $this->mst_nav_submenu_model->get_by_id($id);
				$sql_aktif = "SELECT * FROM template_dummy_reff ORDER BY title";
			$sql_id_menu = "SELECT * FROM template_dummy_reff ORDER BY title";
			
        if ($row) {
            $data = array('radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'icon' => set_value('icon', $row->icon),'dropdown-id_menu' => $this->formgenerator->get_dropdown('id_menu',$sql_id_menu,$row->id_menu),
			
		'id_submenu' => set_value('id_submenu', $row->id_submenu),
		'no_urut' => set_value('no_urut', $row->no_urut),
		'submenu' => set_value('submenu', $row->submenu),
		'url' => set_value('url', $row->url),
	    );
						
            //$this->load->view('mst_nav_submenu_read', $data);
						$this->parser->parse('mst_nav_submenu_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_submenu'));
        }
    }

    public function create() 
    {
			$this->load->library('FormGenerator');
			$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
			$sql_id_menu = "SELECT * FROM mst_nav_menu ORDER BY urutan";
			
        $data = array(
					'button' => 'Create',
					'action' => site_url('mst_nav_submenu/create_action'),
					'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,1),

					'icon' => set_value('icon'),
					'dropdown-id_menu' => $this->formgenerator->get_dropdown('id_menu',$sql_id_menu),

					'id_submenu' => set_value('id_submenu'),
					'no_urut' => set_value('no_urut'),
					'submenu' => set_value('submenu'),
					'url' => set_value('url'),
	);
        //$this->load->view('mst_nav_submenu_form', $data);
				$this->parser->parse('mst_nav_submenu_form', $data);
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
		'icon' => $this->input->post('icon',TRUE),
		'id_menu' => $this->input->post('id_menu',TRUE),
		'no_urut' => $this->input->post('no_urut',TRUE),
		'submenu' => $this->input->post('submenu',TRUE),
		'url' => $this->input->post('url',TRUE),
	    );
						$data = $data + $data_u;
            $this->mst_nav_submenu_model->insert($data);
            #$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mst_nav_submenu'));
        }
    }
    
    public function update($id) 
    {
		$this->load->library('FormGenerator');
        $row = $this->mst_nav_submenu_model->get_by_id($id);
			$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
			$sql_id_menu = "SELECT * FROM mst_nav_menu ORDER BY urutan";
			
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_nav_submenu/update_action'),
				'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'icon' => set_value('icon', $row->icon),'dropdown-id_menu' => $this->formgenerator->get_dropdown('id_menu',$sql_id_menu,$row->id_menu),
			
		'id_submenu' => set_value('id_submenu', $row->id_submenu),
		'no_urut' => set_value('no_urut', $row->no_urut),
		'submenu' => set_value('submenu', $row->submenu),
		'url' => set_value('url', $row->url),
	    );
            //$this->load->view('mst_nav_submenu_form', $data);
						$this->parser->parse('mst_nav_submenu_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_submenu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_submenu', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
		'aktif' => $this->input->post('aktif',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'id_menu' => $this->input->post('id_menu',TRUE),
		'no_urut' => $this->input->post('no_urut',TRUE),
		'submenu' => $this->input->post('submenu',TRUE),
		'url' => $this->input->post('url',TRUE),
	    );
						$data = $data + $data_u;
            $this->mst_nav_submenu_model->update($this->input->post('id_submenu', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_nav_submenu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->mst_nav_submenu_model->get_by_id($id);

        if ($row) {
            $this->mst_nav_submenu_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_nav_submenu'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_submenu'));
        }
    }

    public function _rules() 
    {
	#$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');
	#$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	#$this->form_validation->set_rules('id_menu', 'id menu', 'trim|required');
	$this->form_validation->set_rules('no_urut', 'no urut', 'trim|required');
	$this->form_validation->set_rules('submenu', 'submenu', 'trim|required');
	$this->form_validation->set_rules('url', 'url', 'trim|required');

	$this->form_validation->set_rules('id_submenu', 'id_submenu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->mst_nav_submenu_model->total_rows($q);
				$mst_nav_submenu = $this->mst_nav_submenu_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_nav_submenu_data' => $mst_nav_submenu,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_nav_submenu_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->mst_nav_submenu_model->total_rows($q);
		$rs = $this->mst_nav_submenu_model->get_limit_data($config['per_page'], $start, $q);
		foreach($rs[0] as $k => $v)
		{
			$fields[] = (object)array('name' => $k);
		}

		foreach($fields as $k => $v)
		{
			$no = $k+1;
			$arrCol[] = array('urutan'=>($no), 'nilai'=>$v->name,'fontsize'=> '12', 'bold'=>true, 'namanya'=>$v->name, 'format'=>'string');
		}
		$arrExcel = array('sNAMESS'=>'formgenerator', 'sFILNAM'=>$parameter,'col'=>$arrCol, 'rsl'=>$rs);
		$this->libexcel->bangunexcel($arrExcel);
	}


}

/* End of file mst_nav_submenu.php */
/* Location: ./application/controllers/mst_nav_submenu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-13 09:17:19 */
/* http://harviacode.com */