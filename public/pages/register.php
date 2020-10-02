<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

if (isset($_POST['save'])) {
    $user = new User;

    $user->nama = $_POST['nama'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    $createstatus = $user->create();
    if ($createstatus) {
        $pesan = "Hi, " . $user->nama . " Welcome.";
        $session->pesan($pesan);
        redirect_ke("login.php");
    }
}

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

    <main role="main" class="container">

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <h2 class="my-4">Register Yourself</h2>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="save">Submit</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>