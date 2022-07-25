<?php 

if(!isset($_SESSION)){
    session_start();
}



if(isset($_POST['btnCart'])){
   

    switch ($_POST['btnCart']) {
        case 'Add':
           
if(is_numeric( openssl_decrypt($_POST['pid'],COD,KEY ))){

    $ID = openssl_decrypt($_POST['pid'],COD,KEY );

}else{
 echo '<script>alert("Opss.. something went wrong")</script>';
}

if(is_string( openssl_decrypt($_POST['pname'],COD,KEY ))){

    $NAME = openssl_decrypt($_POST['pname'],COD,KEY );

}else{
 echo '<script>alert("Opss.. something went wrong")</script>';
 break;
}

if(is_numeric( openssl_decrypt($_POST['price'],COD,KEY ))){

    $PRICE = openssl_decrypt($_POST['price'],COD,KEY );

}else{
 echo '<script>alert("Opss.. something went wrong")</script>';
 break;
}

if(is_numeric( openssl_decrypt($_POST['quantity'],COD,KEY ))){

    $QUANTITY = openssl_decrypt($_POST['quantity'],COD,KEY );

}else{
 echo '<script>alert("Opss.. something went wrong")</script>';
 break;
}

if(!isset($_SESSION['CART'])){

    $product = array(

        'ID' => $ID,
        'NAME' => $NAME,
        'PRICE' => $PRICE,
        'QUANTITY' => $QUANTITY
    );
$_SESSION['CART'][0]=$product;

}else{
    

    $idProducts = array_column($_SESSION['CART'],"ID");

if(in_array($ID,$idProducts)){

    foreach($_SESSION['CART'] as $index => $product){

        if($product['ID'] == $ID){

         $_SESSION['CART'][$index]['QUANTITY'] = 
         $_SESSION['CART'][$index]['QUANTITY'] + 1;
        }
        }
    }else{
        $numProducts=count($_SESSION['CART']);

        $product = array(
    
            'ID' => $ID,
            'NAME' => $NAME,
            'PRICE' => $PRICE,
            'QUANTITY' => $QUANTITY
        );
    $_SESSION['CART'][$numProducts]=$product;
    }

}


            break;

            case "Delete":
if(is_numeric( openssl_decrypt($_POST['pid'],COD,KEY ))){
    $ID = openssl_decrypt($_POST['pid'],COD,KEY );

foreach($_SESSION['CART'] as $index=>$product){
    if($product['ID']==$ID){

        if($_SESSION['CART'][$index]['QUANTITY'] > 1){
            $_SESSION['CART'][$index]['QUANTITY'] = 
            $_SESSION['CART'][$index]['QUANTITY'] - 1;

        }else{
            unset($_SESSION['CART'][$index]);
        }
break;
    }
}


}else{
 echo '<script>alert("Opss.. something went wrong")</script>';
}
    

            break;

    }

}




?>