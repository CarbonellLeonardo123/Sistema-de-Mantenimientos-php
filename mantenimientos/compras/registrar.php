<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    header("Location:../../index.php");
    exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$proveedores = mysqli_query($conn,
"SELECT * FROM proveedor");

$error = "";

if(isset($_POST['guardar'])){

    $idProveedor = trim($_POST['idProveedor']);
    $fecha = trim($_POST['fecha']);
    $total = trim($_POST['total']);

    if(
        $idProveedor != "" &&
        $fecha != "" &&
        $total != ""
    ){

        $stmt = mysqli_prepare($conn,

        "INSERT INTO compras
        (idProveedor,fecha,total)

        VALUES

        (?,?,?)");

        mysqli_stmt_bind_param($stmt,
        "isd",
        $idProveedor,
        $fecha,
        $total);

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
<title>Registrar Compra</title>

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
display:flex;
align-items:center;
justify-content:center;
}

.formulario{

width:430px;
background:#1a2a3a;
padding:36px;
border-radius:16px;
border:1px solid rgba(255,255,255,0.1);
}

h1{

font-size:22px;
margin-bottom:24px;
}

label{

font-size:13px;
color:#a0bcd8;
display:block;
margin-top:16px;
margin-bottom:6px;
}

input,select{

width:100%;
padding:12px 14px;
background:#0f1c2e;
border:1px solid rgba(255,255,255,0.15);
border-radius:8px;
color:white;
font-size:15px;
outline:none;
}

input:focus,
select:focus{

border-color:#e07b20;
}

.btn-guardar{

width:100%;
padding:13px;
margin-top:24px;
background:#e07b20;
border:none;
border-radius:10px;
color:white;
font-size:16px;
font-weight:bold;
cursor:pointer;
}

.btn-guardar:hover{

background:#c96a10;
}

.btn-volver{

display:block;
text-align:center;
margin-top:14px;
color:#a0bcd8;
text-decoration:none;
}

.error{

background:rgba(231,76,60,0.2);
color:#f1948a;
padding:10px 14px;
border-radius:8px;
font-size:14px;
margin-bottom:10px;
}

</style>

</head>

<body>

<div class="formulario">

<h1>Registrar Compra</h1>

<?php if($error): ?>

<div class="error">

<?= $error ?>

</div>

<?php endif; ?>

<form method="POST">

<label>Proveedor</label>

<select name="idProveedor" required>

<option value="">
Seleccione Proveedor
</option>

<?php while($p=mysqli_fetch_array($proveedores)){ ?>

<option value="<?= $p['idProveedor'] ?>">

<?= $p['nombre'] ?>

</option>

<?php } ?>

</select>

<label>Fecha</label>

<input type="date"
name="fecha"
required>

<label>Total</label>

<input type="number"
step="0.01"
name="total"
placeholder="Ingrese total"
required>

<button type="submit"
name="guardar"
class="btn-guardar">

Guardar Compra

</button>

</form>

<a href="listar.php"
class="btn-volver">

← Volver a la lista

</a>

</div>

</body>

</html>