<?php 

include_once ("../config.php");

$db = new Db();

if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}

$user = $_SESSION["login_user"];

   if ($user) {
       
    } else {
        header("Location: login.php");
        exit;
    }
    $userid = $user["id"];
   




 
$status = $_POST["status"];
$invoiceId = $_POST["platform_order_id"];
$transactionId = $_POST["payment_id"];
$installment = $_POST["installment"];
$signature = $_POST["signature"];


$url = 'https://sms-verification.codersty.com/';
$locationtrue = $url."successful-pay.php";
$locationfalse = $url."order?orderNo=none";


$data = $_POST["random_nr"] . $_POST["platform_order_id"] . $_POST["total_order_value"] . $_POST["currency"];
$signature = base64_decode($signature);
$expected = hash_hmac('SHA256', $data, $shopierSecret, true);
if ($signature == $expected) {
$status = strtolower($status);
if ($status == "success") {


    $ucret = $_POST["total_order_value"];
    $sorgu1 = "UPDATE user SET balance = balance + $ucret WHERE id = $userid;";
    $db->query($sorgu1);


header("Location: $locationtrue");






}
else{

header("Location: $locationfalse");
}
}
?>
