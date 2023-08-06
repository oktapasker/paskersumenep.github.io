<?php hakAkses(['super_user','administrator']);?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="idslide"]').val("");
        $('[name="title"]').val("");
        $('[name="content"]').val("");
        $('#modal_add .modal-title').html('Tambah slide Baru');
        document.getElementById("viewfoto").src = '';
        $('#btn-ubah').hide();
        $('#btn-add').show();
    } else {
        $('#modal_add .modal-title').html('Rubah Infromasi');
        $('#foto').prop('required', false);
        $('#foto_required').remove();
        $('#btn-add').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=$base_url;?>proses/view_slide.php',
            dataType: 'json',
            success: function(data) {
                if (data.foto_slide != '') {
                    var img = data.foto_slide
                } else {
                    var img = 'default.jpg'
                }
                var link = '<?=$base_url;?>uploads/' + img
                document.getElementById("viewfoto").src = link
                $('[name="idslide"]').val(data.idslide);
                $('[name="keterangan"]').val(data.nama_slide);
                $('[name="content"]').val(data.isi_info);
            }
        });
    }
}

function preview_foto(event) {

    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('viewfoto');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
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
                            <h3 class="box-title">Daftar slide</h3>
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
                                        <th>FOTO SLIDE</th>
                                        <th>KETERANGAN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $n=1;
                                $query = mysqli_query($con,"SELECT * FROM slide ORDER BY idslide DESC")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                    <tr>
                                        <td><?=$n++.'.';?></td>
                                        <td>
                                            <a href="#modal_add" data-toggle="modal"
                                                onclick="submit(<?=$row['idslide'];?>)"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="<?=$base_url;?>uploads/<?=($row['foto_slide']!='')?$row['foto_slide']:'default.jpg';?>"
                                                target="_blank">
                                                <img src="<?=$base_url;?>uploads/<?=($row['foto_slide']!='')?$row['foto_slide']:'default.jpg';?>"
                                                    alt="<?=$row['foto_slide'];?>"
                                                    style="width:50px;height:50px;border:1px dashed;"></a>
                                        </td>
                                        <td><?=$row['nama_slide'];?></td>
                                        <td>
                                            <a href="<?=$base_url;?>proses/slide.php?id=<?=$row['idslide'];?>"
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
            <form action="<?=$base_url;?>proses/slide.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="" alt="Foto" style="border:1px dashed;width:275px;height:255px;" id="viewfoto">
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Foto<span id="foto_required"
                                            style="color:red;">*</span></label>
                                    <input type="file" class="form-control" name="foto" id="foto"
                                        onchange="preview_foto(event)" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Keterangan<span style="color:red;">*</span></label>
                                    <input type="hidden" class="form-control" name="idslide">
                                    <textarea class="form-control" name="keterangan" cols="30" rows="7"></textarea>
                                </div>
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