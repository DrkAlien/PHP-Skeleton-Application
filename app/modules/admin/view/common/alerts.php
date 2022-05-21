<?php
// success, info, warning, danger
$alert = Leaf\Http\Session::get('alert');
#echo '<pre/>';var_dump($alert);exit;
if($alert) {
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
    Leaf\Http\Session::unset('alert');
}
?>