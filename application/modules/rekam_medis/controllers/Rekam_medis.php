<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medis extends MX_Controller {
	var $session_name='sp';
	var $start = 0;

	function __construct() {
		parent::__construct();
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');

		$this->load->model('Rekam_medis_model','mdl');
  }

  public function user_erm()
  {
		#print_r($this->session->userdata);
		#$this->output->enable_profiler(true);
		$sql_dokter	=" SELECT MD.`id_dokter`, MD.`name` FROM mst_dokter MD WHERE MD.`aktif` = 1 ORDER BY MD.`name`";
		$dokter_list=$this->formgenerator->get_dropdown('dokter_list', $sql_dokter, $selected_id='', $readmode=false, $onChange='');

		$id_dokter= $this->input->post('dokter_list');
    $date 		= $this->input->post('awal',date('Y-m-d'));
    $date_akhir= $this->input->post('akhir',date('Y-m-d'));

		/*
		$sql="SELECT TRU.id_reg, TRU.trxdate,
            CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
            MP.id_pasien, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
            MP.birthdate, MU.name AS unit, MD.name AS dokter,
            IF(TR.mrstat=1, 0, 1) AS mrstat, TRU.ctr_num,
            MC.name AS asuransi,
            (CASE TR.status WHEN 0 THEN 'OPEN' WHEN 1 THEN 'CLOSED' END) AS stat,
            TR.status,
						(SELECT x.id_cppt FROM dbhis.soap_cppt_trans x WHERE x.id_reg = TR.id_reg AND x.id_dokter = MD.id_dokter) AS id_cppt,
						(SELECT y.id_asm FROM dbhis.soap_awal y WHERE y.id_reg = TR.id_reg AND y.id_dokter = MD.id_dokter) AS id_asm

            FROM trx_reg_unit TRU
            LEFT JOIN trx_reg TR ON TR.id_reg=TRU.id_reg
            LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
            LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
            LEFT JOIN mst_unit MU ON TRU.id_unit=MU.id_unit
            LEFT JOIN mst_dokter MD ON TRU.id_dokter=MD.id_dokter
            LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
            WHERE TR.status<2 AND TRU.cancel=0
            AND DATE(TRU.`trxdate`)='".$date."'
						AND TRU.`id_dokter`='".$id_dokter."'
            ORDER BY TRU.trxdate DESC
		";
		*/
		/*
		$sql="SELECT 	TRU.id_reg, TRU.trxdate,
            			CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
									MP.id_pasien, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
									MP.birthdate, MU.name AS unit, MD.name AS dokter,MD.id_dokter,
									IF(TR.mrstat=1, 0, 1) AS mrstat, TRU.ctr_num,MC.name AS asuransi,
									(CASE TR.status WHEN 0 THEN 'OPEN' WHEN 1 THEN 'CLOSED' END) AS stat,
									TR.status,y.id_asm,SCT.id_cppt,SCT.assesment
									,(SELECT GROUP_CONCAT(a.id_icd SEPARATOR ';') FROM trx_reg_icd10 a WHERE a.`id_reg`=TR.id_reg) AS id_icd
          FROM trx_reg_unit TRU
									LEFT JOIN trx_reg TR ON TR.id_reg=TRU.id_reg
									LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
									LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
									LEFT JOIN mst_unit MU ON TRU.id_unit=MU.id_unit
									LEFT JOIN mst_dokter MD ON TRU.id_dokter=MD.id_dokter
									LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
									LEFT JOIN dbhis.soap_awal y ON (y.id_reg=TR.id_reg AND y.id_dokter=MD.id_dokter)
									LEFT JOIN dbhis.soap_cppt_trans SCT ON (SCT.id_reg=TR.id_reg AND SCT.id_dokter = MD.id_dokter)
          WHERE TR.status<2 AND TRU.cancel=0
									AND DATE(TRU.`trxdate`)='".$date."'
									AND TRU.`id_dokter`='".$id_dokter."'
          ORDER BY TRU.trxdate DESC
		";
		*/
		$sql = "SELECT ax.* FROM (
				SELECT 	TRU.id_reg, TRU.trxdate,
				            			CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
													MP.id_pasien, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
													MP.birthdate, MU.name AS unit, MD.name AS dokter,MD.id_dokter,
													IF(TR.mrstat=1, 0, 1) AS mrstat, TRU.ctr_num,MC.name AS asuransi,
													(CASE TR.status WHEN 0 THEN 'OPEN' WHEN 1 THEN 'CLOSED' END) AS stat,
													TR.status,y.id_asm,SCT.id_cppt,SCT.assesment
													,(SELECT GROUP_CONCAT(a.id_icd SEPARATOR ';') FROM trx_reg_icd10 a WHERE a.`id_reg`=TR.id_reg) AS id_icd
				          FROM trx_reg_unit TRU
													LEFT JOIN trx_reg TR ON TR.id_reg=TRU.id_reg
													LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
													LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
													LEFT JOIN mst_unit MU ON TRU.id_unit=MU.id_unit
													LEFT JOIN mst_dokter MD ON TRU.id_dokter=MD.id_dokter
													LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
													LEFT JOIN dbhis.soap_awal y ON (y.id_reg=TR.id_reg AND y.id_dokter=MD.id_dokter)
													LEFT JOIN dbhis.soap_cppt_trans SCT ON (SCT.id_reg=TR.id_reg AND SCT.id_dokter = MD.id_dokter)
				          WHERE TR.status<2 AND TRU.cancel=0
													AND DATE(TRU.`trxdate`)='".$date."'
													AND TRU.`id_dokter`='".$id_dokter."'
				UNION ALL
				SELECT 	TR.id_reg, TR.regdate AS trxdate,
				            			CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
													MP.id_pasien, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
													MP.birthdate, 'IGD' AS unit, MD.name AS dokter,MD.id_dokter,
													IF(TR.mrstat=1, 0, 1) AS mrstat
				                                    ,NULL AS ctr_num
				                                    ,MC.name AS asuransi,
													(CASE TR.status WHEN 0 THEN 'OPEN' WHEN 1 THEN 'CLOSED' END) AS stat,
													TR.status,y.id_asm,SCT.id_cppt,SCT.assesment
													,(SELECT GROUP_CONCAT(a.id_icd SEPARATOR ';') FROM trx_reg_icd10 a WHERE a.`id_reg`=TR.id_reg) AS id_icd
				          FROM trx_reg TR
													LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
													LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
													LEFT JOIN mst_dokter MD ON TR.id_dokter_jaga=MD.id_dokter
													LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
													LEFT JOIN dbhis.soap_awal y ON (y.id_reg=TR.id_reg AND y.id_dokter=MD.id_dokter)
													LEFT JOIN dbhis.soap_cppt_trans SCT ON (SCT.id_reg=TR.id_reg AND SCT.id_dokter = MD.id_dokter)
				          WHERE TR.status<2 
													AND DATE(TR.`regdate`)='".$date."'
													AND TR.`id_dokter_jaga`='".$id_dokter."'
				) ax
				ORDER BY ax.trxdate DESC";

		//echo "<pre>".$sql."</pre>";
		$query=$this->dbhis->query($sql);

		$data_row=array();

		foreach($query->result_array() as $k => $rs) {
			$id_pasien 			= $rs['id_pasien'];
			$id_reg 				= $rs['id_reg'];
			$cek_soap 			= $this->mdl->cek_jml_soap($id_pasien, $id_dokter);
			$cek_asm 				= $this->mdl->cek_jml_asm($id_pasien, $id_dokter);
			$rs['jml_soap'] = $cek_soap;
			$rs['jml_asm'] 	= $cek_asm;
			if($rs['id_icd']=='')
			{
				$rs['id_icd'] = '[ Input ]';
			}
			$data_row[]     = $rs;
		}

		$this->make_bread->add('Rekam Medis', '', 1);
    $this->make_bread->add('e-RM User', '', 0);
    $breadcrumb = $this->make_bread->output();

		//print_r($data_row);
		$data=array(
			'data_row'		=> $data_row,
			'dokter_list'	=> $dokter_list,
			'date'				=> $date,
			'id_doctor'		=> $id_dokter,
			'breadcrumb'	=> $breadcrumb,
		);
		$this->load->view('vuser_erm', $data);

  }

  public function user_erm_cari()
  {
		$nama_pasien	= $this->input->post('nama_pasien');
		$id_pasien	= $this->input->post('id_pasien');

		$this->make_bread->add('Rekam Medis', '', 1);
		$this->make_bread->add('e-RM User', '', 0);
		$breadcrumb = $this->make_bread->output();

		if(empty($id_pasien) && empty($nama_pasien))
		{
			$data = array(
				'data_row'		=> array(),
				'nama_pasien'	=> $nama_pasien,
				'id_pasien'		=> $id_pasien,
				'id_doctor'		=> '',
				'breadcrumb'	=> $breadcrumb,
		);

			$this->load->view('vuser_erm_cari',$data);
		}
		else
		{
			$sql="SELECT 	TRU.id_reg, TRU.trxdate,
	            			CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
										MP.id_pasien, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
										MP.birthdate, MU.name AS unit, MD.name AS dokter,MD.id_dokter,
										IF(TR.mrstat=1, 0, 1) AS mrstat, TRU.ctr_num,MC.name AS asuransi,
										(CASE TR.status WHEN 0 THEN 'OPEN' WHEN 1 THEN 'CLOSED' END) AS stat,
										TR.status,y.id_asm,SCT.id_cppt,SCT.assesment
										,(SELECT GROUP_CONCAT(a.id_icd SEPARATOR ';') FROM trx_reg_icd10 a WHERE a.`id_reg`=TR.id_reg) AS id_icd
	          FROM trx_reg_unit TRU
										LEFT JOIN trx_reg TR ON TR.id_reg=TRU.id_reg
										LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
										LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
										LEFT JOIN mst_unit MU ON TRU.id_unit=MU.id_unit
										LEFT JOIN mst_dokter MD ON TRU.id_dokter=MD.id_dokter
										LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
										LEFT JOIN dbhis.soap_awal y ON (y.id_reg=TR.id_reg AND y.id_dokter=MD.id_dokter)
										LEFT JOIN dbhis.soap_cppt_trans SCT ON (SCT.id_reg=TR.id_reg AND SCT.id_dokter = MD.id_dokter)
	          WHERE TR.status<2 AND TRU.cancel=0
						";
			if ($id_pasien != '')
				$sql .= " AND TR.id_pasien LIKE '%" . $id_pasien . "%' ";
			if ($nama_pasien != '')
				$sql .= " AND LOWER(MP.name) LIKE LOWER('%" . $nama_pasien . "%')";
			$sql .= "ORDER BY TR.regdate DESC
					LIMIT 50";

			//echo "<pre>".$sql."</pre>";
			$query=$this->dbhis->query($sql);

			$data_row=array();

			foreach($query->result_array() as $k => $rs) {
				$id_pasien 			= $rs['id_pasien'];
				$id_reg 				= $rs['id_reg'];
				$id_dokter 			= $rs['id_dokter'];
				$cek_soap 			= $this->mdl->cek_jml_soap($id_pasien, $id_dokter);
				$cek_asm 				= $this->mdl->cek_jml_asm($id_pasien, $id_dokter);
				$rs['jml_soap'] = $cek_soap;
				$rs['jml_asm'] 	= $cek_asm;
				if($rs['id_icd']=='')
				{
					$rs['id_icd'] = '[ Input ]';
				}
				$data_row[]     = $rs;
			}

			//print_r($data_row);
			$data=array(
				'data_row'		=> $data_row,
				'nama_pasien'	=> $nama_pasien,
				'id_pasien'				=> $id_pasien,
				'id_doctor'		=> $id_dokter,
				'breadcrumb'	=> $breadcrumb,
			);
			$this->load->view('vuser_erm_cari', $data);
		}

  }

  function user_erm_xls($date, $id_dokter)
	{
		$sql="SELECT TRU.id_reg, TRU.trxdate,
            CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
            MP.id_pasien, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
            MP.birthdate, MU.name AS unit, MD.name AS dokter,
            IF(TR.mrstat=1, 0, 1) AS mrstat, TRU.ctr_num,
            MC.name AS asuransi,
            (CASE TR.status WHEN 0 THEN 'OPEN' WHEN 1 THEN 'CLOSED' END) AS stat,
            TR.status

            FROM trx_reg_unit TRU
            LEFT JOIN trx_reg TR ON TR.id_reg=TRU.id_reg
            LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
            LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
            LEFT JOIN mst_unit MU ON TRU.id_unit=MU.id_unit
            LEFT JOIN mst_dokter MD ON TRU.id_dokter=MD.id_dokter
            LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
            WHERE TR.status<2 AND TRU.cancel=0
            AND DATE(TRU.`trxdate`)='".$date."'
						AND TRU.`id_dokter`='".$id_dokter."'
            ORDER BY TRU.trxdate DESC
    			";

		//echo "<pre>".$sql."</pre>";
		$query=$this->dbhis->query($sql);

		$data_row=array();

		foreach($query->result_array() as $k => $rs) {
			$id_pasien 			= $rs['id_pasien'];
			$cek_soap 			= $this->mdl->cek_jml_soap($id_pasien, $id_dokter);
			$cek_asm 				= $this->mdl->cek_jml_asm($id_pasien, $id_dokter);
			$rs['jml_soap'] = $cek_soap;
			$rs['jml_asm'] 	= $cek_asm;
			$data_row[]     = $rs;
		}

		//print_r($data_row);
		$data=array(
			'data_row'		=> $data_row,
			'date'				=> $date,
			'id_doctor'		=> $id_dokter,
		);
		$this->load->view('vuser_erm_xls', $data);
  }

	public function inner_modal_input_icd($id_reg)
	{
		$sql = "SELECT 	b.name
										,CONCAT(b.`id_icd`,' | ',b.`name`) as combo_name
										,a.*
						FROM 		trx_reg_icd10 a, mst_icd b
						WHERE 	a.id_icd=b.id_icd
										AND a.id_reg='".$id_reg."'
						";
		
		$query = $this->dbhis->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$data_icd_ten[$k] = $v;
		}
		/*
		for($i=0;$i<=4;$i++)
		{
			if(isset($rs[$i]))
				$data_icd_ten[$i] = $rs[$i];
			else
				$data_icd_ten[$i] = array();
		}
		*/
		$data = array(
			'data_icd_ten'	=> $rs,
		);
		$this->load->view('vinner_input_icd', $data);
	}
	
	public function inner_get_icd_pasien($id_reg)
	{
		$sql = "SELECT 	b.name
										,CONCAT(b.`id_icd`,' | ',b.`name`) as combo_name
										,a.*
						FROM 		trx_reg_icd10 a, mst_icd b
						WHERE 	a.id_icd=b.id_icd
										AND a.id_reg='".$id_reg."'
						";
		
		$query = $this->dbhis->query($sql);
		$rs = $query->result_array();
		$data_icd_ten = array();
		foreach($rs as $k => $v)
		{
			$data_icd_ten[$k] = $v;
		}
		echo json_encode($data_icd_ten);
	}
	
	public function inner_get_icd_nine_pasien($id_reg)
	{
		$sql = "SELECT 	b.name
										,CONCAT(b.`id_proc`,' | ',b.`name`) as combo_name
										,a.*
						FROM 		trx_reg_icd9 a, mst_icd9cm b
						WHERE 	a.id_icd9cm=b.id_proc
										AND a.id_reg='".$id_reg."'
						";
		
		$query = $this->dbhis->query($sql);
		$rs = $query->result_array();
		$data_icd_nine = array();
		foreach($rs as $k => $v)
		{
			$data_icd_nine[$k] = $v;
		}
		echo json_encode($data_icd_nine);
	}
	
	public function inner_get_data_autocomplet_icd_ten()
	{
		$term = $this->input->get('term',true);
					//SELECT 	CONCAT(a.id_icd,' | ',a.`name`) AS name,a.id_icd
		$sql = "
						SELECT 	CONCAT(a.id_icd,' | ',a.`name`) as label,a.id_icd as id
						FROM 		mst_icd a
						WHERE 	(UPPER(a.id_icd) LIKE '%".strtoupper($term)."%' OR UPPER(a.name) LIKE '%".strtoupper($term)."%')
						";
		$query = $this->dbhis->query($sql);
		$rs = $query->result_array();
		/*
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] 	= $v['id_icd'];
			$rs[$k]['id'] 		= $v['name'];
		}
		*/
		$return = json_encode($rs);
		echo $return;
	}
	
	public function inner_get_data_autocomplet_icd_nine()
	{
		$term = $this->input->get('term',true);

		$sql = "SELECT 	CONCAT(a.id_proc,' | ',a.`name`) as label,a.id_proc as id
						FROM 		mst_icd9cm a
						WHERE 	(UPPER(a.id_proc) LIKE '%".strtoupper($term)."%' OR UPPER(a.name) LIKE '%".strtoupper($term)."%')
						";
						
		$query = $this->dbhis->query($sql);
		$rs = $query->result_array();
		/*
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] 	= $v['id_icd'];
			$rs[$k]['id'] 		= $v['name'];
		}
		*/
		$return = json_encode($rs);
		echo $return;
	}

	function act_save_icd()
	{
		$id_reg 			= $this->input->post('id_reg_icd',true);
		$id_icd_ten 	= $this->input->post('id_icd_ten',true);
		$id_icd_nine 	= $this->input->post('id_icd_nine',true);
		$old_id_icd_ten 	= $this->input->post('old_id_icd_ten',true);
		$old_id_icd_nine 	= $this->input->post('old_id_icd_nine',true);
		
		
		// --- PREPARE DATA FOR INPUT --- 
		$id_type 			= $this->get_id_type($id_reg);
		$unit_dokter 	= $this->get_unit_dokter_by_reg($id_reg);
		$id_unit			= ($unit_dokter['id_unit']=='null')?"null":"'".$unit_dokter['id_unit']."'";
		$id_dokter		= ($unit_dokter['id_dokter']=='null')?"null":"'".$unit_dokter['id_dokter']."'";
			
		$umur = $this->get_umur_by_id_reg($id_reg);
		$age_y	=$umur['age_y'];
		$age_m	=$umur['age_m'];
		$age_d	=$umur['age_d'];
			
		$creator = $this->session->userdata['sp']->login_name;
		$sqliu[] = "DELETE FROM trx_reg_icd10 WHERE id_reg='".$id_reg."'";
		foreach($id_icd_ten as $k => $v)
		{
			if ($v == "")
				continue;


			if (preg_match('/Z09.8/', $v))
				$mrcase = 1;
			else
				$mrcase = 0;
			
			$is_prime = ($k==0) ? 1 : 0;	
			
			
			$sqliu[] = $test = "	INSERT 	INTO  trx_reg_icd10 
													(trxdate,id_reg,id_type,id_unit,id_dokter,is_prime,age_y,age_m,age_d,id_icd,mrcase,created,creator)
										VALUES
													(now(),'".$id_reg."',".$id_type.",".$id_unit.",".$id_dokter.",".$is_prime.",".$age_y.",".$age_m.",".$age_d.",'".$v."',".$mrcase.",now(),'".$creator."')
								";
			//die('test : '.$test);
			/*
			if($old_id_icd_ten[$k]=='')
			{
				$sqliu[] = "	INSERT 	INTO  trx_reg_icd10 
													(trxdate,id_reg,id_type,id_unit,id_dokter,is_prime,age_y,age_m,age_d,id_icd,mrcase,created,creator)
										VALUES
													(now(),'".$id_reg."',".$id_type.",".$id_unit.",".$id_dokter.",".$is_prime.",".$age_y.",".$age_m.",".$age_d.",'".$v."',".$mrcase.",now(),'".$creator."',now(),'".$creator."')
								";
			}
			else
			{
				$sqliu[] = "	UPDATE trx_reg_icd10
													SET id_icd='".$v."',updated=NOW(),updater='".$creator."'
											WHERE	id_reg='".$id_reg."' AND id_icd='".$old_id_icd_ten[$k]."'
								";
			}
			*/
		}
		
		// ---- PREPARE DATA INSERTION FOR ICD9 ----
		$sqliu[] = "DELETE FROM trx_reg_icd9 WHERE id_reg='".$id_reg."'";
		foreach($id_icd_nine as $k => $v)
		{
			if ($v == "" )
				continue;
			$sqliu[] = "INSERT INTO trx_reg_icd9 
												(trxdate,id_reg,id_type,id_unit,id_dokter,id_icd9cm,created,creator,updated,updater)
									VALUES
												(now(),'".$id_reg."',".$id_type.",".$id_unit.",".$id_dokter.",'".$v."',now(),'".$creator."',now(),'".$creator."')
									";
		}
		/*
		foreach($sqliu as $k => $v)
		{
			echo "sql : ".$v."<br>";
			$ok = $this->dbhis->query($v);
			if($ok==false)
			{
				echo "gagal : ".$v;
				break;
				die();
			}
		}
		echo "ok";
		*/
		## ---- EXECUTE DATA INSERTION ----
		$this->dbhis->trans_begin();
		$ok = true;
		foreach($sqliu as $k => $v)
		{
			$ok = $this->dbhis->query($v);
			if($ok===false) break;
		}
		if($this->dbhis->trans_status()===FALSE || !$ok)
		{
			$this->dbhis->trans_rollback();
			$msg = "Insert/Update Gagal";
		}
		else
		{
			$this->dbhis->trans_commit();
			$msg = "sudah di proses";
		}
		echo $msg;
		
	} /*}}}*/
	
	function get_unit_dokter_by_reg($id_reg) 
	{
		$sql = "SELECT id_unit,id_dokter 
				 FROM trx_reg_unit 
				 WHERE id_reg='".$id_reg."'";
				 //die ($sql);
			
		$result = $this->dbhis->query($sql);
		if($result->num_rows() > 0)
		{
			#$rs 				= $result->fetch_array(MYSQLI_ASSOC);
			$rs 				= $result->result_array();
			$id_unit 		= $rs[0]['id_unit'];
			$id_dokter 	= $rs[0]['id_dokter'];
		}	
		else 
		{
			$id_unit ='null';
			$id_dokter ='null';
		}
			
		return array(
			'id_unit' 	=> $id_unit,
			'id_dokter' => $id_dokter
		);
	}
	
	function get_umur_by_id_reg($id_reg)
	{
		$sql = "SELECT  TIMESTAMPDIFF( YEAR,  a.`birthdate`, now() ) as age_y  ,
										TIMESTAMPDIFF( MONTH, a.`birthdate`, now() ) % 12 as age_m ,
										FLOOR( TIMESTAMPDIFF( DAY, a.`birthdate`, now() ) % 30.4375 ) as age_d  
						FROM 		mst_pasien a, trx_reg b
						WHERE 	a.`id_pasien`=b.id_pasien
										AND b.id_reg='".$id_reg."'";
				#echo "<pre>".$sql."</pre>";
			
		$result = $this->dbhis->query($sql);
		if($result->num_rows() > 0)
		{
			#$rs = $result->fetch_array(MYSQLI_ASSOC);
			$rs = $result->result_array();
			$age_y =$rs[0]['age_y'];
			$age_m =$rs[0]['age_m'];
			$age_d=$rs[0]['age_d'];
		}			
		else 
		{
			$age_y =0;
			$age_m =0;
			$age_d=0;
		}
		
		return array(
			'age_y' => $age_y,
			'age_m' => $age_m,
			'age_d' => $age_d
		);
	}
	
	function get_id_type($id_reg)
	{
		$sql = "		SELECT 		(CASE WHEN a.`rwip`=1 THEN 2
												WHEN a.`rwjn`=1 THEN 1
												WHEN (a.`ugd`=1 AND a.`rwip`=0) THEN 1
												ELSE 0 END
												) AS id_type
								FROM 		trx_reg a 
								WHERE 	a.id_reg='".$id_reg."'";
				#echo "<pre>".$sql."</pre>";
		$result = $this->dbhis->query($sql);
		if($result->num_rows() > 0)
		{
			$row 			= $result->row_array();
			$id_type 	= $row['id_type'];
		}
		else
		{
			$id_type 	= 1;
		}
		return $id_type;
	}

	public function cari_pasien_poli()
	{
		$id_pasien	= $this->input->post('id_pasien');
		$nama_pasien= $this->input->post('nama_pasien');

		$this->make_bread->add('Keperawatan', '', 1);
    $this->make_bread->add('Cari Pasien', '', 0);
    $breadcrumb = $this->make_bread->output();

		if(empty($id_pasien) && empty($nama_pasien))
		{
			$data = array(
			'rs'					=> array(),
			'id_pasien'		=> $id_pasien,
			'nama_pasien' => $nama_pasien,
			'id_fisik'			=> '',
			'jml_stat_fisik'=> '',
			'breadcrumb' 	=> $breadcrumb,
		);

			$this->load->view('vcari_pasien_poli',$data);
		}
		else
		{
			$sql = "SELECT TR.id_reg, DATE(TR.regdate) AS regdate, TR.id_pasien,
							(CASE WHEN TR.rwip THEN 'RWI' WHEN TR.rwjn THEN 'RWJ' WHEN TR.ugd THEN 'UGD' END) AS tipe,
							MU.name AS unit, TRU.id_unit, MP.name AS pasien,
							(CASE
							WHEN TR.rwip THEN TR.id_dokter_prt1
							WHEN TR.rwip=0 AND TR.ugd=1 THEN TR.id_dokter_jaga
							ELSE MD.id_dokter
							END) AS id_dokter,
							(CASE
							WHEN TR.rwip THEN MDR.name
							WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.name
							ELSE MD.name
							END) AS dokter,
							TRK.id_reg_kmr, MK.name AS kelas, TRK.duration, TRK.indate, TRK.outdate,
							(SELECT invdate FROM trx_reg_inv TRI WHERE id_reg=TR.id_reg AND cancel=0 ORDER BY invdate DESC LIMIT 1) AS invdate,
							MC.name AS asuransi,TR.id_dokter_jaga,MDJ2.name AS dokter_igd ,TR.ugd

							FROM trx_reg TR
							LEFT JOIN trx_reg_unit TRU ON TR.id_reg = TRU.id_reg
							LEFT JOIN trx_reg_kmr TRK ON TR.id_reg = TRK.id_reg AND TR.rwip=1
							LEFT JOIN  mst_unit MU ON TRU.id_unit = MU.id_unit
							LEFT JOIN  mst_kelas MK ON TRK.id_kelas = MK.id_kelas
							LEFT JOIN  mst_dokter MD ON TRU.id_dokter = MD.id_dokter
							LEFT JOIN  mst_dokter MDR ON TR.id_dokter_prt1 = MDR.id_dokter
							LEFT JOIN  mst_dokter MDJ ON TR.id_dokter_jaga = MDJ.id_dokter
							LEFT JOIN  mst_company MC ON MC.id_company = TR.id_asuransi
							LEFT JOIN mst_pasien MP ON TR.id_pasien = MP.id_pasien
							LEFT JOIN  mst_dokter MDJ2 ON TR.id_dokter_jaga = MDJ2.id_dokter

							WHERE TR.status<2
							AND (TRU.id_reg IS NULL OR TRU.cancel = 0)
							AND (TRK.id_reg IS NULL OR TRK.cancel = 0)
					";

			if($id_pasien != '')
			$sql.=" AND TR.id_pasien LIKE '%".$id_pasien."%' ";
			if ($nama_pasien != '')
			$sql.=" AND LOWER(MP.name) LIKE LOWER('%".$nama_pasien."%')";
			$sql.="ORDER BY TR.regdate DESC
						LIMIT 100";
			#echo "<pre>".$sql."</pre>";
			$query= $this->dbhis->query($sql);
			$rs 	= $query->result_array();

			foreach($rs as $k => $v)
			{
				$id_reg		= $v['id_reg'];
				$id_dokter		= $v['id_dokter'];
				$cek_fisik= $this->mdl->cek_jml_stat_fisik($id_reg);
				$cek_sukit= $this->mdl->cek_jml_sukit($id_reg, $id_dokter);
				$rs[$k]['cek_fisik'] = $cek_fisik;
				$rs[$k]['cek_sukit'] = $cek_sukit;
			}

			$data = array(
				'rs'					=> $rs,
				'id_pasien'		=> $id_pasien,
				'nama_pasien' => $nama_pasien,
				// 'cek_fisik'		=> $cek_fisik,
				'breadcrumb' 	=> $breadcrumb,
			);
			$this->load->view('vcari_pasien_poli',$data);
		}

	}
	
	
	
	
	
}