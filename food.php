<?php
include ('connect.php');
include ('session.php');
//Food and Drink Filter
$_SESSION["location_page"] = "food.php";
//End filter
if(isset($_POST["button_save_food"])){
	if(isset($_FILES["photo"])){
		$file_name = $_FILES["photo"]["name"];
		$temp_name = $_FILES["photo"]["tmp_name"];
		$imagetype = $_FILES["photo"]["type"];
		$ext ="";
		switch($imagetype){
			case 'image/bmp':
					$ext = '.bmp';break;
			case 'image/gif':
					$ext = '.gif';break;
			case 'image/jpeg':
					$ext = '.jpg';break;
			case 'image/png':
					$ext = '.png';break;
			default:
					$ext ="";
		}
  }
    else
    {
      $ext ="";
    }
    if($ext != "")
    {
      $imagename =date('Ymdhis').rand(1000,9999).$ext;
      $select = $_POST["food_type"];
      if($select == "1")
      {
        $target_path = 'images/foods/'.$imagename;
      }
      else if($select == "2")
      {
        $target_path = 'images/drinks/'.$imagename;
      }
      else
      {
        $target_path = 'images/'.$imagename;
      }
      if(move_uploaded_file($temp_name,$target_path)){
        $sql = "call in_food('".$_POST["food_name"]."', '".$_POST["unit_price"]."', '".$_POST["food_type"]."', '".$target_path."');";
        $qry = mysqli_query($con, $sql);
        if($qry)
        {
          header('location:confirm.php');
          if($qry && $_SESSION["final"] == "confirm")
          {
            $_SESSION["final"] = "";
              mysqli_commit($con);
          }
          else
          {
              mysqli_rollback($con);
          }
        }

      }
    }
    else{
      echo "Action cannot proceed";
    }
   
  }
if(isset($_POST["edit_food"]))
{
  header('location: editfood.php');
}
if(isset($_GET["id"])){
  $food_id = (int)$_GET["id"];
  include('connect.php');
  if($con){
      $qry = mysqli_query($con, "delete from Food where Food_Id= $food_id");
      //$qry = mysqli_query($con, "call delete_customer('".$customer_id."');");
      mysqli_commit($con);

  }
  }
	
//}
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
        <div id="page-content-wrapper">
        <?php 
            include ("header.php");
        ?>
            <div class="container-fluid">
            <h2 class="text-center">Food</h2>
            <div class="row">
                <!--start filter-->
                <div class="col-lg-1">
                    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                      <select id="inputOrder" class="form-select" name="filter_people" onchange="this.form.submit();">
                    
                      </select>
                    </form>
                </div>
                <!--end filter-->
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
                    <span class="h6">Add food</span>
                    </button>
                </div>
            </div>
            <!--end row-->
            <div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form class="modal-dialog" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"> Name:</label>
                    <input type="text" class="form-control" id="recipient-name" name="food_name">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Unit Price:</label>
                    <input type="number" step="any" class="form-control" id="recipient-name" name="unit_price">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Photo:</label>
                    <input type="file" class="form-control" id="recipient-name" name="photo">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Type:</label>
                    <select class="form-select" aria-label="Default select example" name="food_type">
                      <option selected>Open this select menu</option>
                      <option value="1">Food</option>
                      <option value="2">Drink</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                 <input type="submit" name = "button_save_food" value="Add" class="btn btn-primary"/>
                </div>
              </div>
            </form>
        </div>
            <!--end add-->
            <div class="container-fluid d-flex">
              <div class="d-flex justify-content-center flex-wrap">
                <?php
                $connect =  mysqli_connect("localhost","root","","pos");
                if($connect)
                {
                  $mysql = "call select_food();";
                  $myqry = mysqli_query($connect, $mysql);
                }
                
                while($row = mysqli_fetch_array($myqry,MYSQLI_ASSOC)){
                  ?>
                    <div class="p-4">
                        <div class="card" style="width: 18rem;">
                          <img src=<?php echo $row["photo"]?> class="card-img-top"/>
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $row["Food_Name"];?></h5>
                              <p class="card-text">$<?php echo $row["Unit_Price"];?></p>
                            </div>
                           
                              <div class="container py-2">
                                <div class="row text-center">
                                  <div class="col-6 ">
                                  <a title='Click To Edit Food' rel='facebox' href="editfood.php?id=<?php echo $row["Food_Id"]; ?>"> <button class='btn btn-warning'>Edit</button> </a>
                                  </div>
                                  <div class="col-6">
                                  <a class='delete-btn btn btn-danger' href="food.php?id=<?php echo $row["Food_Id"];?>" onclick="return confirm('Are you sure you want to delete this item')"><span class='h6'>Delete</span></a></td>
                                  </div>
                                </div>
                              </div>
                         
                        </div>
                    </div>
                  <?php
                }
                ?>
              </div>
            </div>    
            </div>  
        </div>
    </div> 
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="script.js"></script>   
    </body>
    
</html>