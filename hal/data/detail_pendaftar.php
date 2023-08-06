<?php hakAkses(['super_user','administrator','member']);?>
<?php
if(isset($_GET['detail_pendaftar']) && $_GET['id']!=''){
    $id= $_GET['id'];
    $query = mysqli_query($con,"SELECT * FROM pendaftar WHERE idpendaftar='$id'");
    $row = mysqli_fetch_array($query);
}
?>
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
                            <h3 class="box-title">Detail Data <b><?=$row['nama_lengkap'];?></b></h3>
                            <a href="<?=$base_url;?>?pendaftar" class="btn btn-xs btn-default btn-flat pull-right"><i
                                    class="fa fa-chevron-circle-left"></i>
                                Kembali</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table class="table table-responsive">
                                <tr>
                                    <td rowspan="10" width="300">
                                        <img src="<?=$base_url;?>uploads/<?=($row['foto']!='')?$row['foto']:'default.jpg';?>"
                                            alt="<?=$row['foto'];?>"
                                            style="width:300px;height:350px;border:1px dashed;">
                                    </td>
                                    <td width="200">Tanggal Daftar</td>
                                    <td width="5">:</td>
                                    <td><?=$row['tanggal'];?></td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td><?=$row['nama_lengkap'];?></td>
                                </tr>
                                <tr>
                                    <td>Nama Panggilan</td>
                                    <td>:</td>
                                    <td><?=$row['nama_pendek'];?></td>
                                </tr>
                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?=$row['tempat_lahir'].', '.date('d-M-Y',strtotime($row['tanggal_lahir']));?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    <td><?=$row['umur'];?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><?=$row['jk']=='L'?'Laki-Laki':'Perempuan';?></td>
                                </tr>
                                <tr>
                                    <td>Hobi</td>
                                    <td>:</td>
                                    <td><?=$row['hobi'];?></td>
                                </tr>
                                <tr>
                                    <td>Cita-Cita</td>
                                    <td>:</td>
                                    <td><?=$row['citacita'];?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td><?=$row['status'];?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?=$row['alamat'];?></td>
                                </tr>
                            </table>
                            <table class="table table-responsive">
                                <tr>
                                    <td width="200">Nama Ayah</td>
                                    <td width="5">:</td>
                                    <td width="350"><?=$row['nama_ayah'];?></td>
                                    <td width="200">Nama Ibu</td>
                                    <td width="5">:</td>
                                    <td><?=$row['nama_ibu'];?></td>
                                </tr>
                                <tr>
                                    <td>Alamat Orang Tua</td>
                                    <td>:</td>
                                    <td><?=$row['alamat_ortu'];?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Whastapp</td>
                                    <td>:</td>
                                    <td><?=$row['whatsapp'];?></td>
                                    <td>Telegram</td>
                                    <td>:</td>
                                    <td><?=$row['telegram'];?></td>
                                </tr>
                                <tr>
                                    <td>Facebook</td>
                                    <td>:</td>
                                    <td><?=$row['facebook'];?></td>
                                    <td>Instagram</td>
                                    <td>:</td>
                                    <td><?=$row['instagram'];?></td>
                                </tr>
                                <tr>
                                    <td>Twitter</td>
                                    <td>:</td>
                                    <td><?=$row['twitter'];?></td>
                                    <td>Youtube</td>
                                    <td>:</td>
                                    <td><?=$row['youtube'];?></td>
                                </tr>
                                <tr>
                                    <td>Status Anggota</td>
                                    <td>:</td>
                                    <td>
                                        <?php
                                        if($row['is_anggota']==0):
                                        ?>
                                        <span class="label label-warning">Belum Member</span>
                                        <?php else:?>
                                        <span class="label label-success">Sudah Member</span>
                                        <?php endif;?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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