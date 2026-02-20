<?php
class D_Soap extends ci_model
{
  function mpasien($set_tanggalnya,$set_search_keyword){
    $query=$this->db->query("SELECT b.name AS nama_pasien,b.birthdate,a.*,c.name AS nama_dokter,d.name AS asuransi FROM trx_reg a 
    LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien  
    LEFT JOIN mst_dokter c ON a.id_dokter_prt1=c.id_dokter
    LEFT JOIN mst_company d ON a.id_asuransi=d.id_company
    WHERE a.iostatus='0' AND a.is_reg_aps='0' $set_tanggalnya $set_search_keyword ORDER BY a.regdate DESC");
    return $query->result();
  }
  function mpasien_dokter($id_dokter,$set_tanggalnya,$set_search_keyword){
    $query=$this->db->query("SELECT b.name AS nama_pasien,b.birthdate,a.*,c.name AS nama_dokter,d.name AS asuransi FROM trx_reg a 
    LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien  
    LEFT JOIN mst_dokter c ON a.id_dokter_prt1=c.id_dokter
    LEFT JOIN mst_company d ON a.id_asuransi=d.id_company
    WHERE a.iostatus='0' AND a.id_dokter_prt1 = '$id_dokter' $set_tanggalnya $set_search_keyword ORDER BY a.regdate DESC");
    return $query->result();
  }
  /// 
    //LAST CPPT
    function get_data_cppt($id_pasien)
    {
      $sql = "SELECT  a.* FROM soap_asm_ri a WHERE a.kategori='CPPT' AND a.id_pasien = '$id_pasien' ORDER BY a.asmri_date DESC";
      //echo "<pre>".$sql."</pre>";
      $query  = $this->db->query($sql);
      $result = $query->result_array();
      return $result;
    }
    //END LAST CPPT
    //LAST CPPT
    function get_detail_cppt($id_asmri)
    {
      $sql = "SELECT a.* FROM soap_asm_ri a WHERE a.kategori='CPPT' AND a.id_asmri = '$id_asmri'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    //END LAST CPPT
    function data_pasien_ranap($id_reg)
    {
      $sql ="SELECT TR.id_reg,TR.id_pasien, CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien, '' AS umur, (CASE MP.gender WHEN 1 THEN 'Laki-Laki' WHEN 2 THEN 'Perempuan' END) AS gender, MP.birthdate,DATE_FORMAT(MP.`birthdate`, '%d-%m-%Y') AS tgl_lahir,YEAR(curdate()) - YEAR(MP.birthdate) AS umur1,
      CONCAT(TIMESTAMPDIFF( YEAR, MP.birthdate, now() ),' thn ',
      TIMESTAMPDIFF( MONTH, MP.birthdate, now() ) % 12 ,' bln ',
      FLOOR( TIMESTAMPDIFF( DAY, MP.birthdate, now() ) % 30.4375 ),' hr ') AS umur2
       FROM trx_reg TR
       LEFT JOIN mst_pasien MP ON TR.id_pasien  = MP.id_pasien
            LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
            WHERE
          TR.id_reg= '".$id_reg."'
            ";
      $query  = $this->db->query($sql);
      $result = $query->row_array();
      return $result;
    }
  /////////////////////////SMARTPLUS SECTION
	public function add_data_asm_ranap($data)
  {
    $this->db->insert('soap_asm_ri', $data);
  }
	function get_data_asm_ri_dokter($id_reg)
  {
    $sql = "SELECT  a.*
            FROM    soap_asm_ri a
            WHERE   a.id_reg = '".$id_reg."'
										AND a.kategori='ASM' AND jenis_asm='DOKTER'
										ORDER BY a.asmri_date DESC
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->db->query($sql);
    $row = $query->row_array();
    return $row;
  }
	public function edit_data_asm_ranap($where, $data)
  {
    $this->db->update('soap_asm_ri', $data, $where);
    return $this->db->affected_rows();
  }
  public function delete_asm_ranap($id_asmri)
  {
    $this->db->where('id_asmri', $id_asmri);
    $this->db->delete('soap_asm_ri');
  }
    //tindakan
    function fnddatadokter($id_reg){
      $query=$this->db->query("SELECT id_dokter_prt1 FROM trx_reg WHERE id_reg='$id_reg'");
      return $query->row();
    }
    function get_data_foto_after($id_pasien,$id_reg,$id_cppt){
      $query=$this->db->query("SELECT * FROM upload_foto_befaft WHERE tipe=1 AND id_pasien='$id_pasien' AND id_reg='$id_reg' AND id_set_cppt='$id_cppt' AND aktif=0 ORDER BY tipe,created DESC");
      return $query->result();
    }
    function get_data_foto_before($id_pasien,$id_reg,$id_cppt){
      $query=$this->db->query("SELECT * FROM upload_foto_befaft WHERE tipe=2 AND id_pasien='$id_pasien' AND id_reg='$id_reg' AND id_set_cppt='$id_cppt' AND aktif=0 ORDER BY tipe,created DESC");
      return $query->result();
    }
    function createregact($data_trx_reg_act,$table){
      $this->db->insert($table,$data_trx_reg_act);
    }
    function createrowupload($data_upfile,$table){
      $this->db->insert($table,$data_upfile);
    }
    //end tindakan
    public function add_to_log($data_log){
      $this->db->insert('log_activity', $data_log);
  }
    function update_data($where,$data,$table){
      $this->db->where($where);
      $this->db->update($table,$data);
    }
    function update_data2($where,$data,$table){
      $this->db->where($where);
      $this->db->update($table,$data);
    }	

    function set_delete_list($id){
      $this->db->query("UPDATE upload_foto_befaft SET aktif='1' WHERE id='$id'");
    }
    
    function mst_dokter(){
      $query=$this->db->query("SELECT a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
      FROM 	mst_dokter a
      LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
      ORDER BY a.name");
      return $query->result();
    }
    
        function riwayattindakan($id_reg){
      $query=$this->db->query("SELECT a.id_act,a.name,a.price AS harga,aa.qty,a.id_group,b.name AS namegrup,c.name AS namesubgrup 
      FROM trx_reg_act aa
      LEFT JOIN mst_tindakan a ON aa.id_reg_act=a.id_act  
      LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
      LEFT JOIN mst_tindakan_subgrup c ON a.id_subgroup=c.id_subgroup 
      WHERE aa.id_reg='$id_reg' AND a.id_group <> 1");
      return $query->result();
    }

} 
?>