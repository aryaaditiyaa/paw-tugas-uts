<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

$aksi = $_GET['aksi'];
$uid = $_GET['uid'];

if ($aksi == 'hapus'){
    $user = new User;
    $user->id = $uid;
    $hasil = $user->hapus();
    if ($hasil){
        $session->pesan("User dengan ID " . $uid . " berhasil dihapus");
        redirect_ke("listuser.php");
    }
} else {
    $user = User::cari_dengan_id($uid);
    if (isset($_POST['save'])){
        $user = new User;
        $user->id = $uid;
        $user->nama = $_POST['nama'];
        $user->email = $_POST['email'];
        $hasil = $user->update();
        if ($hasil){
            $session->pesan("User dengan ID " . $uid . " berhasil diperbarui");
            redirect_ke("listuser.php");
        }
    }
}
?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
    <main role="main" class="container">

        <?php echo cetak_pesan($pesan) ?>
        <div class="row justify-content-center">
            <div class="col-lg">
                <h2 class="my-4">Update Profile</h2>
                <form action="edituser.php?aksi=edit&uid=<?php echo $user['id']?>" method="POST">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $user['nama']?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $user['email']?>">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="save">Update</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>