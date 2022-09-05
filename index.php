<?php
session_start();
// Routing using procedural programming..
// require_once './depreciated/procedural_router.php';

require_once "./config.php";
require_once "./functions.php";
use Core\Models\User;
use Core\Router;

spl_autoload_register(function ($class_name) {

    // $class_name = Core\Router
    $file_path = __DIR__; // /Applications/xamp/htdocs/point_of_sales

    $class_name = explode('\\', $class_name);
    if ($class_name[0] != 'Core')
        return;

    foreach ($class_name as $key => $value) {
        // if $key == last_key in $class_name, don't strtolower. 
        if ($key != array_key_last($class_name)) {
            $class_name[$key] = strtolower($value);
        }
        $file_path .= '/' . $class_name[$key];
    }

    $file_path .= '.php';
    // /Applications/xamp/htdocs/point_of_sales/core/Router.php
    require_once $file_path;
});


if (isset($_COOKIE['logged_in_user'])) {
    $user = new User();
    $auth_user = $user->get_by_id($_COOKIE['logged_in_user']);
    if (!empty($auth_user)) {
        $_SESSION['user'] = (object) [
            'username' => $auth_user->user_name,
            'display_name' => $auth_user->display_name,
            'user_id' => $auth_user->id,
            'logged' => true
        ];
    }
}


// Adminstrating Routes
Router::get('/admin', 'admin'); // permission:all


// all
Router::get('/', 'login.form');
Router::post('/login', 'login.authenticate');
Router::get('/logout', 'login.logout');

// permission:admin
Router::get('/admin/users', 'users.list');
Router::get('/admin/users/single', 'users.single');
Router::get('/admin/users/add', 'users.add');
Router::post('/admin/users/store', 'users.store');
Router::get('/admin/users/edit', 'users.edit');
Router::post('/admin/users/update', 'users.update');
Router::post('/admin/users/delete', 'users.delete');

//items entry
Router::get('/admin/items','items.list');
Router::get('/admin/items/single','items.single');
Router::get('/admin/items/edit','items.edit');
Router::post('/admin/items/update','items.update');
Router::get('/admin/items/add','items.add');
Router::post('/admin/items/store','items.store');
Router::post('/admin/items/delete','items.delete');
Router::post('/admin/items/search','items.search');
    
//invoices entry
Router::get('/admin/invoices','invoices.list');
Router::get('/admin/invoices/single','invoices.single');
Router::get('/admin/invoices/edit','invoices.edit');
Router::post('/admin/invoices/update','invoices.update');
Router::get('/admin/invoices/add','invoices.add');
Router::post('/admin/invoices/store','invoices.store');
Router::post('/admin/invoices/delete','invoices.delete');
    


// all
Router::get('/admin/profile', 'profile.list');
Router::get('/admin/profile/edit', 'profile.edit');
Router::post('/admin/profile/update', 'profile.update');


Router::redirect();
