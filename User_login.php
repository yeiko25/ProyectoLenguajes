    <?php 



session_start(); 

if(isset($_SESSION['user'])){
    header("Location: index.php");
    }




function Verification_login($email,$pass)
{   
    include 'ConnDB.php';
    $link = ConnectDB();
    

    $login_verification = oci_parse($link, "SELECT * FROM Usuarios WHERE EMAIL = '$email' AND CLAVE = '$pass'");

    oci_execute($login_verification);

   CloseDB($link);
   
   
    return oci_fetch_all($login_verification, $res);
}




?>