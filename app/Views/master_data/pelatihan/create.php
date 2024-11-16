<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Pelatihan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/pelatihan">Pelatihan</a></li>
                        <li class="breadcrumb-item active">Tambah Pelatihan</li>
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
                            
                            <form action="/pelatihan/tambah" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="name">Nama Pelatihan</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <!-- summernote  -->
                                    <textarea name="description" id="description" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <small class="text-danger align-top"> *File berupa gambar .jpg .jpg .png, ukuran max 1mb</small>
                                    <input type="file" name="image" id="image" class="form-control" required>
                                </div>
                                <div class="image-thumbnail">
                                    <img src="" alt="" class="img-thumbnail" style="display: none; max-height:300px;">
                                </div>
                                <div class="form-group">
                                    <label for="trainer_id">Trainer</label>
                                    <select name="trainer_id" id="trainer_id" class="form-control" required>
                                        <option value="" selected disabled>Pilih Trainer</option>
                                        <?php foreach ($trainers as $trainer): ?>
                                            <option value="<?= $trainer['id']; ?>"><?= $trainer['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Biaya</label>
                                    <input type="text" name="price" id="price" class="form-control" onkeyup="separator()" required>
                                </div>
                                <div class="form-group">
                                    <label for="certificate">Sertifikat</label>
                                    <select name="certificate" id="certificate" class="form-control" required>
                                        <option value="">Pilih Sertifikat</option>
                                        <option value="Sertifikasi BNSP">Sertifikasi BNSP</option>
                                        <option value="Sertifikasi Kemenkes">Sertifikasi Kemenkes</option>
                                    </select>
                                </div>
                                <!-- select multiple requirement -->
                                <div class="form-group">
                                    <label for="requirement_id">Persyaratan</label>
                                    <select style="width:100%;" name="requirement_id[]" id="requirement_id" class="form-control" multiple required>
                                        <?php foreach ($requirements as $requirement): ?>
                                            <option value="<?= $requirement->id; ?>"><?= $requirement->description; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!-- choice multiple schedule date -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
    // summernote description
    $('#description').summernote({
        height: 150,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            // ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    // image preview
    $('#image').on('change', function () {
        const file = $(this).get(0).files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                $('.image-thumbnail').find('img').attr('src', reader.result).show();
            }
            reader.readAsDataURL(file[0]);
        }
    });

    // separator number
    function separator() {
        var number = document.getElementById('price');
        number.addEventListener('keyup', function (e) {
            number.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
    }

    // select2 multiple
    $('#requirement_id').select2({
        placeholder: "Pilih Persyaratan",
        allowClear: true
    });
</script>
<?= $this->endSection(); ?>