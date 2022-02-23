<div class="wrapper">
    <?php include dirname(__FILE__).'/../common/topmenu.php' ?>
    <div class="page-wrapper">

        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            How To
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                                </span>
                                <input type="text" value="" class="form-control" placeholder="Search..." aria-label="Search in documentation">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">

                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h3>SITE_URL and BASE_URL</h3>
                                <p><b>BASE_URL</b> is basically the domain name e.g: https://www.domain.com. <br/>
                                   The <b>SITE_URL</b> is created in \APP:getRoute() method using <b>BASE_URL</b> and the language.
                                   The languages are set in the config file with EN as default.
                                   <b>SITE_URL</b> will look like: https://www.domain.com/es
                                </p>

                                <h3 class="card-title">Request and URL structure</h3>
                                <p>
                                    The URL structure is as folows: SITE_URL/language/module/controller/action/{UUID}/{{var}}/1/{{var}}/2 ...etc <br/>
                                    If no language is passed, or used, the default language is used. <br/>
                                    If module does not exist, the default module is used. <br/>
                                    If the controller does not exist, the default controller is used. <br/>
                                    If the action does not exists on the used controller, the default action is used. (see ValidateAction Middleware) <br/>
                                    If there is something after the {UUID}, this becomes var/value. The {UUID} won't exist. <br/>
                                </p>
                                <p>
                                    Some examples:<br/>
                                    <b>https://www.domain.com/view</b> same as: <b>https://www.domain.com/en/frontend/home/view</b><br/>
                                    <b>https://www.domain.com/admin/users</b> - the admin module > users controller > default/first action<br/>
                                    <b>https://www.domain.com/users/view/231</b> - the default module > users controller > view action > uuid = 231 <br/>
                                    <b>https://www.domain.com/users/view/var/231</b> - the default module > users controller > view action > var = 231. The UUID does not exist. <br/>
                                </p>
                                <h3 class="card-title">Middleware</h3>
                                <p>
                                    $app->addMiddleware('\App\Middleware\Class','Module\Controller');
                                    There are Before and After middlewares, that are executed before and after the action (controller's method) is called.
                                    Middlewares are added in the public/index.php<br/>
                                    $app->addMiddleware('\App\Middleware\ExampleMiddleware'); - will run on every module and controller<br/>
                                    $app->addMiddleware('\App\Middleware\ExampleMiddleware','Admin'); - will run on every controller on Admin module<br/>
                                    $app->addMiddleware('\App\Middleware\ExampleMiddleware','Admin\Home'); - will run on Home controller on Admin module<br/>
                                    To run for a specific action in a particular controller, use IF in your code if($controller->request->action == 'action')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>