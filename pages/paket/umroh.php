<?php
// Mengambil data paket umroh dari tabel 'packages'
$data=$db->query("SELECT p.*, m.nama_maskapai as nama_maskapai FROM packages p LEFT JOIN tbl_maskapai m ON p.airline_id = m.id ORDER BY p.package_name ASC");

// Ambil pesan sukses dari session
$success_message = $_SESSION['success_message'] ?? '';
$error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>
<style>
@keyframes slideIn {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:12px 25px;border-radius:8px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .3s;margin-bottom:20px}
.table-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.custom-table{width:100%;border-collapse:collapse}
.custom-table thead th{background:#f8f9fa;padding:15px 10px;text-align:left;font-size:13px;font-weight:600;color:#2c3e50;border-bottom:2px solid #dee2e6}
.custom-table tbody td{padding:15px 10px;border-bottom:1px solid #ecf0f1;font-size:14px;color:#2c3e50}
.custom-table tbody tr:hover{background:#f8f9fa}
.badge-active{background:#27ae60;color:white;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600}
.btn-action{padding:6px 12px;border-radius:6px;border:none;cursor:pointer;font-size:13px;margin-right:5px; text-decoration: none; display: inline-block;}
.btn-edit{background:#f39c12;color:white}
.btn-detail{background:#667eea;color:white}
.btn-delete{background:#e74c3c;color:white}
</style>
<div class="table-section">
<?php if ($success_message): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert" style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; animation: slideIn 0.3s ease-out;">
    <strong>✅ Berhasil!</strong> <?= htmlspecialchars($success_message) ?>
    <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'" aria-label="Close" style="float: right; background: transparent; border: none; font-size: 20px; cursor: pointer; opacity: 0.5;">&times;</button>
</div>
<script>
setTimeout(function() {
    var alert = document.getElementById('successAlert');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(function() { alert.style.display = 'none'; }, 500);
    }
}, 5000);
</script>
<?php endif; ?>
<?php if ($error_message): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert" style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; animation: slideIn 0.3s ease-out;">
    <strong>❌ Error!</strong> <?= htmlspecialchars($error_message) ?>
    <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'" aria-label="Close" style="float: right; background: transparent; border: none; font-size: 20px; cursor: pointer; opacity: 0.5;">&times;</button>
</div>
<script>
setTimeout(function() {
    var alert = document.getElementById('errorAlert');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(function() { alert.style.display = 'none'; }, 500);
    }
}, 7000);
</script>
<?php endif; ?>
<a href="?page=paket/create" class="btn-add">➕ Tambah Paket</a>

<table class="custom-table">
<thead>
<tr>
<th>No</th>
<th>Kode Paket</th>
<th>Nama Paket</th>
<th>Tanggal Keberangkatan</th>
<th>Hari</th>
<th>Maskapai</th>
<th>Harga Paket</th>
<th>Kuota</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php if($data){foreach($data as $k=>$r){
$tgl = $r['departure_date'] ? date('d M Y', strtotime($r['departure_date'])) : '-';
?>
<tr>
<td><?=($k+1)?></td>
<td><?=$r['package_code']?></td>
<td><strong style="color:#667eea"><?=$r['package_name']?></strong></td>
<td><?=$tgl?></td>
<td><?=$r['duration_days']?> Hari</td>
<td><?=$r['nama_maskapai']?></td>
<td>Rp <?=number_format($r['price'],0,',','.')?></td>
<td><span style="color: <?= $r['remaining_quota'] <= 5 ? 'var(--danger-color)' : 'var(--success-color)' ?>">
                                    <?= $r['remaining_quota'] ?> / <?= $r['quota'] ?> seat
                                </span></td>
<td><span class="badge-active"><?=ucfirst($r['status'])?></span></td>
<td>
<a href="?page=paket/edit&id=<?=$r['id']?>" class="btn-action btn-edit">✏️ Edit</a>
<a href="?page=paket/delete&id=<?=$r['id']?>" class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus paket <?=htmlspecialchars($r['package_name'])?>?')">🗑️ Hapus</a>
</td>
</tr>
<?php }}?>
</tbody>
</table>
</div>