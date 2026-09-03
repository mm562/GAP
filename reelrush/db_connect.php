<?php
require_once("keys.php");

$servername = "localhost";
$username = "root";
$password = KEY_SQL;
$dbname = "schelling";
 
// [Create connection]
$conn = new mysqli($servername, $username, $password, $dbname);
 
// [Check connection]
if ($conn->connect_error) {
    die("Database Connection failed: ".$conn->connect_error);
}
?>