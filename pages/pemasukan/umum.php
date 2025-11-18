<?php
$where="WHERE 1=1";
if(isset($_POST['bulan'])&&$_POST['bulan']!=''){
$bulan=$_POST['bulan'];
$where.=" AND DATE_FORMAT(tanggal_pemasukan,'%Y-%m')='$bulan'";
}
$total=$db->query("SELECT COALESCE(SUM(jumlah_pemasukan),0)as total FROM tbl_pemasukan_umum $where");
$data=$db->query("SELECT*FROM tbl_pemasukan_umum $where ORDER BY tanggal_pemasukan DESC");
?>
<style>
.filter-section{background:white;border-radius:10px;padding:25px;margin-bottom:20px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.filter-title{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;padding:12px 20px;border-radius:8px;font-size:16px;font-weight:600;margin-bottom:20px;text-align:center}
.form-label{font-size:14px;font-weight:600;color:#2c3e50;margin-bottom:8px}
.form-control{border:1px solid #dfe4ea;border-radius:8px;padding:10px 15px;font-size:14px;width:100%}
.btn-search{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:10px 30px;border-radius:8px;font-weight:600;cursor:pointer;transition:all .3s}
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:12px 25px;border-radius:8px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .3s;margin-bottom:20px}
.stat-card{background:linear-gradient(135deg,#11998e 0%,#38ef7d 100%);border-radius:10px;padding:25px;color:white;margin-bottom:20px;box-shadow:0 5px 15px rgba(17,153,142,.3)}
.stat-icon{font-size:40px;margin-bottom:10px}
.stat-amount{font-size:32px;font-weight:700;margin:10px 0 5px}
.stat-label{font-size:14px;font-weight:600;text-transform:uppercase;opacity:.9}
.table-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.custom-table{width:100%;border-collapse:collapse}
.custom-table thead th{background:#f8f9fa;padding:15px 10px;text-align:left;font-size:13px;font-weight:600;color:#2c3e50;border-bottom:2px solid #dee2e6}
.custom-table tbody td{padding:15px 10px;border-bottom:1px solid #ecf0f1;font-size:14px;color:#2c3e50}
.custom-table tbody tr:hover{background:#f8f9fa}
.btn-action{padding:6px 12px;border-radius:6px;border:none;cursor:pointer;font-size:13px;margin-right:5px}
.btn-edit{background:#f39c12;color:white}
.btn-detail{background:#667eea;color:white}
.btn-delete{background:#95a5a6;color:white}
</style>
<div class="row">
<div class="col-md-8">
<div class="filter-section">
<div class="filter-title">Filter Periode Bulanan</div>
<form method="POST">
<div class="form-group">
<label class="form-label">Pilih Periode Bulanan</label>
<input type="month" name="bulan" class="form-control" value="<?=isset($_POST['bulan'])?$_POST['bulan']:''?>">
</div>
<button type="submit" class="btn-search">🔍 Cari</button>
</form>
</div>
<div class="table-section">
<a href="?mod=pemasukan&submod=add" class="btn-add">➕ Tambah Pemasukan Umum</a>
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
<th>Tanggal Pemasukan</th>
<th>Kode Pemasukan</th>
<th>Jenis Pemasukan</th>
<th>Nama Pemasukan</th>
<th>Jumlah Pemasukan</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php if($data){foreach($data as $k=>$r){
$tgl=date('d M Y',strtotime($r['tanggal_pemasukan']));
?>
<tr>
<td><?=($k+1)?></td>
<td><?=$tgl?></td>
<td><?=$r['kode_pemasukan']?></td>
<td><?=ucfirst($r['jenis_pemasukan'])?></td>
<td><?=$r['nama_pemasukan']?></td>
<td>Rp <?=number_format($r['jumlah_pemasukan'],0,',','.')?></td>
<td>
<button class="btn-action btn-edit">✏️</button>
<button class="btn-action btn-detail">👁️</button>
<button class="btn-action btn-delete">🗑️</button>
</td>
</tr>
<?php }}else{echo'<tr><td colspan="7" style="text-align:center">Tidak ada data</td></tr>';}?>
</tbody>
</table>
<div style="margin-top:15px"><p>Showing 1 to <?=count($data)?> of <?=count($data)?> entries</p></div>
</div>
</div>
<div class="col-md-4">
<div class="stat-card">
<div class="stat-icon">💰</div>
<div class="stat-amount">Rp <?=number_format($total[0]['total'],0,',','.')?></div>
<div class="stat-label">Total Pemasukan Umum</div>
</div>
</div>
</div>
