	<?php
		//include "../../header-sub.php";
		include "../../3rdparty/engine.php";
		
		$data = $db->query("select * from tbl_bhp where md5(id)='".$_POST['id']."'");
		//print_r($data);
	?>
	<p style="margin-left: 10px; font-size: 20px;">Daftar Detail dari <?php echo $data[0]['nm_bhp']?></p>
	<div style="margin-left: 10px; margin-right: 10px;">
        <table id="table-data-detail" class="table table-hover dataTable table-bordered">
            <thead>
            <tr>
                <th style="width:20px">No</th>
                <th>Nama Obat</th>
                <th style="width:30px">Sat</th>
                <th style="width:30px">QTY</th>
                <th style="width:40px">Harga</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $data = $db->query("select * from tbl_bph_detail where status_delete='UD' and md5(bphID)='".$_POST['id']."'", 0);
            for ($i = 0; $i < count($data); $i++) {
                $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'", 0);
                ?>
                <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $data[$i]['nama_obat']?></td>
                    <td><?php echo $satuan?></td>
                    <td><div align="right"><?php echo $data[$i]['qty']?></div></td>
                    <td align="right"><div align="right"><?php echo number_format($data[$i]['harga_beli'])?></div></td>
                </tr>
                <?php
                $sbttl = $sbttl + $data[$i]['total'];
            }
            ?>
            </tbody>
        </table>
    </div>
	