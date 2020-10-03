<?php
require_once('database.php');

class Pengeluaran
{
    protected static $namatable = "pengeluaran";
    public $id;
    public $user_id;
    public $kategori_pengeluaran;
    public $rupiah_keluar;
    public $tanggal_keluar;

    public static function cari_dengan_sql($sql = "")
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = $row;
        }
        return $object_array;
    }

    public static function cari_dengan_id($id = "")
    {
        $result_array = self::cari_dengan_sql("SELECT * FROM " . self::$namatable . " WHERE id = {$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public function create()
    {
        global $database;
        $sql = "INSERT INTO " . self::$namatable . " (";
        $sql .= "user_id, kategori_pengeluaran, rupiah_keluar, tanggal_keluar) VALUES ('$this->user_id', '$this->kategori_pengeluaran', '$this->rupiah_keluar', '$this->tanggal_keluar')";
        if ($database->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $sql = "UPDATE " . self::$namatable . " SET ";
        $sql .= "kategori_pengeluaran=" . $this->kategori_pengeluaran . ", rupiah_keluar=" . $this->rupiah_keluar . ", tanggal_keluar='" . $this->tanggal_keluar . "'";
        $sql .= " WHERE id=" . $this->id;
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function hapus()
    {
        global $database;
        $sql = "DELETE FROM " . self::$namatable;
        $sql .= " WHERE id=" . $this->id;
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function nama($id)
    {
        $hasil = $this->cari_dengan_id($id);
        return $hasil["nama"];
    }

    public static function cari_semua()
    {
        return self::cari_dengan_sql("SELECT * FROM " . self::$namatable);
    }

    public static function total_semua()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$namatable;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }
}