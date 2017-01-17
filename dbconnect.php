<?php
//$servername = "localhost";
//$username = "varaghon_fdread";
//$password = "@21amirIRAN";
//$dbname="varaghon_fdreader";
$servername = "localhost";
$username = "root";
$password = "";
$dbname="db_fdreader";


$inserted=false;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset( "utf8" );

?>