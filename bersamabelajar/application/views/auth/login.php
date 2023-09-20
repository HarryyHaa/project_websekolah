<body  class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>DATA </b> SMK HS AGUNG</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Candy SI-Pede 1.0</p>
                <?= $this->session->flashdata('pesan') ?>
                <form action="<?= base_url('auth') ?>" method="post">
                    <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    <div class="input-group mb-3">
                        <input type="text" name="email" value='<?= set_value('email') ?>' class="form-control" placeholder="Username">
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
                    <div class="row">
                       <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Show Password
                                </label>
                            </div>
                        </div>-->
                        <!-- /.col -->
                        <!-- <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>-->
                        <!-- /.col -->
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