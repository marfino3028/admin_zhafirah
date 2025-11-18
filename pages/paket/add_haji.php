<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$kode=$_POST['kode_paket'];
$nama=$_POST['nama_paket'];
$tanggal=$_POST['tanggal_keberangkatan'];
$hari=$_POST['jumlah_hari'];
$maskapai=$_POST['id_maskapai'];
$rute=$_POST['rute_penerbangan'];
$lokasi=$_POST['lokasi_keberangkatan'];
$kuota=$_POST['kuota_jamaah'];
$status=$_POST['status'];

// Jenis Paket 1 (Varian-1)
$jenis1=$_POST['jenis_paket1']??'';
$hotel_mekkah1=$_POST['hotel_mekkah1']??'';
$hotel_madinah1=$_POST['hotel_madinah1']??'';
$hotel_transit1=$_POST['hotel_transit1']??'';
$harga_quad1=$_POST['harga_quad1']??0;
$harga_triple1=$_POST['harga_triple1']??0;
$harga_double1=$_POST['harga_double1']??0;

// Jenis Paket 2 (Varian-2)
$jenis2=$_POST['jenis_paket2']??'';
$hotel_mekkah2=$_POST['hotel_mekkah2']??'';
$hotel_madinah2=$_POST['hotel_madinah2']??'';
$hotel_transit2=$_POST['hotel_transit2']??'';
$harga_hpp2=$_POST['harga_hpp2']??0;
$harga_quad2=$_POST['harga_quad2']??0;
$harga_triple2=$_POST['harga_triple2']??0;
$harga_double2=$_POST['harga_double2']??0;

$termasuk=$_POST['termasuk']??'';
$tidak_termasuk=$_POST['tidak_termasuk']??'';
$syarat=$_POST['syarat']??'';
$catatan=$_POST['catatan']??'';

$foto=$_FILES['foto']['name']??'';
if($foto){
$target="uploads/paket/".time()."_".$foto;
move_uploaded_file($_FILES['foto']['tmp_name'],$target);
}

$db->query("INSERT INTO tbl_paket(kode_paket,nama_paket,jenis_paket,tanggal_keberangkatan,jumlah_hari,id_maskapai,rute_penerbangan,lokasi_keberangkatan,kuota_jamaah,status,
jenis_paket1,hotel_mekkah1,hotel_madinah1,hotel_transit1,harga_quad1,harga_triple1,harga_double1,
jenis_paket2,hotel_mekkah2,hotel_madinah2,hotel_transit2,harga_hpp2,harga_quad2,harga_triple2,harga_double2,
termasuk,tidak_termasuk,syarat,catatan,foto_brosur)VALUES
('$kode','$nama','haji','$tanggal','$hari','$maskapai','$rute','$lokasi','$kuota','$status',
'$jenis1','$hotel_mekkah1','$hotel_madinah1','$hotel_transit1','$harga_quad1','$harga_triple1','$harga_double1',
'$jenis2','$hotel_mekkah2','$hotel_madinah2','$hotel_transit2','$harga_hpp2','$harga_quad2','$harga_triple2','$harga_double2',
'$termasuk','$tidak_termasuk','$syarat','$catatan','".($foto?$target:'')."')");
echo'<script>alert("Data berhasil disimpan");window.location="?mod=paket&submod=haji"</script>';
}
$maskapai_list=$db->query("SELECT*FROM tbl_maskapai ORDER BY nama_maskapai");
$hotel_list=$db->query("SELECT*FROM tbl_hotel ORDER BY nama_hotel");
?>
<style>
.form-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1);margin-bottom:20px}
.form-title{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;padding:12px 20px;border-radius:8px;font-size:16px;font-weight:600;margin-bottom:20px;text-align:center}
.form-label{font-size:14px;font-weight:600;color:#2c3e50;margin-bottom:8px;display:block}
.form-label span{color:#f39c12;font-style:italic}
.form-control,.form-select{border:1px solid #dfe4ea;border-radius:8px;padding:10px 15px;font-size:14px;width:100%;margin-bottom:15px}
textarea.form-control{min-height:100px}
.btn-back{background:#f39c12;color:white;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;margin-right:10px}
.btn-save{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:10px 30px;border-radius:8px;cursor:pointer}
.upload-area{border:2px dashed #dfe4ea;border-radius:8px;padding:30px;text-align:center;background:#f8f9fa;cursor:pointer}
</style>
<form method="POST" enctype="multipart/form-data">
<div class="row">
<div class="col-md-8">
<div class="form-section">
<div class="form-title">Data Paket Haji</div>
<div class="row">
<div class="col-md-6">
<label class="form-label">Kode Paket <span style="color:red">*</span></label>
<input type="text" name="kode_paket" class="form-control" placeholder="PH-" required>
</div>
<div class="col-md-6">
<label class="form-label">Nama Paket <span style="color:red">*</span></label>
<input type="text" name="nama_paket" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Tanggal Keberangkatan <span style="color:red">*</span></label>
<input type="date" name="tanggal_keberangkatan" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Jumlah Hari (Hari) <span style="color:red">*</span></label>
<input type="number" name="jumlah_hari" class="form-control" required>
</div>
<div class="col-md-4">
<label class="form-label">Status Paket <span style="color:red">*</span></label>
<select name="status" class="form-select" required>
<option value="active">Active</option>
<option value="inactive">Inactive</option>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Nama Maskapai <span style="color:red">*</span></label>
<select name="id_maskapai" class="form-select" required>
<option value="">Pilih Nama Maskapai</option>
<?php foreach($maskapai_list as$m){?>
<option value="<?=$m['id']?>"><?=$m['nama_maskapai']?></option>
<?php }?>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Rute Penerbangan <span style="color:red">*</span></label>
<select name="rute_penerbangan" class="form-select" required>
<option value="Direct">Direct</option>
<option value="Transit">Transit</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Lokasi Keberangkatan <span style="color:red">*</span></label>
<select name="lokasi_keberangkatan" class="form-select" required>
<option value="Jakarta">Jakarta</option>
<option value="Surabaya">Surabaya</option>
<option value="Medan">Medan</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Kuota Jamaah (Pax) <span style="color:red">*</span></label>
<input type="number" name="kuota_jamaah" class="form-control" required>
</div>
</div>
</div>

<div class="form-section">
<div class="form-title">Jenis Paket 1 <span>(Varian-1)</span> <span style="color:red">*</span></div>
<div class="row">
<div class="col-md-12">
<label class="form-label">Jenis Paket 1 <span>(Varian-1)</span></label>
<input type="text" name="jenis_paket1" class="form-control">
</div>
<div class="col-md-4">
<label class="form-label">Nama Hotel Mekkah <span>(Varian-1)</span> <span style="color:red">*</span></label>
<select name="hotel_mekkah1" class="form-select">
<option value="">Pilih Hotel Mekkah</option>
<?php foreach($hotel_list as$h){?>
<option value="<?=$h['id']?>"><?=$h['nama_hotel']?></option>
<?php }?>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Nama Hotel Madinah <span>(Varian-1)</span> <span style="color:red">*</span></label>
<select name="hotel_madinah1" class="form-select">
<option value="">Pilih Hotel Madinah</option>
<?php foreach($hotel_list as$h){?>
<option value="<?=$h['id']?>"><?=$h['nama_hotel']?></option>
<?php }?>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Nama Hotel Transit <span>(Varian-1)</span></label>
<select name="hotel_transit1" class="form-select">
<option value="">Pilih Hotel Transit</option>
<?php foreach($hotel_list as$h){?>
<option value="<?=$h['id']?>"><?=$h['nama_hotel']?></option>
<?php }?>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Harga Paket (Quad) <span>(Varian-1)</span> <span style="color:red">*</span></label>
<input type="number" name="harga_quad1" class="form-control">
</div>
<div class="col-md-4">
<label class="form-label">Harga Triple <span>(Varian-1)</span> <span style="color:red">*</span></label>
<input type="number" name="harga_triple1" class="form-control">
</div>
<div class="col-md-4">
<label class="form-label">Harga Double <span>(Varian-1)</span> <span style="color:red">*</span></label>
<input type="number" name="harga_double1" class="form-control">
</div>
</div>
</div>

<div class="form-section">
<div class="form-title">Jenis Paket 2 <span>(Varian-2)</span></div>
<div class="row">
<div class="col-md-12">
<label class="form-label">Jenis Paket 2 <span>(Varian-2)</span></label>
<input type="text" name="jenis_paket2" class="form-control">
</div>
<div class="col-md-4">
<label class="form-label">Nama Hotel Mekkah <span>(Varian-2)</span></label>
<select name="hotel_mekkah2" class="form-select">
<option value="">Pilih Hotel Mekkah</option>
<?php foreach($hotel_list as$h){?>
<option value="<?=$h['id']?>"><?=$h['nama_hotel']?></option>
<?php }?>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Nama Hotel Madinah <span>(Varian-2)</span></label>
<select name="hotel_madinah2" class="form-select">
<option value="">Pilih Hotel Madinah</option>
<?php foreach($hotel_list as$h){?>
<option value="<?=$h['id']?>"><?=$h['nama_hotel']?></option>
<?php }?>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Nama Hotel Transit <span>(Varian-2)</span></label>
<select name="hotel_transit2" class="form-select">
<option value="">Pilih Hotel Transit</option>
<?php foreach($hotel_list as$h){?>
<option value="<?=$h['id']?>"><?=$h['nama_hotel']?></option>
<?php }?>
</select>
</div>
<div class="col-md-3">
<label class="form-label">Harga HPP Paket <span>(Varian-2)</span></label>
<input type="number" name="harga_hpp2" class="form-control">
</div>
<div class="col-md-3">
<label class="form-label">Harga Paket (Quad) <span>(Varian-2)</span></label>
<input type="number" name="harga_quad2" class="form-control">
</div>
<div class="col-md-3">
<label class="form-label">Harga Triple <span>(Varian-2)</span></label>
<input type="number" name="harga_triple2" class="form-control">
</div>
<div class="col-md-3">
<label class="form-label">Harga Double <span>(Varian-2)</span></label>
<input type="number" name="harga_double2" class="form-control">
</div>
</div>
</div>

<div class="form-section">
<label class="form-label">Termasuk Paket <span>(Include)</span></label>
<textarea name="termasuk" class="form-control"></textarea>
</div>

<div class="form-section">
<label class="form-label">Tidak Termasuk Paket <span>(Exclude)</span></label>
<textarea name="tidak_termasuk" class="form-control"></textarea>
</div>

<div class="form-section">
<label class="form-label">Syarat dan Ketentuan <span>(Term & Condition)</span></label>
<textarea name="syarat" class="form-control"></textarea>
</div>

<div class="form-section">
<label class="form-label">Catatan Paket <span>(Notes)</span></label>
<textarea name="catatan" class="form-control"></textarea>
</div>
</div>

<div class="col-md-4">
<div class="form-section">
<div class="form-title">Foto Paket Haji ℹ️</div>
<div class="upload-area" onclick="document.getElementById('foto').click()">
<div style="font-size:50px;color:#667eea">☁️⬆️</div>
<p style="color:#7f8c8d">Klik untuk upload</p>
<input type="file" id="foto" name="foto" style="display:none" accept="image/*">
</div>
</div>
</div>
</div>

<div style="margin-top:20px;text-align:center">
<button type="button" onclick="history.back()" class="btn-back">⬅ Kembali</button>
<button type="submit" class="btn-save">💾 Tambah Paket Haji</button>
</div>
</form>
