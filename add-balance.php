<?php
include_once("inc/config.php");
$db = new Db();

if (!$db->connect()) {
    die("An error occurred while connecting to the database." . $db->error());
}

$user = $_SESSION["login_user"];
$settings = $db->select("SELECT * from settings");
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo $settings[6]["data"]; ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta content="<?php echo $settings[32]["data"]; ?>" name="description">
  <meta content="<?php echo $settings[33]["data"]; ?>" name="keywords">
  
  <!--     Fonts and icons     -->
  
</head>
    <?php include 'static/menu.php'; ?>
      
    <div class="content">
    <p class="text-center"><?php echo $settings[8]["data"]; ?></p>
    <?php
        if($_GET){
          if($_GET["balance"] == "small"){
              echo '<div class="alert alert-danger" role="alert">
              Least '. $settings[17]["data"].'$ you must add the  balance.
          </div>';
          }
        }
        ?>
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[9]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[9]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[10]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[10]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[11]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[11]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[12]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[12]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[13]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[13]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[14]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[14]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[15]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[15]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Price</p>
                      <p class="card-title"><?php echo $settings[16]["data"]; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <form action = "inc/shopier/buy-proccess.php" method="post"> <input type="hidden" name="price" value="<?php echo $settings[16]["data"]; ?>">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Different Amount Entry</h5>
                <p class="card-category">Minimum amount you can charge : <?php echo $settings[17]["data"]; ?>$</p>
              </div>
              <div class="card-body ">
             
              
              <form action = "inc/shopier/buy-proccess.php" method="post">
              <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Balance Amount $ : </label>
              <div class="col-sm-10">
              <input name="price" type="number" min="<?php echo $settings[17]["data"]; ?>" class="form-control" id="exampleFormControlInput1" value="<?php echo $settings[17]["data"]; ?>">
              </div>
            </div> 
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <button type="submit" class="btn btn-block btn-secondary">Online Payment</button></form>
                </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Promo Code</h5>
                <p class="card-category">Be sure to enter your campaign code completely.</p>
              </div>
              <div class="card-body ">
             
              
              <form action = "inc/giftcode.php" method="post">
              <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Campaign Code Entry :</label>
              <div class="col-sm-10">
              <input name="giftcode" type="text"  class="form-control" id="exampleFormControlInput1" >
              </div>
            </div> 
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <button type="submit" class="btn btn-block btn-secondary">Confirm Code</button></form>
                </form>
                </div>
              </div>
            </div>
            <?php
              if($_GET){
                $result = $_GET["type"];
                if($result == "stok"){ echo '<div class="alert alert-danger" role="alert">
                    This code has expired.
                </div>';}
                if($result == "keyerror"){ echo '<div class="alert alert-danger" role="alert">
                    Invalid code.
                </div>';}
                if($result == "ok"){ echo '<div class="alert alert-danger" role="alert">
                    Your code is valid. Your gift has been defined to your account.
                </div>';}
                if($result == "bakiyeyukle"){ echo '<div class="alert alert-danger" role="alert">
                    Please upload $ 20 or more to take advantage of the campaign code.
                </div>';}
                if($result == "tekrar"){ echo '<div class="alert alert-danger" role="alert">
                    You can only benefit from this campaign once.
                </div>';}
              }
            ?>
                   
        </div>

       

        


      </div>
            <?php include 'static/footer.php'; ?>
    </div>
  </div>

</body>

</html>
