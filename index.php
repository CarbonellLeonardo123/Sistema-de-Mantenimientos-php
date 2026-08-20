<?php
session_start();
include("config/conexion.php");
/** @var mysqli $conn */
if(isset($_POST['ingresar'])){

    $usuario = $_POST['usuario'];
    $clave   = $_POST['clave'];

    $sql  = "SELECT * FROM usuario WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    if($fila && $clave == $fila['clave']){
        $_SESSION['usuario'] = $usuario;
        header("Location: menu.php");
        exit();
    } else {
        $error = "Usuario o clave incorrecta";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Promart</title>
<style>
  * { margin:0; padding:0; box-sizing:border-box; }

  body {
    font-family: Arial, sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background:
      linear-gradient(rgba(20,40,80,0.62), rgba(20,40,80,0.62)),
      url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1400&q=80')
      center/cover no-repeat;
  }

  .login-box {
    width: 100%;
    max-width: 460px;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 20px;
  }

  .brand {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
  }

  .brand-icon {
    width: 36px;
    height: 36px;
    fill: white;
  }

  .brand-name {
    font-size: 30px;
    font-weight: bold;
    color: white;
    letter-spacing: 3px;
  }

  .brand-sub {
    font-size: 13px;
    letter-spacing: 6px;
    color: rgba(255,255,255,0.85);
    margin-bottom: 30px;
  }

  .input-wrap {
    width: 100%;
    display: flex;
    align-items: center;
    background: white;
    border-radius: 6px;
    margin-bottom: 14px;
    padding: 0 16px;
    height: 54px;
  }

  .input-wrap svg {
    width: 20px;
    height: 20px;
    stroke: #e07b20;
    flex-shrink: 0;
    margin-right: 12px;
  }

  .input-wrap input {
    border: none;
    outline: none;
    background: transparent;
    font-size: 15px;
    width: 100%;
    color: #333;
  }

  .input-wrap input::placeholder { color: #aaa; }

  .remember-row {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
  }

  .remember-row input[type=checkbox] {
    width: 18px;
    height: 18px;
    accent-color: #e07b20;
    cursor: pointer;
  }

  .remember-row label {
    color: white;
    font-size: 14px;
    cursor: pointer;
  }

  .forgot {
    color: #e07b20;
    font-size: 14px;
    text-decoration: none;
    margin-bottom: 22px;
    margin-top: 4px;
  }

  .forgot:hover { text-decoration: underline; }

  .btn-ingresar {
    width: 100%;
    height: 54px;
    background: #2ecc71;
    border: none;
    border-radius: 30px;
    color: white;
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 2px;
    cursor: pointer;
    transition: background 0.2s;
  }

  .btn-ingresar:hover { background: #27b862; }

  .error-msg {
    color: #ff6b6b;
    font-size: 14px;
    margin-bottom: 12px;
    background: rgba(0,0,0,0.3);
    padding: 8px 16px;
    border-radius: 6px;
    width: 100%;
    text-align: center;
  }
</style>
</head>
<body>

<div class="login-box">

  <!-- Logo -->
  <div class="brand">
    <svg class="brand-icon" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
      <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    <span class="brand-name">PROMART</span>
  </div>
  <div class="brand-sub">EMPRESAS</div>

  <!-- Formulario -->
  <form method="POST" style="width:100%; display:flex; flex-direction:column; align-items:center;">

    <?php if(isset($error)): ?>
      <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="input-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      <input type="text" name="usuario" placeholder="Usuario" required />
    </div>

    <div class="input-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
      </svg>
      <input type="password" name="clave" placeholder="Contraseña" required />
    </div>

    <div class="remember-row">
      <input type="checkbox" id="recuerdame" name="recuerdame" />
      <label for="recuerdame">Recuérdame</label>
    </div>

    <a href="#" class="forgot">Olvidé mi contraseña</a>

    <button type="submit" name="ingresar" class="btn-ingresar">INGRESAR</button>

  </form>
</div>

</body>
</html>