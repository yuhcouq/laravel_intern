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

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <title>
    Admin Paneli
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  
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
                            Service
                            </th>
                            <th>
                            Country
                            </th>
                            <th>
                            Number
                            </th>
                            <th>
                            Message
                            </th>
                            <th>
                            User Mail
                            </th>
                            <th class="text-right">
                            Date
                            </th>
                            
                           
                            </thead>
                            <tbody>
                            <?php 
                               $result = $db->query("SELECT service.servicename,number.id, service.serviceicon,country.countryname,number.number,number.message,number.date,user.username FROM (((number INNER JOIN service ON service.servicecode = number.service_code or service.servicecode2 = number.service_code or service.servicecode3 = number.service_code) INNER JOIN country ON country.countrycode = number.country_code or country.countrycode2 = number.country_code or country.countrycode3 = number.country_code ) Inner JOIN user on user.id = number.user_id)  ORDER by number.date DESC;");
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
                                <i class="<?php echo $row["serviceicon"];?>"></i>&nbsp<?php echo $row["servicename"]; ?>
                                </td>
                                <td>
                                <img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                                </td>
                                <td>
                                <?php echo $row["number"]; ?>
                                </td>
                                <td>
                                <?php echo $row["message"]; ?>
                                </td>
                              
                                <td>
                                <?php echo $row["username"]; ?>
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
