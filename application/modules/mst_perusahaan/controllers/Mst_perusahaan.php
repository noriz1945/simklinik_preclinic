<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mst_perusahaan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_perusahaan");
        if (!isset($this->session->userdata['sp']->username)) {
            redirect("auth");
        }
    }

    public function index()
    {
        $this->mst_perusahaan();
    }

    public function mst_perusahaan()
    {
        $data['datalist'] = $this->M_perusahaan->list_perusahaan();
        $this->load->view('mst_perusahaan', $data);
    }

    public function mst_jenis_perusahaan()
    {
        $data['datalist'] = $this->M_perusahaan->list_jenis_perusahaan();
        $this->load->view('mst_jenis_perusahaan', $data);
    }

    public function mst_kategori_perusahaan()
    {
        $data['datalist'] = $this->M_perusahaan->list_kategori_perusahaan();
        $this->load->view('mst_kategori_perusahaan', $data);
    }
}

