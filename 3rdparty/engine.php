<?php
ini_set('display_errors', false);
include "parser.php";

class database
{
    var $server,
        $host,
        $user,
        $password,
        $database;

    function __construct($db_name = 'zhafirah', $db_password = '', $db_user = 'root', $db_host = '127.0.0.1', $debug = '')
    {
        $this->host = $db_host;
        $this->user = $db_user;
        $this->password = $db_password;
        $this->database = $db_name;

        $this->open();
    }

    function open()
    {
        $this->server = @mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Couldn't connect to SQL server: " . mysqli_connect_error());
    }

    function query($sql, $debug = 0)
    {
        if($debug)
            echo "database/query :<strong>$sql</strong>:<br>\n";

        $result = @mysqli_query($this->server, $sql);

        if( ($sql[0] == 'i') || ($sql[0] == 'I') )
            return mysqli_insert_id($this->server);

        if($result && mysqli_num_rows($result) > 0) {
            while( $row = @mysqli_fetch_array($result) )
                $data[] = $row;
        }

        if(isset($data)){
            return $data;
        }
        
        return array();
    }

    function queryItem($sql, $debug = 0)
    {
        $result = $this->query($sql." LIMIT 0,1", $debug);
        if(isset($result[0][0])) {
            return $result[0][0];
        }
        return null;
    }
};

// DECLARE $db as GLOBAL variable
global $db;

// Database connection - pilih salah satu
//$db = new database("db_login", "admin", "root");
//$db = new database("clinic_aulia", "P@ssw0rd", "rem", "103.169.7.54");
//$db = new database("klinik", "123456789", "klinik", "localhost");
// $db = new database("zhafirah", "Mahameru2025!", "technocare", "127.0.0.1");
// $db = new database("zhafirah_local", "", "root", "127.0.0.1");
$db = new database("zhafirah_local", "", "root", "127.0.0.1");

?>
