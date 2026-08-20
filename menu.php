<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Promart</title>
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body {
    font-family: Arial, sans-serif;
    min-height: 100vh;
    background-image: url('img/fondo.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }
  .capa {
    background: rgba(0,0,0,0.65);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 40px;
  }
  .header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 40px;
    border-bottom: 1px solid rgba(255,255,255,0.15);
  }
  .header-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
    font-size: 22px;
    font-weight: bold;
    letter-spacing: 2px;
  }
  .header-brand svg { width:28px; height:28px; stroke:white; fill:none; stroke-width:2; }
  .header-user {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,0.85);
    font-size: 15px;
  }
  .avatar {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #e07b20;
    display: flex; align-items: center; justify-content: center;
    color: white; font-weight: bold; font-size: 15px;
  }
  h1 {
    color: white;
    font-size: 42px;
    font-style: italic;
    text-align: center;
    margin-top: 36px;
    margin-bottom: 16px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.4);
  }
  /* BUSCADOR */
  .buscador-wrap {
    width: 90%;
    max-width: 400px;
    margin-bottom: 30px;
    position: relative;
  }
  #buscador {
    width: 100%;
    padding: 12px 20px 12px 44px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 30px;
    color: white;
    font-size: 14px;
    outline: none;
    transition: 0.2s;
  }
  #buscador::placeholder { color: rgba(255,255,255,0.5); }
  #buscador:focus { background: rgba(255,255,255,0.15); border-color:rgba(255,255,255,0.4); }
  .buscador-icon {
    position: absolute;
    left: 16px; top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.5);
    font-size: 16px;
  }
  /* GRID */
.contenedor {
    width: 90%;
    max-width: 1100px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 24px;
  }
  .card {
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    padding: 28px 16px 20px;
    text-align: center;
    transition: transform 0.2s, background 0.2s;
    cursor: pointer;
  }
  .card:hover {
    background: rgba(255,255,255,0.18);
    transform: translateY(-4px);
  }
  .card-icon {
    width: 64px; height: 64px;
    margin: 0 auto 16px;
    background: rgba(224,123,32,0.25);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
  }
  .card-icon svg { width:32px; height:32px; stroke:#f0a050; fill:none; stroke-width:1.8; }
  .card a { text-decoration: none; }
  .card button {
    width: 100%;
    padding: 11px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    background: rgba(255,255,255,0.9);
    color: #1a3060;
    cursor: pointer;
    transition: 0.2s;
  }
  .card button:hover { background: #e07b20; color: white; transform: scale(1.03); }
  .card-label { color: white; font-size: 13px; margin-top: 6px; }
  .salir-wrap { margin-top: 30px; }
  .salir-wrap a { text-decoration: none; }
  .btn-salir {
    padding: 12px 48px;
    border: 2px solid rgba(255,255,255,0.6);
    border-radius: 30px;
    background: transparent;
    color: white;
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 1px;
    cursor: pointer;
    transition: 0.2s;
  }
  .btn-salir:hover { background: #e74c3c; border-color: #e74c3c; }
  .no-resultados { color: rgba(255,255,255,0.5); text-align:center; font-size:15px; margin-top:20px; display:none; }
  .no-resultados { color: rgba(255,255,255,0.5); text-align:center; font-size:15px; margin-top:20px; display:none; }

  @media (max-width: 600px) {
    h1 { font-size: 26px; }
    .header { padding: 14px 20px; }
    .header-brand { font-size: 16px; }
    .contenedor { gap: 14px; }
    #buscador { font-size: 13px; }
    #reloj { display: none; }
    .avatar { width: 30px; height: 30px; font-size: 13px; }
  }
</style>
</head>
<body>
<div class="capa">

  <!-- HEADER -->
  <div class="header">
    <div class="header-brand">
      <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      PROMART
    </div>
    <div class="header-user">
      <div class="avatar"><?= strtoupper(substr($_SESSION['usuario'],0,1)) ?></div>
      <?= htmlspecialchars($_SESSION['usuario']) ?>
      <span id="reloj" style="font-size:12px; color:#a0bcd8; margin-left:15px;"></span>
    </div>
  </div>

  <h1>Bienvenido a Promart</h1>

  <!-- BUSCADOR -->
  <div class="buscador-wrap">
    <span class="buscador-icon">🔍</span>
    <input type="text" id="buscador" placeholder="Buscar módulo...">
  </div>

  <div class="contenedor" id="grid-cards">

    <!-- USUARIOS -->
    <div class="card" data-nombre="usuarios">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <a href="mantenimientos/usuarios/listar.php"><button>Usuarios</button></a>
    </div>

    <!-- PROVEEDORES -->
    <div class="card" data-nombre="proveedor proveedores">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      </div>
      <a href="mantenimientos/proveedores/listar.php"><button>Proveedor</button></a>
    </div>

    <!-- PRODUCTOS -->
    <div class="card" data-nombre="productos">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      </div>
      <a href="mantenimientos/productos/listar.php"><button>Productos</button></a>
    </div>

    <!-- VENTAS -->
    <div class="card" data-nombre="ventas">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      </div>
      <a href="mantenimientos/ventas/listar.php"><button>Ventas</button></a>
    </div>

    <!-- CLIENTES -->
    <div class="card" data-nombre="clientes">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </div>
      <a href="mantenimientos/clientes/listar.php"><button>Clientes</button></a>
    </div>

    <!-- SISTEMA -->
    <div class="card" data-nombre="sistema panel">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
      </div>
      <a href="sistema.php"><button>Sistema</button></a>
    </div>

    <!-- MANUAL -->
    <div class="card" data-nombre="manual">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
      </div>
      <a href="manual/index.php" target="_blank"><button>Manual</button></a>
    </div>

    <!-- REPORTES -->
    <div class="card" data-nombre="reportes">
      <div class="card-icon">
        <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
      </div>
      <a href="reportes.php"><button>Reportes</button></a>
    </div>

  </div>

  <p class="no-resultados" id="no-resultados">No se encontró ningún módulo 😕</p>

  <!-- SALIR -->
  <div class="salir-wrap">
    <a href="logout.php"><button class="btn-salir">Salir</button></a>
  </div>

</div>
<script src="js/scripts.js"></script>
<script>
// Buscador de cards del menú
document.getElementById('buscador').addEventListener('keyup', function(){
    const filtro = this.value.toLowerCase();
    const cards = document.querySelectorAll('#grid-cards .card');
    let visibles = 0;
    cards.forEach(card => {
        const nombre = card.getAttribute('data-nombre') || '';
        if(nombre.includes(filtro)){
            card.style.display = '';
            visibles++;
        } else {
            card.style.display = 'none';
        }
    });
    document.getElementById('no-resultados').style.display = visibles === 0 ? 'block' : 'none';
});
</script>
</body>
</html>