<?php 
include ("session.php");
include ('connect.php');
$_SESSION["final"] = "";
if(isset($_POST["final"]))
{
    $_SESSION["final"] = $_POST["final"];
    if($_SESSION["location_page"] == "customer.php")
    header("location: customer.php");
    else if($_SESSION["location_page"] == "food.php")
    {
      header("location: food.php");
    }
    else
    header("location: dashboard.php");
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
    <div class="container border h-25 my-5 w-50">
        <form class="row align-items-center bg-light " method="post">
            <div class="row"><h4 class="text-center my-5">Confirm your action?</h4></div>
        <div class="row">
            <div class="col-md-6 text-center my-5">    
            <input type ="submit" class="btn btn-secondary btn-xl" value="cancel" name="final"/>
               
            
            </div> 
            <div class="col-md-6 text-center my-5">       
            <input type ="submit" class="btn btn-success btn-xl" value="confirm" name="final"/>
               
         
            </div> 
        </div>
        </form>
    </div>
</body>
<html>