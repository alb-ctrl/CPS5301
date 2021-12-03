function updateCart(menu_item_id, quantity) {
    $.ajax({
        url: "cart.php",
        method: "POST",
        data: { menu_item_id: menu_item_id, quantity: quantity },
        //beforeSend: function () {$('#insert').val("Inserting"); },
        success:
            function (data) {
                var cart = $('#cart_icon');
                var cartTotal = cart.attr('data-totalitems');
                console.log("car total: "+cartTotal);
                var newCartTotal = parseInt(cartTotal) + 1;
                cart.attr('data-totalitems', newCartTotal);
                console.log(data);
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;
}


function removeCart(menu_item_id, cart_index, cart_id) {
    console.log($(this).closest('div .Cart-Items').attr('id'));
    console.log(cart_index);
    $.ajax({
        url: "cart.php",
        method: "POST",
        data: { remove_item: menu_item_id, cart_index: cart_index },
        beforeSend: function () {
            var message = new Notification("RandomString");

            message.onclick = function () { alert("Succesfully added to cart") };
        },
        success:
            function (data) {
                console.log(data);
                //location.reload();
                $("#" + cart_id).remove();
                sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;
}

function increase_quantity(menu_item_id, cart_index, cart_id) {

    $.ajax({
        url: "cart.php",
        method: "POST",
        data: { increase_quantity: menu_item_id, cart_index: cart_index },
        success:
            function (data) {
                console.log(data);
                //$("#"+cart_id+" .count" ).html();
                $("#" + cart_id + " .count").text(function (i, t) {
                    return Number(t) + 1;
                });

                location.reload();
                //sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;

}

function decrease_quantity(menu_item_id, cart_index, cart_id) {

    $.ajax({
        url: "cart.php",
        method: "POST",
        data: { decrease_quantity: menu_item_id, cart_index: cart_index },
        success:
            function (data) {
                console.log(data);
                //$("#"+cart_id+" .count" ).html();
                $("#" + cart_id + " .count").text(function (i, t) {
                    return Number(t) - 1;
                });

                location.reload();
                //sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;

}

function sub_total() {
    var all = $(".amount").map(function () {
        return this.innerHTML.replace('$', '');;
    }).get();
    var sum = 0;
    $.each(all, function () {
        sum += parseFloat(this) || 0;
    });
    $("#number_items_cart").html(all.length + " items");
    $("#total_amount_cart").html("$" + sum);
    console.log(all);
    console.log(sum);
}

function checkout_total() {
    // amount is a class that only purpose is to get the cost
    // it doesnt posses any css
    var all = $(".amount").map(function () {
        return this.innerHTML.replace('$', '');;
    }).get();
    var sum = 0;
    $.each(all, function () {
        sum += parseFloat(this) || 0;
    });
    $("#number_items_cart").html(all.length + " items");
    $("#total_amount_cart").html("$" + sum);
    $("#hidden_cost").val(sum);
    console.log(all);
    console.log(sum);
}

function cart_checkout(){

    $.ajax({
        url: "cart.php",
        method: "POST",
        data: { pre_checkout: 0 },
        success: function(data, textStatus, xhr) {
                console.log(data);
                //$("#"+cart_id+" .count" ).html();
                if (xhr.status != 222)
                    $("#guest_checkout").addClass(data);
                else
                    window.location = 'checkout.php';
                //sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;

}

function final_checkout (){

    $.ajax({
        url: "checkout_handler.php",
        method: "POST",
        data:$('#checkout').serialize(), 
        success: function(data, textStatus, xhr) {
                console.log(data);
                //$("#"+cart_id+" .count" ).html();
                
                //sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;
}

// hi from redeemCode
function saveOrder(){

    $.ajax({
        url: "cart.php",
        method: "POST",
        data:{saveOrder:"yes"}, 
        success: function(data, textStatus, xhr) {
                console.log(data);
                //$("#"+cart_id+" .count" ).html();
                
                //sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;

}

function redeemCode(){
    $.ajax({
        url: "cart.php",
        method: "POST",
        async: false,
        data:$('#redeem-form').serialize(),
        success: function(data, textStatus, xhr) {
                console.log(data);
                $("#total_amount_cart_li").before(data);
                //$("#"+cart_id+" .count" ).html();
                
                //sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;

}

function studentCode(){
    $.ajax({
        url: "cart.php",
        method: "POST",
        async: false,
        data:{studentCode: "idk"},
        success: function(data, textStatus, xhr) {
                console.log(data);
                $("#total_amount_cart_li").before(data);
                //$("#"+cart_id+" .count" ).html();
                
                //sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;
}
