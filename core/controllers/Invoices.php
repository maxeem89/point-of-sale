<?php

/**
 * Users controller class: controlles the workflow of the "/admin/users" request in index.php
 */

namespace Core\Controllers;

use Core\Base\Controller;
use Core\Base\View;
use Core\Models\Invoice;
use Core\Models\User;
use Core\Models\Item;
use Core\Models\Item_invoice;
use Core\Models\Items_Entry;
use Core\Models\Items_invoice;
use DateTime;
use Exception;

class Invoices extends Controller
{
    protected $timeNow;
    protected $itemBarcode;



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
        $invoices = new Invoice();
        $all_invoices = $invoices->get_all();
        $this->view = 'admin.invoices.list';
        $this->data['invoices'] = $all_invoices;
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
        $items = new Item();
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $this->data['items'] = $items->get_all();
        $this->view = 'admin.invoices.add';
    }

    public function store()
    {
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $result =   $_POST;
        $itemsInvoice = new Items_invoice();
        $invoice = new Invoice();
        $item = new Item();
        $invoiceId =  $invoice->insert([
            'user_id' => $_SESSION['user']->user_id,
            'total' => $_POST['total'],
            'created_at' => $this->dateNow(),
        ]);
        foreach ($result['serialNumber'] as $key => $value) {
            $itemsInvoice->insert([
                'item_id' =>  $result['serialNumber'][$key],
                'invoice_id' =>  $invoiceId,
                'quantity'  =>  $result['amount'][$key],
                'price_per_unit' => $result['price'][$key],
                'created_at' => $this->dateNow(),
            ]);
            $x =  $item->get_by_barcode($result['serialNumber'][$key]);
            $total = $x->quantity - $result['amount'][$key];
            $item->updateWithBarcode($result['serialNumber'][$key], ['quantity' => $total]);
        }
        echo(json_encode(['result' => 'Added']));
        exit();
    }


    public function edit()
    {
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $id = (int)$_GET['id'];
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $invoice = new Invoice();
        $this->data['item'] = $invoice->join($_GET['id']);
        $this->data['id'] = $id;
        $this->view = 'admin.invoices.add';
    }

    public function update()
    {
        $result =   $_POST;
        $invoice = new Invoice();
        $this->data['items'] = $invoice->join($_POST['form_id']);
        $newItem = new Item();
        $itemsInvoice = new Items_invoice();
        foreach ($this->data['items'] as $item) {
            $oldItem = new Item();
             $barcode = $item['item_id'];
            $invoice_id =  $item['invoice_id'];
            $quantity = (int)$item['quantity'];
            $oldItem = $oldItem->get_by_barcode($barcode);
            $total = $oldItem->quantity + $quantity;
            $newItem->updateWithBarcode($item['item_id'], ['quantity' => $total]);
            $invoice->delete($invoice_id);
        }

            $invoiceId =  $invoice->insert([
                'user_id' => $_SESSION['user']->user_id,
                'total' => $_POST['total'],
                'created_at' => $this->dateNow(),
            ]);
            foreach ($result['serialNumber'] as $key => $value) {
                $item = new Item();
                $itemsInvoice->insert([
                    'item_id' =>  $result['serialNumber'][$key],
                    'invoice_id' =>  $invoiceId,
                    'quantity'  =>  $result['amount'][$key],
                    'price_per_unit' => $result['price'][$key],
                    'created_at' => $this->dateNow(),
                ]);
                $x =  $item->get_by_barcode($result['serialNumber'][$key]);
                $total = $x->quantity - $result['amount'][$key];
                $item->updateWithBarcode($result['serialNumber'][$key], ['quantity' => $total]);
            }
 
            echo(json_encode(['result' => 'updated']));
            exit();

       
    }

    public function delete()
    {
        var_dump('here');
        die;
        $this->auth();
        $this->authorize('admin');
        self::set_admin();
        $items = new Item();
        $items->deleteWithBarcode($_POST['item_barcode']);
        redirect('/admin/items');
    }
}
