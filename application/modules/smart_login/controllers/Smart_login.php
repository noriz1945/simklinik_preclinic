<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Smart_login extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_smart_login");
        $this->load->database();

        if (!isset($this->session->userdata['sp']->username)) {
            redirect("auth");
        }
    }

    public function index(): void
    {
        $keyword = $this->input->get("q");
        $role = $this->input->get("role");
        $sup = $this->input->get("sup");

        $data['title'] = "Master Login Pengguna";
        $data['list'] = $this->M_smart_login->filter($keyword, $role, $sup);
        $data['roles'] = $this->M_smart_login->role_list();
        $data['dok'] = $this->M_smart_login->dokter_list();

        // Pass filters back to view
        $data['q'] = $keyword;
        $data['role'] = $role;
        $data['supSel'] = $sup;

        $this->load->view("smart_login_list", $data);
    }

    public function create(): void
    {
        $data['title'] = "Tambah Pengguna";
        $data['roles'] = $this->M_smart_login->role_list();
        $data['sup'] = $this->M_smart_login->dokter_list();
        $data['row'] = null;

        $this->load->view("smart_login_form", $data);
    }

    public function edit(string $username): void
    {
        $data['title'] = "Edit Pengguna";
        $data['row'] = $this->M_smart_login->get($username);
        $data['roles'] = $this->M_smart_login->role_list();
        $data['sup'] = $this->M_smart_login->dokter_list();

        if (!$data['row']) {
            show_404();
        }

        $this->load->view("smart_login_form", $data);
    }

    /**
     * UNIFIED SAVE (Handles both ADD and EDIT)
     */
    public function save(): void
    {
        $mode = $this->input->post("mode");
        $username = $this->input->post("username");

        $data = [
            "name" => $this->input->post("name"),
            "id_role" => $this->input->post("id_role"),
            "id_dokter" => $this->input->post("id_dokter"),
            "aktif" => $this->input->post("aktif"),
            "nib" => $this->input->post("nib"),
            "nik" => $this->input->post("nik"),
        ];

        // Password handling
        $password = $this->input->post("password");
        if (!empty($password)) {
            $data["password"] = md5($password);
        }

        if ($mode === 'edit') {
            $data["updated"] = date("Y-m-d H:i:s");
            $data["updater"] = $this->session->userdata('sp')->username ?? 'system';
            $this->M_smart_login->update($username, $data);
            $msg = "Data pengguna updated!";
        } else {
            $data["username"] = $username;
            $data["created"] = date("Y-m-d H:i:s");
            $data["creator"] = $this->session->userdata('sp')->username ?? 'system';

            // Default password for new if empty (though form has required)
            if (empty($data["password"])) {
                $data["password"] = md5("123");
            }

            $this->M_smart_login->insert($data);
            $msg = "Data pengguna added!";
        }

        $this->session->set_flashdata("msg", "<div class='alert alert-success border-0 shadow-sm'>{$msg}</div>");
        redirect("smart_login");
    }

    public function delete(string $username): void
    {
        $this->M_smart_login->delete($username);
        $this->session->set_flashdata("msg", "<div class='alert alert-danger border-0 shadow-sm'>Data pengguna deleted.</div>");
        redirect("smart_login");
    }

    public function reset_password(string $username): void
    {
        $data = [
            "password" => md5("123"),
            "updated" => date("Y-m-d H:i:s"),
            "updater" => $this->session->userdata('sp')->username ?? 'system'
        ];

        $this->M_smart_login->update($username, $data);
        $this->session->set_flashdata("msg", "<div class='alert alert-warning border-0 shadow-sm'>Password reset to <b>123</b></div>");
        redirect("smart_login");
    }
}

