<?php
require_once("../includes/database.php");
require_once("../includes/user.php");
require_once("../includes/helper.php");
require_once("../includes/session.php");
?>

<?php require_once("layouts/header.php") ?>
<?php require_once("layouts/navbar.php") ?>
    <main role="main" class="container">
        <?php echo cetak_pesan($pesan) ?>
        <div class="row">
            <div class="col text-center mt-5">
                <h1 class="display-3">Selamat Datang!</h1>
            </div>
        </div>
    </main><!-- /.container -->
<?php require_once("layouts/footer.php") ?>