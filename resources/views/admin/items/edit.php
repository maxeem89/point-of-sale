<div class="container">
    <h1 class="text-center">Edit Item</h1>
    <hr>

    <form class="w-75" method="POST" action="/admin/items/update">
        <input type="hidden" name="barcode" value="<?= $data->item->barcode ?>">
        <div class="mb-3">
            <label for="itemsBarcode" class="form-label">Barcode:</label>
            <input type="text" name="itemBarcode" class="form-control" id="itemBarcode" value="<?= $data->item->barcode ?>">
        </div>
        <div class="mb-3">
            <label for="itemsName" class="form-label">name:</label>
            <input type="text" name="itemName" class="form-control" id="itemName" value="<?= $data->item->name ?>">
        </div>
        <div class="mb-3">
            <label for="itemsEmail" class="form-label">Quantity:</label>
            <input type="text" name="quantity" class="form-control" id="itemsQuantity" value="<?= $data->item->quantity ?>">
        </div>
        <div class="mb-3">
            <label for="itemsPrice" class="form-label">Selling Price:</label>
            <input type="text" name="price" class="form-control" id="itemsprice" value="<?= $data->item->selling_price_per_unit ?>">
        </div>
        <div class="mb-3">
            <label for="itemsDiscriptin" class="form-label">Discriptin:</label>
            <input type="text" name="itemsDiscriptin" class="form-control" id="itemsDiscriptin" value="<?= $data->item->discription ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="/admin/items" class="btn btn-danger my-3">Cancel</a>

</div>