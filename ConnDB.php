<?php

    function ConnectDB()
    {
        $server = "localhost/orcl";
        $user = "Y3IKO";
        $password = "yeiko2002";

         $conection = oci_connect($user, $password, $server);

          if (!$conection) {    
              $m = oci_error();    
            echo $m['message'], "n";    
             exit; 
           } else {    
             echo "Conexión con éxito a Oracle!"; } 

        return oci_connect($user, $password, $server);
    }

    
    function CloseDB($link)
    {
        oci_close($link);
    }


    define("KEY","KDOY2022.pr0t");
    define("COD","AES-128-ECB");  
   
 function SendEmail($addressee, $subject_, $body_email){
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

     $mail = new PHPMailer();
     $mail -> Charset = 'UTF-8';

    $mail -> IsSMTP();
    $mail -> Host = 'smtp.office365.com';
    $mail -> SMTPSecure = 'tls';
    $mail -> Port = 587;   //for SSL 465
    $mail -> SMTPAuth = true;
    $mail -> Username = 'innovatech.heredia@outlook.com';
    $mail -> Password = 'innovatech2022';
    $mail -> SetFrom('innovatech.heredia@outlook.com',"InnovaTech");
    $mail -> Subject = $subject_;
    $mail -> MsgHTML($body_email);
    $mail -> AddAddress($addressee, 'Customer');

    $mail -> send();

 }





    
?>