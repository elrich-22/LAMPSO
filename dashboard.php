<?php
require_once 'config.php';
requireLogin();

$db = getDB();
$users = $db->query('SELECT id, username, email, created_at FROM users ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios — Sistema LAMP</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #1a1a2e; color: #eee; min-height: 100vh; display: flex; flex-direction: column; }

        header { background: #16213e; border-bottom: 2px solid #0f3460; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; }
        header .brand { font-weight: bold; font-size: 1rem; }
        nav a { color: #aaa; text-decoration: none; margin-left: 16px; font-size: 0.88rem; }
        nav a:hover, nav a.active { color: #fff; }
        .user-info { font-size: 0.82rem; color: #556; }
        .user-info span { color: #4a90d9; }

        main { flex: 1; max-width: 860px; margin: 2rem auto; padding: 0 1rem; width: 100%; }

        h2 { font-size: 1rem; color: #ccc; margin-bottom: 1rem; }

        table { width: 100%; border-collapse: collapse; background: #16213e; border: 1px solid #0f3460; border-radius: 4px; font-size: 0.88rem; }
        thead { background: #0f3460; }
        th { padding: 10px 14px; text-align: left; font-weight: normal; color: #aaa; font-size: 0.82rem; }
        td { padding: 9px 14px; border-bottom: 1px solid #0f3460; color: #ddd; }
        tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #0f3460; }

        footer { text-align: center; padding: 12px; font-size: 0.78rem; color: #555; border-top: 1px solid #0f3460; background: #16213e; }
    </style>
</head>
<body>
    <header>
        <span class="brand">Sistema LAMP</span>
        <nav>
            <a href="about.php">Acerca de</a>
        </nav>
        <span class="user-info">Sesión: <span><?= htmlspecialchars($_SESSION['username']) ?></span></span>
    </header>
    <main>
        <h2>Usuarios registrados (<?= count($users) ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Registrado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= (int)$u['id'] ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['email'] ?? '—') ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($u['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p style="margin-top: 1.2rem; font-size: 0.88rem;"><a href="about.php" style="color: #4a90d9;">about.php</a></p>
    </main>
    <footer>Proyecto LAMP &mdash; Seguridad Informática</footer>
</body>
</html>
