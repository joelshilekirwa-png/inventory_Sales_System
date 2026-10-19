<?php
// Change these values if your XAMPP/MySQL configuration is different.
$dbHost = 'localhost';
$dbName = 'inventory_sales';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO(
        "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    $message = htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    die('<!doctype html><html><head><meta charset="utf-8"><title>Database connection error</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></head><body class="bg-light"><div class="container py-5"><div class="alert alert-danger"><h4>Database connection failed</h4><p>Check that MySQL is running, database <strong>inventory_sales</strong> exists, and config/database.php has the correct username/password.</p><small>' . $message . '</small><hr><a href="../setup.php" class="btn btn-primary">Open setup page</a></div></div></body></html>');
}
