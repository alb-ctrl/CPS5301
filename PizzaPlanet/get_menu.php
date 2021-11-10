<!DOCTYPE html>
<html lang="en">
<title>Menu</title>
<link rel="stylesheet" href="../rsrc/styles/index_styles.css">
<link rel="stylesheet" href="../rsrc/styles/menu_styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<nav>
        <input id="check" type="checkbox">
        <label for="check" class="checkbtn">

            <i class="fas fa-bars" color="red"></i>

        </label>
            <label href="#">
                <a href="index.php"><img src="../rsrc/imgs/pizza.png" alt="logo" class="logo"></a>
            </label>
        <ul class = "links">
            <li><a href="index.php">Home</a></li>
            <li><a href="About_Us.php">About</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="Contact_Us.php">Contact</a></li>
            <li>
<?php
if(empty($_SESSION['username'])){
?>

                <a href="login.php">Sign in b<i class="fas fa-user-astronaut fa-5x" 
            style="margin-left:2px;font-size:18px;"></i></a>
            </li>

<?php
}

else{
?>
                
                <a href="#?you are logged in">
                    <?php
                    echo$_SESSION['username'];
                    ?>
                    <i class="fas fa-user-astronaut fa-5x" 
            style="margin-left:2px;font-size:18px;"></i></a>
            <ul class="drop">
                    <li><a href="logout.php">Sign out</a></li>
                    <li><a href="#">My profile</a></li>
                </ul>
        </li>
<?php            
}
?>
            <li>
            <a href="view_cart.php">Cart <i id="cart_icon" data-totalitems="0" class="fas fa-shopping-cart" style="font-size: 18px" ></i></a>
            </li>
        </ul>
    </nav>
    <div class="cont">
        <div class="item">
            <img class="card-img-top" src="../rsrc/imgs/menu/pizza_Cheese.png.jpeg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Cheese Pizza</h5>
            <button><a href="#" id="1" class="btn btn-primary"
                onclick="return updateCart(1,1);">Add to cart</a></button>
        </div>
        </div>
        <div class="item">
            <img class="card-img-top" src="../rsrc/imgs/menu/pizza_Supreme.png.jpeg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Veggie pizza</h5>
                <button><a href="#" id="2" class="btn btn-primary"
                    onclick="return updateCart(2,1);">Add to cart</a></button>
            </div>
        </div>
    </div>
        

<!-- server side images -->

    <?php
    session_start();
    require("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
        die('Coul not connect MySQL: ' . mysqli_connect_error());
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $query = "Select menu_item_id, menu_item_name, description, tags, picture_path, price from menu";
    $results = mysqli_query($db, $query);

    if (!$results) {
        //print error message 
        echo "didnt work";

    }

    ?>
    <div class="cont">
    <?php
    while ($row = mysqli_fetch_array($results)) {
    ?>
    <!-- <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text"><?php echo $row['description']; ?></p>
            <a href="#" id="<?php echo $row['menu_item_id']; ?>" class="btn btn-primary"
                onclick="return updateCart(<?php echo $row['menu_item_id']; ?>,1);">Add to cart</a>
        </div>
    </div> -->
    <div class="cont">
        <div class="item">
        <img class="card-img-top" src="<?php echo $row['picture_path']; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text"><?php echo $row['description']; ?></p>
            <button><a href="#" id="<?php echo $row['menu_item_id']; ?>" class="btn btn-primary"
                onclick="return updateCart(<?php echo $row['menu_item_id']; ?>,1);">Add to cart</a></button>
        </div>
        </div>
    </div>
    
    <?php
    }
    ?>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="../rsrc/js/main.js"></script>
</body>

</html>
