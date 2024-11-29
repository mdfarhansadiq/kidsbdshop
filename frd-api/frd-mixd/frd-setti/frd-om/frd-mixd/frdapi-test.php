<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: $FRD_HURL");

$FRc_InputData = file_get_contents("php://input");
$FRc_ARR = json_decode($FRc_InputData, true);
extract($FRc_ARR);

$FR_OUTPUT = [];

$FR_OUTPUT['FRA'] = 1; 
$FR_OUTPUT['FRM'] =  "Done";
$FR_OUTPUT['FRM_BackD'] =  $FRc_ARR;

THIS_LAST:
echo json_encode($FR_OUTPUT);