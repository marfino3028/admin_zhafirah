<?php
$sidebar = "manifest";
$sidebarSub = "keberangkatan_umroh";
include "../functions/koneksi.php";
include "header.php";

// Get paket list for dropdown
$query_paket = mysqli_query($con, "SELECT * FROM paket WHERE jenis_paket = 'Umroh' ORDER BY nama_paket ASC");

// Check if editing
$keberangkatan = null;
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query_keberangkatan = mysqli_query($con, "SELECT * FROM keberangkatan WHERE id_keberangkatan = '$id'");
    $keberangkatan = mysqli_fetch_object($query_keberangkatan);
}
?>

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold"><?php echo isset($keberangkatan) ? 'Edit' : 'Tambah'; ?> Data Keberangkatan Umroh</h2>
                    <h5 class="text-white op-7 mb-2">Kelola Data Keberangkatan Umroh</h5>
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
                        <li class="breadcrumb-item"><a href="list_keberangkatan_umroh.php">Data Keberangkatan Umroh</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo isset($keberangkatan) ? 'Edit' : 'Tambah'; ?> Data Keberangkatan Umroh</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="list_keberangkatan_umroh.php" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formKeberangkatan').submit();">
                    <i class="fas fa-save"></i> Tambah Keberangkatan
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="proses_keberangkatan_umroh.php" method="post" id="formKeberangkatan">
                            
                            <!-- Section: Data Paket Umroh -->
                            <div class="section-header text-center mb-4 p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px;">
                                <h4 class="mb-0" style="font-weight: 600;">Data Paket Umroh</h4>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Paket Umroh <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control" name="id_paket" id="id_paket" required>
                                        <option value="">Pilih Paket Umroh</option>
                                        <?php while($paket = mysqli_fetch_object($query_paket)): ?>
                                            <option value="<?php echo $paket->id_paket; ?>" 
                                                    data-harga="<?php echo $paket->harga_paket; ?>"
                                                    <?php echo (isset($keberangkatan->id_paket) && $keberangkatan->id_paket == $paket->id_paket) ? 'selected' : ''; ?>>
                                                <?php echo $paket->nama_paket; ?> - Rp <?php echo number_format($paket->harga_paket, 0, ',', '.'); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kode Keberangkatan <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="kode_keberangkatan" id="kode_keberangkatan"
                                           value="<?php echo isset($keberangkatan->kode_keberangkatan) ? $keberangkatan->kode_keberangkatan : 'KU-'; ?>" 
                                           placeholder="KU-" required readonly style="background-color: #e9ecef;">
                                </div>
                                <label class="col-md-2 col-form-label">Nama Keberangkatan <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nama_keberangkatan" 
                                           value="<?php echo isset($keberangkatan->nama_keberangkatan) ? $keberangkatan->nama_keberangkatan : ''; ?>" 
                                           placeholder="Masukkan nama keberangkatan" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tanggal Keberangkatan <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="tanggal_keberangkatan" 
                                           value="<?php echo isset($keberangkatan->tanggal_keberangkatan) ? $keberangkatan->tanggal_keberangkatan : ''; ?>" 
                                           required>
                                </div>
                                <label class="col-md-2 col-form-label">Jumlah Hari (Hari) <span class="text-danger">*</span></label>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="jumlah_hari" 
                                           value="<?php echo isset($keberangkatan->jumlah_hari) ? $keberangkatan->jumlah_hari : ''; ?>" 
                                           placeholder="0" min="1" required>
                                </div>
                                <label class="col-md-2 col-form-label">Kuota Jamaah (Pax) <span class="text-danger">*</span></label>
                                <div class="col-md-12 col-lg-2">
                                    <input type="number" class="form-control" name="kuota_jamaah" 
                                           value="<?php echo isset($keberangkatan->kuota_jamaah) ? $keberangkatan->kuota_jamaah : ''; ?>" 
                                           placeholder="0" min="1" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status Keberangkatan <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control" name="status_keberangkatan" required>
                                        <option value="Active" <?php echo (isset($keberangkatan->status_keberangkatan) && $keberangkatan->status_keberangkatan == 'Active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="Inactive" <?php echo (isset($keberangkatan->status_keberangkatan) && $keberangkatan->status_keberangkatan == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="Full" <?php echo (isset($keberangkatan->status_keberangkatan) && $keberangkatan->status_keberangkatan == 'Full') ? 'selected' : ''; ?>>Full</option>
                                        <option value="Completed" <?php echo (isset($keberangkatan->status_keberangkatan) && $keberangkatan->status_keberangkatan == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Catatan Keberangkatan</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="catatan_keberangkatan" rows="4" 
                                              placeholder="Masukkan catatan keberangkatan (opsional)"><?php echo isset($keberangkatan->catatan_keberangkatan) ? $keberangkatan->catatan_keberangkatan : ''; ?></textarea>
                                </div>
                            </div>

                            <!-- Hidden field for ID if editing -->
                            <?php if(isset($keberangkatan->id_keberangkatan)): ?>
                                <input type="hidden" name="id_keberangkatan" value="<?php echo $keberangkatan->id_keberangkatan; ?>">
                                <input type="hidden" name="action" value="edit">
                            <?php else: ?>
                                <input type="hidden" name="action" value="add">
                            <?php endif; ?>

                            <!-- Submit Buttons -->
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <a href="list_keberangkatan_umroh.php" class="btn btn-secondary">
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
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Auto-generate kode keberangkatan based on selected package
    $('#id_paket').change(function() {
        var paketId = $(this).val();
        if (paketId) {
            $.ajax({
                url: 'ajax_generate_kode_keberangkatan.php',
                type: 'POST',
                data: {id_paket: paketId},
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#kode_keberangkatan').val(response.kode);
                    }
                },
                error: function() {
                    swal('Error', 'Gagal generate kode keberangkatan', 'error');
                }
            });
        }
    });

    // Form validation
    $('#formKeberangkatan').submit(function(e) {
        var kuota = parseInt($('input[name="kuota_jamaah"]').val());
        var hari = parseInt($('input[name="jumlah_hari"]').val());
        
        if (kuota < 1) {
            e.preventDefault();
            swal('Peringatan', 'Kuota jamaah minimal 1 pax', 'warning');
            return false;
        }
        
        if (hari < 1) {
            e.preventDefault();
            swal('Peringatan', 'Jumlah hari minimal 1 hari', 'warning');
            return false;
        }
    });
});
</script>

<?php include "footer.php"; ?>
