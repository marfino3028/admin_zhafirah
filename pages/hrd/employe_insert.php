<?php

session_start();
include "../../3rdparty/engine.php";
//print_r($_POST);
//print_r($_FILES);
$t = explode(".", $_FILES['foto']['name']);
$nt = count($t) - 1;

if ($_SESSION['at_user'] != '') {
    $t1 = explode("/", $_POST['tgl_exp']);
    $date1 = $t1[2] . '-' . $t1[0] . '-' . $t1[1];
    $t2 = explode("/", $_POST['tanggal_lahir']);
    $date2 = $t2[2] . '-' . $t2[0] . '-' . $t2[1];
    $t3 = explode("/", $_POST['TGL_MASUK']);
    $_POST['TGL_MASUK'] = $t3[2] . '-' . $t3[0] . '-' . $t3[1];
    
    $nama_foto = $_POST['nip'] . '.' . $t[$nt];
    $lantai_nama = $db->queryItem("select nama from tbl_lantai where id='" . $_POST['lantai'] . "'");
    $unit_nama = $db->queryItem("select nama_unit from tbl_unit where id='" . $_POST['unit'] . "'");

    if ($_FILES['foto']['tmp_name'] != "") {
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../../employee/$nama_foto");
    }

    $insert = $db->query("insert into tbl_karyawan (nip, "
            . "nama, "
            . "lantai_id, "
            . "lantai_nama, "
            . "unit_id, "
            . "unit_nama, "
            . "jabatan, "
            . "foto, "
            . "tempat_lahir, "
            . "tanggal_lahir, "
            . "uid,"
            . "STATUS_KERJA,"
            . "PENDIDIKAN,"
            . "JURUSAN,"
            . "TAHUN,"
            . "MARITAL_STATUS,"
            . "AGAMA,"
            . "TGL_MASUK,"
            . "NO_HP,"
            . "NO_HP2,"
            . "BAGIAN, "
            . "alamat, "
            . "gender, "
            . "username,"
            . "password,"
            . "no_ktp,"
            . "tgl_exp,"
            . "tgl_exp_su,"
            . "email_1,"
            . "email_2,"
            . "no_darurat,"
            . "nama_darurat"
            . ") 
            values 
            ("
            . "'" . $_POST['nip'] . "', "
            . "'" . $_POST['nama'] . "', "
            . "'" . $_POST['lantai'] . "', "
            . "'$lantai_nama', "
            . "'" . $_POST['unit'] . "', "
            . "'$unit_nama', "
            . "'" . $_POST['jabatan'] . "', "
            . "'" . $nama_foto . "', "
            . "'" . $_POST['tempat_lahir'] . "', "
            . "'" . $date2 . "', "
            . "'" . $_POST['uid'] . "', "
            . "'" . $_POST['STATUS_KERJA'] . "', "
            . "'" . $_POST['PENDIDIKAN'] . "', "
            . "'" . $_POST['JURUSAN'] . "', "
            . "'" . $_POST['TAHUN'] . "', "
            . "'" . $_POST['MARITAL_STATUS'] . "', "
            . "'" . $_POST['AGAMA'] . "', "
            . "'" . $_POST['TGL_MASUK'] . "', "
            . "'" . $_POST['NO_HP'] . "', "
            . "'" . $_POST['NO_HP2'] . "', "
            . "'" . $_POST['BAGIAN'] . "', "
            . "'" . $_POST['alamat'] . "', "
            . "'" . $_POST['gender'] . "', "
            . "'" . $_POST['username'] . "', "
            . "md5('" . $_POST['password'] . "'), "
            . "'" . $_POST['no_ktp'] . "', "
            . "'" . $date1 . "', "
            . "'" . $_POST['tgl_exp_su'] . "', "
            . "'" . $_POST['email_1'] . "', "
            . "'" . $_POST['email_2'] . "', "
            . "'" . $_POST['no_darurat'] . "', "
            . "'" . $_POST['nama_darurat'] . "' "
            . ")");
	$insert_log = $db->query("insert into tbl_log_user (userid, nama, melakukan) values ('".$_SESSION['at_user']."', '".$_SESSION['at_nama']."', 'Tambah Data Karyawan Baru')");
}
header("location:../../index.php?mod=master&submod=employe");
?>