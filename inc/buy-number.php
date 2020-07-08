<?php

include_once ("config.php");

$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];

   if ($user) {
       
    } else {
        header("Location: ../login-register.php?type=number");
        exit;
    }

if($_POST){
 $countrycode = $_POST["countrycode"];
 $servicecode = $_POST["servicecode"];
 $servicecode_0=$servicecode."_0";
 $version = $_POST["version"];

 $resultpriceservice = $db->select("SELECT price.price
 FROM ((price
 INNER JOIN service ON service.id = price.serviceid)
 INNER JOIN country ON country.id = price.countryid) where (country.countrycode = '$countrycode' or country.countrycode2 = '$countrycode' or country.countrycode3 = '$countrycode') and (service.servicecode = '$servicecode' or service.servicecode2 = '$servicecode_0' or service.servicecode3 = '$servicecode_0');");  
 $price = $resultpriceservice[0]["price"];
$resultuserbalance = $db->select("SELECT balance from user where id=".$user["id"]);  
$userbalance = $resultuserbalance[0]["balance"];
$_SESSION["login_user"]["balance"] = $userbalance; //session update current balance assignment
 if($userbalance >= $price){
    
    $querysmsapi= "SELECT * FROM smsapikey";
    $resultsmsapi = $db->select($querysmsapi);
    $smsapikey = $resultsmsapi[0]["apikey"];
    $smsapikey2 = $resultsmsapi[1]["apikey"];
    $smsapikey3 = $resultsmsapi[2]["apikey"];
    include 'functions.php';
    $i=0;
    while ($i<5) {
        if($version=="1"){
            $numberresult = getnumber($smsapikey,$servicecode,$countrycode);
        }
        elseif($version=="2"){
            $numberresult = getnumber2($smsapikey2,$servicecode,$countrycode);
            $servicecode=$servicecode."_0";
        }elseif($version=="3"){
            $numberresult = getnumber3($smsapikey3,$servicecode,$countrycode);
            $servicecode=$servicecode."_0";
        }
        if($numberresult!="nonumber")break;
        $i++;
        sleep(5); 
    }

    if($numberresult != "nonumber"){

        $numberinfo = explode(":", $numberresult);
        $userid = $user["id"];
        $number = $db->quote($numberinfo[1]);
        $numberid = $db->quote($numberinfo[0]);
        $servicecode = $db->quote($servicecode);
        $sorgu = "INSERT INTO number (user_id,country_code,number,number_id,service_code,message,version) VALUES ($userid,'$countrycode',$number,$numberid,$servicecode,'','$version');";
        $db->query($sorgu);
        
        $sorgu1 = "UPDATE user SET balance = balance - $price WHERE id = $userid;";
        $db->query($sorgu1);
        header('Location: ../my-number.php?type=ok');
      

    }else{

        header('Location: ../buy-number.php?type=nonumber&country='.$countrycode);   
    }


    /*
   
    */


 }
 else{
    header('Location: ../buy-number.php?type=balance&country='.$countrycode);   
 }

}
?>