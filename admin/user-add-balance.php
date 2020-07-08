<?php
include_once("../inc/config.php");
$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];

if($user["authority"] ==1){
    
}
else{
    header("Location: ../login-register.php?type=guest"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <title>
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  
  <!--     Fonts and icons     -->
  
</head>
<?php 
      $result =0;  
    if($_POST){
        $mail = $_POST["mail"];
        $price = $_POST["price"];
      if(!empty($price)){
    if($db->query("UPDATE user SET balance = balance + $price WHERE username = '$mail';")){
            $sorgu12 = "Insert into log(user_id,price,type) values ((Select id from user where username='$mail'),$price,2) ";
            $db->query($sorgu12);
            $result =1;
        }else{
            $result =2;
        }
    }
    }
   include 'static/menu.php'; 
    ?>
      
    <div class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="card">
        <div class="card-body">
        The uploads you make here will enter the e-mail address of the user and allow the balance to be loaded on his account.
        </div>
        </div>

        <?php
        if($result ==1){
           echo '<div class="alert alert-primary" role="alert">
           The balance has been successfully added to the user.
            </div>';
        }
        else if($result ==2){
            echo '<div class="alert alert-danger" role="alert">
            There was a problem adding the balance to the user or adding balance.
            </div>';

        }
        ?>
      
        </div>
        </div>
        <div class="row mt-5">
        <div class="col-md-12">

        <div class="card">
        <div class="card-body">

        <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" name="price" class="form-control" >
            
        </div>
        <button type="submit" class="btn btn-primary btn-block">Add</button>
        </form>

        </div>
      </div>

        </div>
        </div>

        
      </div>
            <?php include 'static/footer.php'; ?>
    </div>
  </div>

</body>

</html>
