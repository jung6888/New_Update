<?php
session_start();
//unset($_POST["username"]);
//unset($_POST["password"]);
$msg="";
if(isset($_POST["button_login"])){
	$username =  $_POST["username"];
	$password =  $_POST["password"];
	$con = mysqli_connect("localhost","root","","pos");
	$qry = mysqli_query($con,"select * from table_users where username='".$username."' and password = '".md5($password)."'");
	$count = mysqli_num_rows($qry);
    //username: pos
    //password: admin123
	if($count == 0){
		$msg = "Username or Password is incorrect.";
	}
	else if($count >  0){
		$_SESSION["username"] = $username;
		header("location:dashboard.php");
	}
}
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
    <div class="container">
        <div class="row">
            <div class="col-sm-5 mx-auto mt-5 pt-5">
                <div class="card">
                        <h1 class="card-title mb-1 mt-1 text-center">Login</h1>
                        <hr>
                        <h3 class="text-center"><?php echo $msg;?></h3>
                        <form class="text-center" id="login-form"action='<?php echo $_SERVER["PHP_SELF"]?>' method="post">
          
                            <div class="form-group mx-3">
                                <div class="input-group">
                                    <div class="input-group-prepend h-100">
                                        <span class="input-group-text"><i class="fa fa-user fa-2x"></i> </span>
                                    </div>
                                    <input name="username" class="form-control" placeholder="Enter your username" type="text" required>
                                </div>  
                            </div>
                    
                            <br>
                            <div class="form-group mx-3">
	                                <div class="input-group">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text"> <i class="fa fa-lock fa-2x"></i> </span>
		                                </div>
	                                    <input name="password" class="form-control" placeholder="******" type="password">
	                                </div> <!-- input-group.// -->
	                        </div> <!-- form-group// -->
                            <br>
	                        <div class="form-group text-center">

                            <input class="btn btn-success btn-lg" type="submit" value="Login" name="button_login" />
	                        </div> <!-- form-group// -->
                           <br>
                        </form>
                   
                </div>
            </div>
        </div>
    </div>
       
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	</body>
</html>