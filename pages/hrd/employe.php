<?php
 	function hitung_usia($tgl_lahir)
		{
			$today = date("Y-m-d");
			$now = time();
			list($thn, $bln, $tgl) = explode("-",$tgl_lahir);
			$time_lahir = mktime(0,0,0,$bln, $tgl, $thn);
	
			$selisih= $now - $time_lahir;
	
			$tahun = floor($selisih/(60*60*24*365));
			$bulan = round(($selisih % (60*60*24*365) ) / (60*60*24*30));
	
			return $tahun." tahun ".$bulan." bulan";
		}

?>
<div class="box box-color box-bordered">
	<div class="box-title">
		<h3>
			<i class="fa fa-table"></i>
			Data Master: <b>KARYAWAN RS PERMATA CIBUBUR</b>
		</h3>
		<div class="actions">
			<a href="index.php?mod=master&submod=employe_new2" data-toggle="modal" class='btn'>
				<i class="fa fa-plus-circle"></i> Tambah Data Karyawan</a>
		</div>
	</div>
	<div class="box-content nopadding" style="overflow: auto;">
		<table class="table table-hover table-nomargin dataTable table-bordered">
			<thead>
                <tr>
                    <th style="width:40px">No</th> 
                    <th style="width:70px">NIP</th> 
                    <th>Nama Karyawan</th> 
                    <th>Jabatan</th> 
                    <th>Unit Kerja</th> 
                    <th>Option</th> 
                </tr> 
			</thead>
			<tbody>
				<?php
                    $data = $db->query("select * from tbl_karyawan where status_delete='UD' order by id desc", 0);
					//print_r($data);
					for ($i = 0; $i < count($data); $i++) {
						$no = $start + $i + 1;
						$y = explode(".", $data[$i]['foto']);
						
						if ($y[1] != '')	$data[$i]['extn'] = $data[$i]['foto'];
						else	$data[$i]['extn'] = 'nofoto.png';
						
						$data[$i]['usia'] = hitung_usia($data[$i]['tanggal_lahir']);
					?>
						<tr>
							<td style="text-align: center"><?php echo $no ?></td> 
							<td><?php echo $data[$i]['nip'] ?></td> 
							<td>
								<?php 
									echo '<div><div style="border: #000000 1px solid; width: 50px; float: left;"><img src="employee/'.$data[$i]['extn'].'" width="50"></div><div style="float: left; margin-left: 15px; margin-top: 10px;">'.$data[$i]['nama'].'<br>Umur : '.$data[$i]['usia'].'</div></div>';
								?>
								
							</td> 
							<td><?php echo $data[$i]['jabatan'] ?></td> 
							<td><?php echo $data[$i]['unit_nama'].' '.$data[$i]['lantai_nama']?></td> 
							<td align="center" style="width: 150px;">
                                <span class="glyphicon glyphicon-edit" title="Edit" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=master&submod=employe_edit2&id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-plus" title="Tambah/Edit Kepemilikan Harta" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=employee&submod=employe_harta&id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-plus" title="Tambah/Edit Pendidikan Formal" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=employee&submod=employe_didik&id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-plus" title="Tambah/Edit Riwayat Pekerjaan" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=employee&submod=employe_kerja&id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-plus" title="Tambah/Edit Keluarga" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=employee&submod=employe_keluarga&id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-plus" title="Tambah/Edit Surat Peringatan" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=employee&submod=employe_sp&id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-remove" title="Delete" style="cursor: pointer;" onclick="return window.location = 'pages/master/employe_delete.php?id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-star" title="View Karyawan" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=employee&submod=employe_view&id=<?php echo $data[$i]['id'] ?>'"></span>
                                <span class="glyphicon glyphicon-default" title="View Dokumen" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=employee&submod=employee_docs&nip=<?php echo $data[$i]['nip'] ?>'">Dokumen</span>
							</td> 
						</tr> 
				<?php
                    }
                ?>
			</tbody>
		</table>
	</div>
</div>