<?php

/**
 * Admin controller class: controlles the workflow of the "/admin" request in index.php
 */

namespace Core\Controllers;

use Core\Base\Controller;
use Core\Base\View;
use Core\Models\User;

class Admin extends Controller
{

    public function render(): View
    {
        $this->auth();

        self::set_admin();

        // get site title
    
      

        // admin dashboard to show the flowing:
        // How many users in our data base.
        $user = new User();
        $users_count = count($user->get_all());
        // How many News in our database.
      
        // How many tags in our database.
      
        // How many news was published per user who has id=1
        // SELECT * FROM posts WHERE author_id=1;
      
         
        return $this->view('admin.dashboard', [
           
            'users_count' => $users_count,
           
        ]);
    }

    function __destruct()
    {
        self::unset_admin();
    }
}
