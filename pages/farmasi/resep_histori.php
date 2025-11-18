<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pembayaran Pasien</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
	$pasien = $db->query("select * from tbl_pasien where md5(nomr)='".$_GET['id']."'");
?>
    <div align="left">
        <p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 12px; margin-top: 20px;">
            Resep History Pasien
        </p>
        <p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
            NoMR : <?php echo $pasien[0]['nomr']?><br />
            Nama Pasien : <?php echo $pasien[0]['nm_pasien']?>
        </p>
        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
            <thead> 
            <tr>
                <th style="text-align: center">No</th> 
                <th style="text-align: center">Keterangan</th> 
                <th style="text-align: center">Nama Obat</th> 
                <th style="text-align: center">Qty</th> 
                <th style="text-align: center">Frekuensi</th> 
                <th style="text-align: center">APD</th> 
            </tr> 
            </thead> 
            <tbody> 
            <?php
                $totgigi = 0;
                $adm = $db->query("select * from tbl_resep where md5(nomr)='".$_GET['id']."' and status_delete='UD'", 0);
                for ($i = 0; $i < count($adm); $i++) {
                    $daftar = $db->query("select nama_perusahaan, kode_dokter, tgl_daftar, dokter_pengirim_kode from tbl_pendaftaran where no_daftar='".$adm[$i]['no_daftar']."' and status_delete='UD'", 0);
		    if ($daftar[0]['kode_dokter'] == "")  $daftar[0]['kode_dokter'] = $daftar[0]['dokter_pengirim_kode'];
		    $dokter = $db->query("select nama_dokter from tbl_dokter where kode_dokter='".$daftar[0]['kode_dokter']."' and status_delete='UD'", 0);
		    $sub = $db->query("select nama_obat, qty, frekuensi, apd from tbl_resep_detail where resep_id='".$adm[$i]['id']."'");
               	    $no = $no + 1;
		    $jmlkol2 = count($sub) + 1;
                    $racik = $db->query("select nama, id, no_resep from tbl_racikan where no_daftar='".$adm[$i]['no_daftar']."' and status_delete='UD'", 0);
		    $sub1 = $db->query("select nama_obat, qty from tbl_racikan_detail where racikanId='".$racik[0]['id']."'");
		    $jmlah_baris = count($sub1) + 1;
		    $bartol = $jmlah_baris + $jmlkol2;
	    ?>
            <tr>
                <td style="width: 15px; text-align: right" rowspan="<?php echo $bartol; ?>"><?php echo $no?></td> 
                <td style="text-align: left" rowspan="<?php echo $bartol; ?>"><?php echo 'Tgl Berobat: '.date("d-M-Y", strtotime($daftar[0]['tgl_daftar'])).'<br>No. Resep: '.$adm[$i]['no_resep'].'<br>Penjamin: '.$daftar[0]['nama_perusahaan'].'<br>Dokter: '.$dokter[0]['nama_dokter']?></td> 
                <td style="text-align: left" colspan="4"><strong>Obat Reguler</strong></td> 
            </tr> 
	    <?php
			$nu = 0;
                	for ($j = 0; $j < count($sub); $j++) {
			  $nu = $nu + 1;
            ?>
            <tr>
                <td style="text-align: left"><?php echo $nu.'. '.$sub[$j]['nama_obat']?></td> 
                <td style="text-align: right"><?php echo number_format($sub[$j]['qty'])?></td>
                <td style="text-align: left"><?php echo $sub[$j]['frekuensi']?></td>
                <td style="text-align: left"><?php echo $sub[$j]['apd']?></td>
            </tr> 
            <?php
			}
            ?>
            <tr>
                <td style="text-align: left" colspan="4"><strong>Obat Racikan: <?php echo $racik[0]['nama']?></strong></td> 
            </tr> 
            <?php
			$ni = 0;
                	for ($j = 0; $j < count($sub1); $j++) {
			 $ni = $ni + 1;
			 $sub1[$j]['frekuensi'] = '-';
			 $sub1[$j]['apd'] = '-';
            ?>
            <tr>
                <td style="text-align: left"><?php echo $ni.'. '.$sub1[$j]['nama_obat'].' ('.$racik[0]['nama'].')'?></td> 
                <td style="text-align: right"><?php echo number_format($sub1[$j]['qty'])?></td>
                <td style="text-align: left"><?php echo $sub1[$j]['frekuensi']?></td>
                <td style="text-align: left"><?php echo $sub1[$j]['apd']?></td>
            </tr> 
            <?php
			}
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
