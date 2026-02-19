<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan_vaksinasi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Query utama kamu (dipertahankan strukturnya), + PATCH penting:
     * - filter vaksin id_group=3 dari mst_farmalkes
     * - hanya data yang a.id_batch NOT NULL
     * - join ke mst_farmalkes via c.id_obat = f.id_fa (sesuai query kamu)
     */
    private function base_query()
    {
        $this->db->from('soap_eresep_det a');
        $this->db->join('soap_eresep b', 'a.id_eresep=b.id_eresep', 'left');
        $this->db->join('trx_penerimaan_barang c', 'a.id_batch=c.id_batch', 'left');
        $this->db->join('trx_reg d', 'b.id_reg=d.id_reg', 'left');
        $this->db->join('mst_pasien e', 'd.id_pasien=e.id_pasien', 'left');
        $this->db->join('mst_farmalkes f', 'c.id_obat=f.id_fa', 'left');

        $this->db->where('a.id_batch IS NOT NULL', null, false);
        $this->db->where('f.id_group', '3'); // hanya vaksin
    }

    private function apply_filters(array $filters)
    {
        if ($filters['vaksin_id'] !== '') {
            $this->db->where('f.id_fa', $filters['vaksin_id']);
        }
        if ($filters['vaksin_name'] !== '') {
            $this->db->like('f.name', $filters['vaksin_name']);
        }
        if ($filters['nama_pasien'] !== '') {
            $this->db->like('e.name', $filters['nama_pasien']);
        }
        if ($filters['id_batch'] !== '') {
            $this->db->like('c.id_batch', $filters['id_batch']);
        }

        // tanggal range (so_date)
        if ($filters['date_from'] !== '' && $filters['date_to'] !== '') {
            $this->db->where('DATE(c.so_date) >=', $filters['date_from']);
            $this->db->where('DATE(c.so_date) <=', $filters['date_to']);
        } elseif ($filters['date_from'] !== '') {
            $this->db->where('DATE(c.so_date) >=', $filters['date_from']);
        } elseif ($filters['date_to'] !== '') {
            $this->db->where('DATE(c.so_date) <=', $filters['date_to']);
        }
    }

    /** Dropdown vaksin (id_group=3) */
    public function get_vaksin_options()
    {
        $this->db->select('id_fa, name');
        $this->db->from('mst_farmalkes');
        $this->db->where('id_group', '3');
        $this->db->order_by('name', 'asc');
        return $this->db->get()->result_array();
    }

    /** LIST MODE: 1 baris per pasien */
    public function get_list(array $filters)
    {
        $this->db->select("
            f.name AS nama_vaksin,
            c.id_batch,
            DATE(c.so_date) AS so_date,
            e.name AS nama_pasien
        ", false);

        $this->base_query();
        $this->apply_filters($filters);

        $this->db->order_by('c.so_date', 'desc');
        $this->db->order_by('f.name', 'asc');
        $this->db->order_by('c.id_batch', 'asc');
        $this->db->order_by('e.name', 'asc');

        return $this->db->get()->result_array();
    }

    /** MATRIX MODE: 1 baris per vaksin+batch+tanggal, pasien digabung koma */
    public function get_matrix(array $filters)
    {
        // DISTINCT untuk menghindari duplikasi jika 1 pasien keikut join ganda
        $this->db->select("
            f.name AS nama_vaksin,
            c.id_batch,
            DATE(c.so_date) AS so_date,
            COUNT(DISTINCT e.id_pasien) AS jumlah_pasien,
            GROUP_CONCAT(DISTINCT e.name ORDER BY e.name SEPARATOR ', ') AS detail_pasien
        ", false);

        $this->base_query();
        $this->apply_filters($filters);

        $this->db->group_by(['f.name','c.id_batch','DATE(c.so_date)']);
        $this->db->order_by('c.so_date', 'desc');
        $this->db->order_by('f.name', 'asc');
        $this->db->order_by('c.id_batch', 'asc');

        return $this->db->get()->result_array();
    }
}
