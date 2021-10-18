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
    hi
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
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name']; ?>/h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                    <a href="#" id="<?php echo $row['menu_id']; ?>" class="btn btn-primary">Add to cart</a>
            </div>
        </div>

    <?php
    }

    ?>

</body>

</html>