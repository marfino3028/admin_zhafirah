<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
      <title>Klinik Information System | Technocare</title>
      <link href="style.css" rel="stylesheet" media="all" />
      <script type="text/javascript" src="../../js/jquery-1.3.2.js"></script>
      <script type="text/javascript" src="../../js/superfish.js"></script>
      <script type="text/javascript" src="../../js/jquery-ui-1.8.18.custom.min.js"></script>
      <script type="text/javascript" src="../../js/tooltip.js"></script>
      <script type="text/javascript" src="../../js/cookie.js"></script>
      <script type="text/javascript" src="../../js/custom.js"></script>
      <script type="text/javascript" src="../../js/utama.js"></script>
  </head>
  <body>
 	<p style="text-align: center;"><strong>HASIL PEMERIKSAAN LABORATORIUM</strong></p>
    <?php
        include "../../3rdparty/engine.php";
        ini_set("display_errors", 0);
        $data = $db->query("select * from tbl_lab where status_delete='UD'");
    	//$data = $db->query("select * from tbl_lab where md5(no_lab)='".$_GET['d1']."'");
    	$pasien = $db->query("select * from tbl_pasien where nomr='".$data[0]['nomr']."'");
    	$daftar = $db->query("select a.kode_dokter, b.nama_dokter from tbl_pendaftaran a left join tbl_dokter b on b.kode_dokter=a.kode_dokter where a.no_daftar='".$data[0]['no_daftar']."'");
    	if ($daftar[0]['kode_dokter'] == 'LAB') $daftar[0]['nama_dokter'] = 'Dokter ICU';
    ?>
    <div style="margin-left: 20px; margin-right: 20px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="150">Tanggal</td>
          <td width="10">:</td>
          <td><?php echo date("d F Y", strtotime($data[0]['tgl_input_lab']))?></td>
        </tr>
        <tr>
          <td width="150">Nomor Lab</td>
          <td>:</td>
          <td><?php echo $data[0]['no_lab']?></td>
        </tr>
        <tr>
          <td width="150">Nama Pasien</td>
          <td>:</td>
          <td><?php echo $data[0]['nama']?></td>
        </tr>
        <tr>
          <td width="150">Umur</td>
          <td>:</td>
          <td><?php echo date("d F Y", strtotime($pasien[0]['tgl_lahir']))?></td>
        </tr>
        <tr>
          <td width="150">Alamat</td>
          <td>:</td>
          <td><?php echo $pasien[0]['alamat_pasien']?></td>
        </tr>
        <tr>
          <td width="150">Pengirim</td>
          <td>:</td>
          <td><?php echo $daftar[0]['kode_dokter'].' - '.$daftar[0]['nama_dokter']?></td>
        </tr>
        <tr>
          <td width="150">Alamat Pengirim</td>
          <td>:</td>
          <td>KLINIK ABADA INTI MEDIKA</td>
        </tr>
      </table>
    </div>

	<div style="margin-left: 20px; margin-right: 20px; margin-top: 20px" align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: solid 1px #000000">
        <tr>
          <td style="border-bottom: #000000 solid 10px;"><p style="margin-left: 10px;"><strong>Jenis Pemeriksaan</strong></p></td>
          <td style="border-bottom: #000000 solid 10px;"><p style="margin-left: 10px;"><strong>Hasil</strong></p></td>
          <td style="border-bottom: #000000 solid 10px;"><p style="margin-left: 10px;"><strong>Nilai Rujukan</strong></p></td>
          <td style="border-bottom: #000000 solid 10px;"><p style="margin-left: 10px;"><strong>Satuan</strong></p></td>
        </tr>
        <?php
  			$lab = $db->query("select * from tbl_lab_detail where md5(no_lab)='".$_GET['d1']."'");
            for ($i = 0; $i < count($lab); $i++) {
        ?>
        <tr>
          <td><p style="margin-left: 10px; margin-top: 5px; margin-bottom: 8px;"><?php echo $lab[$i]['nama_tindakan']?></p></td>
          <td><p style="margin-left: 10px; margin-top: 5px; margin-bottom: 8px;"><?php echo $lab[$i]['hasil']?></p></td>
          <td><p style="margin-left: 10px; margin-top: 5px; margin-bottom: 8px;"><?php echo $lab[$i]['normal']?></p></td>
          <td><p style="margin-left: 10px; margin-top: 5px; margin-bottom: 8px;"><?php echo $lab[$i]['satuan']?></p></td>
        </tr>
        <?php
            }
  		?>
      </table>
      <p style="margin-left: 0px; text-align: left;"><strong>Penanggung Jawab (<?php echo $daftar[0]['kode_dokter'].' - '.$daftar[0]['nama_dokter']?>)</strong></p>
      <div style="float: right; width: 200px;">
        <p style="text-align: center; margin-top: 0px;">Pemeriksa</p>
        <p style="text-align: center; margin-top: 100px;">(<?php echo $daftar[0]['kode_dokter'].' - '.$daftar[0]['nama_dokter']?>)</p>
      </div>
    </div>
    
  </body>
</html>