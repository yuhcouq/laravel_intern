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
    header("Location: ../login-register.php?type=guest"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta name="robots" content="noindex">
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
    
    
    ?>
      
    <div class="content">
        <div class="row">
        


        </div>
          
        <div class="row mt-5">
        <div class="col-md-12">

        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
              <table class="table text-center">
                            <thead class=" text-primary">
                            <th >
                            id
                            </th>
                            <th>
                            USER NAME SURNAME
                            </th>
                            <th>
                            User Mail
                            </th>
                            <th>
                            Amount
                            </th>
                            <th>
                            Type
                            </th>
                            <th class="text-right">
                            Date
                            </th>
                            
                           
                            </thead>
                            <tbody>
                            <?php 
                               $result = $db->query("SELECT log.id, user.name,user.surname,user.username,log.price,log.type,log.type,log.date from log inner join user on user.id = log.user_id order by log.date desc");
                               if ($result === false) {
                                   return false;
                               }
                               while ($row = $result->fetch_assoc()) {
                                ?>
                                  <tr>
                                <td>
                                <?php echo $row["id"]; ?>
                                </td>
                                <td>
                                <?php echo $row["name"].' '.$row["surname"]; ?>
                                </td>
                                <td>
                                <?php echo $row["username"]; ?>
                                </td>
                                <td>
                                <?php 
                                $price_log=number_format($row["price"]);
                                echo $price_log; ?> ₫
                                </td>
                                <td>
                                <?php if($row["type"] == 1){ echo 'Online';} else if($row["type"] ==2){echo 'Transfer';} elseif($row["type"]== 3){echo 'Coupon';} ?>
                                </td>
                                <td class="text-right">
                                <?php echo $row["date"]; ?>
                                </td>  
                            </tr>
                               <?php } ?>
                          
                           
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
