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
$settings = $db->select("SELECT * from settings");
 

?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo $settings[4]["data"]; ?>
  </title>
  <meta content="<?php echo $settings[26]["data"]; ?>" name="description">
  <meta content="<?php echo $settings[27]["data"]; ?>" name="keywords">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; ?>
      
    <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Tạo Yêu Cầu Hỗ Trợ</h5>
              </div>
              <div class="card-body ">

              <form method="post" action="inc/open-ticket.php">
    <div class="form-row">
        <div class="form-group col-md-6">
        <label >Họ và tên</label>
        <input type="name" class="form-control" readonly value="<?php echo $user["name"].' '.$user["surname"]; ?>">
        </div>
        <div class="form-group col-md-6">
        <label >Địa chỉ Email hay dùng</label>
        <input type="mail" class="form-control" readonly placeholder="<?php echo $user["username"]; ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Chủ Đề</label>
        <input name="subject" type="text" class="form-control">
    </div>
    <div class="form-group">
    <label>Lời nhắn</label>
    <textarea name="message" class="form-control"  rows="6"></textarea>
  </div>
    <div class="form-row">
        <div class="form-group col-md-8">
        <label> Liên Quan Tới Số Điện Thoại</label>
        <select name="relatedservice" class="form-control">
        <option value="0">Nope</option>
           <?php
          
          $querynumber = $db->query("SELECT number,id from number where user_id = ".$user['id']." and date > MONTH(NOW() - INTERVAL -1 MONTH) order by date desc");
          if ($querynumber === false) {
              return false;
          }
            
          while ($row = $querynumber->fetch_assoc()) {
             
              ?> <option value="<?php echo $row["id"]; ?>"><?php echo  $row["number"]; ?></option> <?php
          }
           ?>
        </select>
        </div>
        <div class="form-group col-md-4">
        <label>Mức Độ Ưu Tiên</label>
        <select name="priority" class="form-control">
            <option value="0">Thấp</option>
            <option value="1" selected>Bình Thường</option>
            <option value="2">Khẩn Cấp</option>
        </select>
        </div>
   
    </div>
    



                </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <button type="submit" class="btn btn-secondary btn-block mt-2">Gửi Ngay</button>
    </form>
    <?php 
      if($_GET){
        if($_GET["type"] == "none"){
          echo '<div class="alert alert-danger mt-3" role="alert">
          Please do not leave the subject or message blank.
        </div>';
        }
        elseif($_GET["type"] == "error"){
          echo '<div class="alert alert-danger mt-3" role="alert">
          Failed to open support request
        </div>';
        }
      }
    ?>
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
