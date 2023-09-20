  <body class="hold-transition login-page" style="background: #FFFFFF;">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?= base_url('assets/img/') . $setting['header'] ?>">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" style="background: #FFFAFA;">
                <p class="login-box-msg">SMK Plus Pratama Adi</p>
                <?= $this->session->flashdata('pesan') ?>
                <form action="<?= base_url('Login') ?>" method="post">
                    <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                    <div class="input-group mb-3">
                        <input type="text" name="username" value='<?= set_value('username') ?>' class="form-control" placeholder="Username">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                    <div class="input-group mb-3">
                        <input type="password" name="password" value='<?= set_value('password') ?>' class="form-control" placeholder="Password">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                
                    <div class="social-auth-links text-center mb-3">
                        <button class="btn btn-block btn-primary">
                            <i class="fab fa-sign-in mr-2"></i> Login Masuk
                        </button>

                    </div>
                    <!-- /.social-auth-links -->
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

<script type="text/javascript">
  document.onkeydown = function(e) {
    if(event.keyCode == 123) {
      return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
      return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
      return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
      return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
      return false;
    }
  }

  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });
</script>