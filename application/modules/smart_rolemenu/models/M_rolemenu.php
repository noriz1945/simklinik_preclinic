<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rolemenu extends CI_Model
{
    public function get_roles(): array
    {
        return $this->db->order_by("nama", "ASC")->get("smart_role")->result();
    }

    public function delete_role(int $id): void
    {
        $this->db->where("id_role", $id)->delete("smart_role");
        $this->db->where("id_role", $id)->delete("smart_rolemenu");
    }

    /**
     * NESTED MENU FOR MATRIX UI
     */
    public function get_menu_nested(): array
    {
        $menus = $this->db->where("aktif", 1)->order_by("urutan", "ASC")->get("smart_menu")->result();
        $data = [];

        foreach ($menus as $m) {
            // Get Parent Submenus
            $parents = $this->db->where([
                "id_menu" => $m->id_menu,
                "is_parent" => 1,
                "aktif" => 1
            ])->order_by("no_urut", "ASC")->get("smart_submenu")->result();

            $parent_data = [];
            foreach ($parents as $p) {
                // Get Child Submenus
                $children = $this->db->where([
                    "parent_id" => $p->id_submenu,
                    "is_child" => 1,
                    "aktif" => 1
                ])->order_by("no_urut", "ASC")->get("smart_submenu")->result();

                $parent_data[] = [
                    'id_submenu' => $p->id_submenu,
                    'submenu' => $p->submenu,
                    'children' => $children
                ];
            }

            $m->children = $parent_data;
            $data[] = $m;
        }

        return $data;
    }

    public function get_role_access(int $id_role): array
    {
        $rows = $this->db->where("id_role", $id_role)->get("smart_rolemenu")->result();
        $arr = [];
        foreach ($rows as $r) {
            $arr[] = $r->id_submenu;
        }
        return $arr;
    }

    public function clear_role(int $id_role): bool
    {
        return $this->db->where("id_role", $id_role)->delete("smart_rolemenu");
    }

    public function insert_role_menu(array $data): bool
    {
        return $this->db->insert_batch("smart_rolemenu", $data);
    }
}

