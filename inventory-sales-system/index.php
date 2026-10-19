<?php
require_once __DIR__ . '/includes/functions.php'; require_login(); require_once __DIR__ . '/config/database.php';
$pageTitle = 'Dashboard';
$stats = [
 'products' => (int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn(),
 'categories' => (int)$pdo->query('SELECT COUNT(*) FROM categories')->fetchColumn(),
 'customers' => (int)$pdo->query('SELECT COUNT(*) FROM customers')->fetchColumn(),
 'sales_count' => (int)$pdo->query('SELECT COUNT(*) FROM sales')->fetchColumn(),
 'sales_total' => (float)$pdo->query('SELECT COALESCE(SUM(total_amount),0) FROM sales')->fetchColumn(),
 'low_stock' => (int)$pdo->query('SELECT COUNT(*) FROM products WHERE quantity <= reorder_level')->fetchColumn(),
];
$recent = $pdo->query('SELECT s.id,s.invoice_no,s.sale_date,s.total_amount,s.payment_method,c.full_name AS customer_name FROM sales s LEFT JOIN customers c ON c.id=s.customer_id ORDER BY s.id DESC LIMIT 7')->fetchAll();
$lowProducts = $pdo->query('SELECT name,sku,quantity,reorder_level FROM products WHERE quantity <= reorder_level ORDER BY quantity ASC LIMIT 6')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<div class="row">
 <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3><?= $stats['products'] ?></h3><p>Products</p></div><div class="icon"><i class="fas fa-box"></i></div><a href="products.php" class="small-box-footer">Manage products <i class="fas fa-arrow-circle-right"></i></a></div></div>
 <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= number_format($stats['sales_total'], 0) ?></h3><p>Total sales (TZS)</p></div><div class="icon"><i class="fas fa-money-bill-wave"></i></div><a href="reports.php" class="small-box-footer">View reports <i class="fas fa-arrow-circle-right"></i></a></div></div>
 <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $stats['low_stock'] ?></h3><p>Low stock products</p></div><div class="icon"><i class="fas fa-exclamation-triangle"></i></div><a href="products.php?stock=low" class="small-box-footer">Check stock <i class="fas fa-arrow-circle-right"></i></a></div></div>
 <div class="col-lg-3 col-6"><div class="small-box bg-danger"><div class="inner"><h3><?= $stats['sales_count'] ?></h3><p>Sales transactions</p></div><div class="icon"><i class="fas fa-shopping-cart"></i></div><a href="sales.php" class="small-box-footer">View sales <i class="fas fa-arrow-circle-right"></i></a></div></div>
</div>
<div class="row"><div class="col-lg-7"><div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-history mr-1"></i> Recent Sales</h3><div class="card-tools"><a href="sales.php" class="btn btn-sm btn-primary">New Sale</a></div></div><div class="card-body table-responsive p-0"><table class="table table-hover"><thead><tr><th>Invoice</th><th>Date</th><th>Customer</th><th>Total (TZS)</th><th></th></tr></thead><tbody><?php if (!$recent): ?><tr><td colspan="5" class="empty-state">No sales yet. Create your first sale.</td></tr><?php else: foreach($recent as $r): ?><tr><td><?= e($r['invoice_no']) ?></td><td><?= e(date('d M Y', strtotime($r['sale_date']))) ?></td><td><?= e($r['customer_name'] ?: 'Walk-in') ?></td><td><?= money($r['total_amount']) ?></td><td><a class="btn btn-xs btn-outline-primary" href="sale_view.php?id=<?= (int)$r['id'] ?>">View</a></td></tr><?php endforeach; endif; ?></tbody></table></div></div></div>
<div class="col-lg-5"><div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-exclamation-circle mr-1"></i> Low Stock Alert</h3></div><div class="card-body p-0"><table class="table table-sm"><thead><tr><th>Product</th><th>SKU</th><th>Qty</th></tr></thead><tbody><?php if (!$lowProducts): ?><tr><td colspan="3" class="empty-state">No low-stock products.</td></tr><?php else: foreach($lowProducts as $p): ?><tr><td><?= e($p['name']) ?></td><td><?= e($p['sku']) ?></td><td><span class="badge badge-danger"><?= (int)$p['quantity'] ?></span></td></tr><?php endforeach; endif; ?></tbody></table></div><div class="card-footer"><a href="products.php">Manage stock</a></div></div><div class="card card-primary card-outline"><div class="card-body"><h5><i class="fas fa-chart-pie mr-1"></i> Quick Summary</h5><p class="mb-1">Categories: <strong><?= $stats['categories'] ?></strong></p><p class="mb-0">Customers: <strong><?= $stats['customers'] ?></strong></p></div></div></div></div>
<?php require __DIR__ . '/includes/footer.php'; ?>
