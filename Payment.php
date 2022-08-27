<?php 
 include 'templates/Header.php';
 include 'ConnDB.php';  


 if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['user'])){
    echo ' <script type="text/javascript">
    $(document).ready(function() {  
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Sorry, you need to have a user account to continue."
        }).then(function() {
        window.location = "Login.php";
        })});
    </script>';
session_destroy();
die();

}
date_default_timezone_set("America/Costa_Rica");



if(isset($_POST['btnPay'])){



    if(isset($_POST['save']) && $_POST['save'] == '1'){

        $ncard_ = $_POST["ncard"];

        $searchString = " ";

        $replaceString = "";
    
        $ncard = str_replace($searchString, $replaceString, $ncard_);

        $cvv = $_POST["cvv"];

        $owner = $_POST["owner"];

        $month = $_POST["expiryMonth"];

        $year = $_POST["expiryYear"];
    
        $date = "01/".$month."/".$year;
       


        //Obtener ID

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
    
    $id = $row['ID_USUARIO'];

  //Insertar Info

  
  $query = "CALL REGISTRARTARJETA('$id','$owner', '$ncard', '$date', '$cvv')";
  
  $call = oci_parse($link, $query);

  oci_execute($call);

  CloseDB($link);
  
    }


   echo ' <script type="text/javascript">
    $(document).ready(function() {  
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Payment successfully."
        }).then(function() {
            document.location.href = "/ProyectoLenguajes/voucher.php";
        })});
    </script>'; 
    
    
    }

?>




<form method="post">
    <div class="container">
        <div class="text-center">
            <div class="nav main-nav">
                <ul>
                    <li class="tab1 active">
                        <a href="#card">Card</a>
                    </li>
                    <li class="tab">
                        <a href="#Paypal">Paypal </a>
                    </li>
                </ul>

            </div>
            <h4 style="color: grey;">
                Add your payment information to continue with the purchase</h4>
        </div> <!-- Credit Card Payment Form - START -->

        <div class="row card">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="text-center">Payment Details</h3>
                            <div class="inlineimage align-content-center"> <img class="img-responsive images"
                                    src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png">
                                <img class="img-responsive images"
                                    src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Visa-Curved.png">
                                <img class="img-responsive images"
                                    src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png">
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group"> <label>CARD NUMBER</label>
                                        <div class="input-group"> <input id="ncard" name="ncard" type="text"
                                                maxlength="19" required="required" class="form-control"
                                                placeholder="Valid Card Number" onkeypress='return formats(this,event)'
                                                onkeyup="return numberValidation(event)" pattern=".{19,19}" /> <span
                                                class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span
                                                class="visible-xs-inline">EXP</span> DATE</label>
                                        <div id="expiration-date">

                                            <select id="expiryMonth" name="expiryMonth" style="height: 30px;"
                                                required="required">
                                                <option value=""></option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            <select id="expiryYear" name="expiryYear" style="height: 30px;"
                                                required="required">
                                                <option value=""></option>


                                                <?php  

              $year = date("Y");
              
              $rango=8; 

              for ($i=$year;$i<=$year+$rango;$i++){
                echo '<option value="'.$i.'">'.$i.'</option>';
              }

              
             ?>


                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group"> <label>CV CODE</label> <input id="cvv" name="cvv"
                                            type="password" minlength="3" maxlength="3" required="required"
                                            onkeypress="return validateNumber(event)" class="form-control"
                                            placeholder="CVC" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group"> <label>CARD OWNER</label> <input id="owner" name="owner"
                                            type="int" required="required" class="form-control"
                                            onkeypress="return validateLetter(event)" placeholder="Card Owner Name"
                                            maxlength="50" />
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <input type="checkbox" class="form-check-input" id="save" name="save" value="1">
                                    <label class="form-check-label" for="conditions"> Save payment information in my
                                        account for future purchases.</label>
                                </div>
                            </div>
                        </form>
</form>
</div>
<div class="panel-footer">
    <div class="row">
        <div class="col-xs-12">
            <a href="voucher.php">
                <button type='submit' onclick="Exp();" class="btn btn-success btn-lg btn-block" name="btnPay"
                    id="btnPay">Confirm
                    Payment</button>
            </a>


        </div>
    </div>
</div>
</div>
</div>
</div>

</div>




<!-- PAYPAL -->

<form method="post">
    <div class="container">
        <div class="row paypal">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="text-center">PAYPAL ACCOUNT</h3>
                            <img style="height: 77px;  width: 77px; display: block; margin: auto; "
                                class="img-responsive images"
                                src="https://cdn2.iconfinder.com/data/icons/social-media-2304/64/19-paypal-256.png">
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group"> <label>PAYPAL EMAIL</label>
                                        <div class="input-group"> <input id="pemail" name="pemail" type="email"
                                                required="required" class="form-control" placeholder="Paypal Email" />
                                            <span class="input-group-addon"><span class="fa fa-paypal"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group"> <label>PASSWORD</label>
                                        <div class="input-group"> <input id="ppass" name="ppass" type="password"
                                                required="required" class="form-control"
                                                placeholder="Paypal password" />
                                            <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
</form>
</div>


<div class="panel-footer">
    <div class="row">
        <div class="col-xs-12">
            <a href="voucher.php">
                <button type='submit' class="btn btn-success btn-lg btn-block" name="btnPay" id="btnPay">Confirm
                    Payment</button>
            </a>


        </div>
    </div>
</div>
</div>
</div>
</div>

</div>











<script>
$("#menu-toggle").click(function(e) {

    e.preventDefault();

    $("#wrapper").toggleClass("toggled");

});



function validateNumber(event)

{

    var key = window.event ? event.keyCode : event.which;



    if (key < 48 || key > 57) {

        return false;

    } else {

        return true;

    }

};

function validateLetter(event) {
    var key = window.event ? event.keyCode : event.which;

    if (key == 32) {
        return true;
    } else if ((key >= 65 && key <= 90) || (key >= 97 && key <= 122)) {
        return true;
    } else {
        return false;
    }

};

function Exp() {
    let fecha = new Date();
    let annoActual = fecha.getFullYear();
    let mesActual = fecha.getMonth() + 1;
    let fechaCompleta = new Date(annoActual, mesActual, 1);

    let annoActualP = document.getElementById("expiryYear").value;
    let mesActualP = document.getElementById("expiryMonth").value;
    let fechaCompletaP = new Date(annoActualP, mesActualP, 1);

    var errorMonth = document.getElementById("expiryMonth");

    if (annoActualP != "" && mesActualP != "") {
        if (fechaCompletaP < fechaCompleta) {
            var mensaje = errorMonth.setCustomValidity("The card is expired");

        } else {
            errorMonth.setCustomValidity("");
        }
    } else {
        mensaje = errorMonth.setCustomValidity("The card is expired");

    }

    return mensaje;
}

function formats(ele, e) {
    if (ele.value.length < 19) {
        ele.value = ele.value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
        return true;
    } else {
        return false;
    }
}

function numberValidation(e) {
    e.target.value = e.target.value.replace(/[^\d ]/g, '');
    return false;
}
</script>

<?php
include 'templates/Footer.php';
?>