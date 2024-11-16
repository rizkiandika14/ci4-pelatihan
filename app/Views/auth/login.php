<?= $this->extend('auth/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1"><b>SMART NUSA JAYANANTA</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masuk untuk memulai sesi</p>
      <form action="<?= base_url('login') ; ?>" method="post">
        <?= csrf_field(); ?>
      <?php
        if (session()->getFlashdata('errEmail')) {
        $isInvalidEmail = 'is-invalid';
        } else {
        $isInvalidEmail = '';
        }
        ?>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control <?= $isInvalidEmail ?>" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <?php
            if (session()->getFlashdata('errEmail')) {
                echo '<div class="invalid-feedback"> ' . session()->getFlashdata('errEmail') . '</div>';
            }
            ?>
        </div>
        <?php
        if (session()->getFlashdata('errPassword')) {
        $isInvalidPassword = 'is-invalid';
        } else {
        $isInvalidPassword = '';
        }
        ?>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control <?= $isInvalidPassword ?>" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php
            if (session()->getFlashdata('errPassword')) {
                echo '<div class="invalid-feedback"> ' . session()->getFlashdata('errPassword') . '</div>';
            }
            ?>
        </div>
        <div class="row justify-content-between">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
          <p class="align-self-end mb-0">
            <a href="forgot-password.html">Lupa password?</a>
          </p>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
 
<?= $this->endSection(); ?>