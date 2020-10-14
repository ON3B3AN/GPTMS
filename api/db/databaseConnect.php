<?php
$host = 'localhost';
$dbName = 'mydb';
$username = 'root';
$password = '';

try {
    $db = new mysqli($host, $username, $password, $dbName);
} catch (mysqli_sql_exception $e) {
    exit;
}
