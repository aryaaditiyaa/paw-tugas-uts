<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");

$helperkategori = helperkategori();

if (isset($_POST['save'])) {
    $kategori = new Kategori();

    $kategori->code = $_POST['code'];
    $kategori->nama = $_POST['nama'];
    $kategori->kategori_type = $_POST['kategori_type'];

    $createstatus = $kategori->create();
    if ($createstatus) {
        $pesan = "Kategori berhasil ditambah";
        $session->pesan($pesan);
        redirect_ke("listkategori.php");
    }
}

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<main role="main" class="container">

    <div class="row">
        <div class="col-lg">
            <h2 class="my-4">Tambah Kategori Baru</h2>
            <form action="newkategori.php" method="POST">
                <div class="form-group">
                    <label>Code</label>
                    <input type="text" class="form-control" name="code" required>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select name="kategori_type" class="form-control">
                        <?php foreach ($helperkategori as $key => $value) : ?>
                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="save">Submit</button>
            </form>
        </div>
    </div>

</main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>

