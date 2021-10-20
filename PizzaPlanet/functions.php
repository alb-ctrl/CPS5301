<?php
session_start(); 


function get_cart($item_id, $quanitiy, $cart_index){

    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $query = "SELECT menu_id, name, description, tags, picture_path, cost from menu where menu_id = $item_id ";

    $results = mysqli_query($db, $query);

    if (!$results) {
        //print error message 
        echo "didnt work";

    }

    while ($row = mysqli_fetch_array($results)) {
?>

<div id="<?php echo "$cart_index$item_id";?>" class="Cart-Items pad">
            <div class="image-box">
                <img src="<?php echo $row['picture_path']; ?>" style= 'height:120px'/>
            </div>
            <div class="about">
                <h1 class="title"><?php echo $row['name']; ?></h1>
                <h3 class="subtitle"><?php echo $row['tags']; ?></h3>
            <!--  <img src="images/veg.png" style='height:"30px" ' /> -->
            </div>
            <div class="counter">
                <div class="btn">+</div>
                <div class="count"><?php echo $quanitiy; ?></div>
                <div class="btn">-</div>
            </div>
            <div class="prices">
                <div class="amount">$<?php echo $row['cost']*$quanitiy; ?></div>
                <!-- <div class="save"><u>Save for later</u></div> -->
                <div class="remove"><u onclick='return removeCart(<?php echo "$item_id, $quanitiy, $cart_index$item_id"; ?>);' >Remove</u></div>
            </div>
        </div>

        
<?php


    }


}
?>