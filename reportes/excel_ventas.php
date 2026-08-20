<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Ventas.xls");
header("Pragma: no-cache");

$sql = "SELECT v.idVenta, c.nombre, c.apellido, v.fecha, v.total
        FROM venta v LEFT JOIN cliente c ON v.idCliente=c.idCliente
        ORDER BY v.fecha DESC";
$resultado = mysqli_query($conn, $sql);
?>
<html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><body>
<table border="1">
  <tr style="background:#1e3a5f;color:white;font-weight:bold;">
    <td colspan="5" align="center" style="font-size:16px;">REPORTE DE VENTAS - PROMART</td>
  </tr>
  <tr style="background:#e07b20;color:white;font-weight:bold;">
    <td>ID VENTA</td><td>NOMBRE</td><td>APELLIDO</td><td>FECHA</td><td>TOTAL (S/.)</td>
  </tr>
  <?php $total=0; while($f=mysqli_fetch_array($resultado)): $total+=$f['total']; ?>
  <tr>
    <td><?=$f['idVenta']?></td>
    <td><?=$f['nombre']?></td>
    <td><?=$f['apellido']?></td>
    <td><?=date('d/m/Y',strtotime($f['fecha']))?></td>
    <td>S/. <?=number_format($f['total'],2)?></td>
  </tr>
  <?php endwhile; ?>
  <tr style="background:#1e3a5f;color:white;font-weight:bold;">
    <td colspan="4" align="right">TOTAL GENERAL:</td>
    <td>S/. <?=number_format($total,2)?></td>
  </tr>
  <tr><td colspan="5" align="right" style="color:gray;font-style:italic;">
    Generado el <?=date('d/m/Y H:i')?> por <?=$_SESSION['usuario']?>
  </td></tr>
</table>
</body></html>