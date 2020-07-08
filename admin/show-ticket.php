<?php
include_once("../inc/config.php");
$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];
if(empty($user)){
  header("Location: login-register.php?type=guest"); 
  exit;
}

if($_POST){
  $ticketid = $_POST["ticketid"];
}
else{
  header("Location: support-tickets.php"); 
  exit;
}
$settings = $db->select("SELECT * from settings");
 

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
    $queryshowticket= "SELECT * FROM support where id=".$ticketid;
    $resultshowticket = $db->select($queryshowticket);
    
    ?>
      
    <div class="content">
    
    <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header ">
              <h5 class="card-title">Support Details</h5>
              <p class="card-category">Status:</span>  <?php if($resultshowticket[0]["status"] ==1){ echo '<i style="color:green;" class="far fa-dot-circle"></i> Open'; } elseif($resultshowticket[0]["status"] == 2){ echo '<i style="color:gray;" class="far fa-dot-circle"></i> Closed';}elseif($resultshowticket[0]["status"] == 3){  echo '<i style="color:red;" class="far fa-dot-circle"></i> Customer Comment';} ?></p>
              <hr>
              </div>
                <div class="card-body ">
                <p><span class=" text-primary">Subject :</span> <?php echo $resultshowticket[0]["subject"]; ?></p>
                <p><span class=" text-primary">Related Service :</span> <?php if($resultshowticket[0]["relatedservice_id"] ==0){echo 'Nope';} else{ $resultnumber = $db->select("SELECT number FROM number where id=".$resultshowticket[0]["relatedservice_id"]);  echo $resultnumber[0]["number"]; } ?></p>
                <p><span class=" text-primary">Priority :</span> <?php if($resultshowticket[0]["priority"] ==0){echo "Low";} elseif($resultshowticket[0]["priority"] ==1){echo "Middle";} elseif($resultshowticket[0]["priority"] ==2){echo "High";} ?></p>
                <button type="button" class="btn btn-info btn-block mt-2" data-toggle="collapse" data-target="#demo">Reply</button>
                <div id="demo" class="collapse mt-2">
                <div class="card mt-2">
                            <div class="card-header">
                            Reply to Request
                            </div>
                            <div class="card-body">
                                <form action="replyticket.php" method="post">
                                <input type="hidden" name="ticketid" value="<?php echo $ticketid; ?>">
                                <textarea name="replyticket" class="form-control ml-1 mr-1" rows="8"></textarea>
                                <?php 
                                  $usermail1= $db->select("SELECT username from user INNER JOIN support on support.user_id = user.id WHERE support.id = $ticketid");
                                ?>
                                <input type="hidden" value="<?php echo $usermail1[0]["username"]; ?>" name="usermail">
                                <button type="submit" class="btn btn-secondary btn-block mt-2" data-toggle="collapse" data-target="#demo">Submit</button>
                                </form>
                            </div>
                            
                            </div>
                </div>

                </div>
            </div>
          </div>
          </div>

        <?php
          $replysupportresult = $db->query("SELECT user.name,user.surname,support_reply.message,support_reply.date FROM support_reply inner join user on user.id = support_reply.replyuser_id where support_id =$ticketid order by date desc ");
         if ($replysupportresult === false) {
             return false;
         }
      
         while ($row = $replysupportresult->fetch_assoc()) {
            ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title"><?php echo $row["name"].' '.$row["surname"]; ?></h5>
              </div>
                <div class="card-body ">
                <p><?php echo $row["message"]; ?></p>

                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                    <i class="fa fa-history"></i> <?php echo date('H:i d/m/Y', strtotime($row["date"])); ?>
                </div>
              </div>
            </div>
          </div>
        </div>


          <?php
            }
          ?>
       


        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title"><?php 
                $resultshowticket1 = $db->select("SELECT user.name,user.surname FROM user Inner join support on support.user_id = user.id  where support.id=".$ticketid);
                    echo $resultshowticket1[0]["name"].' '.$resultshowticket1[0]["surname"];
                ?></h5>
              </div>
                <div class="card-body">
                  <p><?php echo $resultshowticket[0]["message"]; ?></p>

                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                    <i class="fa fa-history"></i> <?php echo date('H:i d/m/Y', strtotime($resultshowticket[0]["date"])); ?>
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
