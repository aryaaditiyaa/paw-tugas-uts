<?
require_once("config.php");

class MySQLDatabase{
    private $connection;

    function __construct()
    {
        $this->open_connection;
    }

    public function open_connection()
    {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->connection) {
            die("Koneksi ke database gagal");
        } else {
            $db_select = mysqli_select_db($this->connection, DB_NAME);
            if (!$db_select) {
                die("Database tidak ditemukan: " . mysqli_error($this->connection));
            }
        }
    }

    public function query($sql){
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    public function fetch_array($result_set){
        return mysqli_fetch_array($result_set);
    }

    private function confirm_query($result){
        if (!$result) {
            $output = "Database query gagal: " . mysqli_error($this->connection);
            die($output);
        }
    }

    public function close_connection(){
        if ($this->connection) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }
}

$database = new MySQLDatabase();
?>