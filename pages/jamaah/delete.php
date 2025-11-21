<?php
// File: delete.php
// Fungsi untuk menghapus data jamaah dari tabel users

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Cek apakah data jamaah ada
    $check = $db->query("SELECT id, foto FROM users WHERE id = $id AND role = 'jamaah'");
    
    if($check && $check->num_rows > 0) {
        $jamaah = $check->fetch_assoc();
        
        // Hapus foto jika ada
        if(!empty($jamaah['foto']) && file_exists($jamaah['foto'])) {
            unlink($jamaah['foto']);
        }
        
        // Hapus data dari database
        $result = $db->query("DELETE FROM users WHERE id = $id AND role = 'jamaah'");
        
        if($result) {
            echo '<script>alert("Data jamaah berhasil dihapus!");window.location="?mod=jamaah&submod=list"</script>';
        } else {
            echo '<script>alert("Gagal menghapus data jamaah!");window.location="?mod=jamaah&submod=list"</script>';
        }
    } else {
        echo '<script>alert("Data jamaah tidak ditemukan!");window.location="?mod=jamaah&submod=list"</script>';
    }
} else {
    echo '<script>alert("ID tidak valid!");window.location="?mod=jamaah&submod=list"</script>';
}
?>
