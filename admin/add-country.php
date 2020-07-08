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
$sonuc =0;
if($_POST){
    if($_POST["type"]== "ulkeadd"){   
    $countryname= $_POST["countryname"];
    $countrycode= $_POST["countrycode"]; 
    $countrycode2= $_POST["countrycode2"]; 
    $countrycode3= $_POST["countrycode3"];    
        if($db->query("Insert into country(countryname,countrycode,countrycode2,countrycode3) values('$countryname','$countrycode','$countrycode2','$countrycode3')")){
            $sonuc = 1;
        }else{
            $sonuc=2;
        }
    }if($_POST["type"]== "ulkedelete"){
        $ulkeid = $_POST['ulkeid']; 
        if($db->query("Delete from country where id =".$ulkeid)){
            $sonuc = 3;
        }else{
            $sonuc=4;
        }
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
        <div class="col-md-12">

        <div class="card">
  <div class="card-body">
   
  <form method="post" >
  <div class="form-group">
    <label for="exampleInputEmail1">Name of country</label>
    <input type="text" name="countryname" class="form-control"  placeholder="">
    <input type="hidden" name="type" class="form-control"  value="ulkeadd">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Country code</label>
    <input type="text" name="countrycode" class="form-control"  placeholder="smspva">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Country code</label>
    <input type="text" name="countrycode2" class="form-control"  placeholder="5sim">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Country code</label>
    <input type="text" name="countrycode3" class="form-control"  placeholder="sim-active">
    <small  class="form-text text-muted">Please enter the country code correctly as shown in the documentation.</small>
  </div>
  
  <button type="submit" class="btn btn-block btn-primary">Add</button>
</form>
<?php
if($sonuc == 1){
    echo '<div class="alert alert-primary" role="alert">
    Added successfully.
</div>';}
if($sonuc == 2){
   echo '<div class="alert alert-danger" role="alert">
   There was a problem adding.
</div>';}
if($sonuc == 3){
    echo '<div class="alert alert-primary" role="alert">
    Successfully deleted.
</div>';}
if($sonuc == 4){
    echo '<div class="alert alert-danger" role="alert">
    There was a problem deleting.
 </div>';}


?>

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
                            İcon
                            </th>
                            <th>
                            Country Name
                            </th>
                            <th>
                            Country Code pva
                            </th>
                            <th>
                            Country Code 5sim
                            </th>
                            <th>
                            Country Code active
                            </th>
                            <th class="text-right">
                            
                            </th>
                            
                           
                            </thead>
                            <tbody>
                            <?php 
                               $result = $db->query("SELECT * from country;");
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
                                <img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png">
                                </td>
                                <td>
                                <?php echo $row["countryname"]; ?>
                                </td>
                                <td>
                                <?php echo $row["countrycode"]; ?>
                                </td>
                                <td>
                                <?php echo $row["countrycode2"]; ?>
                                </td>
                                <td>
                                <?php echo $row["countrycode3"]; ?>
                                </td>
                                <td>
                                <form method="post">
                                <input type="hidden" name="type" value="ulkedelete" >
                                <input type="hidden" name="ulkeid" value="<?php echo $row['id']; ?>" >
                                <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                                </td>
                               <?php } ?>
                            </tr>
                               
                          
                           
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
