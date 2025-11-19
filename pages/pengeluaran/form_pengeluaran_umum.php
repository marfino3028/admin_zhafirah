<?php
$sidebar = "pengeluaran";
$sidebarSub = "pengeluaran_umum";
include "../functions/koneksi.php";
include "header.php";

// Check if editing
$pengeluaran = null;
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query_pengeluaran = mysqli_query($con, "SELECT * FROM pengeluaran WHERE id_pengeluaran = '$id'");
    $pengeluaran = mysqli_fetch_object($query_pengeluaran);
}
?>

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold"><?php echo isset($pengeluaran) ? 'Edit' : 'Tambah'; ?> Data Pengeluaran Umum</h2>
                    <h5 class="text-white op-7 mb-2">Kelola Data Pengeluaran Umum</h5>
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
                        <li class="breadcrumb-item"><a href="umum.php">Data Pengeluaran Umum</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo isset($pengeluaran) ? 'Edit' : 'Tambah'; ?> Data Pengeluaran Umum</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="umum.php" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formPengeluaran').submit();">
                    <i class="fas fa-save"></i> Tambah Pengeluaran Umum
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
                        <form action="proses_pengeluaran_umum.php" method="post" id="formPengeluaran" enctype="multipart/form-data">
                            
                            <!-- Section: Data Pengeluaran Umum -->
                            <div class="section-header text-center mb-4 p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px;">
                                <h4 class="mb-0" style="font-weight: 600;">Data Pengeluaran Umum</h4>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kode Pengeluaran <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="kode_pengeluaran" id="kode_pengeluaran"
                                           value="<?php echo isset($pengeluaran->kode_pengeluaran) ? $pengeluaran->kode_pengeluaran : 'CG-'; ?>" 
                                           placeholder="CG-" required readonly style="background-color: #e9ecef;">
                                </div>
                                <label class="col-md-2 col-form-label">Tanggal Pengeluaran <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="tanggal_pengeluaran" 
                                           value="<?php echo isset($pengeluaran->tanggal_pengeluaran) ? $pengeluaran->tanggal_pengeluaran : date('Y-m-d'); ?>" 
                                           required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jenis Pengeluaran <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="jenis_pengeluaran" id="jenis_pengeluaran" required>
                                        <option value="">Pilih Jenis Pengeluaran</option>
                                        <option value="Operasional" <?php echo (isset($pengeluaran->jenis_pengeluaran) && $pengeluaran->jenis_pengeluaran == 'Operasional') ? 'selected' : ''; ?>>Operasional</option>
                                        <option value="Gaji" <?php echo (isset($pengeluaran->jenis_pengeluaran) && $pengeluaran->jenis_pengeluaran == 'Gaji') ? 'selected' : ''; ?>>Gaji</option>
                                        <option value="Sewa" <?php echo (isset($pengeluaran->jenis_pengeluaran) && $pengeluaran->jenis_pengeluaran == 'Sewa') ? 'selected' : ''; ?>>Sewa</option>
                                        <option value="Utilitas" <?php echo (isset($pengeluaran->jenis_pengeluaran) && $pengeluaran->jenis_pengeluaran == 'Utilitas') ? 'selected' : ''; ?>>Utilitas</option>
                                        <option value="Lain-lain" <?php echo (isset($pengeluaran->jenis_pengeluaran) && $pengeluaran->jenis_pengeluaran == 'Lain-lain') ? 'selected' : ''; ?>>Lain-lain</option>
                                    </select>
                                </div>
                                <label class="col-md-2 col-form-label">Nama Pengeluaran <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nama_pengeluaran" 
                                           value="<?php echo isset($pengeluaran->nama_pengeluaran) ? $pengeluaran->nama_pengeluaran : ''; ?>" 
                                           placeholder="Masukkan nama pengeluaran" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jumlah Pengeluaran</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="jumlah_pengeluaran" id="jumlah_pengeluaran"
                                           value="<?php echo isset($pengeluaran->jumlah_pengeluaran) ? number_format($pengeluaran->jumlah_pengeluaran, 0, ',', '.') : ''; ?>" 
                                           placeholder="0">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Catatan Pengeluaran</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="catatan_pengeluaran" rows="4" 
                                              placeholder="Masukkan catatan pengeluaran (opsional)"><?php echo isset($pengeluaran->catatan_pengeluaran) ? $pengeluaran->catatan_pengeluaran : ''; ?></textarea>
                                </div>
                            </div>

                            <!-- Hidden field for ID if editing -->
                            <?php if(isset($pengeluaran->id_pengeluaran)): ?>
                                <input type="hidden" name="id_pengeluaran" value="<?php echo $pengeluaran->id_pengeluaran; ?>">
                                <input type="hidden" name="action" value="edit">
                            <?php else: ?>
                                <input type="hidden" name="action" value="add">
                            <?php endif; ?>

                            <!-- Submit Buttons -->
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <a href="umum.php" class="btn btn-secondary">
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

            <!-- Sidebar: Bukti Pengeluaran -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bukti Pengeluaran <i class="fas fa-info-circle" data-toggle="tooltip" title="Upload bukti pengeluaran (opsional)"></i></h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="upload-area" style="border: 2px dashed #ccc; padding: 40px 20px; border-radius: 8px; min-height: 200px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 64px; color: #3498db; margin-bottom: 20px;"></i>
                            <p class="text-muted">Drop files here or click to upload</p>
                            <input type="file" name="bukti_pengeluaran" id="bukti_pengeluaran" class="d-none" accept="image/*,.pdf" form="formPengeluaran">
                            <button type="button" class="btn btn-sm btn-primary mt-2" onclick="document.getElementById('bukti_pengeluaran').click();">
                                <i class="fas fa-upload"></i> Pilih File
                            </button>
                            <small class="text-muted mt-2">Format: JPG, PNG, PDF (Max 2MB)</small>
                        </div>
                        
                        <?php if(isset($pengeluaran->bukti_pengeluaran) && !empty($pengeluaran->bukti_pengeluaran)): ?>
                            <div class="mt-3">
                                <p class="mb-2"><strong>File saat ini:</strong></p>
                                <?php 
                                $file_ext = pathinfo($pengeluaran->bukti_pengeluaran, PATHINFO_EXTENSION);
                                if(in_array(strtolower($file_ext), ['jpg', 'jpeg', 'png', 'gif'])): 
                                ?>
                                    <img src="../../uploads/pengeluaran/<?php echo $pengeluaran->bukti_pengeluaran; ?>" class="img-fluid" style="max-height: 150px;">
                                <?php else: ?>
                                    <a href="../../uploads/pengeluaran/<?php echo $pengeluaran->bukti_pengeluaran; ?>" target="_blank" class="btn btn-sm btn-info">
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
    // Auto-generate kode pengeluaran on page load
    <?php if(!isset($pengeluaran->id_pengeluaran)): ?>
    generateKodePengeluaran();
    <?php endif; ?>

    // Format currency input
    $('#jumlah_pengeluaran').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(formatRupiah(value));
    });

    // File preview
    $('#bukti_pengeluaran').change(function(e) {
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
    $('#formPengeluaran').submit(function(e) {
        let jumlah = $('#jumlah_pengeluaran').val().replace(/\D/g, '');
        
        if (jumlah == '' || parseInt(jumlah) < 0) {
            e.preventDefault();
            swal('Peringatan', 'Jumlah pengeluaran tidak valid', 'warning');
            return false;
        }

        // Set hidden input for clean number
        $('<input>').attr({
            type: 'hidden',
            name: 'jumlah_pengeluaran_clean',
            value: jumlah
        }).appendTo(this);
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();
});

function generateKodePengeluaran() {
    $.ajax({
        url: '../functions/ajax_generate_kode_pengeluaran.php',
        type: 'POST',
        data: {jenis: 'umum'},
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#kode_pengeluaran').val(response.kode);
            }
        },
        error: function() {
            console.log('Gagal generate kode pengeluaran');
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
