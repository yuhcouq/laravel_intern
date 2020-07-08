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
    if($_POST["type"]=="serviceadd"){
        $servicename = $_POST["servicename"];
        $serviceicon = $_POST["serviceicon"];
        $servicecode = $_POST["servicecode"];
        $servicecode2 = $_POST["servicecode2"];
        $servicecode3 = $_POST["servicecode3"];
        if($db->query("Insert into service(serviceicon,servicename,servicecode,servicecode2,servicecode3) values('$serviceicon','$servicename','$servicecode','$servicecode2','$servicecode3')")){
            $sonuc = 1;
        }else{
            $sonuc=2;
        }
    }if($_POST["type"]== "deleteservice"){
        $serviceid = $_POST['serviceid']; 
        if($db->query("Delete from service where id =".$serviceid)){
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
        <div class="col-md-12">

        <div class="card">
  <div class="card-body">
   
  <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Service Name</label>
    <input type="text" name="servicename" class="form-control"  placeholder="">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Service Icon</label>
    <input type="text" name="serviceicon" class="form-control"  placeholder="">
    <small class="form-text text-muted">For example, you need to add the relevant icon via fontawesome in this way only: fab fa-facebook-square</small>
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Service Code</label>
    <input type="text" name="servicecode" class="form-control"  placeholder="smspva">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Service Code</label>
    <input type="text" name="servicecode2" class="form-control"  placeholder="5sim">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Service Code</label>
    <input type="text" name="servicecode3" class="form-control"  placeholder="sim-active">
    <small class="form-text text-muted">Please enter the service code correctly as shown in the documentation.</small>
  </div>
    <input type="hidden" name="type" value="serviceadd">
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
                            Icon
                            </th>
                            <th>
                            Service Name
                            </th>
                            <th>
                            Service Code pva
                            </th>
                            <th>
                            Service Code 5sim
                            </th>
                            <th>
                            Service Code active
                            </th>
                            <th class="text-right">
                            
                            </th>
                            
                           
                            </thead>
                            <tbody>
                            <?php 
                               $result = $db->query("SELECT * from service;");
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
                                <i class="<?php echo $row["serviceicon"]; ?>"></i>
                                </td>
                                <td>
                                <?php echo $row["servicename"]; ?>
                                </td>
                                <td>
                                <?php echo $row["servicecode"]; ?>
                                </td>
                                <td>
                                <?php echo $row["servicecode2"]; ?>
                                </td>
                                <td>
                                <?php echo $row["servicecode3"]; ?>
                                </td>
                                <td>
                               <form method="post">
                               <input type="hidden" name="type" value="deleteservice">
                               <input type="hidden" name="serviceid" value="<?php echo $row["id"]; ?>">
                               
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
