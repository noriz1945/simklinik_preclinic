<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_menu");

        if (!isset($this->session->userdata['sp']->username)) {
            redirect("auth");
        }
    }

    public function index(): void
    {
        $data['menu_data'] = $this->M_menu->get_all();
        $this->load->view("menu_list", $data);
    }

    public function create(): void
    {
        $data = [
            'button' => 'Simpan',
            'action' => site_url('smart_menu/menu/insert'),
            'id_menu' => '',
            'menu' => '',
            'icon' => '',
            'urutan' => '',
            'aktif' => 1,
        ];

        $this->load->view("menu_form", $data);
    }

    public function insert(): void
    {
        $data = [
            'menu' => $this->input->post("menu"),
            'icon' => $this->input->post("icon"),
            'urutan' => $this->input->post("urutan"),
            'aktif' => $this->input->post("aktif"),
        ];

        $this->M_menu->insert($data);

        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>Menu berhasil ditambahkan</div>");
        redirect("smart_menu");
    }

    public function update(int $id): void
    {
        $row = $this->M_menu->get_by_id($id);
        if (!$row)
            show_404();

        $data = [
            'button' => 'Update',
            'action' => site_url('smart_menu/menu/update_action'),
            'id_menu' => $row->id_menu,
            'menu' => $row->menu,
            'icon' => $row->icon,
            'urutan' => $row->urutan,
            'aktif' => $row->aktif,
        ];

        $this->load->view("menu_form", $data);
    }

    public function update_action(): void
    {
        $id = $this->input->post("id_menu");
        $data = [
            'menu' => $this->input->post("menu"),
            'icon' => $this->input->post("icon"),
            'urutan' => $this->input->post("urutan"),
            'aktif' => $this->input->post("aktif"),
        ];

        $this->M_menu->update($id, $data);

        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>Menu berhasil diperbarui</div>");
        redirect("smart_menu");
    }

    public function delete(int $id): void
    {
        $this->M_menu->delete($id);
        $this->session->set_flashdata("msg", "<div class='alert alert-danger border-0 shadow-sm'>Menu berhasil dihapus</div>");
        redirect("smart_menu");
    }
}

