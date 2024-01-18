<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Forum";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Setting the PDO Error mode to Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Something went wrong";
}
