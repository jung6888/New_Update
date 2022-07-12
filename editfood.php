<?php
    $food_name = "";
    $type_id = 1;
    $photo = "";
    $food_id = 1;
    include('session.php');
    include('connect.php');
    if(isset($_GET["id"])){
    $val = (int)$_GET["id"];
        if($con){
            $qry = mysqli_query($con,"select * from Food where Food_Id = $val");
            while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                $food_name = $row["Food_Name"];
                $Unit_Price = $row["Unit_Price"];
                $type_id = $row["Type_Id"];
                $food_id = $row["Food_Id"];
                $photo = $row["photo"];
            }
            $_SESSION["id_update"] = $val;
        }
    }
    if(isset($_POST["button_update"])){
        if(isset($_FILES["photo"]))
        {
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
          $ext = $photo;
        }
        if($ext != $photo)
        {
          $imagename = date('Ymdhis').rand(1000, 9999).$ext;
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
        }
        else
        {
          $target_path = $ext;
        }
        if(move_uploaded_file($temp_name,$target_path))
        {
          $con = mysqli_connect("localhost","root","","pos");
          $sql = "update Food set Food_Name = '".$_POST["food_name"]."', Unit_Price = '".$_POST["Unit_Price"]."', Type_Id = '".$_POST["food_type"]."', Food_Id = '".$_SESSION["id_update"]."', photo = '".$target_path."' where Food_Id ='".$_SESSION["id_update"]."'";
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
          }else{
             mysqli_rollback($con);
             echo "Failed";
          }
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
        <form class="modal-dialog w-50" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <h5 class="modal-title" id="exampleModalLabel">Edit Food</h5>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label"> Name:</label>
                  <input type="text" class="form-control"  name="food_name" value='<?php echo $food_name;?>'>
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Unit_Price:</label>
                  <input type="number" class="form-control" name="Unit_Price" value='<?php echo $Unit_Price?>'>
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Photo:</label>
                  <input type="file" class="form-control" name="photo" value='<?php echo $photo?>'>
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Food_Type:</label>
                  <select class="form-select" aria-label="Default select example" value='<?php echo $type_id?>' name="food_type">
                    <option selected value="1">Food</option>
                    <option value="2">Drink</option>
                    
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