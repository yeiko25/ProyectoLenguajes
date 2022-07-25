<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>InnovaTech</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <link rel="shortcut icon" href="imgs/shop.png" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <link type="text/css" rel="stylesheet" href="css/Payment.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="tel:50600000000"><i class="fa fa-phone"></i> (+506) 2263-0109</a></li>
                    <li><a href="mailto:innovatech.heredia@outlook.com?Subject=Interested%20in%20the%20products"><i
                                class="fa fa-envelope-o"></i>innovatech.heredia@outlook.com</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <?php if(!isset($_SESSION)){
                        session_start();
                        }
                        
                 if(isset($_SESSION['user'])){ ?>

                    <li><a href="/ProyectoLenguajes/php/account.php"><i class="fa fa-user-o"></i> My Account</a></li>

                    <?php }else{?>
                    <li><a href="Login.php"><i class="fa fa-user-o"></i> My Account</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="index.php" class="logo">
                                <h1 style="color: white">Innova<span style="color: red">T</span>ech</h1>

                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>

                                <input class="input" placeholder="Search here">
                                <button class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="nav-link" href="ViewCart.php">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty" id="Count_1" name="Count_1"><?php
                                  echo (empty($_SESSION['CART']))?0:count($_SESSION['CART']);?>
                                    </div>
                                </a>

                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->