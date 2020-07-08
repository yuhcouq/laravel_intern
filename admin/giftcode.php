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

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
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
        $result = 0;
        if($_POST){
            if($_POST["type"] == "addcoupon"){
                $couponcode = $_POST["couponcode"];
                $buybalance = $_POST["buybalance"];
                $addbalance = $_POST["addbalance"];
                $stock = $_POST["stock"];
                if($db->query("Insert into giftcode(giftkey,buybalance,addbalance,stock) values('$couponcode',$buybalance,$addbalance,$stock)")){
                    $result = 1;
                }else{
                    $result = 2;
                }
            }else if($_POST["type"] =="deletecoupon"){
                $couponid = $_POST["couponid"];
                if($db->query("Delete from giftcode where id=$couponid")){
                    $result = 3;
                }else{
                    $result = 4;
                }
            }
        }

    ?>
      
    <div class="content">
    <div class="row"><div class="col-md-12">
        <?php 
        if($result == 1){
            echo '<div class="alert alert-primary" role="alert">
            Promosyon kodu başarıyla eklendi.
          </div>';
        }else if($result ==2){
            echo '<div class="alert alert-danger" role="alert">
            Promosyon kodu eklenirken bir sorunla karşılaşıldı.
          </div>';
        }else if($result ==3){
            echo '<div class="alert alert-primary" role="alert">
            Promosyon kodu başarıyla silindi.
          </div>';
        }else if($result ==4){
            echo '<div class="alert alert-danger" role="alert">
            Promosyon kodu silinirken bir sorunla karşılaşıldı.
          </div>';
        }

        ?>
    </div>
    </div>
        <div class="row">
        <div class="col-md-12">
        
        <div class="card">
        <div class="card-body">
        <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Promo Code</label>
            <input type="text" name="couponcode" class="form-control" >
            <small class="form-text text-muted">Create a promotional code that customers will use.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Loading Balance</label>
            <input type="text" name="buybalance" class="form-control" >
            <small class="form-text text-muted">How much above and what should the user use after loading the balance?</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Balance to Add</label>
            <input type="text" name="addbalance" class="form-control">
            <small class="form-text text-muted">Balance to be added to the user's account</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Stock</label>
            <input type="text" name="stock" class="form-control" >
            <small class="form-text text-muted">Number of promotional code.</small>
        </div>
        <input type="hidden" name="type" value="addcoupon" class="form-control" >
        <button type="submit" class="btn btn-primary btn-block">Create</button>
        </form>
        </div>
        </div>

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
                            id
                            </th>
                            <th>
                            Promo Code
                            </th>
                            <th>
                            Loading Balance
                            </th>
                            <th>
                            Balance to Add
                            </th>
                            <th>
                            Stock
                            </th>
                            <th class="text-right">
                            
                            </th>
                            
                           
                            </thead>
                            <tbody>
                            <?php 
                               $result = $db->query("SELECT * from giftcode");
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
                                <?php echo $row["giftkey"]; ?>
                                </td>
                                <td>
                                <?php echo $row["buybalance"]; ?>₺
                                </td>
                                <td>
                                <?php echo $row["addbalance"]; ?>₺
                                </td>
                                <td>
                                <?php echo $row["stock"]; ?> Adet
                                </td>
                                <td class="text-right">
                                <form method="post">
                                <input type="hidden" name="type" value="deletecoupon">
                                <input type="hidden" name="couponid" value="<?php echo $row["id"]; ?>">
                                <button type="submit" class="btn btn-info">Sil</button>
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
