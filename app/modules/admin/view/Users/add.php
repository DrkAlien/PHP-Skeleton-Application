<div class="wrapper">
    <?php include dirname(__FILE__).'/../common/leftmenu.php' ?>
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Users
                        </div>
                        <h2 class="page-title">
                            Add
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <div class="d-none d-sm-none d-lg-block">
                                <?php include dirname(__FILE__).'/../common/accounticon.php' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">

                <?php include dirname(__FILE__).'/../common/alerts.php'; ?>

                <div class="row row-cards">
                    <div class="col-lg-6 col-md-6 col-sm-12">


                            <form action="<?php echo $this->getControllerUrl() ?>/add" method="post" class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">User Details</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">First Name</label>
                                            <div class="col">
                                                <input type="text" name="first_name" value="<?php echo (isset($this->data['form']['first_name']))? $this->data['form']['first_name']:'' ?>" class="form-control" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Last Name</label>
                                            <div class="col">
                                                <input type="text" name="last_name" value="<?php echo (isset($this->data['form']['last_name']))? $this->data['form']['last_name']:'' ?>" class="form-control"  placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Email address</label>
                                            <div class="col">
                                                <input type="email" name="email" value="<?php echo (isset($this->data['form']['email']))? $this->data['form']['email']:'' ?>" class="form-control"  placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Password</label>
                                            <div class="col">
                                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                                <small class="form-hint">
                                                    Your password is recomended to be 8-20 characters long, contain letters, special characters and numbers, must not contain spaces or emoji.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Plan</label>
                                            <div class="col">
                                                <select name="plan" class="form-select">
                                                    <?php foreach($this->data['plans'] as $plan) { ?>
                                                        <option value="<?php echo $plan['id'] ?>"><?php echo $plan['label'].' ($'.$plan['price'].')' ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="form-label col-3 col-form-label pt-0">Active</label>
                                            <div class="col">
                                                <label class="">
                                                    <label class="form-colorinput">
                                                        <input name="active" type="checkbox" value="1" checked="" class="form-colorinput-input">
                                                        <span class="form-colorinput-color bg-dark"></span>
                                                    </label>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex">
                                            <a href="<?php echo $this->getControllerUrl() ?>/list" class="btn btn-link">Cancel</a>
                                            <button type="submit" class="btn btn-primary ms-auto">Save</button>
                                        </div>
                                    </div>
                            </form>





                    </div>
                </div>
            </div>
        </div>

    </div>
</div>