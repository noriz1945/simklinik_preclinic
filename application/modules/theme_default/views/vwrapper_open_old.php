<?php
/**
 * RECURSIVE RENDER SUBMENU – SAFE VERSION
 */
if (!function_exists('render_submenu')) {

    function render_submenu($items)
    {
        if (empty($items)) return;

        echo '<ul class="pcoded-submenu">';

        foreach ($items as $item) {

            $hasChild = !empty($item['children']);
            $liClass  = $hasChild ? 'pcoded-hasmenu' : '';

            echo '<li class="'.$liClass.'">';

            if ($hasChild) {

                echo '<a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">'.$item['submenu'].'</span>
                      </a>';

                // RECURSIVE CALL
                render_submenu($item['children']);

            } else {

                echo '<a href="'.base_url($item['url']).'" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">'.$item['submenu'].'</span>
                      </a>';
            }

            echo '</li>';
        }

        echo '</ul>';
    }

}
?>



<!-- ===================================================== -->
<!-- ===============  START PCODED MAIN WRAPPER  ========== -->
<!-- ===================================================== -->

<body>
    <div class="loader-bg"><div class="loader-bar"></div></div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">


            <!-- ============================= -->
            <!--          HEADER BAR          -->
            <!-- ============================= -->

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a href="<?php echo base_url(''); ?>">
                            <img class="img-fluid" src="<?php echo base_url('assets/img/logo.png'); ?>" 
                                 alt="Theme-Logo" width="150px" />
                        </a>
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu icon-toggle-right"></i>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">

                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" 
                                   class="waves-effect waves-light">
                                    <i class="full-screen feather icon-maximize"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo base_url('assets/core/images/Sample_User_Icon.png'); ?>" 
                                             class="img-radius" alt="User-Profile-Image">
                                        <span><?php echo $this->session->userdata['sp']->name; ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>

                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="<?php echo base_url('auth/logout'); ?>">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>


            <!-- ===================================================== -->
            <!--                    MAIN + SIDEBAR                     -->
            <!-- ===================================================== -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <!-- ============================= -->
                    <!--           SIDEBAR             -->
                    <!-- ============================= -->

                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar">

                            <ul class="pcoded-item">

                                <!-- LOOP MENU UTAMA -->
                                <?php foreach ($rs as $menu): ?>

                                    <li class="pcoded-hasmenu">

                                        <a href="javascript:void(0)" class="waves-effect waves-dark">

                                            <span class="pcoded-micon">
                                                <i class="feather icon-sidebar"></i>
                                            </span>

                                            <?php if (!empty($menu['icon'])): ?>
                                                <i class="<?= $menu['icon']; ?>"></i>
                                            <?php endif; ?>

                                            <span class="pcoded-mtext"><?= $menu['menu']; ?></span>
                                        </a>

                                        <!-- SUBMENU LEVEL 1 -->
                                        <ul class="pcoded-submenu">

                                            <?php foreach ($menu['rs_submenu'] as $parent): ?>

                                                <?php 
                                                    $hasChild = !empty($parent['children']);
                                                    $liClass  = $hasChild ? "pcoded-hasmenu" : "";
                                                ?>

                                                <li class="<?= $liClass; ?>">

                                                    <?php if ($hasChild): ?>

                                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext"><?= $parent['submenu']; ?></span>
                                                        </a>

                                                        <!-- RENDER CHILD -->
                                                        <?php render_submenu($parent['children']); ?>

                                                    <?php else: ?>

                                                        <a href="<?= base_url($parent['url']); ?>" 
                                                           class="waves-effect waves-dark">
                                                           <span class="pcoded-mtext">
                                                               <?= $parent['submenu']; ?>
                                                           </span>
                                                        </a>

                                                    <?php endif; ?>

                                                </li>

                                            <?php endforeach; ?>

                                        </ul>

                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        </div>
                    </nav>
