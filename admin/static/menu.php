<?php
date_default_timezone_set('UTC');
$dashboardmenu = null;
$ulkemenu = null;
$servismenu = null;
$fiyatmenu = null;
$kullaniciyonetimimenu = null;
$bakiyekayitlarimenu = null;
$alinannumaralarmenu = null;
$openticketmenu = null;
$closeticketmenu = null;
$loginregister =null;
$useraddbalancemenu = null;
$seosettingsmenu = null;
$generalsettingsmenu = null;  
$gitfcodemenu = null;
$confidentialitymenu = null;
$url = $_SERVER['REQUEST_URI'];
if(strstr($url, "index.php")) {$dashboardmenu = "active"; $headtext = "Tổng Quan";}
else if(strstr($url, "add-country.php")){$ulkemenu = "active"; $headtext = "Thêm Quốc Gia";}
else if(strstr($url, "add-service.php")){$servismenu = "active"; $headtext = "Thêm Dịch Vụ";  }
else if(strstr($url, "prices.php")){$fiyatmenu = "active"; $headtext = "Add Price";}
else if(strstr($url, "user-managament.php")){$kullaniciyonetimimenu = "active"; $headtext = "Quản Lý Người Dùng";}
else if(strstr($url, "balance-log.php")){$bakiyekayitlarimenu = "active"; $headtext = "Lịch Sử Nạp Tiền Người Dùng";}
else if(strstr($url, "received-numbers.php")){$alinannumaralarmenu ="active"; $headtext = "Các Số Đã Sử Dụng";}
else if(strstr($url, "open-support")){$openticketmenu ="active"; $headtext = "Mở Yêu Cầu Hỗ Trợ";}
else if(strstr($url, "closed-support.php")){$closeticketmenu ="active"; $headtext = "Yêu Cầu Hỗ Trợ Hoàn Tất";}
else if(strstr($url, "user-add-balance.php")){$useraddbalancemenu ="active"; $headtext = "Nạp Số Dư Cho Người Dùng";}
else if(strstr($url, "seo-settings.php")){$seosettingsmenu ="active"; $headtext = "Page Seo Settings";}
else if(strstr($url, "general-settings.php")){$generalsettingsmenu ="active"; $headtext = "Thiết Lập Hệ Thống";}
else if(strstr($url, "giftcode.php")){$gitfcodemenu ="active"; $headtext = "Promo Code";}
else if(strstr($url, "confidentiality-agreement.php")){$confidentialitymenu ="active"; $headtext = "Điều Khoản Người Dùng";}
else{$headtext = "Summary";}

?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
 
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="index.php" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/apple-icon.png">
          </div>
        </a>
        <a href="index.php" class="simple-text logo-normal">
         Admin Panel
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?php echo $dashboardmenu; ?>">
            <a href="index.php">
              <i class="nc-icon nc-bank"></i>
              <p>Tổng Quan</p>
            </a>
          </li>
          <li class="<?php echo $ulkemenu; ?>">
            <a href="add-country.php">
              <i class="fas fa-globe-europe"></i>
              <p>Thêm Quốc Gia</p>
            </a>
          </li>
          <li class="<?php echo $servismenu; ?>">
            <a href="add-service.php">
              <i class="fas fa-concierge-bell"></i>
              <p>Thêm Dịch Vụ</p>
            </a>
          </li>
          <li class="<?php echo $fiyatmenu; ?>">
            <a href="prices.php">
              <i class="fas fa-tag"></i>
              <p>Điều Chỉnh Giá</p>
            </a>
          </li>
          <hr>
          <li class="<?php echo $kullaniciyonetimimenu; ?>">
            <a href="user-managament.php">
              <i class="fas fa-users"></i>
              <p>Quản Lý Người Dùng</p>
            </a>
          </li>
          <li class="<?php echo $bakiyekayitlarimenu; ?>">
            <a href="balance-log.php">
              <i class="fas fa-hand-holding-usd"></i>
              <p>Lịch Sử Nạp Tiền</p>
            </a>
          </li>
          <li class="<?php echo $alinannumaralarmenu; ?>">
            <a href="received-numbers.php">
              <i class="fas fa-list-ol"></i>
              <p>Lịch Sử Nhận Code</p>
            </a>
          </li>
          <hr>
          <li class="<?php echo $openticketmenu; ?>">
            <a href="open-support.php">
              <i class="fas fa-ticket-alt"></i>
              <p>Mở Yêu Cầu Hỗ Trợ</p>
            </a>
          </li>
          <li class="<?php echo $closeticketmenu; ?>">
            <a href="closed-support.php">
              <i class="fas fa-check-double"></i>
              <p>Đóng Yêu Cầu Hỗ Trợ</p>
            </a>
          </li>
          <hr>
          <li class="<?php echo $useraddbalancemenu; ?>">
            <a href="user-add-balance.php">
              <i class="fas fa-funnel-dollar"></i>
              <p>Nạp Tiền Người Dùng</p>
            </a>
          </li>
          <li class="<?php echo $gitfcodemenu; ?>">
            <a href="giftcode.php">
              <i class="fas fa-cookie-bite"></i>
              <p>Promo Code</p>
            </a>
          </li>
          <hr>
          <li class="<?php echo $confidentialitymenu; ?>">
            <a href="confidentiality-agreement.php">
              <i class="far fa-file-alt"></i>
              <p>Điều Khoản</p>
            </a>
          </li>
            <li class="<?php echo $seosettingsmenu; ?>">
            <a href="seo-settings.php">
              <i class="fas fa-cog"></i>
              <p>Thiết Lập Trang</p>
            </a>
          </li>
            <li class="<?php echo $generalsettingsmenu; ?>">
            <a href="general-settings.php">
              <i class="fas fa-cogs"></i>
              <p>Thiết Lập Tổng Quát</p>
            </a>
          </li>
          <hr>
          <li class="active-pro">
            <a href="../index.php">
              <i class="fas fa-sign-out-alt"></i>
              <p>Quay Về Trang Chủ</p>
            </a>
          </li>
         
            
          <li class="active-pro">
            <a href="../logout.php">
              <i class="fas fa-sign-out-alt"></i>
              <p>Đăng Xuất</p>
            </a>
          </li>
          
          <!--<li class="active-pro">
            <a href="./upgrade.html">
              <i class="nc-icon nc-spaceship"></i>
              <p>Sign Out</p>
            </a>
          </li>-->
        </ul>
      </div>
    </div>
    
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="<?php echo $url ?>"><?php echo $headtext; ?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link btn-rotate" href="my-profile.php">
                  
                  <p>
                    <span class="d-lg d-md-block">Xin Chào <?php if($user){ 
                      $resultuserbalance = $db->select("SELECT balance from user where id=".$user["id"]);  
                      $userbalance = $resultuserbalance[0]["balance"];
                      $balanceuser=number_format($userbalance);
                      echo $user["name"].', '.'Số Dư : '.  $balanceuser.' ₫';} else{ echo "Số Dư : 0 ₫";} ?></span>
                  </p>
                </a>
              </li>
             <?php if($user){
                 ?>
                <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Cài Đặt</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="my-profile.php">Chỉnh Sửa Tài Khoản</a>
                  <a class="dropdown-item" href="logout.php">Đăng Xuất</a>
                </div>
              </li>
              <?php
             }
             ?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->