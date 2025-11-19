<?php
$sidebar = "pemasukan";
$sidebarSub = "pemasukan_umum";
include "../functions/koneksi.php";
include "header.php";

// Check if editing
$pemasukan = null;
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query_pemasukan = mysqli_query($con, "SELECT * FROM pemasukan WHERE id_pemasukan = '$id'");
    $pemasukan = mysqli_fetch_object($query_pemasukan);
}
?>

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold"><?php echo isset($pemasukan) ? 'Edit' : 'Tambah'; ?> Data Pemasukan Umum</h2>
                    <h5 class="text-white op-7 mb-2">Kelola Data Pemasukan Umum</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <!-- Breadcrumb -->
        <div class="row mb-3">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../">Home</a></li>
                        <li class="breadcrumb-item"><a href="list_pemasukan_umum.php">Data Pemasukan Umum</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo isset($pemasukan) ? 'Edit' : 'Tambah'; ?> Data Pemasukan Umum</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="list_pemasukan_umum.php" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formPemasukan').submit();">
                    <i class="fas fa-save"></i> Tambah Pemasukan Umum
                </button>
            </div>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form action="proses_pemasukan_umum.php" method="post" id="formPemasukan" enctype="multipart/form-data">
                            
                            <!-- Section: Data Pemasukan Umum -->
                            <div class="section-header text-center mb-4 p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px;">
                                <h4 class="mb-0" style="font-weight: 600;">Data Pemasukan Umum</h4>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kode Pemasukan <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="kode_pemasukan" id="kode_pemasukan"
                                           value="<?php echo isset($pemasukan->kode_pemasukan) ? $pemasukan->kode_pemasukan : 'CG-'; ?>" 
                                           placeholder="CG-" required readonly style="background-color: #e9ecef;">
                                </div>
                                <label class="col-md-2 col-form-label">Tanggal Pemasukan <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="tanggal_pemasukan" 
                                           value="<?php echo isset($pemasukan->tanggal_pemasukan) ? $pemasukan->tanggal_pemasukan : date('Y-m-d'); ?>" 
                                           required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jenis Pemasukan <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="jenis_pemasukan" id="jenis_pemasukan" required>
                                        <option value="">Pilih Jenis Pemasukan</option>
                                        <option value="Donasi" <?php echo (isset($pemasukan->jenis_pemasukan) && $pemasukan->jenis_pemasukan == 'Donasi') ? 'selected' : ''; ?>>Donasi</option>
                                        <option value="Hibah" <?php echo (isset($pemasukan->jenis_pemasukan) && $pemasukan->jenis_pemasukan == 'Hibah') ? 'selected' : ''; ?>>Hibah</option>
                                        <option value="Penjualan" <?php echo (isset($pemasukan->jenis_pemasukan) && $pemasukan->jenis_pemasukan == 'Penjualan') ? 'selected' : ''; ?>>Penjualan</option>
                                        <option value="Lain-lain" <?php echo (isset($pemasukan->jenis_pemasukan) && $pemasukan->jenis_pemasukan == 'Lain-lain') ? 'selected' : ''; ?>>Lain-lain</option>
                                    </select>
                                </div>
                                <label class="col-md-2 col-form-label">Nama Pemasukan <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nama_pemasukan" 
                                           value="<?php echo isset($pemasukan->nama_pemasukan) ? $pemasukan->nama_pemasukan : ''; ?>" 
                                           placeholder="Masukkan nama pemasukan" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jumlah Pemasukan</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="jumlah_pemasukan" id="jumlah_pemasukan"
                                           value="<?php echo isset($pemasukan->jumlah_pemasukan) ? number_format($pemasukan->jumlah_pemasukan, 0, ',', '.') : ''; ?>" 
                                           placeholder="0">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Catatan Pemasukan</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="catatan_pemasukan" rows="4" 
                                              placeholder="Masukkan catatan pemasukan (opsional)"><?php echo isset($pemasukan->catatan_pemasukan) ? $pemasukan->catatan_pemasukan : ''; ?></textarea>
                                </div>
                            </div>

                            <!-- Hidden field for ID if editing -->
                            <?php if(isset($pemasukan->id_pemasukan)): ?>
                                <input type="hidden" name="id_pemasukan" value="<?php echo $pemasukan->id_pemasukan; ?>">
                                <input type="hidden" name="action" value="edit">
                            <?php else: ?>
                                <input type="hidden" name="action" value="add">
                            <?php endif; ?>

                            <!-- Submit Buttons -->
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <a href="list_pemasukan_umum.php" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Bukti Pemasukan -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bukti Pemasukan <i class="fas fa-info-circle" data-toggle="tooltip" title="Upload bukti pemasukan (opsional)"></i></h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="upload-area" style="border: 2px dashed #ccc; padding: 40px 20px; border-radius: 8px; min-height: 200px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 64px; color: #3498db; margin-bottom: 20px;"></i>
                            <p class="text-muted">Drop files here or click to upload</p>
                            <input type="file" name="bukti_pemasukan" id="bukti_pemasukan" class="d-none" accept="image/*,.pdf">
                            <button type="button" class="btn btn-sm btn-primary mt-2" onclick="document.getElementById('bukti_pemasukan').click();">
                                <i class="fas fa-upload"></i> Pilih File
                            </button>
                            <small class="text-muted mt-2">Format: JPG, PNG, PDF (Max 2MB)</small>
                        </div>
                        
                        <?php if(isset($pemasukan->bukti_pemasukan) && !empty($pemasukan->bukti_pemasukan)): ?>
                            <div class="mt-3">
                                <p class="mb-2"><strong>File saat ini:</strong></p>
                                <?php 
                                $file_ext = pathinfo($pemasukan->bukti_pemasukan, PATHINFO_EXTENSION);
                                if(in_array(strtolower($file_ext), ['jpg', 'jpeg', 'png', 'gif'])): 
                                ?>
                                    <img src="../../uploads/pemasukan/<?php echo $pemasukan->bukti_pemasukan; ?>" class="img-fluid" style="max-height: 150px;">
                                <?php else: ?>
                                    <a href="../../uploads/pemasukan/<?php echo $pemasukan->bukti_pemasukan; ?>" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> Lihat File
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div id="preview_area" class="mt-3" style="display: none;">
                            <p class="mb-2"><strong>Preview:</strong></p>
                            <img id="preview_image" src="" class="img-fluid" style="max-height: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Auto-generate kode pemasukan on page load
    <?php if(!isset($pemasukan->id_pemasukan)): ?>
    generateKodePemasukan();
    <?php endif; ?>

    // Format currency input
    $('#jumlah_pemasukan').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(formatRupiah(value));
    });

    // File preview
    $('#bukti_pemasukan').change(function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                swal('Peringatan', 'Ukuran file maksimal 2MB', 'warning');
                $(this).val('');
                return;
            }

            // Preview image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview_image').attr('src', e.target.result);
                    $('#preview_area').show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#preview_area').hide();
            }
        }
    });

    // Form validation
    $('#formPemasukan').submit(function(e) {
        let jumlah = $('#jumlah_pemasukan').val().replace(/\D/g, '');
        
        if (jumlah == '' || parseInt(jumlah) < 0) {
            e.preventDefault();
            swal('Peringatan', 'Jumlah pemasukan tidak valid', 'warning');
            return false;
        }

        // Set hidden input for clean number
        $('<input>').attr({
            type: 'hidden',
            name: 'jumlah_pemasukan_clean',
            value: jumlah
        }).appendTo(this);
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();
});

function generateKodePemasukan() {
    $.ajax({
        url: 'ajax_generate_kode_pemasukan.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#kode_pemasukan').val(response.kode);
            }
        },
        error: function() {
            console.log('Gagal generate kode pemasukan');
        }
    });
}

function formatRupiah(angka) {
    let number_string = angka.toString();
    let split = number_string.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}
</script>

<?php include "footer.php"; ?>
