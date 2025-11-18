<?php
ini_set('display_errors', false);
include "parser.php";

class database
{
  var $server,
    $host,
    $user,
    $password,
    $database,
    $port,
    $debug;

  function database($db_name = '', $db_password = '', $db_user = '', $db_host = 'localhost', $debug = '', $port)
  {
    $this->host = $db_host;
    $this->user = $db_user;
    $this->password = $db_password;
    $this->database = $db_name;
    $this->port = $port;
    $this->debug = $debug;

    $this->open();
  }

  function open()
  {
    $this->server = @mysql_connect($this->host . ':' . $this->port, $this->user, $this->password, $this->debug) or die("Couldn't connect to SQL server");
    @mysql_select_db($this->database, $this->server);
  }

  function query($sql, $debug = 0)
  {

    if ($debug)
      echo "database/query :<strong>$sql</strong>:<br>\n";

    $result = @mysql_query($sql, $this->server);

    if (($sql[0] == 'i') || ($sql[0] == 'I'))
      return mysql_insert_id();

    while ($row = @mysql_fetch_array($result))
      $data[] = $row;


    if (isset($data)) {
      return $data;
    }
  }

  function queryItem($sql, $debug = 0)
  {
    $result = $this->query($sql . " LIMIT 0,1", $debug);
    return $result[0][0];
  }
};

// Local
// $env = array(
//   "dbname" => "clinic",
//   "password" => "",
//   "user" => "root",
//   "host" => "localhost",
//   "debug" => 1,
//   "port" => 3305
// );

// Server
$env = array(
  "dbname" => "dialisacare",
  "password" => "csvgA6Fjva9P8yop",
  "user" => "Techno@2024",
  "host" => "127.0.0.1",
  "debug" => 1,
  "port" => 3306
);

$db = new database($env["dbname"], $env["password"], $env["user"], $env["host"], $env["debug"], $env["port"]);