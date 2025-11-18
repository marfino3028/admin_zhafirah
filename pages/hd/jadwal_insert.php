<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	//echo '<pre>';
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$mulai = date('Y-m-d', strtotime($_POST['tgl_mulai']));
		$selesai = date('Y-m-d', strtotime($_POST['tahun'].'-12-31'));

        $awal_bulan  = date('n', strtotime($_POST['tgl_mulai']));
        $akhir_bulan = 12; // waktu sekarang
        $diff  = date_diff( $awal, $akhir );
        
        $daftar = $db->query("select * from tbl_pendaftaran where md5(no_daftar)='".$_POST['id']."'");
        $pasien = $db->query("select * from tbl_pasien where nomr='".$daftar[0]['nomr']."'");
        
        //hapus data sebelumnya
        $delete = $db->query("delete from tbl_jadwal_hd where no_daftar='".$daftar[0]['no_daftar']."' and jadwal > '$mulai' and year(jadwal)='".$_POST['tahun']."'");

        //Penentuan Hari
        for ($i = 1; $i <= $_POST['waktu']; $i++) {
            if ($_POST['checkbox0'] > 0) {
                $hari[$i] = $_POST['checkbox0'];
                $_POST['checkbox0'] = 0;
            }
            else {
                if ($_POST['checkbox1'] > 0) {
                    $hari[$i] = $_POST['checkbox1'];
                    $_POST['checkbox1'] = 0;
                }
                else {
                    if ($_POST['checkbox2'] > 0) {
                        $hari[$i] = $_POST['checkbox2'];
                        $_POST['checkbox2'] = 0;
                    }
                    else {
                        if ($_POST['checkbox3'] > 0) {
                            $hari[$i] = $_POST['checkbox3'];
                            $_POST['checkbox3'] = 0;
                        }
                        else {
                            if ($_POST['checkbox4'] > 0) {
                                $hari[$i] = $_POST['checkbox4'];
                                $_POST['checkbox4'] = 0;
                            }
                            else {
                                if ($_POST['checkbox5'] > 0) {
                                    $hari[$i] = $_POST['checkbox5'];
                                    $_POST['checkbox5'] = 0;
                                }
                                else {
                                    if ($_POST['checkbox6'] > 0) $hari[$i] = $_POST['checkbox6'];
                                }
                            }
                        }
                    }
                }
            }
        }
        print_r($hari);

		//echo "$mulai dan $selesai dan selisihnya adalah ".$diff->m;
        $no = 0;
		for ($i = $awal_bulan; $i <= $akhir_bulan; $i++) {
		    $no = $no + 1;
		    $jml_hari = cal_days_in_month(CAL_GREGORIAN, $i, $_POST['tahun']);

		    if ($no == 1) $tgl_mulai = date('j', strtotime($_POST['tgl_mulai']));
		    else $tgl_mulai = 1;
		    
		    echo "$no. Bulan ke-$i tahun ".$_POST['tahun'].' ada '.$jml_hari.' Hari mulai dari tanggal '.$tgl_mulai.'<br>';
		    for ($j = $tgl_mulai; $j <= $jml_hari; $j++) {
		        $tgl[$i][$j] = $_POST['tahun']."-$i-$j";
		        $tgl[$i][$j]['hari'] = date("w", strtotime($tgl[$i][$j]));
		        if ($tgl[$i][$j]['hari'] == $hari[1] or $tgl[$i][$j]['hari'] == $hari[2] or $tgl[$i][$j]['hari'] == $hari[3] or $tgl[$i][$j]['hari'] == $hari[4] or $tgl[$i][$j]['hari'] == $hari[5] or $tgl[$i][$j]['hari'] == $hari[6] or $tgl[$i][$j]['hari'] == $hari[7]) { 
		            //echo "Tanggal ".$_POST['tahun']."-$i-$j yaitu hari ".$tgl[$i][$j]['hari']."<br>";
		            //Masukkan ke database
		            $insert = $db->query("insert into tbl_jadwal_hd (nomr, no_daftar, nama, tgl_lahir, jadwal) values ('".$pasien[0]['nomr']."', '".$daftar[0]['no_daftar']."', '".$pasien[0]['nm_pasien']."', '".$pasien[0]['tgl_lahir']."', '".$_POST['tahun']."-$i-$j')");
		        }
		    }
		}
		
		$insert = $db->query("insert into tbl_jadwal_hd_header (tahun, frek, no_daftar) values ('".$_POST['tahun']."', '".$_POST['waktu']."', '".$daftar[0]['no_daftar']."')");
		header("location:../../index.php?mod=hd&submod=jadwal_hd&id=".$_POST['id']);

	}
?>