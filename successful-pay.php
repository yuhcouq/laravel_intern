<?php


include_once ("inc/config.php");

$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}
$user = $_SESSION["login_user"];

   if ($user) {
       
    } else {
        header("Location: login-register.php");
        exit;
    }

    $userid = $user["id"];
  
    $gelenurl = $_SERVER['HTTP_REFERER'];

    if (stripos(strtolower($gelenurl), 'shopier') !== false) {

        $yatirilanucret = $_SESSION['tutar'];
        $sorgu1 = "UPDATE user SET balance = balance + $yatirilanucret WHERE id = $userid;";
        $db->query($sorgu1);
        
        $sorgu12 = "Insert into log(user_id,price,type) values($userid,$yatirilanucret,1)";
        $db->query($sorgu12);
        
        unset($_SESSION['tutar']);

        header("refresh:3;url=index.php");

        // bulunuyor
        } else {
            unset($_SESSION['tutar']);
            header('Location: index.php');
            exit;

        }


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Payment Process</title>
  </head>
  <body>
  
<center><h1>Transaction successful</h1>
</center>
  <center><img src="https://i.gifer.com/7efs.gif"></center>

  <center>
      
  <?php
   
 
die('After 3 seconds you will be redirected to the homepage.
Not to wait this time
<a href="index.php">click here </a>'); 

?></center>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>