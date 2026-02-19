<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mst_umum extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_umum");
        if (!isset($this->session->userdata['sp']->username)) {
            redirect("auth");
        }
    }

    public function index()
    {
        $this->mst_kelas();
    }

    public function mst_kelas()
    {
        $data['datalist'] = $this->M_umum->list_kelas();
        $this->load->view('mst_kelas', $data);
    }

    public function mst_setting_param_harga()
    {
        $this->load->view('mst_markup');
    }

    public function mst_rak()
    {
        $this->load->view('mst_rak');
    }
}

