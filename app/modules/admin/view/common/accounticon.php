<?php
$admin = Leaf\Http\Session::get('admin');
if($admin) {
    ?>
    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open menu">
            <span class="avatar avatar-sm">
            <?php
                echo (isset($admin->first_name[0]))? $admin->first_name[0]:'';
                echo (isset($admin->last_name[0]))? $admin->last_name[0]:'';
            ?>
            </span>
            <div class="d-none d-xl-block ps-2">
                <div><?php echo $admin->first_name.' '.$admin->last_name ?></div>
                <div class="mt-1 small text-muted"><?php echo ucfirst($admin->role) ?></div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="#" class="dropdown-item">Profile &amp; account</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">Settings</a>
            <a href="<?= SITE_URL ?>/admin/logout" class="dropdown-item">Logout</a>
        </div>
    </div>
<?php } ?>

