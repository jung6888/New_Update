<?php 
include ('connect.php');
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	</head>
<body>


        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid " style="background-color: #c4f4df">
                <div class="row my-auto" style="width:150vw; height: 100%" >
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-4 col-xl-3 my-auto justify-content-end" >
                    <button type="button" id="menu-toggle" class="btn  mt-1 mb-3" style="color: #152238">
                        <i class="fas fa-align-left text-success "></i>
                        
                    </button>
                    <span class="text-dark" style="font-size: 2rem">Dashboard</span>  
                    </div>      
                    <div class="d-none d-lg-block d-xl-block col-lg-8 col-xl-9 my-auto" >
                        <div class="collapse navbar-collapse justify-content-end me-1" >
                            <ul class="navbar-nav ">
                                <li class="nav-item text-dark">
                                   <i class= "fa fa-user fa-lg">
                                   
                                   </i>
                                   <span>
                                   Hello <?php 
                                   $msgg = $_SESSION["username"];
                                   echo $msgg;
                                   ?>
                                   </span>
                                </li>
                            </ul>
                    </div>
            </div>
            </div>
        </nav>

        <script src="script.js"></script>
</body>
</html>