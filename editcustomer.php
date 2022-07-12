<?php
    $customer_name = "";
    $address = "";
    $phone_number = "";
    $customer_id = "";
    $customer_level = "";
    include('session.php');
    include('connect.php');
    if(isset($_GET["id"])){
        if($con){
            $qry = mysqli_query($con,"select * from customer where Customer_Id='".$_GET["id"]."'");
            while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                $customer_name = $row["Customer_Name"];
                $address = $row["Address"];
                $phone_number = $row["Phone_Number"];
                $customer_id = $row["Customer_Id"];
                $customer_level = $row["Level"];
            }
            $_SESSION["id_update"] = $_GET["id"];
        }
    }
    if(isset($_POST["button_update"])){
        //echo $_POST["customer_name"];
        //echo $_POST["address"];
        //echo $_SESSION["id_update"];
        $con = mysqli_connect("localhost","root","","pos");
       // $sql = "update Customer set Customer_Name = '".$_POST["customer_name"]."', Address = '".$_POST["address"]."', Phone_Number = '".$_POST["phone_number"]."', Customer_Id = '".$_SESSION["id_update"]."', Level = '".$_POST["customer_level"]."' where Customer_id ='".$_SESSION["id_update"]."'";
        $sql =  "call edit_cust('".$_POST["customer_name"]."', '".$_POST["address"]."', '".$_POST["phone_number"]."', '".$_SESSION["id_update"]."', '".$_POST["customer_level"]."');";
        $qry = mysqli_query($con, $sql);
        if($qry){
          header('location:confirm.php');
          if($qry && $_SESSION["final"] == "confirm")
          {
            unset($_SESSION["final"]);
            mysqli_commit($con);
            
          }
          else 
          {
            unset($_SESSION["final"]);
            mysqli_rollback($con);
          }
        }else{
            mysqli_rollback($con);
            echo "Failed";
        }
    }
?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="customer.css" /> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
  </head>
    <body>
      <!-- user can't change the ID  -->
        <form class="modal-dialog w-50" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
          <div class="modal-content">
            <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Customer Name:</label>
                  <input type="text" class="form-control" name="customer_name" value='<?php echo $customer_name?>' name="customer_name">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Address:</label>
                  <input type="text" class="form-control" name="address" value='<?php echo $address?>' name="address">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Phone Number:</label>
                  <input type="text" class="form-control" name="phone_number" value='<?php echo $phone_number?>' name="phone_number">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Customer Level:</label>
                  <select class="form-select" aria-label="Default select example" name="customer_level" value='<?php echo $customer_level?>' name="customer_level">
                    <option selected value="BRONZE">BRONZE</option>
                    <option value="SILVER">SILVER</option>
                    <option value="GOLD">GOLD</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Cancel</button>
              <input type="submit" name = "button_update" value="Update" class="btn btn-primary"/>
            </div>
          </div>
        </form>
    </body>
</html>