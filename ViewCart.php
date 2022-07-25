<?php 
include 'ConnDB.php';
include 'Cart.php';
include 'templates/Header.php'; 
?>


<div class="container">
    <br>
    <h3>Your Cart</h3>
    <?php if(!empty($_SESSION['CART'])){?>

    <table class="table table-light table-bordered">
        <tbody>
            <tr>
                <th width="40%">Description</th>
                <th width="15%" class="text-center">Quantity</th>
                <th width="20%" class="text-center">Price</th>
                <th width="20%" class="text-center">Total</th>
                <th width="5%" class="text-center">Action</th>
            </tr>
            <?php $Total = 0;?>
            <?php foreach($_SESSION['CART'] as $index=>$product){?>
            <tr>
                <td width="40%"><?php echo $product['NAME']?></td>
                <td width="15%" class="text-center"><?php echo $product['QUANTITY']?></th>
                <td width="20%" class="text-center">$<?php echo $product['PRICE']?></td>
                <td width="20%" class="text-center">
                    $<?php echo number_format($product['PRICE']*$product['QUANTITY'],2);?></td>
                <td width="5%">

                    <form action="" method="POST">
                        <input type="hidden" name="pid" id="pid"
                            value="<?php echo openssl_encrypt($product['ID'],COD,KEY);?>">
                        <button class="btn btn-danger" type="submit" name="btnCart" value="Delete">Delete</button>
                    </form>



                </td>
            </tr>
            <?php $Total = $Total+($product['PRICE']*$product['QUANTITY']);?>
            <?php } ?>
            <tr>
                <td colspan="3" class="text-right">
                    <h3>Total</h3>
                </td>
                <td class="text-right">
                    <h3>$<?php echo number_format($Total,2);?></h3>
                </td>
                <td>
                    <a href="Payment.php">
                        <button class="btn btn-success">Go pay</button>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php }else{?>
    <div class="alert alert-success">
        <h4>Cart is empty... <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-cart-x-fill" viewBox="0 0 16 16">
                <path
                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7.354 5.646 8.5 6.793l1.146-1.147a.5.5 0 0 1 .708.708L9.207 7.5l1.147 1.146a.5.5 0 0 1-.708.708L8.5 8.207 7.354 9.354a.5.5 0 1 1-.708-.708L7.793 7.5 6.646 6.354a.5.5 0 1 1 .708-.708z" />
            </svg> </h4>
    </div>

    <?php }?>
</div>

<?php
include 'templates/Footer.php';
?>