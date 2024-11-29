<?php
ob_start();

if(isset($_POST['FR_DATA'])){
    echo "
    <style>
    table, th, td {
      border: 1px solid #777;
    }
    </style>
    ";    
    
    $FR_DATA = $_POST['FR_DATA'];
    $FR_FILE_NAME = $_POST['FR_FILE_NAME'];
    
    echo "$FR_DATA";
    
    header("Content-type: application/vnd.ms-excel; name='excel'");
    header("Content-Disposition: attachment; filename=$FR_FILE_NAME.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
}
ob_end_flush();