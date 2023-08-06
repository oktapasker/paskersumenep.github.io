<?php hakAkses(['super_user','administrator','member']);?>
<?php
if(isset($_GET['ubah']) && $_GET['id']!=''){
    $ubah = true;
    $id = $_GET['id'];
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
                <!-- left column -->
                <div class="col-md-12">
                    <?php if(isset($_SESSION['msg'])):?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?=$_SESSION['msg'];?>
                    </div>
                    <?php endif; unset($_SESSION['msg']);?>
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Pendaftaran Anggota</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="<?=$base_url;?>proses/formulir.php" method="post"
                            enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab">Data Pribadi</a></li>
                                        <li><a href="#tab_2" data-toggle="tab">Data Orang Tua</a></li>
                                        <li><a href="#tab_3" data-toggle="tab">Data Sosial Media</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="<?=$base_url;?>uploads/<?=isset($ubah)?$row['foto']:'';?>"
                                                        alt="Foto" style="border:1px dashed;width:100%;height:400px;"
                                                        id="viewfoto">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">Foto Anda <?=isset($ubah)?'':'<span
                                                                    style="color:red;">*</span>';?></label>
                                                            <input type="file" class="form-control" name="foto"
                                                                id="exampleInputFile" onchange="preview_foto(event)"
                                                                <?=isset($ubah)?'':'required';?>>
                                                            <p class="help-block">Format file yang diijinkan <b>*.jpg
                                                                    *.jpeg *.png.</b> Maksimal ukuran file 1 MB
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_lengkap">Nama Lengkap <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="hidden" name="id"
                                                                value="<?=isset($ubah)?$row['idpendaftar']:'';?>">
                                                            <input type="text" class="form-control" name="nama_lengkap"
                                                                id="nama_lengkap" placeholder="Ex: Supriana Ema"
                                                                value="<?=isset($ubah)?$row['nama_lengkap']:'';?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_pendek">Nama Panggilan <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" name="nama_pendek"
                                                                id="nama_pendek" placeholder="Ex: Ema"
                                                                value="<?=isset($ubah)?$row['nama_pendek']:'';?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tempat_lahir">Tempat Lahir <span
                                                                    style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" name="tempat_lahir"
                                                                id="tempat_lahir" placeholder="Ex: Manokwari"
                                                                value="<?=isset($ubah)?$row['tempat_lahir']:'';?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir <span
                                                                    style="color:red;">*</span></label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" name="tanggal_lahir"
                                                                    class="form-control pull-right" id="datepicker"
                                                                    value="<?=isset($ubah)?$row['tanggal_lahir']:'';?>"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="jk">Jenis Kelamin <span
                                                                    style="color:red;">*</span></label>
                                                            <select class="form-control select2" id="jk" name="jk"
                                                                required>
                                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                                <option value="L"
                                                                    <?=isset($ubah)?$row['jk']=='L'?'selected':'':'';?>>
                                                                    Laki-Laki</option>
                                                                <option value="P"
                                                                    <?=isset($ubah)?$row['jk']=='P'?'selected':'':'';?>>
                                                                    Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="hobi">Hobi</label>
                                                            <input type="text" class="form-control" name="hobi"
                                                                id="hobi" placeholder="Ex: Dance"
                                                                value="<?=isset($ubah)?$row['hobi']:'';?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="citacita">Cita-Cita</label>
                                                            <input type="text" class="form-control" name="citacita"
                                                                id="citacita" placeholder="Ex: Dancer"
                                                                value="<?=isset($ubah)?$row['citacita']:'';?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="status">Status <span
                                                                    style="color:red;">*</span></label>
                                                            <select class="form-control select2" id="status"
                                                                name="status" required>
                                                                <option value="">-- Pilih Status --</option>
                                                                <option value="Pelajar"
                                                                    <?=isset($ubah)?$row['status']=='Pelajar'?'selected':'':'';?>>
                                                                    Pelajar</option>
                                                                <option value="Mahasiswa"
                                                                    <?=isset($ubah)?$row['status']=='Mahasiswa'?'selected':'':'';?>>
                                                                    Mahasiswa</option>
                                                                <option value="Umum"
                                                                    <?=isset($ubah)?$row['status']=='Umum'?'selected':'':'';?>>
                                                                    Umum</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="hobi">Alamat Lengkap <span
                                                                    style="color:red;">*</span></label>
                                                            <textarea class="form-control" rows="3"
                                                                name="alamat_lengkap"
                                                                placeholder="Alamat lengkap anda ..."
                                                                required><?=isset($ubah)?$row['alamat']:'';?></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="hobi">Hobi</label>
                                                            <input type="text" class="form-control" name="hobi"
                                                                id="hobi" placeholder="Ex: Supriana Ema">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="hobi">Hobi</label>
                                                            <input type="text" class="form-control" name="hobi"
                                                                id="hobi" placeholder="Ex: Supriana Ema">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="hobi">Hobi</label>
                                                            <input type="text" class="form-control" name="hobi"
                                                                id="hobi" placeholder="Ex: Supriana Ema">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Email address</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1" placeholder="Enter email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Password</label>
                                                            <input type="password" class="form-control"
                                                                id="exampleInputPassword1" placeholder="Password">
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_lengkap_ayah">Nama Lengkap Ayah</label>
                                                        <input type="text" class="form-control" name="nama_lengkap_ayah"
                                                            id="nama_lengkap_ayah" placeholder="Ex: Supriana Ema"
                                                            value="<?=isset($ubah)?$row['nama_ayah']:'';?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_lengkap_ibu">Nama Lengkap Ibu</label>
                                                        <input type="text" class="form-control" name="nama_lengkap_ibu"
                                                            id="nama_lengkap_ibu" placeholder="Ex: Supriana Ema"
                                                            value="<?=isset($ubah)?$row['nama_ibu']:'';?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Alamat Orang Tua</label>
                                                        <textarea class="form-control" rows="3"
                                                            name="alamat_lengkap_ortu"
                                                            placeholder="Alamat lengkap orang tua ..."><?=isset($ubah)?$row['alamat_ortu']:'';?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Whatsapp</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-whatsapp"></i>
                                                            </div>
                                                            <input type="text" name="whatsapp"
                                                                class="form-control pull-right"
                                                                placeholder="Ex: 081312348765"
                                                                value="<?=isset($ubah)?$row['whatsapp']:'';?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Telegram</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-telegram"></i>
                                                            </div>
                                                            <input type="text" name="telegram"
                                                                class="form-control pull-right"
                                                                placeholder="Ex: 081312348765"
                                                                value="<?=isset($ubah)?$row['telegram']:'';?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-facebook"></i>
                                                            </div>
                                                            <input type="text" name="facebook"
                                                                class="form-control pull-right"
                                                                placeholder="Ex: https://www.facebook.com/namaIDanda"
                                                                value="<?=isset($ubah)?$row['facebook']:'';?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Instagram</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-instagram"></i>
                                                            </div>
                                                            <input type="text" name="instagram"
                                                                class="form-control pull-right"
                                                                placeholder="Ex: https://www.instagram.com/namaIDanda"
                                                                value="<?=isset($ubah)?$row['instagram']:'';?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Twitter</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-twitter"></i>
                                                            </div>
                                                            <input type="text" name="twitter"
                                                                class="form-control pull-right"
                                                                placeholder="Ex: https://www.twitter.com/namaIDanda"
                                                                value="<?=isset($ubah)?$row['twitter']:'';?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Youtube</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-youtube"></i>
                                                            </div>
                                                            <input type="text" name="youtube"
                                                                class="form-control pull-right"
                                                                placeholder="Ex: https://www.youtube.com/namachanelanda"
                                                                value="<?=isset($ubah)?$row['youtube']:'';?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat pull-right"
                                    name="<?=isset($ubah)?'ubah':'save';?>"><i class="fa fa-save"></i>
                                    SIMPAN DATA</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->