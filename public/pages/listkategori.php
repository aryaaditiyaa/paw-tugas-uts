<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");

if (isset($session)){
    $logged = $session->user_sudahlogin();
    if (!$logged){
        redirect_ke("login.php");
    }
}
$kategori = Kategori::cari_semua();
$totalkategori = Kategori::total_semua();
?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
    <main role="main" class="container">

        <?php echo cetak_pesan($pesan) ?>
        <div class="row my-3 align-items-center">
            <div class="col-8">
                <h2>Daftar Kategori</h2>
            </div>
            <div class="col-4 text-right">
                <a href="newkategori.php" class="btn btn-primary">
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
                        <th scope="col">Code</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($kategori as $kat) : ?>
                        <tr>
                            <th scope="row"><?php echo $kat['code']?></th>
                            <td><?php echo $kat['kategori_type']?></td>
                            <td><?php echo $kat['nama']?></td>
                            <td>
                                <a href="editkategori.php?aksi=edit&id=<?php echo $kat['id']?>"><i class="far fa-edit"></i></a>
                                <a href="editkategori.php?aksi=hapus&id=<?php echo $kat['id']?>"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>