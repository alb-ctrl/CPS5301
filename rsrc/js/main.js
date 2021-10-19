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

