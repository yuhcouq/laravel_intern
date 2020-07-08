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
$result =0;
if($_POST){
  $ticketid = $_POST["ticketid"];
 if( $db->query("Update support set status=2 where id=$ticketid")){
    $result = 1; 
}
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
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 
  <!--     Fonts and icons     -->
  
</head>
<?php include 'static/menu.php'; 
    
    
    ?>
      
    <div class="content">
        <div class="row">
        <div class="col-md-12">
        
        <?php
        
        if($result ==1) {
          echo ' <div class="alert alert-primary" role="alert">
          It was successfully closed.
        </div>';
        }       
        if($_GET){
            if($_GET["type"] == "success"){
                echo ' <div class="alert alert-primary" role="alert">
                Successfully answered.
              </div>';
            }
            if($_GET["type"] == "none"){
                echo ' <div class="alert alert-danger" role="alert">
                The reply could not be sent.
              </div>';
            }
        }
        ?>
        </div>
        </div>
          
        <div class="row mt-5">
        <div class="col-md-12">

        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
              <table class="table text-center">
                            <thead class=" text-primary">
                            <th >
                            Date
                            </th>
                            <th>
                            User Mail
                            </th>
                            <th>
                            Subject
                            </th>
                            <th>
                            Related Service ID
                            </th>
                            <th>
                            Priority
                            </th>
                            <th>
                            Status
                            </th>
                            <th class="text-right">
                            
                            </th>
                            
                           
                            </thead>
                            <tbody>
                            <?php 
                               $result = $db->query("SELECT support.id,user.username,support.date,support.subject,support.relatedservice_id,support.priority,support.status from support Inner JOIN user on user.id = support.user_id where support.status = 1 or support.status=3 order by support.date desc");
                               if ($result === false) {
                                   return false;
                               }
                               while ($row = $result->fetch_assoc()) {
                                ?>
                                  <tr>
                                <td>
                                <?php echo $row["date"]; ?>
                                </td>
                                <td>
                                <?php echo $row["username"]; ?>
                                </td>
                                <td>
                                <?php echo $row["subject"]; ?>
                                </td>
                                <td>
                                <?php if($row["relatedservice_id"] ==0){echo 'Yok';} else{echo $row["relatedservice_id"];} ?>
                                </td>
                                <td>
                                <?php if($row["priority"]==1){echo 'Düşük';} else if($row["priority"]==2){echo 'Orta';} else if($row["priority"]==3){echo 'Yüksek';} ?>
                                </td>
                               
                                <td>
                                <?php if($row["status"] == 1){echo '<i style="color:green;" class="far fa-dot-circle"></i> Open';} else if($row["status"] ==3){ echo '<i style="color:red;" class="far fa-dot-circle"></i> Customer Comment';}  ?>
                                </td>
                                <td class="text-right">
                                <form method="post" action="show-ticket.php"><input type="hidden" name="ticketid" value="<?php echo $row["id"]; ?>">
                                <button type="submit" class="btn btn-primary">Reply</button></form>
                                <form method="post"><input type="hidden" name="ticketid" value="<?php echo $row["id"]; ?>">
                                <button type="submit" class="btn btn-secondary">Close</button></form>

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
