<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    // Ambil data dari form
    $kode = $_POST['kode_jamaah'];
    $nik = $_POST['nik'];
    $nama_ktp = $_POST['nama_ktp'];
    $full_name = $_POST['nama_ktp']; // sama dengan nama KTP
    $kontak = $_POST['kontak'];
    $email = $_POST['email'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? $_POST['kontak']; // default dari kontak
    $kota = $_POST['kota_kabupaten'] ?? '';
    $jk = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'] ?? '';
    $tgl_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'] ?? '';
    $catatan = $_POST['catatan'] ?? '';
    
    // Data paspor (opsional)
    $nama_paspor = $_POST['nama_paspor'] ?? '';
    $nomor_paspor = $_POST['nomor_paspor'] ?? '';
    $tgl_berlaku_paspor = $_POST['tanggal_berlaku_paspor'] ?? null;
    $tgl_kadaluarsa_paspor = $_POST['tanggal_kadaluarsa_paspor'] ?? null;
    
    // Handle upload foto
    $foto = $_FILES['foto']['name'] ?? '';
    $target = '';
    if($foto){
        // Buat folder jika belum ada
        $upload_dir = "uploads/jamaah/";
        if(!is_dir($upload_dir)){
            mkdir($upload_dir, 0777, true);
        }
        $target = $upload_dir . time() . "_" . $foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $target);
    }
    
    // Generate password default (bisa nik atau nomor kontak)
    $default_password = password_hash($nik, PASSWORD_DEFAULT);
    
    // Set role dan status
    $role = 'jamaah';
    $status = 'active';
    
    // Escape string untuk keamanan
    $kode = $db->real_escape_string($kode);
    $nik = $db->real_escape_string($nik);
    $nama_ktp = $db->real_escape_string($nama_ktp);
    $full_name = $db->real_escape_string($full_name);
    $kontak = $db->real_escape_string($kontak);
    $email = $db->real_escape_string($email);
    $whatsapp = $db->real_escape_string($whatsapp);
    $kota = $db->real_escape_string($kota);
    $jk = $db->real_escape_string($jk);
    $tempat_lahir = $db->real_escape_string($tempat_lahir);
    $tgl_lahir = $db->real_escape_string($tgl_lahir);
    $alamat = $db->real_escape_string($alamat);
    $catatan = $db->real_escape_string($catatan);
    $nama_paspor = $db->real_escape_string($nama_paspor);
    $nomor_paspor = $db->real_escape_string($nomor_paspor);
    $target = $db->real_escape_string($target);
    
    // Query insert ke tabel users
    $result = $db->query("
        INSERT INTO users (
            full_name,
            email,
            whatsapp,
            password,
            role,
            status,
            kode_registrasi,
            nik,
            nama_jamaah,
            telepon,
            kota_kabupaten,
            jenis_kelamin,
            tempat_lahir,
            tanggal_lahir,
            alamat,
            catatan,
            foto,
            nama_paspor,
            nomor_paspor,
            tanggal_berlaku_paspor,
            tanggal_kadaluarsa_paspor,
            created_at,
            updated_at
        ) VALUES (
            '$full_name',
            '$email',
            '$whatsapp',
            '$default_password',
            '$role',
            '$status',
            '$kode',
            '$nik',
            '$nama_ktp',
            '$kontak',
            '$kota',
            '$jk',
            '$tempat_lahir',
            '$tgl_lahir',
            '$alamat',
            '$catatan',
            '$target',
            '$nama_paspor',
            '$nomor_paspor',
            " . ($tgl_berlaku_paspor ? "'$tgl_berlaku_paspor'" : "NULL") . ",
            " . ($tgl_kadaluarsa_paspor ? "'$tgl_kadaluarsa_paspor'" : "NULL") . ",
            NOW(),
            NOW()
        )
    ");
    
    if($result){
        echo '<script>alert("Data jamaah berhasil ditambahkan!");window.location="?mod=jamaah&submod=list"</script>';
    } else {
        $error = $db->error ?? 'Unknown error';
        echo '<script>alert("Gagal menyimpan data: ' . $error . '");history.back()</script>';
    }
}

// Ambil daftar paket dari tabel packages (dari portal jamaah)
$packages = $db->query("
    SELECT 
        id, 
        package_code, 
        package_name, 
        package_type,
        price,
        departure_date,
        quota,
        remaining_quota,
        status
    FROM packages 
    WHERE status = 'active' 
    ORDER BY departure_date ASC
");
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
.info-box{background:#e3f2fd;border-left:4px solid #2196f3;padding:15px;margin-bottom:20px;border-radius:5px}
.info-box strong{color:#1976d2}
</style>
<div class="row">
<div class="col-md-8">
<div class="form-section">
<div class="form-title">Data Pribadi Jamaah</div>
<form method="POST" enctype="multipart/form-data">
<div class="row">
<div class="col-md-12">
<label class="form-label">Kode Jamaah <span style="color:red">*</span></label>
<input type="text" name="kode_jamaah" class="form-control" placeholder="Contoh: J-001, JMH-2024-001" required>
<small style="color:#7f8c8d">Kode unik untuk identifikasi jamaah</small>
</div>
<div class="col-md-6">
<label class="form-label">NIK Jamaah <span style="color:red">*</span></label>
<input type="text" name="nik" class="form-control" maxlength="16" pattern="[0-9]{16}" required>
<small style="color:#7f8c8d">16 digit NIK sesuai KTP</small>
</div>
<div class="col-md-6">
<label class="form-label">Nama Jamaah (KTP) <span style="color:red">*</span></label>
<input type="text" name="nama_ktp" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Nomor Telepon/HP <span style="color:red">*</span></label>
<input type="text" name="kontak" class="form-control" placeholder="08xxxxxxxxxx" required>
</div>
<div class="col-md-6">
<label class="form-label">WhatsApp</label>
<input type="text" name="whatsapp" class="form-control" placeholder="08xxxxxxxxxx">
<small style="color:#7f8c8d">Kosongkan jika sama dengan nomor telepon</small>
</div>
<div class="col-md-12">
<label class="form-label">Email Jamaah <span style="color:red">*</span></label>
<input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
<small style="color:#7f8c8d">Email untuk login dan notifikasi</small>
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
<textarea name="catatan" class="form-control" placeholder="Catatan khusus mengenai jamaah (kondisi kesehatan, kebutuhan khusus, dll)"></textarea>
</div>
<div class="col-md-12" style="margin-top:20px;padding:15px;background:#e3f2fd;border-radius:8px">
<h5 style="margin-top:0;color:#1976d2">📋 Data Paspor (Opsional)</h5>
<div class="row">
<div class="col-md-6">
<label class="form-label">Nama Sesuai Paspor</label>
<input type="text" name="nama_paspor" class="form-control" placeholder="Nama lengkap sesuai paspor">
</div>
<div class="col-md-6">
<label class="form-label">Nomor Paspor</label>
<input type="text" name="nomor_paspor" class="form-control" placeholder="Contoh: A1234567">
</div>
<div class="col-md-6">
<label class="form-label">Tanggal Berlaku Paspor</label>
<input type="date" name="tanggal_berlaku_paspor" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Tanggal Kadaluarsa Paspor</label>
<input type="date" name="tanggal_kadaluarsa_paspor" class="form-control">
</div>
</div>
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
<p style="color:#95a5a6;font-size:12px;margin:5px 0 0 0">Format: JPG, PNG (Max 2MB)</p>
<input type="file" id="foto" name="foto" style="display:none" accept="image/*" onchange="previewImage(this)">
</div>
<div id="preview" style="margin-top:15px;text-align:center"></div>
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" style="max-width:100%;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1)">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</div>

<!-- Info Paket dari Portal Jamaah -->
<?php if($packages && count($packages) > 0): ?>
<div class="form-section" style="margin-top:20px">
<div class="form-title">📦 Paket Tersedia</div>
<div class="info-box">
<strong>Info:</strong> Setelah jamaah ditambahkan, Anda dapat mendaftarkan jamaah ke paket melalui menu <strong>Pendaftaran > Umroh/Haji</strong>
</div>
<div style="max-height:300px;overflow-y:auto">
<?php foreach($packages as $pkg): ?>
<div style="background:#f8f9fa;padding:10px;margin-bottom:10px;border-radius:5px;border-left:3px solid #667eea">
<div style="font-weight:600;color:#2c3e50"><?=$pkg['package_code']?> - <?=$pkg['package_name']?></div>
<div style="font-size:12px;color:#7f8c8d;margin-top:5px">
<div>Tipe: <?=ucfirst($pkg['package_type'])?></div>
<div>Keberangkatan: <?=date('d M Y', strtotime($pkg['departure_date']))?></div>
<div>Harga: Rp <?=number_format($pkg['price'],0,',','.')?></div>
<div>Kuota Tersisa: <?=$pkg['remaining_quota']?>/<?=$pkg['quota']?></div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<?php endif; ?>
</div>
</div>
