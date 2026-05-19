<?php
require_once 'db.php';

if (!empty($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistema LAMP</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #1a1a2e; color: #eee; display: flex; flex-direction: column; min-height: 100vh; }

        header { background: #16213e; border-bottom: 2px solid #0f3460; padding: 12px 24px; font-weight: bold; font-size: 1rem; }

        main { flex: 1; display: flex; justify-content: center; align-items: center; padding: 2rem; }

        .box { background: #16213e; border: 1px solid #0f3460; border-radius: 6px; padding: 2rem; width: 100%; max-width: 320px; }
        .box h2 { margin-bottom: 1.2rem; font-size: 1rem; color: #eee; }

        label { display: block; font-size: 0.82rem; margin-bottom: 4px; color: #aaa; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 8px 10px;
            background: #0f3460; border: 1px solid #274472; color: #eee;
            border-radius: 4px; font-size: 0.9rem; margin-bottom: 1rem;
        }
        input:focus { outline: none; border-color: #4a90d9; }
        input::placeholder { color: #556; }

        button { width: 100%; padding: 9px; background: #4a90d9; color: #fff; border: none; border-radius: 4px; font-size: 0.9rem; cursor: pointer; }
        button:hover { background: #357abd; }

        .error { background: #3d1515; color: #e88; border-radius: 4px; padding: 8px 10px; margin-bottom: 1rem; font-size: 0.85rem; }

        .links { text-align: center; margin-top: 1rem; font-size: 0.82rem; }
        .links a { color: #4a90d9; text-decoration: none; }
        .links a:hover { text-decoration: underline; }

        footer { text-align: center; padding: 12px; font-size: 0.78rem; color: #555; border-top: 1px solid #0f3460; background: #16213e; }
    </style>
</head>
<body>
    <header>Sistema LAMP</header>
    <main>
        <div class="box">
            <h2>Iniciar sesión</h2>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <label>Usuario</label>
                <input type="text" name="username" placeholder="admin" required>
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••" required>
                <button type="submit">Entrar</button>
            </form>
            <div class="links"><a href="about.php">Acerca del proyecto</a></div>
        </div>
    </main>
    <footer>Proyecto LAMP &mdash; Seguridad Informática</footer>
</body>
</html>
