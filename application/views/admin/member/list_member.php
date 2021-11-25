<!DOCTYPE html>
<html lang="en">

<!-- menampilkan data pada halaman admin untuk bagian head. -->

<head>
    <?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">
    <!-- menampilkan data pada halaman admin untuk bagian navbar. -->
    <?php $this->load->view("admin/_partials/navbar.php") ?>
    <div id="wrapper">
        <!-- menampilkan data pada halaman admin untuk bagian sidebar. -->
        <?php $this->load->view("admin/_partials/sidebar.php") ?>

        <div id="content-wrapper">

            <div class="container-fluid">
                <!-- menampilkan data pada halaman admin untuk bagian breadcrumb. -->
                <?php $this->load->view("admin/_partials/breadcrumb.php") ?>

                <!-- DataTables -->
                <div class="card mb-3">
                    <div class="card-header">
                        <!-- redirect ke fungsi add di mana meload view halaman admin add_member -->
                        <a href="<?php echo site_url('admin/members/add') ?>"><i class="fas fa-plus"></i> Add New</a>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <!-- membuat tabel -->
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Sub Unit</th>
                                        <th>Kewarganegaraan</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Foto</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--pada bagian isinya mengambil data dari database, variabel members pada controller digunakan untuk menyimpan semua data dari database tabel tb_member -->
                                    <!--variabel members didefinisikan sebagai variabel member-->
                                    <?php foreach ($members as $member) : ?>
                                        <tr>
                                            <!--menampilkan data nama-->
                                            <td width="150">
                                                <?php echo $member->nama_member ?>
                                            </td>
                                            <!--menampilkan data tanggal lahir-->
                                            <td width="150">
                                                <?php echo formatHariTanggal($member->tanggal_lahir) ?>
                                            </td>
                                            <!--menampilkan data jenis kelamin-->
                                            <td width="150">
                                                <?php echo $member->jenis_kelamin ?>
                                            </td>
                                            <!--menampilkan data sub unit-->
                                            <td width="150">
                                                <?php echo $member->unit ?>
                                            </td>
                                            <!--menampilkan data kewarganegaran -->
                                            <td width="150">
                                                <?php echo $member->kewarganegaraan ?>
                                            </td>
                                            <!--menampilkan data email-->
                                            <td width="150">
                                                <?php echo $member->email_member ?>
                                            </td>
                                            <!--menampilkan data password-->
                                            <td width="150">
                                                <?php echo $member->password ?>
                                            </td>
                                            <!--menampilkan data foto-->
                                            <td width="150">
                                                <img src="<?php echo base_url() . '/assets/images/' . $member->foto_member ?>" width="20">
                                            </td>
                                            <!--menampilkan data deskripsi-->
                                            <td width="150">
                                                <?php echo $member->deskripsi ?>
                                            </td>
                                            <td width="250">
                                                <!-- redirect ke fungsi edit di mana meload view halaman admin edit_member -->
                                                <!-- data yang diedit sesuai dengan id nya -->
                                                <a href="<?php echo site_url('admin/members/edit/' . $member->id_member) ?>" class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                                                <!-- redirect ke fungsi delete di -->
                                                <!-- data yang didelete sesuai dengan id nya -->
                                                <!-- event onclick yang akan memanggil fungsi deleteConfirm()->fungsi javascript->menampilkan modal konfirmasi -->
                                                <a onclick="deleteConfirm ('<?php echo site_url('admin/members/delete/' . $member->id_member) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <!-- menampilkan data pada halaman admin untuk bagian footer. -->
            <?php $this->load->view("admin/_partials/footer.php") ?>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php $this->load->view("admin/_partials/scrolltop.php") ?>
    <?php $this->load->view("admin/_partials/modal.php") ?>

    <?php $this->load->view("admin/_partials/js.php") ?>
    <!--fungsi javascript untuk konfirmasi delete 	 -->
    <script>
        function deleteConfirm(url) {
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();
        }
    </script>

</body>

</html>