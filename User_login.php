    <?php 



session_start(); 

if(isset($_SESSION['user'])){
    header("Location: index.php");
    }




function Verification_login($email,$pass)
{   
    include 'ConnDB.php';
    $link = ConnectDB();
    
    $sql = "BEGIN VerificacionLogin(:correo, :pass, :cursor); END;";

    $stmt = oci_parse($link, $sql);

    $cursor = oci_new_cursor($link);

    oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);

    oci_bind_by_name($stmt,":correo",$email);

    oci_bind_by_name($stmt,":pass",$pass);

    oci_execute($stmt);

    oci_execute($cursor);

   CloseDB($link);
 
    return oci_fetch_all($cursor, $res);
}




?>