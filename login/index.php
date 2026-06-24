<?php
session_start();
include "../php/conexion.php";
include "../php/funciones.php";

$error = "";

// Procesar el login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    $sql = "SELECT * FROM usuarios 
            WHERE Usuario='$username' 
            AND Password='$password' 
            AND deleted=0";

    $result = mysqli_query($cnn, $sql);


    if ($result && mysqli_num_rows($result) > 0) {

        $campos = mysqli_fetch_assoc($result);

        $_SESSION["usuarios_registrado"] = true;
        $_SESSION["usuarios_idusuario"] = $campos['IdUsuario'];
        $_SESSION["usuarios_usuario"] = $campos['Usuario'];

        header("Location: ../index.php");
        exit();

    } else {

        $_SESSION["usuarios_registrado"] = false;
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Login - Acceso al Sistema</title>
    <!-- Bootstrap 5 CSS (CDN minimalista) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (opcional, para iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary: #0d6efd; --bg: #f3f4f6; }
        body {
            background-color: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            font-family: 'Inter', system-ui, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
        }

        .login-header { text-align: center; margin-bottom: 2rem; }
        .login-header h1 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; }
        
        .btn-login {
            background-color: var(--primary);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-login:hover { background-color: #0b5ed7; }
        
        .input-group-text { background-color: #f8fafc; border-right: none; color: #64748b; }
        .form-control { border-left: none; }
        
        footer { margin-top: 2rem; font-size: 0.8rem; color: #94a3b8; }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-store" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 0.5rem;"></i>
            <h1>Iniciar Sesión</h1>
            <p class="text-muted">Accede a Kiosco Smart</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Ingresa tu usuario" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="••••••••" required>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Iniciar sesión
                </button>
            </div>
        </form>

        <footer>
            <p><i class="fas fa-shield-alt"></i> Sistema seguro • Demo credentials: admin / 123456</p>
        </footer>
    </div>

    <!-- Bootstrap JS (para el alert dismissible) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>