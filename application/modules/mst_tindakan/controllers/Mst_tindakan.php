<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mst_tindakan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tindakan');
        if (!isset($this->session->userdata['sp']->username)) {
            redirect('auth');
        }
    }

    public function index()
    {
        $this->mst_tindakan();
    }

    public function mst_tindakan()
    {
        $data['datalist'] = $this->M_tindakan->list_tindakan();
        $data['datalistgroup'] = $this->M_tindakan->list_group();
        $this->load->view('mst/views/mst_tindakan', $data);
    }

    public function mst_tindakan_grup()
    {
        $data['datalist'] = $this->M_tindakan->list_group();
        $this->load->view('mst/views/mst_tindakan_grup', $data);
    }

    public function save_tindakan_grup()
    {
        $data = [
            'name' => $this->input->post('nama_grup'),
            'description' => $this->input->post('deskripsi'),
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->M_tindakan->insert_group($data);
        redirect('mst/mst_tindakan_grup');
    }

    public function update_tindakan_grup()
    {
        $id = $this->input->post('id_group');
        $data = [
            'name' => $this->input->post('nama_grup'),
            'description' => $this->input->post('deskripsi'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->M_tindakan->update_group($id, $data);
        redirect('mst/mst_tindakan_grup');
    }

    public function deleteitempo_tindakan_grup()
    {
        $id = $this->input->post('id');
        $this->M_tindakan->update_group($id, ['active' => 0]);
    }

    public function aktifasiitempo_tindakan_grup()
    {
        $id = $this->input->post('id');
        $this->M_tindakan->update_group($id, ['active' => 1]);
    }
}
