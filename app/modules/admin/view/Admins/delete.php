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
                            Admins
                        </div>
                        <h2 class="page-title">
                            Delete
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

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="<?php echo $this->getControllerUrl() ?>/delete/<?php echo $this->data['id'] ?>" method="post" class="card">

                            <div class="card-header">
                                <h4 class="card-title">Confirm deletion !</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="checkbox" name="delete" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">Delete "<?php echo $this->data['first_name'].' '.$this->data['last_name'] ?>"</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex">
                                    <a href="<?php echo $this->getControllerUrl() ?>/list" class="btn btn-default">Back</a>
                                    <button type="submit" class="btn btn-danger ms-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="4" y1="7" x2="20" y2="7"></line>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>