<?php

include_once ("config.php");

$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

function randomString($length = 6) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

$settings = $db->select("SELECT * from settings");
if($_POST){
    $mail1 = $_POST["mail"];
    $mail1 = trim($mail1);

    $sonmail = $db->query("SELECT id,name FROM user where username='$mail1';");
    if ($sonmail === false) {
        return false;
    }
    while ($row = $sonmail->fetch_assoc()) {
        $id = $row["id"];
        $isim = $row["name"];
    }
    if(!empty($id)){

    
        $sifre = randomString();
        

        require("class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
        $mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
        $mail->SMTPSecure = 'ssl'; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
        $mail->Host = $settings[18]["data"]; // Mail sunucusunun adresi (IP de olabilir)
        $mail->Port = 465; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
        $mail->IsHTML(true);
        $mail->SetLanguage("tr", "phpmailer/language");
        $mail->CharSet  ="utf-8";
        $mail->Username = $settings[19]["data"]; // Gönderici adresiniz (e-posta adresiniz)
        $mail->Password = $settings[20]["data"]; // Mail adresimizin sifresi
        $mail->SetFrom($settings[19]["data"],$settings[0]["data"]); // Mail atıldığında gorulecek isim ve email
        $mail->AddAddress($mail1); // Mailin gönderileceği alıcı adres
        $mail->Subject = "New Password Request"; // Email konu başlığı
        $mail->Body = 'Hi:'.$isim.'<br/>
        New Password:'.$sifre.'<br/>';; // Mailin içeriği
        if(!$mail->Send()){
            header("location: ../login-register.php?type=$mail->ErrorInfo");  
            exit;
        }else{
            ob_start();
            $sifre = trim($sifre);
            $sifre =  md5($sifre);

            $sorgu = "Update user set password = '$sifre' where id = $id;";
            $db->query($sorgu);


        echo '<script>window.location="../login-register.php?type=mailsend";</script>';
        }

    }else{
        header("location: ../login-register.php?type=nomail");
        exit;

    }
}else{
    header("location: ../login-register.php");
    exit;
}



?>


