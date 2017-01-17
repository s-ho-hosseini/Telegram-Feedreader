<?php
//$servername = "localhost";
//$username = "neomanir_rootyou";
//$password = "Hashemi4080";
//$dbname="neomanir_freewifi";
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