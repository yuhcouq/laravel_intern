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
  <meta name="robots" content="noindex">
  <title>
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  
  
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; 
    $result=0;
        if($_POST){
            $userid1 = $_POST["userid"];
            if( $db->query("Delete from user where id = $userid1")){
                $result = 1;
            }
            
           
        }
    
    ?>
      
    <div class="content">
        
          
        <div class="row mt-5">
        <div class="col-md-12">
        <?php
            if($result == 1){
                echo '<div class="alert alert-primary" role="alert">
                The user has been successfully deleted.
              </div>';
            }

        ?>
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
              <table class="table text-center">
                            <thead class=" text-primary">
                            <th >
                            id
                            </th>
                            <th>
                            Name Surname
                            </th>
                            <th>
                            Mail
                            </th>
                            <th>
                            Date of registration
                            </th>
                            <th>
                            Last Login
                            </th>
                            <th>
                           Adress
                            </th>
                            <th>
                            Phone number
                            </th>
                            <th>
                           Balance
                            </th>
                            <th class="text-right">
                            
                            </th>
                            
                           
                            </thead>
                            <tbody>
                            <?php 
                               $result = $db->query("SELECT * from user ORDER by created_at DESC;");
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
                                <?php echo $row["created_at"]; ?>
                                </td>
                                <td>
                                <?php echo $row["updated_at"]; ?>
                                </td>
                                <td>
                                <?php echo $row["adress"].' '.$row["city"].' '.$row["country"].' '.$postcode; ?>
                                </td>
                                <td>
                                <?php echo $row["phone"]; ?>
                                </td>
                                <td>
                                <?php 
                                $balance=number_format($row["balance"]);
                                echo $balance.' ₫'; ?>
                                </td>
                                <td>
                                <form method="post">
                                <input type="hidden" name="userid" value=" <?php echo $row["id"]; ?>">
                                <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
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
