<?php
session_start();
session_destroy();
header("Location: /ProyectoLenguajes/index.php");

?>