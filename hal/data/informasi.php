<?php hakAkses(['super_user','administrator']);?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="idinfo"]').val("");
        $('[name="title"]').val("");
        $('[name="content"]').val("");
        $('#modal_add .modal-title').html('Tambah Informasi Baru');
        $('#btn-ubah').hide();
        $('#btn-add').show();
    } else {
        $('#modal_add .modal-title').html('Rubah Infromasi');
        $('#btn-add').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=$base_url;?>proses/view_info.php',
            dataType: 'json',
            success: function(data) {
                $('[name="idinfo"]').val(data.idinfo);
                $('[name="title"]').val(data.judul_info);
                $('[name="content"]').val(data.isi_info);
            }
        });
    }
}
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <?php if(isset($_SESSION['msg'])):?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?=$_SESSION['msg'];?>
                    </div>
                    <?php endif; unset($_SESSION['msg']);?>
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Daftar Informasi</h3>
                            <a href="#" class="btn btn-sm btn-flat btn-primary pull-right" data-toggle="modal"
                                data-target="#modal_add" onclick="submit('add')"><i class="fa fa-plus"></i>
                                Tambah</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th width="5">NO</th>
                                        <th width="5"><i class="fa fa-edit"></i></th>
                                        <th>JUDUL INFO</th>
                                        <th>ISI INFO</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $n=1;
                                $query = mysqli_query($con,"SELECT * FROM informasi ORDER BY idinfo DESC")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                    <tr>
                                        <td><?=$n++.'.';?></td>
                                        <td>
                                            <a href="#modal_add" data-toggle="modal"
                                                onclick="submit(<?=$row['idinfo'];?>)"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td><?=$row['judul_info'];?></td>
                                        <td><?=$row['isi_info'];?></td>
                                        <td>
                                            <a href="<?=$base_url;?>proses/informasi.php?id=<?=$row['idinfo'];?>"
                                                class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                                title="Hapus"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php endwhile;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<!-- PAGE CONTENT WRAPPER -->
<div class="modal" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=$base_url;?>proses/informasi.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Judul Informasi<span style="color:red;">*</span></label>
                                <input type="hidden" class="form-control" name="idinfo">
                                <input type="text" class="form-control" name="title" placeholder="ex: Judul Informasi"
                                    id="title" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Isi Informasi<span style="color:red;">*</span></label>
                                <textarea class="form-control" name="content" id="content" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm btn-flat pull-left"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-flat pull-right" id="btn-ubah"
                        name="edit"><i class="fa fa-save"></i>
                        Update &
                        Save</button>
                    <button type="submit" class="btn btn-success btn-sm btn-flat pull-right" id="btn-add" name="save"><i
                            class="fa fa-save"></i> Add
                        New &
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>