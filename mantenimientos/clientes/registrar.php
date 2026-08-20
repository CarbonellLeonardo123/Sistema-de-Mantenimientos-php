<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$error = "";
if(isset($_POST['guardar'])){
    $nombre   = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo   = trim($_POST['correo']);
    $dni      = trim($_POST['dni']);
    if($nombre != "" && $apellido != "" && $correo != "" && $dni != ""){
        $stmt = mysqli_prepare($conn, "INSERT INTO cliente(nombre,apellido,correo,dni) VALUES(?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $correo, $dni);
        mysqli_stmt_execute($stmt);
        header("Location:listar.php");
        exit();
    } else {
        $error = "Complete todos los campos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Cliente</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:white; font-family:Arial; min-height:100vh; display:flex; align-items:center; justify-content:center; }
.formulario { width:420px; background:#1a2a3a; padding:36px; border-radius:16px; border:1px solid rgba(255,255,255,0.1); }
h1 { font-size:22px; margin-bottom:24px; color:white; }
label { font-size:13px; color:#a0bcd8; display:block; margin-top:16px; margin-bottom:6px; }
input { width:100%; padding:12px 14px; background:#0f1c2e; border:1px solid rgba(255,255,255,0.15); border-radius:8px; color:white; font-size:15px; outline:none; }
input:focus { border-color:#e07b20; }
.btn-guardar { width:100%; padding:13px; margin-top:24px; background:#e07b20; border:none; border-radius:10px; color:white; font-size:16px; font-weight:bold; cursor:pointer; transition:0.2s; }
.btn-guardar:hover { background:#c96a10; }
.btn-volver { display:block; text-align:center; margin-top:14px; color:#a0bcd8; font-size:14px; text-decoration:none; }
.btn-volver:hover { color:white; }
.error { background:rgba(231,76,60,0.2); color:#f1948a; padding:10px 14px; border-radius:8px; font-size:14px; margin-bottom:10px; }
</style>
</head>
<body>
<div class="formulario">
  <h1>Registrar Cliente</h1>
  <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>
  <form method="POST">
    <label>Nombre</label>
    <input type="text" name="nombre" placeholder="Nombre" required>
    <label>Apellido</label>
    <input type="text" name="apellido" placeholder="Apellido" required>
    <label>Correo</label>
    <input type="email" name="correo" placeholder="correo@ejemplo.com" required>
    <label>DNI</label>
    <input type="text" name="dni" placeholder="12345678" maxlength="8" required>
    <button type="submit" name="guardar" class="btn-guardar">Guardar Cliente</button>
  </form>
  <a href="listar.php" class="btn-volver">← Volver a la lista</a>
</div>
</body>
</html>