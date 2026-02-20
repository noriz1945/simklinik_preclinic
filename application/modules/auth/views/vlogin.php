<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="SimKlinik">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - SimKlinik</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon.png'); ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome/css/all.min.css'); ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body class="account-page">

    <!-- Begin Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="row w-100 justify-content-center">
                    <div class="col-lg-3">

                        <div class="login-header">
                            <div class="text-center mb-2">
                                <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="logo"
                                    class="img-fluid mb-2">
                                <h3 class="fw-bold text-dark mb-2">Login</h3>
                                <p class="text-dark mb-0">Please enter your login details to sign in</p>
                            </div>
                        </div>

                        <?php if ($this->session->flashdata('message')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('message'); ?></div>
                        <?php endif; ?>

                        <!-- Form action directed to do_login controller -->
                        <form action="<?php echo base_url('auth/do_login'); ?>" method="post">
                            <div class="card border-0 p-4 login-bg">
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-medium text-dark">Username <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="username" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-medium text-dark">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <p class="text-dark text-center"> Copyright &copy; <?php echo date('Y'); ?> - SimKlinik </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/jquery-3.7.1.min.js'); ?>"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Main JS -->
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>

</body>

</html>