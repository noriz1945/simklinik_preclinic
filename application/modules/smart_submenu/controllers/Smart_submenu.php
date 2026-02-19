<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Smart_submenu extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("smart_menu/M_menu", "MenuModel");
        $this->load->model("smart_submenu/M_submenu", "SubmenuModel");

        if (!isset($this->session->userdata['sp']->username)) {
            redirect("auth");
        }
    }

    public function index(): void
    {
        $data['menu_list'] = $this->MenuModel->get_all();
        $data['submenu_data'] = $this->SubmenuModel->get_all();
        $this->load->view("submenu_list", $data);
    }

    public function create(): void
    {
        $data = [
            'button' => 'Simpan',
            'action' => site_url('smart_submenu/insert'),
            'menu_list' => $this->MenuModel->get_all(),
            'parent_list' => $this->SubmenuModel->get_parent_only(),
            'id_submenu' => '',
            'id_menu' => '',
            'submenu' => '',
            'url' => '',
            'icon' => '',
            'no_urut' => '',
            'is_parent' => 1,
            'parent_id' => '',
            'aktif' => 1,
        ];

        $this->load->view("submenu_form", $data);
    }

    public function insert(): void
    {
        $is_parent = (int) $this->input->post("is_parent");
        $parent_id = ($is_parent === 0) ? $this->input->post("parent_id") : null;

        $data = [
            'id_menu' => $this->input->post("id_menu"),
            'submenu' => $this->input->post("submenu"),
            'url' => $this->input->post("url"),
            'icon' => $this->input->post("icon"),
            'no_urut' => $this->input->post("no_urut"),
            'is_parent' => $is_parent,
            'is_child' => ($is_parent === 0 ? 1 : 0),
            'parent_id' => $parent_id,
            'aktif' => $this->input->post("aktif"),
        ];

        $this->SubmenuModel->insert($data);

        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>Submenu berhasil ditambahkan</div>");
        redirect("smart_submenu");
    }

    public function update(int $id): void
    {
        $row = $this->SubmenuModel->get_by_id($id);
        if (!$row)
            show_404();

        $data = [
            'button' => 'Update',
            'action' => site_url('smart_submenu/update_action'),
            'menu_list' => $this->MenuModel->get_all(),
            'parent_list' => $this->SubmenuModel->get_parent_only(),
            'id_submenu' => $row->id_submenu,
            'id_menu' => $row->id_menu,
            'submenu' => $row->submenu,
            'url' => $row->url,
            'icon' => $row->icon,
            'no_urut' => $row->no_urut,
            'is_parent' => $row->is_parent,
            'parent_id' => $row->parent_id,
            'aktif' => $row->aktif,
        ];

        $this->load->view("submenu_form", $data);
    }

    public function update_action(): void
    {
        $id = $this->input->post("id_submenu");
        $is_parent = (int) $this->input->post("is_parent");
        $parent_id = ($is_parent === 0) ? $this->input->post("parent_id") : null;

        $data = [
            'id_menu' => $this->input->post("id_menu"),
            'submenu' => $this->input->post("submenu"),
            'url' => $this->input->post("url"),
            'icon' => $this->input->post("icon"),
            'no_urut' => $this->input->post("no_urut"),
            'is_parent' => $is_parent,
            'is_child' => ($is_parent === 0 ? 1 : 0),
            'parent_id' => $parent_id,
            'aktif' => $this->input->post("aktif"),
        ];

        $this->SubmenuModel->update($id, $data);

        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>Submenu berhasil diperbarui</div>");
        redirect("smart_submenu");
    }

    public function delete(int $id): void
    {
        $this->SubmenuModel->delete_recursive($id);
        $this->session->set_flashdata("msg", "<div class='alert alert-danger border-0 shadow-sm'>Submenu berhasil dihapus</div>");
        redirect('smart_submenu');
    }
}

