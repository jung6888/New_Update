<?php 
include ("session.php");
?>
<!DOCTYPE html>
<html>
	<head>
    <link rel="stylesheet" href="dycalendar.css">
	<meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
    
                <!--<h3 class="bg-light text-center"><button class="btn btn-light btn-outline-dark my-1 me-1"><</button>
                 ?><button class="btn btn-light btn-outline-dark my-1 ms-1">></button></h3>
                 <div class="calendar">-->
                <!-- <table class="table bg-light">
                    <tr>
                        <th class="text-danger">S<th>
                        <th class="text-dark">M<th>
                        <th class="text-dark">T<th>
                        <th class="text-dark">W<th>
                        <th class="text-dark">T<th>
                        <th class="text-dark">F<th>
                        <th class="text-dark">S<th>
                    </tr>
                 </table> 
            <div class="col-6 col-xs=6 col-sm-12 col-md-6 col-lg-4 ms-2">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%2333B679&ctz=Asia%2FBangkok&showTitle=0&showNav=1&showTz=1&showCalendars=1&showPrint=1&showDate=1&showTabs=0" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            </div>--> 
            <div class="container-fluid p-0 ms-4">
                <div class="row">
                    <div class="d-none d-md-block d-lg-block d-xl-block col-md-7 col-lg-8 col-xl-9 mt-5 mb-auto pe-1">
                        <div class="bg-success">
                            <h2 class="text-light text-center pt-4 ">
                                <b>Introduction</b>
                            </h2>
                            <h5 class="text-light ms-3">
                            <i class="fa fa-question-circle pe-1">&nbsp; What Is a Point of Sale (POS)?</i>
                            </h5>
                            <p class="text-light ms-3 pe-1  ">
                                &nbsp;Point of sale (POS), a critical piece of a point of purchase, 
                                refers to the place where a customer executes the payment for goods or 
                                services and where sales taxes may become payable. It can be in a physical store, 
                                where POS terminals and systems are used to process card payments or a virtual sales 
                                point such as a computer or mobile electronic device.
                                <br>
                                We have four section for you to try out:
                                <ul class="text-light pb-1">
                                    <li>
                                        <h6>
                                        Customer
                                        </h6>
                                    </li>
                                    <li>
                                    <h6>
                                        Food
                                    </h6>
                                    </li>
                                    <li>
                                    <h6>
                                        Sale
                                    </h6>
                                    </li>
                                    <li>
                                    <h6 >
                                        Sale report
                                    </h6>
                                    </li>
                                  
                                </ul>
                            </p>
                            
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 mt-5 mb-auto ps-4">
                        <img src="salon-pos-software.png">
                     </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mx-3">
                    <h1 class="text-dark text-center mt-3"><b>OPTIONS</b></h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 text-center mt-2 ">
                        <button class="btn btn-lg btn-success" id="Customerbutton"style="width: 16rem; height: 10rem" onclick="window.location.href='customer.php'"><i class="fa-solid fa-user-group" ></i>
                        <p class="text-center">Customer</p>
                    </button>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 text-center mt-2 ps-1">
                        <button class="btn btn-lg btn-success" id="Foodbutton" style="width: 16rem; height: 10rem" onclick="window.location.href='food.php'"><i class="fa-solid fa-bowl-food fa-light"></i>
                        <p class="text-center ">Food</p>
                    </button>

                    </div>
                    <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 text-center mt-2 ps-1">
                    <button class="btn btn-lg btn-success" id="Salebutton"style="width: 16rem; height: 10rem" onclick="window.location.href='sale.php'"><i class="fa-solid fa-sack-dollar"></i>
                    <p class="text-center ">Sale</p>
                </button>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-3 text-center mt-2 ">
                    <button class="btn btn-lg btn-success" id="Reportbutton"style="width: 16rem; height: 10rem" onclick="window.location.href='sale_report.php'"><i class="fa-solid fa-file"></i>
                    <p class="text-center ">Sale Report</p>
                    </button>
                    </div>    
                    
                </div>
            </div> 
                   
         
    </div>
</div>
       
<script src="script.js"></script> 
     
</body>
</html>