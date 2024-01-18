<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users4581";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // setting the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "something went wrong";
}
