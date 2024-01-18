<?php

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
// database to work with
$database = "contacts";

// Create a connection 
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
    echo "Connection was successful <br>";
}


// Creating a table in the database
$sql = "CREATE TABLE `mycontacts`(`S.NO` INT(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY , `NAME` VARCHAR(20) NOT NULL, `EMAIL` VARCHAR(30) NOT NULL, `CONCERN` TEXT NOT NULL)";
$result = mysqli_query($conn, $sql);

// checking the table creation was successful or not?
if($result){
    echo "The table was created successfully.<br>";
}
else{
    echo "The table was not created successfully because of this error --->". mysqli_error($conn);
}

?>
