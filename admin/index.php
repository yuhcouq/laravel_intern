<?php
include_once("../inc/config.php");
$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];

if($user["authority"] ==1){
    
}
else{
    header("Location: ../index.php"); 
    exit;
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$support = $db->query("SELECT * from support");
if ($support === false) {
    return false;
}
$opensupport = 0;
$todaysuport = 0;
$last7support = 0;
$monthsupport = 0;
$allsupport = 0;
while ($row = $support->fetch_assoc()) {
    if($row["status"] == 1 || $row["status"] == 3){
        $opensupport = $opensupport +1;
    }
    if(date("Y-m-d",strtotime($row["date"])) == date("Y-m-d")){
        $todaysuport = $todaysupport +1;
    }
    if(date("Y-m-d",strtotime('-7 days')) <= date("Y-m-d",strtotime($row["date"])) ){
       $last7support = $last7support +1;
    }
    if(date("Y-m",strtotime($row["date"])) == date("Y-m")){
        $monthsupport = $monthsupport +1;
    }
    $allsupport = $allsupport +1;
}

$userresult = $db->query("SELECT * from user");
if ($userresult === false) {
    return false;
}
$userbalance = 0;
$totaluser = 0;
$todayuser = 0;
$last7user = 0;
$monthuser = 0;
while ($row = $userresult->fetch_assoc()) {
    if($row["balance"] > 0){
        $userbalance = $row["balance"] + $userbalance;
    }
    if(date("Y-m-d",strtotime($row["created_at"])) == date("Y-m-d")){
        $todayuser = $todayuser +1;
    }
    if(date("Y-m-d",strtotime('-7 days')) <= date("Y-m-d",strtotime($row["created_at"])) ){
        $last7user = $last7user +1;
     }
     if(date("Y-m",strtotime($row["created_at"])) == date("Y-m")){
        $monthuser = $monthuser +1;
    }
    $totaluser = $totaluser +1;
}
$userbalance1 = $userbalance;

$numberresult = $db->query("SELECT * from number");
if ($numberresult === false) {
    return false;
}
$todaynumber = 0;
$last7number = 0;
$monthnumber = 0;
$totalnumber =0;
while ($row = $numberresult->fetch_assoc()) {
   
    if(date("Y-m-d",strtotime($row["date"])) == date("Y-m-d")){
        $todaynumber = $todaynumber +1;
    }
    if(date("Y-m-d",strtotime('-7 days')) <= date("Y-m-d",strtotime($row["date"])) ){
        $last7number = $last7number +1;
     }
     if(date("Y-m",strtotime($row["date"])) == date("Y-m")){
        $monthnumber = $monthnumber +1;
    }
   $totalnumber = $totalnumber +1;
}
$logresult = $db->query("SELECT * from log where type=1 or type=2");
if ($logresult === false) {
    return false;
}
$todaylog = 0;
$last7log = 0;
$monthlog = 0;
$totallog =0;
while ($row = $logresult->fetch_assoc()) {
   
    if(date("Y-m-d",strtotime($row["date"])) == date("Y-m-d")){
        $todaylog = $row["price"] + $todaylog;
    }
    if(date("Y-m-d",strtotime('-7 days')) <= date("Y-m-d",strtotime($row["date"])) ){
        $last7log = $row["price"] + $last7log;
     }
     if(date("Y-m",strtotime($row["date"])) == date("Y-m")){
      $monthlog =  $row["price"] + $monthlog;
    }
   $totallog =  $row["price"] + $totallog;
}

?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <title>
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 

  
</head>
    <?php include 'static/menu.php'; 
    
    
    ?>
      
    <div class="content">
        <div class="row">
        
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-mobile-alt text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Số Dư Khả Dụng</p>
                      <p class="card-title">
                      <?php 
                       $querysmsapi= "SELECT * FROM smsapikey";
                       $resultsmsapi = $db->select($querysmsapi);
                       $smsapikey = $resultsmsapi[0]["apikey"];
                       $smsapikey2 = $resultsmsapi[1]["apikey"];
                       $smsapikey3 = $resultsmsapi[2]["apikey"];
                       include "../inc/functions.php";
                       $bakiye = getBalance($smsapikey);
                        echo 'smspva: '.$bakiye;
                      ?>$
                      <br>
                      <?php
                        $bakiye2 = getBalance2($smsapikey2);
                          echo '5sim: '.$bakiye2;
                      ?>₽<br>
                      <?php
                        $bakiye3 = getBalance3($smsapikey3);
                          echo 'sim-active: '.$bakiye3;
                      ?>₽
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a style="text-decoration:none; color:gray;" href="https://sms-activate.ru/en/"><i class="fas fa-shopping-cart"></i>Nạp Tiền</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Yêu Cầu Đang Chờ</p>
                      <p class="card-title"> <?php echo $opensupport; ?>&nbsp
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <a style="text-decoration:none; color:gray;" href="open-support.php"><i class="fas fa-plus"></i>Trả Lời</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                    <p class="card-category">Số Dư Người Dùng</p>
                      <p class="card-title"><?php
                      $balanceuser1=number_format($userbalance1); 
                      echo $balanceuser1; ?> ₫
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <a style="text-decoration:none; color:gray;" href="balance-log.php"><i class="fas fa-hand-holding-usd"></i>Xem Lịch Sử</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Số Người Dùng</p>
                      <p class="card-title"><?php echo $totaluser; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <a style="text-decoration:none; color:gray;" href="user-managament.php"><i class="fas fa-users"></i>Quản Lý Người Dùng</a>
                </div>
              </div>
            </div>
          </div>



        </div>
          
        <div class="row mt-5">
        <div class="col-md-12">

        <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Hôm Nay
              </button>
            </h2>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
            
            <div class="card">
            <div class="card-body">
              <b>Số Điện Thoại Được Thuê</b> : <?php echo $todaynumber; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Người Dùng Đã Đăng Kí</b> : <?php echo $todayuser; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Số Yêu Cầu Được Mở</b> : <?php echo $todaysuport; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Tổng Số Dư Nạp Vào</b> : <?php echo $todaylog; ?>
            </div>
          </div>
          
          
         
   
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Last 7 Days
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
             
            <div class="card">
            <div class="card-body">
              <b>Number Sold</b> : <?php echo $last7number; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Registered Person</b> : <?php echo $last7user; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Support Request Opened</b> : <?php echo $last7support; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Total Loaded Balance</b> : <?php echo $last7log; ?>
            </div>
          </div>
         

            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
              This Month
              </button>
            </h2>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
             
            <div class="card">
            <div class="card-body">
              <b>Number Sold</b> : <?php echo $monthnumber; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Registered Person</b> : <?php echo $monthuser; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Support Request Opened</b> : <?php echo $monthsupport; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Total Loaded Balance</b> : <?php echo $monthlog; ?>
            </div>
          </div>
          

            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingFour">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              All Time
              </button>
            </h2>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
            <div class="card-body">
             
            <div class="card">
            <div class="card-body">
              <b>Number Sold</b> : <?php echo $totalnumber; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Registered Person</b> : <?php echo $totaluser; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Support Request Opened</b> : <?php echo $allsupport; ?>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <b>Total Loaded Balance</b> : <?php echo $totallog; ?>
            </div>
          </div>
         

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
