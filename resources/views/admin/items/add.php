 <?php

 ?>
 <div>
    <?php if(isset($_SESSION['no']))
    {
        echo $_SESSION['no'];
    }
    ?>
 </div>
<div class="container">
    <h1 class="text-center">Add Item</h1>
    <hr>
    
    <form class="w-75" method="POST" action="/admin/items/store">
        <input type="hidden" name = "user_id" value="<?= $_SESSION['user']->user_id; ?>">
        <div class="mb-3">
            <label for="itemBarcode" class="form-label">Barcode:</label>
            <input type="text" name="barcode" class="form-control" id="itemBarcode">
        </div>
        <div class="mb-3">
            <label for="itemName" class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" id="itemName">
        </div>
        <div class="mb-3">
            <label for="itemQuantity" class="form-label">Quantity:</label>
            <input type="text" name="quantity" class="form-control" id="itemQuantity">
        </div>
        <div class="mb-3">
            <label for="itemsDiscription" class="form-label">Discription:</label>
            <input type="text" name="discription" class="form-control" id="itemsDiscription">
        </div>
        <div class="mb-3">
            <label for="itemBuyingPerUnit" class="form-label">Buying Price:</label>
            <input type="text" name="buyingPrice" class="form-control" id="itemBuyingPerUnit">
        </div>
        <div class="mb-3">
            <label for="itemSellingPerUnit" class="form-label">Selling Price:</label>
            <input type="text" name="sellingPrice" class="form-control" id="itemSellingPerUnit">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="/admin/users" class="btn btn-danger my-3">Cancel</a>

</div>
<script>
    document.addEventListener('keydown', function(event) {
        if (event.keyCode == 17 || event.keyCode == 74 ||event.keyCode == 13    )
            event.preventDefault();
    });
</script>