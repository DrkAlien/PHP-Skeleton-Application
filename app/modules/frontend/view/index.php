<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>PHP Skeleton Application - Frontend</title>
        <link href="<?= BASE_URL ?>/assets/frontend/css/tabler.min.css" rel="stylesheet"/>
        <link href="<?= BASE_URL ?>/assets/frontend/css/tabler-flags.min.css" rel="stylesheet"/>
        <link href="<?= BASE_URL ?>/assets/frontend/css/tabler-payments.min.css" rel="stylesheet"/>
        <link href="<?= BASE_URL ?>/assets/frontend/css/tabler-vendors.min.css" rel="stylesheet"/>
        <link href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet">
        <link href="<?= BASE_URL ?>/assets/frontend/css/custom.css" rel="stylesheet"/>
        <script src="<?= BASE_URL ?>/assets/frontend/js/jquery-3.6.0.min.js"></script>
        <script>
        var site_url = '<?= SITE_URL ?>';
        </script>
    </head>
    <body  class="<?php echo ($this->action == 'login')? 'border-top-wide border-primary d-flex flex-column ':'' ?>">
        <?php include dirname(__FILE__).'/'.ucfirst($this->controller).'/'.$this->action.'.php' ?>
    </body>
    <script src="<?= BASE_URL ?>/assets/frontend/js/tabler.min.js"></script>
    <?php
    // include a js file that is custom for this controller in order to split the code
    $controllerJsFile = APPLICATION_PATH.'/public/assets/frontend/js/'.$this->controller.'.js';
    if(file_exists($controllerJsFile)) { ?>
        <script src="<?= BASE_URL ?>/assets/frontend/js/<?php echo $this->controller.'.js' ?>"></script>
    <?php } ?>
</html>