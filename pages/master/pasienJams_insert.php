<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$pecah = explode(".",$_FILES['data']['name']);
		$letak_eks = sizeof($pecah) - 1;
		$extensi_input = strtolower($pecah[$letak_eks]);
		$extensi_bener = "csv";
		
		if ($extensi_bener != $extensi_input) {
			$error = "Maaf, File Data yang Anda Upload Bukan File Data yang benar";
			echo '<script language="javascript" type="text/javascript">
					alert("'.$error.'");
					window.location="../../index.php?mod=master&submod=pasienJams_new";
				  </script>';
		}
		else {
			//copy($data,"pages/lain/upload/".$_FILES['data']['name']);
			$folder = '';
			$file_name = 'jamsostek.csv';
			move_uploaded_file($_FILES['data']['tmp_name'], $folder.$file_name);
			
			$myFile = $file_name;
			ini_set("auto_detect_line_endings", 1);   // lakukan ini_set SEBELUM fopen file
			ini_set("display_errors", 0);
			ini_set('max_execution_time',0);
			$handle = fopen($myFile, "r");
			// lakukan while loop seperti biasa
			$no = 1;
			$jml_data = 0;
			while (($data = fgetcsv($handle,10000, ",")) !== FALSE)
			{
			   if ($no > 1) {
			   // proses data seperti biasa, data berupa array kolom per baris
				   $nomr = $data[9];
				   $nama = $data[10];
				   $hub = $data[8];
				   $pekerjaan = $data[4];
				   if ($nomr != "") {
				   		$insert = $db->query("insert into tbl_pasien_jamsostek (nomr, nm_pasien, hub, pekerjaan) values ('$nomr', '$nama', '$hub', '$pekerjaan')");
						$jml_data = $jml_data + 1;
				   }
				   //echo "$nomr - $nama - $hub - $pekerjaan - $myFile<br>";
			   }
			   $no = $no + 1;
			   
			}
			fclose($handle);		}
			$error = "Terdapat $jml_data Data yang dapat dibaca di File yang Anda Upload";
			echo '<script language="javascript" type="text/javascript">
					alert("'.$error.'");
					window.location="../../index.php?mod=master&submod=pasien_jamsostek";
				  </script>';
	}
?>