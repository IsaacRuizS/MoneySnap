<?php 

$servername = "localhost";
$dbusername = "root";
$dbpassword = "10Ruiz30*";
$database = "money_snap";

$conn = new mysqli($servername, $dbusername, $dbpassword,$database);

if($conn->connect_error){
    die("error de base de datos ".$conn->connect_error);
}