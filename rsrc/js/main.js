function updateCart(menu_id, quantity) {
    $.ajax({
        url: "cart.php",
        method: "POST",
        data:{menu_id:menu_id, quantity:quantity},
        //beforeSend: function () {$('#insert').val("Inserting"); },
        success:
            function (data) {
                console.log(data);
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;
}  

function removeCart(menu_id,quantity, cart_index) {
    console.log($(this).closest('.Cart-Items').attr('id'));
    console.log(cart_index);
    $.ajax({
        url: "cart.php",
        method: "POST",
        data:{remove_item:menu_id, cart_index:cart_index},
        //beforeSend: function () {$('#insert').val("Inserting"); },
        success:
            function (data) {
                console.log(data);
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;
}  