<?php
require 'includes/functions.php';
$message = '';
session_start();

if(!isset($_SESSION['loggedin']))
{
    header('Location: index.php');
    exit();
}

if(count($_FILES) > 0)
{
    $check = checkPost($_FILES);
    if($check !== true)
    {
        $message = '
        <div class="alert alert-danger text-center">
            '. $check .'
        </div>
        ';
    }
    else
    {
        if($_GET['type'] == 'update' ) 
        {
            updateProfile($_SESSION['username'], $_FILES);
        }
        elseif($_GET['type'] == 'updateadmin' ) 
        {
            updateProfileAdmin($_POST['username'], $_FILES);
        }
        elseif($_GET['type'] == 'add')
        {
            saveProfile($_SESSION['username'], $_FILES);
        }      
    }
}

$profiles = getAllProfiles();
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3"  style="padding-bottom:20px">
                <hr/>
                <?php echo $message; 
                
                if(($_SESSION['username']  !== 'Administrator') && ($_SESSION['username']  !== 'administrator')) {
                    echo ' <button class="btn btn-default" data-toggle="modal" data-target="#newPost"><i class="fa fa-comment"></i> New Profile</button> ';
                }                
                ?>
                <a href="logout.php" class="btn btn-default pull-right"><i class="fa fa-sign-out"> </i> Logout</a>
                <hr/>
            </div>
        </div>

        <div class="row">
            <?php
            foreach($profiles as $profile)
            {
                echo '
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <span>
                                    '.$profile['username'].'
                                </span>
                ';

                if(($profile['username'] == $_SESSION['username']) || ($_SESSION['username']  == 'administrator') ||  ($_SESSION['username']  == 'Administrator'))
                {
                    echo '
                        <span class="pull-right text-muted">
                            <a class="" href="delete.php?id='.$profile['id'].'">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </span>
                    ';
                }

                echo '
                    </div>
                    <div class="panel-body">
                        <p class="text-muted">
                        </p>
                        <img class="img-thumbnail" src="profiles/'.$profile['picture'].'"/>
                    </div> ';
          
                if(($profile['username'] == $_SESSION['username']) || ($_SESSION['username']  == 'administrator') ||  ($_SESSION['username']  == 'Administrator'))
                {     
                    echo ' <div class="panel-footer">
                                <p> 
                                    <a href="reset.php?queryR='.$profile['username'].'" style=margin:25px> Reset Password </a> 
                                </p>  
                                <p>
                                    <a href="edit.php?queryR='.$profile['username'].'"
                                   > Update Profile  </a>
                                </p>
                            </div> '
                    ;
                }
                echo '</div>
                </div>' ;
                        
            }
            ?>

        </div>
    </div>
</div>

<!-- For new profile pic -->
<div id="newPost" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <form role="form" method="post" action="profiles.php?type=add" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">New Profile</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" value="<?php echo $_SESSION['username'];?>" disabled" disabled> 
                    <!-- $_GET['queryR']   -->
                </div>
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input class="form-control" type="file" name="picture">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Submit!"/>
        </div>
    </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- For updating profile pic  -->
<div id="updatePost" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <form role="form" method="post" action="profiles.php?type=update" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Profile</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Profile Picture</label>
                <input class="form-control" type="file" name="picture">    
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Submit!"/>
        </div>
    </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
