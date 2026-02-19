<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Theme {

    var $CI;
    var $db, $db2, $db3;
    var $session, $session_name;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->db  = $this->CI->db;
        if (isset($this->CI->db2)) $this->db2 = $this->CI->db2;
        if (isset($this->CI->db3)) $this->db3 = $this->CI->db3;

        $this->session = $this->CI->session;
        $this->session_name = $this->CI->session->session_name;
    }

    public function head($theme = 'theme_default')
    {
        $this->CI->load->view("../modules/$theme/views/vhead");
    }

    /**
     * Fungsi recursive untuk mengambil semua child
     */
    private function getChildren($parent_id, $id_role)
    {
        $sql = "
            SELECT b.*
            FROM smart_rolemenu a
            JOIN smart_submenu b ON a.id_submenu = b.id_submenu
            WHERE a.id_role = '$id_role'
              AND b.parent_id = '$parent_id'
              AND b.is_child = 1
              AND b.aktif = 1
            ORDER BY b.no_urut ASC
        ";

        $query = $this->db->query($sql);
        $rows = $query->result_array();

        // Rekursif → cari anak dari anak
        foreach ($rows as $k => $r) {
            $rows[$k]['children'] = $this->getChildren($r['id_submenu'], $id_role);
        }

        return $rows;
    }

    /**
     * Wrapper Open → ambil MENU + PARENT SUBMENU + CHILDREN nested
     */
    public function wrapper_open($theme = 'theme_default', $breadcrum = array())
    {
        if($theme=='theme_portal_pasien')
        {
          $data = array(
            'breadcrum' => $breadcrum,
          );
          $this->CI->load->view('../modules/'.$theme.'/views/vwrapper_open', $data);
          return;
        }
        
        if (!isset($this->session->userdata['sp'])) {
            redirect('auth/login');
        }

        $id_role = $this->session->userdata['sp']->id_role;

        /**
         * 1. Ambil MENU SESUAI ROLE
         */
        $sqlMenu = "
            SELECT DISTINCT c.*
            FROM smart_rolemenu a
            JOIN smart_submenu b ON a.id_submenu = b.id_submenu
            JOIN smart_menu c    ON b.id_menu = c.id_menu
            WHERE a.id_role = '$id_role'
              AND b.aktif = 1
              AND c.aktif = 1
            ORDER BY c.urutan ASC
        ";

        $queryMenu = $this->db->query($sqlMenu);
        $menuList = $queryMenu->result_array();

        /**
         * 2. Untuk setiap MENU → ambil PARENT SUBMENU
         *    is_parent = 1 → parent
         */
        foreach ($menuList as $m => $menu) {

            $sqlParent = "
                SELECT b.*
                FROM smart_rolemenu a
                JOIN smart_submenu b ON a.id_submenu = b.id_submenu
                WHERE a.id_role = '$id_role'
                  AND b.id_menu = '{$menu['id_menu']}'
                  AND b.is_parent = 1
                  AND b.aktif = 1
                ORDER BY b.no_urut ASC
            ";

            $queryParent = $this->db->query($sqlParent);
            $parentList = $queryParent->result_array();

            /**
             * 3. Untuk setiap parent → ambil CHILD (nested)
             */
            foreach ($parentList as $p => $parent) {
                $parentList[$p]['children'] = $this->getChildren($parent['id_submenu'], $id_role);
            }

            // simpan submenu ke menu induknya
            $menuList[$m]['rs_submenu'] = $parentList;
        }

        // data ke view
        $data = array(
            'rs'        => $menuList,
            'breadcrum' => $breadcrum
        );

        $this->CI->load->view("../modules/$theme/views/vwrapper_open", $data);
    }

    public function wrapper_close($theme = 'theme_default')
    {
        $this->CI->load->view("../modules/$theme/views/vwrapper_close");
    }

    public function footer($theme = 'theme_default')
    {
        $this->CI->load->view("../modules/$theme/views/vfooter");
    }

    public function script($theme = 'theme_default')
    {
        $this->CI->load->view("../modules/$theme/views/vscript");
    }
}
