$(document).ready(function () {
    
    // Fetch SKUs on page load
    $.ajax({
        url: 'handler.php',
        type: 'POST',
        dataType: 'json',
        data: {"TAG":"getProduct"},
        before: function()
        {
            let skuDropdown = $('#selSku');
            skuDropdown.append('<option value="">LOADING...</option>');
        },
        success: function(response) {

            // Populate SKU dropdown
            let skuDropdown = $('#selSku');
            skuDropdown.html("");
            skuDropdown.append('<option value="">-[ SELECT ]-</option>');
            
            response.forEach(function(product) {
                skuDropdown.append(`<option value="${product.product_id}" data-price="${product.product_price}">[#${product.product_sku}] ${product.product_name}</option>`);
            });
        },
        error: function(error) {
            console.log('Error fetching SKUs:', error);
        }
    });

    updateOrderList();

    // Update Price per cm when SKU is selected
    $('#selSku').change(function() {
        let pricePerCm = $(this).find(':selected').data('price') || 0;
        $('#txtPrice').val(pricePerCm);
    });

    // Calculate
    $('#btnCalc').click(function () {
        let width = $('#txtWidth').val();
        let height = $('#txtHeight').val();
        let price = $('#selSku').find(':selected').data('price');

        if (width && height && price) {
            let perimeter = 2 * (parseFloat(width) + parseFloat(height));
            let totalPrice = perimeter * price;

            $('#totPeri').text(perimeter.toFixed(2));
            $('#framePrice').text(totalPrice.toFixed(2));
        } else {
            alert("Please enter valid dimensions and select a product.");
        }
    });

    // Add to Order
    $('#btnAddToOrder').on('click', function() {
        let pid = $('#selSku').val();
        let width = $('#txtWidth').val();
        let height = $('#txtHeight').val();

        if (pid && width && height) {
            $.ajax({
                url: 'handler.php',
                type: 'POST',
                data: {
                    TAG: 'addOrder',
                    pid: pid,
                    width: width,
                    height: height
                },
                success: function(response) {
                                        
                    if(response)
                    {   updateOrderList();  }
                    else
                    {   alert("Order not Added!");  }

                }
            });
        } else {
            alert('Please fill all the required fields.');
        }
    });

    // Remove Item from Order
    $(document).on('click', '.btnDelete', function() {
        let orderId = $(this).data('id');
        $.ajax({
            url: 'handler.php',
            type: 'POST',
            data: {
                TAG: 'deleteOrder',
                order_id: orderId
            },
            success: function(response) {
                                    
                if(response)
                {   updateOrderList();  }
                else
                {   alert("Order not Deleted!");  }

            }
        });
    });

    // Update Quantity
    $(document).on('change', '.updateQty', function() {
        let orderId = $(this).data('id');
        let newQty = $(this).val();
        if(newQty > 0)
        {
            $.ajax({
                url: 'handler.php',
                type: 'POST',
                data: {
                    TAG: 'updateQty',
                    order_id: orderId,
                    quantity: newQty
                },
                success: function(response) {                   
                    if(response)
                    {   updateOrderList();  }
                    else
                    {   alert("Order not Updated!");  }

                }
            });
        }
        else
        {
            defQty = $(this)[0].defaultValue;
            alert("Quantity can not be Zero!");
            $(this).val(defQty);
        }
    });

    // Function update Order List
    function updateOrderList()
    {
        $.ajax({
            url: 'handler.php',
            type: 'POST',
            data: {TAG: 'getOrderList'},
            success: function(response) {
                
                res = JSON.parse(response);
                sr = 0;
                totOrder = 0;

                // Update Order List with the response (updated order list)
                $('#orderList tbody').html("");
                res.forEach(function(order) {

                    orderHtml = "";
                    lineTotal = (2 * (order['width'] + order['height'])) * (order['product_price'] * order['quantity']);
                    totOrder += lineTotal;

                    orderHtml+= `<tr>
                            <td>`+ (++sr) +`</td>
                            <td>[#`+order['product_sku']+`] `+ order['product_name']+`</td>
                            <td>
                                <input type='number' value='`+order['quantity']+`' min='1' class='form-control updateQty' data-id='`+order['order_id']+`' />
                            </td>
                            <td>`+order['width']+`</td>
                            <td>`+order['height']+`</td>
                            <td class='lineTotal'>`+lineTotal+`</td>
                            <td class='text-center'><button class='btn btn-danger btn-sm fw-semibold btnDelete' data-id='`+order['order_id']+`'>X</button></td>
                        </tr>`;

                    $('#orderList tbody').append(orderHtml);

                });

                $("#txtOrderTotal").text(totOrder);
            }
        });
    }

});