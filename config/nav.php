<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="<?=$base_url;?>" class="navbar-brand"><b>IKSPI KERA SAKTI</b>-KALIANGET</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?=isset($home)?'class="active"':'';?>><a href="<?=$base_url;?>?home"><i class="fa fa-home"></i>
                            Home</a></li>
                    <li <?=isset($formulir)?'class="active"':'';?>><a href="<?=$base_url;?>?formulir"><i
                                class="fa fa-edit"></i> Formulir</a></li>
                    <?php if($_SESSION['akses']=='super_user'||$_SESSION['akses']=='administrator'):?>
                    <li <?=isset($pendaftar)?'class="active"':'';?>><a href="<?=$base_url;?>?pendaftar"><i
                                class="fa fa-users"></i> Pendaftar</a></li>
                    <li <?=isset($statistik)?'class="active"':'';?>><a href="<?=$base_url;?>?statistik"><i
                                class="fa fa-bar-chart-o"></i> Statistik</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i>
                            Pengaturan <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <!-- <li <?=isset($sett_umum)?'class="active"':'';?>><a href="<?=$base_url;?>?sett_umum"><i
                                        class="fa fa-cogs"></i> Umum</a></li> -->
                            <li <?=isset($sett_slide)?'class="active"':'';?>><a href="<?=$base_url;?>?sett_slide"><i
                                        class="fa fa-picture-o"></i> Dokumentasi</a></li>
                            <li <?=isset($sett_info)?'class="active"':'';?>><a href="<?=$base_url;?>?sett_informasi"><i
                                        class="fa fa-info-circle"></i> Informasi</a>
                            </li>
                            <li <?=isset($sett_pengguna)?'class="active"':'';?>><a
                                    href="<?=$base_url;?>?sett_pengguna"><i class="fa fa-user"></i> Pengguna</a></li>
                            <?php if($_SESSION['akses']=='super_user'):?>
                            <li class="divider"></li>
                            <li><a href="<?=$base_url;?>?backup_app"><i class="fa fa-file-archive-o"></i> Backup App</a>
                            </li>
                            <li class="divider"></li>
                            <?php endif;?>
                        </ul>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if($_SESSION['akses']=='super_user'||$_SESSION['akses']=='administrator'||$_SESSION['akses']=='member'):?>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu" style="background-color:red;">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?=$_SESSION['fullname'];?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <div style="padding:5px;text-align:center;">
                                <h4><?=$_SESSION['fullname'];?></h4>
                                <hr>
                                <small>Username : <?=$_SESSION['username'];?></small><br>
                                <small>Level Akses : <?=$_SESSION['akses'];?></small>
                            </div>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <!-- <a href="<?=$base_url;?>?profil" class="btn btn-primary btn-flat">Profil</a> -->
                                </div>
                                <div class="pull-right">
                                    <a href="<?=$base_url;?>proses/logout.php"
                                        class="btn btn-danger btn-flat">Keluar</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>