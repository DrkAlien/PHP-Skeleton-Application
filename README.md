# A PHP Lightweight Skeleton Application

At start, it contains three modules: frontend, admin and api.
- The frontend and admin modules are using Tabler https://github.com/tabler/tabler HTML UI.
- The App does have a onion like middleware implementation
- It uses Eloquent for the MySQL database.
- No template class is used, plain and simple html-php files.
- The models and the middlewares are psr-4 loaded.

### How to use it
1. Clone the repository
2. Create your database and import the php_app.sql file
3. Run `composer update`
4. Edit the config.php to match your environment
5. Login to your **SITE_URL**/admin with admin@admin.com and pass: 123456

### How it works
It is a MVC application so it consists of models,views and controllers.
- The App.php is the core file. It does have 3 classes App, Request and Response.
- The URL has a relative fixed structure as follows:
**SITE_URL**/language/module/controller/action/`{uuid}` or /var1/`{value1}`/var2/`{value2}`

If any of the following: language, module, controller and action are missing from the URL, the default values are used ( see config.php ).

### Middleware
There are two types of middleware, `before` and `after` middleware.
1. The `before` middleware accepts the `$controller` obj and it is called before the controller's action is executed. It does have access to the \Request, thus you can check for the existance of variables and make decisions.
2. The `after` middleware accepts the `$controller` obj and it is called after the controller's action is executed. At this point the data should have been set for the view, thus you can alter it.

The App uses one mandatory middleware to validate the controller's action/method (ValidateAction.php).
To create a new middleware, have a look in the **app/middleware/** folder and use the black middlewares provided: `BeforeMiddleware.php` and `AfterMiddleware.php`

To add a middleware to the stack, add a new line in the `public/index.php` file as follows:
```sh
// to run on every controller in any module
$app->addMiddleware('\App\Middleware\ExampleMiddleware');
// to run on every controller in a specific module (admin)
$app->addMiddleware('\App\Middleware\ExampleMiddleware','Admin');
// to run on a specific controller (Home) in a specific module (admin)
$app->addMiddleware('\App\Middleware\ExampleMiddleware','Admin\Home');
```

### Controller and Model
- To create a new Model take a look at how **Eloquent** works.
- The controller is just a simple class, it does not extends a main controller.
- One controller is loaded at all times, but all the models are available to you at all times in the loaded controller.
- The \Request and the \Response are attached/a property to the `$controller` object, that were set in the \App core class, thus you have access to them in your middlewares.

### Enjoy
If you have any questions, open a new issue.
I know it may not be "to standard" but the idea is to have a fast, lightweight, strict URL structured app, that always matches the URL with the folder structure.
You should always be able to predict where you code is, based on the URL.
