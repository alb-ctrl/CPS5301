<?php
session_start(); 


function get_cart($item_id, $quanitiy, $cart_index){

    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $query = "SELECT menu_item_id, menu_item_name, description, tags, picture_path, price from menu where menu_item_id = $item_id  ";

    $results = mysqli_query($db, $query);

    if (!$results) {
        //print error message 
        echo "didnt work";

    }

    while ($row = mysqli_fetch_array($results)) {
?>

<div id="<?php echo "$cart_index$item_id";?>" class="Cart-Items pad">
    <div class="image-box">
        <img src="../rsrc/imgs/menu/<?php echo $row['picture_path']; ?>" style='height:120px' />
    </div>
    <div class="about">
        <h1 class="title"><?php echo $row['menu_item_name']; ?></h1>
        <h3 class="subtitle"><?php echo $row['tags']; ?></h3>
        <!--  <img src="images/veg.png" style='height:"30px" ' /> -->
    </div>
    <div class="counter">
        <div class="btn"
            onclick='return increase_quantity(<?php echo "$item_id, $cart_index, $cart_index$item_id"; ?>);'>+</div>
        <div class="count"><?php echo $quanitiy; ?></div>
        <div class="btn"
            onclick='return decrease_quantity(<?php echo "$item_id, $cart_index, $cart_index$item_id"; ?>);'>-</div>
    </div>
    <div class="prices">
        <div class="amount">$<?php echo $row['price']*$quanitiy; ?></div>
        <!-- <div class="save"><u>Save for later</u></div> -->
        <div class="remove"><u
                onclick='return removeCart(<?php echo "$item_id, $cart_index, $cart_index$item_id"; ?>);'>Remove</u>
        </div>
    </div>
</div>


<?php


    }
    

/* Close the connection as soon as it's no longer needed */
mysqli_close($db);
}

function get_checkout_cart($item_id, $quanitiy){

    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $query = "SELECT menu_item_id, menu_item_name, description, tags, picture_path, price from menu where menu_item_id = $item_id ";

    $results = mysqli_query($db, $query);

    if (!$results) {
        //print error message 
        echo "didnt work";

    }

    while ($row = mysqli_fetch_array($results)) {
        ?>

<li class="list-group-item d-flex justify-content-between lh-condensed">
    <div>
        <h6 class="my-0"><?php echo $row['menu_item_name']; ?></h6>
        <small class="text-muted"><?php if (count($row['description']) > 6) echo $row['description']; ?></small>
    </div>
    <span class="text-muted amount">$<?php echo $row['price']*$quanitiy; ?></span>
</li>
<?php
        
            }
        
            
        
            
        /* Close the connection as soon as it's no longer needed */
        mysqli_close($db);

}

function get_reciept($order_id){

    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $query = "select m.menu_item_name,  m.price, o.quantity, o.status from pizzaplace.menu m, pizzaplace.user_orders o where m.menu_item_id=o.menu_item_id and o.user_order_id=$order_id  and o.status != 'X'";

    $results = mysqli_query($db, $query);

    if (!$results) {
        //print error message 
        echo "didnt work";

    }
    $order_status="";
    $total=0;

    echo '<div class="pricing">';

    while ($row = mysqli_fetch_array($results)) {
        $order_status = $row['status'];
        $total += $row['price'] * $row['quantity'];
        ?>

<div class="row">
    <div class="col-9"> <span id="name"><?php echo $row['menu_item_name']; ?></span> </div>
    <div class="col-3"> <span id="price">$<?php echo $row['price']; ?></span> </div>
</div>

<?php
        
    }
    echo "</div>";
    echo '<div class="total">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-3"><big>$'.$total.'</big></div>
    </div>
    </div>';

    echo '<div class="progress-track">
    <ul id="progressbar">';

    if ($order_status=='O'){
        echo '<li class="step0 active " id="step1">Ordered</li>
        <li class="step0  text-center" id="step2">In Progress</li>
        <li class="step0  text-right" id="step3">Out for delivery</li>
        <li class="step0 text-right" id="step4">Delivered</li>';
    }
    if ($order_status=='P'){
        echo '<li class="step0 active " id="step1">Ordered</li>
        <li class="step0 active text-center" id="step2">In Progress</li>
        <li class="step0  text-right" id="step3">Out for delivery</li>
        <li class="step0 text-right" id="step4">Delivered</li>';
    }
    if ($order_status=='D'){
        echo '<li class="step0 active " id="step1">Ordered</li>
        <li class="step0 active text-center" id="step2">In Progress</li>
        <li class="step0 active text-right" id="step3">Out for delivery</li>
        <li class="step0 text-right" id="step4">Delivered</li>';
    }
    if ($order_status=='C'){
        echo '<li class="step0 active " id="step1">Ordered</li>
        <li class="step0 active text-center" id="step2">In Progress</li>
        <li class="step0 active text-right" id="step3">Out for delivery</li>
        <li class="step0 active text-right" id="step4">Delivered</li>';
    }
    


    echo '</ul></div>';

    /* Close the connection as soon as it's no longer needed */
    mysqli_close($db);

}

function myMail($to,$subject,$message){

    require '/home/bitnami/PHPmailerconfig.php';
        $mail->IsHTML(true);
        $mail->AddAddress($to, "Dear Customer");
        $mail->SetFrom("bitnamiaws@gmail.com", "Pizza Planet");
        $mail->Subject = "$subject";
        $content = $message;
        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
        }
        else {
            //echo "Email sent successfully";
        }

}
?>