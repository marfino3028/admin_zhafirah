<?php
// Mengambil data paket haji dari tabel 'packages'
$data=$db->query("SELECT p.*, m.name as nama_maskapai FROM packages p LEFT JOIN airlines m ON p.airline_id=m.id WHERE p.package_type='haji' ORDER BY p.departure_date DESC");
?>
<style>
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:12px 25px;border-radius:8px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .3s;margin-bottom:20px}
.table-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.custom-table{width:100%;border-collapse:collapse}
.custom-table thead th{background:#f8f9fa;padding:15px 10px;text-align:left;font-size:13px;font-weight:600;color:#2c3e50;border-bottom:2px solid #dee2e6}
.custom-table tbody td{padding:15px 10px;border-bottom:1px solid #ecf0f1;font-size:14px;color:#2c3e50}
.custom-table tbody tr:hover{background:#f8f9fa}
.badge-active{background:#27ae60;color:white;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600}
</style>
<div class="table-section">
<a href="?mod=paket&submod=add_haji" class="btn-add">➕ Tambah Keberangkatan Haji</a>
<div style="margin-bottom:15px">
<label>Show <select style="padding:5px;border:1px solid #ddd;border-radius:5px"><option>10</option></select> entries</label>
<div style="float:right;display:flex;gap:10px">
<button class="btn-action btn-detail">📄 Excel</button>
<button class="btn-action btn-edit">🖨️ Print</button>
<button class="btn-action btn-delete">🔄 Reset</button>
<button class="btn-action btn-detail">🔃 Reload</button>
</div>
</div>
<div style="margin-bottom:15px;float:right"><label>Search: <input type="text" style="padding:5px;border:1px solid #ddd;border-radius:5px"></label></div>
<table class="custom-table">
<thead>
<tr>
<th>No</th>
<th>Kode Paket</th>
<th>Nama Paket</th>
<th>Tanggal Keberangkatan</th>
<th>Jumlah Hari</th>
<th>Nama Maskapai</th>
<th>Rute Penerbangan</th>
<th>Lokasi Keberangkatan</th>
<th>Kuota Jamaah</th>
<th>Kuota Terisi</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php if($data){foreach($data as $k=>$r){
$tgl=date('d M Y',strtotime($r['departure_date']));
// Menghitung jamaah yang sudah booking dari tabel 'bookings'
$terisi=$db->query("SELECT COUNT(*) as total FROM bookings WHERE package_id='{$r['id']}' AND status NOT IN ('cancelled', 'refunded')");
?>
<tr>
<td><?=($k+1)?></td>
<td><?=$r['package_code']?></td>
<td><strong style="color:#667eea"><?=$r['name']?></strong></td>
<td><?=$tgl?></td>
<td><?=$r['days']?> Hari</td>
<td><?=$r['nama_maskapai']?></td>
<td><?=$r['flight_route']?></td>
<td><?=$r['departure_location']?></td>
<td><?=$r['quota']?> Pax</td>
<td><?=$terisi[0]['total']?> Pax</td>
<td><span class="badge-active"><?=ucfirst($r['status'])?></span></td>
</tr>
<?php }}?>
</tbody>
</table>
</div>
