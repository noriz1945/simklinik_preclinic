<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Op_order_model extends CI_Model
{
  function __construct(){
    parent::__construct();
  }

  function get_data_poli() {
		$sql = "SELECT  a.* FROM mst_unit a ";    
    $query  = $this->dbhis->query($sql);
    $rs     = $query->row_array();
    return $rs;
  }

  function get_data_registrasi_by_id_reg($id_reg)
    {
        $sql = "SELECT  TR.`id_reg`, TR.`regdate`,
                MP.`id_pasien`, CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien,
                MP.`birthplace`, DATE_FORMAT(MP.`birthdate`, '%d-%m-%Y') AS tgl_lahir,
                YEAR(curdate()) - YEAR(MP.birthdate) AS umur1,
                CONCAT(TIMESTAMPDIFF( YEAR, MP.birthdate, now() ),' thn ',
                TIMESTAMPDIFF( MONTH, MP.birthdate, now() ) % 12 ,' bln ',
                FLOOR( TIMESTAMPDIFF( DAY, MP.birthdate, now() ) % 30.4375 ),' hr ') AS umur2,
                CASE WHEN MP.`gender` = 0 THEN 'Laki-Laki' ELSE 'Perempuan' END AS gender1,
                CASE WHEN MP.`gender` = 0 THEN 'L' ELSE 'P' END AS gender2,
                MP.`address` AS alamat, MC.`name` AS asuransi,
                TRU.id_unit, TR.`id_asuransi`, MP.hp, MP.telp, 
                MPJ.`name` AS job, MPM.`name` AS status, MPD.`name` AS pendidikan, 
                MA.`name` AS agama, MP.`id_nation`, MN.`name` AS kebangsaan,
                IFNULL(TRU.`id_dokter`, TR.id_dokter_jaga) AS id_dokter,
                IFNULL(MU.`name`, 'IGD') AS poli_ruangan,
                IFNULL(MD.`name`, MD1.`name`) AS dokter,
                CASE WHEN TR.`rwjn` = 1 THEN '1' ELSE '3' END AS id_type
                                                        
                FROM    trx_reg TR
                LEFT JOIN `mst_pasien` MP ON TR.`id_pasien` = MP.`id_pasien`
                LEFT JOIN `mst_company` MC ON TR.`id_asuransi` = MC.`id_company`
                LEFT JOIN `trx_reg_unit` TRU ON TR.`id_reg` = TRU.`id_reg`
                LEFT JOIN `mst_unit` MU ON TRU.`id_unit` = MU.`id_unit`
                LEFT JOIN `mst_dokter` MD ON TRU.`id_dokter` = MD.`id_dokter`
                LEFT JOIN `mst_dokter` MD1 ON TR.id_dokter_jaga = MD1.`id_dokter`
                LEFT JOIN `mst_pasien_title` MPT ON MP.`id_social` = MPT.`id_social`
                LEFT JOIN `mst_pasien_job` MPJ ON MP.`id_job` = MPJ.`id_job` 
                LEFT JOIN `mst_pasien_mar` MPM ON MP.`id_mar` = MPM.`id_mar` 
                LEFT JOIN `mst_pendidikan` MPD ON MP.`id_pend` = MPD.`id_pend` 
                LEFT JOIN `mst_agama` MA ON MP.`id_agama` = MA.`id_agama` 
                LEFT JOIN `mst_nation` MN ON MP.`id_nation` = MN.`id_nation`
                                        
                WHERE   TR.id_reg = '".$id_reg."'
                ";
                        
        $query  = $this->dbhis->query($sql);
        $rs     = $query->row_array();
        return $rs;
    }

    function id_pendaftaran_id($id_reg)
    {
        $sql = "SELECT  * FROM `emolen_transaksi_pendaftaran`  WHERE  `no_rekam_medis` = '$id_reg'";
        $query  = $this->dbsupp->query($sql);
        $rs     = $query->row_array();
        return $rs;
    }


    function insert_reg_op($data,$table){
			$this->dbsupp->insert($table,$data);
    }
    
    function insert_konsul_op($data,$table){
			$this->dbsupp->insert($table,$data);
		}
  
  
    function delete_konsultasi_id_kosong($id_pend){
      $this->db->where('id_pendaftaran', $id_pend);
      $this->db->delete('emolen_transaksi_konsultasi');   
      }

      function delete_op_id($id_pend){
        $this->dbsupp->where('id_pendaftaran', $id_pend);
        $this->dbsupp->delete('emolen_transaksi_pendaftaran');   
      }

    function list_order_operasi($id_pasien)
	{
   
	 $query=$this->db->query("SELECT * FROM `emolen_transaksi_pendaftaran`  WHERE `id_pasien`='$id_pasien'"); 
	 return $query;
	}
}