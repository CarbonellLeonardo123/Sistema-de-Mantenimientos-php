<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../../index.php"); exit(); }
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$id = intval($_GET['id']);
$ventas = mysqli_query($conn, "SELECT * FROM venta");
$stmt = mysqli_prepare($conn, "SELECT * FROM pagos WHERE idPago=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$fila = mysqli_fetch_array(mysqli_stmt_get_result($stmt));
$error = "";
if(isset($_POST['actualizar'])){
    $metodo  = trim($_POST['metodo']);
    $monto   = trim($_POST['monto']);
    $fecha   = trim($_POST['fecha']);
    $idVenta = trim($_POST['idVenta']);
    if($metodo != "" && $monto != "" && $fecha != "" && $idVenta != ""){
        $stmt2 = mysqli_prepare($conn, "UPDATE pagos SET metodo=?, monto=?, fecha=?, idVenta=? WHERE idPago=?");
        mysqli_stmt_bind_param($stmt2, "sdsii", $metodo, $monto, $fecha, $idVenta, $id);
        mysqli_stmt_execute($stmt2);
        header("Location:listar.php"); exit();
    } else { $error = "Complete todos los campos"; }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Pago</title>
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
.error { background:rgba(231,76,60,0.2); color:#f1948a; padding:10px 14px; border-radius:8px; font-size:14px; margin-bottom:10px; }
</style>
</head>
<body>
<div class="formulario">
  <h1>Editar Pago</h1>
  <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>
  <form method="POST">
    <label>Método de Pago</label>
    <select name="metodo" required>
      <option value="Efectivo"  <?= $fila['metodo']=='Efectivo'  ? 'selected':'' ?>>💵 Efectivo</option>
      <option value="Yape"      <?= $fila['metodo']=='Yape'      ? 'selected':'' ?>>📱 Yape</option>
      <option value="Tarjeta"   <?= $fila['metodo']=='Tarjeta'   ? 'selected':'' ?>>💳 Tarjeta</option>
    </select>
    <label>Monto (S/.)</label>
    <input type="number" name="monto" value="<?= $fila['monto'] ?>" step="0.01" min="0" required>
    <label>Fecha</label>
    <input type="date" name="fecha" value="<?= $fila['fecha'] ?>" required>
    <label>Venta</label>
    <select name="idVenta" required>
      <?php while($v = mysqli_fetch_array($ventas)): ?>
      <option value="<?= $v['idVenta'] ?>" <?= $v['idVenta'] == $fila['idVenta'] ? 'selected':'' ?>>
        Venta #<?= $v['idVenta'] ?> — <?= date('d/m/Y', strtotime($v['fecha'])) ?>
      </option>
      <?php endwhile; ?>
    </select>
    <button type="submit" name="actualizar" class="btn-actualizar">Actualizar Pago</button>
  </form>
  <a href="listar.php" class="btn-volver">← Volver a la lista</a>
</div>
</body>
</html>