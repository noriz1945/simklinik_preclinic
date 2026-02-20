<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Soap_eresep_model extends CI_Model

{



    public $table = 'soap_eresep';

		

    public $id = 'id_eresep';    

		public $order = 'DESC';



    function __construct()

    {

        parent::__construct();

    }



	function detail_obatnya($id_obat){

		$query=$this->db->query("SELECT a.sale_price AS harga_margin

		FROM mst_farmalkes a 

		WHERE a.id_fa='$id_obat'");

		return $query->row(); 

	  } 



    // get all

    function get_all()

    {

        #$this->db->order_by($this->id, $this->order);

        #return $this->db->get($this->table)->result();

				

				$sql = "SELECT * FROM ".$this->table." ORDER BY ".$this->id." ".$this->order."";

				$query = $this->db->query($sql);

				$result = $query->result();

				return $result;

    }



    // get data by id

    function get_by_id($id)

    {

        #$this->db->where($this->id, $id);

        #return $this->db->get($this->table)->row();

				

				$sql = "SELECT 	* 

								FROM 		".$this->table." 

								WHERE		".$this->id."='".$id."'

								ORDER BY ".$this->id." ".$this->order."";

				$query = $this->db->query($sql);

				$result = $query->result();

				$result = $result[0];

				return $result;

    }

    

    // get total rows

    function total_rows($q = NULL) 

		{

			$sql = "SELECT 	* 

								FROM 		".$this->table."

								";

				if($q!=NULL)

				{

					$sql .= " WHERE FALSE ";

					$sql .= "OR LOWER(eresepdate) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(id_reg) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(id_dokter) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(id_type) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(id_kelas) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(total) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(id_ord) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(racikan) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(cancel) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(canceldate) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(created) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(creator) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(updated) LIKE LOWER('%".$q."%') ";

						$sql .= "OR LOWER(updater) LIKE LOWER('%".$q."%') ";

						}

				$sql = "SELECT COUNT(*) as total_rows FROM (".$sql.") abc";

				$query = $this->db->query($sql);

				$result = $query->result();

				$total_rows = $result[0]->total_rows;

				return $total_rows;

	}

	

    // get data with limit and search

    function get_limit_data($limit=NULL, $start = 0, $q = NULL) {

        #$this->db->order_by($this->id, $this->order);

        $sql = "SELECT 	* 

								FROM 		".$this->table."

								";

				if($q!=NULL)

				{

					$sql .= " WHERE FALSE ";

					$sql .= "OR LOWER(eresepdate) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(id_reg) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(id_dokter) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(id_type) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(id_kelas) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(total) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(id_ord) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(racikan) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(cancel) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(canceldate) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(created) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(creator) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(updated) LIKE LOWER('%".$q."%') ";

					$sql .= "OR LOWER(updater) LIKE LOWER('%".$q."%') ";

					}

				$sql .= " ORDER BY ".$this->id." ".$this->order." LIMIT ".$start.",".$limit."";

				$query = $this->db->query($sql);

				$result = $query->result();

				return $result;

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



    function get_data_soap($id_reg)

    {

        $sql = "SELECT  * 

                FROM    soap_cppt_trans                

                WHERE   id_reg = '".$id_reg."'

                ";

                        

        $query  = $this->dbsupp->query($sql);

        $rs     = $query->row_array();

        return $rs;

    }



	function dnu(){

	  $query=$this->db2->query("SELECT max(id_resep) as nourut FROM trx_frm_resep");

	  return $query->row();

	}



	function m_trx_frm_resep($id_eresep){

		$query=$this->db2->query("SELECT * FROM soap_eresep WHERE id_eresep='$id_eresep'");

		return $query->row();

	}



	function m_trx_frm_resep_det($id_eresep){

		$query=$this->db2->query("SELECT 

		a.id_trx_det,a.name, c.satuan,a.qty,b.sale_price, (b.sale_price * a.qty ) AS total

		FROM soap_eresep_det a

		LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa

		LEFT JOIN mst_farmalkes_etk_amt c ON b.id_satuan=c.id_amt

		WHERE a.id_eresep='$id_eresep' AND a.is_racikan='0' 

		-- UNION ALL 

		-- SELECT

		-- a.id_trx_det,a.name, c.satuan,a.qty,b.sale_price, (b.sale_price * a.qty ) AS total

		-- FROM soap_eresep_det_racikan a

		-- LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa

		-- LEFT JOIN mst_farmalkes_etk_amt c ON b.id_satuan=c.id_amt

		-- WHERE a.id_eresep='$id_eresep'

		");

		return $query->result_array();

	}



	function m_trx_frm_resep_rck($id_eresep){

		$query=$this->db2->query("SELECT ROW_NUMBER() OVER() AS no_rck,

		a.id_eresep_det,SUM((b.sale_price * d.qty)) AS total,d.jenis_obat

		FROM soap_eresep_det_racikan a

		LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa

		LEFT JOIN mst_farmalkes_etk_amt c ON b.id_satuan=c.id_amt

		LEFT JOIN soap_eresep_det d ON (a.id_eresep_det=d.id_eresep_det AND d.is_racikan='1')

		WHERE a.id_eresep='$id_eresep' GROUP BY a.id_eresep_det ORDER BY a.id_eresep_det ASC");

		return $query->result_array();

	}





	



	





}



/* End of file Soap_eresep_model.php */

/* Location: ./application/models/Soap_eresep_model.php */

/* Please DO NOT modify this information : */

/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-18 05:09:16 */

/* http://harviacode.com */