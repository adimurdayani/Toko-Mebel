<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <?php
                $user_id = $this->session->userdata('user_id');
                $querymenu = "SELECT `tb_menu`.`id_menu`,`menu`
                                FROM `tb_menu`
                                JOIN `tb_akses_menu` ON `tb_menu`.`id_menu` = `tb_akses_menu`.`menu_id`
                                WHERE `tb_akses_menu`.`user_id` = $user_id
                            ORDER BY `tb_menu`.`nomor_urut` ASC
                ";
                $menu = $this->db->query($querymenu)->result();
                ?>

                <?php foreach ($menu as $m) : ?>

                    <li class="menu-title"><?= $m->menu ?></li>

                    <?php
                    $menu_id = $m->id_menu;
                    $querysubmenu = "SELECT *
                        FROM `tb_submenu`
                        WHERE `tb_submenu`.`id_menu` = $menu_id
                        AND `tb_submenu`.`active`= 1
                        ORDER BY `tb_submenu`.`nomor_urut` ASC
                    ";
                    $submenu = $this->db->query($querysubmenu)->result();
                    ?>

                    <?php foreach ($submenu as $sm) : ?>
                        <li>
                            <a <?php if ($sm->collapse == 1) : ?> href="#<?= $sm->url ?>" <?php else : ?> href="<?= base_url($sm->url) ?>" <?php endif; ?> <?php if ($sm->collapse == 1) : ?> data-toggle="collapse" <?php endif; ?>>
                                <i class="<?= $sm->icon ?>"></i>
                                <span> <?= $sm->submenu ?></span>

                                <?php if ($sm->collapse == 1) : ?>
                                    <span class="menu-arrow"></span>
                                <?php endif; ?>
                            </a>
                            <div class="collapse" id="<?= $sm->url ?>">
                                <ul class="nav-second-level">
                                    <?php
                                    $submenu_id = $sm->id_submenu;
                                    $querysubmenu = "SELECT *
                                                        FROM `tb_submenu_expan`
                                                        WHERE `tb_submenu_expan`.`submenu_id` = $submenu_id AND `tb_submenu_expan`.`is_active` = 1                                                        
                                                        ORDER BY `tb_submenu_expan`.`nomor_urut` ASC
                                                    ";
                                    $submenuCollapse = $this->db->query($querysubmenu)->result();
                                    ?>

                                    <?php foreach ($submenuCollapse as $sc) : ?>
                                        <li>
                                            <a href="<?= base_url($sc->url) ?>"><?= $sc->judul ?></a>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                        </li>
                    <?php endforeach; ?>

                <?php endforeach; ?>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->