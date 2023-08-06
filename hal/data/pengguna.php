<?php hakAkses(['super_user','administrator']);?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="user_name"]').val("");
        $('[name="user_fullname"]').val("");
        $('[name="user_telp"]').val("");
        $('[name="user_type"]').val("");
        $('[name="user_bio"]').val("");
        $('#modal_add .modal-title').html('Add New Pengguna');
        $('#user_name').prop('readonly', false);
        $('#btn-ubah').hide();
        $('#btn-add').show();
    } else {
        $('#modal_add .modal-title').html('Edit Pengguna');
        $('#user_name').prop('readonly', true);
        $('#btn-add').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=$base_url;?>proses/view_user.php',
            dataType: 'json',
            success: function(data) {
                $('[name="idusers"]').val(data.idusers);
                $('[name="user_name"]').val(data.user_name);
                $('[name="user_fullname"]').val(data.user_fullname);
                $('[name="user_telp"]').val(data.user_telp);
                $('[name="user_type"]').val(data.user_type);
                $('[name="user_bio"]').val(data.user_bio);
            }
        });
    }
}

function ubah_password(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=$base_url;?>proses/view_user.php',
        dataType: 'json',
        success: function(data) {
            $('[name="idusers"]').val(data.idusers);
        }
    });
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
                            <h3 class="box-title">Daftar Pengguna</h3>
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
                                        <th width="5"><i class="fa fa-key"></i></th>
                                        <th>NAMA LENGKAP</th>
                                        <th>USERNAME</th>
                                        <th>TELP</th>
                                        <th>BIO</th>
                                        <th>LEVEL</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $n=1;
                                $query = mysqli_query($con,"SELECT * FROM users ORDER BY is_active DESC")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                    <tr>
                                        <td><?=$n++.'.';?></td>
                                        <td>
                                            <?php if($row['user_type']!='super_user'):?>
                                            <a href="#modal_add" data-toggle="modal"
                                                onclick="submit(<?=$row['idusers'];?>)"><i class="fa fa-edit"></i></a>
                                            <?php endif;?>
                                        </td>
                                        <td><a href="#modal_key" data-toggle="modal"
                                                onclick="ubah_password(<?=$row['idusers'];?>)"><i
                                                    class="fa fa-key"></i></a>
                                        </td>
                                        <td><?=$row['user_fullname'];?></td>
                                        <td><?=$row['user_name'];?></td>
                                        <td><?=$row['user_telp'];?></td>
                                        <td><?=$row['user_bio'];?></td>
                                        <td><?=$row['user_type'];?></td>
                                        <td>
                                            <?php
                                            if($row['is_active']==0):
                                            ?>
                                            <span class="label label-warning">Tidak Aktif</span>
                                            <?php else:?>
                                            <span class="label label-success">Aktif</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if($row['user_type']!='super_user' && $_SESSION['iduser']!=$row['idusers']):?>
                                            <a href="<?=$base_url;?>proses/pengguna.php?id=<?=$row['idusers'];?>&act=sts"
                                                class="btn btn-xs btn-primary" data-toggle="tooltip"
                                                data-placement="top"
                                                title="<?=($row['is_active']==0)?'Actived':'Deactived';?>"><i
                                                    class="fa fa-ban"></i></a>
                                            <a href="<?=$base_url;?>proses/pengguna.php?id=<?=$row['idusers'];?>&act=del"
                                                class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                                title="Hapus"><i class="fa fa-trash-o"></i></a>
                                            <?php endif;?>
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
            <form action="<?=$base_url;?>proses/pengguna.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Username<span style="color:red;">*</span></label>
                                <input type="hidden" class="form-control" name="idusers">
                                <input type="text" class="form-control" name="user_name" placeholder="ex: admin"
                                    id="user_name" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Nama Lengkap<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="user_fullname"
                                    placeholder="ex: Supriani Ema" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor Telepon<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="user_telp" placeholder="ex: 0852xxxxxxxx"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">User Level<span style="color:red;">*</span></label>
                            <select class="form-control" name="user_type" id="level" required>
                                <option value="administrator">Administrator</option>
                                <option value="member">Member</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Bio<span style="color:red;">*</span></label>
                                <textarea class="form-control" name="user_bio" id="user_bio" cols="30"
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
<div class="modal" id="modal_key" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=$base_url;?>proses/pengguna.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead">Rubah Password</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idusers">
                                <input type="password" class="form-control" name="user_password"
                                    placeholder="New password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm btn-flat pull-left"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-flat pull-right" name="ubah_pass"><i
                            class="fa fa-save"></i>
                        Update &
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>