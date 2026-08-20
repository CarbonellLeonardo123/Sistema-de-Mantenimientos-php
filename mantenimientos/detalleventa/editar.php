<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$id = intval($_GET['id']);
$ventas    = mysqli_query($conn, "SELECT * FROM venta");
$productos = mysqli_query($conn, "SELECT * FROM producto");
$stmt = mysqli_prepare($conn, "SELECT * FROM detalleventa WHERE idDetalle=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$fila = mysqli_fetch_array(mysqli_stmt_get_result($stmt));

if(isset($_POST['actualizar'])){
    $idVenta    = trim($_POST['idVenta']);
    $idProducto = trim($_POST['idProducto']);
    $cantidad   = trim($_POST['cantidad']);
    $precio     = trim($_POST['precio']);
    $subtotal   = $cantidad * $precio;
    $stmt2 = mysqli_prepare($conn, "UPDATE detalleventa SET idVenta=?, idProducto=?, cantidad=?, precio=?, subtotal=? WHERE idDetalle=?");
    mysqli_stmt_bind_param($stmt2, "iiiddi", $idVenta, $idProducto, $cantidad, $precio, $subtotal, $id);
    mysqli_stmt_execute($stmt2);
    header("Location:listar.php"); exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Detalle Venta</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { background:#0f1c2e; color:white; font-family:Arial; min-height:100vh; display:flex; align-items:center; justify-content:center; }
.formulario { width:420px; background:#1a2a3a; padding:36px; border-radius:16px; border:1px solid rgba(255,255,255,0.1); }
h1 { font-size:22px; margin-bottom:24px; }
label { font-size:13px; color:#a0bcd8; display:block; margin-top:16px; margin-bottom:6px; }
input, select { width:100%; padding:12px 14px; background:#0f1c2e; border:1px solid rgba(255,255,255,0.15); border-radius:8px; color:white; font-size:15px; outline:none; }
input:focus, select:focus { border-color:#2ecc71; }
select option { background:#1a2a3a; }
.btn-actualizar { width:100%; padding:13px; margin-top:24px; background:#2ecc71; border:none; border-radius:10px; color:white; font-size:16px; font-weight:bold; cursor:pointer; transition:0.2s; }
.btn-actualizar:hover { background:#27b862; }
.btn-volver { display:block; text-align:center; margin-top:14px; color:#a0bcd8; font-size:14px; text-decoration:none; }
.btn-volver:hover { color:white; }
</style>
</head>
<body>
<div class="formulario">
  <h1>Editar Detalle Venta</h1>
  <form method="POST">
    <label>Venta</label>
    <select name="idVenta" required>
      <?php while($v = mysqli_fetch_array($ventas)): ?>
      <option value="<?= $v['idVenta'] ?>" <?= $v['idVenta'] == $fila['idVenta'] ? 'selected' : '' ?>>
        Venta #<?= $v['idVenta'] ?> — <?= date('d/m/Y', strtotime($v['fecha'])) ?>
      </option>
      <?php endwhile; ?>
    </select>
    <label>Producto</label>
    <select name="idProducto" required>
      <?php while($p = mysqli_fetch_array($productos)): ?>
      <option value="<?= $p['idProducto'] ?>" <?= $p['idProducto'] == $fila['idProducto'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($p['nombre']) ?>
      </option>
      <?php endwhile; ?>
    </select>
    <label>Cantidad</label>
    <input type="number" name="cantidad" value="<?= $fila['cantidad'] ?>" min="1" required>
    <label>Precio Unitario (S/.)</label>
    <input type="number" name="precio" value="<?= $fila['precio'] ?>" step="0.01" min="0" required>
    <button type="submit" name="actualizar" class="btn-actualizar">Actualizar</button>
  </form>
  <a href="listar.php" class="btn-volver">← Volver a la lista</a>
</div>
</body>
</html>