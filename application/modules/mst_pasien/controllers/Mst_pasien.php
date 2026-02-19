<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_pasien extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mst_pasien_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
		$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_pasien/?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'mst_pasien/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_pasien/';
            $config['first_url'] = base_url() . 'mst_pasien/';
        }

        // Limit list to the latest 100 records
        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        // Avoid heavy COUNT(*) when not needed for the UI
        $config['total_rows'] = 0;
        // Optimized data fetch
        if (method_exists($this->Mst_pasien_model, 'get_limit_data_fast')) {
            $mst_pasien = $this->Mst_pasien_model->get_limit_data_fast($config['per_page'], $start, $q);
        } else {
            $mst_pasien = $this->Mst_pasien_model->get_limit_data($config['per_page'], $start, $q);
        }

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_pasien_data' => $mst_pasien,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('mst_pasien_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Mst_pasien_model->get_by_id($id);
		$sql_gender = "SELECT * FROM mst_gender";
		$sql_id_mar = "SELECT * FROM mst_pasien_mar";
		$sql_id_pend = "SELECT * FROM mst_pendidikan";
		$sql_id_agama = "SELECT * FROM mst_agama ORDER BY name";
		$sql_blood_type = "SELECT * FROM mst_blood_type";
		$sql_rh_type = "SELECT * FROM mst_rh";
		$sql_id_job = "SELECT * FROM mst_pasien_job";
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
			
        if ($row) {
            $data = array(
		'id_pasien' => set_value('id_pasien', $row->id_pasien),
		'name' => set_value('name', $row->name),
		'id_social' => set_value('id_social', $row->id_social),
		'id_pid' => set_value('id_pid', $row->id_pid),
		'pid_num' => set_value('pid_num', $row->pid_num),
		'birthdate' => set_value('birthdate', $row->birthdate),
		'birthplace' => set_value('birthplace', $row->birthplace),
		'radio-gender' => $this->formgenerator->get_radio('gender',$sql_gender,$row->gender),
			'radio-id_mar' => $this->formgenerator->get_radio('id_mar',$sql_id_mar,$row->id_mar),
			'dropdown-id_pend' => $this->formgenerator->get_dropdown('id_pend',$sql_id_pend,$row->id_pend),
			
		'id_nation' => set_value('id_nation', $row->id_nation),'dropdown-id_agama' => $this->formgenerator->get_dropdown('id_agama',$sql_id_agama,$row->id_agama),
			'radio-blood_type' => $this->formgenerator->get_radio('blood_type',$sql_blood_type,$row->blood_type),
			'radio-rh_type' => $this->formgenerator->get_radio('rh_type',$sql_rh_type,$row->rh_type),
			
		'address' => set_value('address', $row->address),
		'address_em' => set_value('address_em', $row->address_em),
		'telp' => set_value('telp', $row->telp),
		'hp' => set_value('hp', $row->hp),
		'father_name' => set_value('father_name', $row->father_name),
		'mother_name' => set_value('mother_name', $row->mother_name),
		'email' => set_value('email', $row->email),
		'id_propinsi' => set_value('id_propinsi', $row->id_propinsi),
		'id_kota' => set_value('id_kota', $row->id_kota),
		'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
		'id_kelurahan' => set_value('id_kelurahan', $row->id_kelurahan),
		'kodepos' => set_value('kodepos', $row->kodepos),'dropdown-id_job' => $this->formgenerator->get_dropdown('id_job',$sql_id_job,$row->id_job),
			
		'job_position' => set_value('job_position', $row->job_position),
		'departemen' => set_value('departemen', $row->departemen),
		'nik' => set_value('nik', $row->nik),
		'is_bth' => set_value('is_bth', $row->is_bth),
		'description' => set_value('description', $row->description),
		'paslb' => set_value('paslb', $row->paslb),
		'fam_name' => set_value('fam_name', $row->fam_name),
		'fam_addr' => set_value('fam_addr', $row->fam_addr),
		'fam_telp' => set_value('fam_telp', $row->fam_telp),
		'fam_hp' => set_value('fam_hp', $row->fam_hp),
		'asm_id' => set_value('asm_id', $row->asm_id),
		'asm_name' => set_value('asm_name', $row->asm_name),
		'asm_comp' => set_value('asm_comp', $row->asm_comp),
		'asm_fam' => set_value('asm_fam', $row->asm_fam),'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'created' => set_value('created', $row->created),
		'creator' => set_value('creator', $row->creator),
		'updated' => set_value('updated', $row->updated),
		'updater' => set_value('updater', $row->updater),
	    );
						
            //$this->load->view('mst_pasien_read', $data);
						$this->parser->parse('mst_pasien_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_pasien'));
        }
    }
	
	public function inner_pasien_baru_reg($redirect="") 
    {
		$sql_gender = "SELECT * FROM mst_gender";
		$sql_id_mar = "SELECT * FROM mst_pasien_mar";
		$sql_id_pend = "SELECT * FROM mst_pendidikan";
		$sql_id_agama = "SELECT * FROM mst_agama ORDER BY name";
		$sql_blood_type = "SELECT * FROM mst_blood_type";
		$sql_rh_type = "SELECT * FROM mst_rh";
		$sql_id_job = "SELECT * FROM mst_pasien_job";
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_asm_comp = "SELECT id_company,name FROM mst_company WHERE aktif=1 ORDER BY name";
			
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_pasien/create_action/'.$redirect),
	    'id_pasien' => set_value('id_pasien'),
	    'name' => set_value('name'),
	    'id_social' => set_value('id_social'),
	    'id_pid' => set_value('id_pid'),
	    'pid_num' => set_value('pid_num'),
	    'birthdate' => set_value('birthdate'),
	    'birthplace' => set_value('birthplace'),'radio-gender' => $this->formgenerator->get_radio('gender',$sql_gender),
			'radio-id_mar' => $this->formgenerator->get_radio('id_mar',$sql_id_mar),
			'dropdown-id_pend' => $this->formgenerator->get_dropdown('id_pend',$sql_id_pend),
			
	    'id_nation' => set_value('id_nation'),'dropdown-id_agama' => $this->formgenerator->get_dropdown('id_agama',$sql_id_agama),
			'radio-blood_type' => $this->formgenerator->get_radio('blood_type',$sql_blood_type),
			'radio-rh_type' => $this->formgenerator->get_radio('rh_type',$sql_rh_type),
			
	    'address' => set_value('address'),
	    'address_em' => set_value('address_em'),
	    'telp' => set_value('telp'),
	    'hp' => set_value('hp'),
	    'father_name' => set_value('father_name'),
	    'mother_name' => set_value('mother_name'),
	    'email' => set_value('email'),
	    'id_propinsi' => set_value('id_propinsi'),
	    'id_kota' => set_value('id_kota'),
	    'id_kecamatan' => set_value('id_kecamatan'),
	    'id_kelurahan' => set_value('id_kelurahan'),
	    'kodepos' => set_value('kodepos'),'dropdown-id_job' => $this->formgenerator->get_dropdown('id_job',$sql_id_job),
			
	    'job_position' => set_value('job_position'),
	    'departemen' => set_value('departemen'),
	    'nik' => set_value('nik'),
	    'is_bth' => set_value('is_bth'),
	    'description' => set_value('description'),
	    'paslb' => set_value('paslb'),
	    'fam_name' => set_value('fam_name'),
	    'fam_addr' => set_value('fam_addr'),
	    'fam_telp' => set_value('fam_telp'),
	    'fam_hp' => set_value('fam_hp'),
	    'asm_id' => set_value('asm_id'),
	    'asm_name' => set_value('asm_name'),
	    #'asm_comp' => set_value('asm_comp'),
		'dropdown_asm_comp' => $this->formgenerator->get_dropdown('asm_comp',$sql_asm_comp,'0001'),
	    'asm_fam' => set_value('asm_fam'),
		'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,1),
			
	    'created' => set_value('created'),
	    'creator' => set_value('creator'),
	    'updated' => set_value('updated'),
	    'updater' => set_value('updater'),
		
		'sosmed_instagram' => set_value('sosmed_instagram'),
		'sosmed_tiktok' => set_value('sosmed_tiktok'),
		'sosmed_facebook' => set_value('sosmed_facebook'),
		
		'recom_nama' => set_value('recom_nama'),
		'recom_wa' => set_value('recom_wa'),
		
		'redirect' => $redirect,
	);
        //$this->load->view('mst_pasien_form', $data);
				$this->parser->parse('inner_pasien_baru_reg', $data);
    }
    

    public function create($redirect="") 
    {
		$sql_gender = "SELECT * FROM mst_gender";
		$sql_id_mar = "SELECT * FROM mst_pasien_mar";
		$sql_id_pend = "SELECT * FROM mst_pendidikan";
		$sql_id_agama = "SELECT * FROM mst_agama ORDER BY name";
		$sql_blood_type = "SELECT * FROM mst_blood_type";
		$sql_rh_type = "SELECT * FROM mst_rh";
		$sql_id_job = "SELECT * FROM mst_pasien_job";
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_asm_comp = "SELECT id_company,name FROM mst_company WHERE aktif=1 ORDER BY name";
		
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_pasien/create_action/'.$redirect),
	    'id_pasien' => set_value('id_pasien'),
	    'name' => set_value('name'),
	    'id_social' => set_value('id_social'),
	    'id_pid' => set_value('id_pid'),
	    'pid_num' => set_value('pid_num'),
	    'birthdate' => set_value('birthdate'),
	    'birthplace' => set_value('birthplace'),
		'radio-gender' => $this->formgenerator->get_radio('gender',$sql_gender),
			'radio-id_mar' => $this->formgenerator->get_radio('id_mar',$sql_id_mar),
			'dropdown-id_pend' => $this->formgenerator->get_dropdown('id_pend',$sql_id_pend),
			
	    'id_nation' => set_value('id_nation'),'dropdown-id_agama' => $this->formgenerator->get_dropdown('id_agama',$sql_id_agama),
			'radio-blood_type' => $this->formgenerator->get_radio('blood_type',$sql_blood_type),
			'radio-rh_type' => $this->formgenerator->get_radio('rh_type',$sql_rh_type),
			
	    'address' => set_value('address'),
	    'address_em' => set_value('address_em'),
	    'telp' => set_value('telp'),
	    'hp' => set_value('hp'),
	    'father_name' => set_value('father_name'),
	    'mother_name' => set_value('mother_name'),
	    'email' => set_value('email'),
	    'id_propinsi' => set_value('id_propinsi'),
	    'id_kota' => set_value('id_kota'),
	    'id_kecamatan' => set_value('id_kecamatan'),
	    'id_kelurahan' => set_value('id_kelurahan'),
	    'kodepos' => set_value('kodepos'),'dropdown-id_job' => $this->formgenerator->get_dropdown('id_job',$sql_id_job),
			
	    'job_position' => set_value('job_position'),
	    'departemen' => set_value('departemen'),
	    'nik' => set_value('nik'),
	    'is_bth' => set_value('is_bth'),
	    'description' => set_value('description'),
	    'paslb' => set_value('paslb'),
	    'fam_name' => set_value('fam_name'),
	    'fam_addr' => set_value('fam_addr'),
	    'fam_telp' => set_value('fam_telp'),
	    'fam_hp' => set_value('fam_hp'),
	    'asm_id' => set_value('asm_id'),
	    'asm_name' => set_value('asm_name'),
	    #'asm_comp' => set_value('asm_comp'),
		'dropdown_asm_comp' => $this->formgenerator->get_dropdown('asm_comp',$sql_asm_comp,'0001'),
	    'asm_fam' => set_value('asm_fam'),
		'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,1),
			
	    'created' => set_value('created'),
	    'creator' => set_value('creator'),
	    'updated' => set_value('updated'),
	    'updater' => set_value('updater'),
		
		'sosmed_instagram' => set_value('sosmed_instagram'),
		'sosmed_tiktok' => set_value('sosmed_tiktok'),
		'sosmed_facebook' => set_value('sosmed_facebook'),
		'recom_nama' => set_value('recom_nama'),
		'recom_wa' => set_value('recom_wa'),
		
		'redirect' => $redirect,
	);
        //$this->load->view('mst_pasien_form', $data);
				$this->parser->parse('mst_pasien_form', $data);
    }
    
    public function create_action($redirect="") 
    {
				#print_r($_POST);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
					$data_u = array();
		
		$new_id_pasien = $this->get_new_id_pasien();
            $data = array(
		
		'id_pasien' => $new_id_pasien,
		'name' => $this->input->post('name',TRUE),
		'id_social' => $this->input->post('id_social',TRUE),
		'id_pid' => $this->input->post('id_pid',TRUE),
		'pid_num' => $this->input->post('pid_num',TRUE),
		'birthdate' => $this->input->post('birthdate',TRUE),
		'birthplace' => $this->input->post('birthplace',TRUE),
		'gender' => $this->input->post('gender',TRUE),
		'id_mar' => $this->input->post('id_mar',TRUE),
		'id_pend' => $this->input->post('id_pend',TRUE),
		'id_nation' => $this->input->post('id_nation',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'blood_type' => $this->input->post('blood_type',TRUE),
		'rh_type' => $this->input->post('rh_type',TRUE),
		'address' => $this->input->post('address',TRUE),
		'address_em' => $this->input->post('address_em',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'father_name' => $this->input->post('father_name',TRUE),
		'mother_name' => $this->input->post('mother_name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'id_propinsi' => $this->input->post('id_propinsi',TRUE),
		'id_kota' => $this->input->post('id_kota',TRUE),
		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
		'id_kelurahan' => $this->input->post('id_kelurahan',TRUE),
		'kodepos' => $this->input->post('kodepos',TRUE),
		'id_job' => $this->input->post('id_job',TRUE),
		'job_position' => $this->input->post('job_position',TRUE),
		'departemen' => $this->input->post('departemen',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'is_bth' => $this->input->post('is_bth',TRUE),
		'description' => $this->input->post('description',TRUE),
		'paslb' => $this->input->post('paslb',TRUE),
		'fam_name' => $this->input->post('fam_name',TRUE),
		'fam_addr' => $this->input->post('fam_addr',TRUE),
		'fam_telp' => $this->input->post('fam_telp',TRUE),
		'fam_hp' => $this->input->post('fam_hp',TRUE),
		'asm_id' => $this->input->post('asm_id',TRUE),
		'asm_name' => $this->input->post('asm_name',TRUE),
		'asm_comp' => $this->input->post('asm_comp',TRUE),
		'asm_fam' => $this->input->post('asm_fam',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
		'created' => $this->input->post('created',TRUE),
		'creator' => $this->input->post('creator',TRUE),
		'updated' => $this->input->post('updated',TRUE),
		'updater' => $this->input->post('updater',TRUE),
		
		'sosmed_instagram' 	=> $this->input->post('sosmed_instagram',TRUE),
		'sosmed_tiktok' 	=> $this->input->post('sosmed_tiktok',TRUE),
		'sosmed_facebook' 	=> $this->input->post('sosmed_facebook',TRUE),
		'recom_nama' 		=> $this->input->post('recom_nama',TRUE),
		'recom_wa' 			=> $this->input->post('recom_wa',TRUE),
	    );
		
			$data = $data + $data_u;
            $this->Mst_pasien_model->insert($data);
            #$this->session->set_flashdata('message', 'Create Record Success');
			if($redirect!='')
				redirect(site_url('trx_reg/create/'.$new_id_pasien));
			else
				redirect(site_url('mst_pasien'));
        }
    }
    
    public function update($id) 
    {
		#$this->output->enable_profiler(true);
        $row = $this->Mst_pasien_model->get_by_id($id);
		$sql_gender = "SELECT * FROM mst_gender";
		$sql_id_mar = "SELECT * FROM mst_pasien_mar";
		$sql_id_pend = "SELECT * FROM mst_pendidikan";
		$sql_id_agama = "SELECT * FROM mst_agama ORDER BY name";
		$sql_blood_type = "SELECT * FROM mst_blood_type";
		$sql_rh_type = "SELECT * FROM mst_rh";
		$sql_id_job = "SELECT * FROM mst_pasien_job";
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_asm_comp = "SELECT id_company,name FROM mst_company WHERE aktif=1 ORDER BY name";
		
		#print_r($row);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_pasien/update_action'),
		'id_pasien' => set_value('id_pasien', $row->id_pasien),
		'name' => set_value('name', $row->name),
		'id_social' => set_value('id_social', $row->id_social),
		'id_pid' => set_value('id_pid', $row->id_pid),
		'pid_num' => set_value('pid_num', $row->pid_num),
		'birthdate' => set_value('birthdate', $row->birthdate),
		'birthplace' => set_value('birthplace', $row->birthplace),'radio-gender' => $this->formgenerator->get_radio('gender',$sql_gender,$row->gender),
			'radio-id_mar' => $this->formgenerator->get_radio('id_mar',$sql_id_mar,$row->id_mar),
			'dropdown-id_pend' => $this->formgenerator->get_dropdown('id_pend',$sql_id_pend,$row->id_pend),
			
		'id_nation' => set_value('id_nation', $row->id_nation),'dropdown-id_agama' => $this->formgenerator->get_dropdown('id_agama',$sql_id_agama,$row->id_agama),
			'radio-blood_type' => $this->formgenerator->get_radio('blood_type',$sql_blood_type,$row->blood_type),
			'radio-rh_type' => $this->formgenerator->get_radio('rh_type',$sql_rh_type,$row->rh_type),
			
		'address' => set_value('address', $row->address),
		'address_em' => set_value('address_em', $row->address_em),
		'telp' => set_value('telp', $row->telp),
		'hp' => set_value('hp', $row->hp),
		'father_name' => set_value('father_name', $row->father_name),
		'mother_name' => set_value('mother_name', $row->mother_name),
		'email' => set_value('email', $row->email),
		'id_propinsi' => set_value('id_propinsi', $row->id_propinsi),
		'id_kota' => set_value('id_kota', $row->id_kota),
		'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
		'id_kelurahan' => set_value('id_kelurahan', $row->id_kelurahan),
		
		'propinsi' => set_value('id_propinsi', $row->propinsi),
		'kota' => set_value('id_kota', $row->kota),
		'kecamatan' => set_value('id_kecamatan', $row->kecamatan),
		'kelurahan' => set_value('id_kelurahan', $row->kelurahan),
		'kodepos' => set_value('kodepos', $row->kodepos),'dropdown-id_job' => $this->formgenerator->get_dropdown('id_job',$sql_id_job,$row->id_job),
			
		'job_position' => set_value('job_position', $row->job_position),
		'departemen' => set_value('departemen', $row->departemen),
		'nik' => set_value('nik', $row->nik),
		'is_bth' => set_value('is_bth', $row->is_bth),
		'description' => set_value('description', $row->description),
		'paslb' => set_value('paslb', $row->paslb),
		'fam_name' => set_value('fam_name', $row->fam_name),
		'fam_addr' => set_value('fam_addr', $row->fam_addr),
		'fam_telp' => set_value('fam_telp', $row->fam_telp),
		'fam_hp' => set_value('fam_hp', $row->fam_hp),
		'asm_id' => set_value('asm_id', $row->asm_id),
		'asm_name' => set_value('asm_name', $row->asm_name),
		'asm_comp' => set_value('asm_comp', $row->asm_comp),
		'dropdown_asm_comp' => $this->formgenerator->get_dropdown('asm_comp',$sql_asm_comp,$row->asm_comp),
		'asm_fam' => set_value('asm_fam', $row->asm_fam),
		'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'created' => set_value('created', $row->created),
		'creator' => set_value('creator', $row->creator),
		'updated' => set_value('updated', $row->updated),
		'updater' => set_value('updater', $row->updater),
		
		'sosmed_instagram' 	=> set_value('sosmed_instagram'	, $row->sosmed_instagram),
		'sosmed_tiktok' 	=> set_value('sosmed_tiktok'	, $row->sosmed_tiktok),
		'sosmed_facebook' 	=> set_value('sosmed_facebook'	, $row->sosmed_facebook),
		'recom_nama' 		=> set_value('recom_nama'		, $row->recom_nama),
		'recom_wa' 			=> set_value('recom_wa'			, $row->recom_wa),
	    );
            //$this->load->view('mst_pasien_form', $data);
						$this->parser->parse('mst_pasien_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_pasien'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pasien', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'id_social' => $this->input->post('id_social',TRUE),
		'id_pid' => $this->input->post('id_pid',TRUE),
		'pid_num' => $this->input->post('pid_num',TRUE),
		'birthdate' => $this->input->post('birthdate',TRUE),
		'birthplace' => $this->input->post('birthplace',TRUE),
		'gender' => $this->input->post('gender',TRUE),
		'id_mar' => $this->input->post('id_mar',TRUE),
		'id_pend' => $this->input->post('id_pend',TRUE),
		'id_nation' => $this->input->post('id_nation',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'blood_type' => $this->input->post('blood_type',TRUE),
		'rh_type' => $this->input->post('rh_type',TRUE),
		'address' => $this->input->post('address',TRUE),
		'address_em' => $this->input->post('address_em',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'father_name' => $this->input->post('father_name',TRUE),
		'mother_name' => $this->input->post('mother_name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'id_propinsi' => $this->input->post('id_propinsi',TRUE),
		'id_kota' => $this->input->post('id_kota',TRUE),
		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
		'id_kelurahan' => $this->input->post('id_kelurahan',TRUE),
		'kodepos' => $this->input->post('kodepos',TRUE),
		'id_job' => $this->input->post('id_job',TRUE),
		'job_position' => $this->input->post('job_position',TRUE),
		'departemen' => $this->input->post('departemen',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'is_bth' => $this->input->post('is_bth',TRUE),
		'description' => $this->input->post('description',TRUE),
		'paslb' => $this->input->post('paslb',TRUE),
		'fam_name' => $this->input->post('fam_name',TRUE),
		'fam_addr' => $this->input->post('fam_addr',TRUE),
		'fam_telp' => $this->input->post('fam_telp',TRUE),
		'fam_hp' => $this->input->post('fam_hp',TRUE),
		'asm_id' => $this->input->post('asm_id',TRUE),
		'asm_name' => $this->input->post('asm_name',TRUE),
		'asm_comp' => $this->input->post('asm_comp',TRUE),
		'asm_fam' => $this->input->post('asm_fam',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
		'created' => $this->input->post('created',TRUE),
		'creator' => $this->input->post('creator',TRUE),
		'updated' => $this->input->post('updated',TRUE),
		'updater' => $this->input->post('updater',TRUE),
		
		'sosmed_instagram' 	=> $this->input->post('sosmed_instagram',TRUE),
		'sosmed_tiktok' 	=> $this->input->post('sosmed_tiktok',TRUE),
		'sosmed_facebook' 	=> $this->input->post('sosmed_facebook',TRUE),
		'recom_nama' 		=> $this->input->post('recom_nama',TRUE),
		'recom_wa' 			=> $this->input->post('recom_wa',TRUE),
	    );
						$data = $data + $data_u;
            $this->Mst_pasien_model->update($this->input->post('id_pasien', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_pasien'));
        }
    }
    public function delete($id) 
    {
        $row = $this->Mst_pasien_model->get_by_id($id);

        if ($row) {
            $this->Mst_pasien_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_pasien'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_pasien'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	#$this->form_validation->set_rules('id_social', 'id social', 'trim|required');
	#$this->form_validation->set_rules('id_pid', 'id pid', 'trim|required');
	#$this->form_validation->set_rules('pid_num', 'pid num', 'trim|required');
	$this->form_validation->set_rules('birthdate', 'birthdate', 'trim|required');
	#$this->form_validation->set_rules('birthplace', 'birthplace', 'trim|required');
	#$this->form_validation->set_rules('gender', 'gender', 'trim|required');
	#$this->form_validation->set_rules('id_mar', 'id mar', 'trim|required');
	#$this->form_validation->set_rules('id_pend', 'id pend', 'trim|required');
	#$this->form_validation->set_rules('id_nation', 'id nation', 'trim|required');
	#$this->form_validation->set_rules('id_agama', 'id agama', 'trim|required');
	#$this->form_validation->set_rules('blood_type', 'blood type', 'trim|required');
	#$this->form_validation->set_rules('rh_type', 'rh type', 'trim|required');
	#$this->form_validation->set_rules('address', 'address', 'trim|required');
	#$this->form_validation->set_rules('address_em', 'address em', 'trim|required');
	#$this->form_validation->set_rules('telp', 'telp', 'trim|required');
	#$this->form_validation->set_rules('hp', 'hp', 'trim|required');
	#$this->form_validation->set_rules('father_name', 'father_name', 'trim|required');
	#$this->form_validation->set_rules('mother_name', 'mother_name', 'trim|required');
	#$this->form_validation->set_rules('email', 'email', 'trim|required');
	#$this->form_validation->set_rules('id_propinsi', 'id propinsi', 'trim|required');
	#$this->form_validation->set_rules('id_kota', 'id kota', 'trim|required');
	#$this->form_validation->set_rules('id_kecamatan', 'id kecamatan', 'trim|required');
	#$this->form_validation->set_rules('id_kelurahan', 'id kelurahan', 'trim|required');
	#$this->form_validation->set_rules('kodepos', 'kodepos', 'trim|required');
	#$this->form_validation->set_rules('id_job', 'id job', 'trim|required');
	#$this->form_validation->set_rules('job_position', 'job position', 'trim|required');
	#$this->form_validation->set_rules('departemen', 'departemen', 'trim|required');
	#$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	#$this->form_validation->set_rules('is_bth', 'is bth', 'trim|required');
	#$this->form_validation->set_rules('description', 'description', 'trim|required');
	#$this->form_validation->set_rules('paslb', 'paslb', 'trim|required');
	#$this->form_validation->set_rules('fam_name', 'fam name', 'trim|required');
	#$this->form_validation->set_rules('fam_addr', 'fam addr', 'trim|required');
	#$this->form_validation->set_rules('fam_telp', 'fam telp', 'trim|required');
	#$this->form_validation->set_rules('fam_hp', 'fam hp', 'trim|required');
	#$this->form_validation->set_rules('asm_id', 'asm id', 'trim|required');
	#$this->form_validation->set_rules('asm_name', 'asm name', 'trim|required');
	#$this->form_validation->set_rules('asm_comp', 'asm comp', 'trim|required');
	#$this->form_validation->set_rules('asm_fam', 'asm fam', 'trim|required');
	#$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');
	#$this->form_validation->set_rules('created', 'created', 'trim|required');
	#$this->form_validation->set_rules('creator', 'creator', 'trim|required');
	#$this->form_validation->set_rules('updated', 'updated', 'trim|required');
	#$this->form_validation->set_rules('updater', 'updater', 'trim|required');

	$this->form_validation->set_rules('id_pasien', 'id_pasien', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->Mst_pasien_model->total_rows($q);
				$mst_pasien = $this->Mst_pasien_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_pasien_data' => $mst_pasien,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_pasien_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->Mst_pasien_model->total_rows($q);
		$rs = $this->Mst_pasien_model->get_limit_data($config['per_page'], $start, $q);
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

	public function inner_get_data_autocomplete_id_propinsi()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_propinsi AS idx,a.`name` AS label
				FROM 	mst_propinsi a
				WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						AND a.aktif = 1
				";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}
		
	public function inner_get_data_autocomplete_id_kota()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_kota AS idx,a.`name` AS label
				FROM 	mst_kota a
				WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						AND a.aktif = 1
				";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}
		
	public function inner_get_data_autocomplete_id_kecamatan()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_kecamatan AS idx,a.`name` AS label
				FROM 	mst_kecamatan a
				WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						AND a.aktif = 1
				";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}
		
	public function inner_get_data_autocomplete_id_kelurahan()
	{
		$term = $this->input->get('term',true);
		$sql = "
				SELECT 	a.id_kelurahan AS idx,CONCAT(a.`name`,' - ',b.name) AS label
						,b.`id_kecamatan`,b.`name` AS kecamatan
						,c.`id_kota`,c.`name` AS kota
						,d.`id_propinsi`,d.`name` AS propinsi
						,a.kodepos
				FROM 	mst_kelurahan a
						JOIN `mst_kecamatan` b ON (b.`id_kecamatan`=a.`id_kecamatan`)
						JOIN `mst_kota` c ON (c.`id_kota`=b.`id_kota`)
						JOIN `mst_propinsi` d ON (d.`id_propinsi` =c.`id_propinsi`)
				WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						AND a.aktif = 1
				";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
			
			$rs[$k]['id_kecamatan'] = $v['id_kecamatan'];
			$rs[$k]['kecamatan'] = $v['kecamatan'];
			
			$rs[$k]['id_kota'] = $v['id_kota'];
			$rs[$k]['kota'] = $v['kota'];
			
			$rs[$k]['id_kota'] = $v['id_kota'];
			$rs[$k]['kota'] = $v['kota'];
		}
		$data = json_encode($rs);
		echo $data;
	}
		
	public function inner_get_data_autocomplete_id_nation()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_nation AS idx,a.`name` AS label
				FROM 	mst_nation a
				WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						-- AND a.aktif = 1
				";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}
	
	public function get_new_id_pasien()
	{
		$sql = "SELECT IFNULL((SELECT MAX((CAST(SUBSTR(a.id_pasien,-8) AS integer))+1) FROM mst_pasien a WHERE a.`is_rm_aps`=0),1) AS new_id_pasien";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$new_id_pasien = str_pad($row['new_id_pasien'] ,8,"0",STR_PAD_LEFT);
		return $new_id_pasien;
	}
}


?>
