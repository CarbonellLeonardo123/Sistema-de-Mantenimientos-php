<?php
session_start();

if(!isset($_SESSION['usuario'])) {
header("Location:../../index.php");
exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$sql = "SELECT detallecompra.*,
producto.nombre

FROM detallecompra

INNER JOIN producto
ON detallecompra.idProducto = producto.idProducto";

$resultado = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista Detalle Compra</title>

<style>

body{
background:#0f1c2e;
color:white;
font-family:Arial;
padding:30px;
}

table{
width:95%;
margin:auto;
border-collapse:collapse;
background:#1a2a3a;
}

th,td{
padding:14px;
text-align:center;
border:1px solid rgba(255,255,255,0.08);
}

th{
background:#1e3a5f;
color:#a0bcd8;
}

a{
text-decoration:none;
}

.btn-editar{
color:#5dade2;
}

.btn-eliminar{
color:#e74c3c;
}

.btn-nuevo{
background:#e07b20;
padding:10px 20px;
border-radius:8px;
color:white;
}

.topbar{
display:flex;
justify-content:space-between;
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="topbar">

<h1>LISTA DETALLE COMPRA</h1>

<a href="registrar.php"
class="btn-nuevo">

+ Nuevo

</a>

</div>

<table>

<tr>

<th>ID</th>
<th>COMPRA</th>
<th>PRODUCTO</th>
<th>CANTIDAD</th>
<th>PRECIO</th>
<th>SUBTOTAL</th>
<th>ACCIONES</th>

</tr>

<?php while($fila=mysqli_fetch_array($resultado)){ ?>

<tr>

<td><?= $fila['idDetalleCompra'] ?></td>

<td>
Compra #<?= $fila['idCompra'] ?>
</td>

<td>
<?= $fila['nombre'] ?>
</td>

<td>
<?= $fila['cantidad'] ?>
</td>

<td>
S/. <?= $fila['precio'] ?>
</td>

<td>
S/. <?= $fila['subtotal'] ?>
</td>

<td>

<a href="editar.php?id=<?= $fila['idDetalleCompra'] ?>"
class="btn-editar">

Editar

</a>

|

<a href="eliminar.php?id=<?= $fila['idDetalleCompra'] ?>"
class="btn-eliminar"
onclick="return confirm('¿Eliminar detalle?')">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>