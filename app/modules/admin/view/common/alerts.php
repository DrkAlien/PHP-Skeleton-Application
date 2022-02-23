<?php
// success, info, warning, danger
if(\App\App::$session->exist('alert')) {
    $alert = \App\App::$session->get('alert');
    ?>
    <div class="alert alert-<?php echo $alert['type'] ?> alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
            </div>
            <div>
                <h4 class="alert-title"><?php echo $alert['title'] ?></h4>
                <div class="text-muted"><?php echo $alert['text'] ?></div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    </div>
<?php
    \App\App::$session->del('alert');
    // you have to commit your changes to the session
    \App\App::$session->commit();
}
?>