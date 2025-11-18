<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Chart of Account (COA) Category</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Master Chart of Account (COA) Category
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					List/Daftar Master Chart of Account (COA)  Category
                                    </h3>
                                    <a href="index.php?mod=master&submod=coa_ketegori_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah COA Category</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Kategori</th>
                                            <th>COA ID Inventory</th>
                                            <th>COA ID Inpatient</th>
                                            <th>COA ID Outpatient</th>
                                            <th>COA ID COGS</th>
                                            <th>COA ID COGS Inpatient</th>
                                            <th>COA ID Adjustment</th>
                                            <th>COA COGS AP Konsinyasi</th>
                                            <th>COA COGS Inpatient Konsinyasi</th>
                                            <th>COA COGS Outpatient Konsinyasi</th>
                                            <th>Is Consignee</th>
                                            <th>Is Fixed Asset</th>
                                            <th>Is Logistic</th>
                                            <th>Is Service</th>
                                            <th>Is Stock</th>
                                            <th>Jenis Barang</th>
                                            <th style="width:70px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	$data = $db->query("select * from tbl_coa_category order by id desc", 0);
                                        	for ($i = 0; $i < count($data); $i++) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['kategori']?></td>
                                                <td><?php echo $data[$i]['id_inventory_kode'].'-'.$data[$i]['id_inventory_nama']?></td>
                                                <td><?php echo $data[$i]['id_inpatient_kode'].'-'.$data[$i]['id_inpatient_nama']?></td>
                                                <td><?php echo $data[$i]['id_outpatient_kode'].'-'.$data[$i]['id_outpatient_nama']?></td>
                                                <td><?php echo $data[$i]['id_cogs_kode'].'-'.$data[$i]['id_cogs_nama']?></td>
                                                <td><?php echo $data[$i]['id_cogs_inpatient_kode'].'-'.$data[$i]['id_cogs_inpatient_nama']?></td>
                                                <td><?php echo $data[$i]['id_cogs_inadjusment_kode'].'-'.$data[$i]['id_cogs_inadjusment_nama']?></td>
                                                <td><?php echo $data[$i]['cogs_ap_konsinyasi_kode'].'-'.$data[$i]['cogs_ap_konsinyasi_nama']?></td>
                                                <td><?php echo $data[$i]['cogs_inpatient_konsinyasi_kode'].'-'.$data[$i]['cogs_inpatient_konsinyasi_nama']?></td>
                                                <td><?php echo $data[$i]['cogs_outpatient_konsinyasi_kode'].'-'.$data[$i]['cogs_outpatient_konsinyasi_nama']?></td>
                                                <td><?php echo $data[$i]['is_consignee']?></td>
                                                <td><?php echo $data[$i]['is_fixed_asset']?></td>
                                                <td><?php echo $data[$i]['is_logistic']?></td>
                                                <td><?php echo $data[$i]['is_service']?></td>
                                                <td><?php echo $data[$i]['is_stock']?></td>
                                                <td><?php echo $data[$i]['jenis_barang']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=coa_kategori_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/coa_kategori_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
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