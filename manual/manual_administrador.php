<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manual de Administrador - Promart</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:#cdd6e0; font-family:Arial, sans-serif; display:flex; }
.sidebar { width:280px; min-height:100vh; background:#0a1525; border-right:1px solid rgba(255,255,255,0.08); position:fixed; top:0; left:0; overflow-y:auto; padding-bottom:30px; }
.sidebar-header { background:#7d2020; padding:20px; border-bottom:1px solid rgba(255,255,255,0.1); }
.sidebar-header h2 { font-size:14px; color:white; letter-spacing:1px; }
.sidebar-header p { font-size:11px; color:#f1948a; margin-top:4px; }
.sidebar-menu { padding:10px 0; }
.menu-section { padding:14px 20px 6px; font-size:11px; letter-spacing:2px; color:#5d7a9a; }
.menu-item { display:block; padding:10px 20px; color:#a0bcd8; text-decoration:none; font-size:13px; border-left:3px solid transparent; transition:0.2s; }
.menu-item:hover { background:rgba(255,255,255,0.05); color:white; border-left-color:#e74c3c; }
.menu-item.active { background:rgba(231,76,60,0.1); color:#f1948a; border-left-color:#e74c3c; }
.main { margin-left:280px; flex:1; padding:40px; max-width:900px; }
.topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:40px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,0.1); }
.topbar h1 { font-size:22px; color:white; }
.btn-volver { padding:10px 20px; background:transparent; border:2px solid rgba(255,255,255,0.3); border-radius:8px; color:white; text-decoration:none; font-size:13px; transition:0.2s; }
.btn-volver:hover { border-color:white; }
.seccion { margin-bottom:60px; padding-top:20px; }
.seccion h2 { font-size:22px; color:white; margin-bottom:6px; padding-bottom:10px; border-bottom:2px solid #e74c3c; }
.seccion h3 { font-size:17px; color:#f1948a; margin:24px 0 10px; }
.seccion h4 { font-size:14px; color:#f0a050; margin:16px 0 8px; }
.seccion p { font-size:14px; line-height:1.8; margin-bottom:12px; color:#b0c4d8; }
.seccion ul, .seccion ol { padding-left:24px; margin-bottom:12px; }
.seccion li { font-size:14px; line-height:1.9; color:#b0c4d8; }
.nota { background:rgba(224,123,32,0.1); border-left:4px solid #e07b20; padding:14px 18px; border-radius:0 8px 8px 0; margin:16px 0; }
.nota p { color:#f0a050; margin:0; }
.advertencia { background:rgba(231,76,60,0.1); border-left:4px solid #e74c3c; padding:14px 18px; border-radius:0 8px 8px 0; margin:16px 0; }
.advertencia p { color:#f1948a; margin:0; }
.tip { background:rgba(46,204,113,0.1); border-left:4px solid #2ecc71; padding:14px 18px; border-radius:0 8px 8px 0; margin:16px 0; }
.tip p { color:#2ecc71; margin:0; }
.danger { background:rgba(231,76,60,0.15); border-left:4px solid #c0392b; padding:14px 18px; border-radius:0 8px 8px 0; margin:16px 0; }
.danger p { color:#e74c3c; margin:0; font-weight:bold; }
.paso { background:#1a2a3a; border-radius:10px; padding:16px 20px; margin:10px 0; display:flex; gap:14px; align-items:flex-start; }
.paso-num { background:#e74c3c; color:white; width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:13px; flex-shrink:0; }
.paso-text { font-size:14px; color:#b0c4d8; line-height:1.7; }
table { width:100%; border-collapse:collapse; margin:16px 0; }
th { background:#1e3a5f; padding:12px; text-align:left; font-size:13px; color:#a0bcd8; }
td { padding:11px 12px; font-size:13px; color:#b0c4d8; border-bottom:1px solid rgba(255,255,255,0.06); }
tr:hover td { background:rgba(255,255,255,0.03); }
.code { background:#0a1525; border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:16px 20px; font-family:monospace; font-size:13px; color:#2ecc71; margin:12px 0; overflow-x:auto; }
.portada { text-align:center; padding:60px 0 80px; border-bottom:2px solid rgba(255,255,255,0.1); margin-bottom:60px; }
.portada h1 { font-size:38px; color:white; letter-spacing:3px; margin-bottom:10px; }
.portada h2 { font-size:20px; color:#e74c3c; margin-bottom:30px; }
.portada p { font-size:14px; color:#a0bcd8; margin-bottom:6px; }
.version { display:inline-block; background:#7d2020; padding:8px 24px; border-radius:20px; font-size:13px; color:#f1948a; margin-top:20px; }
.badge { padding:3px 10px; border-radius:12px; font-size:12px; font-weight:bold; }
.badge-admin { background:rgba(224,123,32,0.2); color:#f0a050; }
.badge-empleado { background:rgba(46,204,113,0.2); color:#2ecc71; }
.badge-supervisor { background:rgba(52,152,219,0.2); color:#5dade2; }
</style>
</head>
<body>

<div class="sidebar">
  <div class="sidebar-header">
    <h2>🔐 MANUAL DE ADMINISTRADOR</h2>
    <p>Sistema Promart v1.0</p>
  </div>
  <div class="sidebar-menu">
    <div class="menu-section">INTRODUCCIÓN</div>
    <a href="#portada" class="menu-item">Portada</a>
    <a href="#introduccion" class="menu-item">Introducción</a>
    <a href="#objetivos" class="menu-item">Objetivos</a>
    <a href="#arquitectura" class="menu-item">Arquitectura del Sistema</a>
    <div class="menu-section">INSTALACIÓN</div>
    <a href="#requisitos" class="menu-item">Requisitos Técnicos</a>
    <a href="#instalacion" class="menu-item">Instalación del Sistema</a>
    <a href="#basedatos" class="menu-item">Base de Datos</a>
    <a href="#configuracion" class="menu-item">Configuración</a>
    <div class="menu-section">ADMINISTRACIÓN</div>
    <a href="#usuarios" class="menu-item">Gestión de Usuarios</a>
    <a href="#roles" class="menu-item">Roles y Permisos</a>
    <a href="#seguridad" class="menu-item">Seguridad del Sistema</a>
    <a href="#sesiones" class="menu-item">Gestión de Sesiones</a>
    <div class="menu-section">BASE DE DATOS</div>
    <a href="#tablas" class="menu-item">Estructura de Tablas</a>
    <a href="#relaciones" class="menu-item">Relaciones</a>
    <a href="#backup" class="menu-item">Respaldo y Restauración</a>
    <a href="#mantenimiento" class="menu-item">Mantenimiento BD</a>
    <div class="menu-section">MÓDULOS</div>
    <a href="#modulos" class="menu-item">Administración de Módulos</a>
    <a href="#reportes" class="menu-item">Configuración de Reportes</a>
    <a href="#fpdf" class="menu-item">Librería FPDF</a>
    <div class="menu-section">AVANZADO</div>
    <a href="#servidor" class="menu-item">Configuración del Servidor</a>
    <a href="#errores" class="menu-item">Errores del Sistema</a>
    <a href="#optimizacion" class="menu-item">Optimización</a>
    <a href="#glosario" class="menu-item">Glosario Técnico</a>
  </div>
</div>

<div class="main">
  <div class="topbar">
    <h1>Manual de Administrador</h1>
    <a href="../menu.php" class="btn-volver">← Volver al Menú</a>
  </div>

  <!-- PORTADA -->
  <div class="portada" id="portada">
    <h1>PROMART</h1>
    <h2>Sistema de Gestión Empresarial</h2>
    <p>Manual de Administrador</p>
    <p>Versión 1.0 — 2026</p>
    <p>Desarrollado con PHP, HTML, CSS, JavaScript y MySQL</p>
    <p style="margin-top:20px;color:#e74c3c;font-weight:bold;">⚠️ DOCUMENTO CONFIDENCIAL — SOLO PARA ADMINISTRADORES</p>
    <span class="version">v1.0 — Mayo 2026</span>
  </div>

  <!-- INTRODUCCION -->
  <div class="seccion" id="introduccion">
    <h2>1. Introducción</h2>
    <p>Este Manual de Administrador está dirigido exclusivamente al personal técnico encargado de instalar, configurar, mantener y administrar el Sistema de Gestión Empresarial Promart. A diferencia del Manual de Usuario, este documento cubre aspectos técnicos avanzados del sistema.</p>
    <p>El Sistema Promart es una aplicación web desarrollada en PHP con base de datos MySQL, que corre sobre un servidor Apache local mediante XAMPP. El sistema cuenta con 15 módulos CRUD, sistema de autenticación por sesiones, generación de reportes en PDF con FPDF y exportación a Excel.</p>
    <p>El administrador es responsable de garantizar el correcto funcionamiento del sistema, la seguridad de los datos, la gestión de usuarios y el mantenimiento preventivo de la base de datos.</p>
    <div class="danger"><p>⚠️ Este manual contiene información sensible del sistema. No debe ser compartido con usuarios finales.</p></div>
  </div>

  <!-- OBJETIVOS -->
  <div class="seccion" id="objetivos">
    <h2>2. Objetivos</h2>
    <h3>2.1 Objetivo General</h3>
    <p>Proporcionar al administrador del sistema una guía técnica completa para instalar, configurar, mantener y administrar el Sistema de Gestión Empresarial Promart.</p>
    <h3>2.2 Objetivos Específicos</h3>
    <ul>
      <li>Describir el proceso completo de instalación del sistema desde cero.</li>
      <li>Explicar la estructura de la base de datos y sus relaciones.</li>
      <li>Detallar la gestión de usuarios, roles y permisos del sistema.</li>
      <li>Proporcionar procedimientos de respaldo y restauración de datos.</li>
      <li>Explicar la configuración de la librería FPDF para reportes.</li>
      <li>Describir los procedimientos de mantenimiento y optimización.</li>
      <li>Documentar los errores técnicos y sus soluciones.</li>
    </ul>
  </div>

  <!-- ARQUITECTURA -->
  <div class="seccion" id="arquitectura">
    <h2>3. Arquitectura del Sistema</h2>
    <h3>3.1 Tecnologías Utilizadas</h3>
    <table>
      <tr><th>Capa</th><th>Tecnología</th><th>Versión</th><th>Función</th></tr>
      <tr><td>Frontend</td><td>HTML5 + CSS3</td><td>—</td><td>Interfaz de usuario</td></tr>
      <tr><td>Frontend</td><td>JavaScript</td><td>ES6</td><td>Interactividad</td></tr>
      <tr><td>Backend</td><td>PHP</td><td>8.2</td><td>Lógica del servidor</td></tr>
      <tr><td>Base de datos</td><td>MySQL</td><td>8.0</td><td>Almacenamiento de datos</td></tr>
      <tr><td>Servidor</td><td>Apache</td><td>2.4</td><td>Servidor web</td></tr>
      <tr><td>Entorno</td><td>XAMPP</td><td>8.x</td><td>Servidor local</td></tr>
      <tr><td>PDF</td><td>FPDF</td><td>1.84</td><td>Generación de reportes PDF</td></tr>
    </table>
    <h3>3.2 Estructura de Carpetas</h3>
    <div class="code">
Promart/<br>
├── config/<br>
│   └── conexion.php &nbsp;&nbsp;&nbsp;← Conexión a BD<br>
├── css/<br>
│   └── estilos.css &nbsp;&nbsp;&nbsp;&nbsp;← Estilos globales<br>
├── img/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Imágenes<br>
├── js/<br>
│   └── scripts.js &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Scripts JS<br>
├── fpdf/<br>
│   ├── font/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Fuentes FPDF<br>
│   └── fpdf.php &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Librería PDF<br>
├── manual/<br>
│   ├── manual_usuario.php<br>
│   └── manual_administrador.php<br>
├── mantenimientos/<br>
│   ├── usuarios/<br>
│   ├── clientes/<br>
│   ├── empleados/<br>
│   ├── proveedores/<br>
│   ├── productos/<br>
│   ├── categoria/<br>
│   ├── marcas/<br>
│   ├── almacen/<br>
│   ├── ventas/<br>
│   ├── compras/<br>
│   ├── pedidos/<br>
│   ├── pagos/<br>
│   ├── detalleventa/<br>
│   └── detallecompra/<br>
├── reportes/<br>
│   ├── pdf_ventas.php<br>
│   ├── pdf_clientes.php<br>
│   ├── excel_ventas.php<br>
│   └── ...<br>
├── SQL/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Scripts SQL<br>
├── index.php &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Login<br>
├── menu.php &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Menú principal<br>
├── sistema.php &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Panel del sistema<br>
├── reportes.php &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Módulo reportes<br>
└── logout.php &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;← Cierre de sesión
    </div>
    <h3>3.3 Patrón de Desarrollo</h3>
    <p>El sistema sigue un patrón de desarrollo tradicional PHP sin frameworks, con archivos separados por función (listar, registrar, editar, eliminar) para cada módulo. Esto facilita el mantenimiento y la comprensión del código.</p>
  </div>

  <!-- REQUISITOS -->
  <div class="seccion" id="requisitos">
    <h2>4. Requisitos Técnicos</h2>
    <h3>4.1 Requisitos del Servidor</h3>
    <table>
      <tr><th>Componente</th><th>Requisito</th></tr>
      <tr><td>Sistema Operativo</td><td>Windows 10/11, Linux CentOS 7, Ubuntu 20+</td></tr>
      <tr><td>Servidor Web</td><td>Apache 2.4 o superior</td></tr>
      <tr><td>PHP</td><td>8.2 o superior con extensiones: mysqli, mbstring, gd</td></tr>
      <tr><td>MySQL</td><td>8.0 o superior</td></tr>
      <tr><td>RAM</td><td>Mínimo 4 GB</td></tr>
      <tr><td>Disco</td><td>Mínimo 10 GB libres</td></tr>
    </table>
    <h3>4.2 Extensiones PHP Requeridas</h3>
    <ul>
      <li><strong>mysqli</strong> — Conexión a base de datos MySQL</li>
      <li><strong>session</strong> — Gestión de sesiones de usuario</li>
      <li><strong>mbstring</strong> — Manejo de caracteres especiales</li>
      <li><strong>gd</strong> — Procesamiento de imágenes (usado por FPDF)</li>
    </ul>
  </div>

  <!-- INSTALACION -->
  <div class="seccion" id="instalacion">
    <h2>5. Instalación del Sistema</h2>
    <h3>5.1 Instalación en Windows con XAMPP</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Descargue e instale XAMPP desde <strong>https://www.apachefriends.org</strong></div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Inicie XAMPP y active los servicios <strong>Apache</strong> y <strong>MySQL</strong>.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Copie la carpeta <strong>Promart</strong> en: <code>C:\xampp\htdocs\Promart\</code></div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Abra el navegador y acceda a <strong>http://localhost/phpmyadmin</strong></div></div>
    <div class="paso"><div class="paso-num">5</div><div class="paso-text">Cree una base de datos llamada <strong>promart</strong> (o el nombre configurado).</div></div>
    <div class="paso"><div class="paso-num">6</div><div class="paso-text">Importe el archivo SQL desde la carpeta <strong>SQL/</strong> del proyecto.</div></div>
    <div class="paso"><div class="paso-num">7</div><div class="paso-text">Configure el archivo <strong>config/conexion.php</strong> con los datos de su servidor.</div></div>
    <div class="paso"><div class="paso-num">8</div><div class="paso-text">Acceda al sistema en <strong>http://localhost/Promart/</strong></div></div>

    <h3>5.2 Instalación en Linux CentOS 7</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Instale Apache: <code>yum install httpd</code></div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Instale PHP: <code>yum install php php-mysqli php-mbstring</code></div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Instale MySQL: <code>yum install mysql-server</code></div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Inicie los servicios: <code>systemctl start httpd && systemctl start mysqld</code></div></div>
    <div class="paso"><div class="paso-num">5</div><div class="paso-text">Copie el proyecto en <code>/var/www/html/Promart/</code></div></div>
    <div class="paso"><div class="paso-num">6</div><div class="paso-text">Configure permisos: <code>chmod -R 755 /var/www/html/Promart/</code></div></div>
  </div>

  <!-- BASE DE DATOS -->
  <div class="seccion" id="basedatos">
    <h2>6. Base de Datos</h2>
    <h3>6.1 Nombre de la Base de Datos</h3>
    <div class="code">promart</div>
    <h3>6.2 Tablas del Sistema</h3>
    <table>
      <tr><th>Tabla</th><th>Descripción</th><th>Campos Principales</th></tr>
      <tr><td>usuario</td><td>Usuarios del sistema</td><td>idUsuario, usuario, clave, rol</td></tr>
      <tr><td>cliente</td><td>Clientes de la empresa</td><td>idCliente, nombre, apellido, correo, dni</td></tr>
      <tr><td>empleado</td><td>Personal de la empresa</td><td>idEmpleado, nombre, cargo, telefono, correo</td></tr>
      <tr><td>proveedor</td><td>Proveedores</td><td>idProveedor, nombre, telefono, direccion</td></tr>
      <tr><td>producto</td><td>Catálogo de productos</td><td>idProducto, nombre, categoria, precio, stock</td></tr>
      <tr><td>categoria</td><td>Categorías de productos</td><td>idCategoria, nombre</td></tr>
      <tr><td>marca</td><td>Marcas de productos</td><td>idMarca, nombre</td></tr>
      <tr><td>almacen</td><td>Almacenes</td><td>idAlmacen, nombre, ubicacion</td></tr>
      <tr><td>venta</td><td>Ventas realizadas</td><td>idVenta, idCliente, fecha, total</td></tr>
      <tr><td>compras</td><td>Compras a proveedores</td><td>idCompra, idProveedor, fecha, total</td></tr>
      <tr><td>pedidos</td><td>Pedidos de clientes</td><td>idPedido, idCliente, fecha, estado, total</td></tr>
      <tr><td>pagos</td><td>Pagos recibidos</td><td>idPago, idVenta, metodo, monto, fecha</td></tr>
      <tr><td>detalleventa</td><td>Detalle de ventas</td><td>idDetalle, idVenta, idProducto, cantidad, precio, subtotal</td></tr>
      <tr><td>detallecompra</td><td>Detalle de compras</td><td>idDetalleCompra, idCompra, idProducto, cantidad, precio, subtotal</td></tr>
      <tr><td>reportes</td><td>Registro de reportes</td><td>idReporte, nombre, fecha</td></tr>
    </table>
    <h3>6.3 Script SQL de Creación</h3>
    <div class="code">
CREATE DATABASE IF NOT EXISTS promart;<br>
USE promart;<br><br>
CREATE TABLE usuario (<br>
&nbsp;&nbsp;idUsuario INT AUTO_INCREMENT PRIMARY KEY,<br>
&nbsp;&nbsp;usuario VARCHAR(50),<br>
&nbsp;&nbsp;clave VARCHAR(50),<br>
&nbsp;&nbsp;rol VARCHAR(50)<br>
);<br><br>
CREATE TABLE cliente (<br>
&nbsp;&nbsp;idCliente INT AUTO_INCREMENT PRIMARY KEY,<br>
&nbsp;&nbsp;nombre VARCHAR(100),<br>
&nbsp;&nbsp;apellido VARCHAR(100),<br>
&nbsp;&nbsp;correo VARCHAR(100),<br>
&nbsp;&nbsp;dni VARCHAR(20)<br>
);<br><br>
CREATE TABLE producto (<br>
&nbsp;&nbsp;idProducto INT AUTO_INCREMENT PRIMARY KEY,<br>
&nbsp;&nbsp;nombre VARCHAR(100),<br>
&nbsp;&nbsp;categoria VARCHAR(100),<br>
&nbsp;&nbsp;precio DECIMAL(10,2),<br>
&nbsp;&nbsp;stock INT<br>
);<br><br>
-- ... (continúa con las demás tablas)
    </div>
  </div>

  <!-- CONFIGURACION -->
  <div class="seccion" id="configuracion">
    <h2>7. Configuración del Sistema</h2>
    <h3>7.1 Archivo de Conexión</h3>
    <p>El archivo principal de configuración es <strong>config/conexion.php</strong>. Este archivo establece la conexión con la base de datos.</p>
    <div class="code">
&lt;?php<br>
$servidor = "localhost"; &nbsp;// Servidor de BD<br>
$usuario = "root"; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Usuario MySQL<br>
$clave = ""; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Contraseña MySQL<br>
$base = "promart"; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Nombre de la BD<br><br>
$conn = mysqli_connect($servidor, $usuario, $clave, $base);<br><br>
if(!$conn){<br>
&nbsp;&nbsp;die("Error de conexión: " . mysqli_connect_error());<br>
}
    </div>
    <div class="advertencia"><p>⚠️ En producción nunca deje la contraseña vacía. Configure una contraseña segura para el usuario MySQL.</p></div>
    <h3>7.2 Parámetros de Configuración</h3>
    <table>
      <tr><th>Parámetro</th><th>Valor por defecto</th><th>Descripción</th></tr>
      <tr><td>$servidor</td><td>localhost</td><td>Host del servidor MySQL</td></tr>
      <tr><td>$usuario</td><td>root</td><td>Usuario de MySQL</td></tr>
      <tr><td>$clave</td><td>(vacío)</td><td>Contraseña de MySQL</td></tr>
      <tr><td>$base</td><td>promart</td><td>Nombre de la base de datos</td></tr>
    </table>
  </div>

  <!-- USUARIOS -->
  <div class="seccion" id="usuarios">
    <h2>8. Gestión de Usuarios</h2>
    <p>Como administrador, usted tiene control total sobre los usuarios del sistema. Puede crear, editar y eliminar cualquier cuenta de acceso.</p>
    <h3>8.1 Crear Usuario Administrador</h3>
    <p>Para crear el primer usuario administrador directamente en la base de datos:</p>
    <div class="code">
INSERT INTO usuario (usuario, clave, rol)<br>
VALUES ('admin', '123', 'Administrador');
    </div>
    <h3>8.2 Cambiar Contraseña desde MySQL</h3>
    <div class="code">
UPDATE usuario SET clave='nueva_clave'<br>
WHERE usuario='admin';
    </div>
    <h3>8.3 Desactivar un Usuario</h3>
    <p>El sistema no tiene función de desactivar usuarios directamente. Para bloquear el acceso de un usuario cambie su contraseña a un valor desconocido o elimine el registro.</p>
    <div class="danger"><p>⚠️ Nunca elimine el único usuario administrador del sistema.</p></div>
  </div>

  <!-- ROLES -->
  <div class="seccion" id="roles">
    <h2>9. Roles y Permisos</h2>
    <p>El sistema maneja tres roles de usuario que determinan el nivel de acceso:</p>
    <table>
      <tr><th>Rol</th><th>Acceso</th><th>Descripción</th></tr>
      <tr><td><span class="badge badge-admin">Administrador</span></td><td>Total</td><td>Acceso completo a todos los módulos, reportes y configuración</td></tr>
      <tr><td><span class="badge badge-supervisor">Supervisor</span></td><td>Parcial</td><td>Puede consultar y generar reportes, supervisar operaciones</td></tr>
      <tr><td><span class="badge badge-empleado">Empleado</span></td><td>Básico</td><td>Registro de ventas, consulta de productos y clientes</td></tr>
    </table>
    <div class="nota"><p>📌 Los roles se asignan desde el módulo de Usuarios. Solo el Administrador puede cambiar roles.</p></div>
  </div>

  <!-- SEGURIDAD -->
  <div class="seccion" id="seguridad">
    <h2>10. Seguridad del Sistema</h2>
    <h3>10.1 Medidas de Seguridad Implementadas</h3>
    <ul>
      <li><strong>Consultas preparadas (mysqli_prepare):</strong> Protección contra inyección SQL en todos los módulos.</li>
      <li><strong>Control de sesiones:</strong> Verificación de sesión activa en cada página del sistema.</li>
      <li><strong>htmlspecialchars():</strong> Escape de caracteres especiales para prevenir XSS.</li>
      <li><strong>intval():</strong> Validación de IDs numéricos para prevenir manipulación de URLs.</li>
    </ul>
    <h3>10.2 Protección contra SQL Injection</h3>
    <p>Todos los módulos usan consultas preparadas. Ejemplo:</p>
    <div class="code">
$stmt = mysqli_prepare($conn, "SELECT * FROM usuario WHERE usuario=?");<br>
mysqli_stmt_bind_param($stmt, "s", $usuario);<br>
mysqli_stmt_execute($stmt);
    </div>
    <h3>10.3 Recomendaciones de Seguridad</h3>
    <ul>
      <li>Cambie la contraseña del usuario admin regularmente.</li>
      <li>No comparta credenciales de administrador.</li>
      <li>Configure HTTPS en producción.</li>
      <li>Realice respaldos de la base de datos diariamente.</li>
      <li>Mantenga XAMPP y PHP actualizados.</li>
    </ul>
    <div class="advertencia"><p>⚠️ En entorno de producción configure una contraseña para MySQL y no use el usuario root.</p></div>
  </div>

  <!-- SESIONES -->
  <div class="seccion" id="sesiones">
    <h2>11. Gestión de Sesiones</h2>
    <p>El sistema usa sesiones PHP nativas para autenticar usuarios. La sesión se inicia al hacer login y se destruye al cerrar sesión.</p>
    <h3>11.1 Variables de Sesión</h3>
    <table>
      <tr><th>Variable</th><th>Contenido</th><th>Uso</th></tr>
      <tr><td>$_SESSION['usuario']</td><td>Nombre del usuario logueado</td><td>Mostrar nombre en la interfaz y en reportes</td></tr>
    </table>
    <h3>11.2 Protección de Páginas</h3>
    <p>Todas las páginas del sistema verifican la sesión al inicio:</p>
    <div class="code">
session_start();<br>
if(!isset($_SESSION['usuario'])) {<br>
&nbsp;&nbsp;header("Location:index.php");<br>
&nbsp;&nbsp;exit();<br>
}
    </div>
    <h3>11.3 Tiempo de Sesión</h3>
    <p>La sesión dura mientras el navegador esté abierto. Para configurar un tiempo límite agregue en conexion.php:</p>
    <div class="code">
ini_set('session.gc_maxlifetime', 3600); // 1 hora<br>
session_set_cookie_params(3600);
    </div>
  </div>

  <!-- TABLAS -->
  <div class="seccion" id="tablas">
    <h2>12. Estructura de Tablas</h2>
    <h3>12.1 Tabla: usuario</h3>
    <table>
      <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
      <tr><td>idUsuario</td><td>INT AUTO_INCREMENT PK</td><td>Identificador único</td></tr>
      <tr><td>usuario</td><td>VARCHAR(50)</td><td>Nombre de usuario para login</td></tr>
      <tr><td>clave</td><td>VARCHAR(50)</td><td>Contraseña del usuario</td></tr>
      <tr><td>rol</td><td>VARCHAR(50)</td><td>Rol: Administrador, Empleado, Supervisor</td></tr>
    </table>
    <h3>12.2 Tabla: venta</h3>
    <table>
      <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
      <tr><td>idVenta</td><td>INT AUTO_INCREMENT PK</td><td>Identificador único</td></tr>
      <tr><td>idCliente</td><td>INT FK</td><td>Referencia a tabla cliente</td></tr>
      <tr><td>fecha</td><td>DATE</td><td>Fecha de la venta</td></tr>
      <tr><td>total</td><td>DECIMAL(10,2)</td><td>Monto total de la venta</td></tr>
    </table>
    <h3>12.3 Tabla: producto</h3>
    <table>
      <tr><th>Campo</th><th>Tipo</th><th>Descripción</th></tr>
      <tr><td>idProducto</td><td>INT AUTO_INCREMENT PK</td><td>Identificador único</td></tr>
      <tr><td>nombre</td><td>VARCHAR(100)</td><td>Nombre del producto</td></tr>
      <tr><td>categoria</td><td>VARCHAR(100)</td><td>Categoría asignada</td></tr>
      <tr><td>precio</td><td>DECIMAL(10,2)</td><td>Precio de venta</td></tr>
      <tr><td>stock</td><td>INT</td><td>Cantidad disponible</td></tr>
    </table>
  </div>

  <!-- RELACIONES -->
  <div class="seccion" id="relaciones">
    <h2>13. Relaciones entre Tablas</h2>
    <p>Las principales relaciones del sistema son:</p>
    <ul>
      <li><strong>venta → cliente:</strong> Una venta pertenece a un cliente (idCliente)</li>
      <li><strong>detalleventa → venta:</strong> Un detalle pertenece a una venta (idVenta)</li>
      <li><strong>detalleventa → producto:</strong> Un detalle referencia un producto (idProducto)</li>
      <li><strong>compras → proveedor:</strong> Una compra pertenece a un proveedor (idProveedor)</li>
      <li><strong>detallecompra → compras:</strong> Un detalle pertenece a una compra (idCompra)</li>
      <li><strong>pagos → venta:</strong> Un pago referencia una venta (idVenta)</li>
    </ul>
    <div class="nota"><p>📌 Al eliminar registros padres (clientes, proveedores) verifique que no tengan registros hijos relacionados.</p></div>
  </div>

  <!-- BACKUP -->
  <div class="seccion" id="backup">
    <h2>14. Respaldo y Restauración</h2>
    <h3>14.1 Respaldo desde phpMyAdmin</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Abra <strong>http://localhost/phpmyadmin</strong></div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Seleccione la base de datos <strong>promart</strong> en el panel izquierdo.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Haga clic en la pestaña <strong>Exportar</strong>.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Seleccione formato <strong>SQL</strong> y haga clic en <strong>Continuar</strong>.</div></div>
    <div class="paso"><div class="paso-num">5</div><div class="paso-text">Guarde el archivo en un lugar seguro con la fecha en el nombre.</div></div>
    <h3>14.2 Restaurar Base de Datos</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Abra phpMyAdmin y seleccione o cree la base de datos.</div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Haga clic en la pestaña <strong>Importar</strong>.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Seleccione el archivo SQL de respaldo.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Haga clic en <strong>Continuar</strong>.</div></div>
    <div class="tip"><p>✅ Se recomienda realizar respaldos diarios de la base de datos.</p></div>
  </div>

  <!-- MANTENIMIENTO BD -->
  <div class="seccion" id="mantenimiento">
    <h2>15. Mantenimiento de la Base de Datos</h2>
    <h3>15.1 Optimizar Tablas</h3>
    <div class="code">
OPTIMIZE TABLE usuario, cliente, producto, venta, compras;
    </div>
    <h3>15.2 Verificar Integridad</h3>
    <div class="code">
CHECK TABLE usuario, cliente, producto;
    </div>
    <h3>15.3 Limpiar Registros Antiguos</h3>
    <div class="code">
-- Eliminar ventas de más de 2 años<br>
DELETE FROM venta WHERE fecha &lt; DATE_SUB(NOW(), INTERVAL 2 YEAR);
    </div>
    <div class="danger"><p>⚠️ Realice siempre un respaldo antes de ejecutar comandos DELETE o DROP.</p></div>
  </div>

  <!-- MODULOS -->
  <div class="seccion" id="modulos">
    <h2>16. Administración de Módulos</h2>
    <p>Cada módulo del sistema sigue la misma estructura de archivos:</p>
    <table>
      <tr><th>Archivo</th><th>Función</th></tr>
      <tr><td>listar.php</td><td>Muestra todos los registros en una tabla</td></tr>
      <tr><td>registrar.php</td><td>Formulario para crear nuevos registros</td></tr>
      <tr><td>editar.php</td><td>Formulario para modificar registros existentes</td></tr>
      <tr><td>eliminar.php</td><td>Elimina un registro por ID</td></tr>
    </table>
    <h3>16.1 Ruta de los Módulos</h3>
    <div class="code">
localhost/Promart/mantenimientos/[modulo]/listar.php<br>
localhost/Promart/mantenimientos/[modulo]/registrar.php<br>
localhost/Promart/mantenimientos/[modulo]/editar.php?id=X<br>
localhost/Promart/mantenimientos/[modulo]/eliminar.php?id=X
    </div>
  </div>

  <!-- REPORTES -->
  <div class="seccion" id="reportes">
    <h2>17. Configuración de Reportes</h2>
    <p>El sistema genera reportes en PDF usando FPDF y en Excel usando HTML con headers especiales.</p>
    <h3>17.1 Reportes Disponibles</h3>
    <table>
      <tr><th>Reporte</th><th>Archivo PDF</th><th>Archivo Excel</th></tr>
      <tr><td>Ventas</td><td>reportes/pdf_ventas.php</td><td>reportes/excel_ventas.php</td></tr>
      <tr><td>Clientes</td><td>reportes/pdf_clientes.php</td><td>reportes/excel_clientes.php</td></tr>
      <tr><td>Productos</td><td>reportes/pdf_productos.php</td><td>reportes/excel_productos.php</td></tr>
      <tr><td>Compras</td><td>reportes/pdf_compras.php</td><td>reportes/excel_compras.php</td></tr>
      <tr><td>Empleados</td><td>reportes/pdf_empleados.php</td><td>reportes/excel_empleados.php</td></tr>
      <tr><td>Usuarios</td><td>reportes/pdf_usuarios.php</td><td>reportes/excel_usuarios.php</td></tr>
    </table>
  </div>

  <!-- FPDF -->
  <div class="seccion" id="fpdf">
    <h2>18. Librería FPDF</h2>
    <p>FPDF es una librería PHP gratuita para generar documentos PDF. El sistema la usa para todos los reportes en PDF.</p>
    <h3>18.1 Ubicación</h3>
    <div class="code">Promart/fpdf/fpdf.php</div>
    <h3>18.2 Cómo se Usa</h3>
    <div class="code">
require('../fpdf/fpdf.php');<br>
$pdf = new FPDF();<br>
$pdf->AddPage();<br>
$pdf->SetFont('Arial','B',16);<br>
$pdf->Cell(0,10,'Título del Reporte',0,1,'C');<br>
$pdf->Output('I','reporte.pdf'); // 'I' = mostrar en navegador
    </div>
    <h3>18.3 Modos de Salida</h3>
    <table>
      <tr><th>Modo</th><th>Descripción</th></tr>
      <tr><td>'I'</td><td>Mostrar en el navegador</td></tr>
      <tr><td>'D'</td><td>Descargar el archivo</td></tr>
      <tr><td>'F'</td><td>Guardar en el servidor</td></tr>
      <tr><td>'S'</td><td>Retornar como string</td></tr>
    </table>
    <div class="nota"><p>📌 Descargue FPDF desde: http://www.fpdf.org</p></div>
  </div>

  <!-- SERVIDOR -->
  <div class="seccion" id="servidor">
    <h2>19. Configuración del Servidor</h2>
    <h3>19.1 Configuración de Apache (httpd.conf)</h3>
    <div class="code">
DocumentRoot "C:/xampp/htdocs"<br>
&lt;Directory "C:/xampp/htdocs"&gt;<br>
&nbsp;&nbsp;Options Indexes FollowSymLinks<br>
&nbsp;&nbsp;AllowOverride All<br>
&nbsp;&nbsp;Require all granted<br>
&lt;/Directory&gt;
    </div>
    <h3>19.2 Configuración PHP (php.ini)</h3>
    <table>
      <tr><th>Parámetro</th><th>Valor Recomendado</th><th>Descripción</th></tr>
      <tr><td>max_execution_time</td><td>300</td><td>Tiempo máximo de ejecución en segundos</td></tr>
      <tr><td>memory_limit</td><td>256M</td><td>Memoria máxima para PHP</td></tr>
      <tr><td>upload_max_filesize</td><td>20M</td><td>Tamaño máximo de archivo subido</td></tr>
      <tr><td>display_errors</td><td>Off (producción)</td><td>Mostrar errores en pantalla</td></tr>
    </table>
  </div>

  <!-- ERRORES -->
  <div class="seccion" id="errores">
    <h2>20. Errores Técnicos y Soluciones</h2>
    <table>
      <tr><th>Error</th><th>Causa</th><th>Solución</th></tr>
      <tr><td>Call to undefined method mysqli_stmt::get_result()</td><td>PHP sin extensión mysqlnd</td><td>Habilitar mysqlnd en php.ini</td></tr>
      <tr><td>Class FPDF not found</td><td>fpdf.php no encontrado</td><td>Verificar ruta en require()</td></tr>
      <tr><td>Access denied for user root</td><td>Contraseña MySQL incorrecta</td><td>Actualizar config/conexion.php</td></tr>
      <tr><td>Headers already sent</td><td>Código antes de header()</td><td>No poner echo antes de header()</td></tr>
      <tr><td>Table doesn't exist</td><td>Tabla no creada en BD</td><td>Importar el script SQL completo</td></tr>
      <tr><td>Session expired</td><td>Sesión cerrada</td><td>Volver a iniciar sesión</td></tr>
    </table>
    <h3>20.1 Activar Log de Errores PHP</h3>
    <div class="code">
// En php.ini:<br>
error_log = "C:/xampp/php/logs/php_error.log"<br>
log_errors = On<br>
display_errors = Off
    </div>
  </div>

  <!-- OPTIMIZACION -->
  <div class="seccion" id="optimizacion">
    <h2>21. Optimización del Sistema</h2>
    <h3>21.1 Optimización de Consultas MySQL</h3>
    <ul>
      <li>Agregar índices a columnas frecuentemente consultadas.</li>
      <li>Usar SELECT con columnas específicas en vez de SELECT *.</li>
      <li>Limitar resultados con LIMIT en consultas de listado.</li>
    </ul>
    <h3>21.2 Optimización de PHP</h3>
    <ul>
      <li>Cerrar conexiones de base de datos al final de cada script.</li>
      <li>Usar include_once en lugar de include para evitar duplicados.</li>
      <li>Activar OPcache en php.ini para mejorar rendimiento.</li>
    </ul>
    <h3>21.3 Agregar Índice en MySQL</h3>
    <div class="code">
ALTER TABLE venta ADD INDEX idx_fecha (fecha);<br>
ALTER TABLE producto ADD INDEX idx_categoria (categoria);
    </div>
  </div>

  <!-- GLOSARIO -->
  <div class="seccion" id="glosario">
    <h2>22. Glosario Técnico</h2>
    <table>
      <tr><th>Término</th><th>Definición</th></tr>
      <tr><td>Apache</td><td>Servidor web que procesa las peticiones HTTP</td></tr>
      <tr><td>CRUD</td><td>Create, Read, Update, Delete — operaciones básicas de BD</td></tr>
      <tr><td>FK (Foreign Key)</td><td>Llave foránea que relaciona dos tablas</td></tr>
      <tr><td>FPDF</td><td>Librería PHP para generación de archivos PDF</td></tr>
      <tr><td>httpd.conf</td><td>Archivo de configuración principal de Apache</td></tr>
      <tr><td>mysqli</td><td>Extensión PHP para conectar con MySQL mejorado</td></tr>
      <tr><td>OPcache</td><td>Sistema de caché para acelerar la ejecución de PHP</td></tr>
      <tr><td>PDO</td><td>PHP Data Objects — alternativa a mysqli para BD</td></tr>
      <tr><td>PK (Primary Key)</td><td>Llave primaria que identifica únicamente cada registro</td></tr>
      <tr><td>php.ini</td><td>Archivo de configuración principal de PHP</td></tr>
      <tr><td>Session</td><td>Mecanismo PHP para mantener datos entre páginas</td></tr>
      <tr><td>SQL Injection</td><td>Ataque que inserta código SQL malicioso</td></tr>
      <tr><td>XAMPP</td><td>Paquete que incluye Apache, MySQL, PHP y Perl</td></tr>
      <tr><td>XSS</td><td>Cross-Site Scripting — ataque de inyección de scripts</td></tr>
    </table>
    <div class="nota"><p>📌 Fin del Manual de Administrador — Sistema Promart v1.0 — 2026</p></div>
  </div>

</div>

<script>
const sections = document.querySelectorAll('.seccion, .portada');
const menuItems = document.querySelectorAll('.menu-item');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(s => { if(window.scrollY >= s.offsetTop - 100) current = s.id; });
  menuItems.forEach(item => {
    item.classList.remove('active');
    if(item.getAttribute('href') === '#' + current) item.classList.add('active');
  });
});
menuItems.forEach(item => {
  item.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(item.getAttribute('href'));
    if(target) target.scrollIntoView({ behavior: 'smooth' });
  });
});
</script>
</body>
</html>