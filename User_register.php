<?php


include 'ConnDB.php';


function EmailVER($email){
    
$link = ConnectDB();

$sql = "SELECT * FROM Usuarios WHERE EMAIL = '$email'";

$email_verification = oci_parse($link, $sql);

oci_execute($email_verification);


CloseDB($link);

return oci_fetch_all($email_verification, $res);

}

function UserVER($user){
$link = ConnectDB();

$sql = "SELECT * FROM Usuarios WHERE USUARIO = '$user' ";

$user_verification = oci_parse($link, $sql);

oci_execute($user_verification);

CloseDB($link);

return oci_fetch_all($user_verification, $res);

}


function registerUser(){
$link = ConnectDB();
}


 ?>