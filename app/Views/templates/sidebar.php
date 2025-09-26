<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url('asset/dist/img/') ?>" alt="" width="80%" class="brand-image" style="opacity: .8"><br>
        <!-- <span class="brand-text font-weight-light">Manajemen Karyawan</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url(strtolower(session()->get('jabatan'))) ?>/index" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= base_url(strtolower(session()->get('jabatan'))) ?>/profile" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

                <?php if(session()->get('jabatan') == 'Admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a href="<?= base_url(strtolower(session()->get('jabatan'))) ?>/program" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Program
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('login/logout'); ?>" class="nav-link">
                        <i class='nav-icon fas fa-sign-out-alt'></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    $(document).ready(function () {
        $('.has-treeview > a').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent();

            if (parent.hasClass('menu-open')) {
                parent.removeClass('menu-open');
                parent.find('.nav-treeview').slideUp();
            } else {
                parent.addClass('menu-open');
                parent.find('.nav-treeview').slideDown();
            }
        });
    });

</script>