<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mst_farmasi extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_farmasi");
        if (!isset($this->session->userdata['sp']->username)) {
            redirect("auth");
        }
    }

    public function index()
    {
        $this->mst_farmasi();
    }

    public function mst_farmasi()
    {
        $data['datalist'] = $this->M_farmasi->list_farmasi();

        // Populate lists for modals
        $data['datalistkat'] = $this->M_farmasi->list_kategori();
        $data['datalistsubkat'] = $this->M_farmasi->list_subkategori();
        $data['datalistgol'] = $this->M_farmasi->list_golongan();
        $data['datalisttype'] = $this->M_farmasi->list_jenis();
        $data['datalistkemasan'] = $this->M_farmasi->list_satuan();
        $data['datalistgroup'] = $this->M_farmasi->list_group();

        $this->load->view('mst_farmasi', $data);
    }

    public function save_farmasi()
    {
        $id_fa = uniqid('FA'); // Fallback if no auto-increment or specific generator

        $data = [
            'id_fa' => $id_fa,
            'name' => $this->input->post('deskripsi_set'),
            'id_group' => $this->input->post('grup_set'),
            'type_obat' => $this->input->post('tipe_obat'),
            'id_gol' => $this->input->post('sel_1'),
            'id_cat' => $this->input->post('sel_2'),
            'id_subcat' => $this->input->post('sel_3'),
            'id_type' => $this->input->post('sel_4'),
            'id_satuan' => $this->input->post('sel_6'),
            'id_kemasan' => $this->input->post('sel_5'),
            'is_formularium' => $this->input->post('field1_set') ? 1 : 0,
            'is_generik' => $this->input->post('field2_set') ? 1 : 0,
            'aktif' => 1,
            'created' => date('Y-m-d H:i:s'),
            'creator' => $this->session->userdata['sp']->login_name
        ];

        $this->M_farmasi->ins1($data, 'mst_farmalkes');
        redirect('mst_farmasi');
    }

    public function edit_farmasi()
    {
        $id = $this->input->post('id_fa');
        $row = $this->M_farmasi->edit_farmasi($id);

        header('Content-Type: application/json');
        if ($row) {
            echo $this->manual_json([
                'status' => 'success',
                'data' => $row
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data not found']);
        }
        exit;
    }

    public function editthis_farmasi()
    {
        $id = $this->input->post('id_fa');
        $data = [
            'name' => $this->input->post('edt_deskripsi'),
            'id_group' => $this->input->post('edt_grup'),
            'type_obat' => $this->input->post('edt_tipe'),
            'id_gol' => $this->input->post('edt_gol'),
            'id_cat' => $this->input->post('edt_cat'),
            'id_subcat' => $this->input->post('edt_subcat'),
            'id_type' => $this->input->post('edt_type'),
            'id_satuan' => $this->input->post('edt_satuan'),
            'id_kemasan' => $this->input->post('edt_kemasan'),
            'is_formularium' => $this->input->post('edt_f1') ? 1 : 0,
            'is_generik' => $this->input->post('edt_f2') ? 1 : 0,
            'updated' => date('Y-m-d H:i:s'),
            'updater' => $this->session->userdata['sp']->login_name
        ];

        $this->M_farmasi->update_data(['id_fa' => $id], $data, 'mst_farmalkes');
        redirect('mst_farmasi');
    }

    public function nonaktif_farmasi()
    {
        $id = $this->input->post('id_fa');
        $this->M_farmasi->update_data(['id_fa' => $id], ['aktif' => 0], 'mst_farmalkes');
        echo json_encode(['status' => true]);
    }

    public function aktifkan_farmasi()
    {
        $id = $this->input->post('id_fa');
        $this->M_farmasi->update_data(['id_fa' => $id], ['aktif' => 1], 'mst_farmalkes');
        echo json_encode(['status' => true]);
    }

    private function manual_json($data)
    {
        if (function_exists('json_encode')) {
            return json_encode($data);
        }
        // Simplified manual JSON for objects
        $parts = [];
        foreach ($data as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $inner = [];
                foreach ((array) $value as $k => $v) {
                    $inner[] = '"' . $k . '":"' . addslashes($v) . '"';
                }
                $val = '{' . implode(',', $inner) . '}';
            } else {
                $val = is_string($value) ? '"' . addslashes($value) . '"' : $value;
            }
            $parts[] = '"' . $key . '":' . $val;
        }
        return '{' . implode(',', $parts) . '}';
    }

    // Other methods remain same but call M_farmasi correctly
    public function mst_jenis()
    {
        $data['datalist'] = $this->M_farmasi->list_jenis();
        $this->load->view('mst_jenis', $data);
    }
    public function mst_satuan()
    {
        $data['datalist'] = $this->M_farmasi->list_satuan();
        $this->load->view('mst_satuan', $data);
    }
    public function mst_kategori()
    {
        $data['datalist'] = $this->M_farmasi->list_kategori();
        $this->load->view('mst_kategori', $data);
    }
    public function mst_subkategori()
    {
        $data['datalist'] = $this->M_farmasi->list_subkategori();
        $this->load->view('mst_subkategori', $data);
    }
    public function mst_golongan()
    {
        $data['datalist'] = $this->M_farmasi->list_golongan();
        $this->load->view('mst_golongan', $data);
    }
    public function mst_supplieralkes()
    {
        $data['datalist'] = $this->M_farmasi->list_supplier();
        $this->load->view('mst_supplier', $data);
    }
    public function mst_pabrikalkes()
    {
        $data['datalist'] = $this->M_farmasi->list_pabrik();
        $this->load->view('mst_pabrik', $data);
    }
    public function mst_gudang()
    {
        $data['datalist'] = $this->M_farmasi->list_gudang();
        $this->load->view('mst_gudang', $data);
    }
}
