<div class="container">
    <div id="notifyDiv" class="d-flex justify-content-center display"></div>
    <form action="" method="POST">
        <input type="hidden" id="formId" name="form_id" value="<?= isset($data->id) ? $data->id : '' ?>">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Invoice </h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    Barcode
                    <input type="text" id="barcode" name="name" class="form-control">
                </div>
                <div class="d-flex justify-content-end">
                    <label for="total"> Total:</label>
                    <input type="text" id="total" name="total" value="0">
                </div>
            </div>
        </div>
        <br>
        <table class="table table-bordered table-hover">
            <thead>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Amount</th>
            </thead>
            <tbody class="detail">
                <form>
                    <button type="submit" class="btn btn-success">save </button>
                </form>
            </tbody>
            <tfoot>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>

        </table>
    </form>
</div>
<script>
    document.addEventListener('keydown', function(event) {
        if (event.keyCode == 17 || event.keyCode == 74)
            event.preventDefault();
    });
</script>
<script type="text/javascript">
    var checkArray = [];
    $(document).ready(function() {
        if ($('#formId').val() != null) {
            var formId = $('#formId').val();
            edit(formId);
        }

        async function edit(input) {
            <?php
            if (isset($data->item))
                foreach ($data->item as $item) {
            ?>
                var arr = {};
                var barcode1 = "" + <?= $item['item_id']; ?>;
                checkArray[barcode1] = [];
                console.log(barcode1);
                arr['barcode'] = barcode1;
                try {
                    const res = await getData(arr, barcode1, <?= $item['quantity'] ?>)
                    console.log(res)
                } catch (err) {
                    console.log(err);
                }
            <?php
                }
            ?>

        }

        function getData(arr, barcode1, qui1) {
            return $.ajax({
                method: 'POST',
                url: '/admin/items/search',
                data: arr,
                success: function(response) {
                    let data = JSON.parse(response);
                    checkArray[barcode1]["quantity"] = data.result.data[0].quantity + qui1;
                    checkArray[barcode1]["price"] = data.result.data[0].selling_price_per_unit;
                    checkArray[barcode1]["qu"] = qui1;
                    console.log(barcode1);
                    var productname = data.result.data[0].name;
                    var quantity = data.result.data[0].quantity;
                    var price = parseFloat(data.result.data[0].selling_price_per_unit);
                    var row = `<tr><td> ${productname} </td></tr>`;
                    var row = `<tr>
                         <td><input type="text" class="form-control productname" value = "${barcode1}" name="serialNumber[]"></td>
                         <td><input type="text" class="form-control productname" value = "${productname}" name="productname[]"></td>
                         <td><input type="text" class="form-control price"  value = "${price}" name="price[]"></td>
                         <td><input id="q_${barcode1}" onchange ="changeQuantity('${barcode1}', this)" type="number" step="1"
                          min="1" max="${quantity+ qui1}" class="form-control amount" 
                          value = "${qui1}" name="amount[]"></td>
                         <td><a href="#" id ="d_${barcode1}" onclick = "delItem(this, '${barcode1}')" 
                          value = "${barcode1}" class="remove">Delete</td>
                         </tr>`;
                    $('tbody').append(row);
                    let currentTotal = parseFloat($('#total').val());
                    currentTotal = currentTotal + (price * qui1);
                    $('#total').val(currentTotal);
                    $('#barcode').val('');
                    console.log(checkArray);

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        }

        $('#barcode').keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (checkArray.hasOwnProperty($('#barcode').val(), checkArray)) {
                    var totalQuantity = parseInt(checkArray[$('#barcode').val()]['quantity']);
                    checkArray[$('#barcode').val()]['qu'] += 1;
                    var quantity = parseInt($("#q_" + $('#barcode').val()).val());
                    if (totalQuantity > quantity) {
                        $("#q_" + $('#barcode').val()).val(parseInt($("#q_" + $('#barcode').val()).val()) + 1);
                        let currentTotal = parseFloat($('#total').val());
                        currentTotal = currentTotal + parseFloat(checkArray[$('#barcode').val()]['price']);
                        $('#total').val(currentTotal);
                        $('#barcode').val('');
                    } else {
                        console.log('out of stock');
                    }
                } else {
                    var arr = {};
                    arr['barcode'] = $('#barcode').val();

                    $.ajax({
                        method: 'POST',
                        url: '/admin/items/search',
                        data: arr,
                        total,
                        success: function(response) {
                            let data = JSON.parse(response);
                            if (data.status =='404') {
                                error();
                            } else {
                            
                                if (data.result.data[0].quantity > 0) {
                                    checkArray[$('#barcode').val()] = [];
                                    checkArray[$('#barcode').val()]["quantity"] = data.result.data[0].quantity;
                                    checkArray[$('#barcode').val()]["price"] = data.result.data[0].selling_price_per_unit;
                                    checkArray[$('#barcode').val()]["qu"] = 1;
                                    var barcode = data.result.data[0].barcode;
                                    var productname = data.result.data[0].name;
                                    var quantity = data.result.data[0].quantity;
                                    var price = parseFloat(data.result.data[0].selling_price_per_unit);
                                    var row = `<tr><td> ${productname} </td></tr>`;
                                    var row = `<tr>
                        <td><input type="text" class="form-control productname" value = "${barcode}" name="serialNumber[]"></td>
                        <td><input type="text" class="form-control productname" value = "${productname}" name="productname[]"></td>
                        <td><input type="text" class="form-control price"  value = "${price}" name="price[]"></td>
                        <td><input id="q_${barcode}" onchange ="changeQuantity('${barcode}', this)" type="number" step="1" min="1" max="${quantity}"  class="form-control amount" value = "1" name="amount[]"></td>
                        <td><a href="#" id ="d_${barcode}" onclick = "delItem(this, '${barcode}')"  value = "${barcode}" class="remove">Delete</td>
                        </tr>`;
                                    $('tbody').append(row);
                                    let currentTotal = parseFloat($('#total').val());
                                    currentTotal = currentTotal + price;
                                    $('#total').val(currentTotal);
                                    $('#barcode').val('');
                                    displaySuccssesMessage();
                                } else {
                                    displayErrorMessage();
                                }
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        }
                    });
                }
            }
        });

        $("form").on("submit", function(event) {
            event.preventDefault();
            total = $('#total').val();
            var url = <?= isset(($data->item)) ? '"/admin/invoices/update" ' : '"/admin/invoices/store"' ?>;
            $.ajax({
                method: 'POST',
                url: url,
                data: $("form").serializeArray(),
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.result == 'updated') {
                        window.location = '/admin/invoices';
                    } else {
                        setInterval('location.reload()', 100);
                    }

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });

        function displaySuccssesMessage() {
            $('#notifyDiv').fadeIn();
            $('#notifyDiv').css('background', 'green');
            $('#notifyDiv').text('Item Added Succsessfuly');
            setTimeout(() => {
                $('#notifyDiv').fadeOut();
            }, 3000);
        }
        

        function displayErrorMessage() {
            $('#notifyDiv').fadeIn();
            $('#notifyDiv').css('background', 'orange');
            $('#notifyDiv').text('The Quantity Items IS Zero');
            setTimeout(() => {
                $('#notifyDiv').fadeOut();
            }, 3000);
        }
        function error() {
            $('#notifyDiv').fadeIn();
            $('#notifyDiv').css('background', 'red');
            $('#notifyDiv').css('color', 'white');
            $('#notifyDiv').text('Item Not Avalible Now');
            setTimeout(() => {
                $('#notifyDiv').fadeOut();
            }, 3000);
        }
        

    });

    function changeQuantity(barcode, input) {
        let updateTotal = checkArray[barcode]['qu'] * checkArray[barcode]['price'];
        $('#total').val(parseFloat($('#total').val()) - updateTotal);
        checkArray[barcode]['qu'] = parseInt($(input).val());
        updateTotal = checkArray[barcode]['qu'] * checkArray[barcode]['price'];
        $('#total').val(parseFloat($('#total').val()) + updateTotal);
    }

    function delItem(input, barcode) {
        let updateTotal = checkArray[barcode]['qu'] * checkArray[barcode]['price'];
        $('#total').val(parseFloat($('#total').val()) - updateTotal);
        delete checkArray[barcode];

        $('body').delegate('.remove', 'click', function() {
            $(input).parent().parent().remove();
        });
    }
</script>