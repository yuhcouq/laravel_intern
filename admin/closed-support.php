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
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>
    Admin Paneli
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
                               $result = $db->query("SELECT support.id,user.username,support.date,support.subject,support.relatedservice_id,support.priority,support.status from support Inner JOIN user on user.id = support.user_id where support.status = 2 order by support.date desc");
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
                                <?php if($row["priority"]==1){echo 'Low';} else if($row["priority"]==2){echo 'Middle';} else if($row["priority"]==3){echo 'High';} ?>
                                </td>
                               
                                <td>
                                <?php if($row["status"] ==1){ echo '<i style="color:green;" class="far fa-dot-circle"></i> Open'; } elseif($row["status"] == 2){ echo '<i style="color:gray;" class="far fa-dot-circle"></i> Closed';}elseif($row["status"] == 3){  echo '<i style="color:red;" class="far fa-dot-circle"></i> Customer Comment';} ?>
                                </td>
                                <td class="text-right">
                                <form method="post" action="show-ticket.php"><input type="hidden" name="ticketid" value="<?php echo $row["id"]; ?>">
                                <button type="submit" class="btn btn-secondary">Show</button></form>
                              

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
