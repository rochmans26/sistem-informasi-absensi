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
                        <div class="col">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="text-gray-900 mb-4 font-weight-bolder"><i
                                            class="fas fa-list mr-2"></i>Register
                                    </h1>
                                </div>
                                <form class="user" method="post" action="<?= site_url('auth/register') ?>">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <h4 class="text-center mb-4">Create an Account</h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="nama" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control form-control-user"
                                                            id="nama" name="nama" placeholder="Enter your full name"
                                                            value="<?php echo set_value('nama'); ?>">
                                                        <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="email" class="form-label">Email Address</label>
                                                        <input type="email" class="form-control form-control-user"
                                                            id="email" name="email" placeholder="Enter your email"
                                                            value="<?php echo set_value('email'); ?>">
                                                        <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="sex" class="form-label">Gender</label>
                                                        <select class="form-select form-control-user" id="sex"
                                                            name="sex">
                                                            <option value="" disabled selected>Select your gender
                                                            </option>
                                                            <option value="1" <?php echo set_select('sex', '1'); ?>>
                                                                Male</option>
                                                            <option value="2" <?php echo set_select('sex', '2'); ?>>Female</option>
                                                        </select>
                                                        <?php echo form_error('sex', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="age" class="form-label">Age</label>
                                                        <input type="number" class="form-control form-control-user"
                                                            id="age" name="age" placeholder="Enter your age" min="12"
                                                            max="99" value="<?php echo set_value('age'); ?>">
                                                        <?php echo form_error('age', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="telp" class="form-label">Phone Number</label>
                                                <input type="tel" class="form-control form-control-user" id="telp"
                                                    name="telp" placeholder="Enter your phone number"
                                                    value="<?php echo set_value('telp'); ?>">
                                                <?php echo form_error('telp', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control form-control-user" id="username"
                                                    name="username" placeholder="Choose a username"
                                                    value="<?php echo set_value('username'); ?>">
                                                <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control form-control-user"
                                                            id="password" name="password"
                                                            placeholder="Create a password">
                                                        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="password_confirm" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control form-control-user"
                                                            id="password_confirm" name="password_confirm"
                                                            placeholder="Repeat your password">
                                                        <?php echo form_error('password_confirm', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-user btn-block py-2">
                                                <i class="fas fa-user-plus mr-2"></i> Register Account
                                            </button>

                                            <hr>

                                            <div class="text-center">
                                                <a class="small" href="<?= site_url('auth/login') ?>">Already have an
                                                    account? Login!</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>