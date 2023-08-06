<?php hakAkses(['super_user','administrator']);?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($_SESSION['msg'])):?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?=$_SESSION['msg'];?>
                    </div>
                    <?php endif; unset($_SESSION['msg']);?>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Statistik Umur Pendaftar</h3>
                        </div>
                        <div class="box-body">
                            <!-- <div id="bar-chart" style="height: 500px;"></div> -->
                            <div style="width:100%;height:500px;text-align:center;margin:10px">
                                <div id="flot-placeholder" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                    <!-- <div style="width:450px;height:300px;text-align:center;margin:10px">
                        <div id="flot-placeholder" style="width:100%;height:100%;"></div>
                    </div> -->
                </div>
                <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->