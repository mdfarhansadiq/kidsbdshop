<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: $FRD_HURL");
$FRc_InputData = file_get_contents("php://input");
$FRc_ARR = json_decode($FRc_InputData, true);
extract($FRc_ARR);
$FR_OUTPUT = [];
$FR_OUTPUT['FRA'] = 1;
$FR_OUTPUT['FRM'] = "DONE";
$FR_OUTPUT['FRrd_RUNNING_VERSION'] = $FR_SOFT_VERSION;
echo json_encode($FR_OUTPUT);