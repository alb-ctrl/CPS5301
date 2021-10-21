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

function removeCart(menu_id,cart_index, cart_id) {
    console.log($(this).closest('div .Cart-Items').attr('id'));
    console.log(cart_index);
    $.ajax({
        url: "cart.php",
        method: "POST",
        data:{remove_item:menu_id, cart_index:cart_index},
        beforeSend: function () {
            var message = new Notification("RandomString");
            
            message.onclick = function(){alert("Succesfully added to cart")}; 
        },
        success:
            function (data) {
                console.log(data);
                //location.reload();
                $("#"+cart_id).remove();
                sub_total();
            },
        error: function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    });
    return false;
}  

function increase_quantity(menu_id,cart_index, cart_id){

    $.ajax({
        url: "cart.php",
        method: "POST",
        data:{increase_quantity:menu_id, cart_index:cart_index},
        success:
            function (data) {
                console.log(data);
                //$("#"+cart_id+" .count" ).html();
                $("#"+cart_id+" .count" ).text(function(i, t) {
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

function decrease_quantity(menu_id,cart_index, cart_id){

    $.ajax({
        url: "cart.php",
        method: "POST",
        data:{decrease_quantity:menu_id, cart_index:cart_index},
        success:
            function (data) {
                console.log(data);
                //$("#"+cart_id+" .count" ).html();
                $("#"+cart_id+" .count" ).text(function(i, t) {
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

function sub_total(){
    var all = $(".amount").map(function() {
        return this.innerHTML.replace('$', '');;
    }).get();
    var sum = 0;
    $.each(all, function() {
        sum += parseFloat(this) || 0;
    });
    $("#number_items_cart").html(all.length + " items");
    $("#total_amount_cart").html("$" + sum);
    console.log(all);
    console.log(sum);
}