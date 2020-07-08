<?php

include_once ("../config.php");

$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}


$user = $_SESSION["login_user"];

   if ($user) {
       
    } else {
        header("Location: ../../login-register.php?type=guest");
        exit;
    }
    $userid = $user["id"];
    $settings = $db->select("SELECT * from settings");
    
if($_POST){

    $tutar1 = $_POST["price"];
    if($tutar1 < $settings[17]["data"]){
        header("Location: ../../add-balance.php?balance=small");
        exit;
    } 



    $sorgukod = $db->query("Select * from user where id = $userid;");
        if ($sorgukod === false) {
            return false;
        }
        while ($row1 = $sorgukod->fetch_assoc()) {
        $isim = $row1['name'];
        $soyisim = $row1['surname'];
        $mail = $row1['username'];
        $tel =  $row1['phone'];
        $city = $row1["city"];
        $country = $row1["country"];
        $postcode = $row1["postcode"];
        $adres = $row1["adress"];
        }




$_SESSION['tutar']= $tutar1;
$tutar =  $tutar1;
$urun = "Sms-verification";
$sipno = rand();
   

include_once ("shopierAPI.php"); 
$shopier = new Shopier($settings[39]["data"], $settings[40]["data"]);

$shopier->setBuyer([ 
'id' => $sipno, 
'paket' => $urun, 
'first_name' => $isim, 'last_name' => $soyisim, 'email' => $mail, 'phone' => $tel]); 
$shopier->setOrderBilling([
'billing_address' => $adres, //Kullanıcının adresi
'billing_city' => $city,
'billing_country' => $country, 
'billing_postcode' => $postcode, 
]);
$shopier->setOrderShipping([
    'shipping_address' => $adres, 
    'shipping_city' => $city, 
    'shipping_country' => $country, 
    'shipping_postcode' => $postcode, 
    ]);
die($shopier->run($sipno, $tutar, 'shopierNotify.php')); 

}




?>
    

