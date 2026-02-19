<?php
class D_Soap extends ci_model
{

  function mpasien(){
    $query=$this->db->query("SELECT b.name AS nama_pasien,a.* FROM trx_reg a LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien  WHERE a.iostatus='0' ");
    return $query->result();
  }

  function magama(){
    $query=$this->db->query("SELECT * FROM mst_agama ORDER BY name ASC");
    return $query->result();
  }

  function mpendidikan(){
    $query=$this->db->query("SELECT * FROM mst_pendidikan ORDER BY name ASC");
    return $query->result();
  }

  function mstatus(){
    $query=$this->db->query("SELECT * FROM mst_status ORDER BY name ASC");
    return $query->result();
  }

  function mpekerjaan(){
    $query=$this->db->query("SELECT * FROM mst_pekerjaan ORDER BY name ASC");
    return $query->result();
  }

  function mhubkel(){
    $query=$this->db->query("SELECT * FROM mst_hubkel ORDER BY name ASC");
    return $query->result();
  }

  ///
  function mstwajibberibadah(){
    $query=$this->db->query("SELECT * FROM mst_wajibibadah ORDER BY name ASC");
    return $query->result();
  }
  function mstthaharoh(){
    $query=$this->db->query("SELECT * FROM mst_thaharoh ORDER BY name ASC");
    return $query->result();
  }
  function mstsholat(){
    $query=$this->db->query("SELECT * FROM mst_sholat ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_kepala(){
    $query=$this->db->query("SELECT * FROM mst_kepala ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_rambut(){
    $query=$this->db->query("SELECT * FROM mst_rambut ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_wajah(){
    $query=$this->db->query("SELECT * FROM mst_wajah ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_mata(){
    $query=$this->db->query("SELECT * FROM mst_mata ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_gigi(){
    $query=$this->db->query("SELECT * FROM mst_gigi ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_tenggorokan(){
    $query=$this->db->query("SELECT * FROM mst_tenggorokan ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_lidah(){
    $query=$this->db->query("SELECT * FROM mst_lidah ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_leher(){
    $query=$this->db->query("SELECT * FROM mst_leher ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_abdomen(){
    $query=$this->db->query("SELECT * FROM mst_abdomen ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_dada(){
    $query=$this->db->query("SELECT * FROM mst_dada ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_respirasi(){
    $query=$this->db->query("SELECT * FROM mst_respirasi ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_jantung(){
    $query=$this->db->query("SELECT * FROM mst_jantung ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_integumen(){
    $query=$this->db->query("SELECT * FROM mst_integumen ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_ekstremitas(){
    $query=$this->db->query("SELECT * FROM mst_ekstremitas ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_genetalia(){
    $query=$this->db->query("SELECT * FROM mst_genitalia ORDER BY name ASC");
    return $query->result();
  }
  function mstpu_elimitas(){
    $query=$this->db->query("SELECT * FROM mst_eliminiasi ORDER BY name ASC");
    return $query->result();
  }
  function mstpengaruh_nyeri(){
    $query=$this->db->query("SELECT * FROM mst_nyeri ORDER BY name ASC");
    return $query->result();
  }

  function setdatatrx($id_reg_set){
    $query=$this->db->query("SELECT a.id_reg AS idregset,b.* FROM trx_reg a LEFT JOIN soap_asm_ri b ON a.id_reg=b.id_reg WHERE a.id_reg='$id_reg_set'  ORDER BY created");
    return $query->result();
  }

  function setdatasoap($id_reg_set){
    $query=$this->db->query("SELECT * FROM soap_asm_ri WHERE id_reg='$id_reg_set'");
    //$query=$this->db->query("SELECT * FROM soap_asm_ri a LEFT JOIN soap_cppt b ON a.id_reg=b.id_reg WHERE a.id_reg='$id_reg_set'");
    return $query->result();
  }

  function setdatasoapedit($id_reg_set, $id_asm_ri){
    $query=$this->db->query("SELECT * FROM soap_asm_ri WHERE id_asmri='$id_asm_ri'");
    //$query=$this->db->query("SELECT * FROM soap_asm_ri a LEFT JOIN soap_cppt b ON a.id_reg=b.id_reg WHERE a.id_reg='$id_reg_set'");
    return $query->result();
  }


  function checkasmrinya($id_reg_set){
    $query=$this->db->query("SELECT COUNT(id_asmri) AS fnddata, id_asmri FROM soap_asm_ri WHERE id_reg='$id_reg_set'");
    return $query->row();
  }

  function createregasmri($data_trx_reg_asmri,$table){
    $this->db->insert($table,$data_trx_reg_asmri);

    function updateregasmri($where,$data,$table){
      $this->db->where($where);
      $this->db->update($table,$data);
    }	
  }

  //ASSESMENT AWAL
  function get_data_asm($id_reg)
  {
    $sql = "SELECT  a.*, b.name AS ppa
            FROM    soap_asm_ri a
            LEFT JOIN smart_login b ON a.creator = b.login_name
            WHERE  a.kategori='ASM' AND a.id_reg = '".$id_reg."'
            ORDER BY a.asmri_date DESC
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }
  //END ASSESMENT AWAL

  //LAST CPPT
  function get_data_cppt($id_reg)
  {
    $sql = "SELECT  a.*, b.name AS ppa FROM soap_asm_ri a LEFT JOIN smart_login b ON a.creator = b.login_name WHERE a.kategori='CPPT' AND a.id_reg = '$id_reg' ORDER BY a.asmri_date DESC";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }
  //END LAST CPPT
  

  /////////////////////////SMARTPLUS SECTION
  function bed_status()
  {
    $sql ="SELECT MK.id_kamar, MK.description, MKB.id_bed, IFNULL(MKLR.name, MKL.name) AS kelas,
          TRK.id_reg, CONCAT(MP.Name,IFNULL(CONCAT(', ',MPT.abbr),'')) as name, MP.id_pasien,
          TRK.indate, MP.gender, MP.birthdate, MP.birthdate AS age, MA.name AS agama
					-- ,get_los_reg(TRK.id_reg) AS los
					, IFNULL(MI.name, TR.diag) AS diagnosa,
          MD.name AS dokter, MC.name AS company,
          (CASE WHEN TR.rwjn=1 THEN 'RJ' WHEN TR.ugd=1 THEN 'GD' END) AS src,
          MP.address, MK.price, MK.id_kelas, MKB.id_status

          FROM mst_kamar MK
          LEFT JOIN mst_kamar_bed MKB ON MK.id_kamar=MKB.id_kamar
          LEFT JOIN mst_kelas MKL ON MK.id_kelas=MKL.id_kelas
          LEFT JOIN trx_reg_kmr TRK ON TRK.id_trx=MKB.id_trx
          LEFT JOIN trx_reg TR ON TR.id_reg=TRK.id_reg
          LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
          LEFT JOIN mst_kelas MKLR ON TR.id_kelas=MKLR.id_kelas
          LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
          LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
          LEFT JOIN mst_dokter MD ON TR.id_dokter_prt1=MD.id_dokter
          LEFT JOIN mst_icd MI ON TR.id_icd=MI.id_icd
          LEFT JOIN mst_agama MA ON MA.id_agama=MP.id_agama

          WHERE MK.aktif=1
          ORDER BY MK.id_kamar
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;

  }

  function list_pasien_ranap()
  {
    $sql ="SELECT MK.id_kamar, MK.description, MKB.id_bed,
          IFNULL(MKLR.name, MKL.name) AS kelas, IFNULL(MI.name, TR.diag) AS diagnosa,
          TRK.indate, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
          '' AS umur , YEAR(curdate()) - YEAR(MP.birthdate) AS umur1
					-- , get_los_reg(TRK.id_reg) AS los
					,CONCAT(MP.Name,IFNULL(CONCAT(', ',MPT.abbr),'')) as name,
          MD.name AS dokter, MC.name AS company, TRK.id_reg,
          (CASE WHEN TR.rwjn=1 THEN 'RJ' WHEN TR.ugd=1 THEN 'GD' END) AS src,
          MP.id_pasien, MP.address, MP.birthdate

          FROM mst_kamar MK
          LEFT JOIN mst_kamar_bed MKB ON MK.id_kamar=MKB.id_kamar
          LEFT JOIN mst_kelas MKL ON MK.id_kelas=MKL.id_kelas
          LEFT JOIN trx_reg_kmr TRK ON TRK.id_trx=MKB.id_trx
          LEFT JOIN trx_reg TR ON TR.id_reg=TRK.id_reg
          LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
          LEFT JOIN mst_kelas MKLR ON TR.id_kelas=MKLR.id_kelas
          LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
          LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
          LEFT JOIN mst_dokter MD ON TR.id_dokter_prt1=MD.id_dokter
          LEFT JOIN mst_icd MI ON TR.id_icd=MI.id_icd
          WHERE MK.aktif=1
          AND (MKB.id_status=2)
          ORDER BY MK.id_kamar
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;

  }

  function data_pasien_ranap($id_reg)
  {
    $sql ="SELECT 	TR.id_reg, MP.pid_num, TR.id_pasien, CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien,
					'' AS umur, (CASE MP.gender WHEN 0 THEN 'Laki-Laki' WHEN 1 THEN 'Perempuan' END) AS gender,
					TL.id_kmr_from, TL.id_bed_from, MKF.name AS kelas_from, TR.regdate,
					TL.indate, TL.id_reg_kmr AS no_kamar, TL.id_bed,
					MKM.`description` AS kamar, MK.name AS kelas, TR.id_icd, MD.name AS dokter, MD.id_dokter,
					TR.penanggung, MC.name AS company, MP.birthdate,
					MIN(DATE(TL.`indate`)) AS tgl_masuk, MAX(DATE(TL.`outdate`)) AS tgl_keluar,
          MP.address, DATE_FORMAT(MP.`birthdate`, '%d-%m-%Y') AS tgl_lahir,
          YEAR(curdate()) - YEAR(MP.birthdate) AS umur1,
          CONCAT(TIMESTAMPDIFF( YEAR, MP.birthdate, now() ),' thn ',
          TIMESTAMPDIFF( MONTH, MP.birthdate, now() ) % 12 ,' bln ',
          FLOOR( TIMESTAMPDIFF( DAY, MP.birthdate, now() ) % 30.4375 ),' hr ') AS umur2
				FROM (
					SELECT 	MM.id_reg,
						IF(NULL=MM.id_reg, CAST(NULL AS char), NULL) AS id_kmr_from,
						(NULL=MM.id_reg_kmr) AS kmr_tmp,
						IF(NULL=MM.id_reg, CAST(NULL AS char), NULL) AS id_bed_from,
						(NULL=MM.id_bed) AS bed_tmp,
						IF(NULL=MM.id_reg, CAST(NULL AS unsigned), NULL) AS id_kelas_from,
						(NULL=MM.id_kelas) AS kelas_tmp,
						IF(NULL=MM.id_reg, NULL, NULL=MM.id_reg) AS reg_tmp,
						MM.indate, MM.outdate, MM.id_reg_kmr, MM.id_bed, MM.id_kelas
					FROM (
						SELECT TRK.*
						FROM (
							SELECT DISTINCT TRK.id_reg
							FROM trx_reg_kmr TRK
							WHERE TRK.cancel = 0
							) AS M
							INNER JOIN trx_reg_kmr TRK ON TRK.id_reg=M.id_reg
						ORDER BY TRK.id_reg, TRK.indate
					) AS MM
				) AS TL
					LEFT JOIN trx_reg TR ON TL.id_reg = TR.id_reg
					LEFT JOIN mst_pasien MP ON TR.id_pasien  = MP.id_pasien
					LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
					LEFT JOIN mst_kelas MK ON TL.id_kelas  = MK.id_kelas
					LEFT JOIN mst_kelas MKF ON TL.id_kelas_from  = MKF.id_kelas
					LEFT JOIN mst_dokter MD ON TR.id_dokter_prt1  = MD.id_dokter
					LEFT JOIN mst_company MC ON TR.id_asuransi  = MC.id_company
					LEFT JOIN mst_kamar MKM ON TL.id_reg_kmr = MKM.id_kamar

				WHERE
				TR.id_reg= '".$id_reg."'
				AND TR.is_reg_aps='0'
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->row_array();
    return $result;
  }

	
	public function add_data_asm_ranap($data)
  {
    $this->dbhis->insert('soap_asm_ri', $data);
  }
	
	function get_data_asm_ri_dokter($id_reg)
  {
    $sql = "SELECT  a.*
            FROM    soap_asm_ri a
            WHERE   a.id_reg = '".$id_reg."'
										AND a.kategori='ASM' AND jenis_asm='DOKTER'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $row = $query->row_array();
    return $row;
  }
	
	function get_data_cppt_ri($id_reg,$id_asmri='0')
  {
    $sql = "SELECT  a.*
            FROM    soap_asm_ri a
            WHERE   a.id_asmri='".$id_asmri."'
            ";
    #echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $row = $query->row_array();
    return $row;
  }
	
	function get_list_cppt_ri($id_reg)
  {
    $sql = "SELECT  a.*
            FROM    soap_asm_ri a
            WHERE   a.id_reg = '".$id_reg."'
										AND a.kategori='CPPT' AND jenis_asm='DOKTER' 
            ";
    #echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $rs = $query->result_array();
    return $rs;
  }
	
	public function edit_data_asm_ranap($where, $data)
  {
    $this->dbhis->update('soap_asm_ri', $data, $where);
    return $this->dbhis->affected_rows();
  }

  public function delete_asm_ranap($id_asmri)
  {
    $this->dbhis->where('id_asmri', $id_asmri);
    $this->dbhis->delete('soap_asm_ri');
  }

  //tindakan
  function fnddatadokter($id_reg){
    $query=$this->db->query("SELECT id_dokter_prt1 FROM trx_reg WHERE id_reg='$id_reg'");
    return $query->row();
  }

  

  function createregact($data_trx_reg_act,$table){
    $this->db->insert($table,$data_trx_reg_act);
  }
  //end tindakan


} 


?>