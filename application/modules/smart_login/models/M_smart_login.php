<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_smart_login extends CI_Model
{
    private string $table = "smart_login";

    public function all(): array
    {
        return $this->db->order_by("username", "ASC")->get($this->table)->result();
    }

    public function get(string $username)
    {
        return $this->db->where("username", $username)->get($this->table)->row();
    }

    public function insert(array $data): bool
    {
        return $this->db->insert($this->table, $data);
    }

    public function update(string $username, array $data): bool
    {
        return $this->db->where("username", $username)->update($this->table, $data);
    }

    public function delete(string $username): bool
    {
        return $this->db->where("username", $username)->delete($this->table);
    }

    public function role_list(): array
    {
        return $this->db->get("smart_role")->result();
    }

    public function get_role_name($id_role): string
    {
        $q = $this->db->where("id_role", $id_role)
            ->get("smart_role")
            ->row();

        return $q ? (string) $q->nama : "-";
    }

    public function dokter_list(): array
    {
        return $this->db->get("mst_dokter")->result();
    }

    public function filter(?string $keyword = null, ?string $role = null, ?string $sup = null): array
    {
        if (!empty($keyword)) {
            $this->db->group_start()
                ->like("username", $keyword)
                ->or_like("name", $keyword)
                ->group_end();
        }

        if ($role !== null && $role !== "") {
            $this->db->where("id_role", $role);
        }

        if ($sup !== null && $sup !== "") {
            $this->db->where("id_dokter", $sup);
        }

        return $this->db->order_by("username", "ASC")
            ->get($this->table)->result();
    }
}

