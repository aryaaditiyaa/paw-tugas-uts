<?php

$logged = false;
$nama = '';
if (isset($session)) {
    $logged = $session->user_sudahlogin();
    $nama = $session->nama();
}

?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top py-2">
    <div class="container">
        <a class="navbar-brand" href="http://localhost/paw-tugas-uts/public">Aplikasi Keuangan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/paw-tugas-uts/public">
                        <i class='fas fa-home mr-1'></i>
                        Home
                    </a>
                </li>
                <?php if ($logged) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/paw-tugas-uts/public/pages/listuser.php">
                        <i class='fas fa-user mr-1'></i>
                        User
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class='fas fa-coins mr-1'></i>
                        Keuangan
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
                        <a class="dropdown-item d-flex align-items-center" href="http://localhost/paw-tugas-uts/public/pages/listkategori.php"><i
                                    class="mr-2 fas fa-ellipsis-h fa-fw"></i>Kategori</a>
                        <a class="dropdown-item d-flex align-items-center" href="http://localhost/paw-tugas-uts/public/pages/listpemasukan.php"><i
                                    class="mr-2 fab fa-get-pocket fa-fw"></i>Pemasukan</a>
                        <a class="dropdown-item d-flex align-items-center" href="http://localhost/paw-tugas-uts/public/pages/listpengeluaran.php"><i
                                    class="mr-2 fas fa-arrow-circle-right fa-fw"></i>Pengeluaran</a>
                        <a class="dropdown-item d-flex align-items-center" href="http://localhost/paw-tugas-uts/public/pages/balancereport.php"><i
                                    class="mr-2 fas fa-file-invoice fa-fw"></i>Balance</a>
                    </div>
                </li>
                <?php endif ?>
            </ul>
            <div class="navbar-nav">
                <?php if (!$logged) : ?>
                    <a href="http://localhost/paw-tugas-uts/public/pages/login.php"
                       class="btn btn-outline-secondary text-white my-2 my-sm-0">Login</a>
                    <a href="http://localhost/paw-tugas-uts/public/pages/register.php"
                       class="btn btn-secondary my-2 my-sm-0 ml-2">Register</a>
                <?php endif ?>
                <?php if ($logged) : ?>
                    <a class="nav-link">Hi <?php echo $nama ?></a>
                    <a href="http://localhost/paw-tugas-uts/public/pages/logout.php"
                       class="btn btn-secondary my-2 my-sm-0 ml-2">Logout</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>