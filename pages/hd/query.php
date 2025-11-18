<?php
date_default_timezone_set("Asia/Jakarta");
if (isset($_POST)) {
    $dataPost = $_POST['dataPost'];

    function createNoMedic($no_daftar)
    {
        include "../../3rdparty/engine.php";
        $cekData = $db->query("select id, no_daftar, no_medication from tbl_medication where no_daftar='" . $no_daftar . "'");
        if (count($cekData) == 0) {
            // GENERATE NOMOR MEDIC
            $ceknmr = $db->queryItem("select max(right(no_medication, 3)*1) from tbl_medication where left(right(no_medication, 11), 8)='" . date("dmY") . "'", 0);
            $ceknmr = $ceknmr + 1;
            if ($ceknmr < 10) $ceknmr = '00' . $ceknmr;
            elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0' . $ceknmr;
            elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
            $nomr = 'MDC-' . date("dmY") . $ceknmr;

            // GET DATA PASIEN
            $daftar = $db->query("SELECT p.nomr, p.no_daftar, s.nm_pasien from tbl_pendaftaran p LEFT JOIN tbl_pasien s ON p.nomr=s.nomr where p.no_daftar='" . $no_daftar . "'", 0);

            // INSERT DATA
            $db->query("insert into  tbl_medication (no_medication, nomr, nama, tgl_input, total_harga, no_daftar, diagnosa) values ('" . $nomr . "', '" . $daftar[0]['nomr'] . "', '" . $daftar[0]['nm_pasien'] . "', '" . date("Y-m-d") . "', '0', '" . $daftar[0]['no_daftar'] . "', 'AUTO')", 0);
        } else {
            $nomr = $cekData[0]['no_medication'];
        }

        $respon = $db->query("SELECT * FROM tbl_medication where no_medication='" . $nomr . "'", 0);

        return json_encode($respon);
    }

    function getDataPaket()
    {
        include "../../3rdparty/engine.php";
        $data = $db->query("SELECT * FROM tbl_bhp", 0);
        $respon = [
            "jumlahData" => count($data),
            "body" => $data
        ];
        return json_encode($respon);
    }

    function getListDataPaket($id)
    {
        include "../../3rdparty/engine.php";
        $data = $db->query("SELECT d.*, o.stock_akhir FROM tbl_bph_detail d LEFT JOIN tbl_obat o ON d.kode_obat=o.kode_obat WHERE bphID = '$id'", 0);
        $respon = [
            "jumlahData" => count($data),
            "body" => $data
        ];
        return json_encode($respon);
    }

    function getListDataPaketByNo($id, $noMedication)
    {
        include "../../3rdparty/engine.php";
        $data = $db->query("SELECT d.*, o.stock_akhir FROM tbl_bph_detail d LEFT JOIN tbl_obat o ON d.kode_obat=o.kode_obat WHERE bphID = '$id' AND no_medication = '$noMedication'", 0);
        $respon = [
            "jumlahData" => count($data),
            "body" => $data
        ];
        return json_encode($respon);
    }

    function tambahItem($obat, $noMedication)
    {
        include "../../3rdparty/engine.php";
        $dataObat = $db->query("SELECT * FROM tbl_obat WHERE kode_obat = '$obat'", 0);
        $bphID = 4;
        $kode_obat = $dataObat[0]['kode_obat'];
        $nama_obat = $dataObat[0]['nama_obat'];
        $satuan = $dataObat[0]['satuan_besar'];
        $harga_beli = $dataObat[0]['harga_beli'];
        $harga_satuan = $dataObat[0]['harga_jual'];
        $qty = 1;

        $db->query("INSERT INTO tbl_bph_detail (bphID, kode_obat, nama_obat, qty, harga_satuan, harga_beli, status_delete, satuan, no_medication) VALUES ('$bphID', '$kode_obat', '$nama_obat', '$qty', '$harga_satuan', '$harga_beli', 'UD', '$satuan', '$noMedication')");

        $respon = [
            "no" => $noMedication
        ];
        return json_encode($respon);
    }

    function simpanData($data)
    {
        include "../../3rdparty/engine.php";
        $medication_id = $data['medication_id'];
        $no_medication = $data['no_medication'];
        $bhp_id = $data['bhp_id'];
        $unit = $data['unit'];
        $bhp_nama = $data['bhp_nama'];
        $transaksi = $data['transaksi'];
        $total_harga = $data['total_harga'];

        $kode_obat = $data['kode_obat'];
        $namaObat = $data['namaObat'];
        $jenis = $data['jenis'];
        $satuan = $data['satuan'];
        $qty = $data['qty'];
        $stock_akhir = $data['stock_akhir'];
        $harga = $data['harga'];

        $status_delete = $data['status_delete'];
        $tgl_insert = $data['tgl_insert'];
        $bhp_detail_id = $data['bhp_detail_id'];
        // update header
        $db->query("UPDATE tbl_medication SET total_harga = '$total_harga', transaksi = '$transaksi', unit = '$unit' WHERE no_medication = '$no_medication'");

	//masukkan ke jurnal
	$dataMed = $db->query("select * from tbl_medication where no_medication = '$no_medication'", 0);
	$dataDaftar = $db->query("select * from tbl_pendaftaran where no_daftar='".$dataMed[0]['no_daftar']."'", 0);
	$cek1 = $db->query("select no_dokumen_nr, no_dokumen from tbl_jurnal where reg_no='".$no_medication."' and (gl_kode='11040101' or gl_kode='51010310')");
	if ($cek1[0]['no_dokumen_nr'] > 0) {
		$no_dokumen = $cek1[0]['no_dokumen'];
		$no_dokumen_nr = $cek1[0]['no_dokumen_nr'];
	}
	else {
		$no_do = $db->query("select no_dokumen_nr from tbl_jurnal order by no_dokumen_nr desc");
		$nodok = $no_do[0]['no_dokumen_nr'] + 1;
		if ($nodok < 10) $nodokumen = '00000'.$nodok;
		elseif ($nodok >= 10 and $nodok < 100) $nodokumen = '0000'.$nodok;
		elseif ($nodok >= 100 and $nodok < 1000) $nodokumen = '000'.$nodok;
		elseif ($nodok >= 1000 and $nodok < 10000) $nodokumen = '00'.$nodok;
		elseif ($nodok >= 10000 and $nodok < 100000) $nodokumen = '0'.$nodok;
		elseif ($nodok >= 100000 and $nodok < 1000000) $nodokumen = $nodok;
		$no_dokumen = date("y-m-d-").$nodokumen;
		$no_dokumen_nr = $nodokumen * 1;
	}
	$tanggal = date("Y-m-d");
	$statuss = 'NOT POSTED';
	$tipe_dokumen = 'Patient UnBill';
	$petugas = $_SESSION['rg_user'];
	$mata_uang = 'Rupiah';
	$rate = 1;
	$supplier = '';
	$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$dataDaftar[0]['nomr']."'");
	$dokter = $db->query("select nama_dokter, tarif_dokter from tbl_dokter where kode_dokter='".$dataDaftar[0]['kode_dokter']."'");
	$keterangan = 'Pemakaian Ruangan:  No. Medication.'.$no_medication.', Medication: ['.$dokter[0]['nama_dokter'].'] PS: '.$pasien[0]['nm_pasien'];

        // insert detail
        $jumlahData = count($kode_obat);
        for ($i = 0; $i < $jumlahData; $i++) {
            $totalItem = $qty[$i] * $harga[$i];

            $cek = $db->query("SELECT id FROM tbl_medication_detail WHERE no_medication = '$no_medication' AND kode_obat = '$kode_obat[$i]'");
            $idEdit = $cek[0]['id'];

            if (count($cek) > 0) {
                $db->query("UPDATE tbl_medication_detail SET kode_obat = '$kode_obat[$i]', jenis = '$jenis', qty = '$qty[$i]', harga = '$harga[$i]', total = '$total_harga', bhp_id = '$bhp_id', bhp_nama = '$bhp_nama', bhp_detail_id = '$bhp_detail_id[$i]' WHERE id = '$idEdit'");
            } else {
                $db->query("INSERT INTO tbl_medication_detail (medication_id, no_medication, kode_obat, nama_obat, jenis, satuan, qty, harga, total, status_delete, tgl_insert, bhp_id, bhp_nama, bhp_detail_id, stock_akhir) VALUES ('$medication_id', '$no_medication', '$kode_obat[$i]', '$namaObat[$i]', '$jenis', '$satuan[$i]', '$qty[$i]', '$harga[$i]', '$totalItem', '$status_delete', '$tgl_insert', '$bhp_id', '$bhp_nama', '$bhp_detail_id[$i]', '$stock_akhir[$i]')");
		

                $updateStokAkhir = $stock_akhir[$i] - $qty[$i];

                if ($unit == "Fisioterapi") {
                    $db->query("UPDATE tbl_obat SET stock_akhir_fisio = '$updateStokAkhir' WHERE kode_obat = '$kode_obat[$i]'");
                } else if ($unit == "Keperawatan") {
                    $db->query("UPDATE tbl_obat SET stock_akhir_keperawatan = '$updateStokAkhir' WHERE kode_obat = '$kode_obat[$i]'");
                } else if ($unit == "Apotik") {
                    $db->query("UPDATE tbl_obat SET stock_akhir_apotik = '$updateStokAkhir' WHERE kode_obat = '$kode_obat[$i]'");
                } else {
                    $db->query("UPDATE tbl_obat SET stock_akhir = '$updateStokAkhir' WHERE kode_obat = '$kode_obat[$i]'");
                }
            }
            // update stok

     		//masukkan ke jurnal
		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='51010310'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		$deskripsi = 'GS BRG #'.$kode_obat[$i].' '.$namaObat[$i].' (Medication)';
		$dtarif = $db->query("select * from tbl_poli where kd_profit='1104'");
		$reg_no = $dataDaftar[0]['no_daftar'];
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		//if ($coa[0]['default_pos'] == 'Debit') {
			//$debet = 0;
			//$kredit = $total_beli;
		//}
		//elseif ($coa[0]['default_pos'] == 'Credit') {
			$debet = $totalItem;
			$kredit = 0;
		//}

		//insert Administrasi di Jurnal
		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debet."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11040101'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		$deskripsi = 'GS BRG #'.$kode_obat[$i].' '.$namaObat[$i].' (Medication)';
		$dtarif = $db->query("select * from tbl_poli where kd_profit='1104'");
		$reg_no = $dataDaftar[0]['no_daftar'];
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		//if ($coa[0]['default_pos'] == 'Debit') {
			//$debet = $total_beli;
			//$kredit = 0;
		//}
		//elseif ($coa[0]['default_pos'] == 'Credit') {
			$debet = 0;
			$kredit = $totalItem;
		//}

		//insert Administrasi di Jurnal
		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debet."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

        }
        $db->query("DELETE FROM tbl_bph_detail WHERE no_medication = '$no_medication' AND bhpID = '4'");
        $respon = [
            "no_medication" => $no_medication
        ];
        echo json_encode($respon);
    }

    function getDetailSave($noMedic)
    {
        include "../../3rdparty/engine.php";
        $data = $db->query("SELECT * FROM tbl_medication_detail WHERE no_medication = '$noMedic'");
        $respon = [
            "jumlahData" => count($data),
            "body" => $data
        ];
        echo json_encode($respon);
    }

    function hapusItemSave($id, $kodeObat, $qty)
    {
        include "../../3rdparty/engine.php";
        $db->query("DELETE FROM tbl_medication_detail WHERE id = '$id'");

        $getStokAkhir = $db->query("SELECT stock_akhir FROM tbl_obat WHERE kode_obat = '$kodeObat'");
        $qtyUpdate = $getStokAkhir[0]['stock_akhir'] + $qty;
        $db->query("UPDATE tbl_obat SET stock_akhir = '$qtyUpdate' WHERE kode_obat = '$kodeObat' ");
        $respon = [
            "pesan" => 0
        ];
        echo json_encode($respon);
    }



    if ($dataPost == "Create Nomor Medic") {
        $no_daftar = $_POST['no_daftar'];
        echo createNoMedic($no_daftar);
    } else if ($dataPost == "Get Data Paket") {
        echo getDataPaket();
    } else if ($dataPost == "Get List Paket") {
        $id = $_POST['id'];
        echo getListDataPaket($id);
    } else if ($dataPost == "Simpan Data Medication") {
        $dataArray = [
            "medication_id" => $_POST['noMedicID'],
            "no_medication" => $_POST['noMedic'],
            "bhp_id" => $_POST['idPaket'],
            "unit" => $_POST['unit'],
            "bhp_nama" => $_POST['labelPaket'],
            "transaksi" => $_POST['transaksi'],
            "total_harga" => $_POST['totalHarga'],
            "kode_obat" => $_POST['kode_obat'],
            "namaObat" => $_POST['namaObat'],
            "jenis" => "OBT-MEDICATION",
            "satuan" => $_POST['satuan'],
            "qty" => $_POST['qty'],
            "stock_akhir" => $_POST['stock_akhir'],
            "harga" => $_POST['harga'],
            "status_delete" => "UD",
            "tgl_insert" => date("Y-m-d H:i:s"),
            "bhp_detail_id" => $_POST['id']
        ];
        echo simpanData($dataArray);
    } else if ($dataPost == "GET Detail Medic") {
        $noMedic = $_POST['noMedic'];
        echo getDetailSave($noMedic);
    } else if ($dataPost == "Hapus Item Save") {
        $id = $_POST['id'];
        $kodeObat = $_POST['kodeObat'];
        $qty = $_POST['qty'];
        echo hapusItemSave($id, $kodeObat, $qty);
    } else if ($dataPost == "Get List Paket By No Medic") {
        $id = $_POST['id'];
        $noMedication = $_POST['noMedication'];
        echo getListDataPaketByNo($id, $noMedication);
    } else if ($dataPost == "Tambah Item Obat") {
        $obat = $_POST['obat'];
        $noMedication = $_POST['noMedication'];
        echo tambahItem($obat, $noMedication);
    }
}
