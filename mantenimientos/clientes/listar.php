<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$resultado = mysqli_query($conn, "SELECT * FROM cliente ORDER BY nombre");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista Clientes</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:white; font-family:Arial; min-height:100vh; padding:30px 20px; }
.topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
h1 { font-size:26px; font-weight:bold; letter-spacing:1px; }
.acciones-top { display:flex; gap:10px; }
.btn-nuevo { padding:10px 22px; background:#e07b20; border:none; border-radius:8px; color:white; font-size:15px; font-weight:bold; cursor:pointer; text-decoration:none; transition:0.2s; }
.btn-nuevo:hover { background:#c96a10; }
.btn-volver { padding:10px 22px; background:transparent; border:2px solid rgba(255,255,255,0.4); border-radius:8px; color:white; font-size:15px; text-decoration:none; transition:0.2s; }
.btn-volver:hover { border-color:white; }

/* BUSCADOR AJAX */
.search-wrap { position:relative; margin-bottom:20px; }
#search-input {
    width:100%; padding:12px 20px 12px 44px;
    background:#1a2a3a; border:1px solid rgba(255,255,255,0.15);
    border-radius:10px; color:white; font-size:15px; outline:none;
    transition:0.2s;
}
#search-input:focus { border-color:#e07b20; }
#search-input::placeholder { color:#a0bcd8; }
.search-icon { position:absolute; left:16px; top:50%; transform:translateY(-50%); font-size:16px; }
.search-info { font-size:13px; color:#a0bcd8; margin-bottom:12px; min-height:20px; }
.spinner { display:none; position:absolute; right:16px; top:50%; transform:translateY(-50%); width:18px; height:18px; border:2px solid rgba(255,255,255,0.2); border-top-color:#e07b20; border-radius:50%; animation:spin 0.6s linear infinite; }
@keyframes spin { to { transform:translateY(-50%) rotate(360deg); } }

table { width:100%; border-collapse:collapse; background:#1a2a3a; border-radius:12px; overflow:hidden; }
th { background:#1e3a5f; padding:14px 16px; text-align:center; font-size:13px; letter-spacing:1px; color:#a0bcd8; }
td { padding:13px 16px; text-align:center; font-size:14px; border-bottom:1px solid rgba(255,255,255,0.07); }
tr:last-child td { border-bottom:none; }
tr:hover td { background:rgba(255,255,255,0.04); }
.avatar { width:32px; height:32px; border-radius:50%; background:#1e3a5f; color:#5dade2; font-weight:bold; font-size:13px; display:inline-flex; align-items:center; justify-content:center; margin-right:8px; vertical-align:middle; }
.dni { font-size:12px; color:#a0bcd8; }
.btn-editar { color:#5dade2; text-decoration:none; font-size:13px; }
.btn-editar:hover { color:#85c1e9; }
.btn-eliminar { color:#e74c3c; text-decoration:none; font-size:13px; }
.btn-eliminar:hover { color:#f1948a; }
.sep { color:#444; margin:0 6px; }
.no-resultados { text-align:center; padding:40px; color:#a0bcd8; font-size:15px; }
</style>
</head>
<body>
<div class="topbar">
  <h1>LISTA DE CLIENTES</h1>
  <div class="acciones-top">
    <a href="../../menu.php" class="btn-volver">← Volver al Menú</a>
    <a href="registrar.php" class="btn-nuevo">+ Nuevo Cliente</a>
  </div>
</div>

<!-- BUSCADOR AJAX -->
<div class="search-wrap">
  <span class="search-icon">🔍</span>
  <input type="text" id="search-input" placeholder="Buscar por nombre, apellido, DNI o correo...">
  <div class="spinner" id="spinner"></div>
</div>
<div class="search-info" id="search-info">Mostrando todos los clientes</div>

<table id="tabla-clientes">
  <thead>
    <tr>
      <th>ID</th><th>NOMBRE</th><th>APELLIDO</th><th>CORREO</th><th>DNI</th><th>ACCIONES</th>
    </tr>
  </thead>
  <tbody id="tbody-clientes">
    <?php while($fila = mysqli_fetch_array($resultado)): ?>
    <tr>
      <td><?= $fila['idCliente'] ?></td>
      <td>
        <span class="avatar"><?= strtoupper(substr($fila['nombre'],0,1)) ?></span>
        <?= htmlspecialchars($fila['nombre']) ?>
      </td>
      <td><?= htmlspecialchars($fila['apellido']) ?></td>
      <td><?= htmlspecialchars($fila['correo']) ?></td>
      <td><span class="dni"><?= htmlspecialchars($fila['dni']) ?></span></td>
      <td>
        <a href="editar.php?id=<?= $fila['idCliente'] ?>" class="btn-editar">Editar</a>
        <span class="sep">|</span>
        <a href="eliminar.php?id=<?= $fila['idCliente'] ?>" class="btn-eliminar"
           onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<script>
let timeout = null;

document.getElementById('search-input').addEventListener('keyup', function(){
    const q = this.value.trim();
    clearTimeout(timeout);

    // Si está vacío muestra todos
    if(q === ''){
        location.reload();
        return;
    }

    document.getElementById('spinner').style.display = 'block';

    timeout = setTimeout(() => {
        fetch(`buscar_clientes.php?q=${encodeURIComponent(q)}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('spinner').style.display = 'none';
            const tbody = document.getElementById('tbody-clientes');
            const info  = document.getElementById('search-info');

            if(data.length === 0){
                tbody.innerHTML = `<tr><td colspan="6" class="no-resultados">😕 No se encontraron clientes con "${q}"</td></tr>`;
                info.textContent = 'Sin resultados';
                return;
            }

            info.textContent = `Mostrando ${data.length} resultado(s) para "${q}"`;

            tbody.innerHTML = data.map(c => `
                <tr>
                    <td>${c.idCliente}</td>
                    <td>
                        <span class="avatar">${c.nombre.charAt(0).toUpperCase()}</span>
                        ${c.nombre}
                    </td>
                    <td>${c.apellido}</td>
                    <td>${c.correo}</td>
                    <td><span class="dni">${c.dni}</span></td>
                    <td>
                        <a href="editar.php?id=${c.idCliente}" class="btn-editar">Editar</a>
                        <span class="sep">|</span>
                        <a href="eliminar.php?id=${c.idCliente}" class="btn-eliminar"
                           onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
                    </td>
                </tr>
            `).join('');
        })
        .catch(() => {
            document.getElementById('spinner').style.display = 'none';
        });
    }, 300); // espera 300ms después de dejar de escribir
});
</script>
</body>
</html>