<?php

$serverName = "localhost";
$userName = "root";
$pass = "";
$dbName = "to_do_list";


try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection";
}catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
