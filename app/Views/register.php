<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>POS - Register</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">

    <meta name="theme-color" content="#7952b3">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Register Form</h1>
            Silahkan Daftarkan Identitas Anda
            <hr />
            <?php 
                $errors ?? ""; 
                echo form_open("/register/process"); 
                csrf_field();
            ?>
                <div class="mb-3">
                    <?= form_label('Username', 'username') ?>
                    <?= form_input('username', old('username') ?? "", ['class' => 'form-control']); ?>
                    <small class="form-text text-danger"> <?=  $validation->getError('username'); ?></small>
                </div>
                <div class="mb-3">
                    <?= form_label('Password', 'password') ?>
                    <?= form_password('password', old('password') ?? "", ['class' => 'form-control']); ?>
                    <small class="form-text text-danger"> <?= $validation->getError('password'); ?></small>
                </div>
                <div class="mb-3">
                    <?= form_label('Confirm Password', 'password_conf') ?>
                    <?= form_password('password_conf', old('password_conf') ?? "", ['class' => 'form-control']); ?>
                    <small class="form-text text-danger"> <?= $validation->getError('password_conf'); ?></small>
                </div>
                <div class="mb-3">
                    <?= form_label('Name', 'name') ?>
                    <?= form_input('name', old('name') ?? "", ['class' => 'form-control']); ?>
                    <small class="form-text text-danger"> <?= $validation->getError('name'); ?></small>
                </div>
                <div class="mb-3">
                    <?= form_submit('Register', 'Register', ['class' => 'btn btn-primary']); ?>
                    <?= anchor('login', 'Back', ['class' => 'btn btn-danger']); ?>
                    <?= form_close(); ?>
                </div>
            <hr />
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>

</body>
</html>