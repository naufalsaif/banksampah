<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/app.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/pages/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="<?= base_url($namePage); ?>">
                            <h3 style="color: #435ebe;"><i class="fas fa-university"></i> Bank Sampah</h3>
                        </a>
                    </div>
                    <h1 class="auth-title"><?= $authTitle; ?></h1>
                    <p class="auth-subtitle mb-5"><?= $authSubtitle; ?></p>
                    <?= $this->renderSection('content'); ?>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block" style="background-color: #435ebe;">
                <!-- <div id="auth-right">
                </div> -->
                <?php if ($namePage == 'registrasi') : ?>
                    <img src="<?= base_url(); ?>/assets/images/samples/<?= $namePage; ?>.png" class="img-fluid rounded-start" style="margin-top: 10vh;" alt="gambar <?= $namePage; ?>">
                <?php else : ?>
                    <img src="<?= base_url(); ?>/assets/images/samples/<?= $namePage; ?>.png" class="img-fluid rounded-start" alt="gambar <?= $namePage; ?>">
                <?php endif; ?>
            </div>
        </div>

    </div>

    <script src="<?= base_url(); ?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url(); ?>/assets/js/mazer.js"></script>
</body>

</html>