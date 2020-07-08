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
if($_POST){
$updateid = array(2,9,18,10,11,12,13,14,15,16,17,19,20,21,22,40,41,43,44,45);
$updatename = array($_POST["navbartitle"],$_POST["addbalanceinfo"],$_POST["minbuybalance"],$_POST["card1"],$_POST["card2"],$_POST["card3"],$_POST["card4"],$_POST["card5"],$_POST["card6"],$_POST["card7"],$_POST["card8"],$_POST["mailhost"],$_POST["mailadress"],$_POST["mailpass"],$_POST["sendmail"],$_POST["shopierkey"],$_POST["shopiersecret"],$_POST["register11"],$_POST["register22"],$_POST["analystics"]);

for($a = 0; $a <20; $a++){
    $db->query("Update settings set data ='$updatename[$a]' where id = $updateid[$a]");
}
$smsactivekey = $_POST["smsapikey"];
$smsactivekey2 = $_POST["smsapikey2"];
$smsactivekey3 = $_POST["smsapikey3"];
$db->query("Update smsapikey set apikey ='$smsactivekey' where id = 1");
$db->query("Update smsapikey set apikey ='$smsactivekey2' where id = 2");

$db->query("Update smsapikey set apikey ='$smsactivekey3' where id = 3");

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
  <meta name="robots" content="noindex">
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
        <form method="post">
        <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Navbar Title</label>
            <div class="col-md-10">
            <input type="text" name="navbartitle" class="form-control" value="<?php echo $settings[1]["data"]; ?>">
            </div>
        </div>
        </div>
        </div>

        <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Mail Host</label>
            <div class="col-md-10">
            <input type="text" name="mailhost" class="form-control" value="<?php echo $settings[18]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Mail Adress</label>
            <div class="col-md-10">
            <input type="text" name="mailadress" class="form-control" value="<?php echo $settings[19]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Mail Password</label>
            <div class="col-md-10">
            <input type="text" name="mailpass" class="form-control" value="<?php echo $settings[20]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Mail Sent Address</label>
            <div class="col-md-10">
            <input type="text" name="sendmail" class="form-control" value="<?php echo $settings[21]["data"]; ?>">
            </div>
        </div>
        </div>
        </div>

        <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Smspva Api Key</label>
            <div class="col-md-10">
            <?php 
            $querysmsapi= "SELECT * FROM smsapikey";
            $resultsmsapi = $db->select($querysmsapi);
            $smsapikey = $resultsmsapi[0]["apikey"];
            $smsapikey2 = $resultsmsapi[1]["apikey"];
            $smsapikey3 = $resultsmsapi[2]["apikey"];
            ?>
            <input type="text" name="smsapikey" class="form-control" value="<?php echo $smsapikey; ?>">
            </div>

            <label class="col-md-2 col-form-label">5sim Api Key</label>
            <div class="col-md-10">
            <input type="text" name="smsapikey2" class="form-control" value="<?php echo $smsapikey2; ?>">
            </div>
            <label class="col-md-2 col-form-label">Sms-active Api Key</label>
            <div class="col-md-10">
            <input type="text" name="smsapikey3" class="form-control" value="<?php echo $smsapikey3; ?>">
            </div>
        </div>
        </div>
        </div>

        <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Shopier Api Key</label>
            <div class="col-md-10">
            <input type="text" name="shopierkey" class="form-control" value="<?php echo $settings[39]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Shopier Api Secret</label>
            <div class="col-md-10">
            <input type="text" name="shopiersecret" class="form-control" value="<?php echo $settings[40]["data"]; ?>">
            </div>
        </div>
        </div>
        </div>

        
        <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Analystics Code</label>
            <div class="col-md-10">
            <input type="text" name="analystics" class="form-control" value="<?php echo $settings[44]["data"];?>">
            </div>
        </div>
        </div>
        </div>

        </div>
        <div class="col-md-6">

        <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Add Balance İnfo</label>
            <div class="col-md-10">
            <input type="text" name="addbalanceinfo" class="form-control" value="<?php echo $settings[8]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Min Price Add Balance</label>
            <div class="col-md-10">
            <input type="text" name="minbuybalance" class="form-control" value="<?php echo $settings[17]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">1. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card1" class="form-control" value="<?php echo $settings[9]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">2. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card2" class="form-control" value="<?php echo $settings[10]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">3. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card3" class="form-control" value="<?php echo $settings[11]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">4. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card4" class="form-control" value="<?php echo $settings[12]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">5. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card5" class="form-control" value="<?php echo $settings[13]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">6. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card6" class="form-control" value="<?php echo $settings[14]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">7. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card7" class="form-control" value="<?php echo $settings[15]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">8. Card Amount</label>
            <div class="col-md-10">
            <input type="text" name="card8" class="form-control" value="<?php echo $settings[16]["data"]; ?>">
            </div>
        </div>
        </div>
        </div>
    
        <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Register Title 1</label>
            <div class="col-md-10">
            <input type="text" name="register11" class="form-control" value="<?php echo $settings[42]["data"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Register Title 2</label>
            <div class="col-md-10">
            <input type="text" name="register22" class="form-control" value="<?php echo $settings[43]["data"]; ?>">
            </div>
        </div>
        </div>
        </div>

        </div>
          
      

        
      </div>
     
      <div class="row">
      <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <button type="submit" class="btn btn-info btn-block">Update</button>
        </form>
        </div>
        </div>
     
      </div>
      
      </div>
            <?php include 'static/footer.php'; ?>
    </div>
  </div>

</body>

</html>
