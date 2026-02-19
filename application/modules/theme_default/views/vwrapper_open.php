<?php
/**
 * RECURSIVE RENDER SUBMENU ??? MATCHING TEMPLATE STRUCTURE
 */
if (!function_exists('render_submenu_new')) {
    function render_submenu_new($items, $level = 2)
    {
        if (empty($items))
            return;

        echo '<ul>';
        foreach ($items as $item) {
            $hasChild = !empty($item['children']);
            $current_url = current_url();
            $item_url = base_url($item['url']);
            $active_class = ($current_url == $item_url) ? 'active' : '';

            if ($hasChild) {
                $li_class = ($level >= 2) ? 'submenu submenu-two' : 'submenu';
                echo '<li class="' . $li_class . '">';

                $arrow_class = ($level >= 2) ? 'menu-arrow inside-submenu' : 'menu-arrow';
                echo '<a href="javascript:void(0);" class="' . $active_class . '"><span>' . $item['submenu'] . '</span><span class="' . $arrow_class . '"></span></a>';

                render_submenu_new($item['children'], $level + 1);
                echo '</li>';
            } else {
                echo '<li><a href="' . $item_url . '" class="' . $active_class . '">' . $item['submenu'] . '</a></li>';
            }
        }
        echo '</ul>';
    }
}

/**
 * GET VARIATED MENU ICON BASED ON NAME
 */
if (!function_exists('get_variated_icon')) {
    function get_variated_icon($menu_name, $existing_icon = '')
    {
        if (!empty($existing_icon) && strpos($existing_icon, 'ti-') !== false) {
            return $existing_icon;
        }

        $name = strtolower($menu_name);

        $icons = [
            'dashboard' => 'ti ti-layout-dashboard',
            'pendaftaran' => 'ti ti-user-plus',
            'registrasi' => 'ti ti-address-book',
            'pasien' => 'ti ti-users',
            'dokter' => 'ti ti-stethoscope',
            'rekam medis' => 'ti ti-clipboard-list',
            'emr' => 'ti ti-notes',
            'kasir' => 'ti ti-cash',
            'keuangan' => 'ti ti-receipt-2',
            'billing' => 'ti ti-credit-card',
            'farmasi' => 'ti ti-pill',
            'obat' => 'ti ti-capsule',
            'apotek' => 'ti ti-medicine-syrup',
            'laboratorium' => 'ti ti-test-pipe',
            'lab' => 'ti ti-flask',
            'radiologi' => 'ti ti-scan',
            'laporan' => 'ti ti-file-description',
            'report' => 'ti ti-chart-bar',
            'pengaturan' => 'ti ti-settings',
            'setting' => 'ti ti-adjustments',
            'master' => 'ti ti-database',
            'user' => 'ti ti-user-shield',
            'antrian' => 'ti ti-list-numbers',
            'stok' => 'ti ti-box-seam',
            'inventori' => 'ti ti-package'
        ];

        foreach ($icons as $key => $icon) {
            if (strpos($name, $key) !== false) {
                return $icon;
            }
        }

        return 'ti ti-tag'; // Default icon
    }
}
?>

<!-- Begin Wrapper -->
<div class="main-wrapper">

    <!-- Topbar Start -->
    <header class="navbar-header">
        <div class="page-container topbar-menu">
            <div class="d-flex align-items-center gap-2">

                <!-- Topbar Logo (Normal) -->
                <a href="<?php echo base_url(); ?>" class="logo">
                    <span class="logo-light">
                        <span class="logo-lg"><img src="<?php echo base_url('assets/img/logo.svg'); ?>"
                                alt="logo"></span>
                        <span class="logo-sm"><img src="<?php echo base_url('assets/img/logo-small.svg'); ?>"
                                alt="small logo"></span>
                    </span>
                    <span class="logo-dark">
                        <span class="logo-lg"><img src="<?php echo base_url('assets/img/logo-white.svg'); ?>"
                                alt="dark logo"></span>
                    </span>
                </a>

                <!-- Sidebar Mobile Button -->
                <a id="mobile_btn" class="mobile-btn" href="#sidebar">
                    <i class="ti ti-menu-deep fs-24"></i>
                </a>

                <button class="sidenav-toggle-btn btn border-0 p-0 active" id="toggle_btn2">
                    <i class="ti ti-arrow-right"></i>
                </button>
            </div>

            <div class="d-flex align-items-center">

                <!-- Light/Dark Mode Button -->
                <div class="header-item d-none d-sm-flex me-2">
                    <button class="topbar-link btn btn-icon topbar-link" id="light-dark-mode" type="button">
                        <i class="ti ti-moon fs-16"></i>
                    </button>
                </div>

                <!-- User Info Dynamically from Session -->
                <div class="header-item">
                    <div class="dropdown border-start ps-3">
                        <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="avatar avatar-md border">
                                <img src="<?php echo base_url('assets/img/profiles/avatar-01.jpg'); ?>" alt="img"
                                    class="rounded-circle">
                                <span class="status online"></span>
                            </span>
                            <span class="ms-2 d-none d-sm-inline-block text-dark fw-medium">
                                <?php echo isset($this->session->userdata['sp']->name) ? $this->session->userdata['sp']->name : 'User'; ?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-2">
                            <div class="p-2 border-bottom mb-2 text-center text-sm-start">
                                <h6 class="mb-0 text-dark">
                                    <?php echo isset($this->session->userdata['sp']->name) ? $this->session->userdata['sp']->name : 'User'; ?>
                                </h6>
                                <p class="mb-0 fs-12 text-muted">Administrator</p>
                            </div>
                            <a href="<?php echo base_url('auth/logout'); ?>" class="dropdown-item text-danger">
                                <i class="ti ti-logout me-1 align-middle"></i>
                                <span class="align-middle">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Sidebar Start -->
    <div class="sidebar" id="sidebar">

        <!-- Sidebar Logo -->
        <div class="sidebar-logo">
            <div>
                <!-- Logo Normal -->
                <a href="<?php echo base_url(); ?>" class="logo logo-normal">
                    <img src="<?php echo base_url('assets/img/logo.svg'); ?>" alt="Logo">
                </a>

                <!-- Logo Small -->
                <a href="<?php echo base_url(); ?>" class="logo-small">
                    <img src="<?php echo base_url('assets/img/logo-small.svg'); ?>" alt="Logo">
                </a>

                <!-- Logo Dark -->
                <a href="<?php echo base_url(); ?>" class="dark-logo">
                    <img src="<?php echo base_url('assets/img/logo-white.svg'); ?>" alt="Logo">
                </a>
            </div>
            <!-- Sidenav Toggle Desktop Button -->
            <button class="sidenav-toggle-btn btn border-0 p-0 active" id="toggle_btn">
                <i class="ti ti-arrow-left text-body"></i>
            </button>

            <!-- Sidebar Menu Close Mobile Button -->
            <button class="sidebar-close">
                <i class="ti ti-x align-middle"></i>
            </button>
        </div>
        <!-- /Sidebar Logo -->

        <div class="sidebar-inner" data-simplebar>
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title"><span>Main Menu</span></li>
                    <li>
                        <ul>
                            <?php if (isset($rs)): ?>
                                <?php foreach ($rs as $menu): ?>
                                    <li class="submenu">
                                        <a href="javascript:void(0);">
                                            <i class="<?= get_variated_icon($menu['menu'], $menu['icon']) ?>"></i>
                                            <span><?= $menu['menu']; ?></span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul>
                                            <?php foreach ($menu['rs_submenu'] as $parent): ?>
                                                <?php if (!empty($parent['children'])): ?>
                                                    <li class="submenu submenu-two">
                                                        <a href="javascript:void(0);">
                                                            <span><?= $parent['submenu']; ?></span>
                                                            <span class="menu-arrow inside-submenu"></span>
                                                        </a>
                                                        <?php render_submenu_new($parent['children'], 3); ?>
                                                    </li>
                                                <?php else: ?>
                                                    <?php
                                                    $item_url = base_url($parent['url']);
                                                    $active = (current_url() == $item_url) ? 'active' : '';
                                                    ?>
                                                    <li><a href="<?= $item_url; ?>"
                                                            class="<?= $active ?>"><?= $parent['submenu']; ?></a></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Start Page Content -->
    <div class="page-wrapper">
