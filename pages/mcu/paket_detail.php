<?php
    $kepala =  $db->query("select * from tbl_paketmcu_header where md5(id)='".$_GET['id']."'", 0);
    //print_r($kepala);
?>
<script language="javascript">

	function pilihBHP(id) {
		var url = "pages/hd/medication_bhp.php";
		var data = {id:id};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
</script>
<!---- JS SELECT2 --->
<script language="javascript">
	$(document).ready(function() {
		$("#obat").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/obat.php",
		        dataType: 'json',
		        type: "GET",
		        quietMillis: 50,
		        data: function (term) {
		            return {
		                term: term
		            };
		        },
		        results: function (data) {
		            return {
		                results: $.map(data, function (item) {
		                    return {
		                        text: item.itemName,
		                        id: item.id
		                    }
		                })
		            };
		        }, 
		    }
		});
	});

</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Layanan MCU</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Travel Paket MCU</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Input Detail Paket MCU</a>
                <i class="fa fa-angle-right"></i>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Detail Paket MCU
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/mcu/paket_detail_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $kepala[0]['nama']?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">COA</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $kepala[0]['coa_kode'].' - '.$kepala[0]['coa_nama']?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">COA Beban</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $kepala[0]['coa_beban_kode'].' - '.$kepala[0]['coa_beban_nama']?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Group</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $kepala[0]['grup']?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Masa Berlaku</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d M Y", strtotime($kepala[0]['mulai'])).' s/d '.date("d M Y", strtotime($kepala[0]['sampai']))?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-12" style="font-weight: bold;">Tambahkan Item untuk Detail Paket MCU</label>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="modul_mcu" name="modul_mcu">
                                                            <option value="">--Pilih Modul MCU--</option>
                                        					<?php
                                        					    $sub = $db->query("select * from tbl_modul_mcu where status_aktif= 'AKTIF'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['nama'].'</option>';
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                                                            <button type="submit" class="btn btn-primary">Add</button>                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-12" style="font-weight: bold;">Tambahkan Item untuk Laboratorium</label>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="lab" name="lab">
                                                            <option value="">--Pilih Tindakan Laboratorium--</option>
                                        					<?php
                                        					    $sub = $db->query("select a.id, a.kode_tarif, a.nama_pelayanan from tbl_tarif as a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan  where a.kode_jns_tarif='3' and a.status_delete='UD'	order by b.kode_kat_pelayanan", 0);
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['kode_tarif'].' - '.$sub[$i]['nama_pelayanan'].'</option>';
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                                                            <button type="submit" class="btn btn-primary">Add</button>                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-12" style="font-weight: bold;">Tambahkan Item untuk Radiologi</label>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="rad" name="rad">
                                                            <option value="">--Pilih Tindakan Radiologi--</option>
                                                           <?php
                                                            $lab = $db->query("select * from tbl_tarif where kode_jns_tarif='4' and status_delete='UD' order by kode_kat_pelayanan");
                                                            for ($i = 0; $i < count($lab); $i++) {
                                                                $j = $i + 1;
                                                                $kategori[$j] = $db->queryItem("select a.id, b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$lab[$i]['kode_tarif']."'");
                                                                //if ($kategori[$j] != $kategori[$i]) echo '<option value="'.$lab[$i]['kode_tarif'].'" disabled="disabled">'.$kategori[$j].'</option>';
                                                                echo '<option value="'.$lab[$i]['id'].'"> &nbsp; &nbsp; &nbsp;'.$lab[$i]['nama_pelayanan'].'</option>';
                                                            }
                                                            ?>
                         														</select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                                                            <button type="submit" class="btn btn-primary">Add</button>                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-success rounded" value="List/Daftar Paket MCU" onclick="simpanData(this.form, 'index.php?mod=mcu&submod=paket')" />
                                                </div>
                                            </div>
                                            <p></p>
                                            <div class="col-sm-7">
                                                <div id="data_pasien">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th style="text-align: center;">Nama Detail Paket</th>
                                                            <th style="text-align: center;">Standard</th>
                                                            <th style="text-align: center;">Asuransi</th>
                                                            <th style="width:30px; text-align: center;">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $data = $db->query("select * from tbl_paketmcu_detail where md5(paketmcu_id)='".$_GET['id']."'", 0);
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'", 0);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1?></td>
                                                                <td><?php echo $data[$i]['kategori_detail_nama']?></td>
                                                                <td style="text-align: right;"><?php echo number_format($data[$i]['standard'])?></td>
                                                                <td style="text-align: right;"><?php echo number_format($data[$i]['asuransi'])?></td>
                                                                <td class="text-center">
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/mcu/paket_detail_delete.php?id=<?php echo md5($data[$i]['id']).'&ids='.$_GET['id']?>';">
                                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $sbttl = $sbttl + $data[$i]['total'];
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>