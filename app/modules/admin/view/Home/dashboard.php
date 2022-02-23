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
                            Admin
                        </div>
                        <h2 class="page-title">
                            Dashboard
                        </h2>
                    </div>
                    <!-- Page title actions -->
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
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-3">

                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-blue text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crown" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        <?php echo $this->data['admins'] ?> Admins
                                                    </div>
                                                    <div class="text-muted">
                                                        <?php echo $this->data['adminsActive'] ?> active
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-sm-6 col-lg-3">

                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-green text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="9" cy="7" r="4"></circle>
                                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        <?php echo $this->data['users'] ?> Users
                                                    </div>
                                                    <div class="text-muted">
                                                        <?php echo $this->data['usersActive'] ?> active
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-sm-6 col-lg-3">

                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <a class="btn btn-twitter w-100 btn-icon js-load-users">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium js-total-users">
                                                        <span>Click to load JSON</span> Users
                                                    </div>
                                                    <div class="text-muted js-active-users">
                                                        <span>n\a</span> active
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-sm-6 col-lg-3">

                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <a class="btn btn-youtube w-100 btn-icon js-load-html">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-rectangle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M16.3 5h.7a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h5l-2.82 -2.82m0 5.64l2.82 -2.82" transform="rotate(-45 12 12)"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="col js-html-response">
                                                    Click to load HTML file
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card card-md">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7"></path><line x1="10" y1="10" x2="10.01" y2="10"></line><line x1="14" y1="10" x2="14.01" y2="10"></line><path d="M10 14a3.5 3.5 0 0 0 4 0"></path></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h3 class="h1">Tabler Theme</h3>
                                    <div class="markdown text-muted">
                                        Tabler is fully responsive and compatible with all modern browsers.
                                        Thanks to its modern, user-friendly design you can create a fully functional interface that users will love!
                                    </div>
                                    <div class="mt-3">
                                        <a href="https://preview.tabler.io" class="btn btn-primary" target="_blank" rel="noopener">Download Theme</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                <p>\App\Response $this->data</p>
                <?php
                    echo '<pre/>';print_r($this->data);
                ?>
                </div>
            </div>
        </div>




    </div>
</div>