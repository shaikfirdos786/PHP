<?php

/*
// Prepared Statements in MySQLi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbobject";

// Creating Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking Connection
if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO myobject(id, name) VALUES(?, ?)");
$stmt->bind_param("is", $id, $name);

// Set Parameters and Execute
$id = 2;
$name = "Firdos";
$stmt->execute();

$id = 3;
$name = "Zinat";
$stmt->execute();

echo "New records inserted Successfully";

$stmt->close();
$conn->close();
*/


// Prepared Statements in PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpdo";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL and bind parameters
    $stmt = $conn->prepare("INSERT INTO mypdo(id, name) VALUES(:id, :name)");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);

    // Insert Rows
    $id = 3;
    $name = "Fiddu";
    $stmt->execute();

    $id = 4;
    $name = "Zinat";
    $stmt->execute();

    echo "New rows inserted successfully";
}catch(PDOException $e){
    echo "Error: ". $e->getMessage();
}
$conn = null;

?>