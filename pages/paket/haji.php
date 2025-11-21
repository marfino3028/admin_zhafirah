<?php
// Mengambil data paket haji dari tabel 'packages'
$data=$db->query("SELECT p.*, m.name as nama_maskapai FROM packages p LEFT JOIN tbl_maskapai m ON p.airline_id = m.id WHERE p.package_type='haji' ORDER BY p.name ASC");
?>
<style>
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
<a href="?mod=paket&submod=add_haji" class="btn-add">➕ Tambah Paket Haji</a>

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
<td><strong style="color:#667eea"><?=$r['name']?></strong></td>
<td><?=$tgl?></td>
<td><?=$r['days']?> Hari</td>
<td><?=$r['nama_maskapai']?></td>
<td>Rp <?=number_format($r['price'],0,',','.')?></td>
<td><?=$r['quota']?> Pax</td>
<td><span class="badge-active"><?=ucfirst($r['status'])?></span></td>
<td>
<a href="?mod=paket&submod=edit&id=<?=$r['id']?>" class="btn-action btn-edit">✏️</a>
<a href="?mod=paket&submod=delete&id=<?=$r['id']?>" class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">🗑️</a>
</td>
</tr>
<?php }}?>
</tbody>
</table>
</div>