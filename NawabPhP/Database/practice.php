<?php
/*
// Connecting to the database using MySQLi(object-oriented)
$servername = "localhost";
$username = "root";
$password = "";

// creating the connection
$conn = new mysqli($servername, $username, $password);

// checking the connection is successful or not?
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
echo "Connected successfully using Object-Oriented MySQLi";
*/

/*
// Connecting to the database using MySQLi(Procedural)
$servername = "localhost";
$username = "root";
$password = "";

// creating the connection
$conn = mysqli_connect($servername, $username, $password);

// checking the connection is successful or not?
if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
echo "Connected successfully using Procedural MySQLi";
*/

/*
// Connecting to the database using PDO(PHP data objects)
$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host = $servername", $username, $password);
    // Setting the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully using PDO";
}catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}
*/

// CREATING DATABASES

/*
// Creating database using MySQLi(Object-Oriented)
// Connecting to the database using MySQLi(object-oriented)
$servername = "localhost";
$username = "root";
$password = "";

// creating the connection
$conn = new mysqli($servername, $username, $password);

// checking the connection is successful or not?
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
echo "Connected successfully using Object-Oriented MySQLi <br>";

// Creating Database
$sql = "CREATE DATABASE dbobject";
if($conn->query($sql) === TRUE){
    echo "Database created successfully using Object-Oriented MySQLi <br>";
}else{
    echo "Error Creating Database: ". $conn->error;
}
*/

/*
// Creating database using MySQLi(Procedural)
// Connecting to the database using MySQLi(Procedural)
$servername = "localhost";
$username = "root";
$password = "";

// creating the connection
$conn = mysqli_connect($servername, $username, $password);

// checking the connection is successful or not?
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully using Procedural MySQLi <br>";

// Creating Database
$sql = "CREATE DATABASE dbprocedural";
if(mysqli_query($conn, $sql)){
    echo "Database created successfully using Procedural MySQLi <br>";
}else{
    echo "Error Creating Database: " . mysqli_error($conn);
}
*/

/*
//Creating database using PDO
// Connecting to the database using PDO(PHP data objects)
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host = $servername", $username, $password);
    // Setting the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE dbpdo";
    // using exec() because no results are returned
    $conn->exec($sql);
    echo "Connected Successfully using PDO<br>";
    echo "Database created Successfully using PDO<br>"
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
*/



// CREATING TABLE

/*
// Creating table using MySQLi(Object-oriented)
// Connecting to the database using MySQLi(object-oriented)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbobject";

// creating the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// checking the connection is successful or not?
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully using Object-Oriented MySQLi <br>";

// Sql to create table
$sql = "CREATE TABLE MyObject(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(30) NOT NULL)";
if($conn->query($sql) === TRUE){
    echo "Table Created Successfully using Object-Oriented MySQLi";
}else{
    echo "Error Creating table: ". $conn->error;
}
*/


/*
//Creating table using MySQLi(Procedural)
// Connecting to the database using MySQLi(Procedural)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbprocedural";

// creating the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// checking the connection is successful or not?
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully using Procedural MySQLi<br>";

// Sql to create table
$sql = "CREATE TABLE myprocedural(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(30) NOT NULL)";
if(mysqli_query($conn, $sql)){
    echo "Table created Successfully using Procedural MySQLi<br>";
}else{
    echo "Error Creating Table: ". mysqli_error($conn);
}
*/


/*
// Creating table using PDO
// Connecting to the database using PDO(PHP data objects)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpdo";

try {
    $conn = new PDO("mysql:host = $servername; dbname=$dbname", $username, $password);
    // Setting the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully using PDO<br>";

    // Sql to create table
    $sql = "CREATE TABLE mypdo(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(30) NOT NULL)";
    $conn->exec($sql);
    echo "Table created successfully using PDO";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
*/




// Inserting Data Into the Tables

/*
// Inserting data into the table using MySQLi(Object-Oriented)
// Connecting to the database using MySQLi(object-oriented)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbobject";

// creating the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// checking the connection is successful or not?
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully using Object-Oriented MySQLi <br>";

// Sql to insert data
$sql = "INSERT INTO myobject(id, name) VALUES(1, 'Nawab')";
if ($conn->query($sql) === TRUE) {
    echo "Row Inserted Successfully using Object-Oriented MySQLi<br>";
} else {
    echo "Error: " . $sql . "<br>". $conn->error;
}
*/


/*
// Inserting data into the table using MySQLi(Procedural)
// Connecting to the database using MySQLi(Procedural)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbprocedural";

// creating the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// checking the connection is successful or not?
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully using Procedural MySQLi<br>";

// Sql to insert data
$sql = "INSERT INTO myprocedural(id, name) VALUES(1, 'Nawab')";
if(mysqli_query($conn, $sql)){
    echo "Row inserted successfully using Procedural MySQLi<br>";
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
*/


// Inserting data into the table using PDO
// Connecting to the database using PDO(PHP data objects)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpdo";

try {
    $conn = new PDO("mysql:host = $servername; dbname=$dbname", $username, $password);
    // Setting the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully using PDO<br>";

    // Sql to insert data
    $sql = "INSERT INTO mypdo(id, name) VALUES(2, 'Firdos')";
    $conn->exec($sql);
    $lastId = $conn->lastInsertId();
    echo "Row inserted successfully using PDO. With Id: ". $lastId;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>