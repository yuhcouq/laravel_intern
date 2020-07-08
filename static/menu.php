<?php
date_default_timezone_set('UTC');
$dashboardmenu = null;
$buynumbermenu = null;
$mynumbermenu = null;
$openticketmenu = null;
$supportticketmenu = null;
$addbalancemenu = null;
$myporofilemenu = null;
$loginregister =null;
$url = $_SERVER['REQUEST_URI'];
if(strstr($url, "index.php")) {$dashboardmenu = "active"; $headtext = $settings[0]["data"];}
else if(strstr($url, "buy-number.php")){$buynumbermenu = "active"; $headtext = "Thuê Số Mới";}
else if(strstr($url, "my-number.php")){$mynumbermenu = "active"; $headtext = "Số Của Tôi";  }
else if(strstr($url, "open-ticket.php")){$openticketmenu = "active"; $headtext = "Yêu Cầu Hỗ Trợ";}
else if(strstr($url, "support-tickets.php")){$supportticketmenu = "active"; $headtext = "Yêu Cầu Hỗ Trợ Của Tôi";}
else if(strstr($url, "add-balance.php")){$addbalancemenu = "active"; $headtext = "Nạp Tiền Vào Tài Khoản";}
else if(strstr($url, "my-profile.php")){$myporofilemenu ="active"; $headtext = "Thiết Lập Tài Khoản";}
else if(strstr($url, "login-register.php")){$loginregister ="active"; $headtext = "Đăng Kí / Đăng Nhập";}
else{$headtext = $settings[1]["data"];}

?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="index.php" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/apple-icon.png">
          </div>
        </a>
        <a href="index.php" class="simple-text logo-normal">
          <?php echo $settings[1]["data"]; ?>
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
              <p>Trang Chủ</p>
            </a>
          </li>
          <li class="<?php echo $buynumbermenu; ?>">
            <a href="buy-number.php">
              <i class="fas fa-phone-alt"></i>
              <p>Thuê Số Mới</p>
            </a>
          </li>
          <li class="<?php echo $mynumbermenu; ?>">
            <a href="my-number.php">
              <i class="fas fa-address-book"></i>
              <p>Số Của Tôi</p>
            </a>
          </li>
          <hr>
          <li class="<?php echo $openticketmenu; ?>">
            <a href="open-ticket.php">
              <i class="fas fa-ticket-alt"></i>
              <p>Yêu Cầu Hỗ Trợ</p>
            </a>
          </li>
          <li class="<?php echo $supportticketmenu; ?>">
            <a href="support-tickets.php">
              <i class="fas fa-envelope-open"></i>
              <p>Yêu Cầu Hỗ Trợ Của Tôi</p>
            </a>
          </li>
          <hr>
          <li class="<?php echo $addbalancemenu; ?>">
            <a href="add-balance.php">
              <i class="fas fa-wallet"></i>
              <p>Nạp Tiền Vào Tài Khoản</p>
            </a>
          </li>
          <?php
           
          ?>
          <?php 
          if($user){
            ?>
            <hr>
            <li class="<?php echo $myporofilemenu; ?>">
            <a href="my-profile.php">
              <i class="fas fa-user-tie"></i>
              <p>Thiết Lập Tài Khoản</p>
            </a>
          </li>
          <?php
             if($user["authority"] ==1){
                ?>
                <hr>
                 <li class="">
            <a href="admin/index.php">
              <i class="fas fa-user-lock"></i>
              <p>Admin Panel</p>
            </a>
          </li>
                <?php
            }
          ?>
          <li class="active-pro">
            <a href="logout.php">
              <i class="fas fa-sign-out-alt"></i>
              <p>Đăng Xuất</p>
            </a>
          </li>
            <?php
          }
          else{
              ?>
              <li class="active-pro <?php echo $loginregister; ?>">
            <a href="login-register.php">
              <i class="fas fa-sign-in-alt"></i>
              <p>Đăng Nhập / Đăng Kí</p>
            </a>
          </li>
              <?php
          }

          ?>
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
                    <span class="d-lg d-md-block">Số dư<?php if($user){echo ' ';
                      $resultuserbalance = $db->select("SELECT balance from user where id=".$user["id"]);  
                      $userbalance = $resultuserbalance[0]["balance"];
                      $balanceuser = number_format($userbalance);
                      echo $user["name"].': '.  $balanceuser; echo ' ₫';} else{ echo ": 0 ₫";} ?></span>
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