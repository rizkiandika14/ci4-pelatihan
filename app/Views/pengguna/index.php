<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengguna</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-orange card-outline">
                        <div class="card-body">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah</button>
                            <!-- <button class="btn btn-sm btn-secondary float-right"><i class="fa fa-print"></i> Cetak Pdf</button> -->
                            
                            <!-- select role  -->
                            <div class="form-group mt-3">
                                <label for="role">Pilih Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="">Semua</option>
                                    <option value="admin">Admin</option>
                                    <option value="trainer">Trainer</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <!-- Tabel Data  -->
                            <div class="p-0 mt-3">
                                <div id="ajax-table">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambahLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('pengguna/tambah'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-tambahLabel">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Pengguna</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">No. HP</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control" id="gender" name="gender"required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="trainer">Trainer</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function () {
        // Load Table
        load_data();

        // Load Data
        function load_data(role = '') {
            $.ajax({
                url: '<?= base_url('pengguna/ajax_table'); ?>',
                method: 'POST',
                data: {
                    role: role
                },
                success: function (data) {
                    $('#ajax-table').html(data);
                }
            });
        }

        // Select Role
        $('#role').change(function () {
            var role = $(this).val();
            load_data(role);
        });
    });
</script>
<?= $this->endSection(); ?>