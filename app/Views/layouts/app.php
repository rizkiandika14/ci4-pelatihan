<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?> | Smart Nusa Jayananta</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('template')?>/plugins/fontawesome-free/css/all.min.css">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="<?= base_url('template'); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('template'); ?>/plugins/toastr/toastr.min.css">
      <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('template'); ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('template'); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('template'); ?>/plugins/summernote/summernote-bs4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template')?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?= $this->include('layouts/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content'); ?>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Made by ❤️ from Rizki Andika with <a href="https://adminlte.io">AdminLTE.io</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024 <a href="#">Smart Nusa Jayananta</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('template') ; ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('template') ; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('template') ; ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('template'); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('template'); ?>/plugins/toastr/toastr.min.js"></script>
<!-- Custom bs input -->
<script src="<?= base_url('template'); ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- summernote  -->
<script src="<?= base_url('template'); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('template')?>/dist/js/adminlte.min.js"></script>
<?= $this->renderSection('script'); ?>
<script>
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>
<script>
    //toastr notification
    $(function() {
        <?php if (session()->getFlashdata('error') !== NULL) : ?>
        Swal.fire({
          position: "middle-center",
          icon: "error",
          title: "<?= session()->getFlashdata('error'); ?>",
          showConfirmButton: false,
          timer: 1500
        });
        <?php elseif(session()->getFlashdata('success') !== NULL) : ?>
        Swal.fire({
          position: "middle-center",
          icon: "success",
          title: "<?= session()->getFlashdata('success'); ?>",
          showConfirmButton: false,
          timer: 1500
        });
        <?php endif; ?>

        // jika ada error dari form validation 
        <?php if (session()->getFlashdata('errors') !== NULL) : ?>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                toastr.error("<?= $error ?>");
            <?php endforeach; ?>
        <?php endif; ?>
    });
  

    $('.tombol-delete').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            });
        });
        
</script>
</body>
</html>
