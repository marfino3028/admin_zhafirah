<?php
date_default_timezone_set("Asia/Jakarta");
if (isset($_POST)) {
    $jenis_surat = $_POST['jenis_surat'];

    function saveKetSehat($postData)
    {
        include "../../3rdparty/engine.php";
        $tgl = date('Y-m-d H:i:s');
        $id = $postData['id'];
        $nomr = $postData['nomr'];
        $no_daftar = $postData['no_daftar'];
        $jenis_surat = $postData['jenis_surat'];
        $tanggal_periksa_kesehatan = $postData['tanggal_periksa_kesehatan'];
        $catatan_keperluan = $postData['catatan_keperluan'];
        $buta_warna = $postData['buta_warna'];
        $visus = $postData['visus'];
        $penyakit_kronis = $postData['penyakit_kronis'];
        $penyakit_menular = $postData['penyakit_menular'];
        $terbit_di = $postData['terbit_di'];
        $user = $postData['user'];
        if ($id != '' && $id != null) {
            $db->query("UPDATE tbl_keterangan_pasien SET jenis_surat='$jenis_surat', tanggal_periksa_kesehatan='$tanggal_periksa_kesehatan', catatan_keperluan='$catatan_keperluan', buta_warna='$buta_warna', visus='$visus', penyakit_kronis='$penyakit_kronis', penyakit_menular='$penyakit_menular', terbit_di='$terbit_di' WHERE id='$id'", 0);
        } else {
            $db->query("INSERT INTO tbl_keterangan_pasien (nomr, no_daftar, jenis_surat, tanggal_periksa_kesehatan, catatan_keperluan, buta_warna, visus, penyakit_kronis, penyakit_menular, terbit_di, tanggal_pembuatan, user_pembuat) VALUES ('$nomr', '$no_daftar', '$jenis_surat', '$tanggal_periksa_kesehatan', '$catatan_keperluan', '$buta_warna', '$visus', '$penyakit_kronis', '$penyakit_menular', '$terbit_di', '$tgl', '$user')", 0);
        }
        $respon = [
            'status' => 'sukses',
            'message' => 'Data berhasil disimpan!'
        ];
        return json_encode($respon);
    }

    function saveKetSakit($postData)
    {
        include "../../3rdparty/engine.php";
        $tgl = date('Y-m-d H:i:s');
        $id = $postData['id'];
        $nomr = $postData['nomr'];
        $no_daftar = $postData['no_daftar'];
        $jenis_surat = $postData['jenis_surat'];
        $istirahat_mulai_tanggal = $postData['istirahat_mulai_tanggal'];
        $istirahat_sampai_tanggal = $postData['istirahat_sampai_tanggal'];
        $istirahat_selama = $postData['istirahat_selama'];
        $terbit_di = $postData['terbit_di'];
        $user = $postData['user'];

        if ($id != '' && $id != null) {
            $db->query("UPDATE tbl_keterangan_pasien SET jenis_surat='$jenis_surat', istirahat_mulai_tanggal='$istirahat_mulai_tanggal', istirahat_sampai_tanggal='$istirahat_sampai_tanggal', istirahat_selama='$istirahat_selama', terbit_di='$terbit_di' WHERE id='$id'", 0);
        } else {
            $db->query("INSERT INTO tbl_keterangan_pasien (nomr, no_daftar, jenis_surat, istirahat_mulai_tanggal, istirahat_sampai_tanggal, istirahat_selama, terbit_di, tanggal_pembuatan, user_pembuat) VALUES ('$nomr', '$no_daftar', '$jenis_surat', '$istirahat_mulai_tanggal', '$istirahat_sampai_tanggal', '$istirahat_selama', '$terbit_di', '$tgl', '$user')", 0);
        }

        $respon = [
            'status' => 'sukses',
            'message' => 'Data berhasil disimpan!'
        ];
        return json_encode($respon);
    }

    function getData($postData)
    {
        include "../../3rdparty/engine.php";
        $nomr = $postData['nomr'];
        $no_daftar = $postData['no_daftar'];
        $data = $db->query("SELECT * FROM tbl_keterangan_pasien WHERE nomr='$nomr' AND no_daftar='$no_daftar' ORDER BY id DESC", 0);
        $respon = [
            'jumlahData' => count($data),
            'body' => $data
        ];
        return json_encode($respon);
    }

    function deleteData($postData)
    {
        include "../../3rdparty/engine.php";
        $id = $postData['id'];
        $db->query("DELETE FROM tbl_keterangan_pasien WHERE id='$id'", 0);
        $respon = [
            'status' => 'sukses',
            'message' => 'Data berhasil dihapus!'
        ];
        return json_encode($respon);
    }

    if ($jenis_surat == "Keterangan Sehat") {
        $postData = [
            'id' => $_POST['id'],
            'nomr' => $_POST['nomr'],
            'no_daftar' => $_POST['no_daftar'],
            'jenis_surat' => $_POST['jenis_surat'],
            'tanggal_periksa_kesehatan' => $_POST['tgl_periksa_kesehatan'],
            'catatan_keperluan' => $_POST['catatan_keperluan'],
            'buta_warna' => $_POST['buta_warna'],
            'visus' => $_POST['visus'],
            'penyakit_kronis' => $_POST['penyakit_kronis'],
            'penyakit_menular' => $_POST['penyakit_menular'],
            'terbit_di' => $_POST['terbit_di'],
            'user' => $_POST['user']
        ];
        echo saveKetSehat($postData);
    } else if ($jenis_surat == "Keterangan Sakit") {
        $postData = [
            'id' => $_POST['id'],
            'nomr' => $_POST['nomr'],
            'no_daftar' => $_POST['no_daftar'],
            'jenis_surat' => $_POST['jenis_surat'],
            'istirahat_mulai_tanggal' => $_POST['istirahat_mulai_tanggal'],
            'istirahat_sampai_tanggal' => $_POST['istirahat_sampai_tanggal'],
            'istirahat_selama' => $_POST['istirahat_selama'],
            'terbit_di' => $_POST['terbit_di'],
            'user' => $_POST['user']
        ];
        echo saveKetSakit($postData);
    } else if ($jenis_surat == "Get Data") {
        $postData = [
            'nomr' => $_POST['nomr'],
            'no_daftar' => $_POST['no_daftar']
        ];
        echo getData($postData);
    } else if ($jenis_surat == "Hapus") {
        $postData = [
            "id" => $_POST['id']
        ];
        echo deleteData($postData);
    }
}
