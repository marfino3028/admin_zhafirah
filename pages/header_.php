<div class="row hidden-480">
    <div class="col-sm-12">
        <div class="top-site">
            <a href="index.php">
                <div class="pull-left" style="display: flex;align-items: center;padding: 10px;background-color: white;">
                    <img class="img-circle" alt="technocare" src="./images/logo-technocare.jpeg" height="40px">&nbsp;
                    <h1 class="techno">TECHNO</h1>
                    <h1 class="care">CARE</h1>
                </div>
            </a>
            <div class="pull-right">
                <ul class="stats">
                    <li>
                        <div class="portlet portlet-content">
                            <form method="post" action="index.php?mod=pendaftaran&submod=index">
                                <input type="text" placeholder="CARI PASIEN" id="search" name="search" style="width: 125px" class="text ui-state-default" value="<?php echo $_POST['search']?>" /> <input type="submit" class="btn btn-sm btn-small btn-primary" value="search" />
                            </form>
                        </div>
                    </li>
                    <li>

                        <div class="details">
                            <span class="big" id="cal"></span>
                            <span id="clock"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="navigation">
    <div class="container-fluid">
        <ul class='main-nav'>
            <?php
            $kategori = $db->query("select c.kategori_id, c.nm_ka_menu from tbl_user_menu a left join tbl_menu b on b.id=a.menu_id left join tbl_kat_menu c on c.kategori_id=b.kategori_id where userid='".$_SESSION['rg_user']."' and a.hak_akses='0' group by c.kategori_id", 0);
            for ($i = 0; $i < count($kategori); $i++) {
                if(empty($kategori[$i]['nm_ka_menu'])) continue;
                echo '<li><a href="index.php" data-toggle="dropdown" class="dropdown-toggle">'.'<span>'.$kategori[$i]['nm_ka_menu'].'</span><span class="caret"></span>'.'</a>';
                $sub = $db->query("select b.nama_menu, b.link from tbl_user_menu a left join tbl_menu b on b.id=a.menu_id left join tbl_kat_menu c on c.kategori_id=b.kategori_id where userid='".$_SESSION['rg_user']."' and a.hak_akses='0' and c.kategori_id='".$kategori[$i]['kategori_id']."'");
                echo '<ul class="dropdown-menu">';
                for ($j = 0; $j < count($sub); $j++) {
                    echo '<li><a href="'.$sub[$j]['link'].'">'.$sub[$j]['nama_menu'].'</a></li>';
                }
                echo '</ul>';
                echo '</li>';
            }
            ?>
        </ul>
        <a href="#" class="toggle-mobile"><i class="fa fa-bars"></i></a>
        <div class="user">
            <div class="dropdown">
                <a href="#" class='dropdown-toggle' data-toggle="dropdown">Welcome <strong><?=$_SESSION['rg_nama']?></strong>
                    <img src="images/no-photo.png" alt="photo" height="25">
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="index.php?mod=logout">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
