<?php
 
include_once("inc/config.php");
$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];
if(empty($user)){
  header("Location: login-register.php?type=guest"); 
  exit;
}


if($_POST){
  $proctype= $_POST["proctype"];
  if($proctype == 1){
   $adress1 = $_POST["adress"];
   $tel1 = $_POST["tel"];
   $city1 = $_POST["city"];
   $country1 = $_POST["country"];
   $postcode1 = $_POST["postcode"];

   $sorgu123 = "Update user set adress ='".$adress1."', city ='".$city1."',country ='".$country1."',postcode ='".$postcode1."',phone ='".$tel1."' where id=".$user["id"];
   $db->query($sorgu123);


  }
  else if($proctype == 2){
    $password1 = $_POST["password2"];
    $password2 = $_POST["password1"];
    $error = false;
    $errors = array();
    if ($password1 != $password2) {
       
      $error = true;
      $errors[] = 'Passwords do not match.';  
  }else{
    $password1 = trim($password1);
    $password1 = md5($password1);

    $sorgu1234 = "Update user set password ='".$password1."' where id=".$user["id"];
    $db->query($sorgu1234);
    header("Location: login-register.php"); 
    exit;
  }
  }
}


  $querydb1= "SELECT phone,adress,city,country,postcode FROM user where id =".$user["id"];
  $resultdb1 = $db->select($querydb1);
  $phonenumber = $resultdb1[0]["phone"];
  $adress = $resultdb1[0]["adress"];
  $city = $resultdb1[0]["city"];
  $country = $resultdb1[0]["country"];
  $postcode = $resultdb1[0]["postcode"];

  $querynumbercount= "SELECT count(*) FROM number where user_id=".$user["id"];
  $resultnumbercount = $db->select($querynumbercount);
  $mynumbers = $resultnumbercount[0]["count(*)"]; 
  $querysupportcount= "SELECT count(*) FROM support where user_id=".$user["id"];
  $resultsupportcount = $db->select($querysupportcount);
  $tickets = $resultsupportcount[0]["count(*)"];
  
  $settings = $db->select("SELECT * from settings");

  ?>
  <!DOCTYPE html>
  <html lang="en">
  
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      <?php echo $settings[7]["data"]; ?>
    </title>
    <meta content="<?php echo $settings[34]["data"]; ?>" name="description">
  <meta content="<?php echo $settings[35]["data"]; ?>" name="keywords">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
   
    ?>
      
    <div class="content">
    <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="assets/img/damir-bosnjak.jpg">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="assets/img/logo-small.png" >
                    <h5 class="title"><?php echo $user["name"].' '.$user["surname"]; ?></h5>
                  </a>
                </div>
                 <p class="description text-center">
                 Trở Thành Thành Viên Ngày
                  <br> <?php echo date('H:i d/m/Y', strtotime($user["created_at"])) ; ?>
                  
                </p>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                      <h5><?php echo $mynumbers; ?>
                        <br>
                        <small>Số Đã Dùng</small>
                      </h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5><?php echo $tickets; ?>
                        <br>
                        <small>Yêu Cầu Hỗ Trợ</small>
                      </h5>
                    </div>
                    <div class="col-lg-3 mr-auto">
                      <h5><?php echo $userbalance; ?> ₫
                        <br>
                        <small>Số Dư</small>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Số Thuê Gần Đây Nhất</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled team-members">

                  <?php 
                 
                  $result = $db->query("Select number.number,country.countryname, service.serviceicon from number inner join country on country.countrycode = number.country_code inner join service on service.servicecode = number.service_code where number.user_id =".$user["id"]." order by number.date desc limit 1;");
                  if ($result === false) {
                      return false;
                  }
                  while ($row = $result->fetch_assoc()) {
                  ?>
                     <li>
                    <div class="row">
                      <div class="col-md-2 col-2">
                        <div class="avatar">
                        <img src="assets/img/flag/<?php echo $row["countryname"]; ?>.png" alt="<?php echo $row["countryname"]; ?>" class="img-circle img-no-padding img-responsive">
                       
						</div>
                      </div>
                      <div class="col-md-7 col-7">
                        <?php echo $row["number"]; ?>
                      </div>
                      <div  class="col-md-3 col-3 text-right">
                         <i class="mt-1 mr-3 <?php echo $row["serviceicon"]; ?>"></i>
                      </div>
                    </div>
                  </li>
               
               <?php
                  }
               ?>
                </ul>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Lần Nạp Tiền Gần Nhất</h4>
              </div>
              <div class="card-body">
              <ul class="list-unstyled team-members">

              <?php 

              $result = $db->query("Select * from log where user_id =".$user["id"]." order by date desc limit 3;");
              if ($result === false) {
                  return false;
              }
              while ($row = $result->fetch_assoc()) {
              ?>
                <li>
                <div class="row">
                  <div class="col-md-2 col-2">
                    <div class="avatar">
                    <img src="assets/img/logo-small.png"  class="img-circle img-no-padding img-responsive">
                    </div>
                  </div>
                  <div class="col-md-7 col-7">
                    Add Balance $<?php echo $row["price"]; ?>
                    <br />
                    <span class="text-muted">
                      <small><?php echo  date('H:i d/m/Y', strtotime($row["date"]));  ?></small>
                    </span>
                  </div>
                  <div class="col-md-3 col-3 text-right">
                    <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="mt-1 fas fa-wallet"></i></btn>
                  </div>
                </div>
              </li>

              <?php
              }
              ?>
              </ul>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Chỉnh Sửa Tài Khoản</h5>
              </div>
              <div class="card-body">
                <form action ="my-profile.php" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Địa Chỉ Email</label>
                        <input type="email" readonly class="form-control" value="<?php echo $user["username"]; ?>">
                      </div>
                    </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" readonly value="<?php echo $user["name"]; ?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Họ</label>
                        <input type="text" class="form-control" readonly value="<?php echo $user["surname"]; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                      <label>Số Điện Thoại</label>
                        <input type="tel" name="tel" class="form-control" placeholder="Số hay dùng nhất" value="<?php echo $phonenumber; ?>">
                      </div>
                    </div>
                    </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Địa Chỉ</label>
                        <input type="text" name="adress" class="form-control" placeholder="Địa chỉ hiện tại" value="<?php echo $adress; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Thành Phố</label>
                        <input type="text" name="city" class="form-control" placeholder="Thành Phố" value="<?php echo $city; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Quốc Gia</label>
                        <input type="text" name="country" class="form-control" placeholder="Quốc Gia" value="<?php echo $country; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Zip Code</label>
                        <input type="number" name="postcode" class="form-control" placeholder="Zip Code" value="<?php echo $postcode; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                    <input type="hidden" name="proctype" value="1">
                      <button type="submit" class="btn btn-primary btn-round">Cập Nhật Tài Khoản</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Cập Nhật Mật Khẩu</h5>
              </div>
              <div class="card-body ">
              <form action ="my-profile.php" method="post" >
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Nhập Mật Khẩu Mới</label>
                        <input name="password1" type="password" class="form-control">
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Nhập Lại Mật Khẩu Mới</label>
                        <input name="password2" type="password" class="form-control">
                      </div>
                    </div>
                    </div>
    
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <input type="hidden" name="proctype" value="2">
                      <button type="submit" class="btn btn-primary btn-round">Cập Nhật</button>
                  <?php    
                  if ($_POST) {
            
                    if ($error) {            
                    foreach ($errors as $err) {
                        echo '<div class="alert alert-warning mt-2" role="alert">' . $err . '</div>';
                    }
                }
            } ?>
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
            <?php include 'static/footer.php'; ?>
    </div>
  </div>

</body>

</html>
