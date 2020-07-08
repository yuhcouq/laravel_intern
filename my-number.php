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

include 'inc/functions.php';
$recivemessage = false;

$lastgetnumber = $db->query("SELECT message,number_id,country_code,service_code,version FROM number where user_id =".$user["id"]." and message='STATUS_WAIT_CODE' or message='';");

if ($lastgetnumber === false) {
    return false;
}
while ($row = $lastgetnumber->fetch_assoc()) {
   $lastnumbermessage = $row["message"];
   $lastnumberid= $row["number_id"];
   $lastcountrycode=$row["country_code"];
   $lastservicecode=$row["service_code"];
   $version=$row["version"];

if($lastnumbermessage == "" || $lastnumbermessage == '$lastnumberid'){
  $querysmsapi= "SELECT * FROM smsapikey";
  $resultsmsapi = $db->select($querysmsapi);
  $smsapikey = $resultsmsapi[0]["apikey"];
  $smsapikey2 = $resultsmsapi[1]["apikey"];
  $smsapikey3 = $resultsmsapi[2]["apikey"];
  if($version=="1"){
    //status version1
    $getlastmessage = getmessage($lastcountrycode,$lastservicecode,$smsapikey,$lastnumberid);
    $sms=$getlastmessage["sms"];
    $response=$getlastmessage["response"];
  }elseif($version=="2"){
    //status version2
    $getlastmessage = getmessage2($smsapikey2,$lastnumberid);
    $sonuc = explode(":",$getlastmessage);
    if($sonuc[0]=="STATUS_OK"){
        $sms=$sonuc[1];
    }  
  }elseif($version=="3"){
    //status version3
    $getlastmessage = getmessage3($smsapikey3,$lastnumberid);
    $sonuc = explode(":",$getlastmessage);
      if($sonuc[0]=="STATUS_OK"){
          $sms=$sonuc[1];
      }
    }
  if($response == '3' || $getlastmessage == "STATUS_CANCEL"){
    $numbercountryservice = $db->select("Select country_code,service_code from number where number_id =".$lastnumberid);  
    $countrycode = $numbercountryservice[0]["country_code"];
    $servicecode = $numbercountryservice[0]["service_code"];
    
    $priceresult = $db->select("SELECT price.price FROM ((price INNER JOIN service ON service.id = price.serviceid)
    INNER JOIN country ON country.id = price.countryid) where (country.countrycode ='$countrycode' or country.countrycode2 ='$countrycode' or country.countrycode3 ='$countrycode') and (service.servicecode = '$servicecode' or service.servicecode2 = '$servicecode' or service.servicecode3 = '$servicecode');");
    $resultprice= $priceresult[0]["price"];
    $sorgu13 = "UPDATE user SET balance = balance + $resultprice WHERE id =".$user["id"].";";
                $db->query($sorgu13);

   $sorgu14 = "Delete from number WHERE number_id = $lastnumberid;";
   $db->query($sorgu14);
   
   $recivemessage = true;
                        
  }else{
    $sorgu1 = "UPDATE number SET message ='$sms' WHERE number_id = $lastnumberid;";
                $db->query($sorgu1);
    $sms='';
  }

header("Refresh: 5; url=my-number.php");
}else{

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
    <?php echo $settings[3]["data"]; ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta content="<?php echo $settings[26]["data"]; ?>" name="description">
  <meta content="<?php echo $settings[27]["data"]; ?>" name="keywords">
  
</head>
    <?php include 'static/menu.php'; 
         $querynumbercount= "SELECT count(*) FROM number where user_id=".$user["id"];
         $resultnumbercount = $db->select($querynumbercount);
    
    
    ?>
      
    <div class="content">
    <?php
    
       if($_GET){
        if($_GET["type"] == "cancel"){
            echo '<div class="alert alert-primary" role="alert">
            Số đã hủy, tiền sẽ được trả về tài khoản của bạn. Thôi, đừng rầu, thuê số mới nghen? <a style="color:black;" href="buy-number.php">OK! Thuê mới luôn</a>
        </div>';
        }elseif($_GET["type"]== "error"){
            echo '<div class="alert alert-danger" role="alert">
            Số này không được hủy. Thử lại cái coi!/The number could not be canceled. Please try again.
        </div>';
        }
        elseif($_GET["type"]== "ok"){
          echo '<div class="alert alert-success" role="alert">
          Thuê số đã thành công, bạn chờ chút trang web sẽ tự động tải lại sau mỗi 5s để gửi trả thông tin mã code về cho bạn.
      </div>';
      }
    }else{
      if($recivemessage == true){
        echo '<div class="alert alert-primary" role="alert">
        Không có tin nhắn nào tới hết trơn á, và số thì đã được hủy. Đừng có lo, tiền sẽ được hoàn trả về tài khoản của bạn. Thuê số mới hen? <a style="color:black;" href="buy-number.php">OK! Thuê số khác</a>
    </div>';
      }
    } 
    ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Các Số Đã Dùng</h5>
                <p class="card-category"><?php echo $resultnumbercount[0]["count(*)"]; ?> số</p>
              </div>
              <div class="card-body ">
              <?php if($resultnumbercount[0]["count(*)"] == 0){
                     ?> 
                     <img class="img-fluid rounded mx-auto d-block" src="assets/img/no-number.gif">
                     <h2 class=" text-primary display-4 mt-2 text-center">Mèn đét ơi!No number you bought. <a href="buy-number.php">Click vào đây</a> để mua số mới.</h2>
                 
                     <?php
              }
              else{
                  ?>
                       <div class="table-responsive">
              <table class="table">
                            <thead class=" text-primary">
                            <th >
                            Ngày
                            </th>
                            <th>
                            Nước
                            </th>
                            <th>
                            Dịch Vụ 
                            </th>
                            <th>
                            Số 
                            </th>
                            <th >
                            Mã Code 
                            </th>
                           
                            </thead>
                            <tbody>
                            <?php 
                              $result = $db->query("SELECT service.servicename, service.serviceicon,country.countryname,number.number,number.message,number.date,number.number_id,number.service_code,number.country_code,number.version FROM ((number INNER JOIN service ON service.servicecode = number.service_code or service.servicecode2 = number.service_code or service.servicecode3 = number.service_code) INNER JOIN country ON country.countrycode = number.country_code or country.countrycode2 = number.country_code or country.countrycode3 = number.country_code) where number.user_id = ".$user["id"]." ORDER by number.id DESC;");
                               if ($result === false) {
                                   return false;
                               }
                               while ($row = $result->fetch_assoc()) {
                                ?>
                                  <tr>
                                <td>
                                <?php echo date('H:i d/m/Y', strtotime($row["date"])); ?>
                                </td>
                                <td>
                                <img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="assets/img/flag/<?php echo $row['countryname']; ?>.png"> <?php echo $row["countryname"]; ?>
                                </td>
                                <td>
                                <i class="<?php echo $row["serviceicon"]; ?>"></i> <?php echo $row["servicename"]; ?>
                                </td>
                                <td>
                                <?php echo $row["number"]; ?>
                                </td>
                                <td>
                                <?php
                                $numberid=$row["number_id"];
                                $countrycode=$row["country_code"];
                                $servicecode=$row["service_code"];
                                if($row["message"]=="STATUS_CANCEL"){
                                  echo '<b> Cancel Number</b>';
                                }
                                else if($row["message"]==""||$row["message"]=='$numberid'){
                                  ?>
                                    <b> Chờ code xíu</b> &nbsp
                                    <form method="POST" action="inc/cancel-number.php">
                                      <input type="hidden" name="cancelnumber" value="<?php echo $row["number_id"]; ?>"> 
                                      <input type="hidden" name="cancelversion" value="<?php echo $row["version"]; ?>"> 
                                      <input type="hidden" name="cancelcountry" value="<?php echo $countrycode; ?>"> 
                                      <input type="hidden" name="cancelservice" value="<?php echo $servicecode; ?>"> 
                                      <button type="submit" class="btn btn-info mt-1">Hủy</button>
                                    </form>
                                    
                                  <?php
                                }
                                else{
                                  echo '<b>'.$row["message"].'</b>';
                                }
                                ?>
                                </td>
                            </tr>
                                <?php
                              }

                            ?>
                          
                           
                            </tbody>
                        </table>    
              </div>
                  <?php
              } ?>
           
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
