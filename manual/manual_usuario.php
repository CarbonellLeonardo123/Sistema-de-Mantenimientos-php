<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manual de Usuario - Promart</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:#cdd6e0; font-family:Arial, sans-serif; display:flex; }

/* SIDEBAR */
.sidebar {
    width:280px; min-height:100vh; background:#0a1525;
    border-right:1px solid rgba(255,255,255,0.08);
    position:fixed; top:0; left:0; overflow-y:auto;
    padding-bottom:30px;
}
.sidebar-header {
    background:#1e3a5f; padding:20px;
    border-bottom:1px solid rgba(255,255,255,0.1);
}
.sidebar-header h2 { font-size:14px; color:white; letter-spacing:1px; }
.sidebar-header p { font-size:11px; color:#a0bcd8; margin-top:4px; }
.sidebar-menu { padding:10px 0; }
.menu-section { padding:14px 20px 6px; font-size:11px; letter-spacing:2px; color:#5d7a9a; }
.menu-item { display:block; padding:10px 20px; color:#a0bcd8; text-decoration:none; font-size:13px; border-left:3px solid transparent; transition:0.2s; }
.menu-item:hover { background:rgba(255,255,255,0.05); color:white; border-left-color:#e07b20; }
.menu-item.active { background:rgba(224,123,32,0.1); color:#f0a050; border-left-color:#e07b20; }

/* MAIN */
.main { margin-left:280px; flex:1; padding:40px; max-width:900px; }
.topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:40px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,0.1); }
.topbar h1 { font-size:22px; color:white; }
.btn-volver { padding:10px 20px; background:transparent; border:2px solid rgba(255,255,255,0.3); border-radius:8px; color:white; text-decoration:none; font-size:13px; transition:0.2s; }
.btn-volver:hover { border-color:white; }

/* SECCIONES */
.seccion { margin-bottom:60px; padding-top:20px; }
.seccion h2 { font-size:22px; color:white; margin-bottom:6px; padding-bottom:10px; border-bottom:2px solid #e07b20; }
.seccion h3 { font-size:17px; color:#5dade2; margin:24px 0 10px; }
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
.paso { background:#1a2a3a; border-radius:10px; padding:16px 20px; margin:10px 0; display:flex; gap:14px; align-items:flex-start; }
.paso-num { background:#e07b20; color:white; width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:13px; flex-shrink:0; }
.paso-text { font-size:14px; color:#b0c4d8; line-height:1.7; }
table { width:100%; border-collapse:collapse; margin:16px 0; }
th { background:#1e3a5f; padding:12px; text-align:left; font-size:13px; color:#a0bcd8; }
td { padding:11px 12px; font-size:13px; color:#b0c4d8; border-bottom:1px solid rgba(255,255,255,0.06); }
tr:hover td { background:rgba(255,255,255,0.03); }
.badge { padding:3px 10px; border-radius:12px; font-size:12px; font-weight:bold; }
.badge-admin { background:rgba(224,123,32,0.2); color:#f0a050; }
.badge-empleado { background:rgba(46,204,113,0.2); color:#2ecc71; }
.badge-supervisor { background:rgba(52,152,219,0.2); color:#5dade2; }
.portada { text-align:center; padding:60px 0 80px; border-bottom:2px solid rgba(255,255,255,0.1); margin-bottom:60px; }
.portada h1 { font-size:38px; color:white; letter-spacing:3px; margin-bottom:10px; }
.portada h2 { font-size:20px; color:#e07b20; margin-bottom:30px; }
.portada p { font-size:14px; color:#a0bcd8; margin-bottom:6px; }
.version { display:inline-block; background:#1e3a5f; padding:8px 24px; border-radius:20px; font-size:13px; color:#5dade2; margin-top:20px; }
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="sidebar-header">
    <h2>📘 MANUAL DE USUARIO</h2>
    <p>Sistema Promart v1.0</p>
  </div>
  <div class="sidebar-menu">
    <div class="menu-section">INTRODUCCIÓN</div>
    <a href="#portada" class="menu-item">Portada</a>
    <a href="#introduccion" class="menu-item">Introducción</a>
    <a href="#objetivos" class="menu-item">Objetivos</a>
    <a href="#requisitos" class="menu-item">Requisitos del Sistema</a>
    <div class="menu-section">ACCESO AL SISTEMA</div>
    <a href="#login" class="menu-item">Inicio de Sesión</a>
    <a href="#menu" class="menu-item">Menú Principal</a>
    <a href="#sistema" class="menu-item">Panel del Sistema</a>
    <div class="menu-section">MÓDULOS</div>
    <a href="#usuarios" class="menu-item">Gestión de Usuarios</a>
    <a href="#clientes" class="menu-item">Gestión de Clientes</a>
    <a href="#empleados" class="menu-item">Gestión de Empleados</a>
    <a href="#proveedores" class="menu-item">Gestión de Proveedores</a>
    <a href="#productos" class="menu-item">Gestión de Productos</a>
    <a href="#categorias" class="menu-item">Gestión de Categorías</a>
    <a href="#marcas" class="menu-item">Gestión de Marcas</a>
    <a href="#almacen" class="menu-item">Gestión de Almacén</a>
    <a href="#ventas" class="menu-item">Gestión de Ventas</a>
    <a href="#compras" class="menu-item">Gestión de Compras</a>
    <a href="#pedidos" class="menu-item">Gestión de Pedidos</a>
    <a href="#pagos" class="menu-item">Gestión de Pagos</a>
    <a href="#detalleventa" class="menu-item">Detalle de Venta</a>
    <a href="#detallecompra" class="menu-item">Detalle de Compra</a>
    <a href="#reportes" class="menu-item">Reportes</a>
    <div class="menu-section">OTROS</div>
    <a href="#errores" class="menu-item">Errores Comunes</a>
    <a href="#preguntas" class="menu-item">Preguntas Frecuentes</a>
    <a href="#glosario" class="menu-item">Glosario</a>
  </div>
</div>

<!-- CONTENIDO -->
<div class="main">
  <div class="topbar">
    <h1>Manual de Usuario</h1>
    <a href="../menu.php" class="btn-volver">← Volver al Menú</a>
  </div>

  <!-- PORTADA -->
  <div class="portada" id="portada">
    <h1>PROMART</h1>
    <h2>Sistema de Gestión Empresarial</h2>
    <p>Manual de Usuario</p>
    <p>Versión 1.0 — 2026</p>
    <p>Desarrollado con PHP, HTML, CSS, JavaScript y MySQL</p>
    <span class="version">v1.0 — Mayo 2026</span>
  </div>

  <!-- INTRODUCCIÓN -->
  <div class="seccion" id="introduccion">
    <h2>1. Introducción</h2>
    <p>El Sistema de Gestión Empresarial Promart es una aplicación web desarrollada para facilitar la administración y control de los procesos internos de la empresa Promart. Este sistema permite gestionar de forma eficiente los módulos de ventas, compras, inventario, clientes, empleados y más.</p>
    <p>Este manual está dirigido a los usuarios finales del sistema, es decir, a todas las personas que utilizarán el sistema en su día a día para realizar operaciones como registrar ventas, consultar productos, gestionar clientes y generar reportes.</p>
    <p>El sistema ha sido desarrollado utilizando tecnologías modernas como PHP para el backend, HTML y CSS para la interfaz visual, JavaScript para la interactividad, y MySQL como motor de base de datos. Todo esto garantiza un sistema robusto, seguro y fácil de usar.</p>
    <p>A lo largo de este manual encontrará instrucciones detalladas paso a paso para utilizar cada uno de los 15 módulos del sistema, así como soluciones a los errores más comunes y respuestas a las preguntas frecuentes.</p>
    <div class="nota"><p>📌 Este manual debe ser leído antes de comenzar a utilizar el sistema por primera vez.</p></div>
  </div>

  <!-- OBJETIVOS -->
  <div class="seccion" id="objetivos">
    <h2>2. Objetivos del Manual</h2>
    <h3>2.1 Objetivo General</h3>
    <p>Proporcionar al usuario final una guía completa y detallada para el correcto uso del Sistema de Gestión Empresarial Promart, permitiendo aprovechar al máximo todas sus funcionalidades.</p>
    <h3>2.2 Objetivos Específicos</h3>
    <ul>
      <li>Explicar el proceso de acceso al sistema mediante el login de usuario.</li>
      <li>Describir la navegación por el menú principal y el panel del sistema.</li>
      <li>Guiar al usuario en el uso de cada uno de los 15 módulos del sistema.</li>
      <li>Enseñar cómo generar reportes en formato PDF y Excel.</li>
      <li>Proporcionar soluciones a los errores más comunes del sistema.</li>
      <li>Definir los términos técnicos utilizados en el sistema.</li>
    </ul>
    <h3>2.3 Alcance</h3>
    <p>Este manual cubre todas las funcionalidades disponibles para el usuario con rol de Empleado y Supervisor. Las funcionalidades exclusivas del Administrador se describen en el Manual de Administrador.</p>
  </div>

  <!-- REQUISITOS -->
  <div class="seccion" id="requisitos">
    <h2>3. Requisitos del Sistema</h2>
    <h3>3.1 Requisitos de Hardware</h3>
    <table>
      <tr><th>Componente</th><th>Mínimo</th><th>Recomendado</th></tr>
      <tr><td>Procesador</td><td>Intel Core i3</td><td>Intel Core i5 o superior</td></tr>
      <tr><td>Memoria RAM</td><td>2 GB</td><td>4 GB o más</td></tr>
      <tr><td>Espacio en disco</td><td>500 MB</td><td>1 GB o más</td></tr>
      <tr><td>Conexión a red</td><td>Red local</td><td>Red local o Internet</td></tr>
    </table>
    <h3>3.2 Requisitos de Software</h3>
    <table>
      <tr><th>Software</th><th>Versión</th><th>Descripción</th></tr>
      <tr><td>Navegador Web</td><td>Cualquier versión moderna</td><td>Chrome, Firefox, Edge</td></tr>
      <tr><td>XAMPP</td><td>8.x o superior</td><td>Servidor local Apache + PHP + MySQL</td></tr>
      <tr><td>PHP</td><td>8.2 o superior</td><td>Lenguaje de programación del servidor</td></tr>
      <tr><td>MySQL</td><td>5.7 o superior</td><td>Motor de base de datos</td></tr>
    </table>
    <h3>3.3 Acceso al Sistema</h3>
    <p>Para acceder al sistema se debe abrir el navegador web e ingresar la siguiente dirección:</p>
    <div class="nota"><p>🌐 URL: <strong>http://localhost/Promart/</strong></p></div>
  </div>

  <!-- LOGIN -->
  <div class="seccion" id="login">
    <h2>4. Inicio de Sesión</h2>
    <p>El inicio de sesión es la puerta de entrada al sistema. Para acceder debe contar con un usuario y contraseña proporcionados por el administrador del sistema.</p>
    <h3>4.1 Pasos para Iniciar Sesión</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Abra su navegador web (Chrome, Firefox o Edge) e ingrese la URL: <strong>http://localhost/Promart/</strong></div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Se mostrará la pantalla de inicio de sesión con el logo de Promart y dos campos de texto.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Ingrese su <strong>nombre de usuario</strong> en el primer campo.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Ingrese su <strong>contraseña</strong> en el segundo campo. La contraseña se mostrará como puntos por seguridad.</div></div>
    <div class="paso"><div class="paso-num">5</div><div class="paso-text">Haga clic en el botón verde <strong>"INGRESAR"</strong>.</div></div>
    <div class="paso"><div class="paso-num">6</div><div class="paso-text">Si los datos son correctos, será redirigido al <strong>Menú Principal</strong> del sistema.</div></div>
    <h3>4.2 Errores en el Login</h3>
    <div class="advertencia"><p>⚠️ Si aparece el mensaje "Usuario o clave incorrecta", verifique que el usuario y contraseña sean correctos. Las contraseñas distinguen mayúsculas de minúsculas.</p></div>
    <h3>4.3 Cerrar Sesión</h3>
    <p>Para cerrar sesión de forma segura, haga clic en el botón <strong>"Salir"</strong> que se encuentra en la parte inferior del menú principal. Esto destruirá su sesión y le redirigirá a la pantalla de login.</p>
    <div class="tip"><p>✅ Siempre cierre sesión cuando termine de usar el sistema, especialmente en computadoras compartidas.</p></div>
  </div>

  <!-- MENU -->
  <div class="seccion" id="menu">
    <h2>5. Menú Principal</h2>
    <p>El menú principal es la pantalla central desde donde puede acceder a todos los módulos del sistema. Se muestra inmediatamente después de iniciar sesión correctamente.</p>
    <h3>5.1 Descripción del Menú</h3>
    <p>El menú principal presenta una interfaz visual con tarjetas (cards) para cada módulo. En la parte superior izquierda se muestra el logo de Promart y en la parte superior derecha aparece el nombre del usuario que ha iniciado sesión junto con su inicial.</p>
    <h3>5.2 Módulos Disponibles</h3>
    <table>
      <tr><th>Módulo</th><th>Descripción</th></tr>
      <tr><td>Usuarios</td><td>Gestión de usuarios del sistema</td></tr>
      <tr><td>Proveedor</td><td>Gestión de proveedores</td></tr>
      <tr><td>Productos</td><td>Gestión del catálogo de productos</td></tr>
      <tr><td>Ventas</td><td>Registro y consulta de ventas</td></tr>
      <tr><td>Clientes</td><td>Gestión de clientes</td></tr>
      <tr><td>Sistema</td><td>Panel con todos los módulos</td></tr>
      <tr><td>Manual</td><td>Manual de usuario del sistema</td></tr>
      <tr><td>Reportes</td><td>Generación de reportes PDF y Excel</td></tr>
    </table>
    <h3>5.3 Navegación</h3>
    <p>Para acceder a cualquier módulo simplemente haga clic sobre la tarjeta correspondiente. Al pasar el mouse sobre cada tarjeta verá un efecto visual de resalte indicando que es clickeable.</p>
  </div>

  <!-- SISTEMA -->
  <div class="seccion" id="sistema">
    <h2>6. Panel del Sistema</h2>
    <p>El Panel del Sistema es una vista centralizada que muestra los 15 módulos organizados por categorías. Es la forma más rápida de navegar entre todos los módulos del sistema.</p>
    <h3>6.1 Categorías del Panel</h3>
    <ul>
      <li><strong>Mantenimientos:</strong> Usuarios, Clientes, Empleados, Proveedores, Productos</li>
      <li><strong>Catálogos:</strong> Categorías, Marcas, Almacén</li>
      <li><strong>Operaciones:</strong> Ventas, Compras, Pedidos, Pagos</li>
      <li><strong>Detalle y Reportes:</strong> Detalle Venta, Detalle Compra, Reportes</li>
    </ul>
  </div>

  <!-- USUARIOS -->
  <div class="seccion" id="usuarios">
    <h2>7. Gestión de Usuarios</h2>
    <p>El módulo de usuarios permite administrar las cuentas de acceso al sistema. Cada usuario tiene un nombre de usuario, contraseña y un rol asignado que determina sus permisos.</p>
    <h3>7.1 Roles del Sistema</h3>
    <table>
      <tr><th>Rol</th><th>Descripción</th><th>Permisos</th></tr>
      <tr><td><span class="badge badge-admin">Administrador</span></td><td>Control total del sistema</td><td>Acceso a todos los módulos</td></tr>
      <tr><td><span class="badge badge-supervisor">Supervisor</span></td><td>Supervisión de operaciones</td><td>Consulta y reportes</td></tr>
      <tr><td><span class="badge badge-empleado">Empleado</span></td><td>Operaciones básicas</td><td>Registro de ventas y consultas</td></tr>
    </table>
    <h3>7.2 Listar Usuarios</h3>
    <p>Al ingresar al módulo verá una tabla con todos los usuarios registrados mostrando su ID, nombre de usuario y rol. Las contraseñas se muestran ocultas por seguridad.</p>
    <h3>7.3 Registrar Nuevo Usuario</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Haga clic en el botón <strong>"+ Nuevo Usuario"</strong>.</div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Complete el campo <strong>Usuario</strong> con el nombre de acceso.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Ingrese la <strong>Contraseña</strong> del usuario.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Seleccione el <strong>Rol</strong> correspondiente.</div></div>
    <div class="paso"><div class="paso-num">5</div><div class="paso-text">Haga clic en <strong>"Guardar Usuario"</strong>.</div></div>
    <h3>7.4 Editar Usuario</h3>
    <p>Haga clic en <strong>"Editar"</strong> en la fila del usuario que desea modificar. Actualice los campos necesarios y haga clic en <strong>"Actualizar"</strong>.</p>
    <h3>7.5 Eliminar Usuario</h3>
    <p>Haga clic en <strong>"Eliminar"</strong> en la fila correspondiente. El sistema pedirá confirmación antes de eliminar el registro.</p>
    <div class="advertencia"><p>⚠️ No elimine su propio usuario ya que perderá acceso al sistema.</p></div>
  </div>

  <!-- CLIENTES -->
  <div class="seccion" id="clientes">
    <h2>8. Gestión de Clientes</h2>
    <p>El módulo de clientes permite registrar y administrar la información de todos los clientes de la empresa. Esta información es utilizada en el módulo de ventas.</p>
    <h3>8.1 Datos del Cliente</h3>
    <table>
      <tr><th>Campo</th><th>Descripción</th><th>Obligatorio</th></tr>
      <tr><td>Nombre</td><td>Primer nombre del cliente</td><td>Sí</td></tr>
      <tr><td>Apellido</td><td>Apellido del cliente</td><td>Sí</td></tr>
      <tr><td>Correo</td><td>Correo electrónico</td><td>Sí</td></tr>
      <tr><td>DNI</td><td>Documento de identidad (8 dígitos)</td><td>Sí</td></tr>
    </table>
    <h3>8.2 Registrar Cliente</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Ingrese al módulo <strong>Clientes</strong> desde el menú.</div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Haga clic en <strong>"+ Nuevo Cliente"</strong>.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Complete todos los campos del formulario.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Haga clic en <strong>"Guardar Cliente"</strong>.</div></div>
    <div class="tip"><p>✅ El DNI debe tener exactamente 8 dígitos numéricos.</p></div>
  </div>

  <!-- EMPLEADOS -->
  <div class="seccion" id="empleados">
    <h2>9. Gestión de Empleados</h2>
    <p>El módulo de empleados permite registrar el personal de la empresa con sus datos completos de contacto y cargo.</p>
    <h3>9.1 Datos del Empleado</h3>
    <table>
      <tr><th>Campo</th><th>Descripción</th></tr>
      <tr><td>Nombre</td><td>Nombre completo del empleado</td></tr>
      <tr><td>Cargo</td><td>Puesto que ocupa en la empresa</td></tr>
      <tr><td>Teléfono</td><td>Número de contacto</td></tr>
      <tr><td>Correo</td><td>Correo electrónico corporativo</td></tr>
    </table>
  </div>

  <!-- PROVEEDORES -->
  <div class="seccion" id="proveedores">
    <h2>10. Gestión de Proveedores</h2>
    <p>El módulo de proveedores permite registrar las empresas o personas que suministran productos a Promart.</p>
    <h3>10.1 Datos del Proveedor</h3>
    <table>
      <tr><th>Campo</th><th>Descripción</th></tr>
      <tr><td>Nombre</td><td>Nombre de la empresa proveedora</td></tr>
      <tr><td>Teléfono</td><td>Número de contacto del proveedor</td></tr>
      <tr><td>Dirección</td><td>Dirección física del proveedor</td></tr>
    </table>
  </div>

  <!-- PRODUCTOS -->
  <div class="seccion" id="productos">
    <h2>11. Gestión de Productos</h2>
    <p>El módulo de productos es uno de los más importantes del sistema. Permite administrar el catálogo completo de productos con su stock y precios.</p>
    <h3>11.1 Datos del Producto</h3>
    <table>
      <tr><th>Campo</th><th>Descripción</th></tr>
      <tr><td>Nombre</td><td>Nombre del producto</td></tr>
      <tr><td>Categoría</td><td>Categoría a la que pertenece</td></tr>
      <tr><td>Stock</td><td>Cantidad disponible en inventario</td></tr>
      <tr><td>Precio</td><td>Precio de venta en soles (S/.)</td></tr>
    </table>
    <h3>11.2 Indicadores de Stock</h3>
    <ul>
      <li>🟢 <strong>Verde:</strong> Stock mayor a 10 unidades — Disponible</li>
      <li>🟠 <strong>Naranja:</strong> Stock entre 1 y 10 — Stock Bajo</li>
      <li>🔴 <strong>Rojo:</strong> Stock en 0 — Agotado</li>
    </ul>
    <div class="nota"><p>📌 Cuando un producto aparece en rojo debe realizarse una compra para reabastecer el inventario.</p></div>
  </div>

  <!-- CATEGORIAS -->
  <div class="seccion" id="categorias">
    <h2>12. Gestión de Categorías</h2>
    <p>Las categorías permiten organizar los productos en grupos. Al registrar un producto se debe asignar una categoría existente.</p>
    <h3>12.1 Pasos para Registrar una Categoría</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Ingrese al módulo <strong>Categorías</strong>.</div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Haga clic en <strong>"+ Nueva Categoría"</strong>.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Ingrese el nombre de la categoría.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Haga clic en <strong>"Guardar Categoría"</strong>.</div></div>
    <div class="advertencia"><p>⚠️ No elimine una categoría que tenga productos asignados, ya que afectará el registro de esos productos.</p></div>
  </div>

  <!-- MARCAS -->
  <div class="seccion" id="marcas">
    <h2>13. Gestión de Marcas</h2>
    <p>El módulo de marcas permite registrar las marcas de los productos que maneja la empresa. Las marcas ayudan a identificar y filtrar productos.</p>
  </div>

  <!-- ALMACEN -->
  <div class="seccion" id="almacen">
    <h2>14. Gestión de Almacén</h2>
    <p>El módulo de almacén permite registrar los distintos almacenes o depósitos donde se guardan los productos de la empresa.</p>
    <h3>14.1 Datos del Almacén</h3>
    <table>
      <tr><th>Campo</th><th>Descripción</th></tr>
      <tr><td>Nombre</td><td>Nombre identificador del almacén</td></tr>
      <tr><td>Ubicación</td><td>Dirección o descripción de la ubicación</td></tr>
    </table>
  </div>

  <!-- VENTAS -->
  <div class="seccion" id="ventas">
    <h2>15. Gestión de Ventas</h2>
    <p>El módulo de ventas es el núcleo operativo del sistema. Permite registrar todas las transacciones de venta realizadas a los clientes.</p>
    <h3>15.1 Datos de la Venta</h3>
    <table>
      <tr><th>Campo</th><th>Descripción</th></tr>
      <tr><td>Cliente</td><td>Cliente al que se realiza la venta</td></tr>
      <tr><td>Fecha</td><td>Fecha de la venta</td></tr>
      <tr><td>Total</td><td>Monto total de la venta en S/.</td></tr>
    </table>
    <h3>15.2 Registrar una Venta</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Ingrese al módulo <strong>Ventas</strong>.</div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Haga clic en <strong>"+ Nueva Venta"</strong>.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Seleccione el <strong>cliente</strong> del listado desplegable.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">Ingrese o confirme la <strong>fecha</strong> de la venta.</div></div>
    <div class="paso"><div class="paso-num">5</div><div class="paso-text">Ingrese el <strong>total</strong> de la venta.</div></div>
    <div class="paso"><div class="paso-num">6</div><div class="paso-text">Haga clic en <strong>"Guardar Venta"</strong>.</div></div>
    <div class="tip"><p>✅ En la lista de ventas el nombre del cliente aparece directamente en lugar del ID para facilitar la lectura.</p></div>
  </div>

  <!-- COMPRAS -->
  <div class="seccion" id="compras">
    <h2>16. Gestión de Compras</h2>
    <p>El módulo de compras permite registrar las adquisiciones realizadas a los proveedores para reabastecer el inventario.</p>
    <h3>16.1 Datos de la Compra</h3>
    <table>
      <tr><th>Campo</th><th>Descripción</th></tr>
      <tr><td>Proveedor</td><td>Proveedor que suministra los productos</td></tr>
      <tr><td>Fecha</td><td>Fecha de la compra</td></tr>
      <tr><td>Total</td><td>Monto total de la compra en S/.</td></tr>
    </table>
  </div>

  <!-- PEDIDOS -->
  <div class="seccion" id="pedidos">
    <h2>17. Gestión de Pedidos</h2>
    <p>El módulo de pedidos permite registrar y hacer seguimiento de los pedidos realizados por los clientes.</p>
    <h3>17.1 Estados de un Pedido</h3>
    <ul>
      <li>🟡 <strong>Pendiente:</strong> El pedido ha sido registrado pero no entregado.</li>
      <li>🟢 <strong>Entregado:</strong> El pedido fue entregado al cliente.</li>
    </ul>
  </div>

  <!-- PAGOS -->
  <div class="seccion" id="pagos">
    <h2>18. Gestión de Pagos</h2>
    <p>El módulo de pagos registra las transacciones de pago recibidas por ventas realizadas.</p>
    <h3>18.1 Métodos de Pago</h3>
    <ul>
      <li>💵 <strong>Efectivo</strong></li>
      <li>📱 <strong>Yape</strong></li>
      <li>💳 <strong>Tarjeta</strong></li>
    </ul>
  </div>

  <!-- DETALLE VENTA -->
  <div class="seccion" id="detalleventa">
    <h2>19. Detalle de Venta</h2>
    <p>El módulo de detalle de venta registra los productos específicos incluidos en cada venta, con cantidad, precio unitario y subtotal.</p>
    <table>
      <tr><th>Campo</th><th>Descripción</th></tr>
      <tr><td>ID Venta</td><td>Venta a la que pertenece el detalle</td></tr>
      <tr><td>Producto</td><td>Producto vendido</td></tr>
      <tr><td>Cantidad</td><td>Unidades vendidas</td></tr>
      <tr><td>Precio</td><td>Precio unitario</td></tr>
      <tr><td>Subtotal</td><td>Precio × Cantidad</td></tr>
    </table>
  </div>

  <!-- DETALLE COMPRA -->
  <div class="seccion" id="detallecompra">
    <h2>20. Detalle de Compra</h2>
    <p>Similar al detalle de venta, este módulo registra los productos específicos de cada compra realizada a proveedores.</p>
  </div>

  <!-- REPORTES -->
  <div class="seccion" id="reportes">
    <h2>21. Reportes</h2>
    <p>El módulo de reportes permite generar documentos con información consolidada del sistema en dos formatos: PDF y Excel.</p>
    <h3>21.1 Reportes Disponibles</h3>
    <table>
      <tr><th>Reporte</th><th>Contenido</th><th>Formatos</th></tr>
      <tr><td>Ventas</td><td>Lista de ventas con cliente, fecha y total</td><td>PDF, Excel</td></tr>
      <tr><td>Clientes</td><td>Lista de clientes con datos de contacto</td><td>PDF, Excel</td></tr>
      <tr><td>Productos</td><td>Inventario con stock y precios</td><td>PDF, Excel</td></tr>
      <tr><td>Compras</td><td>Lista de compras con proveedor y total</td><td>PDF, Excel</td></tr>
      <tr><td>Empleados</td><td>Lista del personal con cargo y contacto</td><td>PDF, Excel</td></tr>
      <tr><td>Usuarios</td><td>Lista de usuarios y roles</td><td>PDF, Excel</td></tr>
    </table>
    <h3>21.2 Generar un Reporte PDF</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Ingrese al módulo <strong>Reportes</strong>.</div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">Ubique el reporte que desea generar.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Haga clic en el botón rojo <strong>"📄 PDF"</strong>.</div></div>
    <div class="paso"><div class="paso-num">4</div><div class="paso-text">El reporte se abrirá directamente en el navegador listo para imprimir.</div></div>
    <h3>21.3 Generar un Reporte Excel</h3>
    <div class="paso"><div class="paso-num">1</div><div class="paso-text">Haga clic en el botón verde <strong>"📊 Excel"</strong>.</div></div>
    <div class="paso"><div class="paso-num">2</div><div class="paso-text">El archivo se descargará automáticamente.</div></div>
    <div class="paso"><div class="paso-num">3</div><div class="paso-text">Ábralo con Microsoft Excel o cualquier programa compatible.</div></div>
  </div>

  <!-- ERRORES COMUNES -->
  <div class="seccion" id="errores">
    <h2>22. Errores Comunes y Soluciones</h2>
    <table>
      <tr><th>Error</th><th>Causa</th><th>Solución</th></tr>
      <tr><td>Página en blanco</td><td>XAMPP no está iniciado</td><td>Abra XAMPP y active Apache y MySQL</td></tr>
      <tr><td>Usuario o clave incorrecta</td><td>Datos de acceso incorrectos</td><td>Verifique usuario y contraseña</td></tr>
      <tr><td>Error 404</td><td>URL incorrecta</td><td>Verifique la dirección del navegador</td></tr>
      <tr><td>No se puede guardar</td><td>Campos vacíos</td><td>Complete todos los campos obligatorios</td></tr>
      <tr><td>PDF no abre</td><td>Carpeta fpdf mal ubicada</td><td>Verifique que fpdf esté en Promart/fpdf/</td></tr>
    </table>
  </div>

  <!-- PREGUNTAS FRECUENTES -->
  <div class="seccion" id="preguntas">
    <h2>23. Preguntas Frecuentes</h2>
    <h3>¿Cómo recupero mi contraseña?</h3>
    <p>Contacte al administrador del sistema para que restablezca su contraseña desde el módulo de usuarios.</p>
    <h3>¿Puedo usar el sistema desde otro equipo?</h3>
    <p>Sí, siempre que ambos equipos estén en la misma red local y el servidor XAMPP esté activo.</p>
    <h3>¿Se guardan los datos automáticamente?</h3>
    <p>Los datos se guardan en la base de datos al hacer clic en los botones "Guardar" o "Actualizar". No hay guardado automático.</p>
    <h3>¿Puedo eliminar un registro que ya tiene operaciones relacionadas?</h3>
    <p>No se recomienda. Por ejemplo, no elimine un cliente que tenga ventas registradas ya que puede causar inconsistencias en los datos.</p>
    <h3>¿Los reportes se actualizan en tiempo real?</h3>
    <p>Sí, cada vez que genera un reporte toma los datos más recientes de la base de datos.</p>
  </div>

  <!-- GLOSARIO -->
  <div class="seccion" id="glosario">
    <h2>24. Glosario de Términos</h2>
    <table>
      <tr><th>Término</th><th>Definición</th></tr>
      <tr><td>CRUD</td><td>Crear, Leer, Actualizar y Eliminar registros en una base de datos</td></tr>
      <tr><td>Sesión</td><td>Período de tiempo activo de un usuario en el sistema</td></tr>
      <tr><td>Stock</td><td>Cantidad de unidades disponibles de un producto</td></tr>
      <tr><td>Módulo</td><td>Sección del sistema dedicada a una función específica</td></tr>
      <tr><td>PDF</td><td>Formato de documento portátil, ideal para imprimir</td></tr>
      <tr><td>Excel</td><td>Formato de hoja de cálculo para analizar datos</td></tr>
      <tr><td>MySQL</td><td>Sistema gestor de base de datos utilizado por el sistema</td></tr>
      <tr><td>PHP</td><td>Lenguaje de programación del servidor web</td></tr>
      <tr><td>XAMPP</td><td>Paquete de software que incluye Apache, MySQL y PHP</td></tr>
      <tr><td>localhost</td><td>Dirección del servidor local en su computadora</td></tr>
      <tr><td>DNI</td><td>Documento Nacional de Identidad</td></tr>
      <tr><td>ROL</td><td>Nivel de acceso y permisos de un usuario en el sistema</td></tr>
    </table>
    <div class="nota"><p>📌 Fin del Manual de Usuario — Sistema Promart v1.0 — 2026</p></div>
  </div>

</div>

<script>
// Highlight active menu item on scroll
const sections = document.querySelectorAll('.seccion, .portada');
const menuItems = document.querySelectorAll('.menu-item');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(s => {
    if(window.scrollY >= s.offsetTop - 100) current = s.id;
  });
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