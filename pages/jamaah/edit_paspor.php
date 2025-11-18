<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$id_jamaah=$_POST['id_jamaah']??0;
// Process photo uploads
$foto_ktp=$_FILES['foto_ktp']['name']??'';
$foto_kk=$_FILES['foto_kk']['name']??'';
$foto_paspor1=$_FILES['foto_paspor1']['name']??'';
$foto_paspor2=$_FILES['foto_paspor2']['name']??'';
if($foto_ktp){$target_ktp="uploads/jamaah/ktp_".time()."_".$foto_ktp;move_uploaded_file($_FILES['foto_ktp']['tmp_name'],$target_ktp);$db->query("UPDATE tbl_pendaftaran_jamaah SET foto_ktp='$target_ktp' WHERE id='$id_jamaah'");}
if($foto_kk){$target_kk="uploads/jamaah/kk_".time()."_".$foto_kk;move_uploaded_file($_FILES['foto_kk']['tmp_name'],$target_kk);$db->query("UPDATE tbl_pendaftaran_jamaah SET foto_kk='$target_kk' WHERE id='$id_jamaah'");}
if($foto_paspor1){$target_p1="uploads/jamaah/paspor1_".time()."_".$foto_paspor1;move_uploaded_file($_FILES['foto_paspor1']['tmp_name'],$target_p1);$db->query("UPDATE tbl_pendaftaran_jamaah SET foto_paspor1='$target_p1' WHERE id='$id_jamaah'");}
if($foto_paspor2){$target_p2="uploads/jamaah/paspor2_".time()."_".$foto_paspor2;move_uploaded_file($_FILES['foto_paspor2']['tmp_name'],$target_p2);$db->query("UPDATE tbl_pendaftaran_jamaah SET foto_paspor2='$target_p2' WHERE id='$id_jamaah'");}
// Update passport data
$nama_paspor=$_POST['nama_paspor']??'';
$nomor_paspor=$_POST['nomor_paspor']??'';
$kantor_imigrasi=$_POST['kantor_imigrasi']??'';
$paspor_aktif=$_POST['paspor_aktif']??'';
$paspor_expired=$_POST['paspor_expired']??'';
$db->query("UPDATE tbl_pendaftaran_jamaah SET nama_paspor='$nama_paspor',nomor_paspor='$nomor_paspor',kantor_imigrasi='$kantor_imigrasi',paspor_aktif='$paspor_aktif',habis_paspor='$paspor_expired' WHERE id='$id_jamaah'");
echo'<script>alert("Data berhasil disimpan");history.back()</script>';
}
$id=$_GET['id']??0;
$jamaah=$db->query("SELECT*FROM tbl_pendaftaran_jamaah WHERE id='$id'");
$j=$jamaah[0]??[];
?>
<style>
.form-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1);margin-bottom:20px}
.form-title{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;padding:12px 20px;border-radius:8px;font-size:16px;font-weight:600;margin-bottom:20px;text-align:center}
.form-label{font-size:14px;font-weight:600;color:#2c3e50;margin-bottom:8px;display:block}
.form-control,.form-select{border:1px solid #dfe4ea;border-radius:8px;padding:10px 15px;font-size:14px;width:100%;margin-bottom:15px}
.btn-back{background:#f39c12;color:white;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;margin-right:10px}
.btn-save{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:10px 30px;border-radius:8px;cursor:pointer}
.upload-box{border:2px dashed #dfe4ea;border-radius:8px;padding:40px 20px;text-align:center;background:#f8f9fa;cursor:pointer;margin-bottom:15px}
.upload-icon{font-size:50px;color:#667eea;margin-bottom:10px}
.upload-text{color:#7f8c8d;font-size:14px;margin:0}
</style>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="id_jamaah" value="<?=$id?>">
<div class="row">
<div class="col-md-8">
<div class="form-section">
<div class="form-title">Data Paspor Jamaah</div>
<div class="row">
<div class="col-md-4">
<label class="form-label">Nama Jamaah (PASPOR)</label>
<input type="text" name="nama_paspor" class="form-control" value="<?=$j['nama_paspor']?>">
</div>
<div class="col-md-4">
<label class="form-label">Nomor Paspor</label>
<input type="text" name="nomor_paspor" class="form-control" value="<?=$j['nomor_paspor']?>">
</div>
<div class="col-md-4">
<label class="form-label">Kantor Imigrasi (Penerbit)</label>
<input type="text" name="kantor_imigrasi" class="form-control" value="<?=$j['kantor_imigrasi']?>">
</div>
<div class="col-md-6">
<label class="form-label">Paspor Aktif</label>
<input type="date" name="paspor_aktif" class="form-control" value="<?=$j['paspor_aktif']?>">
</div>
<div class="col-md-6">
<label class="form-label">Paspor Expired</label>
<input type="date" name="paspor_expired" class="form-control" value="<?=$j['habis_paspor']?>">
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-section">
<div class="form-title">Foto KTP Jamaah ℹ️</div>
<div class="upload-box" onclick="document.getElementById('foto_ktp').click()">
<div class="upload-icon">☁️⬆️</div>
<p class="upload-text">Klik untuk upload</p>
<input type="file" id="foto_ktp" name="foto_ktp" style="display:none" accept="image/*">
</div>
</div>
<div class="form-section">
<div class="form-title">Foto KK Jamaah ℹ️</div>
<div class="upload-box" onclick="document.getElementById('foto_kk').click()">
<div class="upload-icon">☁️⬆️</div>
<p class="upload-text">Klik untuk upload</p>
<input type="file" id="foto_kk" name="foto_kk" style="display:none" accept="image/*">
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-section">
<div class="form-title">Foto Paspor 1 Jamaah ℹ️</div>
<div class="upload-box" onclick="document.getElementById('foto_paspor1').click()">
<div class="upload-icon">☁️⬆️</div>
<p class="upload-text">Klik untuk upload</p>
<input type="file" id="foto_paspor1" name="foto_paspor1" style="display:none" accept="image/*">
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-section">
<div class="form-title">Foto Paspor 2 Jamaah ℹ️</div>
<div class="upload-box" onclick="document.getElementById('foto_paspor2').click()">
<div class="upload-icon">☁️⬆️</div>
<p class="upload-text">Klik untuk upload</p>
<input type="file" id="foto_paspor2" name="foto_paspor2" style="display:none" accept="image/*">
</div>
</div>
</div>
</div>
<div style="margin-top:20px;text-align:center">
<button type="button" onclick="history.back()" class="btn-back">⬅ Kembali</button>
<button type="submit" class="btn-save">💾 Tambah Jamaah</button>
</div>
</form>
