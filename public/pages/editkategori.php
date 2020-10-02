<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");

$helperkategori = helperkategori();
$aksi = $_GET['aksi'];
$id = $_GET['id'];

if ($aksi == 'hapus') {
    $kategori = new Kategori();
    $kategori->id = $id;
    $hasil = $kategori->hapus();
    if ($hasil) {
        $session->pesan("Kategori dengan ID " . $id . " berhasil dihapus");
        redirect_ke("listkategori.php");
    }
} else {
    $kategori = Kategori::cari_dengan_id($id);
    if (isset($_POST['save'])) {
        $kategori = new Kategori();
        $kategori->id = $id;
        $kategori->code = $_POST['code'];
        $kategori->kategori_type = $_POST['kategori_type'];
        $kategori->nama = $_POST['nama'];
        $hasil = $kategori->update();
        if ($hasil) {
            $session->pesan("Kategori dengan ID " . $id . " berhasil diperbarui");
            redirect_ke("listkategori.php");
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
                <h2 class="my-4">Update Kategori</h2>
                <form action="editkategori.php?aksi=edit&id=<?php echo $id ?>" method="POST">
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" value="<?php echo $kategori['code'] ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="kategori_type" class="form-control">
                            <?php foreach ($helperkategori as $key => $value) : ?>
                                <option value="<?php echo $key ?>" <?php (($key == $kategori['kategori_type']) ? print('selected') : print('')) ?>><?php echo $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $kategori['nama'] ?>"
                               required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="save">Update</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>