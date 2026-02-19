<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trx_reg extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_reg_model');
				$this->load->model('mst_paket/Mst_paket_model');
				$this->load->library('FormGenerator');
    }

    public function index()
    {
		$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'trx_reg/?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'trx_reg/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'trx_reg/';
            $config['first_url'] = base_url() . 'trx_reg/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Trx_reg_model->total_rows($q);
        $trx_reg = $this->Trx_reg_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_reg_data' 	=> $trx_reg,
            'q' 			=> $q,
            'pagination' 	=> $this->pagination->create_links(),
            'total_rows' 	=> $config['total_rows'],
            'start' 		=> $start,
        );
        $this->load->view('trx_reg_list', $data);
    }
	
    public function tab_reg()
    {
        $data = array(

        );
        $this->load->view('tab_reg', $data);
    }

    public function inner_booking_today()
{
    $this->load->model('Trx_reg_model', 'mreg');

    // Ambil filter
    $id_pasien   = $this->input->get('id_pasien');
    $nama_pasien = $this->input->get('nama_pasien');
    $nama_dokter = $this->input->get('nama_dokter');
    $tanggal     = $this->input->get('tanggal');

    // Ambil data booking
    $rows = $this->mreg->get_bookings_today_filtered($id_pasien, $nama_pasien, $nama_dokter, $tanggal);

    // Ambil semua dokter aktif untuk dropdown
    $dokter = $this->mreg->get_all_dokter();

    $this->load->view('inner_booking_today', [
        'rows'   => $rows,
        'dokter' => $dokter
    ]);
}



    public function has_booking_today_ajax()
    {
        $id_pasien = $this->input->post('id_pasien', TRUE);
        if(!$id_pasien){
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status'=>false,'has'=>false]));
        }
        $row = $this->db->query(
            "SELECT 1 FROM trx_reg_book WHERE id_pasien=? AND tanggal=CURDATE() LIMIT 1",
            [$id_pasien]
        )->row_array();
        return $this->output->set_content_type('application/json')->set_output(json_encode(['status'=>true,'has'=> (bool)$row ]));
    }
	
	public function inner_pasien_lama_list()
    {
			#$this->output->enable_profiler(true);
		$id_pasien = $this->input->post('cr_id_pasien');
		$nama = $this->input->post('cr_nama');
		$nik = $this->input->post('cr_nik');
		$birthdate = $this->input->post('cr_birthdate');
		
		$mst_pasien = $this->Trx_reg_model->get_last_pasien(100,$id_pasien,$nama,$nik,$birthdate);
		$data = array(
            'mst_pasien_data' 	=> $mst_pasien,
        );
	    $this->load->view('inner_pasien_lama_list', $data);
    }
	
    public function inner_pasien_lama_reg($id_pasien) 
    {
        #$this->output->enable_profiler(true);
        $row = $this->Trx_reg_model->get_pasien_by_id($id_pasien);
        $row->id_reg = '';
		$row->diag = '';
		$row->penanggung = '';
		$row->penanggung = '';
		$row->id_asuransi = '0001';
		$row->asuransi = 'TUNAI';
		$row->card_id = '';
		$row->note = '';
        // Preselect dokter & jenis perawatan dari booking hari ini jika ada
        $default_dokter = '';
        $jenis_perawatan = '';
        $q = $this->db->query(
            "SELECT id_dokter, jenis_perawatan FROM trx_reg_book 
             WHERE id_pasien=? AND tanggal=CURDATE() 
             ORDER BY COALESCE(jam_slot, slot) ASC LIMIT 1",
            [$id_pasien]
        )->row_array();
        if($q){
            $default_dokter = $q['id_dokter'];
            $jenis_perawatan = $q['jenis_perawatan'];
        }

        $sql_id_dokter_prt1 = "SELECT a.id_dokter,a.name FROM mst_dokter a WHERE a.aktif=1 ORDER BY a.name";
		$sql_id_paket 		= "SELECT a.id_paket,a.name FROM mst_paket a WHERE a.aktif=1 ORDER BY a.name";
		$sql_id_asuransi = "SELECT a.id_company,a.name FROM mst_company a WHERE a.aktif=1 ORDER BY a.name";
        $data = array(
            'button' 	=> 'Create',
            'action' 	=> site_url('trx_reg/create_action'),
            'row'		=> $row, 
            'dropdown_id_dokter_prt1' => $this->formgenerator->get_dropdown('id_dokter_prt1',$sql_id_dokter_prt1,$default_dokter),
            'dropdown_id_paket' => $this->formgenerator->get_dropdown('id_paket',$sql_id_paket,''),
            'dropdown_id_asuransi' => $this->formgenerator->get_dropdown('id_asuransi',$sql_id_asuransi,'0001'),
            'jenis_perawatan' => $jenis_perawatan,
        );
		
        $this->load->view('inner_pasien_lama_reg', $data);
		#$this->parser->parse('trx_reg_form', $data);
    }
	
	public function inner_pasien_lama_cari_HAPUSSS()
    {
		$id_pasien = $this->input->post('cr_id_pasien');
		$nama = $this->input->post('cr_nama');
		$nik = $this->input->post('cr_nik');
		$birthdate = $this->input->post('cr_birthdate');
		
        $mst_pasien = $this->Trx_reg_model->get_cari_pasien($id_pasien,$nama,$nik,$birthdate);
        
		$data = array(
            'mst_pasien_data' => $mst_pasien,
        );
        $this->load->view('inner_pasien_lama_list', $data);
    }
	
	public function inner_pasien_aps_reg($id_pasien="")
    {
		#$this->output->enable_profiler(true);
		
		if($id_pasien!='')
			$row = $this->Trx_reg_model->get_pasien_by_id_for_aps($id_pasien);
		else
		{
			$row = (object) array(	"gender"=>'',"id_pasien"=>'',"name"=>'',"nik"=>'',"birthdate"=>'',"birthplace"=>'',"hp"=>'',"address"=>''
									,"id_kelurahan"=>'',"id_kecamatan"=>'',"id_kota"=>'',"id_propinsi"=>''
									,"kelurahan"=>'',"kecamatan"=>'',"kota"=>'',"propinsi"=>'',"kodepos"=>'');
		}
		#echo "<pre>";
		#print_r($row);
		#echo "</pre>";
		$sql_gender = "SELECT * FROM mst_gender";
		$sql_id_dokter_prt1 = "SELECT a.id_dokter,a.name FROM mst_dokter a ORDER BY a.name";
		$data = array(
			'radio_gender' 				=> $this->formgenerator->get_radio('gender',$sql_gender,$row->gender),
			'dropdown_id_dokter_prt1' 	=> $this->formgenerator->get_dropdown('id_dokter_prt1',$sql_id_dokter_prt1,''),
			'row'						=> $row,
		);
		
        $this->load->view('inner_pasien_aps_reg', $data);
		#$this->parser->parse('trx_reg_form', $data);
    }
	
	public function cari_pasien_HAPUSSSS()
    {
		$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'trx_reg/cari_pasien/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'trx_reg/cari_pasien/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'trx_reg/cari_pasien/';
            $config['first_url'] = base_url() . 'trx_reg/cari_pasien/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        #$config['total_rows'] = $this->trx_reg_model->total_rows($q);
		$config['total_rows'] = 3;
        $mst_pasien = $this->Trx_reg_model->get_cari_pasien($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'mst_pasien_data' => $mst_pasien,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('pasien_list', $data);
    }
	
    public function read_HAPUSSSSS($id) 
    {
        $row = $this->Trx_reg_model->get_by_id($id);
				
        if ($row) {
            $data = array(
		'id_reg' => set_value('id_reg', $row->id_reg),
		'regdate' => set_value('regdate', $row->regdate),
		'id_pasien' => set_value('id_pasien', $row->id_pasien),
		'id_dokter_krm' => set_value('id_dokter_krm', $row->id_dokter_krm),
		'id_dokter_prt1' => set_value('id_dokter_prt1', $row->id_dokter_prt1),
		'id_dokter_prt2' => set_value('id_dokter_prt2', $row->id_dokter_prt2),
		'id_dokter_jaga' => set_value('id_dokter_jaga', $row->id_dokter_jaga),
		'id_icd' => set_value('id_icd', $row->id_icd),
		'diag' => set_value('diag', $row->diag),
		'id_asuransi' => set_value('id_asuransi', $row->id_asuransi),
		'id_company' => set_value('id_company', $row->id_company),
		'id_provider' => set_value('id_provider', $row->id_provider),
		'id_pod' => set_value('id_pod', $row->id_pod),
		'status' => set_value('status', $row->status),
		'mrstat' => set_value('mrstat', $row->mrstat),
		'rwjn' => set_value('rwjn', $row->rwjn),
		'rwip' => set_value('rwip', $row->rwip),
		'ugd' => set_value('ugd', $row->ugd),
		'note' => set_value('note', $row->note),
		'penanggung' => set_value('penanggung', $row->penanggung),
		'id_rujukan' => set_value('id_rujukan', $row->id_rujukan),
		'person_rjk' => set_value('person_rjk', $row->person_rjk),
		'confirmby' => set_value('confirmby', $row->confirmby),
		'confirmdate' => set_value('confirmdate', $row->confirmdate),
		'card_id' => set_value('card_id', $row->card_id),
		'card_name' => set_value('card_name', $row->card_name),
		'card_comp' => set_value('card_comp', $row->card_comp),
		'card_fam' => set_value('card_fam', $row->card_fam),
		'card_rjk' => set_value('card_rjk', $row->card_rjk),
		'lab' => set_value('lab', $row->lab),
		'rad' => set_value('rad', $row->rad),
		'farm' => set_value('farm', $row->farm),
		'fisio' => set_value('fisio', $row->fisio),
		'total_dp' => set_value('total_dp', $row->total_dp),
		'id_kamar' => set_value('id_kamar', $row->id_kamar),
		'id_bed' => set_value('id_bed', $row->id_bed),
		'id_kelas' => set_value('id_kelas', $row->id_kelas),
		'iostatus' => set_value('iostatus', $row->iostatus),
		'cash' => set_value('cash', $row->cash),
		'is_odc' => set_value('is_odc', $row->is_odc),
		'is_kpri' => set_value('is_kpri', $row->is_kpri),
		'id_paket' => set_value('id_paket', $row->id_paket),
		'id_trx_paket' => set_value('id_trx_paket', $row->id_trx_paket),
		'paket_aktif' => set_value('paket_aktif', $row->paket_aktif),
		'paket_selesai' => set_value('paket_selesai', $row->paket_selesai),
		'id_kelaspkt' => set_value('id_kelaspkt', $row->id_kelaspkt),
		'mrstatend_igd' => set_value('mrstatend_igd', $row->mrstatend_igd),
		'mrstatend_rwip' => set_value('mrstatend_rwip', $row->mrstatend_rwip),
		'mrstatdcs' => set_value('mrstatdcs', $row->mrstatdcs),
		'id_mod' => set_value('id_mod', $row->id_mod),
		'created' => set_value('created', $row->created),
		'creator' => set_value('creator', $row->creator),
		'updated' => set_value('updated', $row->updated),
		'updater' => set_value('updater', $row->updater),
	    );
						
            //$this->load->view('trx_reg_read', $data);
			$this->parser->parse('trx_reg_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_reg'));
        }
    }

    public function create($id_pasien) 
    {
		#$this->output->enable_profiler(true);
		$row = $this->Trx_reg_model->get_pasien_by_id($id_pasien);
		$row->id_reg = '';
		$row->diag = '';
		$row->penanggung = '';
		$row->penanggung = '';
		$row->id_asuransi = '0001';
		$row->asuransi = 'TUNAI';
		$row->card_id = '';
		$row->note = '';
		$sql_id_dokter_prt1 = "SELECT a.id_dokter,a.name FROM mst_dokter a ORDER BY a.name";
		$data = array(
			'button' 	=> 'Create',
			'action' 	=> site_url('trx_reg/create_action'),
			'row'		=> $row, 
			'dropdown_id_dokter_prt1' => $this->formgenerator->get_dropdown('id_dokter_prt1',$sql_id_dokter_prt1,'')
		);
		
        $this->load->view('trx_reg_form', $data);
		#$this->parser->parse('trx_reg_form', $data);
    }
    
    public function create_action() 
    {
		#$this->output->enable_profiler(true);
        $this->db->trans_begin();
        $id_reg = $this->Trx_reg_model->get_new_id_reg();
        $data = array(
			'id_reg'	      => $id_reg,
			'regdate'         => date('Y-m-d H:i:s'),
			'id_pasien'       => $this->input->post('id_pasien',TRUE),
			#'id_dokter_krm'  => $this->input->post('id_dokter_krm',TRUE),
			'id_dokter_prt1'  => $this->input->post('id_dokter_prt1',TRUE),
			#'id_dokter_prt2' => $this->input->post('id_dokter_prt2',TRUE),
			#'id_dokter_jaga' => $this->input->post('id_dokter_jaga',TRUE),
			#'id_icd'         => $this->input->post('id_icd',TRUE),
			'diag'            => $this->input->post('diag',TRUE),
			'id_asuransi'     => $this->input->post('id_asuransi',TRUE),
			#'id_company'     => $this->input->post('id_company',TRUE),
			#'id_provider'    => $this->input->post('id_provider',TRUE),
			#'id_pod'         => $this->input->post('id_pod',TRUE),
			#'status'         => $this->input->post('status',TRUE),
			#'mrstat'         => $this->input->post('mrstat',TRUE),
			#'rwjn'           => $this->input->post('rwjn',TRUE),
			#'rwip'           => $this->input->post('rwip',TRUE),
			#'ugd'            => $this->input->post('ugd',TRUE),
			'note'            => $this->input->post('note',TRUE),
			'penanggung'      => $this->input->post('penanggung',TRUE),
			#'id_rujukan'     => $this->input->post('id_rujukan',TRUE),
			#'person_rjk'     => $this->input->post('person_rjk',TRUE),
			#'confirmby'      => $this->input->post('confirmby',TRUE),
			#'confirmdate'    => $this->input->post('confirmdate',TRUE),
			'card_id'         => $this->input->post('card_id',TRUE),
			#'card_name'      => $this->input->post('card_name',TRUE),
			#'card_comp'      => $this->input->post('card_comp',TRUE),
			#'card_fam'       => $this->input->post('card_fam',TRUE),
			#'card_rjk'       => $this->input->post('card_rjk',TRUE),
			#'lab'            => $this->input->post('lab',TRUE),
			#'rad'            => $this->input->post('rad',TRUE),
			#'farm'           => $this->input->post('farm',TRUE),
			#'fisio'          => $this->input->post('fisio',TRUE),
			#'total_dp'       => $this->input->post('total_dp',TRUE),
			#'id_kamar'       => $this->input->post('id_kamar',TRUE),
			#'id_bed'         => $this->input->post('id_bed',TRUE),
			#'id_kelas'       => $this->input->post('id_kelas',TRUE),
			#'iostatus'       => $this->input->post('iostatus',TRUE),
			#'cash'           => $this->input->post('cash',TRUE),
			#'is_odc'         => $this->input->post('is_odc',TRUE),
			#'is_kpri'        => $this->input->post('is_kpri',TRUE),
			'id_paket'       => $this->input->post('id_paket',TRUE),
			#'id_trx_paket'   => $this->input->post('id_trx_paket',TRUE),
			#'paket_aktif'    => $this->input->post('paket_aktif',TRUE),
			#'paket_selesai'  => $this->input->post('paket_selesai',TRUE),
			#'id_kelaspkt'    => $this->input->post('id_kelaspkt',TRUE),
			#'mrstatend_igd'  => $this->input->post('mrstatend_igd',TRUE),
			#'mrstatend_rwip' => $this->input->post('mrstatend_rwip',TRUE),
			#'mrstatdcs'      => $this->input->post('mrstatdcs',TRUE),
			#'id_mod'         => $this->input->post('id_mod',TRUE),
			#'created'        => $this->input->post('created',TRUE),
			#'creator'        => $this->input->post('creator',TRUE),
			#'updated'        => $this->input->post('updated',TRUE),
			#'updater'        => $this->input->post('updater',TRUE),
		);
		$this->Trx_reg_model->insert($data);
		
		$id_paket = $this->input->post('id_paket',TRUE);
		if($id_paket!='')
		{
			$this->Mst_paket_model->delete('trx_reg_act','id_reg',$id_reg);
			### --- INSERT PAKET HEADER TAKEN ----------------------------------------------
			$paket_header 	= $this->Mst_paket_model->get_mst_paket_by_id($id_paket);
			
			$data_mst_paket = array();
			$data_mst_paket['id_reg'] 	= $id_reg;
			$data_mst_paket['id_paket'] = $id_paket;
			$data_mst_paket['name'] 	= $paket_header->name;
			$data_mst_paket['duration'] = $paket_header->duration;
			$data_mst_paket['price'] 	= $paket_header->price;
			$data_mst_paket['penjamin'] = $paket_header->penjamin;
			$data_mst_paket['creator'] 	= $this->session->userdata['sp']->name;
			$data_mst_paket['created'] 	= date('Y-m-d H:i:s');
			$new_id_trp = $this->Mst_paket_model->insert('trx_reg_paket',$data_mst_paket);
			
			### --- INSERT KUNUNGAN PAKET  ----------------------------------------------
			$duration = $paket_header->duration;
			$duration = ($duration==0)?1:$duration;
			for($i=1; $i<=$duration; $i++)
			{
				$data_mst_paket_kunj                = array();
				$data_mst_paket_kunj['id_reg'] 	    = $id_reg;
				$data_mst_paket_kunj['id_paket']    = $id_paket;
				$data_mst_paket_kunj['kunj_ke']     = $i;
				$data_mst_paket_kunj['is_hadir']    = ($i==1)?1:0;
				$data_mst_paket_kunj['kunjdate'] 	= ($i==1)?date('Y-m-d H:i:s'):null;
				$new_id_trp = $this->Mst_paket_model->insert('trx_reg_paket_kunj',$data_mst_paket_kunj);
			}
			
			### --- INSERT PAKET DETAIL TAKEN ----------------------------------------------
			$farmasi_item_counter = 0;
			$paket_detail 	= $this->Mst_paket_model->get_mst_paket_det_by_id($id_paket);
			foreach($paket_detail as $k => $v)
			{
				$data_mst_paket_det = array();
				$data_mst_paket_det['id_trp'] 		= $new_id_trp;
				$data_mst_paket_det['id_reg'] 		= $id_reg;
				$data_mst_paket_det['id_paket'] 	= $id_paket;
				$data_mst_paket_det['id_group'] 	= $v->id_group;
				$data_mst_paket_det['id_trx_det'] 	= $v->id_trx_det;
				$data_mst_paket_det['price_src'] 	= $v->price_src;
				$data_mst_paket_det['disc_p'] 		= $v->disc_p;
				$data_mst_paket_det['disc_m'] 		= $v->disc_m;
				$data_mst_paket_det['price'] 		= $v->price;
				$data_mst_paket_det['qty'] 			= $v->qty;
				$data_mst_paket_det['total_src'] 	= $v->total_src;
				$data_mst_paket_det['total'] 		= $v->total;
				$data_mst_paket_det['no_kunj'] 		= $v->no_kunj;
				
				$data_mst_paket_det['tuslah'] 		= $v->tuslah;
				$data_mst_paket_det['jenis_obat'] 	= $v->jenis_obat;
				$data_mst_paket_det['dosis'] 		= $v->dosis;
				$data_mst_paket_det['frekwensi'] 	= $v->frekwensi;
				$data_mst_paket_det['tme'] 		    = $v->tme;
				
				$data_mst_paket_det['creator'] 		= $this->session->userdata['sp']->name;
				$data_mst_paket_det['created'] 		= date('Y-m-d H:i:s');
				$this->Mst_paket_model->insert('trx_reg_paket_det',$data_mst_paket_det);
				
				### --- Auto Tagih Item Paket ---------------------------------------------
				if($v->id_group == 1)
				{
					$auto_tindakan                = array();
					$auto_tindakan['id_reg']      = $id_reg;
					$auto_tindakan['trxdate']     = date('Y-m-d H:i:s');
					$auto_tindakan['id_reg_act']  = $v->id_trx_det;
					$auto_tindakan['id_type']     = 1;		### tipe reg: 1=rwj,2=rwi,3=ugd
					$auto_tindakan['id_kelas']    = 1;
					$auto_tindakan['id_dokter']   = $data['id_dokter_prt1'];
					$auto_tindakan['name']        = $v->id_trx_det_txt;
					$auto_tindakan['qty']         = $v->qty;
					$auto_tindakan['price']       = $v->price;
					$auto_tindakan['total']       = $v->total;
					$auto_tindakan['is_paket'] 	  = 1;
					$auto_tindakan['is_outpaket'] = 0;
					$auto_tindakan['id_paket'] 	  = $id_paket;
					$auto_tindakan['creator']     = $this->session->userdata['sp']->login_name;
					$auto_tindakan['created']     = date('Y-m-d H:i:s');					
					$this->Mst_paket_model->insert('trx_reg_act', $auto_tindakan); 
				}
				
				if($v->id_group == 2)
				{
					if($farmasi_item_counter==0)
					{
						$auto_farmasi                = array();
						$auto_farmasi['id_reg']      = $id_reg;
						$auto_farmasi['eresepdate']  = date('Y-m-d H:i:s');
						$auto_farmasi['id_dokter']   = $data['id_dokter_prt1'];
						$auto_farmasi['is_edited']   = 0;
						$auto_farmasi['is_paket'] 	 = 1;
						$auto_farmasi['id_paket'] 	 = $id_paket;
						$id_eresep = $this->Mst_paket_model->insert('soap_eresep', $auto_farmasi); 
						$farmasi_item_counter++;
					}
					
					$auto_farmasi                   = array();
					$auto_farmasi['id_eresep']      = $id_eresep;
					$auto_farmasi['id_trx_det']     = $v->id_trx_det;
					$auto_farmasi['name']           = $v->id_trx_det_txt;
					$auto_farmasi['qty']            = $v->qty;
					$auto_farmasi['harga_satuan']   = $v->price;
					#$auto_farmasi['subtotal']       = $v->total;
					$auto_farmasi['subtotal']       = ($v->total - $v->tuslah);
					$auto_farmasi['is_paket'] 	 	= 1;
					$auto_farmasi['id_paket'] 	 	= $id_paket;
					#$auto_farmasi['tuslah'] 		= $v->tuslah;
					$auto_farmasi['tuslah'] 		= 0;
					$auto_farmasi['jenis_obat'] 	= $v->jenis_obat;
					$auto_farmasi['dosis'] 			= $v->dosis;
					$auto_farmasi['frekwensi'] 		= $v->frekwensi;
					$auto_farmasi['tme'] 		    = $v->tme;
					$this->Mst_paket_model->insert('soap_eresep_det', $auto_farmasi); 
				}
			}
		}
		#print_r($paket_header);
		#print_r($paket_detail);
		
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                // Tandai booking sebagai sudah check-in dan simpan id_reg pada booking hari ini untuk pasien + dokter terpilih
                try {
                    $this->db->where('id_pasien', $data['id_pasien'])
                             ->where('tanggal', date('Y-m-d'))
                             ->where('id_dokter', $data['id_dokter_prt1'])
                             ->limit(1)
                             ->update('trx_reg_book', [ 'id_reg' => $id_reg, 'sudah_checkin' => 1 ]);
                } catch (Exception $e) { /* ignore non-fatal */ }
                #$this->db->trans_rollback();
                $this->db->trans_commit();
        }
		redirect(site_url('trx_reg'));
    }
    
    public function update($id_reg) 
    {
        $row = $this->Trx_reg_model->get_by_id($id_reg);
		#print_r($row);
		$sql_id_dokter_prt1 = "SELECT a.id_dokter,a.name FROM mst_dokter a ORDER BY a.name";
		
        if ($row) {
            $data = array(
				'button' 	=> 'Update',
				'action' 	=> site_url('trx_reg/update_action'),
				'row'		=> $row,
				'dropdown_id_dokter_prt1' => $this->formgenerator->get_dropdown('id_dokter_prt1',$sql_id_dokter_prt1,$row->id_dokter_prt1,true),
				'id_reg'	=> $row->id_reg,
			);
            $this->load->view('trx_reg_form', $data);
			#$this->parser->parse('trx_reg_form', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_reg'));
        }
    }
    
    public function update_action() 
    {
		#print_r($_POST);
		#die();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_reg', TRUE));
        } else {
        	$data_u = array();
				
            $data = array(
		#'regdate' => $this->input->post('regdate',TRUE),
		#'id_pasien' => $this->input->post('id_pasien',TRUE),
		#'id_dokter_krm' => $this->input->post('id_dokter_krm',TRUE),
		'id_dokter_prt1' => $this->input->post('id_dokter_prt1',TRUE),
		#'id_dokter_prt2' => $this->input->post('id_dokter_prt2',TRUE),
		#'id_dokter_jaga' => $this->input->post('id_dokter_jaga',TRUE),
		#'id_icd' => $this->input->post('id_icd',TRUE),
		'diag' => $this->input->post('diag',TRUE),
		'id_asuransi' => $this->input->post('id_asuransi',TRUE),
		#'id_company' => $this->input->post('id_company',TRUE),
		#'id_provider' => $this->input->post('id_provider',TRUE),
		#'id_pod' => $this->input->post('id_pod',TRUE),
		#'status' => $this->input->post('status',TRUE),
		#'mrstat' => $this->input->post('mrstat',TRUE),
		#'rwjn' => $this->input->post('rwjn',TRUE),
		#'rwip' => $this->input->post('rwip',TRUE),
		#'ugd' => $this->input->post('ugd',TRUE),
		'note' => $this->input->post('note',TRUE),
		'penanggung' => $this->input->post('penanggung',TRUE),
		#'id_rujukan' => $this->input->post('id_rujukan',TRUE),
		#'person_rjk' => $this->input->post('person_rjk',TRUE),
		#'confirmby' => $this->input->post('confirmby',TRUE),
		#'confirmdate' => $this->input->post('confirmdate',TRUE),
		'card_id' => $this->input->post('card_id',TRUE),
		#'card_name' => $this->input->post('card_name',TRUE),
		#'card_comp' => $this->input->post('card_comp',TRUE),
		#'card_fam' => $this->input->post('card_fam',TRUE),
		#'card_rjk' => $this->input->post('card_rjk',TRUE),
		#'lab' => $this->input->post('lab',TRUE),
		#'rad' => $this->input->post('rad',TRUE),
		#'farm' => $this->input->post('farm',TRUE),
		#'fisio' => $this->input->post('fisio',TRUE),
		#'total_dp' => $this->input->post('total_dp',TRUE),
		#'id_kamar' => $this->input->post('id_kamar',TRUE),
		#'id_bed' => $this->input->post('id_bed',TRUE),
		#'id_kelas' => $this->input->post('id_kelas',TRUE),
		#'iostatus' => $this->input->post('iostatus',TRUE),
		#'cash' => $this->input->post('cash',TRUE),
		#'is_odc' => $this->input->post('is_odc',TRUE),
		#'is_kpri' => $this->input->post('is_kpri',TRUE),
		#'id_paket' => $this->input->post('id_paket',TRUE),
		#'id_trx_paket' => $this->input->post('id_trx_paket',TRUE),
		#'paket_aktif' => $this->input->post('paket_aktif',TRUE),
		#'paket_selesai' => $this->input->post('paket_selesai',TRUE),
		#'id_kelaspkt' => $this->input->post('id_kelaspkt',TRUE),
		#'mrstatend_igd' => $this->input->post('mrstatend_igd',TRUE),
		#'mrstatend_rwip' => $this->input->post('mrstatend_rwip',TRUE),
		#'mrstatdcs' => $this->input->post('mrstatdcs',TRUE),
		#'id_mod' => $this->input->post('id_mod',TRUE),
		#'created' => $this->input->post('created',TRUE),
		#'creator' => $this->input->post('creator',TRUE),
		#'updated' => $this->input->post('updated',TRUE),
		#'updater' => $this->input->post('updater',TRUE),
	    );
						$data = $data + $data_u;
            $this->Trx_reg_model->update($this->input->post('id_reg', TRUE), $data);
            #$this->session->set_flashdata('message', 'Update Record Success');
           redirect(site_url('trx_reg'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_reg_model->get_by_id($id);

        if ($row) {
            $this->Trx_reg_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('trx_reg'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_reg'));
        }
    }

    public function _rules() 
    {
	#$this->form_validation->set_rules('regdate', 'regdate', 'trim|required');
	#$this->form_validation->set_rules('id_pasien', 'id pasien', 'trim|required');
	#$this->form_validation->set_rules('id_dokter_krm', 'id dokter krm', 'trim|required');
	$this->form_validation->set_rules('id_dokter_prt1', 'id dokter prt1', 'trim|required');
	#$this->form_validation->set_rules('id_dokter_prt2', 'id dokter prt2', 'trim|required');
	#$this->form_validation->set_rules('id_dokter_jaga', 'id dokter jaga', 'trim|required');
	#$this->form_validation->set_rules('id_icd', 'id icd', 'trim|required');
	#$this->form_validation->set_rules('diag', 'diag', 'trim|required');
	#$this->form_validation->set_rules('id_asuransi', 'id asuransi', 'trim|required');
	#$this->form_validation->set_rules('id_company', 'id company', 'trim|required');
	#$this->form_validation->set_rules('id_provider', 'id provider', 'trim|required');
	#$this->form_validation->set_rules('id_pod', 'id pod', 'trim|required');
	#$this->form_validation->set_rules('status', 'status', 'trim|required');
	#$this->form_validation->set_rules('mrstat', 'mrstat', 'trim|required');
	#$this->form_validation->set_rules('rwjn', 'rwjn', 'trim|required');
	#$this->form_validation->set_rules('rwip', 'rwip', 'trim|required');
	#$this->form_validation->set_rules('ugd', 'ugd', 'trim|required');
	#$this->form_validation->set_rules('note', 'note', 'trim|required');
	#$this->form_validation->set_rules('penanggung', 'penanggung', 'trim|required');
	#$this->form_validation->set_rules('id_rujukan', 'id rujukan', 'trim|required');
	#$this->form_validation->set_rules('person_rjk', 'person rjk', 'trim|required');
	#$this->form_validation->set_rules('confirmby', 'confirmby', 'trim|required');
	#$this->form_validation->set_rules('confirmdate', 'confirmdate', 'trim|required');
	#$this->form_validation->set_rules('card_id', 'card id', 'trim|required');
	#$this->form_validation->set_rules('card_name', 'card name', 'trim|required');
	#$this->form_validation->set_rules('card_comp', 'card comp', 'trim|required');
	#$this->form_validation->set_rules('card_fam', 'card fam', 'trim|required');
	#$this->form_validation->set_rules('card_rjk', 'card rjk', 'trim|required');
	#$this->form_validation->set_rules('lab', 'lab', 'trim|required');
	#$this->form_validation->set_rules('rad', 'rad', 'trim|required');
	#$this->form_validation->set_rules('farm', 'farm', 'trim|required');
	#$this->form_validation->set_rules('fisio', 'fisio', 'trim|required');
	#$this->form_validation->set_rules('total_dp', 'total dp', 'trim|required|numeric');
	#$this->form_validation->set_rules('id_kamar', 'id kamar', 'trim|required');
	#$this->form_validation->set_rules('id_bed', 'id bed', 'trim|required');
	#$this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required');
	#$this->form_validation->set_rules('iostatus', 'iostatus', 'trim|required');
	#$this->form_validation->set_rules('cash', 'cash', 'trim|required');
	#$this->form_validation->set_rules('is_odc', 'is odc', 'trim|required');
	#$this->form_validation->set_rules('is_kpri', 'is kpri', 'trim|required');
	#$this->form_validation->set_rules('id_paket', 'id paket', 'trim|required');
	#$this->form_validation->set_rules('id_trx_paket', 'id trx paket', 'trim|required');
	#$this->form_validation->set_rules('paket_aktif', 'paket aktif', 'trim|required');
	#$this->form_validation->set_rules('paket_selesai', 'paket selesai', 'trim|required');
	#$this->form_validation->set_rules('id_kelaspkt', 'id kelaspkt', 'trim|required');
	#$this->form_validation->set_rules('mrstatend_igd', 'mrstatend igd', 'trim|required');
	#$this->form_validation->set_rules('mrstatend_rwip', 'mrstatend rwip', 'trim|required');
	#$this->form_validation->set_rules('mrstatdcs', 'mrstatdcs', 'trim|required');
	#$this->form_validation->set_rules('id_mod', 'id mod', 'trim|required');
	#$this->form_validation->set_rules('created', 'created', 'trim|required');
	#$this->form_validation->set_rules('creator', 'creator', 'trim|required');
	#$this->form_validation->set_rules('updated', 'updated', 'trim|required');
	#$this->form_validation->set_rules('updater', 'updater', 'trim|required');

	$this->form_validation->set_rules('id_reg', 'id_reg', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

	public function inner_get_data_autocomplete_id_asuransi()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_company AS idx,a.`name` AS label
				FROM 	mst_company a
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
	
	public function create_action_aps() 
    {
		$id_pasien = $this->input->post('id_pasien',true);
		if($id_pasien=='')
		{
			### ------- INSERT MST_PASIEN APS --------------------------
			$new_id_pasien_aps = $this->get_new_id_pasien_aps();
			$data_pasien = array(
				'is_rm_aps' 	=> 1,
				'id_pasien' 	=> $new_id_pasien_aps,
				'name' 			=> $this->input->post('name',TRUE),
				'birthdate' 	=> $this->input->post('birthdate',TRUE),
				'birthplace' 	=> $this->input->post('birthplace',TRUE),
				'gender' 		=> $this->input->post('gender',TRUE),
				'address' 		=> $this->input->post('address',TRUE),
				'hp' 			=> $this->input->post('hp',TRUE),
				
				'id_propinsi' 	=> $this->input->post('id_propinsi',TRUE),
				'id_kota' 		=> $this->input->post('id_kota',TRUE),
				'id_kecamatan' 	=> $this->input->post('id_kecamatan',TRUE),
				'id_kelurahan' 	=> $this->input->post('id_kelurahan',TRUE),
				'kodepos' 		=> $this->input->post('kodepos',TRUE),
				'nik' 			=> $this->input->post('nik',TRUE),
				'asm_name' 		=> 'TUNAI',
				'asm_comp' 		=> '0001',
				'aktif' 		=> 1,
				'created' 		=> $this->input->post('created',TRUE),
				'creator' 		=> $this->input->post('creator',TRUE),
			);
			$this->Trx_reg_model->insert_mst_pasien_aps($data_pasien);
			$id_pasien = $new_id_pasien_aps;
		}
		
		### ------- INSERT MST_PASIEN APS --------------------------
		$id_reg = $this->Trx_reg_model->get_new_id_reg();
		$data_reg = array(
			'is_reg_aps' 	=> 1,
			'id_reg'		=> $id_reg,
			'regdate' 		=> date('Y-m-d H:i:s'),
			'id_pasien' 	=> $id_pasien,
			#'id_asuransi' => $this->input->post('id_asuransi',TRUE),
			'id_asuransi' 	=> '0001',
			'note' 			=> $this->input->post('note',TRUE),
			'penanggung' 	=> $id_pasien,
		);
		#print_r($data);
		#$this->Trx_reg_model->insert($data_reg);
		$this->db->insert('trx_reg', $data_reg);
		#$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('trx_reg/tab_reg'));
		
    }
	
	public function get_new_id_pasien_aps()
	{
		$sql = "SELECT IFNULL((SELECT MAX((CAST(SUBSTR(a.id_pasien,-7) AS integer))+1) FROM mst_pasien a WHERE a.`is_rm_aps`=1),1) AS new_id_pasien_aps";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$new_id_pasien_aps = "A".str_pad($row['new_id_pasien_aps'] ,7,"0",STR_PAD_LEFT);
		return $new_id_pasien_aps;
	}
    
	public function kunjungan($id_reg)
    {
		$data_reg = $this->Trx_reg_model->get_by_id($id_reg);
		$data_kunj = $this->Trx_reg_model->data_kunj($id_reg);
		
		$data = array(
            'id_reg'	=> $id_reg,
			'data_reg'	=> $data_reg,
			'data_kunj'	=> $data_kunj,
        );
		$this->load->view('kunjungan_list', $data);
    }
	public function kunjungan_update()
    {
		#$this->output->enable_profiler(true);
		$id_reg = $this->input->post('id_reg');
		$id_kunj = $this->input->post('id_kunj');
		$kunjdate = $this->input->post('kunjdate');
		$this->db->trans_begin();
		foreach($id_kunj as $k => $v)
		{
			if($kunjdate[$k]!='')
			{
				$kunjdate_i = $kunjdate[$k];
				$is_hadir_i = 1;
			}
			else
			{
				$kunjdate_i = null;
				$is_hadir_i = 0;
			}
			$data_kunj = array();
			$data_kunj['kunjdate'] 	= $kunjdate_i;
			$data_kunj['is_hadir'] 	= $is_hadir_i;
			$data_kunj['updater'] 	= $this->session->userdata['sp']->name;
			$data_kunj['updated'] 	= date('Y-m-d H:i:s');
			$this->Mst_paket_model->update('trx_reg_paket_kunj','id_kunj',$v,$data_kunj);
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
		redirect(site_url('trx_reg'));
	}
	
	public function load_paket_medis($id_reg)
	{
		$data_paket = $this->Mst_paket_model->data_paket_reg($id_reg);
		$sql_id_paket = "SELECT a.id_paket,a.name FROM mst_paket a WHERE a.aktif=1 ORDER BY a.name";
		$data = array(
			'id_reg'			=> $id_reg,
			'data_paket'		=> $data_paket,
			'dropdown_id_paket' => $this->formgenerator->get_dropdown('id_paket',$sql_id_paket,'',false,'load_paket_det()'),
		);
		$this->load->view('inner_paket_medis.php', $data);
	}
	
	public function load_paket_det($id_paket)
	{
		$data_paket_det = $this->Mst_paket_model->get_mst_paket_det_by_id($id_paket);
		$data = array(
			'data_paket_det' => $data_paket_det,
		);
		$this->load->view('inner_paket_medis_det.php', $data);
	}
	
	public function add_paket_to_reg()
	{
		#$this->output->enable_profiler(true);
		$this->db->trans_begin();
		$id_reg = $this->input->post('id_reg');
		$id_paket = $this->input->post('id_paket');
		
		$id_paket_check = $this->Mst_paket_model->check_id_paket_reg($id_reg,$id_paket);
		if($id_paket_check!='')
		{
			echo 'SUDAH INPUT';
			return;
		}
		
		if($id_paket!='')
		{
			#$this->Mst_paket_model->delete('trx_reg_act','id_reg',$id_reg);
			### --- INSERT PAKET HEADER TAKEN ----------------------------------------------
			$paket_header 	= $this->Mst_paket_model->get_mst_paket_by_id($id_paket);
			
			$data_mst_paket = array();
			$data_mst_paket['id_reg'] 	= $id_reg;
			$data_mst_paket['id_paket'] = $id_paket;
			$data_mst_paket['name'] 	= $paket_header->name;
			$data_mst_paket['duration'] = $paket_header->duration;
			$data_mst_paket['price'] 	= $paket_header->price;
			$data_mst_paket['penjamin'] = $paket_header->penjamin;
			$data_mst_paket['creator'] 	= $this->session->userdata['sp']->name;
			$data_mst_paket['created'] 	= date('Y-m-d H:i:s');
			$new_id_trp = $this->Mst_paket_model->insert('trx_reg_paket',$data_mst_paket);
			
			### --- INSERT KUNUNGAN PAKET  ----------------------------------------------
			$duration = $paket_header->duration;
			$duration = ($duration==0)?1:$duration;
			for($i=1; $i<=$duration; $i++)
			{
				$data_mst_paket_kunj                = array();
				$data_mst_paket_kunj['id_reg'] 	    = $id_reg;
				$data_mst_paket_kunj['id_paket']    = $id_paket;
				$data_mst_paket_kunj['kunj_ke']     = $i;
				$data_mst_paket_kunj['is_hadir']    = ($i==1)?1:0;
				$data_mst_paket_kunj['kunjdate'] 	= ($i==1)?date('Y-m-d H:i:s'):null;
				$new_id_trp = $this->Mst_paket_model->insert('trx_reg_paket_kunj',$data_mst_paket_kunj);
			}
			
			### --- INSERT PAKET DETAIL TAKEN ----------------------------------------------
			$farmasi_item_counter = 0;
			$paket_detail 	= $this->Mst_paket_model->get_mst_paket_det_by_id($id_paket);
			foreach($paket_detail as $k => $v)
			{
				$data_mst_paket_det = array();
				$data_mst_paket_det['id_trp'] 		= $new_id_trp;
				$data_mst_paket_det['id_reg'] 		= $id_reg;
				$data_mst_paket_det['id_paket'] 	= $id_paket;
				$data_mst_paket_det['id_group'] 	= $v->id_group;
				$data_mst_paket_det['id_trx_det'] 	= $v->id_trx_det;
				$data_mst_paket_det['price_src'] 	= $v->price_src;
				$data_mst_paket_det['disc_p'] 		= $v->disc_p;
				$data_mst_paket_det['disc_m'] 		= $v->disc_m;
				$data_mst_paket_det['price'] 		= $v->price;
				$data_mst_paket_det['qty'] 			= $v->qty;
				$data_mst_paket_det['total_src'] 	= $v->total_src;
				$data_mst_paket_det['total'] 		= $v->total;
				$data_mst_paket_det['no_kunj'] 		= $v->no_kunj;
				
				$data_mst_paket_det['tuslah'] 		= $v->tuslah;
				$data_mst_paket_det['jenis_obat'] 	= $v->jenis_obat;
				$data_mst_paket_det['dosis'] 		= $v->dosis;
				$data_mst_paket_det['frekwensi'] 	= $v->frekwensi;
				$data_mst_paket_det['tme'] 		    = $v->tme;
				
				$data_mst_paket_det['creator'] 		= $this->session->userdata['sp']->name;
				$data_mst_paket_det['created'] 		= date('Y-m-d H:i:s');
				$this->Mst_paket_model->insert('trx_reg_paket_det',$data_mst_paket_det);
				
				### --- Auto Tagih Item Paket ---------------------------------------------
				if($v->id_group == 1)
				{
					$auto_tindakan                = array();
					$auto_tindakan['id_reg']      = $id_reg;
					$auto_tindakan['trxdate']     = date('Y-m-d H:i:s');
					$auto_tindakan['id_reg_act']  = $v->id_trx_det;
					$auto_tindakan['id_type']     = 1;		### tipe reg: 1=rwj,2=rwi,3=ugd
					$auto_tindakan['id_kelas']    = 1;
					$auto_tindakan['id_dokter']   = $this->session->userdata['sp']->id_dokter;
					$auto_tindakan['name']        = $v->id_trx_det_txt;
					$auto_tindakan['qty']         = $v->qty;
					$auto_tindakan['price']       = $v->price;
					$auto_tindakan['total']       = $v->total;
					$auto_tindakan['is_paket'] 	  = 1;
					$auto_tindakan['is_outpaket'] = 0;
					$auto_tindakan['id_paket'] 	  = $id_paket;
					$auto_tindakan['creator']     = $this->session->userdata['sp']->login_name;
					$auto_tindakan['created']     = date('Y-m-d H:i:s');					
					$this->Mst_paket_model->insert('trx_reg_act', $auto_tindakan); 
				}
				
				if($v->id_group == 2)
				{
					if($farmasi_item_counter==0)
					{
						$auto_farmasi                = array();
						$auto_farmasi['id_reg']      = $id_reg;
						$auto_farmasi['eresepdate']  = date('Y-m-d H:i:s');
						$auto_farmasi['id_dokter']   = $this->session->userdata['sp']->id_dokter;
						$auto_farmasi['is_edited']   = 0;
						$auto_farmasi['is_paket'] 	 = 1;
						$auto_farmasi['id_paket'] 	 = $id_paket;
						$id_eresep = $this->Mst_paket_model->insert('soap_eresep', $auto_farmasi); 
						$farmasi_item_counter++;
					}
					
					$auto_farmasi                   = array();
					$auto_farmasi['id_eresep']      = $id_eresep;
					$auto_farmasi['id_trx_det']     = $v->id_trx_det;
					$auto_farmasi['name']           = $v->id_trx_det_txt;
					$auto_farmasi['qty']            = $v->qty;
					$auto_farmasi['harga_satuan']   = $v->price;
					#$auto_farmasi['subtotal']       = $v->total;
					$auto_farmasi['subtotal']       = ($v->total - $v->tuslah);
					$auto_farmasi['is_paket'] 	 	= 1;
					$auto_farmasi['id_paket'] 	 	= $id_paket;
					#$auto_farmasi['tuslah'] 		= $v->tuslah;
					$auto_farmasi['tuslah'] 		= 0;
					$auto_farmasi['jenis_obat'] 	= $v->jenis_obat;
					$auto_farmasi['dosis'] 			= $v->dosis;
					$auto_farmasi['frekwensi'] 		= $v->frekwensi;
					$auto_farmasi['tme'] 		    = $v->tme;
					$this->Mst_paket_model->insert('soap_eresep_det', $auto_farmasi); 
				}
			}
		}
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo 'GAGAL';
		}
		else
		{
			#$this->db->trans_rollback();
			$this->db->trans_commit();
			echo 'OK';
		}
	}
	
	public function ajax_dokter()
{
    $q = $this->input->get('q');

    $sql = "SELECT id_dokter, name 
            FROM mst_dokter 
            WHERE aktif = 1 
              AND name LIKE '%".$this->db->escape_like_str($q)."%' 
            ORDER BY name ASC";

    $data = $this->db->query($sql)->result_array();

    echo json_encode($data);
}

	
	
}

?>
