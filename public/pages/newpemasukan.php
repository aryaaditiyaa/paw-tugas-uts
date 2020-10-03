<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pemasukan.php");

$kategori = new Kategori;
$kategori->nilaikategori = 'masuk';
$foundkategori = $kategori->kategorikeuangan();

if (isset($_POST['save'])) {
    $pemasukan = new Pemasukan();

    $pemasukan->user_id = $session->uid;
    $pemasukan->rupiah_masuk = $_POST['rupiah_masuk'];
    $pemasukan->kategori_pemasukan = $_POST['kategori_pemasukan'];
    $pemasukan->tanggal_masuk = $_POST['tanggal_masuk'];

    $createstatus = $pemasukan->create();
    if ($createstatus) {
        $pesan = "Pemasukan berhasil ditambah";
        $session->pesan($pesan);
        redirect_ke("listpemasukan.php");
    }
}

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<main role="main" class="container">

    <div class="row">
        <div class="col-lg">
            <h2 class="my-4">Tambah Pemasukan Baru</h2>
            <form action="newpemasukan.php" method="POST">
                <div class="form-group">
                    <label>Jumlah Rupiah</label>
                    <input type="number" class="form-control" min="0" step="1" placeholder="5000" name="rupiah_masuk" required>
                </div>
                <div class="form-group">
                    <label>Kategori Pemasukan</label>
                    <select name="kategori_pemasukan" class="form-control">
                        <?php foreach ($foundkategori as $cat) : ?>
                            <option value="<?php echo $cat['id'] ?>"><?php echo $cat['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="save">Submit</button>
            </form>
        </div>
    </div>

</main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>

