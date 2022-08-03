<?php


include 'ConnDB.php';


function EmailVER($email){
    
$link = ConnectDB();

    $sql = "BEGIN VerificacionEmail(:correo, :cursor); END;";

    $stmt = oci_parse($link, $sql);

    $cursor = oci_new_cursor($link);

    oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);

    oci_bind_by_name($stmt,":correo",$email);
    
    oci_execute($stmt);

    oci_execute($cursor);

    CloseDB($link);

return oci_fetch_all($cursor, $res);

}

function UserVER($user){
$link = ConnectDB();

    $sql = "BEGIN VerificacionUsuario(:usuario_, :cursor); END;";

    $stmt = oci_parse($link, $sql);

    $cursor = oci_new_cursor($link);

    oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);

    oci_bind_by_name($stmt,":usuario_",$user);
    
    oci_execute($stmt);

    oci_execute($cursor);

    CloseDB($link);

CloseDB($link);

return oci_fetch_all($cursor, $res);

}


function registerUser(){
$link = ConnectDB();
}


 ?>