<?php 
ob_start();
include 'Cart.php';
include 'ConnDB.php';


date_default_timezone_set("America/Costa_Rica");

if(!isset($_SESSION)){
    session_start();
    }
    
if(!isset($_SESSION['user'])){
header ("Location: /ProyectoLenguajes/index.php");

}else{
    if(empty($_SESSION['CART'])){
        header ("Location: /ProyectoLenguajes/index.php");  
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="shortcut icon" href="imgs/shop.png" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <link rel="stylesheet" href="css/Voucher.css">

</head>

<body>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 style="color: black;">Innova<span style="color: red">T</span>ech</h1>
                </div>
                <div class="col-md-6">

                    <span style="color: black; font-family: 'Segoe UI';">Heredia</span>
                    <br />
                    <span style="color: black; font-family: 'Times New Roman';">+(506)
                        2263-0109</span>
                    <br />
                    <span style="color: black; font-family: 'Impact';">innovatech.heredia@outlook.com</span>
                </div>
                <hr>

            </div>
        </div>
    </div>

    <br />

    <div class="container-fluid">
        <?php
        
        $ses = $_SESSION['user'];

        $link = ConnectDB();

        $sql = "BEGIN MostrarCuenta(:correo, :cursor); END;";

        $stmt = oci_parse($link, $sql); 

        $cursor = oci_new_cursor($link);

        oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);

        oci_bind_by_name($stmt,":correo",$ses);

        oci_execute($stmt);

        oci_execute($cursor);

        $row = oci_fetch_assoc($cursor);
        
        $id_ = $row['ID_USUARIO'];

        date_default_timezone_set("America/Costa_Rica");
        ?>

        <?php  $id = rand(1, 10000); 
        $letter = chr(rand(65,90));
        $n = $letter . $id;
        ?>


        <h3>Voucher N°: <?php echo $n;?> </h3>


        <div class="row">
            <div class="col-md-6">
                <h4>Date: </h4>
                <h5><?php echo date("d/m/Y H:i");?></h5>
                <br />
            </div>
        </div>

        <?php 
        $link = ConnectDB();

        $d = date("d/m/Y");
        
       // $sql_ = "CALL R_FACTURA('$n','$id_','$d')";
        
       // $stmt_ = oci_parse($link, $sql_); 
        
      //  oci_execute($stmt_); 
        
       // CloseDB($link);
        
        ?>


        <div class="row">
            <div class="col-md-6">
                <h4>Client: </h4>
                <h5>Name: <?php echo $row['NOMBRE']," ",$row['APELLIDO1']," ",$row['APELLIDO2'] ?>
                </h5>
                <h5>Email: <?php echo utf8_decode($row['EMAIL']); ?></h5>
                <h5>Address: <?php echo utf8_decode($row['DIRECCION']); ?></h5>
            </div>
        </div>
    </div>

    <div class="container">
        <br>
        <h3>Purchase</h3>
        <?php if(!empty($_SESSION['CART'])){?>

        <table class="table table-light table-bordered"
            style="border: black 2px solid; text-align: center; boder-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <th width="40%" class="text-center"
                        style="padding: 20px; border-bottom: 2px solid; border-right: 2px solid;">Description
                    </th>
                    <th width="15%" class="text-center"
                        style="padding: 20px; border-bottom: 2px solid; border-right: 2px solid;">Quantity</th>
                    <th width="20%" class="text-center"
                        style="padding: 20px; border-bottom: 2px solid; border-right: 2px solid;">Price</th>
                    <th width="20%" class="text-center" style="padding: 20px; border-bottom: 2px solid; ">Total</th>
                </tr>
                <?php $Total = 0;?>
                <?php foreach($_SESSION['CART'] as $index=>$product){?>
                <tr>
                    <td style="padding: 20px; text-align: center; border-bottom: 2px solid; border-right: 2px solid;"
                        width="40%">
                        <?php
                        $id_d = $product['ID'];
                        echo $product['NAME']?></td>
                    <td style="padding: 20px; text-align: center; border-bottom: 2px solid; border-right: 2px solid;"
                        width="15%" class="text-center">
                        <?php 
                        $cant = $product['QUANTITY'];
                        echo $product['QUANTITY']?></th>
                    <td style="padding: 20px; text-align: center; border-bottom: 2px solid; border-right: 2px solid;"
                        width="20%" class="text-center">
                        $<?php echo $product['PRICE']?></td>
                    <td style="padding: 20px; text-align: center; border-bottom: 2px solid; " width="20%"
                        class="text-center">
                        $<?php echo number_format($product['PRICE']*$product['QUANTITY'],2);?></td>
                </tr>
                <?php $Total = $Total+($product['PRICE']*$product['QUANTITY']);?>
                <?php } ?>
                <tr>
                    <td colspan="3" class="text-right" style=" align=left;  width=50% ; border-right: 2px solid;">
                        <h3>Total:</h3>
                    </td>
                    <td class="text-right" style="text-align: center;">
                        <h3>$<?php echo number_format($Total,2);?></h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php }
        
        /* $link = ConnectDB();
        
        $sql_1 = "CALL R_DETALLE('$n','$id_d','','$Total','$cant')";
        
        $stmt_1 = oci_parse($link, $sql_1); 
        
        oci_execute($stmt_1); 
        
        CloseDB($link);
        */
        
        ?>

    </div>

</body>

</html>

<?php


 $body = ob_get_clean();

 $message_email = "We send you the proof of your purchase hereby made in InnovaTech on " . date('F j, Y \a\t g:i a')  . "<br>" . "<br>" .
  "This message is generated by an automatic system, we appreciate not responding to this address. Thank you very much." . "<br>" . "<br>";

  
$body_email = $message_email . $body;


 $email_ = $row['EMAIL'];



require_once 'Library/dompdf/autoload.inc.php';

 use Dompdf\Dompdf;
 $dompdf = new Dompdf();
 $dompdf -> loadHtml($body);

  $dompdf-> setPaper('landscape');

    $dompdf->render();

 $dompdf->stream("voucher.pdf", array("Attachment" => false));
 SendEmail($email_,"Purchase Voucher",$body_email);
 exit(0);





 



?>