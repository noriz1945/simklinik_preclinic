<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mst_dokter extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_dokter");

        // PHP 7.4 compatible session check
        $sp = $this->session->userdata('sp');
        if (!$sp || !isset($sp->username)) {
            if ($this->input->is_ajax_request()) {
                header('Content-Type: application/json');
                echo '{"status":"error","message":"Session expired. Please login again."}';
                exit;
            }
            redirect("auth");
        }
    }

    public function index()
    {
        $this->mst_dokter();
    }

    // Helper function for manual JSON (backup if json_encode is missing)
    private function manual_json($data)
    {
        if (function_exists('json_encode')) {
            return json_encode($data);
        }
        $parts = [];
        foreach ($data as $key => $value) {
            $val = is_string($value) ? '"' . addslashes($value) . '"' : $value;
            $parts[] = '"' . $key . '":' . $val;
        }
        return '{' . implode(',', $parts) . '}';
    }

    // --- MST JENIS DOKTER ---
    public function mst_jenis_dokter()
    {
        $data['datalist'] = $this->M_dokter->list_jenis_dokter();
        $this->load->view('mst_jenis_dokter', $data);
    }

    public function save_jenis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $datains = [
            'name' => $this->input->post('nama_jenis_dokter'),
            'status' => '0',
            'created' => $datetime,
            'created_by' => $username
        ];
        $this->M_dokter->ins1($datains, 'mst_dokter_type');
        redirect('mst_dokter/mst_jenis_dokter/');
    }

    public function edit_jenis_dokter()
    {
        $id = $this->input->post('id');
        $datasett = $this->M_dokter->edit_jenis_dokter($id);
        header('Content-Type: application/json');
        if ($datasett) {
            echo $this->manual_json([
                'status' => 'success',
                'row_0' => $id,
                'row_1' => $datasett->name ?? ''
            ]);
        } else {
            echo '{"status":"error","message":"Data not found"}';
        }
        exit;
    }

    public function editthis_jenis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'name' => $this->input->post('edt_nama_jenis_dokter'),
            'updated' => $datetime,
            'updated_by' => $username
        ];
        $this->M_dokter->update_data(['id_jenis' => $id], $dataupd, 'mst_dokter_type');
        redirect('mst_dokter/mst_jenis_dokter/');
    }

    public function deleteitempo_jenis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'status' => '1',
            'updated' => $datetime,
            'updated_by' => $username
        ];
        $this->M_dokter->update_data(['id_jenis' => $id], $dataupd, 'mst_dokter_type');
        echo '"ok"';
    }

    public function aktifasiitempo_jenis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'status' => '0',
            'updated' => $datetime,
            'updated_by' => $username
        ];
        $this->M_dokter->update_data(['id_jenis' => $id], $dataupd, 'mst_dokter_type');
        echo '"ok"';
    }

    // --- MST SPESIALIS DOKTER ---
    public function mst_spesialis_dokter()
    {
        $data['datalist'] = $this->M_dokter->list_spesialis_dokter();
        $this->load->view('mst_spesialis_dokter', $data);
    }

    public function save_spesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $datains = [
            'name' => $this->input->post('nama_spesialis_dokter'),
            'aktif' => '1',
            'created' => $datetime,
            'creator' => $username
        ];
        $this->M_dokter->ins1($datains, 'mst_dokter_spec');
        redirect('mst_dokter/mst_spesialis_dokter/');
    }

    public function edit_spesialis_dokter()
    {
        $id = $this->input->post('id');
        $datasett = $this->M_dokter->edit_spesialis_dokter($id);
        header('Content-Type: application/json');
        if ($datasett) {
            echo $this->manual_json([
                'status' => 'success',
                'row_0' => $id,
                'row_1' => $datasett->name ?? ''
            ]);
        } else {
            echo '{"status":"error","message":"Data not found"}';
        }
        exit;
    }

    public function editthis_spesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'name' => $this->input->post('edt_nama_spesialis_dokter'),
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_spes' => $id], $dataupd, 'mst_dokter_spec');
        redirect('mst_dokter/mst_spesialis_dokter/');
    }

    public function deleteitempo_spesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'aktif' => '0',
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_spes' => $id], $dataupd, 'mst_dokter_spec');
        echo '"ok"';
    }

    public function aktifasiitempo_spesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'aktif' => '1',
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_spes' => $id], $dataupd, 'mst_dokter_spec');
        echo '"ok"';
    }

    // --- MST SUB SPESIALIS DOKTER ---
    public function mst_sub_spesialis_dokter()
    {
        $data['datalist'] = $this->M_dokter->list_subspesialis_dokter();
        $data['datalistspesialis'] = $this->M_dokter->list_spesialis_dokter();
        $this->load->view('mst_subspesialis_dokter', $data);
    }

    public function save_subspesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $datains = [
            'name' => $this->input->post('nama_subspesialis_dokter'),
            'id_spes' => $this->input->post('id_spesialis_dokter'),
            'aktif' => 1,
            'created' => $datetime,
            'creator' => $username
        ];
        $this->M_dokter->ins1($datains, 'mst_dokter_subsp');
        redirect('mst_dokter/mst_sub_spesialis_dokter/');
    }

    public function edit_subspesialis_dokter()
    {
        $id = $this->input->post('id');
        $datasett = $this->M_dokter->edit_subspesialis_dokter($id);
        header('Content-Type: application/json');
        if ($datasett) {
            echo $this->manual_json([
                'status' => 'success',
                'row_0' => $id,
                'row_1' => $datasett->name ?? '',
                'row_2' => $datasett->id_spes ?? ''
            ]);
        } else {
            echo '{"status":"error","message":"Data not found"}';
        }
        exit;
    }

    public function editthis_subspesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'name' => $this->input->post('edt_nama_subspesialis_dokter'),
            'id_spes' => $this->input->post('edt_id_spesialis_dokter'),
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_subsp' => $id], $dataupd, 'mst_dokter_subsp');
        redirect('mst_dokter/mst_sub_spesialis_dokter/');
    }

    public function deleteitempo_subspesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'aktif' => '0',
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_subsp' => $id], $dataupd, 'mst_dokter_subsp');
        echo '"ok"';
    }

    public function aktifasiitempo_subspesialis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'aktif' => '1',
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_subsp' => $id], $dataupd, 'mst_dokter_subsp');
        echo '"ok"';
    }

    // --- MST DOKTER ---
    public function mst_dokter()
    {
        $data['datalist'] = $this->M_dokter->list_dokter();
        $data['datalistjenis'] = $this->M_dokter->list_jenis_dokter();
        $data['datalistspesialis'] = $this->M_dokter->list_spesialis_dokter();
        $data['datalistsubspesialis'] = $this->M_dokter->list_subspesialis_dokter();
        $this->load->view('mst_dokter', $data);
    }

    public function save_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');

        $checkid = $this->M_dokter->cdk_dokter();
        $setnoreg = $checkid ? $checkid->id_dokter : "000";
        $urutan_reg = (int) substr($setnoreg, 0, 3);
        $id_poset = sprintf("%03s", $urutan_reg + 1);

        $datains = [
            'id_dokter' => $id_poset,
            'name' => $this->input->post('nama_dokter'),
            'id_jenis' => $this->input->post('id_jenis_dokter') ?: 0,
            'id_spes' => $this->input->post('id_spesialis_dokter') ?: 0,
            'id_subspes' => $this->input->post('id_subspesialis_dokter') ?: 0,
            'hp' => $this->input->post('no_hp'),
            'nosip' => $this->input->post('nosip'),
            'aktif' => 1,
            'created' => $datetime,
            'creator' => $username
        ];
        $this->M_dokter->ins1($datains, 'mst_dokter');
        redirect('mst_dokter/mst_dokter/');
    }

    public function edit_dokter()
    {
        $id = $this->input->post('id');
        $datasett = $this->M_dokter->edit_dokter($id);
        header('Content-Type: application/json');
        if ($datasett) {
            echo $this->manual_json([
                'status' => 'success',
                'row_0' => $id,
                'row_1' => htmlspecialchars($datasett->name ?? ''),
                'row_2' => $datasett->id_jenis ?? '',
                'row_3' => $datasett->id_spes ?? '',
                'row_4' => $datasett->id_subspes ?? '',
                'row_5' => htmlspecialchars($datasett->hp ?? ''),
                'row_6' => htmlspecialchars($datasett->nosip ?? '')
            ]);
        } else {
            echo '{"status":"error","message":"Data not found for ID: ' . $id . '"}';
        }
        exit;
    }

    public function editthis_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'name' => $this->input->post('edt_nama_dokter'),
            'id_jenis' => $this->input->post('edt_id_jenis_dokter') ?: 0,
            'id_spes' => $this->input->post('edt_id_spesialis_dokter') ?: 0,
            'id_subspes' => $this->input->post('edt_id_subspesialis_dokter') ?: 0,
            'hp' => $this->input->post('edt_no_hp'),
            'nosip' => $this->input->post('edt_nosip'),
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_dokter' => $id], $dataupd, 'mst_dokter');
        redirect('mst_dokter/mst_dokter/');
    }

    public function deleteitempo_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'aktif' => 0,
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_dokter' => $id], $dataupd, 'mst_dokter');
        echo '"ok"';
    }

    public function aktifasiitempo_dokter()
    {
        $username = $this->session->userdata('sp')->login_name ?? 'system';
        $datetime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $dataupd = [
            'aktif' => 1,
            'updated' => $datetime,
            'updater' => $username
        ];
        $this->M_dokter->update_data(['id_dokter' => $id], $dataupd, 'mst_dokter');
        echo '"ok"';
    }
}
