<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Feedback</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">FeedBack User</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        FeedBack User
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					FeedBack User
                                    </h3>
                                    <a href="index.php?mod=mobileapps&submod=feed_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah FeedBack</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                        <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>User</th>
                                            <th>Rating</th>
                                            <th>Isi FeedBack</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            	$data = $db->query("select * from tbl_feedback where status_delete='UD' order by id", 0);
                                        	for ($i = 0; $i < count($data); $i++) {
                                        ?>
                                            <tr>
                                                <td class="text-center" style="width: 30px;"><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['user']?></td>
                                                <td style="width: 120px;">
						  <?php
							for ($j = 1; $j < 6; $j++) {
								if ($j <= $data[$i]['rating']) echo '<img src="images/bk.png" width="20">';
								else echo '<img src="images/bh.png" width="20">';
							}
						  ?>
						</td>
                                                <td><?php echo $data[$i]['feedback']?></td>
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