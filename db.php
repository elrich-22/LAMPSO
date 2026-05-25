<?php
if (session_status() === PHP_SESSION_NONE) session_start();

ini_set('display_errors', '0');
error_reporting(0);

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=lamp_project;charset=utf8mb4',
        'lamp_user',
        'lamp1234',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    http_response_code(500);
    die('Error de conexión.');
}
