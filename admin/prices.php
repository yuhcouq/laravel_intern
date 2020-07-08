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
$selectedcountry = 'russia';
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
    
    if($_POST){
      $selectedcountry  = $_POST["countrycode"];
      $ulkesorgukod = $selectedcountry;
      $ucret1 = $_POST["ucret1"];
      $ucret2 = $_POST["ucret2"];
      $ucret3 = $_POST["ucret3"];
      $price1=$_POST['price1'];
      $price2=$_POST['price2'];
      $price3=$_POST['price3'];
      $servisid = $_POST["servisid"];
        if(isset($_POST['guncelle'])){
          if($ucret1!=''){
            if($price1!=''){
              $sorgu1 = "Update price set price = $ucret1 where countryid = (Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod') and price.version='1' and price.serviceid =".$servisid.";";
              $db->query($sorgu1);
            }else{
              $sorgu1 = "Insert into price(countryid,serviceid,price,version) values ((Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod'),$servisid,$ucret1,'1');";
                $db->query($sorgu1);
            }
          }else{
              $sorgu1 = "Delete from price where countryid = (Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod') and price.version='1' and price.serviceid =".$servisid.";";
              $db->query($sorgu1);
            }
          if($ucret2!=''){
            if($price2!=''){
              $sorgu2 = "Update price set price = $ucret2 where countryid = (Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod') and price.version='2' and price.serviceid =".$servisid.";";
              $db->query($sorgu2);
            }else{
              $sorgu2 = "Insert into price(countryid,serviceid,price,version) values ((Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod'),$servisid,$ucret2,'2');";
                $db->query($sorgu2);
            }
          }else{
            $sorgu2 = "Delete from price where countryid = (Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod') and price.version='2' and price.version='2' and price.serviceid =".$servisid.";";
            $db->query($sorgu2);
          }

          if($ucret3!=''){
            if($price3!=''){
              $sorgu3 = "Update price set price = $ucret3 where countryid = (Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod') and price.version='3' and price.serviceid =".$servisid.";";
              $db->query($sorgu3);
            }else{
              $sorgu3 = "Insert into price(countryid,serviceid,price,version) values ((Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod'),$servisid,$ucret3,'3');";
                $db->query($sorgu3);
            }
          }else{
            $sorgu3 = "Delete from price where countryid = (Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod') and price.version='3' and price.serviceid =".$servisid.";";
            $db->query($sorgu3);
          }

             
        }elseif(isset($_POST['ekle'])){
          if($ucret1!=''){
                $sorgu1 = "Insert into price(countryid,serviceid,price,version) values ((Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod'),$servisid,$ucret1,'1');";
                $db->query($sorgu1);}
          if($ucret2!=''){
          $sorgu2 = "Insert into price(countryid,serviceid,price,version) values ((Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod'),$servisid,$ucret2,'2');";
                $db->query($sorgu2);}
          if($ucret3!=''){
          $sorgu3 = "Insert into price(countryid,serviceid,price,version) values ((Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod'),$servisid,$ucret3,'3');";
                $db->query($sorgu3);}


        }elseif(isset($_POST['sil'])){
          $sorgu12 = "Delete from price where countryid = (Select id from country where countrycode ='$ulkesorgukod' or countrycode2 ='$ulkesorgukod' or countrycode3 ='$ulkesorgukod') and price.serviceid =".$servisid.";";
          $db->query($sorgu12);
        }
    
    }
   
    ?>
      
    <div class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="card">
        <div class="card-body">
        <!--<select  id="selectedcountry" onchange="changecountry()" class="custom-select custom-select-lg mb-3"> -->
        <div class="btn-group flex-wrap btn-group-toggle" data-toggle="buttons">
        <?php 
         $result = $db->query("Select * from country order by countryname asc;");
         if ($result === false) {
             return false;
         }
        
         while ($row = $result->fetch_assoc()) {
          if($selectedcountry == $row['countrycode']||$selectedcountry == $row['countrycode2']||$selectedcountry == $row['countrycode3']){
            if($row['countrycode']!=""){ ?>  
               <label class="btn btn-primary active ml-3">
                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
              </label>
               
               <?php }
            elseif($row["countrycode2"]!=""){ ?>
                <label class="btn btn-primary active ml-3">
                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode2']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                </label>
               <?php }
            else{
                ?>
                <label class="btn btn-primary active ml-3">
                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode3']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                  </label>
               <?php }

              
          }else{
            if($row['countrycode']!=""){ ?>  
               <label class="btn btn-secondary ml-3">
                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
              </label>
               
               <?php }
            elseif($row["countrycode2"]!=""){ ?>
                <label class="btn btn-secondary ml-3">
                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode2']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                </label>
               <?php }
            else{
                ?>
                <label class="btn btn-secondary ml-3">
                  <input type="radio" name="options" onchange="changecountry()" value="<?php echo $row['countrycode3']; ?>" checked><img style="width : 23.3px; height:15.6px;" class="img-fluid mr-1" src="../assets/img/flag/<?php echo $row['countryname']; ?>.png"><?php echo $row["countryname"]; ?>
                  </label>
               <?php }
          }
        }
          ?>
          </div>
        
        </select>
        <small  class="form-text text-muted">Please select the country where you will enter prices or make changes.</small>
        </div>
        </div>

        </div>
        </div>
          
        <div class="row mt-6">
        <div class="col-md-12">
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
          <table class="table text-center">
            <thead class=" text-primary">
              <th scope="col">Service Name</th>
              <th scope="col">Price_Pva</th>
              <th scope="col">Price_5sim</th>
              <th scope="col">Price_Active</th>
              <th class="text-right" scope="col"></th>             
            </thead>
            <tbody>
            <?php  
            $result = $db->query("SELECT * from service order by servicename asc;");
            if ($result === false) {
              return false;
            }
          
            while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
            <th scope="row"><i class="<?php echo $row["serviceicon"];?>"></i>&nbsp<?php echo $row["servicename"]; ?></th>
              <?php
              //inner join country on country.id = price.countryid
              $querytitle1= "SELECT * FROM price inner join country on country.id = price.countryid where price.countryid = (Select id from country where countrycode ='$selectedcountry' or countrycode2 ='$selectedcountry' or countrycode3 ='$selectedcountry') and price.version='1' and price.serviceid =".$row['id'].";";
              $resulttitle1 = $db->select($querytitle1); 
              //price_5sim
              $querytitle2= "SELECT * FROM price inner join country on country.id = price.countryid where price.countryid = (Select id from country where countrycode ='$selectedcountry' or countrycode2 ='$selectedcountry' or countrycode3 ='$selectedcountry') and price.version='2' and price.serviceid =".$row['id'].";";
              $resulttitle2 = $db->select($querytitle2);
              //price_active
              $querytitle3= "SELECT * FROM price inner join country on country.id = price.countryid where price.countryid = (Select id from country where countrycode ='$selectedcountry' or countrycode2 ='$selectedcountry' or countrycode3 ='$selectedcountry') and price.version='3' and price.serviceid =".$row['id'].";";
              $resulttitle3 = $db->select($querytitle3);
              ?>
              <form  method="post">
                <input type="hidden" name="countrycode" value="<?php echo $selectedcountry; ?>">
                <input type="hidden" name="servisid" value="<?php echo $row["id"]; ?>">
                <input type="hidden" name="price1" value="<?php echo $resulttitle1[0]["price"]; ?>">
                <input type="hidden" name="price2" value="<?php echo $resulttitle2[0]["price"]; ?>">
                <input type="hidden" name="price3" value="<?php echo $resulttitle3[0]["price"]; ?>">
                <td><input type="text" name="ucret1" value ="<?php echo $resulttitle1[0]["price"]; ?>"></td>
                <td><input type="text" name="ucret2" value ="<?php echo $resulttitle2[0]["price"]; ?>"></td>
                <td><input type="text" name="ucret3" value ="<?php echo $resulttitle3[0]["price"]; ?>"></td>
              <td><?php
                if($resulttitle1[0]["price"] != null || $resulttitle2[0]["price"] != null || $resulttitle3[0]["price"] != null){
                    ?>
                    <button type="submit" name="guncelle" class="btn btn-secondary">Update</button>

                    <?php
                }else{
                    ?>
                    <button type="submit" name="ekle" class="btn btn-secondary">Add</button>
                    <?php
                }?>
              </td>
                <td><button type="submit" name="sil" class="btn btn-secondary">Delete</button></td>
              </form>
              </tr>
              <?php
              }
                 ?>
                          
                           
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

  <script>   
function changecountry() {
    var gender = document.querySelector('input[name = "options"]:checked').value;
    var strUser = gender;


function post(url, method) {
  method = method || "post"; // post (set to default) or get

  // Create the form object
  var form = document.createElement("form");
  form.setAttribute("method", method);
  form.setAttribute("action", url);

  // For each key-value pair
  
    var hiddenField = document.createElement("input");  
    hiddenField.setAttribute("type", "hidden"); 
    hiddenField.setAttribute("name", "countrycode");
    hiddenField.setAttribute("value", strUser);

    // append the newly created control to the form
    form.appendChild(hiddenField); 


  document.body.appendChild(form); // inject the form object into the body section
  form.submit();
}
javascript:post('', 'post');


}
</script>

</body>

</html>
