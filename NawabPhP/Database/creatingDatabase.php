<?php

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";

// Create a connection 
$conn = mysqli_connect($servername, $username, $password);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
    echo "Connection was successful <br>";
}

// Creating a Database
$sql = "CREATE DATABASE contacts";
//mysqli_query($conn, $sql);

// creating and checking database is database created successfull?

$result = mysqli_query($conn, $sql);
if($result){
    echo "The db was created successfully<br>";
}
else{
    echo "The db was not created successfull because of this error ----> ". mysqli_error($conn);
}


?>