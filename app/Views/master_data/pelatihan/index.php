<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pelatihan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pelatihan</li>
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
                            <a href="/pelatihan/tambah" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                                Tambah</a>
                            <!-- <button class="btn btn-sm btn-secondary float-right"><i class="fa fa-print"></i> Cetak Pdf</button> -->

                            <!-- Tabel Data  -->
                            <div class="p-0 mt-3">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelatihan</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Trainer</th>
                                            <th>Kategori</th>
                                            <th>Biaya</th>
                                            <th>Sertifikat</th>
                                            <th>Jadwal</th>
                                            <th>Persyaratan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($trainings as $training): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $training->training_name; ?></td>
                                                <td><?= $training->description; ?></td>
                                                <td><button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                        data-target="#modal-gambar" data-src="<?= $training->image; ?>"><i
                                                            class="fa fa-eye"></i></button></td>
                                                <td><?= $training->name; ?></td>
                                                <td><?= $training->category; ?></td>
                                                <td><?= rupiah($training->price); ?></td>
                                                <td><?= $training->certificate; ?></td>
                                                <td>
                                                    <!-- button modal show jadwal -->
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#modal-jadwal" data-id="<?= $training->id; ?>" data-name="<?= $training->training_name; ?>" data-category="<?= $training->category; ?>"><i class="fa fa-calendar"></i>
                                                        Jadwal</button>
                                                </td>
                                                <td><a href="/pelatihan/persyaratan/<?= $training->id; ?>" class="btn btn-sm btn-success"><i
                                                            class="fa fa-list"></i> Persyaratan</a></td>
                                                <td>Review</td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modal-edit"
                                                        data-id="<?= $training->id; ?>" data-name="<?= $training->name; ?>"
                                                        data-description="<?= $training->description; ?>"
                                                        data-image="<?= $training->image; ?>"
                                                        data-trainer="<?= $training->trainer_id; ?>"
                                                        data-category="<?= $training->category; ?>"
                                                        data-price="<?= $training->price; ?>"
                                                        data-certificate="<?= $training->certificate; ?>"
                                                        class="btn btn-sm btn-warning mb-1"><i class="fa fa-edit
                            "></i> Edit</button>
                                                    <a href="/pelatihan/hapus/<?= $training->id; ?>"
                                                        class="btn btn-sm btn-danger tombol-delete"><i
                                                            class="fa fa-trash"></i> Hapus</a>
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


<!-- Modal Gambar  -->
<div class="modal fade" id="modal-gambar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gambar Pelatihan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="gambar" class="img-fluid" alt="gambar pelatihan">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Jadwal  -->
<div class="modal fade" id="modal-jadwal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Jadwal Pelatihan </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="judul">
            <div id="nama" class="ml-3 mt-2 text-bold"></div>
            </div>
            <div class="modal-body text-center">
                <!-- nama training -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function () {
        $('#modal-gambar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var src = button.data('src')
            var modal = $(this)
            modal.find('.modal-body #gambar').attr('src', src)
        })
    });

    // get jadwal by id training
    $('#modal-jadwal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var nama = button.data('name')
        var category = button.data('category')
        var modal = $(this)
        $.ajax({
            url: '/pelatihan/jadwal/' + id,
            type: 'get',
            success: function (response) {
                modal.find('.modal-body').html(response)
            }
        })
        modal.find('.judul #nama').html(nama)
    })
</script>
<?= $this->endSection(); ?>