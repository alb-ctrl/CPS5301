<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<title>Menu</title>
<link rel="stylesheet" href="../rsrc/styles/index_styles.css">
<link rel="stylesheet" href="../rsrc/styles/menu_styles.css">
<link rel="stylesheet" href="../rsrc/styles/create_own_styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
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
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="About_Us.php">About</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="Contact_Us.php">Contact</a></li>
            <li>
                <?php
if(empty($_SESSION['username'])){
?>

                <a href="login.php">Sign in <i class="fas fa-user-astronaut fa-5x"
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
                <i class="fas fa-user-astronaut fa-5x" style="margin-left:2px;font-size:18px;"></i></a>
            <ul class="drop">
                <li><a href="logout.php">Sign out</a></li>
                <li><a href="userprofile.php">My profile</a></li>
            </ul>
            </li>
            <?php            
}
?>
            <li>
                <a href="view_cart.php">Cart <i id="cart_icon" data-totalitems="0" class="fas fa-shopping-cart" style="font-size: 18px"></i></a>
            </li>
        </ul>
    </nav>




    <!-- server side images -->

    <?php
    session_start();
    require("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
        die('Coul not connect MySQL: ' . mysqli_connect_error());
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $query = "Select menu_item_id, menu_item_name, tags,  price from menu where hiden ='HI' and tags = 'crust' ";
    $results = mysqli_query($db, $query);
    ?>
    <div id = "custom">
        <h4>Customize your pizza</h4><br>
        <?php
        echo "<form action='handle_own.php' method='POST'>";
        echo "<h5>Choose crust</h5>";
        if ($results) {
            //print error message 
            while ($row = mysqli_fetch_array($results)) {

            echo '<div class="form-check">
            <input class="form-check-input" type="radio" value="'.$row["menu_item_id"].'" name="crust" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
            '. $row["menu_item_name"];
            echo '
            </label>
        </div>';
            }

        }

        $query = "Select menu_item_id, menu_item_name, tags,  price from menu where hiden ='HI' and tags = 'size' ";
        $results = mysqli_query($db, $query);

        echo "<h5>Choose Pizza sice</h5>";
        if ($results) {
            //print error message 
            while ($row = mysqli_fetch_array($results)) {

            echo '<div class="form-check">
            <input class="form-check-input" type="radio" value="'.$row["menu_item_id"].'" name="size" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
            '. $row["menu_item_name"];
            echo '
            </label>
        </div>';
            }

        }

        $query = "Select menu_item_id, menu_item_name, tags,  price from menu where hiden ='HI' and tags = 'sauce' ";
        $results = mysqli_query($db, $query);

        echo "<h5>Choose Sauce</h5>";
        if ($results) {
            //print error message 
            while ($row = mysqli_fetch_array($results)) {

            echo '<div class="form-check">
            <input class="form-check-input" type="radio" value="'.$row["menu_item_id"].'" name="sauce" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
            '. $row["menu_item_name"];
            echo '
            </label>
        </div>';
            }

        }

        $query = "Select menu_item_id, menu_item_name, tags,  price from menu where hiden ='HI' and tags = 'meat' ";
        $results = mysqli_query($db, $query);

        echo "<h5>Choose Meat</h5>";
        if ($results) {
            //print error message 
            while ($row = mysqli_fetch_array($results)) {

                echo '<div class="form-check">
                <input class="form-check-input" type="checkbox" name="meat[]" value="'.$row["menu_item_id"].'" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                '. $row["menu_item_name"];
                echo '
                </label>
            </div>';
            }

        }

        echo "<button type='submit' value='Done'>Done</button>";

        echo "</form>";

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
    <div><div id="l"><hr></div></div>
    <div class="footer">
        <ul id = "left">
            <span><li>Hours of Operation</li></span>
            <li>Monday - Sunday 10:00am - 10:00pm</li>
        </ul>
        <ul id = "right">
            <span><li>For Reservation</li></span>
            <li>Our Location</li>
            <li><a href="#">Front St, Elizabeth, NJ 07206</a></li>
            <li>Tel: (908)555-3474</li>
        </ul>
    </div>
</body>

</html>