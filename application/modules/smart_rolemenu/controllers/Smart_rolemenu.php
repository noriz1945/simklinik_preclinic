<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Smart_rolemenu extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_rolemenu");

        if (!isset($this->session->userdata['sp']->username)) {
            redirect("auth");
        }
    }

    public function index(): void
    {
        $data['role_data'] = $this->M_rolemenu->get_roles();
        $this->load->view("role_list", $data);
    }

    public function create(): void
    {
        $data = [
            'button' => 'Simpan',
            'action' => site_url('smart_rolemenu/insert'),
            'id_role' => '',
            'nama' => '',
            'aktif' => 1,
        ];
        $this->load->view("role_form_crud", $data);
    }

    public function insert(): void
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'aktif' => $this->input->post('aktif'),
        ];
        $this->db->insert("smart_role", $data);
        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>Role berhasil ditambahkan</div>");
        redirect("smart_rolemenu");
    }

    public function update(int $id): void
    {
        $row = $this->db->where("id_role", $id)->get("smart_role")->row();
        if (!$row)
            show_404();

        $data = [
            'button' => 'Update',
            'action' => site_url('smart_rolemenu/update_action'),
            'id_role' => $row->id_role,
            'nama' => $row->nama,
            'aktif' => $row->aktif,
        ];
        $this->load->view("role_form_crud", $data);
    }

    public function update_action(): void
    {
        $id = $this->input->post("id_role");
        $data = [
            'nama' => $this->input->post('nama'),
            'aktif' => $this->input->post('aktif'),
        ];
        $this->db->where("id_role", $id)->update("smart_role", $data);
        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>Role berhasil diperbarui</div>");
        redirect("smart_rolemenu");
    }

    public function delete(int $id): void
    {
        $this->M_rolemenu->delete_role($id);
        $this->session->set_flashdata("msg", "<div class='alert alert-danger border-0 shadow-sm'>Role berhasil dihapus</div>");
        redirect("smart_rolemenu");
    }

    /**
     * MANAGE ACCESS MATRIX
     */
    public function manage(int $id_role): void
    {
        $data['role'] = $this->db->where("id_role", $id_role)->get("smart_role")->row();
        $data['menu_all'] = $this->M_rolemenu->get_menu_nested();
        $data['selected'] = $this->M_rolemenu->get_role_access($id_role);
        $data['id_role'] = $id_role;

        $this->load->view("role_form", $data);
    }

    public function save_manage(): void
    {
        $id_role = $this->input->post("id_role");
        $access = $this->input->post("access");

        $this->M_rolemenu->clear_role($id_role);

        if (!empty($access)) {
            $data = [];
            foreach ($access as $id_sub) {
                $data[] = [
                    'id_role' => $id_role,
                    'id_submenu' => $id_sub
                ];
            }
            $this->M_rolemenu->insert_role_menu($data);
        }

        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>Hak akses role berhasil diperbarui</div>");
        redirect("smart_rolemenu/manage/" . $id_role);
    }
}

