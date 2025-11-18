<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Chart of Account (COA)</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Master Chart of Account (COA)
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					List/Daftar Master Chart of Account (COA)
                                    </h3>
                                    <a href="index.php?mod=master&submod=coa_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
				    <div class="col-sm-4">
					<p style="margin-top: 25px; margin-left: 0px; font-size: 16px;"><strong>Daftar COA (Chart of Account)</strong></p>
					<div class="filetree">
						<ul style="margin-left: -20px; font-size: 16px;">
							<?php
								$data = $db->query("select left(kd_coa, 1) kd_coa, nm_coa, ac_type from tbl_coa where post_tape='Header'");
								for ($i = 0; $i < count($data); $i++) {
									echo '<a href="index.php?mod=master&submod=coa&id='.rtrim($data[$i]['kd_coa'], "0").'"><li>'.strtoupper($data[$i]['ac_type']).'</li></a>';
									//$sub1 = $db->query("select kd_coa, nm_coa from tbl_coa where post_tape='Header' and right(left(kd_coa, 2), 1)=0");
									//for ($i = 0; $i < count($data); $i++) {
										//echo '<li>'.$data[$i]['kd_coa'].' - '.$data[$i]['nm_coa'].'</li>';
									//}
								}
							?>
						</ul>
					</div>
				    </div>
				    <div class="col-sm-8">
                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Chart of Account (COA)</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
					    if ($_GET['id'] == "") {
                                            	$data = $db->query("select * from tbl_coa where status_delete='UD' order by id", 0);
					    }
					    else {
						$data = $db->query("select * from tbl_coa where status_delete='UD' and kd_coa like '".$_GET['id']."%' order by id", 0);
					    }
                                            for ($i = 0; $i < count($data); $i++) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['kd_coa']?></td>
                                                <td><?php echo $data[$i]['nm_coa']?></td>
                                                <td class="text-center">
						    <i class="glyphicon-edit" title="Edit" style="cursor: pointer;" onclick="return window.location = 'index.php?mod=master&submod=coa_edit&id=<?php echo md5($data[$i]['id'])?>'"></i>
						    <i class="fa fa-trash-o" title="Delete" style="cursor: pointer;" onclick="return window.location = 'pages/master/coa_delete.php?id=<?php echo $data[$i]['id']?>';"></i>
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
</div>
        <script>
            $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
        </script>