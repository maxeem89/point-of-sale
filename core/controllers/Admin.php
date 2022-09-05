<?php

/**
 * Admin controller class: controlles the workflow of the "/admin" request in index.php
 */

namespace Core\Controllers;

use Core\Base\Controller;
use Core\Base\View;
use Core\Models\Invoice;
use Core\Models\Item;
use Core\Models\Items_invoice;
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
        $invoice = new Invoice();
        $invoices_count = count($invoice->get_all());
        $invoices_total = array_values((array) $invoice->total('total')[0])[0];
        $items_invoice = new Items_invoice();
         $top =   $items_invoice->topSale();
        $topExp = new Item();
        $topExpinsive = $topExp->topExpinsive();
        $item = new Item();
        $items_count  = count($item->get_all());
        // How many News in our database.
      
        // How many tags in our database.
      
        // How many news was published per user who has id=1
        // SELECT * FROM posts WHERE author_id=1;
      
         
        return $this->view('admin.dashboard', [
           
            'users_count' => $users_count,
           'invoices_count' => $invoices_count,
           'items_count' => $items_count,
           'invoices_total' => $invoices_total,
           'top' => $top,
           'topExpinsive' => $topExpinsive,

        ]);
    }

    function __destruct()
    {
        self::unset_admin();
    }
}
