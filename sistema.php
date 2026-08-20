<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema Promart</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
    font-family:Arial, sans-serif;
    background:#0f1c2e;
    color:white;
    min-height:100vh;
    padding:30px 20px;
}
.header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
    padding-bottom:20px;
    border-bottom:1px solid rgba(255,255,255,0.1);
}
.header-brand {
    display:flex;
    align-items:center;
    gap:10px;
    font-size:20px;
    font-weight:bold;
    letter-spacing:2px;
}
.header-brand svg { width:26px; height:26px; stroke:white; fill:none; stroke-width:2; }
.btn-volver {
    padding:10px 22px;
    background:transparent;
    border:2px solid rgba(255,255,255,0.4);
    border-radius:8px;
    color:white;
    font-size:14px;
    text-decoration:none;
    transition:0.2s;
}
.btn-volver:hover { border-color:white; }
h1 {
    text-align:center;
    font-size:28px;
    font-style:italic;
    margin:30px 0 10px;
    color:white;
}
.subtitulo {
    text-align:center;
    color:#a0bcd8;
    font-size:14px;
    margin-bottom:36px;
}
/* SECCIONES */
.seccion-titulo {
    font-size:13px;
    letter-spacing:2px;
    color:#a0bcd8;
    margin-bottom:14px;
    margin-top:30px;
    padding-left:4px;
    border-left:3px solid #e07b20;
    padding-left:10px;
}
.grid {
    display:grid;
    grid-template-columns: repeat(5, 1fr);
    gap:16px;
    margin-bottom:10px;
}
.grid-3 {
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap:16px;
    max-width:700px;
}
/* CARD */
.card {
    background:#1a2a3a;
    border:1px solid rgba(255,255,255,0.08);
    border-radius:14px;
    padding:22px 16px;
    text-align:center;
    text-decoration:none;
    color:white;
    transition:transform 0.2s, background 0.2s, border-color 0.2s;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:12px;
}
.card:hover {
    background:#1e3a5f;
    transform:translateY(-3px);
    border-color:rgba(224,123,32,0.5);
}
.card-icon {
    width:52px; height:52px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
}
.card-icon svg {
    width:26px; height:26px;
    fill:none;
    stroke-width:1.8;
}
.card-label {
    font-size:14px;
    font-weight:bold;
    letter-spacing:0.5px;
}
/* Colores por grupo */
.color-orange .card-icon { background:rgba(224,123,32,0.2); }
.color-orange .card-icon svg { stroke:#f0a050; }
.color-blue .card-icon { background:rgba(52,152,219,0.2); }
.color-blue .card-icon svg { stroke:#5dade2; }
.color-green .card-icon { background:rgba(46,204,113,0.2); }
.color-green .card-icon svg { stroke:#2ecc71; }
.color-purple .card-icon { background:rgba(155,89,182,0.2); }
.color-purple .card-icon svg { stroke:#bb8fce; }
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

<h1>Panel del Sistema</h1>
<p class="subtitulo">Acceso rápido a los 15 módulos del sistema</p>

<!-- MANTENIMIENTOS -->
<div class="seccion-titulo">MANTENIMIENTOS</div>
<div class="grid">

  <a href="mantenimientos/usuarios/listar.php" class="card color-orange">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <span class="card-label">Usuarios</span>
  </a>

  <a href="mantenimientos/clientes/listar.php" class="card color-blue">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </div>
    <span class="card-label">Clientes</span>
  </a>

  <a href="mantenimientos/empleados/listar.php" class="card color-green">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
    </div>
    <span class="card-label">Empleados</span>
  </a>

  <a href="mantenimientos/proveedores/listar.php" class="card color-orange">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
    </div>
    <span class="card-label">Proveedores</span>
  </a>

  <a href="mantenimientos/productos/listar.php" class="card color-blue">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
    </div>
    <span class="card-label">Productos</span>
  </a>

</div>

<!-- CATALOGOS -->
<div class="seccion-titulo">CATÁLOGOS</div>
<div class="grid">

  <a href="mantenimientos/categoria/listar.php" class="card color-purple">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
    </div>
    <span class="card-label">Categorías</span>
  </a>

  <a href="mantenimientos/marcas/listar.php" class="card color-orange">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
    </div>
    <span class="card-label">Marcas</span>
  </a>

  <a href="mantenimientos/almacen/listar.php" class="card color-blue">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
    </div>
    <span class="card-label">Almacén</span>
  </a>

</div>

<!-- OPERACIONES -->
<div class="seccion-titulo">OPERACIONES</div>
<div class="grid">

  <a href="mantenimientos/ventas/listar.php" class="card color-green">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
    </div>
    <span class="card-label">Ventas</span>
  </a>

  <a href="mantenimientos/compras/listar.php" class="card color-orange">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
    </div>
    <span class="card-label">Compras</span>
  </a>

  <a href="mantenimientos/pedidos/listar.php" class="card color-blue">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    </div>
    <span class="card-label">Pedidos</span>
  </a>

  <a href="mantenimientos/pagos/listar.php" class="card color-green">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
    </div>
    <span class="card-label">Pagos</span>
  </a>

</div>

<!-- DETALLE Y REPORTES -->
<div class="seccion-titulo">DETALLE Y REPORTES</div>
<div class="grid-3">

  <a href="mantenimientos/detalleventa/listar.php" class="card color-purple">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
    </div>
    <span class="card-label">Detalle Venta</span>
  </a>

  <a href="mantenimientos/detallecompra/listar.php" class="card color-orange">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
    </div>
    <span class="card-label">Detalle Compra</span>
  </a>

  <a href="mantenimientos/reportes/listar.php" class="card color-green">
    <div class="card-icon">
      <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
    </div>
    <span class="card-label">Reportes</span>
  </a>

</div>

</body>
</html>