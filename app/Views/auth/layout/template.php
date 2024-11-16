<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?> | Smart Nusa Jayananta</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('template') ; ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('template') ; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- SweetAlert2 -->
      <link rel="stylesheet" href="<?= base_url('template'); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('template'); ?>/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template') ; ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<?= $this->renderSection('content'); ?>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('template') ; ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('template') ; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('template'); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('template'); ?>/plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url('template') ; ?>/dist/js/adminlte.min.js"></script>

    <script>
        //toastr notification
        $(function() {
            <?php if (session()->getFlashdata('error') !== NULL) : ?>
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "<?= session()->getFlashdata('error'); ?>",
              });
            <?php elseif(session()->getFlashdata('success') !== NULL) : ?>
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "<?= session()->getFlashdata('success'); ?>",
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
