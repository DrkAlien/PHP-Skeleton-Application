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
                            List
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
                    <div class="col-lg-4 col-md-3 col-sm-12">
                        <a href="<?php echo $this->getControllerUrl() ?>/add" class="btn btn-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            New Admin
                        </a>
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-12"></div>
                    <div class="col-lg-3 col-md-5 col-sm-12 right">
                        <div class="input-icon mb-3">
                            <input type="text" value="" class="form-control" placeholder="Search">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($this->data as $admin) { ?>
                                        <tr>
                                            <td><?php echo $admin['first_name'].' '.$admin['last_name'] ?></td>
                                            <td class="text-muted" >
                                                <?php echo $admin['email'] ?>
                                            </td>
                                            <td class="text-muted" >
                                                <?php echo $admin->adminRole->label ?>
                                            </td>
                                            <td class="text-muted" >
                                                <?php if($admin['active']) { ?>
                                                    <span class="legend me-2 bg-success"></span>
                                                    <span>Active</span>
                                                <?php } else { ?>
                                                    <span class="legend me-2 bg-danger"></span>
                                                    <span>Inactive</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $this->getControllerUrl() ?>/edit/<?php echo $admin['id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo $this->getControllerUrl() ?>/delete/<?php echo $admin['id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer d-flex align-items-center">
                                <?php include dirname(__FILE__).'/../common/pagination.php' ?>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>




    </div>
</div>