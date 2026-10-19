<?php
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? 'Dashboard';
$basePath = $basePath ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?> | Inventory & Sales</title>
  <!-- AdminLTE 3.2, Bootstrap, Font Awesome and Chart.js are loaded from CDN (internet required for these vendor assets). -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= e($basePath) ?>assets/css/app.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li><li class="nav-item d-none d-sm-inline-block"><a href="<?= e($basePath) ?>index.php" class="nav-link">Inventory & Sales</a></li></ul>
  <ul class="navbar-nav ml-auto"><li class="nav-item"><span class="nav-link"><i class="far fa-user mr-1"></i><?= e($_SESSION['full_name'] ?? 'Guest') ?></span></li><li class="nav-item"><a class="nav-link" href="<?= e($basePath) ?>change_password.php" title="Change password"><i class="fas fa-key"></i> Password</a></li><li class="nav-item"><a class="nav-link" href="<?= e($basePath) ?>logout.php" title="Sign out"><i class="fas fa-sign-out-alt"></i> Logout</a></li></ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= e($basePath) ?>index.php" class="brand-link"><span class="brand-image img-circle elevation-3 brand-mark"><i class="fas fa-boxes"></i></span><span class="brand-text font-weight-light">StockManager</span></a>
  <div class="sidebar"><div class="user-panel mt-3 pb-3 mb-3 d-flex"><div class="image"><span class="user-icon"><i class="fas fa-user"></i></span></div><div class="info"><a href="#" class="d-block"><?= e($_SESSION['full_name'] ?? 'Administrator') ?></a><small class="text-light">Administrator</small></div></div>
    <nav class="mt-2"><ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
      <li class="nav-item"><a href="<?= e($basePath) ?>index.php" class="nav-link <?= active_page('index.php') ?>"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
      <li class="nav-header">INVENTORY</li>
      <li class="nav-item"><a href="<?= e($basePath) ?>products.php" class="nav-link <?= active_page('products.php') ?>"><i class="nav-icon fas fa-box"></i><p>Products</p></a></li>
      <li class="nav-item"><a href="<?= e($basePath) ?>categories.php" class="nav-link <?= active_page('categories.php') ?>"><i class="nav-icon fas fa-tags"></i><p>Categories</p></a></li>
      <li class="nav-item"><a href="<?= e($basePath) ?>customers.php" class="nav-link <?= active_page('customers.php') ?>"><i class="nav-icon fas fa-users"></i><p>Customers</p></a></li>
      <li class="nav-header">SALES</li>
      <li class="nav-item"><a href="<?= e($basePath) ?>sales.php" class="nav-link <?= active_page('sales.php') ?>"><i class="nav-icon fas fa-shopping-cart"></i><p>Sales & New Sale</p></a></li>
      <li class="nav-item"><a href="<?= e($basePath) ?>reports.php" class="nav-link <?= active_page('reports.php') ?>"><i class="nav-icon fas fa-chart-bar"></i><p>Reports</p></a></li>
      <li class="nav-header">SYSTEM</li>
      <li class="nav-item"><a href="<?= e($basePath) ?>logout.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
    </ul></nav>
  </div>
</aside>
<div class="content-wrapper"><section class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-7"><h1><?= e($pageTitle) ?></h1></div><div class="col-sm-5"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= e($basePath) ?>index.php">Home</a></li><li class="breadcrumb-item active"><?= e($pageTitle) ?></li></ol></div></div></div></section>
<section class="content"><div class="container-fluid">
<?php show_flash(); ?>
