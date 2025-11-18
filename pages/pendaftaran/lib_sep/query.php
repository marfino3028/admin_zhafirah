<?php
date_default_timezone_set("Asia/Jakarta");
if (isset($_POST)) {
    $jenis_query = $_POST['jenis_query'];

    function getDataPendaftaran($noDaftar)
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            p.no_daftar,
            p.nomr,
            p.kd_poli,
            d.no_peserta,
            d.telp_pasien,
            r.nama_dokter,
            r.kode_dokter,
            r.kode_bpjs 
            FROM
            tbl_pendaftaran p
            LEFT JOIN tbl_pasien d ON p.nomr = d.nomr
            LEFT JOIN tbl_dokter r ON p.kode_dokter = r.kode_dokter 
            WHERE
            p.no_daftar = '$noDaftar'
        ");
        return json_encode($query);
    }

    function getPPK()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            deskripsi, 
            nilai
            FROM
            tbl_config
            WHERE
            kode = 'BPJS-KES' AND deskripsi = 'Kode PPK'
        ");
        return json_encode($query);
    }

    function getJnsPelayanan($jenis)
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            kode_opsi, 
            nama_opsi
            FROM
            tbl_opsi_bpjs
            WHERE
            jenis_opsi = '$jenis' AND aktif = 1
        ");
        return json_encode($query);
    }

    function getPeserta($noKartu)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "no_kartu" => $noKartu,
            "tgl" => date('Y-m-d')
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/peserta/nokartu");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRujukanPcare($noKartu)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "no_kartu" => $noKartu
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/cari_no_kartu_multi_pcare");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRujukanRs($noKartu)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "no_kartu" => $noKartu
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/cari_no_kartu_multi_rs");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getPoli()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_poli
            ORDER BY nama_poli ASC
        ");
        return json_encode($query);
    }

    function getEksekutif()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_opsi_bpjs
            WHERE jenis_opsi = 'Eksekutif' AND aktif = 1
        ");
        return json_encode($query);
    }

    function getCob()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_opsi_bpjs
            WHERE jenis_opsi = 'COB' AND aktif = 1
        ");
        return json_encode($query);
    }

    function getKatarak()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_opsi_bpjs
            WHERE jenis_opsi = 'Katarak' AND aktif = 1
        ");
        return json_encode($query);
    }

    function getTipeRujukan()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_opsi_bpjs
            WHERE jenis_opsi = 'Tipe Rujukan' AND aktif = 1
        ");
        return json_encode($query);
    }

    function getTujuanKunjungan()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_opsi_bpjs
            WHERE jenis_opsi = 'Tujuan Kunjungan' AND aktif = 1
        ");
        return json_encode($query);
    }

    function getAsesmenPelayanan()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_opsi_bpjs
            WHERE jenis_opsi = 'Asesmen Pelayanan' AND aktif = 1
        ");
        return json_encode($query);
    }

    function getDpjp()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_dokter
            ORDER BY nama_dokter ASC
        ");
        return json_encode($query);
    }

    function getKelas()
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            *
            FROM
            tbl_kelas
            WHERE kode_bpjs IS NOT NULL
        ");
        return json_encode($query);
    }

    function getDiagnosa($keyDiagnosa)
    {
        include "../../../3rdparty/engine.php";
        $cekKode = $db->query("SELECT COUNT(kode_icd) jumlahKode FROM tbl_icd WHERE kode_icd LIKE '%$keyDiagnosa%'");
        if ($cekKode[0]['jumlahKode'] > 0) {
            $query = $db->query("SELECT
            *
            FROM
            tbl_icd
            WHERE kode_icd LIKE '%$keyDiagnosa%'
            ");
        } else {
            $query = $db->query("SELECT
            *
            FROM
            tbl_icd
            WHERE nama_icd LIKE '%$keyDiagnosa%'
            ");
        }
        return json_encode($query);
    }

    function createSep()
    {
        include "../../../3rdparty/engine.php";
        $noKartu = $_POST['noKartu'];
        $tglSep = $_POST['tglSep'];
        $ppkPelayanan = $_POST['ppkPelayanan'];
        $jnsPelayanan = $_POST['jnsPelayanan'];
        $klsRawatHak = $_POST['klsRawatHak'];
        $klsRawatNaik = '';
        $pembiayaan = '';
        $penanggungJawab = '';
        $noMR = $_POST['noMR'];
        $noRujukan = $_POST['noRujukan'];
        $asalRujukan = $_POST['asalRujukan'];
        $tglRujukan = $_POST['tglRujukan'];
        $ppkRujukan = $_POST['ppkRujukan'];
        $catatan = $_POST['catatan'];
        $diagAwal = $_POST['diagAwal'];
        $tujuan = $_POST['tujuan'];
        $eksekutif = $_POST['eksekutif'];
        $cob = $_POST['cob'];
        $katarak = $_POST['katarak'];
        $lakaLantas = '0';
        $noLP = '';
        $tglKejadian = '';
        $keterangan = '';
        $suplesi = '0';
        $noSuplesi = '';
        $kdPropinsi = '';
        $kdKabupaten = '';
        $kdKecamatan = '';
        $tujuanKunj = $_POST['tujuanKunj'];
        $flagProcedure = '';
        $kdPenunjang = '';
        $assesmentPel = $_POST['assesmentPel'];
        $noSurat = $_POST['noSurat'];
        $kodeDPJP = $_POST['kodeDPJP'];
        $dpjpLayan = $_POST['dpjpLayan'];
        $noTelp = $_POST['noTelp'];
        $user = $_POST['user'];
        $noDaftar = $_POST['noDaftar'];
        $tanggal = date('Y-m-d H:i');

        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "request" => array(
                "t_sep" => array(
                    "noKartu" => $noKartu,
                    "tglSep" => $tglSep,
                    "ppkPelayanan" => $ppkPelayanan,
                    "jnsPelayanan" => $jnsPelayanan,
                    "klsRawat" => array(
                        "klsRawatHak" => $klsRawatHak,
                        "klsRawatNaik" => $klsRawatNaik,
                        "pembiayaan" => $pembiayaan,
                        "penanggungJawab" => $penanggungJawab,
                    ),
                    "noMR" => $noMR,
                    "rujukan" => array(
                        "asalRujukan" => $asalRujukan,
                        "tglRujukan" => $tglRujukan,
                        "noRujukan" => $noRujukan,
                        "ppkRujukan" => $ppkRujukan,
                    ),
                    "catatan" => $catatan,
                    "diagAwal" => $diagAwal,
                    "poli" => array(
                        "tujuan" => $tujuan,
                        "eksekutif" => $eksekutif,
                    ),
                    "cob" => array(
                        "cob" => $cob
                    ),
                    "katarak" => array(
                        "katarak" => $katarak
                    ),
                    "jaminan" => array(
                        "lakaLantas" => $lakaLantas,
                        "noLP" => $noLP,
                        "penjamin" => array(
                            "tglKejadian" => $tglKejadian,
                            "keterangan" => $keterangan,
                            "suplesi" => array(
                                "suplesi" => $suplesi,
                                "noSepSuplesi" => $noSepSuplesi,
                                "lokasiLaka" => array(
                                    "kdPropinsi" => $kdPropinsi,
                                    "kdKabupaten" => $kdKabupaten,
                                    "kdKecamatan" => $kdKecamatan
                                ),
                            ),
                        ),
                    ),
                    "tujuanKunj" => $tujuanKunj,
                    "flagProcedure" => $flagProcedure,
                    "kdPenunjang" => $kdPenunjang,
                    "assesmentPel" => $assesmentPel,
                    "skdp" => array(
                        "noSurat" => $noSurat,
                        "kodeDPJP" => $kodeDPJP
                    ),
                    "dpjpLayan" => $dpjpLayan,
                    "noTelp" => $noTelp,
                    "user" => $user
                )
            )
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/sep/insert_sep");
        $result = curl_exec($ch);

        $kode = json_decode($result, true);
        if ($kode['metaData']['code'] == 200) {
            $noSep = $kode['response']['sep']['noSep'];
            $db->query("INSERT INTO tbl_sep (noSep, noKartu, tglSep, ppkPelayanan, jnsPelayanan, klsRawatHak, klsRawatNaik, pembiayaan, penanggungJawab, noMR, asalRujukan, tglRujukan, noRujukan, ppkRujukan, catatan, diagAwal, tujuan, eksekutif, cob, katarak, lakaLantas, noLP, tglKejadian, keterangan, suplesi, noSepSuplesi, kdPropinsi, kdKabupaten, kdKecamatan, tujuanKunj, flagProcedure, kdPenunjang, assesmentPel, noSurat, kodeDPJP, dpjpLayan, noTelp, user, no_pendaftaran, tanggal_pembuatan) VALUES ('$noSep', '$noKartu', '$tglSep', '$ppkPelayanan', '$jnsPelayanan', '$klsRawatHak', '$klsRawatNaik', '$pembiayaan', '$penanggungJawab', '$noMR', '$asalRujukan', '$tglRujukan', '$noRujukan', '$ppkRujukan', '$catatan', '$diagAwal', '$tujuan', '$eksekutif', '$cob', '$katarak', '$lakaLantas', '$noLP', '$tglKejadian', '$keterangan', '$suplesi', '$noSuplesi', '$kdPropinsi', '$kdKabupaten', '$kdKecamatan', '$tujuanKunj', '$flagProcedure', '$kdPenunjang', '$assesmentPel', '$noSurat', '$kodeDPJP', '$dpjpLayan', '$noTelp', '$user', '$noDaftar', '$tanggal')");
        }

        curl_close($ch);
        return $result;
    }

    function editSep()
    {
        include "../../../3rdparty/engine.php";
        $noSep = $_POST['noSep'];
        $noKartu = $_POST['noKartu'];
        $tglSep = $_POST['tglSep'];
        $ppkPelayanan = $_POST['ppkPelayanan'];
        $jnsPelayanan = $_POST['jnsPelayanan'];
        $klsRawatHak = $_POST['klsRawatHak'];
        $klsRawatNaik = '';
        $pembiayaan = '';
        $penanggungJawab = '';
        $noMR = $_POST['noMR'];
        $noRujukan = $_POST['noRujukan'];
        $asalRujukan = $_POST['asalRujukan'];
        $tglRujukan = $_POST['tglRujukan'];
        $ppkRujukan = $_POST['ppkRujukan'];
        $catatan = $_POST['catatan'];
        $diagAwal = $_POST['diagAwal'];
        $tujuan = $_POST['tujuan'];
        $eksekutif = $_POST['eksekutif'];
        $cob = $_POST['cob'];
        $katarak = $_POST['katarak'];
        $lakaLantas = '0';
        $noLP = '';
        $tglKejadian = '';
        $keterangan = '';
        $suplesi = '0';
        $noSuplesi = '';
        $kdPropinsi = '';
        $kdKabupaten = '';
        $kdKecamatan = '';
        $tujuanKunj = $_POST['tujuanKunj'];
        $flagProcedure = '';
        $kdPenunjang = '';
        $assesmentPel = $_POST['assesmentPel'];
        $noSurat = $_POST['noSurat'];
        $kodeDPJP = $_POST['kodeDPJP'];
        $dpjpLayan = $_POST['dpjpLayan'];
        $noTelp = $_POST['noTelp'];
        $user = $_POST['user'];
        $noDaftar = $_POST['noDaftar'];
        $tanggal = date('Y-m-d H:i');

        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();

        $dataA =  array(
            "request" => array(
                "t_sep" => array(
                    "noSep" => $noSep,
                    "klsRawat" => array(
                        "klsRawatHak" => $klsRawatHak,
                        "klsRawatNaik" => $klsRawatNaik,
                        "pembiayaan" => $pembiayaan,
                        "penanggungJawab" => $penanggungJawab,
                    ),
                    "noMR" => $noMR,
                    "catatan" => $catatan,
                    "diagAwal" => $diagAwal,
                    "poli" => array(
                        "tujuan" => $tujuan,
                        "eksekutif" => $eksekutif,
                    ),
                    "cob" => array(
                        "cob" => $cob
                    ),
                    "katarak" => array(
                        "katarak" => $katarak
                    ),
                    "jaminan" => array(
                        "lakaLantas" => $lakaLantas,
                        "penjamin" => array(
                            "tglKejadian" => $tglKejadian,
                            "keterangan" => $keterangan,
                            "suplesi" => array(
                                "suplesi" => $suplesi,
                                "noSepSuplesi" => $noSepSuplesi,
                                "lokasiLaka" => array(
                                    "kdPropinsi" => $kdPropinsi,
                                    "kdKabupaten" => $kdKabupaten,
                                    "kdKecamatan" => $kdKecamatan
                                ),
                            ),
                        ),
                    ),
                    "dpjpLayan" => $dpjpLayan,
                    "noTelp" => $noTelp,
                    "user" => $user
                )
            )
        );

        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/sep/update_sep");
        $result = curl_exec($ch);

        $kode = json_decode($result, true);
        if ($kode['metaData']['code'] == 200) {
            $db->query("UPDATE tbl_sep SET klsRawatHak = '$klsRawatHak', klsRawatNaik = '$klsRawatNaik', pembiayaan = '$pembiayaan', penanggungJawab = '$penanggungJawab', noMR = '$noMR', catatan = '$catatan', diagAwal = '$diagAwal', tujuan = '$tujuan', eksekutif = '$eksekutif', cob = '$cob', katarak ='$katarak', lakaLantas='$lakaLantas', noLP='$noLP', tglKejadian='$tglKejadian', keterangan='$keterangan', suplesi='$suplesi', noSepSuplesi='$noSepSuplesi', kdPropinsi='$kdPropinsi', kdKabupaten='$kdKabupaten', kdKecamatan='$kdKecamatan' , dpjpLayan = '$dpjpLayan', noTelp = '$noTelp', user = '$user', tanggal_pembuatan = '$tanggal' WHERE noSep = '$noSep'");
        }

        curl_close($ch);
        return $result;
    }

    function hapusSep($noSep, $userName)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "request" => array(
                "t_sep" => array(
                    "noSep" => $noSep,
                    "user" => $userName
                ),
            ),
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/sep/delete_sep");
        $result = curl_exec($ch);

        $kode = json_decode($result, true);
        if ($kode['metaData']['code'] == 200) {
            $db->query("DELETE FROM tbl_sep WHERE noSep = '$noSep'");
        }

        curl_close($ch);
        return $result;
    }

    function getCariFaskesRujukan($keyFaskes, $keyJenisFaskes)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "faskes" => $keyFaskes,
            "jenis" => $keyJenisFaskes
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/referensi/faskes");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getCariPoliRujukan($keyPoli)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "poli" => $keyPoli,
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/referensi/poli");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getDataSep($noSep)
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT * FROM tbl_sep WHERE noSep = '$noSep'");
        return json_encode($query);
    }

    function getDiagnosaEdit($icd)
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT * FROM tbl_icd WHERE kode_icd = '$icd'");
        return json_encode($query);
    }

    function createRujukan()
    {
        include "../../../3rdparty/engine.php";
        $tglPembuatan = date('Y-m-d H:i');
        $noSep = $_POST['noSep'];
        $tglRujukan = $_POST['tglRujukan'];
        $tglRencanaKunjungan = $_POST['tglRencanaKunjungan'];
        $ppkDirujuk = $_POST['ppkDirujuk'];
        $namaPpk = $_POST['namaPpk'];
        $jnsPelayanan = $_POST['jnsPelayanan'];
        $catatan = $_POST['catatan'];
        $diagnosa = $_POST['diagnosa'];
        $tipeRujukan = $_POST['tipeRujukan'];
        $poliRujukan = $_POST['poliRujukan'];
        $namaPoliRujukan = $_POST['namaPoliRujukan'];
        $user = $_POST['user'];

        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();

        $dataA =  array(
            "request" => array(
                "t_rujukan" => array(
                    "noSep" => $noSep,
                    "tglRujukan" => $tglRujukan,
                    "tglRencanaKunjungan" => $tglRencanaKunjungan,
                    "ppkDirujuk" => $ppkDirujuk,
                    "jnsPelayanan" => $jnsPelayanan,
                    "catatan" => $catatan,
                    "diagRujukan" => $diagnosa,
                    "tipeRujukan" => $tipeRujukan,
                    "poliRujukan" => $poliRujukan,
                    "user" => $user
                )
            )
        );

        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/insert_rujukan");
        $result = curl_exec($ch);

        $kode = json_decode($result, true);
        if ($kode['metaData']['code'] == 200) {
            $nRujukan = $kode['response']['rujukan']['noRujukan'];
            $db->query("INSERT INTO tbl_rujukan_bpjs (noRujukan, noSep, tglRujukan, tglRencanaKunjungan, ppkDirujuk, namaPpk, jnsPelayanan, catatan, diagRujukan, tipeRujukan, poliRujukan, namaPoliRujukan, user, tanggalPembuatan) VALUES ('$nRujukan', '$noSep', '$tglRujukan', '$tglRencanaKunjungan', '$ppkDirujuk', '$namaPpk', '$jnsPelayanan', '$catatan', '$diagnosa', '$tipeRujukan', '$poliRujukan', '$namaPoliRujukan', '$user', '$tglPembuatan')");
        }

        curl_close($ch);
        return $result;
    }

    function editRujukan()
    {
        include "../../../3rdparty/engine.php";
        $tglPembuatan = date('Y-m-d H:i');
        $noRujukan = $_POST['noRujukan'];
        $tglRujukan = $_POST['tglRujukan'];
        $tglRencanaKunjungan = $_POST['tglRencanaKunjungan'];
        $ppkDirujuk = $_POST['ppkDirujuk'];
        $namaPpk = $_POST['namaPpk'];
        $jnsPelayanan = $_POST['jnsPelayanan'];
        $catatan = $_POST['catatan'];
        $diagnosa = $_POST['diagnosa'];
        $tipeRujukan = $_POST['tipeRujukan'];
        $poliRujukan = $_POST['poliRujukan'];
        $namaPoliRujukan = $_POST['namaPoliRujukan'];
        $user = $_POST['user'];

        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();

        $dataA =  array(
            "request" => array(
                "t_rujukan" => array(
                    "noRujukan" => $noRujukan,
                    "tglRujukan" => $tglRujukan,
                    "tglRencanaKunjungan" => $tglRencanaKunjungan,
                    "ppkDirujuk" => $ppkDirujuk,
                    "jnsPelayanan" => $jnsPelayanan,
                    "catatan" => $catatan,
                    "diagRujukan" => $diagnosa,
                    "tipeRujukan" => $tipeRujukan,
                    "poliRujukan" => $poliRujukan,
                    "user" => $user
                )
            )
        );

        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/update_rujukan");
        $result = curl_exec($ch);

        $kode = json_decode($result, true);
        if ($kode['metaData']['code'] == 200) {
            $nRujukan = $kode['response'];

            $ceknRujukan = $db->query("SELECT noRujukan FROM tbl_rujukan_bpjs WHERE noRujukan = '$nRujukan'");
            if (count($ceknRujukan) > 0) {
                $db->query("UPDATE tbl_rujukan_bpjs SET tglRujukan = '$tglRujukan', tglRencanaKunjungan = '$tglRencanaKunjungan', ppkDirujuk = '$ppkDirujuk', namaPpk = '$namaPpk', jnsPelayanan='$jnsPelayanan', catatan='$catatan', diagRujukan = '$diagnosa', tipeRujukan = '$tipeRujukan', poliRujukan = '$poliRujukan', namaPoliRujukan ='$namaPoliRujukan', user='$user', tanggalPembuatan = '$tglPembuatan' WHERE noRujukan = '$nRujukan'");
            } else {
                $db->query("INSERT INTO tbl_rujukan_bpjs (noRujukan, noSep, tglRujukan, tglRencanaKunjungan, ppkDirujuk, namaPpk, jnsPelayanan, catatan, diagRujukan, tipeRujukan, poliRujukan, namaPoliRujukan, user, tanggalPembuatan) VALUES ('$nRujukan', '', '$tglRujukan', '$tglRencanaKunjungan', '$ppkDirujuk', '$namaPpk', '$jnsPelayanan', '$catatan', '$diagnosa', '$tipeRujukan', '$poliRujukan', '$namaPoliRujukan', '$user', '$tglPembuatan')");
            }
        }

        curl_close($ch);
        return $result;
    }

    function cariRujukanKeluar($tglMulai, $tglAkhir)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA =  array(
            "tglMulai" => $tglMulai,
            "tglAkhir" => $tglAkhir
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/rujukan_keluar_rs");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function hapusRujukan($noRujukan)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $user = $_SESSION['rg_user'];
        $ch = curl_init();
        $dataA =  array(
            "request" => array(
                "t_rujukan" => array(
                    "noRujukan" => $noRujukan,
                    "user" => $user
                )
            )
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/delete_rujukan");
        $result = curl_exec($ch);

        $kode = json_decode($result, true);
        if ($kode['metaData']['code'] == 200) {
            $db->query("DELETE FROM tbl_rujukan_bpjs WHERE noRujukan = '$noRujukan'");
        }

        curl_close($ch);
        return $result;
    }

    function getDataRujukan($noRujukan)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "no_rujukan" => $noRujukan
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/norujukan_keluar");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getCariDataKunjungan($tgl, $jenis_pelayanan)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "tgl_sep" => $tgl,
            "jns_pelayanan" => $jenis_pelayanan
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/monitoring/data_kunjungan");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getHistoriPelayanan($noka)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $akhir = date('Y-m-d');
        $awal = date('Y-m-d', strtotime($akhir . ' - 89 days'));
        $ch = curl_init();
        $dataA = array(
            "noka" => $noka,
            "tgl_mulai" => $awal,
            "tgl_akhir" => $akhir
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/monitoring/histori_pelayanan");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRefDiagnosa($keyDiagnosa)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "diagnosa" => $keyDiagnosa
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/referensi/diagnosa");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRefPoliklinik($keyPoliklinik)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "poli" => $keyPoliklinik
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/referensi/poli");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRefFaskes($keyFaskes, $jenis)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "faskes" => $keyFaskes,
            "jenis" => $jenis
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/referensi/faskes");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function getRefDpjp($kodePoli, $tglLayanan, $jenis)
    {
        include "../../../3rdparty/engine.php";
        $link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
        $ch = curl_init();
        $dataA = array(
            "jenis_layanan" => $jenis,
            "tgl_layanan" => $tglLayanan,
            "kode_spesialis" => $kodePoli
        );
        $payload = json_encode($dataA);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/referensi/dpjp_layan");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

	function cekNikMaster($no_ktp)
    {
        include "../../../3rdparty/engine.php";
        $query = $db->query("SELECT
            no_ktp, nomr, nm_pasien
            FROM
            tbl_pasien
            WHERE no_ktp = '$no_ktp'
        ");
        $respon = [
            "jumlahData" => count($query),
            "body" => $query
        ];
        return json_encode($respon);
    }

	function approveDokumen($id, $angka)
    {
        include "../../../3rdparty/engine.php";
        if ($angka == 1) {
            $db->query("UPDATE tbl_travel_detail SET approve_dok1 = 'Ya' WHERE id = '$id'");
        } else if ($angka == 2) {
            $db->query("UPDATE tbl_travel_detail SET approve_dok2 = 'Ya' WHERE id = '$id'");
        } else if ($angka == 3) {
            $db->query("UPDATE tbl_travel_detail SET approve_dok3 = 'Ya' WHERE id = '$id'");
        } else {
            $db->query("UPDATE tbl_travel_detail SET approve_dok4 = 'Ya' WHERE id = '$id'");
        }
        $respon = [
            "pesan" => 0
        ];
        return json_encode($respon);
    }

    if ($jenis_query == "Data Pendaftaran") {
        $noDaftar = $_POST['noDaftar'];
        echo getDataPendaftaran($noDaftar);
    } else if ($jenis_query == "Kode PPK") {
        echo getPPK();
    } else if ($jenis_query == "Jenis Pelayanan") {
        echo getJnsPelayanan($jenis_query);
    } else if ($jenis_query == "Peserta") {
        $noKartu = $_POST['noKartu'];
        echo getPeserta($noKartu);
    } else if ($jenis_query == "Rujukan PCARE") {
        $noKartu = $_POST['noKartu'];
        echo getRujukanPcare($noKartu);
    } else if ($jenis_query == "Rujukan RS") {
        $noKartu = $_POST['noKartu'];
        echo getRujukanRs($noKartu);
    } else if ($jenis_query == "Poli") {
        echo getPoli();
    } else if ($jenis_query == "Eksekutif") {
        echo getEksekutif();
    } else if ($jenis_query == "COB") {
        echo getCob();
    } else if ($jenis_query == "Katarak") {
        echo getKatarak();
    } else if ($jenis_query == "Tujuan Kunjungan") {
        echo getTujuanKunjungan();
    } else if ($jenis_query == "Asesmen Pelayanan") {
        echo getAsesmenPelayanan();
    } else if ($jenis_query == "Diagnosa") {
        $keyDiagnosa = $_POST['keyDiagnosa'];
        echo getDiagnosa($keyDiagnosa);
    } else if ($jenis_query == "DPJP Layanan") {
        echo getDpjp();
    } else if ($jenis_query == "Kelas") {
        echo getKelas();
    } else if ($jenis_query == "Create SEP") {
        echo createSep();
    } else if ($jenis_query == "Hapus SEP") {
        $noSep = $_POST['noSep'];
        $userName = $_POST['userName'];
        echo hapusSep($noSep, $userName);
    } else if ($jenis_query == "Data Sep") {
        $noSep = $_POST['noSep'];
        echo getDataSep($noSep);
    } else if ($jenis_query == "Diagnosa Edit") {
        $icd = $_POST['icd'];
        echo getDiagnosaEdit($icd);
    } else if ($jenis_query == "Edit SEP") {
        echo editSep();
    } else if ($jenis_query == "Tipe Rujukan") {
        echo getTipeRujukan();
    } else if ($jenis_query == "Cari Faskes") {
        $keyFaskes = $_POST['keyFaskes'];
        $keyJenisFaskes = $_POST['keyJenisFaskes'];
        echo getCariFaskesRujukan($keyFaskes, $keyJenisFaskes);
    } else if ($jenis_query == "Cari Poli Rujukan") {
        $keyPoli = $_POST['keyPoli'];
        echo getCariPoliRujukan($keyPoli);
    } else if ($jenis_query == "Create Rujukan") {
        echo createRujukan();
    } else if ($jenis_query == "Cari Rujukan Keluar") {
        $tglMulai = $_POST['tglMulai'];
        $tglAkhir = $_POST['tglAkhir'];
        echo cariRujukanKeluar($tglMulai, $tglAkhir);
    } else if ($jenis_query == "Hapus Rujukan") {
        $noRujukan = $_POST['noRujukan'];
        echo hapusRujukan($noRujukan);
    } else if ($jenis_query == "Data Rujukan") {
        $noRujukan = $_POST['noRujukan'];
        echo getDataRujukan($noRujukan);
    } else if ($jenis_query == "Edit Rujukan") {
        echo editRujukan();
    } else if ($jenis_query == "Cari Data Kunjungan") {
        $tgl = $_POST['tgl'];
        $jenis_pelayanan = $_POST['jenis_pelayanan'];
        echo getCariDataKunjungan($tgl, $jenis_pelayanan);
    } else if ($jenis_query == "Histori Pelayanan") {
        $noka = $_POST['noka'];
        echo getHistoriPelayanan($noka);
    } else if ($jenis_query == "Referensi Diagnosa") {
        $keyDiagnosa = $_POST['keyDiagnosa'];
        echo getRefDiagnosa($keyDiagnosa);
    } else if ($jenis_query == "Referensi Poliklinik") {
        $keyPoliklinik = $_POST['keyPoliklinik'];
        echo getRefPoliklinik($keyPoliklinik);
    } else if ($jenis_query == "Referensi Faskes") {
        $keyFaskes = $_POST['keyFaskes'];
        $jenis = $_POST['jenis'];
        echo getRefFaskes($keyFaskes, $jenis);
    } else if ($jenis_query == "Referensi DPJP") {
        $kodePoli = $_POST['kodePoli'];
        $tglLayanan = $_POST['tglLayanan'];
        $jenis = $_POST['jenis'];
        echo getRefDpjp($kodePoli, $tglLayanan, $jenis);
    } else if ($jenis_query == "Cek NIK Master Pasien") {
        $no_ktp = $_POST['no_ktp'];
        echo cekNikMaster($no_ktp);
    } else if ($jenis_query == "Approve Dokumen") {
        $id = $_POST['id'];
        $angka = $_POST['angka'];
        echo approveDokumen($id, $angka);
    }
}
