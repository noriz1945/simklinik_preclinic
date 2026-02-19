<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_nav_user extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mst_nav_user_model');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_nav_user/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_nav_user/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_nav_user/';
            $config['first_url'] = base_url() . 'mst_nav_user/';
        }

        $config['per_page'] = 1000000;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->mst_nav_user_model->total_rows($q);
        $mst_nav_user = $this->mst_nav_user_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_nav_user_data' => $mst_nav_user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,


        );
        $this->load->view('mst_nav_user_list', $data);
    }

    public function read($id) 
    {
        $row = $this->mst_nav_user_model->get_by_id($id);
				$sql_aktif = "SELECT * FROM template_dummy_reff ORDER BY title";
			$sql_id_dokter = "SELECT * FROM template_dummy_reff ORDER BY title";
			$sql_id_role = "SELECT * FROM template_dummy_reff ORDER BY title";
			
        if ($row) {
            $data = array('radio-aktif' => $this->sarkodan->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'created' => set_value('created', $row->created),
		'creator' => set_value('creator', $row->creator),'dropdown-id_dokter' => $this->sarkodan->get_dropdown('id_dokter',$sql_id_dokter,$row->id_dokter),
			'dropdown-id_role' => $this->sarkodan->get_dropdown('id_role',$sql_id_role,$row->id_role),
			
		'login_name' => set_value('login_name', $row->login_name),
		'login_pass' => set_value('login_pass', $row->login_pass),
		'name' => set_value('name', $row->name),
		'updated' => set_value('updated', $row->updated),
		'updater' => set_value('updater', $row->updater),
	    );
						
            //$this->load->view('mst_nav_user_read', $data);
						$this->parser->parse('mst_nav_user_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_user'));
        }
    }

    public function create() 
    {
			$this->load->library('FormGenerator');
			$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
			$sql_id_dokter = "SELECT * FROM mst_dokter ORDER BY name";
			$sql_id_role = "SELECT * FROM mst_nav_role ORDER BY id_role";
			
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_nav_user/create_action'),
			'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,1),
			
	    'created' => set_value('created'),
	    'creator' => set_value('creator'),
		'dropdown-id_dokter' => $this->formgenerator->get_dropdown('id_dokter',$sql_id_dokter),
			'dropdown-id_role' => $this->formgenerator->get_dropdown('id_role',$sql_id_role),
			
	    'login_name' => set_value('login_name'),
	    'login_pass' => set_value('login_pass'),
	    'name' => set_value('name'),
			'sip_str' => set_value('sip_str'),
	    'updated' => set_value('updated'),
	    'updater' => set_value('updater'),
	);
        //$this->load->view('mst_nav_user_form', $data);
				$this->parser->parse('mst_nav_user_form', $data);
    }
    
    public function create_action() 
    {
				print_r($_POST);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
					$data_u = array();
				
            $data = array(
		'aktif' => $this->input->post('aktif',TRUE),
		'created' => $this->input->post('created',TRUE),
		'creator' => $this->input->post('creator',TRUE),
		'id_dokter' => $this->input->post('id_dokter',TRUE),
		'id_role' => $this->input->post('id_role',TRUE),
		'login_name' => $this->input->post('login_name',TRUE),
		'login_pass' => md5($this->input->post('login_pass',TRUE)),
		'name' => $this->input->post('name',TRUE),
				'sip_str' => $this->input->post('sip_str',TRUE),
		'updated' => $this->input->post('updated',TRUE),
		'updater' => $this->input->post('updater',TRUE),
	    );
						$data = $data + $data_u;
            $this->mst_nav_user_model->insert($data);
            #$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mst_nav_user'));
        }
    }
    
    public function update($id) 
    {
			$this->load->library('FormGenerator');
      $row = $this->mst_nav_user_model->get_by_id($id);
			$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
			$sql_id_dokter = "SELECT * FROM mst_dokter ORDER BY name";
			$sql_id_role = "SELECT * FROM mst_nav_role a WHERE a.id_role<>'33' ORDER BY id_role";
			
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_nav_user/update_action'),
				'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'created' => set_value('created', $row->created),
		'creator' => set_value('creator', $row->creator),
		'dropdown-id_dokter' => $this->formgenerator->get_dropdown('id_dokter',$sql_id_dokter,$row->id_dokter),
			'dropdown-id_role' => $this->formgenerator->get_dropdown('id_role',$sql_id_role,$row->id_role),
			
		'login_name' => set_value('login_name', $row->login_name),
		#'login_pass' => set_value('login_pass', $row->login_pass),
		'login_pass' => '',
		'name' => set_value('name', $row->name),
				'sip_str' => set_value('sip_str', $row->sip_str),
		'updated' => set_value('updated', $row->updated),
		'updater' => set_value('updater', $row->updater),
	    );
            //$this->load->view('mst_nav_user_form', $data);
						$this->parser->parse('mst_nav_user_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('login_name', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
				'aktif' => $this->input->post('aktif',TRUE),
				'created' => $this->input->post('created',TRUE),
				'creator' => $this->input->post('creator',TRUE),
				'id_dokter' => $this->input->post('id_dokter',TRUE),
				'id_role' => $this->input->post('id_role',TRUE),
				'login_name' => $this->input->post('login_name',TRUE),
				
				'name' => $this->input->post('name',TRUE),
				'sip_str' => $this->input->post('sip_str',TRUE),
				'updated' => $this->input->post('updated',TRUE),
				'updater' => $this->input->post('updater',TRUE),
			);
			
			$login_pass = $this->input->post('login_pass',TRUE);
			if($login_pass!='')
			{
				$data['login_pass'] = md5($login_pass);
			}
			
			$data = $data + $data_u;
            $this->mst_nav_user_model->update($this->input->post('login_name', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_nav_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->mst_nav_user_model->get_by_id($id);

        if ($row) {
            $this->mst_nav_user_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_nav_user'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_nav_user'));
        }
    }

    public function _rules() 
    {
	#$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');
	#$this->form_validation->set_rules('created', 'created', 'trim|required');
	#$this->form_validation->set_rules('creator', 'creator', 'trim|required');
	#$this->form_validation->set_rules('id_dokter', 'id dokter', 'trim|required');
	$this->form_validation->set_rules('id_role', 'id role', 'trim|required');
	#$this->form_validation->set_rules('login_pass', 'login pass', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	#$this->form_validation->set_rules('sip_str', 'sip_str', 'trim|required');
	#$this->form_validation->set_rules('updated', 'updated', 'trim|required');
	#$this->form_validation->set_rules('updater', 'updater', 'trim|required');

	$this->form_validation->set_rules('login_name', 'login_name', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->mst_nav_user_model->total_rows($q);
				$mst_nav_user = $this->mst_nav_user_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_nav_user_data' => $mst_nav_user,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_nav_user_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->mst_nav_user_model->total_rows($q);
		$rs = $this->mst_nav_user_model->get_limit_data($config['per_page'], $start, $q);
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

/* End of file mst_nav_user.php */
/* Location: ./application/controllers/mst_nav_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-13 10:01:00 */
/* http://harviacode.com */