<!-- navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('home') ?>">
                <img src="<?= base_url('') ?>assets/img/soccer-ball.png" alt="" width="30" class="d-inline-block align-text-top">
                <?= $titlenav ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if ($this->session->userdata('email') == false) : ?>
                    <li class="nav-item">
                        <a class="nav-link register tombol" href="<?= base_url('auth/registration') ?>">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger tombol" href="<?= base_url('auth') ?>">Login</a>
                    </li>
                <?php else : ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown"><img class="rounded-circle" width="30" height="30px" src="<?= base_url('assets/img/profile/' . $user['image']) ?>" alt=""> <?= $user['name'] ?></a>


                        <ul class="dropdown-menu shadow tab-pane fade" aria-labelledby="dropdownMenuButton1">
                            <?php if ($user['role_id'] == 1) : ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('admin') ?>"><i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>Dashboard</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item tombol-logout" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
                                </li>
                            <?php else : ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('user') ?>"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item tombol-logout" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav>

<!-- end of navbar -->