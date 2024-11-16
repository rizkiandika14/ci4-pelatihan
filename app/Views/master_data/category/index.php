<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kategori</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Kategori</li>
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
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah"><i
                  class="fa fa-plus"></i> Tambah</button>
              <!-- <button class="btn btn-sm btn-secondary float-right"><i class="fa fa-print"></i> Cetak Pdf</button> -->
          
              <!-- Tabel Data  -->
              <div class="p-0 mt-3">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kategori</th>
                      <th>Deskripsi</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($categories as $category): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $category->name; ?></td>
                        <td><?= $category->description; ?></td>
                        <td><button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#modal-gambar" data-src="<?= $category->image; ?>"><i
                              class="fa fa-eye"></i></button></td>
                        <td>
                          <button type="button" data-toggle="modal" data-target="#modal-edit" data-id="<?= $category->id; ?>" data-name="<?= $category->name; ?>" data-description="<?= $category->description; ?>" data-image="<?= $category->image; ?>" class="btn btn-sm btn-warning mb-1"><i class="fa fa-edit"></i> Edit</button>
                          <a href="/kategori/hapus/<?= $category->id; ?>" class="btn btn-sm btn-danger tombol-delete"><i
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


<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="/kategori/tambah" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control" required>
          </div>
          <!-- thumbnail image  -->
          <div class="form-group" id="thumbnail">
            <img src="" class="img-fluid thumbnail" alt="Gambar Kategori">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="/kategori/ubah" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="image-old" id="image-old">
          <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="image-edit">Gambar</label>
            <input type="file" name="image-edit" id="image-edit" accept="image/*" class="form-control">
          </div>
          <!-- thumbnail image  -->
          <div class="form-group" id="thumbnail-edit">
            <img src="" class="img-fluid thumbnail-edit" alt="Gambar Kategori">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-gambar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" class="img-fluid" alt="Gambar Kategori">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('#modal-gambar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var src = button.data('src')
    var modal = $(this)
    modal.find('.modal-body img').attr('src', '<?= base_url('uploads/kategori/'); ?>' + src)
  })

  $('#modal-edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var name = button.data('name')
    var description = button.data('description')
    var image = button.data('image')
    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #name').val(name)
    modal.find('.modal-body #description').val(description)
    modal.find('.modal-body #thumbnail-edit img').attr('src', '<?= base_url('uploads/kategori/'); ?>' + image)
    modal.find('.modal-body #image-old').val(image)
  })

  // hide thumbnail when null 
  $('#thumbnail').hide();
  // set max height for thumbnail
  $('.thumbnail').css('max-height', '200px');
  $('.thumbnail-edit').css('max-height', '200px');

  // set max file size
  $('#image').on('change', function () {
    const file = $(this)[0].files[0];
    if (file.size > 1000000) {
      alert('File terlalu besar, maksimal 1MB');
      $(this).val('');
    }
  });
  // set max file size
  $('#image-edit').on('change', function () {
    const file = $(this)[0].files[0];
    if (file.size > 1000000) {
      alert('File terlalu besar, maksimal 1MB');
      $(this).val('');
    }
  });

  $('#image').on('change', function () {
    const file = $(this)[0].files[0];
    const fileReader = new FileReader();
    fileReader.onload = function () {
      $('#thumbnail img').attr('src', fileReader.result);
    }
    fileReader.readAsDataURL(file);
    $('#thumbnail').show();
  });

  $('#image-edit').on('change', function () {
    const file = $(this)[0].files[0];
    const fileReader = new FileReader();
    fileReader.onload = function () {
      $('#thumbnail-edit img').attr('src', fileReader.result);
    }
    fileReader.readAsDataURL(file);
    $('#thumbnail-edit').show();
  });
</script>
<?= $this->endSection(); ?>