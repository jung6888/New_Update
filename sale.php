<?php



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
            <body>
        <div class="title p-3 text-center"><h1>Cart</h1></div>
        <div class="container-fluid d-flex justify-content-center">
            <div class="d-flex justify-content-center flex-wrap">
                <div class="p-2 " style="width: 25rem;">
                    <div class="cart-item d-flex pb-4 pt-4 border-bottom mx-auto">
                        <img src="images/drinks/coca_cola.jpg" style="width: 6rem;" class="card card-img-top"/>
                        <div class="card-body ms-3 d-flex flex-column justify-content-between">
                            <div>
                                <p class="card-title h4">Coca Cola</p>
                                <p class="card-title text-muted">Drinks</p>
                            </div>
                            <p class="card-text align-bottom text-primary h4">$2.49</p>
                        </div>
                        <div class="d-flex flex-column justify-content-between">
                            <div class="col bg-primary text-white text-center rounded p-2" style="width: 2rem;">+</div>
                            <div class="col text-center rounded h4" style="width: 2rem;">1</div>
                            <div class="col bg-primary text-white text-center rounded p-2" style="width: 2rem;">-</div>
                        </div>
                    </div>

                    <div class="cart-item d-flex pb-4 pt-4 border-bottom">
                        <img src="images/drinks/copper_cocktails.jpeg" style="width: 6rem;" class="card card-img-top"/>
                        <div class="card-body ms-3 d-flex flex-column justify-content-between">
                            <div>
                                <p class="card-title h4">Copper Cocktail</p>
                                <p class="card-title text-muted">Drinks</p>
                            </div>
                            <p class="card-text align-bottom text-primary h4">$4.95</p>
                        </div>
                        <div class="d-flex flex-column justify-content-between me-0">
                            <div class="col bg-primary text-white text-center rounded p-2" style="width: 2rem;">+</div>
                            <div class="col text-center rounded h4" style="width: 2rem;">1</div>
                            <div class="col bg-primary text-white text-center rounded p-2" style="width: 2rem;">-</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between pt-3 pb-3 my-3">
                        <p class="h2">Total</p>
                        <p class="h2">$5.22</p>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="col bg-info rounded text-white text-center p-3 d-flex flex-column"><i class="fa-solid fa-credit-card pe-1 h2"></i>Credit Card</div>
                        <div class="mx-1"></div>
                        <div class="col bg-info rounded text-white text-center p-3 d-flex flex-column"><i class="fa-solid fa-money-bill-1-wave pe-1 h2"></i>Cash</div>
                    </div>

                    <div class="col bg-success rounded text-white text-center d-flex align-items-center justify-content-center h4 py-3">Proceed<i class="fa-solid fa-angles-right ps-2 h3"></i></div>

                </div>
            </div>
        </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>