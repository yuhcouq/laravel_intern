<?php
include_once("inc/config.php");
$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

if ($_POST) {
  
    $error = false;
    $errors = array();

  
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    $phone = $_POST["phone"];
    $adress = $_POST["adress"];

    $name = trim($name);
    $surname = trim($surname);
    $username = trim($username);
    $password1 = trim($password1);
    $password2 = trim($password2);
    $phone = trim($phone);



    if (empty($name)) {
      
        $error = true;
        $errors[] = 'Điền họ  của bạn.';
    }

    if (empty($surname)) {
      
        $error = true;
        $errors[] = 'Điền tên của bạn.';
    }

   
    if (empty($username)) {
       
        $error = true;
        $errors[] = 'Bạn chưa điền email.';
    }

    if (isset($_POST["termofuseok"])) {      
    }else{
        $error = true;
        $errors[] = 'Đồng ý với điều khoản sử dụng.';
    }
    if (empty($phone)) {
       
        $error = true;
        $errors[] = 'Bạn chưa điền số điện thoại.';
    }

    $a = $_POST["username"];
    $querymail= "select count(*) from user where username ='$username';";
    $resultmail = $db->select($querymail);
    $sonuc = $resultmail[0]["count(*)"];
    if($sonuc != "0"){
        $error = true;
        $errors[] = 'Email đã tồn tại trên hệ thống MekongSMS.';
    }
    
    if ($password1 != $password2) {
       
        $error = true;
        $errors[] = 'Mật khẩu không giống.';
    }

   
    if (strlen($password1) < 4) {
       
        $error = true;
        $errors[] = 'Mật khẩu tối thiểu từ 4 kí tự trở lên.';
    }


    if (!$error) {
        
        $name = $db->quote($name);
        $surname = $db->quote($surname);
        $username = $db->quote($username);
        $password = md5($password1);
        $phone = $db->quote($phone);
        $adress = $db->quote($adress);

        $query = "INSERT INTO user (name,surname,username,password,updated_at,adress,phone,balance,authority,city,country,postcode) VALUES ($name,$surname,$username,'$password',NOW(),$adress,$phone,6688,0,'','','');";
            $db->query($query);
        
            header("Location: login-register.php?type=success"); 
            exit;

    }
}

$settings = $db->select("SELECT * from settings");
 

?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo $settings[38]["data"]; ?>
  </title>
  <meta content="<?php echo $settings[36]["data"]; ?>" name="description">
  <meta content="<?php echo $settings[37]["data"]; ?>" name="keywords">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->

</head>
    <?php include 'static/menu.php'; ?>
      
    <div class="content">    
    <div class="row">
    <div class="register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="assets/img/apple-icon.png" alt=""/>
                        <h3><?php echo $settings[42]["data"]; ?></h3>
                        <p><b><?php echo $settings[43]["data"]; ?></b></p>
                        <?php
            if($_GET){
            $reqtype = $_GET["type"];
            if($reqtype == "guest"){
                echo '<div class="alert alert-danger" role="alert">
				Đăng Nhập hoặc Đăng Kí trước khi sử dụng chức năng.
            </div>';
            }
            else if($reqtype == "success"){
                echo '<div class="alert alert-success" role="alert">
                Chúc mừng, bạn đã đăng kí thành công! Bạn có thể đăng nhập ngay bây giờ!
            </div>';
                }
                else if($reqtype == "loginerror"){
                    echo '<div class="alert alert-secondary" role="alert">
                    Email hoặc mật khẩu sai. Bạn quên mật khẩu à? <a href="#" href="#" data-toggle="modal" data-target="#exampleModal">Click đây lấy lại mật khẩu.</a>
                </div>';
                    }
                    else if($reqtype == "mailsend"){
                        echo '<div class="alert alert-success" role="alert">
                        Mật khẩu mới đã được gửi đến email của bạn. Vui lòng kiểm tra kỹ trong hộp thư đến và kể cả spam.
                    </div>';
                        }
                        else if($reqtype == "nomail"){
                            echo '<div class="alert alert-danger" role="alert">
                            Email này chưa được đăng kí trên hệ thống.
                        </div>';
                            }
                    else if($reqtype == "number"){
                        echo '<div class="alert alert-danger" role="alert">
                        Để thuê số, bạn cần phải đăng kí thành viên, sau đó đăng nhập vào tài khoản.
                    </div>';
                        }
            }

            
             if ($_POST) {
                /**
                 * Hata durumunu kontrol et.
                 */
                if ($error) {
                    /**
                     * Eğer hata var ise,
                     * Toplam hata adedini bul.
                     * Ve ekrana yazdır.
                     */
                    $totalError = count($errors);
                    echo '<div class="alert alert-danger mt-2" role="alert">' . $totalError . ' lỗi đã xuất hiện. Kiểm tra kỹ lại lần nữa nhé.</div>';

                    /**
                     * Tek tek hataları ekrana yaz.
                     */
                    foreach ($errors as $err) {
                        echo '<div class="alert alert-warning" role="alert">' . $err . '</div>';
                    }
                }
            }
            ?>
                    </div>
                    
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Đăng Kí</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Đăng Nhập</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Đăng Kí Tài Khoản</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <form action="login-register.php" method="post">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Họ *" value="<?php echo $_POST["name"]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="surname" class="form-control" placeholder="Tên *" value="<?php echo $_POST["surname"]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password1" class="form-control" placeholder="Mật Khẩu *"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password2" class="form-control"  placeholder="Nhập Lại Mật Khẩu *" />
                                        </div>
                                    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="username" class="form-control" placeholder="Email Chính *" value="<?php echo $_POST["username"]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" minlength="5" maxlength="15" name="txtEmpPhone" class="form-control" placeholder="Số Điện Thoại *" value="<?php echo $_POST["phone"]; ?>" />
                                        </div>
                                        <div class="form-group">
                                        <input type="text" name="adress" class="form-control"  placeholder="Địa Chỉ (Tùy Chọn)" value="<?php echo $_POST["adress"]; ?>" />
                                        </div>
                                        <div class="form-group">
                                        
                                         <input type="checkbox" name="termofuseok"  value="ok" /> Tôi đồng ý với <a href="#" data-toggle="modal" data-target="#exampleModalScrollable">điều khoản sử dụng!</a>
                                      
                                        </div>
                                        <button type="submit" class="btnRegister" >Đăng Kí</button>
                                        </form>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Đăng Nhập</h3>
                                <div class="row register-form">
                                    <div class="col-md-12">
                                        <form action="login_check.php" method="post">
                                        <div class="form-group">
                                            <input type="email" name="username" class="form-control" placeholder="Email *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"  class="form-control" placeholder="Mật khẩu *" value="" />
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                        <button type="submit" class="btnRegister">Đăng Nhập</button>
                                       
                                        </div>
                                    </div>
                                    </form>

                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

           
    <style type="text/css">
        .register{
   
    margin-top: 3%;
    padding: 3%;
    width:100%;
    height:100%;
        }
        .register-left{
            text-align: center;
            color: black;
            margin-top: 4%;
        }
      
        .register-right{
            background: rgba(255,255,255,0.5);
            border-top-left-radius: 10% 50%;
            border-bottom-left-radius: 10% 50%;
        }
        .register-left img{
            margin-top: 15%;
            margin-bottom: 5%;
            width: 25%;
            -webkit-animation: mover 2s infinite  alternate;
            animation: mover 1s infinite  alternate;
        }
        @-webkit-keyframes mover {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }
        @keyframes mover {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }
        .register-left p{
            font-weight: lighter;
            padding: 12%;
            margin-top: -9%;
        }
        .register .register-form{
            padding: 10%;
            margin-top: 10%;
        }
        .btnRegister{
            float: right;
            margin-top: 10%;
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            background: #0062cc;
            color: #fff;
            font-weight: 600;
            width: 50%;
            cursor: pointer;
        }
        .register .nav-tabs{
            margin-top: 3%;
            border: none;
            background: #0062cc;
            border-radius: 1.5rem;
            width: 31%;
            float: right;
        }
        .register .nav-tabs .nav-link{
            padding: 2%;
            height: 34px;
            font-weight: 600;
            color: #fff;
            border-top-right-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
        }
        .register .nav-tabs .nav-link:hover{
            border: none;
        }
        .register .nav-tabs .nav-link.active{
            width: 131px;
            color: #0062cc;
            border: 2px solid #0062cc;
            border-top-left-radius: 1.5rem;
            border-bottom-left-radius: 1.5rem;
        }
        .register-heading{
            text-align: center;
            margin-top: 8%;
            margin-bottom: -15%;
            color: #000000;
        }
    </style>


    </div>

      </div>
            <?php include 'static/footer.php'; ?>
    </div>
  </div>


  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">I forgot my password !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="inc/reset-password.php">
      <div class="form-group">
        <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Please enter your e-mail address.">
      </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Confidentiality Agreement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo $settings[41]["data"]; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
