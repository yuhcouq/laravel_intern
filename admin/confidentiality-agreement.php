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
$result = 0;
if($_POST){
    $text = $_POST["text"];
    if($db->query("Update settings set data = '$text' where id=42")){
        $result = 1;
    }else{
        $result = 2;
    }
}

$settings = $db->select("SELECT * from settings");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta name="robots" content="noindex">
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
    
    
    ?>
      
    <div class="content">
    <div class="row">
    <div class="col-md-12">
    <?php 
    if($result ==1){
        echo '<div class="alert alert-primary" role="alert">
        Successfully updated.
      </div>';
    }else if($result ==2){
        echo '<div class="alert alert-danger" role="alert">
        There was a problem updating.
      </div>';
    }

    ?>
    </div>
    </div>
        <div class="row">
        <div class="col-md-12">

        <div class="card">
        <div class="card-body">
        <label for="exampleFormControlTextarea1">Confidentiality Agreement</label>
        <form method="post">
        
       
         <textarea name="text"  id="exampleFormControlTextarea1" style="width:100%;" rows="35" ><?php echo $settings[41]["data"]; ?></textarea>
      
        
        </div>
        </div>

        </div>
        </div>
          
        <div class="row mt-1">
        <div class="col-md-12">

        <div class="card">
        <div class="card-body">

       <button type="submit" class="btn btn-info btn-block">Update</button>
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
