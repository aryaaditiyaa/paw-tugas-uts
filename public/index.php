<?php
require_once("../includes/database.php");
require_once("../includes/user.php");
require_once("../includes/helper.php");
require_once("../includes/session.php");
?>

<?php require_once("layouts/header.php") ?>
<?php require_once("layouts/navbar.php") ?>
<main role="main" class="container">
    <?php echo cetak_pesan($pesan)?>
    <div class="row">
        <div class="col">

        </div>
    </div>
</main><!-- /.container -->
<?php require_once("layouts/footer.php") ?>