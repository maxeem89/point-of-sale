<?php

/**
 * Users controller class: controlles the workflow of the "/admin/users" request in index.php
 */

namespace Core\Controllers;

use Core\Base\Controller;
use Core\Base\View;
use Core\Models\User;
use Core\Models\Item;
use Core\Models\Items_Entry ;
use DateTime;
use Exception;

class Items extends Controller
{

    
    protected $timeNow;

    public function render(): View
    {
        return $this->view($this->view, $this->data);
    }

    function __destruct()
    {
        self::unset_admin();
    }

    public function list()
    {
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $items = new Item();
        $all_items = $items->get_all();
        $this->view = 'admin.items.list';
        $this->data['items'] = $all_items;
    }

    
    public function search()
    {
        $item = new Item();
       
            $result =  $item->where('barcode' , $_POST['barcode']);
            if(empty($result->data) ){
                echo json_encode( ['status' => '404'] ); 
                exit();
            }
        echo   json_encode(["result" => $result]);
        exit();
    }

    public function single()
    {

        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $items = new Item();
        // please do not forget to do a validation if the item was not found, to redirect to 404.
        $this->view = 'admin.items.single';
        $this->data['item'] = $items->get_by_barcode($_GET['barcode']);
    }

    public function add()
    {

        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $this->view = 'admin.items.add';
    }

    public function store()
    {
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $items = new Item();
    
        $entryItem  = new Items_Entry();
       
       try{ 
        $items->insert([
            'barcode' => $_POST['barcode'],
            'name' => $_POST['name'],
            'quantity' =>  $_POST['quantity'],
            'discription' => $_POST['discription'],
            'selling_price_per_unit' => $_POST['sellingPrice'],
            'user_id' => $_POST['user_id'],
            'created_at' => $this->dateNow(),
            'updated_at' => $this->dateNow(),
        ]);
        $entryItem->insert([
            'quantity' =>  $_POST['quantity'],
            'buy_price_per_unit' => $_POST['buyingPrice'],
            'user_id' => $_POST['user_id'],
            'items_barcode' => $_POST['barcode'],
            'created_at' => $this->dateNow(),
            'updated_at' => $this->dateNow(),
        ]);
        redirect('/admin/items');
    }
    catch (Exception $e) {
        redirect('/admin/items');
        
    }
    }

    public function edit()
    {

        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $items = new Item();
        $this->view = 'admin.items.edit';
        $this->data['item'] = $items->get_by_barcode($_GET['barcode']);
    }

    public function update()
    {
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $items = new Item();
        $this->timeNow = $this->timeNow->format('Y-m-d h:m');
        $items->updateWithBarcode($_POST['barcode'], [
            'barcode' => $_POST['itemBarcode'],
            'name' => $_POST['itemName'],
            'quantity' =>  $_POST['quantity'],
            'discription' => $_POST['itemsDiscriptin'],
            'selling_price_per_unit' => $_POST['price'],
            'updated_at' => $this->dateNow(),
        ]);
        redirect('/admin/items');
    }

    public function delete()
    {
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $items = new Item();

        $items->deleteWithBarcode($_POST['item_barcode']);

        redirect('/admin/items');
    }
}
