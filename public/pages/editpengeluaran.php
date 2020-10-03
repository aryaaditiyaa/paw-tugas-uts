<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pengeluaran.php");

$helperkategori = helperkategori();
$kategori = new Kategori;
$kategori->nilaikategori = 'keluar';
$foundkategori = $kategori->kategorikeuangan();
$aksi = $_GET['aksi'];
$id = $_GET['id'];

if ($aksi == 'hapus') {
    $pengeluaran = new Pengeluaran();
    $pengeluaran->id = $id;
    $hasil = $pengeluaran->hapus();
    if ($hasil) {
        $session->pesan("Pengeluaran dengan ID " . $id . " berhasil dihapus");
        redirect_ke("listpengeluaran.php");
    }
} else {
    $pengeluaran = Pengeluaran::cari_dengan_id($id);
    if (isset($_POST['save'])) {
        $pengeluaran = new Pengeluaran();
        $pengeluaran->id = $id;
        $pengeluaran->rupiah_keluar = $_POST['rupiah_keluar'];
        $pengeluaran->kategori_pengeluaran = $_POST['kategori_pengeluaran'];
        $pengeluaran->tanggal_keluar = $_POST['tanggal_keluar'];
        $hasil = $pengeluaran->update();
        if ($hasil) {
            $session->pesan("Pengeluaran dengan ID " . $id . " berhasil diperbarui");
            redirect_ke("listpengeluaran.php");
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
                <h2 class="my-4">Update Pengeluaran</h2>
                <form action="editpengeluaran.php?aksi=edit&id=<?php echo $id ?>" method="POST">
                    <div class="form-group">
                        <label>Jumlah Rupiah</label>
                        <input type="number" class="form-control" min="0" step="1" placeholder="5000"
                               name="rupiah_keluar" value="<?php echo $pengeluaran['rupiah_keluar'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori Pengeluaran</label>
                        <select name="kategori_pengeluaran" class="form-control">
                            <?php foreach ($foundkategori as $cat) : ?>
                                <option value="<?php echo $cat['id'] ?>" <?php (($cat['id'] == $pengeluaran['kategori_pengeluaran']) ? print("selected") : false) ?>><?php echo $cat['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Keluar</label>
                        <input type="date" class="form-control" name="tanggal_keluar" value="<?php echo $pengeluaran['tanggal_keluar'] ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="save">Submit</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>