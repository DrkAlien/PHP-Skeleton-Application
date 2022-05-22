<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>PHP Skeleton Application</title>
        <link href="<?= BASE_URL ?>/assets/admin/css/tabler.min.css" rel="stylesheet"/>
        <link href="<?= BASE_URL ?>/assets/admin/css/tabler-flags.min.css" rel="stylesheet"/>
        <link href="<?= BASE_URL ?>/assets/admin/css/tabler-payments.min.css" rel="stylesheet"/>
        <link href="<?= BASE_URL ?>/assets/admin/css/tabler-vendors.min.css" rel="stylesheet"/>
        <link href="<?= BASE_URL ?>/assets/admin/css/custom.css" rel="stylesheet"/>
        <script src="<?= BASE_URL ?>/assets/admin/js/jquery-3.6.0.min.js"></script>
        <script>
        var site_url = '<?= SITE_URL ?>';
        </script>
    </head>
    <body  class="<?php echo ($this->action == 'login')? 'border-top-wide border-primary d-flex flex-column ':'layout-fluid' ?> theme-dark">
        <?php include dirname(__FILE__).'/'.ucfirst($this->controller).'/'.$this->action.'.php' ?>
    </body>
    <script src="<?= BASE_URL ?>/assets/admin/js/tabler.min.js"></script>
    <?php
    // include a js file that is custom for this controller in order to split the code
    $controllerJsFile = APPLICATION_PATH.'/public/assets/admin/js/'.$this->controller.'.js';
    if(file_exists($controllerJsFile)) { ?>
        <script src="<?= BASE_URL ?>/assets/admin/js/<?php echo $this->controller.'.js' ?>"></script>
    <?php } ?>
</html>