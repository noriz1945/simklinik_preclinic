<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_submenu extends CI_Model
{
    private string $table = "smart_submenu";

    public function get_all(): array
    {
        $this->db->select("s.*, m.menu");
        $this->db->from("{$this->table} s");
        $this->db->join("smart_menu m", "m.id_menu = s.id_menu", "left");
        $this->db->order_by("s.id_menu ASC, s.is_parent DESC, s.parent_id ASC, s.no_urut ASC");
        return $this->db->get()->result();
    }

    public function get_by_id(int $id)
    {
        return $this->db->where("id_submenu", $id)->get($this->table)->row();
    }

    public function get_parent_only(): array
    {
        return $this->db
            ->where("is_parent", 1)
            ->where("aktif", 1)
            ->order_by("no_urut", "ASC")
            ->get($this->table)
            ->result();
    }

    public function get_menu_name($id_menu): string
    {
        $q = $this->db->where("id_menu", $id_menu)->get("smart_menu")->row();
        return $q ? (string) $q->menu : "-";
    }

    public function get_submenu_name($id_submenu): string
    {
        $q = $this->db->where("id_submenu", $id_submenu)->get($this->table)->row();
        return $q ? (string) $q->submenu : "-";
    }

    public function insert(array $data): bool
    {
        return $this->db->insert($this->table, $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->where("id_submenu", $id)->update($this->table, $data);
    }

    public function delete_recursive(int $id): void
    {
        // Delete the item itself
        $this->db->where('id_submenu', $id)->delete($this->table);
        // Delete children if it was a parent
        $this->db->where('parent_id', $id)->delete($this->table);
    }
}

