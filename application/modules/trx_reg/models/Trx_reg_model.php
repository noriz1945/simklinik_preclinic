<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Trx_reg_model extends CI_Model
{
    public $table = "trx_reg";

    public $id = "id_reg";
    public $order = "DESC";

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        #$this->db->order_by($this->id, $this->order);
        #return $this->db->get($this->table)->result();

        $sql =
            "SELECT * FROM " .
            $this->table .
            " ORDER BY " .
            $this->id .
            " " .
            $this->order .
            "";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // get data by id_reg
    function get_by_id($id_reg)
    {
        $sql =
            "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
				WHERE a.id_reg='" .
            $id_reg .
            "'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    // get total rows
    function total_rows($q = null)
    {
        $sql =
            "SELECT 	* 
							FROM 		" .
            $this->table .
            "
							";
        if ($q != null) {
            $sql .= " WHERE FALSE ";
            $sql .= "OR LOWER(regdate) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_pasien) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_dokter_krm) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_dokter_prt1) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_dokter_prt2) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_dokter_jaga) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_icd) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(diag) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_asuransi) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_company) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_provider) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_pod) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(status) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(mrstat) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(rwjn) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(rwip) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(ugd) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(note) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(penanggung) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_rujukan) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(person_rjk) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(confirmby) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(confirmdate) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(card_id) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(card_name) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(card_comp) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(card_fam) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(card_rjk) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(lab) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(rad) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(farm) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(fisio) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(total_dp) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_kamar) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_bed) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_kelas) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(iostatus) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(cash) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(is_odc) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(is_kpri) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_paket) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_trx_paket) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(paket_aktif) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(paket_selesai) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_kelaspkt) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(mrstatend_igd) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(mrstatend_rwip) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(mrstatdcs) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(id_mod) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(created) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(creator) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(updated) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(updater) LIKE LOWER('%" . $q . "%') ";
        }
        $sql = "SELECT COUNT(*) as total_rows FROM (" . $sql . ") abc";
        $query = $this->db->query($sql);
        $result = $query->result();
        $total_rows = $result[0]->total_rows;
        return $total_rows;
    }

    // get data with limit and search
    function get_limit_data($limit = null, $start = 0, $q = null)
    {
        #$this->db->order_by($this->id, $this->order);
        $sql = "SELECT 	a.*,b.*,b.name AS nama_pasien,c.`name` AS dokter,d.`name` AS asuransi
			FROM	trx_reg a
					LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
					LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
					LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
			";
        if ($q != null) {
            $sql .= " WHERE FALSE ";

            $sql .= "OR LOWER(a.id_pasien) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(b.`name`) LIKE LOWER('%" . $q . "%') ";
            $sql .= "OR LOWER(a.id_reg) LIKE LOWER('%" . $q . "%') ";
        }
        $sql .= " ORDER BY a.regdate DESC LIMIT " . $start . "," . $limit . "";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);

        $id_reg = $data["id_reg"];
        $id_act_admin = "00001"; # BIAYA ADMINISTRASI
        $sql = "SELECT a.* FROM mst_tindakan a WHERE a.id_act='00001'";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        $sql =
            "SELECT 	a.*,a.`id_act`,a.`id_kelas`,a.`id_comp`,b.`id_comp`
						,a.`price`,b.`price`
						,IF(COALESCE(b.`price`,0)>0,COALESCE(b.`price`,0),COALESCE(a.`price`,0)) AS price
				FROM 	mst_tindakan_prc a 
						LEFT JOIN mst_tindakan_prc b ON (b.`id_act`=a.`id_act` AND b.id_comp='" .
            $data["id_asuransi"] .
            "' AND b.`aktif`=1)
				WHERE 	a.id_act='" .
            $id_act_admin .
            "' AND a.id_comp='0001' AND a.aktif=1
				ORDER BY a.`created` DESC,b.`created` DESC";
        $query = $this->db->query($sql);
        $row_prc = $query->row_array();

        ### --- Tagihan Auto Tagih ---
        if ($data["id_paket"] == "") {
            $auto_tindakan = [];
            $auto_tindakan["id_reg"] = $id_reg;
            $auto_tindakan["trxdate"] = date("Y-m-d H:i:s");
            $auto_tindakan["id_reg_act"] = $row["id_act"];
            $auto_tindakan["id_type"] = 1; ### tipe reg: 1=rwj,2=rwi,3=ugd
            $auto_tindakan["id_kelas"] = 1;
            $auto_tindakan["id_dokter"] = $data["id_dokter_prt1"];
            $auto_tindakan["name"] = $row["name"];
            $auto_tindakan["qty"] = 1;
            $auto_tindakan["price"] = $row_prc["price"];
            $auto_tindakan["total"] = $row_prc["price"] * 1;
            $auto_tindakan["is_outpaket"] = 1;
            $auto_tindakan["creator"] =
                $this->session->userdata["sp"]->login_name;
            $auto_tindakan["created"] = date("Y-m-d H:i:s");
            $this->db->insert("trx_reg_act", $auto_tindakan);
        }
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

    function get_last_pasien(
        $limit = 100,
        $id_pasien = "",
        $nama = "",
        $nik = "",
        $birthdate = ""
    ) {
        #$this->db->order_by($this->id, $this->order);
        $sql = "SELECT 	mp.*
					,IF(mp.birthdate='0000-00-00 00:00:00','',DATE(mp.birthdate)) AS tgl_lahir
					,a.id_kelurahan AS idx,a.`name` AS kelurahan
					,b.`id_kecamatan`,b.`name` AS kecamatan
					,c.`id_kota`,c.`name` AS kota
					,d.`id_propinsi`,d.`name` AS propinsi
			FROM 	mst_pasien mp
					LEFT JOIN mst_kelurahan a ON (a.`id_kelurahan`=mp.`id_kelurahan`)
					LEFT JOIN `mst_kecamatan` b ON (b.`id_kecamatan`=a.`id_kecamatan`)
					LEFT JOIN `mst_kota` c ON (c.`id_kota`=b.`id_kota`)
					LEFT JOIN `mst_propinsi` d ON (d.`id_propinsi` =c.`id_propinsi`)
          LEFT JOIN trx_reg e ON (e.id_pasien=mp.id_pasien)
			WHERE 	mp.is_rm_aps=0
			";
        if ($id_pasien != "") {
            $sql .=
                "AND mp.id_pasien='" .
                $id_pasien .
                "' 
				";
        }
        if ($nama != "") {
            $sql .=
                "AND UPPER(mp.name) LIKE '%" .
                strtoupper($nama) .
                "%'
				";
        }
        if ($nik != "") {
            $sql .=
                "AND mp.nik='" .
                $nik .
                "'
				";
        }
        if ($birthdate != "") {
            $sql .=
                "AND mp.birthdate='" .
                $birthdate .
                "'
				";
        }
        if ($id_pasien == "" && $nama == "" && $nik == "" && $birthdate == "") 
        {
            $sql.= " AND (e.regdate is null OR DATE(e.regdate) BETWEEN DATE_SUB(CURDATE(), INTERVAL 90 DAY) AND CURDATE() )
                    ";
        }
        $sql .= " ORDER BY e.regdate DESC LIMIT " . $limit;
        #echo "<pre>".$sql."</pre>";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // get data with limit and search
    function get_cari_pasien_HAPUSSS(
        $id_pasien = "",
        $nama = "",
        $nik = "",
        $birthdate = ""
    ) {
        #$this->db->order_by($this->id, $this->order);
        $sql = "SELECT 	mp.*
					,a.id_kelurahan AS idx,a.`name` AS kelurahan
					,b.`id_kecamatan`,b.`name` AS kecamatan
					,c.`id_kota`,c.`name` AS kota
					,d.`id_propinsi`,d.`name` AS propinsi
			FROM 	mst_pasien mp
					LEFT JOIN mst_kelurahan a ON (a.`id_kelurahan`=mp.`id_kelurahan`)
					LEFT JOIN `mst_kecamatan` b ON (b.`id_kecamatan`=a.`id_kecamatan`)
					LEFT JOIN `mst_kota` c ON (c.`id_kota`=b.`id_kota`)
					LEFT JOIN `mst_propinsi` d ON (d.`id_propinsi` =c.`id_propinsi`)
			WHERE mp.is_rm_aps=0  
			";
        if ($id_pasien != "") {
            $sql .=
                "AND mp.id_pasien='" .
                $id_pasien .
                "' 
				";
        }
        if ($nama != "") {
            $sql .=
                "AND UPPER(mp.name) LIKE '%" .
                strtoupper($nama) .
                "%'
				";
        }
        if ($nik != "") {
            $sql .=
                "AND mp.nik='" .
                $nik .
                "'
				";
        }
        if ($birthdate != "") {
            $sql .=
                "AND mp.birthdate='" .
                $birthdate .
                "'
				";
        }

        $sql .= " ORDER BY mp.id_pasien DESC LIMIT 50";
        #echo "<pre>".$sql."</pre>";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_pasien_by_id($id_pasien)
    {
        $sql =
            "    SELECT 	a.* 
                    FROM 	mst_pasien a
                    WHERE	a.id_pasien='" .
            $id_pasien .
            "'
                ";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    
    function get_pasien_by_id_for_aps($id_pasien)
    {
        $sql =
            "   SELECT 	a.*,b.`name` AS status_pernikahan,c.`name` AS pekerjaan,d.`name` AS asuransi
                        ,e.`name` AS kelurahan,f.name AS kecamatan,g.name AS kota,h.name AS propinsi
                FROM 	mst_pasien a
                        LEFT JOIN `mst_pasien_mar` b ON (b.`id_mar`=a.`id_mar`)
                        LEFT JOIN `mst_pasien_job` c ON (c.`id_job`=a.`id_job`)
                        LEFT JOIN `mst_company` d ON (d.`id_company`=a.`asm_comp`)
                        LEFT JOIN `mst_kelurahan` e ON (e.`id_kelurahan`=a.`id_kelurahan`)
                        LEFT JOIN `mst_kecamatan` f ON (f.`id_kecamatan`=a.`id_kecamatan`)
                        LEFT JOIN `mst_kota` g ON (g.`id_kota`=a.`id_kota`)
                        LEFT JOIN `mst_propinsi` h ON (h.`id_propinsi` =a.`id_propinsi`)
                WHERE 	a.id_pasien='".$id_pasien."'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    
    function get_new_id_reg()
    {
        $sql = "SELECT CONCAT(a.`pmonth`,DATE_FORMAT(now(), '%y'),'BM',LPAD((a.`ctr`+1),5,'0')) AS new_id_reg
			FROM 	ctr_reg a 
			WHERE 	a.`pyear`=YEAR(CURDATE()) AND a.`pmonth`=MONTH(CURDATE())";
        $query = $this->db->query($sql);
        $result = $query->row();
        $new_id_reg = $result->new_id_reg;

        $sql =
            "UPDATE ctr_reg SET ctr=ctr+1 WHERE `pyear`=YEAR(CURDATE()) AND `pmonth`=MONTH(CURDATE()) ";
        $query = $this->db->query($sql);

        return $new_id_reg;
    }

    // Booking hari ini (portal) untuk kebutuhan check-in
    function get_bookings_today()
{
    $sql = "
        SELECT 
            b.id AS id_book, 
            b.id_pasien, 
            p.name AS nama_pasien,

            b.id_dokter, 
            d.name AS nama_dokter, 
            b.tanggal, 
            b.jam_slot, 
            b.jenis_perawatan,

            DATE_FORMAT(p.birthdate, '%d%m%Y') AS portal_id,
            p.pin AS pin,

            x.name AS asuransi,
            p.birthdate,

            CASE WHEN EXISTS(
                SELECT 1 FROM trx_reg r
                WHERE r.id_pasien=b.id_pasien 
                AND DATE(r.regdate)=b.tanggal
            ) THEN 1 ELSE 0 END AS sudah_checkin,

            CASE WHEN EXISTS(
                SELECT 1 FROM mst_dokter_cuti c
                WHERE c.id_dokter=b.id_dokter 
                AND c.tanggal_cuti=b.tanggal
            ) THEN 1 ELSE 0 END AS dokter_cuti

        FROM trx_reg_book b
        LEFT JOIN mst_pasien p ON p.id_pasien=b.id_pasien
        LEFT JOIN mst_dokter d ON d.id_dokter=b.id_dokter
        LEFT JOIN mst_company x ON x.id_company=b.id_asuransi

        WHERE b.tanggal = CURDATE()
        ORDER BY b.jam_slot ASC
    ";

    return $this->db->query($sql)->result_array();
}


    // insert data
    function insert_mst_pasien_aps($data)
    {
        $this->db->insert("mst_pasien", $data);
    }

    function data_kunj($id_reg)
    {
        #$this->db->order_by($this->id, $this->order);
        $sql =
            "SELECT 	a.*
		FROM 	`trx_reg_paket_kunj` a 
		WHERE 	a.`id_reg`='" .
            $id_reg .
            "'
		ORDER BY a.kunj_ke";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    public function get_all_dokter()
{
    return $this->db->query("SELECT id_dokter, name FROM mst_dokter WHERE aktif = 1 ORDER BY name")->result_array();
}

    public function get_bookings_today_filtered($id_pasien, $nama_pasien, $nama_dokter, $tanggal)
{
    if(!$tanggal) $tanggal = date('Y-m-d');

    $sql = "
        SELECT b.id AS id_book, b.id_pasien, p.name AS nama_pasien,
               b.id_dokter, d.name AS nama_dokter, b.tanggal, b.jam_slot, b.jenis_perawatan,
               DATE_FORMAT(p.birthdate, '%d%m%Y') AS portal_id,
               p.pin AS pin, x.name AS asuransi, p.birthdate,
               CASE WHEN EXISTS(
                   SELECT 1 FROM trx_reg r
                   WHERE r.id_pasien=b.id_pasien AND DATE(r.regdate)=b.tanggal
               ) THEN 1 ELSE 0 END AS sudah_checkin,
               CASE WHEN EXISTS(
                   SELECT 1 FROM mst_dokter_cuti c
                   WHERE c.id_dokter=b.id_dokter AND c.tanggal_cuti=b.tanggal
               ) THEN 1 ELSE 0 END AS dokter_cuti
        FROM trx_reg_book b
        LEFT JOIN mst_pasien p ON p.id_pasien=b.id_pasien
        LEFT JOIN mst_dokter d ON d.id_dokter=b.id_dokter
        LEFT JOIN mst_company x ON x.id_company=b.id_asuransi
        WHERE b.tanggal = ?
    ";

    $params = [$tanggal];

    if ($id_pasien != "") {
        $sql .= " AND b.id_pasien LIKE ? ";
        $params[] = "%$id_pasien%";
    }
    if ($nama_pasien != "") {
        $sql .= " AND p.name LIKE ? ";
        $params[] = "%$nama_pasien%";
    }
    if ($nama_dokter != "") {
        $sql .= " AND d.name LIKE ? ";
        $params[] = "%$nama_dokter%";
    }

    $sql .= " ORDER BY b.jam_slot ASC ";

    return $this->db->query($sql, $params)->result_array();
}


    
}
?>
