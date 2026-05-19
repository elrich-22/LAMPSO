<?php
require_once 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Si ya está logueado, redirigir al dashboard
if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Por favor ingresa usuario y contraseña.';
    } else {
        $db = getDB();
        $stmt = $db->prepare('SELECT id, username, password FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #1a1a2e;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 2.5rem;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        .card h1 {
            text-align: center;
            margin-bottom: 0.3rem;
            color: #1a1a2e;
            font-size: 1.6rem;
        }
        .card p.subtitle {
            text-align: center;
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 0.3rem;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            margin-bottom: 1.1rem;
            transition: border 0.2s;
        }
        input:focus { outline: none; border-color: #4a90d9; }
        .btn {
            width: 100%;
            padding: 0.8rem;
            background: #4a90d9;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn:hover { background: #357abd; }
        .error {
            background: #fdecea;
            color: #c0392b;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            text-align: center;
        }
        .hint {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.8rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Bienvenido</h1>
        <p class="subtitle">Sistema LAMP &mdash; Proyecto</p>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   placeholder="Ej: admin" autofocus>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="••••••••">

            <button type="submit" class="btn">Ingresar</button>
        </form>
        <p class="hint">Usuario: admin &nbsp;|&nbsp; Contraseña: password123</p>
    </div>
</body>
</html>
