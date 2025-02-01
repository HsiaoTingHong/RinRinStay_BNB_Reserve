<?php
$servername = "localhost";
$user = "root";
$password = "";  
$sqlname = "projectbnb";

$conn = new mysqli($servername, $user, $password, $sqlname);
mysqli_query($conn, 'SET NAMES utf8');
?>