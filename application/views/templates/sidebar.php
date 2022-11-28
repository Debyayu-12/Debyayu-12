<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WEB RPL <sup>1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mb-3">

    <!-- Nav Item - Dashboard -->
    <!-- query menu -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = " SELECT `user_menu`.`id`, `menu`
                    FROM `user_menu` JOIN `user_access_menu`
                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";

    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <?php foreach ($menu as $m) : ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>
        <!-- sub menu -->
        <?php
        $menuId = $m['id'];
        $querysubMenu = " SELECT *
                            FROM `user_sub_menu` JOIN `user_menu`
                              ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                            WHERE `user_sub_menu`.`menu_id` = $menuId
                              AND `user_sub_menu`.`is_active` = 1
                            ";
        $subMenu = $this->db->query($querysubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <li class="nav-item">
                <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                    <i class="<?= $sm['icon'] ?>"></i>
                    <span><?= $sm['title'] ?></span></a>
            </li>
        <?php endforeach; ?>

    <?php endforeach; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <!-- </ul> -->