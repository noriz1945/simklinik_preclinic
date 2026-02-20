<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_nav_role_menu extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mst_nav_role_menu_model');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_nav_role_menu/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_nav_role_menu/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_nav_role_menu/';
            $config['first_url'] = base_url() . 'mst_nav_role_menu/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->mst_nav_role_menu_model->total_rows($q);
        $mst_nav_role_menu = $this->mst_nav_role_menu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_nav_role_menu_data' => $mst_nav_role_menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,


        );
        $this->load->view('mst_nav_role_menu_list', $data);
    }

    public function read($id) 
    {
        $row = $this->mst_nav_role_menu_model->get_by_id($id);
				$sql_id_menu = "SELECT * FROM template_dummy_reff ORDER BY title";
			$sql_id_role = "SELECT * FROM template_dummy_reff ORDER BY title";
			
        if ($row) {
            $data = array('dropdown-id_menu' => $this->sarkodan->get_dropdown('id_menu',$sql_id_menu,$row->id_menu),
			'dropdown-id_role' => $this->sarkodan->get_dropdown('id_role',$sql_id_role,$row->id_role),
			
		'id_usermenu' => set_value('id_usermenu', $row->id_usermenu),
	    );
						
            //$this->load->view('mst_nav_role_menu_read', $data);
						$this->parser->parse('mst_nav_role_menu_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_role_menu'));
        }
    }

    public function create() 
    {
			$this->load->library('FormGenerator');
			$sql_id_menu = "SELECT 	a.id_menu
									,(CASE WHEN a.`is_grup_submenu`=0 THEN a.menu ELSE CONCAT('  -  ',a.menu) END) AS menu
							FROM 	mst_nav_menu a
							ORDER BY (CASE WHEN a.`is_grup_submenu`=0 THEN a.urutan 
										ELSE CONCAT((SELECT x.urutan FROM mst_nav_menu x WHERE x.id_menu=a.id_menu_parent),'.',a.`urutan`) 
									  END)";
			$sql_id_role = "SELECT * FROM mst_nav_role ORDER BY id_role";
			
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_nav_role_menu/create_action'),
						'dropdown-id_menu' => $this->formgenerator->get_dropdown('id_menu',$sql_id_menu),
			'dropdown-id_role' => $this->formgenerator->get_dropdown('id_role',$sql_id_role),
			
	    'id_usermenu' => set_value('id_usermenu'),
	);
        //$this->load->view('mst_nav_role_menu_form', $data);
				$this->parser->parse('mst_nav_role_menu_form', $data);
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
		'id_menu' => $this->input->post('id_menu',TRUE),
		'id_role' => $this->input->post('id_role',TRUE),
	    );
						$data = $data + $data_u;
            $this->mst_nav_role_menu_model->insert($data);
            #$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mst_nav_role_menu'));
        }
    }
    
    public function update($id) 
    {
		$this->load->library('FormGenerator');
        $row = $this->mst_nav_role_menu_model->get_by_id($id);
			$sql_id_menu = "SELECT 	a.id_menu
									,(CASE WHEN a.`is_grup_submenu`=0 THEN a.menu ELSE CONCAT(' - ',a.menu) END) AS menu
							FROM 	mst_nav_menu a
							ORDER BY (CASE WHEN a.`is_grup_submenu`=0 THEN a.urutan 
										ELSE CONCAT((SELECT x.urutan FROM mst_nav_menu x WHERE x.id_menu=a.id_menu_parent),'.',a.`urutan`) 
									  END)";
			$sql_id_role = "SELECT * FROM mst_nav_role ORDER BY id_role";
			
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_nav_role_menu/update_action'),
				'dropdown-id_menu' => $this->formgenerator->get_dropdown('id_menu',$sql_id_menu,$row->id_menu),
			'dropdown-id_role' => $this->formgenerator->get_dropdown('id_role',$sql_id_role,$row->id_role),
			
		'id_usermenu' => set_value('id_usermenu', $row->id_usermenu),
	    );
            //$this->load->view('mst_nav_role_menu_form', $data);
						$this->parser->parse('mst_nav_role_menu_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_role_menu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_usermenu', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
		'id_menu' => $this->input->post('id_menu',TRUE),
		'id_role' => $this->input->post('id_role',TRUE),
	    );
						$data = $data + $data_u;
            $this->mst_nav_role_menu_model->update($this->input->post('id_usermenu', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_nav_role_menu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->mst_nav_role_menu_model->get_by_id($id);

        if ($row) {
            $this->mst_nav_role_menu_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_nav_role_menu'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_role_menu'));
        }
    }

    public function _rules() 
    {
	#$this->form_validation->set_rules('id_menu', 'id menu', 'trim|required');
	#$this->form_validation->set_rules('id_role', 'id role', 'trim|required');

	$this->form_validation->set_rules('id_usermenu', 'id_usermenu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->mst_nav_role_menu_model->total_rows($q);
				$mst_nav_role_menu = $this->mst_nav_role_menu_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_nav_role_menu_data' => $mst_nav_role_menu,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_nav_role_menu_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->mst_nav_role_menu_model->total_rows($q);
		$rs = $this->mst_nav_role_menu_model->get_limit_data($config['per_page'], $start, $q);
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

/* End of file mst_nav_role_menu.php */
/* Location: ./application/controllers/mst_nav_role_menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-13 09:51:36 */
/* http://harviacode.com */