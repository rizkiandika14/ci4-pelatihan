<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Persyaratan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Persyaratan</li>
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

                            <!-- Tabel Data  -->
                            <div class="p-0 mt-3">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Persyaratan</th>
                                            <th>Wajib</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($requirements as $requirement): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $requirement->description; ?></td>
                                                <td><?= $requirement->is_required == 'yes' ? 'Ya' : 'Tidak'; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                        data-target="#modal-edit" data-id="<?= $requirement->id; ?>"
                                                        data-description="<?= $requirement->description; ?>"
                                                        data-is_required="<?= $requirement->is_required; ?>"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#modal-hapus" data-id="<?= $requirement->id; ?>"
                                                        data-description="<?= $requirement->description; ?>"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modal-tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/syarat/tambah" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-tambahLabel">Tambah Persyaratan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="description">Persyaratan</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="is_required">Wajib</label>
                        <select name="is_required" id="is_required" class="form-control" required>
                            <option value="">Pilih Wajib</option>
                            <option value="yes">Ya</option>
                            <option value="no">Tidak</option>
                        </select>
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

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/syarat/ubah" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Ubah Persyaratan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="description">Persyaratan</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="is_required">Wajib</label>
                        <select name="is_required" id="is_required" class="form-control" required>
                            <option value="">Pilih Wajib</option>
                            <option value="yes">Ya</option>
                            <option value="no">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $('#modal-edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var description = button.data('description');
        var is_required = button.data('is_required');

        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #is_required').val(is_required);
    });
</script>
<?= $this->endSection(); ?>