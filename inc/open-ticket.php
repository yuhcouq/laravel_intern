<?php
error_reporting(0);
include_once ("config.php");

$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}
$user = $_SESSION["login_user"];
if ($user) {
       
} else {
    header("Location: ../login-register.php?type=guest");
    exit;
}

$settings = $db->select("SELECT * from settings");

if($_POST){

   $subject = $_POST["subject"];
   $message = $_POST["message"];
   $relatedservice = $_POST["relatedservice"];
   $priority = $_POST["priority"];

    if($subject != null && $message != null){
        $body = "Subject : ".$subject.'<br> Message : '.$message.'<br> Priority : '.$priority;
        $usernamesurname = $user['name'].' '.$user["surname"];
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
        $mail->AddAddress($settings[21]["data"]); // Mailin gönderileceği alıcı adres
        $mail->Subject = "Sms-Verification Support"; // Email konu başlığı
        $mail->Body = $body; // Mailin içeriği
        if(!$mail->Send()){
            echo "Mail Error ".$mail->ErrorInfo;
        }else{
            ob_start();
            $subject = $db->quote($subject);
            $message = $db->quote($message);
            $relatedservice = $db->quote($relatedservice);
            $priority = $db->quote($priority);
            $userid = $user["id"];
            $userid = $db->quote($userid);
                $query = "INSERT INTO support (user_id,subject,message,relatedservice_id,priority,status) VALUES ($userid,$subject,$message,$relatedservice,$priority,1);";
                $db->query($query);

        echo '<script>window.location="../support-tickets.php?type=success";</script>';
        }
    }else{
    echo '<script>window.location="../open-ticket.php?type=none";</script>';
   }



    



   
    }else{
        echo '<script>window.location="../open-ticket.php?type=error";</script>'; 
    }

?>