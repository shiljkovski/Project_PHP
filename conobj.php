<?php
require_once "./Database/Connection.php";


$createConnection = new Connection("mysql", "localhost", "project2", "root", "");
$createConnection->connect();
$connectOBJ = $createConnection->getConnection();
session_start();
?>