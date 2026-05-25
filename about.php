<?php
require_once 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de — Sistema LAMP</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #1a1a2e; color: #eee; min-height: 100vh; display: flex; flex-direction: column; }

        header { background: #16213e; border-bottom: 2px solid #0f3460; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; }
        header .brand { font-weight: bold; font-size: 1rem; }
        nav a { color: #aaa; text-decoration: none; margin-left: 16px; font-size: 0.88rem; }
        nav a:hover, nav a.active { color: #fff; }
        .user-info { font-size: 0.82rem; color: #556; }
        .user-info span { color: #4a90d9; }

        main { flex: 1; max-width: 640px; margin: 2rem auto; padding: 0 1rem; width: 100%; }

        h2 { font-size: 1rem; color: #ccc; margin-bottom: 0.6rem; }
        p { font-size: 0.88rem; color: #aaa; line-height: 1.6; }

        .section { background: #16213e; border: 1px solid #0f3460; border-radius: 4px; padding: 1.2rem 1.4rem; margin-bottom: 1rem; }

        .team { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.6rem; }
        .member { background: #0f3460; border-radius: 4px; padding: 0.8rem 1rem; font-size: 0.88rem; }
        .member strong { display: block; color: #eee; margin-bottom: 2px; }
        .member span { color: #778; }

        footer { text-align: center; padding: 12px; font-size: 0.78rem; color: #555; border-top: 1px solid #0f3460; background: #16213e; }
    </style>
</head>
<body>
    <header>
        <span class="brand">Sistema LAMP</span>
        <nav>
            <a href="dashboard.php">Usuarios</a>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
        <span class="user-info">Sesión: <span><?= htmlspecialchars($_SESSION['username']) ?></span></span>
    </header>
    <main>

        <div class="section">
            <h2>Tecnologías</h2>
            <p>Linux (Ubuntu Server) &mdash; Apache 2.4 &mdash; MySQL 8.4 &mdash; PHP 8.5</p>
        </div>

        <div class="section">
            <h2>Equipo</h2>
            <div class="team">
                <div class="member">
                    <strong>Julian Granillo</strong>
                </div>
                <div class="member">
                    <strong>Gerber Estrada</strong>
                </div>
                <div class="member">
                    <strong>Mario Hernandez</strong>
                </div>
            </div>
        </div>
    </main>
    <footer>Proyecto LAMP &mdash; Seguridad Informática</footer>
</body>
</html>
