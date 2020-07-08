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



$homepage = array(1,23,24);
$buynumber = array(3,25,26);
$mynumber = array(4,27,28);
$opensupport = array(5,29,30);
$showsupport = array(6,31,32);
$useraddbalance = array(7,33,34);
$editprofile = array(8,35,36);
$loginregister = array(39,37,38);
$reqpost = array("title","description","keywords");
if($_POST){
    $type = $_POST["type"];
    $reqpost[0] = $_POST["title"];
    $reqpost[1] = $_POST["description"];
    $reqpost[2] = $_POST["keywords"];
    if($type == "home") { $result = $homepage;}
    if($type == "buynumber") { $result = $buynumber;}
    if($type == "mynumber") { $result = $mynumber;}
    if($type == "opensupport") { $result = $opensupport;}
    if($type == "showsupport") { $result = $showsupport;}
    if($type == "useraddbalance") { $result = $useraddbalance;}
    if($type == "editprofile") { $result = $editprofile;}
    if($type == "loginregister") { $result = $loginregister;}
    $reqpost[0] = $db->quote($reqpost[0]);
    $reqpost[1] = $db->quote($reqpost[1]);
    $reqpost[2] = $db->quote($reqpost[2]);
    for($a = 0; $a < 3; $a++){
      $db->query("Update settings set data =$reqpost[$a] where id = $result[$a]");
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
 
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
    
    
    ?>
      
    <div class="content">
        <div class="row">
        <div class="col-md-6">
       
        <div class="card">
        <div class="card-body">
        <h5 class="card-title text-center">Home Page</h5>
        <form method="post">
        <div class="form-group row">
            <label  class="col-md-2 col-form-label">Title</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="title" value="<?php echo $settings[0]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Description</label>
            <div class="col-md-10">
            <input type="text" name="description" class="form-control" value="<?php echo $settings[22]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-md-2 col-form-label">Keywords</label>
            <div class="col-md-10">
            <input type="text" name="keywords" class="form-control" value="<?php echo $settings[23]["data"]; ?>">
            <input type="hidden" name="type" value="home">
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-block">Update</button>

        </form>
        </div>

        </div>

        </div>
        <div class="col-md-6">

        <div class="card">
        <div class="card-body">
        <h5 class="card-title text-center">Buy Number</h5>
        <form method="post">
        <div class="form-group row">
            <label  class="col-md-2 col-form-label">Title</label>
            <div class="col-md-10">
            <input type="text" name="title" class="form-control" value="<?php echo $settings[2]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Description</label>
            <div class="col-md-10">
            <input type="text"  name="description" class="form-control" value="<?php echo $settings[24]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-md-2 col-form-label">Keywords</label>
            <div class="col-md-10">
            <input type="text" name="keywords" class="form-control" value="<?php echo $settings[25]["data"]; ?>">
            <input type="hidden" name="type" value="buynumber">
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-block">Update</button>
        </form>
        </div>

        </div>
       

        </div>
        </div>
          
        <div class="row mt-2">
        <div class="col-md-6">

        <div class="card">
        <div class="card-body">
        <h5 class="card-title text-center">My Numbers</h5>
        <form method="post">
        <div class="form-group row">
            <label  class="col-md-2 col-form-label">Title</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="title" value="<?php echo $settings[3]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Description</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="description" value="<?php echo $settings[26]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-md-2 col-form-label">Keywords</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="keywords" value="<?php echo $settings[27]["data"]; ?>">
            <input type="hidden" name="type" value="mynumber">
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-block">Update</button>
        </form>
        </div>

        </div>


        </div>
        
        <div class="col-md-6">

            <div class="card">
            <div class="card-body">
            <h5 class="card-title text-center">Support Request</h5>
            <form method="post">
            <div class="form-group row">
                <label  class="col-md-2 col-form-label">Title</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="title" value="<?php echo $settings[4]["data"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Description</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="description" value="<?php echo $settings[28]["data"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail"  class="col-md-2 col-form-label">Keywords</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="keywords" value="<?php echo $settings[29]["data"]; ?>">
                <input type="hidden" name="type" value="opensupport">
                </div>
            </div>
            <button type="submit" class="btn btn-info btn-block">Update</button>
            </form>
            </div>

            </div>


            </div>

        </div>

        <div class="row mt-2">
        <div class="col-md-6">

        <div class="card">
        <div class="card-body">
        <h5 class="card-title text-center">My Support Requests</h5>
        <form method="post">
        <div class="form-group row">
            <label  class="col-md-2 col-form-label">Title</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="title" value="<?php echo $settings[5]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Description</label>
            <div class="col-md-10">
            <input type="text" class="form-control"name="description" value="<?php echo $settings[30]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-md-2 col-form-label">Keywords</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="keywords" value="<?php echo $settings[31]["data"]; ?>">
            <input type="hidden" name="type" value="showsupport">
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-block">Update</button>
        </form>
        </div>

        </div>


        </div>
        
        <div class="col-md-6">

            <div class="card">
            <div class="card-body">
            <h5 class="card-title text-center">Add Balance</h5>
            <form method="post">
            <div class="form-group row">
                <label  class="col-md-2 col-form-label">Title</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="title" value="<?php echo $settings[6]["data"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Description</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="description" value="<?php echo $settings[32]["data"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-md-2 col-form-label">Keywords</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="keywords" value="<?php echo $settings[33]["data"]; ?>">
                <input type="hidden" name="type" value="useraddbalance">
                </div>
            </div>
            <button type="submit" class="btn btn-info btn-block">Update</button>
            </form>
            </div>

            </div>


            </div>

        </div>

        <div class="row mt-2">
        <div class="col-md-6">

        <div class="card">
        <div class="card-body">
        <h5 class="card-title text-center">Edit Profile</h5>
        <form method="post">
        <div class="form-group row">
            <label  class="col-md-2 col-form-label">Title</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="title" value="<?php echo $settings[7]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Description</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="description" value="<?php echo $settings[34]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-md-2 col-form-label">Keywords</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="keywords" value="<?php echo $settings[35]["data"]; ?>">
            <input type="hidden" name="type" value="editprofile">
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-block">Update</button>
        </form>
        </div>

        </div>


        </div>
        
        <div class="col-md-6">

            <div class="card">
            <div class="card-body">
            <h5 class="card-title text-center">Log in / Register</h5>
            <form method="post">
            <div class="form-group row">
                <label  class="col-md-2 col-form-label">Title</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="title" value="<?php echo $settings[38]["data"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Description</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="description" value="<?php echo $settings[36]["data"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-md-2 col-form-label" >Keywords</label>
                <div class="col-md-10">
                <input type="text" class="form-control" name="keywords" value="<?php echo $settings[37]["data"]; ?>">
                <input type="hidden" name="type" value="loginregister">
                </div>
            </div>
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


