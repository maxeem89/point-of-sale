<?php

/**
 * Model class: parent class of model classes
 */

namespace Core\Base;

use Core\Helpers\Tests;
use mysqli;

use function PHPSTORM_META\type;

class Model
{
    use Tests;
    protected $connection;
    protected $table = null;
    public $data = [];
    public $last_insert_id;
    // Open connection
    // Manipulate DB (CRUD Ops)
    // Use DB data
    // Close connection

    // CRUD: Create, Read All, Read Single, Update, Delete.
    final function __construct()
    {
        // Create connection
        $this->connection = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        self::test(!$this->connection->connect_error, "Connection failed: " . $this->connection->connect_error);

        // Get the class name. => Option
        $table = get_class($this); // Core\Models\Option
        $table_arr = explode('\\', $table);
        $table = $table_arr[array_key_last($table_arr)]; // Option
        // Lower case the class name. => option
        // Add "s" to the class name. => options
        $this->table = strtolower($table) . "s";
    }

    final function __destruct()
    {
        $this->connection->close();
    }


    protected function execute_by_id($sql, $id)
    {
        $query = $this->connection->prepare($sql);
        $query->bind_param('i', $id);
        $query->execute();
        return $query->get_result();
    }

    // Read all.
    function get_all()
    {
        $query = $this->connection->prepare("SELECT * FROM $this->table");
        $query->execute();
        $collection = new Collection($query->get_result());

        return $collection->data;
    }

    // Read Single
    function get_by_id($id)
    {
        // Unsecure way of dealing with SQL statements:
        // $query = "SELECT * FROM $this->table WHERE id=$id;";
        // $result = $this->connection->query($query);
        $query_result = $this->execute_by_id("SELECT * FROM $this->table WHERE id=?", $id);

        $collection = new Collection($query_result);

        return !empty($collection->data) ? $collection->data[0] : null;
    }
    function get_by_barcode($barcode)
    {
        // Unsecure way of dealing with SQL statements:
        // $query = "SELECT * FROM $this->table WHERE id=$id;";
        // $result = $this->connection->query($query);
        $query_result = $this->execute_by_id("SELECT * FROM $this->table WHERE barcode=?", $barcode);
        $collection = new Collection($query_result);
        return !empty($collection->data) ? $collection->data[0] : null;
    }
    function join($id)
    {


        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);


        $query = "SELECT invoices.*, items_invoices.*
        FROM invoices
        JOIN items_invoices ON invoices.id = items_invoices.invoice_id
        where invoices.id = " . $id . ";";

        $collection = [];
        $result = mysqli_query($mysqli, $query);

        while ($row = mysqli_fetch_object($result)) {
            $collection[] = (array)$row;
        }

        return $collection;
    }

    // Delete
    function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=?";
        return $this->execute_by_id($sql, $id);
    }
    function deleteWithBarcode($barcode)
    {
        $sql = "DELETE FROM $this->table WHERE barcode=?";
        return $this->execute_by_id($sql, $barcode);
    }

    // Create 
    function insert($value_arr)
    {
        $columns = '';
        $values = '';
        $bind_values_arr = [];
        $bind_types = '';
        foreach ($value_arr as $column => $column_value) {
            $columns .= $column . ", ";
            $values .= "?, ";

            $bind_values_arr[] = $column_value;
            switch ($column) {
                case "id":
                case "barcode":
                case "quantity":
                case "user_id":
                case "items_barcode":
                    $bind_types .= 'i';
                    break;
                default:
                    $bind_types .= 's';
            }
        }
        $columns = rtrim($columns, ", ");
        $values = rtrim($values, ", ");
        if ($this->table == 'items_entrys') {
            $this->table = substr($this->table, 0, -1);
        }
        if ($this->table != 'items') {
            $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
        } else {
            $sql = "INSERT INTO $this->table ($columns) VALUES ($values)  ON DUPLICATE KEY UPDATE quantity = quantity + " . $value_arr['quantity'];
        }
        $query = $this->connection->prepare($sql);
        $query->bind_param($bind_types, ...$bind_values_arr);
        $query->execute();
        $this->last_insert_id = (int) $this->connection->insert_id;
        return $this->last_insert_id;
    }

    // Update
    function update($id, $col_val_arr)
    {
        $col_val = '';
        $bind_values_arr = [];
        $bind_types = '';
        foreach ($col_val_arr as $column => $column_value) {
            $col_val .= "$column=?, ";
            $bind_values_arr[] = $column_value;
            switch ($column) {
                case "id":
                case "barcode":
                case "user_id":
                case "quantity":
                    $bind_types .= 'i';
                    break;
                default:
                    $bind_types .= 's';
            }
        }
        $col_val = rtrim($col_val, ", ");

        $sql = "UPDATE $this->table SET $col_val WHERE id=?";
        $query = $this->connection->prepare($sql);
        $bind_values_arr[] = $id;
        $bind_types .= 'i';

        $query->bind_param($bind_types, ...$bind_values_arr);
        return $query->execute();
    }
    function updateWithBarcode($barcode, $col_val_arr)
    {
        $col_val = '';
        $bind_values_arr = [];
        $bind_types = '';
        foreach ($col_val_arr as $column => $column_value) {
            $col_val .= "$column=?, ";
            $bind_values_arr[] = $column_value;
            switch ($column) {
                case "id":
                case "barcode":
                case "quantity":
                    $bind_types .= 'i';
                    break;
                default:
                    $bind_types .= 's';
            }
        }
        $col_val = rtrim($col_val, ", ");

        $sql = "UPDATE $this->table SET $col_val WHERE barcode=?";
        $query = $this->connection->prepare($sql);
        $bind_values_arr[] = $barcode;
        $bind_types .= 'i';
        $query->bind_param($bind_types, ...$bind_values_arr);
        return $query->execute();
    }

    function custom_query($query)
    {
        return $this->connection->query($query);
    }

    function where($column, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $column=?";
        $query = $this->connection->prepare($sql);
        // integer columns: id, post_author, post_id, tag_id
        switch ($column) {
            case "id":
                $query->bind_param('i', $value);
                break;
            default:
                $query->bind_param('s', $value);
        }
        $query->execute();
        $collection = new Collection($query->get_result());
        $this->data = $collection->data;
        return $this;
    }

    function all()
    {
        return $this->data;
    }

    function first()
    {
        return !empty($this->data) ? $this->data[0] : null;
    }

    function count()
    {
        return count($this->data);
    }
}
