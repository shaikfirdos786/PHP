<?php
/*
Ways to connect to a MySQL Database
1. MySQLi extension
2.PDO
?>
*/

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";


 
//Connecting to the database using oject oriented MySQLi

$conn =new  mysqli($servername, $username, $password);

// Die if connection was not successful
if($conn->connect_error){
    die("Sorry we failed to connect: ". $conn->connect_error);
}
else{
    echo "Connection was successful";
}


/*
// Create a connection using procedural MySQLi
$conn = mysqli_connect($servername, $username, $password);

// Die if connection was not successful
if(!$conn){
    die("Sorry we failed to connect: ".mysqli_connect_error());
}
else{
    echo "Connection was successful";
}
*/


/*
// Connecting using PDO
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=dbnawab", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
*/

?>