<?php
ini_set('display_errors', false);
include "parser.php";

class database
{
    public $server;
    public $host;
    public $user;
    public $password;
    public $database;
    public $port;
    public $debug;
    /** @var mysqli */
    private $conn;

    /**
     * Note: parameter order kept same as original to avoid breaking existing calls:
     * ($db_name, $db_password, $db_user, $db_host, $debug, $port)
     */
    public function __construct($db_name = 'zhafirah', $db_password = '', $db_user = 'root', $db_host = '127.0.0.1', $debug = false, $port = 3306)
    {
        $this->host     = $db_host;
        $this->user     = $db_user;
        $this->password = $db_password;
        $this->database = $db_name;
        $this->port     = $port ?: 3306;
        $this->debug    = $debug;

        $this->open();
    }

    public function open()
    {
        // buat koneksi mysqli
        $this->conn = @new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);

        if ($this->conn->connect_error) {
            if ($this->debug) {
                // saat debug, tampilkan pesan (jangan aktifkan di production)
                die("Couldn't connect to SQL server: " . $this->conn->connect_error);
            } else {
                die("Couldn't connect to SQL server");
            }
        }

        $this->server = $this->conn;
        // set charset optional
        $this->conn->set_charset('utf8mb4');
    }

    /**
     * Jalankan query. Untuk SELECT mengembalikan array hasil (associative).
     * Untuk INSERT mengembalikan insert_id.
     * Untuk UPDATE/DELETE mengembalikan mysqli->affected_rows.
     */
    public function query($sql, $debug = 0)
    {
        if ($debug || $this->debug) {
            echo "database/query :<strong>$sql</strong>:<br>\n";
        }

        $result = $this->conn->query($sql);

        if ($result === false) {
            if ($this->debug) {
                // pesan error saat debug
                throw new \RuntimeException("MySQL error: " . $this->conn->error . " -- SQL: " . $sql);
            }
            return false;
        }

        // SELECT -> result object
        if ($result instanceof mysqli_result) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
            return $data;
        }

        // Non-select (INSERT/UPDATE/DELETE)
        $firstChar = isset($sql[0]) ? strtolower($sql[0]) : '';
        if ($firstChar === 'i') {
            return $this->conn->insert_id;
        }

        // return affected rows for update/delete etc.
        return $this->conn->affected_rows;
    }

    /**
     * Ambil 1 item (value pertama pada baris pertama)
     */
    public function queryItem($sql, $debug = 0)
    {
        $res = $this->query($sql . " LIMIT 0,1", $debug);
        if ($res === false || empty($res) || !is_array($res[0])) {
            return null;
        }
        $firstRow = $res[0];
        $vals = array_values($firstRow);
        return isset($vals[0]) ? $vals[0] : null;
    }

    /**
     * Escape helper (gunakan bila perlu)
     */
    public function escape($value)
    {
        return $this->conn->real_escape_string($value);
    }

    /**
     * Tutup koneksi saat selesai
     */
    public function close()
    {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null;
        }
    }
}

// contoh env (server)
$env = array(
  "dbname"   => "dialisacare",
  "password" => "csvgA6Fjva9P8yop",
  "user"     => "Techno@2024",
  "host"     => "127.0.0.1",
  "debug"    => 1,
  "port"     => 3306
);

$db = new database($env["dbname"], $env["password"], $env["user"], $env["host"], $env["debug"], $env["port"]);