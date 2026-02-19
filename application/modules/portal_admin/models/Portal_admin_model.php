<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal_admin_model extends CI_Model
{
    private $phone_field = 'hp';

    public function get_patients($search = '', $limit = 100)
    {
        $sql = "
            SELECT
                a.id_pasien,
                a.id_pasien AS no_rm,   -- No.RM = id_pasien (sudah 8 digit berleading zero di DB)
                a.name,
                a.birthdate,
                DATE_FORMAT(a.birthdate, '%d%m%Y') AS portal_id,
                a.email,
                a.address,
                a.aktif,
                a.pin,
                a.{$this->phone_field} AS hp,
                e.name AS kelurahan,
                g.name AS kota
            FROM mst_pasien a
            LEFT JOIN mst_kelurahan e ON e.id_kelurahan = a.id_kelurahan
            LEFT JOIN mst_kota g      ON g.id_kota      = a.id_kota
            WHERE a.is_rm_aps = 0
        ";

        $params = [];
        if ($search) {
            $sql .= " AND (
                        a.id_pasien LIKE ? OR
                        a.name LIKE ? OR
                        a.{$this->phone_field} LIKE ? OR
                        a.email LIKE ?
                      )";
            $like = '%'.$search.'%';
            $params = [$like,$like,$like,$like];
        }
        $sql .= " ORDER BY a.id_pasien DESC LIMIT " . intval($limit);

        return $this->db->query($sql, $params)->result_array();
    }

    // id_pasien disuplai berleading zero, query exact match
    public function get_patient_by_id($id_pasien_with_zeros)
    {
        $sql = "SELECT
                    a.id_pasien,
                    a.id_pasien AS no_rm,
                    a.name,
                    a.birthdate,
                    DATE_FORMAT(a.birthdate, '%d%m%Y') AS portal_id,
                    a.{$this->phone_field} AS hp,
                    a.pin
                FROM mst_pasien a
                WHERE a.id_pasien = ?";
        return $this->db->query($sql, [$id_pasien_with_zeros])->row_array();
    }

    public function update_contact_pin($id_pasien_with_zeros, $hp, $pin)
    {
        $this->db->where('id_pasien', $id_pasien_with_zeros); // tanpa normalisasi
        return $this->db->update('mst_pasien', [
            $this->phone_field => $hp,
            'pin'              => $pin
        ]);
    }
}
?>
