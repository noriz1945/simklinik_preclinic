<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{
    private string $table = "smart_menu";

    public function get_all(): array
    {
        return $this->db->order_by("urutan", "ASC")->get($this->table)->result();
    }

    public function get_by_id(int $id)
    {
        return $this->db->where("id_menu", $id)->get($this->table)->row();
    }

    public function insert(array $data): bool
    {
        return $this->db->insert($this->table, $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->where("id_menu", $id)->update($this->table, $data);
    }

    public function delete(int $id): bool
    {
        return $this->db->where("id_menu", $id)->delete($this->table);
    }
}

