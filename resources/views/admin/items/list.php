<?php

 ?>

<div class="container">
    <h1 class="text-center">Items List</h1>
    <hr>

    <div class="d-flex w-100 justify-content-end">
        <a href="/admin/items/add" class="btn btn-success">Add Item</a>
    </div>

    <table class="table table-hover my-5">
        <thead>
            <tr>
                <th scope="col">barcode</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Discription</th>
                <th scope="col">Price</th>
                <th scope="col">created Date</th>
                <th scope="col">updated Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
           <?php 
           foreach ( $data->items as $item ) : ?>
                <tr>
                    <td><?= $item->barcode; ?></td>
                    <td><?= $item->name; ?></td>
                    <td><?= $item->quantity; ?></td>
                    <td><?= $item->discription; ?></td>
                    <td><?= $item->selling_price_per_unit; ?></td>
                    <td><?= $item->created_at; ?></td>
                    <td><?= $item->updated_at; ?></td>
                    <td class="d-flex">
                        <a href="/admin/items/single?barcode=<?= $item->barcode ?>" class="mx-1 btn btn-primary btn-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="/admin/items/edit?barcode=<?= $item->barcode ?>" class="btn btn-warning btn-sm mx-1">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="/admin/items/delete" method="post" class="mx-1">
                            <input type="hidden" name="item_barcode" value="<?= $item->barcode ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
</div>