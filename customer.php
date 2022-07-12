<?php 
include ('session.php');
include ('connect.php');
$_SESSION["location_page"] = "customer.php";
if(isset($_POST["button_save"])){
  $customer_name = "";
  $address = "";
  $phone_number = "";
  $customer_id = "";
  $customer_level = "";
  if($con){
    $customer_name = $_POST["customer_name"];
    $address = $_POST["address"]; 
    $phone_number = $_POST["phone_number"];
    $customer_id = NULL;
    $customer_level = $_POST["customer_level"];
    ini_set("pcre.jit", "0");
    //$sql = "INSERT INTO Customer (Address, Customer_Name, Phone_Number, Level) values ('".$address."', '".$customer_name."', '".$phone_number."', '".$customer_level."')";
    $sql = "call in_customer('".$address."', '".$customer_name."', '".$phone_number."', '".$customer_level."')";
    $qry = mysqli_query($con, $sql);
    if($qry)
    {
      header('location:confirm.php');
      if($qry && $_SESSION["final"] == "confirm")
      {
        $_SESSION["final"] = "";
        mysqli_commit($con);
      }
      else {
        mysqli_rollback($con);
      }
    }
    
  }else{
      echo "Connect failed";
  }
  //header("location: customer.php");
} 
// delete button 
if(isset($_GET["id"])){
$customer_id = $_GET["id"];
include('connect.php');
if($con){
    //$qry = mysqli_query($con, "delete from customer where Customer_id='".$customer_id."'");
    $qry = mysqli_query($con, "call delete_customer('".$customer_id."');");
    if($qry){
      header('location:confirm.php');
      if($qry && $_SESSION["final"] == "confirm")
      {
        $_SESSION["final"] = "";
        mysqli_commit($con);
      }
      else {
        mysqli_rollback($con);
      }
    }else{
        echo "Failed";
    }
}
} 
// Filter button and function
$selected = '';

function get_options($select)
{
  $obj = (object) array('ID/ASC'=>"Customer_Id ASC", 'ID/DESC' => "Customer_Id DESC", 'Name/ASC' => "Customer_Name ASC", 'Name/DESC' => "Customer_Name DESC");
  $optioned = '';
  foreach($obj as $key => $value)
  {
    if($select == $value)
    {
      $optioned.='<option value="'.$value.'" selected>'.$key.'</option>';
    }
    else
    {
      $optioned.='<option value="'.$value.'">'.$key.'</option>';
    }
  }
  return $optioned;
}
if(isset($_POST["filter_people"]))
{
  $selected = $_POST["filter_people"];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
  </head>
<body>
  <div class="d-flex" id="wrapper">
    <?php 
        include ("sidebar.php");  
    ?>
    <!-- Page Content  -->
    <div id="page-content-wrapper">
      <?php 
      include ("header.php");
      ?>
    <!-- Customer body !-->
    <!-- Search & Filter & Add customer !-->
      <div class="container-fluid">
        <div class="row">
          <h1 class="text-dark text-center"><b>Customer</b></h1>
        </div>
        <div class="row">
          <div class="col-lg-1">
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
              <select id="inputOrder" class="form-select" name="filter_people" onchange="this.form.submit();">
              <?php echo get_options($selected);?>
              </select>
            </form>
          </div>
        
          <div class="col-lg-9">
            <form class="row" method="post">  
              <div class="col-lg-11">
                <input placeholder="Enter Customer Name....." type="text" class="form-control" name="button_search">
              </div>
              <div class="col-lg-1 ps-4 pb-2">
              <button type="submit" class="btn btn-success btn-xs">Search</button>
              </div>
            </form>
          </div>
          <div class="col-lg-2 ps-5">
              <button class="add-btn btn btn-primary btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#addForm">
                <span class="h6">Add Customer</span>
              </button>
          </div>
        </div>
        <div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form class="modal-dialog" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Customer Name:</label>
                    <input type="text" class="form-control" id="recipient-name" name="customer_name">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Address:</label>
                    <input type="text" class="form-control" id="recipient-name" name="address">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="recipient-name" name="phone_number">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Customer Level:</label>
                    <select class="form-select" aria-label="Default select example" name="customer_level">
                      <option selected>Open this select menu</option>
                      <option value="BRONZE">BRONZE</option>
                      <option value="SILVER">SILVER</option>
                      <option value="GOLD">GOLD</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                 <input type="submit" name = "button_save" value="Add" class="btn btn-primary"/>
                </div>
              </div>
            </form>
        </div>
      </div>
      <table class="table p-3 ms-2">
        <thead>
          <tr>
            <th scope="col"> No. </th>
            <th scope="col"> Customer Name</th>
            <th scope="col"> Address </th>
            <th scope="col"> Phone Number</th>
            <th scope="col"> Customer ID </th>
            <th scope="col"> Customer Level </th>
            <th scope="col"> Operation </th>
          </tr>
        </thead>
        <tbody>
        <?php
                $con = mysqli_connect("localhost","root","","pos");
                if($con){
                    $qry = "";
                    if(isset($_POST["button_search"])){
                        $argu = $_POST["button_search"];
                        if(isset($_POST["filter_people"]))
                        {
                          $qry = mysqli_query($con, "select * from customer where Customer_Name like '$argu%' order by $selected");
                          //$qry = mysqli_query($con, "call cus_filter_search($argu, $selected);");
                        }
                        else 
                        {
                          $qry = mysqli_query($con, "select * from customer where Customer_Name like '$argu%'");
                          //$qry = mysqli_query($con, "call cus_search('".$argu."');");
                        }
                    }
                    else
                    {
                      if(isset($_POST["filter_people"]))
                      {
                        $qry = mysqli_query($con, "select * from customer order by $selected");
                        //$qry = mysqli_query($con, "call cus_filter(".$selected.");");
                      }
                      else 
                      {
                        $qry = mysqli_query($con, "call cus_select();");
                      }
                    }
                    $num = 1;
                    while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                        echo "<tr><td>".$num++."</td><td>".$row["Customer_Name"]
                        ."</td><td>".$row["Address"]."</td><td>".$row["Phone_Number"]."</td><td>".$row["Customer_Id"]."</td><td>".$row["Level"]."</td>";
                        echo "<td> <a title='Click To Edit Customer' rel='facebox' href='editcustomer.php?id=".$row["Customer_Id"]."' <button class='btn btn-warning'>Edit</button>
                        </a> | <a class='delete-btn btn btn-danger' href='customer.php?id=".$row["Customer_Id"]."' onclick=\"return confirm('Are you sure you want to delete this item')\"><span class='h6'>Delete</span></a></td>";
                        echo "</tr>";    
                    }
                }else{
                    echo "Connection Failed";
                }
            ?>
        </tbody>
      </table>
    </div>
  </div>
   
</body>
</html>

