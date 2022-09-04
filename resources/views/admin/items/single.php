<div class="container text-left">
    <h1 class="text-center"><?= $data->item->name ?></h1>
    <hr>
    <div class="my-5 d-flex justify-content-end">
        <a href="/admin/users" class="mx-1 btn btn-primary btn-sm">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        <a href="/admin/items/edit?barcode=<?= $data->item->barcode ?>" class="btn btn-warning btn-sm mx-1">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <form action="/admin/users/delete" method="post" class="mx-1">
            <input type="hidden" name="barcode" value="<?= $data->item->barcode ?>">
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    </div>
    <div class="my-3">
        <strong class="d-block">Barcode</strong>
        <?= $data->item->barcode ?>
    </div>
    <div class="my-3">
        <strong class="d-block">Name</strong>
        <?= $data->item->name ?>
    </div>
    <div class="my-3">
        <strong class="d-block">Quantity</strong>
        <?= $data->item->quantity ?>
    </div>
    <div class="my-3">
        <strong class="d-block">Selling Price</strong>
        <?= $data->item->selling_price_per_unit ?>
    </div>
    <div class="my-3">
        <strong class="d-block">Registered At</strong>
        <?= $data->item->created_at ?>
    </div>

</div>