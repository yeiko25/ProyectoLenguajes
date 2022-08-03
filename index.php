<?php 
 include 'templates/Header.php';  
 
?>




<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Laptops</a></li>
                <li><a href="#">Components</a></li>
                <li><a href="#">Accessories</a></li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./imgs/pc.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Laptops<br>Collection</h3>
                        <a href="#tab1" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./imgs/headset.png" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Accessories<br>Collection</h3>
                        <a href="#tab1" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="https://cdn.wccftech.com/wp-content/uploads/2020/09/MSI_GeForce-RTX%E2%84%A2-3090-GAMING-TRIO-24G_BOX-125f4e65c6ed1e17.77020536-740x633.png"
                            alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Components<br>Collection</h3>
                        <a href="#tab1" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">


                                <!-- product -->
                                <?php
                                    include 'ConnDB.php';
                                    include 'Cart.php';
                                    
                                    $link = ConnectDB();

                                    $sql = 'BEGIN PAQUETE.MostrarProductos(:cursor); END;';

                                    $stmt = oci_parse($link, $sql); 

                                    $cursor = oci_new_cursor($link);

                                    oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);

                                    oci_execute($stmt);

                                    oci_execute($cursor);
                                
                                    $row = oci_fetch_assoc($cursor); 
                                    
                                    //Categoria

                                    $sql1 = 'BEGIN PAQUETE.MostrarCategoria(:cursor1); END;';
                                    
                                    $stmt1 = oci_parse($link, $sql1);

                                    $cursor1 = oci_new_cursor($link);

                                    oci_bind_by_name($stmt1,":cursor1",$cursor1,-1,OCI_B_CURSOR);

                                    oci_execute($stmt1);

                                    oci_execute($cursor1);

                                    $row1 = oci_fetch_assoc($cursor1); 



                                    ?>


                                <?php while($row = oci_fetch_assoc($cursor)) { ?>



                                <div class="product">
                                    <div class="product-img">
                                        <img src="<?php echo $row['IMG'];?>" title="" data-toggle="popover"
                                            data-placement="bottom" data-content="<?php echo $row['DESCRIPCION'];?>"
                                            data-trigger="hover">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">

                                            <?php 

                                   
                                            ?>

                                        </p>
                                        <h3 class="product-name"><a href="#"><?php echo $row['NOMBREPRODUCTO'];?></a>
                                        </h3>
                                        <h4 class="product-price">$<?php echo $row['PRECIO'];?></h4>

                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                    class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">

                                        <form action="" method="post">

                                            <input type="hidden" name="pid" id="pid"
                                                value="<?php echo openssl_encrypt($row['ID_PRODUCTO'],COD,KEY);?>">
                                            <input type="hidden" name="pname" id="pname"
                                                value="<?php echo openssl_encrypt($row['NOMBREPRODUCTO'],COD,KEY);?>">
                                            <input type="hidden" name="price" id="price"
                                                value="<?php echo openssl_encrypt($row['PRECIO'],COD,KEY);?>">
                                            <input type="hidden" name="quantity" id="quantity"
                                                value="<?php echo openssl_encrypt(1,COD,KEY);?>">

                                            <button type="submit" class="add-to-cart-btn" name="btnCart" value="Add"><i
                                                    class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </form>
                                    </div>
                                </div>

                                <?php } ?>
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
        <?php //print_r($message);?>
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 30% OFF</p>
                    <a class="primary-btn cta-btn" href="#tab1">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top selling</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <!-- product -->

                                <!-- product -->
                                <?php
                                   
                                    

                                    $link = ConnectDB();

                                    $sql = 'BEGIN PAQUETE.MostrarProductos(:cursor); END;';

                                    $stmt = oci_parse($link, $sql); 

                                    $cursor = oci_new_cursor($link);

                                    oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);

                                    oci_execute($stmt);

                                    oci_execute($cursor);
                                
                                    $row = oci_fetch_assoc($cursor);         
                                    
                                    ?>



                                <?php while($row = oci_fetch_assoc($cursor)) { ?>



                                <div class="product">
                                    <div class="product-img">
                                        <img src="<?php echo $row['IMG'];?>" title="" data-toggle="popover"
                                            data-placement="bottom" data-content="<?php echo $row['DESCRIPCION'];?>"
                                            data-trigger="hover">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?php //echo $row['NOMBRECATEGORIA'];?></p>
                                        <h3 class="product-name"><a href="#"><?php echo $row['NOMBREPRODUCTO'];?></a>
                                        </h3>
                                        <h4 class="product-price">$<?php echo $row['PRECIO'];?></h4>

                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                    class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">

                                        <form action="" method="post">

                                            <input type="hidden" name="pid" id="pid"
                                                value="<?php echo openssl_encrypt($row['ID_PRODUCTO'],COD,KEY);?>">
                                            <input type="hidden" name="pname" id="pname"
                                                value="<?php echo openssl_encrypt($row['NOMBREPRODUCTO'],COD,KEY);?>">
                                            <input type="hidden" name="price" id="price"
                                                value="<?php echo openssl_encrypt($row['PRECIO'],COD,KEY);?>">
                                            <input type="hidden" name="quantity" id="quantity"
                                                value="<?php echo openssl_encrypt(1,COD,KEY);?>">

                                            <button type="submit" class="add-to-cart-btn" name="btnCart" value="Add"><i
                                                    class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </form>
                                    </div>
                                </div>

                                <?php } ?>
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->



<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Sign Up for the <strong>PURCHASING</strong></p>
                    <form>
                        <button class="newsletter-btn"
                            onclick="window.location.href='mailto:innovatech.heredia@outlook.com?Subject=I%20want%20to%20SUBSCRIBE%20to%20Innovatech'"><i
                                class="fa fa-envelope"></i> Subscribe</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEWSLETTER -->


<input type="hidden" id="Count_2" name="Count_2"
    value="<?php echo (empty($_SESSION['CART']))?0:count($_SESSION['CART']); ?>">



<?php
include 'templates/Footer.php';
?>



<script>
$(document).ready(function()

    {

        document.getElementById('Count_1').innerHTML = document.getElementById('Count_2').value;



    });



if (window.history.replaceState)

{

    window.history.replaceState(null, null, window.location.href);

}
</script>