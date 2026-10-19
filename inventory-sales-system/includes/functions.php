<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function e($value): string { return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8'); }
function redirect(string $url): never { header('Location: ' . $url); exit; }
function is_logged_in(): bool { return isset($_SESSION['user_id']); }
function require_login(): void { if (!is_logged_in()) redirect('login.php'); }
function flash(string $type, string $message): void { $_SESSION['flash'] = ['type' => $type, 'message' => $message]; }
function show_flash(): void {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash']; unset($_SESSION['flash']);
        $type = in_array($f['type'], ['success','danger','warning','info'], true) ? $f['type'] : 'info';
        echo '<div class="alert alert-' . e($type) . ' alert-dismissible fade show" role="alert">' . e($f['message']) . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
}
function csrf_token(): string { if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); return $_SESSION['csrf_token']; }
function verify_csrf(): void {
    $token = $_POST['csrf_token'] ?? '';
    if (!$token || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) { http_response_code(419); exit('Invalid form token. Please go back, refresh the page, and try again.'); }
}
function money($amount): string { return number_format((float)$amount, 2); }
function active_page(string $file): string { return basename($_SERVER['PHP_SELF']) === $file ? 'active' : ''; }
