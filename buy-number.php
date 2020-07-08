
<head>
    <script>
function changecountry() {
    var gender = document.querySelector('input[name = "options"]:checked').value;
    var strUser = gender
          
function post(url, method) {
    method = method || "post"; // post (set to default) or get

    // Create the form object
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", url);

    // For each key-value pair
    
        var hiddenField = document.createElement("input");  
        hiddenField.setAttribute("type", "hidden"); 
        hiddenField.setAttribute("name", "countrycode1");
        hiddenField.setAttribute("value", strUser);
        // append the newly created control to the form
        form.appendChild(hiddenField); 
    

    document.body.appendChild(form); // inject the form object into the body section
    form.submit();
}
javascript:post('buy-number.php', 'post');


}
</script>
</head>
<?php
include_once("inc/config.php");
$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];

$selectedcountry = 'qw';
if($_POST){
    $selectedcountry = $_POST["countrycode1"];
}
if($_GET){
    $selectedcountry = $_GET["country"];
}
$selected2 = "SELECT countrycode2 FROM country where countrycode = '$selectedcountry' or countrycode2 = '$selectedcountry' or countrycode3 = '$selectedcountry'";
$selectedapi2 = $db->select($selected2);
$selectedcountry2 = $selectedapi2[0]["countrycode2"];
$selected3 = "SELECT countrycode3 FROM country where countrycode = '$selectedcountry' or countrycode2 = '$selectedcountry' or countrycode3 = '$selectedcountry'";
$selectedapi3 = $db->select($selected3);
$selectedcountry3 = $selectedapi3[0]["countrycode3"];

$querysmsapi= "SELECT * FROM smsapikey";
$resultsmsapi = $db->select($querysmsapi);
$smsapikey = $resultsmsapi[0]["apikey"];
$smsapikey2 = $resultsmsapi[1]["apikey"];
$smsapikey3 = $resultsmsapi[2]["apikey"];

$settings = $db->select("SELECT * from settings");
 

?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo $settings[2]["data"]; ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta content="<?php echo $settings[24]["data"]; ?>" name="description">
  <meta content="<?php echo $settings[25]["data"]; ?>" name="keywords">
  
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
    include 'inc/functions.php';
    ?>
      
    <div class="content">
            <?php
                if($_GET){
                    if($_GET["type"] == "balance"){
                        echo '<div class="alert alert-primary" role="alert">
                        Tài khoản của bạn không đủ thuê số mới. Vui lòng nạp thêm tài khoản, <a style="color:black;" href="add-balance.php">clicking vào đây.</a>
                    </div>';
                    }elseif($_GET["type"]== "nonumber"){
                        echo '<div class="alert alert-primary" role="alert">
                        Tiếc ghê, có lỗi gì đó đã xảy ra nên không thể sử dụng số này. Vui lòng chọn số mới.
                    </div>';
                    }
                }

            ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Các Nước Đang Được Hỗ Trợ Nhận Code SMS</h5>
                        <?php
                            
                        ?>
                        <p class="card-category"><?php $resultcountcountry = $db->select("SELECT count(*) FROM country");  echo $resultcountcountry[0]["count(*)"] ?> Quốc Gia</p>
                    </div>
                    <div class="card-body text-center ml-3 mr-3 mb-3">
                    <div class="btn-group flex-wrap btn-group-toggle" data-toggle="buttons">

                        <?php
                            $countryresult = $db->query("Select * from country order by countryname asc;");
                            if ($countryresult === false) {
                                return false;
                            }
                        
                            while ($row = $countryresult->fetch_assoc()) {
                            

                        if($selectedcountry == $row['countrycode']||$selectedcountry == $row['countrycode2']||$selectedcountry == $row['countrycode3']){?>
                                <label class="btn btn-primary active ml-3">
                                  <input type="radio"><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                                </label>
                              <?php
                          }else{
                            if($row['countrycode']!=""){ ?>  
                               <label class="btn btn-secondary ml-3">
                                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                              </label>
                               
                               <?php }
                            elseif($row["countrycode2"]!=""){ ?>
                                <label class="btn btn-secondary ml-3">
                                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode2']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                                </label>
                               <?php }
                            else{
                                ?>
                                <label class="btn btn-secondary ml-3">
                                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode3']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                                  </label>
                               <?php }
                                        }
                            }

                        ?>

                            
    
                        </div>
                    
                    </div>
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Dịch Vụ Đang Được Hỗ Trợ Nhận Code SMS</h5>
                        <p class="card-category"><?php $resultcountservice = $db->select("SELECT count(*) from price Inner join country on country.id = price.countryid where country.countrycode = '$selectedcountry' or country.countrycode2 = '$selectedcountry' or country.countrycode3 = '$selectedcountry'");  echo $resultcountservice[0]["count(*)"]; ?> dịch vụ - Lưu ý: Dịch vụ nào mà ko có trong danh sách, hãy chọn OTHER nhé</p> 
                    </div>
                    <div class="card-body ml-3 mr-3 mb-3">
                            <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                Dịch Vụ
                                </th>
                                <th>
                                Số Lượng Đang Có
                                </th>
                                <th>
                                Giá
                                </th>
                                <th class="text-right">
                                   
                                </th>
                                </thead>
                                <tbody>

                                <?php    
                                $serviceresult = $db->query("SELECT service.servicecode,service.servicecode2,service.servicecode3, service.servicename,service.serviceicon, price.price, price.version
                                FROM ((price
                                INNER JOIN service ON service.id = price.serviceid)
                                INNER JOIN country ON country.id = price.countryid) where country.countrycode = '$selectedcountry' or country.countrycode2 = '$selectedcountry' or country.countrycode3 = '$selectedcountry' order by service.servicename asc,price.version desc;");
                                if ($serviceresult === false) {
                                    return false;
                                } 
                                $pcs2 = stock2($selectedcountry2,$smsapikey2);
                                $pcs3 = stock3($selectedcountry3,$smsapikey3);
                                while ($row = $serviceresult->fetch_assoc()) {
                                    $pcs = stock($selectedcountry,$row["servicecode"],$smsapikey);
                                    ?>
                                <tr>
                                    <td>
                                    <i class="<?php echo $row["serviceicon"]; ?>"></i>&nbsp <?php echo $row["servicename"]; ?>
                                    </td>
                                    <td>
                                    <?php  
                                    //version1
                                    if($row["version"]=="1"){
                                        if($pcs["online"]==null){
                                            echo "0 ";
                                        }else{
                                        echo $pcs["online"]." "; 
                                        }
                                        echo "số " ;
                                    }  
                                    //version2
                                    if($row["version"]=="2"){
                                        if($pcs2[$row["servicecode2"]]==null){
                                            echo "0 ";
                                        }else{
                                        echo $pcs2[$row["servicecode2"]]; 
                                        }
                                        echo " số " ;
                                    }  
                                    //version3
                                    if($row["version"]=="3"){
                                        if($pcs3[$row["servicecode3"]]==null){
                                            echo "0";
                                        }else{
                                        echo $pcs3[$row["servicecode3"]]; 
                                        }
                                        echo " số";
                                    }     
                                    ?>
                                    </td>
                                    <td>
                                    <?php 
                                    $price=number_format($row["price"]);
                                    echo $price; ?> ₫ 
                                    </td>
                                    <td class="text-right">
                                    <form method="post" action="inc/buy-number.php" style="display: inline">
                                    <?php 
                                    //version3
                                    if($row["version"]==3){ 
                                    ?>
                                        <input type="hidden" name="countrycode" value="<?php echo $selectedcountry3; ?>">
                                        <input type="hidden" name="version" value="3">
                                        <input type="hidden" name="servicecode" value="<?php 
                                        echo substr($row["servicecode3"], 0,-2); ?>">
                                        <input type="hidden" name="resend_request" value="<?php echo $pcs[$row["servicecode"]]; ?>">
                                        <button type="submit" class="btn btn-light">Server 3</button>
                                    <?php } ?>
                                    </form>
                                    <form method="post" action="inc/buy-number.php" style="display: inline">
                                    <?php
                                    //version2
                                    if($row["version"]==2){ 
                                    ?>
                                        <input type="hidden" name="countrycode" value="<?php echo $selectedcountry2; ?>">
                                        <input type="hidden" name="version" value="2">
                                        <input type="hidden" name="servicecode" value="<?php 
                                        echo substr($row["servicecode2"], 0,-2); ?>">
                                        <input type="hidden" name="resend_request" value="<?php 
                                        echo $pcs[$row["servicecode"]]; ?>">
                                        <button type="submit" class="btn btn-light">Server 2</button>
                                    </form>
                                    <?php }?>
                                    <form method="post" action="inc/buy-number.php" style="display: inline">
                                    <?php 
                                    //version1
                                    if($row["version"]==1 ){ 
                                    ?>
                                        <input type="hidden" name="countrycode" value="<?php echo $selectedcountry; ?>">
                                        <input type="hidden" name="version" value="1">
                                        <input type="hidden" name="servicecode" value="<?php 
                                        echo $row["servicecode"]; ?>">
                                        <input type="hidden" name="resend_request" value="<?php 
                                        echo $pcs[$row["servicecode"]]; ?>">
                                        <button type="submit" class="btn btn-light">Server 1</button>
                                    <?php }?> 

                                    </form>
                                    
                                    </td>
                                </tr>
                                    <?php
                                }

                                ?>

                               
                                </tbody>
                            </table>
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
