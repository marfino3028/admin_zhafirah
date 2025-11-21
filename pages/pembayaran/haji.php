<?php
// Mengambil daftar jamaah dan paket untuk filter
$jamaah_list = $db->query("
    SELECT u.id, u.full_name 
    FROM users u 
    JOIN bookings b ON u.id = b.user_id
    JOIN packages p ON b.package_id = p.id
    WHERE p.package_type='haji' AND b.status NOT IN ('cancelled', 'refunded')
    GROUP BY u.id
    ORDER BY u.full_name ASC
");

$paket_list = $db->query("SELECT id, name, package_code FROM packages WHERE package_type='haji' ORDER BY departure_date DESC");

// Handle filter
$where = "WHERE p.package_type='haji'";
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$package_id = isset($_POST['package_id']) ? $_POST['package_id'] : '';

if($user_id != '') {
    $where .= " AND b.user_id = '$user_id'";
}
if($package_id != '') {
    $where .= " AND b.package_id = '$package_id'";
}

// Mengambil data pembayaran haji dari tabel payments dengan semua kolom
$data = $db->query("
    SELECT 
        pay.id,
        pay.booking_id,
        pay.invoice_id,
        pay.external_id,
        pay.payment_method,
        pay.payment_channel,
        pay.amount,
        pay.paid_amount,
        pay.status,
        pay.xendit_invoice_url,
        pay.paid_at,
        pay.expired_at,
        pay.xendit_response,
        pay.callback_data,
        pay.created_at,
        pay.updated_at,
        u.full_name,
        b.booking_code,
        p.name as package_name
    FROM payments pay
    JOIN bookings b ON pay.booking_id = b.id
    JOIN users u ON b.user_id = u.id
    JOIN packages p ON b.package_id = p.id
    $where
    ORDER BY pay.created_at DESC
");
?>

<style>
.filter-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.filter-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}
.filter-col {
    flex: 1;
}
.filter-title {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}
.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: block;
}
.form-control, .form-select {
    border: 1px solid #dfe4ea;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
    width: 100%;
}
.btn-search {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 10px 30px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-search:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}
.table-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.custom-table {
    width: 100%;
    border-collapse: collapse;
}
.custom-table thead th {
    background: #f8f9fa;
    padding: 15px 10px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #dee2e6;
}
.custom-table tbody td {
    padding: 15px 10px;
    border-bottom: 1px solid #ecf0f1;
    font-size: 14px;
    color: #2c3e50;
    vertical-align: middle;
}
.custom-table tbody tr:hover {
    background: #f8f9fa;
}
.badge-success {
    background: #27ae60;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.badge-pending {
    background: #f39c12;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.badge-expired {
    background: #e74c3c;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.badge-failed {
    background: #95a5a6;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.btn-action {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 13px;
    margin-right: 5px;
    transition: all 0.3s;
}
.btn-detail {
    background: #667eea;
    color: white;
}
.btn-detail:hover {
    background: #5568d3;
}
.btn-edit {
    background: #f39c12;
    color: white;
}
.btn-edit:hover {
    background: #e08e0b;
}
.btn-print {
    background: #95a5a6;
    color: white;
}
.btn-print:hover {
    background: #7f8c8d;
}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="filter-section">
            <div class="filter-row">
                <div class="filter-col">
                    <div class="filter-title">Filter Data Pembayaran Haji</div>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label class="form-label">Pilih Nama Jamaah</label>
                            <select name="user_id" class="form-select">
                                <option value="">Pilih Nama Jamaah</option>
                                <?php 
                                if($jamaah_list) {
                                    foreach($jamaah_list as $jamaah) { 
                                        $selected = ($user_id == $jamaah['id']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $jamaah['id']; ?>" <?php echo $selected; ?>>
                                    <?php echo $jamaah['full_name']; ?>
                                </option>
                                <?php 
                                    }
                                } 
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Pilih Nama Keberangkatan Haji</label>
                            <select name="package_id" class="form-select">
                                <option value="">Pilih Nama Keberangkatan Haji</option>
                                <?php 
                                if($paket_list) {
                                    foreach($paket_list as $paket) { 
                                        $selected = ($package_id == $paket['id']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $paket['id']; ?>" <?php echo $selected; ?>>
                                    <?php echo $paket['package_code']; ?> | <?php echo $paket['name']; ?>
                                </option>
                                <?php 
                                    }
                                } 
                                ?>
                            </select>
                        </div>
                        
                        <div style="display: flex; gap: 10px; margin-top: 20px;">
                            <button type="submit" class="btn-search">🔍 Cari</button>
                            <a href="?page=pembayaran/haji" class="btn-search" style="background: #95a5a6;">🔄 Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-section">
            <div style="margin-bottom: 15px;">
                <label>Show 
                    <select style="padding: 5px; border: 1px solid #ddd; border-radius: 5px;">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    entries
                </label>
            </div>

            <div style="margin-bottom: 15px; float: right;">
                <label>Search: <input type="text" style="padding: 5px; border: 1px solid #ddd; border-radius: 5px;"></label>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Booking</th>
                            <th>Invoice ID</th>
                            <th>External ID</th>
                            <th>Nama Jamaah</th>
                            <th>Nama Keberangkatan</th>
                            <th>Metode Pembayaran</th>
                            <th>Channel</th>
                            <th>Amount</th>
                            <th>Paid Amount</th>
                            <th>Status</th>
                            <th>Paid At</th>
                            <th>Expired At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($data) {
                            foreach($data as $key => $row) { 
                                $paid_at = $row['paid_at'] ? date('d M Y H:i', strtotime($row['paid_at'])) : '-';
                                $expired_at = $row['expired_at'] ? date('d M Y H:i', strtotime($row['expired_at'])) : '-';
                        ?>
                        <tr>
                            <td><?php echo ($key + 1); ?></td>
                            <td><strong><?php echo $row['booking_code']; ?></strong></td>
                            <td><?php echo $row['invoice_id'] ?: '-'; ?></td>
                            <td><?php echo $row['external_id'] ?: '-'; ?></td>
                            <td><strong style="color: #667eea;"><?php echo strtoupper($row['full_name']); ?></strong></td>
                            <td><strong style="color: #667eea;"><?php echo $row['package_name']; ?></strong></td>
                            <td><?php echo ucfirst($row['payment_method'] ?: '-'); ?></td>
                            <td><?php echo ucfirst($row['payment_channel'] ?: '-'); ?></td>
                            <td>Rp <?php echo number_format($row['amount'], 0, ',', '.'); ?></td>
                            <td>Rp <?php echo number_format($row['paid_amount'], 0, ',', '.'); ?></td>
                            <td>
                                <?php 
                                switch($row['status']) {
                                    case 'success':
                                    case 'paid':
                                        echo '<span class="badge-success">Success</span>';
                                        break;
                                    case 'pending':
                                        echo '<span class="badge-pending">Pending</span>';
                                        break;
                                    case 'expired':
                                        echo '<span class="badge-expired">Expired</span>';
                                        break;
                                    case 'failed':
                                        echo '<span class="badge-failed">Failed</span>';
                                        break;
                                    default:
                                        echo '<span class="badge-pending">' . ucfirst($row['status']) . '</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo $paid_at; ?></td>
                            <td><?php echo $expired_at; ?></td>
                            <td>
                                <a href="?page=pembayaran/detail_pembayaran_haji&id=<?php echo $row['id']; ?>" class="btn-action btn-detail" title="Detail">👁️</a>
                                <?php if($row['xendit_invoice_url']) { ?>
                                <a href="<?php echo $row['xendit_invoice_url']; ?>" target="_blank" class="btn-action btn-print" title="Invoice">🔗</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="14" style="text-align:center;">Tidak ada data pembayaran</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                <p style="margin: 0;">Showing 1 to <?php echo count($data); ?> of <?php echo count($data); ?> entries</p>
                <div>
                    <button class="btn btn-default" style="padding: 8px 15px; margin: 0 3px;">Previous</button>
                    <button class="btn btn-primary" style="padding: 8px 15px; margin: 0 3px; background: #667eea; border: none;">1</button>
                    <button class="btn btn-default" style="padding: 8px 15px; margin: 0 3px;">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
