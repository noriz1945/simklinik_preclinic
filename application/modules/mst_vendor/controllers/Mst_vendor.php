<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_vendor extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mst_vendor_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_vendor/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_vendor/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_vendor/';
            $config['first_url'] = base_url() . 'mst_vendor/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Mst_vendor_model->total_rows($q);
        $mst_vendor = $this->Mst_vendor_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_vendor_data' => $mst_vendor,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('mst_vendor_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Mst_vendor_model->get_by_id($id);
				
        if ($row) {
            $data = array(
				'id_vendor' => set_value('id_vendor', $row->id_vendor),
				'vendor' => set_value('vendor', $row->vendor),
				'alamat' => set_value('alamat', $row->alamat),
				'nama_kontak' => set_value('nama_kontak', $row->nama_kontak),
				'no_telp' => set_value('no_telp', $row->no_telp),
				'no_hp_wa' => set_value('no_hp_wa', $row->no_hp_wa),
				'creator' => set_value('creator', $row->creator),
				'created' => set_value('created', $row->created),
				'updater' => set_value('updater', $row->updater),
				'updated' => set_value('updated', $row->updated),
			);
						
            //$this->load->view('mst_vendor_read', $data);
						$this->parser->parse('mst_vendor_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_vendor'));
        }
    }

    public function create() 
    {
			
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_vendor/create_action'),
			'id_vendor' => set_value('id_vendor'),
			'vendor' => set_value('vendor'),
			'alamat' => set_value('alamat'),
			'nama_kontak' => set_value('nama_kontak'),
			'no_telp' => set_value('no_telp'),
			'no_hp_wa' => set_value('no_hp_wa'),
			'creator' => set_value('creator'),
			'created' => set_value('created'),
			'updater' => set_value('updater'),
			'updated' => set_value('updated'),
		);
        //$this->load->view('mst_vendor_form', $data);
				$this->parser->parse('mst_vendor_form', $data);
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
				'vendor' 		=> $this->input->post('vendor',TRUE),
				'alamat' 		=> $this->input->post('alamat',TRUE),
				'nama_kontak' 	=> $this->input->post('nama_kontak',TRUE),
				'no_telp' 		=> $this->input->post('no_telp',TRUE),
				'no_hp_wa' 		=> $this->input->post('no_hp_wa',TRUE),
				'creator' 		=> $this->session->userdata['sp']->login_name,
				'created' 		=> date("Y-m-d H:i:s"),
				#'updater' 		=> $this->session->userdata['sp']->login_name,
				#'updated' 		=> date("Y-m-d H:i:s"),
			);
			$data_r['creator'] 			= $this->session->userdata['sp']->login_name;
			$data_r['created'] 			= date("Y-m-d H:i:s");
			
			$data = $data + $data_u;
			$this->Mst_vendor_model->insert($data);
			#$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('mst_vendor'));
		}
    }
    
    public function update($id) 
    {
        $row = $this->Mst_vendor_model->get_by_id($id);
			
        if ($row) {
            $data = array(
				'button' 		=> 'Update',
				'action' 		=> site_url('mst_vendor/update_action'),
				'id_vendor' 	=> set_value('id_vendor', $row->id_vendor),
				'vendor' 		=> set_value('vendor', $row->vendor),
				'alamat' 		=> set_value('alamat', $row->alamat),
				'nama_kontak' 	=> set_value('nama_kontak', $row->nama_kontak),
				'no_telp' 		=> set_value('no_telp', $row->no_telp),
				'no_hp_wa' 		=> set_value('no_hp_wa', $row->no_hp_wa),
				'creator' 		=> set_value('creator', $row->creator),
				'created' 		=> set_value('created', $row->created),
				'updater' 		=> set_value('updater', $row->updater),
				'updated' 		=> set_value('updated', $row->updated),
				);
            //$this->load->view('mst_vendor_form', $data);
						$this->parser->parse('mst_vendor_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_vendor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_vendor', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
				'vendor' 		=> $this->input->post('vendor',TRUE),
				'alamat' 		=> $this->input->post('alamat',TRUE),
				'nama_kontak' 	=> $this->input->post('nama_kontak',TRUE),
				'no_telp' 		=> $this->input->post('no_telp',TRUE),
				'no_hp_wa' 		=> $this->input->post('no_hp_wa',TRUE),
				#'creator' 		=> $this->session->userdata['sp']->login_name,
				#'created' 		=> date("Y-m-d H:i:s"),
				'updater' 		=> $this->session->userdata['sp']->login_name,
				'updated' 		=> date("Y-m-d H:i:s"),
			);
			$data = $data + $data_u;
            $this->Mst_vendor_model->update($this->input->post('id_vendor', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_vendor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mst_vendor_model->get_by_id($id);

        if ($row) {
            $this->Mst_vendor_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_vendor'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_vendor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
	#$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	#$this->form_validation->set_rules('nama_kontak', 'nama kontak', 'trim|required');
	#$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	#$this->form_validation->set_rules('no_hp_wa', 'no hp wa', 'trim|required');
	#$this->form_validation->set_rules('creator', 'creator', 'trim|required');
	#$this->form_validation->set_rules('created', 'created', 'trim|required');
	#$this->form_validation->set_rules('updater', 'updater', 'trim|required');
	#$this->form_validation->set_rules('updated', 'updated', 'trim|required');

	$this->form_validation->set_rules('id_vendor', 'id_vendor', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


}
?>
