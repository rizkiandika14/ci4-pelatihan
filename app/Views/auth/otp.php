<?= $this->extend('auth/layout/template');; ?>


<?= $this->section('content'); ?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h3>Kode OTP SMART NUSA JAYANANTA</h3>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan masukan kode OTP yang telah dikirim ke alamat email anda
      (<?= $email ?? '_EMAIL_HERE_' ?>).</p>
      <form action="<?= base_url('otp') ; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="input-group mb-3">
          <input type="text" name="otp" class="form-control" placeholder="Masukkan kode OTP" maxlength="6">
        </div>
        <div class="row justify-content-between">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
        </div>
      </form>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<?= $this->endSection(); ?>