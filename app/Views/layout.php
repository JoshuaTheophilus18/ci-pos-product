<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - <?php echo $this->getData()['headerTitle'] ?? ''; ?> </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">POS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= mark_nav_active('dashboard'); ?>">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard </a>
                </li>
                <li class="nav-item <?= mark_nav_active('products'); ?>">
                    <a class="nav-link" href="<?= base_url('products') ?>">Products</a>
                </li>
                <li class="nav-item <?= mark_nav_active('invoice'); ?>">
                    <a class="nav-link" href="<?= base_url('invoice') ?>">Invoice</a>
                </li>
                <li class="nav-item <?= mark_nav_active('recycle'); ?>">
                    <a class="nav-link" href="<?= base_url('recycle') ?>">Recycle Bin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('logout') ?>">Logout </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php
        $session = session();
        if ($session->has('status')) : ?>
            <div class="mt-2 alert alert-primary" role="alert">
                <?= $session->getFlashdata('status'); ?>
            </div>
        <?php endif ?>
        <?= $this->renderSection('content') ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?= $this->renderSection('js') ?>
</body>

</html>