<?php
defined('BASEPATH') or exit('No direct script access allowed');
class bill_generator {
	
	var $db;
	var $dbsupp;
	var $db2;
	var $dbhis;
	var $bill;
	var $today;
	var $today_timestamp;
	var $config;
	var $id_ppk;
	
	public function __construct()
	{
		$CI =& get_instance();
		$this->config = $CI->config;
		
		$this->db = $CI->dbsupp;
		$this->dbsupp = $CI->dbsupp;
		
		$this->db2 = $CI->dbhis;
		$this->dbhis = $CI->dbhis;
	
		#$this->bill = $this;
		
		date_default_timezone_set('Asia/Jakarta'); 
		$this->today = date("Y-m-d");
		$this->today_timestamp = date("Y-m-d H:i:s"); 
		$this->id_ppk = $this->config->item('apem_id_ppk');
		
		if($this->config->item('apem_debug'))
		{
			$this->db->db_verbose = true;
			$this->db2->db_verbose = true;
			$this->dbsupp->db_verbose = true;
			$this->dbhis->db_verbose = true;
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		}
	}
	
	function get_item_admin_reg($id_comp='')
	{	
		$sql= "	SELECT 	a.`id_act`,a.name,b.`price`,a.id_group
						FROM 		mst_tindakan a, `mst_tindakan_prc` b
						WHERE 	a.`id_act`=b.`id_act`
										AND b.`id_comp`='".$id_comp."' 
										AND b.`id_kelas`='-1'
										AND UPPER(a.name)='REGISTRASI'";
		$query = $this->db2->query($sql);
		$rs = $query->row_array();
		
		$data = array(
			'id_act'  	=> $rs['id_act'],
			'name' 		 	=> $rs['name'],
			'price' 		=> $rs['price'],
			'id_group' 	=> $rs['id_group'],
		);
		return $data;
	}
	
	function get_item_konsultasi_dokter($id_comp='',$id_dokter,$bookdate)
	{
		$sql = " 
		SELECT 
						IFNULL(
						(SELECT MV.id_act FROM mst_dokter_srv AS MV 
						WHERE MV.id_daytype = IF(DAYOFWEEK(DATE('".$bookdate."')) = 1,2,1) 
						AND MV.id_dokter=MD.`id_dokter`)
						,
						(SELECT MV.id_act FROM mst_dokter_srv MV, mst_tindakan MT
						WHERE MV.id_daytype = IF(DAYOFWEEK(DATE('".$bookdate."')) = 1,2,1) 
						AND  MV.id_jenis=MD.`id_jenis`
						AND MV.`id_act`=MT.`id_act` AND MT.`price`>0)
						) AS id_act
		FROM mst_dokter MD WHERE MD.`id_dokter`='".$id_dokter."'
		LIMIT 0,1	
		";
		#echo "<pre>".$sql."</pre><br>";
		$query = $this->db2->query($sql);
		$rs = $query->row_array();
		$id_act = $rs['id_act'];
		
		$sql= "	SELECT 	a.`id_act`,b.`name`,a.`price`,b.id_group
						FROM 		`mst_tindakan_prc` a,`mst_tindakan` b
						WHERE 	a.`id_act`=b.`id_act`
										AND a.`id_act`='".$id_act."' 
										AND a.`id_comp`='".$id_comp."' 
										AND a.`id_kelas`=-1";
		$query = $this->dbhis->query($sql);
		$rs = $query->row_array();
		
		$data = array(
			'id_act'  	=> $rs['id_act'],
			'name' 		 	=> $rs['name'],
			'price' 		=> $rs['price'],
			'id_group' 	=> $rs['id_group'],
		);
		return $data;
	} 
	
	function get_addtional_id_act($id_comp='',$id_unit,$id_act='')
	{
		if($id_act=='')
		{
			### KETERANGAN.. nama table memang berbau bpjs.. tapi itu berlaku untuk pasien non bpjs jugaaa...
			$sql   = "SELECT a.`addtional_id_act` FROM mapping_poli_bpjs a WHERE  a.`id_unit` ='".$id_unit."'";
			$query = $this->dbsupp->query($sql);
			$rs = $query->row_array();
			if(isset($rs['addtional_id_act']))
				$id_act = $rs['addtional_id_act'];
		}
		
		if($id_act!='')
		{			
			#$id_act = $rs['addtional_id_act'];
			/*
			$sql = "SELECT 	a.`id_act`,b.`name`,a.`price`,b.`id_group` 
							FROM 		`mst_tindakan_prc` a,`mst_tindakan` b
							WHERE 	a.`id_act`=b.`id_act`
											AND a.`id_act`='".$id_act."' 
											AND a.`id_comp`='".$id_comp."' 
											AND a.`id_kelas`=-1
											";
			*/
			$sql = "SELECT 	b.`id_act`,b.`name`,b.`id_group`
											,COALESCE(a.`price`,0) AS price
							FROM 		`mst_tindakan` b
											LEFT JOIN `mst_tindakan_prc` a ON (a.`id_act`=b.`id_act` AND a.`id_comp`='".$id_comp."' AND a.`id_kelas`='-1')
							WHERE 	b.`id_act`='".$id_act."' 
							LIMIT 1";
							
			$query 	= $this->dbhis->query($sql);
			$rs 		= $query->row_array();
			
			$id_act 	= $rs['id_act'];
			$name 		= $rs['name'];
			$price 		= $rs['price'];
			$id_group = $rs['id_group'];
		}
		else
		{
			$id_act 	= '';
			$name 		= '';
			$price 		= '';
			$id_group = '';
		}
		
		$data = array(
			'id_act'  	=> $id_act,
			'name' 		 	=> $name,
			'price' 		=> $price,
			'id_group' 	=> $id_group,
		);
		
		return $data;
	}
	
	function check_id_comp_booking($ket_janji)
	{
		$sql 		= "SELECT a.`id_comp_bpjs`,a.`id_comp_inh` FROM `mst_main_setting` a";
		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();
		$id_comp_bpjs 		= $rs['id_comp_bpjs'];
		$id_comp_inhealth = $rs['id_comp_inh'];

		### 6.1. cek apakah inhealth/perusahaan/umum ---------------------------------------
		$delimiter_keterangan = '/';
		$ket_janji = explode($delimiter_keterangan,$ket_janji);
		$ket_janji = array_map('strtoupper', $ket_janji);

		$id_comp = ''; ## init val bray. '' means umum/tunai
		#### CHECK IS INHEALTH ####
		$arr_desc_inhealth = array('inhealth','inhealt','inheal','inhea','inheat','in health','in healt','in heal','in heath','in heat','in hea');
		$arr_desc_inhealth = array_map('strtoupper', $arr_desc_inhealth);
		foreach($arr_desc_inhealth as $k => $v)
		{
			if(in_array($v,$ket_janji))
			{
				$id_comp = $id_comp_inhealth;
				break;
			}
		}
		#### CHECK IS BPJS ####
		$arr_desc_bpjs = array('bpjs');
		$arr_desc_bpjs = array_map('strtoupper', $arr_desc_bpjs);
		foreach($arr_desc_bpjs as $k => $v)
		{
			if(in_array($v,$ket_janji))
			{
				$id_comp = $id_comp_bpjs;
				break;
			}
		}
		
		return $id_comp;	
	}
	
	function check_id_comp_booking_level_2($ket_janji)
	{
		#echo $ket_janji."<br><br>";
		$sql 		= "SELECT a.`id_comp_bpjs`,a.`id_comp_inh` FROM `mst_main_setting` a";
		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();
		$id_comp_bpjs 		= $rs['id_comp_bpjs'];
		$id_comp_inhealth = $rs['id_comp_inh'];

		### 6.1. cek apakah inhealth/perusahaan/umum ---------------------------------------
		$delimiter_keterangan = '/';
		$ket_janji = explode($delimiter_keterangan,$ket_janji);
		$ket_janji = array_map('strtoupper', $ket_janji);
		$ket_janji = array_map('trim', $ket_janji);
		#print_r($ket_janji);
		
		$id_comp = ''; ## init val bray. '' means umum/tunai
		$comp_type = 'tunai';
		#### CHECK IS INHEALTH ####
		$arr_desc_inhealth = array('inhealth','inhealt','inheal','inhea','inheat','in health','in healt','in heal','in heath','in heat','in hea');
		$arr_desc_inhealth = array_map('strtoupper', $arr_desc_inhealth);
		foreach($arr_desc_inhealth as $k => $v)
		{
			if(in_array($v,$ket_janji))
			{
				$id_comp = $id_comp_inhealth;
				$comp_type = 'inhealth';
				break;
			}
		}
		#### CHECK IS BPJS ####
		$arr_desc_bpjs = array('bpjs','sms bpjs');
		$arr_desc_bpjs = array_map('strtoupper', $arr_desc_bpjs);
		foreach($arr_desc_bpjs as $k => $v)
		{
			$v = trim($v);
			#echo $v."<br>";
			#print_r($ket_janji);
			if(in_array($v,$ket_janji))
			{
				$id_comp = $id_comp_bpjs;
				$comp_type = 'bpjs';
				break;
			}
		}
		#### CHECK IS BPJS ####
		$arr_desc_ass = array('ass','asuransi','admedika');
		$arr_desc_ass = array_map('strtoupper', $arr_desc_ass);
		foreach($arr_desc_ass as $k => $v)
		{
			if(in_array($v,$ket_janji))
			{
				$id_comp = $id_comp;
				$comp_type = 'asuransi';
				break;
			}
		}
		
		$data = array(
			'id_comp'		=> $id_comp,
			'comp_type'	=> $comp_type,
		);
		
		return $data;
	}

	function cek_paid($order_id)
	{
		$url = 'https://sariasihgroup.com/kasir_online/billing/cek_paid/'.$order_id;
		$ko_response = file_get_contents($url);
		
		$respon = json_decode($ko_response);
		#echo $respon->status_code;
		/*
		if($respon->status_code=='404')
		{
			//belum bayar
		}
		else
		{
			redirect('payment/lihat_invoice/'.$order_id);
		}
		*/
		return $respon;
	}
	
	
}
?>