<?php
include '../ConnDB.php';
session_start();
if(!isset($_SESSION['user'])){
header("Location: /ProyectoLenguajes/index.php");
}


$ses = $_SESSION['user'];

$link = ConnectDB();

$sql = "SELECT * FROM USUARIOS WHERE EMAIL = '$ses'";

$result = oci_parse($link, $sql);

oci_execute($result);

$row = oci_fetch_assoc($result); 

?>

<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/account.css">

</head>

<body>
    <div class="container">
        <a href="../index.php">
            <button class="btn mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
                Back
            </button>
        </a>
        <div class="wrapper">
            <div class="logo"> <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="">
            </div>
            <div class="text-center mt-4 name"> Account Information </div>
            <div class="p-3 mt-3">

                <div class="row">
                    <div class="col-md-6">
                        <h5>Name:</h5>
                        <div class="form-field d-flex align-items-center">
                            <?php echo utf8_decode($row['NOMBRE']); ?>
                            <input type="text" name="Name" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Surname:</h5>
                        <div class="form-field d-flex align-items-center">
                            <?php echo utf8_decode($row['APELLIDO1']); ?>
                            <input type="text" name="Surname" disabled="disabled">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Second surname:</h5>
                        <div class="form-field d-flex align-items-center">
                            <?php echo utf8_decode($row['APELLIDO2']); ?>
                            <input type="text" name="Surname" disabled="disabled">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Address:</h5>
                        <div class="form-field d-flex align-items-center">
                            <?php echo utf8_decode($row['DIRECCION']); ?>
                            <input type="text" name="Surname" disabled="disabled">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Username:</h5>
                        <div class="form-field d-flex align-items-center">
                            <?php echo utf8_decode($row['USUARIO']); ?>
                            <input type="text" name="Surname" disabled="disabled">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Email:</h5>
                        <div class="form-field d-flex align-items-center">
                            <?php echo utf8_decode($row['EMAIL']); ?>
                            <input type="text" name="Surname" disabled="disabled">
                        </div>
                    </div>
                </div>

                <a href="Logout.php">
                    <button class="btn mt-3">Log out
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd"
                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                    </button>
                </a>
            </div>

        </div>
    </div>
</body>

</html>