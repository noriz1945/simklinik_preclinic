<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function list_reg($limit=NULL, $start = 0, $q = NULL) {
        #$this->db->order_by($this->id, $this->order);
        $sql = "SELECT 	a.*,b.*,b.name AS nama_pasien,c.`name` AS dokter,d.`name` AS asuransi
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
				";
		if($q!=NULL)
		{
			$sql .= " WHERE FALSE ";
			
			$sql .= "	OR LOWER(a.id_pasien) LIKE LOWER('%".$q."%') ";
			$sql .= "	OR LOWER(b.`name`) LIKE LOWER('%".$q."%') ";
			$sql .= "	OR LOWER(a.id_reg) LIKE LOWER('%".$q."%') ";
			}
		$sql .= " 		
						ORDER BY a.regdate DESC LIMIT ".$start.",".$limit."";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_trx_open($id_reg) {
        #$this->db->order_by($this->id, $this->order);
		$sql = "SELECT ax.* FROM (
					SELECT 	a.id_paket as id_trx,a.created as trxdate ,a.`id_reg`,a.`id_paket` as id_reg_act,NULL AS id_dokter
							,0 as price,1 as qty,0 as tuslah, 0 as total
							,CONCAT('<strong>',a.name,' [Rp. ',FORMAT(round(a.price),0,'id_ID'),']','</strong>') AS name
							,null as nakes_1,null as nakes_2,null as nakes_3
							,98 as `id_group`,'PAKET' AS grup,NULL AS `id_subgroup`,NULL AS subgrup
							,(-1) AS `inv_num`, 1 as is_paket, 0 as is_farmasi,'-1' AS id_act
					FROM	trx_reg_paket a
					WHERE 	a.id_reg='".$id_reg."' AND a.`id_inv` IS NULL
					UNION ALL
					SELECT 	a.id_trx,a.`trxdate`,a.`id_reg` ,a.`id_reg_act`,a.`id_dokter`
							,a.`price`,a.`qty`,0 as tuslah,a.`total`
							,(CASE WHEN a.is_paket=1 THEN CONCAT('<strong>','[P] ','</strong>',b.`name`)
							ELSE b.name END) AS name
							,IF(n1.name IS NULL,NULL,CONCAT('<small class=\"text-info\"><i>[',n1.name,']</i></small>')) AS nakes_1
							,IF(n2.name IS NULL,NULL,CONCAT('<small class=\"text-info\"><i>[',n2.name,']</i></small>')) AS nakes_2
							,IF(n3.name IS NULL,NULL,CONCAT('<small class=\"text-info\"><i>[',n3.name,']</i></small>')) AS nakes_3
							,b.`id_group`,c.`name` AS grup,b.`id_subgroup`,d.`name` AS subgrup
							,c.`inv_num`,a.`is_paket`, 0 as farmasi, b.id_act AS id_act
					FROM	trx_reg_act a
						JOIN `mst_tindakan` b ON (b.`id_act`=a.`id_reg_act`)
						LEFT JOIN `mst_tindakan_grup` c ON (c.`id_group`=b.`id_group`)
						LEFT JOIN `mst_tindakan_subgrup` d ON (d.`id_subgroup`=b.`id_subgroup`)
						LEFT JOIN mst_dokter n1 ON (n1.id_dokter=a.id_dokter)
						LEFT JOIN mst_dokter n2 ON (n2.id_dokter=a.id_dokter2)
						LEFT JOIN mst_dokter n3 ON (n3.id_dokter=a.id_dokter3)
					WHERE 	a.id_reg='".$id_reg."' AND a.`id_inv` IS NULL
					UNION ALL
					SELECT 	b.`id_eresep_det` , a.`eresepdate`,a.`id_reg` ,b.`id_trx_det`,a.`id_dokter`
							,b.`harga_satuan`,b.`qty`,b.tuslah,b.`subtotal`
							,(CASE WHEN b.is_paket=1 THEN 
								(CASE WHEN b.is_validasi=0 THEN
										CONCAT('<strong>','[P] ','</strong>',b.`name`,'<strong class=\"text-danger\">[BELUM DIVALIDASI APOTIK]</strong>')
									ELSE
										CONCAT('<strong>','[P] ','</strong>',b.`name`)
								END)
							ELSE b.name END) AS name
							,null as nakes_1,null as nakes_2,null as nakes_3
							,99,'FARMASI' AS grup,NULL AS `id_subgroup`,NULL AS subgrup	
							,99 AS id_num,b.`is_paket`, 1 as is_farmasi, c.id_fa AS id_act
					FROM 	soap_eresep a
							JOIN soap_eresep_det b ON (b.`id_eresep`=a.id_eresep)
							LEFT JOIN `mst_farmalkes` c ON (c.`id_fa`=b.`id_trx_det`)
					WHERE	a.id_reg='".$id_reg."' AND b.`id_inv` IS NULL 
							AND (b.is_validasi=1 OR (b.is_validasi=0 AND b.is_paket=1))
							AND b.status=0
				) ax
				ORDER BY ax.`inv_num`,ax.id_group";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function get_data_reg($id_reg)
    {				
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
				WHERE a.id_reg='".$id_reg."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_new_id_inv()
    {
		$sql = "SELECT CONCAT(a.`pmonth`,DATE_FORMAT(now(), '%y'),'IV',LPAD((a.`ctr`+1),5,'0')) AS new_id_inv
				FROM 	ctr_inv a 
				WHERE 	a.`pyear`=YEAR(CURDATE()) AND a.`pmonth`=MONTH(CURDATE())";
		$query = $this->db->query($sql);
		$result = $query->row();
		$new_id_reg = $result->new_id_inv;
		
		$sql = "UPDATE ctr_inv SET ctr=ctr+1 WHERE `pyear`=YEAR(CURDATE()) AND `pmonth`=MONTH(CURDATE()) ";
		$query = $this->db->query($sql);
		
		return $new_id_reg;
    }
	
	function get_data_inv_header($id_inv)
    {				
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.*
						,(e.`subtotal` - e.`vcdisc_m` + e.`ppn`) as grand_total
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_inv e ON (e.`id_reg`=a.`id_reg`)
				WHERE e.id_inv='".$id_inv."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_data_inv_detail($id_inv)
    {	$sql = "SELECT ax.* FROM (
					SELECT 	a.id_paket as id_trx,a.created as trxdate ,a.`id_reg`,a.`id_paket` as id_reg_act,NULL AS id_dokter
							,0 AS disc_p,0 AS disc_m,0 as tuslah
							,a.price as price,1 as qty, a.price as total
							,CONCAT('<strong>',a.name,'</strong>') AS name
							,98 as `id_group`,'PAKET' AS grup,NULL AS `id_subgroup`,NULL AS subgrup
							,(-1) AS `inv_num`, 1 as is_paket
					FROM	trx_reg_paket a
					WHERE 	a.id_inv='".$id_inv."'
					UNION ALL
					SELECT 	a.id_trx,a.`trxdate`,a.`id_reg` ,a.`id_reg_act`,a.`id_dokter`
							,a.disc_p,a.disc_m,0 as tuslah
							,(CASE WHEN a.is_paket=1 THEN 0
								ELSE a.price END) AS price
							,a.`qty`
							,(CASE WHEN a.is_paket=1 THEN 0
								ELSE a.total END) AS `total`
							,(CASE WHEN a.is_paket=1 THEN CONCAT(' &nbsp; &nbsp; ','<strong>','[P] ','</strong>',b.`name`)
							ELSE b.name END) AS name
							,b.`id_group`,c.`name` AS grup,b.`id_subgroup`,d.`name` AS subgrup
							,c.`inv_num`,a.`is_paket`
					FROM	trx_reg_act a
						JOIN `mst_tindakan` b ON (b.`id_act`=a.`id_reg_act`)
						LEFT JOIN `mst_tindakan_grup` c ON (c.`id_group`=b.`id_group`)
						LEFT JOIN `mst_tindakan_subgrup` d ON (d.`id_subgroup`=b.`id_subgroup`)
					WHERE 	a.id_inv='".$id_inv."'
					UNION ALL
					SELECT 	b.`id_eresep_det` , a.`eresepdate`,a.`id_reg` ,b.`id_trx_det`,a.`id_dokter`
							,b.disc_p,b.disc_m,b.tuslah
							,(CASE WHEN b.is_paket=1 THEN 0
								ELSE b.`harga_satuan` END) AS price
							,b.`qty`
							,(CASE WHEN b.is_paket=1 THEN 0
								ELSE b.`subtotal` END) AS `total`
							,(CASE WHEN b.is_paket=1 THEN CONCAT(' &nbsp; &nbsp; ','<strong>','[P] ','</strong>',b.`name`)
							ELSE b.name END) AS name
							,99,'FARMASI' AS grup,NULL AS `id_subgroup`,NULL AS subgrup	
							,99 AS id_num,b.`is_paket`
					FROM 	soap_eresep a
							JOIN soap_eresep_det b ON (b.`id_eresep`=a.id_eresep)
							LEFT JOIN `mst_farmalkes` c ON (c.`id_fa`=b.`id_trx_det`)
					WHERE	b.id_inv='".$id_inv."'
				) ax
				ORDER BY ax.`inv_num`";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
	
	function get_data_inv_by_id_reg($id_reg)
    {				
		$sql = "SELECT 	e.id_inv,e.invdate
				FROM	trx_reg_inv e
				WHERE 	e.id_reg='".$id_reg."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
	
	function get_data_inv_refund_by_id_reg($id_reg)
    {				
		$sql = "SELECT 	a.id_refund
				FROM	`trx_reg_inv_refund` a, trx_reg_inv e
				WHERE 	a.`id_inv`=e.`id_inv`
						AND e.id_reg='".$id_reg."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
	
	function update($table,$where_id,$id, $data)
    {
        $this->db->where($where_id, $id);
        $this->db->update($table, $data);
    }
	
	// insert data
    function insert($table,$data)
    {
        $this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();

		return  $insert_id;
    }
    
    ////////////////////////////////////////////////////////////////28112023
	function get_data_total_inv($id_inv)
    {	$sql = "SELECT SUM(ax.total) AS total FROM (
					SELECT 	a.id_trx,a.`trxdate`,a.`id_reg` ,a.`id_reg_act`,a.`id_dokter`,a.`price`,a.`qty`,a.`total`
							,b.`name`,b.`id_group`,c.`name` AS grup,b.`id_subgroup`,d.`name` AS subgrup
							,c.`inv_num`
					FROM	trx_reg_act a
						JOIN `mst_tindakan` b ON (b.`id_act`=a.`id_reg_act`)
						LEFT JOIN `mst_tindakan_grup` c ON (c.`id_group`=b.`id_group`)
						LEFT JOIN `mst_tindakan_subgrup` d ON (d.`id_subgroup`=b.`id_subgroup`)
					WHERE 	a.id_inv='".$id_inv."'
					UNION ALL
					SELECT 	b.`id_eresep_det` , a.`eresepdate`,a.`id_reg` ,b.`id_trx_det`,a.`id_dokter`,b.`harga_satuan`,b.`qty`,b.`subtotal`
							,b.`name`,99,'FARMASI' AS grup,NULL AS `id_subgroup`,NULL AS subgrup	
							,99 AS inv_num
					FROM 	soap_eresep a
							JOIN soap_eresep_det b ON (b.`id_eresep`=a.id_eresep)
							LEFT JOIN `mst_farmalkes` c ON (c.`id_fa`=b.`id_trx_det`)
					WHERE	b.id_inv='".$id_inv."'
				) ax
				ORDER BY ax.`inv_num`";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }

	function get_data_userdata($user_set, $pass_set){
		$query=$this->db->query("SELECT * FROM mst_nav_user WHERE login_name='$user_set' AND login_pass='$pass_set'");
		return $query->row(); 
	  }

	  function update_data_refund($reg,$id_inv,$total_tagihan,$refund_aktif,$refund_created,$refund_created_by){
		$query=$this->db->query("UPDATE trx_reg SET refund_aktif=$refund_aktif,refund_total='$total_tagihan',refund_id_inv='$id_inv',refund_created='$refund_created',refund_created_by='$refund_created_by' WHERE id_reg='$reg'");
	  }
	////////////////////////////////////////////////////////////////END 28112023
	
			//KARTU STOK
	function cdk_kartu_stok(){
		$query=$this->db->query("SELECT id_kode FROM gdf_kartu_stok WHERE kode='RSP' ORDER BY created DESC limit 1");
		return $query->row();
	}

	function get_data_obat_per_inv($new_id_inv){
		$query=$this->db->query("SELECT 
		a.id_trx_det AS id_obat,a.name AS nama_obat,a.qty,a.harga_satuan AS harga, a.subtotal AS jumlah ,('Non Racikan') AS tipe,a.created,a.created_by,a.set_depo
		FROM soap_eresep_det a 
		LEFT JOIN soap_eresep_det_racikan b ON a.id_eresep_det=b.id_eresep_det_racikan
		WHERE a.id_inv='$new_id_inv' AND a.is_racikan='0' AND a.is_validasi='1'
		UNION ALL
		SELECT 
		a.id_trx_det AS id_obat,a.name AS nama_obat,a.qty,a.harga_satuan AS harga, a.subtotal AS jumlah ,('Racikan') AS tipe,b.created,b.created_by,b.set_depo
		FROM soap_eresep_det_racikan a
		LEFT JOIN soap_eresep_det b ON a.id_eresep_det=b.id_eresep_det
		WHERE b.id_inv='$new_id_inv' AND b.is_racikan='1' AND b.is_validasi='1'");
		return $query->result();
	}

	function get_data_obat_per_depot($id_obat,$set_depo){
		$query=$this->db->query("SELECT * FROM mst_soh WHERE id_soh='$id_obat' AND id_wrh='$set_depo'");
		return $query->row();
	}

	function ins1($datains,$table){
		$this->db->insert($table,$datains);
	}

	function ins2($datains,$table){
		$this->db->insert($table,$datains);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	//END KARTU STOK
	
	public function add_to_log($data_log){
		$this->db->insert('log_activity', $data_log);
	}
	
	function get_data_dp_by_id_reg($id_reg)
    {				
		$sql = "SELECT 	a.*
				FROM 	trx_reg_dp a
				WHERE	a.id_reg='".$id_reg."'
						AND (a.id_inv IS NULL OR (a.ret=1 AND a.id_inv IS NOT NULL))
				ORDER BY a.id_trx";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
	
	function get_data_trx_vcr_disc($kode_vcr)
	{
		$query = $this->db->query("SELECT * FROM trx_vcr_disc a WHERE a.kode_vcr='".$kode_vcr."'");
		return $query->row();
	}
}
?>