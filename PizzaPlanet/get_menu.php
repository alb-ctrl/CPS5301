<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>

</head>

<body>
    <?php
    session_start();
    require("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
        die('Coul not connect MySQL: ' . mysqli_connect_error());
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $query = "Select menu_id, name, description, tags, picture_path, cost from menu";
    $results = mysqli_query($db, $query);

    if (!$results) {
        //print error message 
        echo "didnt work";

    }
    while ($row = mysqli_fetch_array($results)) {
    ?>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo $row['picture_path']; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text"><?php echo $row['description']; ?></p>
            <a href="#" id="<?php echo $row['menu_id']; ?>" class="btn btn-primary"
                onclick="return updateCart(<?php echo $row['menu_id']; ?>,1);">Add to cart</a>
        </div>
    </div>

    <?php
    }

    ?>

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