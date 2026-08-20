<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "promart";

$conn = mysqli_connect($server,$user,$pass,$db);

if(!$conn){
    die("Error de conexion");
}