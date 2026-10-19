<?php
// One-time installer: create the database, tables, sample categories and admin account.
$host = '127.0.0.1'; $user = 'root'; $pass = ''; $dbName = 'inventory_sales';
try {
    $pdo = new PDO("mysql:host={$host};charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `{$dbName}`");
    $schema = file_get_contents(__DIR__ . '/database/schema_only.sql');
    foreach (array_filter(array_map('trim', explode(';', $schema))) as $statement) $pdo->exec($statement);
    $pdo->exec("INSERT IGNORE INTO categories (name, description) VALUES ('Electronics','Electronic equipment and accessories'),('Stationery','School and office stationery'),('Accessories','Computer and general accessories')");
    $stmt = $pdo->prepare('INSERT IGNORE INTO users (full_name, username, password_hash) VALUES (?, ?, ?)');
    $stmt->execute(['System Administrator', 'admin', password_hash('Admin@123', PASSWORD_DEFAULT)]);
    $ok = true; $message = 'Installation completed successfully. Your database and tables are ready.';
} catch (Throwable $e) { $ok = false; $message = $e->getMessage(); }
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>System Setup</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"><link rel="stylesheet" href="assets/css/app.css"></head><body class="bg-light"><div class="container py-5"><div class="card mx-auto" style="max-width:720px"><div class="card-header bg-primary text-white"><h3 class="mb-0">Inventory & Sales — Setup</h3></div><div class="card-body"><div class="alert alert-<?= $ok ? 'success' : 'danger' ?>"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div><?php if ($ok): ?><h5>Default administrator login</h5><p>Username: <code>admin</code><br>Password: <code>Admin@123</code></p><p class="text-danger"><strong>Security:</strong> After setup and testing, remove or rename <code>setup.php</code>, and change the default password if user management is enabled.</p><a class="btn btn-primary" href="login.php">Go to login</a><?php else: ?><p>Check that XAMPP MySQL is running and that the username/password at the top of <code>setup.php</code> match your MySQL configuration.</p><a class="btn btn-secondary" href="setup.php">Try again</a><?php endif; ?></div></div></div></body></html>
