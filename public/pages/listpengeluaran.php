<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pengeluaran.php");

$user = new User;
$kategori = new Kategori;

if (isset($session)){
    $logged = $session->user_sudahlogin();
    if (!$logged){
        redirect_ke("login.php");
    }
}
$pengeluaran = Pengeluaran::cari_semua();
$totalpengeluaran = Pengeluaran::total_semua();
?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
    <main role="main" class="container">

        <?php echo cetak_pesan($pesan) ?>
        <div class="row my-3 align-items-center">
            <div class="col-8">
                <h2>Daftar Pengeluaran</h2>
            </div>
            <div class="col-4 text-right">
                <a href="newpengeluaran.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Kasir</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Rupiah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pengeluaran as $peng) : ?>
                        <tr>
                            <th scope="row"><?php echo $user->nama($peng['user_id'])?></th>
                            <td><?php echo $kategori->nama($peng['kategori_pengeluaran'])?></td>
                            <td><?php echo $peng['tanggal_keluar']?></td>
                            <td><?php echo $peng['rupiah_keluar']?></td>
                            <td>
                                <a href="editpengeluaran.php?aksi=edit&id=<?php echo $peng['id']?>"><i class="far fa-edit"></i></a>
                                <a href="editpengeluaran.php?aksi=hapus&id=<?php echo $peng['id']?>"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>