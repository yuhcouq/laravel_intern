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
        $numberid = $_POST["cancelnumber"];
        $cancelversion = $_POST["cancelversion"];
        $cancelcountry = $_POST["cancelcountry"];
        $cancelservice = $_POST["cancelservice"];
        //$cancelservice_0 = $cancelservice."_0";
        include 'functions.php';
        $querysmsapi= "SELECT * FROM smsapikey";
        $resultsmsapi = $db->select($querysmsapi);
        $smsapikey = $resultsmsapi[0]["apikey"];
        $smsapikey2 = $resultsmsapi[1]["apikey"];
        $smsapikey3 = $resultsmsapi[2]["apikey"];
        if($cancelversion=="1"){
            $statuscancel = cancelnumber($cancelcountry,$cancelservice,$numberid,$smsapikey);
        }
        elseif($cancelversion=="2"){
            $statuscancel = cancelnumber2($smsapikey2,$numberid);
        }elseif($cancelversion=="3"){
            $statuscancel = cancelnumber3($smsapikey3,$numberid);
        }
        //var_dump($statuscancel);
        if($statuscancel =="success"){
            $userid=$user["id"];
            $priceresult = $db->select("SELECT price.price FROM ((price INNER JOIN service ON service.id = price.serviceid)
            INNER JOIN country ON country.id = price.countryid) where (country.countrycode ='$cancelcountry' or country.countrycode2 ='$cancelcountry' or country.countrycode3 ='$cancelcountry') and (service.servicecode = '$cancelservice' or service.servicecode2 = '$cancelservice' or service.servicecode3 = '$cancelservice');");
            $resultprice= $priceresult[0]["price"];
            //$user["balance"] = $user["balance"] + $resultprice;
            $sorgu13 = "UPDATE user SET balance = balance + $resultprice WHERE id = $userid;";
                        $db->query($sorgu13);
   
            $sorgu14 = "Delete from number WHERE number_id = $numberid;";
            $db->query($sorgu14);
            header('Location: ../my-number.php?type=cancel');
        }else{
            header('Location: ../my-number.php?type=error');
        }
    }


?>