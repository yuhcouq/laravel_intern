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
    <?php echo $settings[5]["data"]; ?>
  </title>
  <meta content="<?php echo $settings[30]["data"]; ?>" name="description">
  <meta content="<?php echo $settings[31]["data"]; ?>" name="keywords">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
     $querysupportcount= "SELECT count(*) FROM support where user_id=".$user["id"];
     $resultsupportcount = $db->select($querysupportcount);
    
    
    ?>
      
    <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Lịch Sử Yêu Cầu Hỗ Trợ</h5>
                <p class="card-category"><?php echo $resultsupportcount[0]["count(*)"]; ?> lần</p>
              </div>
              <div class="card-body ">
              <?php
              if( $resultsupportcount[0]["count(*)"] == 0){
                  ?> 
                    <img class="img-fluid rounded mx-auto d-block" src="assets/img/support-ticket.gif">
                    <h2 class=" text-primary display-4 mt-2 text-center">Ôi má ơi, thấy tui giỏi hông, chưa có cái nào luôn nè!</h2>
                
                  <?php
              }
              else{
                ?>              
              <div class="table-responsive">
              <table class="table">
                            <thead class=" text-primary">
                            <th>
                            Ngày
                            </th>
                            <th>
                            Chủ Đề
                            </th>
                            <th>
                            Liên Quan Đến Số
                            </th>
                            <th>
                            Trạng Thái 
                            </th>
                            <th class="text-right">
                                
                            </th>
                            </thead>
                            <tbody>
                              <?php 
                                 $querysupport = $db->query("SELECT * FROM support  where user_id =".$user["id"]." order by date desc");
                                 if ($querysupport === false) {
                                     return false;
                                 }
                               
                                 while ($row = $querysupport->fetch_assoc()) {
                                  ?>
                                     <td>
                                      <?php echo date('H:i d/m/Y', strtotime($row["date"])); ?>
                                      </td>
                                      <td>
                                      <?php echo $row["subject"]; ?>
                                      </td>
                                      <td>
                                      <?php if($row["relatedservice_id"] == 0){echo 'Yok';} else{ $resultnumber = $db->select("SELECT number FROM number where id=".$row["relatedservice_id"]);  echo $resultnumber[0]["number"]; } ?>
                                      </td>
                                      <td>
                                      <?php if($row["status"] ==1){ echo '<i style="color:green;" class="far fa-dot-circle"></i> Open'; } elseif($row["status"] == 2){ echo '<i style="color:gray;" class="far fa-dot-circle"></i> Closed';}elseif($row["status"] == 3){  echo '<i style="color:red;" class="far fa-dot-circle"></i> Customer Comment';} ?>
                                      </td>
                                      <td>
                                      <form method="post" action="show-ticket.php"><input type="hidden" name="ticketid" value="<?php echo $row["id"]; ?>">
                                      <button type="submit" class="btn btn-light float-right">Show</button></form>
                                      </td>
                                     
                                  </tr>
                                  <?php
                                }
                              ?>
                            <tr>
                               
                            </tbody>
                        </table>    
              </div>
              <?php } ?>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  
          
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
