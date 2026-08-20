<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../../../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$sql = "SELECT * FROM usuario";
$resultado = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista Usuarios</title>
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
.badge { padding:4px 12px; border-radius:20px; font-size:12px; font-weight:bold; }
.badge-admin { background:rgba(224,123,32,0.2); color:#f0a050; }
.badge-empleado { background:rgba(46,204,113,0.2); color:#2ecc71; }
.badge-supervisor { background:rgba(52,152,219,0.2); color:#5dade2; }
.clave-oculta { color:#666; font-style:italic; font-size:13px; }
.btn-editar { color:#5dade2; text-decoration:none; font-size:13px; }
.btn-editar:hover { color:#85c1e9; }
.btn-eliminar { color:#e74c3c; text-decoration:none; font-size:13px; }
.btn-eliminar:hover { color:#f1948a; }
.sep { color:#444; margin:0 6px; }
</style>
</head>
<body>
<div class="topbar">
  <h1>LISTA DE USUARIOS</h1>
  <div class="acciones-top">
    <a href="../../menu.php" class="btn-volver">← Volver al Menú</a>
    <a href="registrar.php" class="btn-nuevo">+ Nuevo Usuario</a>
  </div>
</div>

<table>
  <tr>
    <th>ID</th>
    <th>USUARIO</th>
    <th>CLAVE</th>
    <th>ROL</th>
    <th>ACCIONES</th>
  </tr>
  <?php while($fila = mysqli_fetch_array($resultado)): ?>
  <tr>
    <td><?= $fila['idUsuario'] ?></td>
    <td><?= htmlspecialchars($fila['usuario']) ?></td>
    <td><span class="clave-oculta">••••••</span></td>
    <td>
      <?php
        $rol = $fila['rol'];
        $clase = 'badge-empleado';
        if($rol == 'Administrador') $clase = 'badge-admin';
        elseif($rol == 'Supervisor') $clase = 'badge-supervisor';
      ?>
      <span class="badge <?= $clase ?>"><?= $rol ?></span>
    </td>
    <td>
      <a href="editar.php?id=<?= $fila['idUsuario'] ?>" class="btn-editar">Editar</a>
      <span class="sep">|</span>
      <a href="eliminar.php?id=<?= $fila['idUsuario'] ?>" class="btn-eliminar"
         onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
</body>
</html>
