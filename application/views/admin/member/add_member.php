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
                <div class="card mb-3">
                    <div class="card-header">
                        <!--redirect ke halaman index-->
                        <a href="<?php echo site_url('admin/members/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <!--form mengirim data ke controller members, method add -->
                        <form action="<?php echo site_url('admin/members/add') ?>" method="post" enctype="multipart/form-data">
                            <!--input untuk field nama_member-->
                            <div class="form-group">
                                <label for="nama_member">Nama</label>
                                <input class="form-control <?php echo form_error('nama_member') ? 'is-invalid' : '' ?>" type="text" name="nama_member" placeholder="Nama Member" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('nama_member') ?>
                                </div>
                            </div>
                            <!--input untuk field tanggal lahir-->
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input class="form-control <?php echo form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('tanggal_lahir') ?>
                                </div>
                            </div>

                            <!-- input untuk field jenis kelamin -->
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <br />
                                <input <?php echo form_error('jenis_kelamin') ? 'is-invalid' : '' ?> type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-Laki" required />Laki-Laki
                                <input <?php echo form_error('jenis_kelamin') ? 'is-invalid' : '' ?> type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required />Perempuan
                                <div class="invalid-feedback">
                                    <?php echo form_error('jenis_kelamin') ?>
                                </div>
                            </div>

                            <!-- input field kewarganegaraan -->
                            <div class="form-group">
                                <label for="kewarganegaraan">Kewarganegaraan</label>
                                <select class="form-control <?php echo form_error('kewarganegaraan') ? 'is-invalid' : '' ?>" name="kewarganegaraan" id="kewarganegaraan">
                                    <option selected="">--Pilih Kewarganegaraan--</option>
                                    <option value="Amerika Serikat">Amerika Serikat</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Jepang">Jepang</option>
                                    <option value="Korea Selatan">Korea Selatan</option>
                                    <option value="Makau">Makau</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Tiongkok">Tiongkok</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('kewarganegaraan') ?>
                                </div>
                            </div>

                            <!-- input field email -->
                            <div class="form-group">
                                <label for="email_member">Email</label>
                                <input class="form-control <?php echo form_error('email_member') ? 'is-invalid' : '' ?>" type="email" name="email_member" placeholder="Email" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('email_member') ?>
                                </div>
                            </div>

                            <!-- input field password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" type="password" name="password" placeholder="Password" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('password') ?>
                                </div>
                            </div>

                            <!--input field sub unit-->
                            <div class="form-group">
                                <label for="unit">Sub-Unit</label><br />
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="nctu" value="NCT U" />NCT U
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="nct127" value="NCT 127" />NCT 127
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="nctdream" value="NCT DREAM" />NCT DREAM
                                <input <?php echo form_error('unit') ? 'is-invalid' : '' ?> type="checkbox" name="unit[]" id="wayv" value="NCT DREAM" />WayV
                                <div class="invalid-feedback">
                                    <?php echo form_error('unit') ?>
                                </div>
                            </div>

                            <!-- input field foto -->
                            <div class="form-group">
                                <label for="foto_member">Foto</label>
                                <fieldset class="form-group">
                                    <input type="file" class="form-control-file" id="foto_member" name="foto_member">
                                </fieldset>
                            </div>
                            <!-- input deskripsi -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control " id="deskripsi" name="deskripsi"></textarea>
                            </div>
                            <input class="btn btn-success" type="submit" name="btn" value="Save" />
                    </div>
                    </form>
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

<!-- mereplace id deskripsi dengan ckeditor -->
<script>
    CKEDITOR.replace('deskripsi')
</script>

</html>
