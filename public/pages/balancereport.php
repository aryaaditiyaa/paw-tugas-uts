<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/balance.php");

$kategori = new Kategori;
$tahun = daftarTahun();
$bulan = daftarBulan();

$tahunnow = date("Y");
$bulannow = date("M");

if (isset($_POST['save'])) {
    $tahunnow = $_POST['tahun'];
    $bulannow = $_POST['bulan'];
}

$balance = new Balance;
$balance->tahun = $tahunnow;
$balance->bulan = $bulannow;
$totalpengeluaran = $balance->totalpengeluaran();
$totalpemasukan = $balance->totalpemasukan();
$profit = $totalpemasukan - $totalpengeluaran;
$itempemasukan = $balance->itempemasukan();
$itempengeluaran = $balance->itempengeluaran();

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<main role="main" class="container">

    <form action="balancereport.php" method="POST">
        <div class="row justify-content-center">
            <div class="col-3">
                <label>Tahun</label>
                <select name="tahun" class="form-control">
                    <?php foreach ($tahun as $key => $value) : ?>
                        <option value="<?php echo $key ?>" <?php ($key == $tahunnow) ? print("selected") : false ?>><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-3">
                <label>Bulan</label>
                <select name="bulan" class="form-control">
                    <?php foreach ($bulan as $key => $value) : ?>
                        <option value="<?php echo $key ?>" <?php ($key == $bulannow) ? print("selected") : false ?>><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label>&nbsp;</label><br/>
                <button class="btn btn-primary" name="save">Filter</button>
            </div>
        </div>
    </form>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Balance Keuangan</h3>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Total Pemasukan</th>
                                    <th>Rp. <?php echo number_format((float)$totalpemasukan, 2, ',', '.') ?></th>
                                </tr>
                                <tr>
                                    <th>Total Pengeluaran</th>
                                    <th>Rp. <?php echo number_format((float)$totalpengeluaran, 2, ',', '.') ?></th>
                                </tr>
                                <tr>
                                    <th class="bg-success text-light">Balance</th>
                                    <th>Rp. <?php echo number_format((float)$profit, 2, ',', '.') ?></th>
                                </tr>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bg-primary text-light">Pemasukan</th>
                                    <th>Rp. <?php echo number_format((float)$totalpemasukan, 2, ',', '.') ?></th>
                                </tr>
                                <?php foreach ($itempemasukan as $item) : ?>
                                    <tr>
                                        <th><?php echo $kategori->nama($item['kategori_pemasukan']) ?></th>
                                        <th>Rp. <?php echo number_format((float)$item['total'], 2, ',', '.') ?></th>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bg-danger text-light">Pengeluaran</th>
                                    <th>Rp. <?php echo number_format((float)$totalpengeluaran, 2, ',', '.') ?></th>
                                </tr>
                                <?php foreach ($itempengeluaran as $item) : ?>
                                    <tr>
                                        <th><?php echo $kategori->nama($item['kategori_pengeluaran']) ?></th>
                                        <th>Rp. <?php echo number_format((float)$item['total'], 2, ',', '.') ?></th>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>

