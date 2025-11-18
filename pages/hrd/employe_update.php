<?php

session_start();
include "../../3rdparty/engine.php";
print_r($_session);
if ($_SESSION['at_user'] != '') {
    $data = $db->query("select * from tbl_karyawan where nip='" . $_POST['nip'] . "'");
    $t1 = explode("/", $_POST['tgl_exp']);
    $date1 = $t1[2] . '-' . $t1[0] . '-' . $t1[1];
    $t2 = explode("/", $_POST['tanggal_lahir']);
    $date2 = $t2[2] . '-' . $t2[0] . '-' . $t2[1];
    $t = explode(".", $_FILES['foto']['name']);
    $nt = count($t) - 1;
    if ($_FILES['foto']['name'] == "") {
        $nama_foto = $data[0]['foto'];
    } else {
        $nama_foto = $_POST['nip'] . '.' . $t[$nt];
    }
    $lantai_nama = $db->queryItem("select nama from tbl_lantai where id='" . $_POST['lantai'] . "'");
    $unit_nama = $db->queryItem("select nama_unit from tbl_unit where id='" . $_POST['unit'] . "'");

    if ($_FILES['foto']['tmp_name'] != "") {
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../employee/$nama_foto");
    }

    $tgl_exp_su = empty($_POST['tgl_exp_su']) ? 0 : 1;

    $insert = $db->query("update tbl_karyawan set "
            . "nip='" . $_POST['nip'] . "', "
            . "nama='" . $_POST['nama'] . "', "
            . "lantai_id='" . $_POST['lantai'] . "', "
            . "lantai_nama='$lantai_nama', "
            . "unit_id='" . $_POST['unit'] . "', "
            . "unit_nama='$unit_nama', "
            . "jabatan='" . $_POST['jabatan'] . "', "
            . "tanggal_lahir='" . $date2. "', "
	    	. "foto='" . $nama_foto . "', "
            . "tempat_lahir='" . $_POST['tempat_lahir'] . "', "
            . "STATUS_KERJA='" . $_POST['STATUS_KERJA'] . "', "
            . "PENDIDIKAN='" . $_POST['PENDIDIKAN'] . "', "
            . "JURUSAN='" . $_POST['JURUSAN'] . "', "
            . "TAHUN='" . $_POST['TAHUN'] . "', "
            . "MARITAL_STATUS='" . $_POST['MARITAL_STATUS'] . "', "
            . "AGAMA='" . $_POST['AGAMA'] . "', "
            . "TGL_MASUK='" . $_POST['TGL_MASUK'] . "', "
            . "NO_HP='" . $_POST['NO_HP'] . "', "
            . "NO_HP2='" . $_POST['NO_HP2'] . "', "
            . "BAGIAN='" . $_POST['BAGIAN'] . "', "
            . "username='" . $_POST['username'] . "', "
            . "password=md5('" . $_POST['password'] . "'), "
            . "golongan='" . $_POST['golongan'] . "', "
            . "alamat='" . $_POST['alamat'] . "', "
            . "gender='" . $_POST['gender'] . "', "
            . "tanggal_lahir='" . $date2 . "', "
            . "uid='" . $_POST['uid'] . "', "
            . "no_ktp='" . $_POST['no_ktp'] . "', "
            . "tgl_exp='" . $date1 . "', "
            . "tgl_exp_su='" . $tgl_exp_su . "', "
            . "email_1='" . $_POST['email_1'] . "', "
            . "email_2='" . $_POST['email_2'] . "', "
            . "no_darurat='" . $_POST['no_darurat'] . "', "
            . "nama_darurat='" . $_POST['nama_darurat'] . "' "
            . " where id='" . $_POST['id'] . "'", 0);
    $insert_log = $db->query("insert into tbl_log_user (userid, nama, melakukan) values ('".$_SESSION['at_user']."', '".$_SESSION['at_nama']."', 'Update Data Karyawan')");
    //echo 'test';
    //print_r($_POST);
}
header("location:../../index.php?mod=master&submod=employe");
?>