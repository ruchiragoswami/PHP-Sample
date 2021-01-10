<?php
session_start();
require 'includes/functions.php';

$message = '';
if(isset($_COOKIE['error_message']))
{
    $message = '<div class="alert alert-danger text-center">'
        . $_COOKIE['error_message'] .
        '</div>';

    setcookie('error_message', null, time() - 3600);
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>COMP 3015</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div id="wrapper">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="login-panel text-center text-muted">
                    COMP 3015 Assignment 3
                </h1>
                <hr/>
                <h2 style=text-align:center;> Reset Password For </h2>
                <h3 style=text-align:center;> <?php echo $_GET['queryR'];?> </h3>
                <?php echo $message; ?>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Change Your Passwords </h3>
                    </div>
                    <div class="panel-body">
                        <form name="reset" role="form" action="redirect.php?from=reset" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <!-- <input class="form-control"
                                           
                                           value="<?php echo $_GET['queryR'];?>" disabled
                                           name="username"
                                           placeholder="Username"
                                           type="text"
                                           
                                    /> -->
                                </div>
                                <div class="form-group">
                                    <input class="form-control"
                                           value="<?php echo $_GET['queryR'];?>" 
                                           name="username"
                                           placeholder="Username"
                                           type="hidden"
                                           autofocus 
                                    />
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control"
                                           name="password"
                                           placeholder="New Password"
                                           type="password"
                                    />
                                </div>

                                <div class="form-group">
                                    <input class="form-control"
                                           name="verify_password"
                                           placeholder="Verify New Password"
                                           type="password"
                                    />
                                </div>
                                <input type="submit" class="btn btn-lg btn-info btn-block" value="Confirm"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-default" href="login.php">Login</a>
            </div>
        </div>

    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
