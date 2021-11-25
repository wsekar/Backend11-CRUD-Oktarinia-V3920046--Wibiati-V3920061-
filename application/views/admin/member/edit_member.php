<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">
    <script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
    <?php $this->load->view("admin/_partials/navbar.php") ?>
    <div id="wrapper">
        <?php $this->load->view("admin/_partials/sidebar.php") ?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- membuat notifikasi data berhasil disimpan -->
                <?php $this->load->view("admin/_partials/breadcrumb.php") ?>
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <!-- Card  -->
                <div class="card mb-3">
                    <div class="card-header">
                        <!--redirect ke halaman index -->
                        <a href="<?php echo site_url('admin/members/') ?>"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Note: atribut action dikosongkan, artinya action-nya akan diproses 
							oleh controller tempat vuew ini digunakan. Yakni index.php/admin/products/edit/ID --->
                            <!--edit berdasarkan id -->
                            <input type="hidden" name="id" value="<?php echo $member->id_member ?>" />
                            <!-- data Nama Member berdasarkan id -->
                            <div class="form-group">
                                <label for="nama_member">Nama</label>
                                <input class="form-control <?php echo form_error('nama_member') ? 'is-invalid' : '' ?>" type="text" name="nama_member" placeholder="Nama Member" value="<?php echo $member->nama_member ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('nama_member') ?>
                                </div>
                            </div>
                            <!-- data tanggal lahir berdasarkan id -->
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input class="form-control <?php echo form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $member->tanggal_lahir ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('tanggal_lahir') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <br />
                                <input <?php echo form_error('jenis_kelamin') ? 'is-invalid' : '' ?> type="radio" name="jenis_kelamin" id="laki-laki" value="<?php echo $member->jenis_kelamin ?>" <?= $member->id_member == 0 ? "" : ($member->jenis_kelamin == "Laki-Laki" ? "checked" :  "") ?> />Laki-Laki
                                <input <?php echo form_error('jenis_kelamin') ? 'is-invalid' : '' ?> type="radio" name="jenis_kelamin" id="perempuan" value="<?php echo $member->jenis_kelamin ?>" <?= $member->id_member == 0 ? "" : ($member->jenis_kelamin == "Perempuan" ? "checked" :  "") ?> />Perempuan
                                <div class="invalid-feedback">
                                    <?php echo form_error('jenis_kelamin') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kewarganegaraan">Kewarganegaraan</label>
                                <br />
                                <?php
                                $stkewarganegaraan = "";
                                if ($member->id_member != 0) {
                                    $stkewarganegaraan = $member->kewarganegaraan;
                                }
                                ?>
                                <select class="form-control <?php echo form_error('kewarganegaraan') ? 'is-invalid' : '' ?>" name="kewarganegaraan" id="kewarganegaraan">
                                    <option selected="">--Pilih Kewarganegaraan--</option>
                                    <option value="Amerika Serikat" <?= ($stkewarganegaraan == "Amerika Serikat" ? "selected" : "") ?>>Amerika Serikat</option>
                                    <option value="Hong Kong <?= ($stkewarganegaraan == "Hong Kong" ? "selected" : "") ?>">Hong Kong</option>
                                    <option value="Jepang <?= ($stkewarganegaraan == "Jepang" ? "selected" : "") ?>">Jepang</option>
                                    <option value="Korea Selatan <?= ($stkewarganegaraan == "Korea Selatan" ? "selected" : "") ?>">Korea Selatan</option>
                                    <option value="Makau <?= ($stkewarganegaraan == "Makau" ? "selected" : "") ?>">Makau</option>
                                    <option value="Thailand <?= ($stkewarganegaraan == "Thailand" ? "selected" : "") ?>">Thailand</option>
                                    <option value="Tiongkok <?= ($stkewarganegaraan == "Tiongkok" ? "selected" : "") ?>">Tiongkok</option>
                                </select>
                                <!-- <input <?php echo form_error('kewarganegaraan') ? 'is-invalid' : '' ?> name="kewarganegaraan" value="<?php echo $member->kewarganegaraan ?>" ?> /> -->
                                <?php echo form_error('kewarganegaraan') ?>
                            </div>

                            <div class="form-group">
                                <label for="email_member">Email</label>
                                <input class="form-control <?php echo form_error('email_member') ? 'is-invalid' : '' ?>" type="email" name="email_member" placeholder="Email" value="<?php echo $member->email_member ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('email_member') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" type="password" name="password" placeholder="Password" value="<?php echo $member->password ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('password') ?>
                                </div>
                            </div>

                            <!-- data sub unit berdasarkan id -->
                            <div class="form-group">
                                <label for="unit">Sub Unit</label></br>
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="nctu" value="<?php echo $member->unit ?>" <?= $member->id_member == 0 ? "" : ($member->unit == "NCT U" ? "checked" :  "") ?> />NCT U
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="nct127" value="<?php echo $member->unit ?>" <?= $member->id_member == 0 ? "" : ($member->unit == "NCT 127" ? "checked" :  "") ?> />NCT 127
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="nctdream" value="<?php echo $member->unit ?>" <?= $member->id_member == 0 ? "" : ($member->unit == "NCT DREAM" ? "checked" :  "") ?> />NCT DREAM
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="wayv" value="<?php echo $member->unit ?>" <?= $member->id_member == 0 ? "" : ($member->unit == "WayV" ? "checked" :  "") ?> />WayV
                                <div class="invalid-feedback">
                                    <?php echo form_error('unit') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="foto_member">Foto</label>
                                <fieldset class="form-group">
                                    <input type="file" class="form-control-file" id="foto_member">
                                </fieldset>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control " id="deskripsi" name="deskripsi" value="<?php echo $member->deskripsi ?>"></textarea>
                            </div>
                            <input class="btn btn-success" type="submit" name="btn" value="Save" />
                        </form>
                    </div>
                    <div class="card-footer small text-muted">
                        * required fields
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <?php $this->load->view("admin/_partials/footer.php") ?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php $this->load->view("admin/_partials/scrolltop.php") ?>
    <?php $this->load->view("admin/_partials/js.php") ?>
</body>
<script>
    CKEDITOR.replace('deskripsi')
</script>

</html>