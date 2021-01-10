<?php
session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Comp 3015</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    

<div class="edit-php" > 

    <form role="form" method="post" action="profiles.php?type=updateadmin" enctype="multipart/form-data">
        <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" name="username" value="<?php echo $_GET['queryR'];?>" type="hidden"> 
                    <!-- $profile['username']    -->
                </div>
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input class="form-control" type="file" name="picture">
                </div>
        </div>
        <div class="modal-footer">
            <button > <a href="profiles.php">   Close    </a> </button>
            <input type="submit" class="btn btn-primary" value="Submit!"/>
        </div>
    <!-- </div> -->
    <!-- /.modal-content   -->
    </form>

</div> <!-- end edit-php  -->

</body>
</html>


<style> 
body {
    padding: 100px;
}

.edit-php {
    width:50%; 
    margin:0 auto; 
    border:1px solid black;
}
</style>