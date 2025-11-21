<?php
$sidebar = "dokumen";
$sidebarSub = "surat_izin_cuti";
include "../functions/koneksi.php";
include "header.php";

// Check if editing
$surat = null;
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query_surat = mysqli_query($con, "SELECT * FROM surat_izin_cuti WHERE id_surat = '$id'");
    $surat = mysqli_fetch_object($query_surat);
}

// Get jamaah list for dropdown
$query_jamaah = mysqli_query($con, "SELECT * FROM jamaah ORDER BY nama_jamaah ASC");

// Get keberangkatan list for dropdown
$query_keberangkatan = mysqli_query($con, "SELECT k.*, p.nama_paket 
                                           FROM keberangkatan k
                                           LEFT JOIN paket p ON k.id_paket = p.id_paket
                                           WHERE p.jenis_paket = 'Umroh'
                                           ORDER BY k.tanggal_keberangkatan DESC");
?>

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold"><?php echo isset($surat) ? 'Edit' : 'Tambah'; ?> Data Surat Izin Cuti</h2>
                    <h5 class="text-white op-7 mb-2">Kelola Data Surat Izin Cuti</h5>
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
                        <li class="breadcrumb-item"><a href="list_surat_izin_cuti.php">Data Surat Izin Cuti</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo isset($surat) ? 'Edit' : 'Tambah'; ?> Data Surat Izin Cuti</li>
                    </ol>
                </nav>
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
                        <form action="proses_surat_izin_cuti.php" method="post" id="formSurat">
                            
                            <!-- Section: Data Jamaah Umroh -->
                            <div class="section-header text-center mb-4 p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px;">
                                <h4 class="mb-0" style="font-weight: 600;">Data Jamaah Umroh</h4>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Jamaah <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="id_jamaah" id="id_jamaah" required>
                                        <option value="">Pilih Nama Jamaah</option>
                                        <?php 
                                        mysqli_data_seek($query_jamaah, 0);
                                        while($row_jamaah = mysqli_fetch_object($query_jamaah)): 
                                        ?>
                                            <option value="<?php echo $row_jamaah->id_jamaah; ?>" 
                                                    data-nama="<?php echo $row_jamaah->nama_jamaah; ?>"
                                                    <?php echo (isset($surat->id_jamaah) && $surat->id_jamaah == $row_jamaah->id_jamaah) ? 'selected' : ''; ?>>
                                                <?php echo $row_jamaah->nama_jamaah; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <label class="col-md-2 col-form-label">Nama Keberangkatan <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <select class="form-control" name="id_keberangkatan" id="id_keberangkatan" required>
                                        <option value="">Pilih Nama Keberangkatan</option>
                                        <?php 
                                        mysqli_data_seek($query_keberangkatan, 0);
                                        while($row_kb = mysqli_fetch_object($query_keberangkatan)): 
                                        ?>
                                            <option value="<?php echo $row_kb->id_keberangkatan; ?>" 
                                                    <?php echo (isset($surat->id_keberangkatan) && $surat->id_keberangkatan == $row_kb->id_keberangkatan) ? 'selected' : ''; ?>>
                                                <?php echo $row_kb->nama_keberangkatan; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Section: Data Surat Izin Cuti -->
                            <div class="section-header text-center mb-4 p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px;">
                                <h4 class="mb-0" style="font-weight: 600;">Data Surat Izin Cuti</h4>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nomor Dokumen <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nomor_dokumen" id="nomor_dokumen"
                                           value="<?php echo isset($surat->nomor_dokumen) ? $surat->nomor_dokumen : 'SC-032351/PT.TWH/1710/2025'; ?>" 
                                           placeholder="SC-032351/PT.TWH/1710/2025" required readonly style="background-color: #e9ecef;">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kantor Instansi <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="kantor_instansi" 
                                           value="<?php echo isset($surat->kantor_instansi) ? $surat->kantor_instansi : ''; ?>" 
                                           placeholder="Masukkan kantor instansi" required>
                                </div>
                                <label class="col-md-3 col-form-label">NIK Instansi</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nik_instansi" 
                                           value="<?php echo isset($surat->nik_instansi) ? $surat->nik_instansi : ''; ?>" 
                                           placeholder="Masukkan NIK instansi">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jabatan Instansi</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="jabatan_instansi" 
                                           value="<?php echo isset($surat->jabatan_instansi) ? $surat->jabatan_instansi : ''; ?>" 
                                           placeholder="Masukkan jabatan instansi">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Ayah Jamaah</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="nama_ayah" 
                                           value="<?php echo isset($surat->nama_ayah) ? $surat->nama_ayah : ''; ?>" 
                                           placeholder="Masukkan nama ayah jamaah">
                                </div>
                                <label class="col-md-2 col-form-label">Nama Kakek Jamaah</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nama_kakek" 
                                           value="<?php echo isset($surat->nama_kakek) ? $surat->nama_kakek : ''; ?>" 
                                           placeholder="Masukkan nama kakek jamaah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Catatan Surat Izin Cuti</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="catatan_surat" rows="4" 
                                              placeholder="Masukkan catatan surat izin cuti (opsional)"><?php echo isset($surat->catatan_surat) ? $surat->catatan_surat : ''; ?></textarea>
                                </div>
                            </div>

                            <!-- Hidden field for ID if editing -->
                            <?php if(isset($surat->id_surat)): ?>
                                <input type="hidden" name="id_surat" value="<?php echo $surat->id_surat; ?>">
                                <input type="hidden" name="action" value="edit">
                            <?php else: ?>
                                <input type="hidden" name="action" value="add">
                            <?php endif; ?>

                            <!-- Submit Buttons -->
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <a href="list_surat_izin_cuti.php" class="btn btn-secondary">
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
    // Auto-generate nomor dokumen on page load
    <?php if(!isset($surat->id_surat)): ?>
    generateNomorDokumen();
    <?php endif; ?>

    // Form validation
    $('#formSurat').submit(function(e) {
        let jamaah = $('#id_jamaah').val();
        let keberangkatan = $('#id_keberangkatan').val();
        
        if (!jamaah) {
            e.preventDefault();
            swal('Peringatan', 'Pilih nama jamaah terlebih dahulu', 'warning');
            return false;
        }
        
        if (!keberangkatan) {
            e.preventDefault();
            swal('Peringatan', 'Pilih nama keberangkatan terlebih dahulu', 'warning');
            return false;
        }
    });
});

function generateNomorDokumen() {
    $.ajax({
        url: '../functions/ajax_generate_nomor_dokumen.php',
        type: 'POST',
        data: {jenis: 'surat_cuti'},
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#nomor_dokumen').val(response.nomor);
            }
        },
        error: function() {
            console.log('Gagal generate nomor dokumen');
        }
    });
}
</script>

<?php include "footer.php"; ?>
