<?php
// Bagian ini akan di-include oleh index.php, jadi koneksi database sudah ada.
// session_start() juga sudah ada di index.php.

$success_message = '';
$error_message = '';

// Ambil data maskapai untuk dropdown (fetchAll agar bisa di-foreach)
$airlinesStmt = $db->query("SELECT id, name FROM airlines ORDER BY name ASC");
$airlines = $airlinesStmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Ambil & sanitize input
        $package_type = isset($_POST['package_type']) ? trim($_POST['package_type']) : 'umroh';
        $package_code = isset($_POST['package_code']) && trim($_POST['package_code']) !== '' 
                        ? trim($_POST['package_code']) 
                        : 'PK-'.strtoupper(uniqid());
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $departure_date = trim($_POST['departure_date'] ?? '');
        $days = (int)($_POST['days'] ?? 0);
        $airline_id = ($_POST['airline_id'] ?? '') !== '' ? (int)$_POST['airline_id'] : null;
        $flight_route = trim($_POST['flight_route'] ?? '');
        $departure_location = trim($_POST['departure_location'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $quota = (int)($_POST['quota'] ?? 0);
        $status = trim($_POST['status'] ?? 'active');

        // Validasi dasar
        if ($name === '' || $departure_date === '' || $price <= 0 || $quota <= 0) {
            throw new Exception("Nama paket, tanggal keberangkatan, harga, dan kuota wajib diisi dan valid.");
        }

        // validasi tanggal sederhana (YYYY-MM-DD)
        $d = DateTime::createFromFormat('Y-m-d', $departure_date);
        if (!$d || $d->format('Y-m-d') !== $departure_date) {
            throw new Exception("Format tanggal keberangkatan tidak valid. Gunakan YYYY-MM-DD.");
        }

        // --- Siapkan data untuk insert (named placeholders) ---
        $data = [
            'package_type' => $package_type,
            'package_code' => $package_code,
            'name' => $name,
            'description' => $description,
            'departure_date' => $departure_date,
            'days' => $days,
            'airline_id' => $airline_id,
            'flight_route' => $flight_route,
            'departure_location' => $departure_location,
            'price' => $price,
            'quota' => $quota,
            'status' => $status,
            // jika ingin menambahkan brochure_url nanti, tambahkan $data['brochure_url'] = $url;
        ];

        // Hapus key yang nilainya null agar query tidak memasukkan kolom dengan NULL jika tidak diinginkan
        // (opsional — tergantung struktur tabel)
        // foreach ($data as $k => $v) { if ($v === null) unset($data[$k]); }

        // Bangun query dinamis
        $columns = array_keys($data); // ['package_type', 'package_code', ...]
        $placeholders = array_map(function($c){ return ':' . $c; }, $columns);

        $sql = "INSERT INTO packages (" . implode(', ', $columns) . ", created_at)
                VALUES (" . implode(', ', $placeholders) . ", NOW())";

        // Convert params ke format :key => value
        $bindParams = [];
        foreach ($data as $col => $val) {
            $bindParams[':' . $col] = $val;
        }

        // Execute dalam transaction
        $db->beginTransaction();
        $stmt = $db->prepare($sql);
        $stmt->execute($bindParams);
        $db->commit();

        $success_message = "Data paket berhasil ditambahkan!";

        // Redirect (jika mau langsung ke halaman list umroh)
        header("Location: /default.php?page=paket/umroh");
        exit;

    } catch (Throwable $t) {
        // rollback bila perlu
        if (isset($db) && $db->inTransaction()) {
            $db->rollBack();
        }
        // Log lengkap untuk dev, tampilkan pesan singkat ke user
        error_log("Paket save error: " . $t->getMessage() . " in " . $t->getFile() . ":" . $t->getLine());
        $error_message = "Terjadi kesalahan saat menyimpan data paket. " . $t->getMessage();
    }
}
?>

<style>
.form-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.form-title {
    font-size: 20px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
    border-bottom: 2px solid #667eea;
    padding-bottom: 10px;
}
.form-label {
    font-weight: 600;
    color: #34495e;
}
.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dfe4ea;
    padding: 10px 15px;
}
.btn-save {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}
.btn-cancel {
    background: #95a5a6;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
}
</style>

<div class="form-section">
    <h3 class="form-title">Tambah Data Paket Haji Baru</h3>

    <?php if ($success_message): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success_message) ?>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" novalidate>
        <input type="hidden" name="package_type" value="haji">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama Paket <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="package_code" class="form-label">Kode Paket</label>
                <input type="text" class="form-control" id="package_code" name="package_code" placeholder="Otomatis jika kosong" value="<?= isset($_POST['package_code']) ? htmlspecialchars($_POST['package_code']) : '' ?>">
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Paket</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="departure_date" class="form-label">Tanggal Keberangkatan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="departure_date" name="departure_date" required value="<?= isset($_POST['departure_date']) ? htmlspecialchars($_POST['departure_date']) : '' ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="days" class="form-label">Jumlah Hari</label>
                <input type="number" class="form-control" id="days" name="days" value="<?= isset($_POST['days']) ? (int)$_POST['days'] : 9 ?>">
            </div>
             <div class="col-md-4 mb-3">
                <label for="departure_location" class="form-label">Lokasi Keberangkatan</label>
                <input type="text" class="form-control" id="departure_location" name="departure_location" placeholder="Contoh: Jakarta" value="<?= isset($_POST['departure_location']) ? htmlspecialchars($_POST['departure_location']) : '' ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="airline_id" class="form-label">Maskapai</label>
                <select class="form-select" id="airline_id" name="airline_id">
                    <option value="">Pilih Maskapai</option>
                    <?php foreach ($airlines as $airline): ?>
                        <option value="<?= (int)$airline['id'] ?>" <?= isset($_POST['airline_id']) && $_POST['airline_id'] == $airline['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($airline['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="flight_route" class="form-label">Rute Penerbangan</label>
                <input type="text" class="form-control" id="flight_route" name="flight_route" placeholder="Contoh: JKT-JED, MED-JKT" value="<?= isset($_POST['flight_route']) ? htmlspecialchars($_POST['flight_route']) : '' ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="price" class="form-label">Harga Paket (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="price" name="price" required min="0" value="<?= isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '' ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="quota" class="form-label">Kuota Jamaah <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="quota" name="quota" required min="0" value="<?= isset($_POST['quota']) ? htmlspecialchars($_POST['quota']) : '' ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="active" <?= (isset($_POST['status']) && $_POST['status'] === 'active') ? 'selected' : '' ?>>Aktif</option>
                    <option value="inactive" <?= (isset($_POST['status']) && $_POST['status'] === 'inactive') ? 'selected' : '' ?>>Tidak Aktif</option>
                    <option value="full" <?= (isset($_POST['status']) && $_POST['status'] === 'full') ? 'selected' : '' ?>>Penuh</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="?mod=paket&submod=keberangkatan_haji" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Data Paket</button>
        </div>
    </form>
</div>