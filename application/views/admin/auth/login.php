<!-- Outer Row -->
<div class="container">
    <?php if ($this->session->flashdata('success')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $this->session->flashdata('success'); ?>',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?php echo $this->session->flashdata('error'); ?>',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    <?php endif; ?>
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block">
                            <img src="<?= base_url('assets/img/registerpic.jpg') ?>" alt="Register" class="img-fluid"
                                style=" object-fit: cover;">
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="text-gray-900 mb-4 font-weight-bolder"><i class="fas fa-key"></i>Login
                                    </h1>
                                </div>
                                <form class="user" method="post" action="<?= site_url('auth/login') ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="username"
                                            placeholder="Masukan Username" value="<?php echo set_value('username'); ?>">
                                        <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            placeholder="Password">
                                        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <!-- <input type="submit" class="btn btn-primary btn-user btn-block" value="Login"> -->
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    <hr>
                                </form>
                                <!-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div> -->
                                <div class="text-center">
                                    <a class="small" href="<?= site_url('auth/register') ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>