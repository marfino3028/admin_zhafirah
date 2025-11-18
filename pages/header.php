<div id="navigation">
    <div class="container-fluid">
        <ul class='main-nav'>
            <?php
            $kategori = $db->query("select DISTINCT c.kategori_id, c.nm_ka_menu from tbl_user_menu a left join tbl_menu b on b.id=a.menu_id left join tbl_kat_menu c on c.kategori_id=b.kategori_id where userid='".$_SESSION['rg_user']."' and a.hak_akses='0' order by kategori_id", 0);
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
        <div class="user"></div>
    </div>
</div>
<div class="container-fluid" id="content">
    <div id="left">
        <div class="subnav" style="margin: auto;">
            <a href="index.php">
                <img src="images/technocare.jpeg" style="width: 100%;">
            </a>
        </div>
        <form method="post" action="index.php?mod=pendaftaran&submod=index" class='search-form'>
            <div class="search-pane">
                <input type="text" id="search" name="search" style="width: 80%;" class="text ui-state-default" placeholder="Cari Jamaah" value="<?php echo $_POST['search']?>" />
                <button type="submit" class="rounded">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <div class="subnav">
            <div id="datepicker-kiri" style="margin-left: 5px;"></div>
        </div>
        <div class="subnav">
            <div style="display: none;"><span id="cal"></span> </div>
            <div class="tengah"><span id="clock"></span> </div>
        </div>
        <div class="subnav bawah">
            <ul class="subnav-menu">
                <li>
                    <a href="index.php?mod=logout" class="text-danger bold" title="Log Out"><i class="fa fa-sign-out"></i><span> Log Out</span></a>
                    <a><span><i class="fa fa-user"></i> <?=$_SESSION['rg_nama']?> - SHIFT <?php echo $_SESSION['rg_shift']?></span></a>
                </li>
            </ul>
        </div>
    </div>
    <div>
        <div class="container-fluid"></div>