<?php
session_start();
if(!isset($_SESSION['usuario'])) { echo json_encode([]); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */

$buscar = isset($_GET['q']) ? trim($_GET['q']) : '';

$stmt = mysqli_prepare($conn,
    "SELECT * FROM cliente
     WHERE nombre LIKE ? OR apellido LIKE ? OR dni LIKE ? OR correo LIKE ?
     ORDER BY nombre");

$like = "%$buscar%";
mysqli_stmt_bind_param($stmt, "ssss", $like, $like, $like, $like);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$clientes = [];
while($fila = mysqli_fetch_assoc($resultado)){
    $clientes[] = $fila;
}

header('Content-Type: application/json');
echo json_encode($clientes);