<?php
function redirect_ke($lokasi = NULL)
{
    if ($lokasi != NULL) {
        header("Location: $lokasi");
        exit;
    }
}

function cetak_pesan($pesan = '')
{
    if (!empty($pesan)) {
        return "<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
        <strong>Info: </strong> {$pesan}
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times</span>
        </button>
    </div>";
    } else {
        return "";
    }
}

function helperkategori()
{
    $cat['masuk'] = 'Masuk';
    $cat['keluar'] = 'Keluar';
    return $cat;
}

function daftarTahun()
{
    $kumpulantahun = array();
    $sekarang = date("Y");
    $tahunmulai = $sekarang - 3;
    for ($tahun = $sekarang; $tahun >= $tahunmulai; $tahun--) {
        $kumpulantahun[$tahun] = $tahun;
    }
    return $kumpulantahun;
}

function daftarBulan()
{
    $bulan = array(1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember');
    return $bulan;
}

?>