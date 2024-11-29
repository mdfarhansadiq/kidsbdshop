<?php 
session_start();
session_destroy();

//FRD HINKS RICIVEING
if(isset($_GET['FRH'])){
    $FRH=$_GET['FRH'];
}
header("location:../index.php/?FRH=$FRH");