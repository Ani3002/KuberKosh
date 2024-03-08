<?php

    include "php/google-auth.php"
?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login with Google in PHP</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  
 </head>
 <body>
  <div class="container">
   <br />   

   <h5>Session ID: <?php echo session_id(); ?></h5>
   
   <div class="panel panel-default">
   <?php

    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION['profile_picture'].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name : </b>'.$_SESSION["first_name"].' '.$_SESSION['last_name']. '</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['email_address'].'</h3>';
    echo '<h3><a href="index.php?logout">Logout</h3></div>';

   ?>
   </div>
  </div>
 </body>
</html>