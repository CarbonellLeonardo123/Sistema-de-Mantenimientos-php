<?php
session_start();

if(!isset($_SESSION['usuario'])) {
header("Location:../../index.php");
exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$sql = "SELECT pedidos.*, cliente.nombre, cliente.apellido

FROM pedidos

INNER JOIN cliente
ON pedidos.idCliente = cliente.idCliente";

$resultado = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista Pedidos</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#0f1c2e;
color:white;
font-family:Arial;
min-height:100vh;
padding:30px 20px;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

h1{
font-size:26px;
}

.acciones-top{
display:flex;
gap:10px;
}

.btn-nuevo{
padding:10px 22px;
background:#e07b20;
border:none;
border-radius:8px;
color:white;
text-decoration:none;
font-weight:bold;
}

.btn-volver{
padding:10px 22px;
background:transparent;
border:2px solid rgba(255,255,255,0.4);
border-radius:8px;
color:white;
text-decoration:none;
}

table{
width:95%;
margin:auto;
border-collapse:collapse;
background:#1a2a3a;
border-radius:12px;
overflow:hidden;
}

th{
background:#1e3a5f;
padding:14px;
color:#a0bcd8;
font-size:13px;
}

td{
padding:13px;
text-align:center;
border-bottom:1px solid rgba(255,255,255,0.07);
}

tr:hover td{
background:rgba(255,255,255,0.04);
}

.btn-editar{
color:#5dade2;
text-decoration:none;
}

.btn-eliminar{
color:#e74c3c;
text-decoration:none;
}

</style>

</head>

<body>

<div class="topbar">

<h1>LISTA DE PEDIDOS</h1>

<div class="acciones-top">

<a href="../../menu.php"
class="btn-volver">

← Volver al Menú

</a>

<a href="registrar.php"
class="btn-nuevo">

+ Nuevo Pedido

</a>

</div>

</div>

<table>

<tr>

<th>ID</th>
<th>CLIENTE</th>
<th>FECHA</th>
<th>ESTADO</th>
<th>TOTAL</th>
<th>ACCIONES</th>

</tr>

<?php while($fila=mysqli_fetch_array($resultado)){ ?>

<tr>

<td><?= $fila['idPedido'] ?></td>

<td>

<?= $fila['nombre'] ?>
<?= $fila['apellido'] ?>

</td>

<td><?= $fila['fecha'] ?></td>

<td><?= $fila['estado'] ?></td>

<td>S/. <?= $fila['total'] ?></td>

<td>

<a href="editar.php?id=<?= $fila['idPedido'] ?>"
class="btn-editar">

Editar

</a>

|

<a href="eliminar.php?id=<?= $fila['idPedido'] ?>"
class="btn-eliminar"
onclick="return confirm('¿Eliminar pedido?')">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>