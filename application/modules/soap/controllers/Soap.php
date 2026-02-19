<?php
class Soap extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Soap');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('FormGenerator');
        $this->load->library('session');
    }
    function index(){
        $id_role                = @$this->session->userdata['sp']->id_role;
        $id_dokter              = @$this->session->userdata['sp']->id_dokter;        if($id_role==0 || $id_role==1 || $id_role==2){

        $tgl_1                  = $this->input->post('tgl_1');
        $tgl_2                  = $this->input->post('tgl_2');
        $search_keyword         = $this->input->post('search_keyword');

        if($tgl_1==""){
            $set_tgl_1 = DATE('Y-m-01');
        }else{
            $set_tgl_1 = $tgl_1;
        }

        if($tgl_2==""){
            $set_tgl_2 = DATE('Y-m-t'); 
        }else{
            $set_tgl_2 = $tgl_2;
        }


        $set_tanggalnya = " AND DATE_FORMAT(regdate, '%Y-%m-%d') BETWEEN '$set_tgl_1' AND '$set_tgl_2'";
        
        if(isset($search_keyword)){
            $set_search_keyword =" AND (a.id_reg LIKE '%$search_keyword%' OR a.regdate LIKE '%$search_keyword%' OR a.id_pasien LIKE '%$search_keyword%' OR b.birthdate LIKE '%$search_keyword%' OR b.name LIKE '%$search_keyword%' OR d.name LIKE '%$search_keyword%' OR c.name LIKE '%$search_keyword%')";
        }else{
            $set_search_keyword ="";
        }

            $datapasien         = $this->D_Soap->mpasien($set_tanggalnya,$set_search_keyword);
        }elseif($id_role==2){
            $datapasien         = $this->D_Soap->mpasien_dokter($id_dokter,$set_tanggalnya,$set_search_keyword);
        }else{
            echo "Akses Ditolak";exit;
        }
        $datapasien         = $this->D_Soap->mpasien($set_tanggalnya,$set_search_keyword);
        $data = array(
            'datapasien'        => $datapasien,
            'tgl_1'             => $tgl_1,
            'tgl_2'             => $tgl_2,
            'search_keyword'    => $search_keyword
        );
        $this->load->view('list_pasien', $data);
    }
    	function get_data_pasien_by_id_reg($id_reg)
	{
		$sql = "SELECT 	a.*,b.*
						FROM 		mst_pasien a, trx_reg b
						WHERE 	a.id_pasien=b.id_pasien
										AND b.id_reg='".$id_reg."'
										";
		$query = $this->dbhis->query($sql);
		$rs = $query->row_array();
		return $rs;
	}
	//from smartlib
	public function riwayat_pasien($id_pasien)
	{
		$sql="SELECT 	a.*
					FROM	soap_riwayat_pasien a
					WHERE	a.`id_pasien`='".$id_pasien."'
					";
		$result = $this->dbhis->query($sql);
		if($result->num_rows() > 0)
		{
			$rs	= $result->result_array();
			$penyakit_sekarang	= $rs[0]['penyakit_sekarang'];
			$penyakit_dahulu		= $rs[0]['penyakit_dahulu'];
			$penyakit_keluarga 	= $rs[0]['penyakit_keluarga'];
			$pengobatan 				= $rs[0]['pengobatan'];
			$alergi 						= $rs[0]['alergi'];
		}
		else
		{
			$penyakit_sekarang	='';
			$penyakit_dahulu		='';
			$penyakit_keluarga	='';
			$pengobatan 				='';
			$alergi 						='';
		}
		return array(
			'penyakit_sekarang' => $penyakit_sekarang,
			'penyakit_dahulu'	 	=> $penyakit_dahulu,
			'penyakit_keluarga'	=> $penyakit_keluarga,
			'pengobatan' 				=> $pengobatan,
			'alergi' 						=> $alergi,
		);
	}
	//end from smartlib
    function rm($id_reg){
		$data_pasien	= $this->get_data_pasien_by_id_reg($id_reg);
		$id_pasien = $data_pasien['id_pasien'];
		$riwayat_pasien	= $this->riwayat_pasien($id_pasien);
		$row = $this->D_Soap->get_data_asm_ri_dokter($id_reg);
        //LAST CPPT
	    $data_cppt              = $this->D_Soap->get_data_cppt($id_pasien);
        //END LAST CPPT
        $datapasiennya          = $this->D_Soap->data_pasien_ranap($id_reg);
        $namapasien             = $datapasiennya['nama_pasien'];
        $idreg                  = $datapasiennya['id_reg'];
        $idpasien               = $datapasiennya['id_pasien'];
        $tgl_lahir              = $datapasiennya['tgl_lahir'];
        $umur2                  = $datapasiennya['umur2'];
        $gender                 = $datapasiennya['gender'];
        $sql_id_bank = "SELECT * FROM mst_bank ORDER BY nama_bank";
        $sql_id_dokter = "SELECT a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name FROM mst_dokter a LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis) ORDER BY a.name";
        $sql = "SELECT a.id_dokter_prt1 FROM trx_reg a WHERE a.id_reg='".$id_reg."'";
        $query = $this->db->query($sql);
        $rowdtr = $query->row_array();
        $id_dokter_prt1 = $rowdtr['id_dokter_prt1'];
        $data = array(
	    		'id_reg'			 => $id_reg,
	    		'id_pasien'			 => $id_pasien,
	    		'row'                => $row,
	    		'data_pasien'		 => $data_pasien,
                'namapasien'         => $namapasien,
                'idreg'              => $idreg,
                'idpasien'           => $idpasien,
                'tgl_lahir'          => $tgl_lahir,
                'umur'               => $umur2,
                'gender'             => $gender,                'data_asm'	         => $data_asm,
                'data_cppt'          => $data_cppt,
	    		'riwayat_pasien'     => $riwayat_pasien,
	    		'dropdown_id_dokter' => $this->formgenerator->get_dropdown('id_operator',$sql_id_dokter,$id_dokter_prt1)
        );
        $this->load->view('soap', $data);
    }
      public function msttindakan_cppt(){
		$term = $this->input->get('term',true);
		$sql = "SELECT a.id_act,a.name,a.price AS harga,a.id_group,b.name AS namegrup,c.name AS namesubgrup 
        FROM mst_tindakan a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
        LEFT JOIN mst_tindakan_subgrup c ON a.id_subgroup=c.id_subgroup  
        WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label']         = $v['name'];
			$rs[$k]['id']            = $v['id_act'];
            $rs[$k]['price_cppt']    = $v['harga'];
            $rs[$k]['id_group_cppt'] = $v['id_group'];
            $rs[$k]['group_cppt']    = $v['namegrup'];
            $rs[$k]['subgroup_cppt'] = $v['namesubgrup'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
      }
    //END MST
    function get_list_cppt(){
        $id_pasien      = $this->input->post('id_pasien');
        $data           = $this->D_Soap->get_data_cppt($id_pasien);
        $datasend       = json_encode($data);
        echo $datasend;
    }
    function get_detail_cppt(){
        $id_asmri       = $this->input->post('id_asmri');
        $data           = $this->D_Soap->get_detail_cppt($id_asmri);
        $datasend       = json_encode($data);
        echo $datasend;
    }
    public function act_cppt($id_reg,$id_pasien){
        $datetime       = DATE('Y-m-d H:i:s');
        $id_doc         = @$this->session->userdata['sp']->id_dokter;
        $creator        = @$this->session->userdata['sp']->username;
        $edit_set       = $this->input->post('edit_set');
        $id_asmri_set   = $this->input->post('id_asmri');
          if ($id_doc != NULL) {
            $id_dokter = $id_doc;
          } else {
            $id_dokter = '';
          }
        $data_pasien	= $this->get_data_pasien_by_id_reg($id_reg);
        $data = array(
            'asmri_date'                => date('Y-m-d H:i:s'),
            'regdate'                   => $data_pasien['regdate'],
            'id_reg'                    => $id_reg,
            'id_pasien'                 => $data_pasien['id_pasien'],
            'nama_pasien'               => $data_pasien['name'], 
            'id_dokter'                 => $id_dokter,
            'id_type'                   => '2',
            'jenis_asm'                 => 'DOKTER',
            'kategori'                  => 'CPPT',
            // SUBJECTIVE START
            'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
            'subjective'             	=> $this->input->post('keluhan_utama'),
            // SUBJECTIVE END
            // OBJECTIVE START
            'objective'                 => $this->input->post('objective'),
            // OBJECTIVE END
            // ASSESMENT
            'assesment'	                => $this->input->post('assesment'),
            'diag_medis_banding'	    => $this->input->post('assesment'),
            'diag_medis_banding_text'	=> $this->input->post('assesment'),
            // ASSESMENT END
            // PLANNING
            'planning'			        => $this->input->post('planning'),
            'planning_text'	            => $this->input->post('planning'),
            // PLANNING END
            'created'	                => date('Y-m-d H:i:s'),
            'creator'                   => $creator,
        );
        $data_update = array(
            // SUBJECTIVE START
            'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
            'subjective'             	=> $this->input->post('keluhan_utama'),
            // SUBJECTIVE END
            // OBJECTIVE START
            'objective'                 => $this->input->post('objective'),
            // OBJECTIVE END
            // ASSESMENT
            'assesment'	                => $this->input->post('assesment'),
            'diag_medis_banding'	    => $this->input->post('assesment'),
            'diag_medis_banding_text'	=> $this->input->post('assesment'),
            // ASSESMENT END
            // PLANNING
            'planning'			        => $this->input->post('planning'),
            'planning_text'	            => $this->input->post('planning'),
            // PLANNING END
            'updated'                   => date('Y-m-d H:i:s'),
            'updator'                   => $creator,
        );
        //tindakan 24022023
        $id_reg         = $this->input->post('idregset');
        $id_operator    = $this->input->post('id_operator');
        $send           = $this->input->post('id_act_cppt');
        $qty            = $this->input->post('qty_cppt');
        $name           = $this->input->post('nama_tindakan_cppt');
        $price          = $this->input->post('price_cppt');
        $id_grup        = $this->input->post('id_group_cppt');
        $datetime       = date('Y-m-d H:i:s');
        $fndiddokter    = $this->D_Soap->fnddatadokter($id_reg);
        $id_dokter      = $fndiddokter->id_dokter_prt1;
        if(empty($send)){
            //nothing
        }else{
        foreach($send as $k => $v){
            $qtyset    = $qty[$k];
            $nameset   = $name[$k];
            $priceset  = $price[$k];
            $totalset  = ($priceset * $qtyset);
            $idgrupset = $id_grup[$k];
            $data_trx_reg_act = array(  
                'id_reg'             =>   $id_reg,
                'id_dokter'          =>   $id_dokter,
                'id_reg_act'         =>   $v,
                'trxdate'            =>   $datetime,
                'operator'           =>   $id_operator,
                'qty'                =>   $qtyset,
                'name'               =>   $nameset,
                'price'              =>   $priceset,
                'id_group_act'       =>   $idgrupset,
                'total'              =>   $totalset,
                'created'            =>   $datetime,
                'creator'            =>   $creator
            );
            $this->D_Soap->createregact($data_trx_reg_act,'trx_reg_act'); 
        }
        }
        //end tindakan 24022023
        //////////////////////////////////
        if($edit_set==1){
        //UPDATE
        $where = " id_asmri='".$id_asmri_set."' ";
        $this->D_Soap->edit_data_asm_ranap($where, $data_update);
        //UPLOAD SECTION 
            $size_file                      = "5120";
            $allow_file                     = "jpg|png|jpeg";
            $strtime                        = strtotime("now");
            // Start uploading file
            //files dok 1
            $file_dok_upl = $this->config->item('upload_path') . "./assets/files_medis_befaft/".$id_pasien.'/'.$id_reg;
            if (!file_exists($file_dok_upl)) mkdir($file_dok_upl, 0777, true);
            $config_1 = array( 'upload_path' => $file_dok_upl, 'allowed_types' => $allow_file, 'max_size' => $size_file, 'file_name' => $strtime ); $this->load->library('upload', $config_1);
            if (!$this->upload->do_upload('filedetail_dok_1')) { //nothing
            }else{
            $file = $this->upload->data();
                $data_upload = array(
                    'filedetail_dok_1'    => $strtime.$file['file_ext'],
                    'upload_dok_1'        => $creator."-".$datetime
                );
                $where_upload = array(
                    'id_asmri'            => $id_asmri_set,
                );
                $this->D_Soap->update_data($where_upload,$data_upload,'soap_asm_ri');
            }
            //end files dok 1
            if (!$this->upload->do_upload('filedetail_dok_2')) { //nothing
            }else{
            $file = $this->upload->data();
                $data_upload2 = array(
                    'filedetail_dok_2'    => $strtime.$file['file_ext'],
                    'upload_dok_2'        => $creator."-".$datetime
                );
                $where_upload2 = array(
                    'id_asmri'            => $id_asmri_set,
                );
                $this->D_Soap->update_data2($where_upload2,$data_upload2,'soap_asm_ri');
            }
            //end files dok 2
        //END UPLOAD SECTION
        ///////////////////////////
           $infoset     = "Update ".$creator.' -> '.$datetime.' -> '.$id_pasien.' ('.$id_reg.')';
           $data_log = array(
               'type' 	        =>	"5",
               'attempt_1'     =>	"CPPT - ID ASMRI ".$id_asmri_set,
               'attempt_2'	    => 	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
               'info' 	        =>	$infoset." Upload File ".$strtime.$file['file_ext']."/".$file['file_size']." kilobytes/".$file['file_ext'],
               'created'		=>  date('Y-m-d H:i:s'),
               'created_by'	=>  $creator
           );
           $this->D_Soap->add_to_log($data_log);       
        /////////////////////////////
        //END UPDATE
        }else{
        //INSERT
        $this->D_Soap->add_data_asm_ranap($data);
        //UPLOAD SECTION 
            $size_file                      = "5120";
            $allow_file                     = "jpg|png|jpeg";
            // Start uploading file
            //files dok 1
            $file_dok_upl = $this->config->item('upload_path') . "./assets/files_medis_befaft/".$id_pasien.'/'.$id_reg;
            if (!file_exists($file_dok_upl)) mkdir($file_dok_upl, 0777, true);
            $config_1 = array( 'upload_path' => $file_dok_upl, 'allowed_types' => $allow_file, 'max_size' => $size_file, 'file_name' => $strtime ); $this->load->library('upload', $config_1);
            if (!$this->upload->do_upload('filedetail_dok_1')) { //nothing
            }else{
            $file = $this->upload->data();
                $data_upload = array(
                    'filedetail_dok_1'    => $strtime.$file['file_ext'],
                    'upload_dok_1'        => $creator."-".$datetime
                );
                $where_upload = array(
                    'id_asmri'            => $id_asmri_set,
                );
                $this->D_Soap->update_data($where_upload,$data_upload,'soap_asm_ri');
            }
            //end files dok 1
            //files dok 2
            if (!$this->upload->do_upload('filedetail_dok_2')) { //nothing
            }else{
            $file = $this->upload->data();
                $data_upload2 = array(
                    'filedetail_dok_2'    => $strtime.$file['file_ext'],
                    'upload_dok_2'        => $creator."-".$datetime
                );
                $where_upload2 = array(
                    'id_asmri'            => $id_asmri_set,
                );
                $this->D_Soap->update_data2($where_upload2,$data_upload2,'soap_asm_ri');
            }
            //end files dok 2
        //END UPLOAD SECTION
        ///////////////////////////
           $infoset     = "Insert ".$creator.' -> '.$datetime.' -> '.$id_pasien.' ('.$id_reg.')';
           $data_log = array(
               'type' 	        =>	"5",
               'attempt_1'      =>	"CPPT - ID ASMRI ".$id_asmri_set,
               'attempt_2'	    => 	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
               'info' 	        =>	$infoset." Upload File ".$strtime.$file['file_ext']."/".$file['file_size']." kilobytes/".$file['file_ext'],
               'created'		=>  date('Y-m-d H:i:s'),
               'created_by'	=>  $creator
           );
           $this->D_Soap->add_to_log($data_log);       
        /////////////////////////////
        //END INSERT
        }
        #echo json_encode(array("status" => true));
        redirect('soap/rm/'.$id_reg);
    }
    public function act_cppt_update($id_reg,$id_pasien){
        $datetime       = DATE('Y-m-d H:i:s');
        $id_doc         = @$this->session->userdata['sp']->id_dokter;
        $creator        = @$this->session->userdata['sp']->username;
          if ($id_doc != NULL) {
            $id_dokter = $id_doc;
          } else {
            $id_dokter = '';
          }
        $data_pasien	= $this->get_data_pasien_by_id_reg($id_reg);
        $data = array(
            'asmri_date'                => date('Y-m-d H:i:s'),
            'regdate'                   => $data_pasien['regdate'],
            'id_reg'                    => $id_reg,
            'id_pasien'                 => $data_pasien['id_pasien'],
            'nama_pasien'               => $data_pasien['name'], 
            'id_dokter'                 => $id_dokter,
            'id_type'                   => '2',
            'jenis_asm'                 => 'DOKTER',
            'kategori'                  => 'CPPT',
            // SUBJECTIVE START
            'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
            // SUBJECTIVE END
            // OBJECTIVE START
            'objective'                 => $this->input->post('objective'),
            // OBJECTIVE END
            // ASSESMENT
            'assesment'	                => $this->input->post('assesment'),
            'diag_medis_banding'	    => $this->input->post('assesment'),
            'diag_medis_banding_text'	=> $this->input->post('assesment'),
            // ASSESMENT END
            // PLANNING
            'planning'			        => $this->input->post('planning'),
            'planning_text'	            => $this->input->post('planning'),
            // PLANNING END
            'created'	                => date('Y-m-d H:i:s'),
            'creator'                   => $creator,
        );
        $data_update = array(
            // SUBJECTIVE START
            'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
            // SUBJECTIVE END
            // OBJECTIVE START
            'objective'                 => $this->input->post('objective'),
            'kategori'                  => 'CPPT',
            // OBJECTIVE END
            // ASSESMENT
            'assesment'	                => $this->input->post('assesment'),
            'diag_medis_banding'	    => $this->input->post('assesment'),
            'diag_medis_banding_text'	=> $this->input->post('assesment'),
            // ASSESMENT END
            // PLANNING
            'planning'			        => $this->input->post('planning'),
            'planning_text'	            => $this->input->post('planning'),
            // PLANNING END
            'updated'                   => date('Y-m-d H:i:s'),
            'updator'                   => $creator,
        );
        //tindakan 24022023
        $id_reg         = $this->input->post('idregset');
        $id_operator    = $this->input->post('id_operator');
        $send           = $this->input->post('id_act_cppt');
        $qty            = $this->input->post('qty_cppt');
        $name           = $this->input->post('nama_tindakan_cppt');
        $price          = $this->input->post('price_cppt');
        $id_grup        = $this->input->post('id_group_cppt');
        $datetime       = date('Y-m-d H:i:s');
        $fndiddokter    = $this->D_Soap->fnddatadokter($id_reg);
        $id_dokter      = $fndiddokter->id_dokter_prt1;
        foreach($send as $k => $v){
            $qtyset    = $qty[$k];
            $nameset   = $name[$k];
            $priceset  = $price[$k];
            $totalset  = ($priceset * $qtyset);
            $idgrupset = $id_grup[$k];
            $data_trx_reg_act = array(  
                'id_reg'             =>   $id_reg,
                'id_dokter'          =>   $id_dokter,
                'id_reg_act'         =>   $v,
                'trxdate'            =>   $datetime,
                'operator'           =>   $id_operator,
                'qty'                =>   $qtyset,
                'name'               =>   $nameset,
                'price'              =>   $priceset,
                'id_group_act'       =>   $idgrupset,
                'total'              =>   $totalset,
                'created'            =>   $datetime,
                'creator'            =>   $creator
            );
            $this->D_Soap->createregact($data_trx_reg_act,'trx_reg_act'); 
        }
        //end tindakan 24022023
        $dataidreg      = $this->D_Soap->fndidreg($id_reg);
		$fnddata 		= $dataidreg->fnddata;
        if($fnddata < 1){
          $sql_command = 'insert';
        }else{
          $sql_command = 'update';
        }
        //echo $sql_command;
        //exit;
        if($sql_command=='update')
        {
            $where = " id_reg='".$idregset."' ";
            $this->D_Soap->edit_data_asm_ranap($where, $data_update);
            //UPLOAD SECTION 
                $size_file                      = "5120";
                $allow_file                     = "jpg|png|jpeg";
                // Start uploading file
                //files dok 1
                $file_dok_upl = $this->config->item('upload_path') . "./assets/files_medis_befaft/".$id_pasien.'/'.$id_reg;
                if (!file_exists($file_dok_upl)) mkdir($file_dok_upl, 0777, true);
                $config_1 = array( 'upload_path' => $file_dok_upl, 'allowed_types' => $allow_file, 'max_size' => $size_file ); $this->load->library('upload', $config_1);
                if (!$this->upload->do_upload('filedetail_dok_1')) { //nothing
                }else{
                $file = $this->upload->data();
                    $data_upload = array(
                        'filedetail_dok_1'    => $file['file_name'],
                        'upload_dok_1'        => $creator."-".$datetime
                    );
                    $where_upload = array(
                        'id_reg'              => $id_reg,
                    );
                    $this->D_Soap->update_data($where_upload,$data_upload,'soap_asm_ri');
                }
            //END UPLOAD SECTION
                                ///////////////////////////
                                $infoset     = "Update ".$creator.' -> '.$datetime.' -> '.$id_pasien.' ('.$id_reg.')';
                                $data_log = array(
                                    'type' 	        =>	"5",
                                    'attempt_1'     =>	"CPPT",
                                    'attempt_2'	    => 	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
                                    'info' 	        =>	$infoset." Upload File ".strtotime("now")."/".$file['file_size']." kilobytes/".$file['file_ext'],
                                    'created'		=>  date('Y-m-d H:i:s'),
                                    'created_by'	=>  $creator
                                );
                                $this->D_Soap->add_to_log($data_log);
        }
        else
        {
            $action = $this->D_Soap->add_data_asm_ranap($data);
                //UPLOAD SECTION 
                    $size_file                      = "5120";
                    $allow_file                     = "jpg|png|jpeg";
                    // Start uploading file
                    //files dok 1
                    $file_dok_upl = $this->config->item('upload_path') . "./assets/files_medis_befaft/".$id_pasien.'/'.$id_reg;
                    if (!file_exists($file_dok_upl)) mkdir($file_dok_upl, 0777, true);
                    $config_1 = array( 'upload_path' => $file_dok_upl, 'allowed_types' => $allow_file, 'max_size' => $size_file ); $this->load->library('upload', $config_1);
                    if (!$this->upload->do_upload('filedetail_dok_1')) { //nothing
                    }else{
                    $file = $this->upload->data();
                        $data_upload = array(
                            'filedetail_dok_1'    => $file['file_name'],
                            'upload_dok_1'        => $creator."-".$datetime
                        );
                        $where_upload = array(
                            'id_reg'              => $id_reg,
                        );
                        $this->D_Soap->update_data($where_upload,$data_upload,'soap_asm_ri');
                    }
                //END UPLOAD SECTION
                                    ///////////////////////////
                                    $infoset     = "Insert ".$creator.' -> '.$datetime.' -> '.$id_pasien.' ('.$id_reg.')';
                                    $data_log = array(
                                        'type' 	        =>	"5",
                                        'attempt_1'     =>	"CPPT",
                                        'attempt_2'	    => 	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
                                        'info' 	        =>	$infoset." Upload File ".strtotime("now")."/".$file['file_size']." kilobytes/".$file['file_ext'],
                                        'created'		=>  date('Y-m-d H:i:s'),
                                        'created_by'	=>  $creator
                                    );
                                    $this->D_Soap->add_to_log($data_log);
        }
        #echo json_encode(array("status" => true));
        redirect('soap/rm/'.$id_reg);
    }
        function upload_processing(){
        $username                = @$this->session->userdata['sp']->username;
        $id_pasien               = $this->input->post('id_pasien');
        $id_reg                  = $this->input->post('id_reg');
        $id_cppt                 = $this->input->post('id_cppt_set');
        $tipe                    = $this->input->post('tipe_upload');
        $datet                   = date('Y-m-d H:i:s');
       //Start uploading file
       $dir_empid = $this->config->item('upload_path') . "./assets/files_medis_befaft/".$id_pasien."/".$id_reg."/".$id_cppt;
       if (!file_exists($dir_empid))
           mkdir($dir_empid, 0777, true);
           $config = array(
               'upload_path' => $dir_empid,
               'allowed_types' => 'jpeg|jpg|png',
               'max_size' => '2048' //2MB
           );
       $this->load->library('upload', $config);
       if($this->upload->do_upload('userfile')) {
       $namafile = $this->upload->data();
       $data_upload = array(
           'id_set_cppt' => $id_cppt,
           'id_pasien'   => $id_pasien,
           'id_reg'      => $id_reg,
           'tipe'        => $tipe,
           'nama_file'   => $namafile['file_name'],
           'nama_ext'    => $namafile['file_ext'],
           'file_size'   => $namafile['file_size'],
           'created'     => $datet,
           'created_by'  => $username
          );
       $this->D_Soap->createrowupload($data_upload,'upload_foto_befaft'); 
       }
       }
       function list_photo_after(){
        $id_pasien      = $this->input->post('id_pasien_set');
        $id_reg         = $this->input->post('id_reg_set');
        $id_cppt        = $this->input->post('id_cppt_set');
        $data           = $this->D_Soap->get_data_foto_after($id_pasien,$id_reg,$id_cppt);
        $datasend       = json_encode($data);
        echo $datasend;
    }
    function list_photo_before(){
        $id_pasien      = $this->input->post('id_pasien_set');
        $id_reg         = $this->input->post('id_reg_set');
        $id_cppt        = $this->input->post('id_cppt_set');
        $data           = $this->D_Soap->get_data_foto_before($id_pasien,$id_reg,$id_cppt);
        $datasend       = json_encode($data);
        echo $datasend;
    }

    function deleteimage(){
        $id         = $this->input->post('id');
        $dataset    = $this->D_Soap->set_delete_list($id);
        echo json_encode($dataset);
     }
    function mstdokterset(){
        $data       = $this->D_Soap->mst_dokter();
        $datasend = json_encode($data);
        echo $datasend;
    }
    public function msttindakan(){
		$term = $this->input->get('term',true);
		$sql = "SELECT a.id_act,a.name,a.price AS harga,a.id_group,b.name AS namegrup,c.name AS namesubgrup 
        FROM mst_tindakan a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
        LEFT JOIN mst_tindakan_subgrup c ON a.id_subgroup=c.id_subgroup 
        WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%' AND a.aktif=1";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label']    = $v['name'];
			$rs[$k]['id']       = $v['id_act'];
            $rs[$k]['price']    = $v['harga'];
            $rs[$k]['id_group'] = $v['id_group'];
            $rs[$k]['group']    = $v['namegrup'];
            $rs[$k]['subgroup'] = $v['namesubgrup'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
      }
            /////////////TINDAKAN LOG
      public function soap_tindakanlog(){
        $id_reg = $this->input->post('id_reg');
        $data       = $this->D_Soap->riwayattindakan($id_reg);
        $datasend = json_encode($data);
        echo $datasend;
      }
      /////////////END TINDAKAN LOG
}
?>