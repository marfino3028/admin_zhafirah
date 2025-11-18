<?php
include_once '../../../3rdparty/3rdparty/engine.php';
$dsn = "mysql:host=".$env['host'].";port=".$env['port'].";dbname=".$env['dbname'].";charset=utf8";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
);

try {
    $db = new PDO($dsn, $env['user'], $env['password'], $options);
    return $db;
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit;
}

