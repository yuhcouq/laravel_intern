
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
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Paneli
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta content="description" name="En Uygun Fiyatlarla Sms Onay Hizmeti! Piyasadaki en uygun fiyatlarla en yüksek kaliteyi sunuyoruz. Sadece kayıt olun ve kullanmaya başlayın.">
  <meta content="keywords" name="numara onay,mobil onay,telefon onay,sms onay,tek kullanımlık numara onay,ücretsiz mobil onay,ücretsiz numar onayı">
  
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
    
    
    ?>
      
    <div class="content">
        <div class="row">
        


        </div>
          
        <div class="row mt-5">
        <div class="col-md-12">



        </div>
        </div>

        
      </div>
            <?php include 'static/footer.php'; ?>
    </div>
  </div>

</body>

</html>
