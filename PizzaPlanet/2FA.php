<?php
require ("/home/bitnami/dbconfig.php");
include('mysqli_connect_Register.php');
// page will set the session variables after the user has clicked the link in the email
// sent to them and redirect them to the index page with their session variables set
?>
<form action="2FA.php" method="POST">
    Enter Secure Code
    <input type="text" name = "scode">
    <button type="submit">Submit</button>
</form>

<?php
if(isset($_SESSION["code"])){
    $scode = $_POST["scode"];
    $code = $_SESSION["code"];
    if($code == $scode){
        header('location: index.php');
    }
    else{
    session_unset();
}
}
else{
    session_unset();
}
?>