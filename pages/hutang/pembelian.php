<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">AP Purchasing / Hutang Pembelian</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Hutang Pembelian
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Hutang Pembelian
                                    </h3>
                                    <a href="index.php?mod=hutang&submod=pembelian_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Hutang Pembelian</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
				    <div style="margin-left: 10px; margin-top: 10px; margin-right: 10px; margin-bottom: 10px;">
                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:20px">No</th>
                                            <th>Supplier</th>
                                            <th>Tgl AP</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Tgl Faktur Pajak</th>
                                            <th>PPN</th>
                                            <th>diskon</th>
                                            <th>Total</th>
                                            <th style="width:70px">OPT</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            	$data = $db->query("select * from tbl_hutang_pembelian order by tgl_ap desc, id desc", 0);
                                        	for ($i = 0; $i < count($data); $i++) {
                                            	
                                        ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['suplier_nama']?></td>
                                                <td><?php echo date("d/m/Y", strtotime($data[$i]['tgl_ap']))?></td>
                                                <td><?php echo date("d/m/Y", strtotime($data[$i]['jatuh_tempo']))?></td>
                                                <td><?php echo date("d/m/Y", strtotime($data[$i]['tgl_faktur_pajak']))?></td>
                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['ppn'])?></div></td>
                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['diskon'])?></div></td>
                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td>
                                                <td class="text-center">
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=hutang&submod=pembelian_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                            <span class="ui-icon ui-icon-wrench"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/hutang/pembelian_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                        </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script>
            $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
        </script>