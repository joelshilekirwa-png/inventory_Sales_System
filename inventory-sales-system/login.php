<?php
require_once __DIR__ . '/includes/functions.php';
if (is_logged_in()) redirect('index.php');
require_once __DIR__ . '/config/database.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim($_POST['username'] ?? ''); $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT id, full_name, username, password_hash FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]); $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true); $_SESSION['user_id'] = (int)$user['id']; $_SESSION['full_name'] = $user['full_name']; $_SESSION['username'] = $user['username'];
        flash('success', 'Welcome back, ' . $user['full_name'] . '.'); redirect('index.php');
    }
    $error = 'Invalid username or password.';
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login | Inventory & Sales</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"><link rel="stylesheet" href="assets/css/app.css"></head><body class="login-page"><div class="login-box"><div class="login-logo"><b><i class="fas fa-boxes mr-2"></i>StockManager</b></div><div class="card"><div class="card-body login-card-body"><p class="login-box-msg">Sign in to manage inventory and sales</p><?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?><?php show_flash(); ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div class="input-group mb-3"><input name="username" class="form-control" placeholder="Username" required autofocus><div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div></div><div class="input-group mb-3"><input type="password" name="password" class="form-control" placeholder="Password" required><div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div></div><button class="btn btn-primary btn-block" type="submit">Sign In</button></form><hr><p class="text-muted small mb-0">First time? Open <a href="setup.php">setup.php</a> after starting XAMPP MySQL.</p></div></div></div><script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script></body></html>
