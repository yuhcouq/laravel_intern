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
$userid= $user["id"];
    if($_POST){
        $giftcode = $_POST["giftcode"];
        $querymail= "select * from giftcode where giftkey ='$giftcode';";
        $resultmail = $db->select($querymail);
        $sonuc = $resultmail[0]["stock"];
        if($sonuc >0){
            if($resultmail[0]["giftkey"]== "ONAY2020"){
                $querylog= "select price from log where user_id =$userid order by id desc limit 1;";
                $resultlog = $db->select($querylog);
                if($resultlog[0]["price"] >=20){
                    $querypay= "select count(*) from log where type=3 and user_id =$userid;";
                    $resultpay = $db->select($querypay);
                    if($resultpay[0]["count(*)"] ==0){
                        $sorgu1 = "UPDATE user SET balance = balance + 5 WHERE id = $userid;";
                        $db->query($sorgu1);
                        $sorgu12 = "Insert into log(user_id,price,type) values ($userid,5,3) ";
                        $db->query($sorgu12);
                        $sorgu123 = "UPDATE giftcode SET stock = stock - 1 WHERE id = 1;";
                        $db->query($sorgu123);
                        header('Location: ../add-balance.php?type=ok');
                    }else{ header('Location: ../add-balance.php?type=tekrar');}
                }else{
                    header('Location: ../add-balance.php?type=bakiyeyukle');
                }
            }else{
                header('Location: ../add-balance.php?type=stok');
            }

        }else{
            if($sonuc ==0){   header('Location: ../add-balance.php?type=stok');}
            if($sonuc ==null){   header('Location: ../add-balance.php?type=keyerror');}
        }
    }

?>