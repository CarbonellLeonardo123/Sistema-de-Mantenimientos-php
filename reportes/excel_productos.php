<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Productos.xls");
header("Pragma: no-cache");
$resultado = mysqli_query($conn, "SELECT * FROM producto ORDER BY nombre");
?>
<html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><body>
<table border="1">
  <tr style="background:#1e3a5f;color:white;font-weight:bold;">
    <td colspan="5" align="center" style="font-size:16px;">REPORTE DE PRODUCTOS - PROMART</td>
  </tr>
  <tr style="background:#e07b20;color:white;font-weight:bold;">
    <td>ID</td><td>NOMBRE</td><td>CATEGORIA</td><td>STOCK</td><td>PRECIO (S/.)</td>
  </tr>
  <?php while($f=mysqli_fetch_array($resultado)): ?>
  <tr>
    <td><?=$f['idProducto']?></td><td><?=$f['nombre']?></td>
    <td><?=$f['categoria']?></td><td><?=$f['stock']?></td>
    <td>S/. <?=number_format($f['precio'],2)?></td>
  </tr>
  <?php endwhile; ?>
  <tr><td colspan="5" align="right" style="color:gray;font-style:italic;">
    Generado el <?=date('d/m/Y H:i')?> por <?=$_SESSION['usuario']?>
  </td></tr>
</table></body></html>