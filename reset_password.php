<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Reset Password</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>

<body>
    <div class="container padding-bottom-3x mb-2 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="forgot">
                    <h1 class="email">Reset Password</h1>
                    <h4>Please type in your new password below</h4>
                </div>
                <form action="PizzaPlanet/change_password.php" method="post" class="card mt-4">
                    <div class="card-body">
                        <div class="form-group"><label>New Password</label> 
                            <input class="form-control" id="email-for-pass" type="password" name="password" placeholder="Enter Your New Password" required></div>
                        <div class="form-group"><label>Retype New Password</label> 
							<input class="form-control" id="email-for-pass" type="password" name="password_2" placeholder="Re-Enter Password" required></div>
							<input type="hidden" name="email" value="<?php echo($_POST['email']) ?>" />
                    </div>
                    <div card-footer>
                        <button class="btn btn-success" type="submit" name="submit" value="submit">Reset Password</button>
                        <button onclick="window.location.href='index.html';" class="btn btn-danger" type="submit" name="submit" value="submit">Back To Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
