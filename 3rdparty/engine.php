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

    function database($db_name = '', $db_password = '', $db_user = '', $db_host = 'localhost', $debug = '')
    {
      $this->host = $db_host;
      $this->user = $db_user;
      $this->password = $db_password;
      $this->database = $db_name;

      $this->open();
    }

    function open()
    {
      $this->server = @mysql_connect($this->host, $this->user, $this->password) or die("Couldn't connect to SQL server");
      @mysql_select_db($this->database, $this->server);
    }

    function query($sql, $debug = 0)
    {

      if($debug)
        echo "database/query :<strong>$sql</strong>:<br>\n";


      $result = @mysql_query($sql, $this->server);

      if( ($sql[0] == 'i') || ($sql[0] == 'I') )
        return mysql_insert_id();

      while( $row = @mysql_fetch_array($result) )
        $data[] = $row;


	  if(isset($data)){
	  return $data;
	  }

    }

    function queryItem($sql, $debug = 0)
    {
      $result = $this->query($sql." LIMIT 0,1", $debug);
      return $result[0][0];
    }
  };
  
  
	//$db = new database("db_login", "admin", "root");
    //$db = new database("clinic_aulia", "P@ssw0rd", "rem", "103.169.7.54");
    //$db = new database("klinik", "123456789", "klinik", "localhost");
	$db = new database("zhafirah", "Mahameru2025!", "technocare", "127.0.0.1");
//    $db = new database("clinic_aulia", "", "root", "localhost");

?>
