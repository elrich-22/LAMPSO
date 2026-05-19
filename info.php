<?php
require_once 'config.php';
requireLogin();

$db = getDB();
$totalUsers = $db->query('SELECT COUNT(*) FROM users')->fetchColumn();

$info = [
    'Sistema operativo' => PHP_OS,
    'Versión PHP'       => PHP_VERSION,
    'Servidor web'      => $_SERVER['SERVER_SOFTWARE'] ?? 'Apache',
    'Fecha del servidor'=> date('d/m/Y H:i:s'),
    'Total de usuarios' => $totalUsers,
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información — Sistema LAMP</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #1a1a2e; color: #eee; min-height: 100vh; display: flex; flex-direction: column; }

        header { background: #16213e; border-bottom: 2px solid #0f3460; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; }
        header .brand { font-weight: bold; font-size: 1rem; }
        nav a { color: #aaa; text-decoration: none; margin-left: 16px; font-size: 0.88rem; }
        nav a:hover, nav a.active { color: #fff; }
        .user-info { font-size: 0.82rem; color: #556; }
        .user-info span { color: #4a90d9; }

        main { flex: 1; max-width: 600px; margin: 2rem auto; padding: 0 1rem; width: 100%; }

        h2 { font-size: 1rem; color: #ccc; margin-bottom: 1rem; }

        table { width: 100%; border-collapse: collapse; background: #16213e; border: 1px solid #0f3460; font-size: 0.88rem; }
        td { padding: 9px 14px; border-bottom: 1px solid #0f3460; color: #ddd; }
        tr:last-child td { border-bottom: none; }
        td:first-child { color: #888; width: 50%; }

        footer { text-align: center; padding: 12px; font-size: 0.78rem; color: #555; border-top: 1px solid #0f3460; background: #16213e; }
    </style>
</head>
<body>
    <header>
        <span class="brand">Sistema LAMP</span>
        <nav>
            <a href="dashboard.php">Usuarios</a>
            <a href="info.php" class="active">Información</a>
            <a href="about.php">Acerca de</a>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
        <span class="user-info">Sesión: <span><?= htmlspecialchars($_SESSION['username']) ?></span></span>
    </header>
    <main>
        <h2>Información del servidor</h2>
        <table>
            <?php foreach ($info as $label => $value): ?>
            <tr>
                <td><?= htmlspecialchars($label) ?></td>
                <td><?= htmlspecialchars((string)$value) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <footer>Proyecto LAMP &mdash; Seguridad Informática</footer>
</body>
</html>
