<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Eresep_model_bypass extends CI_Model

{



    public $table = 'soap_eresep';

		

    public $id = 'id_eresep';    

		public $order = 'DESC';



    function __construct()

    {

        parent::__construct();

    }


  /**
   * Ambil info group farmalkes berdasarkan id_eresep_det
   * Return: ['id_group'=>int|null, 'id_trx_det'=>string|null]
   */
  function get_item_group_by_det($id_eresep_det){
    $q = $this->db->query("
      SELECT d.id_trx_det, mf.id_group
      FROM soap_eresep_det d
      LEFT JOIN mst_farmalkes mf ON mf.id_fa = d.id_trx_det
      WHERE d.id_eresep_det = ?
      LIMIT 1
    ", array($id_eresep_det));
    return $q->row_array();
  }

  /**
   * List batch untuk obat (trx_penerimaan_barang)
   * Return array: [['id_batch'=>..., 'stok_masuk'=>...], ...]
   */
  function get_batch_list_by_obat($id_obat){
    $q = $this->db->query("
      SELECT id_batch, id_obat, stok_masuk
      FROM trx_penerimaan_barang
      WHERE id_obat = ?
      ORDER BY id_batch DESC
    ", array($id_obat));
    return $q->result_array();
  }







//////////////////////////////////////

function data_pasien($id_reg){

  $query=$this->db->query("SELECT a.*,b.*,c.name AS nama_asuransi,d.name AS nama_dokter

  FROM mst_pasien a, trx_reg b

  LEFT JOIN mst_company c ON b.id_asuransi=c.id_company

  LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter

  WHERE a.id_pasien=b.id_pasien AND b.id_reg='".$id_reg."'");

  return $query->row(); 

} 

function mst_setting_harga(){

    $query=$this->db->query("SELECT tuslah,jasa_racik FROM mst_markup_harga");

    return $query->row(); 

  } 
  
  function getdatasoap($id_reg){

    $query=$this->db->query("SELECT * FROM soap_asm_ri WHERE id_reg='$id_reg'");

    return $query->row(); 

  } 



  function data_total_tagihan($id_eresep){

    $query=$this->db->query("SELECT SUM(a.subtotal) AS totalall FROM soap_eresep_det a LEFT JOIN soap_eresep b ON a.id_eresep=b.id_eresep WHERE b.id_reg='$id_eresep' AND a.is_validasi='1'");

    return $query->row(); 

  } 



  function detail_obatnya($id_obat){

    $query=$this->db->query("SELECT a.sale_price AS harga_margin

		FROM mst_farmalkes a 

		WHERE a.id_fa='$id_obat'");

    return $query->row(); 

  } 



  function detail_obat_eresep_nonracik($id_eresep){

    $query=$this->db->query("SELECT a.*,b.*, mf.id_group, b.id_batch

	FROM soap_eresep a, soap_eresep_det b
	LEFT JOIN mst_farmalkes mf ON mf.id_fa=b.id_trx_det

	WHERE a.id_eresep=b.id_eresep

	AND a.id_reg='".$id_eresep."'

	AND b.is_racikan=0 AND b.status=0 AND b.is_validasi=0

	ORDER BY a.id_eresep DESC");

    return $query->result_array();

  }



  function list_detail_obat_eresep_nonracik($id_eresep){

    $query=$this->db->query("SELECT a.*,b.*, mf.id_group, b.id_batch

	FROM soap_eresep a, soap_eresep_det b
	LEFT JOIN mst_farmalkes mf ON mf.id_fa=b.id_trx_det

	WHERE a.id_eresep=b.id_eresep

	AND a.id_reg='".$id_eresep."'

	AND b.is_racikan=0 AND b.status=0 AND b.is_validasi=1 

	ORDER BY a.id_eresep DESC");

    return $query->result_array();

  }

  function data_obat_search($id_eresep){

	$query=$this->db->query("SELECT * FROM soap_eresep_det WHERE id_eresep_det='$id_eresep'");

    return $query->row(); 

  }



  function data_obat_search_rck($id_eresep){

	$query=$this->db->query("SELECT * FROM soap_eresep_det_racikan WHERE id_eresep_det='$id_eresep'");

    return $query->result_array(); 

  }



  function delete_obatnya($id_eresep){

    $query=$this->db->query("UPDATE soap_eresep_det SET status=1 WHERE id_eresep_det='$id_eresep'");

  }



  function validasi_obatnya($id_eresep,$subtotal_new,$tuslah,$jasa_racik,$set_depo,$id_batch){

    // PATCH: simpan id_batch (nullable) untuk vaksin; gunakan binding supaya aman
    $sql = "UPDATE soap_eresep_det
            SET tuslah=?,
                jasa_racik='0',
                is_validasi=1,
                set_depo=?,
                subtotal=?,
                id_batch=?
            WHERE id_eresep_det=?";
    $this->db->query($sql, array($tuslah, $set_depo, $subtotal_new, $id_batch, $id_eresep));

  }



  function cancel_obatnya($id_eresep,$subtotal_new){

    $query=$this->db->query("UPDATE soap_eresep_det SET tuslah='0', jasa_racik='0', is_validasi=0, subtotal='$subtotal_new', id_batch=NULL WHERE id_eresep_det='$id_eresep'");

  }



  function delete_obatnya_rck($id_eresep){

    $query=$this->db->query("UPDATE soap_eresep_det SET status=1 WHERE id_eresep_det='$id_eresep' AND is_racikan=1");

  }



  function hapus_obatnya_rck($id_eresep){

    $query=$this->db->query("UPDATE soap_eresep_det SET status=1 WHERE id_eresep_det='$id_eresep' AND is_racikan=1");

  }



  function validasi_obatnya_rck($id_eresep,$set_depo){

    $query=$this->db->query("UPDATE soap_eresep_det SET is_validasi=1, set_depo='$set_depo' WHERE id_eresep_det='$id_eresep' AND is_racikan=1");

  }



  function cancel_obatnya_rck($id_eresep){

    $query=$this->db->query("UPDATE soap_eresep_det SET is_validasi=0, set_depo=NULL WHERE id_eresep_det='$id_eresep' AND is_racikan=1");

  }



  function edit_nonracikan($id_eresep,$qty,$harga_subtotal_set){

    $query=$this->db->query("UPDATE soap_eresep_det SET qty='$qty',subtotal=$harga_subtotal_set WHERE id_eresep_det='$id_eresep'");

  }



  function edit_racikan($id_eresep,$qty,$harga_subtotal_set){

    $query=$this->db->query("UPDATE soap_eresep_det_racikan SET qty='$qty',subtotal=$harga_subtotal_set WHERE id_eresep_det_racikan='$id_eresep'");

  }



  function validasi_obatnya_hrg_rck($id_item_racikan,$subtotal_new){

    $query=$this->db->query("UPDATE soap_eresep_det_racikan SET subtotal='$subtotal_new' WHERE id_eresep_det_racikan='$id_item_racikan'");

  }



  function cancel_obatnya_hrg_rck($id_item_racikan,$subtotal_new){

    $query=$this->db->query("UPDATE soap_eresep_det_racikan SET subtotal='$subtotal_new' WHERE id_eresep_det_racikan='$id_item_racikan'");

  }



  function data_search_obat($id_eresep){

    $query=$this->db->query("SELECT *

    FROM soap_eresep_det 

    WHERE id_eresep_det='$id_eresep'");

    return $query->row(); 

  } 



  function data_search_obat_racikan($id_eresep_det_racikan){

    $query=$this->db->query("SELECT *

    FROM soap_eresep_det_racikan 

    WHERE id_eresep_det_racikan='$id_eresep_det_racikan'");

    return $query->row(); 

  }



  function qty_obatnya_hrg_rck($id_eresep){

    $query=$this->db->query("SELECT qty FROM soap_eresep_det WHERE id_eresep_det='$id_eresep'");

    return $query->row(); 

  } 



  function sum_obatnya_hrg_rck($id_eresep){

    $query=$this->db->query("SELECT SUM(subtotal) AS grandtotal FROM soap_eresep_det_racikan WHERE id_eresep_det='$id_eresep'");

    return $query->row(); 

  } 



  function update_obatnya_hrg_rck($id_eresep,$grandtotal_sat_set,$cal_sub_racikan,$tuslah,$jasa_racik){

    $query=$this->db->query("UPDATE soap_eresep_det SET tuslah='$tuslah',jasa_racik='$jasa_racik',harga_satuan='$grandtotal_sat_set',subtotal='$cal_sub_racikan' WHERE id_eresep_det='$id_eresep'");

  }

  

    // insert data

    function insert($data)

    {

        $this->db->insert($this->table, $data);

    }



    // update data

    function update($id, $data)

    {

        $this->db->where($this->id, $id);

        $this->db->update($this->table, $data);

    }



    // delete data

    function delete($id)

    {

        $this->db->where($this->id, $id);

        $this->db->delete($this->table);

    }







	function dnu(){

	  $query=$this->db2->query("SELECT max(id_resep) as nourut FROM trx_frm_resep");

	  return $query->row();

	}


  public function add_to_log($data_log){

    $this->db->insert('log_activity', $data_log);

  }

  

  function getdatafarmasi($username){

    $query=$this->db->query("SELECT online,set_depo FROM mst_nav_user WHERE login_name='$username'");

    return $query->row();

  }


}



/* End of file Eresep_model.php */