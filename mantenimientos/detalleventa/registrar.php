<?php
session_start();

if(!isset($_SESSION['usuario'])) {
header("Location:../../index.php");
exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$ventas = mysqli_query($conn,
"SELECT * FROM venta");

$productos = mysqli_query($conn,
"SELECT * FROM producto");

$error = "";

if(isset($_POST['guardar'])){

$idVenta = trim($_POST['idVenta']);
$idProducto = trim($_POST['idProducto']);
$cantidad = trim($_POST['cantidad']);
$precio = trim($_POST['precio']);

$subtotal = $cantidad * $precio;

if(
$idVenta != "" &&
$idProducto != "" &&
$cantidad != "" &&
$precio != ""
){

$stmt = mysqli_prepare($conn,

"INSERT INTO detalleventa
(idVenta,idProducto,cantidad,precio,subtotal)

VALUES

(?,?,?,?,?)");

mysqli_stmt_bind_param($stmt,
"iiidd",
$idVenta,
$idProducto,
$cantidad,
$precio,
$subtotal);

mysqli_stmt_execute($stmt);

header("Location:listar.php");
exit();

}else{

$error = "Complete todos los campos";
}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Detalle Venta</title>

<style>

body{
background:#0f1c2e;
color:white;
font-family:Arial;
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
}

.formulario{
width:430px;
background:#1a2a3a;
padding:36px;
border-radius:16px;
}

input,select{
width:100%;
padding:12px;
margin-top:14px;
background:#0f1c2e;
border:1px solid rgba(255,255,255,0.1);
border-radius:8px;
color:white;
}

button{
width:100%;
padding:13px;
margin-top:22px;
background:#e07b20;
border:none;
border-radius:10px;
color:white;
font-size:16px;
font-weight:bold;
cursor:pointer;
}

a{
display:block;
text-align:center;
margin-top:15px;
color:#a0bcd8;
text-decoration:none;
}

.error{
background:rgba(231,76,60,0.2);
padding:10px;
border-radius:8px;
margin-bottom:10px;
}

</style>

</head>

<body>

<div class="formulario">

<h1>Registrar Detalle Venta</h1>

<?php if($error){ ?>

<div class="error">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<select name="idVenta" required>

<option value="">
Seleccione Venta
</option>

<?php while($v=mysqli_fetch_array($ventas)){ ?>

<option value="<?= $v['idVenta'] ?>">

Venta #<?= $v['idVenta'] ?>

</option>

<?php } ?>

</select>

<select name="idProducto" required>

<option value="">
Seleccione Producto
</option>

<?php while($p=mysqli_fetch_array($productos)){ ?>

<option value="<?= $p['idProducto'] ?>">

<?= $p['nombre'] ?>

</option>

<?php } ?>

</select>

<input type="number"
name="cantidad"
placeholder="Cantidad"
required>

<input type="number"
step="0.01"
name="precio"
placeholder="Precio"
required>

<button type="submit"
name="guardar">

Guardar Detalle

</button>

</form>

<a href="listar.php">

← Volver

</a>

</div>

</body>

</html>