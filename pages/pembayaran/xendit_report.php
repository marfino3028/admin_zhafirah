<?php
/**
 * Admin - Xendit Balance & Transactions Report
 */
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/xendit-va.php';

// Check admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$xenditVA = new XenditVA();
$message = '';
$error = '';

// Get Balance
$balanceData = null;
if (isset($_GET['get_balance'])) {
    $result = $xenditVA->getBalance();
    if ($result['success']) {
        $balanceData = $result['data'];
    } else {
        $error = $result['message'];
    }
}

// Get Transactions
$transactions = null;
if (isset($_GET['get_transactions'])) {
    $result = $xenditVA->getTransactions([
        'limit' => isset($GET[]) ? $GET[] : 50,
        'types' => 'DISBURSEMENT,PAYMENT'
    ]);
    if ($result['success']) {
        $transactions = $result['data'];
    } else {
        $error = $result['message'];
    }
}

// Get payment summary from database
$database = new Database();
$db = $database->getConnection();

// Today's payments
$query = "SELECT COUNT(*) as total, SUM(amount) as sum 
          FROM payments 
          WHERE status = 'paid' 
          AND DATE(paid_at) = CURDATE()";
$stmt = $db->query($query);
$todayPayments = $stmt->fetch(PDO::FETCH_ASSOC);

// This month
$query = "SELECT COUNT(*) as total, SUM(amount) as sum 
          FROM payments 
          WHERE status = 'paid' 
          AND MONTH(paid_at) = MONTH(CURDATE()) 
          AND YEAR(paid_at) = YEAR(CURDATE())";
$stmt = $db->query($query);
$monthPayments = $stmt->fetch(PDO::FETCH_ASSOC);

// Recent transactions
$query = "SELECT p.*, b.booking_code, u.full_name 
          FROM payments p
          JOIN bookings b ON p.booking_id = b.id
          JOIN users u ON b.user_id = u.id
          ORDER BY p.created_at DESC
          LIMIT 20";
$stmt = $db->query($query);
$recentPayments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xendit Balance & Laporan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .balance-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
        }
        .stat-card {
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Zhafirah Admin - Xendit Report</span>
            <a href="dashboard.php" class="btn btn-outline-light btn-sm">Kembali</a>
        </div>
    </nav>

    <div class="container my-5">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <!-- Balance Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="balance-card">
                    <h4><i class="bi bi-wallet2"></i> Saldo Xendit</h4>
                    <?php if ($balanceData): ?>
                        <h2 class="mb-0">Rp <?= number_format($balanceData['balance'] ?? 0, 0, ',', '.') ?></h2>
                        <small>Terakhir update: <?= date('d M Y H:i') ?></small>
                    <?php else: ?>
                        <a href="?get_balance=1" class="btn btn-light mt-2">
                            <i class="bi bi-arrow-repeat"></i> Cek Saldo
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <h6 class="text-muted">Hari Ini</h6>
                        <h3><?= $todayPayments['total'] ?? 0 ?> Transaksi</h3>
                        <p class="mb-0">Rp <?= number_format($todayPayments['sum'] ?? 0, 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <h6 class="text-muted">Bulan Ini</h6>
                        <h3><?= $monthPayments['total'] ?? 0 ?> Transaksi</h3>
                        <p class="mb-0">Rp <?= number_format($monthPayments['sum'] ?? 0, 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="?get_transactions=1" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-download"></i> Download Transaksi Xendit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Xendit Transactions -->
        <?php if ($transactions): ?>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-ul"></i> Transaksi Xendit API</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions['data'] ?? [] as $tx): ?>
                            <tr>
                                <td><code><?= htmlspecialchars($tx['id'] ?? '') ?></code></td>
                                <td><?= htmlspecialchars($tx['type'] ?? '') ?></td>
                                <td>Rp <?= number_format($tx['amount'] ?? 0, 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge bg-<?= ($tx['status'] ?? '') === 'SUCCESS' ? 'success' : 'secondary' ?>">
                                        <?= htmlspecialchars($tx['status'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($tx['created'] ?? 'now')) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Recent Payments from DB -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Transaksi Terbaru (Database)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Booking Code</th>
                                <th>Nama</th>
                                <th>Amount</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentPayments as $payment): ?>
                            <tr>
                                <td><?= htmlspecialchars($payment['booking_code']) ?></td>
                                <td><?= htmlspecialchars($payment['full_name']) ?></td>
                                <td>Rp <?= number_format($payment['amount'], 0, ',', '.') ?></td>
                                <td>
                                    <?= htmlspecialchars($payment['payment_method'] ?? 'N/A') ?>
                                    <?php if ($payment['payment_channel']): ?>
                                        <br><small class="text-muted"><?= htmlspecialchars($payment['payment_channel']) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $statusColors = [
                                        'paid' => 'success',
                                        'pending' => 'warning',
                                        'expired' => 'danger',
                                        'failed' => 'danger'
                                    ];
                                    $color = $statusColors[$payment['status']] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?= $color ?>">
                                        <?= ucfirst($payment['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($payment['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
