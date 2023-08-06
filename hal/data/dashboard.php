<?php hakAkses(['super_user','administrator','member']);?>
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header mb-4">
                    <h1>
                        Top Navigation
                        <small>Example 2.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Layout</a></li>
                        <li class="active">Top Navigation</li>
                    </ol>
                </section> -->

        <!-- CAROUSAL -->
        <div class="box box-solid">
            <div class="box-body">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <?php
                    ?>
                    <ol class="carousel-indicators">
                        <?php
                        $n=0;
                        $query = mysqli_query($con,"SELECT * FROM slide ORDER BY idslide DESC")or die(mysqli_error($con));
                        while($r = mysqli_fetch_array($query)): ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?=$n;?>"
                            <?=$n==0?'class="active"':'';?>></li>
                        <?php $n++; endwhile;?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $n=0;
                        $query = mysqli_query($con,"SELECT * FROM slide ORDER BY idslide DESC")or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)): ?>
                        <div class="item <?=$n==0?'active':'';?>">
                            <img src="<?=$base_url;?>/uploads/<?=$row['foto_slide'];?>" alt="<?=$row['foto_slide'];?>"
                                style="height:450px;width:100%;">

                            <div class="carousel-caption">
                                <?=$row['nama_slide'];?>
                            </div>
                        </div>
                        <?php $n++; endwhile;?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- CAROUSAL -->
        <!-- Main content -->
        <section class="content">
            <!-- START ACCORDION & CAROUSEL-->

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Informasi</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                <?php
                                $n=1;
                                $query = mysqli_query($con,"SELECT * FROM informasi ORDER BY idinfo DESC")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                                href="#collapse<?=$row['idinfo'];?>">
                                                <?=$row['judul_info'];?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?=$row['idinfo'];?>" class="panel-collapse collapse">
                                        <div class="box-body">
                                            <?=$row['isi_info'];?>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile;?>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- END ACCORDION & CAROUSEL-->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.container -->
</div>
<!-- /.content-wrapper -->