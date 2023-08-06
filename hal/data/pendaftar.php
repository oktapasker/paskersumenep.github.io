<?php hakAkses(['super_user','administrator']);?>
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
                            <h3 class="box-title">Daftar Pendataran Anggota</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th width="5">NO</th>
                                        <th>TANGGAL</th>
                                        <th>FOTO</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>TTL</th>
                                        <th>UMUR</th>
                                        <th>JK</th>
                                        <th>ALAMAT</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $n=1;
                                $query = mysqli_query($con,"SELECT * FROM pendaftar ORDER BY is_anggota DESC")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                    <tr>
                                        <td><?=$n++.'.';?></td>
                                        <td><?=$row['tanggal'];?></td>
                                        <td><a href="#modal_image" data-toggle="modal"
                                                onclick="ubah_gambar(<?=$row['idmahasiswa'];?>)">
                                                <img src="<?=$base_url;?>uploads/<?=($row['foto']!='')?$row['foto']:'default.jpg';?>"
                                                    alt="<?=$row['foto'];?>"
                                                    style="width:50px;height:50px;border:1px dashed;"></a></td>
                                        <td>
                                            <?=$row['nama_lengkap'].' ('.$row['nama_pendek'].')';?>
                                        </td>
                                        <td><?=$row['tempat_lahir'].', '.date('d-M-Y',strtotime($row['tanggal_lahir']));?>
                                        </td>
                                        <td><?=$row['umur'].' Tahun';?></td>
                                        <td><?=$row['jk']=='L'?'Laki-Laki':'Perempuan';?></td>
                                        <td><?=$row['alamat'];?></td>
                                        <td>
                                            <?php
                                            if($row['is_anggota']==0):
                                            ?>
                                            <span class="label label-warning">Belum Member</span>
                                            <?php else:?>
                                            <span class="label label-success">Sudah Member</span>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if($row['is_anggota']==0):?>
                                            <a href="<?=$base_url;?>proses/formulir.php?sts&id=<?=$row['idpendaftar'];?>"
                                                class="btn btn-xs btn-success" data-toggle="tooltip"
                                                data-placement="top" title="Ubah Status"><i class="fa fa-check"></i></a>
                                            <?php endif;?>
                                            <a href="<?=$base_url;?>?detail_pendaftar&id=<?=$row['idpendaftar'];?>"
                                                class="btn btn-xs btn-default" data-toggle="tooltip"
                                                data-placement="top" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                            <a href="<?=$base_url;?>?ubah&id=<?=$row['idpendaftar'];?>"
                                                class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top"
                                                title="Ubah"><i class="fa fa-edit"></i></a>
                                            <a href="<?=$base_url;?>proses/formulir.php?hapus&id=<?=$row['idpendaftar'];?>"
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