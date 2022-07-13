<?php

include ('connect.php');
include ('session.php');
if(isset($_POST["add_to_cart"]))  
{
    if(isset($_SESSION["cart"]))  
    {  
           $item_array_id = array_column($_SESSION["cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"]  
                );  
                $_SESSION["cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="sale.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],   
           );  
           $_SESSION["cart"][0] = $item_array;  
      }
}
if(isset($_POST["remove_from_cart"])) 
{
    foreach($_SESSION["cart"] as $keys => $values)  
    {  
        if($values["item_id"] == $_GET["id"])  
        {  
            unset($_SESSION["cart"][$keys]);  
            echo '<script>alert("Item Removed")</script>';  
            echo '<script>window.location="sale.php"</script>';  
        }  
    }  
} 
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <!-- Sidebar  -->
        <div class="d-flex" id="wrapper">
            <?php 
                include ("sidebar.php");  
            ?>
            <div id="page-content-wrapper">
                    <?php 
                        include ("header.php");
                    ?>
                <div class="container-fluid">
                    <h2 class="text-center">Sale</h2>
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
                                    <input placeholder="Enter Food/Drink Name....." type="text" class="form-control" name="button_search">
                                </div>
                                <div class="col-lg-1 ps-4 pb-2">
                                    <button type="submit" class="btn btn-success btn-xs">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 ps-5">
                            <button class="add-btn btn btn-primary btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#addForm">
                                <span class="h6"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Card: <?php echo sizeof($_SESSION['cart']);?> Selected</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                                $connect =  mysqli_connect("localhost","root","","pos");
                                if($connect)
                                {
                                    $mysql = "call select_food();";
                                    $myqry = mysqli_query($connect, $mysql);
                                }
                                while($row = mysqli_fetch_array($myqry,MYSQLI_ASSOC)){
                            ?>
                                <div class="col-sm-6">
                                    <div class="card" style="width: 18rem;">
                                        <img src=<?php echo $row["photo"]?> class="card-img-top"/>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row["Food_Name"];?></h5>
                                            <p class="card-text">$<?php echo $row["Unit_Price"];?></p>
                                        </div>
                                        <div class="container py-2 m-0">
                                            <div class="row me-5">
                                                <div class="col-6 ">
                                                    <form method="post" action="sale.php?action=add&id=<?php echo $row["Food_Id"];?> ">
                                                    <input type="hidden" name="hidden_id" value="<?php echo $row["Food_Id"]; ?>" />    
                                                    <input type="submit" name="add_to_cart" class="btn btn-success" value="Add to cart"/>
                                                </form>      
                                                </div>
                                                <div class="col-6">
                                                    <form method="post" action="sale.php?action=delete&id=<?php echo $row["Food_Id"];?> ">
                                                        <input type="hidden" name="hidden_id" value="<?php echo $row["Food_Id"]; ?>" />    
                                                        <input type="submit" name="remove_from_cart" class="btn btn-danger" value="Remove from chart"/>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="col-sm-6 bg-light mt-2 ">
                            <div class="title p-3 text-center"><h1>Cart</h1></div>
                            <?php 
                            if(!empty($_SESSION["cart"]))
                            {
                                $num = 0;
                      
                                $connect =  mysqli_connect("localhost","root","","pos");
                                foreach($_SESSION["cart"] as $keys => $values)
                                {

                                    $r = mysqli_query($connect, "select * from Food where Food_Id =".$values["item_id"]."");
                                    $roww = mysqli_fetch_array($r,MYSQLI_ASSOC);
                                    $_SESSION["quantity"][$num] = (int)array(0);
                                    ?>
                                    <div class="cart-item d-flex pb-4 pt-4 border-bottom mx-auto">
                                        <img src=<?php echo $roww["photo"]; ?> style="width: 6rem;" class="card card-img-top"/>
                                        <div class="card-body ms-1 d-flex flex-column justify-content-between"> 
                                            <div>  
                                                <p class="card-title h4"><?php echo $roww["Food_Name"];?></p>
                                                 <p class="card-title text-muted"><?php if( $roww["Type_Id"] == 1){echo "Food";}else{echo "Drink";}?></p>
                                            </div>
                                            <p class="card-text align-bottom text-primary h4">$<?php echo $roww["Unit_Price"];?></p>
                                        </div>
                                        <div class="d-flex flex-column justify-content-between">
                                            <form method="post" action=<?php 
                                            if(isset($_POST["increment"])){
                                             (int)$_SESSION["quantity"][$num]++;
                                            }
                                            if(isset($_POST["decrement"]))
                                            {
                                                if($_SESSION["quantity"][$num] > 0)
                                                {
                                                    (int)$_SESSION["quantity"][$num]--; 
                                                }
                                            }   
                                            $num = $num + 1;
                                                ?>>
                                            <input type="submit" name="increment" class="btn btn-primary" value="+"/>
                                            <div class="col text-center rounded h4" style="width: 2rem;"><?php echo $_SESSION["quantity"][$num];?></div>
                                            <input type="submit" name="decrement" class="btn btn-primary" value="-"/>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                    
                                }
                            }
                            ?>
                            </div>   
                        </div>
                    </div>   
                </div>
         
                <!--
                <div class="container-fluid d-flex">
                    <div class="d-flex justify-content-center flex-wrap">
                    //    <?php
                    //        $connect =  mysqli_connect("localhost","root","","pos");
                    //        if($connect)
                    //        {
                    //            $mysql = "call select_food();";
                    //            $myqry = mysqli_query($connect, $mysql);
                    //        }
                    //            while($row = mysqli_fetch_array($myqry,MYSQLI_ASSOC)){
                    //    ?>
                        <div class="p-1">
                            <div class="card" style="width: 18rem;">
                              <img src=<?php //echo $row["photo"]?> class="card-img-top"/>
                                <div class="card-body">
                                  <h5 class="card-title"><?php //echo $row["Food_Name"];?></h5>
                                  <p class="card-text">$<?php //echo $row["Unit_Price"];?></p>
                                  <h5 class="card-title"><?php //if(isset($_POST["select"])) 
                                  //{
                                  //  echo '<p class="text-success>Selected</p>';
                                  //}
                                  //else
                                  //{
                                  //  echo '<p class="text-dark>Not Select</p>';
                                  //}
                                  //?></h5>
                                </div>
                                <div class="container py-2">
                                    <div class="row text-center">
                                      <div class="col-6 ">
                                        <form method="post" action="<?php
                                        //if(isset($_POST["select"]))
                                        //{
                                        //    array_push($_SESSION['cart'],$row["Food_Id"]);
                                        //}
                                        //?>">
                                            <button name="select" class="btn btn-success" onclick="this.form.submit()">Select</button>
                                        </form>
                                      </div>
                                      <div class="col-6">
                                        <form method="post" action="<?php 
                                        //if(isset($_POST["deselect"]))
                                        //{
                                        //    $_SESSION['cart']=array_diff($_SESSION['cart'],$row["Food_Id"]);
                                        //}
                                        //?>">
                                            <input type="submit" name="deselect" value="Deselect" class="btn btn-warning"/>
                                        </form>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        //}
                        ?>
                    </div>
                </div> 
                    -->   
            </div>
        </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>