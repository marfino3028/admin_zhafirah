<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$kode=$_POST['kode_jamaah'];
$nik=$_POST['nik'];
$nama_ktp=$_POST['nama_ktp'];
$kontak=$_POST['kontak'];
$email=$_POST['email']??'';
$kota=$_POST['kota_kabupaten'];
$jk=$_POST['jenis_kelamin'];
$tempat_lahir=$_POST['tempat_lahir'];
$tgl_lahir=$_POST['tanggal_lahir'];
$alamat=$_POST['alamat']??'';
$catatan=$_POST['catatan']??'';
$foto=$_FILES['foto']['name']??'';
if($foto){
$target="uploads/jamaah/".time()."_".$foto;
move_uploaded_file($_FILES['foto']['tmp_name'],$target);
}
$db->query("INSERT INTO tbl_pendaftaran_jamaah(kode_registrasi,nik,nama_jamaah,telepon,email,kota_kabupaten,jenis_kelamin,tanggal_lahir,alamat,foto)VALUES('$kode','$nik','$nama_ktp','$kontak','$email','$kota','$jk','$tgl_lahir','$alamat','".($foto?$target:'')."')");
echo'<script>alert("Data berhasil disimpan");window.location="?mod=jamaah&submod=list"</script>';
}
?>
<style>
.form-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.form-title{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;padding:12px 20px;border-radius:8px;font-size:16px;font-weight:600;margin-bottom:20px;text-align:center}
.form-label{font-size:14px;font-weight:600;color:#2c3e50;margin-bottom:8px;display:block}
.form-control,.form-select{border:1px solid #dfe4ea;border-radius:8px;padding:10px 15px;font-size:14px;width:100%;margin-bottom:15px}
textarea.form-control{min-height:80px}
.btn-back{background:#f39c12;color:white;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;margin-right:10px}
.btn-save{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:10px 30px;border-radius:8px;cursor:pointer}
.upload-area{border:2px dashed #dfe4ea;border-radius:8px;padding:30px;text-align:center;background:#f8f9fa;cursor:pointer}
.upload-icon{font-size:40px;color:#667eea;margin-bottom:10px}
</style>
<div class="row">
<div class="col-md-8">
<div class="form-section">
<div class="form-title">Data Pribadi Jamaah</div>
<form method="POST" enctype="multipart/form-data">
<div class="row">
<div class="col-md-12">
<label class="form-label">Kode Jamaah <span style="color:red">*</span></label>
<input type="text" name="kode_jamaah" class="form-control" placeholder="J-" required>
</div>
<div class="col-md-6">
<label class="form-label">NIK Jamaah <span style="color:red">*</span></label>
<input type="text" name="nik" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Nama Jamaah (KTP) <span style="color:red">*</span></label>
<input type="text" name="nama_ktp" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Kontak Jamaah <span style="color:red">*</span></label>
<input type="text" name="kontak" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Email Jamaah</label>
<input type="email" name="email" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Kota / Kabupaten</label>
<input type="text" name="kota_kabupaten" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Jenis Kelamin <span style="color:red">*</span></label>
<select name="jenis_kelamin" class="form-select" required>
<option value="">Pilih Jenis Kelamin</option>
<option value="Laki-Laki">Laki-Laki</option>
<option value="Perempuan">Perempuan</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Tempat Lahir</label>
<input type="text" name="tempat_lahir" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Tanggal Lahir <span style="color:red">*</span></label>
<input type="date" name="tanggal_lahir" class="form-control" required>
</div>
<div class="col-md-12">
<label class="form-label">Alamat Jamaah</label>
<textarea name="alamat" class="form-control"></textarea>
</div>
<div class="col-md-12">
<label class="form-label">Catatan Jamaah</label>
<textarea name="catatan" class="form-control"></textarea>
</div>
</div>
<div style="margin-top:20px">
<button type="button" onclick="history.back()" class="btn-back">⬅ Kembali</button>
<button type="submit" class="btn-save">💾 Tambah Jamaah</button>
</div>
</form>
</div>
</div>
<div class="col-md-4">
<div class="form-section">
<div class="form-title">Foto Jamaah ℹ️</div>
<div class="upload-area" onclick="document.getElementById('foto').click()">
<div class="upload-icon">☁️⬆️</div>
<p style="color:#7f8c8d;margin:0">Klik untuk upload foto</p>
<input type="file" id="foto" name="foto" style="display:none" accept="image/*">
</div>
</div>
</div>
</div>
