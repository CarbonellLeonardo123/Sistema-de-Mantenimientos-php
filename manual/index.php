<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manuales - Promart</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:white; font-family:Arial; min-height:100vh; display:flex; align-items:center; justify-content:center; }
.contenedor { text-align:center; padding:40px 20px; }
.logo { font-size:28px; font-weight:bold; letter-spacing:3px; margin-bottom:8px; }
.subtitulo { color:#a0bcd8; font-size:15px; margin-bottom:50px; }
.cards { display:flex; gap:30px; justify-content:center; flex-wrap:wrap; }
.card { background:#1a2a3a; border:1px solid rgba(255,255,255,0.1); border-radius:16px; padding:40px 36px; width:240px; text-decoration:none; color:white; transition:0.2s; }
.card:hover { transform:translateY(-5px); border-color:rgba(255,255,255,0.3); }
.card-icon { font-size:52px; margin-bottom:20px; }
.card-title { font-size:18px; font-weight:bold; margin-bottom:10px; }
.card-desc { font-size:13px; color:#a0bcd8; line-height:1.6; }
.card-btn { display:inline-block; margin-top:20px; padding:10px 24px; border-radius:8px; font-size:14px; font-weight:bold; }
.card-usuario .card-btn { background:#e07b20; }
.card-admin .card-btn { background:#e74c3c; }
.btn-volver { display:inline-block; margin-top:40px; padding:10px 24px; background:transparent; border:2px solid rgba(255,255,255,0.3); border-radius:8px; color:white; text-decoration:none; font-size:14px; transition:0.2s; }
.btn-volver:hover { border-color:white; }
</style>
</head>
<body>
<div class="contenedor">
  <div class="logo">PROMART</div>
  <div class="subtitulo">Seleccione el manual que desea consultar</div>

  <div class="cards">
    <a href="manual_usuario.php" class="card card-usuario" target="_blank">
      <div class="card-icon">📘</div>
      <div class="card-title">Manual de Usuario</div>
      <div class="card-desc">Guía para usuarios finales del sistema. Aprenda a usar todos los módulos paso a paso.</div>
      <span class="card-btn">Ver Manual</span>
    </a>

    <a href="manual_administrador.php" class="card card-admin" target="_blank">
      <div class="card-icon">🔐</div>
      <div class="card-title">Manual de Administrador</div>
      <div class="card-desc">Guía técnica para administradores. Instalación, configuración y mantenimiento del sistema.</div>
      <span class="card-btn">Ver Manual</span>
    </a>
  </div>

  <a href="../menu.php" class="btn-volver">← Volver al Menú</a>
</div>
</body>
</html>