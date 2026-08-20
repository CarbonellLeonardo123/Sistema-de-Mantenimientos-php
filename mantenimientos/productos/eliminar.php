<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "DELETE FROM producto WHERE idProducto=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
header("Location:listar.php");
exit();