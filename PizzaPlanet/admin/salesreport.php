<!DOCTYPE html>
<html lang="en">
<?php
require("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die('Coul not connect MySQL: ' . mysqli_connect_error());
// Set the encoding...
mysqli_set_charset($db, 'utf8');
include 'navbar.php';
error_reporting(0);
session_start();


function get_time($time){
    if($time == "all"){
        return '';
    }elseif($time == "past_week"){
        return "AND order_date>date_sub(date(now()), interval 1 week)";
    }
    elseif($time == "current_month"){
        return "AND month(order_date)=month(now())";
    }
    elseif($time == "past_month"){
        return "AND order_date>date_sub(date(now()), interval 1 month)";
    }
    elseif($time == "this_year"){
        return "AND year(order_date)=year(now())";
    }
    elseif($time == "past_year"){
        return "AND year(order_date)=2020";
    }else{
    return '';
    }
}

$report_period = (!empty($_POST['report_period'])) ? $_POST['report_period']: "";
$i=1;


if($report_period == "all"){
    $period = 'All';
}elseif($report_period == "past_week"){
    $period = 'Past Week';
}
elseif($report_period == "current_month"){
    $period = 'Current month';
}
elseif($report_period == "past_month"){
    $period = 'Past month';
}
elseif($report_period == "this_year"){
    $period = 'This Year';
}
elseif($report_period == "past_year"){
    $period = 'Past Year';
}else{
    $period = '';
}


?>
<head>
</head>

<body class="fix-header ">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
        <div class="page-wrapper" style="min-height:400px;">

            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>Sales Report - <?php echo $period?> </b></h3>
                </div>

            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row" style="min-height:380px;">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                                

                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr><th>Menu Item Name</th>
                                                <th>Unit Cost</th>
                                                <th>Sold Quantity</th>
                                                <th>Sub Total</th>


                                            </tr>
                                        </thead>
                                        <tbody>



                                        <?php


$time = get_time($report_period);
$sql   = "SELECT menu_item_name , price as Unit_Cost, sum(quantity) as quantity,  
sum(quantity*price )as Sub_Total  FROM user_orders u, menu m WHERE u.menu_item_id=m.menu_item_id 
and status = 'c' $time GROUP BY menu_item_name ORDER BY quantity desc ";
$query = mysqli_query($db, $sql);

if (!mysqli_num_rows($query) > 0) {
    echo '<td colspan="8"><center>No Orders</center></td>';
} else {
    $Total = 0;
    while ($rows = mysqli_fetch_array($query)) {

        ?>
<?php
$subTotal = $rows['Sub_Total'];
$Total += $subTotal;

echo '  <tr>
        <td>' . $rows['menu_item_name'] . '</td>
        <td>' . $rows['Unit_Cost'] . '</td>
        <td>' . $rows['quantity'] . '</td>';
        echo "<td>$$subTotal</td></tr>";
        $i++;


    }
        echo "<tr>
                        <th>Total</th>
                        <td colspan=2><td>$$Total</td>
                        </tr></table>";
}

?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->

        <!-- footer -->
            <?php
include 'footer.php';
    ?>

<!-- End footer -->


    </div>



</body>

</html>
