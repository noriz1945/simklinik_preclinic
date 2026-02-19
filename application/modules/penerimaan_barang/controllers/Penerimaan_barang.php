<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penerimaan_barang_model', 'pb');
        $this->load->helper(['url','form']);
        $this->load->library(['session']);
        $this->load->database();
    }

    public function index()
    {
        $data = ['title' => 'Penerimaan Barang (Farmasi)'];
        $this->load->view('index', $data);
    }

    /** list distinct SO Date */
    public function so_dates()
    {
        $rows = $this->pb->get_so_dates(500);
        return $this->output->set_content_type('application/json')->set_output(json_encode(['results'=>$rows]));
    }

    /** items existing pada SO date */
    public function so_items()
    {
        $so_date = trim((string)$this->input->get('so_date'));
        if (!$so_date) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok'=>false,'msg'=>'SO Date kosong','rows'=>[], 'count'=>0]));
        }
        $rows = $this->pb->get_items_by_so_date($so_date);
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['ok'=>true,'rows'=>$rows,'count'=>count($rows)]));
    }

    public function list_json()
    {
        $draw   = (int)$this->input->post('draw');
        $start  = (int)$this->input->post('start');
        $length = (int)$this->input->post('length');
        $search = trim((string)($this->input->post('search')['value'] ?? ''));

        $filters = [
            'id_batch' => trim((string)$this->input->post('f_id_batch')),
            'obat'     => trim((string)$this->input->post('f_obat')),
            'so_date'  => trim((string)$this->input->post('f_so_date')),
        ];

        $res = $this->pb->dt_list($start, $length, $search, $filters);

        return $this->output->set_content_type('application/json')->set_output(json_encode([
            "draw"            => $draw,
            "recordsTotal"    => $res['total'],
            "recordsFiltered" => $res['filtered'],
            "data"            => $res['rows'],
        ]));
    }

    /**
     * Select2 ajax: cari obat dari mst_farmalkes (exclude yg sudah ada pada so_date tsb)
     * return grouped results berdasarkan mst_farmalkes_grup (header/optgroup)
     */
    public function obat_search()
    {
        $q       = trim((string)$this->input->get('q'));
        $so_date = trim((string)$this->input->get('so_date'));

        $rows = $this->pb->search_obat($q, $so_date);

        // grouped structure: [{text:'Nama Grup', children:[{id,text,...}, ...]}, ...]
        $groups = [];
        foreach ($rows as $r) {
            $gname = trim((string)($r['group_name'] ?? ''));
            if ($gname === '') $gname = 'Lainnya';

            if (!isset($groups[$gname])) $groups[$gname] = [];

            // ✅ id_fa bisa punya leading zero => jangan cast ke int
            $idFa = (string)($r['id_fa'] ?? '');

            $groups[$gname][] = [
                'id'         => $idFa,
                'text'       => $idFa.' - '.$r['name'],
                'name'       => $r['name'],
                'hna1'       => $r['hna1'],
                'sale_price' => $r['sale_price'],
                'id_group'   => $r['id_group'] ?? null,
                'group_name' => $gname,
            ];
        }

        ksort($groups, SORT_NATURAL | SORT_FLAG_CASE);

        $results = [];
        foreach ($groups as $gname => $children) {
            $results[] = [
                'text'     => $gname,
                'children' => $children,
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['results' => $results]));
    }

    public function next_batch_no()
    {
        $so_date = trim((string)$this->input->get('so_date')) ?: date('Y-m-d');
        $next = $this->pb->peek_next_batch_no($so_date);
        return $this->output->set_content_type('application/json')->set_output(json_encode(['ok'=>true,'next'=>$next]));
    }

    public function save_bulk()
    {
        $so_date = trim((string)$this->input->post('so_date')) ?: null;

        $id_obat     = $this->input->post('id_obat');
        $harga_dasar = $this->input->post('harga_dasar');
        $harga_jual  = $this->input->post('harga_jual');
        $stok_masuk  = $this->input->post('stok_masuk');

        if (!$so_date) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok'=>false,'msg'=>'SO Date wajib diisi.']));
        }

        if (!is_array($id_obat) || count($id_obat) < 1) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok'=>false,'msg'=>'Pilih minimal 1 obat.']));
        }

        $items = [];
        for ($i=0; $i<count($id_obat); $i++) {
            // ✅ simpan string apa adanya (leading zero aman)
            $idOb = trim((string)($id_obat[$i] ?? ''));

            $items[] = [
                'id_obat'     => $idOb,
                'harga_dasar' => (float)($harga_dasar[$i] ?? 0),
                'harga_jual'  => (float)($harga_jual[$i] ?? 0),
                'stok_masuk'  => (int)($stok_masuk[$i] ?? 0),
            ];
        }

        $res = $this->pb->save_bulk($so_date, $items, $this->_actor());
        return $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    public function delete($id = null)
    {
        $id = (int)$id;
        $res = $this->pb->delete_row($id);
        return $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    /** =========================
     *  SOH (Stok Aktif) endpoints
     *  ========================= */

    public function soh_list()
    {
        $q = trim((string)$this->input->get('q'));
        $rows = $this->pb->get_soh_list($q, 200);

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['ok'=>true,'rows'=>$rows,'count'=>count($rows)]));
    }

    public function soh_detail()
    {
        // ✅ id_obat bisa leading zero, jangan cast int
        $id_obat = trim((string)$this->input->get('id_obat'));
        if ($id_obat === '' || !preg_match('/^\d+$/', $id_obat)) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok'=>false,'msg'=>'id_obat invalid']));
        }

        $res = $this->pb->get_soh_detail($id_obat);
        return $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    private function _actor()
    {
        $sess = $this->session->userdata('logged_in');
        return isset($sess['username']) ? $sess['username'] : 'system';
    }
}
