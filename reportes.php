<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reportes Promart</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:white; font-family:Arial; min-height:100vh; padding:30px 20px; }
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,0.1); }
.header-brand { display:flex; align-items:center; gap:10px; font-size:20px; font-weight:bold; letter-spacing:2px; }
.header-brand svg { width:26px; height:26px; stroke:white; fill:none; stroke-width:2; }
.btn-volver { padding:10px 22px; background:transparent; border:2px solid rgba(255,255,255,0.4); border-radius:8px; color:white; font-size:14px; text-decoration:none; transition:0.2s; }
.btn-volver:hover { border-color:white; }
h1 { text-align:center; font-size:28px; font-style:italic; margin-bottom:8px; }
.subtitulo { text-align:center; color:#a0bcd8; font-size:14px; margin-bottom:36px; }
.seccion-titulo { font-size:13px; letter-spacing:2px; color:#a0bcd8; margin-bottom:16px; margin-top:30px; border-left:3px solid #e07b20; padding-left:10px; }
.grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:10px; }
.card { background:#1a2a3a; border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:24px 20px; transition:0.2s; }
.card:hover { background:#1e3a5f; transform:translateY(-2px); }
.card-header { display:flex; align-items:center; gap:12px; margin-bottom:16px; }
.card-icon { width:44px; height:44px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.card-icon svg { width:22px; height:22px; fill:none; stroke-width:1.8; }
.card-title { font-size:16px; font-weight:bold; }
.card-desc { font-size:13px; color:#a0bcd8; margin-bottom:18px; line-height:1.5; }
.card-btns { display:flex; gap:10px; }
.btn-pdf { flex:1; padding:10px; background:#e74c3c; border:none; border-radius:8px; color:white; font-size:13px; font-weight:bold; cursor:pointer; text-decoration:none; text-align:center; transition:0.2s; }
.btn-pdf:hover { background:#c0392b; }
.btn-excel { flex:1; padding:10px; background:#27ae60; border:none; border-radius:8px; color:white; font-size:13px; font-weight:bold; cursor:pointer; text-decoration:none; text-align:center; transition:0.2s; }
.btn-excel:hover { background:#1e8449; }
/* colores icono */
.ic-ventas   { background:rgba(46,204,113,0.2); } .ic-ventas svg   { stroke:#2ecc71; }
.ic-clientes { background:rgba(52,152,219,0.2); } .ic-clientes svg { stroke:#5dade2; }
.ic-productos{ background:rgba(224,123,32,0.2); } .ic-productos svg{ stroke:#f0a050; }
.ic-compras  { background:rgba(231,76,60,0.2);  } .ic-compras svg  { stroke:#e74c3c; }
.ic-empleados{ background:rgba(155,89,182,0.2); } .ic-empleados svg{ stroke:#bb8fce; }
.ic-usuarios { background:rgba(241,196,15,0.2); } .ic-usuarios svg { stroke:#f1c40f; }
</style>
</head>
<body>

<div class="header">
  <div class="header-brand">
    <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    PROMART
  </div>
  <a href="menu.php" class="btn-volver">← Volver al Menú</a>
</div>

<h1>Reportes del Sistema</h1>
<p class="subtitulo">Genera e imprime reportes en PDF o Excel</p>

<div class="seccion-titulo">REPORTES DISPONIBLES</div>

<div class="grid">

  <!-- VENTAS -->
  <div class="card">
    <div class="card-header">
      <div class="card-icon ic-ventas">
        <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      </div>
      <span class="card-title">Reporte de Ventas</span>
    </div>
    <p class="card-desc">Listado completo de ventas registradas con cliente, fecha y total.</p>
    <div class="card-btns">
      <a href="reportes/pdf_ventas.php" class="btn-pdf">📄 PDF</a>
      <a href="reportes/excel_ventas.php" class="btn-excel">📊 Excel</a>
    </div>
  </div>

  <!-- CLIENTES -->
  <div class="card">
    <div class="card-header">
      <div class="card-icon ic-clientes">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </div>
      <span class="card-title">Reporte de Clientes</span>
    </div>
    <p class="card-desc">Lista de todos los clientes registrados con sus datos de contacto.</p>
    <div class="card-btns">
      <a href="reportes/pdf_clientes.php" class="btn-pdf">📄 PDF</a>
      <a href="reportes/excel_clientes.php" class="btn-excel">📊 Excel</a>
    </div>
  </div>

  <!-- PRODUCTOS -->
  <div class="card">
    <div class="card-header">
      <div class="card-icon ic-productos">
        <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      </div>
      <span class="card-title">Reporte de Productos</span>
    </div>
    <p class="card-desc">Inventario completo con categoría, stock y precio actual.</p>
    <div class="card-btns">
      <a href="reportes/pdf_productos.php" class="btn-pdf">📄 PDF</a>
      <a href="reportes/excel_productos.php" class="btn-excel">📊 Excel</a>
    </div>
  </div>

  <!-- COMPRAS -->
  <div class="card">
    <div class="card-header">
      <div class="card-icon ic-compras">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      </div>
      <span class="card-title">Reporte de Compras</span>
    </div>
    <p class="card-desc">Listado de compras realizadas con proveedor, fecha y monto total.</p>
    <div class="card-btns">
      <a href="reportes/pdf_compras.php" class="btn-pdf">📄 PDF</a>
      <a href="reportes/excel_compras.php" class="btn-excel">📊 Excel</a>
    </div>
  </div>

  <!-- EMPLEADOS -->
  <div class="card">
    <div class="card-header">
      <div class="card-icon ic-empleados">
        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
      </div>
      <span class="card-title">Reporte de Empleados</span>
    </div>
    <p class="card-desc">Lista del personal con cargo, teléfono y correo electrónico.</p>
    <div class="card-btns">
      <a href="reportes/pdf_empleados.php" class="btn-pdf">📄 PDF</a>
      <a href="reportes/excel_empleados.php" class="btn-excel">📊 Excel</a>
    </div>
  </div>

  <!-- USUARIOS -->
  <div class="card">
    <div class="card-header">
      <div class="card-icon ic-usuarios">
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <span class="card-title">Reporte de Usuarios</span>
    </div>
    <p class="card-desc">Lista de usuarios del sistema con su rol asignado.</p>
    <div class="card-btns">
      <a href="reportes/pdf_usuarios.php" class="btn-pdf">📄 PDF</a>
      <a href="reportes/excel_usuarios.php" class="btn-excel">📊 Excel</a>
    </div>
  </div>

</div>

</body>
</html>