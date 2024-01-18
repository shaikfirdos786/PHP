<?php

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
// database to work with
$database = "dbnawab";

// Create a connection 
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
    echo "Connection was successful <br>";
}


// inserting data into the table
$sql = "INSERT INTO `students`(`R.NO`, `NAME`, `CLASS`, `MARKS`) VALUES(39, 'Firdos', 10, 99)";
$result = mysqli_query($conn, $sql);

// checking the data insertion was successful or not?
if($result){
    echo "The data has been inserted successfully.<br>";
}
else{
    echo "The data was not inserted successfully because of this error --->". mysqli_error($conn);
}
