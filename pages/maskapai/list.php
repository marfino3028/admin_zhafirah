<?php
$data=$db->query("SELECT*FROM tbl_maskapai ORDER BY nama_maskapai ASC");
?>
<style>
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:12px 25px;border-radius:8px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .3s;margin-bottom:20px}
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
<div class="table-section">
    <a href="?mod=maskapai&submod=add" class="btn-add">➕ Tambah Data Maskapai</a>
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
                <th>Kode Maskapai</th>
                <th>Nama Maskapai</th>
                <th>Rute Penerbangan</th>
                <th>Lama Perjalanan</th>
                <th>Harga Tiket</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($data){foreach($data as $k=>$r){?>
            <tr>
                <td><?=($k+1)?></td>
                <td><?=$r['kode_maskapai']?></td>
                <td><?=$r['nama_maskapai']?></td>
                <td><?=$r['rute_penerbangan']?></td>
                <td><?=$r['lama_perjalanan']?></td>
                <td>Rp <?=number_format($r['harga_tiket'],0,',','.')?></td>
                <td>
                    <button class="btn-action btn-edit">✏️</button>
                    <button class="btn-action btn-detail">👁️</button>
                    <button class="btn-action btn-delete">🗑️</button>
                </td>
            </tr>
            <?php }}?>
        </tbody>
    </table>
    <div style="margin-top:15px;display:flex;justify-content:space-between">
        <p>Showing 1 to <?=count($data)?> of <?=count($data)?> entries</p>
        <div>
            <button style="padding:8px 15px;margin:0 3px">Previous</button>
            <button style="padding:8px 15px;margin:0 3px;background:#667eea;color:white;border:none">1</button>
            <button style="padding:8px 15px;margin:0 3px">Next</button>
        </div>
    </div>
</div>
