<?php
require ("/home/bitnami/dbconfig.php");
// page will set the session variables after the user has clicked the link in the email
// sent to them and redirect them to the index page with their session variables set

echo $_SESSION["code"];
echo "\nsession above post below\n";
echo $_POST["scode"];
if(isset($_SESSION["code"])){
    $scode = $_POST["scode"];
    $c = $_SESSION['code'];
    if($c == $scode){
        header('location: index.php');
    }
    else{
    session_destroy();
    
}
}
else{
    session_destroy();
}
?>