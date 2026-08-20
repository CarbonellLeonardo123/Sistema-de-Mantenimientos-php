<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$sql = "SELECT v.idVenta, c.nombre as cliente, v.fecha, v.total
        FROM venta v
        LEFT JOIN cliente c ON v.idCliente = c.idCliente";
$resultado = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista Ventas</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:white; font-family:Arial; min-height:100vh; padding:30px 20px; }
.topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; }
h1 { font-size:26px; font-weight:bold; letter-spacing:1px; color:white; }
.acciones-top { display:flex; gap:10px; }
.btn-nuevo { padding:10px 22px; background:#e07b20; border:none; border-radius:8px; color:white; font-size:15px; font-weight:bold; cursor:pointer; text-decoration:none; transition:0.2s; }
.btn-nuevo:hover { background:#c96a10; }
.btn-volver { padding:10px 22px; background:transparent; border:2px solid rgba(255,255,255,0.4); border-radius:8px; color:white; font-size:15px; cursor:pointer; text-decoration:none; transition:0.2s; }
.btn-volver:hover { border-color:white; }
table { width:100%; border-collapse:collapse; background:#1a2a3a; border-radius:12px; overflow:hidden; }
th { background:#1e3a5f; padding:14px 16px; text-align:center; font-size:13px; letter-spacing:1px; color:#a0bcd8; }
td { padding:13px 16px; text-align:center; font-size:14px; border-bottom:1px solid rgba(255,255,255,0.07); }
tr:last-child td { border-bottom:none; }
tr:hover td { background:rgba(255,255,255,0.04); }
.total { color:#2ecc71; font-weight:bold; }
.btn-editar { color:#5dade2; text-decoration:none; font-size:13px; }
.btn-editar:hover { color:#85c1e9; }
.btn-eliminar { color:#e74c3c; text-decoration:none; font-size:13px; }
.btn-eliminar:hover { color:#f1948a; }
.sep { color:#444; margin:0 6px; }
</style>
</head>
<body>
<div class="topbar">
  <h1>LISTA DE VENTAS</h1>
  <div class="acciones-top">
    <a href="../../menu.php" class="btn-volver">← Volver al Menú</a>
    <a href="registrar.php" class="btn-nuevo">+ Nueva Venta</a>
  </div>
</div>
<table>
  <tr>
    <th>ID VENTA</th><th>CLIENTE</th><th>FECHA</th><th>TOTAL</th><th>ACCIONES</th>
  </tr>
  <?php while($fila = mysqli_fetch_array($resultado)): ?>
  <tr>
    <td><?= $fila['idVenta'] ?></td>
    <td><?= htmlspecialchars($fila['cliente']) ?></td>
    <td><?= date('d/m/Y', strtotime($fila['fecha'])) ?></td>
    <td class="total">S/. <?= number_format($fila['total'], 2) ?></td>
    <td>
      <a href="editar.php?id=<?= $fila['idVenta'] ?>" class="btn-editar">Editar</a>
      <span class="sep">|</span>
      <a href="eliminar.php?id=<?= $fila['idVenta'] ?>" class="btn-eliminar"
         onclick="return confirm('¿Seguro que deseas eliminar esta venta?')">Eliminar</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
</body>
</html>