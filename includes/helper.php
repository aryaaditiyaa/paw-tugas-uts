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

?>