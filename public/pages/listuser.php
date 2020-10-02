<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

if (isset($session)){
    $logged = $session->user_sudahlogin();
    if (!$logged){
        redirect_ke("login.php");
    }
}
$users = User::cari_semua();
$totaluser = User::total_semua();
?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
    <main role="main" class="container">

        <?php echo cetak_pesan($pesan) ?>
        <div class="row justify-content-center">
            <div class="col-lg">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <th scope="row"><?php echo $user['id']?></th>
                            <td><?php echo $user['nama']?></td>
                            <td><?php echo $user['email']?></td>
                            <td>
                                <a href="edituser.php?aksi=edit&uid=<?php echo $user['id']?>"><i class="far fa-edit"></i></a>
                                <a href="edituser.php?aksi=hapus&uid=<?php echo $user['id']?>"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>