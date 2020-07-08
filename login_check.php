<?php


include_once ("inc/config.php");

$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];


if ($user) {
    header("location: index.php");
    exit;
}


// login.php den gönderilen Kullanıcı adı ve Şifreyi alıyoruz.
$username = $_POST["username"];
$password = $_POST["password"];

// Varsa Sağında yada Solunda gereksiz boşluklar, bunları temizliyoruz.
$username = trim($username);
$password = trim($password);

// Kullanıcı adını güvenli hale getiriyoruz.
$username = $db->quote($username);

// Şifremizi md5 e çeviriyoruz
$password = md5($password);

// Sorgumuzu hazırlıyoruz.
$query= "SELECT * FROM user WHERE username=$username and password='$password'";

/**
 * Sorgumuzu Çalıştırıyoruz.
 */
$result = $db->select($query);

/**
 * Sorgumuzu çalıştırdıktan sonra dönen sonucu inceliyoruz.
 * Login Formundan gelen bilgiler ile, veritabanımız da bulunan bilgileri karşılaştırdık.
 * Burada ki IF ile EŞLEŞEN bir kayıt var mı diye kontrol ediyoruz.
 */
if ($result && count($result) == 1) {
    /**
     * Girilen Kullanıcı adı ve Şifre ile eşleşen bir kayıt bulduk.
     * Tanımsız olarak başlattığımız Session ı, artık tanımlaya biliriz.
     * Böylece oturum açma işlemini gerçekleştirebiliriz.
     */

    // Ihtiyaç duyduğumuz alanları login_user adlı oturum değişkenine kayıt ettik.
    // login_user oturum değişkeni ilk defa burada dulduruluyor.
    // Daha önce hep boştu. Boş olması demek, kişi oturum açmamış demektir.
    // Dolu olması demek ise, kişi oturum açmış demektir.
    // Bizde doldurmak için gerekli alanları login_user oturum değişkenine kayıt ettik.
    // Örneğin başka bir sayfa da kullanıcın adını yada soyadını almak için, burada kayıt ettiğimiz name ve surname i alacağız.
    $_SESSION["login_user"] = array(
        "id" => $result[0]["id"],
        "name" => $result[0]["name"],
        "surname" => $result[0]["surname"],
        "username" => $result[0]["username"],
        "created_at" => $result[0]["created_at"],
        "updated_at" => $result[0]["updated_at"],
        "balance" => $result[0]["balance"],
        "authority" => $result[0]["authority"]

    );
    $user = $_SESSION["login_user"];
    $userid = $user["id"];
    $sorgu11 = "UPDATE user SET updated_at = NOW() WHERE id = $userid;";
    $db->query($sorgu11);
   
    header("location: index.php");
    exit;

} else {
  
    header("location: login-register.php?type=loginerror");
    exit;

}