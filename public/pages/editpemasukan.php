<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pemasukan.php");

$helperkategori = helperkategori();
$kategori = new Kategori;
$kategori->nilaikategori = 'masuk';
$foundkategori = $kategori->kategorikeuangan();
$aksi = $_GET['aksi'];
$id = $_GET['id'];

if ($aksi == 'hapus') {
    $pemasukan = new Pemasukan;
    $pemasukan->id = $id;
    $hasil = $pemasukan->hapus();
    if ($hasil) {
        $session->pesan("Pemasukan dengan ID " . $id . " berhasil dihapus");
        redirect_ke("listpemasukan.php");
    }
} else {
    $pemasukan = Pemasukan::cari_dengan_id($id);
    if (isset($_POST['save'])) {
        $pemasukan = new Pemasukan;
        $pemasukan->id = $id;
        $pemasukan->rupiah_masuk = $_POST['rupiah_masuk'];
        $pemasukan->kategori_pemasukan = $_POST['kategori_pemasukan'];
        $pemasukan->tanggal_masuk = $_POST['tanggal_masuk'];
        $hasil = $pemasukan->update();
        if ($hasil) {
            $session->pesan("Pemasukan dengan ID " . $id . " berhasil diperbarui");
            redirect_ke("listpemasukan.php");
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
                <h2 class="my-4">Update Pemasukan</h2>
                <form action="editpemasukan.php?aksi=edit&id=<?php echo $id ?>" method="POST">
                    <div class="form-group">
                        <label>Jumlah Rupiah</label>
                        <input type="number" class="form-control" min="0" step="1" placeholder="5000"
                               name="rupiah_masuk" value="<?php echo $pemasukan['rupiah_masuk'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori Pemasukan</label>
                        <select name="kategori_pemasukan" class="form-control">
                            <?php foreach ($foundkategori as $cat) : ?>
                                <option value="<?php echo $cat['id'] ?>" <?php (($cat['id'] == $pemasukan['kategori_pemasukan']) ? print("selected") : false) ?>><?php echo $cat['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" value="<?php echo $pemasukan['tanggal_masuk'] ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="save">Submit</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>